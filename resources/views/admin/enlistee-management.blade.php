@extends('layouts.admin')

@section('title', 'Enlistee Management')
@section('breadcrumb', 'Enlistee Management')

@section('content')
<div class="admin-page-header">
  <div>
    <h1 class="admin-page-title">Enlistee Management</h1>
    <p class="admin-page-subtitle">Review, process, and track enlistees from public enlistment forms.</p>
  </div>
  <div style="display: flex; gap: 12px; flex-wrap: wrap; align-items: center;">
    <div id="live-refresh-badge" class="admin-live-badge" hidden aria-live="polite">Live · just updated</div>
    <form action="{{ route('admin.enlistees.export') }}" method="POST" data-turbo="false">
      @csrf
      <button type="submit" class="admin-btn admin-btn--outline">Export List</button>
    </form>
    <button type="button" class="admin-btn admin-btn--accent" data-open-modal="modal-add-enlistee">+ New Enlistee</button>
  </div>
</div>

<form action="{{ route('admin.enlistees.index') }}" method="GET" class="admin-filter-panel">
  <div class="admin-filter-field admin-filter-field--grow">
    <label class="admin-filter-label" for="enlistee_search">Search</label>
    <div class="admin-filter-input-wrap">
      <svg width="16" height="16" viewBox="0 0 14 14" fill="none" aria-hidden="true" style="flex-shrink: 0;">
        <path d="M12 12L9.1 9.1M10.7 5.3C10.7 8.3 8.3 10.7 5.3 10.7 2.4 10.7 0 8.3 0 5.3 0 2.4 2.4 0 5.3 0 8.3 0 10.7 2.4 10.7 5.3Z" transform="translate(1.17 1.17)" stroke="#64748b" stroke-width="2" stroke-linecap="round"/>
      </svg>
      <input type="search" id="enlistee_search" name="q" class="admin-input" placeholder="Search name, email, or contact..." value="{{ $query ?? request('q') }}">
    </div>
  </div>
  <div class="admin-filter-field admin-filter-field--position">
    <label class="admin-filter-label" for="enlistee_position">Position</label>
    <select id="enlistee_position" name="position" class="admin-select" onchange="this.form.submit()">
      @foreach ($positionFilters as $filter)
        <option value="{{ $filter }}" @selected(request('position', 'All Positions') === $filter)>{{ $filter }}</option>
      @endforeach
    </select>
  </div>
  <div class="admin-filter-field admin-filter-field--status">
    <label class="admin-filter-label" for="enlistee_status">Status</label>
    <select id="enlistee_status" name="status" class="admin-select" onchange="this.form.submit()">
      <option value="">All Statuses</option>
      @foreach ($statuses as $status)
        <option value="{{ $status }}" @selected(request('status') === $status)>{{ $status }}</option>
      @endforeach
    </select>
  </div>
  <div class="admin-filter-field admin-filter-field--date">
    <label class="admin-filter-label" for="enlistee_date">Date Enlisted</label>
    <select id="enlistee_date" name="date" class="admin-select" onchange="this.form.submit()">
      @foreach ($dateFilters as $filter)
        <option value="{{ $filter }}" @selected(request('date', 'Last 30 Days') === $filter)>{{ $filter }}</option>
      @endforeach
    </select>
  </div>
  <a href="{{ route('admin.enlistees.index') }}" class="admin-btn admin-btn--reset">Reset</a>
</form>

<div class="admin-card">
  <div class="admin-table-wrap">
    <table class="admin-table">
      <thead>
        <tr>
          <th>Enlistee Name</th>
          <th>Position Enlisted</th>
          <th>Date Enlisted</th>
          <th>Contact</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody
        id="live-enlistee-rows"
        data-live-url="{{ route('admin.live.enlistees', $liveQuery ?? request()->except('page')) }}"
        data-live-interval="30000"
      >
        @include('partials.admin.enlistee-table-rows', [
          'enlistees' => $enlistees,
          'statuses' => $statuses,
        ])
      </tbody>
    </table>
  </div>

  @include('partials.public.pagination', [
    'currentPage' => $currentPage,
    'lastPage' => $lastPage,
    'routeName' => 'admin.enlistees.index',
    'query' => request()->except('page'),
  ])
</div>
@endsection

@push('modals')
  @include('partials.admin.modals.add-new-enlistee')
  @include('partials.admin.modals.edit-enlistee')
  @include('partials.admin.modals.enlistee-details')
@endpush
