@extends('layouts.admin')

@section('title', 'Announcements')
@section('breadcrumb', 'Announcements')

@section('content')
<div class="admin-page-header">
  <div>
    <h1 class="admin-page-title admin-page-title--announcements">Announcements Management</h1>
    <p class="admin-page-subtitle">Publish public bulletins, job fair advisories, and vocational training notifications.</p>
  </div>
  <button type="button" class="admin-btn admin-btn--accent" data-open-modal="modal-create-announcement">
    <svg width="12" height="12" viewBox="0 0 11 11" fill="none" aria-hidden="true"><path d="M0 4.667H9.334M4.667 0V9.334" transform="translate(1.21 1.21)" stroke="#fff" stroke-width="2" stroke-linecap="round"/></svg>
    Create New
  </button>
</div>

<div class="admin-announcements-toolbar">
  <div class="admin-announcement-tabs">
    <a href="{{ route('admin.announcements.index', request()->except(['status', 'page'])) }}" class="admin-announcement-tab @if (!request('status')) is-active @endif">
      All
      <span class="admin-announcement-tab__count">{{ $tabCounts['all'] ?? 0 }}</span>
    </a>
    @foreach ($filterTabs as $tab)
      <a href="{{ route('admin.announcements.index', array_merge(request()->except('page'), ['status' => $tab])) }}" class="admin-announcement-tab @if (request('status') === $tab) is-active @endif">
        {{ $tab }}
        <span class="admin-announcement-tab__count">{{ $tabCounts[$tab] ?? 0 }}</span>
      </a>
    @endforeach
  </div>

  <form action="{{ route('admin.announcements.index') }}" method="GET" class="admin-announcement-sort">
    @foreach (request()->except(['sort', 'page']) as $key => $value)
      <input type="hidden" name="{{ $key }}" value="{{ $value }}">
    @endforeach
    <span>Sort by:</span>
    <select name="sort" onchange="this.form.submit()">
      @foreach ($sortOptions as $option)
        <option value="{{ $option }}" @selected(request('sort', 'Recent First') === $option)>{{ $option }}</option>
      @endforeach
    </select>
    <svg width="9" height="6" viewBox="0 0 9 6" fill="none" aria-hidden="true"><path d="M0 0L3.5 3.5 7 0" transform="translate(1.29 1.57)" stroke="#64748b" stroke-width="2" stroke-linecap="round"/></svg>
  </form>
</div>

<div class="admin-announcement-list">
  @forelse ($announcements as $item)
    <article class="admin-announcement-card">
      <div class="admin-announcement-card__head">
        <h2 class="admin-announcement-card__title">{{ $item['title'] }}</h2>
        <div class="admin-announcement-card__actions">
          <button type="button" class="admin-announcement-action" title="Preview" aria-label="Preview"
            data-open-modal="modal-preview-announcement"
            data-item-id="{{ $item['id'] }}"
            data-title="{{ $item['title'] }}"
            data-excerpt="{{ $item['excerpt'] }}"
            data-author="{{ $item['author'] }}"
            data-category="{{ $item['category'] ?? '' }}"
            data-publish-date="{{ $item['publish_date'] ?? '' }}"
            data-status="{{ $item['status'] }}">
            <svg width="16" height="12" viewBox="0 0 15 11" fill="none" aria-hidden="true"><path d="M0.042 4.898C-0.014 4.748-0.014 4.584 0.042 4.434 0.583 3.122 1.501 2 2.681 1.211 3.86 0.421 5.248 0 6.667 0 8.086 0 9.474 0.421 10.653 1.211 11.833 2 12.751 3.122 13.292 4.434 13.348 4.584 13.348 4.748 13.292 4.898 12.751 6.21 11.833 7.332 10.653 8.122 9.474 8.911 8.086 9.333 6.667 9.333 5.248 9.333 3.86 8.911 2.681 8.122 1.501 7.332 0.583 6.21 0.042 4.898ZM8.667 4.666C8.667 5.771 7.772 6.666 6.667 6.666 5.563 6.666 4.667 5.771 4.667 4.666 4.667 3.561 5.563 2.666 6.667 2.666 7.772 2.666 8.667 3.561 8.667 4.666Z" transform="translate(1.15 1.21)" stroke="#475569" stroke-width="2" stroke-linecap="round"/></svg>
          </button>
          <button type="button" class="admin-announcement-action" title="Edit" aria-label="Edit"
            data-open-modal="modal-edit-announcement"
            data-item-id="{{ $item['id'] }}"
            data-title="{{ $item['title'] }}"
            data-excerpt="{{ $item['excerpt'] }}"
            data-author="{{ $item['author'] }}"
            data-category="{{ $item['category'] ?? '' }}"
            data-publish-date="{{ $item['publish_date'] ?? '' }}"
            data-status="{{ $item['status'] }}"
            data-schedule-later="{{ $item['status'] === 'Scheduled' ? '1' : '0' }}">
            <svg width="16" height="16" viewBox="0 0 15 15" fill="none" aria-hidden="true"><path d="M12.784 3.208C13.136 2.856 13.334 2.378 13.334 1.88 13.335 1.381 13.137 0.903 12.784 0.551 12.432 0.198 11.954 0 11.455 0 10.957 0 10.479 0.198 10.126 0.55L1.228 9.449C1.073 9.604 0.959 9.794 0.895 10.003L0.014 12.904C-0.003 12.962-0.005 13.023 0.01 13.081 0.025 13.14 0.055 13.193 0.098 13.235 0.14 13.278 0.194 13.308 0.252 13.323 0.31 13.337 0.372 13.336 0.429 13.319L3.332 12.439C3.54 12.375 3.73 12.261 3.885 12.107L12.784 3.208Z" transform="translate(1.15 1.15)" stroke="#475569" stroke-width="2" stroke-linecap="round"/></svg>
          </button>
          <form action="{{ route('admin.announcements.delete') }}" method="POST" data-confirm="Delete this announcement?">
            @csrf
            <input type="hidden" name="id" value="{{ $item['id'] }}">
            <input type="hidden" name="title" value="{{ $item['title'] }}">
            <button type="submit" class="admin-announcement-action admin-announcement-action--danger" title="Delete" aria-label="Delete">
              <svg width="14" height="16" viewBox="0 0 14 15" fill="none" aria-hidden="true"><path d="M4.667 6V10M7.333 6V10M10.667 2.667V12C10.667 12.355 10.526 12.694 10.276 12.944 10.026 13.194 9.687 13.334 9.333 13.334H2.667C2.313 13.334 1.974 13.194 1.724 12.944 1.474 12.694 1.333 12.355 1.333 12V2.667M0 2.667H12M3.333 2.667V1.333C3.333 0.98 3.474 0.641 3.724 0.391 3.974 0.141 4.313 0 4.667 0H7.333C7.687 0 8.026 0.141 8.276 0.391 8.526 0.641 8.667 0.98 8.667 1.333V2.667" transform="translate(1.17 1.15)" stroke="#ef4444" stroke-width="2" stroke-linecap="round"/></svg>
            </button>
          </form>
        </div>
      </div>
      <p class="admin-announcement-card__excerpt">{{ $item['excerpt'] }}</p>
      <hr class="admin-announcement-card__divider">
      <div class="admin-announcement-card__foot">
        <div class="admin-announcement-card__meta">
          <span class="admin-announcement-card__meta-item">
            <svg width="11" height="13" viewBox="0 0 10 12" fill="none" aria-hidden="true"><path d="M8.168 10.5V9.333C8.168 8.715 7.922 8.121 7.484 7.683 7.047 7.246 6.453 7 5.834 7H2.334C1.715 7 1.121 7.246 0.684 7.683 0.246 8.121 0 8.715 0 9.333V10.5M6.417 2.333C6.417 3.622 5.373 4.667 4.084 4.667 2.795 4.667 1.75 3.622 1.75 2.333 1.75 1.045 2.795 0 4.084 0 5.373 0 6.417 1.045 6.417 2.333Z" transform="translate(1.24 1.19)" stroke="#64748b" stroke-width="2" stroke-linecap="round"/></svg>
            {{ $item['author'] }}
          </span>
          <span class="admin-announcement-card__meta-dot" aria-hidden="true"></span>
          <span class="admin-announcement-card__meta-item">
            <svg width="13" height="14" viewBox="0 0 12 14" fill="none" aria-hidden="true"><path d="M2.917 0V2.333M7.583 0V2.333M0 4.667H10.5M1.167 1.167H9.333C9.978 1.167 10.5 1.689 10.5 2.333V10.501C10.5 11.145 9.978 11.668 9.333 11.668H1.167C0.522 11.668 0 11.145 0 10.501V2.333C0 1.689 0.522 1.167 1.167 1.167Z" transform="translate(1.19 1.17)" stroke="#64748b" stroke-width="2" stroke-linecap="round"/></svg>
            {{ $item['date'] }}
          </span>
        </div>
        <span class="admin-badge {{ \App\Support\AdminListing::announcementStatusClass($item['status']) }}">{{ $item['status'] }}</span>
      </div>
    </article>
  @empty
    <p style="text-align: center; color: #64748b; padding: 32px 0;">No announcements found.</p>
  @endforelse
</div>

@if ($lastPage > 1)
  @include('partials.public.pagination', [
    'currentPage' => $currentPage,
    'lastPage' => $lastPage,
    'routeName' => 'admin.announcements.index',
    'query' => request()->except('page'),
  ])
@endif
@endsection

@push('modals')
  @include('partials.admin.modals.create-new-announcement')
  @include('partials.admin.modals.edit-announcement')
  @include('partials.admin.modals.preview-announcement-details')
@endpush
