<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Applicant;
use App\Models\JobPosting;
use App\Models\Referral;
use Illuminate\Database\Seeder;

class ReferralSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Admin::where('username', 'admin')->first();

        if (! $admin) {
            return;
        }

        $daysAgo = [3, 12, 28];

        foreach (config('admin-content.referrals', []) as $index => $referral) {
            $applicant = Applicant::where('fullname', 'like', '%'.explode(' ', $referral['name'])[0].'%')->first();
            $jobPosting = JobPosting::where('job_title', $referral['job'])->first();
            $createdAt = now()->subDays($daysAgo[$index] ?? ($index + 1) * 7);

            Referral::updateOrCreate(
                ['fullname' => $referral['name'], 'job_title' => $referral['job'], 'employer' => $referral['employer']],
                [
                    'applicant_id' => $applicant?->id,
                    'job_posting_id' => $jobPosting?->id,
                    'admin_id' => $admin->id,
                    'status' => $referral['status'],
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ]
            );
        }
    }
}
