<style>

/* latin-ext */
@font-face {
  font-family: 'Instrument Serif';
  font-style: normal;
  font-weight: 400;
  font-display: swap;
  src: url(https://fonts.gstatic.com/s/instrumentserif/v5/jizBRFtNs2ka5fXjeivQ4LroWlx-6zsTjmbI.woff2) format('woff2');
  unicode-range: U+0100-02BA, U+02BD-02C5, U+02C7-02CC, U+02CE-02D7, U+02DD-02FF, U+0304, U+0308, U+0329, U+1D00-1DBF, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
  font-family: 'Instrument Serif';
  font-style: normal;
  font-weight: 400;
  font-display: swap;
  src: url(https://fonts.gstatic.com/s/instrumentserif/v5/jizBRFtNs2ka5fXjeivQ4LroWlx-6zUTjg.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}


@font-face {
  font-family: 'Inter';
  font-style: normal;
  font-weight: 100 900;
  font-display: swap;
  src: url('https://cdn.divriots.com/fonts/inter/v3.19/Inter.var.woff2') format('woff2');
}
@font-face {
  font-family: 'Inter';
  font-style: italic;
  font-weight: 100 900;
  font-display: swap;
  src: url('https://cdn.divriots.com/fonts/inter/v3.19/Inter.var.woff2') format('woff2');
  font-variation-settings: 'slnt' -10;
}


*,
*::before,
*::after {
  box-sizing: border-box;
}

body {
  -webkit-font-smoothing: auto;
}

button {
  -webkit-font-smoothing: inherit;
  -moz-osx-font-smoothing: inherit;
  -webkit-appearance: none;
}
* {
  padding: 0;
  margin: 0;
}a {
  color: inherit;
  text-decoration: inherit;
}
input {
  border: none;
  font: inherit;
  outline: none;
  background-color: inherit;
}
button {
  border-style: none;
  width: auto;
  overflow: visible;
  background: transparent;
  font: inherit;
  line-height: normal;
  color: inherit;
}
textarea {
  font: inherit;
  background-color: inherit;
}
select {
  font: inherit;
  background-color: inherit;
}
img {
  display: block;
}
picture {
  display: block;
}
video {
  display: block;
}
canvas {
  display: block;
}
svg {
  display: block;
}

[data-visible='false']{
  display:none!important;
}

.before-hidden::before {
  display:none;
}

.after-hidden::after {
  display:none;
}

.before-visible::before {
  content: "";
}

.after-visible::after {
  content: "";
}

.text {
  white-space: pre-wrap;
  overflow-wrap: break-word;
}

/* Admin layout */
.admin-body { margin: 0; background: #f4f6f9; }
.turbo-progress-bar {
  height: 3px;
  background-color: #1b3a6b;
}
turbo-frame#admin-content {
  display: block;
  min-height: 100%;
}
turbo-frame#admin-content[busy] .admin-content {
  opacity: 0.72;
  transition: opacity 0.15s ease;
}
.admin-login-body { margin: 0; background: #f8fafc; min-height: 100vh; }
.admin-shell { display: flex; min-height: 100vh; width: 100%; }
.admin-sidebar {
  flex: 0 0 260px; width: 260px; background: #0f2241; padding: 24px 16px;
  display: flex; flex-direction: column; min-height: 100vh;
}
.admin-sidebar__brand { display: flex; align-items: center; gap: 12px; margin-bottom: 32px; }
.admin-sidebar__logo { width: 40px; height: 40px; border-radius: 20px; object-fit: cover; }
.admin-sidebar__title { font-family: "Instrument Serif", system-ui, sans-serif; font-size: 20px; color: #fff; }
.admin-sidebar__subtitle { font-size: 10px; font-weight: 600; text-transform: uppercase; color: #94a3b8; }
.admin-nav { display: flex; flex-direction: column; gap: 4px; flex: 1; }
.admin-nav__link {
  display: flex; align-items: center; gap: 12px; padding: 12px 16px; border-radius: 10px;
  font-size: 14px; font-family: Inter, system-ui, sans-serif; color: #94a3b8; text-decoration: none;
}
.admin-nav__link:hover { background: rgba(255,255,255,0.05); color: #fff; }
.admin-nav__link.is-active {
  background: #1a355e; border: 1px solid rgba(255,255,255,0.1); color: #fff; font-weight: 600;
}
.admin-nav__dot { width: 6px; height: 6px; border-radius: 3px; background: #f57c00; margin-left: auto; flex-shrink: 0; }
.admin-sidebar__logout {
  margin-top: auto; display: block; width: 100%; padding: 12px 16px; border-radius: 10px;
  background: #db3838; color: #fff; font-size: 14px; font-weight: 600; font-family: Inter, system-ui, sans-serif;
  text-align: center; cursor: pointer; border: none;
}
.admin-main { flex: 1 1 0; min-width: 0; display: flex; flex-direction: column; }
.admin-topbar {
  background: #fff; padding: 16px clamp(16px, 4vw, 32px); display: flex; align-items: center;
  justify-content: space-between; flex-wrap: wrap; gap: 12px; box-shadow: 0 4px 12px rgba(15,23,42,0.03);
}
.admin-breadcrumb { display: flex; align-items: center; gap: 8px; font-size: 14px; font-family: Inter, system-ui, sans-serif; }
.admin-breadcrumb a { color: #64748b; text-decoration: none; }
.admin-breadcrumb a:hover { color: #1b3a6b; }
.admin-breadcrumb__current { color: #1b3a6b; font-weight: 600; }
.admin-topbar__user { text-align: right; }
.admin-topbar__name { font-size: 14px; font-weight: 600; color: #1e293b; font-family: Inter, system-ui, sans-serif; }
.admin-topbar__role { font-size: 11px; font-weight: 600; color: #f57c00; font-family: Inter, system-ui, sans-serif; }
.admin-content { padding: clamp(20px, 4vw, 32px); flex: 1; }
.admin-page-header { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 16px; margin-bottom: 24px; }
.admin-live-badge {
  display: inline-flex; align-items: center; gap: 8px; padding: 6px 12px;
  border-radius: 100px; background: #dcfce7; flex-shrink: 0;
  font-size: 12px; font-weight: 600; color: #15803d; font-family: Inter, system-ui, sans-serif;
}
.admin-live-badge::before {
  content: ''; width: 6px; height: 6px; border-radius: 50%; background: #15803d; flex-shrink: 0;
}
.admin-page-title { font-family: "Instrument Serif", system-ui, sans-serif; font-size: clamp(24px, 4vw, 32px); color: #1e293b; }
.admin-page-subtitle { font-size: 14px; color: #64748b; font-family: Inter, system-ui, sans-serif; margin-top: 4px; }
.admin-card {
  background: #fff; border-radius: 20px; padding: 24px; box-shadow: 0 4px 12px rgba(15,23,42,0.03);
  border: 1px solid #e5e8ef;
}
.admin-stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 24px; }
.admin-stat-card { background: #fff; border: 1px solid #e5e8ef; border-radius: 12px; padding: 20px; box-shadow: 0 4px 12px rgba(15,23,42,0.03); }
.admin-stat-card__label { font-size: 13px; font-weight: 600; text-transform: uppercase; color: #64748b; font-family: Inter, system-ui, sans-serif; }
.admin-stat-card__value { font-size: 28px; font-weight: 700; color: #1e293b; margin: 8px 0 4px; font-family: Inter, system-ui, sans-serif; }
.admin-stat-card__change { font-size: 12px; font-family: Inter, system-ui, sans-serif; }
.admin-stat-card__change--up { color: #10b981; font-weight: 600; }
.admin-stat-card__change--down { color: #ef4444; font-weight: 600; }
.admin-btn {
  display: inline-flex; align-items: center; justify-content: center; padding: 10px 20px; border-radius: 10px;
  font-size: 14px; font-weight: 600; font-family: Inter, system-ui, sans-serif; cursor: pointer; border: none; text-decoration: none;
}
.admin-btn--primary { background: #1b3a6b; color: #fff; }
.admin-btn--accent { background: #f57c00; color: #fff; }
.admin-btn--outline {
  background: #fff; color: #0f172a; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 16px;
}
.admin-btn--ghost { background: #fff; color: #64748b; border: 1px solid #e2e8f0; }
.admin-btn--danger { background: #db3838; color: #fff; }
.admin-filters { display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; align-items: center; }
.admin-filter-panel {
  display: flex; flex-wrap: wrap; gap: 16px; align-items: flex-end; margin-bottom: 24px;
  padding: 20px; border: 1px solid #e2e8f0; border-radius: 20px; background: #fff;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.03);
}
.admin-filter-field { display: flex; flex-direction: column; gap: 6px; min-width: 0; }
.admin-filter-field--grow { flex: 1 1 240px; }
.admin-filter-field--position { flex: 0 1 240px; width: 240px; max-width: 100%; }
.admin-filter-field--status,
.admin-filter-field--date { flex: 0 1 180px; width: 180px; max-width: 100%; }
.admin-filter-label {
  font-size: 11px; font-weight: 600; text-transform: uppercase; color: #64748b;
  font-family: Inter, system-ui, sans-serif;
}
.admin-filter-input-wrap {
  display: flex; align-items: center; gap: 10px; border: 1px solid #e2e8f0; border-radius: 8px;
  background: #fff; padding: 10px 14px;
}
.admin-filter-input-wrap .admin-input {
  border: none; background: transparent; padding: 0; flex: 1; min-width: 0; border-radius: 0;
}
.admin-filter-panel .admin-select {
  border-radius: 8px; background: #fff; border: 1px solid #e2e8f0; padding: 10px 36px 10px 14px;
}
.admin-btn--reset {
  background: #fff; color: #64748b; border: 1px solid #e2e8f0; border-radius: 8px;
  padding: 11px 16px; font-weight: 600; text-decoration: none;
}
.admin-input, .admin-select, .admin-textarea {
  border: 1px solid #e2e8f0; border-radius: 10px; background: #f8fafc; padding: 10px 16px;
  font-size: 14px; font-family: Inter, system-ui, sans-serif; color: #0f172a; width: 100%; box-sizing: border-box;
}
.admin-input::placeholder, .admin-textarea::placeholder { color: #64748b; }
.admin-select { appearance: none; cursor: pointer; padding-right: 36px;
  background-image: url("data:image/svg+xml,%3Csvg width='10' height='6' viewBox='0 0 10 6' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 0L4 4 8 0' stroke='%2364748b' stroke-width='2' stroke-linecap='round'/%3E%3C/svg%3E");
  background-repeat: no-repeat; background-position: right 12px center;
}
.admin-field-label { font-size: 13px; font-weight: 600; color: #0f172a; font-family: Inter, system-ui, sans-serif; display: block; margin-bottom: 8px; }
.admin-field-required { color: #ef4444; }
.admin-table-wrap { overflow-x: auto; width: 100%; }
.admin-table-wrap--fit { overflow-x: visible; }
.admin-table { width: 100%; border-collapse: collapse; font-family: Inter, system-ui, sans-serif; min-width: 720px; }
.admin-table--fit {
  min-width: 0;
  table-layout: fixed;
}
.admin-table--fit th,
.admin-table--fit td {
  padding: 14px 12px;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
.admin-table--fit th:nth-child(1),
.admin-table--fit td:nth-child(1) { width: 26%; }
.admin-table--fit th:nth-child(2),
.admin-table--fit td:nth-child(2) { width: 34%; }
.admin-table--fit th:nth-child(3),
.admin-table--fit td:nth-child(3) { width: 18%; }
.admin-table--fit th:nth-child(4),
.admin-table--fit td:nth-child(4) { width: 22%; }
.admin-table--fit td:last-child,
.admin-table--fit th:last-child { white-space: normal; }
.admin-table th {
  text-align: left; padding: 12px 16px; font-size: 12px; font-weight: 600; text-transform: uppercase;
  color: #64748b; background: #f8fafc; border-bottom: 1px solid #e2e8f0;
}
.admin-table td { padding: 16px; border-bottom: 1px solid #e2e8f0; font-size: 14px; color: #0f172a; vertical-align: middle; }
.admin-table tr:nth-child(even) td { background: #f8fafc; }
.admin-badge {
  display: inline-block; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600;
  font-family: Inter, system-ui, sans-serif;
}
.admin-badge--green { background: #d1fae5; color: #047857; }
.admin-badge--red { background: #fee2e2; color: #b91c1c; }
.admin-badge--gray { background: #f1f5f9; color: #475569; }
.admin-badge--amber { background: #fef3c7; color: #b45309; }
.admin-badge--blue { background: #dbeafe; color: #1d4ed8; }
.admin-status-pill.admin-badge { padding: 0; border-radius: 99px; }
.admin-status-pill {
  display: inline-flex; align-items: center; position: relative; max-width: 100%;
  border-radius: 99px; padding-right: 4px;
}
.admin-status-pill::after {
  content: '▾'; position: absolute; right: 10px; font-size: 10px; pointer-events: none; line-height: 1;
}
.admin-status-pill__select {
  appearance: none; border: none; background: transparent; font-size: 12px; font-weight: 600;
  font-family: Inter, system-ui, sans-serif; cursor: pointer; padding: 6px 24px 6px 12px;
  border-radius: 99px; color: inherit; max-width: 100%;
}
.admin-status-pill__select:focus { outline: none; }
.admin-skill-tags { display: flex; flex-wrap: wrap; gap: 8px; width: 100%; padding-bottom: 4px; }
.admin-skill-tag {
  border-radius: 6px; background: #eef4f8; display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px;
}
.admin-skill-tag__label {
  font-size: 12px; font-weight: 700; text-transform: uppercase; color: #1b3a6b;
  font-family: Inter, system-ui, sans-serif;
}
.admin-skill-tag__remove {
  border: none; background: transparent; padding: 0; cursor: pointer; display: flex; align-items: center;
}
.admin-skill-input-wrap {
  display: flex; align-items: center; gap: 10px; border: 1px solid #e2e8f0; border-radius: 10px;
  background: #f8fafc; padding: 10px 16px; height: 44px; width: 100%; box-sizing: border-box;
}
.admin-skill-input-wrap .admin-input {
  border: none; background: transparent; padding: 0; height: auto; flex: 1; min-width: 0; border-radius: 0;
}
.admin-detail-value {
  border: 1px solid #e2e8f0; border-radius: 10px; background: #f5f7fa; padding: 10px 16px; min-height: 44px;
  display: flex; align-items: center; font-size: 14px; color: #1c2433; font-family: Inter, system-ui, sans-serif;
  width: 100%; box-sizing: border-box; line-height: 1.4;
}
.admin-referral-stats {
  display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 24px;
}
.admin-referral-stat-card {
  border-radius: 20px; background: #fff; padding: 24px; box-shadow: 0 4px 16px rgba(27, 58, 107, 0.06);
  display: flex; flex-direction: column; gap: 12px;
}
.admin-referral-stat-card__header {
  display: flex; align-items: center; justify-content: space-between; width: 100%;
}
.admin-referral-stat-card__label {
  font-size: 14px; font-weight: 600; text-transform: uppercase; color: #5a6e85;
  font-family: Inter, system-ui, sans-serif;
}
.admin-referral-stat-card__icon {
  width: 36px; height: 36px; border-radius: 18px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.admin-referral-stat-card__value {
  font-size: 32px; font-weight: 700; color: #1c2d42; font-family: Inter, system-ui, sans-serif;
}
.admin-referral-toolbar {
  display: flex; flex-wrap: wrap; gap: 16px; align-items: center; margin-bottom: 24px; padding: 16px;
  border-radius: 16px; background: #fff; box-shadow: 0 4px 16px rgba(27, 58, 107, 0.06);
}
.admin-referral-search {
  flex: 1 1 240px; display: flex; align-items: center; gap: 8px; height: 40px; padding: 0 12px;
  border-radius: 8px; background: #f4f6f9;
}
.admin-referral-search .admin-input {
  border: none; background: transparent; padding: 0; height: auto; flex: 1; min-width: 0; border-radius: 0;
}
.admin-referral-filter-select {
  border: 1px solid #e2e8f0; border-radius: 8px; padding: 10px 36px 10px 14px; background: #fff;
  font-size: 14px; font-weight: 500; color: #1c2d42; font-family: Inter, system-ui, sans-serif;
  appearance: none; cursor: pointer; min-width: 0;
  background-image: url("data:image/svg+xml,%3Csvg width='10' height='6' viewBox='0 0 10 6' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 0L4 4 8 0' stroke='%235a6e85' stroke-width='2' stroke-linecap='round'/%3E%3C/svg%3E");
  background-repeat: no-repeat; background-position: right 12px center;
}
.admin-referral-table-wrap { overflow-x: auto; margin-bottom: 24px; }
.admin-referral-table {
  min-width: 960px; border-radius: 20px; overflow: hidden; box-shadow: 0 4px 16px rgba(27, 58, 107, 0.06); background: #fff;
}
.admin-referral-table__head,
.admin-referral-table__row {
  display: flex; align-items: center; gap: 8px; padding-left: 24px; padding-right: 24px;
}
.admin-referral-table__head {
  background: #1b3a6b; color: #fff; font-size: 12px; font-weight: 700; text-transform: uppercase;
  font-family: Inter, system-ui, sans-serif; padding-top: 14px; padding-bottom: 14px;
}
.admin-referral-table__row {
  border-bottom: 1px solid #e2e8f0; padding-top: 16px; padding-bottom: 16px;
}
.admin-referral-table__col-name { flex: 1 1 0; min-width: 0; }
.admin-referral-table__col-company { flex: 0 0 220px; min-width: 160px; }
.admin-referral-table__col-position { flex: 0 0 210px; min-width: 140px; }
.admin-referral-table__col-date { flex: 0 0 140px; min-width: 120px; flex-shrink: 0; }
.admin-referral-table__col-status { flex: 0 0 140px; min-width: 120px; flex-shrink: 0; }
.admin-referral-table__col-actions {
  flex: 0 0 160px; min-width: 140px; display: flex; justify-content: center; gap: 6px; flex-wrap: wrap;
}
.admin-referral-table__row .admin-referral-table__col-date {
  font-size: 14px; color: #5a6e85; font-family: Inter, system-ui, sans-serif;
}
.admin-referral-name { font-size: 14px; font-weight: 600; color: #1c2d42; font-family: Inter, system-ui, sans-serif; }
.admin-referral-name__sub { font-size: 12px; color: #5a6e85; margin-top: 4px; font-family: Inter, system-ui, sans-serif; }
.admin-referral-cell { font-size: 14px; font-weight: 500; color: #1c2d42; font-family: Inter, system-ui, sans-serif; }
.admin-badge--referral-pending { background: #fff3e0; color: #f57c00; border-radius: 30px; }
.admin-badge--referral-approved { background: #e8f5e9; color: #2e7d32; border-radius: 30px; }
.admin-badge--referral-denied { background: #ffebee; color: #c62828; border-radius: 30px; }
.admin-badge--cert-pending { background: #fffde7; color: #d28e00; border-radius: 30px; }
.admin-badge--cert-claimed { background: #e8f5e9; color: #2e7d32; border-radius: 30px; }
.admin-badge--cert-not-claimed { background: #fff3e0; color: #f57c00; border-radius: 30px; }
.admin-ftjs-table__col-barangay { flex: 0 0 240px; min-width: 180px; flex-shrink: 0; }
.admin-referral-table__row .admin-ftjs-table__col-barangay {
  font-size: 14px; font-weight: 500; color: #1c2d42; font-family: Inter, system-ui, sans-serif;
}
.admin-ftjs-table__col-actions {
  flex: 0 0 220px; min-width: 220px; flex-shrink: 0; display: flex; justify-content: flex-end; align-items: center; gap: 8px;
}
.admin-referral-table--ftjs {
  min-width: 100%;
}
.admin-referral-table--ftjs .admin-referral-table__head,
.admin-referral-table--ftjs .admin-referral-table__row {
  display: grid;
  grid-template-columns: minmax(180px, 220px) 140px minmax(200px, 1fr) 140px minmax(210px, auto);
  gap: 0;
  column-gap: 16px;
  align-items: center;
}
.admin-referral-table--ftjs .admin-referral-table__col-name,
.admin-referral-table--ftjs .admin-referral-table__col-date,
.admin-referral-table--ftjs .admin-ftjs-table__col-barangay,
.admin-referral-table--ftjs .admin-referral-table__col-status,
.admin-referral-table--ftjs .admin-ftjs-table__col-actions {
  flex: unset;
  min-width: 0;
  width: auto;
}
.admin-referral-table--ftjs .admin-ftjs-table__col-barangay {
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
.admin-referral-table--ftjs .admin-referral-table__head .admin-ftjs-table__col-actions {
  text-align: right;
  justify-content: flex-end;
}
.admin-referral-table--ftjs .admin-ftjs-table__col-actions {
  justify-self: stretch;
  justify-content: flex-end;
}
.admin-ftjs-actions { display: flex; align-items: center; justify-content: flex-end; gap: 8px; flex-wrap: nowrap; }
.admin-ftjs-btn {
  display: inline-flex; align-items: center; gap: 6px; border-radius: 6px;
  padding: 6px 12px 6px 12px; font-size: 12px; font-weight: 600; font-family: Inter, system-ui, sans-serif;
  cursor: pointer; border: none; white-space: nowrap;
}
.admin-ftjs-btn--print {
  background: #fff; border: 1px solid #1b3a6b; color: #1b3a6b;
}
.admin-ftjs-btn--claim { background: #1b3a6b; color: #fff; min-width: 124px; }
.admin-ftjs-btn--claimed {
  background: #e2e8f0; color: #5a6e85; min-width: 124px; opacity: 0.6; cursor: not-allowed;
}
.admin-icon-btn--neutral { background: #fff; border: 1px solid #e2e8f0; border-radius: 6px; }
.admin-btn--create { border-radius: 8px; padding: 10px 16px; gap: 8px; }
.admin-modal--referral-letter { max-width: 640px; border-radius: 16px; box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08); }
.admin-modal--referral-preview { max-width: 480px; padding: 0; background: transparent; box-shadow: none; overflow: visible; }
.admin-referral-letter-modal__header {
  display: flex; align-items: flex-start; justify-content: space-between; gap: 16px;
  padding: 24px 28px 16px; border-bottom: none;
}
.admin-referral-letter-modal__title {
  font-size: 18px; font-weight: 700; color: #1b2538; font-family: Inter, system-ui, sans-serif; margin: 0;
}
.admin-referral-letter-modal__subtitle {
  font-size: 12px; color: #667385; margin-top: 4px; font-family: Inter, system-ui, sans-serif;
}
.admin-referral-letter-modal__body { padding: 0 28px 24px; }
.admin-referral-letter-modal__footer {
  display: flex; justify-content: flex-end; gap: 12px; padding: 16px 28px 20px;
}
.admin-referral-letter {
  border-radius: 12px; background: #f4f6f9; padding: 20px 24px;
  display: flex; flex-direction: column; gap: 8px; font-family: Inter, system-ui, sans-serif; color: #1b2538;
}
.admin-referral-letter--preview { border: 1px solid #e2e8f0; gap: 12px; }
.admin-referral-letter__masthead {
  display: flex; flex-direction: column; align-items: center; gap: 2px; text-align: center; width: 100%;
}
.admin-referral-letter__masthead small {
  font-size: 9px; font-weight: 700; text-transform: uppercase; color: #5a6e85;
}
.admin-referral-letter__masthead strong {
  font-size: 10px; font-weight: 800; color: #1b3a6b;
}
.admin-referral-letter__masthead span {
  font-size: 8px; color: #5a6e85;
}
.admin-referral-letter__divider {
  border-top: 1px solid #bfc7d6; width: 100%; margin: 0;
}
.admin-referral-letter__divider--light { border-color: #e2e8f0; }
.admin-referral-letter__meta {
  display: flex; flex-direction: column; gap: 2px; font-size: 9px; width: 100%;
}
.admin-referral-letter__meta-label { font-weight: 700; font-size: 10px; }
.admin-referral-letter__field {
  border: 1.5px solid #4d80d9; border-radius: 6px; background: #fff;
  padding: 3px 6px; font-size: 10px; font-family: Inter, system-ui, sans-serif; color: #1b2538;
  width: 100%; box-sizing: border-box;
}
.admin-referral-letter__field::placeholder { color: #8c94a6; font-weight: 300; }
.admin-referral-letter__field--inline {
  display: inline-flex; width: auto; min-width: 100px; max-width: 100%; font-size: 11px;
}
.admin-referral-letter__field--select {
  appearance: none; cursor: pointer; padding-right: 22px;
  background-image: url("data:image/svg+xml,%3Csvg width='10' height='6' viewBox='0 0 10 6' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 0L4 4 8 0' stroke='%23667385' stroke-width='2' stroke-linecap='round'/%3E%3C/svg%3E");
  background-repeat: no-repeat; background-position: right 6px center;
}
.admin-referral-letter__subject {
  display: flex; flex-wrap: wrap; align-items: center; gap: 4px; font-size: 11px; font-weight: 700;
}
.admin-referral-letter__subject .admin-referral-letter__field--inline {
  flex: 1; min-width: 120px;
}
.admin-referral-letter__paragraph {
  font-size: 10px; line-height: 1.5; color: #1b2538;
}
.admin-referral-letter__paragraph--inline {
  display: flex; flex-wrap: wrap; align-items: center; gap: 4px;
}
.admin-referral-letter__paragraph--preview { font-size: 9px; line-height: 1.4; }
.admin-referral-letter__signoff {
  display: flex; flex-direction: column; gap: 1px; font-size: 10px; padding-top: 4px;
}
.admin-referral-letter__signoff small { font-size: 9px; color: #667385; }
.admin-referral-preview {
  background: #fff; border: 1px solid #e2e8f0; border-radius: 20px;
  box-shadow: 0 4px 16px rgba(27, 58, 107, 0.06); padding: 24px 24px 0; width: 100%;
}
.admin-referral-preview__header {
  display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-bottom: 20px;
}
.admin-referral-preview__title-wrap {
  display: flex; align-items: center; gap: 8px;
}
.admin-referral-preview__title {
  font-size: 16px; font-weight: 700; color: #1c2d42; font-family: Inter, system-ui, sans-serif; margin: 0;
}
.admin-referral-preview__badge {
  display: inline-flex; padding: 4px 8px; border-radius: 6px; background: #e8eef5;
  color: #1b3a6b; font-size: 10px; font-weight: 600; font-family: Inter, system-ui, sans-serif;
}
.admin-referral-preview__desc {
  font-size: 12px; color: #5a6e85; margin: -12px 0 20px; font-family: Inter, system-ui, sans-serif; line-height: 1.5;
}
.admin-referral-preview__actions {
  display: flex; flex-direction: column; gap: 10px; padding: 8px 0 24px;
}
.admin-referral-preview__actions-row {
  display: flex; gap: 12px; width: 100%;
}
.admin-btn--letter-primary {
  width: 100%; border-radius: 10px; padding: 12px 0; justify-content: center;
}
.admin-btn--letter-secondary {
  flex: 1; border-radius: 10px; padding: 12px 0; justify-content: center;
  background: #fff; border: 1px solid #e2e8f0; color: #1c2d42; gap: 8px;
}
.admin-btn--text-cancel {
  background: transparent; border: none; color: #667385; font-size: 13px; font-weight: 500; padding: 10px 20px;
}
.admin-icon-btn {
  display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px;
  border-radius: 6px; border: 1px solid #e2e8f0; background: #f1f5f9; cursor: pointer; padding: 0;
}
.admin-icon-btn--amber { background: #fffbeb; border-color: #fef3c7; }
.admin-icon-btn--danger { background: #fef2f2; border-color: #fee2e2; }
.admin-icon-btn--outline { background: #fff; border-color: #1b3a6b; }
.admin-row-actions form { display: inline; margin: 0; }
.admin-modal-backdrop {
  position: fixed; inset: 0; background: rgba(15,23,42,0.45); display: none;
  align-items: center; justify-content: center; z-index: 1000; padding: 20px;
  overflow: hidden;
}
.admin-modal-backdrop.is-open {
  display: flex;
  overflow-y: scroll;
  -ms-overflow-style: none;
  scrollbar-width: none;
}
.admin-modal-backdrop.is-open::-webkit-scrollbar {
  display: none;
  width: 0;
  height: 0;
}
.admin-modal {
  background: #fff; border-radius: 20px; width: 100%; max-width: 560px;
  max-height: min(90dvh, calc(100vh - 40px));
  display: flex; flex-direction: column; overflow: hidden; min-height: 0; flex-shrink: 0;
  box-shadow: 0 20px 40px rgba(15,23,42,0.15);
}
.admin-modal > form {
  display: flex; flex-direction: column; flex: 1 1 auto; min-height: 0; max-height: 100%; overflow: hidden;
}
.admin-modal__header { padding: 24px; border-bottom: 1px solid #e2e8f0; display: flex; align-items: flex-start; justify-content: space-between; gap: 16px; flex-shrink: 0; }
.admin-modal__title { font-size: 20px; font-weight: 700; color: #0f172a; font-family: Inter, system-ui, sans-serif; }
.admin-modal__subtitle { font-size: 13px; color: #64748b; margin-top: 4px; font-family: Inter, system-ui, sans-serif; }
.admin-modal__close { width: 32px; height: 32px; border-radius: 16px; background: #f8fafc; border: none; cursor: pointer; flex-shrink: 0; }
.admin-modal__body {
  padding: 24px; display: flex; flex-direction: column; gap: 20px;
  flex: 1 1 auto; min-height: 0; overflow-x: hidden; overflow-y: scroll;
  overscroll-behavior: contain; -webkit-overflow-scrolling: touch; touch-action: pan-y;
  -ms-overflow-style: none;
  scrollbar-width: none;
}
.admin-modal__body::-webkit-scrollbar {
  display: none;
  width: 0;
  height: 0;
}
.admin-modal__footer { padding: 24px; border-top: 1px solid #e2e8f0; background: #f8fafc; display: flex; justify-content: flex-end; gap: 12px; flex-wrap: wrap; flex-shrink: 0; }
.admin-modal--announcement { max-width: 640px; }
.admin-modal__close--icon {
  display: inline-flex; align-items: center; justify-content: center;
  border: 1px solid #e2e8f0; border-radius: 16px; background: #f8fafc; color: #0f172a;
}
.admin-modal__footer--single { justify-content: flex-end; }
.admin-btn--publish { border-radius: 10px; padding: 12px 24px; gap: 8px; }
.admin-form-row-2 { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 20px; }
.admin-textarea--announcement { min-height: 140px; resize: vertical; line-height: 21px; }
.admin-input-icon-wrap {
  position: relative; display: flex; align-items: center;
}
.admin-input-icon-wrap > svg {
  position: absolute; left: 16px; top: 50%; transform: translateY(-50%); pointer-events: none; flex-shrink: 0;
}
.admin-input--with-icon { padding-left: 42px; }
.admin-schedule-toggle {
  display: flex; align-items: center; justify-content: space-between; gap: 16px;
  border: 1px solid #e2e8f0; border-radius: 10px; background: #f8fafc; padding: 10px 16px;
}
.admin-schedule-toggle__copy {
  display: flex; flex-direction: column; gap: 2px; min-width: 0;
}
.admin-schedule-toggle__copy strong {
  font-size: 14px; font-weight: 600; color: #0f172a; font-family: Inter, system-ui, sans-serif;
}
.admin-schedule-toggle__copy span {
  font-size: 12px; line-height: 18px; color: #64748b; font-family: Inter, system-ui, sans-serif;
}
.admin-toggle { position: relative; display: inline-flex; cursor: pointer; flex-shrink: 0; }
.admin-toggle__input {
  position: absolute; opacity: 0; width: 0; height: 0;
}
.admin-toggle__track {
  display: inline-flex; align-items: center; width: 44px; height: 24px; border-radius: 12px;
  background: #cbd5e1; padding: 2px; transition: background 0.15s;
}
.admin-toggle__thumb {
  width: 20px; height: 20px; border-radius: 10px; background: #fff; transition: transform 0.15s;
}
.admin-toggle__input:checked + .admin-toggle__track { background: #1b3a6b; }
.admin-toggle__input:checked + .admin-toggle__track .admin-toggle__thumb { transform: translateX(20px); }
.admin-announcement-info {
  display: flex; align-items: flex-start; gap: 12px; border-radius: 8px; background: #e0f2fe; padding: 16px;
}
.admin-announcement-info p {
  margin: 0; font-size: 11px; line-height: 18px; color: #1b3a6b; font-family: Inter, system-ui, sans-serif;
}
.admin-preview-value {
  min-height: 44px; display: flex; align-items: center; border-radius: 6px; background: #f4f6f9;
  padding: 10px 16px; font-size: 14px; font-weight: 500; color: #1b2538; font-family: Inter, system-ui, sans-serif;
}
.admin-preview-value--multiline {
  align-items: flex-start; min-height: 101px; line-height: 21px; white-space: pre-wrap;
}
.admin-preview-value--status { background: #f8fafc; font-weight: 400; color: #0f172a; }
.admin-schedule-fields[hidden] { display: none !important; }

@media (max-width: 640px) {
  .admin-form-row-2 { grid-template-columns: 1fr; }
}
.admin-flash {
  display: flex; align-items: flex-start; gap: 12px;
  border-radius: 12px; background: #eef4fc; border: 1px solid rgba(27,58,107,0.15);
  border-left-width: 4px; border-left-color: #1b3a6b;
  padding: 14px 18px; margin-bottom: 24px; font-size: 14px; color: #1b3a6b;
  font-family: Inter, system-ui, sans-serif; line-height: 1.5;
}
.admin-flash--danger {
  background: #fef2f2; border-color: rgba(185,28,28,0.2); border-left-color: #b91c1c; color: #b91c1c;
}
.admin-flash--success {
  background: #ecfdf5; border-color: rgba(21,128,61,0.2); border-left-color: #15803d; color: #166534;
}
.admin-flash__icon {
  flex-shrink: 0; width: 22px; height: 22px; border-radius: 50%;
  display: inline-flex; align-items: center; justify-content: center;
  font-size: 12px; font-weight: 700; line-height: 1;
}
.admin-flash--danger .admin-flash__icon { background: #fee2e2; color: #b91c1c; }
.admin-flash--success .admin-flash__icon { background: #d1fae5; color: #15803d; }
.admin-login-wrap {
  min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 40px 20px;
}
.admin-login-card {
  background: #fff; border: 1px solid #e2e8f0; border-radius: 20px; padding: clamp(32px, 6vw, 56px);
  width: 100%; max-width: 640px; box-shadow: 0 16px 32px rgba(15,23,42,0.05);
}
.admin-login-icon {
  width: 72px; height: 72px; border-radius: 36px; background: #fff; display: flex; align-items: center;
  justify-content: center; margin: 0 auto 16px; overflow: hidden;
}
.admin-login-heading { font-family: "Instrument Serif", system-ui, sans-serif; font-size: clamp(24px, 5vw, 32px); text-align: center; color: #0f172a; }
.admin-login-sub { text-align: center; color: #64748b; font-size: 16px; margin-top: 6px; font-family: Inter, system-ui, sans-serif; }
.admin-form-stack { display: flex; flex-direction: column; gap: 28px; margin-top: 32px; }
.admin-form-field { display: flex; flex-direction: column; gap: 8px; }
.admin-tabs { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 20px; }
.admin-tab {
  padding: 8px 16px; border-radius: 100px; border: 1px solid #e2e8f0; background: #fff;
  font-size: 13px; font-weight: 600; font-family: Inter, system-ui, sans-serif; color: #64748b; cursor: pointer; text-decoration: none;
}
.admin-tab.is-active, .admin-tab:hover { background: #1b3a6b; color: #fff; border-color: #1b3a6b; }

.admin-page-title--announcements {
  font-size: 28px; font-weight: 800; color: #1e293b;
}
.admin-btn--accent { border-radius: 12px; padding: 12px 20px; gap: 8px; }
.admin-announcements-toolbar {
  display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 16px; margin-bottom: 24px;
}
.admin-announcement-tabs { display: flex; flex-wrap: wrap; gap: 12px; align-items: center; }
.admin-announcement-tab {
  display: inline-flex; align-items: center; gap: 8px; padding: 10px 16px; border-radius: 99px;
  border: 1px solid #e2e8f0; background: #fff; font-size: 14px; font-weight: 500; color: #475569;
  font-family: Inter, system-ui, sans-serif; text-decoration: none; transition: background 0.15s, color 0.15s, border-color 0.15s;
}
.admin-announcement-tab.is-active {
  background: #1b3a6b; border-color: #1b3a6b; color: #fff; font-weight: 600;
}
.admin-announcement-tab__count {
  display: inline-flex; align-items: center; justify-content: center; min-width: 20px; padding: 2px 6px;
  border-radius: 99px; background: #f1f5f9; font-size: 11px; font-weight: 600; color: #64748b;
}
.admin-announcement-tab.is-active .admin-announcement-tab__count {
  background: rgba(255, 255, 255, 0.13); color: #fff;
}
.admin-announcement-sort {
  display: inline-flex; align-items: center; gap: 8px; padding: 10px 16px; border-radius: 12px;
  border: 1px solid #e2e8f0; background: #fff; font-size: 14px; font-weight: 500; color: #475569;
  font-family: Inter, system-ui, sans-serif; cursor: pointer;
}
.admin-announcement-sort select {
  border: none; background: transparent; font: inherit; color: inherit; cursor: pointer; outline: none; padding-right: 4px;
}
.admin-announcement-list { display: flex; flex-direction: column; gap: 16px; }
.admin-announcement-card {
  border: 1px solid #e2e8f0; border-radius: 20px; padding: 24px; background: #fff;
  box-shadow: 0 4px 12px rgba(15, 23, 42, 0.02);
}
.admin-announcement-card__head {
  display: flex; align-items: flex-start; justify-content: space-between; gap: 24px; margin-bottom: 16px;
}
.admin-announcement-card__title {
  flex: 1; min-width: 200px; font-size: 18px; font-weight: 700; color: #1e293b;
  font-family: Inter, system-ui, sans-serif; line-height: 1.35; margin: 0;
}
.admin-announcement-card__actions { display: flex; align-items: center; gap: 12px; flex-shrink: 0; }
.admin-announcement-action {
  display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px;
  border-radius: 8px; border: none; background: #f1f5f9; cursor: pointer; padding: 0;
}
.admin-announcement-action--danger { background: #fef2f2; }
.admin-announcement-action:hover { opacity: 0.85; }
.admin-announcement-card__excerpt {
  font-size: 14px; color: #475569; line-height: 21px; margin: 0 0 16px;
  font-family: Inter, system-ui, sans-serif;
}
.admin-announcement-card__divider {
  border: none; border-top: 1px solid #f1f5f9; margin: 0 0 16px;
}
.admin-announcement-card__foot {
  display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap;
}
.admin-announcement-card__meta {
  display: flex; align-items: center; gap: 16px; flex-wrap: wrap;
}
.admin-announcement-card__meta-item {
  display: inline-flex; align-items: center; gap: 6px; font-size: 13px; color: #475569;
  font-family: Inter, system-ui, sans-serif;
}
.admin-announcement-card__meta-dot {
  width: 4px; height: 4px; border-radius: 50%; background: #64748b; opacity: 0.5; flex-shrink: 0;
}
.admin-badge--announcement-published { background: #dcfce7; color: #15803d; }
.admin-badge--announcement-scheduled { background: #dbeafe; color: #1d4ed8; }
.admin-badge--announcement-draft { background: #f1f5f9; color: #475569; }

.admin-grid-2 { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px; }
.admin-section-title {
  font-size: 22px; font-weight: 400; color: #1e293b; margin: 0 0 16px;
  font-family: "Instrument Serif", system-ui, sans-serif;
}
.admin-card--flush { padding: 0; overflow: hidden; }
.admin-card__header {
  display: flex; align-items: center; justify-content: space-between; gap: 16px;
  padding: 20px; border-bottom: 1px solid #f1f5f9;
}
.admin-card__header .admin-section-title { margin-bottom: 0; }
.admin-link-pill {
  display: inline-flex; align-items: center; padding: 6px 12px; border-radius: 8px;
  background: #f1f5f9; color: #1b3a6b; font-size: 12px; font-weight: 600;
  font-family: Inter, system-ui, sans-serif; text-decoration: none; flex-shrink: 0;
}
.admin-link-pill:hover { background: #e2e8f0; }
.admin-dashboard-row {
  display: flex; gap: 24px; align-items: stretch;
}
.admin-dashboard-row__main {
  flex: 1 1 0; min-width: 0;
}
.admin-dashboard-row__aside {
  flex: 0 0 360px; max-width: 360px;
}
.admin-activity-list {
  display: flex; flex-direction: column; gap: 16px;
}
.admin-activity-item {
  display: flex; gap: 12px; align-items: flex-start;
}
.admin-activity-date {
  display: flex; flex-direction: column; align-items: center; justify-content: center;
  flex-shrink: 0; width: 56px; padding: 8px 12px; border-radius: 8px; background: #f1f5f9;
}
.admin-activity-date__day {
  font-size: 14px; font-weight: 700; color: #1b3a6b; font-family: Inter, system-ui, sans-serif; line-height: 1.2;
}
.admin-activity-date__month {
  font-size: 11px; font-weight: 600; text-transform: uppercase; color: #94a3b8;
  font-family: Inter, system-ui, sans-serif; line-height: 1.2;
}
.admin-activity-item__content { min-width: 0; flex: 1; }
.admin-activity-item__title {
  font-size: 14px; font-weight: 600; color: #1e293b; font-family: Inter, system-ui, sans-serif;
  margin-bottom: 4px;
}
.admin-activity-item__details {
  font-size: 12px; color: #64748b; font-family: Inter, system-ui, sans-serif; line-height: 1.4;
}
.admin-company-badge {
  width: 28px; height: 28px; border-radius: 14px; background: #eff6ff; display: inline-flex;
  align-items: center; justify-content: center; font-size: 10px; font-weight: 700; color: #1b3a6b; flex-shrink: 0;
}
.admin-row-actions { display: flex; gap: 8px; flex-wrap: wrap; }

.admin-page-header--reports {
  align-items: flex-start;
}
.admin-page-header__actions {
  display: flex; align-items: center; gap: 12px; flex-shrink: 0; flex-wrap: wrap;
}
.admin-reports-date-pill {
  display: inline-flex; align-items: center; padding: 8px 16px; border-radius: 10px;
  background: #fff; box-shadow: 0 4px 12px rgba(15, 23, 42, 0.03);
  font-size: 14px; font-weight: 600; color: #1b3a6b; font-family: Inter, system-ui, sans-serif;
  flex-shrink: 0;
}
.admin-reports-stats {
  display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 20px; margin-bottom: 24px;
}
.admin-reports-stat-card {
  border: 1px solid #e5e8ef; border-radius: 12px; background: #fff; padding: 20px;
  box-shadow: 0 4px 12px rgba(15, 23, 42, 0.03); display: flex; flex-direction: column; gap: 12px;
}
.admin-reports-stat-card__header {
  display: flex; align-items: center; justify-content: space-between; gap: 12px;
}
.admin-reports-stat-card__label {
  font-size: 13px; font-weight: 600; text-transform: uppercase; color: #64748b;
  font-family: Inter, system-ui, sans-serif;
}
.admin-reports-stat-card__icon {
  width: 36px; height: 36px; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.admin-reports-stat-card__value {
  font-size: 28px; font-weight: 700; color: #1e293b; font-family: Inter, system-ui, sans-serif; line-height: 1.1;
}
.admin-reports-stat-card__change {
  display: flex; align-items: center; gap: 4px; font-size: 12px; font-family: Inter, system-ui, sans-serif;
}
.admin-reports-stat-card__change-value--up { color: #10b981; font-weight: 600; }
.admin-reports-stat-card__change-value--down { color: #ef4444; font-weight: 600; }
.admin-reports-stat-card__change-label { color: #94a3b8; font-weight: 400; }
.admin-reports-charts {
  display: flex; gap: 24px; align-items: stretch; margin-bottom: 24px;
}
.admin-reports-chart-card {
  border-radius: 20px; background: #fff; padding: 24px;
  box-shadow: 0 4px 12px rgba(15, 23, 42, 0.03);
}
.admin-reports-chart-card--main { flex: 1 1 0; min-width: 0; }
.admin-reports-chart-card--aside { flex: 0 0 420px; max-width: 420px; }
.admin-reports-chart-card__header {
  display: flex; align-items: center; justify-content: space-between; gap: 16px; margin-bottom: 16px;
}
.admin-reports-chart-card__header .admin-section-title { margin-bottom: 0; }
.admin-reports-chart-legend {
  display: flex; align-items: center; gap: 12px; font-size: 12px; font-weight: 500; color: #64748b;
  font-family: Inter, system-ui, sans-serif;
}
.admin-reports-chart-legend__dot {
  width: 8px; height: 8px; border-radius: 50%; background: #1b3a6b; flex-shrink: 0;
}
.admin-reports-line-chart {
  position: relative; width: 100%; height: 180px;
}
.admin-reports-line-chart svg { width: 100%; height: 100%; display: block; }
.admin-reports-line-chart__months {
  display: flex; justify-content: space-between; padding: 0 12px; margin-top: 8px;
  font-size: 12px; font-weight: 500; color: #64748b; font-family: Inter, system-ui, sans-serif;
}
.admin-reports-line-chart__tooltip {
  position: absolute; top: 0; right: 18%; padding: 6px 10px; border-radius: 6px;
  background: #1b3a6b; color: #fff; font-size: 11px; font-weight: 600;
  font-family: Inter, system-ui, sans-serif; box-shadow: 0 4px 12px rgba(15, 23, 42, 0.03);
  white-space: nowrap;
}
.admin-reports-donut {
  display: flex; align-items: center; gap: 24px;
}
.admin-reports-donut__chart {
  position: relative; width: 140px; height: 140px; flex-shrink: 0;
}
.admin-reports-donut__chart svg { width: 140px; height: 140px; display: block; }
.admin-reports-donut__center {
  position: absolute; inset: 0; display: flex; flex-direction: column; align-items: center; justify-content: center;
}
.admin-reports-donut__total {
  font-size: 20px; font-weight: 700; color: #1e293b; font-family: Inter, system-ui, sans-serif; line-height: 1.2;
}
.admin-reports-donut__label {
  font-size: 11px; color: #64748b; font-family: Inter, system-ui, sans-serif;
}
.admin-reports-donut__legend {
  display: flex; flex-direction: column; gap: 10px; flex: 1; min-width: 0;
}
.admin-reports-donut__legend-row {
  display: flex; align-items: center; justify-content: space-between; gap: 12px;
}
.admin-reports-donut__legend-name {
  display: flex; align-items: center; gap: 8px; font-size: 13px; color: #64748b;
  font-family: Inter, system-ui, sans-serif;
}
.admin-reports-donut__legend-swatch {
  width: 10px; height: 10px; border-radius: 2px; flex-shrink: 0;
}
.admin-reports-donut__legend-values {
  display: flex; align-items: center; gap: 8px; flex-shrink: 0;
}
.admin-reports-donut__legend-count {
  font-size: 13px; font-weight: 600; color: #1e293b; font-family: Inter, system-ui, sans-serif;
}
.admin-reports-donut__legend-percent {
  font-size: 12px; color: #94a3b8; font-family: Inter, system-ui, sans-serif;
}

@media (max-width: 1100px) {
  .admin-reports-stats { grid-template-columns: repeat(2, minmax(0, 1fr)); }
  .admin-reports-charts { flex-direction: column; }
  .admin-reports-chart-card--aside { flex: none; max-width: none; width: 100%; }
}

@media (max-width: 900px) {
  .admin-shell { flex-direction: column; }
  .admin-sidebar { width: 100%; flex: none; min-height: auto; }
  .admin-nav { flex-direction: row; flex-wrap: wrap; }
  .admin-sidebar__logout { margin-top: 16px; width: auto; }
  .admin-dashboard-row { flex-direction: column; }
  .admin-dashboard-row__aside { flex: none; max-width: none; width: 100%; }
  .admin-filter-field--position,
  .admin-filter-field--status,
  .admin-filter-field--date { flex: 1 1 100%; width: 100%; }
  .admin-reports-stats { grid-template-columns: 1fr; }
  .admin-page-header--reports { flex-direction: column; gap: 16px; }
  .admin-page-header--activity-logs { flex-direction: column; align-items: flex-start; gap: 16px; }
  .admin-activity-toolbar-wrap { flex-direction: column; align-items: stretch; }
  .admin-activity-toolbar { flex-direction: column; align-items: stretch; }
}

/* Activity Logs */
.admin-page-header--activity-logs {
  align-items: center;
}
.admin-activity-live-badge {
  display: inline-flex; align-items: center; gap: 8px; padding: 6px 12px;
  border-radius: 100px; background: #dcfce7; flex-shrink: 0;
}
.admin-activity-live-badge__dot {
  width: 6px; height: 6px; border-radius: 50%; background: #15803d; flex-shrink: 0;
}
.admin-activity-live-badge__text {
  font-size: 12px; font-weight: 600; color: #15803d; font-family: Inter, system-ui, sans-serif;
}
.admin-activity-toolbar-wrap {
  display: flex; flex-wrap: wrap; gap: 12px; align-items: center; margin-bottom: 24px;
  padding: 16px; border: 1px solid #e2e8f0; border-radius: 12px; background: #fff;
}
.admin-activity-toolbar {
  display: flex; flex-wrap: wrap; gap: 12px; align-items: center; flex: 1; min-width: 0;
}
.admin-activity-toolbar__search {
  flex: 1 1 240px; display: flex; align-items: center; gap: 8px; height: 40px;
  padding: 0 12px; border: 1px solid #e2e8f0; border-radius: 8px; min-width: 0;
}
.admin-activity-toolbar__search .admin-input {
  border: none; background: transparent; padding: 0; height: auto; flex: 1; min-width: 0;
  border-radius: 0; font-size: 14px; color: #1e293b;
}
.admin-activity-toolbar__search .admin-input::placeholder { color: #94a3b8; }
.admin-activity-toolbar__select {
  flex: 0 0 auto; height: 40px; padding: 0 36px 0 12px; border: 1px solid #e2e8f0;
  border-radius: 8px; background: #fff; font-size: 14px; font-weight: 500; color: #1e293b;
  font-family: Inter, system-ui, sans-serif; appearance: none; cursor: pointer;
  background-image: url("data:image/svg+xml,%3Csvg width='8' height='5' viewBox='0 0 8 5' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 0L3 3 6 0' stroke='%2364748b' stroke-width='2' stroke-linecap='round'/%3E%3C/svg%3E");
  background-repeat: no-repeat; background-position: right 12px center;
}
.admin-activity-toolbar__select--users { width: 160px; }
.admin-activity-toolbar__select--actions { width: 160px; }
.admin-activity-toolbar__select--date { width: 200px; }
.admin-activity-toolbar__export {
  display: inline-flex; align-items: center; gap: 8px; height: 40px; padding: 0 16px;
  border: 1px solid #1b3a6b; border-radius: 8px; background: #fff; font-size: 14px;
  font-weight: 600; color: #1b3a6b; font-family: Inter, system-ui, sans-serif; cursor: pointer;
  flex-shrink: 0;
}
.admin-activity-toolbar__export:hover { background: #f8fafc; }
.admin-activity-table-wrap {
  border-radius: 20px; overflow: hidden; background: #fff;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03); overflow-x: auto;
}
.admin-activity-table__head,
.admin-activity-table__row {
  display: grid;
  grid-template-columns: 180px 200px 200px minmax(0, 1fr);
  gap: 20px; align-items: center; padding: 14px 24px; min-width: 860px;
}
.admin-activity-table__head {
  background: #eef2f6; font-size: 12px; font-weight: 700; text-transform: uppercase;
  color: #1b3a6b; font-family: Inter, system-ui, sans-serif;
}
.admin-activity-table__row {
  border-bottom: 1px solid #e2e8f0; background: #fff;
}
.admin-activity-table__row:last-of-type { border-bottom: none; }
.admin-activity-table__timestamp {
  font-size: 13px; font-weight: 500; color: #1e293b; font-family: Inter, system-ui, sans-serif;
}
.admin-activity-table__user {
  font-size: 14px; font-weight: 600; color: #1e293b; font-family: Inter, system-ui, sans-serif;
}
.admin-activity-table__details {
  font-size: 14px; font-weight: 500; color: #64748b; font-family: Inter, system-ui, sans-serif;
}
.admin-badge--log-created { background: #dcfce7; color: #15803d; }
.admin-badge--log-approved { background: #ffedd5; color: #c2410c; }
.admin-badge--log-updated { background: #dbeafe; color: #1d4ed8; }
.admin-badge--log-neutral { background: #f1f5f9; color: #475569; }
.admin-badge--log-danger { background: #fee2e2; color: #b91c1c; }
.admin-activity-table__footer {
  display: flex; align-items: center; justify-content: space-between; gap: 16px;
  padding: 16px 24px; flex-wrap: wrap;
}
.admin-activity-table__summary {
  font-size: 13px; color: #64748b; font-family: Inter, system-ui, sans-serif;
}
.admin-activity-table__summary strong { color: #1e293b; font-weight: 600; }
.admin-activity-pagination {
  display: flex; align-items: center; gap: 6px; flex-wrap: wrap;
}
.admin-activity-pagination__btn,
.admin-activity-pagination__page {
  display: inline-flex; align-items: center; justify-content: center;
  min-width: 32px; height: 32px; padding: 0 8px; border-radius: 6px;
  font-size: 13px; font-family: Inter, system-ui, sans-serif; text-decoration: none;
}
.admin-activity-pagination__btn {
  border: 1px solid #e2e8f0; background: #fff; color: #64748b;
}
.admin-activity-pagination__btn:hover:not(.is-disabled) { background: #f8fafc; }
.admin-activity-pagination__btn.is-disabled {
  opacity: 0.5; cursor: not-allowed; pointer-events: none;
}
.admin-activity-pagination__page {
  border: 1px solid #e2e8f0; background: #fff; color: #64748b; font-weight: 500;
}
.admin-activity-pagination__page:hover { background: #f8fafc; }
.admin-activity-pagination__page.is-active {
  background: #1b3a6b; border-color: #1b3a6b; color: #fff; font-weight: 600;
}
.admin-activity-pagination__ellipsis {
  display: inline-flex; align-items: center; justify-content: center;
  min-width: 32px; height: 32px; border: 1px solid #e2e8f0; border-radius: 6px;
  background: #fff; font-size: 13px; color: #64748b; font-family: Inter, system-ui, sans-serif;
}
.admin-activity-table__empty {
  padding: 48px 24px; text-align: center; color: #64748b; font-size: 14px;
  font-family: Inter, system-ui, sans-serif;
}

/* Custom confirm prompts (replaces native browser confirm) */
.peso-confirm-backdrop {
  position: fixed; inset: 0; z-index: 1100;
  display: flex; align-items: center; justify-content: center;
  padding: 20px; background: rgba(15, 23, 42, 0.5);
  backdrop-filter: blur(2px);
}
.peso-confirm-backdrop[hidden] { display: none !important; }
.peso-confirm {
  width: 100%; max-width: 420px;
  border-radius: 16px; background: #fff;
  box-shadow: 0 24px 48px rgba(15, 23, 42, 0.18);
  border: 1px solid #e2e8f0; overflow: hidden;
  font-family: Inter, system-ui, sans-serif;
  animation: peso-confirm-in 0.18s ease-out;
}
@keyframes peso-confirm-in {
  from { opacity: 0; transform: translateY(8px) scale(0.98); }
  to { opacity: 1; transform: translateY(0) scale(1); }
}
.peso-confirm__icon-wrap {
  display: flex; align-items: center; justify-content: center;
  padding: 28px 24px 0;
}
.peso-confirm__icon {
  display: none; align-items: center; justify-content: center;
  width: 52px; height: 52px; border-radius: 50%;
}
.peso-confirm--danger .peso-confirm__icon--danger { display: inline-flex; background: #fef2f2; color: #b91c1c; }
.peso-confirm--warning .peso-confirm__icon--warning { display: inline-flex; background: #fffbeb; color: #d97706; }
.peso-confirm--success .peso-confirm__icon--success { display: inline-flex; background: #ecfdf5; color: #15803d; }
.peso-confirm--info .peso-confirm__icon--info { display: inline-flex; background: #eef4fc; color: #1b3a6b; }
.peso-confirm__body { padding: 16px 28px 24px; text-align: center; }
.peso-confirm__title {
  margin: 0 0 8px; font-size: 18px; font-weight: 700; color: #0f172a; line-height: 1.3;
}
.peso-confirm__message {
  margin: 0; font-size: 14px; line-height: 1.55; color: #64748b;
}
.peso-confirm__actions {
  display: flex; gap: 10px; justify-content: center;
  padding: 0 24px 24px; flex-wrap: wrap;
}
.peso-confirm__btn {
  min-width: 112px; padding: 11px 18px; border-radius: 10px;
  font-size: 14px; font-weight: 600; font-family: inherit;
  cursor: pointer; border: 1px solid transparent; transition: background 0.15s, border-color 0.15s;
}
.peso-confirm__btn--cancel {
  background: #fff; border-color: #e2e8f0; color: #64748b;
}
.peso-confirm__btn--cancel:hover { background: #f8fafc; }
.peso-confirm--danger .peso-confirm__btn--ok { background: #b91c1c; color: #fff; }
.peso-confirm--danger .peso-confirm__btn--ok:hover { background: #991b1b; }
.peso-confirm--warning .peso-confirm__btn--ok { background: #d97706; color: #fff; }
.peso-confirm--warning .peso-confirm__btn--ok:hover { background: #b45309; }
.peso-confirm--success .peso-confirm__btn--ok { background: #15803d; color: #fff; }
.peso-confirm--success .peso-confirm__btn--ok:hover { background: #166534; }
.peso-confirm--info .peso-confirm__btn--ok { background: #1b3a6b; color: #fff; }
.peso-confirm--info .peso-confirm__btn--ok:hover { background: #152d54; }

</style>
