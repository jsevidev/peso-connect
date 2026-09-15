<?php

namespace App\Support;

use App\Models\JobPosting;
use Illuminate\Http\Request;

class PublicJobListing
{
    public static function all(): array
    {
        return JobPosting::query()
            ->where('status', 'Active')
            ->orderByDesc('created_at')
            ->get()
            ->map(fn (JobPosting $job) => self::toArray($job))
            ->all();
    }

    public static function findById(int|string|null $id): ?array
    {
        if ($id === null || $id === '') {
            return null;
        }

        $job = JobPosting::query()
            ->where('status', 'Active')
            ->find((int) $id);

        return $job ? self::toArray($job) : null;
    }

    public static function toArray(JobPosting $job): array
    {
        $typeKey = strtolower(str_replace(' ', '-', $job->job_type));
        $daysAgo = max(0, (int) $job->created_at->diffInDays(now()));

        return [
            'id' => $job->id,
            'title' => $job->job_title,
            'company' => $job->company,
            'description' => $job->job_description,
            'location' => $job->location,
            'salary_min' => $job->min_salary ?? 0,
            'salary_max' => $job->max_salary ?? 0,
            'type' => $job->job_type,
            'type_key' => $typeKey,
            'posted_days_ago' => $daysAgo,
            'bookmarked' => false,
            'peso_verified' => true,
        ];
    }

    public static function filter(Request $request, int $perPage = 4): array
    {
        $jobs = collect(self::all());

        if ($query = trim((string) $request->input('q', ''))) {
            $needle = mb_strtolower($query);
            $jobs = $jobs->filter(function (array $job) use ($needle) {
                return str_contains(mb_strtolower($job['title']), $needle)
                    || str_contains(mb_strtolower($job['company']), $needle)
                    || str_contains(mb_strtolower($job['location']), $needle);
            });
        }

        $types = array_filter((array) $request->input('type', []));
        if ($types !== []) {
            $jobs = $jobs->filter(fn (array $job) => in_array($job['type_key'], $types, true));
        }

        $salaryRanges = array_filter((array) $request->input('salary', []));
        if ($salaryRanges !== []) {
            $jobs = $jobs->filter(function (array $job) use ($salaryRanges) {
                foreach ($salaryRanges as $range) {
                    if (self::jobMatchesSalaryRange($job, $range)) {
                        return true;
                    }
                }

                return false;
            });
        }

        $posted = array_filter((array) $request->input('posted', []));
        if ($posted !== []) {
            $jobs = $jobs->filter(function (array $job) use ($posted) {
                foreach ($posted as $window) {
                    if (self::jobMatchesPostedWindow($job['posted_days_ago'], $window)) {
                        return true;
                    }
                }

                return false;
            });
        }

        $jobs = match ($request->input('sort', 'recent')) {
            'salary_high' => $jobs->sortByDesc('salary_max')->values(),
            'salary_low' => $jobs->sortBy('salary_min')->values(),
            default => $jobs->sortBy('posted_days_ago')->values(),
        };

        $total = $jobs->count();
        $page = max(1, (int) $request->input('page', 1));
        $lastPage = max(1, (int) ceil($total / $perPage));
        $page = min($page, $lastPage);

        return [
            'jobs' => $jobs->slice(($page - 1) * $perPage, $perPage)->values()->all(),
            'total' => $total,
            'page' => $page,
            'last_page' => $lastPage,
            'per_page' => $perPage,
        ];
    }

    public static function filterCounts(): array
    {
        $jobs = collect(self::all());

        return [
            'type' => [
                'full-time' => $jobs->where('type_key', 'full-time')->count(),
                'part-time' => $jobs->where('type_key', 'part-time')->count(),
                'contract' => $jobs->where('type_key', 'contract')->count(),
            ],
            'salary' => [
                '15-25' => $jobs->filter(fn ($j) => self::jobMatchesSalaryRange($j, '15-25'))->count(),
                '25-40' => $jobs->filter(fn ($j) => self::jobMatchesSalaryRange($j, '25-40'))->count(),
                '40-60' => $jobs->filter(fn ($j) => self::jobMatchesSalaryRange($j, '40-60'))->count(),
                '60-plus' => $jobs->filter(fn ($j) => self::jobMatchesSalaryRange($j, '60-plus'))->count(),
            ],
            'posted' => [
                '24h' => $jobs->filter(fn ($j) => self::jobMatchesPostedWindow($j['posted_days_ago'], '24h'))->count(),
                '7d' => $jobs->filter(fn ($j) => self::jobMatchesPostedWindow($j['posted_days_ago'], '7d'))->count(),
                '30d' => $jobs->filter(fn ($j) => self::jobMatchesPostedWindow($j['posted_days_ago'], '30d'))->count(),
            ],
        ];
    }

    public static function formatSalary(array $job): string
    {
        if (($job['salary_min'] ?? 0) === 0 && ($job['salary_max'] ?? 0) === 0) {
            return 'Contact for details';
        }

        return '₱'.number_format($job['salary_min']).' - ₱'.number_format($job['salary_max']);
    }

    public static function postedLabel(array $job, string $style = 'active'): string
    {
        $days = $job['posted_days_ago'];

        return $style === 'posted'
            ? 'Posted '.$days.' day'.($days === 1 ? '' : 's').' ago'
            : 'Active '.$days.' day'.($days === 1 ? '' : 's').' ago';
    }

    private static function jobMatchesSalaryRange(array $job, string $range): bool
    {
        $min = $job['salary_min'];
        $max = $job['salary_max'];

        if ($min === 0 && $max === 0) {
            return false;
        }

        return match ($range) {
            '15-25' => $max >= 15000 && $min <= 25000,
            '25-40' => $max >= 25000 && $min <= 40000,
            '40-60' => $max >= 40000 && $min <= 60000,
            '60-plus' => $max >= 60000,
            default => false,
        };
    }

    private static function jobMatchesPostedWindow(int $daysAgo, string $window): bool
    {
        return match ($window) {
            '24h' => $daysAgo <= 1,
            '7d' => $daysAgo <= 7,
            '30d' => $daysAgo <= 30,
            default => false,
        };
    }
}
