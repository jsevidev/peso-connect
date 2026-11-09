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
        <button type="button" class="admin-icon-btn admin-icon-btn--primary" title="Edit enlistee" aria-label="Edit enlistee"
          data-open-modal="modal-edit-enlistee"
          data-item-id="{{ $enlistee['id'] }}"
          data-name="{{ $enlistee['name'] }}"
          data-contact="{{ $enlistee['contact'] }}"
          data-address="{{ $enlistee['address'] ?? '' }}"
          data-skills="{{ $enlistee['skills'] ?? '' }}"
          data-education="{{ $enlistee['education'] ?? '' }}">
          @include('partials.admin.icon', ['name' => 'edit'])
        </button>
        <button type="button" class="admin-icon-btn admin-icon-btn--muted" title="View details" aria-label="View details"
          data-open-modal="modal-enlistee-details"
          data-item-id="{{ $enlistee['id'] }}"
          data-name="{{ $enlistee['name'] }}"
          data-contact="{{ $enlistee['contact'] }}"
          data-address="{{ $enlistee['address'] ?? '' }}"
          data-skills="{{ $enlistee['skills'] ?? '' }}"
          data-education="{{ $enlistee['education'] ?? '' }}">
          @include('partials.admin.icon', ['name' => 'view'])
        </button>
        <form action="{{ route('admin.enlistees.delete') }}" method="POST"
          data-confirm="This will permanently remove {{ $enlistee['name'] }} from enlistee records."
          data-confirm-type="danger"
          data-confirm-title="Delete enlistee?"
          data-confirm-ok="Delete enlistee">
          @csrf
          <input type="hidden" name="id" value="{{ $enlistee['id'] }}">
          <button type="submit" class="admin-icon-btn admin-icon-btn--danger" title="Delete enlistee" aria-label="Delete enlistee">
            @include('partials.admin.icon', ['name' => 'delete'])
          </button>
        </form>
      </div>
    </td>
  </tr>
@empty
  <tr><td colspan="6" style="text-align: center; color: #64748b;">No enlistees found.</td></tr>
@endforelse
