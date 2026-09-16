<div id="modal-edit-employer" class="admin-modal-backdrop" role="dialog" aria-modal="true" aria-labelledby="modal-edit-employer-title">
  <div class="admin-modal">
    <form action="{{ route('admin.employers.update') }}" method="POST">
      @csrf
      <input type="hidden" name="id" value="">
      <div class="admin-modal__header">
        <div>
          <h2 id="modal-edit-employer-title" class="admin-modal__title">Edit Employer</h2>
          <p class="admin-modal__subtitle">Update employer profile and verification status</p>
        </div>
        <button type="button" class="admin-modal__close" data-close-modal aria-label="Close">&times;</button>
      </div>
      <div class="admin-modal__body">
        <div class="admin-form-field">
          <label class="admin-field-label" for="edit_employer_name">Company / Agency Name</label>
          <input class="admin-input" type="text" id="edit_employer_name" name="name" data-modal-field="name" required>
        </div>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
          <div class="admin-form-field">
            <label class="admin-field-label" for="edit_employer_contact_person">Contact Person</label>
            <input class="admin-input" type="text" id="edit_employer_contact_person" name="contact_person" data-modal-field="contact-person">
          </div>
          <div class="admin-form-field">
            <label class="admin-field-label" for="edit_employer_contact_email">Contact Email</label>
            <input class="admin-input" type="email" id="edit_employer_contact_email" name="contact_email" data-modal-field="contact-email">
          </div>
        </div>
        <div class="admin-form-field">
          <label class="admin-field-label" for="edit_employer_address">Address</label>
          <textarea class="admin-textarea" id="edit_employer_address" name="address" rows="3" data-modal-field="address"></textarea>
        </div>
        <div class="admin-form-field">
          <label class="admin-field-label" for="edit_employer_status">Status</label>
          <select class="admin-select" id="edit_employer_status" name="status" data-modal-field="status">
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
          </select>
        </div>
        <label class="admin-checkbox" style="display: flex; align-items: center; gap: 8px;">
          <input type="checkbox" name="peso_verified" value="1" data-modal-field="peso-verified" data-modal-boolean="1">
          <span>Mark as PESO verified partner</span>
        </label>
      </div>
      <div class="admin-modal__footer">
        <button type="button" class="admin-btn admin-btn--ghost" data-close-modal>Cancel</button>
        <button type="submit" class="admin-btn admin-btn--primary">Save Changes</button>
      </div>
    </form>
  </div>
</div>
