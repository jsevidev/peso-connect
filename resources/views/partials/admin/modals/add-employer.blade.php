<div id="modal-add-employer" class="admin-modal-backdrop" role="dialog" aria-modal="true" aria-labelledby="modal-add-employer-title">
  <div class="admin-modal">
    <form action="{{ route('admin.employers.store') }}" method="POST">
      @csrf
      <div class="admin-modal__header">
        <div>
          <h2 id="modal-add-employer-title" class="admin-modal__title">Add Employer</h2>
          <p class="admin-modal__subtitle">Register an agency or company for job postings and referrals</p>
        </div>
        <button type="button" class="admin-modal__close" data-close-modal aria-label="Close">&times;</button>
      </div>
      <div class="admin-modal__body">
        <div class="admin-form-field">
          <label class="admin-field-label" for="employer_name">Company / Agency Name <span class="admin-field-required">*</span></label>
          <input class="admin-input" type="text" id="employer_name" name="name" placeholder="e.g., Department of Social Welfare and Development (DSWD)" required>
        </div>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
          <div class="admin-form-field">
            <label class="admin-field-label" for="employer_contact_person">Contact Person</label>
            <input class="admin-input" type="text" id="employer_contact_person" name="contact_person" placeholder="Hiring manager name">
          </div>
          <div class="admin-form-field">
            <label class="admin-field-label" for="employer_contact_email">Contact Email</label>
            <input class="admin-input" type="email" id="employer_contact_email" name="contact_email" placeholder="hr@company.com">
          </div>
        </div>
        <div class="admin-form-field">
          <label class="admin-field-label" for="employer_address">Address</label>
          <textarea class="admin-textarea" id="employer_address" name="address" rows="3" placeholder="Office address"></textarea>
        </div>
        <label class="admin-checkbox" style="display: flex; align-items: center; gap: 8px;">
          <input type="checkbox" name="peso_verified" value="1">
          <span>Mark as PESO verified partner</span>
        </label>
      </div>
      <div class="admin-modal__footer">
        <button type="button" class="admin-btn admin-btn--ghost" data-close-modal>Cancel</button>
        <button type="submit" class="admin-btn admin-btn--primary">Save Employer</button>
      </div>
    </form>
  </div>
</div>
