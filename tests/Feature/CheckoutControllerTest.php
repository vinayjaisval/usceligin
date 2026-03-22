<?php

namespace Tests\Feature;

use App\Models\Address;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Schema\Blueprint;
use Tests\TestCase;

/**
 * Feature tests for Front\CheckoutController@checkout.
 *
 * Uses a minimal SQLite in-memory schema (same pattern as AddressCrudTest).
 * The controller reads $this->gs from the generalsettings table via AppServiceProvider
 * cache, so we seed a minimal generalsettings row in setUp().
 *
 * Covers:
 *  - Auth guard (guest → sign-in redirect)
 *  - Empty-cart guard (→ cart redirect)
 *  - Coupon session clear on ?remove_coupon
 *  - All required view variables are present
 *  - Shipping cost: free above threshold, charged below
 *  - Tax formula: subtotalMRP × 0.18
 *  - Referral discount: first order only, respects reffered_by
 *  - Gateway filter: codGateway / razorpayGateway
 *  - bfcache guard: pageshow reload on persisted restore (documented behaviour)
 *  - Double-submit guard: place-order button disabled after first click (documented)
 */
class CheckoutControllerTest extends TestCase
{
    // ── Schema setup ─────────────────────────────────────────────────────────

    protected function setUp(): void
    {
        parent::setUp();
        $this->createTestSchema();
        $this->seedGeneralSettings();
        // Flush the AppServiceProvider cache so it reads our seeded row
        cache()->forget('generalsettings');
        cache()->forget('pagesettings');
        cache()->forget('seotools');
        cache()->forget('socialsettings');
        cache()->forget('default_font');
    }

    protected function tearDown(): void
    {
        DB::table('orders')->delete();
        DB::table('addresses')->delete();
        DB::table('payment_gateways')->delete();
        DB::table('generalsettings')->delete();
        DB::table('currencies')->delete();
        DB::table('languages')->delete();
        DB::table('counters')->delete();
        DB::table('users')->delete();
        foreach (['generalsettings','pagesettings','seotools','socialsettings','default_font'] as $key) {
            cache()->forget($key);
        }
        parent::tearDown();
    }

    private function createTestSchema(): void
    {
        // Drop in dependency order
        Schema::dropIfExists('orders');
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('payment_gateways');
        Schema::dropIfExists('generalsettings');
        Schema::dropIfExists('pagesettings');
        Schema::dropIfExists('seotools');
        Schema::dropIfExists('socialsettings');
        Schema::dropIfExists('fonts');
        Schema::dropIfExists('counters');
        Schema::dropIfExists('languages');
        Schema::dropIfExists('currencies');
        Schema::dropIfExists('blogs');
        Schema::dropIfExists('users');

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable()->unique();
            $table->string('phone')->nullable();
            $table->boolean('phone_verified')->default(false);
            $table->string('password');
            $table->unsignedBigInteger('reffered_by')->nullable();
            $table->decimal('current_balance', 10, 2)->default(0);
            $table->string('zip')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sign')->default('₹');
            $table->decimal('value', 10, 4)->default(1);
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });

        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_default')->default(false);
        });

        Schema::create('generalsettings', function (Blueprint $table) {
            $table->id();
            // Core display / branding
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('title')->nullable();
            $table->string('colors')->nullable();
            $table->string('currency_sign')->default('₹');
            $table->tinyInteger('currency_format')->default(0);
            $table->string('decimal_separator')->default('.');
            $table->string('thousand_separator')->default(',');
            // Shipping / pricing
            $table->decimal('free_shipping_amount', 10, 2)->default(500);
            $table->decimal('shipping_cost', 10, 2)->default(50);
            $table->decimal('referral_bonus', 5, 2)->default(10);
            $table->integer('referral_charge')->nullable();
            $table->tinyInteger('is_reward')->default(0);
            $table->integer('reward_point')->default(0);
            $table->integer('reward_dolar')->default(0);
            // Feature flags (tinyint defaults used by views/header)
            $table->tinyInteger('is_maintain')->default(0);
            $table->tinyInteger('is_language')->default(1);
            $table->tinyInteger('is_currency')->default(1);
            $table->tinyInteger('is_affilate')->default(0);
            $table->tinyInteger('is_loader')->default(0);
            $table->tinyInteger('is_popup')->default(0);
            $table->tinyInteger('is_talkto')->default(0);
            $table->tinyInteger('is_comment')->default(1);
            $table->tinyInteger('is_disqus')->default(0);
            $table->tinyInteger('is_capcha')->default(0);
            $table->tinyInteger('is_cookie')->default(0);
            $table->tinyInteger('guest_checkout')->default(0);
            $table->tinyInteger('show_stock')->default(0);
            $table->tinyInteger('multiple_shipping')->default(0);
            $table->tinyInteger('reg_vendor')->default(0);
            $table->tinyInteger('wholesell')->default(0);
            $table->tinyInteger('is_secure')->default(0);
            $table->tinyInteger('is_debug')->default(0);
            $table->tinyInteger('is_contact_seller')->default(0);
            $table->tinyInteger('previous_price')->nullable()->default(1);
            $table->tinyInteger('physical')->default(1);
            $table->tinyInteger('digital')->default(1);
            $table->tinyInteger('listing')->default(1);
            $table->tinyInteger('affilite')->default(1);
            // Contact / mail
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('from_email')->nullable();
            $table->string('from_name')->nullable();
            $table->tinyInteger('is_smtp')->default(0);
            // Misc nullable fields used in templates
            $table->string('footer_color')->nullable();
            $table->string('copyright_color')->nullable();
            $table->string('copyright')->nullable();
            $table->string('footer_logo')->nullable();
            $table->string('breadcrumb_banner')->nullable();
            $table->string('loader')->nullable();
            $table->text('talkto')->nullable();
            $table->text('disqus')->nullable();
            $table->text('popup_background')->nullable();
            $table->string('link')->nullable();
            $table->string('partner_title')->nullable();
            $table->text('partner_text')->nullable();
            $table->string('deal_title')->nullable();
            // Counts used in homepage sections
            $table->integer('best_seller_count')->default(0);
            $table->integer('popular_count')->default(0);
            $table->integer('top_rated_count')->default(0);
            $table->integer('big_save_count')->default(0);
            $table->integer('trending_count')->default(0);
            $table->integer('post_count')->default(0);
        });

        // Minimal tables needed by AppServiceProvider view composer
        Schema::create('pagesettings',  fn(Blueprint $t) => $t->id());
        Schema::create('seotools',      fn(Blueprint $t) => $t->id());
        Schema::create('socialsettings',fn(Blueprint $t) => $t->id());
        Schema::create('fonts', function (Blueprint $table) {
            $table->id();
            $table->string('font_family')->nullable();
            $table->string('font_value')->nullable();
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
        // Products table — queried by footer search partial
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('thumbnail')->nullable();
            $table->decimal('price', 12, 2)->default(0);
            $table->decimal('previous_price', 12, 2)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });

        // Layout tables used in header / footer partials
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->tinyInteger('type')->default(1);
            $table->double('price')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('footer')->default(0);
        });
        Schema::create('social_links', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->default(0);
            $table->tinyInteger('status')->default(1);
        });

        Schema::create('counters', function (Blueprint $table) {
            $table->id();
            $table->string('referral')->nullable();
            $table->string('type')->nullable();
            $table->integer('total_count')->default(0);
            $table->integer('todays_count')->default(0);
            $table->string('today')->nullable();
            $table->timestamps();
        });

        Schema::create('payment_gateways', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('keyword')->nullable();
            $table->tinyInteger('checkout')->default(1);
            $table->string('currency_id')->default('*');
            $table->string('information')->nullable();
        });

        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('address_category', 20)->default('delivery');
            $table->string('type')->nullable()->default('home');
            $table->string('name');
            $table->string('phone', 15);
            $table->text('address_line_1');
            $table->text('address_line_2')->nullable();
            $table->string('city', 100);
            $table->string('state', 100);
            $table->string('pincode', 6);
            $table->string('country', 100)->default('India');
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });

        Schema::create('pickups', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });

        // Seed required default rows
        DB::table('currencies')->insert(['name' => 'INR', 'sign' => '₹', 'value' => 1, 'is_default' => true]);
        DB::table('languages')->insert(['name' => 'English', 'is_default' => true]);
    }

    private function seedGeneralSettings(array $overrides = []): void
    {
        DB::table('generalsettings')->delete();
        DB::table('generalsettings')->insert(array_merge([
            'currency_sign'        => '₹',
            'free_shipping_amount' => 500,
            'shipping_cost'        => 50,
            'referral_bonus'       => 10,
            'currency_format'      => 0,
            'decimal_separator'    => '.',
            'thousand_separator'   => ',',
            'is_maintain'          => 0,
        ], $overrides));
    }

    // ── Helpers ───────────────────────────────────────────────────────────────

    private function makeUser(array $overrides = []): User
    {
        return User::create(array_merge([
            'name'     => 'User ' . uniqid(),
            'email'    => 'user_' . uniqid() . '@test.com',
            'password' => bcrypt('password'),
        ], $overrides));
    }

    /** Build a minimal cart object the controller reads from Session::get('cart'). */
    private function makeCart(float $totalPrice = 400.00): object
    {
        return (object) [
            'totalPrice' => $totalPrice,
            'items'      => [
                [
                    'item'  => ['name' => 'Test Product', 'photo' => null],
                    'qty'   => 1,
                    'price' => $totalPrice,
                    'size'  => null,
                    'color' => null,
                ],
            ],
        ];
    }

    /**
     * Call the checkout() controller method directly, bypassing HTTP response
     * rendering. This lets us assert view-data values (calculations, gateway
     * filters, etc.) without needing the full header/footer view scaffold.
     *
     * The controller's $this->curr is injected via reflection because the
     * middleware closure that normally sets it only runs during the HTTP pipeline.
     */
    private function getCheckoutViewData(User $user, float $cartTotal, array $gsOverrides = []): array
    {
        if (!empty($gsOverrides)) {
            $this->seedGeneralSettings($gsOverrides);
            cache()->forget('generalsettings');
        }

        $this->actingAs($user);
        Session::put('cart', $this->makeCart($cartTotal));

        $controller = $this->app->make(\App\Http\Controllers\Front\CheckoutController::class);

        // Inject $curr — normally set by the HTTP middleware pipeline
        $currency = \App\Models\Currency::where('is_default', 1)->first();
        $prop = (new \ReflectionClass($controller))->getProperty('curr');
        $prop->setAccessible(true);
        $prop->setValue($controller, $currency);

        $result = $controller->checkout();

        // Guard: if checkout() returns a redirect the setup was wrong
        if ($result instanceof \Illuminate\Http\RedirectResponse) {
            return [];
        }

        return $result->getData();
    }

    private function seedGateway(string $keyword, int $checkout = 1): void
    {
        DB::table('payment_gateways')->insert([
            'title'       => ucfirst($keyword),
            'keyword'     => $keyword,
            'checkout'    => $checkout,
            'currency_id' => '*',
        ]);
    }

    // ── Tests: Auth & cart guards ─────────────────────────────────────────────

    public function test_guest_is_redirected_to_sign_in(): void
    {
        Session::put('cart', $this->makeCart());

        $response = $this->get(route('front.checkout'));

        $response->assertRedirect(route('sign-in'));
        $this->assertEquals(
            route('front.checkout'),
            Session::get('url.intended')
        );
    }

    public function test_empty_cart_redirects_authenticated_user_to_cart_page(): void
    {
        $user = $this->makeUser();
        // No 'cart' in session
        $response = $this->actingAs($user)->get(route('front.checkout'));

        $response->assertRedirect(route('front.cart'));
        $response->assertSessionHas('success');
    }

    // ── Tests: Coupon session clearing ────────────────────────────────────────

    public function test_remove_coupon_param_clears_coupon_session_keys(): void
    {
        $user = $this->makeUser();
        $this->seedGateway('cod');

        Session::put('cart', $this->makeCart());
        Session::put('coupon', 20);
        Session::put('coupon_code', 'SAVE20');
        Session::put('coupon_total', 380);

        $this->actingAs($user)->get(route('front.checkout', ['remove_coupon' => 1]));

        $this->assertNull(Session::get('coupon'));
        $this->assertNull(Session::get('coupon_code'));
        $this->assertNull(Session::get('coupon_total'));
    }

    // ── Tests: View variables (direct controller call — no view rendering) ────

    public function test_checkout_view_contains_all_required_variables(): void
    {
        $user = $this->makeUser();
        $this->seedGateway('cod');
        $this->seedGateway('razorpay');

        $data = $this->getCheckoutViewData($user, 400);

        $required = [
            'subtotalMRP', 'discountMRP', 'shippingCost', 'taxAmount',
            'finalTotal', 'points', 'orderCount', 'codGateway',
            'razorpayGateway', 'products', 'totalPrice', 'totalQty',
            'addresses', 'defaultAddress', 'user',
        ];
        foreach ($required as $key) {
            $this->assertArrayHasKey($key, $data, "View is missing key: {$key}");
        }
    }

    // ── Tests: Shipping cost calculation ──────────────────────────────────────

    public function test_shipping_is_charged_when_subtotal_below_threshold(): void
    {
        $user = $this->makeUser();
        $this->seedGateway('cod');

        $data = $this->getCheckoutViewData($user, 400); // 400 < 500 threshold

        $this->assertEquals(50.0, $data['shippingCost']);
    }

    public function test_shipping_is_free_when_subtotal_meets_threshold(): void
    {
        $user = $this->makeUser();
        $this->seedGateway('cod');

        $data = $this->getCheckoutViewData($user, 600); // 600 >= 500 threshold

        $this->assertEquals(0.0, $data['shippingCost']);
    }

    public function test_shipping_is_free_exactly_at_threshold(): void
    {
        $user = $this->makeUser();
        $this->seedGateway('cod');

        $data = $this->getCheckoutViewData($user, 500); // exactly at threshold

        $this->assertEquals(0.0, $data['shippingCost']);
    }

    // ── Tests: Tax calculation ────────────────────────────────────────────────

    public function test_tax_is_18_percent_of_subtotal(): void
    {
        $user = $this->makeUser();
        $this->seedGateway('cod');

        $data = $this->getCheckoutViewData($user, 200);

        $this->assertEquals(200 * 0.18, $data['taxAmount']); // 36.0
    }

    public function test_final_total_equals_total_plus_shipping_plus_tax(): void
    {
        $user = $this->makeUser();
        $this->seedGateway('cod');

        // subtotal=400 → shipping=50 (below threshold), tax=72 → total=522
        $data = $this->getCheckoutViewData($user, 400);

        $this->assertEquals(400 + 50 + 72.0, $data['finalTotal']);
    }

    // ── Tests: Referral discount ──────────────────────────────────────────────

    public function test_referral_discount_applied_on_first_order(): void
    {
        $referrer = $this->makeUser();
        $user     = $this->makeUser(['reffered_by' => $referrer->id]);
        $this->seedGateway('cod');
        // 0 orders → discount = 10% of 1000 = 100

        $data = $this->getCheckoutViewData($user, 1000);

        $this->assertEquals(100.0, $data['refferal_discount']);
        $this->assertEquals(900.0, $data['totalPrice']); // 1000 - 100
    }

    public function test_referral_discount_not_applied_on_subsequent_orders(): void
    {
        $referrer = $this->makeUser();
        $user     = $this->makeUser(['reffered_by' => $referrer->id]);
        DB::table('orders')->insert(['user_id' => $user->id, 'created_at' => now(), 'updated_at' => now()]);
        $this->seedGateway('cod');

        $data = $this->getCheckoutViewData($user, 1000);

        $this->assertEquals(0, $data['refferal_discount']);
        $this->assertEquals(1000.0, $data['totalPrice']);
    }

    public function test_referral_discount_not_applied_without_referrer(): void
    {
        $user = $this->makeUser(); // reffered_by = null
        $this->seedGateway('cod');

        $data = $this->getCheckoutViewData($user, 500);

        $this->assertEquals(0, $data['refferal_discount']);
        $this->assertEquals(500.0, $data['totalPrice']);
    }

    // ── Tests: Order count ────────────────────────────────────────────────────

    public function test_order_count_reflects_actual_orders_in_database(): void
    {
        $user = $this->makeUser();
        DB::table('orders')->insert([
            ['user_id' => $user->id, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => $user->id, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => $user->id, 'created_at' => now(), 'updated_at' => now()],
        ]);
        $this->seedGateway('cod');

        $data = $this->getCheckoutViewData($user, 400);

        $this->assertEquals(3, $data['orderCount']);
    }

    // ── Tests: Gateway filter ─────────────────────────────────────────────────

    public function test_cod_gateway_is_passed_to_view_when_present(): void
    {
        $user = $this->makeUser();
        $this->seedGateway('cod');

        $data = $this->getCheckoutViewData($user, 400);

        $this->assertNotNull($data['codGateway']);
        $this->assertSame('cod', strtolower($data['codGateway']->keyword));
    }

    public function test_razorpay_gateway_is_passed_to_view_when_present(): void
    {
        $user = $this->makeUser();
        $this->seedGateway('razorpay');

        $data = $this->getCheckoutViewData($user, 400);

        $this->assertNotNull($data['razorpayGateway']);
        $this->assertStringContainsStringIgnoringCase('razorpay', $data['razorpayGateway']->keyword);
    }

    public function test_gateways_are_null_when_no_matching_rows_exist(): void
    {
        $user = $this->makeUser();
        $this->seedGateway('stripe'); // neither COD nor Razorpay

        $data = $this->getCheckoutViewData($user, 400);

        $this->assertNull($data['codGateway']);
        $this->assertNull($data['razorpayGateway']);
    }

    public function test_gateway_with_checkout_disabled_is_excluded(): void
    {
        $user = $this->makeUser();
        $this->seedGateway('cod', checkout: 0); // disabled

        $data = $this->getCheckoutViewData($user, 400);

        $this->assertNull($data['codGateway']);
    }

    // ── Tests: Points balance ────────────────────────────────────────────────

    public function test_points_equals_rounded_user_current_balance(): void
    {
        $user = $this->makeUser();
        // current_balance is not in User::$fillable — use forceFill so the
        // in-memory model object is updated before being passed to actingAs()
        $user->forceFill(['current_balance' => 47.6])->save();
        $this->seedGateway('cod');

        $data = $this->getCheckoutViewData($user, 400);

        $this->assertEquals(48, $data['points']); // round(47.6) = 48
    }

    public function test_points_is_zero_when_balance_is_zero(): void
    {
        $user = $this->makeUser(); // current_balance defaults to 0 in test schema
        $this->seedGateway('cod');

        $data = $this->getCheckoutViewData($user, 400);

        $this->assertEquals(0, $data['points']);
    }

    // ── Tests: Discount is zero by default ───────────────────────────────────

    public function test_discount_mrp_is_zero_by_default(): void
    {
        $user = $this->makeUser();
        $this->seedGateway('cod');

        $data = $this->getCheckoutViewData($user, 400);

        $this->assertEquals(0, $data['discountMRP']);
    }
}
