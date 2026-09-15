@extends('layouts.admin')

@section('title', 'Enlistee Management')
@section('breadcrumb', 'Enlistee Management')

@section('content')
<div class="admin-page-header">
  <div>
    <h1 class="admin-page-title">Enlistee Management</h1>
    <p class="admin-page-subtitle">Review, process, and track enlistees from public enlistment forms.</p>
  </div>
  <div style="display: flex; gap: 12px; flex-wrap: wrap;">
    <form action="{{ route('admin.enlistees.export') }}" method="POST">
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
      <tbody>
        @forelse ($enlistees as $enlistee)
          <tr>
            <td style="font-weight: 600;">{{ $enlistee['name'] }}</td>
            <td>{{ $enlistee['position'] }}</td>
            <td>{{ $enlistee['date'] }}</td>
            <td>{{ $enlistee['contact'] }}</td>
            <td>
              <form action="{{ route('admin.enlistees.status') }}" method="POST" style="display: inline;">
                @csrf
                <input type="hidden" name="id" value="{{ $enlistee['id'] }}">
                <div class="admin-status-pill admin-badge {{ \App\Support\AdminListing::statusClass($enlistee['status']) }}">
                  <select name="status" class="admin-status-pill__select" aria-label="Change status for {{ $enlistee['name'] }}" onchange="this.form.submit()">
                    @foreach ($statuses as $status)
                      <option value="{{ $status }}" @selected($enlistee['status'] === $status)>{{ $status }}</option>
                    @endforeach
                  </select>
                </div>
              </form>
            </td>
            <td>
              <div class="admin-row-actions">
                <button type="button" class="admin-icon-btn" title="Edit enlistee" aria-label="Edit enlistee"
                  data-open-modal="modal-edit-enlistee"
                  data-item-id="{{ $enlistee['id'] }}"
                  data-name="{{ $enlistee['name'] }}"
                  data-contact="{{ $enlistee['contact'] }}"
                  data-address="{{ $enlistee['address'] ?? '' }}"
                  data-skills="{{ $enlistee['skills'] ?? '' }}"
                  data-education="{{ $enlistee['education'] ?? '' }}">
                  <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M10 1l3 3L4 13H1v-3L10 1z" stroke="#1b3a6b" stroke-width="1.5"/></svg>
                </button>
                <button type="button" class="admin-icon-btn" title="View details" aria-label="View details"
                  data-open-modal="modal-enlistee-details"
                  data-item-id="{{ $enlistee['id'] }}"
                  data-name="{{ $enlistee['name'] }}"
                  data-contact="{{ $enlistee['contact'] }}"
                  data-address="{{ $enlistee['address'] ?? '' }}"
                  data-skills="{{ $enlistee['skills'] ?? '' }}"
                  data-education="{{ $enlistee['education'] ?? '' }}">
                  <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M1 7s2.5-4 6-4 6 4 6 4-2.5 4-6 4-6-4-6-4z" stroke="#64748b" stroke-width="1.5"/><circle cx="7" cy="7" r="2" stroke="#64748b" stroke-width="1.5"/></svg>
                </button>
                <form action="{{ route('admin.enlistees.delete') }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete enlistee {{ addslashes($enlistee['name']) }}? This cannot be undone.');">
                  @csrf
                  <input type="hidden" name="id" value="{{ $enlistee['id'] }}">
                  <button type="submit" class="admin-icon-btn" title="Delete enlistee" aria-label="Delete enlistee">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2 4h10M5 4V2h4v2M5.5 6v5M8.5 6v5M3 4l.5 8h7L11 4" stroke="#b91c1c" stroke-width="1.5" stroke-linecap="round"/></svg>
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr><td colspan="6" style="text-align: center; color: #64748b;">No enlistees found.</td></tr>
        @endforelse
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
