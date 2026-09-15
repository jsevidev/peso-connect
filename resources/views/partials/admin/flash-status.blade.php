@if (session('error'))
  <div class="admin-flash admin-flash--danger" role="alert">
    <span class="admin-flash__icon" aria-hidden="true">!</span>
    <span>{{ session('error') }}</span>
  </div>
@endif

@if ($errors->any())
  <div class="admin-flash admin-flash--danger" role="alert">
    <span class="admin-flash__icon" aria-hidden="true">!</span>
    <div>
      <strong style="display: block; margin-bottom: 6px;">Please fix the following:</strong>
      <ul style="margin: 0; padding-left: 18px;">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  </div>
@endif

@if (session('status'))
  <div class="admin-flash admin-flash--success" role="status">
    <span class="admin-flash__icon" aria-hidden="true">✓</span>
    <span>{{ session('status') }}</span>
  </div>
@endif
