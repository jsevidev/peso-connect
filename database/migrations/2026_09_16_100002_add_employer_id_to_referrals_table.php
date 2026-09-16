<?php

use App\Models\Employer;
use App\Models\Referral;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('referrals', function (Blueprint $table) {
            $table->foreignId('employer_id')->nullable()->after('admin_id')->constrained()->nullOnDelete();
        });

        Referral::query()
            ->select('employer')
            ->distinct()
            ->pluck('employer')
            ->filter(fn (?string $name) => filled($name) && $name !== 'Pending Assignment')
            ->each(function (string $employerName) {
                $employer = Employer::query()->firstOrCreate(
                    ['name' => Employer::normalizeName($employerName)],
                    [
                        'abbr' => Employer::makeAbbr($employerName),
                        'peso_verified' => Employer::detectPesoVerified($employerName),
                        'status' => 'Active',
                    ]
                );

                Referral::query()
                    ->where('employer', $employerName)
                    ->update(['employer_id' => $employer->id]);
            });
    }

    public function down(): void
    {
        Schema::table('referrals', function (Blueprint $table) {
            $table->dropConstrainedForeignId('employer_id');
        });
    }
};
