<?php

use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\ApplicantController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CertificationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JobPostingController;
use App\Http\Controllers\Admin\ReferralController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\PublicAnnouncementController;
use App\Http\Controllers\PublicFormController;
use App\Support\PublicAnnouncementListing;
use App\Support\PublicJobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $jobs = collect(PublicJobListing::all())->take(6)->values()->all();

    return view('public.landing', [
        'featuredJobs' => $jobs,
        'announcements' => array_slice(PublicAnnouncementListing::published(), 0, 3),
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
        'jobOptions' => collect(PublicJobListing::all())->pluck('title')->all(),
    ]);
})->name('referral-requests');

Route::post('/referral-requests', [PublicFormController::class, 'storeReferral']);

Route::get('/first-time-job-seeker', function () {
    return view('public.first-time-job-seeker');
})->name('first-time-job-seeker');

Route::post('/first-time-job-seeker', [PublicFormController::class, 'storeCertification']);

Route::get('/announcements', function (Request $request) {
    $listing = PublicAnnouncementListing::paginate($request);

    return view('public.announcements', [
        'announcements' => $listing['items'],
        'currentPage' => $listing['page'],
        'lastPage' => $listing['last_page'],
    ]);
})->name('announcements');

Route::get('/announcements/{slug}', [PublicAnnouncementController::class, 'show'])->name('announcements.show');

Route::get('/enlistment', function () {
    $selectedJobListing = PublicJobListing::findById(request('job'));

    return view('public.enlistment', [
        'jobs' => PublicJobListing::all(),
        'selectedJobListing' => $selectedJobListing,
    ]);
})->name('enlistment');

Route::post('/enlistment', [PublicFormController::class, 'storeEnlistment']);

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn () => redirect()->route('admin.login'));
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    Route::middleware('admin.auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/jobs', [JobPostingController::class, 'index'])->name('jobs.index');
        Route::post('/jobs', [JobPostingController::class, 'store'])->name('jobs.store');
        Route::post('/jobs/update', [JobPostingController::class, 'update'])->name('jobs.update');
        Route::post('/jobs/archive', [JobPostingController::class, 'archive'])->name('jobs.archive');
        Route::post('/jobs/delete', [JobPostingController::class, 'destroy'])->name('jobs.delete');

        Route::get('/enlistees', [ApplicantController::class, 'index'])->name('enlistees.index');
        Route::post('/enlistees', [ApplicantController::class, 'store'])->name('enlistees.store');
        Route::post('/enlistees/export', [ApplicantController::class, 'export'])->name('enlistees.export');
        Route::post('/enlistees/update', [ApplicantController::class, 'update'])->name('enlistees.update');
        Route::post('/enlistees/status', [ApplicantController::class, 'updateStatus'])->name('enlistees.status');
        Route::post('/enlistees/delete', [ApplicantController::class, 'destroy'])->name('enlistees.delete');

        Route::get('/referrals', [ReferralController::class, 'index'])->name('referrals.index');
        Route::post('/referrals', [ReferralController::class, 'store'])->name('referrals.store');
        Route::post('/referrals/approve', [ReferralController::class, 'approve'])->name('referrals.approve');
        Route::post('/referrals/deny', [ReferralController::class, 'deny'])->name('referrals.deny');

        Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
        Route::post('/announcements', [AnnouncementController::class, 'store'])->name('announcements.store');
        Route::post('/announcements/update', [AnnouncementController::class, 'update'])->name('announcements.update');
        Route::post('/announcements/delete', [AnnouncementController::class, 'destroy'])->name('announcements.delete');

        Route::get('/certifications', [CertificationController::class, 'index'])->name('certifications.index');
        Route::post('/certifications/approve', [CertificationController::class, 'approve'])->name('certifications.approve');
        Route::post('/certifications/print', [CertificationController::class, 'print'])->name('certifications.print');
        Route::post('/certifications/claim', [CertificationController::class, 'claim'])->name('certifications.claim');

        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::post('/reports/export', [ReportController::class, 'export'])->name('reports.export');

        Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');
        Route::post('/activity-logs/export', [ActivityLogController::class, 'export'])->name('activity-logs.export');
    });
});
