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
      'icon' => '<svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
      'color' => 'text-green-600 dark:text-green-400',
      'bg' => 'bg-green-50 dark:bg-green-900/20',
      'border' => 'border-green-200 dark:border-green-800',
      'title' => 'Payment Successful!',
      'message' => 'Thank you for your purchase. We\'ll email you an order confirmation with tracking details.',
    ],
    'failed' => [
      'icon' => '<svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
      'color' => 'text-red-600 dark:text-red-400',
      'bg' => 'bg-red-50 dark:bg-red-900/20',
      'border' => 'border-red-200 dark:border-red-800',
      'title' => 'Payment Failed',
      'message' => 'We couldn\'t process your payment. Please check your payment details and try again.',
    ],
    'pending' => [
      'icon' => '<svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
      'color' => 'text-orange-600 dark:text-orange-400',
      'bg' => 'bg-orange-50 dark:bg-orange-900/20',
      'border' => 'border-orange-200 dark:border-orange-800',
      'title' => 'Payment Pending',
      'message' => 'Your payment is being verified. You\'ll receive a confirmation email once completed.',
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
    'subtotal' => 4331,
    'shipping' => 76.02,
    'discount' => 0,
    'tax' => 0,
    'total' => 4407.02,
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
      'name' => 'Sample Product',
      'image' => asset('assets/images/noimage.png'),
      'quantity' => 1,
      'price' => 4331,
      'total' => 4331,
    ],
  ];
@endphp

<!-- Main Content -->
<main id="main-content" role="main" class="bg-gray-50 dark:bg-gray-900 min-h-screen">
  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <!-- Status Demo Switcher (Remove in production) -->
    <div class="mb-4 p-3 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800">
      <p class="text-xs text-yellow-800 dark:text-yellow-200 font-medium mb-2">Demo Mode: Switch payment status</p>
      <div class="flex flex-wrap gap-2">
        <a href="?status=success" class="px-3 py-1.5 text-xs bg-green-600 text-white hover:bg-green-700 transition-colors">Success</a>
        <a href="?status=failed" class="px-3 py-1.5 text-xs bg-red-600 text-white hover:bg-red-700 transition-colors">Failed</a>
        <a href="?status=pending" class="px-3 py-1.5 text-xs bg-orange-600 text-white hover:bg-orange-700 transition-colors">Pending</a>
      </div>
    </div>

    <!-- Compact Status Card -->
    <div class="bg-white dark:bg-gray-800 border-2 {{ $currentStatus['border'] }} mb-6">
      <div class="p-6">

        <!-- Status Header - Horizontal Layout -->
        <div class="flex items-center gap-4 mb-4">
          <!-- Status Icon -->
          <div class="{{ $currentStatus['color'] }} flex-shrink-0" aria-hidden="true">
            {!! $currentStatus['icon'] !!}
          </div>

          <!-- Status Text -->
          <div class="flex-1 min-w-0">
            <h1 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-gray-100 mb-1">
              {{ $currentStatus['title'] }}
            </h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">
              {{ $currentStatus['message'] }}
            </p>
          </div>

          <!-- Order Number (Desktop) -->
          <div class="hidden lg:block text-right flex-shrink-0">
            <p class="text-xs text-gray-600 dark:text-gray-400 mb-1">Order Number</p>
            <p class="font-mono font-bold text-gray-900 dark:text-gray-100">{{ $order['order_number'] }}</p>
          </div>
        </div>

        <!-- Order Number (Mobile) -->
        <div class="lg:hidden mb-4 pb-4 border-b border-gray-200 dark:border-gray-700">
          <p class="text-xs text-gray-600 dark:text-gray-400 mb-1">Order Number</p>
          <p class="font-mono font-semibold text-gray-900 dark:text-gray-100">{{ $order['order_number'] }}</p>
        </div>

        <!-- Order Meta - Compact Grid -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-4 pb-4 border-b border-gray-200 dark:border-gray-700">
          <div>
            <p class="text-xs text-gray-600 dark:text-gray-400 mb-1">Date</p>
            <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $order['order_date'] }}</p>
          </div>
          <div>
            <p class="text-xs text-gray-600 dark:text-gray-400 mb-1">Payment</p>
            <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $order['payment_method'] }}</p>
          </div>
          @if($demoStatus === 'success')
          <div class="col-span-2">
            <p class="text-xs text-gray-600 dark:text-gray-400 mb-1">Transaction ID</p>
            <p class="text-xs font-mono text-gray-900 dark:text-gray-100 break-all">{{ $order['transaction_id'] }}</p>
          </div>
          @endif
        </div>

        <!-- Action Buttons - Compact -->
        <div class="flex flex-col sm:flex-row gap-2">
          @if($demoStatus === 'success' || $demoStatus === 'pending')
            <a href="{{ route('front.index') }}"
               class="flex-1 sm:flex-none px-6 py-2.5 bg-orange-600 text-white text-sm font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 transition-colors text-center">
              Continue Shopping
            </a>
            <a href="{{ route('user.account') }}"
               class="flex-1 sm:flex-none px-6 py-2.5 bg-gray-800 dark:bg-gray-700 text-white text-sm font-semibold hover:bg-gray-900 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors text-center">
              My Account
            </a>
          @else
            <a href="{{ route('front.checkout') }}"
               class="flex-1 sm:flex-none px-6 py-2.5 bg-orange-600 text-white text-sm font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 transition-colors text-center">
              Retry Payment
            </a>
            <a href="{{ route('front.cart') }}"
               class="flex-1 sm:flex-none px-6 py-2.5 bg-gray-800 dark:bg-gray-700 text-white text-sm font-semibold hover:bg-gray-900 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors text-center">
              Back to Cart
            </a>
          @endif
        </div>
      </div>
    </div>

    <!-- Order Details Section (Show only for success and pending) -->
    @if($demoStatus === 'success' || $demoStatus === 'pending')

    <!-- Two Column Layout for Desktop -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

      <!-- Left: Products & Address (2 columns) -->
      <div class="lg:col-span-2 space-y-4">

        <!-- Products Section - Compact -->
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
          <div class="p-4">
            <h2 class="text-base font-bold text-gray-900 dark:text-gray-100 mb-3">Ordered Items</h2>

            <!-- Compact Product List -->
            <div class="space-y-3">
              @foreach($orderProducts as $product)
              <div class="flex items-center gap-3 pb-3 border-b border-gray-200 dark:border-gray-700 last:border-0 last:pb-0">
                <img src="{{ $product['image'] }}"
                     alt="{{ $product['name'] }}"
                     class="w-14 h-14 object-cover bg-gray-100 dark:bg-gray-700 flex-shrink-0"
                     loading="lazy" />
                <div class="flex-1 min-w-0">
                  <p class="text-sm font-semibold text-gray-900 dark:text-gray-100 truncate">{{ $product['name'] }}</p>
                  <p class="text-xs text-gray-600 dark:text-gray-400">Qty: {{ $product['quantity'] }}</p>
                </div>
                <div class="text-right flex-shrink-0">
                  <p class="text-sm font-bold text-gray-900 dark:text-gray-100">{{ App\Models\Product::convertPrice($product['total']) }}</p>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>

        <!-- Billing Address - Compact -->
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
          <div class="p-4">
            <h2 class="text-base font-bold text-gray-900 dark:text-gray-100 mb-3">Billing Address</h2>
            <div class="text-sm space-y-1 text-gray-700 dark:text-gray-300">
              <p class="font-semibold text-gray-900 dark:text-gray-100">{{ $billingAddress['name'] }}</p>
              <p class="text-xs">{{ $billingAddress['email'] }} • {{ $billingAddress['phone'] }}</p>
              <p class="pt-1">{{ $billingAddress['address'] }}@if($billingAddress['flat']), {{ $billingAddress['flat'] }}@endif</p>
              <p>{{ $billingAddress['city'] }}, {{ $billingAddress['state'] }} {{ $billingAddress['zip'] }}</p>
            </div>
          </div>
        </div>

      </div>

      <!-- Right: Payment Summary (1 column) -->
      <div class="lg:col-span-1">
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 lg:sticky lg:top-6">
          <div class="p-4">
            <h2 class="text-base font-bold text-gray-900 dark:text-gray-100 mb-3">Payment Summary</h2>

            <div class="space-y-2 text-sm mb-3 pb-3 border-b border-gray-200 dark:border-gray-700">
              <div class="flex justify-between">
                <span class="text-gray-600 dark:text-gray-400">Subtotal</span>
                <span class="text-gray-900 dark:text-gray-100">{{ App\Models\Product::convertPrice($paymentInfo['subtotal']) }}</span>
              </div>
              <div class="flex justify-between">
                <span class="text-gray-600 dark:text-gray-400">Shipping</span>
                <span class="text-gray-900 dark:text-gray-100">
                  {{ $paymentInfo['shipping'] == 0 ? 'FREE' : App\Models\Product::convertPrice($paymentInfo['shipping']) }}
                </span>
              </div>
              @if($paymentInfo['discount'] > 0)
              <div class="flex justify-between text-green-600 dark:text-green-400">
                <span>Discount</span>
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

            <div class="flex justify-between items-center">
              <span class="font-bold text-gray-900 dark:text-gray-100">Total Paid</span>
              <span class="text-xl font-bold text-orange-600 dark:text-orange-400">
                {{ App\Models\Product::convertPrice($paymentInfo['total']) }}
              </span>
            </div>

            @if($demoStatus === 'success')
            <div class="mt-4 p-3 {{ $currentStatus['bg'] }} border {{ $currentStatus['border'] }}">
              <div class="flex gap-2">
                <svg class="w-4 h-4 {{ $currentStatus['color'] }} flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-xs text-green-800 dark:text-green-200">
                  Payment confirmed. Your order will be processed shortly.
                </p>
              </div>
            </div>
            @elseif($demoStatus === 'pending')
            <div class="mt-4 p-3 {{ $currentStatus['bg'] }} border {{ $currentStatus['border'] }}">
              <div class="flex gap-2">
                <svg class="w-4 h-4 {{ $currentStatus['color'] }} flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-xs text-orange-800 dark:text-orange-200">
                  Verifying payment. Check your email for updates.
                </p>
              </div>
            </div>
            @endif
          </div>
        </div>
      </div>

    </div>
    @endif

    <!-- Failed Payment Additional Info (Compact) -->
    @if($demoStatus === 'failed')
    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
      <div class="p-4 sm:p-6">
        <div class="grid md:grid-cols-2 gap-6">

          <!-- Common Issues -->
          <div>
            <h2 class="text-base font-bold text-gray-900 dark:text-gray-100 mb-3">Common Issues</h2>
            <div class="space-y-2 text-sm text-gray-700 dark:text-gray-300">
              <div class="flex gap-2">
                <span class="text-red-600 dark:text-red-400">•</span>
                <p>Insufficient funds in account</p>
              </div>
              <div class="flex gap-2">
                <span class="text-red-600 dark:text-red-400">•</span>
                <p>Incorrect card details</p>
              </div>
              <div class="flex gap-2">
                <span class="text-red-600 dark:text-red-400">•</span>
                <p>Card expired or blocked</p>
              </div>
              <div class="flex gap-2">
                <span class="text-red-600 dark:text-red-400">•</span>
                <p>Payment gateway timeout</p>
              </div>
            </div>
          </div>

          <!-- Support -->
          <div>
            <h2 class="text-base font-bold text-gray-900 dark:text-gray-100 mb-3">Need Help?</h2>
            <div class="text-sm text-gray-700 dark:text-gray-300 space-y-2">
              <p>Contact our support team:</p>
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

    <!-- Footer Help Text - Compact -->
    <div class="mt-6 text-center">
      <p class="text-xs text-gray-600 dark:text-gray-400">
        Questions?
        <a href="#" class="text-orange-600 dark:text-orange-400 hover:underline font-medium">Contact Support</a>
        or visit
        <a href="#" class="text-orange-600 dark:text-orange-400 hover:underline font-medium">Help Center</a>
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
