<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobPosting;
use App\Support\ActivityLogger;
use App\Support\AdminListing;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JobPostingController extends Controller
{
    public function index(Request $request): View
    {
        $listing = AdminListing::filterJobs($request);

        return view('admin.job-management', [
            'jobs' => $listing['items'],
            'currentPage' => $listing['page'],
            'lastPage' => $listing['last_page'],
            'query' => $request->input('q'),
            'statuses' => config('peso-options.job_statuses', []),
            'categories' => config('peso-options.job_categories', []),
            'postedFilters' => config('peso-options.posted_filters', []),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'salary_min' => ['required', 'string', 'max:50'],
            'salary_max' => ['required', 'string', 'max:50'],
            'type' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string'],
        ]);

        $job = JobPosting::create([
            'admin_id' => session('admin_id'),
            'job_title' => $validated['title'],
            'company' => $validated['company'],
            'location' => $validated['location'],
            'min_salary' => $this->parseSalary($validated['salary_min']),
            'max_salary' => $this->parseSalary($validated['salary_max']),
            'job_type' => $validated['type'],
            'job_description' => $validated['description'],
            'status' => 'Active',
        ]);

        ActivityLogger::record(
            session('admin_id'),
            'Created Job Posting',
            'ID #'.$job->id.': '.$job->job_title.' ('.$job->company.')'
        );

        return redirect()
            ->route('admin.jobs.index')
            ->with('status', 'Job post "'.$job->job_title.'" published successfully.');
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id' => ['required', 'integer', 'exists:job_postings,id'],
            'title' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:50'],
            'status' => ['required', 'string', 'max:50'],
        ]);

        $job = JobPosting::findOrFail($validated['id']);
        $job->update([
            'job_title' => $validated['title'],
            'company' => $validated['company'],
            'job_type' => $validated['type'],
            'status' => $validated['status'],
        ]);

        ActivityLogger::record(
            session('admin_id'),
            'Updated Job Posting',
            'ID #'.$job->id.': '.$job->job_title
        );

        return redirect()
            ->route('admin.jobs.index')
            ->with('status', 'Job "'.$job->job_title.'" updated successfully.');
    }

    public function archive(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id' => ['required', 'integer', 'exists:job_postings,id'],
        ]);

        $job = JobPosting::findOrFail($validated['id']);
        $job->update(['status' => 'Closed']);

        ActivityLogger::record(
            session('admin_id'),
            'Updated Job Posting',
            'Archived ID #'.$job->id.': '.$job->job_title
        );

        return redirect()
            ->route('admin.jobs.index')
            ->with('status', 'Job "'.$job->job_title.'" archived.');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id' => ['required', 'integer', 'exists:job_postings,id'],
        ]);

        $job = JobPosting::findOrFail($validated['id']);
        $title = $job->job_title;
        $jobId = $job->id;
        $job->delete();

        ActivityLogger::record(
            session('admin_id'),
            'Removed Job Posting',
            'Deleted ID #'.$jobId.': '.$title
        );

        return redirect()
            ->route('admin.jobs.index')
            ->with('status', 'Job "'.$title.'" deleted.');
    }

    private function parseSalary(string $value): ?int
    {
        $digits = preg_replace('/[^\d]/', '', $value);

        return $digits !== '' ? (int) $digits : null;
    }
}
