<?php

namespace App\Support;

use App\Models\ActivityLog;
use App\Models\Applicant;
use App\Models\Certification;
use App\Models\JobPosting;
use App\Models\Referral;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportExporter
{
    public static function download(string $type, ?string $dateRange = null): StreamedResponse
    {
        return match ($type) {
            'enlistments' => self::csv('enlistments', ['Name', 'Email', 'Contact', 'Position', 'Status', 'Date Enlisted'], self::enlistmentRows($dateRange)),
            'referrals' => self::csv('referrals', ['Name', 'Job Title', 'Employer', 'Status', 'Date Requested'], self::referralRows($dateRange)),
            'jobs' => self::csv('job-postings', ['Title', 'Company', 'Location', 'Type', 'Status', 'Posted'], self::jobRows($dateRange)),
            'ftjs' => self::csv('ftjs-certifications', ['Name', 'Barangay', 'Status', 'Date Requested'], self::certificationRows($dateRange)),
            'activity_logs' => self::csv('activity-logs', ['Timestamp', 'User', 'Action', 'Details'], self::activityLogRows($dateRange)),
            default => self::csv('report', ['Message'], [['Unknown report type']]),
        };
    }

    public static function enlistmentRows(?string $dateRange = null): array
    {
        return self::applyDateRange(Applicant::query(), 'created_at', $dateRange)
            ->orderByDesc('created_at')
            ->get()
            ->map(fn (Applicant $row) => [
                $row->fullname,
                $row->email_address,
                $row->contact_number,
                $row->position ?? '',
                $row->status,
                $row->created_at->format('Y-m-d'),
            ])
            ->all();
    }

    public static function activityLogRows(?string $dateRange = null): array
    {
        return self::applyDateRange(ActivityLog::query()->with('admin'), 'created_at', $dateRange)
            ->orderByDesc('created_at')
            ->get()
            ->map(fn (ActivityLog $row) => [
                $row->created_at->format('Y-m-d H:i'),
                $row->admin?->username ?? 'System',
                $row->action,
                $row->details ?? '',
            ])
            ->all();
    }

    private static function referralRows(?string $dateRange): array
    {
        return self::applyDateRange(Referral::query(), 'created_at', $dateRange)
            ->orderByDesc('created_at')
            ->get()
            ->map(fn (Referral $row) => [
                $row->fullname,
                $row->job_title,
                $row->employer,
                $row->status,
                $row->created_at->format('Y-m-d'),
            ])
            ->all();
    }

    private static function jobRows(?string $dateRange): array
    {
        return self::applyDateRange(JobPosting::query(), 'created_at', $dateRange)
            ->orderByDesc('created_at')
            ->get()
            ->map(fn (JobPosting $row) => [
                $row->job_title,
                $row->company,
                $row->location,
                $row->job_type,
                $row->status,
                $row->created_at->format('Y-m-d'),
            ])
            ->all();
    }

    private static function certificationRows(?string $dateRange): array
    {
        return self::applyDateRange(Certification::query(), 'date_requested', $dateRange)
            ->orderByDesc('date_requested')
            ->get()
            ->map(fn (Certification $row) => [
                $row->fullname,
                $row->barangay ?? '',
                $row->status,
                $row->date_requested->format('Y-m-d'),
            ])
            ->all();
    }

    private static function applyDateRange(Builder $query, string $column, ?string $dateRange): Builder
    {
        return match ($dateRange) {
            'Last 7 Days' => $query->where($column, '>=', now()->subDays(7)),
            'Last 30 Days' => $query->where($column, '>=', now()->subDays(30)),
            'This Month' => $query->where($column, '>=', now()->startOfMonth()),
            default => $query,
        };
    }

    private static function csv(string $basename, array $headers, array $rows): StreamedResponse
    {
        $filename = 'peso-'.$basename.'-'.now()->format('Y-m-d').'.csv';

        return response()->streamDownload(function () use ($headers, $rows) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $headers);

            foreach ($rows as $row) {
                fputcsv($handle, $row);
            }

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv',
        ]);
    }
}
