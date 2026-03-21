@extends('frontend.include.app')

@section('content')
<main id="main-content" role="main" class="bg-gray-50 dark:bg-gray-900 min-h-screen">
  <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-8">

    {{-- Breadcrumb --}}
    @include('frontend.include.breadcrumb', ['items' => [
      ['label' => 'Home',       'url' => route('front.index')],
      ['label' => 'My Account', 'url' => route('user.account') . '#purchases'],
      ['label' => 'Order #' . $order->order_number],
    ]])

    {{-- Back link --}}
    <a href="{{ route('user.account') }}#purchases"
      class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400 hover:text-primary-700 dark:hover:text-primary-400 transition-colors mt-4 mb-6 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
      </svg>
      Back to Your Orders
    </a>

    @php
      $refundDays        = config('order.refund_window_days', 5);
      $currSign          = $order->currency_sign ?: '₹';
      $cartItems         = $cart['items'] ?? [];
      $isRefundRequested = $order->status === 'refund_requested';
      $isCompleted       = $order->status === 'completed' || $isRefundRequested;
      $receivedAt        = $isCompleted ? $order->updated_at : null;
      $daysLeft          = ($isCompleted && !$isRefundRequested)
                            ? max(0, $refundDays - (int) $receivedAt->diffInDays(now()))
                            : null;
      $refundEligible    = ($order->status === 'completed') && $daysLeft > 0;

      $statusStep = match(true) {
        in_array($order->status, ['completed', 'refund_requested'])  => 4,
        in_array($order->status, ['on delivery', 'out for delivery']) => 3,
        in_array($order->status, ['processing', 'shipped'])          => 2,
        default                                                       => 1,
      };
    @endphp

    {{-- Page Title --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
      <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Order Details</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Order #{{ $order->order_number }}</p>
      </div>
      <a href="{{ route('user-order-print', $order->id) }}" target="_blank" rel="noopener noreferrer"
        aria-label="Print order invoice — opens in new window"
        class="inline-flex items-center gap-1.5 px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-600">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
        </svg>
        Print Invoice
      </a>
    </div>

    {{-- Status Tracker --}}
    <section class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-5 sm:p-6 mb-5" aria-label="Order status">
      <h2 class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wide mb-5">Order Status</h2>
      <x-order-status-tracker :order="$order" :status-step="$statusStep" />

      @if($isRefundRequested)
        <div class="mt-5 p-3 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 text-sm text-amber-700 dark:text-amber-400"
             role="status" aria-live="polite">
          Your refund request is under review. Our team will get back to you within 1–2 business days.
        </div>
      @endif
    </section>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

      {{-- Left: Items + Shipping --}}
      <div class="lg:col-span-2 space-y-5">

        {{-- Order Items --}}
        <section class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700" aria-label="Ordered items">
          <div class="px-5 py-3.5 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/40">
            <h2 class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wide">
              Items <span aria-label="{{ count($cartItems) }} items">({{ count($cartItems) }})</span>
            </h2>
          </div>
          <ul class="divide-y divide-gray-100 dark:divide-gray-700/50" aria-label="Order items list">
            @foreach($cartItems as $cartItem)
              <li class="flex gap-4 p-4 sm:p-5">
                {{-- Image --}}
                <div class="flex-shrink-0 w-16 h-16 sm:w-20 sm:h-20 bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 overflow-hidden">
                  <x-product-image
                    :photo="$cartItem['item']['photo'] ?? null"
                    :thumbnail="$cartItem['item']['thumbnail'] ?? null"
                    :name="$cartItem['item']['name'] ?? 'Product'" />
                </div>

                {{-- Details --}}
                <div class="flex-1 min-w-0">
                  <h3 class="text-sm font-medium text-gray-900 dark:text-gray-100 line-clamp-2">
                    {{ $cartItem['item']['name'] ?? 'Product' }}
                  </h3>
                  <dl class="flex flex-wrap gap-x-4 gap-y-1 mt-1.5 text-xs text-gray-500 dark:text-gray-400">
                    @if(!empty($cartItem['size']))
                      <div class="flex gap-1"><dt>Size:</dt><dd>{{ str_replace('-', ' ', $cartItem['size']) }}</dd></div>
                    @endif
                    @if(!empty($cartItem['color']))
                      <div class="flex items-center gap-1">
                        <dt>Colour:</dt>
                        <dd>
                          <span class="w-3 h-3 inline-block border border-gray-300 dark:border-gray-600"
                                style="background-color: #{{ $cartItem['color'] }}"
                                aria-label="#{{ $cartItem['color'] }}"></span>
                        </dd>
                      </div>
                    @endif
                    <div class="flex gap-1"><dt>Qty:</dt><dd>{{ $cartItem['qty'] ?? 1 }}</dd></div>
                  </dl>
                  <p class="text-sm font-semibold text-gray-900 dark:text-gray-100 mt-2">
                    {{ $currSign }}{{ number_format(($cartItem['item_price'] ?? $cartItem['item']['price'] ?? 0) * ($order->currency_value ?? 1), 2) }}
                  </p>
                </div>

                {{-- View product link --}}
                @if(!empty($cartItem['item']['id']))
                  @php $prod = App\Models\Product::find($cartItem['item']['id']); @endphp
                  @if($prod)
                    <div class="flex-shrink-0">
                      <a href="{{ route('front.product', $prod->slug) }}"
                         aria-label="View {{ $cartItem['item']['name'] ?? 'product' }} page"
                         class="text-xs text-primary-700 dark:text-primary-400 hover:underline focus:outline-none focus:ring-2 focus:ring-primary-600">
                        View Product
                      </a>
                    </div>
                  @endif
                @endif
              </li>
            @endforeach
          </ul>
        </section>

        {{-- Shipping & Payment --}}
        <section class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700" aria-label="Delivery and payment information">
          <div class="px-5 py-3.5 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/40">
            <h2 class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wide">Delivery Address</h2>
          </div>
          <div class="p-5 grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
              <h3 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-2">Ship To</h3>
              <address class="not-italic text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                <span class="block font-medium text-gray-900 dark:text-gray-100">{{ $address->name ?: $order->customer_name }}</span>
                @if($address->phone ?: $order->customer_phone)
                  <span class="block mt-0.5">{{ $address->phone ?: $order->customer_phone }}</span>
                @endif
                <span class="block mt-1">
                  {{ $address->address_line_1 ?: $order->customer_address }}
                  @if($address->city ?: $order->customer_city)
                    <br>{{ $address->city ?: $order->customer_city }}{{ ($address->state ?: $order->customer_state) ? ', ' . ($address->state ?: $order->customer_state) : '' }}{{ ($address->pincode ?: $order->customer_zip) ? ' – ' . ($address->pincode ?: $order->customer_zip) : '' }}
                  @endif
                  @if($order->shipping_country ?: $order->customer_country)
                    <br>{{ $order->shipping_country ?: $order->customer_country }}
                  @endif
                </span>
              </address>
            </div>
            <div>
              <h3 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-2">Payment</h3>
              <dl class="text-sm space-y-1">
                <div class="flex gap-2">
                  <dt class="text-gray-500 dark:text-gray-400">Method:</dt>
                  <dd class="font-medium text-gray-900 dark:text-gray-100 capitalize">{{ $order->method == 9 ? 'Online Payment' : 'Cash on Delivery' }}</dd>
                </div>
                <div class="flex gap-2">
                  <dt class="text-gray-500 dark:text-gray-400">Status:</dt>
                  <dd class="font-medium capitalize {{ $order->payment_status === 'paid' ? 'text-green-600 dark:text-green-400' : 'text-yellow-600 dark:text-yellow-400' }}">
                    {{ $order->payment_status ?: 'Pending' }}
                  </dd>
                </div>
                @if($order->txnid)
                  <div class="flex gap-2">
                    <dt class="text-gray-500 dark:text-gray-400">Txn ID:</dt>
                    <dd class="font-mono text-xs text-gray-600 dark:text-gray-400 break-all">{{ $order->txnid }}</dd>
                  </div>
                @endif
              </dl>
            </div>
          </div>
        </section>

        {{-- Tracking --}}
        @if($order->third_party_delivery_tracking_id)
          <section class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-5" aria-label="Shipment tracking">
            <h2 class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wide mb-3">Tracking</h2>
            <dl class="text-sm">
              <div class="flex gap-2">
                <dt class="text-gray-500 dark:text-gray-400">Tracking ID:</dt>
                <dd class="font-mono font-medium text-gray-900 dark:text-gray-100">{{ $order->third_party_delivery_tracking_id }}</dd>
              </div>
            </dl>
            <a href="{{ route('user-order-track-search', $order->id) }}"
               class="inline-flex items-center gap-1.5 mt-3 text-sm text-primary-700 dark:text-primary-400 hover:underline font-medium focus:outline-none focus:ring-2 focus:ring-primary-600">
              Track Shipment
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
              </svg>
            </a>
          </section>
        @endif

      </div>

      {{-- Right: Summary + Info + Actions --}}
      <div class="space-y-5">

        {{-- Order Summary --}}
        <section class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700" aria-label="Order price summary">
          <div class="px-5 py-3.5 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/40">
            <h2 class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wide">Order Summary</h2>
          </div>
          <dl class="p-5 space-y-2.5 text-sm">
            @php
              $subtotal = $order->pay_amount
                - ($order->shipping_cost ?? 0)
                - ($order->packing_cost ?? 0)
                + ($order->coupon_discount ?? 0)
                + ($order->wallet_price ?? 0)
                + ($order->refferal_discount ?? 0);
            @endphp
            <div class="flex justify-between">
              <dt class="text-gray-600 dark:text-gray-400">Subtotal</dt>
              <dd>{{ $currSign }}{{ number_format($subtotal, 2) }}</dd>
            </div>
            @if(($order->shipping_cost ?? 0) > 0)
              <div class="flex justify-between">
                <dt class="text-gray-600 dark:text-gray-400">Shipping{{ $order->shipping_title ? ' (' . $order->shipping_title . ')' : '' }}</dt>
                <dd>{{ $currSign }}{{ number_format($order->shipping_cost, 2) }}</dd>
              </div>
            @endif
            @if(($order->packing_cost ?? 0) > 0)
              <div class="flex justify-between">
                <dt class="text-gray-600 dark:text-gray-400">Packing{{ $order->packing_title ? ' (' . $order->packing_title . ')' : '' }}</dt>
                <dd>{{ $currSign }}{{ number_format($order->packing_cost, 2) }}</dd>
              </div>
            @endif
            @if(($order->coupon_discount ?? 0) > 0)
              <div class="flex justify-between text-green-600 dark:text-green-400">
                <dt>Coupon ({{ $order->coupon_code }})</dt>
                <dd>− {{ $currSign }}{{ number_format($order->coupon_discount, 2) }}</dd>
              </div>
            @endif
            @if(($order->wallet_price ?? 0) > 0)
              <div class="flex justify-between text-green-600 dark:text-green-400">
                <dt>Wallet</dt>
                <dd>− {{ $currSign }}{{ number_format($order->wallet_price, 2) }}</dd>
              </div>
            @endif
            @if(($order->refferal_discount ?? 0) > 0)
              <div class="flex justify-between text-green-600 dark:text-green-400">
                <dt>Referral Discount</dt>
                <dd>− {{ $currSign }}{{ number_format($order->refferal_discount, 2) }}</dd>
              </div>
            @endif
            <div class="border-t border-gray-200 dark:border-gray-700 pt-2.5 flex justify-between font-bold text-gray-900 dark:text-gray-100">
              <dt>Total</dt>
              <dd>{{ $currSign }}{{ number_format($order->pay_amount, 2) }}</dd>
            </div>
          </dl>
        </section>

        {{-- Order Info --}}
        <section class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-5" aria-label="Order information">
          <h2 class="sr-only">Order Information</h2>
          <dl class="space-y-3 text-sm">
            <div class="flex justify-between">
              <dt class="text-gray-500 dark:text-gray-400">Order Placed</dt>
              <dd class="font-medium text-gray-900 dark:text-gray-100">
                <time datetime="{{ $order->created_at->toDateString() }}">{{ $order->created_at->format('M d, Y') }}</time>
              </dd>
            </div>
            <div class="flex justify-between">
              <dt class="text-gray-500 dark:text-gray-400">Status</dt>
              <dd class="font-medium capitalize
                @if(in_array($order->status, ['completed', 'refund_requested'])) text-green-600 dark:text-green-400
                @elseif($order->status === 'declined') text-red-600 dark:text-red-400
                @elseif(in_array($order->status, ['processing', 'shipped', 'on delivery', 'out for delivery'])) text-blue-600 dark:text-blue-400
                @else text-yellow-600 dark:text-yellow-400
                @endif">
                @if($isRefundRequested) Refund Requested
                @else {{ ucfirst($order->status) }}
                @endif
              </dd>
            </div>
            @if($isCompleted && $receivedAt)
              <div class="flex justify-between">
                <dt class="text-gray-500 dark:text-gray-400">Delivered</dt>
                <dd class="font-medium text-gray-900 dark:text-gray-100">
                  <time datetime="{{ $receivedAt->toDateString() }}">{{ $receivedAt->format('M d, Y') }}</time>
                </dd>
              </div>
            @endif
            <div class="flex justify-between">
              <dt class="text-gray-500 dark:text-gray-400">Items</dt>
              <dd class="font-medium text-gray-900 dark:text-gray-100">{{ $order->totalQty }}</dd>
            </div>
          </dl>
        </section>

        {{-- Actions --}}
        <div class="space-y-2" role="group" aria-label="Order actions">

          {{-- Refund Request --}}
          @if($isRefundRequested)
            <button type="button" disabled
              class="w-full text-center px-4 py-2.5 bg-amber-50 dark:bg-amber-900/20 text-amber-700 dark:text-amber-400 text-sm font-semibold cursor-not-allowed border border-amber-300 dark:border-amber-700">
              Refund Under Review
            </button>
          @elseif($refundEligible)
            <button type="button"
              onclick="requestRefund()"
              aria-label="Request refund for order #{{ $order->order_number }}"
              class="w-full text-center px-4 py-2.5 bg-red-600 text-white text-sm font-semibold hover:bg-red-700 transition-colors focus:outline-none focus:ring-2 focus:ring-red-500">
              Request Refund &mdash; {{ $daysLeft }}d left
            </button>
          @elseif($isCompleted)
            <button type="button" disabled
              class="w-full text-center px-4 py-2.5 bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500 text-sm font-medium cursor-not-allowed border border-gray-200 dark:border-gray-600">
              Refund Window Closed
            </button>
          @else
            <button type="button" disabled
              class="w-full text-center px-4 py-2.5 bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500 text-sm font-medium cursor-not-allowed border border-gray-200 dark:border-gray-600">
              Refund After Delivery
            </button>
          @endif

          {{-- Return & Refund Policy --}}
          <a href="{{ route('front.return-refund-policy') }}"
             class="block w-full text-center text-xs text-gray-500 dark:text-gray-400 hover:text-primary-700 dark:hover:text-primary-400 transition-colors py-1 underline underline-offset-2 focus:outline-none focus:ring-2 focus:ring-primary-600">
            Return &amp; Refund Policy
          </a>
        </div>

      </div>
    </div>

  </div>
</main>

{{-- Refund confirmation dialog --}}
<dialog id="refund-dialog" aria-labelledby="refund-dialog-title" aria-describedby="refund-dialog-desc"
  class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 max-w-sm w-full shadow-xl backdrop:bg-black/40">
  <h2 id="refund-dialog-title" class="text-base font-bold text-gray-900 dark:text-gray-100 mb-2">Request Refund?</h2>
  <p id="refund-dialog-desc" class="text-sm text-gray-600 dark:text-gray-400 mb-5">
    Our team will review your request within 1–2 business days. You cannot undo this action.
  </p>
  <div class="flex gap-3 justify-end">
    <button type="button" id="refund-cancel"
      class="px-4 py-2 text-sm font-medium border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-400">
      Cancel
    </button>
    <button type="button" id="refund-confirm"
      class="px-4 py-2 text-sm font-semibold bg-red-600 text-white hover:bg-red-700 transition-colors focus:outline-none focus:ring-2 focus:ring-red-500">
      Yes, Request Refund
    </button>
  </div>
</dialog>

<script>
  (function () {
    const dialog      = document.getElementById('refund-dialog');
    const cancelBtn   = document.getElementById('refund-cancel');
    const confirmBtn  = document.getElementById('refund-confirm');
    const csrfToken   = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const refundUrl   = '{{ route("user.order.refund-request", ["id" => $order->id]) }}';
    let triggerBtn    = null;

    function requestRefund() {
      triggerBtn = document.querySelector('[onclick="requestRefund()"]');
      dialog.showModal();
      cancelBtn.focus();
    }

    cancelBtn.addEventListener('click', function () { dialog.close(); });

    dialog.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') dialog.close();
    });

    confirmBtn.addEventListener('click', function () {
      dialog.close();
      if (triggerBtn) { triggerBtn.disabled = true; triggerBtn.textContent = 'Submitting…'; }

      fetch(refundUrl, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
      })
      .then(r => r.json())
      .then(data => {
        if (data.success) {
          window.location.reload();
        } else {
          if (triggerBtn) { triggerBtn.disabled = false; triggerBtn.textContent = 'Request Refund — {{ $daysLeft }}d left'; }
          alert(data.error || 'Failed to submit refund request.');
        }
      })
      .catch(function () {
        if (triggerBtn) { triggerBtn.disabled = false; triggerBtn.textContent = 'Request Refund — {{ $daysLeft }}d left'; }
        alert('An error occurred. Please try again.');
      });
    });

    window.requestRefund = requestRefund;
  }());
</script>
@endsection
