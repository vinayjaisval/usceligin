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
        if (Schema::hasTable('products') && !Schema::hasColumn('products', 'expiry_date')) {
            Schema::table('products', function (Blueprint $table) {
                $table->string('expiry_date')->nullable();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('products') && Schema::hasColumn('products', 'expiry_date')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('expiry_date');
            });
        }
    }
};
