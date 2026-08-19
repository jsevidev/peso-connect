@extends('layouts.admin')

@section('title', 'Dashboard')
@section('breadcrumb', 'Dashboard')

@section('content')
<div class="admin-page-header">
  <div>
    <h1 class="admin-page-title">Dashboard Overview</h1>
    <p class="admin-page-subtitle">Monitor enlistments, job posts, and referral activity at a glance.</p>
  </div>
</div>

<div class="admin-stats">
  @foreach ($stats as $stat)
    <div class="admin-stat-card">
      <div class="admin-stat-card__label">{{ $stat['label'] }}</div>
      <div class="admin-stat-card__value">{{ $stat['value'] }}</div>
      <div class="admin-stat-card__change admin-stat-card__change--{{ $stat['change_type'] }}">{{ $stat['change'] }} from last month</div>
    </div>
  @endforeach
</div>

<div class="admin-card" style="margin-bottom: 24px;">
  <h2 class="admin-section-title">Enlistments by Category</h2>
  @foreach ($categories as $cat)
    <div style="margin-bottom: 16px;">
      <div style="display: flex; justify-content: space-between; font-size: 14px; font-family: Inter, system-ui, sans-serif; margin-bottom: 6px;">
        <span style="color: #0f172a; font-weight: 600;">{{ $cat['name'] }}</span>
        <span style="color: #64748b;">{{ $cat['count'] }} ({{ $cat['percent'] }})</span>
      </div>
      <div style="height: 8px; background: #e2e8f0; border-radius: 4px; overflow: hidden;">
        <div style="height: 100%; width: {{ $cat['percent'] }}; background: {{ $cat['color'] }}; border-radius: 4px;"></div>
      </div>
    </div>
  @endforeach
</div>

<div class="admin-dashboard-row">
  <div class="admin-card admin-dashboard-row__main admin-card--flush">
    <div class="admin-card__header">
      <h2 class="admin-section-title">Recent Enlistments</h2>
      <a href="{{ route('admin.enlistees.index') }}" class="admin-link-pill">View All</a>
    </div>
    <div class="admin-table-wrap admin-table-wrap--fit">
      <table class="admin-table admin-table--fit">
        <thead>
          <tr>
            <th>Enlistee Name</th>
            <th>Position Enlisted</th>
            <th>Date</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($recentEnlistees as $row)
            <tr>
              <td><strong>{{ $row['name'] }}</strong></td>
              <td>{{ $row['position'] }}</td>
              <td>{{ $row['date'] }}</td>
              <td><span class="admin-badge {{ \App\Support\AdminListing::statusClass($row['status']) }}">{{ $row['status'] }}</span></td>
            </tr>
          @endforeach
        </tbody>
      </table>
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
