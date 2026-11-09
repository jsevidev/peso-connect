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
    <div
      id="live-upcoming-activities"
      data-live-url="{{ route('admin.live.upcoming-activities') }}"
      data-live-interval="30000"
    >
      @include('admin.live.upcoming-activities', ['upcomingActivities' => $upcomingActivities])
    </div>
  </div>
</div>
@endsection
