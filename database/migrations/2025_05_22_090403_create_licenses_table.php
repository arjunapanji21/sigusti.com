<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('license_key')->unique();
            $table->dateTime('expires_at');
            $table->integer('daily_limit')->default(0);
            $table->integer('monthly_limit')->default(0);
            $table->integer('daily_usage')->default(0);
            $table->integer('monthly_usage')->default(0);
            $table->boolean('is_active')->default(false);
            $table->timestamp('last_check')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licenses');
    }
};
