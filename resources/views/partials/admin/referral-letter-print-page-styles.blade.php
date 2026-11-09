<style>
  html,
  body.referral-letter-print {
    margin: 0;
    padding: 0;
    background: #fff;
    color: #111;
  }

  body.referral-letter-print {
    font-family: Calibri, 'Segoe UI', Arial, sans-serif;
  }

  .peso-official-referral-letter {
    font-family: Calibri, 'Segoe UI', Arial, sans-serif;
    font-size: 13pt;
    line-height: 1.15;
    color: #111;
    background: #fff;
    box-sizing: border-box;
    width: 100%;
    max-width: 6.5in;
    margin: 0 auto;
    min-height: 9in;
    display: flex;
    flex-direction: column;
    padding: 0;
    border: none;
    border-radius: 0;
  }

  .peso-official-referral-letter__letterhead-row {
    display: grid;
    grid-template-columns: 1.05in 1fr 1.05in;
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

  .peso-official-referral-letter__logo-slot {
    width: 0.9in;
    height: 0.9in;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    flex-shrink: 0;
  }

  .peso-official-referral-letter__logo {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
  }

  .peso-official-referral-letter__logo-fallback {
    display: none;
    font-size: 8px;
    text-align: center;
    color: #64748b;
  }

  .peso-official-referral-letter__logo-slot.is-placeholder .peso-official-referral-letter__logo {
    display: none;
  }

  .peso-official-referral-letter__logo-slot.is-placeholder .peso-official-referral-letter__logo-fallback {
    display: block;
  }

  .peso-official-referral-letter__letterhead-center {
    text-align: center;
    min-width: 0;
  }

  .peso-official-referral-letter__gov,
  .peso-official-referral-letter__office-sub {
    margin: 0;
    font-size: 13pt;
    line-height: 1.15;
  }

  .peso-official-referral-letter__office {
    margin: 0;
    font-size: 14pt;
    font-weight: 700;
    line-height: 1.15;
    color: #111;
  }

  .peso-official-referral-letter__rule {
    border: none;
    border-top: 1px solid #1e293b;
    margin: 8px 0 10px;
    height: 0;
  }

  .peso-official-referral-letter__page {
    display: flex;
    flex-direction: column;
    flex: 1 1 auto;
    min-height: 0;
  }

  .peso-official-referral-letter__title {
    text-align: center;
    font-size: 25pt;
    font-weight: 700;
    font-style: normal;
    margin: 0 0 12pt;
    line-height: 1.1;
  }

  .peso-official-referral-letter__body p {
    margin: 0 0 12pt;
  }

  .peso-official-referral-letter__recipient-name {
    font-weight: 700;
  }

  .peso-official-referral-letter__reference {
    font-weight: 700;
    text-align: justify;
  }

  .peso-official-referral-letter__intro,
  .peso-official-referral-letter__closing,
  .peso-official-referral-letter__thanks {
    text-align: justify;
  }

  .peso-official-referral-letter__profile {
    margin: 0 0 12pt;
    padding-left: 0.25in;
    list-style-type: disc;
  }

  .peso-official-referral-letter__profile li {
    margin: 0 0 8pt;
    padding-left: 4pt;
    text-align: left;
  }

  .peso-official-referral-letter__signatory p:first-child {
    font-weight: 700;
    margin: 0 0 2pt;
    font-size: 13pt;
  }

  .peso-official-referral-letter__signatory p:last-child {
    margin: 0;
    font-size: 10pt;
  }

  .peso-official-referral-letter__footer {
    margin-top: auto;
    padding: 0;
    border: none;
    flex-shrink: 0;
  }

  .peso-official-referral-letter__footer-line {
    margin: 0;
    text-align: center;
    font-size: 9.5pt;
    color: #334155;
    line-height: 1.35;
  }

  @page {
    size: letter portrait;
    margin: 1in;
  }

  @media print {
    html,
    body.referral-letter-print {
      margin: 0 !important;
      padding: 0 !important;
      height: auto !important;
      overflow: visible !important;
    }

    .peso-official-referral-letter {
      min-height: 9in;
      max-width: none;
      margin: 0;
    }

    .peso-official-referral-letter__footer {
      position: fixed;
      left: 0;
      right: 0;
      bottom: 0;
      margin: 0;
    }

    .peso-official-referral-letter__page {
      padding-bottom: 40pt;
    }
  }
</style>
