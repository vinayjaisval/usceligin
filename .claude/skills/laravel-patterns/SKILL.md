---
name: laravel-patterns
description: Laravel 10 development patterns for Usceligin e-commerce project. Use when working with controllers, models, routes, Blade templates, authentication, payments, or any Laravel-specific code. Includes OTP authentication, route security, payment gateways, Tailwind CSS, and project-specific standards.
allowed-tools: Read, Edit, Write, Grep, Glob, Bash
---

# Laravel Patterns for Usceligin E-Commerce

This skill provides comprehensive development patterns for the Usceligin Laravel e-commerce project.

---

## 🔐 Authentication Patterns

### CRITICAL: OTP Authentication Only (No Passwords!)

This project uses **OTP (One-Time Password) authentication** exclusively - there are NO traditional passwords.

#### OTP Controller Pattern

**File:** `app/Http/Controllers/Auth/User/LoginController.php`

```php
public function send_otp(Request $request) {
    $request->validate([
        'phone' => 'required|regex:/^[6-9][0-9]{9}$/', // Indian phone format
    ]);

    $otpService = new OtpService();
    $result = $otpService->sendOtp($request->phone);

    return response()->json($result);
}

public function verify_otp(Request $request) {
    $request->validate([
        'phone' => 'required',
        'otp' => 'required|digits:6',
    ]);

    $otpService = new OtpService();
    $result = $otpService->verifyOtp($request->phone, $request->otp);

    if ($result['success']) {
        Auth::login($result['user']);
        return redirect()->intended(route('user.account'));
    }

    return back()->with('error', 'Invalid OTP');
}
```

#### OTP Service Pattern

**File:** `app/Services/OtpService.php`

```php
class OtpService {
    public function sendOtp($phone) {
        // Rate limiting: 5 attempts per hour
        // OTP expires in 10 minutes
        // Development mode: OTP is always 123456
    }

    public function verifyOtp($phone, $otp) {
        // Max 3 verification attempts
        // Auto-create user if doesn't exist
    }
}
```

---

## 🛡️ Route Security Patterns

### Rule: ALL Sensitive Routes MUST Use `auth` Middleware

#### Protected Route Pattern

```php
// User account routes (ALWAYS protected)
Route::middleware('auth')->group(function () {
    Route::get('/myaccount', 'User\AccountController@index')->name('user.account');
    Route::post('/myaccount/update', 'User\AccountController@update');

    // Address management
    Route::post('/myaccount/addresses', 'User\AddressController@store');
    Route::put('/myaccount/addresses/{id}', 'User\AddressController@update');
    Route::delete('/myaccount/addresses/{id}', 'User\AddressController@destroy');
});

// Checkout route (MUST be protected)
Route::get('/checkout', 'Front\CheckoutController@checkout')
    ->middleware('auth')
    ->name('front.checkout');

// Payment submission routes (ALWAYS protected)
Route::middleware('auth')->group(function () {
    Route::post('/checkout/payment/razorpay-submit', 'Payment\Checkout\RazorpayController@store');
    Route::post('/checkout/payment/stripe-submit', 'Payment\Checkout\StripeController@store');
    // ... all payment gateway submissions
});
```

#### Guest-Only Route Pattern

```php
// Login page - redirect if already authenticated
Route::middleware('guest')->group(function () {
    Route::get('/sign-in', 'Auth\OtpController@showLoginForm')->name('otp.login.form');
});
```

#### Rate-Limited Routes Pattern

```php
// OTP routes with rate limiting
Route::middleware('throttle:5,1')->group(function () {
    Route::post('/otp/send', 'Auth\User\LoginController@send_otp');
    Route::post('/otp/resend', 'Auth\OtpController@resendOtp');
});

Route::middleware('throttle:10,1')->group(function () {
    Route::post('/otp/verify', 'Auth\User\LoginController@verify_otp');
});
```

**See:** `ROUTE_SECURITY.md` for complete route security documentation.

---

## 🗄️ Database Configuration

### CRITICAL: Non-Standard MySQL Port

**This project uses MySQL on port 3307 (NOT default 3306!)**

#### .env Configuration

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3307                        # ⚠️ NON-STANDARD PORT
DB_DATABASE=us_devceligin_1nov25
DB_USERNAME=root
DB_PASSWORD=
```

#### Command Line Access

```bash
# ALWAYS use port 3307
C:/wamp64/bin/mysql/bin/mysql.exe -u root -h 127.0.0.1 -P 3307 -e "USE us_devceligin_1nov25; SHOW TABLES;"
```

#### Laravel Artisan Commands

```bash
# PHP path for XAMPP
C:/wamp64/bin/php/php8.1.31/php.exe artisan migrate
C:/wamp64/bin/php/php8.1.31/php.exe artisan tinker
C:/wamp64/bin/php/php8.1.31/php.exe artisan route:clear
```

---

## 🎨 Frontend Design Standards

### CRITICAL Design Rules

#### ❌ FORBIDDEN
- **NO rounded corners** (sharp design aesthetic)
- **NO hardcoded values**
- **NO missing dark mode variants**
- **NO duplicate code** (use DRY principles)
- **NO emojis** (unless explicitly requested)

#### ✅ REQUIRED
- **Accessibility:** ARIA labels, semantic HTML
- **Dark mode:** Always include `dark:` variants
- **Mobile-first:** Responsive breakpoints (sm, md, lg, xl)
- **Tailwind-first:** Use utility classes over custom CSS
- **Component reuse:** Leverage existing Blade components

#### Brand Colors

```css
/* Primary Color */
--orange-600: #EA580C

/* Use in Tailwind */
.bg-orange-600
.text-orange-600
.border-orange-600
.dark:bg-orange-500
.dark:text-orange-400
```

#### Sharp Design (No Rounded Corners)

```blade
{{-- ❌ WRONG --}}
<div class="rounded-lg border">...</div>
<button class="rounded-full">...</button>

{{-- ✅ CORRECT --}}
<div class="border">...</div>
<button class="">...</button>
```

#### Dark Mode Support

```blade
{{-- ✅ ALWAYS include dark mode variants --}}
<div class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
    <h1 class="text-gray-900 dark:text-gray-100">Title</h1>
    <p class="text-gray-600 dark:text-gray-400">Description</p>
</div>
```

---

## 📝 Blade Template Patterns

### Always Use Existing Components

#### Breadcrumb Component

```blade
@include('frontend.include.breadcrumb', ['items' => [
    ['label' => 'Home', 'url' => route('front.index')],
    ['label' => 'My Account']
]])
```

#### Empty State Component

```blade
@include('frontend.include.empty-state', [
    'icon' => 'shopping_bag',
    'title' => 'No Purchases Yet',
    'description' => 'You haven\'t made any purchases.',
    'actionText' => 'Start Shopping',
    'actionUrl' => route('front.index')
])
```

#### Accordion Component

```blade
@include('frontend.include.accordion', [
    'items' => [
        ['title' => 'Question 1', 'content' => 'Answer 1'],
        ['title' => 'Question 2', 'content' => 'Answer 2'],
    ]
])
```

### DRY Blade Patterns

**Always create reusable dictionaries instead of repeating code:**

```blade
@php
// Icons dictionary (DRY)
$icons = [
    'user' => '<path d="..."/>',
    'email' => '<path d="..."/>',
    'phone' => '<path d="..."/>',
];

// Classes dictionary (DRY)
$classes = [
    'card' => 'bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700',
    'label' => 'text-xs uppercase text-gray-500 dark:text-gray-400',
    'value' => 'text-base font-bold text-gray-900 dark:text-gray-100',
];
@endphp

{{-- Use in loops --}}
@foreach($items as $item)
    <div class="{{ $classes['card'] }}">
        {!! $icons[$item['icon']] !!}
        <span class="{{ $classes['label'] }}">{{ $item['label'] }}</span>
        <span class="{{ $classes['value'] }}">{{ $item['value'] }}</span>
    </div>
@endforeach
```

**See:** `PAYMENT_STATUS_PAGE.md` for excellent DRY implementation example.

---

## 💳 Payment Gateway Patterns

### All Payment Routes MUST Be Protected

```php
Route::middleware('auth')->group(function () {
    // Razorpay
    Route::post('/checkout/payment/razorpay-submit', 'Payment\Checkout\RazorpayController@store')
        ->name('front.razorpay.submit');

    // Stripe
    Route::post('/checkout/payment/stripe-submit', 'Payment\Checkout\StripeController@store')
        ->name('front.stripe.submit');

    // PayPal
    Route::post('/checkout/payment/paypal/submit', 'Payment\Checkout\PaypalController@store')
        ->name('front.paypal.submit');

    // Cash on Delivery (still requires auth!)
    Route::post('/checkout/payment/cod-submit', 'Payment\Checkout\CashOnDeliveryController@store')
        ->name('front.cod.submit');
});
```

### Payment Status Page Pattern

```php
// CheckoutController
public function paymentStatus(Request $request) {
    $status = $request->get('status', 'success'); // success, failed, pending
    $orderId = $request->get('order_id');

    $orderData = Order::with('items')->findOrFail($orderId);

    $order = [
        'order_number' => $orderData->order_number,
        'order_date' => $orderData->created_at->format('d-M-Y'),
        'transaction_id' => $orderData->txnid,
        'payment_method' => $orderData->method,
    ];

    return view('frontend.payment-status', compact('status', 'order'));
}
```

---

## 🏗️ Controller Patterns

### File Read Before Edit (CRITICAL!)

**ALWAYS read files before modifying them:**

```php
// ❌ WRONG - Don't edit without reading first
Edit('app/Http/Controllers/UserController.php', ...);

// ✅ CORRECT - Always read first
$content = Read('app/Http/Controllers/UserController.php');
// Analyze the content
Edit('app/Http/Controllers/UserController.php', ...);
```

### Controller with Auth Check

```php
class AccountController extends Controller
{
    public function index()
    {
        // Extra safety check beyond middleware
        if (!Auth::check()) {
            return redirect()->route('otp.login.form')
                ->with('error', 'Please login to access your account.');
        }

        $user = Auth::user();

        // Rest of controller logic
        return view('user.account.index', compact('user'));
    }
}
```

### Controller with Validation

```php
public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'nullable|email|unique:users,email,' . $user->id,
        'phone' => 'nullable|string|max:15|unique:users,phone,' . $user->id,
    ]);

    $user->update($request->only(['name', 'email', 'phone']));

    return redirect()->route('user.account')
        ->with('success', 'Profile updated successfully!');
}
```

---

## 📊 Model Patterns

### Wishlist Model

```php
class Wishlist extends Model
{
    protected $fillable = ['user_id', 'product_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
```

### Address Model with Auto-Default

```php
class Address extends Model
{
    protected $fillable = [
        'user_id', 'type', 'name', 'phone',
        'address_line_1', 'address_line_2',
        'city', 'state', 'pincode', 'country', 'is_default'
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        // Ensure only one default address per user
        static::saving(function ($address) {
            if ($address->is_default) {
                static::where('user_id', $address->user_id)
                    ->where('id', '!=', $address->id)
                    ->update(['is_default' => false]);
            }
        });
    }
}
```

---

## 🔄 Migration Patterns

### Create Migration

```bash
C:/wamp64/bin/php/php8.1.31/php.exe artisan make:migration create_wishlists_table
```

### Migration Structure

```php
public function up(): void
{
    Schema::create('wishlists', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('product_id');
        $table->timestamps();

        // Foreign key constraints
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

        // Prevent duplicate entries
        $table->unique(['user_id', 'product_id']);
    });
}
```

### Run Migration

```bash
C:/wamp64/bin/php/php8.1.31/php.exe artisan migrate
```

---

## 🚀 Git Commit Patterns

### Commit Message Format

```bash
git commit -m "$(cat <<'EOF'
feat: Add user wishlist functionality

- Create wishlists table migration
- Add Wishlist model with relationships
- Implement add/remove wishlist routes
- Add wishlist icon to product cards

🤖 Generated with [Claude Code](https://claude.com/claude-code)

Co-Authored-By: Claude Sonnet 4.5 <noreply@anthropic.com>
EOF
)"
```

### What to Commit

✅ **DO commit:**
- `.mcp.json` (project MCP servers)
- `.claude/skills/` (team skills)
- `CLAUDE.md`, `ROUTE_SECURITY.md` (documentation)
- Source code changes
- Migration files

❌ **DON'T commit:**
- `.claude/settings.local.json` (personal settings)
- `.env` (secrets)
- `node_modules/`, `vendor/` (dependencies)
- Personal MCP servers (`~/.claude.json`)

---

## 📚 Common Tasks Quick Reference

### Check Database Tables

```bash
C:/wamp64/bin/mysql/bin/mysql.exe -u root -h 127.0.0.1 -P 3307 \
  -e "USE us_devceligin_1nov25; SHOW TABLES;"
```

### Clear Laravel Caches

```bash
C:/wamp64/bin/php/php8.1.31/php.exe artisan route:clear
C:/wamp64/bin/php/php8.1.31/php.exe artisan config:clear
C:/wamp64/bin/php/php8.1.31/php.exe artisan view:clear
```

### Run Laravel Tinker

```bash
C:/wamp64/bin/php/php8.1.31/php.exe artisan tinker

# Example tinker commands
>>> App\Models\User::count();
>>> App\Models\Wishlist::where('user_id', 1)->get();
>>> App\Models\Order::latest()->first();
```

---

## 🎯 When to Use This Skill

Use this skill when you:
- Create new controllers or models
- Add routes with authentication
- Work with Blade templates
- Implement payment features
- Need database queries
- Follow project code standards
- Set up new features
- Refactor existing code
- Write migrations
- Configure middleware

---

## 📖 Related Documentation

- **Project Instructions:** `CLAUDE.md`
- **Route Security:** `ROUTE_SECURITY.md`
- **Payment Status Page:** `PAYMENT_STATUS_PAGE.md`
- **MCP Test Results:** `MCP_TEST_RESULTS.md`

For detailed examples and advanced patterns, see [REFERENCE.md](REFERENCE.md).

---

**Last Updated:** 2025-12-21
**Project:** Usceligin E-Commerce
**Framework:** Laravel 10.x
**Database:** MySQL 3307
