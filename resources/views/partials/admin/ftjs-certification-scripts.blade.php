<script>
  (function () {
    function bindFtjsPrintButtons() {
      document.addEventListener('click', function (event) {
        var trigger = event.target.closest('[data-admin-print-ftjs]');
        if (!trigger || !trigger.dataset.itemId) return;

        event.preventDefault();

        var printUrl = '/admin/certifications/' + encodeURIComponent(trigger.dataset.itemId) + '/certificate/print';
        window.open(printUrl, '_blank', 'noopener,noreferrer');
      });
    }

    bindFtjsPrintButtons();
  })();
</script>
