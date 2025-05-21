<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('license_key')->unique();
            $table->dateTime('expires_at');
            $table->integer('daily_limit')->default(0);
            $table->integer('monthly_limit')->default(0);
            $table->integer('daily_usage')->default(0);
            $table->integer('monthly_usage')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_check')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('licenses');
    }
};
