<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use App\Support\AdminDashboard;
use App\Support\AdminStats;
use Illuminate\Http\Request;
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

    public function liveUpcomingActivities(Request $request): View
    {
        abort_unless($request->header('X-Live-Refresh') === '1', 404);

        return view('admin.live.upcoming-activities', [
            'upcomingActivities' => AdminDashboard::upcomingActivities(),
        ]);
    }

    private function dashboardData(): array
    {
        return array_merge($this->liveDashboardData(), [
            'upcomingActivities' => AdminDashboard::upcomingActivities(),
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

}
