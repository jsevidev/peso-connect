@php
    $currentRoute = Route::currentRouteName();
    $navItems = [
        ['route' => 'home', 'label' => 'Home'],
        ['route' => 'jobs.index', 'label' => 'Find Jobs'],
        ['route' => 'referral-requests', 'label' => 'Referral Requests'],
        ['route' => 'first-time-job-seeker', 'label' => 'First-Time Job Seeker'],
        ['route' => 'announcements', 'label' => 'Announcements'],
    ];
@endphp
<header class="public-header" style="background-color: #fff;display: flex;flex-direction: row;grid-column-gap: 0px;align-items: center;justify-content: center;height: 80px;position: relative;flex-shrink: 0;">
  <a href="{{ route('home') }}" class="public-brand" style="display: flex;flex-direction: row;grid-column-gap: 12px;align-items: center;justify-content: flex-start;width: min-content;position: relative;flex-shrink: 0;margin: 0px auto 0px 0px;text-decoration: none;">
    <div style="overflow: hidden;border-radius: 20px;display: flex;flex-direction: column;row-gap: 0px;align-items: start;justify-content: flex-start;width: 40px;height: 40px;position: relative;flex-shrink: 0;"><img src="https://placehold.co/40x40?text=seal-logo" alt="PESO seal logo" style="inset: 0;width: 100%;height: 100%;position: absolute;object-fit: cover;"></div>
    <div style="display: flex;flex-direction: column;row-gap: 2px;align-items: start;justify-content: flex-start;width: min-content;position: relative;flex-shrink: 0;"><span class="text" style="display: inline;text-align: left;font-size: 18px;font-family: Inter, system-ui, sans-serif;font-weight: 800;font-stretch: 100%;color: #1b3a6b;width: max-content;position: relative;flex-shrink: 0;">PESO</span><span class="text public-brand__subtitle" style="display: inline;text-align: left;font-size: 9px;font-family: Inter, system-ui, sans-serif;font-weight: 600;font-stretch: 100%;text-transform: uppercase;color: #626f84;width: max-content;position: relative;flex-shrink: 0;">Department of Labor and Employment</span></div>
  </a>
  <div class="public-header__actions">
    <button type="button" class="public-nav-toggle" aria-label="Open menu" aria-expanded="false" aria-controls="public-nav">
      <span></span>
    </button>
    <a href="{{ route('enlistment') }}" class="public-header__enlist--mobile" style="border-radius: 8px;background-color: #1b3a6b;display: flex;flex-direction: row;grid-column-gap: 0px;align-items: center;justify-content: center;width: min-content;position: relative;flex-shrink: 0;padding: 10px 16px;text-decoration: none;cursor: pointer;"><span class="text" style="display: inline;text-align: center;font-size: 14px;font-family: Inter, system-ui, sans-serif;font-weight: 600;font-stretch: 100%;color: #fff;width: max-content;position: relative;flex-shrink: 0;">Enlist</span></a>
  </div>
  <nav id="public-nav" class="public-nav" style="display: flex;flex-direction: row;grid-column-gap: 8px;align-items: center;justify-content: flex-start;width: min-content;position: relative;flex-shrink: 0;margin: 0px auto 0px 0px;">
    @foreach ($navItems as $item)
      @php
        $isActive = $currentRoute === $item['route'];
        $activeStyle = $isActive ? 'border-radius: 8px;background-color: rgba(27,58,107,0.06);' : 'border-radius: 8px;';
        $fontWeight = $isActive ? '600' : '500';
      @endphp
      <a href="{{ route($item['route']) }}" style="{{ $activeStyle }}display: flex;flex-direction: column;row-gap: 0px;align-items: start;justify-content: flex-start;width: min-content;position: relative;flex-shrink: 0;padding: 10px 16px;text-decoration: none;"><span class="text" style="display: inline;text-align: left;font-size: 14px;font-family: Inter, system-ui, sans-serif;font-weight: {{ $fontWeight }};font-stretch: 100%;color: #1b3a6b;width: max-content;position: relative;flex-shrink: 0;">{{ $item['label'] }}</span></a>
    @endforeach
  </nav>
  <a href="{{ route('enlistment') }}" class="public-header__enlist--desktop" style="border-radius: 8px;background-color: #1b3a6b;display: flex;flex-direction: row;grid-column-gap: 0px;align-items: center;justify-content: center;width: min-content;position: relative;flex-shrink: 0;padding: 10px 24px;text-decoration: none;cursor: pointer;"><span class="text" style="display: inline;text-align: center;font-size: 14px;font-family: Inter, system-ui, sans-serif;font-weight: 600;font-stretch: 100%;color: #fff;width: max-content;position: relative;flex-shrink: 0;">Enlist Now</span></a>
</header>
