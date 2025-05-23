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
            $table->foreignId('plan_id')->constrained(); // Add plan_id foreign key
            $table->foreignId('license_id')->nullable(); // Make license_id nullable
            $table->string('status');
            $table->decimal('amount', 10, 2);
            $table->string('payment_method');
            $table->string('reference_number')->unique();
            $table->string('proof_of_payment')->nullable();
            $table->text('admin_notes')->nullable();
            $table->timestamp('expires_at')->nullable(); // Add expires_at field
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
