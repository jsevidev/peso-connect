<script>
  (function () {
    var pollTimer = null;

    function showLiveBadge() {
      var badge = document.getElementById('live-refresh-badge');
      if (!badge) return;

      badge.hidden = false;
      badge.textContent = 'Live · updated ' + new Date().toLocaleTimeString([], { hour: 'numeric', minute: '2-digit' });

      window.clearTimeout(badge._hideTimer);
      badge._hideTimer = window.setTimeout(function () {
        badge.hidden = true;
      }, 4000);
    }

    function refreshLiveTarget(target) {
      var url = target.getAttribute('data-live-url');
      if (!url || document.hidden) return Promise.resolve();

      return fetch(url, {
        headers: {
          'X-Live-Refresh': '1',
          'X-Requested-With': 'XMLHttpRequest',
          Accept: 'text/html',
        },
        credentials: 'same-origin',
      })
        .then(function (response) {
          if (!response.ok) throw new Error('Live refresh failed');
          return response.text();
        })
        .then(function (html) {
          target.innerHTML = html;
          showLiveBadge();
        })
        .catch(function () {
          /* ignore transient network errors during polling */
        });
    }

    function pollLiveRegions() {
      var targets = document.querySelectorAll('[data-live-url]');
      if (!targets.length) return;

      Promise.all(Array.prototype.map.call(targets, refreshLiveTarget));
    }

    function startLivePolling() {
      window.clearInterval(pollTimer);
      pollTimer = null;

      var targets = document.querySelectorAll('[data-live-url]');
      if (!targets.length) return;

      var interval = 30000;
      targets.forEach(function (target) {
        var value = parseInt(target.getAttribute('data-live-interval') || '30000', 10);
        if (!Number.isNaN(value) && value > 0) {
          interval = Math.min(interval, value);
        }
      });

      pollTimer = window.setInterval(pollLiveRegions, interval);
    }

    function stopLivePolling() {
      window.clearInterval(pollTimer);
      pollTimer = null;
    }

    document.addEventListener('turbo:load', startLivePolling);
    document.addEventListener('DOMContentLoaded', startLivePolling);
    document.addEventListener('turbo:before-cache', stopLivePolling);
    document.addEventListener('visibilitychange', function () {
      if (!document.hidden) pollLiveRegions();
    });
  })();
</script>
