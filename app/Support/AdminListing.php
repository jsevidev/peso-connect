<?php

namespace App\Support;

use Illuminate\Http\Request;

class AdminListing
{
    public static function paginate(array $items, Request $request, int $perPage = 4, string $pageKey = 'page'): array
    {
        $total = count($items);
        $lastPage = max(1, (int) ceil($total / $perPage));
        $page = min(max(1, (int) $request->input($pageKey, 1)), $lastPage);

        return [
            'items' => array_slice($items, ($page - 1) * $perPage, $perPage),
            'total' => $total,
            'page' => $page,
            'last_page' => $lastPage,
        ];
    }

    public static function statusClass(string $status): string
    {
        return match ($status) {
            'Active', 'Approved', 'Published', 'Claimed', 'Hired' => 'admin-badge--green',
            'Closed', 'Denied', 'Not Qualified' => 'admin-badge--red',
            'Draft', 'Not Claimed' => 'admin-badge--gray',
            'Pending', 'Pending Review', 'Pending Approval' => 'admin-badge--amber',
            'Scheduled', 'For Interview' => 'admin-badge--blue',
            default => 'admin-badge--gray',
        };
    }

    public static function referralStatusClass(string $status): string
    {
        return match ($status) {
            'Pending Review' => 'admin-badge--referral-pending',
            'Approved' => 'admin-badge--referral-approved',
            'Denied' => 'admin-badge--referral-denied',
            default => 'admin-badge--gray',
        };
    }

    public static function findJob(int $id): ?array
    {
        return collect(config('admin-content.admin_jobs', []))->firstWhere('id', $id);
    }

    public static function findEnlistee(int $id): ?array
    {
        return collect(config('admin-content.enlistees', []))->firstWhere('id', $id);
    }

    public static function findReferral(int $id): ?array
    {
        return collect(config('admin-content.referrals', []))->firstWhere('id', $id);
    }

    public static function findAnnouncement(int $id): ?array
    {
        return collect(config('admin-content.admin_announcements', []))->firstWhere('id', $id);
    }

    public static function findCertification(int $id): ?array
    {
        return collect(config('admin-content.certifications', []))->firstWhere('id', $id);
    }

    public static function filterJobs(Request $request): array
    {
        $jobs = collect(config('admin-content.admin_jobs', []));

        if ($q = trim((string) $request->input('q', ''))) {
            $needle = mb_strtolower($q);
            $jobs = $jobs->filter(fn (array $job) => str_contains(mb_strtolower($job['title']), $needle)
                || str_contains(mb_strtolower($job['company']), $needle));
        }

        if ($status = $request->input('status')) {
            $jobs = $jobs->filter(fn (array $job) => $job['status'] === $status);
        }

        if ($category = $request->input('category')) {
            if ($category !== 'All') {
                $jobs = $jobs->filter(fn (array $job) => ($job['category'] ?? '') === $category);
            }
        }

        return self::paginate($jobs->values()->all(), $request);
    }

    public static function filterEnlistees(Request $request): array
    {
        $items = collect(config('admin-content.enlistees', []));

        if ($q = trim((string) $request->input('q', ''))) {
            $needle = mb_strtolower($q);
            $items = $items->filter(fn (array $row) => str_contains(mb_strtolower($row['name']), $needle)
                || str_contains(mb_strtolower($row['position']), $needle)
                || str_contains(mb_strtolower($row['contact']), $needle));
        }

        if ($status = $request->input('status')) {
            $items = $items->filter(fn (array $row) => $row['status'] === $status);
        }

        if ($position = $request->input('position')) {
            if ($position !== 'All Positions') {
                $items = $items->filter(fn (array $row) => str_contains($row['position'], explode(' ', $position)[0]));
            }
        }

        return self::paginate($items->values()->all(), $request);
    }

    public static function filterReferrals(Request $request): array
    {
        $items = collect(config('admin-content.referrals', []));

        if ($q = trim((string) $request->input('q', ''))) {
            $needle = mb_strtolower($q);
            $items = $items->filter(fn (array $row) => str_contains(mb_strtolower($row['name']), $needle)
                || str_contains(mb_strtolower($row['job']), $needle));
        }

        if ($status = $request->input('status')) {
            $items = $items->filter(fn (array $row) => $row['status'] === $status);
        }

        return self::paginate($items->values()->all(), $request);
    }

    public static function announcementStatusClass(string $status): string
    {
        return match ($status) {
            'Published' => 'admin-badge--announcement-published',
            'Scheduled' => 'admin-badge--announcement-scheduled',
            'Draft' => 'admin-badge--announcement-draft',
            default => 'admin-badge--gray',
        };
    }

    public static function announcementCounts(): array
    {
        $items = collect(config('admin-content.admin_announcements', []));

        return [
            'all' => $items->count(),
            'Published' => $items->where('status', 'Published')->count(),
            'Scheduled' => $items->where('status', 'Scheduled')->count(),
            'Draft' => $items->where('status', 'Draft')->count(),
        ];
    }

    public static function filterAnnouncements(Request $request): array
    {
        $items = collect(config('admin-content.admin_announcements', []));

        if ($status = $request->input('status')) {
            $items = $items->filter(fn (array $row) => $row['status'] === $status);
        }

        $sort = $request->input('sort', 'Recent First');
        $items = $sort === 'Oldest First'
            ? $items->sortBy('id')
            : $items->sortByDesc('id');

        return self::paginate($items->values()->all(), $request, 10);
    }

    public static function certificationStatusClass(string $status): string
    {
        return match ($status) {
            'Pending' => 'admin-badge--cert-pending',
            'Claimed' => 'admin-badge--cert-claimed',
            'Not Claimed' => 'admin-badge--cert-not-claimed',
            default => 'admin-badge--gray',
        };
    }

    public static function filterCertifications(Request $request): array
    {
        $items = collect(config('admin-content.certifications', []));

        if ($q = trim((string) $request->input('q', ''))) {
            $needle = mb_strtolower($q);
            $items = $items->filter(fn (array $row) => str_contains(mb_strtolower($row['name']), $needle)
                || str_contains(mb_strtolower($row['barangay']), $needle));
        }

        if ($status = $request->input('status')) {
            $items = $items->filter(fn (array $row) => $row['status'] === $status);
        }

        return self::paginate($items->values()->all(), $request);
    }

    public static function activityLogActionClass(string $action): string
    {
        return match ($action) {
            'Created Job Posting' => 'admin-badge--log-created',
            'Approved Referral' => 'admin-badge--log-approved',
            'Updated Enlistee Status' => 'admin-badge--log-updated',
            'Login', 'Modified System Settings' => 'admin-badge--log-neutral',
            'Exported Report', 'Removed Enlistee Record' => 'admin-badge--log-danger',
            default => 'admin-badge--gray',
        };
    }

    public static function filterActivityLogs(Request $request): array
    {
        $items = collect(config('admin-content.activity_logs', []));

        if ($q = trim((string) $request->input('q', ''))) {
            $needle = mb_strtolower($q);
            $items = $items->filter(fn (array $row) => str_contains(mb_strtolower($row['details']), $needle)
                || str_contains(mb_strtolower($row['action']), $needle)
                || str_contains(mb_strtolower($row['user']), $needle));
        }

        if ($user = $request->input('user')) {
            if ($user !== 'All Users') {
                $items = $items->filter(fn (array $row) => $row['user'] === $user);
            }
        }

        if ($action = $request->input('action')) {
            if ($action !== 'All Actions') {
                $items = $items->filter(fn (array $row) => $row['action'] === $action);
            }
        }

        if ($date = $request->input('date')) {
            if ($date !== 'All Time') {
                $items = $items->filter(function (array $row) use ($date) {
                    if (! preg_match('/^([A-Za-z]+ \d+) - ([A-Za-z]+ \d+), (\d{4})$/', $date, $matches)) {
                        return true;
                    }

                    [, $startLabel, $endLabel, $year] = $matches;
                    $startDay = (int) filter_var($startLabel, FILTER_SANITIZE_NUMBER_INT);
                    $endDay = (int) filter_var($endLabel, FILTER_SANITIZE_NUMBER_INT);
                    $month = strtok($startLabel, ' ');

                    if (! preg_match('/^'.preg_quote($month, '/').' (\d+), '.$year.'/', $row['timestamp'], $rowMatch)) {
                        return false;
                    }

                    $rowDay = (int) $rowMatch[1];

                    return $rowDay >= $startDay && $rowDay <= $endDay;
                });
            }
        }

        $hasFilters = $request->filled('q')
            || ($request->input('user') && $request->input('user') !== 'All Users')
            || ($request->input('action') && $request->input('action') !== 'All Actions')
            || ($request->input('date') && $request->input('date') !== 'All Time');

        $result = self::paginate($items->values()->all(), $request, 10);
        $result['has_filters'] = $hasFilters;
        $result['display_total'] = $hasFilters
            ? $result['total']
            : (int) config('admin-content.activity_total', $result['total']);

        return $result;
    }
}
