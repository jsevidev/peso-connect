<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\ActivityLogger;
use App\Support\AdminStats;
use App\Support\DonutChart;
use App\Support\ReportExporter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    public function index(): View
    {
        $categories = AdminStats::enlistmentCategories();

        return view('admin.reports', [
            'stats' => AdminStats::reportStatsWithIcons(),
            'monthlyEnlistments' => AdminStats::monthlyEnlistments(),
            'categories' => $categories,
            'donutSegments' => DonutChart::segments($categories),
            'categoryTotal' => AdminStats::categoryTotal(),
            'reportTypes' => config('peso-options.report_types', []),
            'dateFilters' => config('peso-options.report_date_filters', []),
            'displayDate' => now()->format('F j, Y'),
        ]);
    }

    public function export(Request $request): StreamedResponse|RedirectResponse
    {
        $validated = $request->validate([
            'report_type' => ['required', 'string', 'in:enlistments,referrals,jobs,ftjs,activity_logs'],
            'date_range' => ['nullable', 'string'],
        ]);

        ActivityLogger::record(
            session('admin_id'),
            'Exported Report',
            ucfirst(str_replace('_', ' ', $validated['report_type'])).' ('.($validated['date_range'] ?? 'All Time').')'
        );

        return ReportExporter::download($validated['report_type'], $validated['date_range'] ?? null);
    }
}
