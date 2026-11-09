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
    @include('partials.admin.icon', ['name' => 'plus'])
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
        <div class="admin-referral-table__col-actions admin-row-actions">
          <form action="{{ route('admin.referrals.approve') }}" method="POST"
            data-confirm="Approve the referral request for {{ $referral['name'] }} and mark it ready for endorsement."
            data-confirm-type="success"
            data-confirm-title="Approve referral?"
            data-confirm-ok="Approve">
            @csrf
            <input type="hidden" name="id" value="{{ $referral['id'] }}">
            <input type="hidden" name="name" value="{{ $referral['name'] }}">
            <button type="submit" class="admin-icon-btn" title="Approve referral" aria-label="Approve referral">
              @include('partials.admin.icon', ['name' => 'approve'])
            </button>
          </form>
          <form action="{{ route('admin.referrals.deny') }}" method="POST"
            data-confirm="Deny the referral request for {{ $referral['name'] }}. The applicant will remain on record as denied."
            data-confirm-type="warning"
            data-confirm-title="Deny referral?"
            data-confirm-ok="Deny request">
            @csrf
            <input type="hidden" name="id" value="{{ $referral['id'] }}">
            <input type="hidden" name="name" value="{{ $referral['name'] }}">
            <button type="submit" class="admin-icon-btn" title="Deny referral" aria-label="Deny referral">
              @include('partials.admin.icon', ['name' => 'deny'])
            </button>
          </form>
          <button type="button" class="admin-icon-btn" title="Print referral" aria-label="Print referral" data-admin-print-referral data-item-id="{{ $referral['id'] }}">
            @include('partials.admin.icon', ['name' => 'print'])
          </button>
          <button type="button" class="admin-icon-btn" title="Preview referral" aria-label="Preview referral"
            data-open-modal="modal-referral-preview"
            data-item-id="{{ $referral['id'] }}"
            data-name="{{ $referral['name'] }}"
            data-job="{{ $referral['job'] }}"
            data-employer="{{ $referral['employer'] }}"
            data-date="{{ $referral['date'] }}">
            @include('partials.admin.icon', ['name' => 'preview-document'])
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
  @include('partials.admin.modals.create-referral-letter', [
    'employers' => $employers,
    'enlistees' => $enlistees,
    'jobOptions' => $jobOptions,
  ])
  @include('partials.admin.modals.referral-preview')
@endpush
