# Laravel Patterns Reference Guide

Detailed examples and advanced patterns for the Usceligin e-commerce project.

---

## Table of Contents

1. [Complete OTP Authentication Flow](#complete-otp-authentication-flow)
2. [Checkout to Payment Flow](#checkout-to-payment-flow)
3. [Wishlist Implementation](#wishlist-implementation)
4. [Address Management CRUD](#address-management-crud)
5. [Payment Status Page](#payment-status-page)
6. [Route Security Examples](#route-security-examples)
7. [Blade Component Library](#blade-component-library)
8. [Common Debugging Commands](#common-debugging-commands)

---

## Complete OTP Authentication Flow

### Step 1: Display Login Form

**File:** `resources/views/frontend/sign-in.blade.php`

```blade
<form id="otp-form" method="POST" action="{{ route('otp.send') }}">
    @csrf

    <label for="phone" class="block text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2">
        Mobile Number
    </label>

    <div class="relative flex items-center border border-gray-300 dark:border-gray-600">
        <span class="bg-gray-100 dark:bg-gray-600 px-4 py-3 text-sm font-medium">+91</span>
        <input
            type="tel"
            id="phone"
            name="phone"
            required
            class="flex-1 px-4 py-3 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
            placeholder="12345 67890"
            maxlength="10"
            pattern="[6-9][0-9]{9}">
    </div>

    <button type="submit" class="w-full py-3 bg-orange-600 text-white font-semibold hover:bg-orange-700">
        Send OTP
    </button>
</form>
```

### Step 2: OTP Controller (Send)

**File:** `app/Http/Controllers/Auth/User/LoginController.php`

```php
public function send_otp(Request $request)
{
    $request->validate([
        'phone' => [
            'required',
            'regex:/^[6-9][0-9]{9}$/', // Indian phone format
        ],
    ]);

    try {
        $otpService = app(OtpService::class);
        $result = $otpService->sendOtp($request->phone);

        if ($result['success']) {
            return response()->json([
                'success' => true,
                'message' => 'OTP sent successfully',
                'expires_in' => config('otp.expiry_minutes', 10)
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => $result['message']
        ], 429);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to send OTP'
        ], 500);
    }
}
```

### Step 3: OTP Service Implementation

**File:** `app/Services/OtpService.php`

```php
namespace App\Services;

use App\Models\User;
use App\Models\OtpVerification;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class OtpService
{
    protected $otpLength = 6;
    protected $expiryMinutes = 10;
    protected $maxAttempts = 5;

    public function sendOtp($phone)
    {
        // Rate limiting check
        $recentAttempts = OtpVerification::where('phone', $phone)
            ->where('created_at', '>', Carbon::now()->subHour())
            ->count();

        if ($recentAttempts >= $this->maxAttempts) {
            return [
                'success' => false,
                'message' => 'Too many OTP requests. Please try after an hour.'
            ];
        }

        // Generate OTP
        $otp = config('app.debug') ? '123456' : $this->generateOtp();

        // Store OTP
        OtpVerification::create([
            'phone' => $phone,
            'otp' => config('otp.hash_in_database') ? Hash::make($otp) : $otp,
            'expires_at' => Carbon::now()->addMinutes($this->expiryMinutes),
            'ip_address' => request()->ip(),
        ]);

        // Send SMS (in production)
        if (!config('app.debug')) {
            // $this->sendSms($phone, $otp);
        }

        return [
            'success' => true,
            'message' => 'OTP sent successfully',
            'otp' => config('app.debug') ? $otp : null // Only in debug mode
        ];
    }

    public function verifyOtp($phone, $otp)
    {
        $otpRecord = OtpVerification::where('phone', $phone)
            ->where('verified', false)
            ->where('expires_at', '>', Carbon::now())
            ->latest()
            ->first();

        if (!$otpRecord) {
            return ['success' => false, 'message' => 'Invalid or expired OTP'];
        }

        // Check OTP match
        $otpMatches = config('otp.hash_in_database')
            ? Hash::check($otp, $otpRecord->otp)
            : $otp === $otpRecord->otp;

        if (!$otpMatches) {
            $otpRecord->increment('attempts');

            if ($otpRecord->attempts >= 3) {
                $otpRecord->delete();
                return ['success' => false, 'message' => 'Too many failed attempts'];
            }

            return ['success' => false, 'message' => 'Invalid OTP'];
        }

        // Mark as verified
        $otpRecord->update(['verified' => true]);

        // Get or create user
        $user = User::firstOrCreate(
            ['phone' => $phone],
            ['name' => 'User_' . substr($phone, -4)]
        );

        return [
            'success' => true,
            'user' => $user,
            'message' => 'OTP verified successfully'
        ];
    }

    protected function generateOtp()
    {
        return str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }
}
```

### Step 4: Verify OTP Controller

```php
public function verify_otp(Request $request)
{
    $request->validate([
        'phone' => 'required',
        'otp' => 'required|digits:6',
    ]);

    $otpService = app(OtpService::class);
    $result = $otpService->verifyOtp($request->phone, $request->otp);

    if ($result['success']) {
        Auth::login($result['user']);

        // Redirect to intended URL or myaccount
        $intendedUrl = session('url.intended', route('user.account'));
        session()->forget('url.intended');

        return redirect($intendedUrl)
            ->with('success', 'Welcome back!');
    }

    return back()
        ->withInput()
        ->with('error', $result['message']);
}
```

---

## Checkout to Payment Flow

### Step 1: Checkout Controller

**File:** `app/Http/Controllers/Front/CheckoutController.php`

```php
public function checkout()
{
    // Check authentication
    if (!Auth::check()) {
        session(['url.intended' => route('front.checkout')]);
        return redirect()->route('otp.login.form')
            ->with('error', 'Please login to proceed to checkout.');
    }

    // Check cart
    if (!Session::has('cart')) {
        return redirect()->route('front.cart')
            ->with('success', "You don't have any product to checkout.");
    }

    $cart = Session::get('cart');
    $user = Auth::user();

    // Get user's addresses
    $addresses = Address::where('user_id', $user->id)->get();
    $defaultAddress = $addresses->firstWhere('is_default', true);

    // Calculate totals
    $total = $cart->totalPrice;

    if (Session::has('coupon_total')) {
        $total = (float) preg_replace('/[^0-9.]/', '', Session::get('coupon_total'));
    }

    // Payment gateways
    $gateways = PaymentGateway::scopeHasGateway($this->curr->id);

    return view('frontend.checkout', [
        'products' => $cart->items,
        'totalPrice' => $total,
        'totalQty' => $cart->totalQty,
        'gateways' => $gateways,
        'addresses' => $addresses,
        'defaultAddress' => $defaultAddress,
        'user' => $user
    ]);
}
```

### Step 2: Payment Submission (Razorpay Example)

**File:** `app/Http/Controllers/Payment/Checkout/RazorpayController.php`

```php
public function store(Request $request)
{
    // Verify user is authenticated
    if (!Auth::check()) {
        return redirect()->route('otp.login.form');
    }

    $request->validate([
        'razorpay_payment_id' => 'required',
        'razorpay_order_id' => 'required',
        'razorpay_signature' => 'required',
    ]);

    try {
        // Verify signature
        $api = new Api(config('payment.razorpay_key'), config('payment.razorpay_secret'));

        $api->utility->verifyPaymentSignature([
            'razorpay_order_id' => $request->razorpay_order_id,
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'razorpay_signature' => $request->razorpay_signature
        ]);

        // Create order
        $order = Order::create([
            'user_id' => Auth::id(),
            'order_number' => 'ORD' . time(),
            'txnid' => $request->razorpay_payment_id,
            'method' => 'Razorpay',
            'pay_amount' => $this->calculateTotal(),
            'status' => 'pending',
        ]);

        // Clear cart
        Session::forget('cart');

        // Redirect to success page
        return redirect()->route('front.payment.status', [
            'status' => 'success',
            'order_id' => $order->id
        ]);

    } catch (\Exception $e) {
        return redirect()->route('front.payment.status', [
            'status' => 'failed'
        ])->with('error', 'Payment verification failed');
    }
}
```

---

## Wishlist Implementation

### Migration

```php
// database/migrations/2025_12_08_024945_create_wishlists_table.php
public function up(): void
{
    Schema::create('wishlists', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('product_id');
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        $table->unique(['user_id', 'product_id']);
    });
}
```

### Model

```php
// app/Models/Wishlist.php
class Wishlist extends Model
{
    protected $fillable = ['user_id', 'product_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Scope to check if product is in user's wishlist
    public static function isInWishlist($userId, $productId)
    {
        return static::where('user_id', $userId)
            ->where('product_id', $productId)
            ->exists();
    }
}
```

### Controller

```php
// app/Http/Controllers/Front/WishlistController.php
public function addwishlist($id)
{
    if (!Auth::check()) {
        return response()->json([
            'error' => 'Please login to add items to wishlist'
        ], 401);
    }

    $product = Product::findOrFail($id);
    $user = Auth::user();

    // Check if already in wishlist
    if (Wishlist::isInWishlist($user->id, $product->id)) {
        return response()->json([
            'success' => false,
            'message' => 'Already in wishlist'
        ]);
    }

    Wishlist::create([
        'user_id' => $user->id,
        'product_id' => $product->id,
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Added to wishlist',
        'wishlist_count' => Wishlist::where('user_id', $user->id)->count()
    ]);
}

public function wishlist()
{
    if (!Auth::check()) {
        return redirect()->route('otp.login.form');
    }

    $wishlists = Wishlist::where('user_id', Auth::id())
        ->with('product')
        ->latest()
        ->get();

    return view('frontend.wishlist', compact('wishlists'));
}
```

---

## Address Management CRUD

### Controller

```php
// app/Http/Controllers/User/AddressController.php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();

        // Limit to 3 addresses per user
        if (Address::where('user_id', $user->id)->count() >= 3) {
            return back()->with('error', 'Maximum 3 addresses allowed');
        }

        $validated = $request->validate([
            'type' => 'required|in:home,work,other',
            'name' => 'required|string|max:255',
            'phone' => 'required|regex:/^[6-9][0-9]{9}$/',
            'address_line_1' => 'required|string',
            'address_line_2' => 'nullable|string',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'pincode' => 'required|regex:/^[1-9][0-9]{5}$/',
            'is_default' => 'boolean',
        ]);

        $address = Address::create([
            'user_id' => $user->id,
            ...$validated
        ]);

        return redirect()->route('user.account')
            ->with('success', 'Address added successfully');
    }

    public function update(Request $request, $id)
    {
        $address = Address::where('user_id', Auth::id())
            ->findOrFail($id);

        $validated = $request->validate([
            'type' => 'required|in:home,work,other',
            'name' => 'required|string|max:255',
            'phone' => 'required|regex:/^[6-9][0-9]{9}$/',
            'address_line_1' => 'required|string',
            'address_line_2' => 'nullable|string',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'pincode' => 'required|regex:/^[1-9][0-9]{5}$/',
            'is_default' => 'boolean',
        ]);

        $address->update($validated);

        return back()->with('success', 'Address updated successfully');
    }

    public function destroy($id)
    {
        $address = Address::where('user_id', Auth::id())
            ->findOrFail($id);

        $address->delete();

        return back()->with('success', 'Address deleted successfully');
    }

    public function setDefault($id)
    {
        $user = Auth::user();

        // Remove default from all addresses
        Address::where('user_id', $user->id)
            ->update(['is_default' => false]);

        // Set new default
        $address = Address::where('user_id', $user->id)
            ->findOrFail($id);

        $address->update(['is_default' => true]);

        return back()->with('success', 'Default address updated');
    }
}
```

---

## Payment Status Page

See `PAYMENT_STATUS_PAGE.md` for complete implementation. Here's the key pattern:

```php
public function paymentStatus(Request $request)
{
    $status = $request->get('status', 'success');
    $orderId = $request->get('order_id');

    $orderData = Order::with('items')->findOrFail($orderId);

    $order = [
        'order_number' => $orderData->order_number,
        'order_date' => $orderData->created_at->format('d-M-Y'),
        'transaction_id' => $orderData->txnid,
        'payment_method' => $orderData->method,
    ];

    $paymentInfo = [
        'subtotal' => $orderData->pay_amount,
        'shipping' => $orderData->shipping_cost ?? 0,
        'discount' => $orderData->coupon_discount ?? 0,
        'tax' => $orderData->tax ?? 0,
        'total' => $orderData->pay_amount,
    ];

    $billingAddress = [
        'name' => $orderData->customer_name,
        'email' => $orderData->customer_email,
        'phone' => $orderData->customer_phone,
        'address' => $orderData->customer_address,
        'city' => $orderData->customer_city,
        'state' => $orderData->customer_state,
        'zip' => $orderData->customer_zip,
    ];

    $orderProducts = $orderData->items->map(function($item) {
        return [
            'name' => $item->product_name,
            'quantity' => $item->qty,
            'price' => $item->price,
            'total' => $item->qty * $item->price,
        ];
    })->toArray();

    return view('frontend.payment-status', compact(
        'status', 'order', 'paymentInfo', 'billingAddress', 'orderProducts'
    ));
}
```

---

## Route Security Examples

### Complete Route File Structure

```php
// routes/web.php

// Guest-only routes
Route::middleware('guest')->group(function () {
    Route::get('/sign-in', 'Auth\OtpController@showLoginForm')->name('otp.login.form');
});

// Rate-limited OTP routes
Route::middleware('throttle:5,1')->group(function () {
    Route::post('/otp/send', 'Auth\User\LoginController@send_otp')->name('otp.send');
    Route::post('/otp/resend', 'Auth\OtpController@resendOtp')->name('otp.resend');
});

Route::middleware('throttle:10,1')->group(function () {
    Route::post('/otp/verify', 'Auth\User\LoginController@verify_otp')->name('otp.verify');
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    // User account
    Route::get('/myaccount', 'User\AccountController@index')->name('user.account');
    Route::post('/myaccount/update', 'User\AccountController@update');

    // Addresses
    Route::post('/myaccount/addresses', 'User\AddressController@store');
    Route::put('/myaccount/addresses/{id}', 'User\AddressController@update');
    Route::delete('/myaccount/addresses/{id}', 'User\AddressController@destroy');
    Route::post('/myaccount/addresses/{id}/set-default', 'User\AddressController@setDefault');

    // Checkout
    Route::get('/checkout', 'Front\CheckoutController@checkout')->name('front.checkout');

    // Payment submissions
    Route::post('/checkout/payment/razorpay-submit', 'Payment\Checkout\RazorpayController@store');
    Route::post('/checkout/payment/stripe-submit', 'Payment\Checkout\StripeController@store');
    // ... all other payment gateways
});

// Logout
Route::post('/logout', 'Auth\User\LoginController@logout')->name('logout')->middleware('auth');
```

---

## Blade Component Library

### Full Page Layout

```blade
@extends('frontend.include.app')

@section('content')
<main id="main-content" role="main" class="bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">

        {{-- Breadcrumb --}}
        @include('frontend.include.breadcrumb', ['items' => [
            ['label' => 'Home', 'url' => route('front.index')],
            ['label' => 'Current Page']
        ]])

        {{-- Content here --}}

    </div>
</main>
@endsection
```

### Card Component Pattern

```blade
<div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
    {{-- Header --}}
    <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700/30 border-b border-gray-200 dark:border-gray-700">
        <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100">Card Title</h2>
    </div>

    {{-- Body --}}
    <div class="p-6">
        <p class="text-gray-600 dark:text-gray-400">Card content</p>
    </div>
</div>
```

### Form Component Pattern

```blade
<form method="POST" action="{{ route('user.account.update') }}">
    @csrf

    {{-- Input Field --}}
    <div class="mb-6">
        <label for="name" class="block text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2">
            Full Name <span class="text-red-600">*</span>
        </label>
        <input
            type="text"
            id="name"
            name="name"
            required
            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
            value="{{ old('name', $user->name) }}">
        @error('name')
            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>

    {{-- Submit Button --}}
    <button
        type="submit"
        class="w-full px-6 py-3 bg-orange-600 text-white font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">
        Update Profile
    </button>
</form>
```

---

## Common Debugging Commands

### Check Tables

```bash
# List all tables
C:/wamp64/bin/mysql/bin/mysql.exe -u root -h 127.0.0.1 -P 3307 \
  -e "USE us_devceligin_1nov25; SHOW TABLES;"

# Describe table structure
C:/wamp64/bin/mysql/bin/mysql.exe -u root -h 127.0.0.1 -P 3307 \
  -e "USE us_devceligin_1nov25; DESCRIBE wishlists;"

# Count records
C:/wamp64/bin/mysql/bin/mysql.exe -u root -h 127.0.0.1 -P 3307 \
  -e "USE us_devceligin_1nov25; SELECT COUNT(*) FROM wishlists;"
```

### Tinker Commands

```bash
C:/wamp64/bin/php/php8.1.31/php.exe artisan tinker

# Count users
>>> App\Models\User::count();

# Find user by phone
>>> App\Models\User::where('phone', '9999999999')->first();

# Get user's wishlist
>>> App\Models\Wishlist::where('user_id', 1)->with('product')->get();

# Latest order
>>> App\Models\Order::latest()->first();

# Check if table exists
>>> Schema::hasTable('wishlists');

# Get table columns
>>> Schema::getColumnListing('wishlists');
```

### Clear Caches

```bash
# Clear all caches
C:/wamp64/bin/php/php8.1.31/php.exe artisan optimize:clear

# Individual clears
C:/wamp64/bin/php/php8.1.31/php.exe artisan route:clear
C:/wamp64/bin/php/php8.1.31/php.exe artisan config:clear
C:/wamp64/bin/php/php8.1.31/php.exe artisan view:clear
C:/wamp64/bin/php/php8.1.31/php.exe artisan cache:clear
```

---

**End of Reference Guide**
