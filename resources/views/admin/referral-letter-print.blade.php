<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Referral Letter — Print</title>
  @include('partials.admin.referral-letter-print-page-styles')
</head>
<body class="referral-letter-print">
  @include('partials.admin.referral-letter-official', ['letter' => $letter, 'letterMode' => 'view'])

  <script>
    (function () {
      var dateEl = document.querySelector('[data-letter-field="date_display"]');
      if (dateEl) {
        dateEl.textContent = new Date().toLocaleDateString('en-GB', {
          day: 'numeric',
          month: 'long',
          year: 'numeric',
        });
      }

      window.addEventListener('load', function () {
        window.setTimeout(function () {
          window.print();
        }, 200);
      });

      window.addEventListener('afterprint', function () {
        window.close();
      });
    })();
  </script>
</body>
</html>
