<script>
  (function () {
    function openModal(id) {
      var modal = document.getElementById(id);
      if (modal) modal.classList.add('is-open');
    }

    function closeModal(modal) {
      if (modal) modal.classList.remove('is-open');
    }

    function renderReadOnlySkillTags(container, skillsCsv) {
      if (!container) return;
      container.innerHTML = '';
      (skillsCsv || '')
        .split(',')
        .map(function (s) { return s.trim(); })
        .filter(Boolean)
        .forEach(function (skill) {
          var tag = document.createElement('div');
          tag.className = 'admin-skill-tag';
          tag.innerHTML = '<span class="admin-skill-tag__label">' + skill + '</span>';
          container.appendChild(tag);
        });
    }

    function populateModalFromTrigger(trigger, modal) {
      Object.keys(trigger.dataset).forEach(function (key) {
        if (key === 'openModal' || key === 'itemId') return;
        var field = key.replace(/([A-Z])/g, '-$1').toLowerCase();
        modal.querySelectorAll('[data-modal-field="' + field + '"]').forEach(function (el) {
          if (el.type === 'checkbox' && el.dataset.modalBoolean === '1') {
            el.checked = trigger.dataset[key] === '1' || trigger.dataset[key] === 'true';
          } else if (el.tagName === 'INPUT' || el.tagName === 'TEXTAREA' || el.tagName === 'SELECT') {
            el.value = trigger.dataset[key] || '';
          } else {
            el.textContent = trigger.dataset[key];
          }
        });
      });

      var idInput = modal.querySelector('input[name="id"]');
      if (idInput && trigger.dataset.itemId) {
        idInput.value = trigger.dataset.itemId;
      }

      modal.querySelectorAll('input[name="id"]').forEach(function (el) {
        if (trigger.dataset.itemId) el.value = trigger.dataset.itemId;
      });
      modal.querySelectorAll('input[name="name"]').forEach(function (el) {
        if (trigger.dataset.name) el.value = trigger.dataset.name;
      });

      if (modal.id === 'modal-edit-enlistee' && trigger.dataset.skills && typeof window.setEditEnlisteeSkills === 'function') {
        window.setEditEnlisteeSkills(trigger.dataset.skills);
      }

      if (modal.id === 'modal-enlistee-details') {
        renderReadOnlySkillTags(modal.querySelector('#enlistee-details-skills'), trigger.dataset.skills);
      }

      if (modal.id === 'modal-referral-preview') {
        var subject = modal.querySelector('[data-modal-field="subject"]');
        if (subject && trigger.dataset.name) {
          subject.textContent = 'Subject: Endorsement of ' + trigger.dataset.name;
        }
      }

      if (modal.id === 'modal-edit-announcement') {
        var scheduleToggle = modal.querySelector('#edit_schedule_later');
        var scheduleFields = modal.querySelector('#edit_schedule_fields');
        var isScheduled = trigger.dataset.scheduleLater === '1' || trigger.dataset.status === 'Scheduled';
        if (scheduleToggle) scheduleToggle.checked = isScheduled;
        if (scheduleFields) scheduleFields.hidden = !isScheduled;
      }
    }

    function syncAdminNav() {
      var path = window.location.pathname.replace(/\/$/, '');
      document.querySelectorAll('.admin-nav__link').forEach(function (link) {
        var href = link.getAttribute('href');
        if (!href) return;
        var linkPath = href.replace(/^https?:\/\/[^/]+/, '').replace(/\/$/, '');
        var isActive = path === linkPath;
        link.classList.toggle('is-active', isActive);
        var dot = link.querySelector('.admin-nav__dot');
        if (isActive && !dot) {
          dot = document.createElement('span');
          dot.className = 'admin-nav__dot';
          dot.setAttribute('aria-hidden', 'true');
          link.appendChild(dot);
        } else if (!isActive && dot) {
          dot.remove();
        }
      });
    }

    var confirmDefaults = {
      danger: { title: 'Confirm deletion', ok: 'Delete', cancel: 'Keep' },
      warning: { title: 'Please confirm', ok: 'Continue', cancel: 'Cancel' },
      success: { title: 'Confirm action', ok: 'Approve', cancel: 'Go back' },
      info: { title: 'Are you sure?', ok: 'Confirm', cancel: 'Cancel' },
    };

    window.PesoConfirm = {
      show: function (options) {
        var backdrop = document.getElementById('peso-confirm');
        if (!backdrop) {
          return Promise.resolve(window.confirm(options.message || 'Continue?'));
        }

        var panel = backdrop.querySelector('[data-confirm-panel]');
        var type = options.type || 'info';
        var defaults = confirmDefaults[type] || confirmDefaults.info;
        var titleEl = backdrop.querySelector('#peso-confirm-title');
        var messageEl = backdrop.querySelector('#peso-confirm-message');
        var okBtn = backdrop.querySelector('[data-confirm-ok]');
        var cancelBtn = backdrop.querySelector('[data-confirm-cancel]');

        panel.className = 'peso-confirm peso-confirm--' + type;
        titleEl.textContent = options.title || defaults.title;
        messageEl.textContent = options.message || '';
        okBtn.textContent = options.ok || defaults.ok;
        cancelBtn.textContent = options.cancel || defaults.cancel;

        return new Promise(function (resolve) {
          function finish(result) {
            backdrop.hidden = true;
            document.body.style.overflow = '';
            okBtn.removeEventListener('click', onOk);
            cancelBtn.removeEventListener('click', onCancel);
            backdrop.removeEventListener('click', onBackdrop);
            document.removeEventListener('keydown', onKeydown);
            resolve(result);
          }

          function onOk() { finish(true); }
          function onCancel() { finish(false); }
          function onBackdrop(event) {
            if (event.target === backdrop) finish(false);
          }
          function onKeydown(event) {
            if (event.key === 'Escape') finish(false);
            if (event.key === 'Enter') finish(true);
          }

          okBtn.addEventListener('click', onOk);
          cancelBtn.addEventListener('click', onCancel);
          backdrop.addEventListener('click', onBackdrop);
          document.addEventListener('keydown', onKeydown);

          backdrop.hidden = false;
          document.body.style.overflow = 'hidden';
          cancelBtn.focus();
        });
      },
    };

    function bindAdminUi() {
      if (window.__pesoAdminUiBound) {
        syncAdminNav();
        return;
      }

      window.__pesoAdminUiBound = true;

      document.addEventListener('change', function (event) {
        var input = event.target.closest('[data-schedule-toggle]');
        if (!input) return;
        var target = document.getElementById(input.getAttribute('data-schedule-toggle'));
        if (target) target.hidden = !input.checked;
      });

      document.addEventListener('click', function (event) {
        var openTrigger = event.target.closest('[data-open-modal]');
        if (openTrigger) {
          var id = openTrigger.getAttribute('data-open-modal');
          var modal = document.getElementById(id);
          if (!modal) return;
          populateModalFromTrigger(openTrigger, modal);
          openModal(id);
          return;
        }

        var closeTrigger = event.target.closest('[data-close-modal]');
        if (closeTrigger) {
          closeModal(closeTrigger.closest('.admin-modal-backdrop'));
          return;
        }

        var backdrop = event.target.closest('.admin-modal-backdrop');
        if (backdrop && event.target === backdrop) {
          closeModal(backdrop);
          return;
        }

        var printTrigger = event.target.closest('[data-admin-print]');
        if (printTrigger) {
          window.print();
          return;
        }

        var editReferralTrigger = event.target.closest('[data-edit-referral-letter]');
        if (editReferralTrigger) {
          var preview = document.getElementById('modal-referral-preview');
          if (!preview) return;

          var data = {
            name: preview.querySelector('[data-modal-field="name"]')?.textContent || '',
            job: preview.querySelector('[data-modal-field="job"]')?.textContent || '',
            employer: preview.querySelector('[data-modal-field="employer"]')?.textContent || '',
          };

          closeModal(preview);

          if (typeof window.populateCreateReferralModal === 'function') {
            window.populateCreateReferralModal(data);
          }

          openModal('modal-create-referral');
        }
      });

      document.addEventListener('submit', function (event) {
        var form = event.target.closest('form[data-confirm]');
        if (!form) return;

        if (form.dataset.confirmed === '1') {
          delete form.dataset.confirmed;
          return;
        }

        event.preventDefault();

        window.PesoConfirm.show({
          type: form.getAttribute('data-confirm-type') || 'info',
          title: form.getAttribute('data-confirm-title') || '',
          message: form.getAttribute('data-confirm') || 'Continue with this action?',
          ok: form.getAttribute('data-confirm-ok') || '',
          cancel: form.getAttribute('data-confirm-cancel') || '',
        }).then(function (confirmed) {
          if (!confirmed) return;
          form.dataset.confirmed = '1';
          if (typeof form.requestSubmit === 'function') {
            form.requestSubmit();
          } else {
            form.submit();
          }
        });
      });

      syncAdminNav();
    }

    document.addEventListener('turbo:load', bindAdminUi);
    document.addEventListener('DOMContentLoaded', bindAdminUi);
  })();
</script>
