#!/bin/sh
set -e

cd /var/www/html

if [ ! -f .env ]; then
  cp .env.example .env
fi

if [ -z "$APP_KEY" ] || [ "$APP_KEY" = "" ]; then
  php artisan key:generate --force
fi

php artisan migrate --force

ADMIN_COUNT=$(php artisan tinker --execute="echo \\App\\Models\\Admin::count();" 2>/dev/null | tail -n 1)
if [ "$ADMIN_COUNT" = "0" ]; then
  php artisan db:seed --force
fi

php artisan storage:link --force 2>/dev/null || true

php artisan config:cache
php artisan route:cache
php artisan view:cache

exec php artisan serve --host=0.0.0.0 --port="${PORT:-10000}"
