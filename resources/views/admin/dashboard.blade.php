@extends('layouts.admin')

@section('title', 'Dashboard')
@section('breadcrumb', 'Dashboard')

@section('content')
<div class="admin-page-header">
  <div>
    <h1 class="admin-page-title">Dashboard Overview</h1>
    <p class="admin-page-subtitle">Monitor enlistments, job posts, and referral activity at a glance.</p>
  </div>
  <div id="live-refresh-badge" class="admin-live-badge" hidden aria-live="polite">Live · just updated</div>
</div>

<div class="admin-dashboard-row" style="align-items: flex-start;">
  <div class="admin-dashboard-row__main">
    <div
      id="live-dashboard-panel"
      data-live-url="{{ route('admin.live.dashboard') }}"
      data-live-interval="30000"
    >
      @include('admin.live.dashboard', [
        'stats' => $stats,
        'categories' => $categories,
        'recentEnlistees' => $recentEnlistees,
      ])
    </div>
  </div>

  <div class="admin-card admin-dashboard-row__aside">
    <h2 class="admin-section-title">Upcoming Activities</h2>
    <div class="admin-activity-list">
      @foreach ($upcomingActivities as $activity)
        <div class="admin-activity-item">
          <div class="admin-activity-date">
            <span class="admin-activity-date__day">{{ $activity['day'] }}</span>
            <span class="admin-activity-date__month">{{ $activity['month'] }}</span>
          </div>
          <div class="admin-activity-item__content">
            <div class="admin-activity-item__title">{{ $activity['title'] }}</div>
            <div class="admin-activity-item__details">{{ $activity['details'] }}</div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
