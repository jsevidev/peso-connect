<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Support\PublicAnnouncementListing;
use Illuminate\View\View;

class PublicAnnouncementController extends Controller
{
    public function show(string $slug): View
    {
        $announcement = Announcement::query()
            ->where('slug', $slug)
            ->where('status', 'Published')
            ->firstOrFail();

        return view('public.announcement-show', [
            'announcement' => PublicAnnouncementListing::toArray($announcement),
        ]);
    }
}
