@extends('layouts.public-site')

@section('title', $announcement['title'].' - PESO Connect')

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
    <div style="border-width: 1px 0px 0px;border-style: solid;border-color: #e2e8f0;width: 100%;height: 1px;"></div>
    <div style="display: flex;justify-content: flex-end;width: 100%;">
      <a href="{{ route($announcement['action_route']) }}" style="border-radius: 8px;background-color: #1b3a6b;display: inline-flex;align-items: center;padding: 12px 24px;text-decoration: none;">
        <span class="text" style="font-size: 14px;font-family: Inter, system-ui, sans-serif;font-weight: 600;color: #fff;">{{ $announcement['action_label'] }}</span>
      </a>
    </div>
  </article>
</div>
@endsection
