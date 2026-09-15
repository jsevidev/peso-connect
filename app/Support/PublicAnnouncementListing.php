<?php

namespace App\Support;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PublicAnnouncementListing
{
    public static function published(): array
    {
        return Announcement::query()
            ->where('status', 'Published')
            ->orderByDesc('publish_date')
            ->get()
            ->map(fn (Announcement $item) => self::toArray($item))
            ->all();
    }

    public static function toArray(Announcement $item): array
    {
        $date = $item->publish_date ?? $item->scheduled_date ?? $item->created_at;
        $category = $item->category;
        $actionRoute = self::actionRoute($category, $item->title);

        return [
            'slug' => $item->slug,
            'day' => $date->format('d'),
            'month' => strtoupper($date->format('M')),
            'category' => $category,
            'category_landing' => $category,
            'title' => $item->title,
            'title_full' => $item->title,
            'excerpt' => Str::limit($item->description, 120),
            'excerpt_full' => $item->description,
            'description' => $item->description,
            'author' => $item->author_name ?? 'PESO Admin',
            'date' => $date->format('M j, Y'),
            'action_route' => $actionRoute,
            'action_label' => $actionRoute === 'first-time-job-seeker' ? 'Apply for Certification' : 'Learn More',
        ];
    }

    public static function paginate(Request $request, int $perPage = 3): array
    {
        $items = collect(self::published());
        $total = $items->count();
        $lastPage = max(1, (int) ceil($total / $perPage));
        $page = min(max(1, (int) $request->input('page', 1)), $lastPage);

        return [
            'items' => $items->slice(($page - 1) * $perPage, $perPage)->values()->all(),
            'total' => $total,
            'page' => $page,
            'last_page' => $lastPage,
        ];
    }

    private static function actionRoute(string $category, string $title): string
    {
        $haystack = mb_strtolower($category.' '.$title);

        if (str_contains($haystack, 'first-time') || str_contains($haystack, 'ftjs') || str_contains($haystack, '11261')) {
            return 'first-time-job-seeker';
        }

        if (str_contains($haystack, 'referral')) {
            return 'referral-requests';
        }

        return 'enlistment';
    }
}
