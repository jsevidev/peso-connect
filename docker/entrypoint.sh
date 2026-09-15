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
if grep -q '^APP_KEY=' .env; then
  sed -i "s|^APP_KEY=.*|APP_KEY=${APP_KEY}|" .env
else
  echo "APP_KEY=${APP_KEY}" >> .env
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

php artisan migrate --force

ADMIN_COUNT=$(php artisan tinker --execute="echo \\App\\Models\\Admin::count();" 2>/dev/null | tail -n 1)
if [ "$ADMIN_COUNT" = "0" ]; then
  php artisan db:seed --force
fi

php artisan storage:link --force 2>/dev/null || true

# Do not cache config — Render env vars (DB_URL) must be read fresh each boot.
php artisan config:clear
php artisan route:clear
php artisan view:clear

exec php artisan serve --host=0.0.0.0 --port="${PORT:-10000}"
