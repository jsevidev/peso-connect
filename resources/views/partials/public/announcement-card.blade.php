@php
  $compact = $compact ?? false;
  $title = $compact ? $announcement['title'] : ($announcement['title_full'] ?? $announcement['title']);
  $excerpt = $compact ? $announcement['excerpt'] : ($announcement['excerpt_full'] ?? $announcement['excerpt']);
  $category = $compact ? ($announcement['category_landing'] ?? $announcement['category']) : $announcement['category'];
  $detailUrl = route('announcements.show', $announcement['slug']);
  $tag = $compact ? 'a' : 'article';
@endphp

<{{ $tag }} @if ($compact) href="{{ $detailUrl }}" @endif class="public-announcement-card {{ $compact ? 'public-landing-announcement-card' : 'public-announcement-card--full' }}" @if ($compact) style="text-decoration: none;cursor: pointer;" @endif>
  <div class="public-announcement-card__head">
    <div class="public-announcement-card__date">
      <span class="public-announcement-card__day">{{ $announcement['day'] }}</span>
      <span class="public-announcement-card__month">{{ $announcement['month'] }}</span>
    </div>
    <span class="public-announcement-card__category">{{ $category }}</span>
  </div>
  <div class="public-announcement-card__body">
    @if ($compact)
      <span class="public-announcement-card__title public-announcement-card__title--compact">{{ $title }}</span>
    @else
      <a href="{{ $detailUrl }}" class="public-announcement-card__title" style="text-decoration: none;color: inherit;">{{ $title }}</a>
    @endif
    <span class="public-announcement-card__excerpt">{{ $excerpt }}</span>
  </div>
  @unless ($compact)
    <div style="border-width: 1px 0px 0px;border-style: solid;border-color: #e2e8f0;width: 100%;height: 1px;margin: -1px 0px 0px;"></div>
    <div style="display: flex;flex-direction: row;align-items: center;justify-content: space-between;width: 100%;flex-wrap: wrap;gap: 16px;">
      <div style="display: flex;flex-direction: row;grid-column-gap: 16px;align-items: center;flex-wrap: wrap;">
        <span class="text" style="font-size: 13px;font-family: Inter, system-ui, sans-serif;color: #626f84;">{{ $announcement['author'] }}</span>
        <span style="border-radius: 50%;background-color: #626f84;width: 4px;height: 4px;opacity: 0.5;"></span>
        <span class="text" style="font-size: 13px;font-family: Inter, system-ui, sans-serif;color: #626f84;">{{ $announcement['date'] }}</span>
      </div>
      <div style="display: flex;gap: 12px;flex-wrap: wrap;">
        <a href="{{ $detailUrl }}" style="border-width: 1px;border-style: solid;border-color: #1b3a6b;border-radius: 8px;background-color: #fff;display: inline-flex;align-items: center;padding: 10px 20px;text-decoration: none;">
          <span class="text" style="font-size: 13px;font-family: Inter, system-ui, sans-serif;font-weight: 600;color: #1b3a6b;">Read more</span>
        </a>
        <a href="{{ route($announcement['action_route']) }}" style="border-radius: 8px;background-color: #1b3a6b;display: inline-flex;align-items: center;padding: 10px 20px;text-decoration: none;">
          <span class="text" style="font-size: 13px;font-family: Inter, system-ui, sans-serif;font-weight: 600;color: #fff;">{{ $announcement['action_label'] }}</span>
        </a>
      </div>
    </div>
  @endunless
</{{ $tag }}>
