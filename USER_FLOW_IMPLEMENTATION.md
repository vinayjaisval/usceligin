# User Flow & Logic Implementation Plan

**Date**: 2025-12-07
**Status**: Implementation Ready
**Database**: us_devceligin_1nov25

## Current System Analysis

### Existing Infrastructure ✅
- **OTP Authentication**: Fully functional (OtpController.php + OtpService.php)
- **User Model**: Supports phone/email with auto-creation
- **Routes**: Sign-in (`/sign-in`), My Account (`/myaccount`), Logout (`/logout`)
- **Session Management**: Cart & Wishlist stored in session
- **Views Ready**: sign-in.blade.php, my-account (index.blade.php), cart, checkout, wishlist

### Current Route Structure
```php
// Authentication
GET  /sign-in           → Auth\OtpController@showLoginForm (otp.login.form)
POST /otp/send          → Auth\User\LoginController@send_otp (otp.send)
POST /otp/verify        → Auth\User\LoginController@verify_otp (otp.verify)
POST /logout            → Auth\User\LoginController@logout (logout)

// Protected Routes (need middleware)
GET  /myaccount         → User\AccountController@index (user.account)
POST /myaccount/update  → User\AccountController@update (user.account.update)

// Public Routes
GET  /carts             → Front\CartController@cart (front.cart)
GET  /checkout          → Front\CheckoutController@checkout (front.checkout)
GET  /wishlist          → Front\WishlistController@wishlist (front.wishlist)
```

---

## Implementation Tasks

### PHASE 1: Header My Account Icon Logic

**File**: `resources/views/frontend/include/header.blade.php:119, 200`

**Current Code** (Line 119 Desktop + Line 200 Mobile):
```blade
<a href="{{ route('sign-in') }}" ...>
```

**Updated Logic**:
```blade
@auth
  <a href="{{ route('user.account') }}"
     aria-label="My account"
     class="p-2 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 ...">
    <svg><!-- User Icon --></svg>
  </a>
@else
  <a href="{{ route('otp.login.form') }}"
     aria-label="Sign in to your account"
     class="p-2 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 ...">
    <svg><!-- User Icon --></svg>
  </a>
@endauth
```

**Changes Required**:
1. Wrap `<a>` tag in `@auth/@else/@endauth` directive
2. Authenticated → redirect to `user.account`
3. Guest → redirect to `otp.login.form`

---

### PHASE 2: Authentication Middleware Setup

**Goal**: Protect routes that require authentication

#### Step 2.1: Create Redirect Logic Middleware

**File**: `app/Http/Middleware/RedirectIfAuthenticated.php` (Existing)
**Update**: Ensure it redirects guests to `/sign-in`

**File**: `app/Http/Middleware/Authenticate.php` (Existing)
**Update Method**:
```php
protected function redirectTo($request)
{
    if (!$request->expectsJson()) {
        // Store intended URL in session
        session(['url.intended' => $request->fullUrl()]);

        return route('otp.login.form');
    }
}
```

#### Step 2.2: Apply Middleware to Routes

**File**: `routes/web.php`

**Update Protected Routes**:
```php
// Protected routes requiring authentication
Route::middleware(['auth'])->group(function () {
    Route::get('/myaccount', 'User\AccountController@index')->name('user.account');
    Route::post('/myaccount/update', 'User\AccountController@update')->name('user.account.update');

    // Future: Order history, saved addresses, etc.
});

// Cart and Checkout - conditional authentication
Route::get('/carts', 'Front\CartController@cart')->name('front.cart'); // Public
Route::get('/checkout', 'Front\CheckoutController@checkout')
    ->middleware('auth') // Require login for checkout
    ->name('front.checkout');
```

---

### PHASE 3: Sign-In Redirect Logic with Return URLs

**Requirement**: After successful sign-in, redirect to:
1. Intended URL (if user was trying to access protected route)
2. Checkout (if cart-to-checkout flow)
3. My Account (default for direct sign-in)

#### Step 3.1: Update OTP Verification Flow

**File**: `app/Http/Controllers/Auth/User/LoginController.php`
**Method**: `verify_otp()`

**Add Before Redirect**:
```php
public function verify_otp(Request $request)
{
    // ... existing OTP verification logic ...

    if ($verified) {
        // Log user in
        Auth::login($user, $keepSignedIn);

        // Merge guest wishlist to user account
        $this->mergeGuestWishlist();

        // Determine redirect URL
        $redirectUrl = $this->getRedirectUrl();

        return response()->json([
            'success' => true,
            'message' => 'Login successful!',
            'redirect_url' => $redirectUrl
        ]);
    }
}

private function getRedirectUrl()
{
    // Priority 1: Intended URL from middleware
    if (session()->has('url.intended')) {
        $intendedUrl = session()->pull('url.intended');
        return $intendedUrl;
    }

    // Priority 2: Cart checkout flow
    if (session()->has('cart') && count(session('cart')->items) > 0) {
        return route('front.checkout');
    }

    // Priority 3: Default to My Account
    return route('user.account');
}
```

#### Step 3.2: Update Frontend Redirect Logic

**File**: `resources/views/frontend/sign-in.blade.php:884-913`

**Current Code** (Line 893):
```javascript
const redirectUrl = this.redirectUrl || sessionIntendedUrl || "{{ session('url.intended', route('front.index')) }}";
```

**Update To**:
```javascript
const redirectUrl = this.redirectUrl || sessionIntendedUrl || "{{ route('user.account') }}";
```

This ensures backend response `redirect_url` has priority, falling back to My Account.

---

### PHASE 4: Cart-to-Checkout Flow

**User Journey**:
1. Guest adds items to cart → `/carts` (public, no sign-in required)
2. Guest clicks "Checkout" → redirect to `/sign-in`
3. After sign-in → redirect to `/checkout` (with cart preserved)

#### Step 4.1: Add Middleware to Checkout Route

**File**: `routes/web.php:1886`

**Current**:
```php
Route::get('/checkout', 'Front\CheckoutController@checkout')->name('front.checkout');
```

**Updated**:
```php
Route::get('/checkout', 'Front\CheckoutController@checkout')
    ->middleware('auth')
    ->name('front.checkout');
```

#### Step 4.2: Update Cart "Proceed to Checkout" Button

**File**: `resources/views/frontend/add-to-cart.blade.php` (Find checkout button)

**Example Button**:
```blade
<a href="{{ route('front.checkout') }}"
   class="px-6 py-3 bg-orange-600 text-white font-semibold hover:bg-orange-700">
   Proceed to Checkout
</a>
```

**No Code Change Needed** - Middleware will handle redirect automatically.

---

### PHASE 5: Wishlist Merge Logic (Guest → User)

**Requirement**: When guest user signs in, merge session wishlist into database wishlist.

#### Step 5.1: Create Wishlist Merge Service

**File**: `app/Services/WishlistMergeService.php` (New File)

```php
<?php

namespace App\Services;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class WishlistMergeService
{
    public function mergeGuestWishlistToUser()
    {
        if (!Auth::check()) {
            return;
        }

        $userId = Auth::id();
        $guestWishlist = Session::get('wishlist', []);

        if (empty($guestWishlist)) {
            return;
        }

        foreach ($guestWishlist as $productId => $item) {
            // Check if product already in user's wishlist
            $existingWishlist = Wishlist::where('user_id', $userId)
                ->where('product_id', $productId)
                ->first();

            if (!$existingWishlist) {
                // Add to database
                Wishlist::create([
                    'user_id' => $userId,
                    'product_id' => $productId,
                    'created_at' => now(),
                ]);
            }
        }

        // Clear session wishlist after merge
        Session::forget('wishlist');
    }
}
```

#### Step 5.2: Create Wishlist Database Migration

**Command**:
```bash
php artisan make:migration create_wishlists_table
```

**File**: `database/migrations/YYYY_MM_DD_create_wishlists_table.php`

```php
public function up()
{
    Schema::create('wishlists', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('product_id');
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        $table->unique(['user_id', 'product_id']); // Prevent duplicates
    });
}
```

**Run Migration**:
```bash
php artisan migrate
```

#### Step 5.3: Create Wishlist Model

**File**: `app/Models/Wishlist.php` (New File)

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
```

#### Step 5.4: Call Merge on Sign-In

**File**: `app/Http/Controllers/Auth/User/LoginController.php`

**Update `verify_otp()` Method**:
```php
use App\Services\WishlistMergeService;

public function verify_otp(Request $request)
{
    // ... existing verification logic ...

    if ($verified) {
        Auth::login($user, $keepSignedIn);

        // Merge guest wishlist
        $wishlistService = new WishlistMergeService();
        $wishlistService->mergeGuestWishlistToUser();

        // ... rest of logic ...
    }
}
```

---

### PHASE 6: My Account Dashboard - Dynamic Data

**File**: `resources/views/user/account/index.blade.php`

#### Step 6.1: Update Controller to Pass Data

**File**: `app/Http/Controllers/User/AccountController.php`

```php
public function index()
{
    $user = Auth::user();

    // Get user's orders
    $orders = Order::where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->limit(5)
        ->get();

    // Get user's wishlist
    $wishlist = Wishlist::where('user_id', $user->id)
        ->with('product')
        ->get();

    // Get user's addresses
    $addresses = Address::where('user_id', $user->id)->get();

    // Get user's points/rewards
    $points = $user->reward_points ?? 0;

    return view('user.account.index', compact('user', 'orders', 'wishlist', 'addresses', 'points'));
}
```

#### Step 6.2: Update Dashboard View

**File**: `resources/views/user/account/index.blade.php:140-153`

**Replace Static "0" with Dynamic Data**:
```blade
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
  <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-4 text-center">
    <div class="text-2xl font-bold text-orange-600 dark:text-orange-400">{{ $orders->count() }}</div>
    <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">Total Orders</div>
  </div>
  <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-4 text-center">
    <div class="text-2xl font-bold text-orange-600 dark:text-orange-400">{{ $wishlist->count() }}</div>
    <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">Wishlist Items</div>
  </div>
  <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-4 text-center">
    <div class="text-2xl font-bold text-orange-600 dark:text-orange-400">{{ $points }}</div>
    <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">Points Earned</div>
  </div>
</div>
```

#### Step 6.3: Replace Empty States with Real Data

**Purchase History Section** (Line 170-188):
```blade
@if($orders->count() > 0)
  <div class="space-y-4">
    @foreach($orders as $order)
      <div class="border border-gray-200 dark:border-gray-700 p-4">
        <div class="flex justify-between items-start mb-2">
          <div>
            <h4 class="font-semibold text-gray-900 dark:text-gray-100">Order #{{ $order->order_number }}</h4>
            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $order->created_at->format('M d, Y') }}</p>
          </div>
          <span class="px-3 py-1 text-xs font-semibold
            @if($order->status == 'completed') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
            @elseif($order->status == 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
            @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200
            @endif">
            {{ ucfirst($order->status) }}
          </span>
        </div>
        <p class="text-sm text-gray-600 dark:text-gray-400">Total: ₹{{ number_format($order->total, 2) }}</p>
      </div>
    @endforeach
  </div>
@else
  <!-- Empty State -->
  @include('frontend.include.empty-state', [
    'icon' => 'shopping_bag',
    'title' => 'No Purchases Yet',
    'description' => 'You haven\'t made any purchases...',
    'actionText' => 'Start Shopping',
    'actionUrl' => route('front.index')
  ])
@endif
```

**Wishlist Section** (Line 190-208):
```blade
@if($wishlist->count() > 0)
  <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
    @foreach($wishlist as $item)
      <div class="border border-gray-200 dark:border-gray-700 p-3">
        <img src="{{ asset('assets/images/products/' . $item->product->photo) }}"
             alt="{{ $item->product->name }}"
             class="w-full h-32 object-cover mb-2">
        <h5 class="text-sm font-semibold text-gray-900 dark:text-gray-100 truncate">
          {{ $item->product->name }}
        </h5>
        <p class="text-sm text-orange-600 dark:text-orange-400 font-semibold">
          ₹{{ number_format($item->product->price, 2) }}
        </p>
      </div>
    @endforeach
  </div>
@else
  <!-- Empty State -->
@endif
```

---

### PHASE 7: Address Management

#### Step 7.1: Create Address Migration

**Command**:
```bash
php artisan make:migration create_addresses_table
```

**Migration File**:
```php
public function up()
{
    Schema::create('addresses', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->string('type')->default('home'); // home, work, other
        $table->string('name'); // Contact name
        $table->string('phone', 15);
        $table->text('address_line_1');
        $table->text('address_line_2')->nullable();
        $table->string('city');
        $table->string('state');
        $table->string('pincode', 6);
        $table->string('country')->default('India');
        $table->boolean('is_default')->default(false);
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}
```

**Run**:
```bash
php artisan migrate
```

#### Step 7.2: Create Address Model

**File**: `app/Models/Address.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Ensure only one default address per user
    public static function boot()
    {
        parent::boot();

        static::saving(function ($address) {
            if ($address->is_default) {
                // Remove default from other addresses
                static::where('user_id', $address->user_id)
                    ->where('id', '!=', $address->id)
                    ->update(['is_default' => false]);
            }
        });
    }
}
```

#### Step 7.3: Create Address Controller

**File**: `app/Http/Controllers/User/AddressController.php`

```php
<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Address::where('user_id', Auth::id())->get();
        return view('user.addresses.index', compact('addresses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:home,work,other',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address_line_1' => 'required|string',
            'address_line_2' => 'nullable|string',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'pincode' => 'required|digits:6',
            'is_default' => 'boolean',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['country'] = 'India';

        // Check address limit (max 3)
        if (Address::where('user_id', Auth::id())->count() >= 3) {
            return back()->with('error', 'You can only save up to 3 addresses.');
        }

        Address::create($validated);

        return back()->with('success', 'Address added successfully.');
    }

    public function update(Request $request, $id)
    {
        $address = Address::where('user_id', Auth::id())->findOrFail($id);

        $validated = $request->validate([
            'type' => 'required|in:home,work,other',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address_line_1' => 'required|string',
            'address_line_2' => 'nullable|string',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'pincode' => 'required|digits:6',
            'is_default' => 'boolean',
        ]);

        $address->update($validated);

        return back()->with('success', 'Address updated successfully.');
    }

    public function destroy($id)
    {
        $address = Address::where('user_id', Auth::id())->findOrFail($id);
        $address->delete();

        return back()->with('success', 'Address deleted successfully.');
    }

    public function setDefault($id)
    {
        $address = Address::where('user_id', Auth::id())->findOrFail($id);
        $address->update(['is_default' => true]);

        return back()->with('success', 'Default address updated.');
    }
}
```

#### Step 7.4: Add Address Routes

**File**: `routes/web.php` (Inside `auth` middleware group)

```php
Route::middleware(['auth'])->group(function () {
    // Existing routes...

    // Address management
    Route::get('/myaccount/addresses', 'User\AddressController@index')->name('user.addresses');
    Route::post('/myaccount/addresses', 'User\AddressController@store')->name('user.addresses.store');
    Route::put('/myaccount/addresses/{id}', 'User\AddressController@update')->name('user.addresses.update');
    Route::delete('/myaccount/addresses/{id}', 'User\AddressController@destroy')->name('user.addresses.destroy');
    Route::post('/myaccount/addresses/{id}/set-default', 'User\AddressController@setDefault')->name('user.addresses.set-default');
});
```

#### Step 7.5: Update My Account View - Add Address Accordion

**File**: `resources/views/user/account/index.blade.php:237-343` (Manage Account Tab)

**Add Address Section Using Accordion Component**:
```blade
{{-- Addresses Section --}}
<div class="mb-6">
  <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Your Addresses</h3>

  @include('frontend.include.accordion', [
    'items' => $addresses->map(function($address) {
      return [
        'title' => ucfirst($address->type) . ' Address' . ($address->is_default ? ' (Default)' : ''),
        'content' => view('user.partials.address-item', compact('address'))->render()
      ];
    })->toArray()
  ])

  @if($addresses->count() < 3)
    <button type="button"
            onclick="showAddAddressModal()"
            class="mt-4 px-4 py-2 border border-orange-600 text-orange-600 hover:bg-orange-50 dark:hover:bg-orange-900/20">
      + Add New Address
    </button>
  @else
    <p class="mt-4 text-sm text-gray-600 dark:text-gray-400">
      Maximum 3 addresses allowed.
    </p>
  @endif
</div>
```

---

### PHASE 8: Checkout - Address Integration

**File**: `app/Http/Controllers/Front/CheckoutController.php`

**Update `checkout()` Method**:
```php
public function checkout()
{
    if (!Auth::check()) {
        return redirect()->route('otp.login.form');
    }

    $user = Auth::user();
    $addresses = Address::where('user_id', $user->id)->get();
    $defaultAddress = $addresses->firstWhere('is_default', true);

    $cart = Session::get('cart');

    if (!$cart || count($cart->items) === 0) {
        return redirect()->route('front.cart')->with('error', 'Your cart is empty.');
    }

    return view('frontend.checkout', compact('cart', 'addresses', 'defaultAddress', 'user'));
}
```

**File**: `resources/views/frontend/checkout.blade.php`

**Add Address Selection**:
```blade
<h2 class="text-xl font-semibold mb-4">Delivery Address</h2>

@if($addresses->count() > 0)
  <div class="space-y-3 mb-4">
    @foreach($addresses as $address)
      <label class="block border border-gray-300 dark:border-gray-600 p-4 cursor-pointer hover:border-orange-500 dark:hover:border-orange-400 transition-colors">
        <input type="radio"
               name="address_id"
               value="{{ $address->id }}"
               {{ $address->is_default ? 'checked' : '' }}
               class="mr-3">
        <div class="inline-block">
          <p class="font-semibold text-gray-900 dark:text-gray-100">{{ $address->name }} - {{ $address->phone }}</p>
          <p class="text-sm text-gray-600 dark:text-gray-400">
            {{ $address->address_line_1 }}, {{ $address->address_line_2 }}<br>
            {{ $address->city }}, {{ $address->state }} - {{ $address->pincode }}
          </p>
        </div>
      </label>
    @endforeach
  </div>

  <a href="{{ route('user.addresses') }}" class="text-orange-600 dark:text-orange-400 text-sm">
    + Add New Address
  </a>
@else
  <p class="text-gray-600 dark:text-gray-400 mb-4">
    You don't have any saved addresses. Please add one to continue.
  </p>
  <a href="{{ route('user.addresses') }}" class="px-4 py-2 bg-orange-600 text-white">
    Add Address
  </a>
@endif
```

---

## Implementation Checklist

- [ ] **Phase 1**: Update header My Account icon logic
- [ ] **Phase 2**: Setup authentication middleware
- [ ] **Phase 3**: Implement sign-in redirect logic
- [ ] **Phase 4**: Add middleware to checkout route
- [ ] **Phase 5**: Create wishlist merge functionality
  - [ ] Create migration
  - [ ] Create model
  - [ ] Create service
  - [ ] Integrate into login flow
- [ ] **Phase 6**: Update My Account dashboard with dynamic data
  - [ ] Update controller
  - [ ] Update view with real data
- [ ] **Phase 7**: Implement address management
  - [ ] Create migration
  - [ ] Create model
  - [ ] Create controller
  - [ ] Add routes
  - [ ] Create views
- [ ] **Phase 8**: Integrate addresses into checkout
  - [ ] Update checkout controller
  - [ ] Update checkout view

---

## Database Schema Requirements

### New Tables Needed

#### 1. `wishlists` Table
```sql
CREATE TABLE wishlists (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    product_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    UNIQUE KEY unique_user_product (user_id, product_id)
);
```

#### 2. `addresses` Table
```sql
CREATE TABLE addresses (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    type VARCHAR(255) DEFAULT 'home',
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    address_line_1 TEXT NOT NULL,
    address_line_2 TEXT NULL,
    city VARCHAR(100) NOT NULL,
    state VARCHAR(100) NOT NULL,
    pincode VARCHAR(6) NOT NULL,
    country VARCHAR(100) DEFAULT 'India',
    is_default BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

---

## Testing Scenarios

### Scenario 1: New User Journey
1. Guest visits homepage
2. Clicks "My Account" icon → redirected to `/sign-in`
3. Enters phone number → receives OTP
4. Verifies OTP → redirected to `/myaccount`
5. Dashboard shows empty states for orders, wishlist, addresses

### Scenario 2: Guest Cart to Checkout
1. Guest adds products to cart
2. Guest clicks "Proceed to Checkout"
3. Redirected to `/sign-in` (intended URL saved: `/checkout`)
4. After sign-in → redirected to `/checkout`
5. Prompted to add delivery address

### Scenario 3: Guest Wishlist Merge
1. Guest adds 3 products to wishlist (stored in session)
2. Guest signs in
3. Session wishlist automatically merged to database
4. Guest visits "My Account" → sees 3 wishlist items

### Scenario 4: Existing User with Data
1. User signs in
2. Dashboard shows:
   - Total orders: 5
   - Wishlist items: 12
   - Points: 250
3. User clicks "Purchase History" → sees order list
4. User clicks "Manage Account" → sees saved addresses
5. User can add/edit/delete addresses (max 3)

### Scenario 5: Address Management
1. User navigates to "Manage Account" → "Your Addresses"
2. Clicks "Add New Address"
3. Fills form → saves
4. Sets address as default
5. Goes to checkout → default address pre-selected

---

## Notes & Considerations

1. **Session Persistence**: Cart and wishlist sessions are preserved across authentication.

2. **Security**: All protected routes use `auth` middleware. Intended URLs are validated to prevent open redirects.

3. **User Experience**:
   - Clear empty states guide users to take action
   - Automatic redirects reduce friction
   - Default addresses streamline checkout

4. **Data Integrity**:
   - Wishlist uses unique constraint to prevent duplicates
   - Address model auto-manages default selection
   - Max 3 addresses per user enforced

5. **Future Enhancements**:
   - Order history pagination
   - Wishlist sharing
   - Address validation via Google Maps API
   - Points/rewards calculation system

---

**Last Updated**: 2025-12-07
**Next Review**: After Phase 3 completion
