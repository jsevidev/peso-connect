<div class="admin-activity-list">
  @forelse ($upcomingActivities as $activity)
    <div class="admin-activity-item">
      <div class="admin-activity-date" title="{{ $activity['date_label'] }}">
        <span class="admin-activity-date__day">{{ $activity['day'] }}</span>
        <span class="admin-activity-date__month">{{ $activity['month'] }}</span>
      </div>
      <div class="admin-activity-item__content">
        <div class="admin-activity-item__title">{{ $activity['title'] }}</div>
        <div class="admin-activity-item__details">{{ $activity['details'] }}</div>
      </div>
    </div>
  @empty
    <p class="admin-empty-hint" style="margin: 0;font-size: 13px;font-family: Inter, system-ui, sans-serif;color: #64748b;line-height: 1.5;">
      No upcoming announcements yet. Publish or schedule items under <strong>Announcement Management</strong> to show them here.
    </p>
  @endforelse
</div>
