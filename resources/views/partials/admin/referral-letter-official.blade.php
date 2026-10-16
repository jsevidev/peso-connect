@php
  $letterMode = $letterMode ?? 'view';
  $letter = $letter ?? \App\Support\ReferralLetter::compose();
  $isForm = $letterMode === 'form';
@endphp

<article class="peso-official-referral-letter" data-letter-root @if(($letterMode ?? 'view') === 'view') id="peso-official-referral-letter" @endif>
  <header class="peso-official-referral-letter__letterhead">
    <div class="peso-official-referral-letter__logos">
      @foreach ($letter['letterhead_logos'] as $logo)
        <div class="peso-official-referral-letter__logo-slot">
          <img
            src="{{ asset($logo['src']) }}"
            alt="{{ $logo['alt'] }}"
            class="peso-official-referral-letter__logo"
            loading="lazy"
            onerror="this.closest('.peso-official-referral-letter__logo-slot').classList.add('is-placeholder')"
          >
          <span class="peso-official-referral-letter__logo-fallback" aria-hidden="true">{{ $logo['alt'] }}</span>
        </div>
      @endforeach
    </div>
    <p class="peso-official-referral-letter__gov">Republic of the Philippines</p>
    <p class="peso-official-referral-letter__office">PUBLIC EMPLOYMENT SERVICE OFFICE</p>
    <p class="peso-official-referral-letter__office-sub">Office of the City Human Resource Management</p>
    <p class="peso-official-referral-letter__office-sub">City of Ozamiz</p>
  </header>

  <h2 class="peso-official-referral-letter__title">Referral Letter</h2>

  <div class="peso-official-referral-letter__body">
    <p class="peso-official-referral-letter__date">
      @if ($isForm)
        <input type="hidden" name="letter_date" value="{{ now()->toDateString() }}">
      @endif
      <span data-letter-field="date_display">{{ $letter['date_display'] }}</span>
    </p>

    @if ($isForm)
      <label class="peso-official-referral-letter__enlistee-label" for="referral_employer_id">Employer / company</label>
      <select class="peso-official-referral-letter__input peso-official-referral-letter__input--block" id="referral_employer_id" name="employer_id" required>
        <option value="" disabled selected>Select employer / company</option>
        @foreach (($employers ?? []) as $employer)
          <option
            value="{{ $employer['id'] }}"
            data-contact="{{ $employer['contact_person'] ?? '' }}"
            data-address="{{ $employer['address'] ?? '' }}"
            data-name="{{ $employer['name'] ?? '' }}"
          >{{ $employer['name'] }}</option>
        @endforeach
      </select>
      <label class="peso-official-referral-letter__enlistee-label" for="referral_applicant_id">Load profile from enlistee (optional)</label>
      <select class="peso-official-referral-letter__input peso-official-referral-letter__input--block" id="referral_applicant_id" name="applicant_id">
        <option value="">— Select enlistee —</option>
        @foreach (($enlistees ?? []) as $enlistee)
          <option
            value="{{ $enlistee['id'] }}"
            data-name="{{ $enlistee['name'] }}"
            data-birth="{{ $enlistee['birth_date'] ?? '' }}"
            data-address="{{ $enlistee['address'] ?? '' }}"
            data-phone="{{ $enlistee['contact'] ?? '' }}"
            data-email="{{ $enlistee['email'] ?? '' }}"
            data-education="{{ $enlistee['education'] ?? '' }}"
            data-skills="{{ $enlistee['skills'] ?? '' }}"
            data-gender="{{ $enlistee['gender'] ?? '' }}"
          >{{ $enlistee['name'] }}</option>
        @endforeach
      </select>
      <input type="hidden" name="gender" id="referral_gender" value="">
    @endif

    <div class="peso-official-referral-letter__address-block">
      @if ($isForm)
        <input type="hidden" name="recipient_name" id="referral_recipient_name" value="{{ old('recipient_name') }}">
        <p data-letter-field="recipient_name" id="referral_recipient_name_display" class="peso-official-referral-letter__recipient-name">—</p>
        <p class="peso-official-referral-letter__field-note">Filled from the selected employer’s contact person. Update it under Employer Management if needed.</p>
      @else
        <p data-letter-field="recipient_name" class="peso-official-referral-letter__recipient-name">{{ $letter['recipient_name'] }}</p>
      @endif
      <p data-letter-field="recipient_title">{{ $letter['recipient_title'] }}</p>
      @if ($isForm)
        <p data-letter-field="company" id="referral_company_mirror">{{ $letter['company'] ?: 'Company name' }}</p>
        <input class="peso-official-referral-letter__input peso-official-referral-letter__input--block" type="text" name="recipient_city" id="referral_recipient_city" placeholder="City" value="{{ old('recipient_city', $letter['city']) }}">
      @else
        <p data-letter-field="company">{{ $letter['company'] }}</p>
        <p data-letter-field="city">{{ $letter['city'] }}</p>
      @endif
    </div>

    <p class="peso-official-referral-letter__reference">
      REFERENCE: Your vacancy in the position:
      @if ($isForm)
        <select class="peso-official-referral-letter__input peso-official-referral-letter__input--inline" id="referral_job" name="job" required>
          <option value="" disabled selected>Choose job position</option>
          @foreach (($jobOptions ?? []) as $job)
            <option value="{{ is_array($job) ? $job['title'] : $job }}">{{ is_array($job) ? $job['title'] : $job }}</option>
          @endforeach
        </select>
      @else
        “<span data-letter-field="position">{{ $letter['position'] }}</span>”
      @endif
    </p>

    <p class="peso-official-referral-letter__salutation">Dear Sir/Ma’am:</p>

    @if ($isForm)
      <label class="peso-official-referral-letter__enlistee-label" for="referral_name">Jobseeker full name</label>
      <input class="peso-official-referral-letter__input peso-official-referral-letter__input--block" type="text" name="name" id="referral_name" placeholder="Full name of jobseeker" required>
    @endif

    <p class="peso-official-referral-letter__intro">
      <span data-letter-field="candidate_display">{{ $letter['candidate_display'] }}</span>
      is a registered jobseeker with the following profile:
    </p>

    <ul class="peso-official-referral-letter__profile">
      <li>
        <strong>Born:</strong>
        @if ($isForm)
          <input class="peso-official-referral-letter__input peso-official-referral-letter__input--inline" type="date" name="birth_date" id="referral_birth_date">
        @else
          <span data-letter-field="born">{{ $letter['born'] }}</span>
        @endif
      </li>
      <li>
        <strong>Address:</strong>
        @if ($isForm)
          <input class="peso-official-referral-letter__input peso-official-referral-letter__input--wide" type="text" name="address" id="referral_address" placeholder="Complete address">
        @else
          <span data-letter-field="address">{{ $letter['address'] }}</span>
        @endif
      </li>
      <li>
        <strong>Phone:</strong>
        @if ($isForm)
          <input class="peso-official-referral-letter__input peso-official-referral-letter__input--inline" type="text" name="phone" id="referral_phone" placeholder="Contact number">
        @else
          <span data-letter-field="phone">{{ $letter['phone'] }}</span>
        @endif
      </li>
      <li>
        <strong>Email Address:</strong>
        @if ($isForm)
          <input class="peso-official-referral-letter__input peso-official-referral-letter__input--wide" type="email" name="email" id="referral_email" placeholder="Email address">
        @else
          <span data-letter-field="email">{{ $letter['email'] }}</span>
        @endif
      </li>
      <li>
        <strong>Highest education:</strong>
        @if ($isForm)
          <input class="peso-official-referral-letter__input peso-official-referral-letter__input--wide" type="text" name="education" id="referral_education" placeholder="Highest attained education">
        @else
          <span data-letter-field="education">{{ $letter['education'] }}</span>
        @endif
      </li>
      <li>
        <strong>Special Skills:</strong>
        @if ($isForm)
          <input class="peso-official-referral-letter__input peso-official-referral-letter__input--wide" type="text" name="skills" id="referral_skills" placeholder="Skills (comma-separated)">
        @else
          <span data-letter-field="skills">{{ $letter['skills'] }}</span>
        @endif
      </li>
    </ul>

    <p class="peso-official-referral-letter__closing">
      We find <span data-letter-field="pronoun_possessive">{{ $letter['pronoun_possessive'] }}</span> profile matching the requirements of your vacancy in the above-mentioned position.
    </p>
    <p class="peso-official-referral-letter__closing">For your kind consideration.</p>
    <p class="peso-official-referral-letter__thanks">Thanks and regards,</p>

    <div class="peso-official-referral-letter__signatory">
      <p data-letter-field="signatory_name">{{ $letter['signatory_name'] }}</p>
      <p data-letter-field="signatory_title">{{ $letter['signatory_title'] }}</p>
    </div>
  </div>

  <footer class="peso-official-referral-letter__footer">
    <p><span class="peso-official-referral-letter__footer-icon" aria-hidden="true">☎</span> {{ $letter['footer']['telephone'] }}</p>
    <p>{{ $letter['footer']['mobile'] }}</p>
    <p><span class="peso-official-referral-letter__footer-icon" aria-hidden="true">✉</span> {{ $letter['footer']['email'] }}</p>
  </footer>
</article>
