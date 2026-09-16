<?php

namespace Database\Seeders;

use App\Models\Employer;
use Illuminate\Database\Seeder;

class EmployerSeeder extends Seeder
{
    public function run(): void
    {
        $companies = collect(config('public-content.jobs', []))
            ->pluck('company')
            ->merge(collect(config('admin-content.admin_jobs', []))->pluck('company'))
            ->merge(collect(config('admin-content.referrals', []))->pluck('employer'))
            ->filter()
            ->unique()
            ->values();

        foreach ($companies as $company) {
            $name = Employer::normalizeName($company);

            Employer::updateOrCreate(
                ['name' => $name],
                [
                    'abbr' => Employer::makeAbbr($company),
                    'peso_verified' => Employer::detectPesoVerified($company),
                    'status' => 'Active',
                ]
            );
        }
    }
}
