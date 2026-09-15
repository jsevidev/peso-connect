@extends('layouts.admin')

@section('title', 'Job Management')
@section('breadcrumb', 'Job Management')

@section('content')
<div class="admin-page-header">
  <div>
    <h1 class="admin-page-title">Job Management</h1>
    <p class="admin-page-subtitle">Create, edit, and monitor verified job opportunities.</p>
  </div>
  <button type="button" class="admin-btn admin-btn--accent" data-open-modal="modal-add-job">+ Add New Job</button>
</div>

<form action="{{ route('admin.jobs.index') }}" method="GET" class="admin-filters">
  <input type="search" name="q" class="admin-input" placeholder="Search jobs or agencies..." value="{{ $query ?? request('q') }}" style="max-width: 280px;">
  <select name="category" class="admin-select" style="max-width: 160px;" onchange="this.form.submit()">
    @foreach ($categories as $category)
      <option value="{{ $category }}" @selected(request('category', 'All') === $category)>Category: {{ $category }}</option>
    @endforeach
  </select>
  <select name="status" class="admin-select" style="max-width: 160px;" onchange="this.form.submit()">
    <option value="">Status: All</option>
    @foreach ($statuses as $status)
      <option value="{{ $status }}" @selected(request('status') === $status)>{{ $status }}</option>
    @endforeach
  </select>
  <select name="posted" class="admin-select" style="max-width: 160px;">
    @foreach ($postedFilters as $filter)
      <option value="{{ $filter }}" @selected(request('posted', 'Anytime') === $filter)>Posted: {{ $filter }}</option>
    @endforeach
  </select>
  <button type="submit" class="admin-btn admin-btn--ghost">Search</button>
</form>

<div class="admin-card">
  <div class="admin-table-wrap">
    <table class="admin-table">
      <thead>
        <tr>
          <th>Job Title</th>
          <th>Agency / Company</th>
          <th>Type</th>
          <th>Posted</th>
          <th>Enlistments</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($jobs as $job)
          <tr>
            <td style="font-weight: 600;">{{ $job['title'] }}</td>
            <td>
              <span style="display: inline-flex; align-items: center; gap: 8px;">
                <span class="admin-company-badge">{{ $job['company_abbr'] }}</span>
                {{ $job['company'] }}
              </span>
            </td>
            <td>{{ $job['type'] }}</td>
            <td>{{ $job['posted'] }}</td>
            <td>{{ $job['enlistments'] }}</td>
            <td><span class="admin-badge {{ \App\Support\AdminListing::statusClass($job['status']) }}">{{ $job['status'] }}</span></td>
            <td>
              <div class="admin-row-actions">
                <button type="button" class="admin-icon-btn" title="Edit job" aria-label="Edit job"
                  data-open-modal="modal-edit-job"
                  data-item-id="{{ $job['id'] }}"
                  data-title="{{ $job['title'] }}"
                  data-company="{{ $job['company'] }}"
                  data-type="{{ $job['type'] }}"
                  data-status="{{ $job['status'] }}">
                  <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M10 1l3 3L4 13H1v-3L10 1z" stroke="#1b3a6b" stroke-width="1.5"/></svg>
                </button>
                <form action="{{ route('admin.jobs.archive') }}" method="POST"
                  data-confirm="“{{ $job['title'] }}” will be moved to archived listings and hidden from the public jobs page."
                  data-confirm-type="warning"
                  data-confirm-title="Archive this job?"
                  data-confirm-ok="Archive job">
                  @csrf
                  <input type="hidden" name="id" value="{{ $job['id'] }}">
                  <input type="hidden" name="title" value="{{ $job['title'] }}">
                  <button type="submit" class="admin-icon-btn admin-icon-btn--amber" title="Archive job" aria-label="Archive job">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M1 4h12M4 4V2h6v2M5 7v3M9 7v3M2 4l1 8h8l1-8" stroke="#d97706" stroke-width="1.5"/></svg>
                  </button>
                </form>
                <form action="{{ route('admin.jobs.delete') }}" method="POST"
                  data-confirm="“{{ $job['title'] }}” will be permanently deleted. This cannot be undone."
                  data-confirm-type="danger"
                  data-confirm-title="Delete job listing?"
                  data-confirm-ok="Delete job">
                  @csrf
                  <input type="hidden" name="id" value="{{ $job['id'] }}">
                  <input type="hidden" name="title" value="{{ $job['title'] }}">
                  <button type="submit" class="admin-icon-btn admin-icon-btn--danger" title="Delete job" aria-label="Delete job">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2 4h10M5 4V2h4v2M3 4l1 9h6l1-9" stroke="#ef4444" stroke-width="1.5"/></svg>
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr><td colspan="7" style="text-align: center; color: #64748b;">No jobs found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @include('partials.public.pagination', [
    'currentPage' => $currentPage,
    'lastPage' => $lastPage,
    'routeName' => 'admin.jobs.index',
    'query' => request()->except('page'),
  ])
</div>
@endsection

@push('modals')
  @include('partials.admin.modals.add-new-job')
  @include('partials.admin.modals.edit-job')
@endpush
