@extends('layouts.public-site')

@section('title', 'PESO Connect - Find Your Next Opportunity')

@section('content')
<section class="public-hero">
  <div class="public-hero__intro">
    <h1 class="public-hero__title">Find Your Next Opportunity</h1>
    <p class="public-hero__subtitle">Browse verified job listings posted by the Public Employment Service Office (PESO) in your municipality.</p>
  </div>
  <form action="{{ route('jobs.index') }}" method="GET" class="public-hero-search">
    <div class="public-hero-search__icon" aria-hidden="true">
      <svg width="24" height="24" viewBox="0 0 20 20" fill="none">
        <path d="M18.0002 18.0002L13.6602 13.6602M16 8C16 12.4183 12.4183 16 8 16 3.5817 16 0 12.4183 0 8 0 3.5817 3.5817 0 8 0 12.4183 0 16 3.5817 16 8Z" transform="translate(1.11 1.11)" stroke="#1b3a6b" stroke-width="2" stroke-linecap="round"/>
      </svg>
    </div>
    <input type="search" name="q" class="public-hero-search__input" placeholder="Job title, keywords, or skills..." value="{{ request('q') }}">
    <div class="public-hero-search__divider" aria-hidden="true"></div>
    <button type="submit" class="public-hero-search__submit">Search Jobs</button>
  </form>
</section>

<section class="public-section public-section--muted public-section--compact">
  <h2 class="public-section-title">Quick Services</h2>
  <div class="public-landing-grid public-landing-grid--services">
    @foreach ([
      ['route' => 'jobs.index', 'title' => 'Find Jobs', 'desc' => 'Access the latest job postings from local and overseas companies.', 'icon' => 'briefcase'],
      ['route' => 'referral-requests', 'title' => 'Request Referral', 'desc' => 'Secure a PESO official referral letter to match your job applications.', 'icon' => 'referral'],
      ['route' => 'first-time-job-seeker', 'title' => 'First-Time Job Seeker', 'desc' => 'Apply for benefits and free certificates under Republic Act 11261.', 'icon' => 'user'],
    ] as $service)
      <a href="{{ route($service['route']) }}" class="public-service-card">
        <div class="public-service-card__icon">
          @if ($service['icon'] === 'briefcase')
            <svg width="28" height="28" viewBox="0 0 28 28" fill="none" aria-hidden="true"><path d="M16.3346 21V2.3333C16.3346 1.7145 16.0888 1.121 15.6512 0.6834 15.2135 0.2458 14.62 0 14.0011 0H9.3341C8.7152 0 8.1217 0.2458 7.684 0.6834 7.2464 1.121 7.0006 1.7145 7.0006 2.3333V21M2.3335 4.6667H21.0017C22.2904 4.6667 23.3352 5.7113 23.3352 7V18.6667C23.3352 19.9553 22.2904 21 21.0017 21H2.3335C1.0448 21 0 19.9553 0 18.6667V7C0 5.7113 1.0448 4.6667 2.3335 4.6667Z" transform="translate(1.09 1.1)" stroke="#1b3a6b" stroke-width="2" stroke-linecap="round"/></svg>
          @elseif ($service['icon'] === 'referral')
            <svg width="28" height="28" viewBox="0 0 28 28" fill="none" aria-hidden="true"><path d="M11.6655 0H2.3331C1.7143 0 1.1209 0.2459 0.6833 0.6835C0.2458 1.1211 0 1.7146 0 2.3335V21.0017C0 21.6206 0.2458 22.2141 0.6833 22.6517C1.1209 23.0893 1.7143 23.3352 2.3331 23.3352H16.3317C16.9505 23.3352 17.5439 23.0893 17.9814 22.6517C18.419 22.2141 18.6648 21.6206 18.6648 21.0017V7.0006C18.6654 6.6307 18.5927 6.2643 18.451 5.9227C18.3092 5.581 18.1012 5.2708 17.8389 5.0101L13.6533 0.8237C13.3927 0.5621 13.0828 0.3546 12.7417 0.2133C12.4005 0.0719 12.0348-0.0006 11.6655 0V5.8338C11.6655 6.1432 11.7884 6.44 12.0072 6.6588C12.2259 6.8776 12.5227 7.0006 12.832 7.0006L18.6648 7.0006M6.9993 8.1673H4.6662M13.9986 12.8344H4.6662M13.9986 17.5014H4.6662" transform="translate(1.11 1.09)" stroke="#1b3a6b" stroke-width="2" stroke-linecap="round"/></svg>
          @else
            <svg width="28" height="28" viewBox="0 0 28 28" fill="none" aria-hidden="true"><path d="M16.3346 21V18.6667C16.3346 17.429 15.8429 16.242 14.9677 15.3668C14.0925 14.4917 12.9054 14 11.6676 14H4.667C3.4293 14 2.2422 14.4917 1.3669 15.3668C0.4917 16.242 0 17.429 0 18.6667V21M19.8349 5.8333V12.8333M23.3352 9.3333H16.3346M12.8344 4.6667C12.8344 7.244 10.7449 9.3333 8.1673 9.3333C5.5898 9.3333 3.5003 7.244 3.5003 4.6667C3.5003 2.0893 5.5898 0 8.1673 0C10.7449 0 12.8344 2.0893 12.8344 4.6667Z" transform="translate(1.09 1.1)" stroke="#1b3a6b" stroke-width="2" stroke-linecap="round"/></svg>
          @endif
        </div>
        <div class="public-service-card__body">
          <span class="public-service-card__title">{{ $service['title'] }}</span>
          <span class="public-service-card__desc">{{ $service['desc'] }}</span>
        </div>
        <span class="public-service-card__link">
          Get Started
          <svg width="16" height="16" viewBox="0 0 11.33 11.33" fill="none" aria-hidden="true"><path d="M0 4.6672H9.3344L4.6672 0M9.3344 4.6672L4.6672 9.3344" transform="translate(1.21 1.21)" stroke="#1b3a6b" stroke-width="2" stroke-linecap="round"/></svg>
        </span>
      </a>
    @endforeach
  </div>
</section>

<section class="public-section public-section--spacious">
  <div class="public-section-header">
    <h2 class="public-section-title">Latest Job Openings</h2>
    <a href="{{ route('jobs.index') }}" class="public-section-link">
      View All Jobs
      <svg width="18" height="18" viewBox="0 0 12.5 12.5" fill="none" aria-hidden="true"><path d="M0 5.2506H10.5012L5.2506 0M10.5012 5.2506L5.2506 10.5012" transform="translate(1.19 1.19)" stroke="#1b3a6b" stroke-width="2" stroke-linecap="round"/></svg>
    </a>
  </div>
  <div class="public-landing-jobs">
    @foreach (collect($featuredJobs)->chunk(3) as $row)
      <div class="public-landing-grid public-landing-grid--jobs">
        @foreach ($row as $job)
          @include('partials.public.job-card-landing', ['job' => $job])
        @endforeach
      </div>
    @endforeach
  </div>
</section>

<section class="public-section public-section--muted public-section--spacious">
  <h2 class="public-section-title">Announcements &amp; Community Events</h2>
  <div class="public-landing-grid public-landing-grid--announcements">
    @foreach ($announcements as $announcement)
      @include('partials.public.announcement-card', ['announcement' => $announcement, 'compact' => true])
    @endforeach
  </div>
</section>
@endsection
