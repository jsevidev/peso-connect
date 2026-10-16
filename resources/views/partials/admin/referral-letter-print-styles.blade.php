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

  .peso-official-referral-letter__title {
    text-align: center;
    font-size: 16px;
    font-weight: 700;
    font-style: italic;
    margin: 12px 0 14px;
  }

  .peso-official-referral-letter__body p { margin: 0 0 8px; }
  .peso-official-referral-letter__recipient-name { font-weight: 700; letter-spacing: 0.02em; }
  .peso-official-referral-letter__reference { font-weight: 700; margin-top: 10px !important; }
  .peso-official-referral-letter__salutation { margin-top: 10px !important; }
  .peso-official-referral-letter__intro { margin-top: 8px !important; text-align: justify; }

  .peso-official-referral-letter__profile {
    margin: 8px 0 12px 18px;
    padding: 0;
  }
  .peso-official-referral-letter__profile li { margin-bottom: 4px; }

  .peso-official-referral-letter__closing,
  .peso-official-referral-letter__thanks { text-align: justify; }

  .peso-official-referral-letter__signatory { margin-top: 18px; }
  .peso-official-referral-letter__signatory p:first-child { font-weight: 700; margin-bottom: 2px; }

  .peso-official-referral-letter__footer {
    margin-top: 18px;
    padding-top: 10px;
    border-top: 1px solid #cbd5e1;
    font-size: 10px;
    color: #334155;
    display: flex;
    flex-wrap: wrap;
    gap: 8px 16px;
    justify-content: center;
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

  @media print {
    @page {
      size: letter;
      margin: 0.32in 0.45in;
    }

    html, body {
      height: auto !important;
      overflow: hidden !important;
      margin: 0 !important;
      padding: 0 !important;
    }

    body.peso-print-referral-letter * {
      visibility: hidden !important;
    }
    body.peso-print-referral-letter [data-letter-root],
    body.peso-print-referral-letter [data-letter-root] * {
      visibility: visible !important;
    }
    body.peso-print-referral-letter [data-letter-root] {
      position: absolute;
      left: 0;
      top: 0;
      width: calc(100% / var(--peso-letter-print-scale, 1));
      border: none;
      border-radius: 0;
      padding: 0;
      margin: 0;
      box-sizing: border-box;
      transform: scale(var(--peso-letter-print-scale, 1));
      transform-origin: top left;
      page-break-inside: avoid;
      break-inside: avoid;
      overflow: hidden;
    }

    body.peso-print-referral-letter .peso-official-referral-letter {
      font-size: 11px;
      line-height: 1.32;
      padding: 0;
    }
    body.peso-print-referral-letter .peso-official-referral-letter__letterhead {
      margin-bottom: 6px;
    }
    body.peso-print-referral-letter .peso-official-referral-letter__logo-slot {
      width: 52px;
      height: 52px;
    }
    body.peso-print-referral-letter .peso-official-referral-letter__gov {
      font-size: 9px;
    }
    body.peso-print-referral-letter .peso-official-referral-letter__office {
      font-size: 11px;
    }
    body.peso-print-referral-letter .peso-official-referral-letter__office-sub {
      font-size: 9px;
    }
    body.peso-print-referral-letter .peso-official-referral-letter__title {
      font-size: 13px;
      margin: 8px 0 10px;
    }
    body.peso-print-referral-letter .peso-official-referral-letter__body p {
      margin-bottom: 5px;
    }
    body.peso-print-referral-letter .peso-official-referral-letter__profile {
      margin: 5px 0 8px 16px;
    }
    body.peso-print-referral-letter .peso-official-referral-letter__profile li {
      margin-bottom: 2px;
    }
    body.peso-print-referral-letter .peso-official-referral-letter__signatory {
      margin-top: 10px;
    }
    body.peso-print-referral-letter .peso-official-referral-letter__footer {
      margin-top: 10px;
      padding-top: 6px;
      font-size: 8.5px;
      gap: 4px 10px;
    }

    body.peso-print-referral-letter .admin-modal-backdrop.is-open {
      position: static !important;
      background: transparent !important;
      display: block !important;
    }
  }
</style>
