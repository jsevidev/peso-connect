@php
  $compact = $compact ?? false;
  $title = $compact ? $announcement['title'] : ($announcement['title_full'] ?? $announcement['title']);
  $excerpt = $compact ? $announcement['excerpt'] : ($announcement['excerpt_full'] ?? $announcement['excerpt']);
  $category = $compact ? ($announcement['category_landing'] ?? $announcement['category']) : $announcement['category'];
  $tag = $compact ? 'a' : 'article';
@endphp

<{{ $tag }} @if ($compact) href="{{ route($announcement['action_route']) }}" @endif class="public-announcement-card {{ $compact ? 'public-card' : 'public-announcement-card--full' }}" style="border-width: 1px;border-style: solid;border-color: #e2e8f0;border-radius: 20px;background-color: #fff;display: flex;flex-direction: column;row-gap: 20px;align-items: start;width: 100%;padding: 32px;box-sizing: border-box;{{ $compact ? 'text-decoration: none;cursor: pointer;' : '' }}">
  <div style="display: flex;flex-direction: row;grid-column-gap: 16px;align-items: center;width: 100%;">
    <div style="border-radius: 12px;background-color: #fff3e0;display: flex;flex-direction: column;align-items: center;justify-content: center;width: 56px;height: 56px;flex-shrink: 0;">
      <span class="text" style="font-size: 18px;font-family: Inter, system-ui, sans-serif;font-weight: 800;color: #f57c00;">{{ $announcement['day'] }}</span>
      <span class="text" style="font-size: 10px;font-family: Inter, system-ui, sans-serif;font-weight: 700;text-transform: uppercase;color: #f57c00;">{{ $announcement['month'] }}</span>
    </div>
    <div style="border-radius: 100px;background-color: rgba(27,58,107,0.04);padding: 6px 12px;"><span class="text" style="font-size: 11px;font-family: Inter, system-ui, sans-serif;font-weight: 600;text-transform: uppercase;color: #1b3a6b;">{{ $category }}</span></div>
  </div>
  <div style="display: flex;flex-direction: column;row-gap: 10px;width: 100%;">
    <span class="text" style="line-height: {{ $compact ? '25.2px' : '28px' }};font-size: {{ $compact ? '18px' : '20px' }};font-family: Inter, system-ui, sans-serif;font-weight: 700;color: #1a253c;width: 100%;">{{ $title }}</span>
    <span class="text" style="line-height: 22.4px;font-size: 14px;font-family: Inter, system-ui, sans-serif;color: #626f84;width: 100%;">{{ $excerpt }}</span>
  </div>
  @unless ($compact)
    <div style="border-width: 1px 0px 0px;border-style: solid;border-color: #e2e8f0;width: 100%;height: 1px;margin: -1px 0px 0px;"></div>
    <div style="display: flex;flex-direction: row;align-items: center;justify-content: space-between;width: 100%;flex-wrap: wrap;gap: 16px;">
      <div style="display: flex;flex-direction: row;grid-column-gap: 16px;align-items: center;flex-wrap: wrap;">
        <span class="text" style="font-size: 13px;font-family: Inter, system-ui, sans-serif;color: #626f84;">{{ $announcement['author'] }}</span>
        <span style="border-radius: 50%;background-color: #626f84;width: 4px;height: 4px;opacity: 0.5;"></span>
        <span class="text" style="font-size: 13px;font-family: Inter, system-ui, sans-serif;color: #626f84;">{{ $announcement['date'] }}</span>
      </div>
      <a href="{{ route($announcement['action_route']) }}" style="border-radius: 8px;background-color: #1b3a6b;display: inline-flex;align-items: center;padding: 10px 20px;text-decoration: none;">
        <span class="text" style="font-size: 13px;font-family: Inter, system-ui, sans-serif;font-weight: 600;color: #fff;">{{ $announcement['action_label'] }}</span>
      </a>
    </div>
  @endunless
</{{ $tag }}>
