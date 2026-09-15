<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Applicant;
use App\Support\AdminStats;
use Illuminate\Support\Str;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $recentEnlistees = Applicant::query()
            ->orderByDesc('created_at')
            ->limit(4)
            ->get()
            ->map(fn (Applicant $applicant) => [
                'name' => $applicant->fullname,
                'position' => $applicant->position ?? 'Unassigned',
                'date' => $applicant->created_at->format('M j, Y'),
                'status' => $applicant->status,
            ])
            ->all();

        $upcomingActivities = Announcement::query()
            ->whereIn('status', ['Published', 'Scheduled'])
            ->orderBy('publish_date')
            ->limit(3)
            ->get()
            ->map(function (Announcement $announcement) {
                $date = $announcement->publish_date ?? $announcement->scheduled_date ?? $announcement->created_at;

                return [
                    'day' => $date->format('d'),
                    'month' => strtoupper($date->format('M')),
                    'title' => $announcement->title,
                    'details' => Str::limit($announcement->description, 80),
                ];
            })
            ->all();

        return view('admin.dashboard', [
            'stats' => AdminStats::dashboardStats(),
            'recentEnlistees' => $recentEnlistees,
            'categories' => AdminStats::enlistmentCategories(),
            'upcomingActivities' => $upcomingActivities,
        ]);
    }
}
