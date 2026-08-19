@php
  use App\Support\PublicJobListing;
  $salary = PublicJobListing::formatSalary($job);
  $postedLabel = PublicJobListing::postedLabel($job, 'posted');
@endphp

<article class="public-job-list-item" style="display: flex;flex-direction: row;grid-column-gap: 0px;align-items: start;justify-content: flex-start;width: 100%;padding: 16px;">
  <div style="border-radius: 20px;background-color: #fff;display: flex;flex-direction: column;row-gap: 0px;align-items: start;justify-content: center;width: 100%;filter: drop-shadow(0px 4px 16px rgba(15,23,42,0.03));padding: 24px;">
    <div style="display: flex;flex-direction: column;row-gap: 16px;align-items: start;width: 100%;margin: 0px 0px auto;">
      <div style="display: flex;flex-direction: column;row-gap: 4px;align-items: start;width: 100%;">
        <h2 class="text" style="font-size: 18px;font-family: Inter, system-ui, sans-serif;font-weight: 700;color: #0f172a;width: 100%;">{{ $job['title'] }}</h2>
        <span class="text" style="font-size: 14px;font-family: Inter, system-ui, sans-serif;font-weight: 500;color: #1b3a6b;">{{ $job['company'] }}</span>
      </div>
      <div style="display: flex;flex-direction: column;row-gap: 10px;width: 100%;">
        <div style="display: flex;flex-direction: row;grid-column-gap: 6px;align-items: center;">
          <svg width="16" height="16" viewBox="0 0 12.665599822998047 15.334400177001955" fill="none" aria-hidden="true"><path d="M10.6656 5.3338C10.6656 8.6628 6.9733 12.1298 5.7334 13.2006 5.6179 13.2874 5.4773 13.3344 5.3328 13.3344 5.1883 13.3344 5.0477 13.2874 4.9322 13.2006 3.6923 12.1298 0 8.6628 0 5.3338 0 3.9192 0.5618 2.5625 1.5619 1.5622 2.562 0.562 3.9185 0 5.3328 0 6.7471 0 8.1036 0.562 9.1037 1.5622 10.1038 2.5625 10.6656 3.9192 10.6656 5.3338ZM7.3326 5.3338C7.3326 6.4385 6.4373 7.334 5.3328 7.334 4.2283 7.334 3.333 6.4385 3.333 5.3338 3.333 4.2292 4.2283 3.3336 5.3328 3.3336 6.4373 3.3336 7.3326 4.2292 7.3326 5.3338Z" transform="translate(1.1875187549871726 1.1499879989689699)" style="stroke: #64748b;stroke-width: 2;stroke-linecap: round;"></path></svg>
          <span class="text" style="font-size: 13px;font-family: Inter, system-ui, sans-serif;color: #64748b;">{{ $job['location'] }}</span>
        </div>
        <div style="display: flex;flex-direction: row;grid-column-gap: 6px;align-items: center;">
          <svg width="16" height="16" viewBox="0 0 10 14" fill="none" aria-hidden="true"><path d="M0 5.3333H5.3333C6.0406 5.3333 6.7189 5.0524 7.219 4.5523 7.719 4.0522 8 3.3739 8 2.6667 8 1.9594 7.719 1.2811 7.219 0.781 6.7189 0.281 6.0406 0 5.3333 0H2V12M0 8H5.3333" transform="translate(1.25 1.1666666666666667)" style="stroke: #16a34a;stroke-width: 2;stroke-linecap: round;"></path></svg>
          <span class="text" style="font-size: 14px;font-family: Inter, system-ui, sans-serif;font-weight: 600;color: #16a34a;">{{ $salary }}</span>
        </div>
      </div>
      @if (! empty($job['description']))
        <p class="public-job-card__description" style="font-size: 14px;font-family: Inter, system-ui, sans-serif;line-height: 1.5;color: #64748b;width: 100%;margin: 0;">{{ $job['description'] }}</p>
      @endif
      <div style="display: flex;flex-wrap: wrap;row-gap: 8px;grid-column-gap: 8px;width: 100%;">
        <div style="border-radius: 6px;background-color: #eef4f8;padding: 4px 10px;"><span class="text" style="font-size: 12px;font-family: Inter, system-ui, sans-serif;font-weight: 600;color: #1b3a6b;">{{ $job['type'] }}</span></div>
        @if ($job['peso_verified'])
          <div style="border-radius: 6px;background-color: #e0f2fe;padding: 4px 8px;"><span class="text" style="font-size: 11px;font-family: Inter, system-ui, sans-serif;font-weight: 700;text-transform: uppercase;color: #1b3a6b;">Posted by PESO</span></div>
        @endif
      </div>
    </div>
    <div style="display: flex;flex-direction: column;row-gap: 16px;width: 100%;padding: 16px 0px 0px;">
      <div style="border-width: 1px 0px 0px;border-style: solid;border-color: #e2e8f0;width: 100%;height: 1px;margin: -1px 0px 0px;"></div>
      <div class="public-job-card__footer" style="display: flex;flex-direction: row;align-items: center;width: 100%;">
        <span class="text" style="font-size: 12px;font-family: Inter, system-ui, sans-serif;color: #64748b;margin: 0px auto 0px 0px;">{{ $postedLabel }}</span>
        <div style="display: flex;flex-direction: row;grid-column-gap: 8px;">
          <a href="{{ route('enlistment', ['job' => $job['id']]) }}" style="border-radius: 12px;background-color: #f57c00;display: inline-flex;padding: 8px 14px;text-decoration: none;"><span class="text" style="font-size: 13px;font-family: Inter, system-ui, sans-serif;font-weight: 600;color: #fff;">Enlist Now</span></a>
        </div>
      </div>
    </div>
  </div>
</article>
