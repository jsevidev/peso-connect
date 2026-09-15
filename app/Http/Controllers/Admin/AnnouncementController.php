<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Support\ActivityLogger;
use App\Support\AdminListing;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AnnouncementController extends Controller
{
    public function index(Request $request): View
    {
        $listing = AdminListing::filterAnnouncements($request);

        return view('admin.announcement-management', [
            'announcements' => $listing['items'],
            'currentPage' => $listing['page'],
            'lastPage' => $listing['last_page'],
            'filterTabs' => config('peso-options.announcement_filter_tabs', []),
            'sortOptions' => config('peso-options.announcement_sort_options', []),
            'tabCounts' => AdminListing::announcementCounts(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatedAnnouncement($request);
        $status = $request->boolean('schedule_later') ? 'Scheduled' : $validated['status'];

        $announcement = Announcement::create([
            'admin_id' => session('admin_id'),
            'slug' => Str::slug($validated['title']).'-'.Str::lower(Str::random(4)),
            'title' => $validated['title'],
            'description' => $validated['excerpt'],
            'category' => $validated['category'],
            'status' => $status,
            'publish_date' => $validated['publish_date'],
            'scheduled_date' => $validated['scheduled_date'] ?? null,
            'scheduled_time' => $validated['scheduled_time'] ?? null,
            'author_name' => $validated['author'],
        ]);

        ActivityLogger::record(
            session('admin_id'),
            'Created Announcement',
            'ID #'.$announcement->id.': '.$announcement->title
        );

        return redirect()
            ->route('admin.announcements.index')
            ->with('status', 'Announcement "'.$announcement->title.'" saved successfully.');
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $this->validatedAnnouncement($request, true);
        $announcement = Announcement::findOrFail($validated['id']);
        $status = $request->boolean('schedule_later') ? 'Scheduled' : $validated['status'];

        $announcement->update([
            'title' => $validated['title'],
            'description' => $validated['excerpt'],
            'category' => $validated['category'],
            'status' => $status,
            'publish_date' => $validated['publish_date'],
            'scheduled_date' => $validated['scheduled_date'] ?? null,
            'scheduled_time' => $validated['scheduled_time'] ?? null,
            'author_name' => $validated['author'],
        ]);

        ActivityLogger::record(
            session('admin_id'),
            'Updated Announcement',
            'ID #'.$announcement->id.': '.$announcement->title
        );

        return redirect()
            ->route('admin.announcements.index')
            ->with('status', 'Announcement "'.$announcement->title.'" updated successfully.');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id' => ['required', 'integer', 'exists:announcements,id'],
        ]);

        $announcement = Announcement::findOrFail($validated['id']);
        $title = $announcement->title;
        $announcement->delete();

        ActivityLogger::record(
            session('admin_id'),
            'Removed Announcement',
            'Deleted: '.$title
        );

        return redirect()
            ->route('admin.announcements.index')
            ->with('status', 'Announcement "'.$title.'" deleted.');
    }

    private function validatedAnnouncement(Request $request, bool $updating = false): array
    {
        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['required', 'string'],
            'author' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:50'],
            'publish_date' => ['required', 'date'],
            'scheduled_date' => ['nullable', 'date'],
            'scheduled_time' => ['nullable'],
        ];

        if ($updating) {
            $rules['id'] = ['required', 'integer', 'exists:announcements,id'];
        }

        return $request->validate($rules);
    }
}
