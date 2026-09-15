@if ($errors->any())
  <div class="public-flash public-flash--danger" role="alert">
    <span class="public-flash__icon" aria-hidden="true">!</span>
    <div>
      <span class="public-flash__title">Please fix the following:</span>
      <ul class="public-flash__list">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  </div>
@endif

@if (session('status'))
  <div class="public-flash public-flash--success" role="status">
    <span class="public-flash__icon" aria-hidden="true">✓</span>
    <span>{{ session('status') }}</span>
  </div>
@endif
