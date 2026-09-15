# PESO Connect — Capstone Defense Demo Script

Use this 8–10 minute walkthrough after running `php artisan migrate:fresh --seed` and `php artisan serve`.

## Before you start

| Item | Value |
|------|-------|
| Public site | http://127.0.0.1:8000 |
| Admin login | http://127.0.0.1:8000/admin/login |
| Admin accounts | `admin` / `admin123`, `maria.santos` / `peso2026`, `juan.delacruz` / `peso2026 |

---

## 1. Public landing (1 min)

1. Open the home page — point out featured jobs and latest announcements from the database.
2. Click an announcement card → show the **detail page** with full description and CTA button.

## 2. Job seeker flow (2 min)

1. Go to **Find Jobs** — search or filter by type/salary.
2. Click **Enlist** on a job → submit the enlistment form (use a test name).
3. Show the success message and mention validation if you submit empty fields.

## 3. Referral & FTJS (1 min)

1. Briefly open **Referral Requests** — explain it creates both an applicant and referral record.
2. Open **First-Time Job Seeker** — mention optional ID upload and RA 11261 eligibility checkboxes.

## 4. Admin login & dashboard (1 min)

1. Log in as `admin` / `admin123`.
2. Show dashboard stats (enlistees, referrals, certifications) sourced from live queries.

## 5. Enlistee management (2 min)

1. Open **Enlistee Management** — show the new submission from step 2.
2. Change status via the dropdown.
3. Edit an enlistee or delete a test record (with confirmation).
4. Export CSV.

## 6. Jobs, announcements, referrals (1 min)

1. **Job Postings** — add or archive a job; explain it appears on the public jobs page.
2. **Announcements** — show publish/edit; new posts appear on `/announcements`.
3. **Referrals** — approve or deny a pending referral.

## 7. FTJS certifications & reports (1 min)

1. **FTJS Certifications** — approve/print/claim workflow.
2. **Reports** — monthly enlistment chart and dynamic donut segments.
3. **Activity Logs** — show login and actions recorded during the demo.

## 8. Wrap-up talking points

- Laravel MVC: routes → controllers → Eloquent models → Blade views
- Seeders provide realistic demo data with relative dates
- Public forms validate input and notify admin via email (logged in dev)
- Feature tests cover auth, jobs listing, and enlistment submission

---

## If something breaks live

```bash
cd peso-connect
php artisan migrate:fresh --seed
php artisan storage:link
php artisan serve
```
