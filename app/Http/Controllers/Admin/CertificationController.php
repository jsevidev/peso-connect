<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use App\Support\ActivityLogger;
use App\Support\AdminListing;
use App\Support\AdminStats;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CertificationController extends Controller
{
    public function index(Request $request): View
    {
        $listing = AdminListing::filterCertifications($request);

        return view('admin.first-time-job-seeker-certification', [
            'certifications' => $listing['items'],
            'currentPage' => $listing['page'],
            'lastPage' => $listing['last_page'],
            'query' => $request->input('q'),
            'stats' => AdminStats::certificationStats(),
            'statuses' => config('peso-options.certification_statuses', []),
            'dateFilters' => config('peso-options.certification_date_filters', []),
        ]);
    }

    public function approve(Request $request): RedirectResponse
    {
        return $this->updateStatus($request, 'Not Claimed', 'Approved FTJS Certification');
    }

    public function print(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id' => ['required', 'integer', 'exists:certifications,id'],
            'name' => ['nullable', 'string', 'max:255'],
        ]);

        $certification = Certification::findOrFail($validated['id']);

        ActivityLogger::record(
            session('admin_id'),
            'Printed FTJS Certificate',
            'Certificate for '.$certification->fullname.' sent to print queue'
        );

        return redirect()
            ->route('admin.certifications.index')
            ->with('status', 'Certificate for "'.$certification->fullname.'" sent to print queue.');
    }

    public function claim(Request $request): RedirectResponse
    {
        return $this->updateStatus($request, 'Claimed', 'Marked FTJS Certification Claimed');
    }

    private function updateStatus(Request $request, string $status, string $logAction): RedirectResponse
    {
        $validated = $request->validate([
            'id' => ['required', 'integer', 'exists:certifications,id'],
            'name' => ['nullable', 'string', 'max:255'],
        ]);

        $certification = Certification::findOrFail($validated['id']);
        $certification->update(['status' => $status]);

        ActivityLogger::record(
            session('admin_id'),
            $logAction,
            'Certification for '.$certification->fullname
        );

        return redirect()
            ->route('admin.certifications.index')
            ->with('status', 'Certification for "'.$certification->fullname.'" updated.');
    }
}
