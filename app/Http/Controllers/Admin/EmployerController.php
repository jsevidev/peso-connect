<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employer;
use App\Support\ActivityLogger;
use App\Support\AdminListing;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployerController extends Controller
{
    public function index(Request $request): View
    {
        $listing = AdminListing::filterEmployers($request);

        return view('admin.employer-management', [
            'employers' => $listing['items'],
            'currentPage' => $listing['page'],
            'lastPage' => $listing['last_page'],
            'query' => $request->input('q'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:employers,name'],
            'contact_person' => ['nullable', 'string', 'max:255'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string'],
            'peso_verified' => ['nullable', 'boolean'],
        ]);

        $employer = Employer::create([
            'name' => Employer::normalizeName($validated['name']),
            'abbr' => Employer::makeAbbr($validated['name']),
            'contact_person' => $validated['contact_person'] ?? null,
            'contact_email' => $validated['contact_email'] ?? null,
            'address' => $validated['address'] ?? null,
            'peso_verified' => $request->boolean('peso_verified'),
            'status' => 'Active',
        ]);

        ActivityLogger::record(
            session('admin_id'),
            'Created Employer Record',
            'Added: '.$employer->name
        );

        return redirect()
            ->route('admin.employers.index')
            ->with('status', 'Employer "'.$employer->name.'" added successfully.');
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id' => ['required', 'integer', 'exists:employers,id'],
            'name' => ['required', 'string', 'max:255', 'unique:employers,name,'.$request->input('id')],
            'contact_person' => ['nullable', 'string', 'max:255'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string'],
            'peso_verified' => ['nullable', 'boolean'],
            'status' => ['required', 'string', 'max:50'],
        ]);

        $employer = Employer::findOrFail($validated['id']);
        $employer->update([
            'name' => Employer::normalizeName($validated['name']),
            'abbr' => Employer::makeAbbr($validated['name']),
            'contact_person' => $validated['contact_person'] ?? null,
            'contact_email' => $validated['contact_email'] ?? null,
            'address' => $validated['address'] ?? null,
            'peso_verified' => $request->boolean('peso_verified'),
            'status' => $validated['status'],
        ]);

        $employer->jobPostings()->update(['company' => $employer->name]);

        ActivityLogger::record(
            session('admin_id'),
            'Updated Employer Record',
            'Updated: '.$employer->name
        );

        return redirect()
            ->route('admin.employers.index')
            ->with('status', 'Employer "'.$employer->name.'" updated successfully.');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id' => ['required', 'integer', 'exists:employers,id'],
        ]);

        $employer = Employer::withCount('jobPostings')->findOrFail($validated['id']);

        if ($employer->job_postings_count > 0) {
            $employer->update(['status' => 'Inactive']);

            ActivityLogger::record(
                session('admin_id'),
                'Updated Employer Record',
                'Deactivated: '.$employer->name
            );

            return redirect()
                ->route('admin.employers.index')
                ->with('status', 'Employer "'.$employer->name.'" deactivated because it still has job postings.');
        }

        $name = $employer->name;
        $employer->delete();

        ActivityLogger::record(
            session('admin_id'),
            'Removed Employer Record',
            'Deleted: '.$name
        );

        return redirect()
            ->route('admin.employers.index')
            ->with('status', 'Employer "'.$name.'" deleted.');
    }
}
