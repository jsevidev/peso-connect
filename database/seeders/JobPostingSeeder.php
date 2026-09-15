<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\JobPosting;
use Illuminate\Database\Seeder;

class JobPostingSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Admin::where('username', 'admin')->first();

        if (! $admin) {
            return;
        }

        foreach (config('public-content.jobs', []) as $job) {
            $postedAt = now()->subDays($job['posted_days_ago'] ?? 2);

            JobPosting::updateOrCreate(
                ['job_title' => $job['title'], 'company' => $job['company']],
                [
                    'admin_id' => $admin->id,
                    'location' => $job['location'],
                    'min_salary' => $job['salary_min'],
                    'max_salary' => $job['salary_max'],
                    'job_type' => $job['type'],
                    'job_description' => $job['description'],
                    'status' => 'Active',
                    'created_at' => $postedAt,
                    'updated_at' => $postedAt,
                ]
            );
        }

        foreach (config('admin-content.admin_jobs', []) as $index => $job) {
            $postedAt = now()->subDays(14 + ($index * 9));

            JobPosting::updateOrCreate(
                ['job_title' => $job['title'], 'company' => $job['company']],
                [
                    'admin_id' => $admin->id,
                    'location' => 'Metro Manila',
                    'min_salary' => null,
                    'max_salary' => null,
                    'job_type' => $job['type'],
                    'job_description' => $job['title'].' position at '.$job['company'].'.',
                    'status' => $job['status'],
                    'created_at' => $postedAt,
                    'updated_at' => $postedAt,
                ]
            );
        }
    }
}
