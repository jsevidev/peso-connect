<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Login') - PESO Connect</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/peso-logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    @include('partials.admin.styles')
    @include('partials.shared.page-transitions-styles')
    @stack('styles')
  </head>
  <body class="admin-login-body">
    @include('partials.shared.page-transitions')
    <div class="peso-page-transition">
      @yield('content')
    </div>
    @include('partials.admin.confirm-dialog')
    @include('partials.admin.scripts')
    @stack('scripts')
  </body>
</html>
