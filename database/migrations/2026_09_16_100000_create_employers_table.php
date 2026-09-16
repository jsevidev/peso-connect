<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('abbr', 12)->nullable();
            $table->boolean('peso_verified')->default(false);
            $table->string('contact_person')->nullable();
            $table->string('contact_email')->nullable();
            $table->text('address')->nullable();
            $table->string('status')->default('Active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employers');
    }
};
