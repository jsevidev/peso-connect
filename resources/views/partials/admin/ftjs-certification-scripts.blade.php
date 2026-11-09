<script>
  (function () {
    var fieldMap = {
      bearer_name: 'bearer_name',
      confirm_name: 'confirm_name',
      pronoun_subject: 'pronoun_subject',
      certification_date_display: 'certification_date_display',
      city: 'city',
      certification_date_short: 'certification_date_short',
      signatory_name: 'signatory_name',
      signatory_title: 'signatory_title',
    };

    window.renderOfficialFtjsCertification = function (root, data) {
      if (!root || !data) return;

      Object.keys(fieldMap).forEach(function (field) {
        var key = fieldMap[field];
        var el = root.querySelector('[data-letter-field="' + field + '"]');
        if (!el) return;
        var value = data[key];
        el.textContent = value === null || value === undefined || value === '' ? '—' : value;
      });
    };

    if (!window.prepareReferralLetterPrintFit) {
      window.prepareReferralLetterPrintFit = function () {
        var letter = document.querySelector('body.peso-print-referral-letter [data-letter-root]');
        if (!letter) return function () {};

        letter.style.removeProperty('--peso-letter-print-scale');
        var pageHeightPx = 10 * 96 - 0.56 * 96;
        var contentHeight = letter.scrollHeight;
        if (contentHeight > pageHeightPx && contentHeight > 0) {
          var scale = pageHeightPx / contentHeight;
          letter.style.setProperty('--peso-letter-print-scale', String(Math.max(0.94, scale)));
        }

        return function resetReferralLetterPrintFit() {
          letter.style.removeProperty('--peso-letter-print-scale');
        };
      };
    }

    window.fetchFtjsCertification = function (certificationId) {
      return fetch('/admin/certifications/' + certificationId + '/certificate', {
        headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
      }).then(function (response) {
        if (!response.ok) throw new Error('Unable to load FTJS certification.');
        return response.json();
      });
    };

    function logFtjsPrint(certificationId) {
      var tokenInput = document.querySelector('input[name="_token"]');
      var token = tokenInput ? tokenInput.value : '';
      var body = new FormData();
      body.append('_token', token);
      body.append('id', certificationId);
      body.append('name', '');

      return fetch('{{ route('admin.certifications.print') }}', {
        method: 'POST',
        body: body,
        headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
      }).catch(function () {
        return null;
      });
    }

    function bindFtjsPrintButtons() {
      document.addEventListener('click', function (event) {
        var trigger = event.target.closest('[data-admin-print-ftjs]');
        if (!trigger || !trigger.dataset.itemId) return;

        var host = document.getElementById('ftjs-certification-print-host');
        var templateRoot = document.querySelector('#ftjs-certification-print-template [data-letter-root]');
        if (!host || !templateRoot) return;

        event.preventDefault();

        window.fetchFtjsCertification(trigger.dataset.itemId)
          .then(function (data) {
            host.hidden = false;
            host.innerHTML = '';
            host.appendChild(templateRoot.cloneNode(true));
            var letterRoot = host.querySelector('[data-letter-root]');
            if (window.renderOfficialFtjsCertification && letterRoot) {
              window.renderOfficialFtjsCertification(letterRoot, data);
            }

            document.body.classList.add('peso-print-referral-letter');
            var resetPrintFit = window.prepareReferralLetterPrintFit
              ? window.prepareReferralLetterPrintFit()
              : function () {};

            window.print();
            resetPrintFit();
            document.body.classList.remove('peso-print-referral-letter');
            host.hidden = true;
            host.innerHTML = '';

            logFtjsPrint(trigger.dataset.itemId);
          });
      });
    }

    bindFtjsPrintButtons();
  })();
</script>
