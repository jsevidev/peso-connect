@extends('layouts.public-site')

@section('title', 'Find Jobs - PESO Connect')

@section('body-bg', '#f8fafc')

@section('page-bg', '#f8fafc')

@section('content')
<div class="public-banner" style="background-color: #1b3a6b;display: flex;flex-direction: column;row-gap: 24px;align-items: center;justify-content: flex-start;width: 100%;position: relative;flex-shrink: 0;padding: 48px clamp(20px, 5vw, 64px) 40px;">
  <div style="display: flex;flex-direction: column;row-gap: 8px;align-items: center;justify-content: flex-start;width: 100%;max-width:800px;position: relative;flex-shrink: 0;">
    <span class="text" style="display: inline;text-align: center;font-size: 14px;font-family: Inter, system-ui, sans-serif;font-weight: 700;text-transform: uppercase;color: #f57c00;width: 100%;">Official Local &amp; Public Sector Opportunities</span>
    <span class="text" style="display: inline;text-align: center;font-size: 48px;font-family: &quot;Instrument Serif&quot;, system-ui, sans-serif;font-weight: 400;color: #fff;width: 100%;">Connecting Filipinos to Dignified Employment</span>
  </div>
  <form action="{{ route('jobs.index') }}" method="GET" class="public-search" style="border-radius: 32px;background-color: #fff;display: flex;flex-direction: row;grid-column-gap: 16px;align-items: center;justify-content: flex-start;width: 100%;max-width:1120px;height: 64px;filter: drop-shadow(0px 4px 16px rgba(15,23,42,0.03));padding: 8px 8px 8px 24px;">
    @foreach (request()->except('q', 'page') as $key => $value)
      @if (is_array($value))
        @foreach ($value as $item)
          <input type="hidden" name="{{ $key }}[]" value="{{ $item }}">
        @endforeach
      @else
        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
      @endif
    @endforeach
    <div style="display: flex;flex-direction: row;grid-column-gap: 8px;align-items: center;width: 100%;flex-grow: 1;">
      <svg width="20" height="20" viewBox="0 0 17 17" fill="none" aria-hidden="true" style="flex-shrink:0;"><path d="M15.0001 15.0001L11.3835 11.3835M13.3333 6.6667C13.3333 10.3486 10.3486 13.3333 6.6667 13.3333 2.9848 13.3333 0 10.3486 0 6.6667 0 2.9848 2.9848 0 6.6667 0 10.3486 0 13.3333 2.9848 13.3333 6.6667Z" transform="translate(1.13 1.13)" style="stroke: #64748b;stroke-width: 2;stroke-linecap: round;"></path></svg>
      <input type="search" name="q" placeholder="Job title, skill, or agency..." value="{{ $query ?? request('q') }}" style="display: inline;font-size: 14px;font-family: Inter, system-ui, sans-serif;color: #0f172a;width: 100%;border: none;outline: none;background: transparent;">
    </div>
    <button type="submit" style="border-radius: 24px;background-color: #f57c00;display: flex;flex-direction: row;grid-column-gap: 8px;align-items: center;padding: 12px 32px;border: none;cursor: pointer;">
      <svg width="16" height="16" viewBox="0 0 14 14" fill="none" aria-hidden="true"><path d="M12.0001 12.0001L9.1068 9.1068M10.6667 5.3333C10.6667 8.2789 8.2789 10.6667 5.3333 10.6667 2.3878 10.6667 0 8.2789 0 5.3333 0 2.3878 2.3878 0 5.3333 0 8.2789 0 10.6667 2.3878 10.6667 5.3333Z" transform="translate(1.17 1.17)" style="stroke: #fff;stroke-width: 2;stroke-linecap: round;"></path></svg>
      <span class="text" style="font-size: 15px;font-family: Inter, system-ui, sans-serif;font-weight: 600;color: #fff;">Search</span>
    </button>
  </form>
</div>

<div class="public-layout-row public-content" style="background-color: #f8fafc;display: flex;flex-direction: row;grid-column-gap: 32px;align-items: start;width: 100%;padding: 48px clamp(20px, 5vw, 64px);">
  <form action="{{ route('jobs.index') }}" method="GET" class="public-sidebar" style="border-radius: 20px;background-color: #fff;display: flex;flex-direction: column;row-gap: 24px;align-items: start;width: 260px;filter: drop-shadow(0px 4px 16px rgba(15,23,42,0.03));padding: 24px;">
    @if (request('q'))
      <input type="hidden" name="q" value="{{ request('q') }}">
    @endif
    @if (request('sort'))
      <input type="hidden" name="sort" value="{{ request('sort') }}">
    @endif

    <div style="display: flex;flex-direction: row;align-items: center;width: 100%;">
      <span class="text" style="font-size: 16px;font-family: Inter, system-ui, sans-serif;font-weight: 700;color: #0f172a;margin-right: auto;">Filters</span>
      <a href="{{ route('jobs.index', request('q') ? ['q' => request('q')] : []) }}" class="public-link-button" style="text-decoration: underline;">Clear Filters</a>
    </div>

    <div style="border-width: 1px 0px 0px;border-style: solid;border-color: #e2e8f0;width: 100%;height: 1px;margin: -1px 0px 0px;"></div>

    <fieldset style="border: none;display: flex;flex-direction: column;row-gap: 14px;width: 100%;padding: 0;margin: 0;">
      <legend class="text" style="font-size: 13px;font-family: Inter, system-ui, sans-serif;font-weight: 700;text-transform: uppercase;color: #0f172a;margin-bottom: 0;">Job Type</legend>
      @foreach ([['full-time', 'Full-Time'], ['part-time', 'Part-Time']] as [$key, $label])
        <label class="public-filter-row">
          <div style="display: flex;flex-direction: row;grid-column-gap: 10px;align-items: center;">
            <input type="checkbox" name="type[]" value="{{ $key }}" @checked(in_array($key, $selectedTypes ?? [], true)) onchange="this.form.submit()">
            <span class="public-filter-row__box"></span>
            <span class="text" style="font-size: 14px;font-family: Inter, system-ui, sans-serif;color: #0f172a;">{{ $label }}</span>
          </div>
          <span class="text" style="font-size: 12px;font-family: Inter, system-ui, sans-serif;color: #64748b;">{{ $filterCounts['type'][$key] ?? 0 }}</span>
        </label>
      @endforeach
    </fieldset>

    <div style="border-width: 1px 0px 0px;border-style: solid;border-color: #e2e8f0;width: 100%;height: 1px;margin: -1px 0px 0px;"></div>

    <fieldset style="border: none;display: flex;flex-direction: column;row-gap: 14px;width: 100%;padding: 0;margin: 0;">
      <legend class="text" style="font-size: 13px;font-family: Inter, system-ui, sans-serif;font-weight: 700;text-transform: uppercase;color: #0f172a;">Monthly Salary Range</legend>
      @foreach ([['15-25', '₱15,000 - ₱25,000'], ['25-40', '₱25,000 - ₱40,000'], ['40-60', '₱40,000 - ₱60,000'], ['60-plus', '₱60,000+']] as [$key, $label])
        <label class="public-filter-row">
          <div style="display: flex;flex-direction: row;grid-column-gap: 10px;align-items: center;">
            <input type="checkbox" name="salary[]" value="{{ $key }}" @checked(in_array($key, $selectedSalary ?? [], true)) onchange="this.form.submit()">
            <span class="public-filter-row__box"></span>
            <span class="text" style="font-size: 14px;font-family: Inter, system-ui, sans-serif;color: #0f172a;">{{ $label }}</span>
          </div>
          <span class="text" style="font-size: 12px;font-family: Inter, system-ui, sans-serif;color: #64748b;">{{ $filterCounts['salary'][$key] ?? 0 }}</span>
        </label>
      @endforeach
    </fieldset>

    <div style="border-width: 1px 0px 0px;border-style: solid;border-color: #e2e8f0;width: 100%;height: 1px;margin: -1px 0px 0px;"></div>

    <fieldset style="border: none;display: flex;flex-direction: column;row-gap: 14px;width: 100%;padding: 0;margin: 0;">
      <legend class="text" style="font-size: 13px;font-family: Inter, system-ui, sans-serif;font-weight: 700;text-transform: uppercase;color: #0f172a;">Date Posted</legend>
      @foreach ([['24h', 'Last 24 Hours'], ['7d', 'Last 7 Days'], ['30d', 'Last 30 Days']] as [$key, $label])
        <label class="public-filter-row">
          <div style="display: flex;flex-direction: row;grid-column-gap: 10px;align-items: center;">
            <input type="checkbox" name="posted[]" value="{{ $key }}" @checked(in_array($key, $selectedPosted ?? [], true)) onchange="this.form.submit()">
            <span class="public-filter-row__box"></span>
            <span class="text" style="font-size: 14px;font-family: Inter, system-ui, sans-serif;color: #0f172a;">{{ $label }}</span>
          </div>
          <span class="text" style="font-size: 12px;font-family: Inter, system-ui, sans-serif;color: #64748b;">{{ $filterCounts['posted'][$key] ?? 0 }}</span>
        </label>
      @endforeach
    </fieldset>
  </form>

  <div class="public-main" style="display: flex;flex-direction: column;row-gap: 24px;align-items: start;min-width: 0;">
    <div style="display: flex;flex-direction: row;align-items: center;width: 100%;flex-wrap: wrap;gap: 16px;">
      <div style="display: flex;flex-direction: row;grid-column-gap: 8px;align-items: center;flex-wrap: wrap;margin-right: auto;">
        <span class="text" style="font-size: 16px;font-family: Inter, system-ui, sans-serif;font-weight: 700;color: #0f172a;">Showing {{ $totalJobs }} job{{ $totalJobs === 1 ? '' : 's' }}</span>
        @if (($selectedTypes ?? []) !== [] || ($selectedSalary ?? []) !== [] || ($selectedPosted ?? []) !== [])
          <span class="text" style="font-size: 13px;font-family: Inter, system-ui, sans-serif;color: #64748b;">• Filters applied</span>
        @endif
      </div>
      <form action="{{ route('jobs.index') }}" method="GET" style="display: flex;align-items: center;grid-column-gap: 8px;">
        @foreach (request()->except('sort', 'page') as $key => $value)
          @if (is_array($value))
            @foreach ($value as $item)
              <input type="hidden" name="{{ $key }}[]" value="{{ $item }}">
            @endforeach
          @else
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
          @endif
        @endforeach
        <label for="sort" class="text" style="font-size: 13px;font-family: Inter, system-ui, sans-serif;color: #64748b;">Sort by:</label>
        <select id="sort" name="sort" class="public-sort-select" onchange="this.form.submit()">
          <option value="recent" @selected(($sort ?? 'recent') === 'recent')>Most Recent</option>
          <option value="salary_high" @selected(($sort ?? '') === 'salary_high')>Salary: High to Low</option>
          <option value="salary_low" @selected(($sort ?? '') === 'salary_low')>Salary: Low to High</option>
        </select>
      </form>
    </div>

    <div style="display: flex;flex-direction: column;row-gap: 24px;width: 100%;">
      @forelse ($jobs as $job)
        @include('partials.public.job-card-list', ['job' => $job])
      @empty
        <div style="border-radius: 20px;background-color: #fff;padding: 48px 24px;text-align: center;width: 100%;">
          <span class="text" style="font-size: 16px;font-family: Inter, system-ui, sans-serif;color: #64748b;">No jobs match your search or filters. Try adjusting your criteria.</span>
        </div>
      @endforelse
    </div>

    @include('partials.public.pagination', [
      'currentPage' => $currentPage,
      'lastPage' => $lastPage,
      'routeName' => 'jobs.index',
      'query' => request()->except('page'),
    ])
  </div>
</div>
@endsection
