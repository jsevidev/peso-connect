<?php

$base = dirname(__DIR__) . '/resources/views';
$figma = $base . '/admin/from figma';

function extractStyles(string $html): string
{
    preg_match_all('/<style[^>]*>(.*?)<\/style>/s', $html, $matches);

    return implode("\n", $matches[1] ?? []);
}

function extractBody(string $html): string
{
    if (! preg_match('/<body[^>]*>(.*)<\/body>/s', $html, $matches)) {
        return trim($html);
    }

    return trim($matches[1]);
}

function writeBlade(string $path, string $title, string $body, string $layout = 'layouts.admin'): void
{
    $content = "@extends('{$layout}')\n\n";
    $content .= "@section('title', '{$title}')\n\n";
    $content .= "@section('content')\n";
    $content .= $body . "\n";
    $content .= "@endsection\n";

    file_put_contents($path, $content);
}

function writePartial(string $path, string $name, string $body): void
{
    $content = "{{-- {$name} --}}\n";
    $content .= $body . "\n";

    file_put_contents($path, $content);
}

$pages = [
    ['admin-login/index.html', 'admin/login.blade.php', 'Admin Login', 'layouts.admin-login'],
    ['admin-dashboard/index.html', 'admin/dashboard.blade.php', 'Dashboard'],
    ['admin-job-management/index.html', 'admin/job-management.blade.php', 'Job Management'],
    ['admin-applicant-management/index.html', 'admin/enlistee-management.blade.php', 'Enlistee Management'],
    ['admin-referral-management/index.html', 'admin/referral-management.blade.php', 'Referral Management'],
    ['admin-announcements/index.html', 'admin/announcement-management.blade.php', 'Announcement Management'],
    ['admin-ftjs-certification/index.html', 'admin/first-time-job-seeker-certification.blade.php', 'First-Time Job Seeker Certification'],
    ['admin-activity-logs/index.html', 'admin/activity-logs.blade.php', 'Activity Logs'],
];

$modals = [
    ['modal-add-job/index.html', 'partials/admin/modals/add-new-job.blade.php', 'Add New Job Modal'],
    ['modal-add-applicant/index.html', 'partials/admin/modals/add-new-enlistee.blade.php', 'Add New Enlistee Modal'],
    ['modal-view-enlistee/index.html', 'partials/admin/modals/enlistee-details.blade.php', 'Enlistee Details Modal'],
    ['modal-create-referral-letter/index.html', 'partials/admin/modals/create-referral-letter.blade.php', 'Create Referral Letter Modal'],
    ['preview-dock/index.html', 'partials/admin/modals/referral-preview.blade.php', 'Referral Preview Modal'],
    ['modal-create-announcement/index.html', 'partials/admin/modals/create-new-announcement.blade.php', 'Create New Announcement Modal'],
    ['modal-preview-announcement/index.html', 'partials/admin/modals/preview-announcement-details.blade.php', 'Preview Announcement Details Modal'],
];

$pageModalIncludes = [
    'admin/job-management.blade.php' => ['partials.admin.modals.add-new-job'],
    'admin/enlistee-management.blade.php' => ['partials.admin.modals.add-new-enlistee', 'partials.admin.modals.enlistee-details'],
    'admin/referral-management.blade.php' => ['partials.admin.modals.create-referral-letter', 'partials.admin.modals.referral-preview'],
    'admin/announcement-management.blade.php' => ['partials.admin.modals.create-new-announcement', 'partials.admin.modals.preview-announcement-details'],
];

$loginHtml = file_get_contents($figma . '/admin-login/index.html');
$dashboardHtml = file_get_contents($figma . '/admin-dashboard/index.html');

$loginStyles = extractStyles($loginHtml);
$adminStyles = extractStyles($dashboardHtml);

$stylesDir = $base . '/partials/admin';
if (! is_dir($stylesDir)) {
    mkdir($stylesDir, 0777, true);
}
if (! is_dir($stylesDir . '/modals')) {
    mkdir($stylesDir . '/modals', 0777, true);
}

file_put_contents(
    $stylesDir . '/login-styles.blade.php',
    "<style>\n{$loginStyles}\n</style>\n"
);

file_put_contents(
    $stylesDir . '/styles.blade.php',
    "<style>\n{$adminStyles}\n</style>\n"
);

file_put_contents(
    $base . '/layouts/admin.blade.php',
    <<<'BLADE'
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') - PESO Connect</title>
    <link rel="preconnect" href="https://cdn.divriots.com" crossorigin="">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    @include('partials.admin.styles')
    @stack('styles')
  </head>
  <body style="display: grid;background-color: #f4f6f9;margin:0;">
    @yield('content')
    @stack('scripts')
  </body>
</html>
BLADE
);

file_put_contents(
    $base . '/layouts/admin-login.blade.php',
    <<<'BLADE'
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Login') - PESO Connect</title>
    <link rel="preconnect" href="https://cdn.divriots.com" crossorigin="">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    @include('partials.admin.login-styles')
    @stack('styles')
  </head>
  <body style="margin:0;">
    @yield('content')
    @stack('scripts')
  </body>
</html>
BLADE
);

foreach ($pages as $page) {
    [$source, $target, $title] = $page;
    $layout = $page[3] ?? 'layouts.admin';
    $html = file_get_contents($figma . '/' . $source);
    $body = extractBody($html);
    writeBlade($base . '/' . $target, $title, $body, $layout);
    echo "Converted page: {$target}\n";
}

foreach ($modals as [$source, $target, $name]) {
    $html = file_get_contents($figma . '/' . $source);
    $body = extractBody($html);
    writePartial($base . '/' . $target, $name, $body);
    echo "Converted modal: {$target}\n";
}

foreach ($pageModalIncludes as $page => $includes) {
    $path = $base . '/' . $page;
    $content = file_get_contents($path);
    $includeBlock = '';
    foreach ($includes as $partial) {
        $includeBlock .= "\n@include('{$partial}')\n";
    }

    if (! str_contains($content, 'partials.admin.modals')) {
        $content = preg_replace('/@endsection\s*$/', $includeBlock . "@endsection\n", $content, 1);
        file_put_contents($path, $content);
    }
}

writeBlade($base . '/admin/reports.blade.php', 'Reports', '<div style="padding:32px;font-family:Inter,system-ui,sans-serif;color:#64748b;">Reports page — Figma export not yet provided.</div>');

echo "Done.\n";
