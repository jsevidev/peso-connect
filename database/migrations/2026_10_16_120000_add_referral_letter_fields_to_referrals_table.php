<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('referrals', function (Blueprint $table) {
            $table->string('recipient_name')->nullable()->after('employer');
            $table->string('recipient_city')->nullable()->after('recipient_name');
            $table->json('candidate_profile')->nullable()->after('recipient_city');
        });
    }

    public function down(): void
    {
        Schema::table('referrals', function (Blueprint $table) {
            $table->dropColumn(['recipient_name', 'recipient_city', 'candidate_profile']);
        });
    }
};
