@extends('layouts.admin')

@section('title', 'Reports & Analytics')
@section('breadcrumb', 'Reports & Analytics')

@section('content')
@php
  $values = collect($monthlyEnlistments)->pluck('value');
  $minValue = $values->min() ?? 0;
  $maxValue = $values->max() ?? 1;
  $range = max($maxValue - $minValue, 1);
  $chartHeight = 150;
  $chartTop = 15;
  $pointCount = count($monthlyEnlistments);
  $chartPoints = [];

  foreach ($monthlyEnlistments as $index => $point) {
    $x = $pointCount > 1 ? 30 + ($index / ($pointCount - 1)) * 550 : 305;
    $y = $chartTop + $chartHeight - (($point['value'] - $minValue) / $range) * $chartHeight;
    $chartPoints[] = array_merge($point, ['x' => round($x, 1), 'y' => round($y, 1)]);
  }

  $polyline = collect($chartPoints)->map(fn ($p) => $p['x'].','.$p['y'])->join(' ');
  $highlight = collect($chartPoints)->firstWhere('highlight', true) ?? ($chartPoints[$pointCount - 1] ?? null);
@endphp

<div class="admin-page-header admin-page-header--reports">
  <div>
    <h1 class="admin-page-title">Reports & Analytics</h1>
    <p class="admin-page-subtitle">Employment metrics and exportable reports for PESO staff.</p>
  </div>
  <div class="admin-page-header__actions">
    <span class="admin-reports-date-pill">{{ $displayDate }}</span>
    <button type="button" class="admin-btn admin-btn--accent" data-open-modal="modal-generate-report">
      <svg width="12" height="12" viewBox="0 0 11 11" fill="none" aria-hidden="true"><path d="M0 4.667H9.334M4.667 0V9.334" transform="translate(1.21 1.21)" stroke="#fff" stroke-width="2" stroke-linecap="round"/></svg>
      Generate Report
    </button>
  </div>
</div>

<div class="admin-reports-stats">
  @foreach ($stats as $stat)
    <div class="admin-reports-stat-card">
      <div class="admin-reports-stat-card__header">
        <span class="admin-reports-stat-card__label">{{ $stat['label'] }}</span>
        <div class="admin-reports-stat-card__icon" style="background: {{ $stat['icon_bg'] ?? 'rgba(27,58,107,0.1)' }};">
          @if (($stat['icon'] ?? '') === 'users')
            <svg width="18" height="16" viewBox="0 0 17 15" fill="none" aria-hidden="true"><path d="M10.501 13.5V12C10.501 11.204 10.185 10.441 9.622 9.879 9.059 9.316 8.296 9 7.501 9H3.001C2.205 9 1.441 9.316 0.879 9.879 0.316 10.441 0 11.204 0 12V13.5M10.501 0.096C11.144 0.263 11.714 0.638 12.121 1.164 12.528 1.69 12.748 2.335 12.748 3 12.748 3.665 12.528 4.31 12.121 4.836 11.714 5.362 11.144 5.737 10.501 5.904M15.001 13.5V12C15.001 11.335 14.779 10.69 14.372 10.164 13.965 9.639 13.395 9.264 12.751 9.097M8.251 3C8.251 4.657 6.907 6 5.251 6 3.593 6 2.251 4.657 2.251 3 2.251 1.343 3.593 0 5.251 0 6.907 0 8.251 1.343 8.251 3Z" transform="translate(1.13 1.15)" stroke="{{ $stat['icon_stroke'] ?? '#1b3a6b' }}" stroke-width="2" stroke-linecap="round"/></svg>
          @elseif (($stat['icon'] ?? '') === 'briefcase')
            <svg width="18" height="16" viewBox="0 0 17 15" fill="none" aria-hidden="true"><path d="M10.501 13.5V1.5C10.501 1.102 10.343 0.721 10.062 0.439 9.78 0.158 9.399 0 9.001 0H6.001C5.603 0 5.221 0.158 4.94 0.439 4.658 0.721 4.5 1.102 4.5 1.5V13.5M1.5 3H13.501C14.33 3 15.001 3.672 15.001 4.5V12C15.001 12.828 14.33 13.5 13.501 13.5H1.5C0.672 13.5 0 12.828 0 12V4.5C0 3.672 0.672 3 1.5 3Z" transform="translate(1.13 1.15)" stroke="{{ $stat['icon_stroke'] ?? '#f57c00' }}" stroke-width="2" stroke-linecap="round"/></svg>
          @elseif (($stat['icon'] ?? '') === 'referral')
            <svg width="14" height="17" viewBox="0 0 14 17" fill="none" aria-hidden="true"><path d="M7.499 0H1.5C1.102 0 0.721 0.158 0.439 0.439 0.158 0.721 0 1.102 0 1.5V13.501C0 13.899 0.158 14.281 0.439 14.562 0.721 14.843 1.102 15.001 1.5 15.001H10.499C10.897 15.001 11.278 14.843 11.56 14.562 11.841 14.281 11.999 13.899 11.999 13.501V4.5C11.999 4.263 11.953 4.027 11.861 3.807 11.77 3.588 11.637 3.388 11.468 3.221L8.777 0.53C8.61 0.361 8.41 0.228 8.191 0.137 7.972 0.046 7.737-0 7.499 0V3.75C7.499 3.949 7.579 4.14 7.719 4.281 7.86 4.421 8.05 4.5 8.249 4.5H11.999M3.75 9.751L5.25 11.251 8.249 8.251" transform="translate(1.17 1.13)" stroke="{{ $stat['icon_stroke'] ?? '#009688' }}" stroke-width="2" stroke-linecap="round"/></svg>
          @else
            <svg width="17" height="16" viewBox="0 0 17 15" fill="none" aria-hidden="true"><path d="M10.501 13.5V12C10.501 11.204 10.185 10.441 9.622 9.879 9.059 9.316 8.296 9 7.501 9H3.001C2.205 9 1.441 9.316 0.879 9.879 0.316 10.441 0 11.204 0 12V13.5M12.751 3.75V8.25M15.001 6H10.501M8.251 3C8.251 4.657 6.907 6 5.251 6 3.593 6 2.251 4.657 2.251 3 2.251 1.343 3.593 0 5.251 0 6.907 0 8.251 1.343 8.251 3Z" transform="translate(1.13 1.15)" stroke="{{ $stat['icon_stroke'] ?? '#4f46e5' }}" stroke-width="2" stroke-linecap="round"/></svg>
          @endif
        </div>
      </div>
      <div class="admin-reports-stat-card__value">{{ $stat['value'] }}</div>
      @if (! empty($stat['change']))
        <div class="admin-reports-stat-card__change">
          @if (($stat['change_type'] ?? 'up') === 'up')
            <svg width="12" height="12" viewBox="0 0 9 9" fill="none" aria-hidden="true"><path d="M0 3.5L3.5 0 7 3.5M3.5 0V7" transform="translate(1.29 1.29)" stroke="#10b981" stroke-width="2" stroke-linecap="round"/></svg>
          @else
            <svg width="12" height="12" viewBox="0 0 9 9" fill="none" aria-hidden="true"><path d="M3.5 0V7L7 3.5M3.5 7L0 3.5" transform="translate(1.29 1.29)" stroke="#ef4444" stroke-width="2" stroke-linecap="round"/></svg>
          @endif
          <span class="admin-reports-stat-card__change-value--{{ $stat['change_type'] ?? 'up' }}">{{ $stat['change'] }}</span>
          <span class="admin-reports-stat-card__change-label">vs last month</span>
        </div>
      @endif
    </div>
  @endforeach
</div>

<div class="admin-reports-charts">
  <div class="admin-reports-chart-card admin-reports-chart-card--main">
    <div class="admin-reports-chart-card__header">
      <h2 class="admin-section-title">Monthly Enlistments</h2>
      <div class="admin-reports-chart-legend">
        <span class="admin-reports-chart-legend__dot"></span>
        <span>Total Enlistees</span>
      </div>
    </div>
    <div class="admin-reports-line-chart">
      @if ($highlight)
        <div class="admin-reports-line-chart__tooltip">{{ $highlight['month'] }}: {{ $highlight['value'] }} enlisted</div>
      @endif
      <svg viewBox="0 0 640 180" preserveAspectRatio="none" aria-hidden="true">
        @for ($grid = 0; $grid <= 4; $grid++)
          <line x1="0" y1="{{ 44 * $grid + 1 }}" x2="640" y2="{{ 44 * $grid + 1 }}" stroke="#f1f5f9" stroke-width="1"/>
        @endfor
        <polyline points="{{ $polyline }}" fill="none" stroke="#1b3a6b" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"/>
        @foreach ($chartPoints as $point)
          <circle cx="{{ $point['x'] }}" cy="{{ $point['y'] }}" r="4" fill="#f57c00" stroke="#fff" stroke-width="2"/>
        @endforeach
        @if ($highlight)
          <line x1="{{ $highlight['x'] }}" y1="{{ $highlight['y'] + 4 }}" x2="{{ $highlight['x'] }}" y2="180" stroke="#f57c00" stroke-width="1" stroke-dasharray="4 4"/>
        @endif
      </svg>
    </div>
    <div class="admin-reports-line-chart__months">
      @foreach ($monthlyEnlistments as $point)
        <span>{{ $point['month'] }}</span>
      @endforeach
    </div>
  </div>

  <div class="admin-reports-chart-card admin-reports-chart-card--aside">
    <h2 class="admin-section-title">Enlistments by Category</h2>
    <div class="admin-reports-donut">
      <div class="admin-reports-donut__chart">
        <svg viewBox="0 0 140 140" aria-hidden="true" role="img" aria-label="Enlistments by category chart">
          @forelse ($donutSegments as $segment)
            <path d="{{ $segment['d'] }}" fill="{{ $segment['color'] }}">
              <title>{{ $segment['name'] }}: {{ $segment['count'] }}</title>
            </path>
          @empty
            <circle cx="70" cy="70" r="70" fill="#e2e8f0"/>
            <circle cx="70" cy="70" r="45.5" fill="#fff"/>
          @endforelse
        </svg>
        <div class="admin-reports-donut__center">
          <span class="admin-reports-donut__total">{{ $categoryTotal }}</span>
          <span class="admin-reports-donut__label">Total</span>
        </div>
      </div>
      <div class="admin-reports-donut__legend">
        @foreach ($categories as $category)
          <div class="admin-reports-donut__legend-row">
            <div class="admin-reports-donut__legend-name">
              <span class="admin-reports-donut__legend-swatch" style="background: {{ $category['color'] }};"></span>
              <span>{{ $category['name'] }}</span>
            </div>
            <div class="admin-reports-donut__legend-values">
              <span class="admin-reports-donut__legend-count">{{ $category['count'] }}</span>
              <span class="admin-reports-donut__legend-percent">{{ $category['percent'] }}</span>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection

@push('modals')
  @include('partials.admin.modals.generate-report')
@endpush
