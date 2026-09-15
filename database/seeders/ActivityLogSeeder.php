<?php

namespace Database\Seeders;

use App\Models\ActivityLog;
use App\Models\Admin;
use Illuminate\Database\Seeder;

class ActivityLogSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Admin::where('username', 'admin')->first();

        if (! $admin) {
            return;
        }

        $hoursAgo = [2, 6, 12, 18, 30, 42, 54, 70, 88, 110];

        foreach (config('admin-content.activity_logs', []) as $index => $log) {
            $timestamp = now()->subHours($hoursAgo[$index] ?? ($index + 1) * 8);

            ActivityLog::updateOrCreate(
                ['action' => $log['action'], 'details' => $log['details'], 'created_at' => $timestamp],
                [
                    'admin_id' => $admin->id,
                    'updated_at' => $timestamp,
                ]
            );
        }
    }
}
