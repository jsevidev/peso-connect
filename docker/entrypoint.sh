#!/bin/sh
set -e

cd /var/www/html

if [ ! -f .env ]; then
  cp .env.example .env
fi

# Render may inject an empty APP_KEY env var, which overrides .env and breaks encryption.
if [ -z "$APP_KEY" ] || ! printf '%s' "$APP_KEY" | grep -qE '^base64:'; then
  export APP_KEY="$(php artisan key:generate --show --force)"
fi

# Fix common Render mistake: full URL pasted into DB_CONNECTION instead of DB_URL.
case "$DB_CONNECTION" in
  postgres://*|postgresql://*)
    export DB_URL="$DB_CONNECTION"
    export DB_CONNECTION=pgsql
    ;;
esac

if [ -z "$DB_URL" ] && [ -n "$DATABASE_URL" ]; then
  export DB_URL="$DATABASE_URL"
fi

if [ -z "$DB_URL" ]; then
  echo "ERROR: Set DB_URL to your Render Postgres Internal Database URL (DB_CONNECTION must be pgsql)."
  exit 1
fi

export DB_CONNECTION=pgsql
export SESSION_DRIVER="${SESSION_DRIVER:-file}"
export CACHE_STORE="${CACHE_STORE:-file}"

# Write Render env into .env so runtime requests use Postgres, not .env.example sqlite defaults.
php <<'PHP'
<?php
$path = '.env';
$contents = file_exists($path) ? file_get_contents($path) : '';

$quote = static function (string $value): string {
    if ($value === '' || (! str_contains($value, ' ') && ! str_contains($value, '#'))) {
        return $value;
    }

    return '"'.str_replace('"', '\\"', $value).'"';
};

$updates = [
    'APP_KEY' => getenv('APP_KEY') ?: '',
    'APP_ENV' => getenv('APP_ENV') ?: 'production',
    'APP_URL' => getenv('APP_URL') ?: '',
    'DB_CONNECTION' => 'pgsql',
    'DB_URL' => getenv('DB_URL') ?: getenv('DATABASE_URL') ?: '',
    'SESSION_DRIVER' => getenv('SESSION_DRIVER') ?: 'file',
    'CACHE_STORE' => getenv('CACHE_STORE') ?: 'file',
];

foreach ($updates as $key => $value) {
    if ($value === '') {
        continue;
    }

    $line = $key.'='.$quote($value);
    $pattern = '/^'.preg_quote($key, '/').'=.*/m';
    $contents = preg_match($pattern, $contents)
        ? preg_replace($pattern, $line, $contents)
        : ($contents.PHP_EOL.$line);
}

file_put_contents($path, rtrim($contents).PHP_EOL);
PHP

echo "Running migrations against Postgres..."
php artisan migrate --force --no-interaction
php artisan migrate:status --no-interaction || true

set +e
ADMIN_COUNT=$(php <<'PHP'
<?php
require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
echo App\Models\Admin::query()->count();
PHP
)
set -e
ADMIN_COUNT=${ADMIN_COUNT:-0}
echo "Admin count after migrate: ${ADMIN_COUNT}"

if [ "$ADMIN_COUNT" = "0" ]; then
  echo "Seeding demo data..."
  php artisan db:seed --force --no-interaction
fi

set +e
SCHEMA_OK=$(php <<'PHP'
<?php
require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

if (! Illuminate\Support\Facades\Schema::hasTable('employers')) {
    exit(1);
}

echo "Schema OK: employers table present.";
PHP
)
SCHEMA_STATUS=$?
set -e

if [ "$SCHEMA_STATUS" -ne 0 ]; then
  echo "WARN: employers table missing after migrate. Retrying migrations..."
  php artisan migrate --force --no-interaction
fi

echo "${SCHEMA_OK:-Schema check complete.}"

php artisan storage:link --force 2>/dev/null || true

php artisan config:clear --no-interaction || true
php artisan route:clear --no-interaction || true
php artisan view:clear --no-interaction || true

echo "Starting Laravel server on port ${PORT:-10000}..."
exec php artisan serve --host=0.0.0.0 --port="${PORT:-10000}"
