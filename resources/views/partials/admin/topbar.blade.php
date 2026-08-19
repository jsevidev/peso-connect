<header class="admin-topbar">
  <nav class="admin-breadcrumb" aria-label="Breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Admin</a>
    <span aria-hidden="true">&gt;</span>
    <span class="admin-breadcrumb__current">@yield('breadcrumb', 'Dashboard')</span>
  </nav>
  <div class="admin-topbar__user">
    <div class="admin-topbar__name">Admin User</div>
    <div class="admin-topbar__role">PESO Staff</div>
  </div>
</header>
