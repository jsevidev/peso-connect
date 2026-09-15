<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Applicant;
use App\Models\JobPosting;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ApplicantSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Admin::where('username', 'admin')->first();

        if (! $admin) {
            return;
        }

        $monthOffsets = [5, 4, 3, 2, 1, 0, 0, 5, 4, 3, 2, 1];

        foreach (config('admin-content.enlistees', []) as $index => $enlistee) {
            $jobPosting = JobPosting::where('job_title', 'like', '%'.Str::before($enlistee['position'], ' ').'%')
                ->orWhere('job_title', $enlistee['position'])
                ->first();

            $createdAt = $this->monthsAgo($monthOffsets[$index] ?? $index);

            Applicant::updateOrCreate(
                ['fullname' => $enlistee['name'], 'contact_number' => $enlistee['contact']],
                [
                    'admin_id' => $admin->id,
                    'job_posting_id' => $jobPosting?->id,
                    'email_address' => Str::slug($enlistee['name'], '.').'@example.com',
                    'address' => $enlistee['address'],
                    'skills' => $enlistee['skills'],
                    'education' => $enlistee['education'],
                    'position' => $enlistee['position'],
                    'status' => $enlistee['status'],
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ]
            );
        }

        $this->seedMonthlyChartSpread($admin);
    }

    private function seedMonthlyChartSpread(Admin $admin): void
    {
        $activeJobs = JobPosting::query()->where('status', 'Active')->get();

        if ($activeJobs->isEmpty()) {
            return;
        }

        for ($monthsAgo = 5; $monthsAgo >= 0; $monthsAgo--) {
            for ($slot = 0; $slot < 2; $slot++) {
                $createdAt = $this->monthsAgo($monthsAgo, 8 + ($slot * 10));
                $job = $activeJobs[($monthsAgo + $slot) % $activeJobs->count()];

                Applicant::updateOrCreate(
                    ['email_address' => "chart.demo.m{$monthsAgo}.s{$slot}@example.com"],
                    [
                        'admin_id' => $admin->id,
                        'job_posting_id' => $job->id,
                        'fullname' => 'Chart Demo Enlistee '.($monthsAgo * 2 + $slot + 1),
                        'contact_number' => '+63 900 000 '.str_pad((string) ($monthsAgo * 2 + $slot + 1), 4, '0', STR_PAD_LEFT),
                        'address' => 'Barangay Demo, Metro Manila',
                        'skills' => 'MS Office, Customer Service',
                        'education' => "College (Bachelor's Degree)",
                        'position' => $job->job_title,
                        'status' => 'Pending',
                        'created_at' => $createdAt,
                        'updated_at' => $createdAt,
                    ]
                );
            }
        }
    }

    private function monthsAgo(int $months, int $day = 15): Carbon
    {
        $date = now()->subMonths($months);

        return $date->copy()->day(min($day, $date->daysInMonth))->startOfDay()->addHours(10);
    }
}
