@extends('frontend.include.app')

@section('content')
@php
  // This is a demo page showing all payment statuses
  // In production, you'll pass the actual status from the controller
  // Example: $status = 'success' | 'failed' | 'pending'

  // For demo purposes, you can change this value to test different states
  $demoStatus = request()->get('status', 'success'); // Change to 'failed' or 'pending' for testing

  // Status configurations
  $statusConfig = [
    'success' => [
      'iconBg' => 'bg-green-600 dark:bg-green-500',
      'iconColor' => 'text-white',
      'color' => 'text-green-600 dark:text-green-400',
      'bg' => 'bg-green-50 dark:bg-green-900/20',
      'border' => 'border-green-200 dark:border-green-800',
      'title' => 'Payment Successful!',
      'message' => 'Your order has been placed successfully.',
    ],
    'failed' => [
      'iconBg' => 'bg-red-600 dark:bg-red-500',
      'iconColor' => 'text-white',
      'color' => 'text-red-600 dark:text-red-400',
      'bg' => 'bg-red-50 dark:bg-red-900/20',
      'border' => 'border-red-200 dark:border-red-800',
      'title' => 'Payment Failed',
      'message' => 'Your payment could not be processed. Please try again.',
    ],
    'pending' => [
      'iconBg' => 'bg-orange-600 dark:bg-orange-500',
      'iconColor' => 'text-white',
      'color' => 'text-orange-600 dark:text-orange-400',
      'bg' => 'bg-orange-50 dark:bg-orange-900/20',
      'border' => 'border-orange-200 dark:border-orange-800',
      'title' => 'Payment Pending',
      'message' => 'Your payment is being verified. You will receive confirmation soon.',
    ],
  ];

  $currentStatus = $statusConfig[$demoStatus] ?? $statusConfig['success'];

  // Sample order data (in production, this will come from controller)
  $order = [
    'order_number' => 'hejH1764847275',
    'order_date' => '04-Dec-2025',
    'transaction_id' => 'pay_RnWArmPcKs1FBy',
    'payment_method' => 'Razorpay',
  ];

  $paymentInfo = [
    'subtotal' => 8092,
    'shipping' => 150,
    'discount' => 500,
    'tax' => 0,
    'total' => 7742,
  ];

  $billingAddress = [
    'name' => 'Vinay',
    'email' => 'vinay.jaisval2015@gmail.com',
    'phone' => '9889259224',
    'address' => 'Noida sector -2, B-95',
    'flat' => '217B',
    'city' => 'Gautam Buddha Nagar',
    'state' => 'Uttar Pradesh',
    'zip' => '201301',
    'country' => 'India',
  ];

  // Sample products (in production, this will come from order items)
  $orderProducts = [
    [
      'name' => 'Organic Face Serum - Vitamin C',
      'image' => asset('assets/images/noimage.png'),
      'quantity' => 2,
      'price' => 1299,
      'total' => 2598,
    ],
    [
      'name' => 'Natural Body Lotion - Lavender',
      'image' => asset('assets/images/noimage.png'),
      'quantity' => 1,
      'price' => 899,
      'total' => 899,
    ],
    [
      'name' => 'Hydrating Face Mask - Aloe Vera',
      'image' => asset('assets/images/noimage.png'),
      'quantity' => 3,
      'price' => 599,
      'total' => 1797,
    ],
    [
      'name' => 'Cleansing Oil - Tea Tree',
      'image' => asset('assets/images/noimage.png'),
      'quantity' => 1,
      'price' => 1199,
      'total' => 1199,
    ],
    [
      'name' => 'Anti-Aging Night Cream',
      'image' => asset('assets/images/noimage.png'),
      'quantity' => 1,
      'price' => 1599,
      'total' => 1599,
    ],
  ];
@endphp

<!-- Main Content -->
<main id="main-content" role="main" class="bg-gray-50 dark:bg-gray-900 min-h-screen">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">

    <!-- Status Demo Switcher (Remove in production) -->
    <div class="mb-6 p-3 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800" role="region" aria-label="Demo Mode Switcher">
      <p class="text-sm text-yellow-800 dark:text-yellow-200 font-medium mb-2">Demo Mode: Switch payment status</p>
      <div class="flex flex-wrap gap-2">
        <a href="?status=success" class="px-3 py-1.5 text-sm bg-green-600 text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors">Success</a>
        <a href="?status=failed" class="px-3 py-1.5 text-sm bg-red-600 text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors">Failed</a>
        <a href="?status=pending" class="px-3 py-1.5 text-sm bg-orange-600 text-white hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-colors">Pending</a>
      </div>
    </div>

    <!-- Payment Status Header -->
    <div class="bg-white dark:bg-gray-800 shadow-lg border border-gray-200 dark:border-gray-700 mb-6">
      <div class="{{ $currentStatus['bg'] }} border-b {{ $currentStatus['border'] }} px-6 py-8 sm:px-8">
        <div class="flex flex-col sm:flex-row items-center gap-6">
          <!-- Status Icon -->
          <div class="{{ $currentStatus['iconBg'] }} p-4 shadow-lg" aria-hidden="true">
            <div class="{{ $currentStatus['iconColor'] }}">
              @if($demoStatus === 'success')
              <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" stroke-width="2"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/>
              </svg>
              @elseif($demoStatus === 'failed')
              <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" stroke-width="2"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 9l-6 6m0-6l6 6"/>
              </svg>
              @else
              <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" stroke-width="2"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2"/>
              </svg>
              @endif
            </div>
          </div>

          <!-- Status Info -->
          <div class="flex-1 text-center sm:text-left">
            <h1 id="payment-status-title" class="text-2xl sm:text-3xl font-bold {{ $currentStatus['color'] }} mb-2">
              {{ $currentStatus['title'] }}
            </h1>
            <p class="text-base text-gray-700 dark:text-gray-300">
              {{ $currentStatus['message'] }}
            </p>
          </div>

          <!-- Total Amount -->
          <div class="text-center border-l-0 sm:border-l-2 {{ $currentStatus['border'] }} sm:pl-6">
            <p class="text-xs uppercase tracking-wider font-semibold text-gray-600 dark:text-gray-400 mb-1">Total Amount</p>
            <p class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-gray-100">
              {{ App\Models\Product::convertPrice($paymentInfo['total']) }}
            </p>
          </div>
        </div>
      </div>

      <!-- Quick Actions -->
      <div class="px-6 py-4 sm:px-8 bg-gray-50 dark:bg-gray-700/30 border-b border-gray-200 dark:border-gray-600">
        <div class="flex flex-col sm:flex-row gap-3">
          @if($demoStatus === 'success' || $demoStatus === 'pending')
            <a href="{{ route('front.index') }}"
               class="flex-1 py-3 px-6 bg-orange-600 text-white text-center text-sm font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-colors">
              Continue Shopping
            </a>
            <a href="{{ route('user.account') }}"
               class="flex-1 py-3 px-6 bg-gray-800 dark:bg-gray-700 text-white text-center text-sm font-semibold hover:bg-gray-900 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
              View My Orders
            </a>
          @else
            <a href="{{ route('front.checkout') }}"
               class="flex-1 py-3 px-6 bg-orange-600 text-white text-center text-sm font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-colors">
              Retry Payment
            </a>
            <a href="{{ route('front.cart') }}"
               class="flex-1 py-3 px-6 bg-gray-800 dark:bg-gray-700 text-white text-center text-sm font-semibold hover:bg-gray-900 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
              Back to Cart
            </a>
          @endif
        </div>
      </div>

      <!-- Order & Payment Details -->
      <div class="p-6 sm:p-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

          <!-- Order Details -->
          <section aria-labelledby="order-details-heading">
            <h2 id="order-details-heading" class="text-xs uppercase tracking-wider font-bold text-gray-500 dark:text-gray-400 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">Order Details</h2>

            <dl class="space-y-4">
              <!-- Order Number -->
              <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-gray-400 dark:text-gray-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                <div class="flex-1">
                  <dt class="text-xs uppercase tracking-wide font-medium text-gray-500 dark:text-gray-400 mb-1">Order Number</dt>
                  <dd class="text-base font-bold text-gray-900 dark:text-gray-100 break-all">{{ $order['order_number'] }}</dd>
                </div>
              </div>

              <!-- Payment Date -->
              <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-gray-400 dark:text-gray-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <div class="flex-1">
                  <dt class="text-xs uppercase tracking-wide font-medium text-gray-500 dark:text-gray-400 mb-1">Payment Date</dt>
                  <dd class="text-base font-bold text-gray-900 dark:text-gray-100">{{ $order['order_date'] }}</dd>
                </div>
              </div>

              <!-- Payment Method -->
              <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-gray-400 dark:text-gray-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                </svg>
                <div class="flex-1">
                  <dt class="text-xs uppercase tracking-wide font-medium text-gray-500 dark:text-gray-400 mb-1">Payment Method</dt>
                  <dd class="text-base font-bold text-gray-900 dark:text-gray-100">{{ $order['payment_method'] }}</dd>
                </div>
              </div>

              <!-- Customer Name -->
              <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-gray-400 dark:text-gray-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <div class="flex-1">
                  <dt class="text-xs uppercase tracking-wide font-medium text-gray-500 dark:text-gray-400 mb-1">Customer Name</dt>
                  <dd class="text-base font-bold text-gray-900 dark:text-gray-100">{{ $billingAddress['name'] }}</dd>
                </div>
              </div>

              <!-- Transaction ID (Success Only) -->
              @if($demoStatus === 'success' && $order['transaction_id'])
              <div class="flex items-start gap-3 pt-3 border-t border-gray-200 dark:border-gray-700">
                <svg class="w-5 h-5 text-green-600 dark:text-green-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div class="flex-1">
                  <dt class="text-xs uppercase tracking-wide font-medium text-green-700 dark:text-green-400 mb-1">Transaction ID</dt>
                  <dd class="text-sm font-mono font-bold text-green-900 dark:text-green-100 break-all">{{ $order['transaction_id'] }}</dd>
                </div>
              </div>
              @endif
            </dl>
          </section>

          <!-- Payment Breakdown -->
          @if($demoStatus === 'success' || $demoStatus === 'pending')
          <section aria-labelledby="payment-breakdown-heading">
            <h2 id="payment-breakdown-heading" class="text-xs uppercase tracking-wider font-bold text-gray-500 dark:text-gray-400 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">Payment Breakdown</h2>

            <dl class="space-y-3">
              <div class="flex justify-between items-center">
                <dt class="text-sm text-gray-600 dark:text-gray-400">Subtotal</dt>
                <dd class="text-base font-semibold text-gray-900 dark:text-gray-100">{{ App\Models\Product::convertPrice($paymentInfo['subtotal']) }}</dd>
              </div>

              <div class="flex justify-between items-center">
                <dt class="text-sm text-gray-600 dark:text-gray-400">Shipping Cost</dt>
                <dd class="text-base font-semibold text-gray-900 dark:text-gray-100">
                  {{ $paymentInfo['shipping'] == 0 ? 'FREE' : App\Models\Product::convertPrice($paymentInfo['shipping']) }}
                </dd>
              </div>

              @if($paymentInfo['discount'] > 0)
              <div class="flex justify-between items-center">
                <dt class="text-sm text-green-700 dark:text-green-400">Discount Coupon</dt>
                <dd class="text-base font-semibold text-green-600 dark:text-green-400">-{{ App\Models\Product::convertPrice($paymentInfo['discount']) }}</dd>
              </div>
              @endif

              @if($paymentInfo['tax'] > 0)
              <div class="flex justify-between items-center">
                <dt class="text-sm text-gray-600 dark:text-gray-400">Tax</dt>
                <dd class="text-base font-semibold text-gray-900 dark:text-gray-100">{{ App\Models\Product::convertPrice($paymentInfo['tax']) }}</dd>
              </div>
              @endif

              <div class="pt-4 mt-4 border-t-2 border-gray-300 dark:border-gray-600 flex justify-between items-center">
                <dt class="text-base font-bold text-gray-900 dark:text-gray-100">Total</dt>
                <dd class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ App\Models\Product::convertPrice($paymentInfo['total']) }}</dd>
              </div>
            </dl>
          </section>
          @endif

        </div>
      </div>

      <!-- Status-specific Messages -->
      @if($demoStatus === 'failed')
      <div class="px-6 py-4 sm:px-8 bg-red-50 dark:bg-red-900/20 border-t border-red-200 dark:border-red-800" role="alert">
        <h3 class="text-sm font-bold text-red-800 dark:text-red-300 mb-2">Common Issues:</h3>
        <ul class="text-sm text-red-700 dark:text-red-300 space-y-1 ml-5 list-disc">
          <li>Insufficient funds in account</li>
          <li>Incorrect payment details entered</li>
          <li>Card expired or has been blocked</li>
          <li>Network timeout during transaction</li>
        </ul>
      </div>
      @endif

      @if($demoStatus === 'pending')
      <div class="px-6 py-4 sm:px-8 bg-orange-50 dark:bg-orange-900/20 border-t border-orange-200 dark:border-orange-800" role="status">
        <div class="flex items-start gap-3">
          <svg class="w-6 h-6 text-orange-600 dark:text-orange-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
          <p class="text-sm text-orange-800 dark:text-orange-200">
            We are verifying your payment. You will receive an email confirmation once the verification is complete.
          </p>
        </div>
      </div>
      @endif
    </div>

    <!-- Order Items & Billing Address (Success/Pending Only) -->
    @if($demoStatus === 'success' || $demoStatus === 'pending')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

      <!-- Ordered Items (2/3 width) -->
      <section class="lg:col-span-2 bg-white dark:bg-gray-800 shadow-lg border border-gray-200 dark:border-gray-700" aria-labelledby="ordered-items-heading">
        <div class="px-6 py-4 sm:px-8 bg-gray-50 dark:bg-gray-700/30 border-b border-gray-200 dark:border-gray-700">
          <h2 id="ordered-items-heading" class="text-lg font-bold text-gray-900 dark:text-gray-100">Ordered Items ({{ count($orderProducts) }})</h2>
        </div>

        <div class="p-6 sm:p-8">
          <ul class="space-y-6" role="list">
    
              @foreach($tempcart->items as $product)

        
            <li class="flex gap-4 pb-6 @if(!$loop->last) border-b border-gray-200 dark:border-gray-700 @endif">
              <!-- Product Image -->
              <div class="flex-shrink-0 relative">
                <img src="{{ $product['item']['photo'] ? asset('assets/images/products/'.$product['item']['photo']) : asset('assets/images/noimage.png') }}"
                     alt=""
                     class="w-20 h-20 object-cover bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600"
                     loading="lazy" />

                @if($product['qty'] > 1)
                <span class="absolute -top-2 -right-2 bg-orange-600 text-white text-xs font-bold px-2 py-1 shadow-md min-w-[28px] text-center border-2 border-white dark:border-gray-800"
                      aria-label="Quantity: {{ $product['qty'] }}">
                  ×{{ $product['qty'] }}
                </span>
                @endif
              </div>

              <!-- Product Details -->
              <div class="flex-1 min-w-0">
                <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100 mb-3">
                  {{ $product['item']['name'] }}
                </h3>

                <dl class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                  <div>
                    <dt class="text-xs uppercase tracking-wide font-medium text-gray-500 dark:text-gray-400 mb-1">Quantity</dt>
                    <dd class="text-sm font-bold {{ $product['qty'] > 1 ? 'text-orange-600 dark:text-orange-400' : 'text-gray-900 dark:text-gray-100' }}">
                      {{ $product['qty'] }}
                    </dd>
                  </div>

                  <div>
                    <dt class="text-xs uppercase tracking-wide font-medium text-gray-500 dark:text-gray-400 mb-1">Unit Price</dt>
                    <dd class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                      {{ App\Models\Product::convertPrice($product['price']) }}
                    </dd>
                  </div>

                  <div>
                    <dt class="text-xs uppercase tracking-wide font-medium text-gray-500 dark:text-gray-400 mb-1">Subtotal</dt>
                    <dd class="text-sm font-bold text-orange-600 dark:text-orange-400">
                      {{ App\Models\Product::convertPrice($product['item_price']) }}
                    </dd>
                  </div>
                </dl>
              </div>
            </li>
            @endforeach
          </ul>
        </div>
      </section>

      <!-- Billing Address (1/3 width) -->
      <section class="bg-white dark:bg-gray-800 shadow-lg border border-gray-200 dark:border-gray-700" aria-labelledby="billing-address-heading">
        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700/30 border-b border-gray-200 dark:border-gray-700">
          <h2 id="billing-address-heading" class="text-lg font-bold text-gray-900 dark:text-gray-100">Billing Address</h2>
        </div>

        <div class="p-6">
          <div class="space-y-5">
            <!-- Customer Name -->
            <div class="pb-4 border-b border-gray-200 dark:border-gray-700">
              <p class="text-base font-bold text-gray-900 dark:text-gray-100">{{ $billingAddress['name'] }}</p>
            </div>

            <!-- Contact Info -->
            <dl class="space-y-4">
              <!-- Email -->
              <div class="flex gap-3">
                <svg class="w-5 h-5 text-gray-400 dark:text-gray-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <div class="flex-1 min-w-0">
                  <dt class="text-xs uppercase tracking-wide font-medium text-gray-500 dark:text-gray-400 mb-1">Email</dt>
                  <dd>
                    <a href="mailto:{{ $billingAddress['email'] }}"
                       class="text-sm font-medium text-orange-600 dark:text-orange-400 hover:underline break-all">
                      {{ $billingAddress['email'] }}
                    </a>
                  </dd>
                </div>
              </div>

              <!-- Phone -->
              <div class="flex gap-3">
                <svg class="w-5 h-5 text-gray-400 dark:text-gray-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
                <div class="flex-1 min-w-0">
                  <dt class="text-xs uppercase tracking-wide font-medium text-gray-500 dark:text-gray-400 mb-1">Phone</dt>
                  <dd>
                    <a href="tel:{{ $billingAddress['phone'] }}"
                       class="text-sm font-medium text-orange-600 dark:text-orange-400 hover:underline">
                      {{ $billingAddress['phone'] }}
                    </a>
                  </dd>
                </div>
              </div>

              <!-- Address -->
              <div class="flex gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                <svg class="w-5 h-5 text-gray-400 dark:text-gray-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <div class="flex-1 min-w-0">
                  <dt class="text-xs uppercase tracking-wide font-medium text-gray-500 dark:text-gray-400 mb-2">Address</dt>
                  <dd class="text-sm text-gray-700 dark:text-gray-300 space-y-1">
                    <p class="font-medium">{{ $billingAddress['address'] }}@if($billingAddress['flat']), {{ $billingAddress['flat'] }}@endif</p>
                    <p>{{ $billingAddress['city'] }}, {{ $billingAddress['state'] }}</p>
                    <p>{{ $billingAddress['zip'] }}</p>
                    <p class="font-semibold text-gray-900 dark:text-gray-100">{{ $billingAddress['country'] }}</p>
                  </dd>
                </div>
              </div>
            </dl>
          </div>
        </div>
      </section>

    </div>
    @endif

    <!-- Help Section (Failed Only) -->
    @if($demoStatus === 'failed')
    <div class="bg-white dark:bg-gray-800 shadow-lg border border-gray-200 dark:border-gray-700">
      <div class="p-6 sm:p-8">
        <div class="grid md:grid-cols-2 gap-8">

          <!-- Troubleshooting -->
          <section aria-labelledby="help-heading">
            <h2 id="help-heading" class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">Need Help?</h2>
            <div class="text-sm text-gray-700 dark:text-gray-300 space-y-3">
              <p>If you continue to experience issues, please try the following:</p>
              <ul class="space-y-2 ml-5 list-disc">
                <li>Verify your payment method details are correct</li>
                <li>Ensure sufficient funds are available</li>
                <li>Try using a different payment method</li>
                <li>Contact your bank if the issue persists</li>
              </ul>
            </div>
          </section>

          <!-- Support Contact -->
          <section aria-labelledby="support-heading">
            <h2 id="support-heading" class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">Contact Support</h2>
            <div class="text-sm text-gray-700 dark:text-gray-300 space-y-3">
              <p>Our support team is here to help you:</p>
              <div class="space-y-2">
                <p>
                  <a href="mailto:support@usceligin.com"
                     class="text-orange-600 dark:text-orange-400 hover:underline font-medium inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    support@usceligin.com
                  </a>
                </p>
                <p>
                  <a href="tel:+911234567890"
                     class="text-orange-600 dark:text-orange-400 hover:underline font-medium inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    +91 123 456 7890
                  </a>
                </p>
              </div>
            </div>
          </section>

        </div>
      </div>
    </div>
    @endif

    <!-- Footer -->
    <footer class="mt-8 text-center">
      <p class="text-sm text-gray-600 dark:text-gray-400">
        Have questions?
        <a href="mailto:support@usceligin.com"
           class="text-orange-600 dark:text-orange-400 hover:underline font-medium">
          Contact our support team
        </a>
      </p>
    </footer>

  </div>
</main>
@endsection

@section('scripts')
<script>
  console.log('Payment Status Page Loaded - Status: {{ $demoStatus }}');

  @if($demoStatus === 'pending')
  // Optional: Auto-refresh for pending payments
  // Uncomment to enable auto-refresh every 30 seconds
  // setTimeout(() => window.location.reload(), 30000);
  @endif
</script>
@endsection
