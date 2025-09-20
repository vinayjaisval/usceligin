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
        Schema::create('otp_verifications', function (Blueprint $table) {
            $table->id();
            $table->string('phone', 15)->nullable()->index();
            $table->string('email')->nullable()->index();
            $table->string('otp_code', 6);
            $table->timestamp('expires_at');
            $table->integer('attempts')->default(0);
            $table->timestamp('verified_at')->nullable();
            $table->ipAddress('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->enum('type', ['login', 'registration', 'reset_password'])->default('login');
            $table->enum('method', ['phone', 'email'])->default('phone');
            $table->boolean('is_used')->default(false);
            $table->timestamps();

            // Indexes for performance
            $table->index(['phone', 'created_at']);
            $table->index(['email', 'created_at']);
            $table->index(['otp_code', 'expires_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('otp_verifications');
    }
};