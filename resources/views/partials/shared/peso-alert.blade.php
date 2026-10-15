<div id="peso-alert" class="peso-alert-backdrop" data-turbo-permanent hidden aria-modal="true" role="alertdialog" aria-labelledby="peso-alert-title" aria-describedby="peso-alert-message">
  <div class="peso-alert peso-alert--info" data-alert-panel>
    <div class="peso-alert__icon-wrap" aria-hidden="true">
      <span class="peso-alert__icon peso-alert__icon--danger">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none"><path d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
      </span>
      <span class="peso-alert__icon peso-alert__icon--warning">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/><path d="M12 8v5M12 16h.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
      </span>
      <span class="peso-alert__icon peso-alert__icon--success">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none"><path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </span>
      <span class="peso-alert__icon peso-alert__icon--info">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/><path d="M12 11v6M12 8h.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
      </span>
    </div>
    <div class="peso-alert__body">
      <h2 id="peso-alert-title" class="peso-alert__title">Notice</h2>
      <p id="peso-alert-message" class="peso-alert__message"></p>
      <ul id="peso-alert-list" class="peso-alert__list" hidden></ul>
    </div>
    <div class="peso-alert__actions">
      <button type="button" class="peso-alert__btn" data-alert-ok>OK</button>
    </div>
  </div>
</div>

<script>
  (function () {
    var defaults = {
      success: { title: 'Success', ok: 'OK' },
      danger: { title: 'Something went wrong', ok: 'OK' },
      warning: { title: 'Please review', ok: 'OK' },
      info: { title: 'Notice', ok: 'OK' },
    };

    function closeAlert(backdrop) {
      backdrop.hidden = true;
      document.body.style.overflow = '';
    }

    window.PesoAlert = {
      show: function (options) {
        var backdrop = document.getElementById('peso-alert');
        if (!backdrop) return Promise.resolve();

        var panel = backdrop.querySelector('[data-alert-panel]');
        var type = options.type || 'info';
        if (!defaults[type]) type = 'info';
        var preset = defaults[type];

        panel.className = 'peso-alert peso-alert--' + type;
        backdrop.querySelector('#peso-alert-title').textContent = options.title || preset.title;
        backdrop.querySelector('[data-alert-ok]').textContent = options.ok || preset.ok;

        var messageEl = backdrop.querySelector('#peso-alert-message');
        var listEl = backdrop.querySelector('#peso-alert-list');
        var items = options.items || [];

        messageEl.textContent = options.message || '';
        messageEl.hidden = !options.message;

        listEl.innerHTML = '';
        if (items.length) {
          items.forEach(function (item) {
            var li = document.createElement('li');
            li.textContent = item;
            listEl.appendChild(li);
          });
          listEl.hidden = false;
        } else {
          listEl.hidden = true;
        }

        if (!options.message && !items.length) {
          messageEl.hidden = false;
          messageEl.textContent = 'Please try again.';
        }

        return new Promise(function (resolve) {
          function finish() {
            closeAlert(backdrop);
            okBtn.removeEventListener('click', onOk);
            backdrop.removeEventListener('click', onBackdrop);
            document.removeEventListener('keydown', onKeydown);
            resolve();
          }

          function onOk() { finish(); }
          function onBackdrop(event) {
            if (event.target === backdrop) finish();
          }
          function onKeydown(event) {
            if (event.key === 'Escape' || event.key === 'Enter') finish();
          }

          var okBtn = backdrop.querySelector('[data-alert-ok]');
          okBtn.addEventListener('click', onOk);
          backdrop.addEventListener('click', onBackdrop);
          document.addEventListener('keydown', onKeydown);

          backdrop.hidden = false;
          document.body.style.overflow = 'hidden';
          okBtn.focus();
        });
      },
    };

    function clearPesoFieldInvalid() {
      document.querySelectorAll('.peso-field-invalid').forEach(function (el) {
        el.classList.remove('peso-field-invalid');
        el.removeAttribute('aria-invalid');
      });
    }

    function markPesoFieldInvalid(names) {
      if (!names || !names.length) return;

      clearPesoFieldInvalid();

      names.forEach(function (name) {
        var selector = '[name="' + name.replace(/\\/g, '\\\\').replace(/"/g, '\\"') + '"]';
        document.querySelectorAll(selector).forEach(function (el) {
          el.classList.add('peso-field-invalid');
          el.setAttribute('aria-invalid', 'true');
        });
      });
    }

    function fieldLabelFor(el) {
      if (el.labels && el.labels.length) {
        return el.labels[0].textContent.replace(/\s+/g, ' ').trim();
      }
      var labelledBy = el.getAttribute('aria-labelledby');
      if (labelledBy) {
        var labelEl = document.getElementById(labelledBy);
        if (labelEl) return labelEl.textContent.replace(/\s+/g, ' ').trim();
      }
      return el.getAttribute('placeholder') || el.name || el.id || 'Field';
    }

    function bindPesoFormValidation() {
      if (window.__pesoFormValidationBound) return;
      window.__pesoFormValidationBound = true;

      document.addEventListener('input', function (event) {
        var el = event.target;
        if (!el.classList || !el.classList.contains('peso-field-invalid')) return;
        if (typeof el.checkValidity === 'function' && el.checkValidity()) {
          el.classList.remove('peso-field-invalid');
          el.removeAttribute('aria-invalid');
        }
      });

      document.addEventListener('submit', function (event) {
        var form = event.target;
        if (!(form instanceof HTMLFormElement)) return;
        if (form.method && form.method.toLowerCase() === 'get') return;
        if (form.getAttribute('data-skip-validation-popup') === 'true') return;

        if (form.checkValidity()) return;

        event.preventDefault();
        event.stopPropagation();

        var invalidEls = form.querySelectorAll(':invalid');
        var items = [];
        var fields = [];

        invalidEls.forEach(function (el) {
          if (el.name) fields.push(el.name);
          var msg = el.validationMessage || 'This field is required.';
          items.push(fieldLabelFor(el) + ': ' + msg);
        });

        markPesoFieldInvalid(fields);

        window.PesoAlert.show({
          type: 'warning',
          title: 'Please complete the form',
          message: 'Some required fields are missing or invalid.',
          items: items.slice(0, 10),
          ok: 'Got it',
        }).then(function () {
          if (invalidEls.length) invalidEls[0].focus();
        });
      }, true);
    }

    var flashBootQueued = false;

    function bootPesoFlash() {
      if (flashBootQueued) return;
      flashBootQueued = true;

      window.requestAnimationFrame(function () {
        flashBootQueued = false;

        var payloadEl = document.getElementById('peso-flash-payload');
        if (!payloadEl) return;

        var data;
        try {
          data = JSON.parse(payloadEl.textContent || '{}');
        } catch (e) {
          payloadEl.remove();
          return;
        }

        payloadEl.remove();

        if (!data || !data.type) return;

        if (data.fields) {
          markPesoFieldInvalid(data.fields);
        }

        window.PesoAlert.show({
          type: data.type,
          title: data.title,
          message: data.message || '',
          items: data.items || [],
          ok: data.ok,
        });
      });
    }

    function bootPesoFeedback() {
      bindPesoFormValidation();
      bootPesoFlash();
    }

    document.addEventListener('DOMContentLoaded', bootPesoFeedback);
    document.addEventListener('turbo:load', bootPesoFeedback);
  })();
</script>
