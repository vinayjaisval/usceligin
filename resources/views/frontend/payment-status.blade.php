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
      'icon' => '<svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke-width="2"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/></svg>',
      'iconColor' => 'text-white',
      'iconBg' => 'bg-green-600 dark:bg-green-500',
      'color' => 'text-green-600 dark:text-green-400',
      'bg' => 'bg-green-50 dark:bg-green-900/20',
      'border' => 'border-green-200 dark:border-green-800',
      'title' => 'Payment Success!',
      'message' => 'Your payment has been successfully done.',
    ],
    'failed' => [
      'icon' => '<svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke-width="2"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 9l-6 6m0-6l6 6"/></svg>',
      'iconColor' => 'text-white',
      'iconBg' => 'bg-red-600 dark:bg-red-500',
      'color' => 'text-red-600 dark:text-red-400',
      'bg' => 'bg-red-50 dark:bg-red-900/20',
      'border' => 'border-red-200 dark:border-red-800',
      'title' => 'Payment Failed!',
      'message' => 'Your payment could not be processed. Please try again.',
    ],
    'pending' => [
      'icon' => '<svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke-width="2"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2"/></svg>',
      'iconColor' => 'text-white',
      'iconBg' => 'bg-orange-600 dark:bg-orange-500',
      'color' => 'text-orange-600 dark:text-orange-400',
      'bg' => 'bg-orange-50 dark:bg-orange-900/20',
      'border' => 'border-orange-200 dark:border-orange-800',
      'title' => 'Payment Pending!',
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
  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-3">

    <!-- Status Demo Switcher (Remove in production) -->
    <div class="mb-4 p-3 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800">
      <p class="text-sm text-yellow-800 dark:text-yellow-200 font-medium mb-2">Demo Mode: Switch payment status</p>
      <div class="flex flex-wrap gap-2">
        <a href="?status=success" class="px-3 py-1.5 text-sm bg-green-600 text-white hover:bg-green-700 transition-colors">Success</a>
        <a href="?status=failed" class="px-3 py-1.5 text-sm bg-red-600 text-white hover:bg-red-700 transition-colors">Failed</a>
        <a href="?status=pending" class="px-3 py-1.5 text-sm bg-orange-600 text-white hover:bg-orange-700 transition-colors">Pending</a>
      </div>
    </div>

    <!-- Merged Status Card with Payment Summary -->
    <div class="bg-white dark:bg-gray-800 shadow-lg mb-4">
      <div class="p-4 sm:p-5">

        <!-- Centered Icon -->
        <div class="flex justify-center mb-3">
          <div class="{{ $currentStatus['iconBg'] }} p-3 shadow-md" aria-hidden="true">
            <div class="{{ $currentStatus['iconColor'] }}">
              <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                @if($demoStatus === 'success')
                <circle cx="12" cy="12" r="10" stroke-width="2"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/>
                @elseif($demoStatus === 'failed')
                <circle cx="12" cy="12" r="10" stroke-width="2"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 9l-6 6m0-6l6 6"/>
                @else
                <circle cx="12" cy="12" r="10" stroke-width="2"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2"/>
                @endif
              </svg>
            </div>
          </div>
        </div>

        <!-- Centered Title -->
        <h1 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-gray-100 text-center mb-2">
          {{ $currentStatus['title'] }}
        </h1>

        <!-- Centered Message -->
        <p class="text-sm text-gray-600 dark:text-gray-400 text-center mb-4">
          {{ $currentStatus['message'] }}
        </p>

        <!-- Divider -->
        <div class="border-t border-gray-200 dark:border-gray-700 mb-3"></div>

        <!-- Total Payment - Centered -->
        <div class="text-center mb-4">
          <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Total Payment</p>
          <p class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-gray-100">
            {{ App\Models\Product::convertPrice($paymentInfo['total']) }}
          </p>
        </div>

        <!-- Payment Details Grid (2x2) -->
        <div class="grid grid-cols-2 gap-3 mb-4">

          <!-- Ref Number -->
          <div class="bg-gray-50 dark:bg-gray-700/50 p-3 border border-gray-200 dark:border-gray-600">
            <p class="text-sm text-gray-600 dark:text-gray-400">Ref Number</p>
            <p class="text-sm font-semibold text-gray-900 dark:text-gray-100 break-all mt-1">
              {{ $order['order_number'] }}
            </p>
          </div>

          <!-- Payment Time -->
          <div class="bg-gray-50 dark:bg-gray-700/50 p-3 border border-gray-200 dark:border-gray-600">
            <p class="text-sm text-gray-600 dark:text-gray-400">Payment Time</p>
            <p class="text-sm font-semibold text-gray-900 dark:text-gray-100 mt-1">
              {{ $order['order_date'] }}
            </p>
          </div>

          <!-- Payment Method -->
          <div class="bg-gray-50 dark:bg-gray-700/50 p-3 border border-gray-200 dark:border-gray-600">
            <p class="text-sm text-gray-600 dark:text-gray-400">Payment Method</p>
            <p class="text-sm font-semibold text-gray-900 dark:text-gray-100 mt-1">
              {{ $order['payment_method'] }}
            </p>
          </div>

          <!-- Sender Name -->
          <div class="bg-gray-50 dark:bg-gray-700/50 p-3 border border-gray-200 dark:border-gray-600">
            <p class="text-sm text-gray-600 dark:text-gray-400">Sender Name</p>
            <p class="text-sm font-semibold text-gray-900 dark:text-gray-100 mt-1">
              {{ $billingAddress['name'] }}
            </p>
          </div>

        </div>

        <!-- Payment Breakdown -->
        @if($demoStatus === 'success' || $demoStatus === 'pending')
        <div class="bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 p-3 mb-4">
          <h3 class="text-sm font-bold text-gray-900 dark:text-gray-100 mb-2">Payment Breakdown</h3>
          <div class="space-y-1.5 text-sm">
            <div class="flex justify-between">
              <span class="text-gray-600 dark:text-gray-400">Subtotal</span>
              <span class="text-gray-900 dark:text-gray-100">{{ App\Models\Product::convertPrice($paymentInfo['subtotal']) }}</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-600 dark:text-gray-400">Shipping Cost</span>
              <span class="text-gray-900 dark:text-gray-100">
                {{ $paymentInfo['shipping'] == 0 ? 'FREE' : App\Models\Product::convertPrice($paymentInfo['shipping']) }}
              </span>
            </div>
            @if($paymentInfo['discount'] > 0)
            <div class="flex justify-between text-green-600 dark:text-green-400">
              <span>Discount Coupon</span>
              <span>-{{ App\Models\Product::convertPrice($paymentInfo['discount']) }}</span>
            </div>
            @endif
            @if($paymentInfo['tax'] > 0)
            <div class="flex justify-between">
              <span class="text-gray-600 dark:text-gray-400">Tax</span>
              <span class="text-gray-900 dark:text-gray-100">{{ App\Models\Product::convertPrice($paymentInfo['tax']) }}</span>
            </div>
            @endif
          </div>
        </div>
        @endif

        @if($demoStatus === 'success' && $order['transaction_id'])
        <!-- Transaction ID (Only for Success) -->
        <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 p-3 mb-4">
          <p class="text-sm text-green-800 dark:text-green-300">Transaction ID</p>
          <p class="text-sm font-mono font-semibold text-green-900 dark:text-green-100 break-all mt-1">
            {{ $order['transaction_id'] }}
          </p>
        </div>
        @endif

        @if($demoStatus === 'failed')
        <!-- Error Information -->
        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 p-3 mb-4">
          <p class="text-sm font-semibold text-red-800 dark:text-red-300 mb-2">Common Issues:</p>
          <ul class="text-sm text-red-700 dark:text-red-300 space-y-1">
            <li>• Insufficient funds</li>
            <li>• Incorrect payment details</li>
            <li>• Card expired or blocked</li>
            <li>• Network timeout</li>
          </ul>
        </div>
        @endif

        @if($demoStatus === 'pending')
        <!-- Pending Information -->
        <div class="bg-orange-50 dark:bg-orange-900/20 border border-orange-200 dark:border-orange-800 p-3 mb-4">
          <div class="flex items-start gap-2">
            <svg class="w-5 h-5 text-orange-600 dark:text-orange-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-sm text-orange-800 dark:text-orange-200">
              We are verifying your payment. You will receive an email confirmation once verified.
            </p>
          </div>
        </div>
        @endif

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-3">
          @if($demoStatus === 'success' || $demoStatus === 'pending')
            <a href="{{ route('front.index') }}"
               class="flex-1 py-2.5 px-4 bg-orange-600 text-white text-center text-sm font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 transition-colors">
              Continue Shopping
            </a>
            <a href="{{ route('user.account') }}"
               class="flex-1 py-2.5 px-4 bg-gray-800 dark:bg-gray-700 text-white text-center text-sm font-semibold hover:bg-gray-900 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors">
              My Account
            </a>
          @else
            <a href="{{ route('front.checkout') }}"
               class="flex-1 py-2.5 px-4 bg-orange-600 text-white text-center text-sm font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 transition-colors">
              Retry Payment
            </a>
            <a href="{{ route('front.cart') }}"
               class="flex-1 py-2.5 px-4 bg-gray-800 dark:bg-gray-700 text-white text-center text-sm font-semibold hover:bg-gray-900 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors">
              Back to Cart
            </a>
          @endif
        </div>

      </div>
    </div>

    <!-- Order Details Section (Show only for success and pending) -->
    @if($demoStatus === 'success' || $demoStatus === 'pending')

    <!-- Two Column Layout for Desktop -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

      <!-- Left: Products Section -->
      <div class="bg-white dark:bg-gray-800 shadow-lg">
        <div class="p-4 sm:p-5">
          <h2 class="text-base font-bold text-gray-900 dark:text-gray-100 mb-3">Ordered Items</h2>

          <!-- Product List -->
          <div class="space-y-3">
            @foreach($orderProducts as $product)
            <div class="bg-gray-50 dark:bg-gray-700/30 p-3 border border-gray-200 dark:border-gray-600 hover:border-orange-300 dark:hover:border-orange-700 transition-colors">
              <div class="flex items-start gap-3">
                <!-- Product Image with Quantity Badge -->
                <div class="flex-shrink-0 relative">
                  <img src="{{ $product['image'] }}"
                       alt="{{ $product['name'] }}"
                       class="w-16 h-16 sm:w-20 sm:h-20 object-cover bg-gray-100 dark:bg-gray-700"
                       loading="lazy" />

                  <!-- Quantity Badge (Shows if qty > 1) -->
                  @if($product['quantity'] > 1)
                  <div class="absolute -top-1 -right-1 bg-orange-600 text-white text-xs font-bold px-1.5 py-0.5 shadow-md min-w-[24px] text-center">
                    ×{{ $product['quantity'] }}
                  </div>
                  @endif
                </div>

                <!-- Product Info -->
                <div class="flex-1 min-w-0">
                  <!-- Product Name -->
                  <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2">
                    {{ $product['name'] }}
                  </h3>

                  <!-- Price and Quantity Grid -->
                  <div class="grid grid-cols-2 gap-2 mb-2">
                    <!-- Quantity -->
                    <div>
                      <p class="text-sm text-gray-500 dark:text-gray-400">Qty</p>
                      <span class="text-sm font-semibold {{ $product['quantity'] > 1 ? 'text-orange-600 dark:text-orange-400' : 'text-gray-900 dark:text-gray-100' }}">
                        {{ $product['quantity'] }}
                      </span>
                    </div>

                    <!-- Unit Price -->
                    <div>
                      <p class="text-sm text-gray-500 dark:text-gray-400">Price</p>
                      <p class="text-sm font-medium text-gray-700 dark:text-gray-300">
                        {{ App\Models\Product::convertPrice($product['price']) }}
                      </p>
                    </div>
                  </div>

                  <!-- Total Price -->
                  <div class="flex justify-between items-center pt-2 border-t border-gray-200 dark:border-gray-600">
                    <span class="text-sm text-gray-500 dark:text-gray-400">Total</span>
                    <span class="text-sm font-bold text-orange-600 dark:text-orange-400">
                      {{ App\Models\Product::convertPrice($product['total']) }}
                    </span>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>

      <!-- Right: Billing Address -->
      <div class="bg-white dark:bg-gray-800 shadow-lg">
        <div class="p-4 sm:p-5">
          <h2 class="text-base font-bold text-gray-900 dark:text-gray-100 mb-3">Billing Address</h2>

          <!-- Customer Name -->
          <div class="mb-3 pb-3 border-b border-gray-200 dark:border-gray-700">
            <p class="text-sm font-bold text-gray-900 dark:text-gray-100">{{ $billingAddress['name'] }}</p>
          </div>

          <!-- Contact Information -->
          <div class="space-y-3 mb-3">
            <!-- Email -->
            <div class="flex items-start gap-2">
              <svg class="w-5 h-5 text-gray-400 dark:text-gray-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
              </svg>
              <div class="flex-1 min-w-0">
                <p class="text-sm text-gray-500 dark:text-gray-400">Email</p>
                <a href="mailto:{{ $billingAddress['email'] }}" class="text-sm text-orange-600 dark:text-orange-400 hover:underline break-all">
                  {{ $billingAddress['email'] }}
                </a>
              </div>
            </div>

            <!-- Phone -->
            <div class="flex items-start gap-2">
              <svg class="w-5 h-5 text-gray-400 dark:text-gray-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
              </svg>
              <div class="flex-1 min-w-0">
                <p class="text-sm text-gray-500 dark:text-gray-400">Phone</p>
                <a href="tel:{{ $billingAddress['phone'] }}" class="text-sm text-orange-600 dark:text-orange-400 hover:underline">
                  {{ $billingAddress['phone'] }}
                </a>
              </div>
            </div>
          </div>

          <!-- Shipping Address -->
          <div class="pt-3 border-t border-gray-200 dark:border-gray-700">
            <div class="flex items-start gap-2">
              <svg class="w-5 h-5 text-gray-400 dark:text-gray-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
              </svg>
              <div class="flex-1 min-w-0">
                <p class="text-sm text-gray-500 dark:text-gray-400">Address</p>
                <div class="text-sm text-gray-700 dark:text-gray-300 space-y-1 mt-1">
                  <p>{{ $billingAddress['address'] }}@if($billingAddress['flat']), {{ $billingAddress['flat'] }}@endif</p>
                  <p>{{ $billingAddress['city'] }}, {{ $billingAddress['state'] }} {{ $billingAddress['zip'] }}</p>
                  <p class="font-medium">{{ $billingAddress['country'] }}</p>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>

    </div>
    @endif

    <!-- Failed Payment Additional Info -->
    @if($demoStatus === 'failed')
    <div class="bg-white dark:bg-gray-800 shadow-lg">
      <div class="p-4 sm:p-5">
        <div class="grid md:grid-cols-2 gap-4">

          <!-- Common Issues -->
          <div>
            <h2 class="text-base font-bold text-gray-900 dark:text-gray-100 mb-3">Need Help?</h2>
            <div class="text-sm text-gray-700 dark:text-gray-300 space-y-2">
              <p>If you continue to experience issues, please:</p>
              <ul class="space-y-1 ml-4">
                <li>• Check your payment method details</li>
                <li>• Ensure sufficient funds are available</li>
                <li>• Try a different payment method</li>
                <li>• Contact your bank if needed</li>
              </ul>
            </div>
          </div>

          <!-- Support -->
          <div>
            <h2 class="text-base font-bold text-gray-900 dark:text-gray-100 mb-3">Contact Support</h2>
            <div class="text-sm text-gray-700 dark:text-gray-300 space-y-2">
              <p>Our support team is here to help:</p>
              <p>
                <a href="mailto:support@usceligin.com" class="text-orange-600 dark:text-orange-400 hover:underline font-medium">
                  support@usceligin.com
                </a>
              </p>
              <p>
                <a href="tel:+911234567890" class="text-orange-600 dark:text-orange-400 hover:underline font-medium">
                  +91 123 456 7890
                </a>
              </p>
            </div>
          </div>

        </div>
      </div>
    </div>
    @endif

    <!-- Footer Help Text -->
    <div class="mt-4 text-center">
      <p class="text-sm text-gray-600 dark:text-gray-400">
        Questions?
        <a href="mailto:support@usceligin.com" class="text-orange-600 dark:text-orange-400 hover:underline font-medium">Contact Support</a>
      </p>
    </div>

  </div>
</main>
@endsection

@section('scripts')
<script>
  // Add any page-specific JavaScript here
  console.log('Payment Status Page Loaded');

  // Auto-refresh for pending payments (optional)
  @if($demoStatus === 'pending')
  // Uncomment to enable auto-refresh every 30 seconds for pending payments
  // setTimeout(() => {
  //   window.location.reload();
  // }, 30000);
  @endif
</script>
@endsection
