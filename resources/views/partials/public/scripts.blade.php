<script>
  (function () {
    function syncPublicNav() {
      var path = window.location.pathname.replace(/\/$/, '') || '/';
      document.querySelectorAll('#public-nav a[href]').forEach(function (link) {
        var href = link.getAttribute('href');
        if (!href) return;
        var linkPath = href.replace(/^https?:\/\/[^/]+/, '').replace(/\/$/, '') || '/';
        var isActive = path === linkPath;
        link.style.borderRadius = '8px';
        link.style.backgroundColor = isActive ? 'rgba(27,58,107,0.06)' : 'transparent';
        var label = link.querySelector('.text');
        if (label) label.style.fontWeight = isActive ? '600' : '500';
      });
    }

    function bindPublicUi() {
      var toggle = document.querySelector('.public-nav-toggle');
      var nav = document.getElementById('public-nav');

      if (toggle && nav && !toggle.dataset.bound) {
        toggle.dataset.bound = '1';
        toggle.addEventListener('click', function () {
          var isOpen = nav.classList.toggle('is-open');
          toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
          toggle.setAttribute('aria-label', isOpen ? 'Close menu' : 'Open menu');
        });
      }

      syncPublicNav();
    }

    document.addEventListener('turbo:load', bindPublicUi);
    document.addEventListener('DOMContentLoaded', bindPublicUi);
  })();
</script>
@stack('scripts')
