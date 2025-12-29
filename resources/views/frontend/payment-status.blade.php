@extends('frontend.include.app')

@section('content')
@php
  // This is a demo page showing all payment statuses
  // In production, you'll pass the actual status from the controller
  $demoStatus = request()->get('status', 'success');

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
  $order = $order ?? [
    'order_number' => 'hejH1764847275',
    'order_date' => '04-Dec-2025',
    'transaction_id' => 'pay_RnWArmPcKs1FBy',
    'payment_method' => 'Razorpay',
  ];

  $paymentInfo = $paymentInfo ?? [
    'subtotal' => 8092,
    'shipping' => 150,
    'discount' => 500,
    'tax' => 0,
    'total' => 7742,
  ];

  $billingAddress = $billingAddress ?? [
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
  $orderProducts = $orderProducts ?? [
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
  ];

  // SVG Icons (DRY)
  $icons = [
    'success' => '<circle cx="12" cy="12" r="10" stroke-width="2"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/>',
    'failed' => '<circle cx="12" cy="12" r="10" stroke-width="2"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 9l-6 6m0-6l6 6"/>',
    'pending' => '<circle cx="12" cy="12" r="10" stroke-width="2"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2"/>',
    'tag' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>',
    'calendar' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>',
    'credit-card' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>',
    'user' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>',
    'check-circle' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>',
    'email' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>',
    'phone' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>',
    'location' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>',
    'info' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
  ];

  // Common CSS Classes (DRY)
  $classes = [
    'card' => 'bg-white dark:bg-gray-800 shadow-lg border border-gray-200 dark:border-gray-700',
    'card-header' => 'px-6 py-4 sm:px-8 bg-gray-50 dark:bg-gray-700/30 border-b border-gray-200 dark:border-gray-700',
    'card-body' => 'p-6 sm:p-8',
    'section-title' => 'text-xs uppercase tracking-wider font-bold text-gray-500 dark:text-gray-400 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700',
    'label' => 'text-xs uppercase tracking-wide font-medium text-gray-500 dark:text-gray-400 mb-1',
    'value' => 'text-base font-bold text-gray-900 dark:text-gray-100',
    'icon-wrapper' => 'w-5 h-5 text-gray-400 dark:text-gray-500 flex-shrink-0 mt-0.5',
    'btn-primary' => 'flex-1 py-3 px-6 bg-orange-600 text-white text-center text-sm font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-colors',
    'btn-secondary' => 'flex-1 py-3 px-6 bg-gray-800 dark:bg-gray-700 text-white text-center text-sm font-semibold hover:bg-gray-900 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors',
  ];

  // Order detail items configuration
  $orderDetails = [
    ['icon' => 'tag', 'label' => 'Order Number', 'value' => $order['order_number']],
    ['icon' => 'calendar', 'label' => 'Payment Date', 'value' => $order['order_date']],
    ['icon' => 'credit-card', 'label' => 'Payment Method', 'value' => $order['payment_method']],
    ['icon' => 'user', 'label' => 'Customer Name', 'value' => $billingAddress['name']],
  ];

  // Payment breakdown items
  $paymentBreakdown = [
    ['label' => 'Subtotal', 'value' => $paymentInfo['subtotal'], 'color' => 'text-gray-600 dark:text-gray-400'],
    ['label' => 'Shipping Cost', 'value' => $paymentInfo['shipping'], 'color' => 'text-gray-600 dark:text-gray-400', 'free' => true],
  ];

  if ($paymentInfo['discount'] > 0) {
    $paymentBreakdown[] = ['label' => 'Discount Coupon', 'value' => $paymentInfo['discount'], 'color' => 'text-green-700 dark:text-green-400', 'negative' => true];
  }

  if ($paymentInfo['tax'] > 0) {
    $paymentBreakdown[] = ['label' => 'Tax', 'value' => $paymentInfo['tax'], 'color' => 'text-gray-600 dark:text-gray-400'];
  }

  // Contact info configuration
  $contactInfo = [
    ['icon' => 'email', 'label' => 'Email', 'value' => $billingAddress['email'], 'type' => 'mailto'],
    ['icon' => 'phone', 'label' => 'Phone', 'value' => $billingAddress['phone'], 'type' => 'tel'],
  ];

  // Settings (these should be passed from controller in production)
  $settings = $settings ?? [
    'support_email' => config('mail.from.address', 'support@example.com'),
    'support_phone' => '+1234567890',
  ];
@endphp

<!-- Main Content -->
<main id="main-content" role="main" class="bg-gray-50 dark:bg-gray-900 min-h-screen">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">

    <!-- Status Demo Switcher (Remove in production) -->
    @if(config('app.debug'))
    <div class="mb-6 p-3 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800" role="region" aria-label="Demo Mode Switcher">
      <p class="text-sm text-yellow-800 dark:text-yellow-200 font-medium mb-2">Demo Mode: Switch payment status</p>
      <div class="flex flex-wrap gap-2">
        @foreach(['success' => 'green', 'failed' => 'red', 'pending' => 'orange'] as $status => $color)
        <a href="?status={{ $status }}"
           class="px-3 py-1.5 text-sm bg-{{ $color }}-600 text-white hover:bg-{{ $color }}-700 focus:outline-none focus:ring-2 focus:ring-{{ $color }}-500 focus:ring-offset-2 transition-colors">
          {{ ucfirst($status) }}
        </a>
        @endforeach
      </div>
    </div>
    @endif

    <!-- Payment Status Header -->
    <div class="{{ $classes['card'] }} mb-6">
      <div class="{{ $currentStatus['bg'] }} border-b {{ $currentStatus['border'] }} px-6 py-8 sm:px-8">
        <div class="flex flex-col sm:flex-row items-center gap-6">
          <!-- Status Icon -->
          <div class="{{ $currentStatus['iconBg'] }} p-4 shadow-lg" aria-hidden="true">
            <div class="{{ $currentStatus['iconColor'] }}">
              <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                {!! $icons[$demoStatus] !!}
              </svg>
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
            <p class="{{ $classes['label'] }}">Total Amount</p>
            <p class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-gray-100">
              {{ App\Models\Product::convertPrice($paymentInfo['total']) }}
            </p>
          </div>
        </div>
      </div>

      <!-- Quick Actions -->
      <div class="{{ $classes['card-header'] }}">
        <div class="flex flex-col sm:flex-row gap-3">
          @if($demoStatus === 'success' || $demoStatus === 'pending')
            <a href="{{ route('front.index') }}" class="{{ $classes['btn-primary'] }}">
              Continue Shopping
            </a>
            <a href="{{ route('user.account') }}" class="{{ $classes['btn-secondary'] }}">
              View My Orders
            </a>
          @else
            <a href="{{ route('front.checkout') }}" class="{{ $classes['btn-primary'] }}">
              Retry Payment
            </a>
            <a href="{{ route('front.cart') }}" class="{{ $classes['btn-secondary'] }}">
              Back to Cart
            </a>
          @endif
        </div>
      </div>

      <!-- Order & Payment Details -->
      <div class="{{ $classes['card-body'] }}">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

          <!-- Order Details -->
          <section aria-labelledby="order-details-heading">
            <h2 id="order-details-heading" class="{{ $classes['section-title'] }}">Order Details</h2>

            <dl class="space-y-4">
              @foreach($orderDetails as $detail)
              <div class="flex items-start gap-3">
                <svg class="{{ $classes['icon-wrapper'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                  {!! $icons[$detail['icon']] !!}
                </svg>
                <div class="flex-1">
                  <dt class="{{ $classes['label'] }}">{{ $detail['label'] }}</dt>
                  <dd class="{{ $classes['value'] }} break-all">{{ $detail['value'] }}</dd>
                </div>
              </div>
              @endforeach

              <!-- Transaction ID (Success Only) -->
              @if($demoStatus === 'success' && !empty($order['transaction_id']))
              <div class="flex items-start gap-3 pt-3 border-t border-gray-200 dark:border-gray-700">
                <svg class="w-5 h-5 text-green-600 dark:text-green-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                  {!! $icons['check-circle'] !!}
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
            <h2 id="payment-breakdown-heading" class="{{ $classes['section-title'] }}">Payment Breakdown</h2>

            <dl class="space-y-3">
              @foreach($paymentBreakdown as $item)
              <div class="flex justify-between items-center">
                <dt class="text-sm {{ $item['color'] }}">{{ $item['label'] }}</dt>
                <dd class="text-base font-semibold {{ isset($item['negative']) ? 'text-green-600 dark:text-green-400' : 'text-gray-900 dark:text-gray-100' }}">
                  @if(isset($item['negative']))
                    -{{ App\Models\Product::convertPrice($item['value']) }}
                  @elseif(isset($item['free']) && $item['value'] == 0)
                    FREE
                  @else
                    {{ App\Models\Product::convertPrice($item['value']) }}
                  @endif
                </dd>
              </div>
              @endforeach

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
            {!! $icons['info'] !!}
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
      <section class="lg:col-span-2 {{ $classes['card'] }}" aria-labelledby="ordered-items-heading">
        <div class="{{ $classes['card-header'] }}">
          <h2 id="ordered-items-heading" class="text-lg font-bold text-gray-900 dark:text-gray-100">
            Ordered Items ({{ count($orderProducts) }})
          </h2>
        </div>

        <div class="{{ $classes['card-body'] }}">
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
                    <dt class="{{ $classes['label'] }}">Unit Price</dt>
                    <dd class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                      {{ App\Models\Product::convertPrice($product['price']) }}
                    </dd>
                  </div>

                  <div>
                    <dt class="{{ $classes['label'] }}">Subtotal</dt>
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
      <section class="{{ $classes['card'] }}" aria-labelledby="billing-address-heading">
        <div class="{{ $classes['card-header'] }}">
          <h2 id="billing-address-heading" class="text-lg font-bold text-gray-900 dark:text-gray-100">Billing Address</h2>
        </div>

        <div class="p-6">
          <div class="space-y-5">
            <!-- Customer Name -->
            <div class="pb-4 border-b border-gray-200 dark:border-gray-700">
              <p class="{{ $classes['value'] }}">{{ $billingAddress['name'] }}</p>
            </div>

            <!-- Contact Info -->
            <dl class="space-y-4">
              @foreach($contactInfo as $contact)
              <div class="flex gap-3">
                <svg class="{{ $classes['icon-wrapper'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                  {!! $icons[$contact['icon']] !!}
                </svg>
                <div class="flex-1 min-w-0">
                  <dt class="{{ $classes['label'] }}">{{ $contact['label'] }}</dt>
                  <dd>
                    <a href="{{ $contact['type'] }}:{{ $contact['value'] }}"
                       class="text-sm font-medium text-orange-600 dark:text-orange-400 hover:underline break-all">
                      {{ $contact['value'] }}
                    </a>
                  </dd>
                </div>
              </div>
              @endforeach

              <!-- Address -->
              <div class="flex gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                <svg class="{{ $classes['icon-wrapper'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                  {!! $icons['location'] !!}
                </svg>
                <div class="flex-1 min-w-0">
                  <dt class="{{ $classes['label'] }} mb-2">Address</dt>
                  <dd class="text-sm text-gray-700 dark:text-gray-300 space-y-1">
                    <p class="font-medium">{{ $billingAddress['address'] }}@if(!empty($billingAddress['flat'])), {{ $billingAddress['flat'] }}@endif</p>
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
    <div class="{{ $classes['card'] }}">
      <div class="{{ $classes['card-body'] }}">
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
                  <a href="mailto:{{ $settings['support_email'] }}"
                     class="text-orange-600 dark:text-orange-400 hover:underline font-medium inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      {!! $icons['email'] !!}
                    </svg>
                    {{ $settings['support_email'] }}
                  </a>
                </p>
                <p>
                  <a href="tel:{{ $settings['support_phone'] }}"
                     class="text-orange-600 dark:text-orange-400 hover:underline font-medium inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      {!! $icons['phone'] !!}
                    </svg>
                    {{ $settings['support_phone'] }}
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
        <a href="mailto:{{ $settings['support_email'] }}"
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
  // setTimeout(() => window.location.reload(), 30000);
  @endif
</script>
@endsection
