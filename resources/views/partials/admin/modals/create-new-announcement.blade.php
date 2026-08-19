<div id="modal-create-announcement" class="admin-modal-backdrop" role="dialog" aria-modal="true" aria-labelledby="modal-create-announcement-title">
  <div class="admin-modal admin-modal--announcement">
    <form action="{{ route('admin.announcements.store') }}" method="POST">
      @csrf
      <div class="admin-modal__header">
        <div>
          <h2 id="modal-create-announcement-title" class="admin-modal__title">Create New Announcement</h2>
          <p class="admin-modal__subtitle">Fill in the details below to broadcast a new announcement to seekers.</p>
        </div>
        <button type="button" class="admin-modal__close admin-modal__close--icon" data-close-modal aria-label="Close">
          <svg width="16" height="16" viewBox="0 0 15 15" fill="none" aria-hidden="true"><path d="M8.667 4.667L4.667 8.667M4.667 4.667L8.667 8.667M13.334 6.667C13.334 10.349 10.349 13.334 6.667 13.334 2.985 13.334 0 10.349 0 6.667 0 2.985 2.985 0 6.667 0 10.349 0 13.334 2.985 13.334 6.667Z" transform="translate(1.15 1.15)" stroke="#0f172a" stroke-width="2" stroke-linecap="round"/></svg>
        </button>
      </div>
      <div class="admin-modal__body">
        @include('partials.admin.modals.announcement-form-fields', ['prefix' => 'create'])
      </div>
      <div class="admin-modal__footer admin-modal__footer--single">
        <button type="submit" class="admin-btn admin-btn--primary admin-btn--publish">
          <svg width="12" height="9" viewBox="0 0 11 8" fill="none" aria-hidden="true"><path d="M9.332 0L2.916 6.416 0 3.5" transform="translate(1.21 1.31)" stroke="#fff" stroke-width="2" stroke-linecap="round"/></svg>
          Publish Announcement
        </button>
      </div>
    </form>
  </div>
</div>
