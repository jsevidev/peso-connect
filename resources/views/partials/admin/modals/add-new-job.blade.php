<div id="modal-add-job" class="admin-modal-backdrop" role="dialog" aria-modal="true" aria-labelledby="modal-add-job-title">
  <div class="admin-modal">
    <form action="{{ route('admin.jobs.store') }}" method="POST">
      @csrf
      <div class="admin-modal__header">
        <div>
          <h2 id="modal-add-job-title" class="admin-modal__title">Add New Job</h2>
          <p class="admin-modal__subtitle">Create and publish a new verified opportunity on PESO</p>
        </div>
        <button type="button" class="admin-modal__close" data-close-modal aria-label="Close">&times;</button>
      </div>
      <div class="admin-modal__body">
        <div class="admin-form-field">
          <label class="admin-field-label" for="job_title">Job Title <span class="admin-field-required">*</span></label>
          <input class="admin-input" type="text" id="job_title" name="title" placeholder="e.g., Administrative Assistant II" required>
        </div>
        <div class="admin-form-field">
          <label class="admin-field-label" for="job_company">Agency / Company Name <span class="admin-field-required">*</span></label>
          <input class="admin-input" type="text" id="job_company" name="company" placeholder="e.g., Department of Social Welfare and Development (DSWD)" required>
        </div>
        <div class="admin-form-field">
          <label class="admin-field-label" for="job_location">Location (City, Province) <span class="admin-field-required">*</span></label>
          <input class="admin-input" type="text" id="job_location" name="location" placeholder="e.g., Quezon City, Metro Manila" required>
        </div>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
          <div class="admin-form-field">
            <label class="admin-field-label" for="job_salary_min">Minimum Salary <span class="admin-field-required">*</span></label>
            <input class="admin-input" type="text" id="job_salary_min" name="salary_min" placeholder="₱ 18,000" required>
          </div>
          <div class="admin-form-field">
            <label class="admin-field-label" for="job_salary_max">Maximum Salary <span class="admin-field-required">*</span></label>
            <input class="admin-input" type="text" id="job_salary_max" name="salary_max" placeholder="₱ 22,000" required>
          </div>
        </div>
        <div class="admin-form-field">
          <label class="admin-field-label" for="job_type">Job Type <span class="admin-field-required">*</span></label>
          <select class="admin-select" id="job_type" name="type" required>
            @foreach (config('peso-options.job_types', []) as $type)
              <option value="{{ $type }}">{{ $type }}</option>
            @endforeach
          </select>
        </div>
        <div class="admin-form-field">
          <label class="admin-field-label" for="job_description">Job Description <span class="admin-field-required">*</span></label>
          <textarea class="admin-textarea" id="job_description" name="description" rows="4" placeholder="Describe key responsibilities, daily duties, and organizational scope..." required></textarea>
        </div>
      </div>
      <div class="admin-modal__footer">
        <button type="button" class="admin-btn admin-btn--ghost" data-close-modal>Cancel</button>
        <button type="submit" class="admin-btn admin-btn--primary">Post Job</button>
      </div>
    </form>
  </div>
</div>
