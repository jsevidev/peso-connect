<div id="modal-generate-report" class="admin-modal-backdrop" role="dialog" aria-modal="true" aria-labelledby="modal-generate-report-title">
  <div class="admin-modal">
    <form action="{{ route('admin.reports.export') }}" method="POST" data-turbo="false">
      @csrf
      <div class="admin-modal__header">
        <div>
          <h2 id="modal-generate-report-title" class="admin-modal__title">Generate Report</h2>
          <p class="admin-modal__subtitle">Download summary reports for enlistments, referrals, job postings, and FTJS certifications.</p>
        </div>
        <button type="button" class="admin-modal__close" data-close-modal aria-label="Close">&times;</button>
      </div>
      <div class="admin-modal__body">
        <div class="admin-form-field">
          <label class="admin-field-label" for="report_type">Report Type <span class="admin-field-required">*</span></label>
          <select class="admin-select" id="report_type" name="report_type" required>
            @foreach ($reportTypes as $type)
              <option value="{{ $type['value'] }}">{{ $type['label'] }}</option>
            @endforeach
          </select>
        </div>
        <div class="admin-form-field">
          <label class="admin-field-label" for="date_range">Date Range</label>
          <select class="admin-select" id="date_range" name="date_range">
            @foreach ($dateFilters as $filter)
              <option value="{{ $filter }}" @selected($filter === 'This Month')>{{ $filter }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="admin-modal__footer">
        <button type="button" class="admin-btn admin-btn--ghost" data-close-modal>Cancel</button>
        <button type="submit" class="admin-btn admin-btn--primary">Generate Report</button>
      </div>
    </form>
  </div>
</div>
