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
          if (el.tagName === 'INPUT' || el.tagName === 'TEXTAREA' || el.tagName === 'SELECT') {
            el.value = trigger.dataset[key];
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

    document.querySelectorAll('[data-schedule-toggle]').forEach(function (input) {
      input.addEventListener('change', function () {
        var target = document.getElementById(input.getAttribute('data-schedule-toggle'));
        if (target) target.hidden = !input.checked;
      });
    });

    document.querySelectorAll('[data-open-modal]').forEach(function (trigger) {
      trigger.addEventListener('click', function () {
        var id = trigger.getAttribute('data-open-modal');
        var modal = document.getElementById(id);
        if (!modal) return;
        populateModalFromTrigger(trigger, modal);
        openModal(id);
      });
    });

    document.querySelectorAll('[data-close-modal]').forEach(function (trigger) {
      trigger.addEventListener('click', function () {
        closeModal(trigger.closest('.admin-modal-backdrop'));
      });
    });

    document.querySelectorAll('.admin-modal-backdrop').forEach(function (backdrop) {
      backdrop.addEventListener('click', function (event) {
        if (event.target === backdrop) closeModal(backdrop);
      });
    });

    document.querySelectorAll('[data-admin-print]').forEach(function (trigger) {
      trigger.addEventListener('click', function () {
        window.print();
      });
    });

    document.querySelectorAll('[data-edit-referral-letter]').forEach(function (trigger) {
      trigger.addEventListener('click', function () {
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
      });
    });

    document.querySelectorAll('form[data-confirm]').forEach(function (form) {
      form.addEventListener('submit', function (event) {
        var message = form.getAttribute('data-confirm');
        if (message && !window.confirm(message)) {
          event.preventDefault();
        }
      });
    });
  })();
</script>
