@extends('layouts.admin-login')

@section('title', 'Admin Login')

@section('content')
<div class="admin-login-wrap">
  <div class="admin-login-card">
    @if (session('error'))
      <div class="admin-flash admin-flash--danger" role="alert">
        <span class="admin-flash__icon" aria-hidden="true">!</span>
        <span>{{ session('error') }}</span>
      </div>
    @endif
    @if (session('status'))
      <div class="admin-flash admin-flash--success" role="status">
        <span class="admin-flash__icon" aria-hidden="true">✓</span>
        <span>{{ session('status') }}</span>
      </div>
    @endif
    <div class="admin-login-icon" aria-hidden="true">
      <img src="{{ asset('assets/img/peso-logo.png') }}" alt="" width="56" height="56" style="border-radius: 50%; object-fit: cover;">
    </div>
    <h1 class="admin-login-heading">PESO Admin Portal</h1>
    <p class="admin-login-sub">Secure access for authorized LGU employment staff</p>

    <form action="{{ route('admin.login.submit') }}" method="POST" class="admin-form-stack">
      @csrf
      <div class="admin-form-field">
        <label class="admin-field-label" for="username">Username <span class="admin-field-required">*</span></label>
        <input class="admin-input" type="text" id="username" name="username" placeholder="admin" required value="{{ old('username') }}" autocomplete="username">
        <x-field-error field="username" />
      </div>
      <div class="admin-form-field">
        <label class="admin-field-label" for="password">Password <span class="admin-field-required">*</span></label>
        <input class="admin-input" type="password" id="password" name="password" placeholder="Enter your password" required autocomplete="current-password">
        <x-field-error field="password" />
      </div>
      <button type="submit" class="admin-btn admin-btn--accent" style="width: 100%; padding: 14px;">Sign In to Dashboard</button>
    </form>
  </div>
</div>
@endsection
