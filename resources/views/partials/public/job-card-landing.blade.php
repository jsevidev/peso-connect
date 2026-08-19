@php
  use App\Support\PublicJobListing;
  $salary = PublicJobListing::formatSalary($job);
  $postedLabel = PublicJobListing::postedLabel($job, 'active');
@endphp

<div class="public-card" style="border-width: 1px;border-style: solid;border-color: #e2e8f0;border-radius: 20px;background-color: #fff;display: flex;flex-direction: column;row-gap: 20px;align-items: start;justify-content: flex-start;width: 411px;position: relative;filter: drop-shadow(0px 8px 16px rgba(0,0,0,0.02));flex-shrink: 0;padding: 24px;">
  <div style="display: flex;flex-direction: row;grid-column-gap: 16px;align-items: center;justify-content: flex-start;width: 100%;position: relative;flex-shrink: 0;">
    <div style="overflow: hidden;border-radius: 12px;display: flex;flex-direction: row;grid-column-gap: 0px;align-items: start;justify-content: flex-start;width: 48px;height: 48px;position: relative;flex-shrink: 0;"><img src="https://placehold.co/48x48?text=company-logo" alt="{{ $job['company'] }} logo" style="inset: 0;width: 100%;height: 100%;position: absolute;object-fit: cover;"></div>
    <div style="display: flex;flex-direction: column;row-gap: 4px;align-items: start;justify-content: flex-start;width: 100%;position: relative;flex-grow: 1;flex-basis: 0px;">
      <span class="text" style="display: inline;text-align: left;font-size: 16px;font-family: Inter, system-ui, sans-serif;font-weight: 700;color: #1a253c;width: 100%;">{{ $job['title'] }}</span>
      <span class="text" style="display: inline;text-align: left;font-size: 14px;font-family: Inter, system-ui, sans-serif;font-weight: 400;color: #626f84;width: 100%;">{{ $job['company'] }}</span>
    </div>
  </div>
  <div style="display: flex;flex-direction: column;row-gap: 8px;align-items: start;justify-content: flex-start;width: 100%;position: relative;flex-shrink: 0;">
    <div style="display: flex;flex-direction: row;grid-column-gap: 8px;align-items: center;justify-content: flex-start;width: 100%;">
      <svg width="16" height="16" viewBox="0 0 12.665599822998047 15.334400177001955" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" style="flex-shrink:0;"><path d="M10.6656 5.3338C10.6656 8.6628 6.9733 12.1298 5.7334 13.2006 5.6179 13.2874 5.4773 13.3344 5.3328 13.3344 5.1883 13.3344 5.0477 13.2874 4.9322 13.2006 3.6923 12.1298 0 8.6628 0 5.3338 0 3.9192 0.5618 2.5625 1.5619 1.5622 2.562 0.562 3.9185 0 5.3328 0 6.7471 0 8.1036 0.562 9.1037 1.5622 10.1038 2.5625 10.6656 3.9192 10.6656 5.3338ZM7.3326 5.3338C7.3326 6.4385 6.4373 7.334 5.3328 7.334 4.2283 7.334 3.333 6.4385 3.333 5.3338 3.333 4.2292 4.2283 3.3336 5.3328 3.3336 6.4373 3.3336 7.3326 4.2292 7.3326 5.3338Z" transform="translate(1.1875187549871726 1.1499879989689699)" style="stroke: #626f84;stroke-width: 2;stroke-linecap: round;"></path></svg>
      <span class="text" style="font-size: 14px;font-family: Inter, system-ui, sans-serif;color: #626f84;">{{ $job['location'] }}</span>
    </div>
    <div style="display: flex;flex-direction: row;grid-column-gap: 8px;align-items: center;justify-content: flex-start;width: 100%;">
      <svg width="16" height="16" viewBox="0 0 15.334400177001955 10" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" style="flex-shrink:0;"><path d="M2.6669 4H2.6735M10.6675 4H10.6742M1.3334 0H12.001C12.7374 0 13.3344 0.597 13.3344 1.3333V6.6667C13.3344 7.403 12.7374 8 12.001 8H1.3334C0.597 8 0 7.403 0 6.6667V1.3333C0 0.597 0.597 0 1.3334 0ZM8.0006 4C8.0006 4.7364 7.4036 5.3333 6.6672 5.3333 5.9308 5.3333 5.3338 4.7364 5.3338 4 5.3338 3.2636 5.9308 2.6667 6.6672 2.6667 7.4036 2.6667 8.0006 3.2636 8.0006 4Z" transform="translate(1.1499879989689699 1.25)" style="stroke: #2e7d32;stroke-width: 2;stroke-linecap: round;"></path></svg>
      <span class="text" style="font-size: 14px;font-family: Inter, system-ui, sans-serif;font-weight: 600;color: #2e7d32;">{{ $salary }}</span>
    </div>
  </div>
  <div style="display: flex;flex-direction: row;grid-column-gap: 8px;align-items: center;justify-content: flex-start;width: 100%;flex-wrap: wrap;row-gap: 8px;">
    <div style="border-radius: 100px;background-color: #f8f9fc;padding: 6px 12px;"><span class="text" style="font-size: 12px;font-family: Inter, system-ui, sans-serif;font-weight: 600;color: #1a253c;">{{ $job['type'] }}</span></div>
    @if ($job['peso_verified'])
      <div style="border-radius: 100px;background-color: rgba(27,58,107,0.07);padding: 6px 12px;"><span class="text" style="font-size: 11px;font-family: Inter, system-ui, sans-serif;font-weight: 700;text-transform: uppercase;color: #1b3a6b;">Posted by PESO</span></div>
    @endif
  </div>
  <div style="border-width: 1px 0px 0px;border-style: solid;border-color: #e2e8f0;width: 100%;height: 1px;margin: -1px 0px 0px;"></div>
  <div class="public-job-card__footer" style="display: flex;flex-direction: row;grid-column-gap: 0px;align-items: center;justify-content: center;width: 100%;">
    <span class="text" style="font-size: 12px;font-family: Inter, system-ui, sans-serif;color: #626f84;margin: 0px auto 0px 0px;">{{ $postedLabel }}</span>
    <a href="{{ route('enlistment', ['job' => $job['id']]) }}" style="border-radius: 8px;background-color: #1b3a6b;display: inline-flex;align-items: center;padding: 10px 20px;text-decoration: none;"><span class="text" style="font-size: 13px;font-family: Inter, system-ui, sans-serif;font-weight: 600;color: #fff;">Enlist Now</span></a>
  </div>
</div>
