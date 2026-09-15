<!DOCTYPE html>
<html lang="en" xml:lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'PESO Connect')</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/peso-logo.png') }}">
    <link rel="preconnect" href="https://cdn.divriots.com" crossorigin="">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    @include('partials.public.styles')
    @include('partials.shared.turbo')
  </head>
  <body style="background-color: @yield('body-bg', '#fff');margin:0;">
    <div class="public-page" style="background-color: @yield('page-bg', '#fff');display: flex;flex-direction: column;row-gap: 0px;align-items: stretch;justify-content: flex-start;width: 100%;min-height: 100vh;position: relative;">
      @include('partials.public.header')
      @yield('content')
      @include('partials.public.footer')
    </div>
    @include('partials.public.scripts')
  </body>
</html>
