# PESO Connect — Deployment Guide

## Render (recommended for capstone demo — persistent online data)

The repo `render.yaml` provisions:

| Resource | Purpose |
|----------|---------|
| **Web service** (`peso-connect`) | Runs the Laravel app in Docker |
| **PostgreSQL** (`peso-connect-db`) | **Persistent online database** — data survives redeploys |

Local dev uses SQLite (`database/database.sqlite`). Production on Render uses PostgreSQL automatically via `DB_URL`.

On each deploy, the entrypoint runs `migrate --force` and seeds demo data **only if no admin accounts exist yet** — so your live data is not wiped on every redeploy.

### Deploy steps

1. Push latest code to GitHub `main`.
2. [Render Dashboard](https://dashboard.render.com) → **New +** → **Blueprint** → select `jsevidev/peso-connect`.
3. Click **Apply** (creates web + database).
4. Wait for deploy, then open your Render URL.
5. Log in with `admin` / `admin123`.

Uploaded FTJS files are still stored on the web container filesystem (not in Postgres). For a capstone demo, that is usually fine; only metadata paths are in the database.

---

## VPS (MySQL) — school or LGU hosting

Minimal steps to deploy on a typical Linux VPS (Ubuntu) with Nginx, PHP 8.2+, and MySQL.

## 1. Server requirements

- PHP 8.2+ with extensions: `mbstring`, `xml`, `pdo_mysql`, `tokenizer`, `fileinfo`, `openssl`, `curl`
- Composer 2.x
- MySQL 8 or MariaDB
- Nginx (or Apache)

## 2. Clone and install

```bash
git clone <your-repo-url> peso-connect
cd peso-connect
composer install --no-dev --optimize-autoloader
cp .env.example .env
php artisan key:generate
```

## 3. Environment (`.env`)

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.gov.ph

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=peso_connect
DB_USERNAME=peso_user
DB_PASSWORD=strong-password-here

MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_FROM_ADDRESS=noreply@your-domain.gov.ph

PESO_ADMIN_EMAIL=admin@your-domain.gov.ph
```

## 4. Database and storage

```bash
php artisan migrate --force
php artisan db:seed --force
php artisan storage:link
```

Uploaded FTJS ID copies are stored in `storage/app/public/ftjs-documents`.

## 5. Permissions

```bash
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

## 6. Nginx site block (example)

```nginx
server {
    listen 80;
    server_name your-domain.gov.ph;
    root /var/www/peso-connect/public;

    add_header X-Frame-Options "SAMEORIGIN";
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Enable HTTPS with Certbot after DNS is pointed to the server.

## 7. Production optimizations

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 8. Default admin accounts (change after first login)

| Username | Password |
|----------|----------|
| admin | admin123 |
| maria.santos | peso2026 |
| juan.delacruz | peso2026 |

**Change these passwords immediately** in production — update `AdminSeeder` or reset via tinker.

## 9. Local development

```bash
cd peso-connect
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan storage:link
php artisan serve
```

Use `MAIL_MAILER=log` locally so notification emails appear in `storage/logs/laravel.log`.

## 10. Running tests

```bash
php artisan test
```

Tests use an in-memory SQLite database and do not affect your dev MySQL/SQLite file.
