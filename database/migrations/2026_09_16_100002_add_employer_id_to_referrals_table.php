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
        Schema::table('referrals', function (Blueprint $table) {
            $table->foreignId('employer_id')->nullable()->after('admin_id')->constrained()->nullOnDelete();
        });

        DB::table('referrals')
            ->select('employer')
            ->distinct()
            ->pluck('employer')
            ->filter(fn (?string $name) => filled($name) && $name !== 'Pending Assignment')
            ->each(function (string $employerName) {
                $name = Employer::normalizeName($employerName);

                $employerId = DB::table('employers')->where('name', $name)->value('id');

                if (! $employerId) {
                    $employerId = DB::table('employers')->insertGetId([
                        'name' => $name,
                        'abbr' => Employer::makeAbbr($employerName),
                        'peso_verified' => Employer::detectPesoVerified($employerName),
                        'status' => 'Active',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                DB::table('referrals')
                    ->where('employer', $employerName)
                    ->update(['employer_id' => $employerId]);
            });
    }

    public function down(): void
    {
        Schema::table('referrals', function (Blueprint $table) {
            $table->dropConstrainedForeignId('employer_id');
        });
    }
};
