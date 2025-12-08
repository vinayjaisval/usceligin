@extends('frontend.include.app')

@section('content')
@php
  // Calculate order totals
  $subtotalMRP = $totalPrice;
  $discountMRP = Session::get('coupon', 0);
  $shippingCost = $totalPrice >= ($gs->free_shipping_amount ?? 500) ? 0 : ($gs->shipping_cost ?? 50);
  $referralDiscount = $refferal_discount ?? 0;

  // Calculate tax based on shipping address
  $userZip = Auth::check() ? Auth::user()->zip : '';
  $taxRate = 0.18; // Default 18% GST

  // You can customize tax rates based on ZIP code here
  // Example: Different tax rates for different states/regions
  if ($userZip) {
    // Add your ZIP code based tax logic here
    // For now using default 18% GST
  }

  $taxableAmount = $subtotalMRP - $discountMRP - $referralDiscount;
  $taxAmount = $taxableAmount * $taxRate;

  // Final total calculation
  $finalTotal = $subtotalMRP - $discountMRP - $referralDiscount + $shippingCost + $taxAmount;

  // Check if user has saved addresses
  $userHasAddress = Auth::check() && Auth::user()->address;
@endphp

<!-- Main Content -->
<main id="main-content" role="main" class="bg-gray-50 dark:bg-gray-900 min-h-screen">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <!-- Breadcrumb Navigation -->
    @include('frontend.include.breadcrumb', ['items' => [
      ['label' => 'Home', 'url' => route('front.index')],
      ['label' => 'Cart', 'url' => route('front.cart')],
      ['label' => 'Checkout']
    ]])

    <!-- Page Title -->
    <div class="mb-6">
      <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100">Checkout</h1>
    </div>

    <!-- Checkout Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

      <!-- Left Column: Cart, Addresses, Payment -->
      <div class="lg:col-span-2 space-y-4">

        <!-- Cart Section -->
        <section class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700" id="cart-section">
          <div class="p-4 sm:p-6">
            <div class="flex items-center space-x-3 mb-4">
              <h2 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-gray-100">Cart</h2>
              <span class="text-sm text-gray-600 dark:text-gray-400">
                ({{ $totalQty }} {{ $totalQty === 1 ? 'item' : 'items' }})
              </span>
            </div>

            <!-- Cart Items -->
            <div class="space-y-3">
              @if(!empty($products))
                @foreach ($products as $product)
                <div class="flex gap-3 sm:gap-4 pb-3 border-b border-gray-200 dark:border-gray-700 last:border-0 last:pb-0">
                  <!-- Product Image -->
                  <div class="w-16 h-16 sm:w-20 sm:h-20 flex-shrink-0 bg-gray-100 dark:bg-gray-700 rounded overflow-hidden">
                    <img
                      src="{{ $product['item']['photo'] ? asset('assets/images/products/'.$product['item']['photo']) : asset('assets/images/noimage.png') }}"
                      alt="{{ $product['item']['name'] }}"
                      class="w-full h-full object-cover"
                      loading="lazy" />
                  </div>

                  <!-- Product Details -->
                  <div class="flex-1 min-w-0">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100 line-clamp-2">
                      {{ $product['item']['name'] }}
                    </h3>
                    <div class="flex flex-wrap items-center gap-2 mt-1 text-xs text-gray-600 dark:text-gray-400">
                      @if(!empty($product['size']))
                      <span class="px-2 py-0.5 bg-gray-100 dark:bg-gray-700 rounded">{{ $product['size'] }}</span>
                      @endif
                      @if(!empty($product['color']))
                      <span class="px-2 py-0.5 bg-gray-100 dark:bg-gray-700 rounded">{{ $product['color'] }}</span>
                      @endif
                      <span>Qty: {{ $product['qty'] }}</span>
                    </div>
                    <p class="text-sm font-bold text-gray-900 dark:text-gray-100 mt-1">
                      {{ App\Models\Product::convertPrice($product['price']) }}
                    </p>
                  </div>
                </div>
                @endforeach
              @endif
            </div>

            <a href="{{ route('front.cart') }}" class="inline-flex items-center space-x-1 text-sm text-orange-600 dark:text-orange-400 hover:text-orange-700 dark:hover:text-orange-300 font-medium mt-4 transition-colors">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
              </svg>
              <span>Modify Cart</span>
            </a>
          </div>
        </section>

        <!-- Address Section -->
        <section class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700" id="address-section">
          <div class="p-4 sm:p-6">
            <div class="flex items-center space-x-3 mb-4">
              <h2 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-gray-100">Delivery Address</h2>
            </div>

            @if($userHasAddress)
              <!-- Existing User: Show Saved Address -->
              <div id="saved-address-display" class="border border-gray-200 dark:border-gray-700 p-4 mb-4">
                <div class="flex items-start justify-between">
                  <div class="flex-1">
                    <p class="font-semibold text-gray-900 dark:text-gray-100">{{ Auth::user()->name }}</p>
                    <p class="text-sm text-gray-700 dark:text-gray-300 mt-1">{{ Auth::user()->address }}</p>
                    @if(Auth::user()->city || Auth::user()->state || Auth::user()->zip)
                    <p class="text-sm text-gray-700 dark:text-gray-300">
                      {{ Auth::user()->city }}{{ Auth::user()->city && Auth::user()->state ? ', ' : '' }}{{ Auth::user()->state }} {{ Auth::user()->zip }}
                    </p>
                    @endif
                    @if(Auth::user()->phone)
                    <p class="text-sm text-gray-700 dark:text-gray-300 mt-1">
                      <span class="font-medium">Phone:</span> {{ Auth::user()->phone }}
                    </p>
                    @endif
                  </div>
                  <button
                    type="button"
                    onclick="toggleAddressForm()"
                    class="text-sm text-orange-600 dark:text-orange-400 hover:text-orange-700 dark:hover:text-orange-300 font-medium transition-colors">
                    Change
                  </button>
                </div>
              </div>

              <!-- Hidden Address Form (for editing) -->
              <div id="address-form-container" class="hidden">
            @else
              <!-- New User: Show Form Directly -->
              <div id="address-form-container">
            @endif

              <form id="addressForm" class="space-y-4">
                @csrf

                <!-- Full Name -->
                <div>
                  <label for="full_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Full name (First and Last name) <span class="text-red-600">*</span>
                  </label>
                  <input
                    type="text"
                    id="full_name"
                    name="full_name"
                    value="{{ Auth::check() ? Auth::user()->name : '' }}"
                    required
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors"
                    aria-required="true" />
                </div>

                <!-- Phone Number and Email -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                  <!-- Phone Number -->
                  <div>
                    <label for="phone_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                      Phone number <span class="text-red-600">*</span>
                    </label>
                    <input
                      type="tel"
                      id="phone_number"
                      name="phone_number"
                      value="{{ Auth::check() ? Auth::user()->phone : '' }}"
                      required
                      placeholder="+919999499035"
                      class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors"
                      aria-required="true"
                      aria-describedby="phone-help" />
                    <p id="phone-help" class="text-xs text-gray-600 dark:text-gray-400 mt-1">May be used to assist delivery</p>
                  </div>

                  <!-- Email Address -->
                  <div>
                    <label for="email_address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                      Email address <span class="text-red-600">*</span>
                    </label>
                    <input
                      type="email"
                      id="email_address"
                      name="email_address"
                      value="{{ Auth::check() ? Auth::user()->email : '' }}"
                      required
                      placeholder="example@domain.com"
                      class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors"
                      aria-required="true"
                      aria-describedby="email-help" />
                    <p id="email-help" class="text-xs text-gray-600 dark:text-gray-400 mt-1">For order updates</p>
                  </div>
                </div>

                <!-- Street Address -->
                <div>
                  <label for="street_address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Street address <span class="text-red-600">*</span>
                  </label>
                  <input
                    type="text"
                    id="street_address"
                    name="street_address"
                    value="{{ Auth::check() ? Auth::user()->address : '' }}"
                    required
                    placeholder="Street address or P.O. Box"
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors"
                    aria-required="true" />
                </div>

                <!-- Landmark -->
                <div>
                  <label for="landmark" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Landmark
                  </label>
                  <input
                    type="text"
                    id="landmark"
                    name="landmark"
                    placeholder="Apt, suite, unit, building, floor, etc."
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors" />
                </div>

                <!-- City, State, ZIP, Country Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                  <!-- ZIP Code -->
                  <div> 
                    <label for="zip_code" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                      ZIP Code <span class="text-red-600">*</span>
                    </label>
                    <input
                      type="text"
                      id="zip_code"
                      name="zip_code"
                      value="{{ Auth::check() ? Auth::user()->zip : '' }}"
                      required
                      maxlength="6"
                      class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors"
                      aria-required="true" />
                  </div>
                  <!-- City -->
                  <div>
                    <label for="city" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                      City <span class="text-red-600">*</span>
                    </label>
                    <input
                      type="text"
                      id="city"
                      name="city"
                      value="{{ Auth::check() ? Auth::user()->city : '' }}"
                      required
                     class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-300"
                      aria-required="true" />
                  </div>
                 <div>
                   <label for="state" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                      State <span class="text-red-600">*</span>
                    </label>
                    <input
                      type="text"
                     id="state"
                      name="state"
                      required
                      value="{{ Auth::check() ? Auth::user()->state : '' }}"
                      required
                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-300"
                      aria-required="true" />
                  </div>
                  <!-- State -->
                
                

                  <!-- Country -->
                  <div>
                    <label for="country" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                      Country <span class="text-red-600">*</span>
                    </label>
                    <input
                      type="text"
                      id="country"
                      name="country"
                      value="{{ Auth::check() ? Auth::user()->country : '' }}"
                      readonly
                      class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-300"
                      aria-required="true" />
                  </div>
                </div>

                <!-- Make this my default address -->
                <div class="flex items-start space-x-2">
                  <input
                    type="checkbox"
                    id="default_address"
                    name="default_address"
                    class="mt-1 w-4 h-4 text-orange-600 border-gray-300 rounded focus:ring-orange-500"
                    {{ $userHasAddress ? '' : 'checked' }} />
                  <label for="default_address" class="text-sm text-gray-700 dark:text-gray-300 cursor-pointer">
                    Make this my default address
                  </label>
                </div>

                <!-- Save Button (for existing users editing) -->
                @if($userHasAddress)
                <div class="flex gap-3">
                  <button
                    type="button"
                    onclick="saveAddress()"
                    class="px-6 py-2 bg-orange-600 text-white text-sm font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 transition-colors">
                    Save Address
                  </button>
                  <button
                    type="button"
                    onclick="toggleAddressForm()"
                    class="px-6 py-2 bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100 text-sm font-semibold hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors">
                    Cancel
                  </button>
                </div>
                @endif
              </form>
            </div>

            <!-- Billing Address Toggle -->
            <div class="mt-4 border-t border-gray-200 dark:border-gray-700 pt-4">
              <div class="flex items-start space-x-2">
                <input
                  type="checkbox"
                  id="same_as_delivery"
                  name="same_as_delivery"
                  checked
                  onchange="toggleBillingAddress()"
                  class="mt-1 w-4 h-4 text-orange-600 border-gray-300 focus:ring-orange-500" />
                <label for="same_as_delivery" class="text-sm text-gray-700 dark:text-gray-300 cursor-pointer">
                  Billing address same as delivery address
                </label>
              </div>

              <!-- Billing Address Form (Hidden by default) -->
              <div id="billing-address-container" class="hidden mt-4">
                <h3 class="text-md font-semibold text-gray-900 dark:text-gray-100 mb-3">Billing Address</h3>
                <form id="billingAddressForm" class="space-y-4">
                  @csrf

                  <!-- Full Name -->
                  <div>
                    <label for="billing_full_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                      Full name <span class="text-red-600">*</span>
                    </label>
                    <input
                      type="text"
                      id="billing_full_name"
                      name="billing_full_name"
                      required
                      class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors" />
                  </div>

                  <!-- Phone and Email -->
                  <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                      <label for="billing_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Phone number <span class="text-red-600">*</span>
                      </label>
                      <input
                        type="tel"
                        id="billing_phone"
                        name="billing_phone"
                        required
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors" />
                    </div>
                    <div>
                      <label for="billing_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Email address <span class="text-red-600">*</span>
                      </label>
                      <input
                        type="email"
                        id="billing_email"
                        name="billing_email"
                        required
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors" />
                    </div>
                  </div>

                  <!-- Street Address -->
                  <div>
                    <label for="billing_address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                      Street address <span class="text-red-600">*</span>
                    </label>
                    <input
                      type="text"
                      id="billing_address"
                      name="billing_address"
                      required
                      class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors" />
                  </div>

                  <!-- City, State, ZIP, Country -->
                  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                      <div>
                      <label for="billing_zip" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        ZIP Code <span class="text-red-600">*</span>
                      </label>
                      <input
                        type="text"
                        id="billing_zip"
                        name="billing_zip"
                        required
                        maxlength="6"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors" />
                    </div>
                    <div>
                      <label for="billing_city" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        City <span class="text-red-600">*</span>
                      </label>
                      <input
                        type="text"
                        id="billing_city"
                        name="billing_city"
                        required
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors" />
                    </div>
                    <div>
                      <label for="billing_state" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        State <span class="text-red-600">*</span>
                      </label>
                      <select
                        id="billing_state"
                        name="billing_state"
                        required
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors">
                        <option value="">Select</option>
                        <option value="Delhi">Delhi</option>
                        <option value="Maharashtra">Maharashtra</option>
                        <option value="Karnataka">Karnataka</option>
                      </select>
                    </div>
                  
                    <div>
                      <label for="billing_country" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Country <span class="text-red-600">*</span>
                      </label>
                      <input
                        type="text"
                        id="billing_country"
                        name="billing_country"
                        value="India"
                        readonly
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-300" />
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </section>

        <!-- Payment Method Section -->
        <section id="payment-section"
  class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">

  <div class="p-4 sm:p-6">
    <h2 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">
      Choose Payment Mode
    </h2>

    <div class="space-y-2">

      @forelse($gateways as $index => $gateway)
        @if ($gateway->checkout != 1)
          @continue
        @endif

        @php
          $keyword = strtolower($gateway->keyword);
          $isOpen = $index === 0; // First payment method opened
        @endphp

        <!-- Payment Box -->
        <div class="border border-gray-200 dark:border-gray-700 overflow-hidden">

          <!-- Payment Header -->
          <button type="button"
            onclick="togglePaymentMethod('payment_{{ $gateway->id }}')"
            class="w-full flex items-center justify-between p-4 bg-white dark:bg-gray-800
                   hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">

            <div class="flex items-center space-x-3">
              <input type="radio"
                name="payment_method"
                value="{{ $gateway->id }}"
                id="payment_radio_{{ $gateway->id }}"
                class="w-4 h-4 text-orange-600 border-gray-300 focus:ring-orange-500"
                {{ $isOpen ? 'checked' : '' }} />

              <label for="payment_radio_{{ $gateway->id }}"
                class="font-medium text-gray-900 dark:text-gray-100 cursor-pointer">
                {{ $gateway->title ?? ucfirst($keyword) }}
              </label>
            </div>

            <svg id="chevron_{{ $gateway->id }}"
              class="w-5 h-5 text-gray-600 dark:text-gray-400 transform transition-transform
                     {{ $isOpen ? 'rotate-180' : '' }}"
              fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 9l-7 7-7-7" />
            </svg>

          </button>

          <!-- Payment Content -->
          <div id="payment_{{ $gateway->id }}"
            class="{{ $isOpen ? '' : 'hidden' }}
                   p-4 border-t border-gray-200 dark:border-gray-700
                   bg-gray-50 dark:bg-gray-900">

            {{-- ##############################
                PAYMENT TYPE CONDITIONS
                ############################## --}}

            @if($keyword == 'cod')
              {{-- CASH ON DELIVERY --}}
              <div class="flex items-center space-x-3">
                <input type="radio" name="cod_method" value="cash" id="cod_cash"
                  checked
                  class="w-4 h-4 text-orange-600 border-gray-300 focus:ring-orange-500">
                <label for="cod_cash"
                  class="text-sm text-gray-700 dark:text-gray-300">
                  Cash on Delivery (Cash / UPI)
                </label>
              </div>
              <p class="text-xs text-gray-600 dark:text-gray-400 mt-2 ml-7">
                You can pay via Cash or UPI on delivery.
              </p>

            @elseif(str_contains($keyword, 'upi'))
              {{-- UPI PAYMENT --}}
              <div class="space-y-3">
                <div class="flex items-center space-x-3">
                  <input type="radio" name="upi_method" value="scan" id="upi_scan"
                    class="w-4 h-4 text-orange-600 border-gray-300 focus:ring-orange-500">
                  <label for="upi_scan" class="text-sm text-gray-700 dark:text-gray-300">
                    Scan & Pay
                  </label>
                </div>

                <div class="flex items-center space-x-3">
                  <input type="radio" name="upi_method" value="id" id="upi_id"
                    checked
                    class="w-4 h-4 text-orange-600 border-gray-300 focus:ring-orange-500">
                  <label for="upi_id" class="text-sm text-gray-700 dark:text-gray-300">
                    Enter UPI ID
                  </label>
                </div>

                <input type="text" placeholder="Enter your UPI ID"
                  class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600
                         rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100
                         focus:ring-2 focus:ring-orange-500 text-sm" />
              </div>

            @elseif(str_contains($keyword, 'card'))
              {{-- CARD PAYMENT --}}
              <div class="space-y-3">
                <input type="text" placeholder="Card Number" maxlength="16"
                  class="input-field" />

                <input type="text" placeholder="Name on card"
                  class="input-field" />

                <div class="grid grid-cols-2 gap-3">
                  <input type="text" placeholder="MM/YY" maxlength="5"
                    class="input-field" />
                  <input type="text" placeholder="CVV" maxlength="3"
                    class="input-field" />
                </div>
              </div>

            @elseif(str_contains($keyword, 'wallet'))
              {{-- WALLET --}}
              <div class="space-y-3">
                <div class="flex items-center space-x-3 p-3 border rounded">
                  <input type="radio" name="wallet_provider" value="mobikwik"
                    id="wallet_mobikwik" checked
                    class="w-4 h-4 text-orange-600 border-gray-300 focus:ring-orange-500">

                  <label for="wallet_mobikwik"
                    class="flex-1 text-sm text-gray-700 dark:text-gray-300">
                    Mobikwik
                  </label>
                </div>

                <input type="text" placeholder="+91 XXXXXXX702"
                  class="input-field" />

                <p class="text-xs text-gray-600 dark:text-gray-400">
                  This number will be linked with wallet
                </p>
              </div>

            @elseif(str_contains($keyword, 'bank'))
              {{-- NET BANKING --}}
              <p class="text-sm text-gray-700 dark:text-gray-300 mb-3">
                Select your bank:
              </p>

              @php
                $banks = ['Axis Bank', 'HDFC Bank', 'ICICI Bank', 'Kotak', 'SBI', 'Other Bank'];
              @endphp

              @foreach($banks as $bank)
                <div class="flex items-center space-x-3 p-2 hover:bg-white dark:hover:bg-gray-800 rounded">
                  <input type="radio" name="bank_name"
                    value="{{ strtolower(str_replace(' ', '_', $bank)) }}"
                    id="bank_{{ strtolower(str_replace(' ', '_', $bank)) }}"
                    class="w-4 h-4 text-orange-600 border-gray-300 focus:ring-orange-500">
                  <label for="bank_{{ strtolower(str_replace(' ', '_', $bank)) }}"
                    class="text-sm text-gray-700 dark:text-gray-300">
                    {{ $bank }}
                  </label>
                </div>
              @endforeach

            @else
              {{-- OTHER PAYMENT TYPES --}}
              <p class="text-sm text-gray-700 dark:text-gray-300">
                Click "Pay Now" to proceed with {{ $gateway->title ?? ucfirst($keyword) }}.
              </p>
            @endif

          </div>
        </div>

      @empty
        <p class="text-sm text-gray-600 dark:text-gray-400 p-4 text-center">
          No payment methods available
        </p>
      @endforelse

    </div>
  </div>
</section>

<style>
  .input-field {
    @apply w-full px-3 py-2 border border-gray-300 dark:border-gray-600
           rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100
           focus:ring-2 focus:ring-orange-500 text-sm;
  }
</style>


      </div>

      <!-- Right Column: Order Summary -->
      <div class="lg:col-span-1">
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-4 sm:p-6 lg:sticky lg:top-6">

          <!-- Promo Code Collapsible -->
          <div class="border border-gray-300 dark:border-gray-600 mb-4">
            <button
              type="button"
              onclick="togglePromoCode()"
              class="w-full flex items-center justify-between p-3 text-left">
              <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
                <span class="text-sm font-medium text-gray-900 dark:text-gray-100">Apply Promo Code</span>
              </div>
              <svg
                id="promo-chevron"
                class="w-5 h-5 text-gray-600 dark:text-gray-400 transform transition-transform"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>

            <div id="promo-content" class="hidden p-3 border-t border-gray-300 dark:border-gray-600">
              <form onsubmit="return applyCoupon();" class="flex gap-2">
                <input
                  type="text"
                  id="coupon_code"
                  placeholder="Enter code"
                  class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-sm text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500"
                  aria-label="Promo code" />
                <button
                  type="submit"
                  class="px-4 py-2 bg-orange-600 text-white text-sm font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 transition-colors">
                  Apply
                </button>
              </form>
            </div>
          </div>

          <!-- Order Summary -->
          <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">Order Summary</h3>

<div class="space-y-3 text-sm">
    
    <!-- Subtotal -->
    <div class="flex justify-between">
        <span class="text-gray-600 dark:text-gray-400">
            Subtotal MRP ({{ $totalQty }} {{ $totalQty === 1 ? 'item' : 'items' }})
        </span>
        <span class="font-semibold text-gray-900 dark:text-gray-100" id="subtotal-mrp">
            {{ App\Models\Product::convertPrice($subtotalMRP) }}
        </span>
    </div>

    <!-- Discount -->
    @if($discountMRP > 0 || $referralDiscount > 0)
    <div class="flex justify-between text-green-600 dark:text-green-400">
        <span>Discount on MRP</span>
        <span class="font-semibold" id="mrp-discount">
            -{{ App\Models\Product::convertPrice($discountMRP + $referralDiscount) }}
        </span>
    </div>
    @endif

    <!-- Coupon -->
    <div id="applied-coupon-display" class="hidden flex justify-between items-center text-green-600 dark:text-green-400">
        <span>Coupon Discount</span>
        <div class="flex items-center space-x-2">
            <span class="font-semibold" id="coupon-discount-amount">-₹0</span>
            <button type="button" onclick="removeCoupon()" class="text-red-600 hover:text-red-700">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Shipping -->
    <div class="flex justify-between">
        <span class="text-gray-600 dark:text-gray-400">Shipping</span>
        <span class="font-semibold text-gray-900 dark:text-gray-100" id="shipping-amount">
            {{ $shippingCost == 0 ? 'FREE' : App\Models\Product::convertPrice($shippingCost) }}
        </span>
    </div>

    <!-- Taxes -->
    <div class="flex justify-between">
        <span class="text-gray-600 dark:text-gray-400">Estimated Taxes (GST 18%)</span>
        <span class="font-semibold text-gray-900 dark:text-gray-100" id="tax-amount">
            {{ App\Models\Product::convertPrice($taxAmount) }}
        </span>
    </div>

</div>

<!-- Total -->
<div class="flex justify-between items-center py-4 border-t border-gray-200 dark:border-gray-700 mt-4">
    <span class="text-lg font-bold text-gray-900 dark:text-gray-100">Total</span>
    <span class="text-lg font-bold text-gray-900 dark:text-gray-100" id="final-total">
        {{ App\Models\Product::convertPrice($finalTotal) }}
    </span>
</div>

         

          <!-- Place Order Button -->
          <button
            type="button"
            onclick="placeOrder()"
            class="w-full px-6 py-3 bg-orange-600 text-white text-base font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-colors duration-200">
            Place your order
          </button>

          <!-- Terms -->
          <p class="text-xs text-gray-600 dark:text-gray-400 text-center mt-4">
            By ordering, you accept our
            <a href="{{ route('terms') }}" class="text-orange-600 dark:text-orange-400 hover:underline">terms</a>
            and
            <a href="{{ route('privacy') }}" class="text-orange-600 dark:text-orange-400 hover:underline">privacy policy</a>
          </p>
        </div>
      </div>

    </div>
  </div>
</main>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  const userHasAddress = {{ $userHasAddress ? 'true' : 'false' }};

  // Toggle address form (for existing users)
  function toggleAddressForm() {
    const display = document.getElementById('saved-address-display');
    const form = document.getElementById('address-form-container');

    if (display && form) {
      display.classList.toggle('hidden');
      form.classList.toggle('hidden');
    }
  }

  // Save address
  function saveAddress() {
    const form = document.getElementById('addressForm');
    const formData = new FormData(form);

    // Basic validation
    const requiredFields = ['full_name', 'phone_number', 'email_address', 'street_address', 'city', 'state', 'zip_code'];
    for (const field of requiredFields) {
      if (!formData.get(field)) {
        showToast(`Please fill in ${field.replace('_', ' ')}`, 'error');
        return;
      }
    }

    // TODO: Implement AJAX call to save address
    // For now, just toggle back and show success
    showToast('Address saved successfully', 'success');

    // Recalculate tax based on new ZIP code
    calculateTax(formData.get('zip_code'));

    if (userHasAddress) {
      toggleAddressForm();
    }
  }

  // Toggle billing address form
  function toggleBillingAddress() {
    const checkbox = document.getElementById('same_as_delivery');
    const billingContainer = document.getElementById('billing-address-container');

    if (checkbox && billingContainer) {
      if (checkbox.checked) {
        billingContainer.classList.add('hidden');
      } else {
        billingContainer.classList.remove('hidden');
      }
    }
  }

  // Calculate tax based on ZIP code
  function calculateTax(zipCode) {
    if (!zipCode) return;

    // Default GST rate 18%
    let taxRate = 0.18;

    // You can add ZIP code based tax logic here
    // Example:
    // if (zipCode.startsWith('110')) { // Delhi
    //   taxRate = 0.18;
    // } else if (zipCode.startsWith('400')) { // Mumbai
    //   taxRate = 0.18;
    // }

    const subtotal = {{ $subtotalMRP }};
    const discount = {{ $discountMRP }};
    const referralDiscount = {{ $referralDiscount }};
    const shipping = {{ $shippingCost }};

    const taxableAmount = subtotal - discount - referralDiscount;
    const taxAmount = taxableAmount * taxRate;
    const finalTotal = taxableAmount + shipping + taxAmount;

    // Update tax display
    const taxElement = document.getElementById('tax-amount');
    if (taxElement) {
      taxElement.textContent = '{{ $gs->currency_sign ?? "₹" }}' + taxAmount.toFixed(2);
    }

    // Update final total
    const totalElement = document.getElementById('final-total');
    if (totalElement) {
      totalElement.textContent = '{{ $gs->currency_sign ?? "₹" }}' + finalTotal.toFixed(2);
    }
  }

  // Listen for ZIP code changes
  document.addEventListener('DOMContentLoaded', function() {
    const zipInput = document.getElementById('zip_code');
    if (zipInput) {
      zipInput.addEventListener('blur', function() {
        calculateTax(this.value);
      });
    }
  });

  // Toggle promo code section
  function togglePromoCode() {
    const content = document.getElementById('promo-content');
    const chevron = document.getElementById('promo-chevron');

    content.classList.toggle('hidden');
    chevron.classList.toggle('rotate-180');
  }

  // Toggle payment method accordion
  function togglePaymentMethod(id) {
    const content = document.getElementById(id);
    const chevronId = 'chevron_' + id.replace('payment_', '');
    const chevron = document.getElementById(chevronId);
    const radioId = 'payment_radio_' + id.replace('payment_', '');
    const radio = document.getElementById(radioId);

    // Close all other payment methods
    document.querySelectorAll('[id^="payment_"]').forEach(el => {
      if (el.id !== id && !el.id.includes('radio')) {
        el.classList.add('hidden');
      }
    });

    // Reset all chevrons
    document.querySelectorAll('[id^="chevron_"]').forEach(el => {
      if (el.id !== chevronId) {
        el.classList.remove('rotate-180');
      }
    });

    // Toggle current
    content.classList.toggle('hidden');
    chevron.classList.toggle('rotate-180');

    // Select this payment method
    if (radio) {
      radio.checked = true;
    }
  }

  // Apply coupon
  function applyCoupon() {
    const couponCode = document.getElementById('coupon_code').value.trim();

    if (!couponCode) {
      showToast('Please enter a coupon code', 'error');
      return false;
    }

    const submitBtn = event.target.querySelector('button[type="submit"]');
    const originalText = submitBtn.textContent;
    submitBtn.disabled = true;
    submitBtn.textContent = 'Applying...';

    const totalPrice = parseFloat('{{ $totalPrice }}');

    fetch(`/carts/coupon/check?code=${encodeURIComponent(couponCode)}&total=${totalPrice}`, {
      method: 'GET',
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': csrfToken
      }
    })
    .then(res => res.json())
    .then(data => {
      submitBtn.disabled = false;
      submitBtn.textContent = originalText;

      if (Array.isArray(data) && data[5] === 1) {
        const discount = data[2];

        // Update UI
        document.getElementById('applied-coupon-display').classList.remove('hidden');
        document.getElementById('coupon-discount-amount').textContent = '-{{ $gs->currency_sign ?? "₹" }}' + discount;

        // Clear input field
        document.getElementById('coupon_code').value = '';

        // Recalculate total
        updateTotal(discount);

        showToast('Coupon applied successfully!', 'success');

        // Close promo section
        togglePromoCode();
      } else if (data === 0) {
        showToast('Invalid or expired coupon code', 'error');
      } else if (data === 2) {
        showToast('Coupon already applied', 'info');
      } else if (data === 3) {
        showToast('Minimum order value not met', 'error');
      } else if (data === 8) {
        showToast('You have already used this coupon', 'error');
      } else {
        showToast('Unable to apply coupon', 'error');
      }
    })
    .catch(err => {
      submitBtn.disabled = false;
      submitBtn.textContent = originalText;
      showToast('Error applying coupon', 'error');
      console.error('Coupon error:', err);
    });

    return false;
  }

  // Remove coupon
  function removeCoupon() {
    document.getElementById('applied-coupon-display').classList.add('hidden');
    document.getElementById('coupon_code').value = '';
    updateTotal(0);
    showToast('Coupon removed', 'info');
  }

  // Update total
  function updateTotal(couponDiscount = 0) {
    const subtotal = parseFloat('{{ $subtotalMRP }}');
    const existingDiscount = parseFloat('{{ $discountMRP + $referralDiscount }}');
    const shipping = parseFloat('{{ $shippingCost }}');
    const taxRate = 0.18; // 18% GST

    // Calculate tax on taxable amount (after all discounts)
    const taxableAmount = subtotal - existingDiscount - couponDiscount;
    const taxAmount = taxableAmount * taxRate;

    // Update tax display
    const taxElement = document.getElementById('tax-amount');
    if (taxElement) {
      taxElement.textContent = '{{ $gs->currency_sign ?? "₹" }}' + taxAmount.toFixed(2);
    }

    // Calculate final total
    const newTotal = taxableAmount + shipping + taxAmount;
    document.getElementById('final-total').textContent = '{{ $gs->currency_sign ?? "₹" }}' + newTotal.toFixed(2);
  }

  // Place order
  function placeOrder() {
    // Validate payment method
    const paymentMethod = document.querySelector('input[name="payment_method"]:checked');
    if (!paymentMethod) {
      showToast('Please select a payment method', 'error');
      return;
    }

    // Validate address (for new users)
    if (!userHasAddress) {
      const form = document.getElementById('addressForm');
      if (!form.checkValidity()) {
        form.reportValidity();
        showToast('Please fill in all required address fields', 'error');
        return;
      }
    }

    // TODO: Implement order placement
    showToast('Processing order...', 'info');
    console.log('Order placement logic to be implemented');
  }

  // Show toast notification
  function showToast(message, type = 'success') {
    const backgroundColor = type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : '#f59e0b';

    if (typeof Toastify !== 'undefined') {
      Toastify({
        text: message,
        duration: 3000,
        close: true,
        gravity: "top",
        position: "right",
        backgroundColor: backgroundColor
      }).showToast();
    } else {
      alert(message);
    }
  }
</script>
<script>
$(document).ready(function () {

    let fetchedPin = '';

    // MAIN URL FOR AJAX
    var mainurl = "{{ url('/') }}";

    // ----------------------------------------------------------
    // 🔹 ON PAGE LOAD → CHECK IF ZIP STORED IN LOCAL STORAGE
    // ----------------------------------------------------------
    if (localStorage.getItem("zip_code")) {
        let savedPin = localStorage.getItem("zip_code");
        $("#zip_code").val(savedPin);

        // Auto-trigger fetch if pin valid
        if (savedPin.length === 6 && /^\d{6}$/.test(savedPin)) {
            fetchedPin = savedPin;
            autoFillAddress(savedPin);
        }
    }

    // ----------------------------------------------------------
    // 🔹 WHEN USER TYPES PIN → SAVE TO LOCAL STORAGE
    // ----------------------------------------------------------
    $('#zip_code').on('keyup', function () {
        let pincode = $(this).val().trim();

        // Save pin live (even if incomplete)
        localStorage.setItem("zip_code", pincode);

        if (pincode.length === 6 && /^\d{6}$/.test(pincode) && pincode !== fetchedPin) {
            fetchedPin = pincode;
            autoFillAddress(pincode);
        } else if (pincode.length < 6) {
            $('#city, #state, #country').val('');
        }
    });

    // ----------------------------------------------------------
    // 🔹 FUNCTION: AUTO-FILL CITY / STATE / COUNTRY
    // ----------------------------------------------------------
    function autoFillAddress(pincode) {

        $('#city').val('Loading...');
        $('#state').val('Loading...');
        $('#country').val('Loading...');

        $.ajax({
            url: "https://api.postalpincode.in/pincode/" + pincode,
            type: "GET",
            success: function (response) {
                if (response[0].Status === "Success") {
                    let post = response[0].PostOffice[0];

                    $('#city').val(post.District);
                    $('#state').val(post.State);
                    $('#country').val(post.Country);

                    // After valid PIN → fetch shipping
                    fetchShippingCharge(pincode);
                }
                else {
                    $('#city, #state, #country').val('');
                    alert("Invalid PIN code.");
                }
            },
            error: function () {
                $('#city, #state, #country').val('');
                alert("Could not fetch data. Try again.");
            }
        });
    }

    // ----------------------------------------------------------
    // 🔹 FETCH SHIPPING COST
    // ----------------------------------------------------------
    function fetchShippingCharge(zip) {
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: mainurl + "/getPinCodeDetails",
            type: "POST",
            data: { zipcode: zip },

            success: function (response) {
                if (response.status) {
                    const shippingCost = parseFloat(response.result.shipping_cost || 0);
                    updateShipping(shippingCost);
                }
            },
            error: function (err) {
                console.error("Shipping cost fetch error:", err);
            }
        });
    }

    // ----------------------------------------------------------
    // 🔹 UPDATE SHIPPING + TOTAL
    // ----------------------------------------------------------
    function updateShipping(shippingCost) {

        if (shippingCost == 0) {
            $('#shipping-amount').html("FREE").removeClass("text-gray-900").addClass("text-green-600");
        } else {
            $('#shipping-amount').html("₹" + shippingCost.toFixed(2)).removeClass("text-green-600").addClass("text-gray-900");
        }

        let subtotal = parseCurrency($("#subtotal-mrp").text());
        let mrpDiscount = parseCurrency($("#mrp-discount").text());
        let couponDiscount = parseCurrency($("#coupon-discount-amount").text());
        let taxAmount = parseCurrency($("#tax-amount").text());

        let finalTotal = subtotal - mrpDiscount - couponDiscount + shippingCost + taxAmount;

        $("#final-total").html("₹" + finalTotal.toFixed(2));
    }

    // Helper
    function parseCurrency(val) {
        if (!val) return 0;
        return parseFloat(val.replace(/[₹,]/g, "")) || 0;
    }

});
</script>



@endsection
