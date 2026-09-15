@php
  use App\Support\PublicJobListing;
  $salary = PublicJobListing::formatSalary($job);
  $postedLabel = PublicJobListing::postedLabel($job, 'active');
@endphp

<article class="public-landing-job-card">
  <div class="public-landing-job-card__head">
    <div class="public-landing-job-card__logo">
      <img src="https://placehold.co/48x48?text=company-logo" alt="{{ $job['company'] }} logo" width="48" height="48">
    </div>
    <div class="public-landing-job-card__meta">
      <h3 class="public-landing-job-card__title">{{ $job['title'] }}</h3>
      <p class="public-landing-job-card__company">{{ $job['company'] }}</p>
    </div>
  </div>

  <div class="public-landing-job-card__details">
    <div class="public-landing-job-card__detail">
      <svg width="16" height="16" viewBox="0 0 12.67 15.33" fill="none" aria-hidden="true"><path d="M10.6656 5.3338C10.6656 8.6628 6.9733 12.1298 5.7334 13.2006C5.6179 13.2874 5.4773 13.3344 5.3328 13.3344C5.1883 13.3344 5.0477 13.2874 4.9322 13.2006C3.6923 12.1298 0 8.6628 0 5.3338C0 3.9192 0.5618 2.5625 1.5619 1.5622C2.562 0.562 3.9185 0 5.3328 0C6.7471 0 8.1036 0.562 9.1037 1.5622C10.1038 2.5625 10.6656 3.9192 10.6656 5.3338ZM7.3326 5.3338C7.3326 6.4385 6.4373 7.334 5.3328 7.334C4.2283 7.334 3.333 6.4385 3.333 5.3338C3.333 4.2292 4.2283 3.3336 5.3328 3.3336C6.4373 3.3336 7.3326 4.2292 7.3326 5.3338Z" transform="translate(1.19 1.15)" stroke="#626f84" stroke-width="2" stroke-linecap="round"/></svg>
      <span>{{ $job['location'] }}</span>
    </div>
    <div class="public-landing-job-card__detail public-landing-job-card__detail--salary">
      <svg width="16" height="16" viewBox="0 0 15.33 10" fill="none" aria-hidden="true"><path d="M2.6669 4H2.6735M10.6675 4H10.6742M1.3334 0H12.001C12.7374 0 13.3344 0.597 13.3344 1.3333V6.6667C13.3344 7.403 12.7374 8 12.001 8H1.3334C0.597 8 0 7.403 0 6.6667V1.3333C0 0.597 0.597 0 1.3334 0ZM8.0006 4C8.0006 4.7364 7.4036 5.3333 6.6672 5.3333C5.9308 5.3333 5.3338 4.7364 5.3338 4C5.3338 3.2636 5.9308 2.6667 6.6672 2.6667C7.4036 2.6667 8.0006 3.2636 8.0006 4Z" transform="translate(1.15 1.25)" stroke="#2e7d32" stroke-width="2" stroke-linecap="round"/></svg>
      <span>{{ $salary }}</span>
    </div>
  </div>

  <div class="public-landing-job-card__tags">
    <span class="public-landing-job-card__tag">{{ $job['type'] }}</span>
    @if ($job['peso_verified'])
      <span class="public-landing-job-card__tag public-landing-job-card__tag--peso">Posted by PESO</span>
    @endif
  </div>

  <div class="public-landing-job-card__divider" aria-hidden="true"></div>

  <div class="public-landing-job-card__footer">
    <span class="public-landing-job-card__posted">{{ $postedLabel }}</span>
    <a href="{{ route('enlistment', ['job' => $job['id']]) }}" class="public-landing-job-card__cta">Enlist Now</a>
  </div>
</article>
