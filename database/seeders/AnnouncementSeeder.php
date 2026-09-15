<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Announcement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AnnouncementSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Admin::where('username', 'admin')->first();

        if (! $admin) {
            return;
        }

        $daysAgo = [5, 12, 20, 28, 35];

        foreach (config('admin-content.admin_announcements', []) as $index => $item) {
            $publishDate = now()->subDays($daysAgo[$index] ?? ($index + 1) * 7);

            Announcement::updateOrCreate(
                ['slug' => Str::slug($item['title'])],
                [
                    'admin_id' => $admin->id,
                    'title' => $item['title'],
                    'description' => $item['excerpt'],
                    'category' => $item['category'],
                    'status' => $item['status'],
                    'publish_date' => $publishDate->toDateString(),
                    'scheduled_date' => $item['status'] === 'Scheduled' ? $publishDate->copy()->addDays(7)->toDateString() : null,
                    'author_name' => $item['author'],
                    'created_at' => $publishDate,
                    'updated_at' => $publishDate,
                ]
            );
        }

        $publicDaysAgo = [10, 18, 25];

        foreach (config('public-content.announcements', []) as $index => $item) {
            $publishDate = now()->subDays($publicDaysAgo[$index] ?? ($index + 1) * 9);

            Announcement::updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'admin_id' => $admin->id,
                    'title' => $item['title_full'] ?? $item['title'],
                    'description' => $item['excerpt_full'] ?? $item['excerpt'],
                    'category' => $item['category_landing'] ?? $item['category'],
                    'status' => 'Published',
                    'publish_date' => $publishDate->toDateString(),
                    'author_name' => $item['author'],
                    'created_at' => $publishDate,
                    'updated_at' => $publishDate,
                ]
            );
        }
    }
}
