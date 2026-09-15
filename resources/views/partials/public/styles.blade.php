<style>
/* latin-ext */
@font-face {
  font-family: 'Instrument Serif';
  font-style: normal;
  font-weight: 400;
  font-display: swap;
  src: url(https://fonts.gstatic.com/s/instrumentserif/v5/jizBRFtNs2ka5fXjeivQ4LroWlx-6zsTjmbI.woff2) format('woff2');
  unicode-range: U+0100-02BA, U+02BD-02C5, U+02CE-02CC, U+02DD-02FF, U+0304, U+0308, U+0329, U+1D00-1DBF, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
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
</style>
<style media="all">
*, *::before, *::after { box-sizing: border-box; }
body { -webkit-font-smoothing: auto; margin: 0; }
button {
  -webkit-font-smoothing: inherit;
  -moz-osx-font-smoothing: inherit;
  -webkit-appearance: none;
  border-style: none;
  width: auto;
  overflow: visible;
  background: transparent;
  font: inherit;
  line-height: normal;
  color: inherit;
  cursor: pointer;
}
* { padding: 0; margin: 0; }
a { color: inherit; text-decoration: inherit; }
input, textarea, select {
  border: none;
  font: inherit;
  outline: none;
  background-color: inherit;
}
img, picture, video, canvas, svg { display: block; }
[data-visible='false'] { display: none !important; }
.before-hidden::before, .after-hidden::after { display: none; }
.before-visible::before, .after-visible::after { content: ""; }
.text { white-space: pre-wrap; overflow-wrap: break-word; }

html, body {
  width: 100%;
  overflow-x: hidden;
}

.public-page {
  width: 100%;
  max-width: 100%;
  min-height: 100vh;
  overflow-x: hidden;
  align-items: stretch !important;
}

.public-header,
.public-hero,
.public-section,
.public-footer,
.public-content,
.public-banner {
  width: 100% !important;
  max-width: none !important;
  margin-left: 0 !important;
  margin-right: 0 !important;
  box-sizing: border-box;
}

.public-header {
  gap: 16px;
  padding-left: clamp(20px, 5vw, 80px) !important;
  padding-right: clamp(20px, 5vw, 80px) !important;
}

.public-hero,
.public-section,
.public-content,
.public-banner {
  padding-left: clamp(20px, 5vw, 80px) !important;
  padding-right: clamp(20px, 5vw, 80px) !important;
}

.public-footer__grid,
.public-footer__bottom {
  padding-left: clamp(20px, 5vw, 80px) !important;
  padding-right: clamp(20px, 5vw, 80px) !important;
}

.public-hero__title {
  width: 100% !important;
  max-width: 800px;
}

.public-hero__subtitle {
  width: 100% !important;
  max-width: 640px;
}

.public-search {
  width: 100% !important;
  max-width: 900px;
}

.public-hero-search {
  border-radius: 36px;
  background-color: #fff;
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: flex-start;
  gap: 16px;
  width: 100%;
  max-width: 900px;
  height: 72px;
  flex-shrink: 0;
  padding: 8px 8px 8px 24px;
  filter: drop-shadow(0px 12px 24px rgba(0, 0, 0, 0.08));
  border: none;
}

.public-hero-search__icon {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 24px;
  height: 24px;
  flex-shrink: 0;
}

.public-hero-search__input {
  flex: 1 1 0;
  min-width: 0;
  font-size: 16px;
  font-family: Inter, system-ui, sans-serif;
  font-weight: 400;
  color: #1a253c;
  background: transparent;
  border: none;
  outline: none;
  padding: 0;
}

.public-hero-search__input::placeholder {
  color: #1a253c;
  opacity: 1;
}

.public-hero-search__divider {
  border-width: 1px 0 0;
  border-style: solid;
  border-color: #e2e8f0;
  transform: rotate(90deg);
  width: 32px;
  height: 1px;
  flex-shrink: 0;
  margin: 15px -16px 16px;
}

.public-hero-search__submit {
  border-radius: 28px;
  background-color: #f57c00;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  padding: 16px 32px;
  border: none;
  cursor: pointer;
  font-size: 16px;
  font-family: Inter, system-ui, sans-serif;
  font-weight: 600;
  color: #fff;
  white-space: nowrap;
}

.public-hero-search__submit:hover {
  background-color: #e65100;
}

.public-hero {
  background-image: linear-gradient(180deg, #1b3a6b 0%, #0d2147 100%);
  display: flex;
  flex-direction: column;
  row-gap: 40px;
  align-items: center;
  justify-content: flex-start;
  width: 100%;
  padding-top: 80px;
  padding-bottom: 80px;
}

.public-hero__intro {
  display: flex;
  flex-direction: column;
  row-gap: 16px;
  align-items: center;
  width: 100%;
}

.public-hero__title {
  text-align: center;
  font-size: 64px;
  font-family: "Instrument Serif", system-ui, sans-serif;
  font-weight: 400;
  color: #fff;
  margin: 0;
}

.public-hero__subtitle {
  text-align: center;
  line-height: 27px;
  font-size: 18px;
  font-family: Inter, system-ui, sans-serif;
  font-weight: 400;
  color: rgba(255, 255, 255, 0.8);
  margin: 0;
}

.public-section {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  width: 100%;
  padding-top: 80px;
  padding-bottom: 80px;
}

.public-section--muted {
  background-color: #f8f9fc;
}

.public-section--compact {
  row-gap: 32px;
}

.public-section--spacious {
  row-gap: 40px;
}

.public-section-header {
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: space-between;
  width: 100%;
  gap: 16px;
}

.public-section-link {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 16px;
  font-family: Inter, system-ui, sans-serif;
  font-weight: 600;
  color: #1b3a6b;
  text-decoration: none;
  flex-shrink: 0;
}

.public-section-link:hover {
  text-decoration: underline;
}

.public-landing-grid {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: 24px;
  width: 100%;
  align-items: stretch;
}

.public-landing-jobs {
  display: flex;
  flex-direction: column;
  row-gap: 24px;
  width: 100%;
}

.public-landing-job-card {
  border: 1px solid #e2e8f0;
  border-radius: 20px;
  background-color: #fff;
  display: flex;
  flex-direction: column;
  row-gap: 20px;
  padding: 24px;
  width: 100%;
  max-width: 411px;
  box-sizing: border-box;
  filter: drop-shadow(0px 8px 16px rgba(0, 0, 0, 0.02));
}

.public-landing-job-card__head {
  display: flex;
  align-items: center;
  gap: 16px;
  width: 100%;
}

.public-landing-job-card__logo {
  overflow: hidden;
  border-radius: 12px;
  width: 48px;
  height: 48px;
  flex-shrink: 0;
  position: relative;
}

.public-landing-job-card__logo img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

.public-landing-job-card__meta {
  min-width: 0;
  flex: 1;
}

.public-landing-job-card__title {
  font-size: 16px;
  font-family: Inter, system-ui, sans-serif;
  font-weight: 700;
  color: #1a253c;
  margin: 0 0 4px;
  line-height: 1.3;
}

.public-landing-job-card__company {
  font-size: 14px;
  font-family: Inter, system-ui, sans-serif;
  font-weight: 400;
  color: #626f84;
  margin: 0;
}

.public-landing-job-card__details {
  display: flex;
  flex-direction: column;
  row-gap: 8px;
  width: 100%;
}

.public-landing-job-card__detail {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 14px;
  font-family: Inter, system-ui, sans-serif;
  font-weight: 400;
  color: #626f84;
}

.public-landing-job-card__detail svg {
  flex-shrink: 0;
}

.public-landing-job-card__detail--salary {
  font-weight: 600;
  color: #2e7d32;
}

.public-landing-job-card__tags {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  width: 100%;
}

.public-landing-job-card__tag {
  border-radius: 100px;
  background-color: #f8f9fc;
  padding: 6px 12px;
  font-size: 12px;
  font-family: Inter, system-ui, sans-serif;
  font-weight: 600;
  color: #1a253c;
}

.public-landing-job-card__tag--peso {
  background-color: rgba(27, 58, 107, 0.07);
  font-size: 11px;
  font-weight: 700;
  text-transform: uppercase;
  color: #1b3a6b;
}

.public-landing-job-card__divider {
  border-top: 1px solid #e2e8f0;
  width: 100%;
  margin-top: -1px;
}

.public-landing-job-card__footer {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  width: 100%;
}

.public-landing-job-card__posted {
  font-size: 12px;
  font-family: Inter, system-ui, sans-serif;
  font-weight: 400;
  color: #626f84;
}

.public-landing-job-card__cta {
  border-radius: 8px;
  background-color: #1b3a6b;
  display: inline-flex;
  align-items: center;
  padding: 10px 20px;
  font-size: 13px;
  font-family: Inter, system-ui, sans-serif;
  font-weight: 600;
  color: #fff;
  text-decoration: none;
  flex-shrink: 0;
}

.public-landing-job-card__cta:hover {
  background-color: #0f2241;
}

.public-announcement-card {
  border: 1px solid #e2e8f0;
  border-radius: 20px;
  background-color: #fff;
  display: flex;
  flex-direction: column;
  row-gap: 20px;
  padding: 32px;
  box-sizing: border-box;
  width: 100%;
}

.public-landing-announcement-card {
  max-width: 411px;
  filter: drop-shadow(0px 8px 16px rgba(0, 0, 0, 0.03));
  color: inherit;
}

.public-announcement-card__head {
  display: flex;
  align-items: center;
  gap: 16px;
  flex-wrap: wrap;
}

.public-announcement-card__date {
  border-radius: 12px;
  background-color: #fff3e0;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  width: 56px;
  height: 56px;
  flex-shrink: 0;
}

.public-announcement-card__day {
  font-size: 18px;
  font-family: Inter, system-ui, sans-serif;
  font-weight: 800;
  color: #f57c00;
  line-height: 1.1;
}

.public-announcement-card__month {
  font-size: 10px;
  font-family: Inter, system-ui, sans-serif;
  font-weight: 700;
  text-transform: uppercase;
  color: #f57c00;
  line-height: 1.1;
}

.public-announcement-card__category {
  border-radius: 100px;
  background-color: rgba(27, 58, 107, 0.04);
  padding: 6px 12px;
  font-size: 11px;
  font-family: Inter, system-ui, sans-serif;
  font-weight: 600;
  text-transform: uppercase;
  color: #1b3a6b;
}

.public-announcement-card__body {
  display: flex;
  flex-direction: column;
  row-gap: 10px;
  width: 100%;
}

.public-announcement-card__title {
  line-height: 28px;
  font-size: 20px;
  font-family: Inter, system-ui, sans-serif;
  font-weight: 700;
  color: #1a253c;
}

.public-announcement-card__title--compact {
  line-height: 25.2px;
  font-size: 18px;
}

.public-announcement-card__excerpt {
  line-height: 22.4px;
  font-size: 14px;
  font-family: Inter, system-ui, sans-serif;
  font-weight: 400;
  color: #626f84;
}

.public-grid {
  flex-wrap: wrap !important;
  row-gap: 24px;
}

.public-card {
  width: 100% !important;
  max-width: 411px;
  flex: 1 1 280px;
  height: auto !important;
}

.public-announcements-page {
  width: 100%;
  max-width: 1280px;
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  row-gap: 24px;
  align-items: stretch;
}

.public-announcement-card--full {
  width: 100% !important;
  max-width: none !important;
  flex: none !important;
  box-sizing: border-box;
  filter: drop-shadow(0px 4px 16px rgba(15,23,42,0.03));
}

.public-section-title {
  font-size: 36px;
  font-family: "Instrument Serif", system-ui, sans-serif;
  font-weight: 400;
  color: #1b3a6b;
  width: 100%;
  margin: 0;
}

.public-layout-row {
  width: 100% !important;
  max-width: none !important;
  flex-wrap: nowrap !important;
  gap: 32px;
  align-items: flex-start;
}

.public-sidebar {
  flex: 0 0 260px;
  width: 260px;
  max-width: 260px;
  flex-shrink: 0;
}

.public-main {
  flex: 1 1 0;
  min-width: 0;
  width: auto !important;
}

.public-form-card {
  width: 100% !important;
  max-width: none !important;
}

.public-nav-toggle {
  display: none;
  align-items: center;
  justify-content: center;
  width: 44px;
  height: 44px;
  border: 1px solid #e2e8f0;
  border-radius: 8px;
  background: #fff;
  cursor: pointer;
  flex-shrink: 0;
  margin-left: auto;
}

.public-nav-toggle span {
  display: block;
  width: 18px;
  height: 2px;
  background: #1b3a6b;
  position: relative;
}

.public-nav-toggle span::before,
.public-nav-toggle span::after {
  content: "";
  position: absolute;
  left: 0;
  width: 18px;
  height: 2px;
  background: #1b3a6b;
}

.public-nav-toggle span::before { top: -6px; }
.public-nav-toggle span::after { top: 6px; }

.public-header__actions {
  display: none;
  align-items: center;
  gap: 12px;
  margin-left: auto;
}

.public-header__enlist--mobile { display: none; }

.public-footer-link {
  display: inline;
  font-size: 14px;
  font-family: Inter, system-ui, sans-serif;
  font-weight: 400;
  color: rgba(255,255,255,0.63);
  text-decoration: none;
}

.public-footer-link:hover {
  color: #fff;
}

@media (max-width: 1100px) {
  .public-landing-grid {
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }

  .public-nav a span { font-size: 13px !important; }
  .public-nav { gap: 4px !important; }
}

@media (max-width: 900px) {
  .public-header__actions { display: flex; }

  .public-header {
    flex-wrap: wrap !important;
    height: auto !important;
    padding: 16px 20px !important;
    justify-content: space-between !important;
  }

  .public-nav-toggle { display: flex; }
  .public-header__actions { margin-left: 0; }
  .public-header__enlist--desktop { display: none !important; }
  .public-header__enlist--mobile { display: flex !important; }

  .public-nav {
    display: none !important;
    flex-direction: column !important;
    align-items: stretch !important;
    width: 100% !important;
    order: 4;
    gap: 8px !important;
    margin: 0 !important;
    padding-top: 8px;
    border-top: 1px solid #e2e8f0;
  }

  .public-nav.is-open { display: flex !important; }
  .public-nav a { width: 100% !important; }

  .public-hero {
    padding: 48px 20px !important;
    row-gap: 28px !important;
  }

  .public-hero__title {
    font-size: clamp(2rem, 8vw, 3rem) !important;
    line-height: 1.1 !important;
  }

  .public-hero__subtitle {
    font-size: 16px !important;
    line-height: 1.5 !important;
  }

  .public-hero-search {
    flex-direction: column !important;
    align-items: stretch !important;
    height: auto !important;
    padding: 16px !important;
    border-radius: 20px !important;
    gap: 12px !important;
  }

  .public-hero-search__divider { display: none !important; }

  .public-hero-search__submit {
    width: 100% !important;
    justify-content: center !important;
  }

  .public-search {
    flex-direction: column !important;
    align-items: stretch !important;
    height: auto !important;
    padding: 16px !important;
    border-radius: 20px !important;
    gap: 12px !important;
  }

  .public-search__divider { display: none !important; }
  .public-search button {
    width: 100% !important;
    justify-content: center !important;
  }

  .public-section,
  .public-content,
  .public-banner {
    padding: 48px 20px !important;
  }

  .public-section-header {
    flex-direction: column !important;
    align-items: flex-start !important;
    gap: 16px !important;
  }

  .public-landing-grid {
    grid-template-columns: 1fr !important;
  }

  .public-landing-job-card,
  .public-landing-announcement-card {
    max-width: none !important;
  }

  .public-landing-job-card__footer {
    flex-direction: column !important;
    align-items: stretch !important;
  }

  .public-landing-job-card__cta {
    justify-content: center;
    width: 100%;
  }

  .public-section-title {
    font-size: clamp(1.75rem, 4vw, 2.25rem) !important;
  }

  .public-section-header > span,
  .public-section-header > a,
  .public-section-link {
    width: 100% !important;
    margin: 0 !important;
  }

  .public-grid { flex-direction: column !important; }
  .public-card { max-width: 100% !important; flex-basis: auto !important; }

  .public-layout-row {
    flex-direction: column !important;
    flex-wrap: wrap !important;
    padding: 32px 20px !important;
  }

  .public-sidebar {
    flex: 1 1 100%;
    width: 100% !important;
    max-width: 100% !important;
  }

  .public-main {
    flex: 1 1 100%;
    width: 100% !important;
  }

  .public-footer__grid {
    flex-direction: column !important;
    padding: 48px 20px 32px !important;
    gap: 32px !important;
  }

  .public-footer__grid > div { width: 100% !important; }

  .public-footer__bottom {
    flex-direction: column !important;
    align-items: flex-start !important;
    gap: 16px !important;
    padding: 24px 20px !important;
  }

  .public-footer__bottom > span { width: 100% !important; margin: 0 !important; text-align: left !important; }

  .public-job-card__footer {
    flex-direction: column !important;
    align-items: stretch !important;
    gap: 12px !important;
  }

  .public-job-card__footer > span { margin: 0 !important; }
  .public-job-card__footer a,
  .public-job-card__footer > div:last-child {
    width: 100% !important;
    justify-content: center !important;
  }
}

@media (max-width: 480px) {
  .public-brand__subtitle { display: none !important; }
}

.public-input,
.public-select,
.public-textarea {
  border-width: 1px;
  border-style: solid;
  border-color: #e2e8f0;
  border-radius: 8px;
  background-color: #fff;
  width: 100%;
  padding: 12px 16px;
  font-size: 14px;
  font-family: Inter, system-ui, sans-serif;
  font-weight: 400;
  color: #0f172a;
  box-sizing: border-box;
}

.public-input--gray { border-color: #d1d5db; color: #1f2937; }
.public-input::placeholder,
.public-textarea::placeholder { color: #94a3b8; }
.public-input--gray::placeholder { color: #9ca3af; }

.public-select {
  appearance: none;
  background-image: url("data:image/svg+xml,%3Csvg width='11' height='7' viewBox='0 0 11 7' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 0L4.5 4.5 9 0' stroke='%2394a3b8' stroke-width='2' stroke-linecap='round'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 16px center;
  padding-right: 40px;
  cursor: pointer;
}

.public-textarea {
  min-height: 100px;
  resize: vertical;
  line-height: 1.4;
}

.public-field-label {
  display: inline;
  font-size: 14px;
  font-family: Inter, system-ui, sans-serif;
  font-weight: 600;
  color: #1e293b;
}

.public-field-label--dark { color: #1f2937; }
.public-field-required { color: #dc2626; font-weight: 600; }

.public-enlistment-input {
  border-color: #e2e8f0;
  border-radius: 10px;
  background-color: #f8fafc;
  min-height: 44px;
  padding: 10px 16px;
  color: #0f172a;
}

.public-select.public-enlistment-input {
  padding-right: 40px;
}

.public-enlistment-input::placeholder { color: #64748b; }

.public-checkbox-row {
  display: flex;
  flex-direction: row;
  grid-column-gap: 10px;
  align-items: center;
  width: 100%;
  cursor: pointer;
  font-size: 14px;
  font-family: Inter, system-ui, sans-serif;
  color: #0f172a;
}

.public-checkbox-row input[type="checkbox"] {
  width: 18px;
  height: 18px;
  accent-color: #1b3a6b;
  flex-shrink: 0;
  cursor: pointer;
}

.public-checkbox-row--large input[type="checkbox"] {
  width: 20px;
  height: 20px;
}

.public-filter-row {
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: space-between;
  width: 100%;
  cursor: pointer;
}

.public-filter-row input[type="checkbox"] {
  position: absolute;
  opacity: 0;
  width: 0;
  height: 0;
}

.public-filter-row__box {
  border-width: 1px;
  border-style: solid;
  border-color: #e2e8f0;
  border-radius: 4px;
  background-color: #fff;
  width: 18px;
  height: 18px;
  flex-shrink: 0;
  display: flex;
  align-items: center;
  justify-content: center;
}

.public-filter-row input:checked + .public-filter-row__box {
  border-color: #1b3a6b;
  background-color: #1b3a6b;
}

.public-filter-row input:checked + .public-filter-row__box::after {
  content: "";
  width: 10px;
  height: 7px;
  border-left: 2px solid #fff;
  border-bottom: 2px solid #fff;
  transform: rotate(-45deg) translateY(-1px);
}

.public-link-button {
  background: none;
  border: none;
  padding: 0;
  font-size: 13px;
  font-family: Inter, system-ui, sans-serif;
  font-weight: 600;
  text-decoration: underline;
  color: #f57c00;
  cursor: pointer;
}

.public-sort-select {
  border-width: 1px;
  border-style: solid;
  border-color: #e2e8f0;
  border-radius: 8px;
  background-color: #fff;
  padding: 8px 32px 8px 16px;
  font-size: 13px;
  font-family: Inter, system-ui, sans-serif;
  font-weight: 600;
  color: #0f172a;
  appearance: none;
  background-image: url("data:image/svg+xml,%3Csvg width='9' height='6' viewBox='0 0 9 6' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 0L3.5 3.5 7 0' stroke='%230f172a' stroke-width='2' stroke-linecap='round'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 12px center;
  cursor: pointer;
}

.public-service-card {
  border-width: 1px;
  border-style: solid;
  border-color: #e2e8f0;
  border-radius: 20px;
  background-color: #fff;
  display: flex;
  flex-direction: column;
  row-gap: 24px;
  align-items: flex-start;
  width: 100%;
  filter: drop-shadow(0px 8px 16px rgba(0,0,0,0.03));
  flex-grow: 1;
  flex-basis: 0;
  min-width: 0;
  padding: 32px;
  text-decoration: none;
  color: inherit;
  height: auto !important;
  box-sizing: border-box;
}

.public-service-card__icon {
  border-radius: 16px;
  background-color: rgba(27, 58, 107, 0.06);
  display: flex;
  align-items: center;
  justify-content: center;
  width: 56px;
  height: 56px;
  flex-shrink: 0;
}

.public-service-card__body {
  display: flex;
  flex-direction: column;
  row-gap: 8px;
  width: 100%;
}

.public-service-card__title {
  font-size: 20px;
  font-family: Inter, system-ui, sans-serif;
  font-weight: 700;
  color: #1a253c;
}

.public-service-card__desc {
  line-height: 21px;
  font-size: 14px;
  font-family: Inter, system-ui, sans-serif;
  font-weight: 400;
  color: #626f84;
}

.public-service-card__link {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 14px;
  font-family: Inter, system-ui, sans-serif;
  font-weight: 600;
  color: #1b3a6b;
}

.public-service-card:hover .public-service-card__link { text-decoration: underline; }

.sr-only {
  position: absolute;
  width: 1px;
  height: 1px;
  padding: 0;
  margin: -1px;
  overflow: hidden;
  clip: rect(0, 0, 0, 0);
  white-space: nowrap;
  border: 0;
}

@media (max-width: 900px) {
  .public-pagination {
    flex-direction: column !important;
    align-items: stretch !important;
  }

  .public-pagination__nav,
  .public-pagination__nav--disabled {
    margin: 0 !important;
    justify-content: center !important;
  }

  .public-job-list-item .public-job-card__footer {
    flex-direction: column !important;
    align-items: stretch !important;
    gap: 12px !important;
  }

  .public-job-list-item .public-job-card__footer > div:last-child {
    width: 100% !important;
    flex-direction: column !important;
  }

  .public-job-list-item .public-job-card__footer a {
    width: 100% !important;
    justify-content: center !important;
  }
}
</style>
@stack('styles')
