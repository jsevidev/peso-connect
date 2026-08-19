<div id="modal-referral-preview" class="admin-modal-backdrop" role="dialog" aria-modal="true" aria-labelledby="modal-referral-preview-title">
  <div class="admin-modal admin-modal--referral-preview">
    <div class="admin-referral-preview">
      <div class="admin-referral-preview__header">
        <div class="admin-referral-preview__title-wrap">
          <svg width="16" height="16" viewBox="0 0 13 16" fill="none" aria-hidden="true">
            <path d="M6.666 0H1.333C0.98 0 0.641 0.141 0.391 0.391 0.141 0.641 0 0.98 0 1.333V12.001C0 12.355 0.141 12.694 0.391 12.944 0.641 13.194 0.98 13.334 1.333 13.334H9.332C9.686 13.334 10.025 13.194 10.275 12.944 10.525 12.694 10.666 12.355 10.666 12.001V4.000M3.999 4.667H2.666M7.999 7.334H2.666M7.999 10.001H2.666" transform="translate(1.19 1.15)" stroke="#f57c00" stroke-width="2" stroke-linecap="round"/>
          </svg>
          <h2 id="modal-referral-preview-title" class="admin-referral-preview__title">Referral Preview</h2>
        </div>
        <span class="admin-referral-preview__badge">DRAFT</span>
      </div>
      <p class="admin-referral-preview__desc">Confirm and review the auto-generated PESO endorsement letter before sending or printing.</p>

      <div class="admin-referral-letter admin-referral-letter--preview">
        <div class="admin-referral-letter__masthead">
          <small>Republic of the Philippines</small>
          <strong>PUBLIC EMPLOYMENT SERVICE OFFICE</strong>
          <span>PESO Ozamiz</span>
        </div>
        <hr class="admin-referral-letter__divider admin-referral-letter__divider--light">
        <div class="admin-referral-letter__meta">
          <span data-modal-field="date">Oct 25, 2024</span>
          <span class="admin-referral-letter__meta-label">HIRING MANAGER</span>
          <span data-modal-field="employer" style="color: #5a6e85;">Company Name</span>
        </div>
        <p class="admin-referral-letter__paragraph admin-referral-letter__paragraph--preview" style="font-weight: 700;" data-modal-field="subject">Subject: Endorsement of Juanito dela Cruz</p>
        <p class="admin-referral-letter__paragraph admin-referral-letter__paragraph--preview">
          This is to formally endorse <strong data-modal-field="name">Juanito dela Cruz</strong> for the position of <strong data-modal-field="job">Production Engineer</strong>. He has successfully undergone our screening process and is deemed highly qualified for your workforce needs.
        </p>
        <p class="admin-referral-letter__paragraph admin-referral-letter__paragraph--preview">We look forward to a successful placement partnership.</p>
        <div class="admin-referral-letter__signoff">
          <small>Sincerely,</small>
          <strong>Maria Clara Santos</strong>
          <small>PESO Ozamiz Staff</small>
        </div>
      </div>

      <div class="admin-referral-preview__actions">
        <form action="{{ route('admin.referrals.approve') }}" method="POST">
          @csrf
          <input type="hidden" name="id" value="">
          <input type="hidden" name="name" value="">
          <button type="submit" class="admin-btn admin-btn--primary admin-btn--letter-primary">Approve Letter</button>
        </form>
        <div class="admin-referral-preview__actions-row">
          <button type="button" class="admin-btn admin-btn--letter-secondary" data-edit-referral-letter>Edit Letter Content</button>
          <button type="button" class="admin-btn admin-btn--letter-secondary" data-admin-print>
            <svg width="16" height="16" viewBox="0 0 15 15" fill="none" aria-hidden="true">
              <path d="M2.667 10.668H1.333C0.98 10.668 0.641 10.527 0.391 10.277 0.141 10.026 0 9.687 0 9.334V6.001C0 5.647 0.141 5.308 0.391 5.058 0.641 4.808 0.98 4.668 1.333 4.668H12.001C12.355 4.668 12.694 4.808 12.944 5.058 13.194 5.308 13.334 5.647 13.334 6.001V9.334C13.334 9.688 13.194 10.027 12.944 10.277 12.694 10.527 12.355 10.668 12.001 10.668H10.668M2.667 4.668V0.667C2.667 0.49 2.737 0.32 2.862 0.195 2.987 0.07 3.157 0 3.334 0H10.001C10.178 0 10.347 0.07 10.472 0.195 10.597 0.32 10.668 0.49 10.668 0.667V4.668M3.334 8.001H10.001C10.369 8.001 10.668 8.299 10.668 8.667V12.668C10.668 13.036 10.369 13.334 10.001 13.334H3.334C2.966 13.334 2.667 13.036 2.667 12.668V8.667C2.667 8.299 2.966 8.001 3.334 8.001Z" transform="translate(1.15 1.15)" stroke="#1c2d42" stroke-width="2" stroke-linecap="round"/>
            </svg>
            Print
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
