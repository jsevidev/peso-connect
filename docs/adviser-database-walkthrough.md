# PESO Connect — Adviser Database Walkthrough

Quick reference for progress meetings when your adviser asks to see the database, data storage, or how the backend works.

---

## One-minute summary (say this out loud)

> PESO Connect stores data in **PostgreSQL on Render** for our live demo site. Locally we use **SQLite** during development. The database has **7 main tables** from our ERD: admins, job_postings, applicants, referrals, certifications, announcements, and activity_logs. Laravel **migrations** create the tables; **seeders** load demo data; **Eloquent models** connect the app to the database.

**Live site:** https://peso-connect-8i0o.onrender.com  
**Admin login:** `/admin/login` — `admin` / `admin123`

---

## Option 1 — Show data through the app (recommended)

No SQL tools needed. This proves the database is connected and working.

### Public → Admin flow (2 minutes)

1. Open the **live site** → Home / Find Jobs (data from `job_postings`).
2. Submit a **test enlistment** (public form → saved to `applicants`).
3. Log in to **Admin** → **Enlistee Management** → show the new record.
4. Optional: **Reports** (charts from live queries), **Activity Logs** (admin actions logged).

### What each admin page reads from

| Admin page | Main table(s) |
|------------|----------------|
| Dashboard | applicants, referrals, certifications, job_postings |
| Job Management | job_postings |
| Enlistee Management | applicants |
| Referral Management | referrals, applicants |
| FTJS Certification | certifications, applicants |
| Announcements | announcements |
| Activity Logs | activity_logs |
| Reports | aggregated queries across tables |

### Export for adviser (CSV)

- **Enlistee Management** → Export List  
- **Reports** → Generate / export report  

Hand her the CSV — real exported data from the database.

---

## Option 2 — Show the database design (ERD)

Use this when she asks about **schema, relationships, or normalization**.

| File | How to open |
|------|-------------|
| [`peso-connect-erd.dbml`](peso-connect-erd.dbml) | Open in [dbdiagram.io](https://dbdiagram.io) or VS Code DBML extension |
| [`peso-connect-erd.drawio`](peso-connect-erd.drawio) | Open in [diagrams.net](https://app.diagrams.net) |
| [`backend-database-plan.md`](backend-database-plan.md) | Ctrl+Shift+V preview in VS Code |

### Tables at a glance

```
admins ──┬── job_postings ──┬── applicants ──┬── referrals
         │                  │                └── certifications
         │                  │
         └── announcements  └── (public enlistment forms)
         
activity_logs (audit trail for admin actions)
```

---

## Option 3 — Browse raw tables (PostgreSQL on Render)

Use when she wants to **see rows and columns** directly.

### A. Render dashboard (metadata only)

1. [dashboard.render.com](https://dashboard.render.com) → sign in  
2. Open **`peso-connect-db`** (PostgreSQL)  
3. Show: **Available** status, region, plan  
4. **Connections** tab — Internal / External URLs exist (do not share passwords on slides)

Render free tier does not include a built-in SQL editor. Use a desktop tool below for table browsing.

### B. DBeaver or pgAdmin (full table view)

1. Install [DBeaver](https://dbeaver.io/) (free) or [pgAdmin](https://www.pgadmin.org/)  
2. Render → **peso-connect-db** → **Connections** → copy **External Database URL**  
3. New connection → PostgreSQL → paste URL (or host, port, database, user, password)  
4. Browse schemas → **public** → tables → **View data**

**Security:** Use External URL only on your machine. Do not commit connection strings to GitHub.

### C. Render Shell (quick counts, no install)

1. Render → **peso-connect-8i0o** (web service) → **Shell**  
2. Run:

```bash
php artisan tinker
>>> \App\Models\Admin::count();
>>> \App\Models\JobPosting::where('status', 'Active')->count();
>>> \App\Models\Applicant::latest()->first();
>>> exit
```

---

## Option 4 — Local SQLite (development laptop)

**Path:** `peso-connect/database/database.sqlite`

This is your **local** database. It is **not** the same file as production unless you run the same migrations/seeds locally.

### DB Browser for SQLite

1. Install [DB Browser for SQLite](https://sqlitebrowser.org/)  
2. **Open Database** → select `database/database.sqlite`  
3. **Browse Data** → choose a table  

### Terminal (local project folder)

```bash
cd peso-connect
php artisan migrate:status    # list applied migrations
php artisan tinker            # query models interactively
```

---

## Local vs online — explain clearly

| | Local (your PC) | Online (Render) |
|--|-----------------|-------------------|
| **Engine** | SQLite | PostgreSQL |
| **File / host** | `database/database.sqlite` | `peso-connect-db` on Render |
| **Used by** | `php artisan serve` locally | https://peso-connect-8i0o.onrender.com |
| **Persists** | Until you delete the file or run `migrate:fresh` | Survives redeploys (Postgres is separate from the web container) |

**Important:** Running `php artisan db:seed` on your laptop seeds **local** SQLite. To seed or fix **online** data, use **Render Shell** on the web service or rely on automatic seed on first deploy when the database is empty.

---

## Code locations (if she asks “where is the database defined?”)

| What | Where |
|------|--------|
| Table structure | `database/migrations/` |
| Demo / seed data | `database/seeders/` |
| PHP models (ORM) | `app/Models/` |
| DB connection config | `config/database.php`, `.env` (local), Render **Environment** (production) |
| ERD documentation | `docs/peso-connect-erd.dbml`, `docs/peso-connect-erd.drawio` |

---

## Suggested 5-minute meeting agenda

1. **30 sec** — One-minute summary (top of this doc)  
2. **2 min** — Live demo: public jobs → enlistment → admin enlistee list  
3. **1 min** — Open ERD diagram (relationships)  
4. **1 min** — Export CSV or show one table in DBeaver (optional)  
5. **30 sec** — Mention tests (`php artisan test`) and GitHub repo  

---

## Troubleshooting (during the meeting)

| Problem | Fix |
|---------|-----|
| Live site slow first load | Free Render tier wakes after ~15 min idle; wait 30–60 sec |
| Empty jobs/enlistees online | Render Shell: `php artisan migrate --force && php artisan db:seed --force` |
| `/admin` shows 404 | Use **`/admin/login`** (or `/admin` after latest deploy with redirect) |
| Adviser asks for ERD file | Share `docs/peso-connect-erd.drawio` or screenshot from dbdiagram.io |

---

## Related docs

- [Demo script for defense](demo-script.md)  
- [Deployment guide](deployment.md)  
- [Backend & database plan](backend-database-plan.md)
