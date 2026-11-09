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
    <div class="admin-card__header" style="margin-bottom: 16px;padding: 0;">
      <h2 class="admin-section-title" style="margin: 0;">Upcoming Activities</h2>
      <a href="{{ route('admin.announcements.index') }}" class="admin-link-pill">Manage</a>
    </div>
    <div
      id="live-upcoming-activities"
      data-live-url="{{ route('admin.live.upcoming-activities') }}"
      data-live-interval="30000"
    >
      @include('admin.live.upcoming-activities', ['upcomingActivities' => $upcomingActivities])
    </div>
    <p class="admin-empty-hint" style="margin: 12px 0 0;font-size: 11px;color: #94a3b8;line-height: 1.4;">
      Sourced from published and scheduled announcements in the system.
    </p>
  </div>
</div>
@endsection
