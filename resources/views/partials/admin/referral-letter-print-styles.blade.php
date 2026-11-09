<style>
  .peso-official-referral-letter {
    font-family: Calibri, "Segoe UI", Arial, sans-serif;
    font-size: 13px;
    line-height: 1.45;
    color: #111;
    background: #fff;
    padding: 20px 22px 16px;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    max-width: 100%;
    box-sizing: border-box;
  }

  .peso-official-referral-letter__letterhead { text-align: center; margin-bottom: 10px; }
  .peso-official-referral-letter__logos {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    flex-wrap: wrap;
    margin-bottom: 8px;
  }
  .peso-official-referral-letter__logo-slot {
    width: 72px;
    height: 72px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
  }
  .peso-official-referral-letter__logo {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
  }
  .peso-official-referral-letter__logo-fallback {
    display: none;
    font-size: 9px;
    text-align: center;
    color: #64748b;
    padding: 4px;
  }
  .peso-official-referral-letter__logo-slot.is-placeholder .peso-official-referral-letter__logo { display: none; }
  .peso-official-referral-letter__logo-slot.is-placeholder .peso-official-referral-letter__logo-fallback { display: block; }

  .peso-official-referral-letter__gov { margin: 0; font-size: 11px; }
  .peso-official-referral-letter__office {
    margin: 2px 0 0;
    font-size: 13px;
    font-weight: 800;
    color: #1b3a6b;
    letter-spacing: 0.02em;
  }
  .peso-official-referral-letter__office-sub { margin: 1px 0 0; font-size: 11px; color: #334155; }

  .peso-official-referral-letter__letterhead-row {
    display: grid;
    grid-template-columns: 86px 1fr 86px;
    align-items: center;
    column-gap: 10px;
    margin-bottom: 4px;
  }

  .peso-official-referral-letter__logo-col {
    display: flex;
    align-items: center;
  }

  .peso-official-referral-letter__logo-col--left {
    justify-content: flex-start;
  }

  .peso-official-referral-letter__logo-col--right {
    justify-content: flex-end;
  }

  .peso-official-referral-letter__letterhead-center {
    text-align: center;
    min-width: 0;
  }

  .peso-official-referral-letter__rule {
    border-top: 1px solid #1e293b;
    margin: 8px 0 10px;
    height: 0;
  }

  .peso-official-referral-letter__page {
    display: flex;
    flex-direction: column;
    flex: 1;
  }

  .peso-official-referral-letter__title {
    text-align: center;
    font-size: 22px;
    font-weight: 700;
    font-style: normal;
    margin: 0 0 12px;
  }

  .peso-official-referral-letter__profile {
    margin: 8px 0 12px;
    padding-left: 18px;
    list-style-type: disc;
  }

  .peso-official-referral-letter__profile li {
    margin-bottom: 6px;
  }

  .peso-official-referral-letter__footer-line {
    margin: 0;
    text-align: center;
    font-size: 10px;
  }

  .peso-official-referral-letter__body p { margin: 0 0 8px; }
  .peso-official-referral-letter__recipient-name { font-weight: 700; letter-spacing: 0.02em; }
  .peso-official-referral-letter__reference { font-weight: 700; margin-top: 10px !important; }
  .peso-official-referral-letter__salutation { margin-top: 10px !important; }
  .peso-official-referral-letter__intro { margin-top: 8px !important; text-align: justify; }

  .peso-official-referral-letter__closing,
  .peso-official-referral-letter__thanks { text-align: justify; }

  .peso-official-referral-letter__signatory { margin-top: 18px; }
  .peso-official-referral-letter__signatory p:first-child { font-weight: 700; margin-bottom: 2px; }

  .peso-official-referral-letter__footer {
    margin-top: 18px;
    padding-top: 10px;
    border-top: none;
    font-size: 10px;
    color: #334155;
    display: block;
    text-align: center;
  }
  .peso-official-referral-letter__footer p { margin: 0; }
  .peso-official-referral-letter__footer-icon { margin-right: 4px; }

  .peso-official-referral-letter__input {
    border: 1px solid #4d80d9;
    border-radius: 4px;
    padding: 4px 8px;
    font: inherit;
    color: inherit;
    background: #fff;
    box-sizing: border-box;
  }
  .peso-official-referral-letter__input--block { display: block; width: 100%; margin-bottom: 6px; }
  .peso-official-referral-letter__input--inline { min-width: 140px; max-width: 100%; }
  .peso-official-referral-letter__input--wide { width: min(100%, 360px); }
  .peso-official-referral-letter__enlistee-label {
    display: block;
    font-size: 11px;
    font-weight: 600;
    color: #475569;
    margin: 10px 0 4px;
  }
  .peso-official-referral-letter__field-note {
    margin: 0 0 8px;
    font-size: 11px;
    line-height: 1.4;
    color: #64748b;
    font-style: italic;
  }

</style>
