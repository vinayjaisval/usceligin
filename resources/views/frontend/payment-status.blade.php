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
      'title'    => 'Order Successful!',
      'message'  => 'Your order has been placed. A confirmation email is on its way.',
      'amtLabel' => 'Amount Paid',
    ],
    'failed' => [
      'iconBg'   => 'bg-semantic-error',
      'iconColor' => 'text-white',
      'color'    => 'text-semantic-error',
      'bg'       => 'bg-red-50 dark:bg-red-950/30',
      'border'   => 'border-red-200 dark:border-red-900',
      'title'    => 'Payment Failed',
      'message'  => 'Your payment could not be processed. No amount has been charged.',
      'amtLabel' => 'Attempted Amount',
    ],
    'pending' => [
      'iconBg'   => 'bg-primary-800',
      'iconColor' => 'text-white',
      'color'    => 'text-primary-700 dark:text-primary-400',
      'bg'       => 'bg-primary-100 dark:bg-primary-900/20',
      'border'   => 'border-primary-200 dark:border-primary-800',
      'title'    => 'Payment Pending',
      'message'  => 'Your payment is being verified. Confirmation follows shortly.',
      'amtLabel' => 'Amount',
    ],
  ];

  $currentStatus = $statusConfig[$demoStatus] ?? $statusConfig['success'];

  $order = $order ?? '';

  $paymentInfo = $paymentInfo ?? '';

  $billingAddress = $billingAddress[0] ?? '';

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
    'exclamation'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>',
  ];

  // Shared token shortcuts
  $divider  = 'border-neutral-200 dark:border-neutral-700';
  $card     = 'bg-white dark:bg-neutral-800 border border-neutral-200 dark:border-neutral-700';
  $lblRow   = 'text-xs uppercase tracking-wide font-medium text-neutral-400 dark:text-neutral-500 mb-0.5 block';
  $valRow   = 'text-sm font-bold text-neutral-900 dark:text-neutral-100';
  $iconSm   = 'w-4 h-4 text-neutral-400 dark:text-neutral-500 flex-shrink-0 mt-0.5';
  $secHd    = 'text-xs uppercase tracking-wider font-bold text-neutral-500 dark:text-neutral-400 mb-3 pb-2 border-b border-neutral-200 dark:border-neutral-700';
  $colHd    = 'text-xs uppercase tracking-wide font-semibold text-neutral-400 dark:text-neutral-500';
  // Button base classes — append bg/border/color per variant
  $btnSolid = 'flex-1 flex items-center justify-center text-white text-sm font-semibold px-5 py-2.5 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-1';
  $btnGhost = 'flex-1 flex items-center justify-center text-sm font-semibold px-5 py-2.5 border transition-colors focus:outline-none focus:ring-2 focus:ring-offset-1';

  // Order detail rows
  $orderDetails = [
    ['icon' => 'tag',         'label' => 'Order Number',   'value' => $order['order_number']],
    ['icon' => 'calendar',    'label' => 'Order Date',     'value' => $order['created_at'] ?? ($order['order_date'] ?? 'N/A')],
    ['icon' => 'credit-card', 'label' => 'Payment Method', 'value' => isset($order['method'])
      ? ($order['method'] == 'COD' ? 'COD' : ($order['method'] == 'online' ? 'Razorpay' : 'Unknown'))
      : ($order['payment_method'] ?? 'N/A')],
    ['icon' => 'user', 'label' => 'Customer', 'value' => $billingAddress['name']],
  ];

  // Subtotal: Order model has no totalPrice column; use tempcart object or derive from pay_amount
  $subtotal = null;
  if (isset($tempcart) && is_object($tempcart) && isset($tempcart->totalPrice) && $tempcart->totalPrice > 0) {
    $subtotal = $tempcart->totalPrice;
  } elseif (isset($paymentInfo['totalPrice']) && $paymentInfo['totalPrice'] > 0) {
    $subtotal = $paymentInfo['totalPrice'];
  } else {
    // Derive: items total = paid − shipping − tax + discounts
    $subtotal = ($paymentInfo['pay_amount'] ?? 0)
      - ($paymentInfo['shipping_cost'] ?? 0)
      - ($paymentInfo['tax'] ?? 0)
      + ($paymentInfo['coupon_discount'] ?? 0)
      + ($paymentInfo['refferal_discount'] ?? 0);
  }

  // Payment breakdown rows
  $breakdown = [
    ['label' => 'Subtotal', 'value' => $subtotal,                     'type' => 'normal'],
    ['label' => 'Shipping', 'value' => $paymentInfo['shipping_cost'], 'type' => 'free'],
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

{{-- Single padding source: py on main only, inner div handles horizontal + space-y --}}
<main id="main-content" role="main" class="bg-neutral-50 dark:bg-neutral-900 min-h-screen py-6 sm:py-8">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4">

    {{-- ═══════════════════════════════════════════════════════
         ROW 1 — 2 columns: [Status Banner] | [Amount Paid]
         ═══════════════════════════════════════════════════════ --}}
    <div class="overflow-hidden border {{ $divider }}" role="region" aria-labelledby="payment-status-title">
      <div class="flex flex-col sm:flex-row sm:items-stretch">

        {{-- Col 1: Status icon + title + message — stacked on mobile, side-by-side on sm+ --}}
        <div class="{{ $currentStatus['bg'] }} flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-5 px-6 py-6 sm:flex-1">
          <div class="{{ $currentStatus['iconBg'] }} p-3 self-start sm:flex-shrink-0" aria-hidden="true">
            <svg class="w-8 h-8 {{ $currentStatus['iconColor'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              {!! $icons[$demoStatus] !!}
            </svg>
          </div>
          <div>
            <h1 id="payment-status-title" class="text-2xl font-bold {{ $currentStatus['color'] }} leading-tight">
              {{ $currentStatus['title'] }}
            </h1>
            <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">{{ $currentStatus['message'] }}</p>
          </div>
        </div>

        {{-- Col 2: Amount paid — left-aligned on mobile, right-aligned on sm+ --}}
        <div class="{{ $currentStatus['bg'] }} flex flex-col justify-center px-6 sm:px-8 py-4 sm:py-6 text-left sm:text-right border-t sm:border-t-0 sm:border-l {{ $currentStatus['border'] }} sm:min-w-[210px]">
          <p class="{{ $colHd }} tracking-widest mb-1">{{ $currentStatus['amtLabel'] }}</p>
          <p class="text-3xl sm:text-4xl font-bold text-neutral-900 dark:text-neutral-100 leading-tight">
            {{ App\Models\Product::convertPrice($paymentInfo['pay_amount']) }}
          </p>
        </div>

      </div>
    </div>

    {{-- CTA Buttons — flex-col on mobile, flex-row on sm+ --}}
    <div class="flex flex-col sm:flex-row gap-3">
      @if($demoStatus === 'success' || $demoStatus === 'pending')
        <a href="{{ route('front.index') }}"
           class="{{ $btnSolid }} bg-primary-800 hover:bg-primary-900 focus:ring-primary-600">
          Continue Shopping
        </a>
        <a href="{{ route('user.account') }}"
           class="{{ $btnGhost }} border-primary-700 dark:border-primary-500 text-primary-700 dark:text-primary-400 hover:bg-primary-50 dark:hover:bg-primary-900/20 focus:ring-primary-600">
          View My Orders
        </a>
      @else
        <a href="{{ route('front.checkout') }}"
           class="{{ $btnSolid }} bg-semantic-error hover:opacity-90 focus:ring-red-500">
          Retry Payment
        </a>
        <a href="{{ route('front.cart') }}"
           class="{{ $btnGhost }} border-neutral-400 dark:border-neutral-600 text-neutral-700 dark:text-neutral-300 hover:bg-neutral-50 dark:hover:bg-neutral-700/30 focus:ring-neutral-500">
          Back to Cart
        </a>
      @endif
    </div>


    {{-- ═══════════════════════════════════════════════════════
         ROW 2 — 2 columns:
           Left  → Order Details | Billing Address
           Right → Ordered Items + Payment Breakdown (or Failed help)
         ═══════════════════════════════════════════════════════ --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 items-start">

      {{-- ── LEFT COLUMN: Order Details + Billing Address ─────── --}}
      <div class="{{ $card }} grid grid-cols-1 sm:grid-cols-2 overflow-hidden">

        {{-- Order Details --}}
        <section class="p-5" aria-labelledby="order-details-heading">
          <h2 id="order-details-heading" class="{{ $secHd }}">Order Details</h2>

          <dl class="space-y-3">
            @foreach($orderDetails as $detail)
            <div class="flex items-start gap-2.5">
              <svg class="{{ $iconSm }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                {!! $icons[$detail['icon']] !!}
              </svg>
              <div>
                <dt class="{{ $lblRow }}">{{ $detail['label'] }}</dt>
                <dd class="{{ $valRow }}">{{ $detail['value'] }}</dd>
              </div>
            </div>
            @endforeach

            @if($demoStatus === 'success' && !empty($order['transaction_id']))
            <div class="flex items-start gap-2.5 pt-3 border-t {{ $divider }}">
              <svg class="w-4 h-4 text-semantic-success flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                {!! $icons['check-circle'] !!}
              </svg>
              <div>
                <dt class="{{ $lblRow }} !text-semantic-success">Transaction ID</dt>
                <dd class="text-xs font-mono font-bold text-neutral-900 dark:text-neutral-100 break-all">{{ $order['transaction_id'] }}</dd>
              </div>
            </div>
            @endif
          </dl>
        </section>

        {{-- Billing Address --}}
        <section class="p-5 border-t sm:border-t-0 sm:border-l {{ $divider }}" aria-labelledby="billing-address-heading">
          <h2 id="billing-address-heading" class="{{ $secHd }}">Billing Address</h2>

          <p class="font-bold text-neutral-900 dark:text-neutral-100 pb-2 mb-2.5 border-b {{ $divider }}">
            {{ $billingAddress['name'] }}
          </p>

          <dl class="space-y-2.5">
            {{-- Email --}}
            <div class="flex items-start gap-2">
              <svg class="{{ $iconSm }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">{!! $icons['email'] !!}</svg>
              <div class="min-w-0">
                <dt class="{{ $lblRow }}">Email</dt>
                @if(!empty($billingAddress['email']))
                <dd class="text-xs text-neutral-700 dark:text-neutral-300 break-all">{{ $billingAddress['email'] }}</dd>
                @endif
              </div>
            </div>

            {{-- Phone --}}
            <div class="flex items-start gap-2">
              <svg class="{{ $iconSm }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">{!! $icons['phone'] !!}</svg>
              <div>
                <dt class="{{ $lblRow }}">Phone</dt>
                <dd>
                  <a href="tel:{{ $billingAddress['phone'] }}"
                     class="text-sm font-medium text-neutral-900 dark:text-neutral-100 hover:underline">
                    {{ $billingAddress['phone'] }}
                  </a>
                </dd>
              </div>
            </div>

            {{-- Delivery Address --}}
            <div class="flex items-start gap-2 pt-2 border-t {{ $divider }}">
              <svg class="{{ $iconSm }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">{!! $icons['location'] !!}</svg>
              <div>
                <dt class="{{ $lblRow }}">Delivery Address</dt>
                <dd class="space-y-0.5 text-sm">
                  @if(!empty($billingAddress['address']))
                  <p class="text-neutral-700 dark:text-neutral-300">{{ $billingAddress['address'] }}@if(!empty($billingAddress['flat'])), {{ $billingAddress['flat'] }}@endif</p>
                  @endif
                  <p class="text-primary-700 dark:text-primary-400 font-medium">{{ $billingAddress['city'] }}, {{ $billingAddress['state'] }}</p>
                  <p class="text-neutral-700 dark:text-neutral-300">{{ $billingAddress['pincode'] ?? $billingAddress['zip'] ?? '' }}</p>
                  <p class="font-bold text-neutral-900 dark:text-neutral-100">{{ $billingAddress['country'] }}</p>
                </dd>
              </div>
            </div>
          </dl>
        </section>

      </div>
      {{-- / left column --}}


      {{-- ── RIGHT COLUMN ──────────────────────────────────────── --}}

      {{-- Success / Pending: Ordered Items + Payment Breakdown --}}
      @if($demoStatus === 'success' || $demoStatus === 'pending')
      <section class="{{ $card }}" aria-labelledby="ordered-items-heading">

        {{-- Items header --}}
        <div class="px-5 py-3 border-b {{ $divider }}">
          <h2 id="ordered-items-heading" class="text-sm font-bold text-neutral-900 dark:text-neutral-100">
            Ordered Items
            <span class="ml-1 font-normal text-xs text-neutral-500 dark:text-neutral-400">({{ $itemCount }} {{ Str::plural('item', $itemCount) }})</span>
          </h2>
        </div>

        {{-- Invoice column headers — $colHd applied to each cell (DRY) --}}
        <div class="flex items-center px-5 py-2 bg-neutral-50 dark:bg-neutral-900/30 border-b {{ $divider }}">
          <div class="flex-1 {{ $colHd }}">Item</div>
          <div class="w-10 text-center {{ $colHd }}">Qty</div>
          <div class="hidden sm:block w-24 text-right {{ $colHd }}">Unit Price</div>
          <div class="w-24 text-right {{ $colHd }}">Total</div>
        </div>

        {{-- Product rows --}}
        <ul class="divide-y {{ $divider }}" role="list">
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
          <li class="flex items-center px-5 py-3 gap-3" role="listitem">
            {{-- Item: thumbnail + name --}}
            <div class="flex-1 flex items-center gap-3 min-w-0">
              <img src="{{ $pImg }}" alt="{{ $pName }}"
                   class="w-10 h-10 object-cover flex-shrink-0 bg-neutral-100 dark:bg-neutral-700 border {{ $divider }}"
                   loading="lazy" />
              <p class="text-sm font-medium text-neutral-900 dark:text-neutral-100 truncate min-w-0" title="{{ $pName }}">
                {{ $pName }}
              </p>
            </div>
            {{-- Qty --}}
            <div class="w-10 text-center text-sm text-neutral-600 dark:text-neutral-400 flex-shrink-0">
              {{ $pQty }}
            </div>
            {{-- Unit Price (hidden on mobile) --}}
            <div class="hidden sm:block w-24 text-right text-sm text-neutral-400 dark:text-neutral-500 flex-shrink-0">
              {{ App\Models\Product::convertPrice($pPrice) }}
            </div>
            {{-- Total --}}
            <div class="w-24 text-right text-sm font-bold text-primary-700 dark:text-primary-400 flex-shrink-0">
              {{ App\Models\Product::convertPrice($pTotal) }}
            </div>
          </li>
          @endforeach
        </ul>

        {{-- Payment Breakdown — values align with Total column via w-24 --}}
        <div class="bg-neutral-50 dark:bg-neutral-900/30 border-t {{ $divider }}">
          <div class="px-5 pt-4 pb-3 space-y-1.5">
            <p class="{{ $colHd }} mb-3">Payment Breakdown</p>
            @foreach($breakdown as $item)
            <div class="flex items-center text-sm">
              <dt class="flex-1 text-neutral-500 dark:text-neutral-400">{{ $item['label'] }}</dt>
              <dd class="w-24 text-right {{ $item['type'] === 'discount' ? 'text-semantic-success font-medium' : 'text-neutral-700 dark:text-neutral-300' }}">
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
          </div>

          {{-- Total Paid --}}
          <div class="flex items-center justify-between px-5 py-4 border-t {{ $divider }}">
            <span class="text-base font-bold text-neutral-900 dark:text-neutral-100">Total Paid</span>
            <span class="text-2xl font-bold text-neutral-900 dark:text-neutral-100">
              {{ App\Models\Product::convertPrice($paymentInfo['pay_amount']) }}
            </span>
          </div>
        </div>

        {{-- Pending notice --}}
        @if($demoStatus === 'pending')
        <div class="flex items-center gap-2 px-5 py-2.5 border-t {{ $divider }} bg-primary-50 dark:bg-primary-900/20" role="status">
          <svg class="w-4 h-4 text-primary-700 dark:text-primary-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            {!! $icons['info'] !!}
          </svg>
          <p class="text-xs text-primary-800 dark:text-primary-200">
            Payment verification is in progress. Email confirmation will follow.
          </p>
        </div>
        @endif

      </section>
      @endif

      {{-- Failed: What went wrong + Support --}}
      @if($demoStatus === 'failed')
      <div class="{{ $card }}" role="alert">

        {{-- Header --}}
        <div class="px-5 py-3 border-b {{ $divider }} bg-red-50 dark:bg-red-950/30 flex items-center gap-2">
          <svg class="w-4 h-4 text-semantic-error flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            {!! $icons['exclamation'] !!}
          </svg>
          <h2 class="text-sm font-bold text-semantic-error">What Went Wrong?</h2>
        </div>

        <div class="p-5 grid grid-cols-1 sm:grid-cols-2 gap-5">

          {{-- Common Reasons --}}
          <section>
            <h3 class="{{ $secHd }}">Common Reasons</h3>
            <ul class="space-y-2">
              @foreach(['Insufficient funds in your account', 'Incorrect card or UPI details', 'Card expired or blocked by bank', 'Network timeout during transaction'] as $reason)
              <li class="flex items-start gap-2 text-sm text-neutral-700 dark:text-neutral-300">
                <span class="w-1.5 h-1.5 bg-neutral-400 flex-shrink-0 mt-1.5"></span>
                {{ $reason }}
              </li>
              @endforeach
            </ul>
          </section>

          {{-- Support Contact --}}
          <section>
            <h3 class="{{ $secHd }}">Contact Support</h3>
            <div class="space-y-3">
              <a href="mailto:{{ $settings['support_email'] }}"
                 class="flex items-start gap-2 text-sm hover:underline">
                <svg class="{{ $iconSm }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">{!! $icons['email'] !!}</svg>
                <div>
                  <p class="{{ $lblRow }}">Email us</p>
                  <p class="text-primary-700 dark:text-primary-400 font-medium break-all">{{ $settings['support_email'] }}</p>
                </div>
              </a>
              <a href="tel:{{ $settings['support_phone'] }}"
                 class="flex items-start gap-2 text-sm hover:underline">
                <svg class="{{ $iconSm }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">{!! $icons['phone'] !!}</svg>
                <div>
                  <p class="{{ $lblRow }}">Call us</p>
                  <p class="text-primary-700 dark:text-primary-400 font-medium">{{ $settings['support_phone'] }}</p>
                </div>
              </a>
            </div>
          </section>

        </div>
      </div>
      @endif

    </div>{{-- / row 2 grid --}}


    {{-- Footer --}}
    <p class="text-center text-xs text-neutral-500 dark:text-neutral-400 pb-1">
      Have questions?
      <a href="mailto:{{ $settings['support_email'] }}"
         class="text-primary-700 dark:text-primary-400 hover:underline font-medium">
        Contact our support team
      </a>
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
