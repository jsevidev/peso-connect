@php
  $certificate = $certificate ?? \App\Support\FtjsCertification::compose();
@endphp

<article class="peso-official-referral-letter peso-official-ftjs-certification" data-letter-root id="peso-official-ftjs-certification">
  <header class="peso-official-referral-letter__letterhead peso-official-ftjs-certification__letterhead">
    <div class="peso-official-referral-letter__logos">
      @foreach ($certificate['letterhead_logos'] as $logo)
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

  <div class="peso-official-ftjs-certification__rule" aria-hidden="true"></div>

  <h2 class="peso-official-ftjs-certification__title">CERTIFICATION</h2>

  <div class="peso-official-referral-letter__body peso-official-ftjs-certification__body">
    <p class="peso-official-ftjs-certification__salutation">To Whom It May Concern:</p>

    <p class="peso-official-ftjs-certification__paragraph">
      This is to certify that the bearer, <strong data-letter-field="bearer_name">{{ $certificate['bearer_name'] }}</strong>
      is officially registered as a first-time job seeker in our office. As per the provisions of the law, is eligible to avail
      the benefits and privileges offered for first-time job seekers in relation to their pre-employment requirements charges.
    </p>

    <p class="peso-official-ftjs-certification__paragraph">
      We confirm that <span data-letter-field="confirm_name">{{ $certificate['confirm_name'] }}</span> fulfilled the necessary
      criteria to be classified as a first-time job seeker, as stipulated by the relevant regulations.
      <span data-letter-field="pronoun_subject">{{ $certificate['pronoun_subject'] }}</span> has not been previously employed
      in any formal capacity and is seeking employment for the first time.
    </p>

    <p class="peso-official-ftjs-certification__paragraph">
      This certification is being issued in accordance with the laws and regulations governing first-time job seekers,
      and it is valid as of the date mentioned below.
    </p>

    <p class="peso-official-ftjs-certification__date-line">
      <strong>Date of Certification: <span data-letter-field="certification_date_display">{{ $certificate['certification_date_display'] }}</span>/
      <span data-letter-field="city">{{ $certificate['city'] }}</span></strong>
    </p>

    <p class="peso-official-ftjs-certification__paragraph">
      {{ $certificate['contact_line'] }}
    </p>

    <div class="peso-official-ftjs-certification__signature-row">
      <div class="peso-official-ftjs-certification__signature-block">
        <p class="peso-official-ftjs-certification__signature-label">Sincerely,</p>
        <div class="peso-official-ftjs-certification__signature-space" aria-hidden="true"></div>
        <p class="peso-official-ftjs-certification__signatory-name" data-letter-field="signatory_name">{{ $certificate['signatory_name'] }}</p>
        <p data-letter-field="signatory_title">{{ $certificate['signatory_title'] }}</p>
      </div>
      <div class="peso-official-ftjs-certification__signature-block peso-official-ftjs-certification__signature-block--received">
        <p class="peso-official-ftjs-certification__signature-label">Received:</p>
        <div class="peso-official-ftjs-certification__signature-space" aria-hidden="true"></div>
        <p class="peso-official-ftjs-certification__received-date" data-letter-field="certification_date_short">{{ $certificate['certification_date_short'] }}</p>
      </div>
    </div>
  </div>

  <footer class="peso-official-referral-letter__footer">
    <p><span class="peso-official-referral-letter__footer-icon" aria-hidden="true">☎</span> {{ $certificate['footer']['telephone'] }}</p>
    <p>{{ $certificate['footer']['mobile'] }}</p>
    <p><span class="peso-official-referral-letter__footer-icon" aria-hidden="true">✉</span> {{ $certificate['footer']['email'] }}</p>
  </footer>
</article>
