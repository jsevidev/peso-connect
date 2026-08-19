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
git clone https://github.com/YOUR_USERNAME/peso-connect.git
cd peso-connect

composer install
cp .env.example .env
php artisan key:generate
php artisan serve
```

Open [http://127.0.0.1:8000](http://127.0.0.1:8000).

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
- Config-driven sample data (`config/admin-content.php`)

## License

Capstone project — see your institution's guidelines for use and attribution.
