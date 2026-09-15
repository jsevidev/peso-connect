<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Admin;
use App\Support\ActivityLogger;
use App\Support\AdminListing;
use App\Support\ReportExporter;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ActivityLogController extends Controller
{
    public function index(Request $request): View
    {
        $listing = AdminListing::filterActivityLogs($request);
        $perPage = 10;
        $from = $listing['total'] === 0 ? 0 : (($listing['page'] - 1) * $perPage) + 1;
        $to = min($listing['page'] * $perPage, $listing['total']);

        $users = collect(['All Users'])
            ->merge(Admin::query()->orderBy('username')->pluck('username'))
            ->all();

        $actions = collect(['All Actions'])
            ->merge(ActivityLog::query()->distinct()->orderBy('action')->pluck('action'))
            ->unique()
            ->values()
            ->all();

        return view('admin.activity-logs', [
            'logs' => $listing['items'],
            'currentPage' => $listing['page'],
            'lastPage' => $listing['last_page'],
            'displayTotal' => $listing['display_total'],
            'rangeFrom' => $from,
            'rangeTo' => $to,
            'query' => $request->input('q'),
            'users' => $users,
            'actions' => $actions,
            'dateFilters' => config('peso-options.activity_date_filters', []),
        ]);
    }

    public function export(): StreamedResponse
    {
        ActivityLogger::record(session('admin_id'), 'Exported Report', 'Activity logs CSV download');

        return ReportExporter::download('activity_logs');
    }
}
