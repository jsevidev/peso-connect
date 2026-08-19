<div id="modal-add-enlistee" class="admin-modal-backdrop" role="dialog" aria-modal="true" aria-labelledby="modal-add-enlistee-title">
  <div class="admin-modal">
    <form action="{{ route('admin.enlistees.store') }}" method="POST" id="form-add-enlistee">
      @csrf
      <div class="admin-modal__header">
        <div>
          <h2 id="modal-add-enlistee-title" class="admin-modal__title">Add New Enlistee</h2>
        </div>
        <button type="button" class="admin-modal__close" data-close-modal aria-label="Close">&times;</button>
      </div>
      <div class="admin-modal__body">
        <div class="admin-form-field">
          <label class="admin-field-label" for="enlistee_name">Full Name <span class="admin-field-required">*</span></label>
          <input class="admin-input" type="text" id="enlistee_name" name="name" placeholder="e.g. Maria Clara Santos" required>
        </div>
        <div class="admin-form-field">
          <label class="admin-field-label" for="enlistee_contact">Contact Number <span class="admin-field-required">*</span></label>
          <input class="admin-input" type="text" id="enlistee_contact" name="contact" placeholder="e.g. +63 917 123 4567" required>
        </div>
        <div class="admin-form-field">
          <label class="admin-field-label" for="enlistee_address">Address / Barangay <span class="admin-field-required">*</span></label>
          <input class="admin-input" type="text" id="enlistee_address" name="address" placeholder="e.g. Barangay 76, Pasay City, Metro Manila" required>
        </div>
        <div class="admin-form-field">
          <label class="admin-field-label" for="enlistee_skills_input">Skills <span class="admin-field-required">*</span></label>
          <input type="hidden" id="enlistee_skills" name="skills" value="Customer Service, Data Entry, MS Office">
          <div id="enlistee-skills-tags" class="admin-skill-tags"></div>
          <div class="admin-skill-input-wrap">
            <input type="text" id="enlistee_skills_input" class="admin-input" placeholder="Type and press enter to add skills..." autocomplete="off">
            <svg width="16" height="16" viewBox="0 0 10 10" fill="none" aria-hidden="true" style="flex-shrink: 0;">
              <path d="M0 4.0838H8.1676M4.0838 0V8.1676" transform="translate(1.24 1.24)" stroke="#64748b" stroke-width="2" stroke-linecap="round"/>
            </svg>
          </div>
        </div>
        <div class="admin-form-field">
          <label class="admin-field-label" for="enlistee_education">Highest Educational Attainment <span class="admin-field-required">*</span></label>
          <input class="admin-input" type="text" id="enlistee_education" name="education" placeholder="e.g. College (Bachelor's Degree)" required>
        </div>
      </div>
      <div class="admin-modal__footer">
        <button type="button" class="admin-btn admin-btn--ghost" data-close-modal>Cancel</button>
        <button type="submit" class="admin-btn admin-btn--primary">Save</button>
      </div>
    </form>
  </div>
</div>

@push('scripts')
<script>
  (function () {
    var hiddenInput = document.getElementById('enlistee_skills');
    var tagsContainer = document.getElementById('enlistee-skills-tags');
    var skillsInput = document.getElementById('enlistee_skills_input');
    var form = document.getElementById('form-add-enlistee');
    if (!hiddenInput || !tagsContainer || !skillsInput) return;

    var skills = (hiddenInput.value || '')
      .split(',')
      .map(function (s) { return s.trim(); })
      .filter(Boolean);

    function syncHidden() {
      hiddenInput.value = skills.join(', ');
    }

    function renderTags() {
      tagsContainer.innerHTML = '';
      skills.forEach(function (skill, index) {
        var tag = document.createElement('div');
        tag.className = 'admin-skill-tag';
        tag.innerHTML =
          '<span class="admin-skill-tag__label">' + skill + '</span>' +
          '<button type="button" class="admin-skill-tag__remove" aria-label="Remove ' + skill + '">' +
          '<svg width="12" height="12" viewBox="0 0 10 10" fill="none" aria-hidden="true">' +
          '<path d="M5.2 2.8L2.8 5.2M2.8 2.8L5.2 5.2M8 4C8 6.21 6.21 8 4 8 1.79 8 0 6.21 0 4 0 1.79 1.79 0 4 0 6.21 0 8 1.79 8 4Z" transform="translate(0.89 0.89)" stroke="#1b3a6b" stroke-width="1.5" stroke-linecap="round"></path>' +
          '</svg></button>';
        tag.querySelector('button').addEventListener('click', function () {
          skills.splice(index, 1);
          syncHidden();
          renderTags();
        });
        tagsContainer.appendChild(tag);
      });
    }

    function addSkill(value) {
      var skill = value.trim();
      if (!skill || skills.indexOf(skill) !== -1) return;
      skills.push(skill);
      syncHidden();
      renderTags();
    }

    skillsInput.addEventListener('keydown', function (event) {
      if (event.key !== 'Enter') return;
      event.preventDefault();
      addSkill(skillsInput.value);
      skillsInput.value = '';
    });

    if (form) {
      form.addEventListener('submit', function (event) {
        if (skills.length === 0) {
          event.preventDefault();
          skillsInput.focus();
        }
      });
    }

    renderTags();
  })();
</script>
@endpush
