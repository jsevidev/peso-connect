<div id="modal-edit-job" class="admin-modal-backdrop" role="dialog" aria-modal="true" aria-labelledby="modal-edit-job-title">
  <div class="admin-modal">
    <form action="{{ route('admin.jobs.update') }}" method="POST">
      @csrf
      <input type="hidden" name="id" value="">
      <div class="admin-modal__header">
        <div>
          <h2 id="modal-edit-job-title" class="admin-modal__title">Edit Job</h2>
          <p class="admin-modal__subtitle">Update job listing details</p>
        </div>
        <button type="button" class="admin-modal__close" data-close-modal aria-label="Close">&times;</button>
      </div>
      <div class="admin-modal__body">
        <div class="admin-form-field">
          <label class="admin-field-label" for="edit_job_title">Job Title</label>
          <input class="admin-input" type="text" id="edit_job_title" name="title" data-modal-field="title" required>
        </div>
        <div class="admin-form-field">
          <label class="admin-field-label" for="edit_job_company">Agency / Company</label>
          <input class="admin-input" type="text" id="edit_job_company" name="company" data-modal-field="company" required>
        </div>
        <div class="admin-form-field">
          <label class="admin-field-label" for="edit_job_type">Job Type</label>
          <select class="admin-select" id="edit_job_type" name="type" data-modal-field="type">
            @foreach (config('admin-content.job_types', []) as $type)
              <option value="{{ $type }}">{{ $type }}</option>
            @endforeach
          </select>
        </div>
        <div class="admin-form-field">
          <label class="admin-field-label" for="edit_job_status">Status</label>
          <select class="admin-select" id="edit_job_status" name="status" data-modal-field="status">
            @foreach (config('admin-content.job_statuses', []) as $status)
              <option value="{{ $status }}">{{ $status }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="admin-modal__footer">
        <button type="button" class="admin-btn admin-btn--ghost" data-close-modal>Cancel</button>
        <button type="submit" class="admin-btn admin-btn--primary">Save Changes</button>
      </div>
    </form>
  </div>
</div>
