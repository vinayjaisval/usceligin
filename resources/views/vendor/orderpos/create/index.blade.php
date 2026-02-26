@extends('layouts.vendor-frontend')

@section('page-title', 'POS — Sell Product')

@section('styles')
<link href="{{ asset('assets/admin/css/jquery-ui.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<style>
  /* ── CSS custom properties ────────────────────────────────── */
  :root {
    --pos-orange: #EA580C;
    --pos-orange-rgb: 234,88,12;
    --pos-green: #16a34a;
  }

  /* ── Product Card ─────────────────────────────────────────── */
  .product-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    transition: border-color .2s, box-shadow .2s, transform .2s;
    cursor: pointer;
    position: relative;
  }
  @media (prefers-reduced-motion: reduce) {
    .product-card { transition: border-color .2s; }
    .product-card .card-img img { transition: none; }
  }
  .product-card:hover {
    border-color: var(--pos-orange);
    box-shadow: 0 8px 24px -4px rgba(var(--pos-orange-rgb),.15);
    transform: translateY(-2px);
  }
  .product-card .card-img {
    aspect-ratio: 1/1;
    overflow: hidden;
    background: #f9fafb;
    flex-shrink: 0;
  }
  .product-card .card-img img {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform .35s ease;
  }
  .product-card:hover .card-img img { transform: scale(1.07); }
  .product-card .card-body {
    padding: 10px 10px 6px;
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 4px;
  }
  .product-card .card-name {
    font-size: 12px;
    font-weight: 500;
    color: #111827;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    line-height: 1.4;
    min-height: 33px;
  }
  .product-card .card-price {
    font-size: 13px;
    font-weight: 700;
    color: var(--pos-orange);
  }
  .product-card .card-add {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 8px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    border-top: 1px solid #f3f4f6;
    background: #f9fafb;
    color: #374151;
    transition: background .15s, color .15s;
    cursor: pointer;
    border: none;
    width: 100%;
  }
  .product-card .card-add .material-icons-outlined { font-size: 14px; }
  .product-card:hover .card-add { background: var(--pos-orange); color: #fff; border-top-color: var(--pos-orange); }
  /* Added-to-cart badge */
  .product-card .added-badge {
    position: absolute; top: 8px; right: 8px;
    background: var(--pos-green); color: #fff;
    font-size: 10px; font-weight: 700;
    padding: 2px 7px; display: none;
  }
  .product-card.in-cart .added-badge { display: block; }
  .product-card.in-cart { border-color: var(--pos-green); }
  .product-card.in-cart .card-add { background: #f0fdf4; color: var(--pos-green); border-top-color: #bbf7d0; }
  .product-card:hover.in-cart .card-add { background: var(--pos-green); color: #fff; }

  /* ── Dark mode: Product Card ──────────────────────────────── */
  .dark .product-card { background: #1f2937; border-color: #374151; }
  .dark .product-card:hover { border-color: var(--pos-orange); }
  .dark .product-card .card-img { background: #374151; }
  .dark .product-card .card-name { color: #f3f4f6; }
  .dark .product-card .card-price { color: #fb923c; }
  .dark .product-card .card-add { background: #374151; color: #d1d5db; border-top-color: #4b5563; }
  .dark .product-card:hover .card-add { background: var(--pos-orange); color: #fff; }
  .dark .product-card.in-cart { border-color: var(--pos-green); }
  .dark .product-card.in-cart .card-add { background: #052e16; color: #4ade80; border-top-color: #166534; }
  .dark .product-card:hover.in-cart .card-add { background: var(--pos-green); color: #fff; }

  /* ── Skeleton loader ──────────────────────────────────────── */
  .skeleton { animation: pulse 1.5s infinite; background: #f3f4f6; }
  .dark .skeleton { background: #374151; }
  @keyframes pulse { 0%,100%{opacity:1} 50%{opacity:.5} }
  @media (prefers-reduced-motion: reduce) { .skeleton { animation: none; } }

  /* ── Pagination ───────────────────────────────────────────── */
  .page-btn {
    min-width: 32px; height: 32px;
    display: inline-flex; align-items: center; justify-content: center;
    font-size: 12px; font-weight: 500;
    border: 1px solid #e5e7eb;
    color: #374151;
    transition: all .15s;
    cursor: pointer;
  }
  .page-btn .material-icons-outlined { font-size: 16px; }
  .page-ellipsis { border: none; color: #9ca3af; cursor: default; }
  .dark .page-btn { border-color: #4b5563; color: #d1d5db; }
  .page-btn:hover:not(:disabled) { border-color: var(--pos-orange); color: var(--pos-orange); }
  .page-btn.active { background: var(--pos-orange); border-color: var(--pos-orange); color: #fff; }
  .page-btn:disabled { opacity: .35; cursor: default; }

  /* ── Select2 ──────────────────────────────────────────────── */
  .select2-container--default .select2-selection--single {
    border: 1px solid #e5e7eb; border-radius: 0; height: 40px;
  }
  .select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 38px; padding-left: 12px; font-size: 13px; color: #374151;
  }
  .select2-container--default .select2-selection--single .select2-selection__arrow { height: 38px; }
  .select2-dropdown { border-radius: 0 !important; }

  /* ── Form inputs ──────────────────────────────────────────── */
  .pos-input {
    width: 100%;
    border: 1px solid #e5e7eb;
    background: #fff;
    color: #111827;
    padding: 10px 12px;
    font-size: 13px;
    outline: none;
    transition: border-color .15s;
  }
  .pos-input:focus { border-color: var(--pos-orange); box-shadow: 0 0 0 3px rgba(var(--pos-orange-rgb),.08); }
  .pos-input.readonly-field { background: #f9fafb; color: #6b7280; cursor: not-allowed; }
  .pos-label {
    display: block;
    font-size: 11px;
    font-weight: 600;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 5px;
  }
</style>
@endsection

@section('content')
@php
  $hasCart      = Session::has('admin_cart');
  $posCart      = $hasCart ? Session::get('admin_cart') : null;
  $hasAddress   = Session::has('order_address');
  $savedAddr    = $hasAddress ? Session::get('order_address') : null;
  $posSubtotal  = $hasCart ? $posCart->totalPrice : 0;
  $posShipping  = ($hasCart && $hasAddress)
                    ? (($savedAddr['shipping_cost'] ?? 0) * ($savedAddr['totalqty'] ?? 1))
                    : null;
  $posTotal     = $posSubtotal + ($posShipping ?? 0);
  $posItemCount = $hasCart ? count($posCart->items) : 0;
  $currSign     = $sign?->sign ?? '₹';
  $price        = fn($v) => App\Models\Product::convertPrice($v);
@endphp
<div class="space-y-5">

  {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
       HEADER
  ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
  <div class="flex items-center justify-between flex-wrap gap-3">
    <div>
      <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100 tracking-tight">POS — Sell Product</h1>
    </div>
    <div class="flex items-center gap-2">
      <div id="cart-count-badge" class="hidden items-center gap-2 px-3 py-2 bg-green-50 border border-green-200 text-green-700 text-sm font-semibold"
        role="status" aria-live="polite" aria-atomic="true">
        <span class="material-icons-outlined text-base" aria-hidden="true">shopping_cart</span>
        <span id="badge-count">0</span><span class="sr-only"> products</span> in cart
      </div>
      <a href="{{ route('vendor-order-index') }}"
         class="inline-flex items-center gap-1.5 px-3 py-2 border border-gray-300 dark:border-gray-600 text-gray-600 dark:text-gray-300 text-sm hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
        <span class="material-icons-outlined text-sm">arrow_back</span>
        Orders
      </a>
    </div>
  </div>

  {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
       STEP 1 — PRODUCT GRID
  ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
  <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">

    <!-- Section Header -->
    <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between gap-4 flex-wrap">
      <div class="flex items-center gap-3">
        <span class="flex items-center justify-center w-7 h-7 bg-primary-600 text-white text-xs font-bold flex-shrink-0">1</span>
        <div>
          <h2 class="text-sm font-bold text-gray-900 dark:text-gray-100">Select Products</h2>
          <p class="text-xs text-gray-500 dark:text-gray-400">Click a product card to add it to the cart</p>
        </div>
      </div>
      <!-- Search -->
      <div class="relative flex-1 max-w-xs">
        <label for="product-search" class="sr-only">Search products</label>
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" aria-hidden="true">
          <span class="material-icons-outlined text-base">search</span>
        </span>
        <input type="search" id="product-search"
          class="w-full border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 pl-9 pr-3 py-2 text-sm focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/10"
          placeholder="Search products…"
          aria-label="Search products">
      </div>
    </div>

    <!-- Product Grid -->
    <div class="p-5">
      <div id="product-grid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 xl:grid-cols-5 gap-3">
        {{-- Skeleton placeholders --}}
        @for($i = 0; $i < 10; $i++)
        <div class="border border-gray-100 overflow-hidden">
          <div class="skeleton aspect-square"></div>
          <div class="p-3 space-y-2">
            <div class="skeleton h-3 w-3/4"></div>
            <div class="skeleton h-3 w-1/2"></div>
            <div class="skeleton h-8 w-full mt-2"></div>
          </div>
        </div>
        @endfor
      </div>
    </div>

    <!-- Pagination -->
    <div class="px-5 pb-4 flex items-center justify-between flex-wrap gap-3">
      <span id="product-count-text" class="text-xs text-gray-400"></span>
      <div id="product-pagination" class="flex items-center gap-1"></div>
    </div>

  </div>

  {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
       STEP 2 (left) + UNIFIED ORDER PANEL (right)
  ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 items-start">

    {{-- ─── LEFT: STEP 2 CUSTOMER DETAILS (2/3) ──────────────── --}}
    <div class="lg:col-span-2">
      <form action="{{ route('vendor-order-create-submit', ['method' => 'cod']) }}" method="POST" id="pos-form">
        @csrf
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">

          <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center gap-3">
            <span class="flex items-center justify-center w-7 h-7 bg-primary-600 text-white text-xs font-bold flex-shrink-0">2</span>
            <div>
              <h2 class="text-sm font-bold text-gray-900 dark:text-gray-100">Customer Details</h2>
              <p class="text-xs text-gray-500 dark:text-gray-400">Select existing or fill in manually</p>
            </div>
            @if($hasAddress)
            <span class="ml-auto inline-flex items-center gap-1 text-xs text-green-600 dark:text-green-400 font-medium">
              <span class="material-icons-outlined text-sm">check_circle</span>Saved
            </span>
            @endif
          </div>

          <div class="p-5 space-y-5" id="customer-form-body">

            <!-- Existing Customer Dropdown -->
            <div>
              <label class="pos-label">
                <span class="material-icons-outlined text-xs align-middle">manage_search</span>
                Existing Customer <span class="font-normal text-gray-400 normal-case">(optional — auto-fills form)</span>
              </label>
              <select name="user_id" id="order_create_user" class="order_create_user w-full">
                <option value="">— New / Walk-in Customer —</option>
                @foreach(App\Models\User::where('seller_id', Auth::user()->id)->get() as $usr)
                  <option value="{{ $usr->id }}"
                    {{ $hasAddress && ($savedAddr['user_id'] ?? '') == $usr->id ? 'selected' : '' }}>
                    {{ $usr->name }} · {{ $usr->phone }}
                  </option>
                @endforeach
              </select>
            </div>

            <!-- Divider -->
            <div class="flex items-center gap-3">
              <div class="flex-1 border-t border-gray-100 dark:border-gray-700"></div>
              <span class="text-xs text-gray-400 uppercase tracking-wider">Contact Info</span>
              <div class="flex-1 border-t border-gray-100 dark:border-gray-700"></div>
            </div>

            <!-- Address Form -->
            <div id="order_create_user_address">
              @include('vendor.orderpos.create.address_form')
            </div>

            <!-- Save CTA -->
            <div class="pt-2">
              <button type="submit"
                class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-primary-600 hover:bg-primary-700 text-white text-sm font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500">
                <span class="material-icons-outlined text-base">check_circle</span>
                Save Customer Details
              </button>
              @if($hasAddress)
              <p class="flex items-center gap-1.5 justify-center text-xs text-green-600 dark:text-green-400 mt-2">
                <span class="material-icons-outlined text-sm">check_circle</span>
                Details saved — select payment mode on the right
              </p>
              @else
              <p class="text-center text-xs text-gray-400 dark:text-gray-500 mt-2">
                Save to unlock payment &amp; place order
              </p>
              @endif
            </div>

          </div>
        </div>
      </form>
    </div>

    {{-- ─── RIGHT: UNIFIED ORDER PANEL Steps 3–6 (1/3) ───────── --}}
    <div class="lg:col-span-1">
      {{-- Panel is sticky on desktop with internal scrolling for cart items --}}
      <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 flex flex-col
                  lg:sticky lg:top-24 lg:max-h-[calc(100vh-7rem)] lg:overflow-hidden">

        {{-- ── Step 3: Cart header (always visible) ── --}}
        <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700 flex-shrink-0 flex items-center justify-between">
          <div class="flex items-center gap-2">
            <span class="flex items-center justify-center w-6 h-6 bg-primary-600 text-white text-xs font-bold flex-shrink-0">3</span>
            <span class="text-sm font-bold text-gray-900 dark:text-gray-100">Cart</span>
            @if($hasCart)
            <span id="panel-cart-count"
              class="inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-primary-600 rounded-full">{{ $posItemCount }}</span>
            @else
            <span id="panel-cart-count"
              class="hidden inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-primary-600 rounded-full">0</span>
            @endif
          </div>
          <span class="text-xs text-gray-400 dark:text-gray-500">Add from Step 1 ↑</span>
        </div>

        {{-- ── Cart items: scrollable, takes remaining space ── --}}
        <div id="view_table_order" class="flex-1 min-h-[80px] overflow-y-auto">
          @include('vendor.orderpos.create.product_add_table')
        </div>

        @if($hasCart)

        {{-- ── Step 4: Order Summary (compact, always pinned) ── --}}
        <div class="border-t border-gray-200 dark:border-gray-700 flex-shrink-0 px-4 pt-3 pb-2">
          <div class="flex items-center gap-2 mb-2.5">
            <span class="flex items-center justify-center w-6 h-6 bg-primary-600 text-white text-xs font-bold flex-shrink-0">4</span>
            <span class="text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wide">Summary</span>
          </div>

          {{-- Promo code (always visible, no toggle) --}}
          <div class="flex gap-1.5 mb-1.5">
            <input type="text" id="pos-coupon-code" placeholder="Promo / coupon code"
              class="flex-1 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-2.5 py-1.5 text-xs focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500/30">
            <button type="button" id="pos-apply-coupon"
              class="flex-shrink-0 px-3 py-1.5 bg-primary-600 hover:bg-primary-700 text-white text-xs font-semibold transition-colors">
              Apply
            </button>
          </div>
          <div class="flex items-center justify-between min-h-[18px]">
            <button type="button" id="pos-remove-coupon" class="hidden text-xs text-red-500 hover:underline">× Remove</button>
            <p id="pos-coupon-msg" class="text-xs"></p>
          </div>

          {{-- Line items --}}
          <div class="space-y-1.5 text-xs mt-1.5">
            <div class="flex items-center justify-between">
              <span class="text-gray-500 dark:text-gray-400">
                Subtotal <span class="text-gray-400 dark:text-gray-500">({{ $posItemCount }} {{ $posItemCount === 1 ? 'item' : 'items' }})</span>
              </span>
              <span class="font-medium text-gray-900 dark:text-gray-100">{{ $price($posSubtotal) }}</span>
            </div>
            <div class="flex items-center justify-between">
              <span class="text-gray-500 dark:text-gray-400">Shipping</span>
              <span>
                @if($posShipping === null)
                  <span class="text-gray-400 dark:text-gray-500 italic">Save address</span>
                @elseif($posShipping == 0)
                  <span class="text-green-600 font-semibold">FREE</span>
                @else
                  <span class="text-gray-900 dark:text-gray-100 font-medium">{{ $price($posShipping) }}</span>
                @endif
              </span>
            </div>
            <div id="pos-discount-row" class="hidden flex items-center justify-between">
              <span class="text-gray-500 dark:text-gray-400">Discount</span>
              <span class="text-green-600 font-medium" id="pos-discount-label">−₹0</span>
            </div>
          </div>

          {{-- Total --}}
          <div class="flex items-center justify-between pt-2 mt-1.5 border-t border-gray-200 dark:border-gray-700">
            <span class="text-sm font-bold text-gray-900 dark:text-gray-100">Total</span>
            <span class="text-sm font-bold text-gray-900 dark:text-gray-100" id="pos-total-display">
              {{ $price($posTotal) }}
            </span>
          </div>

          {{-- Hidden JS state inputs --}}
          <input type="hidden" id="pos-subtotal-val" value="{{ $posSubtotal }}">
          <input type="hidden" id="pos-shipping-val" value="{{ $posShipping ?? 0 }}">
          <input type="hidden" id="pos-coupon-val"   value="0">
          <input type="hidden" id="pos-total-val"    value="{{ $posTotal }}">
          <input type="hidden" id="pos-currency-sign" value="{{ $currSign }}">
        </div>

        {{-- ── Step 5: Payment Mode (compact 2-column, locked until address saved) ── --}}
        <div class="border-t border-gray-200 dark:border-gray-700 flex-shrink-0 px-4 py-2.5
                    {{ !$hasAddress ? 'opacity-50 pointer-events-none select-none' : '' }}">
          <div class="flex items-center gap-2 mb-2">
            <span class="flex items-center justify-center w-6 h-6 {{ $hasAddress ? 'bg-primary-600' : 'bg-gray-300 dark:bg-gray-600' }} text-white text-xs font-bold flex-shrink-0">5</span>
            <span class="text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wide">Payment</span>
            @if(!$hasAddress)
            <span class="ml-auto text-xs text-amber-500 dark:text-amber-400 flex items-center gap-0.5">
              <span class="material-icons-outlined text-xs">lock</span> Save address first
            </span>
            @endif
          </div>
          <div class="grid grid-cols-2 gap-2" id="payment-options">
            <label class="pos-pay-opt flex items-center gap-2 p-2.5 border-2 border-primary-500 bg-primary-50 dark:bg-primary-900/20 cursor-pointer" data-method="cod">
              <input type="radio" name="pos_payment_method" value="cod" class="accent-primary-600 flex-shrink-0" checked>
              <div class="min-w-0">
                <div class="text-xs font-semibold text-gray-900 dark:text-gray-100 leading-tight">COD / UPI</div>
                <div class="text-xs text-gray-400 dark:text-gray-500 leading-tight mt-0.5">Pay on delivery</div>
              </div>
            </label>
            <label class="pos-pay-opt flex items-center gap-2 p-2.5 border border-gray-200 dark:border-gray-600 cursor-pointer" data-method="online">
              <input type="radio" name="pos_payment_method" value="online" class="accent-primary-600 flex-shrink-0">
              <div class="min-w-0">
                <div class="text-xs font-semibold text-gray-900 dark:text-gray-100 leading-tight">Online</div>
                <div class="text-xs text-gray-400 dark:text-gray-500 leading-tight mt-0.5">Razorpay</div>
              </div>
            </label>
          </div>
        </div>

        {{-- ── Step 6: Place Order (always pinned at bottom) ── --}}
        <div class="border-t border-gray-200 dark:border-gray-700 flex-shrink-0 px-4 py-3">
          @if($hasAddress)
          <form method="GET" action="{{ route('vendor-order-create-submit') }}" id="order-submit-form">
            <input type="hidden" name="coupon_discount" id="form-coupon"   value="0">
            <input type="hidden" name="shipping_cost"   id="form-shipping" value="{{ $posShipping }}">
            <input type="hidden" name="total"           id="form-total"    value="{{ $posTotal }}">
            <input type="hidden" name="payment_method"  id="form-payment"  value="cod">
            <button type="submit" id="place-order-btn"
              class="w-full flex items-center justify-center gap-2 py-3 bg-primary-700 hover:bg-primary-800 text-white text-sm font-bold transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500">
              <span class="material-icons-outlined text-base" aria-hidden="true">shopping_bag</span>
              Place Order
              <span class="opacity-50 font-light mx-0.5">·</span>
              <span id="pos-final-total">{{ $price($posTotal) }}</span>
            </button>
          </form>
          @else
          <button type="button" disabled
            class="w-full flex items-center justify-center gap-2 py-3 bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500 text-sm font-semibold cursor-not-allowed">
            <span class="material-icons-outlined text-base">lock</span>
            Save address to place order
          </button>
          @endif
          <p class="text-center text-xs text-gray-400 dark:text-gray-500 mt-2 leading-relaxed">
            By ordering you accept our
            <a href="#" class="underline hover:text-primary-600 dark:hover:text-primary-400">terms</a> &amp;
            <a href="#" class="underline hover:text-primary-600 dark:hover:text-primary-400">privacy</a>
          </p>
        </div>

        @else {{-- empty cart --}}
        <div class="flex-1 flex flex-col items-center justify-center p-8 text-center">
          <span class="material-icons-outlined text-4xl text-gray-200 dark:text-gray-700 mb-2">receipt_long</span>
          <p class="text-xs font-medium text-gray-400 dark:text-gray-500">Add products &amp; save customer details</p>
          <p class="text-xs text-gray-300 dark:text-gray-600 mt-0.5">Order summary appears here</p>
        </div>
        @endif

      </div>
    </div>

  </div>

</div>

{{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
     PRODUCT ADD MODAL
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
<div id="add-product"
  class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm p-4"
  role="dialog" aria-modal="true" aria-labelledby="add-product-title">
  <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 w-full max-w-lg max-h-[90vh] flex flex-col shadow-2xl">
    <div class="flex items-center justify-between px-5 py-4 border-b border-gray-200 dark:border-gray-700 flex-shrink-0">
      <div class="flex items-center gap-2">
        <span class="material-icons-outlined text-primary-500" aria-hidden="true">add_shopping_cart</span>
        <h2 id="add-product-title" class="text-sm font-bold text-gray-900 dark:text-gray-100">Add to Cart</h2>
      </div>
      <button type="button" id="pos-modal-close"
        class="p-1.5 text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500"
        aria-label="Close dialog">
        <span class="material-icons-outlined" aria-hidden="true">close</span>
      </button>
    </div>
    <div id="product-show" class="p-5 overflow-y-auto flex-1 text-sm text-gray-700 dark:text-gray-300">
      <div class="flex items-center justify-center py-10">
        <svg class="animate-spin h-7 w-7 text-primary-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
        </svg>
      </div>
    </div>
    <div class="px-5 py-3 border-t border-gray-200 dark:border-gray-700 flex-shrink-0">
      <button type="button" id="addProductRemoveBtn"
        class="w-full py-2.5 text-sm font-medium text-gray-600 dark:text-gray-300 border border-gray-200 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500">
        Close
      </button>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('assets/admin/js/jqueryui.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
/* ─── Shared constants ──────────────────────────────────────── */
const CSRF = document.querySelector('meta[name="csrf-token"]').content;
const SPINNER_LG = `<div class="flex items-center justify-center py-10">
  <svg class="animate-spin h-7 w-7 text-primary-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true">
    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
  </svg>
</div>`;
const SPINNER_SM = `<svg class="animate-spin h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>`;

/* ═══════════════════════════════════════════════════════════════
   POS PRODUCT BROWSER
═══════════════════════════════════════════════════════════════ */
const POS = {
  endpoint: '{{ route('vendor-order-product-datatables') }}',
  perPage: 10,
  page: 0,
  total: 0,
  search: '',
  draw: 1,
  inCartIds: new Set(),

  /* Fetch from DataTables endpoint */
  async fetch() {
    const params = new URLSearchParams({
      draw: this.draw++,
      start: this.page * this.perPage,
      length: this.perPage,
      'search[value]': this.search,
      'search[regex]': false,
      'columns[0][data]': 'name',
      'columns[0][name]': 'name',
      'columns[0][searchable]': true,
      'columns[0][orderable]': false,
      'columns[1][data]': 'action',
      'columns[1][name]': 'action',
      'columns[1][searchable]': false,
      'columns[1][orderable]': false,
    });
    const res = await fetch(`${this.endpoint}?${params}`, {
      headers: { 'X-CSRF-TOKEN': CSRF }
    });
    const json = await res.json();
    this.total = json.recordsFiltered || json.recordsTotal || 0;
    return json.data || [];
  },

  /* Parse server-rendered HTML row → clean object */
  parseRow(row) {
    const nd = document.createElement('div'); nd.innerHTML = row.name;
    const img = nd.querySelector('img');
    const small = nd.querySelector('small');
    const ad = document.createElement('div'); ad.innerHTML = row.action;
    const btn = ad.querySelector('.order_product_add');
    return {
      id: btn ? btn.getAttribute('data-href') : null,
      img: img ? img.src : '',
      name: img ? img.alt : nd.textContent.trim().split('\n')[0].trim(),
      price: small ? small.textContent.trim() : '',
    };
  },

  /* Render one product card */
  cardHtml(p) {
    const inCart = this.inCartIds.has(p.id);
    return `
      <div class="product-card${inCart ? ' in-cart' : ''}" data-id="${p.id}">
        <span class="added-badge">✓ Added</span>
        <div class="card-img">
          <img src="${p.img}" alt="${p.name}" loading="lazy"
               onerror="this.src='{{ asset('assets/images/noimage.png') }}'">
        </div>
        <div class="card-body">
          <div class="card-name">${p.name}</div>
          <div class="card-price">${p.price}</div>
        </div>
        <button type="button" class="card-add order_product_add" data-href="${p.id}"
          aria-label="${inCart ? 'Add more of ' + p.name : 'Add ' + p.name + ' to cart'}">
          <span class="material-icons-outlined" aria-hidden="true">add_shopping_cart</span>
          ${inCart ? 'Add More' : 'Add to Cart'}
        </button>
      </div>`;
  },

  /* Render pagination */
  paginationHtml() {
    const totalPages = Math.ceil(this.total / this.perPage);
    if (totalPages <= 1) return '';
    const btnClass = (active, disabled) =>
      `page-btn${active ? ' active' : ''}${disabled ? ' disabled-btn' : ''}`;

    let html = `<button class="${btnClass(false, this.page===0)}" data-page="${this.page-1}" ${this.page===0?'disabled':''} aria-label="Previous page">
      <span class="material-icons-outlined" aria-hidden="true">chevron_left</span></button>`;

    const range = Array.from({length: totalPages}, (_, i) => i)
      .filter(i => i===0 || i===totalPages-1 || Math.abs(i-this.page)<=1);

    let prev = -1;
    for (const i of range) {
      if (prev !== -1 && i - prev > 1) html += `<span class="page-btn page-ellipsis" aria-hidden="true">…</span>`;
      html += `<button class="${btnClass(i===this.page, false)}" data-page="${i}" aria-label="Page ${i+1}" ${i===this.page?'aria-current="page"':''}>${i+1}</button>`;
      prev = i;
    }

    html += `<button class="${btnClass(false, this.page>=totalPages-1)}" data-page="${this.page+1}" ${this.page>=totalPages-1?'disabled':''} aria-label="Next page">
      <span class="material-icons-outlined" aria-hidden="true">chevron_right</span></button>`;
    return html;
  },

  /* Full render cycle */
  async render() {
    const grid = document.getElementById('product-grid');
    const countText = document.getElementById('product-count-text');
    const pagination = document.getElementById('product-pagination');

    // Loading skeletons
    grid.innerHTML = Array(this.perPage).fill(`
      <div class="border border-gray-100 overflow-hidden">
        <div class="skeleton aspect-square"></div>
        <div class="p-3 space-y-2">
          <div class="skeleton h-3 rounded w-3/4"></div>
          <div class="skeleton h-3 rounded w-1/2"></div>
          <div class="skeleton h-8 rounded w-full mt-2"></div>
        </div>
      </div>`).join('');

    try {
      const rows = await this.fetch();
      if (!rows.length) {
        grid.innerHTML = `<div class="col-span-full py-16 text-center text-gray-400">
          <span class="material-icons-outlined text-5xl block mb-2">inventory_2</span>
          No products found.
        </div>`;
        countText.textContent = '';
        pagination.innerHTML = '';
        return;
      }
      const start = this.page * this.perPage + 1;
      const end = Math.min(start + rows.length - 1, this.total);
      countText.textContent = `Showing ${start}–${end} of ${this.total} products`;
      grid.innerHTML = rows.map(r => this.cardHtml(this.parseRow(r))).join('');
      pagination.innerHTML = this.paginationHtml();
      this.bindPagination();
    } catch (e) {
      grid.innerHTML = `<div class="col-span-full py-8 text-center text-red-400 text-sm">Failed to load products.</div>`;
    }
  },

  bindPagination() {
    document.querySelectorAll('#product-pagination .page-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const p = parseInt(btn.dataset.page);
        if (isNaN(p) || btn.disabled) return;
        this.page = p;
        this.render();
        document.getElementById('product-grid').scrollIntoView({behavior: 'smooth', block: 'start'});
      });
    });
  },

  init() {
    this.render();

    // Search with debounce
    let debounce;
    document.getElementById('product-search').addEventListener('input', e => {
      clearTimeout(debounce);
      debounce = setTimeout(() => {
        this.search = e.target.value;
        this.page = 0;
        this.render();
      }, 350);
    });
  }
};

/* ═══════════════════════════════════════════════════════════════
   MODAL
═══════════════════════════════════════════════════════════════ */
function openModal() {
  const m = document.getElementById('add-product');
  m.classList.remove('hidden'); m.classList.add('flex');
  document.body.style.overflow = 'hidden';
}
function closeModal() {
  const m = document.getElementById('add-product');
  m.classList.add('hidden'); m.classList.remove('flex');
  document.body.style.overflow = '';
}
document.getElementById('pos-modal-close').addEventListener('click', closeModal);
document.getElementById('addProductRemoveBtn').addEventListener('click', closeModal);
document.getElementById('add-product').addEventListener('click', e => { if (e.target === e.currentTarget) closeModal(); });

/* ═══════════════════════════════════════════════════════════════
   ADD TO CART CLICK
═══════════════════════════════════════════════════════════════ */
$(document).on('click', '.order_product_add', function(e) {
  e.preventDefault();
  const productId = $(this).attr('data-href');
  openModal();
  $('#product-show').html(SPINNER_LG)
  .load(mainurl + '/vendor/order/create/product-show/' + productId, function() {
    // Mark card as in-cart on successful add
    POS.inCartIds.add(productId);
    updateCartBadge();
  });
});

/* ═══════════════════════════════════════════════════════════════
   REMOVE FROM CART
═══════════════════════════════════════════════════════════════ */
$(document).on('click', '.removeOrder', function(e) {
  e.preventDefault();
  if (!confirm('Remove this product from cart?')) return;
  $.ajax({
    url: $(this).attr('data-href'), type: 'GET',
    success(data) { $('#view_table_order').html(data); updateCartBadge(); }
  });
});

/* ═══════════════════════════════════════════════════════════════
   EXISTING CUSTOMER → AUTO-FILL
═══════════════════════════════════════════════════════════════ */
$(document).on('change', '#order_create_user', function() {
  const user_id = $(this).val();
  if (user_id) {
    $.ajax({
      url: mainurl + '/vendor/order/create/user-address',
      type: 'GET', data: { user_id },
      success(data) { $('#order_create_user_address').html(data); }
    });
  } else {
    $('#order_create_user_address').find('input, textarea').val('');
  }
});

/* ═══════════════════════════════════════════════════════════════
   CART BADGE COUNTER
═══════════════════════════════════════════════════════════════ */
function updateCartBadge() {
  const items = document.querySelectorAll('#view_table_order .removeOrder');
  const count = items.length;
  const badge = document.getElementById('cart-count-badge');
  const num = document.getElementById('badge-count');
  const panelBadge = document.getElementById('panel-cart-count');
  if (count > 0) {
    badge.classList.remove('hidden'); badge.classList.add('flex');
    num.textContent = count;
    if (panelBadge) { panelBadge.textContent = count; panelBadge.classList.remove('hidden'); }
  } else {
    badge.classList.add('hidden'); badge.classList.remove('flex');
    if (panelBadge) panelBadge.classList.add('hidden');
  }
}

/* ═══════════════════════════════════════════════════════════════
   INIT
═══════════════════════════════════════════════════════════════ */
$(document).ready(function() {
  // Select2
  $('.order_create_user').select2({
    placeholder: '— New / Walk-in Customer —',
    allowClear: true
  });

  // Boot product browser
  POS.init();

  // Initial cart badge
  updateCartBadge();
});

/* ═══════════════════════════════════════════════════════════════
   STEPS 4-6: ORDER SUMMARY, PAYMENT MODE, PLACE ORDER
═══════════════════════════════════════════════════════════════ */
(function () {
  // Guard: only init when cart has items and Steps 4-6 are rendered
  var applyBtn = document.getElementById('pos-apply-coupon');
  if (!applyBtn) return;

  var removeBtn     = document.getElementById('pos-remove-coupon');
  var couponMsg     = document.getElementById('pos-coupon-msg');
  var couponInput   = document.getElementById('pos-coupon-code');
  var totalDisplay  = document.getElementById('pos-total-display');
  var finalTotal    = document.getElementById('pos-final-total');
  var discountRow   = document.getElementById('pos-discount-row');
  var discountLabel = document.getElementById('pos-discount-label');
  var subtotalVal   = document.getElementById('pos-subtotal-val');
  var shippingVal   = document.getElementById('pos-shipping-val');
  var couponVal     = document.getElementById('pos-coupon-val');
  var totalVal      = document.getElementById('pos-total-val');
  var formCoupon    = document.getElementById('form-coupon');
  var formTotal     = document.getElementById('form-total');
  var formPayment   = document.getElementById('form-payment');
  var submitForm    = document.getElementById('order-submit-form');
  var placeBtn      = document.getElementById('place-order-btn');

  // Preserve original formatted total for coupon removal restoration
  var originalTotalText = totalDisplay ? totalDisplay.textContent.trim() : '';

  /* ── Apply coupon ─────────────────────────────────────────── */
  applyBtn.addEventListener('click', function () {
      var code = couponInput.value.trim();
      if (!code) { setMsg('Please enter a coupon code.', 'text-amber-600'); return; }
      applyBtn.disabled = true; applyBtn.textContent = '…'; clearMsg();

      var currentTotal = parseFloat(totalVal ? totalVal.value : 0) || 0;
      $.ajax({
        url: '{{ route('applyCoupon') }}',
        method: 'POST',
        data: {
          _token: CSRF,
          coupon_code: code,
          total: currentTotal
        },
        success: function (data) {
          applyBtn.disabled = false; applyBtn.textContent = 'Apply';
          if (data.success) {
            var discAmt = parseFloat(data.discount) || 0;
            var newNum  = currentTotal - discAmt;
            // Show discount row with amount
            discountLabel.textContent = '−' + discAmt.toFixed(0);
            discountRow.classList.remove('hidden');
            // Update total displays with server-formatted string
            if (totalDisplay) totalDisplay.textContent = data.new_total;
            if (finalTotal)   finalTotal.textContent   = data.new_total;
            // Sync hidden state fields
            if (couponVal)  couponVal.value  = discAmt;
            if (totalVal)   totalVal.value   = newNum;
            if (formCoupon) formCoupon.value = discAmt;
            if (formTotal)  formTotal.value  = newNum;
            // Show remove button
            removeBtn.classList.remove('hidden');
            setMsg('Coupon applied!', 'text-green-600');
          } else {
            setMsg(data.message || 'Invalid coupon code.', 'text-red-500');
          }
        },
        error: function () {
          applyBtn.disabled = false; applyBtn.textContent = 'Apply';
          setMsg('Something went wrong. Please try again.', 'text-red-500');
        }
      });
  });

  /* ── Remove coupon ─────────────────────────────────────────── */
  if (removeBtn) {
    removeBtn.addEventListener('click', function () {
      var subtotal = parseFloat(subtotalVal ? subtotalVal.value : 0) || 0;
      var shipping = parseFloat(shippingVal ? shippingVal.value : 0) || 0;
      var original = subtotal + shipping;
      // Restore original formatted total
      if (totalDisplay) totalDisplay.textContent = originalTotalText;
      if (finalTotal)   finalTotal.textContent   = originalTotalText;
      // Hide discount row
      discountRow.classList.add('hidden');
      // Reset hidden fields
      if (couponVal)  couponVal.value  = 0;
      if (totalVal)   totalVal.value   = original;
      if (formCoupon) formCoupon.value = 0;
      if (formTotal)  formTotal.value  = original;
      // Reset coupon UI
      removeBtn.classList.add('hidden');
      couponInput.value = '';
      clearMsg();
    });
  }

  /* ── Payment mode card selection ───────────────────────────── */
  var payOpts = document.querySelectorAll('.pos-pay-opt');
  payOpts.forEach(function (label) {
    label.addEventListener('click', function () {
      payOpts.forEach(function (l) {
        l.classList.remove('border-2', 'border-primary-500', 'bg-primary-50');
        l.classList.add('border', 'border-gray-200');
      });
      label.classList.remove('border', 'border-gray-200');
      label.classList.add('border-2', 'border-primary-500', 'bg-primary-50');
      if (formPayment) formPayment.value = label.dataset.method;
    });
  });

  /* ── Place order: sync fields + loading state ──────────────── */
  if (submitForm && placeBtn) {
    submitForm.addEventListener('submit', function () {
      // Sync selected payment method to hidden field
      var radio = document.querySelector('input[name="pos_payment_method"]:checked');
      if (radio && formPayment) formPayment.value = radio.value;
      // Loading state on button
      placeBtn.disabled = true;
      placeBtn.innerHTML = SPINNER_SM + 'Placing order…';
    });
  }

  /* ── Helpers ───────────────────────────────────────────────── */
  function setMsg(text, cls) {
    if (!couponMsg) return;
    couponMsg.textContent = text;
    couponMsg.className = 'text-xs ' + cls;
  }
  function clearMsg() {
    if (!couponMsg) return;
    couponMsg.textContent = '';
    couponMsg.className = 'text-xs';
  }
})();
</script>
@endsection
