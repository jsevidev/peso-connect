@if ($errors->any())
  <div class="public-flash" role="alert" style="border-radius: 12px;background-color: #fef2f2;border: 1px solid rgba(185,28,28,0.2);padding: 16px 20px;width: 100%;margin-bottom: 24px;">
    <span class="text" style="display: block;font-family: Inter, system-ui, sans-serif;font-size: 14px;font-weight: 600;color: #b91c1c;margin-bottom: 8px;">Please fix the following:</span>
    <ul style="margin: 0;padding-left: 18px;font-family: Inter, system-ui, sans-serif;font-size: 13px;color: #b91c1c;">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

@if (session('status'))
  <div class="public-flash" role="status" style="border-radius: 12px;background-color: #eef4fc;border: 1px solid rgba(27,58,107,0.15);padding: 16px 20px;width: 100%;margin-bottom: 24px;">
    <span class="text" style="font-family: Inter, system-ui, sans-serif;font-size: 14px;font-weight: 500;color: #1b3a6b;">{{ session('status') }}</span>
  </div>
@endif
