<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') — PESO Connect</title>
    <style>
        body { font-family: Inter, system-ui, sans-serif; margin: 0; background: #f8f9fc; color: #1a253c; }
        .wrap { max-width: 720px; margin: 48px auto; padding: 0 24px; }
        a { color: #1b3a6b; font-weight: 600; text-decoration: none; }
        a:hover { text-decoration: underline; }
        h1 { font-size: 2rem; margin: 16px 0 8px; color: #1b3a6b; }
        p { line-height: 1.6; color: #626f84; }
    </style>
</head>
<body>
    <div class="wrap">
        <a href="{{ route('home') }}">&larr; Back to Home</a>
        <h1>@yield('title')</h1>
        @yield('content')
    </div>
</body>
</html>
