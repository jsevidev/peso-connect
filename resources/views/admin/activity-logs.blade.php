@extends('layouts.admin')

@section('title', 'Activity Logs')
@section('breadcrumb', 'Activity Logs')

@section('content')
<div class="admin-page-header admin-page-header--activity-logs">
  <div>
    <h1 class="admin-page-title">Activity Logs</h1>
    <p class="admin-page-subtitle">Audit trail and system logging for regulatory compliance and referral tracking security.</p>
  </div>
  <div class="admin-activity-live-badge" aria-label="Live logs streaming">
    <span class="admin-activity-live-badge__dot"></span>
    <span class="admin-activity-live-badge__text">Live Logs Streaming</span>
  </div>
</div>

<div class="admin-activity-toolbar-wrap">
<form action="{{ route('admin.activity-logs.index') }}" method="GET" class="admin-activity-toolbar">
  <div class="admin-activity-toolbar__search">
    <svg width="16" height="16" viewBox="0 0 14 14" fill="none" aria-hidden="true" style="flex-shrink: 0;">
      <path d="M12 12L9.1 9.1M10.7 5.3C10.7 8.3 8.3 10.7 5.3 10.7 2.4 10.7 0 8.3 0 5.3 0 2.4 2.4 0 5.3 0 8.3 0 10.7 2.4 10.7 5.3Z" transform="translate(1.17 1.17)" stroke="#64748b" stroke-width="2" stroke-linecap="round"/>
    </svg>
    <input type="search" name="q" class="admin-input" placeholder="Filter by keyword or details..." value="{{ $query ?? request('q') }}">
  </div>
  <select name="user" class="admin-activity-toolbar__select admin-activity-toolbar__select--users" onchange="this.form.submit()">
    @foreach ($users as $user)
      <option value="{{ $user }}" @selected(request('user', 'All Users') === $user)>{{ $user }}</option>
    @endforeach
  </select>
  <select name="action" class="admin-activity-toolbar__select admin-activity-toolbar__select--actions" onchange="this.form.submit()">
    @foreach ($actions as $action)
      <option value="{{ $action }}" @selected(request('action', 'All Actions') === $action)>{{ $action }}</option>
    @endforeach
  </select>
  <select name="date" class="admin-activity-toolbar__select admin-activity-toolbar__select--date" onchange="this.form.submit()">
    @foreach ($dateFilters as $filter)
      <option value="{{ $filter }}" @selected(request('date', 'Oct 24 - Oct 31, 2024') === $filter)>{{ $filter }}</option>
    @endforeach
  </select>
</form>
<form action="{{ route('admin.activity-logs.export') }}" method="POST">
  @csrf
  <button type="submit" class="admin-activity-toolbar__export">
    <svg width="16" height="16" viewBox="0 0 14 14" fill="none" aria-hidden="true">
      <path d="M9.3 12V7.3C9.3 7.2 9.3 7 9.1 6.9 9 6.7 8.8 6.7 8.7 6.7H3.3C3.2 6.7 3 6.7 2.9 6.9 2.7 7 2.7 7.2 2.7 7.3V12M2.7 0V2.7C2.7 2.8 2.7 3 2.9 3.1 3 3.3 3.2 3.3 3.3 3.3H8M8.1 0C8.5 0 8.8 0.1 9.1 0.4L11.6 2.9C11.9 3.2 12 3.5 12 3.9V10.7C12 11 11.9 11.4 11.6 11.6 11.4 11.9 11 12 10.7 12H1.3C1 12 0.6 11.9 0.4 11.6 0.1 11.4 0 11 0 10.7V1.3C0 1 0.1 0.6 0.4 0.4 0.6 0.1 1 0 1.3 0H8.1Z" transform="translate(1.17 1.17)" stroke="#1b3a6b" stroke-width="2" stroke-linecap="round"/>
    </svg>
    Export Logs
  </button>
</form>
</div>

<div class="admin-activity-table-wrap">
  <div class="admin-activity-table__head">
    <div>Timestamp</div>
    <div>User</div>
    <div>Action</div>
    <div>Details</div>
  </div>

  @forelse ($logs as $log)
    <div class="admin-activity-table__row">
      <div class="admin-activity-table__timestamp">{{ $log['timestamp'] }}</div>
      <div class="admin-activity-table__user">{{ $log['user'] }}</div>
      <div>
        <span class="admin-badge {{ \App\Support\AdminListing::activityLogActionClass($log['action']) }}">{{ $log['action'] }}</span>
      </div>
      <div class="admin-activity-table__details">{{ $log['details'] }}</div>
    </div>
  @empty
    <div class="admin-activity-table__empty">No activity logs found.</div>
  @endforelse

  @php
    $paginationQuery = request()->except('page');
    $displayFrom = $rangeFrom ?? 0;
    $displayTo = $rangeTo ?? 0;
    $totalCount = $displayTotal ?? 0;
    $pages = [];
    if ($lastPage <= 5) {
        $pages = range(1, max(1, $lastPage));
    } else {
        $pages = array_unique(array_filter([
            1,
            max(1, $currentPage - 1),
            $currentPage,
            min($lastPage, $currentPage + 1),
            $lastPage,
        ]));
        sort($pages);
    }
    $prevPage = null;
  @endphp

  <div class="admin-activity-table__footer">
    <p class="admin-activity-table__summary">
      @if ($totalCount > 0)
        Showing <strong>{{ number_format($displayFrom) }}-{{ number_format($displayTo) }}</strong> of <strong>{{ number_format($totalCount) }}</strong> activities
      @else
        No activities to display
      @endif
    </p>

    @if ($lastPage > 1)
      <nav class="admin-activity-pagination" aria-label="Activity logs pagination">
        @if ($currentPage > 1)
          <a href="{{ route('admin.activity-logs.index', array_merge($paginationQuery, ['page' => $currentPage - 1])) }}" class="admin-activity-pagination__btn" aria-label="Previous page">
            <svg width="6" height="10" viewBox="0 0 6 10" fill="none" aria-hidden="true"><path d="M4 8L0 4 4 0" transform="translate(1.5 1.25)" stroke="#64748b" stroke-width="2" stroke-linecap="round"/></svg>
          </a>
        @else
          <span class="admin-activity-pagination__btn is-disabled" aria-disabled="true">
            <svg width="6" height="10" viewBox="0 0 6 10" fill="none" aria-hidden="true"><path d="M4 8L0 4 4 0" transform="translate(1.5 1.25)" stroke="#64748b" stroke-width="2" stroke-linecap="round"/></svg>
          </span>
        @endif

        @foreach ($pages as $page)
          @if ($prevPage !== null && $page - $prevPage > 1)
            <span class="admin-activity-pagination__ellipsis">...</span>
          @endif
          @if ($page === $currentPage)
            <span class="admin-activity-pagination__page is-active" aria-current="page">{{ $page }}</span>
          @else
            <a href="{{ route('admin.activity-logs.index', array_merge($paginationQuery, ['page' => $page])) }}" class="admin-activity-pagination__page">{{ $page }}</a>
          @endif
          @php $prevPage = $page; @endphp
        @endforeach

        @if ($currentPage < $lastPage)
          <a href="{{ route('admin.activity-logs.index', array_merge($paginationQuery, ['page' => $currentPage + 1])) }}" class="admin-activity-pagination__btn" aria-label="Next page">
            <svg width="6" height="10" viewBox="0 0 6 10" fill="none" aria-hidden="true"><path d="M0 8L4 4 0 0" transform="translate(1.5 1.25)" stroke="#64748b" stroke-width="2" stroke-linecap="round"/></svg>
          </a>
        @else
          <span class="admin-activity-pagination__btn is-disabled" aria-disabled="true">
            <svg width="6" height="10" viewBox="0 0 6 10" fill="none" aria-hidden="true"><path d="M0 8L4 4 0 0" transform="translate(1.5 1.25)" stroke="#64748b" stroke-width="2" stroke-linecap="round"/></svg>
          </span>
        @endif
      </nav>
    @endif
  </div>
</div>
@endsection
