<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('plan_id');
            $table->foreignId('license_id')->nullable();
            $table->foreignId('payment_method_id'); // Add this line
            $table->string('status');
            $table->integer('amount');
            $table->string('payment_frequency');
            $table->string('reference_number')->unique();
            $table->string('proof_of_payment')->nullable();
            $table->text('admin_notes')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
