@if (session('status'))
  <div class="public-flash" role="status" style="border-radius: 12px;background-color: #eef4fc;border: 1px solid rgba(27,58,107,0.15);padding: 16px 20px;width: 100%;margin-bottom: 24px;">
    <span class="text" style="font-family: Inter, system-ui, sans-serif;font-size: 14px;font-weight: 500;color: #1b3a6b;">{{ session('status') }}</span>
  </div>
@endif
