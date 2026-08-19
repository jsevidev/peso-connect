@php
  $prefix = $prefix ?? 'announcement';
  $authorValue = $authorValue ?? '';
@endphp

<div class="admin-form-field">
  <label class="admin-field-label" for="{{ $prefix }}_title">Announcement Title <span class="admin-field-required">*</span></label>
  <input class="admin-input" type="text" id="{{ $prefix }}_title" name="title" data-modal-field="title" placeholder="e.g. Quezon City Mega Job Fair 2026" value="{{ $titleValue ?? '' }}" required>
</div>

<div class="admin-form-field">
  <label class="admin-field-label" for="{{ $prefix }}_excerpt">Announcement Body / Description <span class="admin-field-required">*</span></label>
  <textarea class="admin-textarea admin-textarea--announcement" id="{{ $prefix }}_excerpt" name="excerpt" rows="5" data-modal-field="excerpt" placeholder="Write the main description and information details of the announcement here. Mention dates, locations, requirements, and instructions for seekers..." required>{{ $excerptValue ?? '' }}</textarea>
</div>

<div class="admin-form-row-2">
  <div class="admin-form-field">
    <label class="admin-field-label" for="{{ $prefix }}_author">Author <span class="admin-field-required">*</span></label>
    <div class="admin-input-icon-wrap">
      <svg width="12" height="14" viewBox="0 0 11 14" fill="none" aria-hidden="true"><path d="M9.334 12V10.667C9.334 9.959 9.053 9.281 8.553 8.781 8.053 8.281 7.375 8 6.667 8H2.667C1.96 8 1.281 8.281 0.781 8.781 0.281 9.281 0 9.959 0 10.667V12M7.334 2.667C7.334 4.139 6.14 5.333 4.667 5.333 3.194 5.333 2 4.139 2 2.667 2 1.194 3.194 0 4.667 0 6.14 0 7.334 1.194 7.334 2.667Z" transform="translate(1.21 1.17)" stroke="#64748b" stroke-width="2" stroke-linecap="round"/></svg>
      <input class="admin-input admin-input--with-icon" type="text" id="{{ $prefix }}_author" name="author" data-modal-field="author" placeholder="e.g. Admin Maria Santos" value="{{ $authorValue }}" required>
    </div>
  </div>
  <div class="admin-form-field">
    <label class="admin-field-label" for="{{ $prefix }}_category">Category / Tags <span class="admin-field-required">*</span></label>
    <div class="admin-input-icon-wrap">
      <svg width="15" height="15" viewBox="0 0 15 15" fill="none" aria-hidden="true"><path d="M7.058 0.391C6.808 0.141 6.469 0 6.115 0H1.333C0.98 0 0.641 0.141 0.391 0.391 0.141 0.641 0 0.98 0 1.333V6.115C0 6.469 0.141 6.808 0.391 7.058L6.194 12.861C6.497 13.162 6.907 13.331 7.334 13.331 7.761 13.331 8.171 13.162 8.474 12.861L12.861 8.474C13.162 8.171 13.331 7.761 13.331 7.334 13.331 6.907 13.162 6.497 12.861 6.194L7.058 0.391ZM4 3.667C4 3.851 3.851 4 3.667 4 3.483 4 3.334 3.851 3.334 3.667 3.334 3.483 3.483 3.334 3.667 3.334 3.851 3.334 4 3.483 4 3.667Z" transform="translate(1.15 1.15)" stroke="#64748b" stroke-width="2" stroke-linecap="round"/></svg>
      <input class="admin-input admin-input--with-icon" type="text" id="{{ $prefix }}_category" name="category" data-modal-field="category" list="{{ $prefix }}_category_list" placeholder="e.g. Job Fair, Training, System" value="{{ $categoryValue ?? '' }}" required>
      <datalist id="{{ $prefix }}_category_list">
        @foreach (config('admin-content.announcement_categories', []) as $category)
          <option value="{{ $category }}"></option>
        @endforeach
      </datalist>
    </div>
  </div>
</div>

<div class="admin-form-row-2">
  <div class="admin-form-field">
    <label class="admin-field-label" for="{{ $prefix }}_status">Status <span class="admin-field-required">*</span></label>
    <select class="admin-select" id="{{ $prefix }}_status" name="status" data-modal-field="status" required>
      @foreach (config('admin-content.announcement_statuses', []) as $status)
        <option value="{{ $status }}" @selected(($statusValue ?? 'Published') === $status)>{{ $status }}</option>
      @endforeach
    </select>
  </div>
  <div class="admin-form-field">
    <label class="admin-field-label" for="{{ $prefix }}_publish_date">Publish Date <span class="admin-field-required">*</span></label>
    <div class="admin-input-icon-wrap">
      <svg width="14" height="15" viewBox="0 0 14 15" fill="none" aria-hidden="true"><path d="M3.333 0V2.667M8.667 0V2.667M0 5.334H12M1.333 1.333H10.667C11.403 1.333 12 1.93 12 2.667V12.001C12 12.737 11.403 13.334 10.667 13.334H1.333C0.597 13.334 0 12.737 0 12.001V2.667C0 1.93 0.597 1.333 1.333 1.333Z" transform="translate(1.17 1.15)" stroke="#64748b" stroke-width="2" stroke-linecap="round"/></svg>
      <input class="admin-input admin-input--with-icon" type="date" id="{{ $prefix }}_publish_date" name="publish_date" data-modal-field="publish-date" value="{{ $publishDateValue ?? '' }}" required>
    </div>
  </div>
</div>

<div class="admin-form-field">
  <label class="admin-field-label" for="{{ $prefix }}_schedule_later">Schedule for later</label>
  <div class="admin-schedule-toggle">
    <div class="admin-schedule-toggle__copy">
      <strong>Schedule for later</strong>
      <span>Set a future date and time to automatically publish this announcement.</span>
    </div>
    <label class="admin-toggle">
      <input type="checkbox" id="{{ $prefix }}_schedule_later" name="schedule_later" value="1" class="admin-toggle__input" data-schedule-toggle="{{ $prefix }}_schedule_fields">
      <span class="admin-toggle__track" aria-hidden="true"><span class="admin-toggle__thumb"></span></span>
    </label>
  </div>
</div>

<div class="admin-form-row-2 admin-schedule-fields" id="{{ $prefix }}_schedule_fields" hidden>
  <div class="admin-form-field">
    <label class="admin-field-label" for="{{ $prefix }}_scheduled_date">Scheduled Date</label>
    <div class="admin-input-icon-wrap">
      <svg width="14" height="15" viewBox="0 0 14 15" fill="none" aria-hidden="true"><path d="M3.333 0V2.667M8.667 0V2.667M0 5.334H12M1.333 1.333H10.667C11.403 1.333 12 1.93 12 2.667V12.001C12 12.737 11.403 13.334 10.667 13.334H1.333C0.597 13.334 0 12.737 0 12.001V2.667C0 1.93 0.597 1.333 1.333 1.333Z" transform="translate(1.17 1.15)" stroke="#64748b" stroke-width="2" stroke-linecap="round"/></svg>
      <input class="admin-input admin-input--with-icon" type="date" id="{{ $prefix }}_scheduled_date" name="scheduled_date">
    </div>
  </div>
  <div class="admin-form-field">
    <label class="admin-field-label" for="{{ $prefix }}_scheduled_time">Scheduled Time</label>
    <div class="admin-input-icon-wrap">
      <svg width="14" height="14" viewBox="0 0 14 14" fill="none" aria-hidden="true"><path d="M3.333 0V2.4M8.667 0V2.4M0 4.8H12M1.333 1.2H10.667C11.403 1.2 12 1.737 12 2.4V10.8C12 11.463 11.403 12 10.667 12H1.333C0.597 12 0 11.463 0 10.8V2.4C0 1.737 0.597 1.2 1.333 1.2Z" transform="translate(1.17 1.17)" stroke="#64748b" stroke-width="2" stroke-linecap="round"/></svg>
      <input class="admin-input admin-input--with-icon" type="time" id="{{ $prefix }}_scheduled_time" name="scheduled_time">
    </div>
  </div>
</div>

<div class="admin-announcement-info">
  <svg width="16" height="16" viewBox="0 0 15 15" fill="none" aria-hidden="true"><path d="M6.667 4V6.667M6.667 9.334H6.674M13.334 6.667C13.334 10.349 10.349 13.334 6.667 13.334 2.985 13.334 0 10.349 0 6.667 0 2.985 2.985 0 6.667 0 10.349 0 13.334 2.985 13.334 6.667Z" transform="translate(1.15 1.15)" stroke="#1b3a6b" stroke-width="2" stroke-linecap="round"/></svg>
  <p>You can publish now or schedule this announcement for a future date.</p>
</div>
