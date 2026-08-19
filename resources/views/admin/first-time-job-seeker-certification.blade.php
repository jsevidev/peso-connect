@extends('layouts.admin')

@section('title', 'FTJS Certification')
@section('breadcrumb', 'FTJS Certification')

@section('content')
<div class="admin-page-header">
  <div>
    <h1 class="admin-page-title">First-time Job Seeker Certification Management</h1>
    <p class="admin-page-subtitle">Track and manage FTJS certifications for first-time job seekers in the municipality.</p>
  </div>
</div>

<div class="admin-referral-stats">
  @foreach ($stats as $stat)
    <div class="admin-referral-stat-card">
      <div class="admin-referral-stat-card__header">
        <span class="admin-referral-stat-card__label">{{ $stat['label'] }}</span>
        <div class="admin-referral-stat-card__icon" style="background: {{ $stat['icon_bg'] ?? '#e8eef5' }};">
          @if ($stat['label'] === 'Total Certifications')
            <svg width="18" height="15" viewBox="0 0 10 15" fill="none" aria-hidden="true"><path d="M6.318 7.26L7.328 12.944C7.34 13.011 7.33 13.08 7.301 13.14 7.272 13.202 7.226 13.254 7.167 13.288 7.108 13.322 7.04 13.337 6.973 13.332 6.905 13.326 6.841 13.3 6.788 13.257L4.402 11.466C4.286 11.38 4.146 11.333 4.003 11.333 3.859 11.333 3.719 11.38 3.604 11.466L1.213 13.256C1.16 13.299 1.096 13.325 1.029 13.331 0.961 13.336 0.893 13.321 0.835 13.287 0.776 13.253 0.729 13.202 0.7 13.141 0.672 13.079 0.662 13.011 0.673 12.944L1.682 7.26M8 4C8 6.209 6.209 8 4 8 1.791 8 0 6.209 0 4 0 1.791 1.791 0 4 0 6.209 0 8 1.791 8 4Z" transform="translate(1.25 1.15)" stroke="{{ $stat['icon_stroke'] ?? '#1b3a6b' }}" stroke-width="2" stroke-linecap="round"/></svg>
          @elseif ($stat['label'] === 'Pending Approval')
            <svg width="17" height="17" viewBox="0 0 15 15" fill="none" aria-hidden="true"><path d="M6.667 2.667V6.667L9.334 8M13.334 6.667C13.334 10.349 10.349 13.334 6.667 13.334 2.985 13.334 0 10.349 0 6.667 0 2.985 2.985 0 6.667 0 10.349 0 13.334 2.985 13.334 6.667Z" transform="translate(1.15 1.15)" stroke="{{ $stat['icon_stroke'] ?? '#f57c00' }}" stroke-width="2" stroke-linecap="round"/></svg>
          @elseif ($stat['label'] === 'Claimed')
            <svg width="17" height="17" viewBox="0 0 15 15" fill="none" aria-hidden="true"><path d="M13.199 5.336C13.504 6.83 13.287 8.383 12.584 9.737 11.882 11.09 10.737 12.162 9.34 12.774 7.943 13.385 6.379 13.5 4.908 13.097 3.437 12.695 2.149 11.801 1.257 10.563 0.366 9.326-0.074 7.82 0.01 6.298 0.095 4.775 0.698 3.328 1.721 2.196 2.743 1.065 4.123 0.319 5.629 0.081 7.136-0.156 8.678 0.13 9.998 0.892M4.665 6.002L6.665 8.002 13.332 1.335" transform="translate(1.15 1.15)" stroke="{{ $stat['icon_stroke'] ?? '#2e7d32' }}" stroke-width="2" stroke-linecap="round"/></svg>
          @else
            <svg width="17" height="17" viewBox="0 0 15 15" fill="none" aria-hidden="true"><path d="M6.667 4V6.667M6.667 9.334H6.674M13.334 6.667C13.334 10.349 10.349 13.334 6.667 13.334 2.985 13.334 0 10.349 0 6.667 0 2.985 2.985 0 6.667 0 10.349 0 13.334 2.985 13.334 6.667Z" transform="translate(1.15 1.15)" stroke="{{ $stat['icon_stroke'] ?? '#c62828' }}" stroke-width="2" stroke-linecap="round"/></svg>
          @endif
        </div>
      </div>
      <div class="admin-referral-stat-card__value">{{ $stat['value'] }}</div>
    </div>
  @endforeach
</div>

<form action="{{ route('admin.certifications.index') }}" method="GET" class="admin-referral-toolbar">
  <div class="admin-referral-search">
    <svg width="16" height="16" viewBox="0 0 14 14" fill="none" aria-hidden="true" style="flex-shrink: 0;">
      <path d="M12 12L9.1 9.1M10.7 5.3C10.7 8.3 8.3 10.7 5.3 10.7 2.4 10.7 0 8.3 0 5.3 0 2.4 2.4 0 5.3 0 8.3 0 10.7 2.4 10.7 5.3Z" transform="translate(1.17 1.17)" stroke="#5a6e85" stroke-width="2" stroke-linecap="round"/>
    </svg>
    <input type="search" name="q" class="admin-input" placeholder="Search enlistee name" value="{{ $query ?? request('q') }}">
  </div>
  <select name="status" class="admin-referral-filter-select" onchange="this.form.submit()">
    <option value="">Status: All</option>
    @foreach ($statuses as $status)
      <option value="{{ $status }}" @selected(request('status') === $status)>Status: {{ $status }}</option>
    @endforeach
  </select>
  <select name="date" class="admin-referral-filter-select" onchange="this.form.submit()">
    @foreach ($dateFilters as $filter)
      <option value="{{ $filter }}" @selected(request('date', 'This Month') === $filter)>Date: {{ $filter }}</option>
    @endforeach
  </select>
</form>

<div class="admin-referral-table-wrap">
  <div class="admin-referral-table admin-referral-table--ftjs">
    <div class="admin-referral-table__head">
      <div class="admin-referral-table__col-name">Enlistee Name</div>
      <div class="admin-referral-table__col-date">Date Applied</div>
      <div class="admin-ftjs-table__col-barangay">Barangay</div>
      <div class="admin-referral-table__col-status">Status</div>
      <div class="admin-ftjs-table__col-actions">Actions</div>
    </div>
    @forelse ($certifications as $cert)
      <div class="admin-referral-table__row">
        <div class="admin-referral-table__col-name">
          <div class="admin-referral-name">{{ $cert['name'] }}</div>
          <div class="admin-referral-name__sub">First-Time Seeker</div>
        </div>
        <div class="admin-referral-table__col-date">{{ $cert['date'] }}</div>
        <div class="admin-ftjs-table__col-barangay">{{ $cert['barangay'] }}</div>
        <div class="admin-referral-table__col-status">
          <span class="admin-badge {{ \App\Support\AdminListing::certificationStatusClass($cert['status']) }}">{{ $cert['status'] }}</span>
        </div>
        <div class="admin-ftjs-table__col-actions">
          <div class="admin-ftjs-actions">
            <form action="{{ route('admin.certifications.print') }}" method="POST">
              @csrf
              <input type="hidden" name="id" value="{{ $cert['id'] }}">
              <input type="hidden" name="name" value="{{ $cert['name'] }}">
              <button type="submit" class="admin-ftjs-btn admin-ftjs-btn--print">
                <svg width="14" height="14" viewBox="0 0 12 12" fill="none" aria-hidden="true"><path d="M2 8H1C0.735 8 0.48 7.895 0.293 7.707 0.105 7.52 0 7.266 0 7V4.5C0 4.235 0.105 3.981 0.293 3.793 0.48 3.606 0.735 3.5 1 3.5H9C9.266 3.5 9.52 3.606 9.707 3.793 9.895 3.981 10 4.235 10 4.5V7C10 7.266 9.895 7.52 9.707 7.707 9.52 7.895 9.266 8 9 8H8M2 3.5V0.5C2 0.367 2.053 0.24 2.147 0.146 2.24 0.053 2.368 0 2.5 0H7.5C7.633 0 7.76 0.053 7.854 0.146 7.948 0.24 8 0.367 8 0.5V3.5M2.5 6H7.5C7.777 6 8 6.224 8 6.5V9.5C8 9.777 7.777 10 7.5 10H2.5C2.224 10 2 9.777 2 9.5V6.5C2 6.224 2.224 6 2.5 6Z" transform="translate(1.2 1.2)" stroke="#1b3a6b" stroke-width="2" stroke-linecap="round"/></svg>
                Print
              </button>
            </form>
            @if ($cert['status'] === 'Claimed')
              <button type="button" class="admin-ftjs-btn admin-ftjs-btn--claimed" disabled>
                <svg width="14" height="14" viewBox="0 0 10 8" fill="none" aria-hidden="true"><path d="M8 0L2.5 5.5 0 3" transform="translate(1.25 1.36)" stroke="#5a6e85" stroke-width="2" stroke-linecap="round"/></svg>
                Claimed
              </button>
            @else
              <form action="{{ route('admin.certifications.claim') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $cert['id'] }}">
                <input type="hidden" name="name" value="{{ $cert['name'] }}">
                <button type="submit" class="admin-ftjs-btn admin-ftjs-btn--claim">
                  <svg width="14" height="14" viewBox="0 0 10 8" fill="none" aria-hidden="true"><path d="M8 0L2.5 5.5 0 3" transform="translate(1.25 1.36)" stroke="#fff" stroke-width="2" stroke-linecap="round"/></svg>
                  Mark Claimed
                </button>
              </form>
            @endif
          </div>
        </div>
      </div>
    @empty
      <div class="admin-referral-table__row">
        <div style="grid-column: 1 / -1; text-align: center; color: #64748b; padding: 8px 0;">No certification requests found.</div>
      </div>
    @endforelse
  </div>
</div>

@include('partials.public.pagination', [
  'currentPage' => $currentPage,
  'lastPage' => $lastPage,
  'routeName' => 'admin.certifications.index',
  'query' => request()->except('page'),
])
@endsection
