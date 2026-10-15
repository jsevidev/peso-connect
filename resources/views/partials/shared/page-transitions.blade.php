<div id="peso-nav-progress" class="peso-nav-progress" hidden aria-hidden="true">
  <div class="peso-nav-progress__bar"></div>
</div>

<div id="peso-session-loader" class="peso-session-loader @if(request()->is('admin', 'admin/*')) peso-session-loader--admin @endif" role="status" aria-live="polite" aria-label="Loading PESO Connect">
  <img src="{{ asset('assets/img/peso-logo.png') }}" alt="" class="peso-session-loader__logo" width="48" height="48" decoding="async">
  <span class="peso-session-loader__label">Loading PESO Connect…</span>
</div>

<script>
  (function () {
    var SESSION_KEY = 'peso_connect.session_booted';
    var progressEl = document.getElementById('peso-nav-progress');
    var loaderEl = document.getElementById('peso-session-loader');
    var reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var navBusy = false;
    var navBusySince = 0;
    var navHideTimer = null;

    function showNavProgress() {
      if (!progressEl || reducedMotion) return;
      navBusy = true;
      navBusySince = Date.now();
      document.documentElement.classList.add('peso-nav-busy');
      progressEl.hidden = false;
    }

    function hideNavProgress() {
      if (!navBusy && progressEl && progressEl.hidden) return;

      var elapsed = Date.now() - navBusySince;
      var minVisible = reducedMotion ? 0 : 180;
      var delay = Math.max(0, minVisible - elapsed);

      clearTimeout(navHideTimer);
      navHideTimer = setTimeout(function () {
        navBusy = false;
        document.documentElement.classList.remove('peso-nav-busy');
        if (progressEl) progressEl.hidden = true;
      }, delay);
    }

    function dismissSessionLoader() {
      if (!loaderEl || loaderEl.classList.contains('is-hidden')) return;

      try {
        sessionStorage.setItem(SESSION_KEY, '1');
      } catch (e) {}

      loaderEl.classList.add('is-hidden');
      window.setTimeout(function () {
        if (loaderEl.parentNode) loaderEl.parentNode.removeChild(loaderEl);
      }, 400);
    }

    function initSessionLoader() {
      if (!loaderEl) return;

      var alreadyBooted = false;
      try {
        alreadyBooted = sessionStorage.getItem(SESSION_KEY) === '1';
      } catch (e) {}

      if (alreadyBooted) {
        loaderEl.remove();
        return;
      }

      var minShown = Date.now() + (reducedMotion ? 0 : 400);
      var finished = false;

      function finish() {
        if (finished) return;
        finished = true;
        var wait = Math.max(0, minShown - Date.now());
        window.setTimeout(dismissSessionLoader, wait);
      }

      window.addEventListener('load', finish, { once: true });
      document.addEventListener('turbo:load', finish, { once: true });
      window.setTimeout(finish, 8000);
    }

    initSessionLoader();

    if (!window.Turbo) return;

    document.addEventListener('turbo:before-visit', showNavProgress);
    document.addEventListener('turbo:submit-start', function (event) {
      if (event.detail && event.detail.formSubmission && !event.detail.formSubmission.isSafe) {
        showNavProgress();
      }
    });
    document.addEventListener('turbo:render', hideNavProgress);
    document.addEventListener('turbo:load', hideNavProgress);
    document.addEventListener('turbo:frame-render', hideNavProgress);
  })();
</script>
