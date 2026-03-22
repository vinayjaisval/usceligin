<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Add address_category column to distinguish between delivery and billing addresses.
     * - 'delivery' = Shipping/delivery addresses (existing behavior)
     * - 'billing' = Billing addresses (new feature)
     */
    public function up(): void
    {
        if (Schema::hasTable('addresses') && !Schema::hasColumn('addresses', 'address_category')) {
            Schema::table('addresses', function (Blueprint $table) {
                $table->string('address_category', 20)->default('delivery')->after('user_id');
                $table->index(['user_id', 'address_category']);
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('addresses') && Schema::hasColumn('addresses', 'address_category')) {
            Schema::table('addresses', function (Blueprint $table) {
                $table->dropIndex(['user_id', 'address_category']);
                $table->dropColumn('address_category');
            });
        }
    }
};
