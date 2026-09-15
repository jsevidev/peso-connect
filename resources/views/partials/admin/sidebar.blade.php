@php
  $navItems = [
    ['route' => 'admin.dashboard', 'label' => 'Dashboard'],
    ['route' => 'admin.jobs.index', 'label' => 'Job Management'],
    ['route' => 'admin.enlistees.index', 'label' => 'Enlistee Management'],
    ['route' => 'admin.referrals.index', 'label' => 'Referral Management'],
    ['route' => 'admin.certifications.index', 'label' => 'FTJS Certification'],
    ['route' => 'admin.reports.index', 'label' => 'Reports & Analytics'],
    ['route' => 'admin.announcements.index', 'label' => 'Announcements'],
    ['route' => 'admin.activity-logs.index', 'label' => 'Activity Logs'],
  ];
@endphp

<aside id="admin-sidebar" class="admin-sidebar" data-turbo-permanent>
  <div class="admin-sidebar__brand">
    <img src="{{ asset('assets/img/peso-logo.png') }}" alt="PESO logo" class="admin-sidebar__logo">
    <div>
      <div class="admin-sidebar__title">PESO</div>
      <div class="admin-sidebar__subtitle">Gov Employment Platform</div>
    </div>
  </div>

  <nav class="admin-nav" aria-label="Admin navigation">
    @foreach ($navItems as $item)
      <a href="{{ route($item['route']) }}" class="admin-nav__link @if (request()->routeIs($item['route'])) is-active @endif">
        <span>{{ $item['label'] }}</span>
        @if (request()->routeIs($item['route']))
          <span class="admin-nav__dot" aria-hidden="true"></span>
        @endif
      </a>
    @endforeach
  </nav>

  <form action="{{ route('admin.logout') }}" method="POST">
    @csrf
    <button type="submit" class="admin-sidebar__logout">Logout Session</button>
  </form>
</aside>
