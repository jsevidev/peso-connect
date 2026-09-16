@extends('layouts.admin')

@section('title', 'Employer Management')
@section('breadcrumb', 'Employer Management')

@section('content')
<div class="admin-page-header">
  <div>
    <h1 class="admin-page-title">Employer Management</h1>
    <p class="admin-page-subtitle">Maintain registered agencies and companies linked to job postings and referrals.</p>
  </div>
  <button type="button" class="admin-btn admin-btn--accent" data-open-modal="modal-add-employer">+ Add Employer</button>
</div>

<form action="{{ route('admin.employers.index') }}" method="GET" class="admin-filters">
  <input type="search" name="q" class="admin-input" placeholder="Search employer name or contact..." value="{{ $query ?? request('q') }}" style="max-width: 320px;">
  <button type="submit" class="admin-btn admin-btn--ghost">Search</button>
</form>

<div class="admin-card">
  <div class="admin-table-wrap">
    <table class="admin-table">
      <thead>
        <tr>
          <th>Employer</th>
          <th>Contact</th>
          <th>Jobs</th>
          <th>Verification</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($employers as $employer)
          <tr>
            <td>
              <span style="display: inline-flex; align-items: center; gap: 8px;">
                <span class="admin-company-badge">{{ $employer['abbr'] }}</span>
                <strong>{{ $employer['name'] }}</strong>
              </span>
            </td>
            <td>
              <div>{{ $employer['contact_person'] ?: '—' }}</div>
              <div style="color: #64748b; font-size: 13px;">{{ $employer['contact_email'] ?: '—' }}</div>
            </td>
            <td>{{ $employer['job_count'] }}</td>
            <td>
              @if ($employer['peso_verified'])
                <span class="admin-badge admin-badge--green">PESO Verified</span>
              @else
                <span class="admin-badge admin-badge--gray">Standard</span>
              @endif
            </td>
            <td><span class="admin-badge {{ \App\Support\AdminListing::statusClass($employer['status']) }}">{{ $employer['status'] }}</span></td>
            <td>
              <div class="admin-row-actions">
                <button type="button" class="admin-icon-btn" title="Edit employer" aria-label="Edit employer"
                  data-open-modal="modal-edit-employer"
                  data-item-id="{{ $employer['id'] }}"
                  data-name="{{ $employer['name'] }}"
                  data-contact-person="{{ $employer['contact_person'] ?? '' }}"
                  data-contact-email="{{ $employer['contact_email'] ?? '' }}"
                  data-address="{{ $employer['address'] ?? '' }}"
                  data-peso-verified="{{ $employer['peso_verified'] ? '1' : '0' }}"
                  data-status="{{ $employer['status'] }}">
                  <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M10 1l3 3L4 13H1v-3L10 1z" stroke="#1b3a6b" stroke-width="1.5"/></svg>
                </button>
                <form action="{{ route('admin.employers.delete') }}" method="POST" style="display: inline;"
                  data-confirm="{{ $employer['job_count'] > 0 ? 'This employer has job postings and will be deactivated instead of deleted.' : 'This will permanently remove '.$employer['name'].' from employer records.' }}"
                  data-confirm-type="danger"
                  data-confirm-title="{{ $employer['job_count'] > 0 ? 'Deactivate employer?' : 'Delete employer?' }}"
                  data-confirm-ok="{{ $employer['job_count'] > 0 ? 'Deactivate' : 'Delete employer' }}">
                  @csrf
                  <input type="hidden" name="id" value="{{ $employer['id'] }}">
                  <button type="submit" class="admin-icon-btn" title="{{ $employer['job_count'] > 0 ? 'Deactivate employer' : 'Delete employer' }}" aria-label="Remove employer">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2 4h10M5 4V2h4v2M5.5 6v5M8.5 6v5M3 4l.5 8h7L11 4" stroke="#b91c1c" stroke-width="1.5" stroke-linecap="round"/></svg>
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr><td colspan="6" style="text-align: center; color: #64748b;">No employers found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @include('partials.public.pagination', [
    'currentPage' => $currentPage,
    'lastPage' => $lastPage,
    'routeName' => 'admin.employers.index',
    'query' => request()->except('page'),
  ])
</div>
@endsection

@push('modals')
  @include('partials.admin.modals.add-employer')
  @include('partials.admin.modals.edit-employer')
@endpush
