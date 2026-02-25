@extends('frontend.include.app')

@section('content')
@php
  $demoStatus = request()->get('status', 'success');

  $statusConfig = [
    'success' => [
      'iconBg'   => 'bg-semantic-success',
      'iconColor' => 'text-white',
      'color'    => 'text-semantic-success',
      'bg'       => 'bg-green-50 dark:bg-green-950/30',
      'border'   => 'border-green-200 dark:border-green-900',
      'title'    => 'Payment Successful!',
      'message'  => 'Your order has been placed successfully.',
    ],
    'failed' => [
      'iconBg'   => 'bg-semantic-error',
      'iconColor' => 'text-white',
      'color'    => 'text-semantic-error',
      'bg'       => 'bg-red-50 dark:bg-red-950/30',
      'border'   => 'border-red-200 dark:border-red-900',
      'title'    => 'Payment Failed',
      'message'  => 'Your payment could not be processed. Please try again.',
    ],
    'pending' => [
      'iconBg'   => 'bg-primary-800',
      'iconColor' => 'text-white',
      'color'    => 'text-primary-700 dark:text-primary-400',
      'bg'       => 'bg-primary-100 dark:bg-primary-900/20',
      'border'   => 'border-primary-200 dark:border-primary-800',
      'title'    => 'Payment Pending',
      'message'  => 'Your payment is being verified. Confirmation follows shortly.',
    ],
  ];

  $currentStatus = $statusConfig[$demoStatus] ?? $statusConfig['success'];

  $order = $order ?? [
    'order_number'   => 'hejH1764847275',
    'order_date'     => '04-Dec-2025',
    'transaction_id' => 'pay_RnWArmPcKs1FBy',
    'payment_method' => 'Razorpay',
  ];

  $paymentInfo = $paymentInfo ?? [
    'totalPrice'        => 8092,
    'shipping_cost'     => 150,
    'refferal_discount' => 150,
    'coupon_discount'   => 500,
    'tax'               => 0,
    'pay_amount'        => 7742,
  ];

  $billingAddress = $billingAddress[0] ?? [
    'name'    => 'Vinay',
    'email'   => 'vinay.jaisval2015@gmail.com',
    'phone'   => '9889259224',
    'address' => 'Noida Sector-2, B-95',
    'flat'    => '217B',
    'city'    => 'Gautam Buddha Nagar',
    'state'   => 'Uttar Pradesh',
    'pincode' => '201301',
    'country' => 'India',
  ];

  $orderProducts = $orderProducts ?? [
    ['name' => 'Organic Face Serum - Vitamin C', 'image' => asset('assets/images/noimage.png'), 'quantity' => 2, 'price' => 1299, 'total' => 2598],
    ['name' => 'Natural Body Lotion - Lavender',  'image' => asset('assets/images/noimage.png'), 'quantity' => 1, 'price' => 899,  'total' => 899],
  ];

  $cartItems   = isset($tempcart) && isset($tempcart->items) ? (array) $tempcart->items : null;
  $itemCount   = $cartItems !== null ? count($cartItems) : count($orderProducts);
  $itemsSource = $cartItems ?? $orderProducts;

  // SVG icon paths (DRY)
  $icons = [
    'success'      => '<circle cx="12" cy="12" r="10" stroke-width="2"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/>',
    'failed'       => '<circle cx="12" cy="12" r="10" stroke-width="2"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 9l-6 6m0-6l6 6"/>',
    'pending'      => '<circle cx="12" cy="12" r="10" stroke-width="2"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2"/>',
    'tag'          => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>',
    'calendar'     => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>',
    'credit-card'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>',
    'user'         => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>',
    'check-circle' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>',
    'email'        => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>',
    'phone'        => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>',
    'location'     => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>',
    'info'         => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
  ];

  // Shared classes (design system tokens)
  $c = [
    'card'        => 'bg-white dark:bg-neutral-800 border border-neutral-200 dark:border-neutral-700',
    'sec-label'   => 'text-xs uppercase tracking-wider font-bold text-neutral-500 dark:text-neutral-400 mb-3',
    'row-label'   => 'text-xs uppercase tracking-wide font-medium text-neutral-400 dark:text-neutral-500 mb-0.5 block',
    'row-value'   => 'text-sm font-bold text-neutral-900 dark:text-neutral-100',
    'icon-sm'     => 'w-4 h-4 text-neutral-400 dark:text-neutral-500 flex-shrink-0 mt-0.5',
    'btn-primary' => 'flex-1 py-3 text-center text-sm font-semibold text-white bg-primary-800 hover:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary-600 transition-colors',
    'btn-dark'    => 'flex-1 py-3 text-center text-sm font-semibold text-white bg-neutral-900 dark:bg-neutral-700 hover:bg-neutral-800 dark:hover:bg-neutral-600 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-neutral-500 transition-colors',
  ];

  // Order detail rows
  $orderDetails = [
    ['icon' => 'tag',         'label' => 'Order Number',   'value' => $order['order_number']],
    ['icon' => 'calendar',    'label' => 'Payment Date',   'value' => $order['created_at'] ?? ($order['order_date'] ?? 'N/A')],
    ['icon' => 'credit-card', 'label' => 'Payment Method', 'value' => isset($order['method'])
      ? ($order['method'] == 1 ? 'COD' : ($order['method'] == 9 ? 'Razorpay' : 'Unknown'))
      : ($order['payment_method'] ?? 'N/A')],
    ['icon' => 'user', 'label' => 'Customer Name', 'value' => $billingAddress['name']],
  ];

  // Payment breakdown rows
  $breakdown = [
    ['label' => 'Subtotal',      'value' => $paymentInfo['totalPrice'],    'type' => 'normal'],
    ['label' => 'Shipping Cost', 'value' => $paymentInfo['shipping_cost'], 'type' => 'free'],
  ];
  if (($paymentInfo['refferal_discount'] ?? 0) > 0) {
    $breakdown[] = ['label' => 'Promo',           'value' => $paymentInfo['refferal_discount'], 'type' => 'discount'];
  }
  if (($paymentInfo['coupon_discount'] ?? 0) > 0) {
    $breakdown[] = ['label' => 'Coupon Discount', 'value' => $paymentInfo['coupon_discount'],   'type' => 'discount'];
  }
  if (($paymentInfo['tax'] ?? 0) > 0) {
    $breakdown[] = ['label' => 'Tax',             'value' => $paymentInfo['tax'],               'type' => 'normal'];
  }

  $settings = $settings ?? [
    'support_email' => config('mail.from.address', 'support@example.com'),
    'support_phone' => '+1234567890',
  ];
@endphp

<main id="main-content" role="main" class="bg-neutral-50 dark:bg-neutral-900 min-h-screen py-5 sm:py-6">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 space-y-3">

    {{-- ── Card 1: Status Banner + CTA Buttons ──────────────── --}}
    <div class="{{ $c['card'] }}" role="region" aria-labelledby="payment-status-title">

      {{-- Status row --}}
      <div class="{{ $currentStatus['bg'] }} border-b {{ $currentStatus['border'] }}">
        <div class="flex items-center gap-4 px-5 py-4 sm:px-6">

          {{-- Icon --}}
          <div class="{{ $currentStatus['iconBg'] }} p-2.5 flex-shrink-0" aria-hidden="true">
            <svg class="w-7 h-7 {{ $currentStatus['iconColor'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              {!! $icons[$demoStatus] !!}
            </svg>
          </div>

          {{-- Title + message --}}
          <div class="flex-1 min-w-0">
            <h1 id="payment-status-title" class="text-lg sm:text-xl font-bold {{ $currentStatus['color'] }} leading-tight">
              {{ $currentStatus['title'] }}
            </h1>
            <p class="text-xs text-neutral-600 dark:text-neutral-400 mt-0.5">{{ $currentStatus['message'] }}</p>
          </div>

          {{-- Total Amount --}}
          <div class="flex-shrink-0 text-right pl-4 border-l border-neutral-200 dark:border-neutral-700 min-w-[110px] sm:min-w-[140px]">
            <p class="text-xs uppercase tracking-wider font-medium text-neutral-500 dark:text-neutral-400">Total Amount</p>
            <p class="text-xl sm:text-3xl font-bold text-neutral-900 dark:text-neutral-100 leading-tight">
              {{ App\Models\Product::convertPrice($paymentInfo['pay_amount']) }}
            </p>
          </div>
        </div>
      </div>

      {{-- CTA buttons — full width, edge to edge --}}
      <div class="flex divide-x divide-neutral-200 dark:divide-neutral-700">
        @if($demoStatus === 'success' || $demoStatus === 'pending')
          <a href="{{ route('front.index') }}"  class="{{ $c['btn-primary'] }}">Continue Shopping</a>
          <a href="{{ route('user.account') }}" class="{{ $c['btn-dark'] }}">View My Orders</a>
        @else
          <a href="{{ route('front.checkout') }}" class="{{ $c['btn-primary'] }}">Retry Payment</a>
          <a href="{{ route('front.cart') }}"     class="{{ $c['btn-dark'] }}">Back to Cart</a>
        @endif
      </div>
    </div>

    {{-- ── Card 2: Order Details + Payment Breakdown ────────── --}}
    <div class="{{ $c['card'] }}">
      <div class="grid grid-cols-1 sm:grid-cols-2 divide-y sm:divide-y-0 sm:divide-x divide-neutral-200 dark:divide-neutral-700">

        {{-- Order Details --}}
        <section class="p-5 sm:p-6" aria-labelledby="order-details-heading">
          <h2 id="order-details-heading" class="{{ $c['sec-label'] }}">Order Details</h2>
          <dl class="space-y-3">
            @foreach($orderDetails as $detail)
            <div class="flex items-start gap-2.5">
              <svg class="{{ $c['icon-sm'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                {!! $icons[$detail['icon']] !!}
              </svg>
              <div>
                <dt class="{{ $c['row-label'] }}">{{ $detail['label'] }}</dt>
                <dd class="{{ $c['row-value'] }}">{{ $detail['value'] }}</dd>
              </div>
            </div>
            @endforeach

            @if($demoStatus === 'success' && !empty($order['transaction_id']))
            <div class="flex items-start gap-2.5 pt-3 border-t border-neutral-200 dark:border-neutral-700">
              <svg class="w-4 h-4 text-semantic-success flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                {!! $icons['check-circle'] !!}
              </svg>
              <div>
                <dt class="text-xs uppercase tracking-wide font-medium text-semantic-success mb-0.5 block">Transaction ID</dt>
                <dd class="text-xs font-mono font-bold text-neutral-900 dark:text-neutral-100 break-all">{{ $order['transaction_id'] }}</dd>
              </div>
            </div>
            @endif
          </dl>
        </section>

        {{-- Payment Breakdown (success/pending) --}}
        @if($demoStatus === 'success' || $demoStatus === 'pending')
        <section class="p-5 sm:p-6" aria-labelledby="payment-breakdown-heading">
          <h2 id="payment-breakdown-heading" class="{{ $c['sec-label'] }}">Payment Breakdown</h2>
          <dl class="space-y-2">
            @foreach($breakdown as $item)
            <div class="flex justify-between items-center text-sm">
              <dt class="text-neutral-600 dark:text-neutral-400">{{ $item['label'] }}</dt>
              <dd class="{{ $item['type'] === 'discount' ? 'text-semantic-success font-medium' : 'text-neutral-700 dark:text-neutral-300' }}">
                @if($item['type'] === 'discount')
                  −{{ App\Models\Product::convertPrice($item['value']) }}
                @elseif($item['type'] === 'free' && $item['value'] == 0)
                  <span class="text-semantic-success font-semibold">FREE</span>
                @else
                  {{ App\Models\Product::convertPrice($item['value']) }}
                @endif
              </dd>
            </div>
            @endforeach
            <div class="flex justify-between items-center pt-2 border-t border-neutral-300 dark:border-neutral-600">
              <dt class="text-sm font-bold text-neutral-900 dark:text-neutral-100">Total</dt>
              <dd class="text-xl font-bold text-neutral-900 dark:text-neutral-100">{{ App\Models\Product::convertPrice($paymentInfo['pay_amount']) }}</dd>
            </div>
          </dl>
        </section>
        @endif

        {{-- Failure reasons (takes right column) --}}
        @if($demoStatus === 'failed')
        <section class="p-5 sm:p-6" aria-labelledby="failed-reasons-heading">
          <h2 id="failed-reasons-heading" class="{{ $c['sec-label'] }}">Common Reasons</h2>
          <ul class="text-sm text-neutral-700 dark:text-neutral-300 space-y-1.5 ml-4 list-disc">
            <li>Insufficient funds in account</li>
            <li>Incorrect payment details entered</li>
            <li>Card expired or blocked</li>
            <li>Network timeout during transaction</li>
          </ul>
        </section>
        @endif

      </div>

      {{-- Pending notice --}}
      @if($demoStatus === 'pending')
      <div class="flex items-center gap-2 px-5 py-2.5 sm:px-6 bg-primary-50 dark:bg-primary-900/20 border-t border-primary-200 dark:border-primary-800" role="status">
        <svg class="w-4 h-4 text-primary-700 dark:text-primary-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
          {!! $icons['info'] !!}
        </svg>
        <p class="text-xs text-primary-800 dark:text-primary-200">Payment verification in progress. Email confirmation will follow.</p>
      </div>
      @endif
    </div>

    {{-- ── Card 3 + 4: Ordered Items + Billing Address ─────── --}}
    @if($demoStatus === 'success' || $demoStatus === 'pending')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-3">

      {{-- Ordered Items (2/3) --}}
      <section class="lg:col-span-2 {{ $c['card'] }}" aria-labelledby="ordered-items-heading">
        <div class="px-5 py-3 sm:px-6 border-b border-neutral-200 dark:border-neutral-700">
          <h2 id="ordered-items-heading" class="text-sm font-bold text-neutral-900 dark:text-neutral-100">
            Ordered Items <span class="font-normal text-neutral-500 dark:text-neutral-400">{{ $itemCount }}</span>
          </h2>
        </div>
        <ul class="divide-y divide-neutral-200 dark:divide-neutral-700" role="list">
          @foreach($itemsSource as $product)
          @php
            $pName  = $product['item']['name']  ?? $product['name']     ?? 'Product';
            $pQty   = $product['qty']            ?? $product['quantity'] ?? 1;
            $pPrice = $product['price']           ?? 0;
            $pTotal = $product['item_price']      ?? $product['total']   ?? 0;
            $pPhoto = $product['item']['photo']   ?? null;
            $pImg   = $pPhoto
              ? asset('assets/images/products/' . $pPhoto)
              : ($product['image'] ?? asset('assets/images/noimage.png'));
          @endphp
          <li class="flex gap-3 px-5 py-3.5 sm:px-6" role="listitem">
            <img src="{{ $pImg }}" alt="{{ $pName }}"
                 class="w-14 h-14 object-cover bg-neutral-100 dark:bg-neutral-700 border border-neutral-200 dark:border-neutral-600 flex-shrink-0"
                 loading="lazy" />
            <div class="flex-1 min-w-0">
              <p class="text-sm font-semibold text-primary-700 dark:text-primary-400 mb-2 truncate" title="{{ $pName }}">
                {{ $pName }}
              </p>
              <div class="grid grid-cols-3 gap-2 text-xs">
                <div>
                  <p class="uppercase tracking-wide font-medium text-neutral-400 dark:text-neutral-500 mb-0.5">Quantity</p>
                  <p class="font-bold text-neutral-900 dark:text-neutral-100">{{ $pQty }}</p>
                </div>
                <div>
                  <p class="uppercase tracking-wide font-medium text-neutral-400 dark:text-neutral-500 mb-0.5">Unit Price</p>
                  <p class="font-bold text-neutral-700 dark:text-neutral-300">{{ App\Models\Product::convertPrice($pPrice) }}</p>
                </div>
                <div>
                  <p class="uppercase tracking-wide font-medium text-neutral-400 dark:text-neutral-500 mb-0.5">Subtotal</p>
                  <p class="font-bold text-primary-700 dark:text-primary-400">{{ App\Models\Product::convertPrice($pTotal) }}</p>
                </div>
              </div>
            </div>
          </li>
          @endforeach
        </ul>
      </section>

      {{-- Billing Address (1/3) --}}
      <section class="{{ $c['card'] }}" aria-labelledby="billing-address-heading">
        <div class="px-5 py-3 sm:px-6 border-b border-neutral-200 dark:border-neutral-700">
          <h2 id="billing-address-heading" class="text-sm font-bold text-neutral-900 dark:text-neutral-100">Billing Address</h2>
        </div>
        <div class="p-5 sm:p-6">
          <p class="font-bold text-neutral-900 dark:text-neutral-100 pb-3 mb-3 border-b border-neutral-200 dark:border-neutral-700">
            {{ $billingAddress['name'] }}
          </p>
          <dl class="space-y-3 text-sm">
            <div class="flex items-start gap-2">
              <svg class="{{ $c['icon-sm'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">{!! $icons['email'] !!}</svg>
              <div class="min-w-0">
                <dt class="{{ $c['row-label'] }}">Email</dt>
                <dd><a href="mailto:{{ $billingAddress['email'] }}" class="text-primary-700 dark:text-primary-400 hover:underline break-all text-xs">{{ $billingAddress['email'] }}</a></dd>
              </div>
            </div>
            <div class="flex items-start gap-2">
              <svg class="{{ $c['icon-sm'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">{!! $icons['phone'] !!}</svg>
              <div>
                <dt class="{{ $c['row-label'] }}">Phone</dt>
                <dd><a href="tel:{{ $billingAddress['phone'] }}" class="text-primary-700 dark:text-primary-400 hover:underline text-sm font-medium">{{ $billingAddress['phone'] }}</a></dd>
              </div>
            </div>
            <div class="flex items-start gap-2 pt-3 border-t border-neutral-200 dark:border-neutral-700">
              <svg class="{{ $c['icon-sm'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">{!! $icons['location'] !!}</svg>
              <div>
                <dt class="{{ $c['row-label'] }}">Address</dt>
                <dd class="space-y-0.5 text-neutral-700 dark:text-neutral-300">
                  <p>{{ $billingAddress['address'] }}@if(!empty($billingAddress['flat'])), {{ $billingAddress['flat'] }}@endif</p>
                  <p class="text-primary-700 dark:text-primary-400 font-medium">{{ $billingAddress['city'] }}, {{ $billingAddress['state'] }}</p>
                  <p>{{ $billingAddress['pincode'] ?? $billingAddress['zip'] ?? '' }}</p>
                  <p class="font-bold text-neutral-900 dark:text-neutral-100">{{ $billingAddress['country'] }}</p>
                </dd>
              </div>
            </div>
          </dl>
        </div>
      </section>

    </div>
    @endif

    {{-- ── Help Section (failed only) ───────────────────────── --}}
    @if($demoStatus === 'failed')
    <div class="{{ $c['card'] }}">
      <div class="grid sm:grid-cols-2 divide-y sm:divide-y-0 sm:divide-x divide-neutral-200 dark:divide-neutral-700">
        <div class="p-5 sm:p-6">
          <h2 class="{{ $c['sec-label'] }}">Need Help?</h2>
          <ul class="text-sm text-neutral-700 dark:text-neutral-300 space-y-1.5 ml-4 list-disc">
            <li>Verify your payment method details</li>
            <li>Ensure sufficient funds are available</li>
            <li>Try a different payment method</li>
            <li>Contact your bank if the issue persists</li>
          </ul>
        </div>
        <div class="p-5 sm:p-6">
          <h2 class="{{ $c['sec-label'] }}">Contact Support</h2>
          <div class="space-y-2.5">
            <a href="mailto:{{ $settings['support_email'] }}" class="flex items-center gap-2 text-sm text-primary-700 dark:text-primary-400 hover:underline font-medium">
              <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">{!! $icons['email'] !!}</svg>
              {{ $settings['support_email'] }}
            </a>
            <a href="tel:{{ $settings['support_phone'] }}" class="flex items-center gap-2 text-sm text-primary-700 dark:text-primary-400 hover:underline font-medium">
              <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">{!! $icons['phone'] !!}</svg>
              {{ $settings['support_phone'] }}
            </a>
          </div>
        </div>
      </div>
    </div>
    @endif

    {{-- Footer --}}
    <p class="text-center text-xs text-neutral-500 dark:text-neutral-400 pb-2">
      Have questions?
      <a href="mailto:{{ $settings['support_email'] }}" class="text-primary-700 dark:text-primary-400 hover:underline font-medium">Contact our support team</a>
    </p>

  </div>
</main>
@endsection

@section('scripts')
<script>
  @if($demoStatus === 'pending')
  // Auto-refresh for pending — uncomment in production:
  // setTimeout(() => window.location.reload(), 30000);
  @endif
</script>
@endsection
