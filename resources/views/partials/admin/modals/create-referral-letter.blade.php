<div id="modal-create-referral" class="admin-modal-backdrop" role="dialog" aria-modal="true" aria-labelledby="modal-create-referral-title">
  <div class="admin-modal admin-modal--referral-letter">
    <form action="{{ route('admin.referrals.store') }}" method="POST" id="form-create-referral">
      @csrf
      <div class="admin-referral-letter-modal__header">
        <div>
          <h2 id="modal-create-referral-title" class="admin-referral-letter-modal__title">Create Referral Letter</h2>
          <p class="admin-referral-letter-modal__subtitle">Complete the fields in the letter below. The layout matches the official PESO Ozamiz referral format.</p>
        </div>
        <button type="button" class="admin-modal__close" data-close-modal aria-label="Close">&times;</button>
      </div>
      <div class="admin-referral-letter-modal__body">
        @include('partials.admin.referral-letter-official', [
          'letterMode' => 'form',
          'employers' => $employers ?? [],
          'enlistees' => $enlistees ?? [],
          'jobOptions' => $jobOptions ?? [],
        ])
      </div>
      <div class="admin-referral-letter-modal__footer">
        <button type="button" class="admin-btn admin-btn--text-cancel" data-close-modal>Cancel</button>
        <button type="submit" class="admin-btn admin-btn--primary" style="border-radius: 8px; padding: 10px 20px;">Save Letter</button>
      </div>
    </form>
  </div>
</div>

@push('scripts')
  @include('partials.admin.referral-letter-scripts')
@endpush
