<script>
  (function () {
    var toggle = document.querySelector('.public-nav-toggle');
    var nav = document.getElementById('public-nav');
    if (!toggle || !nav) return;

    toggle.addEventListener('click', function () {
      var isOpen = nav.classList.toggle('is-open');
      toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
      toggle.setAttribute('aria-label', isOpen ? 'Close menu' : 'Open menu');
    });
  })();
</script>
@stack('scripts')
