<?php

use App\Support\AdminListing;
use App\Support\PublicJobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $jobs = collect(PublicJobListing::all())->take(6)->values()->all();

    return view('public.landing', [
        'featuredJobs' => $jobs,
        'announcements' => config('public-content.announcements', []),
    ]);
})->name('home');

Route::get('/jobs', function (Request $request) {
    $listing = PublicJobListing::filter($request);
    $selectedTypes = array_filter((array) $request->input('type', []));
    $selectedSalary = array_filter((array) $request->input('salary', []));
    $selectedPosted = array_filter((array) $request->input('posted', []));

    return view('public.find-jobs', [
        'query' => $request->input('q'),
        'jobs' => $listing['jobs'],
        'totalJobs' => $listing['total'],
        'currentPage' => $listing['page'],
        'lastPage' => $listing['last_page'],
        'filterCounts' => PublicJobListing::filterCounts(),
        'selectedTypes' => $selectedTypes,
        'selectedSalary' => $selectedSalary,
        'selectedPosted' => $selectedPosted,
        'sort' => $request->input('sort', 'recent'),
    ]);
})->name('jobs.index');

Route::get('/referral-requests', function () {
    return view('public.referral-requests', [
        'jobOptions' => config('public-content.referral_job_options', []),
    ]);
})->name('referral-requests');

Route::post('/referral-requests', function () {
    return redirect()->route('referral-requests')->with('status', 'Referral request received. Backend processing is not yet implemented.');
});

Route::get('/first-time-job-seeker', function () {
    return view('public.first-time-job-seeker');
})->name('first-time-job-seeker');

Route::post('/first-time-job-seeker', function () {
    return redirect()->route('first-time-job-seeker')->with('status', 'Certification request received. Backend processing is not yet implemented.');
});

Route::get('/announcements', function (Request $request) {
    $announcements = config('public-content.announcements', []);
    $perPage = 3;
    $total = count($announcements);
    $lastPage = max(1, (int) ceil($total / $perPage));
    $page = min(max(1, (int) $request->input('page', 1)), $lastPage);

    return view('public.announcements', [
        'announcements' => array_slice($announcements, ($page - 1) * $perPage, $perPage),
        'currentPage' => $page,
        'lastPage' => $lastPage,
    ]);
})->name('announcements');

Route::get('/enlistment', function () {
    $selectedJobListing = PublicJobListing::findById(request('job'));

    return view('public.enlistment', [
        'jobs' => PublicJobListing::all(),
        'selectedJobListing' => $selectedJobListing,
    ]);
})->name('enlistment');

Route::post('/enlistment', function () {
    return redirect()->route('enlistment')->with('status', 'Enlistment request received. Backend processing is not yet implemented.');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', function () {
        return view('admin.login');
    })->name('login');

    Route::post('/login', function (Request $request) {
        $username = (string) $request->input('username');
        $password = (string) $request->input('password');

        $validUsername = config('admin-content.credentials.username', 'admin');
        $validPassword = config('admin-content.credentials.password', 'admin');

        if ($username === $validUsername && $password === $validPassword) {
            return redirect()->route('admin.dashboard')->with('status', 'Welcome back, Admin User.');
        }

        return redirect()->route('admin.login')
            ->withInput($request->only('username'))
            ->with('error', 'Invalid username or password.');
    })->name('login.submit');

    Route::post('/logout', function () {
        return redirect()->route('admin.login')->with('status', 'You have been logged out.');
    })->name('logout');

    Route::get('/dashboard', function () {
        $dashboard = config('admin-content.dashboard', []);

        return view('admin.dashboard', [
            'stats' => $dashboard['stats'] ?? [],
            'recentEnlistees' => $dashboard['recent_enlistees'] ?? [],
            'categories' => $dashboard['categories'] ?? [],
            'upcomingActivities' => $dashboard['upcoming_activities'] ?? [],
        ]);
    })->name('dashboard');

    Route::get('/jobs', function (Request $request) {
        $listing = AdminListing::filterJobs($request);

        return view('admin.job-management', [
            'jobs' => $listing['items'],
            'currentPage' => $listing['page'],
            'lastPage' => $listing['last_page'],
            'query' => $request->input('q'),
            'statuses' => config('admin-content.job_statuses', []),
            'categories' => config('admin-content.job_categories', []),
            'postedFilters' => config('admin-content.posted_filters', []),
        ]);
    })->name('jobs.index');

    Route::post('/jobs', function (Request $request) {
        return redirect()->route('admin.jobs.index')->with('status', 'Job post "'.$request->input('title').'" received. Backend processing is not yet implemented.');
    })->name('jobs.store');

    Route::post('/jobs/update', function (Request $request) {
        return redirect()->route('admin.jobs.index')->with('status', 'Job "'.$request->input('title').'" updated. Backend processing is not yet implemented.');
    })->name('jobs.update');

    Route::post('/jobs/archive', function (Request $request) {
        return redirect()->route('admin.jobs.index')->with('status', 'Job "'.$request->input('title').'" archived. Backend processing is not yet implemented.');
    })->name('jobs.archive');

    Route::post('/jobs/delete', function (Request $request) {
        return redirect()->route('admin.jobs.index')->with('status', 'Job "'.$request->input('title').'" deleted. Backend processing is not yet implemented.');
    })->name('jobs.delete');

    Route::get('/enlistees', function (Request $request) {
        $listing = AdminListing::filterEnlistees($request);

        return view('admin.enlistee-management', [
            'enlistees' => $listing['items'],
            'currentPage' => $listing['page'],
            'lastPage' => $listing['last_page'],
            'query' => $request->input('q'),
            'statuses' => config('admin-content.enlistee_statuses', []),
            'positionFilters' => config('admin-content.position_filters', []),
            'dateFilters' => config('admin-content.date_filters', []),
        ]);
    })->name('enlistees.index');

    Route::post('/enlistees', function (Request $request) {
        return redirect()->route('admin.enlistees.index')->with('status', 'Enlistee "'.$request->input('name').'" added. Backend processing is not yet implemented.');
    })->name('enlistees.store');

    Route::post('/enlistees/export', function () {
        return redirect()->route('admin.enlistees.index')->with('status', 'Enlistee list export started. Backend processing is not yet implemented.');
    })->name('enlistees.export');

    Route::post('/enlistees/update', function (Request $request) {
        return redirect()->route('admin.enlistees.index')->with('status', 'Enlistee "'.$request->input('name').'" updated. Backend processing is not yet implemented.');
    })->name('enlistees.update');

    Route::post('/enlistees/status', function (Request $request) {
        return redirect()->route('admin.enlistees.index')->with('status', 'Enlistee status changed to "'.$request->input('status').'". Backend processing is not yet implemented.');
    })->name('enlistees.status');

    Route::get('/referrals', function (Request $request) {
        $listing = AdminListing::filterReferrals($request);

        return view('admin.referral-management', [
            'referrals' => $listing['items'],
            'currentPage' => $listing['page'],
            'lastPage' => $listing['last_page'],
            'query' => $request->input('q'),
            'stats' => config('admin-content.referral_stats', []),
            'statuses' => config('admin-content.referral_statuses', []),
            'dateFilters' => config('admin-content.referral_date_filters', []),
        ]);
    })->name('referrals.index');

    Route::post('/referrals', function (Request $request) {
        return redirect()->route('admin.referrals.index')->with('status', 'Referral letter for "'.$request->input('name').'" created. Backend processing is not yet implemented.');
    })->name('referrals.store');

    Route::post('/referrals/approve', function (Request $request) {
        return redirect()->route('admin.referrals.index')->with('status', 'Referral for "'.$request->input('name').'" approved. Backend processing is not yet implemented.');
    })->name('referrals.approve');

    Route::post('/referrals/deny', function (Request $request) {
        return redirect()->route('admin.referrals.index')->with('status', 'Referral for "'.$request->input('name').'" denied. Backend processing is not yet implemented.');
    })->name('referrals.deny');

    Route::get('/announcements', function (Request $request) {
        $listing = AdminListing::filterAnnouncements($request);

        return view('admin.announcement-management', [
            'announcements' => $listing['items'],
            'currentPage' => $listing['page'],
            'lastPage' => $listing['last_page'],
            'filterTabs' => config('admin-content.announcement_filter_tabs', []),
            'sortOptions' => config('admin-content.announcement_sort_options', []),
            'tabCounts' => AdminListing::announcementCounts(),
        ]);
    })->name('announcements.index');

    Route::post('/announcements', function (Request $request) {
        return redirect()->route('admin.announcements.index')->with('status', 'Announcement "'.$request->input('title').'" published. Backend processing is not yet implemented.');
    })->name('announcements.store');

    Route::post('/announcements/update', function (Request $request) {
        return redirect()->route('admin.announcements.index')->with('status', 'Announcement "'.$request->input('title').'" updated. Backend processing is not yet implemented.');
    })->name('announcements.update');

    Route::post('/announcements/delete', function (Request $request) {
        return redirect()->route('admin.announcements.index')->with('status', 'Announcement "'.$request->input('title').'" deleted. Backend processing is not yet implemented.');
    })->name('announcements.delete');

    Route::get('/certifications', function (Request $request) {
        $listing = AdminListing::filterCertifications($request);

        return view('admin.first-time-job-seeker-certification', [
            'certifications' => $listing['items'],
            'currentPage' => $listing['page'],
            'lastPage' => $listing['last_page'],
            'query' => $request->input('q'),
            'stats' => config('admin-content.certification_stats', []),
            'statuses' => config('admin-content.certification_statuses', []),
            'dateFilters' => config('admin-content.certification_date_filters', []),
        ]);
    })->name('certifications.index');

    Route::post('/certifications/approve', function (Request $request) {
        return redirect()->route('admin.certifications.index')->with('status', 'Certification for "'.$request->input('name').'" approved. Backend processing is not yet implemented.');
    })->name('certifications.approve');

    Route::post('/certifications/print', function (Request $request) {
        return redirect()->route('admin.certifications.index')->with('status', 'Certificate for "'.$request->input('name').'" sent to print queue. Backend processing is not yet implemented.');
    })->name('certifications.print');

    Route::post('/certifications/claim', function (Request $request) {
        return redirect()->route('admin.certifications.index')->with('status', 'Certification for "'.$request->input('name').'" marked as claimed. Backend processing is not yet implemented.');
    })->name('certifications.claim');

    Route::get('/reports', function () {
        $reports = config('admin-content.reports', []);

        return view('admin.reports', [
            'stats' => $reports['stats'] ?? [],
            'monthlyEnlistments' => $reports['monthly_enlistments'] ?? [],
            'categories' => $reports['categories'] ?? [],
            'categoryTotal' => $reports['category_total'] ?? '0',
            'reportTypes' => $reports['report_types'] ?? [],
            'dateFilters' => $reports['date_filters'] ?? [],
            'displayDate' => $reports['display_date'] ?? now()->format('F j, Y'),
        ]);
    })->name('reports.index');

    Route::post('/reports/export', function () {
        return redirect()->route('admin.reports.index')->with('status', 'Report export requested. Backend processing is not yet implemented.');
    })->name('reports.export');

    Route::get('/activity-logs', function (Request $request) {
        $listing = AdminListing::filterActivityLogs($request);
        $perPage = 10;
        $from = $listing['total'] === 0 ? 0 : (($listing['page'] - 1) * $perPage) + 1;
        $to = min($listing['page'] * $perPage, $listing['total']);

        return view('admin.activity-logs', [
            'logs' => $listing['items'],
            'currentPage' => $listing['page'],
            'lastPage' => $listing['last_page'],
            'displayTotal' => $listing['display_total'],
            'rangeFrom' => $from,
            'rangeTo' => $to,
            'query' => $request->input('q'),
            'users' => config('admin-content.activity_users', []),
            'actions' => config('admin-content.activity_actions', []),
            'dateFilters' => config('admin-content.activity_date_filters', []),
        ]);
    })->name('activity-logs.index');

    Route::post('/activity-logs/export', function () {
        return redirect()->route('admin.activity-logs.index')->with('status', 'Activity logs export started. Backend processing is not yet implemented.');
    })->name('activity-logs.export');
});
