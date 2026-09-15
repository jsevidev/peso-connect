<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Applicant;
use App\Models\Certification;
use Illuminate\Database\Seeder;

class CertificationSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Admin::where('username', 'admin')->first();

        if (! $admin) {
            return;
        }

        $daysAgo = [4, 11, 18, 25, 32, 40];

        foreach (config('admin-content.certifications', []) as $index => $cert) {
            $applicant = Applicant::where('fullname', 'like', '%'.explode(' ', $cert['name'])[0].'%')->first();
            $requestedAt = now()->subDays($daysAgo[$index] ?? ($index + 1) * 6);

            Certification::updateOrCreate(
                ['fullname' => $cert['name'], 'date_requested' => $requestedAt->toDateString()],
                [
                    'applicant_id' => $applicant?->id,
                    'admin_id' => $admin->id,
                    'barangay' => $cert['barangay'],
                    'status' => $cert['status'],
                    'created_at' => $requestedAt,
                    'updated_at' => $requestedAt,
                ]
            );
        }
    }
}
