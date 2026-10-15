<style>
  .turbo-progress-bar {
    display: none !important;
  }

  .peso-nav-progress {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 10000;
    width: 100%;
    height: 3px;
    pointer-events: none;
    opacity: 0;
    transition: opacity 0.2s ease;
  }

  .peso-nav-progress:not([hidden]) {
    opacity: 1;
  }

  .peso-nav-progress__bar {
    height: 100%;
    width: 36%;
    max-width: 280px;
    border-radius: 0 2px 2px 0;
    background: linear-gradient(90deg, #1b3a6b 0%, #3d6eb5 55%, #1b3a6b 100%);
    transform: translateX(-100%);
    animation: peso-nav-progress-slide 1.1s ease-in-out infinite;
  }

  @keyframes peso-nav-progress-slide {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(calc(100vw + 100%)); }
  }

  .peso-page-transition {
    transition: opacity 0.22s ease;
  }

  html.peso-nav-busy .peso-page-transition {
    opacity: 0.88;
  }

  .peso-session-loader {
    position: fixed;
    inset: 0;
    z-index: 10001;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 16px;
    background: rgba(248, 250, 252, 0.92);
    backdrop-filter: blur(4px);
    transition: opacity 0.35s ease, visibility 0.35s ease;
  }

  .peso-session-loader--admin {
    background: rgba(244, 246, 249, 0.94);
  }

  .peso-session-loader.is-hidden {
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
  }

  .peso-session-loader__logo {
    width: 48px;
    height: 48px;
    border-radius: 20px;
    object-fit: cover;
    animation: peso-session-logo-pulse 1.4s ease-in-out infinite;
  }

  .peso-session-loader__label {
    font-family: Inter, system-ui, sans-serif;
    font-size: 14px;
    font-weight: 500;
    color: #64748b;
    letter-spacing: 0.01em;
  }

  @keyframes peso-session-logo-pulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.82; transform: scale(0.97); }
  }

  @media (prefers-reduced-motion: reduce) {
    .peso-nav-progress__bar {
      animation: none;
      width: 100%;
      max-width: none;
      transform: none;
      opacity: 0.35;
    }

    .peso-page-transition {
      transition: none;
    }

    html.peso-nav-busy .peso-page-transition {
      opacity: 1;
    }

    .peso-session-loader__logo {
      animation: none;
    }
  }
</style>
