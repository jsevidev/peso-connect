<?php

namespace App\Support;

use App\Models\Applicant;
use App\Models\Certification;
use App\Models\JobPosting;
use App\Models\Referral;
use Illuminate\Support\Collection;

class AdminStats
{
    public static function dashboardStats(): array
    {
        $totalEnlistees = Applicant::count();
        $lastMonthEnlistees = Applicant::whereBetween('created_at', [now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth()])->count();
        $thisMonthEnlistees = Applicant::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();

        return [
            [
                'label' => 'Total Enlistees',
                'value' => number_format($totalEnlistees),
                'change' => self::percentChange($thisMonthEnlistees, $lastMonthEnlistees),
                'change_type' => self::changeType($thisMonthEnlistees, $lastMonthEnlistees),
            ],
            [
                'label' => 'Active Job Posts',
                'value' => (string) JobPosting::where('status', 'Active')->count(),
                'change' => '+0%',
                'change_type' => 'up',
            ],
            [
                'label' => 'Pending Referrals',
                'value' => (string) Referral::where('status', 'Pending Review')->count(),
                'change' => '-0%',
                'change_type' => 'down',
            ],
            [
                'label' => 'New This Month',
                'value' => (string) $thisMonthEnlistees,
                'change' => self::percentChange($thisMonthEnlistees, $lastMonthEnlistees),
                'change_type' => self::changeType($thisMonthEnlistees, $lastMonthEnlistees),
            ],
        ];
    }

    public static function referralStats(): array
    {
        return [
            ['label' => 'Total Requests', 'value' => (string) Referral::count(), 'icon_bg' => '#e8eef5', 'icon_stroke' => '#1b3a6b'],
            ['label' => 'Pending Review', 'value' => (string) Referral::where('status', 'Pending Review')->count(), 'icon_bg' => '#fff3e0', 'icon_stroke' => '#f57c00'],
            ['label' => 'Approved', 'value' => (string) Referral::where('status', 'Approved')->count(), 'icon_bg' => '#e8f5e9', 'icon_stroke' => '#2e7d32'],
            ['label' => 'Denied', 'value' => (string) Referral::where('status', 'Denied')->count(), 'icon_bg' => '#ffebee', 'icon_stroke' => '#c62828'],
        ];
    }

    public static function certificationStats(): array
    {
        return [
            ['label' => 'Total Certifications', 'value' => (string) Certification::count(), 'icon_bg' => '#e8eef5', 'icon_stroke' => '#1b3a6b'],
            ['label' => 'Pending Approval', 'value' => (string) Certification::where('status', 'Pending')->count(), 'icon_bg' => '#fff3e0', 'icon_stroke' => '#f57c00'],
            ['label' => 'Claimed', 'value' => (string) Certification::where('status', 'Claimed')->count(), 'icon_bg' => '#e8f5e9', 'icon_stroke' => '#2e7d32'],
            ['label' => 'Not Claimed', 'value' => (string) Certification::where('status', 'Not Claimed')->count(), 'icon_bg' => '#ffebee', 'icon_stroke' => '#c62828'],
        ];
    }

    public static function reportStatsWithIcons(): array
    {
        $stats = self::dashboardStats();
        $icons = [
            ['icon_bg' => 'rgba(27,58,107,0.1)', 'icon_stroke' => '#1b3a6b', 'icon' => 'users'],
            ['icon_bg' => 'rgba(245,124,0,0.1)', 'icon_stroke' => '#f57c00', 'icon' => 'briefcase'],
            ['icon_bg' => 'rgba(0,150,136,0.1)', 'icon_stroke' => '#009688', 'icon' => 'referral'],
            ['icon_bg' => 'rgba(79,70,229,0.1)', 'icon_stroke' => '#4f46e5', 'icon' => 'new'],
        ];

        return collect($stats)->map(fn (array $stat, int $index) => array_merge($icons[$index] ?? [], $stat))->all();
    }

    public static function monthlyEnlistments(int $months = 6): array
    {
        $points = [];

        for ($i = $months - 1; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $count = Applicant::query()
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();

            $points[] = [
                'month' => $date->format('M'),
                'value' => $count,
                'highlight' => $i === 0,
            ];
        }

        return $points;
    }

    public static function enlistmentCategories(): array
    {
        $colors = config('peso-options.category_colors', []);
        $applicants = Applicant::query()->with('jobPosting')->get();
        $grouped = $applicants->groupBy(fn (Applicant $applicant) => $applicant->jobPosting?->job_type ?? 'Unassigned');
        $total = max($applicants->count(), 1);

        return $grouped
            ->map(function (Collection $items, string $name) use ($colors, $total) {
                $count = $items->count();

                return [
                    'name' => $name,
                    'count' => $count,
                    'percent' => round(($count / $total) * 100).'%',
                    'color' => $colors[$name] ?? $colors['Other'] ?? '#94a3b8',
                ];
            })
            ->sortByDesc('count')
            ->values()
            ->all();
    }

    public static function categoryTotal(): string
    {
        return number_format(Applicant::count());
    }

    private static function percentChange(int $current, int $previous): string
    {
        if ($previous === 0) {
            return $current > 0 ? '+100%' : '0%';
        }

        $change = (($current - $previous) / $previous) * 100;

        return ($change >= 0 ? '+' : '').round($change).'%';
    }

    private static function changeType(int $current, int $previous): string
    {
        return $current >= $previous ? 'up' : 'down';
    }
}
