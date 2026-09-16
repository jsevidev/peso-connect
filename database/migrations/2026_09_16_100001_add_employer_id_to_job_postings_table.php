<?php

use App\Models\Employer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('job_postings', function (Blueprint $table) {
            $table->foreignId('employer_id')->nullable()->after('admin_id')->constrained()->nullOnDelete();
        });

        DB::table('job_postings')
            ->select('company')
            ->distinct()
            ->pluck('company')
            ->filter()
            ->each(function (string $company) {
                $name = Employer::normalizeName($company);

                $employerId = DB::table('employers')->where('name', $name)->value('id');

                if (! $employerId) {
                    $employerId = DB::table('employers')->insertGetId([
                        'name' => $name,
                        'abbr' => Employer::makeAbbr($company),
                        'peso_verified' => Employer::detectPesoVerified($company),
                        'status' => 'Active',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                DB::table('job_postings')
                    ->where('company', $company)
                    ->update(['employer_id' => $employerId]);
            });
    }

    public function down(): void
    {
        Schema::table('job_postings', function (Blueprint $table) {
            $table->dropConstrainedForeignId('employer_id');
        });
    }
};
