<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employer;
use App\Models\JobPosting;
use App\Models\Referral;
use App\Support\ActivityLogger;
use App\Support\AdminListing;
use App\Support\AdminStats;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReferralController extends Controller
{
    public function index(Request $request): View
    {
        $listing = AdminListing::filterReferrals($request);

        return view('admin.referral-management', [
            'referrals' => $listing['items'],
            'currentPage' => $listing['page'],
            'lastPage' => $listing['last_page'],
            'query' => $request->input('q'),
            'stats' => AdminStats::referralStats(),
            'statuses' => config('peso-options.referral_statuses', []),
            'dateFilters' => config('peso-options.referral_date_filters', []),
            'jobOptions' => JobPosting::query()->where('status', 'Active')->orderBy('job_title')->pluck('job_title'),
            'employers' => AdminListing::activeEmployerOptions(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'employer_id' => ['required', 'integer', 'exists:employers,id'],
            'job' => ['required', 'string', 'max:255'],
        ]);

        $employer = Employer::findOrFail($validated['employer_id']);
        $jobPosting = JobPosting::where('job_title', $validated['job'])->first();

        Referral::create([
            'admin_id' => session('admin_id'),
            'employer_id' => $employer->id,
            'job_posting_id' => $jobPosting?->id,
            'fullname' => $validated['name'],
            'job_title' => $validated['job'],
            'employer' => $employer->name,
            'status' => 'Pending Review',
        ]);

        ActivityLogger::record(
            session('admin_id'),
            'Created Referral',
            'Referral letter for '.$validated['name']
        );

        return redirect()
            ->route('admin.referrals.index')
            ->with('status', 'Referral letter for "'.$validated['name'].'" created successfully.');
    }

    public function approve(Request $request): RedirectResponse
    {
        return $this->updateStatus($request, 'Approved', 'Approved Referral');
    }

    public function deny(Request $request): RedirectResponse
    {
        return $this->updateStatus($request, 'Denied', 'Denied Referral');
    }

    private function updateStatus(Request $request, string $status, string $logAction): RedirectResponse
    {
        $validated = $request->validate([
            'id' => ['required', 'integer', 'exists:referrals,id'],
            'name' => ['nullable', 'string', 'max:255'],
        ]);

        $referral = Referral::findOrFail($validated['id']);
        $referral->update(['status' => $status]);

        ActivityLogger::record(
            session('admin_id'),
            $logAction,
            'Candidate: '.$referral->fullname.' • Employer: '.$referral->employer
        );

        return redirect()
            ->route('admin.referrals.index')
            ->with('status', 'Referral for "'.$referral->fullname.'" '.strtolower($status).'.');
    }
}
