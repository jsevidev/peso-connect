@php
  $certificate = $certificate ?? \App\Support\FtjsCertification::compose();
  $logos = $certificate['letterhead_logos'] ?? [];
  $leftLogos = isset($logos[0]) ? [$logos[0]] : [];
  $rightLogos = isset($logos[1]) ? [$logos[1]] : [];
@endphp

<article class="peso-official-ftjs-certification" data-letter-root id="peso-official-ftjs-certification">
  <header class="peso-official-ftjs-certification__letterhead">
    <div class="peso-official-ftjs-certification__letterhead-row">
      <div class="peso-official-ftjs-certification__logo-col peso-official-ftjs-certification__logo-col--left">
        @foreach ($leftLogos as $logo)
          <div class="peso-official-ftjs-certification__logo-slot">
            <img
              src="{{ asset($logo['src']) }}"
              alt="{{ $logo['alt'] }}"
              class="peso-official-ftjs-certification__logo"
              loading="lazy"
              onerror="this.closest('.peso-official-ftjs-certification__logo-slot').classList.add('is-placeholder')"
            >
            <span class="peso-official-ftjs-certification__logo-fallback" aria-hidden="true">{{ $logo['alt'] }}</span>
          </div>
        @endforeach
      </div>

      <div class="peso-official-ftjs-certification__letterhead-center">
        <p class="peso-official-ftjs-certification__gov">Republic of the Philippines</p>
        <p class="peso-official-ftjs-certification__office">PUBLIC EMPLOYMENT SERVICE OFFICE</p>
        <p class="peso-official-ftjs-certification__office-sub">Office of the City Human Resource Management</p>
        <p class="peso-official-ftjs-certification__office-sub">City of Ozamiz</p>
      </div>

      <div class="peso-official-ftjs-certification__logo-col peso-official-ftjs-certification__logo-col--right">
        @foreach ($rightLogos as $logo)
          <div class="peso-official-ftjs-certification__logo-slot">
            <img
              src="{{ asset($logo['src']) }}"
              alt="{{ $logo['alt'] }}"
              class="peso-official-ftjs-certification__logo"
              loading="lazy"
              onerror="this.closest('.peso-official-ftjs-certification__logo-slot').classList.add('is-placeholder')"
            >
            <span class="peso-official-ftjs-certification__logo-fallback" aria-hidden="true">{{ $logo['alt'] }}</span>
          </div>
        @endforeach
      </div>
    </div>
  </header>

  <div class="peso-official-ftjs-certification__rule" aria-hidden="true"></div>

  <div class="peso-official-ftjs-certification__page">
    <h2 class="peso-official-ftjs-certification__title" aria-label="CERTIFICATION">C E R T I F I C A T I O N</h2>

    <div class="peso-official-ftjs-certification__body">
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
        Date of Certification:
        <strong><span data-letter-field="certification_date_display">{{ $certificate['certification_date_display'] }}</span>/</strong>
        <span data-letter-field="city">{{ $certificate['city'] }}</span>
      </p>

      <p class="peso-official-ftjs-certification__paragraph peso-official-ftjs-certification__contact">
        {{ $certificate['contact_line'] }}
      </p>

      <div class="peso-official-ftjs-certification__signature-block">
        <p class="peso-official-ftjs-certification__signature-label">Sincerely,</p>
        <div class="peso-official-ftjs-certification__signature-space" aria-hidden="true"></div>
        <p class="peso-official-ftjs-certification__signatory-name" data-letter-field="signatory_name">{{ $certificate['signatory_name'] }}</p>
        <p class="peso-official-ftjs-certification__signatory-title" data-letter-field="signatory_title">{{ $certificate['signatory_title'] }}</p>
      </div>
    </div>

    <footer class="peso-official-ftjs-certification__footer">
      <p class="peso-official-ftjs-certification__footer-line">
        <span aria-hidden="true">☎</span> {{ $certificate['footer']['telephone'] }}&nbsp;&nbsp;&nbsp;{{ $certificate['footer']['mobile'] }}&nbsp;&nbsp;&nbsp;<span aria-hidden="true">✉</span> {{ $certificate['footer']['email'] }}
      </p>
    </footer>
  </div>
</article>
