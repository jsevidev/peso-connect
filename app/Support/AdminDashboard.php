<?php

namespace App\Support;

use App\Models\Announcement;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class AdminDashboard
{
    /**
     * @return array<int, array{day: string, month: string, title: string, details: string, date_label: string}>
     */
    public static function upcomingActivities(int $limit = 3): array
    {
        $today = now()->startOfDay();

        $announcements = Announcement::query()
            ->whereIn('status', ['Published', 'Scheduled'])
            ->where(function ($query) use ($today) {
                $query->whereDate('publish_date', '>=', $today)
                    ->orWhere(function ($builder) use ($today) {
                        $builder->where('status', 'Scheduled')
                            ->whereNotNull('scheduled_date')
                            ->whereDate('scheduled_date', '>=', $today);
                    });
            })
            ->orderByRaw('COALESCE(scheduled_date, publish_date) asc')
            ->limit($limit)
            ->get();

        if ($announcements->isEmpty()) {
            $announcements = Announcement::query()
                ->where('status', 'Published')
                ->orderByDesc('publish_date')
                ->limit($limit)
                ->get();
        }

        return $announcements
            ->map(function (Announcement $announcement) {
                $date = self::activityDate($announcement);

                return [
                    'day' => $date->format('d'),
                    'month' => strtoupper($date->format('M')),
                    'title' => $announcement->title,
                    'details' => Str::limit(strip_tags($announcement->description ?? ''), 80),
                    'date_label' => $date->format('M j, Y'),
                ];
            })
            ->all();
    }

    private static function activityDate(Announcement $announcement): Carbon
    {
        $value = $announcement->status === 'Scheduled' && $announcement->scheduled_date
            ? $announcement->scheduled_date
            : ($announcement->publish_date ?? $announcement->created_at);

        return Carbon::parse($value);
    }
}
