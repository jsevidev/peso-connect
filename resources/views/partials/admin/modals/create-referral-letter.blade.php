<div id="modal-create-referral" class="admin-modal-backdrop" role="dialog" aria-modal="true" aria-labelledby="modal-create-referral-title">
  <div class="admin-modal admin-modal--referral-letter">
    <form action="{{ route('admin.referrals.store') }}" method="POST" id="form-create-referral">
      @csrf
      <div class="admin-referral-letter-modal__header">
        <div>
          <h2 id="modal-create-referral-title" class="admin-referral-letter-modal__title">Create Referral Letter</h2>
          <p class="admin-referral-letter-modal__subtitle">Fill in the highlighted fields to generate an endorsement letter</p>
        </div>
        <button type="button" class="admin-modal__close" data-close-modal aria-label="Close">&times;</button>
      </div>
      <div class="admin-referral-letter-modal__body">
        <div class="admin-referral-letter">
          <div class="admin-referral-letter__masthead">
            <small>Republic of the Philippines</small>
            <strong>PUBLIC EMPLOYMENT SERVICE OFFICE</strong>
            <span>PESO Ozamiz</span>
          </div>
          <hr class="admin-referral-letter__divider">
          <div class="admin-referral-letter__meta">
            <span>{{ now()->format('M j, Y') }}</span>
            <span class="admin-referral-letter__meta-label">HIRING MANAGER</span>
            <input class="admin-referral-letter__field" type="text" id="referral_employer" name="employer" placeholder="Company Name" required>
          </div>
          <div class="admin-referral-letter__subject">
            <span>Subject: Endorsement of</span>
            <input class="admin-referral-letter__field admin-referral-letter__field--inline" type="text" id="referral_name" name="name" placeholder="Full name" required>
          </div>
          <div class="admin-referral-letter__paragraph admin-referral-letter__paragraph--inline">
            <span>This is to formally endorse</span>
            <strong id="referral_name_mirror">Full name</strong>
            <span>for the position of</span>
            <select class="admin-referral-letter__field admin-referral-letter__field--inline admin-referral-letter__field--select" id="referral_job" name="job" required>
              <option value="" disabled selected>Choose Job</option>
              @foreach (config('admin-content.admin_jobs', []) as $job)
                <option value="{{ $job['title'] }}">{{ $job['title'] }}</option>
              @endforeach
            </select>
            <span>.</span>
          </div>
          <p class="admin-referral-letter__paragraph">He has successfully undergone our screening process and is deemed highly qualified for your workforce needs.</p>
          <p class="admin-referral-letter__paragraph">We look forward to a successful placement partnership.</p>
          <div class="admin-referral-letter__signoff">
            <span>Sincerely,</span>
            <strong>Maria Clara Santos</strong>
            <small>PESO Ozamiz Staff</small>
          </div>
        </div>
      </div>
      <div class="admin-referral-letter-modal__footer">
        <button type="button" class="admin-btn admin-btn--text-cancel" data-close-modal>Cancel</button>
        <button type="submit" class="admin-btn admin-btn--primary" style="border-radius: 8px; padding: 10px 20px;">Save Letter</button>
      </div>
    </form>
  </div>
</div>

@push('scripts')
<script>
  (function () {
    var nameInput = document.getElementById('referral_name');
    var mirror = document.getElementById('referral_name_mirror');
    if (!nameInput || !mirror) return;

    function syncName() {
      mirror.textContent = nameInput.value.trim() || 'Full name';
    }

    nameInput.addEventListener('input', syncName);
    syncName();

    window.populateCreateReferralModal = function (data) {
      if (data.name && nameInput) {
        nameInput.value = data.name;
        syncName();
      }
      var employerInput = document.getElementById('referral_employer');
      var jobSelect = document.getElementById('referral_job');
      if (employerInput && data.employer) employerInput.value = data.employer;
      if (jobSelect && data.job) jobSelect.value = data.job;
    };
  })();
</script>
@endpush
