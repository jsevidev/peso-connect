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
        <form action="{{ route('admin.enlistees.delete') }}" method="POST" style="display: inline;"
          data-confirm="This will permanently remove {{ $enlistee['name'] }} from enlistee records."
          data-confirm-type="danger"
          data-confirm-title="Delete enlistee?"
          data-confirm-ok="Delete enlistee">
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
