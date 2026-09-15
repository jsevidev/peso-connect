@extends('layouts.admin')

@section('title', 'Referral Management')
@section('breadcrumb', 'Referral Management')

@section('content')
<div class="admin-page-header">
  <div>
    <h1 class="admin-page-title">Referral Management</h1>
    <p class="admin-page-subtitle">Review, approve, and generate official LGU endorsement letters for job enlistees.</p>
  </div>
  <button type="button" class="admin-btn admin-btn--primary admin-btn--create" data-open-modal="modal-create-referral">
    <svg width="14" height="14" viewBox="0 0 10 10" fill="none" aria-hidden="true"><path d="M0 4.0838H8.1676M4.0838 0V8.1676" transform="translate(1.24 1.24)" stroke="#fff" stroke-width="2" stroke-linecap="round"/></svg>
    Create Referral
  </button>
</div>

<div class="admin-referral-stats">
  @foreach ($stats as $stat)
    <div class="admin-referral-stat-card">
      <div class="admin-referral-stat-card__header">
        <span class="admin-referral-stat-card__label">{{ $stat['label'] }}</span>
        <div class="admin-referral-stat-card__icon" style="background: {{ $stat['icon_bg'] ?? '#e8eef5' }};">
          @if ($stat['label'] === 'Total Requests')
            <svg width="18" height="15" viewBox="0 0 17 15" fill="none" aria-hidden="true"><path d="M3 8.25L4.125 6.075C4.893 5.337 5.43 5.25 5.43 5.25H13.5C14.828 5.649 15.012 6.903 14.955 7.125L13.8 11.625C13.527 12.642 12.672 12.752 12.338 12.75H1.5C0.158 12.592 0 11.648 0 11.25V1.5C0 0.72 0.721 0 1.5 0H4.425C4.926 0.058 5.555 0.466 5.693 0.675L6.3 1.575C6.907 2.25 7.552 2.25 7.552 2.25H12C12.779 2.25 13.5 3.352 13.5 3.75V5.25" transform="translate(1.13 1.16)" stroke="{{ $stat['icon_stroke'] ?? '#1b3a6b' }}" stroke-width="2" stroke-linecap="round"/></svg>
          @elseif ($stat['label'] === 'Pending Review')
            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" aria-hidden="true"><path d="M7.5 3V7.5L10.5 9M15 7.5C15 11.643 11.643 15 7.5 15 3.358 15 0 11.643 0 7.5 0 3.358 3.358 0 7.5 0 11.643 0 15 3.358 15 7.5Z" transform="translate(1.13 1.13)" stroke="{{ $stat['icon_stroke'] ?? '#f57c00' }}" stroke-width="2" stroke-linecap="round"/></svg>
          @elseif ($stat['label'] === 'Approved')
            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" aria-hidden="true"><path d="M14.849 6.003C15.192 7.684 14.947 9.431 14.157 10.954 12.079 13.683 8.936 15.059 5.522 14.734 2.417 13.276 0.785 10.492 1.414 8.122 2.681 3.744 6.333 0.358 8.028 0.091 11.248 1.004M5.248 6.752L7.498 9.002 14.998 1.502" transform="translate(1.13 1.13)" stroke="{{ $stat['icon_stroke'] ?? '#2e7d32' }}" stroke-width="2" stroke-linecap="round"/></svg>
          @else
            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" aria-hidden="true"><path d="M9.751 5.25L5.251 9.75M5.251 5.25L9.751 9.75M15.001 7.5C15.001 11.643 11.643 15.001 7.501 15.001 3.358 15.001 0 11.643 0 7.5 0 3.358 3.358 0 7.501 0 11.643 0 15.001 3.358 15.001 7.5Z" transform="translate(1.13 1.13)" stroke="{{ $stat['icon_stroke'] ?? '#c62828' }}" stroke-width="2" stroke-linecap="round"/></svg>
          @endif
        </div>
      </div>
      <div class="admin-referral-stat-card__value">{{ $stat['value'] }}</div>
    </div>
  @endforeach
</div>

<form action="{{ route('admin.referrals.index') }}" method="GET" class="admin-referral-toolbar">
  <div class="admin-referral-search">
    <svg width="16" height="16" viewBox="0 0 14 14" fill="none" aria-hidden="true" style="flex-shrink: 0;">
      <path d="M12 12L9.1 9.1M10.7 5.3C10.7 8.3 8.3 10.7 5.3 10.7 2.4 10.7 0 8.3 0 5.3 0 2.4 2.4 0 5.3 0 8.3 0 10.7 2.4 10.7 5.3Z" transform="translate(1.17 1.17)" stroke="#5a6e85" stroke-width="2" stroke-linecap="round"/>
    </svg>
    <input type="search" name="q" class="admin-input" placeholder="Search enlistee name, position, or company..." value="{{ $query ?? request('q') }}">
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
  <div class="admin-referral-table">
    <div class="admin-referral-table__head">
      <div class="admin-referral-table__col-name">Enlistee Name</div>
      <div class="admin-referral-table__col-company">Target Company</div>
      <div class="admin-referral-table__col-position">Position</div>
      <div class="admin-referral-table__col-date">Date Requested</div>
      <div class="admin-referral-table__col-status">Status</div>
      <div class="admin-referral-table__col-actions">Actions</div>
    </div>
    @forelse ($referrals as $referral)
      <div class="admin-referral-table__row">
        <div class="admin-referral-table__col-name">
          <div class="admin-referral-name">{{ $referral['name'] }}</div>
          <div class="admin-referral-name__sub">Enlistee</div>
        </div>
        <div class="admin-referral-table__col-company admin-referral-cell">{{ $referral['employer'] }}</div>
        <div class="admin-referral-table__col-position admin-referral-cell">{{ $referral['job'] }}</div>
        <div class="admin-referral-table__col-date">{{ $referral['date'] }}</div>
        <div class="admin-referral-table__col-status">
          <span class="admin-badge {{ \App\Support\AdminListing::referralStatusClass($referral['status']) }}">{{ $referral['status'] }}</span>
        </div>
        <div class="admin-referral-table__col-actions">
          <form action="{{ route('admin.referrals.approve') }}" method="POST" style="display: inline;"
            data-confirm="Approve the referral request for {{ $referral['name'] }} and mark it ready for endorsement."
            data-confirm-type="success"
            data-confirm-title="Approve referral?"
            data-confirm-ok="Approve">
            @csrf
            <input type="hidden" name="id" value="{{ $referral['id'] }}">
            <input type="hidden" name="name" value="{{ $referral['name'] }}">
            <button type="submit" class="admin-icon-btn admin-icon-btn--neutral" title="Approve referral" aria-label="Approve referral">
              <svg width="14" height="14" viewBox="0 0 13 10" fill="none"><path d="M10.666 0L3.333 7.333 0 4" transform="translate(1.19 1.27)" stroke="#404d66" stroke-width="2" stroke-linecap="round"/></svg>
            </button>
          </form>
          <form action="{{ route('admin.referrals.deny') }}" method="POST" style="display: inline;"
            data-confirm="Deny the referral request for {{ $referral['name'] }}. The applicant will remain on record as denied."
            data-confirm-type="warning"
            data-confirm-title="Deny referral?"
            data-confirm-ok="Deny request">
            @csrf
            <input type="hidden" name="id" value="{{ $referral['id'] }}">
            <input type="hidden" name="name" value="{{ $referral['name'] }}">
            <button type="submit" class="admin-icon-btn admin-icon-btn--neutral" title="Deny referral" aria-label="Deny referral">
              <svg width="14" height="14" viewBox="0 0 15 15" fill="none"><path d="M8.667 4.667L4.667 8.667M4.667 4.667L8.667 8.667M13.334 6.667C13.334 10.349 10.349 13.334 6.667 13.334 2.985 13.334 0 10.349 0 6.667 0 2.985 2.985 0 6.667 0 10.349 0 13.334 2.985 13.334 6.667Z" transform="translate(1.15 1.15)" stroke="#404d66" stroke-width="2" stroke-linecap="round"/></svg>
            </button>
          </form>
          <button type="button" class="admin-icon-btn admin-icon-btn--neutral" title="Print referral" aria-label="Print referral" data-admin-print>
            <svg width="14" height="14" viewBox="0 0 15 15" fill="none"><path d="M2.667 10.668H1.333C0.98 10.668 0.641 10.527 0.391 10.277 0.141 10.027 0 9.688 0 9.334V6.001C0 5.647 0.141 5.308 0.391 5.058 0.641 4.808 0.98 4.668 1.333 4.668H12.001C12.355 4.668 12.694 4.808 12.944 5.058 13.194 5.308 13.334 5.647 13.334 6.001V9.334C13.334 9.688 13.194 10.027 12.944 10.277 12.694 10.527 12.355 10.668 12.001 10.668H10.668M2.667 4.668V0.667C2.667 0.49 2.737 0.32 2.862 0.195 2.987 0.07 3.157 0 3.334 0H10.001C10.178 0 10.347 0.07 10.472 0.195 10.597 0.32 10.668 0.49 10.668 0.667V4.668M3.334 8.001H10.001C10.369 8.001 10.668 8.299 10.668 8.667V12.668C10.668 13.036 10.369 13.334 10.001 13.334H3.334C2.965 13.334 2.667 13.036 2.667 12.668V8.667C2.667 8.299 2.965 8.001 3.334 8.001Z" transform="translate(1.15 1.15)" stroke="#404d66" stroke-width="2" stroke-linecap="round"/></svg>
          </button>
          <button type="button" class="admin-icon-btn admin-icon-btn--neutral" title="Preview referral" aria-label="Preview referral"
            data-open-modal="modal-referral-preview"
            data-item-id="{{ $referral['id'] }}"
            data-name="{{ $referral['name'] }}"
            data-job="{{ $referral['job'] }}"
            data-employer="{{ $referral['employer'] }}"
            data-date="{{ $referral['date'] }}">
            <svg width="14" height="14" viewBox="0 0 15 15" fill="none"><path d="M6 0.664H1.333C0.98 0.664 0.641 0.805 0.391 1.055 0.141 1.305 0 1.644 0 1.997V11.331C0 11.684 0.141 12.024 0.391 12.274 0.641 12.524 0.98 12.664 1.333 12.664H10.667C11.02 12.664 11.359 12.524 11.609 12.274 11.859 12.024 12 11.684 12 11.331V6.664M10.25 0.414C10.515 0.149 10.875 0 11.25 0 11.625 0 11.985 0.149 12.25 0.414 12.515 0.679 12.664 1.039 12.664 1.414 12.664 1.789 12.515 2.149 12.25 2.414L6.241 8.424C6.083 8.582 5.888 8.698 5.673 8.76L3.757 9.32C3.327 9.337 3.341 9.082 3.904 6.992L4.241 6.424L10.25 0.414Z" transform="translate(1.16 1.16)" stroke="#404d66" stroke-width="2" stroke-linecap="round"/></svg>
          </button>
        </div>
      </div>
    @empty
      <div class="admin-referral-table__row">
        <div style="width: 100%; text-align: center; color: #64748b; padding: 8px 0;">No referrals found.</div>
      </div>
    @endforelse
  </div>
</div>

@include('partials.public.pagination', [
  'currentPage' => $currentPage,
  'lastPage' => $lastPage,
  'routeName' => 'admin.referrals.index',
  'query' => request()->except('page'),
])
@endsection

@push('modals')
  @include('partials.admin.modals.create-referral-letter')
  @include('partials.admin.modals.referral-preview')
@endpush
