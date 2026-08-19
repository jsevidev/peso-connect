@extends('layouts.public-site')

@section('title', 'PESO Connect - Find Your Next Opportunity')

@section('content')
<section class="public-hero" style="background-image: linear-gradient(180deg, #1b3a6b 0%, #0d2147 100%);display: flex;flex-direction: column;row-gap: 40px;align-items: center;width: 100%;padding: 80px;">
  <div style="display: flex;flex-direction: column;row-gap: 16px;align-items: center;width: 100%;">
    <h1 class="text public-hero__title" style="text-align: center;font-size: 64px;font-family: &quot;Instrument Serif&quot;, system-ui, sans-serif;color: #fff;">Find Your Next Opportunity</h1>
    <p class="text public-hero__subtitle" style="text-align: center;line-height: 27px;font-size: 18px;font-family: Inter, system-ui, sans-serif;color: rgba(255,255,255,0.8);">Browse verified job listings posted by the Public Employment Service Office (PESO) in your municipality.</p>
  </div>
  <form action="{{ route('jobs.index') }}" method="GET" class="public-search" style="border-radius: 36px;background-color: #fff;display: flex;flex-direction: row;grid-column-gap: 16px;align-items: center;width: 900px;height: 72px;filter: drop-shadow(0px 12px 24px rgba(0,0,0,0.08));padding: 8px 8px 8px 24px;">
    <svg width="24" height="24" viewBox="0 0 20 20" fill="none" aria-hidden="true" style="flex-shrink:0;"><path d="M18.0002 18.0002L13.6602 13.6602M16 8C16 12.4183 12.4183 16 8 16 3.5817 16 0 12.4183 0 8 0 3.5817 3.5817 0 8 0 12.4183 0 16 3.5817 16 8Z" transform="translate(1.11 1.11)" style="stroke: #1b3a6b;stroke-width: 2;stroke-linecap: round;"></path></svg>
    <input type="search" name="q" placeholder="Job title, keywords, or skills..." value="{{ request('q') }}" style="font-size: 16px;font-family: Inter, system-ui, sans-serif;color: #1a253c;width: 100%;border: none;outline: none;background: transparent;">
    <div class="public-search__divider" style="border-width: 1px 0px 0px;border-style: solid;border-color: #e2e8f0;transform: rotate(90deg);width: 32px;height: 1px;margin: 15px -16px 16px;"></div>
    <button type="submit" style="border-radius: 28px;background-color: #f57c00;display: inline-flex;align-items: center;padding: 16px 32px;border: none;cursor: pointer;">
      <span class="text" style="font-size: 16px;font-family: Inter, system-ui, sans-serif;font-weight: 600;color: #fff;">Search Jobs</span>
    </button>
  </form>
</section>

<section class="public-section" style="background-color: #f8f9fc;display: flex;flex-direction: column;row-gap: 32px;align-items: start;width: 100%;padding: 80px;">
  <h2 class="text public-section-title" style="font-size: 36px;font-family: &quot;Instrument Serif&quot;, system-ui, sans-serif;color: #1b3a6b;width: 100%;">Quick Services</h2>
  <div class="public-grid" style="display: flex;flex-direction: row;grid-column-gap: 24px;align-items: start;width: 100%;">
    @foreach ([
      ['route' => 'jobs.index', 'title' => 'Find Jobs', 'desc' => 'Access the latest job postings from local and overseas companies.', 'svg' => '<path d="M16.3346 21V2.3333C16.3346 1.7145 16.0888 1.121 15.6512 0.6834 15.2135 0.2458 14.62 0 14.0011 0H9.3341C8.7152 0 8.1217 0.2458 7.684 0.6834 7.2464 1.121 7.0006 1.7145 7.0006 2.3333V21M2.3335 4.6667H21.0017C22.2904 4.6667 23.3352 5.7113 23.3352 7V18.6667C23.3352 19.9553 22.2904 21 21.0017 21H2.3335C1.0448 21 0 19.9553 0 18.6667V7C0 5.7113 1.0448 4.6667 2.3335 4.6667Z" transform="translate(1.09 1.1)" style="stroke: #1b3a6b;stroke-width: 2;stroke-linecap: round;"></path>'],
      ['route' => 'referral-requests', 'title' => 'Request Referral', 'desc' => 'Secure a PESO official referral letter to match your job applications.', 'svg' => '<path d="M11.6655 0H2.3331C1.7143 0 1.1209 0.2459 0.6833 0.6835 0 1.7146 0 2.3335V21.0017C0 21.6206 0.2458 22.2141 0.6833 22.6517 1.1209 23.0893 1.7143 23.3352 2.3331 23.3352H16.3317C16.9505 23.3352 17.5439 23.0893 17.9814 22.6517 18.419 22.2141 18.6648 21.6206 18.6648 21.0017V7.0006C18.6654 6.6307 18.5927 6.2643 18.451 5.9227 18.3092 5.581 18.1012 5.2708 17.8389 5.0101L13.6533 0.8237C13.3927 0.5621 13.0828 0.3546 12.7417 0.2133 12.4005 0.0719 12.0348-0.0006 11.6655 0V5.8338C11.6655 6.1432 11.7884 6.44 12.0072 6.6588 12.2259 6.8776 12.5227 7.0006 12.832 7.0006L18.6648 7.0006M6.9993 8.1673H4.6662M13.9986 12.8344H4.6662M13.9986 17.5014H4.6662" transform="translate(1.11 1.09)" style="stroke: #1b3a6b;stroke-width: 2;stroke-linecap: round;"></path>'],
      ['route' => 'first-time-job-seeker', 'title' => 'First-Time Job Seeker', 'desc' => 'Apply for benefits and free certificates under Republic Act 11261.', 'svg' => '<path d="M16.3346 21V18.6667C16.3346 17.429 15.8429 16.242 14.9677 15.3668 14.0925 14.4917 12.9054 14 11.6676 14H4.667C3.4293 14 2.2422 14.4917 1.3669 15.3668 0.4917 16.242 0 17.429 0 18.6667V21M19.8349 5.8333V12.8333M23.3352 9.3333H16.3346M12.8344 4.6667C12.8344 7.244 10.7449 9.3333 8.1673 9.3333 5.5898 9.3333 3.5003 7.244 3.5003 4.6667 3.5003 2.0893 5.5898 0 8.1673 0 10.7449 0 12.8344 2.0893 12.8344 4.6667Z" transform="translate(1.09 1.1)" style="stroke: #1b3a6b;stroke-width: 2;stroke-linecap: round;"></path>'],
    ] as $service)
      <a href="{{ route($service['route']) }}" class="public-service-card">
        <div style="border-radius: 16px;background-color: rgba(27,58,107,0.06);display: flex;align-items: center;justify-content: center;width: 56px;height: 56px;">
          <svg width="28" height="28" viewBox="0 0 28 28" fill="none" aria-hidden="true">{!! $service['svg'] !!}</svg>
        </div>
        <div style="display: flex;flex-direction: column;row-gap: 8px;width: 100%;">
          <span class="text" style="font-size: 20px;font-family: Inter, system-ui, sans-serif;font-weight: 700;color: #1a253c;">{{ $service['title'] }}</span>
          <span class="text" style="line-height: 21px;font-size: 14px;font-family: Inter, system-ui, sans-serif;color: #626f84;">{{ $service['desc'] }}</span>
        </div>
        <span class="public-service-card__link" style="display: inline-flex;align-items: center;grid-column-gap: 8px;font-size: 14px;font-family: Inter, system-ui, sans-serif;font-weight: 600;color: #1b3a6b;">Get Started →</span>
      </a>
    @endforeach
  </div>
</section>

<section class="public-section" style="display: flex;flex-direction: column;row-gap: 40px;align-items: start;width: 100%;padding: 80px;">
  <div class="public-section-header" style="display: flex;flex-direction: row;align-items: center;width: 100%;">
    <h2 class="text public-section-title" style="font-size: 36px;font-family: &quot;Instrument Serif&quot;, system-ui, sans-serif;color: #1b3a6b;margin: 0px auto 0px 0px;">Latest Job Openings</h2>
    <a href="{{ route('jobs.index') }}" style="display: inline-flex;align-items: center;grid-column-gap: 8px;text-decoration: none;">
      <span class="text" style="font-size: 16px;font-family: Inter, system-ui, sans-serif;font-weight: 600;color: #1b3a6b;">View All Jobs</span>
      <span aria-hidden="true">→</span>
    </a>
  </div>
  <div style="display: flex;flex-direction: column;row-gap: 24px;width: 100%;">
    @foreach (collect($featuredJobs)->chunk(3) as $row)
      <div class="public-grid" style="display: flex;flex-direction: row;grid-column-gap: 24px;align-items: start;width: 100%;">
        @foreach ($row as $job)
          @include('partials.public.job-card-landing', ['job' => $job])
        @endforeach
      </div>
    @endforeach
  </div>
</section>

<section class="public-section" style="background-color: #f8f9fc;display: flex;flex-direction: column;row-gap: 40px;align-items: start;width: 100%;padding: 80px;">
  <h2 class="text public-section-title" style="font-size: 36px;font-family: &quot;Instrument Serif&quot;, system-ui, sans-serif;color: #1b3a6b;width: 100%;">Announcements &amp; Community Events</h2>
  <div class="public-grid" style="display: flex;flex-direction: row;grid-column-gap: 24px;align-items: start;width: 100%;">
    @foreach ($announcements as $announcement)
      @include('partials.public.announcement-card', ['announcement' => $announcement, 'compact' => true])
    @endforeach
  </div>
</section>
@endsection
