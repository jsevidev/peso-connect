<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') - PESO Connect</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/peso-logo.png') }}">
    <link rel="preconnect" href="https://cdn.divriots.com" crossorigin="">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    @include('partials.admin.styles')
    @stack('styles')
  </head>
  <body class="admin-body">
    <div class="admin-shell">
      @include('partials.admin.sidebar')
      <div class="admin-main">
        @include('partials.admin.topbar')
        <div class="admin-content">
          @include('partials.admin.flash-status')
          @yield('content')
        </div>
      </div>
    </div>
    @stack('modals')
    @include('partials.admin.scripts')
    @stack('scripts')
  </body>
</html>
