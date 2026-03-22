<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Creates all core template tables that were missing from the database.
 * Dated 2024-11-12 so it runs before 2024_11_13_add_column_to_products_table.
 * All non-essential columns are nullable to avoid insert issues.
 */
return new class extends Migration
{
    public function up(): void
    {
        // ── products ─────────────────────────────────────────────────────────
        // Required by: wishlists FK, add_column_to_products migration
        if (!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->unsignedBigInteger('category_id')->nullable();
                $table->unsignedBigInteger('subcategory_id')->nullable();
                $table->unsignedBigInteger('childcategory_id')->nullable();
                $table->unsignedBigInteger('brand_id')->nullable();
                $table->string('name')->nullable();
                $table->string('slug')->nullable()->unique();
                $table->text('description')->nullable();
                $table->text('summary')->nullable();
                $table->string('photo')->nullable();
                $table->string('thumbnail')->nullable();
                $table->decimal('price', 10, 2)->default(0);
                $table->decimal('previous_price', 10, 2)->nullable();
                $table->decimal('discount', 5, 2)->nullable();
                $table->date('discount_date')->nullable();
                $table->string('type')->default('physical');
                $table->integer('stock')->default(0);
                $table->integer('minimum_qty')->default(1);
                $table->string('sku')->nullable();
                $table->decimal('weight', 8, 2)->nullable();
                $table->decimal('tax', 5, 2)->nullable();
                $table->boolean('featured')->default(0);
                $table->boolean('trending')->default(0);
                $table->boolean('hot')->default(0);
                $table->boolean('is_new')->default(0);
                $table->boolean('sale')->default(0);
                $table->boolean('best')->default(0);
                $table->tinyInteger('status')->default(1);
                $table->tinyInteger('is_verify')->default(0);
                $table->timestamps();
            });
        }

        // ── generalsettings ───────────────────────────────────────────────────
        if (!Schema::hasTable('generalsettings')) {
            Schema::create('generalsettings', function (Blueprint $table) {
                $table->id();
                $table->string('site_title')->default('Usceligin');
                $table->string('logo')->nullable();
                $table->string('favicon')->nullable();
                $table->string('copyright')->nullable();
                $table->tinyInteger('is_maintain')->default(0);
                $table->text('maintain_text')->nullable();
                $table->string('from_email')->nullable();
                $table->string('from_name')->nullable();
                $table->tinyInteger('is_smtp')->default(0);
                $table->string('mail_host')->nullable();
                $table->string('mail_port')->nullable();
                $table->string('mail_user')->nullable();
                $table->string('mail_pass')->nullable();
                $table->string('mail_encryption')->nullable();
                $table->tinyInteger('is_currency')->default(0);
                $table->tinyInteger('is_loader')->default(0);
                $table->tinyInteger('admin_loader')->default(0);
                $table->tinyInteger('is_admin_loader')->default(0);
                $table->tinyInteger('is_cookie')->default(0);
                $table->text('cookie_text')->nullable();
                $table->tinyInteger('is_capcha')->default(0);
                $table->string('capcha_site_key')->nullable();
                $table->string('capcha_secret_key')->nullable();
                $table->tinyInteger('is_talkto')->default(0);
                $table->string('talkto')->nullable();
                $table->tinyInteger('is_popup')->default(0);
                $table->string('popup_background')->nullable();
                $table->tinyInteger('is_comment')->default(0);
                $table->tinyInteger('is_disqus')->default(0);
                $table->string('disqus')->nullable();
                $table->tinyInteger('is_verification_email')->default(0);
                $table->tinyInteger('is_vendor')->default(0);
                $table->tinyInteger('is_reward')->default(0);
                $table->integer('reward_point')->default(0);
                $table->decimal('reward_dolar', 10, 2)->default(0);
                $table->tinyInteger('is_affilate')->default(0);
                $table->decimal('affilate_charge', 10, 2)->default(0);
                $table->string('affilate_banner')->nullable();
                $table->integer('affilate_user')->default(0);
                $table->decimal('affilate_income', 10, 2)->default(0);
                $table->string('affilate_code')->nullable();
                $table->tinyInteger('is_report')->default(0);
                $table->tinyInteger('is_secure')->default(0);
                $table->tinyInteger('is_shipping')->default(0);
                $table->decimal('free_shipping_amount', 10, 2)->default(0);
                $table->string('google_analytics')->nullable();
                $table->string('facebook_pixel')->nullable();
                $table->string('header_color')->nullable();
                $table->string('header_email')->nullable();
                $table->string('header_phone')->nullable();
                $table->tinyInteger('is_provider')->default(0);
                $table->tinyInteger('multiple_shipping')->default(0);
                $table->tinyInteger('multiple_packaging')->default(0);
                $table->tinyInteger('guest_checkout')->default(1);
                $table->tinyInteger('newsletter')->default(0);
                $table->tinyInteger('reg_vendor')->default(0);
                $table->decimal('seller_commission', 5, 2)->default(0);
                $table->decimal('admin_commission', 5, 2)->default(0);
                $table->decimal('percentage_commission', 5, 2)->default(0);
                $table->decimal('fixed_commission', 10, 2)->default(0);
                $table->decimal('withdraw_charge', 5, 2)->default(0);
                $table->decimal('withdraw_fee', 10, 2)->default(0);
                $table->decimal('min_price', 10, 2)->default(0);
                $table->decimal('max_price', 10, 2)->default(9999999);
                $table->integer('decimals')->default(2);
                $table->string('decimal_separator')->default('.');
                $table->string('thousand_separator')->default(',');
                $table->string('invoice_logo')->nullable();
                $table->tinyInteger('is_debug')->default(0);
                $table->string('breadcrumb_banner')->nullable();
            });

            DB::table('generalsettings')->insert(['id' => 1, 'site_title' => 'Usceligin', 'is_maintain' => 0]);
        }

        // ── languages ─────────────────────────────────────────────────────────
        if (!Schema::hasTable('languages')) {
            Schema::create('languages', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('native_name')->nullable();
                $table->string('flag')->nullable();
                $table->tinyInteger('is_default')->default(0);
                $table->tinyInteger('rtl')->default(0);
                $table->tinyInteger('status')->default(1);
            });

            DB::table('languages')->insert(['id' => 1, 'name' => 'en', 'native_name' => 'English', 'is_default' => 1]);
        }

        // ── admin_languages ───────────────────────────────────────────────────
        if (!Schema::hasTable('admin_languages')) {
            Schema::create('admin_languages', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('native_name')->nullable();
                $table->string('flag')->nullable();
                $table->tinyInteger('is_default')->default(0);
                $table->tinyInteger('status')->default(1);
            });

            DB::table('admin_languages')->insert(['id' => 1, 'name' => 'en', 'native_name' => 'English', 'is_default' => 1]);
        }

        // ── currencies ────────────────────────────────────────────────────────
        if (!Schema::hasTable('currencies')) {
            Schema::create('currencies', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('sign')->default('₹');
                $table->string('code')->default('INR');
                $table->decimal('value', 10, 4)->default(1.0000);
                $table->tinyInteger('is_default')->default(0);
            });

            DB::table('currencies')->insert(['id' => 1, 'name' => 'Indian Rupee', 'sign' => '₹', 'code' => 'INR', 'value' => 1.0, 'is_default' => 1]);
        }

        // ── pagesettings ──────────────────────────────────────────────────────
        if (!Schema::hasTable('pagesettings')) {
            Schema::create('pagesettings', function (Blueprint $table) {
                $table->id();
                $table->tinyInteger('blog')->default(1);
                $table->tinyInteger('faq')->default(1);
                $table->tinyInteger('contact')->default(1);
                $table->string('contact_email')->nullable();
                $table->tinyInteger('checkout')->default(1);
                $table->tinyInteger('home')->default(1);
                $table->tinyInteger('listing')->default(1);
                $table->tinyInteger('wishlist_page')->default(1);
                $table->tinyInteger('product_page')->default(1);
                $table->tinyInteger('vendor_page_count')->default(12);
                $table->tinyInteger('page_count')->default(12);
                $table->tinyInteger('post_count')->default(6);
                $table->tinyInteger('new_count')->default(8);
                $table->tinyInteger('featured')->default(8);
                $table->tinyInteger('trending_count')->default(8);
                $table->tinyInteger('hot_count')->default(8);
                $table->tinyInteger('best_seller_count')->default(8);
                $table->tinyInteger('top_rated_count')->default(8);
                $table->tinyInteger('sale_count')->default(8);
                $table->tinyInteger('popular_count')->default(8);
                $table->tinyInteger('flash_count')->default(8);
            });

            DB::table('pagesettings')->insert(['id' => 1, 'blog' => 1, 'faq' => 1, 'contact' => 1]);
        }

        // ── seotools ──────────────────────────────────────────────────────────
        if (!Schema::hasTable('seotools')) {
            Schema::create('seotools', function (Blueprint $table) {
                $table->id();
                $table->string('meta_tag')->nullable();
                $table->text('meta_keys')->nullable();
                $table->text('meta_description')->nullable();
                $table->string('og_title')->nullable();
                $table->text('og_description')->nullable();
                $table->string('og_image')->nullable();
            });

            DB::table('seotools')->insert(['id' => 1]);
        }

        // ── socialsettings ────────────────────────────────────────────────────
        if (!Schema::hasTable('socialsettings')) {
            Schema::create('socialsettings', function (Blueprint $table) {
                $table->id();
                $table->string('facebook')->nullable();
                $table->string('twitter')->nullable();
                $table->string('linkedin')->nullable();
                $table->string('youtube')->nullable();
                $table->string('gplus')->nullable();
                $table->string('instagram')->nullable();
                $table->string('dribble')->nullable();
                $table->string('pinterest')->nullable();
            });

            DB::table('socialsettings')->insert(['id' => 1]);
        }

        // ── blogs ─────────────────────────────────────────────────────────────
        if (!Schema::hasTable('blogs')) {
            Schema::create('blogs', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->unsignedBigInteger('category_id')->nullable();
                $table->string('title')->nullable();
                $table->string('slug')->nullable()->unique();
                $table->text('description')->nullable();
                $table->string('photo')->nullable();
                $table->tinyInteger('status')->default(1);
                $table->tinyInteger('is_approved')->default(1);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('blogs');
        Schema::dropIfExists('socialsettings');
        Schema::dropIfExists('seotools');
        Schema::dropIfExists('pagesettings');
        Schema::dropIfExists('currencies');
        Schema::dropIfExists('admin_languages');
        Schema::dropIfExists('languages');
        Schema::dropIfExists('generalsettings');
        // products intentionally kept — may have data from other migrations
    }
};
