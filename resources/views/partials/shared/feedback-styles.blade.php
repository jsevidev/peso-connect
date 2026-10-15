<style>
  .peso-alert-backdrop {
    position: fixed;
    inset: 0;
    z-index: 1100;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    background: rgba(15, 23, 42, 0.48);
    backdrop-filter: blur(3px);
  }

  .peso-alert-backdrop[hidden] {
    display: none !important;
  }

  .peso-alert {
    width: 100%;
    max-width: 440px;
    border-radius: 16px;
    background: #fff;
    box-shadow: 0 24px 48px rgba(15, 23, 42, 0.18);
    border: 1px solid #e2e8f0;
    overflow: hidden;
    font-family: Inter, system-ui, sans-serif;
    animation: peso-alert-in 0.2s ease-out;
  }

  @keyframes peso-alert-in {
    from { opacity: 0; transform: translateY(8px) scale(0.98); }
    to { opacity: 1; transform: translateY(0) scale(1); }
  }

  .peso-alert__icon-wrap {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 28px 24px 0;
  }

  .peso-alert__icon {
    display: none;
    align-items: center;
    justify-content: center;
    width: 52px;
    height: 52px;
    border-radius: 50%;
  }

  .peso-alert--success .peso-alert__icon--success { display: inline-flex; background: #ecfdf5; color: #15803d; }
  .peso-alert--danger .peso-alert__icon--danger { display: inline-flex; background: #fef2f2; color: #b91c1c; }
  .peso-alert--warning .peso-alert__icon--warning { display: inline-flex; background: #fffbeb; color: #d97706; }
  .peso-alert--info .peso-alert__icon--info { display: inline-flex; background: #eef4fc; color: #1b3a6b; }

  .peso-alert__body {
    padding: 16px 28px 20px;
    text-align: center;
  }

  .peso-alert__title {
    margin: 0 0 8px;
    font-size: 18px;
    font-weight: 700;
    color: #0f172a;
    line-height: 1.3;
  }

  .peso-alert__message {
    margin: 0;
    font-size: 14px;
    line-height: 1.55;
    color: #64748b;
  }

  .peso-alert__list {
    margin: 12px 0 0;
    padding-left: 18px;
    text-align: left;
    font-size: 13px;
    line-height: 1.5;
    color: #64748b;
  }

  .peso-alert__actions {
    display: flex;
    justify-content: center;
    padding: 0 24px 24px;
  }

  .peso-alert__btn {
    min-width: 120px;
    padding: 11px 22px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 600;
    font-family: inherit;
    cursor: pointer;
    border: 1px solid transparent;
    transition: background 0.15s;
  }

  .peso-alert--success .peso-alert__btn { background: #15803d; color: #fff; }
  .peso-alert--success .peso-alert__btn:hover { background: #166534; }
  .peso-alert--danger .peso-alert__btn { background: #b91c1c; color: #fff; }
  .peso-alert--danger .peso-alert__btn:hover { background: #991b1b; }
  .peso-alert--warning .peso-alert__btn { background: #d97706; color: #fff; }
  .peso-alert--warning .peso-alert__btn:hover { background: #b45309; }
  .peso-alert--info .peso-alert__btn { background: #1b3a6b; color: #fff; }
  .peso-alert--info .peso-alert__btn:hover { background: #152d54; }

  .field-error {
    position: absolute !important;
    width: 1px !important;
    height: 1px !important;
    padding: 0 !important;
    margin: -1px !important;
    overflow: hidden !important;
    clip: rect(0, 0, 0, 0) !important;
    white-space: nowrap !important;
    border: 0 !important;
  }

  .peso-field-invalid,
  .admin-input.peso-field-invalid,
  .admin-select.peso-field-invalid,
  .admin-textarea.peso-field-invalid,
  .public-input.peso-field-invalid,
  .public-select.peso-field-invalid,
  .public-textarea.peso-field-invalid {
    border-color: #b91c1c !important;
    box-shadow: 0 0 0 3px rgba(185, 28, 28, 0.12);
  }
</style>
