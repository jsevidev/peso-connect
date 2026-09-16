<?php

use App\Models\Employer;
use App\Models\JobPosting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('job_postings', function (Blueprint $table) {
            $table->foreignId('employer_id')->nullable()->after('admin_id')->constrained()->nullOnDelete();
        });

        JobPosting::query()
            ->select('company')
            ->distinct()
            ->pluck('company')
            ->filter()
            ->each(function (string $company) {
                $employer = Employer::query()->firstOrCreate(
                    ['name' => Employer::normalizeName($company)],
                    [
                        'abbr' => Employer::makeAbbr($company),
                        'peso_verified' => Employer::detectPesoVerified($company),
                        'status' => 'Active',
                    ]
                );

                JobPosting::query()
                    ->where('company', $company)
                    ->update(['employer_id' => $employer->id]);
            });
    }

    public function down(): void
    {
        Schema::table('job_postings', function (Blueprint $table) {
            $table->dropConstrainedForeignId('employer_id');
        });
    }
};
