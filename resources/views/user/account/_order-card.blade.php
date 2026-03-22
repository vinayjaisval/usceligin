{{-- Order card partial — expects: $order (App\Models\Order) --}}
@php
  $cart              = json_decode($order->cart, true);
  $cartItems         = $cart['items'] ?? [];
  $refundDays        = config('order.refund_window_days', 5);
  $isRefundRequested = $order->status === 'refund_requested';
  $isCompleted       = $order->status === 'completed' || $isRefundRequested;
  $receivedAt        = $isCompleted ? $order->updated_at : null;
  $daysLeft          = ($isCompleted && !$isRefundRequested)
                        ? max(0, $refundDays - (int) $receivedAt->diffInDays(now()))
                        : null;
  $refundEligible    = ($order->status === 'completed') && $daysLeft > 0;
  $statusStep = match(true) {
    in_array($order->status, ['completed', 'refund_requested'])  => 4,
    in_array($order->status, ['on delivery','out for delivery']) => 3,
    in_array($order->status, ['processing','shipped'])           => 2,
    default                                                      => 1,
  };
@endphp
<div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden">

  {{-- Order Header --}}
  <div class="bg-gray-50 dark:bg-gray-900/40 border-b border-gray-200 dark:border-gray-700 px-4 sm:px-6 py-3">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
      <div class="flex flex-wrap gap-x-6 gap-y-1 text-xs uppercase tracking-wide">
        <div>
          <span class="text-gray-500 dark:text-gray-400">Order Placed</span>
          <p class="text-gray-900 dark:text-gray-100 font-medium normal-case text-sm mt-0.5">{{ $order->created_at->format('M d, Y') }}</p>
        </div>
        <div>
          <span class="text-gray-500 dark:text-gray-400">Total</span>
          <p class="text-gray-900 dark:text-gray-100 font-medium normal-case text-sm mt-0.5">{{ $order->currency_sign ?: '₹' }}{{ number_format($order->pay_amount, 2) }}</p>
        </div>
        <div>
          <span class="text-gray-500 dark:text-gray-400">Ship To</span>
          <p class="text-gray-900 dark:text-gray-100 font-medium normal-case text-sm mt-0.5">{{ $order->shipping_name ?: ($order->customer_name ?: Auth::user()->name) }}</p>
        </div>
        @if($isCompleted && $receivedAt)
          <div>
            <span class="text-gray-500 dark:text-gray-400">Delivered</span>
            <p class="text-gray-900 dark:text-gray-100 font-medium normal-case text-sm mt-0.5">{{ $receivedAt->format('M d, Y') }}</p>
          </div>
        @endif
      </div>
      <div class="text-right">
        <span class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">Order #</span>
        <p class="text-sm text-gray-900 dark:text-gray-100 font-medium">{{ $order->order_number }}</p>
      </div>
    </div>
  </div>

  {{-- Order Body --}}
  <div class="p-4 sm:p-6">

    {{-- Status Tracker --}}
    <div class="mb-6">
      <x-order-status-tracker :order="$order" :status-step="$statusStep" />
    </div>

    <div class="flex flex-col lg:flex-row gap-6">
      {{-- Products List --}}
      <div class="flex-1 space-y-4">
        @foreach($cartItems as $cartItem)
          <div class="flex gap-4">
            <div class="flex-shrink-0 w-16 h-16 sm:w-20 sm:h-20 bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 overflow-hidden">
              <x-product-image
                :photo="$cartItem['item']['photo'] ?? null"
                :thumbnail="$cartItem['item']['thumbnail'] ?? null"
                :name="$cartItem['item']['name'] ?? 'Product'" />
            </div>
            <div class="flex-1 min-w-0">
              <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100 line-clamp-2">
                {{ $cartItem['item']['name'] ?? 'Product' }}
                @if(($cartItem['qty'] ?? 1) > 1)
                  <span class="text-gray-600 dark:text-gray-400">({{ $cartItem['qty'] }})</span>
                @endif
              </h4>
              @if(!empty($cartItem['size']))
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Size: {{ str_replace('-', ' ', $cartItem['size']) }}</p>
              @endif
              @if(!empty($cartItem['color']))
                <div class="flex items-center gap-1 mt-0.5">
                  <span class="text-xs text-gray-500 dark:text-gray-400">Color:</span>
                  <span class="w-3 h-3 border border-gray-300 dark:border-gray-600"
                        style="background-color: #{{ $cartItem['color'] }}"
                        aria-label="{{ $cartItem['color'] }} colour swatch"></span>
                </div>
              @endif
              <p class="text-sm font-semibold text-gray-900 dark:text-gray-100 mt-1">
                {{ $order->currency_sign ?: '₹' }}{{ number_format(($cartItem['item_price'] ?? $cartItem['item']['price'] ?? 0) * ($order->currency_value ?? 1), 2) }}
              </p>
              @if(!empty($cartItem['item']['id']))
                <button type="button"
                  onclick="addToCart({{ $cartItem['item']['id'] }})"
                  aria-label="Buy {{ $cartItem['item']['name'] ?? 'this item' }} again"
                  class="inline-flex items-center gap-1.5 mt-2 px-3 py-1.5 border border-primary-200 dark:border-primary-700 text-xs font-medium text-primary-700 dark:text-primary-400 hover:bg-primary-100 dark:hover:bg-primary-900/20 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-600">
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                  Buy it again
                </button>
              @endif
            </div>
          </div>
        @endforeach
      </div>

      {{-- Order Actions --}}
      <div class="flex flex-col gap-2.5 lg:w-52 flex-shrink-0">

        {{-- 1. View Order Details — always active --}}
        <a href="{{ url('/user/order/' . $order->id) }}"
          class="w-full text-center px-4 py-2 bg-primary-800 text-white text-sm font-semibold hover:bg-primary-900 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-600">
          View Order Details
        </a>

        {{-- 2. Cancel Order --}}
        @if($order->status === 'pending')
          <button type="button" onclick="cancelOrder({{ $order->id }})"
            class="w-full text-center px-4 py-2 border border-red-400 dark:border-red-600 text-red-600 dark:text-red-400 text-sm font-medium hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
            Cancel Order
          </button>
        @elseif($order->status === 'declined')
          <button type="button" disabled
            class="w-full text-center px-4 py-2 bg-red-50 dark:bg-red-900/20 text-red-400 dark:text-red-500 text-sm font-medium cursor-not-allowed border border-red-200 dark:border-red-800">
            Order Cancelled
          </button>
        @else
          <button type="button" disabled
            class="w-full text-center px-4 py-2 bg-gray-100 dark:bg-gray-700/50 text-gray-400 dark:text-gray-500 text-sm font-medium cursor-not-allowed border border-gray-200 dark:border-gray-600">
            Cancellation Closed
          </button>
        @endif

        {{-- 3. Request Refund --}}
        @if($order->status === 'refunded')
          <button type="button" disabled
            class="w-full text-center px-4 py-2 bg-green-50 dark:bg-green-900/20 text-green-600 dark:text-green-400 text-sm font-semibold cursor-not-allowed border border-green-300 dark:border-green-700">
            Refund Processed
          </button>
        @elseif($isRefundRequested)
          <button type="button" disabled
            class="w-full text-center px-4 py-2 bg-amber-50 dark:bg-amber-900/20 text-amber-700 dark:text-amber-400 text-sm font-semibold cursor-not-allowed border border-amber-300 dark:border-amber-700">
            Refund Under Review
          </button>
        @elseif($refundEligible)
          <button type="button" onclick="requestRefund({{ $order->id }})"
            class="w-full text-center px-4 py-2 bg-red-600 text-white text-sm font-semibold hover:bg-red-700 transition-colors">
            Request Refund — {{ $daysLeft }}d left
          </button>
        @elseif($isCompleted)
          <button type="button" disabled
            class="w-full text-center px-4 py-2 bg-gray-100 dark:bg-gray-700/50 text-gray-400 dark:text-gray-500 text-sm font-medium cursor-not-allowed border border-gray-200 dark:border-gray-600">
            Refund Window Closed
          </button>
        @else
          <button type="button" disabled
            class="w-full text-center px-4 py-2 bg-gray-100 dark:bg-gray-700/50 text-gray-400 dark:text-gray-500 text-sm font-medium cursor-not-allowed border border-gray-200 dark:border-gray-600">
            Refund Request
          </button>
        @endif

        {{-- 4. View Invoice --}}
        <a href="{{ url('/user/print/order/print/' . $order->id) }}"
          class="w-full text-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
          View Invoice
        </a>

        {{-- 5. Return & Refund Policy --}}
        <a href="{{ route('front.return-refund-policy') }}"
          class="w-full text-center text-xs text-primary-700 dark:text-primary-400 hover:text-primary-900 transition-colors py-1 underline underline-offset-2">
          Return &amp; Refund Policy
        </a>

      </div>
    </div>
  </div>
</div>
