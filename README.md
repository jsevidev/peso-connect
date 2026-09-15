# PESO Connect

A Laravel web application for the Public Employment Service Office (PESO) — connecting job seekers with employment opportunities, managing enlistments, referrals, certifications, announcements, and admin reporting.

## Features

- **Public portal** — job listings, enlistment, referrals, FTJS certification
- **Admin dashboard** — analytics, job/enlistee/referral management
- **FTJS Certification** — track and manage first-time job seeker certificates
- **Reports & Analytics** — enlistment trends and exportable reports
- **Announcements** — create, schedule, and publish public bulletins
- **Activity Logs** — audit trail for admin actions

## Requirements

- PHP 8.2+
- Composer
- Node.js & npm (optional, for frontend assets)

## Local setup

```bash
git clone https://github.com/jsevidev/peso-connect.git
cd peso-connect

composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan storage:link
php artisan serve
```

Open [http://127.0.0.1:8000](http://127.0.0.1:8000).

**Local database:** SQLite file at `database/database.sqlite` (created by migrate).

**Default admin login:** `admin` / `admin123`

## Admin routes

| Page | URL |
|------|-----|
| Dashboard | `/admin/dashboard` |
| Job Management | `/admin/jobs` |
| Enlistee Management | `/admin/enlistees` |
| Referral Management | `/admin/referrals` |
| FTJS Certification | `/admin/certifications` |
| Reports | `/admin/reports` |
| Announcements | `/admin/announcements` |
| Activity Logs | `/admin/activity-logs` |

## Tech stack

- [Laravel](https://laravel.com)
- Blade templates
- SQLite locally; PostgreSQL on Render (persistent online storage)

## License

Capstone project — see your institution's guidelines for use and attribution.

## Deploy live (free public URL)

This repo includes a [Render](https://render.com) config for a free public demo URL.

1. Sign up at [render.com](https://render.com) and connect your GitHub account.
2. Click **New +** → **Blueprint**.
3. Select the repo **jsevidev/peso-connect**.
4. Render reads `render.yaml` and creates the **web service** (one free Postgres DB per account — create or reuse separately; see below).
5. Click **Apply** and wait for the deploy to finish (~5–10 min first time).
6. In the web service → **Environment**, set:
   - **`DB_URL`** — Internal Database URL from your Render PostgreSQL instance
   - **`APP_URL`** — your live web URL (e.g. `https://peso-connect-xxxx.onrender.com`)
7. Save (triggers redeploy), then open your live URL.

**PostgreSQL (online data):** Render Dashboard → **New +** → **PostgreSQL** (free) if you do not already have one. Copy **Internal Database URL** into the web service `DB_URL`. Data persists across redeploys. On first boot, migrations run and demo seed data loads if the database is empty.

**Note:** On the free plan, the app sleeps after ~15 minutes of no traffic. The first visit after sleep may take 30–60 seconds to wake up. The free PostgreSQL database expires after 90 days of inactivity (Render policy) — use it for demos and capstone defense.

After deploy, set **APP_URL** in Render → your service → **Environment** to your exact Render URL if links look wrong.
