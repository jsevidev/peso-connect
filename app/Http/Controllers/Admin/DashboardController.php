<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Applicant;
use App\Support\AdminStats;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', $this->dashboardData());
    }

    public function live(Request $request): View
    {
        abort_unless($request->header('X-Live-Refresh') === '1', 404);

        return view('admin.live.dashboard', $this->liveDashboardData());
    }

    private function dashboardData(): array
    {
        return array_merge($this->liveDashboardData(), [
            'upcomingActivities' => $this->upcomingActivities(),
        ]);
    }

    private function liveDashboardData(): array
    {
        return [
            'stats' => AdminStats::dashboardStats(),
            'recentEnlistees' => $this->recentEnlistees(),
            'categories' => AdminStats::enlistmentCategories(),
        ];
    }

    private function recentEnlistees(): array
    {
        return Applicant::query()
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
    }

    private function upcomingActivities(): array
    {
        return Announcement::query()
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
    }
}
