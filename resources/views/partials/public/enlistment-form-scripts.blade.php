<script>
  (function () {
    function parseSkillsCsv(value) {
      return (value || '')
        .split(',')
        .map(function (s) { return s.trim(); })
        .filter(Boolean);
    }

    function hasSkill(skills, skill) {
      var lower = skill.toLowerCase();
      return skills.some(function (existing) {
        return existing.toLowerCase() === lower;
      });
    }

    function bindEnlistmentSkillsRoot(root) {
      if (!root || root.dataset.bound === '1') return;

      var prefix = root.getAttribute('data-enlistment-prefix') || 'enlistment';
      var hiddenInput = document.getElementById(prefix + '_skills');
      var tagsContainer = root.querySelector('[data-enlistment-skills-tags]');
      var skillsInput = root.querySelector('[data-enlistment-skills-input]');
      var addButton = root.querySelector('[data-enlistment-skills-add]');
      var form = root.closest('form');
      if (!hiddenInput || !tagsContainer || !skillsInput || !addButton) return;

      root.dataset.bound = '1';

      var skills = parseSkillsCsv(hiddenInput.value);

      function syncHidden() {
        hiddenInput.value = skills.join(', ');
      }

      function renderTags() {
        tagsContainer.innerHTML = '';
        skills.forEach(function (skill, index) {
          var tag = document.createElement('div');
          tag.style.cssText = 'border-radius:6px;background-color:#eef4f8;display:flex;align-items:center;grid-column-gap:6px;padding:6px 12px;';
          tag.innerHTML =
            '<span class="text" style="font-size:12px;font-family:Inter,system-ui,sans-serif;font-weight:700;text-transform:uppercase;color:#1b3a6b;">' +
            skill +
            '</span>' +
            '<button type="button" aria-label="Remove ' + skill + '" style="border:none;background:transparent;padding:0;cursor:pointer;display:flex;align-items:center;">' +
            '<svg width="12" height="12" viewBox="0 0 10 10" fill="none" aria-hidden="true"><path d="M5.2 2.8L2.8 5.2M2.8 2.8L5.2 5.2M8 4C8 6.21 6.21 8 4 8 1.79 8 0 6.21 0 4 0 1.79 1.79 0 4 0 6.21 0 8 1.79 8 4Z" transform="translate(0.89 0.89)" style="stroke:#1b3a6b;stroke-width:1.5;stroke-linecap:round;"></path></svg>' +
            '</button>';
          tag.querySelector('button').addEventListener('click', function () {
            skills.splice(index, 1);
            syncHidden();
            renderTags();
          });
          tagsContainer.appendChild(tag);
        });
      }

      function commitSkillInput() {
        var raw = skillsInput.value.trim();
        if (!raw) return;

        raw.split(',').forEach(function (part) {
          var skill = part.trim();
          if (!skill || hasSkill(skills, skill)) return;
          skills.push(skill);
        });

        skillsInput.value = '';
        syncHidden();
        renderTags();
      }

      skillsInput.addEventListener('keydown', function (event) {
        if (event.key !== 'Enter') return;
        event.preventDefault();
        commitSkillInput();
      });

      addButton.addEventListener('click', function () {
        commitSkillInput();
        skillsInput.focus();
      });

      if (form) {
        form.addEventListener('submit', function (event) {
          commitSkillInput();
          if (skills.length > 0) return;

          event.preventDefault();
          event.stopImmediatePropagation();

          if (window.PesoAlert) {
            window.PesoAlert.show({
              type: 'warning',
              title: 'Add at least one skill',
              message: 'Type a skill and press Enter or the + button to add it before submitting.',
              ok: 'Got it',
            }).then(function () {
              skillsInput.focus();
            });
          } else {
            skillsInput.focus();
          }
        }, true);
      }

      syncHidden();
      renderTags();
    }

    function initEnlistmentSkills() {
      document.querySelectorAll('[data-enlistment-skills-root]').forEach(bindEnlistmentSkillsRoot);
    }

    function getEnlistModal() {
      return document.getElementById('modal-enlist-now');
    }

    function openEnlistModal(options) {
      options = options || {};
      var modal = getEnlistModal();
      if (!modal) {
        window.location.href = options.fallbackUrl || '/enlistment';
        return;
      }

      var select = document.getElementById('enlist_modal_job_position');
      if (select && options.jobTitle) {
        select.value = options.jobTitle;
        if (select.value !== options.jobTitle) {
          Array.prototype.forEach.call(select.options, function (option) {
            if (option.textContent.trim() === options.jobTitle) option.selected = true;
          });
        }
      }

      modal.hidden = false;
      document.body.classList.add('public-enlist-modal-open');
      document.body.style.overflow = 'hidden';

      var firstField = document.getElementById('enlist_modal_full_name');
      if (firstField && !options.jobTitle) firstField.focus();
    }

    function closeEnlistModal() {
      var modal = getEnlistModal();
      if (!modal) return;
      modal.hidden = true;
      document.body.classList.remove('public-enlist-modal-open');
      document.body.style.overflow = '';
    }

    window.openEnlistModal = openEnlistModal;
    window.closeEnlistModal = closeEnlistModal;

    function bindEnlistModalUi() {
      var modal = getEnlistModal();
      if (!modal || modal.dataset.bound === '1') return;
      modal.dataset.bound = '1';

      modal.addEventListener('click', function (event) {
        if (event.target === modal) closeEnlistModal();
      });

      modal.querySelectorAll('[data-close-enlist-modal]').forEach(function (button) {
        button.addEventListener('click', closeEnlistModal);
      });

      if (!window.__pesoEnlistModalKeydownBound) {
        window.__pesoEnlistModalKeydownBound = true;
        document.addEventListener('keydown', function (event) {
          var enlistModal = getEnlistModal();
          if (event.key === 'Escape' && enlistModal && !enlistModal.hidden) closeEnlistModal();
        });
      }
    }

    function bindEnlistTriggers() {
      if (window.__pesoEnlistTriggersBound) return;
      window.__pesoEnlistTriggersBound = true;

      document.addEventListener('click', function (event) {
        var trigger = event.target.closest('[data-open-enlist-modal]');
        if (!trigger) return;
        event.preventDefault();
        openEnlistModal({
          jobTitle: trigger.getAttribute('data-job-title') || '',
          fallbackUrl: trigger.getAttribute('href') || '/enlistment',
        });
      });
    }

    function maybeAutoOpenEnlistModal() {
      var body = document.body;
      if (body && body.getAttribute('data-open-enlist-modal') === '1') {
        openEnlistModal({ jobTitle: body.getAttribute('data-enlist-job-title') || '' });
        body.removeAttribute('data-open-enlist-modal');
      }
    }

    function bootstrapEnlistUi() {
      initEnlistmentSkills();
      bindEnlistModalUi();
      bindEnlistTriggers();
      maybeAutoOpenEnlistModal();
    }

    document.addEventListener('DOMContentLoaded', bootstrapEnlistUi);
    document.addEventListener('turbo:load', bootstrapEnlistUi);
    document.addEventListener('turbo:render', initEnlistmentSkills);
  })();
</script>
