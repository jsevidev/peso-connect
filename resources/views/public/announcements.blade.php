@extends('layouts.public-site')

@section('title', 'Announcements - PESO Connect')

@section('body-bg', '#f8fafc')

@section('page-bg', '#f8fafc')

@section('content')
<div class="public-banner" style="background-image: linear-gradient(180deg, #1b3a6b 0%, #0d2147 100%);display: flex;flex-direction: column;row-gap: 24px;align-items: center;width: 100%;padding: 64px clamp(20px, 5vw, 80px);">
  <div style="display: flex;flex-direction: column;row-gap: 16px;align-items: center;width: 100%;">
    <span class="text" style="text-align: center;font-size: 14px;font-family: Inter, system-ui, sans-serif;font-weight: 700;text-transform: uppercase;color: #f57c00;width: 100%;">Public Bulletins &amp; Community Updates</span>
    <span class="text" style="text-align: center;font-size: 56px;font-family: &quot;Instrument Serif&quot;, system-ui, sans-serif;font-weight: 400;color: #fff;width: 100%;max-width:800px;">PESO Announcements</span>
    <span class="text" style="text-align: center;line-height: 24px;font-size: 16px;font-family: Inter, system-ui, sans-serif;color: rgba(255,255,255,0.63);width: 100%;max-width:640px;">Stay informed with verified vocational program advisories, national job caravan updates, and official guidelines from your municipal local government unit.</span>
  </div>
</div>

<div class="public-content public-announcements-section" style="background-color: #f8fafc;width: 100%;padding: 48px clamp(20px, 5vw, 80px) 80px;">
  <div class="public-announcements-page">
    @foreach ($announcements as $announcement)
      @include('partials.public.announcement-card', ['announcement' => $announcement, 'compact' => false])
    @endforeach

    @include('partials.public.pagination', [
      'currentPage' => $currentPage,
      'lastPage' => $lastPage,
      'routeName' => 'announcements',
      'query' => request()->except('page'),
    ])
  </div>
</div>
@endsection
