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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone', 15)->nullable()->after('email')->index();
            $table->timestamp('phone_verified_at')->nullable()->after('email_verified_at');
            $table->timestamp('last_otp_sent_at')->nullable()->after('phone_verified_at');
            $table->integer('otp_attempts_count')->default(0)->after('last_otp_sent_at');
            $table->boolean('is_phone_primary')->default(false)->after('otp_attempts_count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'phone_verified_at',
                'last_otp_sent_at',
                'otp_attempts_count',
                'is_phone_primary'
            ]);
        });
    }
};