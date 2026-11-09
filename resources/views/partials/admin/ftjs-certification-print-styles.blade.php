<style>
  html,
  body.ftjs-certification-print {
    margin: 0;
    padding: 0;
    background: #fff;
    color: #111;
  }

  body.ftjs-certification-print {
    font-family: Calibri, 'Segoe UI', Arial, sans-serif;
  }

  .peso-official-ftjs-certification {
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
  }

  .peso-official-ftjs-certification__letterhead-row {
    display: grid;
    grid-template-columns: 1.05in 1fr 1.05in;
    align-items: center;
    column-gap: 10px;
    margin-bottom: 4px;
  }

  .peso-official-ftjs-certification__logo-col {
    display: flex;
    align-items: center;
  }

  .peso-official-ftjs-certification__logo-col--left {
    justify-content: flex-start;
  }

  .peso-official-ftjs-certification__logo-col--right {
    justify-content: flex-end;
  }

  .peso-official-ftjs-certification__logo-slot {
    width: 0.9in;
    height: 0.9in;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    flex-shrink: 0;
  }

  .peso-official-ftjs-certification__logo {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
  }

  .peso-official-ftjs-certification__logo-fallback {
    display: none;
    font-size: 8px;
    text-align: center;
    color: #64748b;
    padding: 2px;
  }

  .peso-official-ftjs-certification__logo-slot.is-placeholder .peso-official-ftjs-certification__logo {
    display: none;
  }

  .peso-official-ftjs-certification__logo-slot.is-placeholder .peso-official-ftjs-certification__logo-fallback {
    display: block;
  }

  .peso-official-ftjs-certification__letterhead-center {
    text-align: center;
    min-width: 0;
  }

  .peso-official-ftjs-certification__gov,
  .peso-official-ftjs-certification__office-sub {
    margin: 0;
    font-size: 13pt;
    line-height: 1.15;
  }

  .peso-official-ftjs-certification__office {
    margin: 0;
    font-size: 14pt;
    font-weight: 700;
    line-height: 1.15;
  }

  .peso-official-ftjs-certification__rule {
    border: none;
    border-top: 1px solid #1e293b;
    margin: 8px 0 10px;
    height: 0;
  }

  .peso-official-ftjs-certification__page {
    display: flex;
    flex-direction: column;
    flex: 1 1 auto;
    min-height: 0;
  }

  .peso-official-ftjs-certification__title {
    text-align: center;
    font-size: 22pt;
    font-weight: 700;
    margin: 0 0 10pt;
    line-height: 1.1;
    white-space: nowrap;
  }

  .peso-official-ftjs-certification__body {
    flex: 0 1 auto;
  }

  .peso-official-ftjs-certification__salutation {
    font-weight: 700;
    margin: 0 0 12pt !important;
    font-size: 13pt;
  }

  .peso-official-ftjs-certification__paragraph,
  .peso-official-ftjs-certification__date-line {
    text-align: justify;
    margin: 0 0 12pt !important;
    font-size: 13pt;
    line-height: 1.15;
  }

  .peso-official-ftjs-certification__signature-block {
    margin-top: 0;
    max-width: 320px;
  }

  .peso-official-ftjs-certification__signature-label {
    margin: 0 0 8pt !important;
    font-style: italic;
    font-size: 12pt;
  }

  .peso-official-ftjs-certification__signature-space {
    height: 48px;
  }

  .peso-official-ftjs-certification__signatory-name {
    font-weight: 700;
    margin: 0 !important;
    font-size: 12pt;
  }

  .peso-official-ftjs-certification__signatory-title {
    margin: 0 !important;
    font-size: 12pt;
  }

  .peso-official-ftjs-certification__footer {
    margin-top: auto;
    padding: 0;
    border: none;
    flex-shrink: 0;
  }

  .peso-official-ftjs-certification__footer-line {
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
    body.ftjs-certification-print {
      margin: 0 !important;
      padding: 0 !important;
      height: auto !important;
      overflow: visible !important;
    }

    .peso-official-ftjs-certification {
      min-height: 9in;
      max-width: none;
      margin: 0;
    }

    .peso-official-ftjs-certification__footer {
      position: fixed;
      left: 0;
      right: 0;
      bottom: 0;
      margin: 0;
      padding-bottom: 0;
    }

    .peso-official-ftjs-certification__page {
      padding-bottom: 36pt;
    }
  }
</style>
