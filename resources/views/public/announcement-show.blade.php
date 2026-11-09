@extends('layouts.public-site')

@section('title', $announcement['title'].' - PESO Ozamiz')

@section('body-bg', '#f8fafc')

@section('page-bg', '#f8fafc')

@section('content')
<div class="public-content" style="display: flex;flex-direction: column;row-gap: 32px;width: 100%;padding: 48px clamp(20px, 5vw, 80px) 80px;">
  <a href="{{ route('announcements') }}" class="text" style="font-size: 14px;font-family: Inter, system-ui, sans-serif;font-weight: 600;color: #1b3a6b;text-decoration: none;width: fit-content;">← Back to announcements</a>

  <article class="public-announcement-card public-announcement-card--full" style="max-width: 840px;">
    <div class="public-announcement-card__head">
      <div class="public-announcement-card__date">
        <span class="public-announcement-card__day">{{ $announcement['day'] }}</span>
        <span class="public-announcement-card__month">{{ $announcement['month'] }}</span>
      </div>
      <span class="public-announcement-card__category">{{ $announcement['category'] }}</span>
    </div>
    <div class="public-announcement-card__body" style="row-gap: 16px;">
      <h1 class="public-announcement-card__title">{{ $announcement['title'] }}</h1>
      <div style="display: flex;flex-direction: row;grid-column-gap: 16px;align-items: center;flex-wrap: wrap;">
        <span class="text" style="font-size: 13px;font-family: Inter, system-ui, sans-serif;color: #626f84;">{{ $announcement['author'] }}</span>
        <span style="border-radius: 50%;background-color: #626f84;width: 4px;height: 4px;opacity: 0.5;"></span>
        <span class="text" style="font-size: 13px;font-family: Inter, system-ui, sans-serif;color: #626f84;">{{ $announcement['date'] }}</span>
      </div>
      <div class="text" style="line-height: 1.7;font-size: 16px;font-family: Inter, system-ui, sans-serif;color: #334155;white-space: pre-line;">{{ $announcement['description'] }}</div>
    </div>
  </article>
</div>
@endsection
