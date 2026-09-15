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

**Security:** Use the External URL only on your machine. Do not commit connection strings to GitHub or show passwords on screen recordings.

#### Step 1 — Get the connection string from Render

1. Go to [dashboard.render.com](https://dashboard.render.com) and sign in.  
2. Open your PostgreSQL instance (**`peso-connect-db`**).  
3. Click the **Connections** tab.  
4. Find **External Database URL** and click **Copy** (eye icon to reveal first if needed).

It looks like:

```text
postgresql://peso_connect:YOUR_PASSWORD@dpg-xxxxx-a.oregon-postgres.render.com/peso_connect
```

Use **External** (not Internal) — Internal only works from other Render services in the same region.

#### Step 2 — Install DBeaver (recommended)

1. Download [DBeaver Community](https://dbeaver.io/download/) (Windows 64-bit installer).  
2. Run the installer → Next → Finish.  
3. Open **DBeaver**.

#### Step 3 — Create a PostgreSQL connection in DBeaver

DBeaver does **not** accept Render’s `postgresql://user:pass@host/db` string in the URL box (you may see **Invalid JDBC URL**). Use the **Main** tab fields instead.

1. **Database** menu → **New Database Connection** (plug icon).  
2. Choose **PostgreSQL** → **Next**.  
3. On the **Main** tab, fill in (from your External Database URL):

| DBeaver field | Example / where to get it |
|---------------|---------------------------|
| **Host** | `dpg-xxxxx-a.oregon-postgres.render.com` (between `@` and `/`) |
| **Port** | `5432` |
| **Database** | `peso_connect` (after the last `/`) |
| **Username** | `peso_connect` (after `://` and before `:`) |
| **Password** | characters between `:` and `@` |

4. Open the **SSL** tab → **SSL mode** = `require`.  
5. Click **Test Connection** → allow driver download if prompted → **Finish**.

**Optional — JDBC URL format** (only if you use the URL tab):

```text
jdbc:postgresql://dpg-xxxxx-a.oregon-postgres.render.com:5432/peso_connect
```

Use `jdbc:postgresql://` (not `postgresql://`). Put username and password on the **Main** tab, not in the URL.

#### Step 4 — Browse your tables

1. In the left **Database Navigator**, expand your connection.  
2. Expand **Databases** → **peso_connect** → **Schemas** → **public** → **Tables**.  
3. You should see tables such as:
   - `admins`
   - `job_postings`
   - `applicants`
   - `referrals`
   - `certifications`
   - `announcements`
   - `activity_logs`
   - (plus Laravel tables: `sessions`, `cache`, `migrations`, etc.)
4. Right-click a table (e.g. **`job_postings`**) → **View Data** → **All rows**.

That opens a spreadsheet-like view you can show your adviser.

#### Step 5 — Simple SQL (optional)

1. Right-click the connection → **SQL Editor** → **New SQL Script**.  
2. Example queries:

```sql
SELECT * FROM admins;
SELECT job_title, company, status FROM job_postings WHERE status = 'Active';
SELECT fullname, status, created_at FROM applicants ORDER BY created_at DESC LIMIT 10;
```

3. Highlight a query → **Execute** (Ctrl+Enter).

#### pgAdmin (alternative to DBeaver)

1. Install [pgAdmin](https://www.pgadmin.org/download/).  
2. Open pgAdmin → **Add New Server**.  
3. **General** tab → Name: `PESO Connect Render`.  
4. **Connection** tab → enter Host, Port, Database, Username, Password from the External URL.  
5. **SSL** tab → SSL mode: **Require** → **Save**.  
6. Expand **Servers** → **Databases** → **peso_connect** → **Schemas** → **public** → **Tables** → right-click → **View/Edit Data**.

#### Troubleshooting

| Issue | Fix |
|-------|-----|
| Connection timeout | Confirm you copied **External** URL; check internet / firewall |
| SSL required | Set SSL mode to `require` |
| Authentication failed | Re-copy URL from Render (password may have changed if DB was recreated) |
| No tables | Run migrations on Render Shell: `php artisan migrate --force` |

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
