<?php

namespace App\Support;

use App\Models\ActivityLog;
use App\Models\Announcement;
use App\Models\Applicant;
use App\Models\Certification;
use App\Models\JobPosting;
use App\Models\Referral;
use Illuminate\Database\Eloquent\Builder;
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
        $job = JobPosting::withCount('applicants')->find($id);

        return $job ? self::jobToArray($job) : null;
    }

    public static function jobToArray(JobPosting $job): array
    {
        $words = preg_split('/\s+/', $job->company) ?: [];
        $abbr = '';

        foreach (array_slice($words, 0, 3) as $word) {
            $abbr .= strtoupper(mb_substr($word, 0, 1));
        }

        return [
            'id' => $job->id,
            'title' => $job->job_title,
            'company' => $job->company,
            'company_abbr' => $abbr !== '' ? $abbr : 'JOB',
            'type' => $job->job_type,
            'category' => 'General',
            'posted' => $job->created_at->format('M j, Y'),
            'enlistments' => $job->applicants_count ?? $job->applicants()->count(),
            'status' => $job->status,
        ];
    }

    public static function findEnlistee(int $id): ?array
    {
        $applicant = Applicant::find($id);

        return $applicant ? self::applicantToArray($applicant) : null;
    }

    public static function findReferral(int $id): ?array
    {
        $referral = Referral::find($id);

        return $referral ? self::referralToArray($referral) : null;
    }

    public static function findAnnouncement(int $id): ?array
    {
        $announcement = Announcement::find($id);

        return $announcement ? self::announcementToArray($announcement) : null;
    }

    public static function findCertification(int $id): ?array
    {
        $certification = Certification::find($id);

        return $certification ? self::certificationToArray($certification) : null;
    }

    public static function applicantToArray(Applicant $applicant): array
    {
        return [
            'id' => $applicant->id,
            'name' => $applicant->fullname,
            'position' => $applicant->position ?? 'Unassigned',
            'date' => $applicant->created_at->format('M j, Y'),
            'contact' => $applicant->contact_number,
            'address' => $applicant->address,
            'skills' => $applicant->skills,
            'education' => $applicant->education,
            'status' => $applicant->status,
        ];
    }

    public static function referralToArray(Referral $referral): array
    {
        return [
            'id' => $referral->id,
            'name' => $referral->fullname,
            'job' => $referral->job_title,
            'employer' => $referral->employer,
            'date' => $referral->created_at->format('M j, Y'),
            'status' => $referral->status,
        ];
    }

    public static function announcementToArray(Announcement $announcement): array
    {
        $date = $announcement->publish_date ?? $announcement->scheduled_date ?? $announcement->created_at;

        return [
            'id' => $announcement->id,
            'title' => $announcement->title,
            'excerpt' => $announcement->description,
            'author' => $announcement->author_name ?? 'PESO Admin',
            'date' => $date->format('M j, Y'),
            'publish_date' => $announcement->publish_date?->format('Y-m-d') ?? '',
            'category' => $announcement->category,
            'status' => $announcement->status,
        ];
    }

    public static function certificationToArray(Certification $certification): array
    {
        return [
            'id' => $certification->id,
            'name' => $certification->fullname,
            'date' => $certification->date_requested->format('M j, Y'),
            'barangay' => $certification->barangay,
            'status' => $certification->status,
        ];
    }

    public static function activityLogToArray(ActivityLog $log): array
    {
        return [
            'timestamp' => $log->created_at->format('M j, Y, g:i A'),
            'user' => $log->admin?->username ?? 'System',
            'action' => $log->action,
            'details' => $log->details,
        ];
    }

    public static function applyDateFilter(Builder $query, string $column, ?string $filter): void
    {
        match ($filter) {
            'Last 7 Days' => $query->where($column, '>=', now()->subDays(7)),
            'Last 30 Days', 'This Month' => $query->where($column, '>=', now()->subDays(30)),
            default => null,
        };
    }

    public static function filterJobs(Request $request): array
    {
        $query = JobPosting::query()->withCount('applicants');

        if ($q = trim((string) $request->input('q', ''))) {
            $needle = '%'.$q.'%';
            $query->where(function ($builder) use ($needle) {
                $builder->where('job_title', 'like', $needle)
                    ->orWhere('company', 'like', $needle);
            });
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        if ($posted = $request->input('posted')) {
            match ($posted) {
                'Last 7 Days' => $query->where('created_at', '>=', now()->subDays(7)),
                'Last 30 Days' => $query->where('created_at', '>=', now()->subDays(30)),
                default => null,
            };
        }

        $jobs = $query
            ->orderByDesc('created_at')
            ->get()
            ->map(fn (JobPosting $job) => self::jobToArray($job))
            ->all();

        return self::paginate($jobs, $request);
    }

    public static function filterEnlistees(Request $request): array
    {
        $query = Applicant::query();

        if ($q = trim((string) $request->input('q', ''))) {
            $needle = '%'.$q.'%';
            $query->where(function ($builder) use ($needle) {
                $builder->where('fullname', 'like', $needle)
                    ->orWhere('position', 'like', $needle)
                    ->orWhere('contact_number', 'like', $needle)
                    ->orWhere('email_address', 'like', $needle);
            });
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        if ($position = $request->input('position')) {
            if ($position !== 'All Positions') {
                $query->where('position', 'like', '%'.explode(' ', $position)[0].'%');
            }
        }

        if ($date = $request->input('date')) {
            self::applyDateFilter($query, 'created_at', $date);
        }

        $items = $query->orderByDesc('created_at')
            ->get()
            ->map(fn (Applicant $applicant) => self::applicantToArray($applicant))
            ->all();

        return self::paginate($items, $request);
    }

    public static function filterReferrals(Request $request): array
    {
        $query = Referral::query();

        if ($q = trim((string) $request->input('q', ''))) {
            $needle = '%'.$q.'%';
            $query->where(function ($builder) use ($needle) {
                $builder->where('fullname', 'like', $needle)
                    ->orWhere('job_title', 'like', $needle)
                    ->orWhere('employer', 'like', $needle);
            });
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        if ($date = $request->input('date')) {
            self::applyDateFilter($query, 'created_at', $date);
        }

        $items = $query->orderByDesc('created_at')
            ->get()
            ->map(fn (Referral $referral) => self::referralToArray($referral))
            ->all();

        return self::paginate($items, $request);
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
        return [
            'all' => Announcement::count(),
            'Published' => Announcement::where('status', 'Published')->count(),
            'Scheduled' => Announcement::where('status', 'Scheduled')->count(),
            'Draft' => Announcement::where('status', 'Draft')->count(),
        ];
    }

    public static function filterAnnouncements(Request $request): array
    {
        $query = Announcement::query();

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $sort = $request->input('sort', 'Recent First');
        $query->orderBy('id', $sort === 'Oldest First' ? 'asc' : 'desc');

        $items = $query->get()
            ->map(fn (Announcement $announcement) => self::announcementToArray($announcement))
            ->all();

        return self::paginate($items, $request, 10);
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
        $query = Certification::query();

        if ($q = trim((string) $request->input('q', ''))) {
            $needle = '%'.$q.'%';
            $query->where(function ($builder) use ($needle) {
                $builder->where('fullname', 'like', $needle)
                    ->orWhere('barangay', 'like', $needle);
            });
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        if ($date = $request->input('date')) {
            self::applyDateFilter($query, 'date_requested', $date);
        }

        $items = $query->orderByDesc('date_requested')
            ->get()
            ->map(fn (Certification $certification) => self::certificationToArray($certification))
            ->all();

        return self::paginate($items, $request);
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
        $query = ActivityLog::query()->with('admin');

        if ($q = trim((string) $request->input('q', ''))) {
            $needle = '%'.$q.'%';
            $query->where(function ($builder) use ($needle) {
                $builder->where('details', 'like', $needle)
                    ->orWhere('action', 'like', $needle);
            });
        }

        if ($user = $request->input('user')) {
            if ($user !== 'All Users') {
                $query->whereHas('admin', fn ($builder) => $builder->where('username', $user));
            }
        }

        if ($action = $request->input('action')) {
            if ($action !== 'All Actions') {
                $query->where('action', $action);
            }
        }

        if ($date = $request->input('date')) {
            if ($date !== 'All Time' && preg_match('/^([A-Za-z]+ \d+) - ([A-Za-z]+ \d+), (\d{4})$/', $date, $matches)) {
                [, $startLabel, $endLabel, $year] = $matches;
                $month = strtok($startLabel, ' ');
                $startDay = (int) filter_var($startLabel, FILTER_SANITIZE_NUMBER_INT);
                $endDay = (int) filter_var($endLabel, FILTER_SANITIZE_NUMBER_INT);
                $start = \Carbon\Carbon::parse("$month $startDay, $year")->startOfDay();
                $end = \Carbon\Carbon::parse("$month $endDay, $year")->endOfDay();
                $query->whereBetween('created_at', [$start, $end]);
            }
        }

        $hasFilters = $request->filled('q')
            || ($request->input('user') && $request->input('user') !== 'All Users')
            || ($request->input('action') && $request->input('action') !== 'All Actions')
            || ($request->input('date') && $request->input('date') !== 'All Time');

        $items = $query->orderByDesc('created_at')
            ->get()
            ->map(fn (ActivityLog $log) => self::activityLogToArray($log))
            ->all();

        $result = self::paginate($items, $request, 10);
        $result['has_filters'] = $hasFilters;
        $result['display_total'] = $result['total'];

        return $result;
    }
}
