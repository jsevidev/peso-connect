@if (session('error'))
  <div class="admin-flash" role="alert" style="background: #fee2e2; border-color: rgba(185,28,28,0.2); color: #b91c1c;">{{ session('error') }}</div>
@endif

@if ($errors->any())
  <div class="admin-flash" role="alert" style="background: #fee2e2; border-color: rgba(185,28,28,0.2); color: #b91c1c;">
    <strong style="display: block; margin-bottom: 6px;">Please fix the following:</strong>
    <ul style="margin: 0; padding-left: 18px;">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

@if (session('status'))
  <div class="admin-flash" role="status">{{ session('status') }}</div>
@endif
