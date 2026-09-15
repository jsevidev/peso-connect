<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use App\Support\ActivityLogger;
use App\Support\AdminListing;
use App\Support\ReportExporter;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ApplicantController extends Controller
{
    public function index(Request $request): View
    {
        $listing = AdminListing::filterEnlistees($request);

        return view('admin.enlistee-management', array_merge(
            $this->enlisteeViewData($request, $listing),
            [
                'currentPage' => $listing['page'],
                'lastPage' => $listing['last_page'],
                'query' => $request->input('q'),
                'positionFilters' => config('peso-options.position_filters', []),
                'dateFilters' => config('peso-options.date_filters', []),
            ]
        ));
    }

    public function live(Request $request): View
    {
        abort_unless($request->header('X-Live-Refresh') === '1', 404);

        $listing = AdminListing::filterEnlistees($request);

        return view('admin.live.enlistee-table', $this->enlisteeViewData($request, $listing));
    }

    private function enlisteeViewData(Request $request, array $listing): array
    {
        return [
            'enlistees' => $listing['items'],
            'statuses' => config('peso-options.enlistee_statuses', []),
            'liveQuery' => $request->except('page'),
        ];
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'max:50'],
            'address' => ['required', 'string'],
            'skills' => ['required', 'string'],
            'education' => ['required', 'string', 'max:255'],
        ]);

        $applicant = Applicant::create([
            'admin_id' => session('admin_id'),
            'email_address' => Str::slug($validated['name'], '.').'@example.com',
            'fullname' => $validated['name'],
            'contact_number' => $validated['contact'],
            'address' => $validated['address'],
            'skills' => $validated['skills'],
            'education' => $validated['education'],
            'status' => 'Pending',
        ]);

        ActivityLogger::record(
            session('admin_id'),
            'Created Enlistee Record',
            'Added: '.$applicant->fullname
        );

        return redirect()
            ->route('admin.enlistees.index')
            ->with('status', 'Enlistee "'.$applicant->fullname.'" added successfully.');
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id' => ['required', 'integer', 'exists:applicants,id'],
            'name' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'max:50'],
            'address' => ['required', 'string'],
            'skills' => ['required', 'string'],
            'education' => ['required', 'string', 'max:255'],
        ]);

        $applicant = Applicant::findOrFail($validated['id']);
        $applicant->update([
            'fullname' => $validated['name'],
            'contact_number' => $validated['contact'],
            'address' => $validated['address'],
            'skills' => $validated['skills'],
            'education' => $validated['education'],
        ]);

        ActivityLogger::record(
            session('admin_id'),
            'Updated Enlistee Status',
            'Updated profile: '.$applicant->fullname
        );

        return redirect()
            ->route('admin.enlistees.index')
            ->with('status', 'Enlistee "'.$applicant->fullname.'" updated successfully.');
    }

    public function updateStatus(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id' => ['required', 'integer', 'exists:applicants,id'],
            'status' => ['required', 'string', 'max:50'],
        ]);

        $applicant = Applicant::findOrFail($validated['id']);
        $applicant->update(['status' => $validated['status']]);

        ActivityLogger::record(
            session('admin_id'),
            'Updated Enlistee Status',
            'Marked '.$applicant->fullname.' as '.$validated['status']
        );

        return redirect()
            ->route('admin.enlistees.index')
            ->with('status', 'Enlistee status changed to "'.$validated['status'].'".');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id' => ['required', 'integer', 'exists:applicants,id'],
        ]);

        $applicant = Applicant::findOrFail($validated['id']);
        $name = $applicant->fullname;
        $applicant->delete();

        ActivityLogger::record(
            session('admin_id'),
            'Removed Enlistee Record',
            'Deleted enlistee: '.$name
        );

        return redirect()
            ->route('admin.enlistees.index')
            ->with('status', 'Enlistee "'.$name.'" deleted.');
    }

    public function export(): StreamedResponse
    {
        ActivityLogger::record(session('admin_id'), 'Exported Report', 'Enlistee list CSV download');

        return ReportExporter::download('enlistments');
    }
}
