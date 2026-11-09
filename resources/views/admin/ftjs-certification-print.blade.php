<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FTJS Certification — Print</title>
  @include('partials.admin.ftjs-certification-print-styles')
</head>
<body class="ftjs-certification-print">
  @include('partials.admin.ftjs-certification-official', ['certificate' => $certificate])

  <form id="ftjs-print-log" method="POST" action="{{ route('admin.certifications.print') }}" hidden>
    @csrf
    <input type="hidden" name="id" value="{{ $certificationId }}">
    <input type="hidden" name="name" value="">
  </form>

  <script>
    (function () {
      var dateEl = document.querySelector('[data-letter-field="certification_date_display"]');
      if (dateEl) {
        dateEl.textContent = new Date().toLocaleDateString('en-GB', {
          day: 'numeric',
          month: 'long',
          year: 'numeric',
        });
      }

      function logPrint() {
        var form = document.getElementById('ftjs-print-log');
        if (!form) return;
        var body = new FormData(form);
        fetch(form.action, {
          method: 'POST',
          body: body,
          headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
          credentials: 'same-origin',
        }).catch(function () {});
      }

      window.addEventListener('load', function () {
        window.setTimeout(function () {
          window.print();
        }, 200);
      });

      window.addEventListener('afterprint', function () {
        logPrint();
        window.close();
      });
    })();
  </script>
</body>
</html>
