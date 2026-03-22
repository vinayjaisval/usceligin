@extends('frontend.include.app')

@section('content')
<main id="main-content" role="main" class="bg-gray-50 dark:bg-gray-900 min-h-screen">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-8">

    {{-- Breadcrumb --}}
    @include('frontend.include.breadcrumb', ['items' => [
    ['label' => 'Home', 'url' => route('front.index')],
    ['label' => 'My Account']
    ]])

    {{-- Success Message --}}
    @if(session('success'))
    <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200">
      <div class="flex items-start">
        <span class="material-icons-outlined text-green-600 dark:text-green-400 mr-3 mt-0.5" aria-hidden="true">check_circle</span>
        <div class="flex-1">
          <p class="font-semibold">{{ session('success') }}</p>
        </div>
      </div>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8">

      {{-- Left Sidebar: Navigation (3 columns) --}}
      <aside class="lg:col-span-3">
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">

          {{-- User Avatar --}}
          <div class="p-6 border-b border-gray-200 dark:border-gray-700 flex flex-col items-center">
            <div class="w-20 h-20 rounded-full bg-gray-900 dark:bg-gray-100 text-white dark:text-gray-900 flex items-center justify-center text-3xl font-bold mb-3">
              {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
            </div>
            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 text-center">{{ Auth::user()->name ?? 'User' }}</h2>
            <p class="text-sm text-gray-600 dark:text-gray-400 text-center">{{ Auth::user()->email }}</p>
          </div>

          {{-- Navigation Menu --}}
          <nav class="p-2">
            <a href="#dashboard"
              onclick="switchTab(event, 'dashboard')"
              data-tab="dashboard"
              class="tab-link active flex items-center justify-between px-4 py-3 text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors cursor-pointer">
              <div class="flex items-center">
                <span class="material-icons-outlined mr-3" aria-hidden="true">dashboard</span>
                <span>Dashboard</span>
              </div>
              <span class="material-icons-outlined text-gray-400 dark:text-gray-500" aria-hidden="true">chevron_right</span>
            </a>
            @if(Auth::user()->reffered_times == 3)
            <a href="{{ route('vendor.dashboard', ['tab' => 'purchases']) }}"
              class="tab-link flex items-center justify-between px-4 py-3 text-gray-900 hover:bg-gray-100">
              <div class="flex items-center">
                <span class="material-icons-outlined mr-3" aria-hidden="true">shopping_bag</span>
                <span>POS</span>
              </div>
            </a>
            @endif


            <a href="#purchases"
              onclick="switchTab(event, 'purchases')"
              data-tab="purchases"
              class="tab-link flex items-center justify-between px-4 py-3 text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors cursor-pointer">
              <div class="flex items-center">
                <span class="material-icons-outlined mr-3" aria-hidden="true">shopping_bag</span>
                <span>Purchase History</span>
              </div>
              <span class="material-icons-outlined text-gray-400 dark:text-gray-500" aria-hidden="true">chevron_right</span>
            </a>

            <a href="#wishlists"
              onclick="switchTab(event, 'wishlists')"
              data-tab="wishlists"
              class="tab-link flex items-center justify-between px-4 py-3 text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors cursor-pointer">
              <div class="flex items-center">
                <span class="material-icons-outlined mr-3" aria-hidden="true">favorite_border</span>
                <span>Wishlists</span>
              </div>
              <span class="material-icons-outlined text-gray-400 dark:text-gray-500" aria-hidden="true">chevron_right</span>
            </a>

            <a href="#account"
              onclick="switchTab(event, 'account')"
              data-tab="account"
              class="tab-link flex items-center justify-between px-4 py-3 text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors cursor-pointer">
              <div class="flex items-center">
                <span class="material-icons-outlined mr-3" aria-hidden="true">person</span>
                <span>Manage Account</span>
              </div>
              <span class="material-icons-outlined text-gray-400 dark:text-gray-500" aria-hidden="true">chevron_right</span>
            </a>

            <a href="#support"
              onclick="switchTab(event, 'support')"
              data-tab="support"
              class="tab-link flex items-center justify-between px-4 py-3 text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors cursor-pointer">
              <div class="flex items-center">
                <span class="material-icons-outlined mr-3" aria-hidden="true">support_agent</span>
                <span>Customer Service</span>
              </div>
              <span class="material-icons-outlined text-gray-400 dark:text-gray-500" aria-hidden="true">chevron_right</span>
            </a>

            <a href="#affiliate"
              onclick="switchTab(event, 'affiliate')"
              data-tab="affiliate"
              class="tab-link flex items-center justify-between px-4 py-3 text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors cursor-pointer">
              <div class="flex items-center">
                <span class="material-icons-outlined mr-3" aria-hidden="true">groups</span>
                <span>Affiliate</span>
              </div>
              <span class="material-icons-outlined text-gray-400 dark:text-gray-500" aria-hidden="true">chevron_right</span>
            </a>

            <a href="#points"
              onclick="switchTab(event, 'points')"
              data-tab="points"
              class="tab-link flex items-center justify-between px-4 py-3 text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors cursor-pointer">
              <div class="flex items-center">
                <span class="material-icons-outlined mr-3" aria-hidden="true">stars</span>
                <span>CELIGIN Points</span>
              </div>
              <span class="material-icons-outlined text-gray-400 dark:text-gray-500" aria-hidden="true">chevron_right</span>
            </a>

            <form method="POST" action="{{ route('logout') }}" class="border-t border-gray-200 dark:border-gray-700 mt-2 pt-2">
              @csrf
              <button type="submit" class="w-full flex items-center justify-between px-4 py-3 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                <div class="flex items-center">
                  <span class="material-icons-outlined mr-3" aria-hidden="true">logout</span>
                  <span>Sign Out</span>
                </div>
              </button>
            </form>
          </nav>
        </div>
      </aside>

      {{-- Right Content Area (9 columns) --}}
      <div class="lg:col-span-9">

        {{-- Dashboard Tab --}}
        <div id="content-dashboard" class="tab-content">
          <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 mb-6">Dashboard</h1>

          {{-- Quick Stats --}}
          <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 mb-5">
            <div class="grid grid-cols-3 divide-x divide-gray-200 dark:divide-gray-700">
              <a href="#purchases" onclick="switchTab(null, 'purchases')" class="flex items-center gap-3 px-4 py-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                <span class="material-icons-outlined text-gray-400 dark:text-gray-500 text-xl" aria-hidden="true">shopping_bag</span>
                <div>
                  <p class="text-xl font-bold text-gray-900 dark:text-gray-100 leading-tight">{{ $totalOrders }}</p>
                  <p class="text-xs text-gray-500 dark:text-gray-400">Orders</p>
                </div>
              </a>
              <a href="#wishlists" onclick="switchTab(null, 'wishlists')" class="flex items-center gap-3 px-4 py-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                <span class="material-icons-outlined text-gray-400 dark:text-gray-500 text-xl" aria-hidden="true">favorite_border</span>
                <div>
                  <p class="text-xl font-bold text-gray-900 dark:text-gray-100 leading-tight">{{ $totalWishlistItems }}</p>
                  <p class="text-xs text-gray-500 dark:text-gray-400">Wishlist</p>
                </div>
              </a>
              <a href="#points" onclick="switchTab(null, 'points')" class="flex items-center gap-3 px-4 py-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                <span class="material-icons-outlined text-gray-400 dark:text-gray-500 text-xl" aria-hidden="true">stars</span>
                <div>
                  <p class="text-xl font-bold text-gray-900 dark:text-gray-100 leading-tight">{{ round(Auth::user()->current_balance ?? 0) }}</p>
                  <p class="text-xs text-gray-500 dark:text-gray-400">Points</p>
                </div>
              </a>
            </div>
          </div>

          {{-- Join CELIGIN CLUB --}}
          <a href="{{ route('front.celigin-join-club') }}"
            class="flex items-center gap-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 px-4 py-3.5 mb-5 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors group">
            <span class="material-icons-outlined text-gray-400 dark:text-gray-500 text-xl transition-colors" aria-hidden="true">card_membership</span>
            <div class="flex-1 min-w-0">
              <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">Join CELIGIN CLUB</p>
              <p class="text-xs text-gray-500 dark:text-gray-400">Exclusive benefits and rewards for members</p>
            </div>
            <span class="material-icons-outlined text-gray-300 dark:text-gray-600 text-lg" aria-hidden="true">chevron_right</span>
          </a>

          {{-- Your Orders --}}
          <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 mb-5">
            <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200 dark:border-gray-700">
              <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Your Orders</h3>
              @if($orders->count() > 0)
                <a href="#purchases" onclick="switchTab(null, 'purchases')" class="text-xs text-primary-700 dark:text-primary-400 hover:text-primary-900 font-medium">View all →</a>
              @endif
            </div>

            @if($orders->count() > 0)
              @foreach($orders->take(3) as $order)
                @php
                  $dashCart = json_decode($order->cart, true);
                  $dashCartItems = $dashCart['items'] ?? [];
                  $itemsList = array_values($dashCartItems);
                  $totalItemCount = count($itemsList);
                  $currSign = $order->currency_sign ?: '₹';
                @endphp
                <a href="#purchases" onclick="switchTab(null, 'purchases')"
                  class="block px-4 py-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors border-b border-gray-100 dark:border-gray-700/50 last:border-b-0">

                  {{-- Order header: date, status, price --}}
                  <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2">
                      <span class="text-xs text-gray-400 dark:text-gray-500">{{ $order->created_at->format('M d, Y') }}</span>
                      <span class="text-gray-300 dark:text-gray-600">&middot;</span>
                      <span class="inline-flex items-center gap-1 text-xs font-medium
                        @if($order->status == 'completed') text-green-600 dark:text-green-400
                        @elseif($order->status == 'pending') text-yellow-600 dark:text-yellow-400
                        @elseif($order->status == 'processing' || $order->status == 'on delivery') text-blue-600 dark:text-blue-400
                        @elseif($order->status == 'declined') text-red-600 dark:text-red-400
                        @else text-gray-500 dark:text-gray-400
                        @endif">
                        <span class="w-1.5 h-1.5 rounded-full
                          @if($order->status == 'completed') bg-green-500
                          @elseif($order->status == 'pending') bg-yellow-500
                          @elseif($order->status == 'processing' || $order->status == 'on delivery') bg-blue-500
                          @elseif($order->status == 'declined') bg-red-500
                          @else bg-gray-400
                          @endif"></span>
                        {{ ucfirst($order->status) }}
                      </span>
                    </div>
                    <div class="flex items-center gap-2">
                      <span class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $currSign }}{{ number_format($order->pay_amount, 2) }}</span>
                      <span class="material-icons-outlined text-gray-300 dark:text-gray-600 text-lg" aria-hidden="true">chevron_right</span>
                    </div>
                  </div>

                  {{-- Product items list --}}
                  <div class="flex flex-col gap-2.5">
                    @foreach(array_slice($itemsList, 0, 3) as $cartItem)
                      <div class="flex items-center gap-3">
                        <div class="flex-shrink-0 w-16 h-16 bg-gray-100 dark:bg-gray-700 overflow-hidden">
                          <x-product-image
                            :photo="$cartItem['item']['photo'] ?? null"
                            :thumbnail="$cartItem['item']['thumbnail'] ?? null"
                            :name="$cartItem['item']['name'] ?? 'Product'" />
                        </div>
                        <div class="flex-1 min-w-0">
                          <p class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">{{ $cartItem['item']['name'] ?? 'Product' }}</p>
                          <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">Qty: {{ $cartItem['qty'] ?? 1 }}</p>
                        </div>
                      </div>
                    @endforeach
                    @if($totalItemCount > 3)
                      <p class="text-xs text-gray-400 dark:text-gray-500">+ {{ $totalItemCount - 3 }} more {{ Str::plural('item', $totalItemCount - 3) }}</p>
                    @endif
                  </div>
                </a>
              @endforeach
            @else
              <div class="px-4 py-8 text-center">
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">No orders yet</p>
                <a href="{{ route('front.index') }}" class="text-sm text-primary-700 dark:text-primary-400 font-medium hover:text-primary-900 hover:underline">Start Shopping →</a>
              </div>
            @endif
          </div>

          {{-- Wishlist --}}
          <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200 dark:border-gray-700">
              <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Wishlist</h3>
              @if($wishlist->count() > 0)
                <a href="#wishlists" onclick="switchTab(null, 'wishlists')" class="text-xs text-primary-700 dark:text-primary-400 hover:text-primary-900 font-medium">View all →</a>
              @endif
            </div>

            @if($wishlist->count() > 0)
              @foreach($wishlist->take(3) as $item)
                @php $wProduct = $item->product; @endphp
                <a href="{{ $wProduct ? route('front.product', $wProduct->slug) : '#wishlists' }}"
                  class="flex items-center gap-3 px-4 py-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors border-b border-gray-100 dark:border-gray-700/50 last:border-b-0">

                  <div class="flex-shrink-0 w-16 h-16 bg-gray-100 dark:bg-gray-700 overflow-hidden">
                    @if($wProduct && $wProduct->thumbnail)
                      <img src="{{ asset('assets/images/thumbnails/' . $wProduct->thumbnail) }}"
                           alt="{{ $wProduct->name ?? 'Product' }}"
                           class="w-full h-full object-cover" loading="lazy" />
                    @else
                      <div class="w-full h-full flex items-center justify-center">
                        <span class="material-icons-outlined text-gray-300 dark:text-gray-500" aria-hidden="true">image</span>
                      </div>
                    @endif
                  </div>

                  <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">{{ $wProduct->name ?? 'Product' }}</p>
                    @if($wProduct)
                      <div class="flex items-baseline gap-1.5 mt-0.5">
                        <span class="text-xs font-semibold text-gray-900 dark:text-gray-100">{{ $wProduct->showPrice() }}</span>
                        @if($wProduct->previous_price && $wProduct->previous_price > $wProduct->price)
                          <span class="text-xs text-green-600 dark:text-green-400 font-medium">{{ round((($wProduct->previous_price - $wProduct->price) / $wProduct->previous_price) * 100) }}% off</span>
                        @endif
                      </div>
                    @endif
                  </div>

                  <span class="material-icons-outlined text-gray-300 dark:text-gray-600 text-lg flex-shrink-0" aria-hidden="true">chevron_right</span>
                </a>
              @endforeach
            @else
              <div class="px-4 py-8 text-center">
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">Your wishlist is empty</p>
                <a href="{{ route('front.index') }}" class="text-sm text-primary-700 dark:text-primary-400 font-medium hover:text-primary-900 hover:underline">Browse Products →</a>
              </div>
            @endif
          </div>
        </div>

        {{-- Purchase History Tab --}}
        <div id="content-purchases" class="tab-content hidden">

          {{-- Header: Title + Search --}}
          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100">Your Orders</h1>
            <form method="GET" action="{{ route('user.account') }}" class="flex items-center gap-2">
              <input type="hidden" name="period" value="{{ $period ?? 'all' }}">
              <div class="relative flex-1 sm:flex-none">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </span>
                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search all orders"
                  class="w-full sm:w-72 pl-9 pr-4 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 text-sm focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-colors"
                  id="order-search" aria-label="Search orders by order number or product name" />
              </div>
              <button type="submit"
                class="px-4 py-2 bg-primary-800 text-white text-sm font-semibold hover:bg-primary-900 transition-colors whitespace-nowrap focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2">
                Search Orders
              </button>
              <input type="hidden" name="_hash" value="purchases">
            </form>
          </div>

          {{-- Sub-tabs: Orders | Buy Again --}}
          <div class="border-b border-gray-200 dark:border-gray-700 mb-4">
            <nav class="flex gap-6" role="tablist" aria-label="Purchase history tabs">
              <button type="button" role="tab" aria-selected="true" aria-controls="orders-subtab-content"
                onclick="switchOrderSubTab('orders')" id="subtab-orders"
                class="order-subtab pb-3 text-sm font-semibold border-b-2 border-primary-800 dark:border-primary-400 text-primary-800 dark:text-primary-400 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2">
                Orders
              </button>
              <button type="button" role="tab" aria-selected="false" aria-controls="buyagain-subtab-content"
                onclick="switchOrderSubTab('buyagain')" id="subtab-buyagain"
                class="order-subtab pb-3 text-sm font-semibold border-b-2 border-transparent text-neutral-500 dark:text-neutral-400 hover:text-primary-800 dark:hover:text-primary-400 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2">
                Buy Again
              </button>
            </nav>
          </div>

          {{-- Orders Sub-tab Content --}}
          <div id="orders-subtab-content">

            {{-- Period filter + count --}}
            <div class="flex flex-col sm:flex-row sm:items-center gap-3 mb-5">
              <label for="periodFilter" class="text-sm text-gray-700 dark:text-gray-300">
                <strong>{{ $orders->count() }} {{ Str::plural('order', $orders->count()) }}</strong> placed in
              </label>
              <form method="GET" action="{{ route('user.account') }}" id="periodFilterForm">
                <input type="hidden" name="search" value="{{ $search ?? '' }}">
                <input type="hidden" name="_hash" value="purchases">
                <select id="periodFilter" name="period" onchange="document.getElementById('periodFilterForm').submit()"
                  class="text-sm border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 py-1.5 px-3 focus:ring-2 focus:ring-primary-600 focus:border-primary-600 cursor-pointer"
                  aria-label="Filter orders by time period">
                  <option value="3months" {{ ($period ?? 'all') === '3months' ? 'selected' : '' }}>past 3 months</option>
                  <option value="6months" {{ ($period ?? 'all') === '6months' ? 'selected' : '' }}>past 6 months</option>
                  <option value="year" {{ ($period ?? 'all') === 'year' ? 'selected' : '' }}>past year</option>
                  <option value="all" {{ ($period ?? 'all') === 'all' ? 'selected' : '' }}>all time</option>
                </select>
              </form>
            </div>

            @if($orders->count() > 0)
              <div class="space-y-5">
                @foreach($orders as $order)
                  @php
                    $cart = json_decode($order->cart, true);
                    $cartItems = $cart['items'] ?? [];
                  @endphp
                  @php
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
                          @foreach($cartItems as $key => $cartItem)
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

                          {{-- 2. Cancel Order — active only when pending/ordered --}}
                          @if($order->status === 'pending')
                            <button type="button" onclick="cancelOrder({{ $order->id }})"
                              class="w-full text-center px-4 py-2 border border-red-400 dark:border-red-600 text-red-600 dark:text-red-400 text-sm font-medium hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                              Cancel Order
                            </button>
                          @else
                            <button type="button" disabled
                              class="w-full text-center px-4 py-2 bg-gray-100 dark:bg-gray-700/50 text-gray-400 dark:text-gray-500 text-sm font-medium cursor-not-allowed border border-gray-200 dark:border-gray-600">
                              Cancellation Closed
                            </button>
                          @endif

                          {{-- 3. Request Refund — active within 5 days of delivery --}}
                          @if($isRefundRequested)
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
                              Refund After Delivery
                            </button>
                          @endif

                          {{-- 4. View Invoice — always active --}}
                          <a href="{{ url('/user/print/order/print/' . $order->id) }}"
                            class="w-full text-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                            View Invoice
                          </a>

                          {{-- 5. Return & Refund Policy — always shown --}}
                          <a href="{{ route('front.return-refund-policy') }}"
                            class="w-full text-center text-xs text-primary-700 dark:text-primary-400 hover:text-primary-900 transition-colors py-1 underline underline-offset-2">
                            Return &amp; Refund Policy
                          </a>

                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            @else
              {{-- Empty State --}}
              <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-8 lg:p-12 text-center">
                <div class="max-w-md mx-auto">
                  <div class="w-20 h-20 bg-primary-100 dark:bg-primary-900/20 rounded-full flex items-center justify-center mx-auto mb-5">
                    <span class="material-icons-outlined text-5xl text-primary-600 dark:text-primary-400" aria-hidden="true">shopping_bag</span>
                  </div>
                  <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                    @if(!empty($search))
                      No orders found
                    @else
                      No orders yet
                    @endif
                  </h3>
                  <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                    @if(!empty($search))
                      We couldn't find any orders matching "<strong>{{ $search }}</strong>". Try a different search term.
                    @else
                      You haven't placed any orders. Start shopping to see your purchase history here.
                    @endif
                  </p>
                  <a href="{{ route('front.index') }}"
                    class="inline-block px-6 py-2.5 bg-primary-800 text-white text-sm font-semibold hover:bg-primary-900 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-600">
                    Start Shopping
                  </a>
                </div>
              </div>
            @endif
          </div>

          {{-- Buy Again Sub-tab Content --}}
          <div id="buyagain-subtab-content" class="hidden">
            @if(isset($buyAgainProducts) && $buyAgainProducts->count() > 0)
              <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($buyAgainProducts as $productData)
                  @php $product = $productData['product']; @endphp
                  <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-3 group hover:border-primary-300 dark:hover:border-primary-600 transition-colors">
                    {{-- Product Image --}}
                    <div class="aspect-square bg-gray-100 dark:bg-gray-700 overflow-hidden mb-3">
                      @if($product->thumbnail)
                        <img src="{{ asset('assets/images/thumbnails/' . $product->thumbnail) }}"
                             alt="{{ $product->name }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                             loading="lazy" />
                      @else
                        <div class="w-full h-full flex items-center justify-center">
                          <span class="material-icons-outlined text-gray-400 dark:text-gray-500 text-4xl" aria-hidden="true">image</span>
                        </div>
                      @endif
                    </div>

                    {{-- Product Info --}}
                    <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100 line-clamp-2 mb-1" title="{{ $product->name }}">
                      {{ $product->name }}
                    </h4>
                    <p class="text-base font-bold text-gray-900 dark:text-gray-100 mb-1">
                      {{ $productData['currency_sign'] }}{{ number_format($product->price, 2) }}
                    </p>
                    @if($product->previous_price && $product->previous_price > $product->price)
                      <p class="text-xs text-gray-500 dark:text-gray-400 line-through mb-1">
                        {{ $productData['currency_sign'] }}{{ number_format($product->previous_price, 2) }}
                      </p>
                    @endif
                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">
                      Purchased {{ $productData['last_purchased']->format('M Y') }}
                    </p>

                    {{-- Add to Cart --}}
                    <button type="button"
                      onclick="addToCart({{ $product->id }})"
                      class="w-full px-3 py-2 bg-primary-800 text-white text-xs font-semibold hover:bg-primary-900 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-600">
                      Add to Cart
                    </button>
                  </div>
                @endforeach
              </div>
            @else
              <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-8 lg:p-12 text-center">
                <div class="max-w-md mx-auto">
                  <div class="w-20 h-20 bg-primary-100 dark:bg-primary-900/20 rounded-full flex items-center justify-center mx-auto mb-5">
                    <span class="material-icons-outlined text-5xl text-primary-600 dark:text-primary-400" aria-hidden="true">replay</span>
                  </div>
                  <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">No products to buy again</h3>
                  <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                    Once you place orders, your previously purchased products will appear here for easy reordering.
                  </p>
                  <a href="{{ route('front.index') }}"
                    class="inline-block px-6 py-2.5 bg-primary-800 text-white text-sm font-semibold hover:bg-primary-900 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-600">
                    Browse Products
                  </a>
                </div>
              </div>
            @endif
          </div>

        </div>

        {{-- Wishlists Tab --}}
        <div id="content-wishlists" class="tab-content hidden">
          <div class="flex items-center justify-between mb-6">
            <div>
              <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100">My Wishlist</h1>
              @if($wishlist->count() > 0)
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $wishlist->count() }} {{ Str::plural('item', $wishlist->count()) }} saved</p>
              @endif
            </div>
            @if($wishlist->count() > 0)
              <button type="button" onclick="removeAllWishlistItems()"
                aria-label="Remove all {{ $wishlist->count() }} items from wishlist"
                class="text-sm text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                Remove All
              </button>
            @endif
          </div>

          @if($wishlist->count() > 0)
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 divide-y divide-gray-200 dark:divide-gray-700">
              @foreach($wishlist as $item)
                @php $product = $item->product; @endphp
                <div class="flex items-start gap-4 p-4 sm:p-5 group" id="wishlist-row-{{ $item->id }}">

                  {{-- Product Image --}}
                  <a href="{{ $product ? route('front.product', $product->slug) : '#' }}"
                     class="flex-shrink-0 w-20 h-20 sm:w-24 sm:h-24 bg-gray-100 dark:bg-gray-700 overflow-hidden block"
                     aria-label="View {{ $product->name ?? 'product' }} details">
                    <x-product-image
                      :photo="null"
                      :thumbnail="$product?->thumbnail"
                      :name="$product->name ?? 'Product'" />
                  </a>

                  {{-- Product Details --}}
                  <div class="flex-1 min-w-0">
                    <a href="{{ $product ? route('front.product', $product->slug) : '#' }}"
                      class="text-sm sm:text-base font-medium text-gray-900 dark:text-gray-100 hover:text-primary-800 dark:hover:text-primary-400 transition-colors line-clamp-2">
                      {{ $product->name ?? 'Product Unavailable' }}
                    </a>

                    @if($product)
                      {{-- Price --}}
                      <div class="flex items-baseline gap-2 mt-1.5">
                        <span class="text-base sm:text-lg font-bold text-gray-900 dark:text-gray-100">{{ $product->showPrice() }}</span>
                        @if($product->previous_price && $product->previous_price > $product->price)
                          <span class="text-xs text-gray-400 dark:text-gray-500 line-through">{{ $product->showPreviousPrice() }}</span>
                          <span class="text-xs font-semibold text-green-600 dark:text-green-400">{{ round((($product->previous_price - $product->price) / $product->previous_price) * 100) }}% off</span>
                        @endif
                      </div>

                      {{-- Stock Status --}}
                      <p class="text-xs mt-1 {{ $product->stock && $product->stock > 0 ? 'text-green-600 dark:text-green-400' : 'text-red-500 dark:text-red-400' }}">
                        @if($product->stock && $product->stock > 0)
                          In Stock
                        @else
                          Out of Stock
                        @endif
                      </p>

                      {{-- Actions Row --}}
                      <div class="flex items-center gap-3 mt-3">
                        @if(!$product->stock || $product->stock > 0)
                          <button type="button" onclick="addToCart({{ $product->id }})"
                            aria-label="Add {{ $product->name }} to cart"
                            class="px-4 py-1.5 bg-primary-800 text-white text-xs font-semibold hover:bg-primary-900 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-600">
                            Add to Cart
                          </button>
                        @else
                          <span class="px-4 py-1.5 bg-gray-200 dark:bg-gray-700 text-gray-500 dark:text-gray-400 text-xs font-semibold cursor-not-allowed" aria-disabled="true">
                            Unavailable
                          </span>
                        @endif
                        <button type="button" onclick="removeWishlistItem({{ $item->id }})"
                          aria-label="Remove {{ $product->name }} from wishlist"
                          class="text-xs text-gray-500 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 transition-colors font-medium focus:outline-none focus:ring-2 focus:ring-red-500">
                          Remove
                        </button>
                      </div>
                    @else
                      <p class="text-sm text-red-500 dark:text-red-400 mt-1">This product is no longer available</p>
                      <button type="button" onclick="removeWishlistItem({{ $item->id }})"
                        aria-label="Remove unavailable item from wishlist"
                        class="mt-2 text-xs text-gray-500 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 transition-colors font-medium focus:outline-none focus:ring-2 focus:ring-red-500">
                        Remove
                      </button>
                    @endif
                  </div>

                  {{-- Added Date (desktop) --}}
                  <div class="hidden sm:block flex-shrink-0 text-right">
                    <p class="text-xs text-gray-400 dark:text-gray-500">Added {{ $item->created_at->diffForHumans() }}</p>
                  </div>
                </div>
              @endforeach
            </div>
          @else
          @include('frontend.include.empty-state', [
          'icon' => 'favorite_border',
          'title' => 'No Wishlist Items',
          'description' => 'You haven\'t saved any items yet. Browse our products and add favorites to your wishlist.',
          'actionText' => 'Browse Products',
          'actionUrl' => route('front.index')
          ])
          @endif
        </div>

        {{-- Manage Account Tab --}}
        <div id="content-account" class="tab-content hidden">
          <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 mb-6">Manage Account</h1>

          {{-- Personal Information Card --}}
          <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-sm mb-6">
            <div class="border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/30 px-6 py-4">
              <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Personal Information</h2>
              <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Update your account details and contact information</p>
            </div>

            <form method="POST" action="{{ route('user.account.update') }}" novalidate class="p-6 lg:p-8">
              @csrf

              <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                {{-- Name Field --}}
                <div>
                  <label for="name" class="block text-sm font-medium text-gray-900 dark:text-gray-100 mb-2">
                    Full Name <span class="text-red-600 dark:text-red-400">*</span>
                  </label>
                  <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $user->name) }}"
                    required
                    class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm"
                    placeholder="Enter your full name" />
                  @error('name')
                  <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                  @enderror
                </div>

                {{-- Email Field --}}
                <div>
                  <label for="email" class="block text-sm font-medium text-gray-900 dark:text-gray-100 mb-2">
                    Email Address
                    @if($user->email_verified_at)
                    <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 ml-2">
                      <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                      </svg>
                      Verified
                    </span>
                    @endif
                  </label>
                  <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email', $user->email) }}"
                    class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm"
                    placeholder="your@email.com" />
                  @error('email')
                  <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                  @enderror
                </div>
              </div>

              {{-- Phone Field --}}
              <div class="mb-6">
                <label for="phone" class="block text-sm font-medium text-gray-900 dark:text-gray-100 mb-2">
                  Mobile Number
                  @if($user->phone_verified_at)
                  <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 ml-2">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    Verified
                  </span>
                  @endif
                </label>
                <div class="relative flex items-center border border-gray-300 dark:border-gray-600 overflow-hidden focus-within:ring-2 focus-within:ring-blue-500 focus-within:border-blue-500 transition-all">
                  <span class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-4 py-2.5 text-sm font-medium border-r border-gray-300 dark:border-gray-600">+91</span>
                  <input
                    type="tel"
                    id="phone"
                    name="phone"
                    value="{{ old('phone', $user->phone ? substr($user->phone, -10) : '') }}"
                    class="flex-1 px-4 py-2.5 border-0 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 outline-none text-sm"
                    placeholder="12345 67890"
                    maxlength="10" />
                </div>
                @error('phone')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
              </div>

              {{-- Account Info Box --}}
              <!-- <div class="mb-6 p-5 bg-blue-50 dark:bg-blue-900/10 border border-blue-200 dark:border-blue-800">
                <div class="flex items-start gap-3 mb-4">
                  <span class="material-icons-outlined text-blue-600 dark:text-blue-400 text-xl mt-0.5" aria-hidden="true">info</span>
                  <div class="flex-1">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-3">Account Details</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-2.5 gap-x-6 text-sm">
                      <div class="flex justify-between sm:flex-col sm:justify-start">
                        <span class="text-gray-600 dark:text-gray-400">Account Type:</span>
                        <span class="text-gray-900 dark:text-gray-100 font-medium sm:mt-1">
                          @if($user->is_admin) Admin
                          @elseif($user->is_vendor) Vendor
                          @else Customer
                          @endif
                        </span>
                      </div>
                      <div class="flex justify-between sm:flex-col sm:justify-start">
                        <span class="text-gray-600 dark:text-gray-400">Member Since:</span>
                        <span class="text-gray-900 dark:text-gray-100 font-medium sm:mt-1">{{ $user->created_at->format('M d, Y') }}</span>
                      </div>
                      <div class="flex justify-between sm:flex-col sm:justify-start">
                        <span class="text-gray-600 dark:text-gray-400">Status:</span>
                        <span class="inline-flex items-center gap-1 font-medium sm:mt-1 {{ $user->status ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                          <span class="w-2 h-2 rounded-full {{ $user->status ? 'bg-green-600 dark:bg-green-400' : 'bg-red-600 dark:bg-red-400' }}"></span>
                          {{ $user->status ? 'Active' : 'Inactive' }}
                        </span>
                      </div>
                      <div class="flex justify-between sm:flex-col sm:justify-start">
                        <span class="text-gray-600 dark:text-gray-400">Last Login:</span>
                        <span class="text-gray-900 dark:text-gray-100 font-medium sm:mt-1">{{ $user->last_otp_sent_at ? $user->last_otp_sent_at->diffForHumans() : 'Never' }}</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div> -->

              {{-- Update Button --}}
              <div class="flex gap-3">
                <button
                  type="submit"
                  class="flex-1 sm:flex-none sm:px-8 py-3 bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-colors">
                  Update Profile
                </button>
              </div>
            </form>
          </div>

          {{-- Saved Addresses Section --}}
          <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-sm">
            <div class="border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/30 px-6 py-4">
              <div class="flex items-center justify-between">
                <div>
                  <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Saved Addresses</h2>
                  <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Manage your delivery and billing addresses (Maximum 3 addresses)</p>
                </div>
                @if($addresses->count() < 3)
                  <button
                  type="button"
                  onclick="toggleAddAddressForm()"
                  class="hidden sm:inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                  </svg>
                  Add New Address
                  </button>
                  @endif
              </div>
            </div>

            <div class="p-6 lg:p-8">
              @if($addresses->count() > 0)
              {{-- Mobile Add Button --}}
              @if($addresses->count() < 3)
                <button
                type="button"
                onclick="toggleAddAddressForm()"
                class="sm:hidden w-full mb-4 flex items-center justify-center gap-2 px-4 py-2.5 border-2 border-dashed border-blue-300 dark:border-blue-700 text-blue-600 dark:text-blue-400 text-sm font-semibold hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add New Address
                </button>
                @endif

                {{-- Address Cards Grid --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4" id="address-cards-container">
                  @foreach($addresses as $address)
                  <div class="relative group border-2 {{ $address->is_default ? 'border-blue-500 dark:border-blue-400 bg-blue-50/30 dark:bg-blue-900/10' : 'border-gray-200 dark:border-gray-700 hover:border-gray-300 dark:hover:border-gray-600' }} p-5 transition-all duration-200">

                    {{-- Default Badge (Top Right) --}}
                    @if($address->is_default)
                    <div class="absolute -top-2 -right-2 bg-blue-600 dark:bg-blue-500 text-white px-3 py-1 text-xs font-semibold shadow-md">
                      DEFAULT
                    </div>
                    @endif

                    {{-- Address Type Icon & Badge --}}
                    <div class="flex items-center gap-2 mb-3">
                      <span class="material-icons-outlined text-gray-400 dark:text-gray-500 text-lg" aria-hidden="true">
                        @if($address->type === 'home') home
                        @elseif($address->type === 'work') business
                        @else location_on
                        @endif
                      </span>
                      <span class="inline-flex items-center px-2.5 py-1 text-xs font-semibold text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 uppercase tracking-wide">
                        {{ ucfirst($address->type ?? 'home') }}
                      </span>
                    </div>

                    {{-- Address Details --}}
                    <div class="mb-4">
                      <h3 class="text-base font-bold text-gray-900 dark:text-gray-100 mb-1">
                        {{ $address->name }}
                      </h3>
                      <p class="text-sm text-gray-600 dark:text-gray-400 mb-2 flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        {{ $address->phone }}
                      </p>
                      <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                        {{ $address->address_line_1 }}@if($address->address_line_2), {{ $address->address_line_2 }}@endif
                        <br>
                        {{ $address->city }}, {{ $address->state }} - {{ $address->pincode }}
                      </p>
                    </div>

                    {{-- Actions --}}
                    <div class="flex flex-wrap gap-2 pt-3 border-t border-gray-200 dark:border-gray-700">
                      @if(!$address->is_default)
                      <button
                        type="button"
                        onclick="setDefaultAddress({{ $address->id }})"
                        class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 border border-blue-200 dark:border-blue-700 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Set as default
                      </button>
                      @endif

                      <button
                        type="button"
                        onclick="editAddress({{ $address->id }})"
                        class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 border border-gray-200 dark:border-gray-600 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit
                      </button>

                      <button
                        type="button"
                        onclick="deleteAddress({{ $address->id }})"
                        class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 border border-red-200 dark:border-red-700 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Delete
                      </button>
                    </div>
                  </div>
                  @endforeach
                </div>

                {{-- Add Address Form (Hidden) --}}
                <div id="add-address-form" class="hidden border-t border-gray-200 dark:border-gray-700 pt-6">
                  <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Add New Address</h3>
                  <form id="myAccountAddressForm" class="space-y-4">
                    @csrf
                    <input type="hidden" name="address_category" value="delivery">

                    {{-- Address Type --}}
                    <div>
                      <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Address Type <span class="text-red-600">*</span>
                      </label>
                      <div class="flex gap-4">
                        <label class="flex items-center space-x-2 cursor-pointer">
                          <input type="radio" name="type" value="home" checked
                            class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500" />
                          <span class="text-sm text-gray-700 dark:text-gray-300">Home</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                          <input type="radio" name="type" value="work"
                            class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500" />
                          <span class="text-sm text-gray-700 dark:text-gray-300">Work</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                          <input type="radio" name="type" value="other"
                            class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500" />
                          <span class="text-sm text-gray-700 dark:text-gray-300">Other</span>
                        </label>
                      </div>
                    </div>

                    {{-- Name --}}
                    <div>
                      <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Full Name <span class="text-red-600">*</span>
                      </label>
                      <input type="text" name="name" id="myAccountAddressForm_name" required
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" />
                    </div>

                    {{-- Phone --}}
                    <div>
                      <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Phone Number <span class="text-red-600">*</span>
                      </label>
                      <input type="tel" name="phone" required maxlength="10" minlength="10" pattern="[0-9]{10}" inputmode="numeric" placeholder="10-digit number"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" />
                    </div>

                    {{-- Address Line 1 --}}
                    <div>
                      <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Address Line 1 <span class="text-red-600">*</span>
                      </label>
                      <input type="text" name="address_line_1" required
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" />
                    </div>

                    {{-- Address Line 2 --}}
                    <div>
                      <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Address Line 2
                      </label>
                      <input type="text" name="address_line_2"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" />
                    </div>

                    {{-- Pincode, City, State, Country --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                      <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                          Pincode <span class="text-red-600">*</span>
                        </label>
                        <input type="text" name="pincode" id="myAccountAddressForm_pincode" required maxlength="6" pattern="[0-9]{6}"
                          onblur="fetchPincodeDetails('myAccountAddressForm')"
                          class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" />
                      </div>
                      <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                          City <span class="text-red-600">*</span>
                        </label>
                        <input type="text" name="city" id="myAccountAddressForm_city" required readonly
                          class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-300" />
                      </div>
                      <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                          State <span class="text-red-600">*</span>
                        </label>
                        <input type="text" name="state" id="myAccountAddressForm_state" required readonly
                          class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-300" />
                      </div>
                      <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                          Country <span class="text-red-600">*</span>
                        </label>
                        <input type="text" name="country" id="myAccountAddressForm_country" value="India" readonly
                          class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-300" />
                      </div>
                    </div>

                    {{-- Default Checkbox --}}
                    <div class="flex items-start space-x-2">
                      <input type="checkbox" name="is_default" value="1"
                        class="mt-1 w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" />
                      <label class="text-sm text-gray-700 dark:text-gray-300 cursor-pointer">
                        Make this my default address
                      </label>
                    </div>

                    {{-- Buttons --}}
                    <div class="flex gap-3">
                      <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                        Save Address
                      </button>
                      <button type="button" onclick="cancelAddressForm()"
                        class="px-6 py-2 bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100 text-sm font-semibold hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors">
                        Cancel
                      </button>
                    </div>
                  </form>
                </div>

                {{-- Edit Address Modal/Form (Hidden) --}}
                <div id="edit-address-form" class="hidden border-t border-gray-200 dark:border-gray-700 pt-6">
                  <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Edit Address</h3>
                  <div id="edit-address-form-content"></div>
                </div>

                @else
                {{-- No Addresses Empty State --}}
                <div class="text-center py-16 px-6 border-2 border-dashed border-gray-300 dark:border-gray-600 bg-gray-50/50 dark:bg-gray-900/20">
                  <div class="max-w-md mx-auto">
                    <div class="w-20 h-20 bg-blue-100 dark:bg-blue-900/20 rounded-full flex items-center justify-center mx-auto mb-4">
                      <span class="material-icons-outlined text-5xl text-blue-600 dark:text-blue-400" aria-hidden="true">add_location_alt</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">No Saved Addresses</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                      Add your delivery address to make checkout faster and easier. You can save up to 3 addresses.
                    </p>
                    <button
                      type="button"
                      onclick="toggleAddAddressForm()"
                      class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors shadow-md">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                      </svg>
                      Add Your First Address
                    </button>
                  </div>
                </div>

                {{-- Add Address Form (Will be shown when clicked) --}}
                <div id="add-address-form" class="hidden mt-6 border-t border-gray-200 dark:border-gray-700 pt-6">
                  <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Add New Address</h3>
                  <form id="myAccountAddressForm" class="space-y-4">
                    @csrf
                    <input type="hidden" name="address_category" value="delivery">

                    {{-- Address Type --}}
                    <div>
                      <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Address Type <span class="text-red-600">*</span>
                      </label>
                      <div class="flex gap-4">
                        <label class="flex items-center space-x-2 cursor-pointer">
                          <input type="radio" name="type" value="home" checked
                            class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500" />
                          <span class="text-sm text-gray-700 dark:text-gray-300">Home</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                          <input type="radio" name="type" value="work"
                            class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500" />
                          <span class="text-sm text-gray-700 dark:text-gray-300">Work</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                          <input type="radio" name="type" value="other"
                            class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500" />
                          <span class="text-sm text-gray-700 dark:text-gray-300">Other</span>
                        </label>
                      </div>
                    </div>

                    {{-- Name --}}
                    <div>
                      <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Full Name <span class="text-red-600">*</span>
                      </label>
                      <input type="text" name="name" id="myAccountAddressForm_name" required
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" />
                    </div>

                    {{-- Phone --}}
                    <div>
                      <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Phone Number <span class="text-red-600">*</span>
                      </label>
                      <input type="tel" name="phone" required maxlength="10" minlength="10" pattern="[0-9]{10}" inputmode="numeric" placeholder="10-digit number"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" />
                    </div>

                    {{-- Address Line 1 --}}
                    <div>
                      <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Address Line 1 <span class="text-red-600">*</span>
                      </label>
                      <input type="text" name="address_line_1" required
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" />
                    </div>

                    {{-- Address Line 2 --}}
                    <div>
                      <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Address Line 2
                      </label>
                      <input type="text" name="address_line_2"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" />
                    </div>

                    {{-- Pincode, City, State, Country --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                      <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                          Pincode <span class="text-red-600">*</span>
                        </label>
                        <input type="text" name="pincode" id="myAccountAddressForm_pincode" required maxlength="6" pattern="[0-9]{6}"
                          onblur="fetchPincodeDetails('myAccountAddressForm')"
                          class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" />
                      </div>
                      <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                          City <span class="text-red-600">*</span>
                        </label>
                        <input type="text" name="city" id="myAccountAddressForm_city" required readonly
                          class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-300" />
                      </div>
                      <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                          State <span class="text-red-600">*</span>
                        </label>
                        <input type="text" name="state" id="myAccountAddressForm_state" required readonly
                          class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-300" />
                      </div>
                      <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                          Country <span class="text-red-600">*</span>
                        </label>
                        <input type="text" name="country" id="myAccountAddressForm_country" value="India" readonly
                          class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-300" />
                      </div>
                    </div>

                    {{-- Default Checkbox --}}
                    <div class="flex items-start space-x-2">
                      <input type="checkbox" name="is_default" value="1"
                        class="mt-1 w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" />
                      <label class="text-sm text-gray-700 dark:text-gray-300 cursor-pointer">
                        Make this my default address
                      </label>
                    </div>

                    {{-- Buttons --}}
                    <div class="flex gap-3">
                      <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                        Save Address
                      </button>
                      <button type="button" onclick="cancelAddressForm()"
                        class="px-6 py-2 bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100 text-sm font-semibold hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors">
                        Cancel
                      </button>
                    </div>
                  </form>
                </div>
                @endif

                {{-- Maximum Limit Reached Message --}}
                @if($addresses->count() >= 3)
                <div class="mt-6 p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 flex items-start gap-3">
                  <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                  </svg>
                  <div class="flex-1">
                    <p class="text-sm font-medium text-blue-900 dark:text-blue-200">
                      Maximum Address Limit Reached
                    </p>
                    <p class="text-sm text-blue-700 dark:text-blue-300 mt-1">
                      You've saved 3 addresses (maximum allowed). To add a new address, please delete an existing one first.
                    </p>
                  </div>
                </div>
                @endif
            </div>
          </div>
        </div>

        {{-- Customer Service Tab --}}
        <div id="content-support" class="tab-content hidden">
          <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 mb-6">Customer Service</h1>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6">
              <div class="flex items-start">
                <span class="material-icons-outlined text-blue-600 dark:text-blue-400 text-3xl mr-4" aria-hidden="true">email</span>
                <div>
                  <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Email Support</h3>
                  <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Get help via email within 24 hours</p>
                  <a href="mailto:support@celigin.com" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 text-sm font-semibold">
                    support@celigin.com
                  </a>
                </div>
              </div>
            </div>

            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6">
              <div class="flex items-start">
                <span class="material-icons-outlined text-blue-600 dark:text-blue-400 text-3xl mr-4" aria-hidden="true">phone</span>
                <div>
                  <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Phone Support</h3>
                  <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Talk to our support team</p>
                  <a href="tel:+911234567890" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 text-sm font-semibold">
                    +91 123 456 7890
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

        {{-- Affiliate Tab --}}
        <div id="content-affiliate" class="tab-content hidden">
          @php
            $user          = Auth::user();
            $affiliateActive = $user->reffered_times > 0;
            $affiliateCode = $user->affilate_code;
            $affiliateLink = $affiliateActive ? url('?affilate_code=' . $affiliateCode) : '';
            $thClass       = 'text-left text-xs font-semibold text-neutral-500 uppercase tracking-wider py-3 px-4';
          @endphp

          <h1 class="text-2xl sm:text-3xl font-bold text-neutral-900 dark:text-white mb-6">Affiliate Program</h1>

          <div class="bg-white dark:bg-neutral-800 border border-neutral-200 dark:border-neutral-700 p-6 lg:p-8">

            {{-- Hero --}}
            <div class="text-center pb-8 mb-8 border-b border-neutral-200 dark:border-neutral-700">
              <span class="material-icons-outlined text-6xl text-gray-400 dark:text-gray-500 mb-4 block" aria-hidden="true">groups</span>
              <h2 class="text-xl font-semibold text-neutral-900 dark:text-white mb-3">Join Our Affiliate Program</h2>
              <p class="text-neutral-500 dark:text-neutral-400 mb-6 max-w-2xl mx-auto">
                Earn commissions by referring customers. Share your unique affiliate link and get rewarded for every sale you drive.
              </p>
              @if(!$affiliateActive)
                <button
                  id="activateAffiliateBtn"
                  onclick="activateAffiliate()"
                  aria-label="Activate your affiliate account"
                  class="px-6 py-3 bg-primary-800 text-white font-semibold hover:bg-primary-900 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2">
                  Activate Affiliate
                </button>
              @else
                <span class="inline-flex items-center gap-2 px-4 py-2 bg-primary-900 text-white text-sm font-medium" role="status">
                  <span class="material-icons-outlined text-base" aria-hidden="true">check_circle</span>
                  Affiliate Activated
                </span>
              @endif
            </div>

            {{-- Affiliate Link Box --}}
            <div class="border border-neutral-200 dark:border-neutral-700 p-5 mb-8 {{ !$affiliateActive ? 'opacity-50 pointer-events-none select-none' : '' }}"
                 aria-disabled="{{ !$affiliateActive ? 'true' : 'false' }}">
              <h3 class="font-semibold text-neutral-900 dark:text-white mb-1" id="affiliateLinkHeading">Your Affiliate Link</h3>
              <p class="text-sm text-neutral-500 dark:text-neutral-400 mb-3">
                {{ $affiliateActive ? 'Share this link to earn commissions on every referred purchase.' : 'Activate your affiliate account above to unlock your unique link.' }}
              </p>
              <div class="flex flex-col sm:flex-row gap-2">
                <input
                  type="text"
                  id="affiliateReferralLink"
                  value="{{ $affiliateLink }}"
                  readonly
                  aria-label="Your affiliate referral link"
                  aria-describedby="affiliateLinkHeading"
                  placeholder="{{ !$affiliateActive ? 'Activate affiliate to see your link' : '' }}"
                  class="flex-1 text-sm border border-neutral-200 dark:border-neutral-700 px-3 py-2 text-neutral-600 dark:text-neutral-300 bg-neutral-50 dark:bg-neutral-900 focus:outline-none focus:border-gray-500">
                <button
                  id="copyAffiliateBtn"
                  onclick="copyAffiliateLink()"
                  aria-label="Copy affiliate link to clipboard"
                  class="bg-primary-800 text-white px-5 py-2 text-sm font-medium hover:bg-primary-900 transition-colors whitespace-nowrap focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2">
                  Copy Link
                </button>
              </div>
              <span id="affiliateCopyFeedback" class="sr-only" aria-live="polite" aria-atomic="true"></span>
            </div>

            {{-- Earnings Table --}}
            <div>
              <h3 class="text-base font-semibold text-neutral-900 dark:text-white mb-4" id="affiliateEarningsHeading">Affiliate Earnings</h3>
              <div class="overflow-x-auto border border-neutral-200 dark:border-neutral-700">
                <table class="w-full min-w-max border-collapse text-sm" aria-labelledby="affiliateEarningsHeading">
                  <caption class="sr-only">Affiliate earnings showing products, customers, order amounts, commissions, and payment status</caption>
                  <thead>
                    <tr class="bg-neutral-50 dark:bg-neutral-900 border-b border-neutral-200 dark:border-neutral-700">
                      <th scope="col" class="{{ $thClass }}">#</th>
                      <th scope="col" class="{{ $thClass }}">Product</th>
                      <th scope="col" class="{{ $thClass }}">Customer</th>
                      <th scope="col" class="{{ $thClass }}">Order Amount</th>
                      <th scope="col" class="{{ $thClass }}">Commission</th>
                      <th scope="col" class="{{ $thClass }}">Status</th>
                    </tr>
                  </thead>
                  <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                    @php $rowNum = 0; @endphp
                    @forelse($final_affilate_users as $fuser)
                      @php $cart = json_decode($fuser->cart, true); @endphp
                      @foreach($cart['items'] ?? [] as $c)
                        @php
                          $rowNum++;
                          $statusKey = strtolower($fuser->status ?? '');
                          [$badgeClass, $badgeLabel] = match(true) {
                              in_array($statusKey, ['active', 'paid', 'completed']) => ['bg-gray-900 dark:bg-gray-100 text-white dark:text-gray-900', ucfirst($fuser->status)],
                              $statusKey === 'pending' => ['border border-neutral-400 text-neutral-600 dark:text-neutral-300', 'Pending'],
                              default => ['bg-neutral-200 dark:bg-neutral-700 text-neutral-700 dark:text-neutral-300', ucfirst($fuser->status)],
                          };
                        @endphp
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                          <td class="py-3 px-4 text-neutral-500 whitespace-nowrap">{{ $rowNum }}</td>
                          <td class="py-3 px-4 font-medium text-neutral-900 dark:text-white">
                            <a href="{{ route('front.product', $c['item']['slug']) }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               aria-label="{{ $c['item']['name'] }} (opens in new tab)"
                               class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100 hover:underline">
                              {{ $c['item']['name'] }}
                            </a>
                          </td>
                          <td class="py-3 px-4 text-neutral-700 dark:text-neutral-300 whitespace-nowrap">{{ $fuser->customer_name }}</td>
                          <td class="py-3 px-4 text-neutral-700 dark:text-neutral-300 whitespace-nowrap">{{ App\Models\Product::vendorConvertPrice($fuser->pay_amount) }}</td>
                          <td class="py-3 px-4 font-medium text-gray-900 dark:text-gray-100 whitespace-nowrap">{{ App\Models\Product::vendorConvertPrice($fuser->affilate_charge) }}</td>
                          <td class="py-3 px-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium {{ $badgeClass }}">{{ $badgeLabel }}</span>
                          </td>
                        </tr>
                      @endforeach
                    @empty
                      <tr>
                        <td colspan="6" class="py-12 text-center">
                          <span class="material-icons-outlined text-5xl text-neutral-300 dark:text-neutral-600 block mb-3" aria-hidden="true">storefront</span>
                          <p class="font-medium text-neutral-700 dark:text-neutral-300 mb-1">No earnings yet</p>
                          <p class="text-sm text-neutral-500">Share your affiliate link to start earning commissions</p>
                        </td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>

          </div>
        </div>

        {{-- CELIGIN Points Tab --}}
        <div id="content-points" class="tab-content hidden">
          @php
            $referralCode = Auth::user()->refferel_code ?? '';
            $referralLink = url('/?refferel_code=' . $referralCode);
            $thClass      = 'text-left text-xs font-semibold text-neutral-500 uppercase tracking-wider py-3 px-4';
          @endphp

          <h1 class="text-2xl sm:text-3xl font-bold text-neutral-900 dark:text-white mb-6">CELIGIN Points</h1>

          <div class="bg-white dark:bg-neutral-800 border border-neutral-200 dark:border-neutral-700 p-6 lg:p-8">

            {{-- Points Balance --}}
            <div class="text-center py-8 mb-8 bg-gray-50 dark:bg-gray-700/40 border border-gray-200 dark:border-gray-700"
                 role="region" aria-label="Your points balance">
              <div class="flex items-center justify-center gap-3 mb-2">
                <span class="material-icons-outlined text-4xl text-gray-400 dark:text-gray-500" aria-hidden="true">stars</span>
                <span class="text-5xl sm:text-6xl font-bold text-neutral-900 dark:text-white"
                      aria-label="{{ round(Auth::user()->current_balance ?? 0) }} available points">
                  {{ round(Auth::user()->current_balance ?? 0) }}
                </span>
              </div>
              <p class="text-sm font-medium text-neutral-500 uppercase tracking-wider" aria-hidden="true">Available Points</p>
            </div>

            {{-- How It Works Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">

              {{-- Earn --}}
              <div class="border border-neutral-200 dark:border-neutral-700 p-5 text-center">
                <span class="material-icons-outlined text-3xl text-gray-400 dark:text-gray-500 mb-3 block" aria-hidden="true">shopping_cart</span>
                <h3 class="font-semibold text-neutral-900 dark:text-white mb-1">Earn on Purchases</h3>
                <p class="text-sm text-neutral-500 dark:text-neutral-400">Get 1 point for every ₹100 spent</p>
              </div>

              {{-- Redeem --}}
              <div class="border border-neutral-200 dark:border-neutral-700 p-5 text-center">
                <span class="material-icons-outlined text-3xl text-gray-400 dark:text-gray-500 mb-3 block" aria-hidden="true">card_giftcard</span>
                <h3 class="font-semibold text-neutral-900 dark:text-white mb-1">Redeem Rewards</h3>
                <p class="text-sm text-neutral-500 dark:text-neutral-400">Use points for discounts on orders</p>
              </div>

              {{-- Refer Friends --}}
              <div class="border border-neutral-200 dark:border-neutral-700 p-5 text-center sm:col-span-2 lg:col-span-1">
                <span class="material-icons-outlined text-3xl text-gray-400 dark:text-gray-500 mb-3 block" aria-hidden="true">share</span>
                <h3 class="font-semibold text-neutral-900 dark:text-white mb-1" id="referralLinkHeading">Refer Friends</h3>
                <p class="text-sm text-neutral-500 dark:text-neutral-400 mb-4">Earn bonus points for referrals</p>

                {{-- Referral Link Input --}}
                <input
                  type="text"
                  id="referralLink"
                  value="{{ $referralLink }}"
                  readonly
                  aria-label="Your referral link"
                  aria-describedby="referralLinkHeading"
                  class="w-full text-xs border border-neutral-200 dark:border-neutral-700 px-3 py-2 mb-2 text-center text-neutral-600 dark:text-neutral-300 bg-neutral-50 dark:bg-neutral-900 select-all focus:outline-none focus:border-gray-500">

                {{-- Copy Button --}}
                <button
                  id="copyReferralBtn"
                  onclick="copyReferral()"
                  aria-label="Copy referral link to clipboard"
                  class="w-full bg-primary-800 text-white px-4 py-2 text-sm font-medium hover:bg-primary-900 transition-colors mb-2 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2">
                  Copy Link
                </button>
                <span id="referralCopyFeedback" class="sr-only" aria-live="polite" aria-atomic="true"></span>

                {{-- Social Share --}}
                <div class="flex justify-center gap-3 mt-3" role="group" aria-label="Share referral link on social media">
                  <a id="whatsappShare" target="_blank" rel="noopener noreferrer"
                     aria-label="Share on WhatsApp (opens in new tab)"
                     class="w-9 h-9 flex items-center justify-center rounded-full bg-green-500 hover:bg-green-600 transition-colors focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                    <svg class="w-4 h-4 fill-white" viewBox="0 0 32 32" aria-hidden="true">
                      <path d="M16.1 3C9.4 3 4 8.4 4 15.1c0 2.7.9 5.2 2.4 7.3L4 29l6.8-2.2c2 .9 4.2 1.4 6.5 1.4 6.7 0 12.1-5.4 12.1-12.1C28.2 8.4 22.8 3 16.1 3zm0 22.1c-2.1 0-4.1-.6-5.9-1.7l-.4-.2-4 1.3 1.3-3.9-.3-.4c-1.1-1.8-1.7-3.9-1.7-6.1 0-6 4.9-10.9 10.9-10.9S27 9.1 27 15.1 22.1 25.1 16.1 25.1zm6-8.2c-.3-.1-1.9-.9-2.2-1s-.5-.1-.7.1-.8 1-.9 1.2-.3.2-.6.1-1.2-.4-2.3-1.4c-.8-.7-1.4-1.6-1.5-1.9-.2-.3 0-.4.1-.6.1-.1.3-.3.4-.5.1-.2.1-.3.2-.5s0-.3 0-.5-.7-1.8-.9-2.4c-.2-.6-.4-.5-.7-.5h-.6c-.2 0-.5.1-.7.3-.2.2-.9.9-.9 2.1s.9 2.4 1 2.6c.1.2 1.7 2.6 4.2 3.6 2.4 1 2.4.7 2.8.7.4 0 1.4-.6 1.6-1.1.2-.5.2-1 .1-1.1z" />
                    </svg>
                  </a>
                  <a id="facebookShare" target="_blank" rel="noopener noreferrer"
                     aria-label="Share on Facebook (opens in new tab)"
                     class="w-9 h-9 flex items-center justify-center rounded-full bg-[#1877F2] hover:bg-[#166FE5] transition-colors focus:outline-none focus:ring-2 focus:ring-[#1877F2] focus:ring-offset-2">
                    <svg class="w-4 h-4 fill-white" viewBox="0 0 24 24" aria-hidden="true">
                      <path d="M22.675 0h-21.35C.6 0 0 .6 0 1.326v21.348C0 23.4.6 24 1.326 24h11.495v-9.294H9.691V11.01h3.13V8.309c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.464.099 2.795.143v3.24h-1.918c-1.504 0-1.795.715-1.795 1.763v2.31h3.587l-.467 3.696h-3.12V24h6.116C23.4 24 24 23.4 24 22.674V1.326C24 .6 23.4 0 22.675 0z" />
                    </svg>
                  </a>
                  <a id="twitterShare" target="_blank" rel="noopener noreferrer"
                     aria-label="Share on X (opens in new tab)"
                     class="w-9 h-9 flex items-center justify-center rounded-full bg-neutral-900 hover:bg-neutral-700 transition-colors focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:ring-offset-2">
                    <svg class="w-4 h-4 fill-white" viewBox="0 0 24 24" aria-hidden="true">
                      <path d="M18.244 2H21.49l-7.09 8.1L22.75 22h-6.39l-5-6.56L5.78 22H2.53l7.58-8.67L1.5 2h6.55l4.52 5.98L18.24 2z" />
                    </svg>
                  </a>
                  <a id="telegramShare" target="_blank" rel="noopener noreferrer"
                     aria-label="Share on Telegram (opens in new tab)"
                     class="w-9 h-9 flex items-center justify-center rounded-full bg-[#2AABEE] hover:bg-[#229ED9] transition-colors focus:outline-none focus:ring-2 focus:ring-[#2AABEE] focus:ring-offset-2">
                    <svg class="w-4 h-4 fill-white" viewBox="0 0 24 24" aria-hidden="true">
                      <path d="M9.993 15.522l-.397 5.584c.568 0 .815-.245 1.111-.539l2.667-2.532 5.523 4.035c1.012.56 1.728.265 1.986-.935l3.6-16.88c.319-1.49-.538-2.07-1.515-1.7L1.353 9.6c-1.454.566-1.432 1.38-.248 1.745l5.524 1.72L19.41 5.44c.664-.44 1.27-.197.772.243" />
                    </svg>
                  </a>
                </div>
              </div>

            </div>{{-- end grid --}}

            {{-- Referral History --}}
            <div>
              <h3 class="text-base font-semibold text-neutral-900 dark:text-white mb-4" id="referralHistoryHeading">Referral History</h3>
              <div class="overflow-x-auto border border-neutral-200 dark:border-neutral-700">
                <table class="w-full min-w-max border-collapse text-sm" aria-labelledby="referralHistoryHeading">
                  <caption class="sr-only">Referral history showing referred friends, their purchase amounts, and reward status</caption>
                  <thead>
                    <tr class="bg-neutral-50 dark:bg-neutral-900 border-b border-neutral-200 dark:border-neutral-700">
                      <th scope="col" class="{{ $thClass }}">#</th>
                      <th scope="col" class="{{ $thClass }}">Referred Friend</th>
                      <th scope="col" class="{{ $thClass }}">Purchase Amount</th>
                      <th scope="col" class="{{ $thClass }}">Status</th>
                    </tr>
                  </thead>
                  <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                    @forelse($final_refferal_users as $fuser)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                      <td class="py-3 px-4 text-neutral-500 whitespace-nowrap">{{ $loop->iteration }}</td>
                      <td class="py-3 px-4 font-medium text-neutral-900 dark:text-white whitespace-nowrap">{{ $fuser->customer_name }}</td>
                      <td class="py-3 px-4 text-neutral-700 dark:text-neutral-300 whitespace-nowrap">{{ App\Models\Product::vendorConvertPrice($fuser->affilate_charge) }}</td>
                      <td class="py-3 px-4 whitespace-nowrap">
                        @php
                          $statusKey = strtolower($fuser->status ?? '');
                          [$badgeClass, $badgeLabel] = match(true) {
                              $statusKey === 'active' => ['bg-gray-900 dark:bg-gray-100 text-white dark:text-gray-900', 'Active'],
                              $statusKey === 'pending' => ['border border-neutral-400 text-neutral-600 dark:text-neutral-300', 'Pending'],
                              default => ['bg-neutral-200 dark:bg-neutral-700 text-neutral-700 dark:text-neutral-300', ucfirst($fuser->status)],
                          };
                        @endphp
                        <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium {{ $badgeClass }}">{{ $badgeLabel }}</span>
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="4" class="py-12 text-center">
                        <span class="material-icons-outlined text-5xl text-neutral-300 dark:text-neutral-600 block mb-3" aria-hidden="true">group_add</span>
                        <p class="font-medium text-neutral-700 dark:text-neutral-300 mb-1">No referrals yet</p>
                        <p class="text-sm text-neutral-500">Share your referral link above to start earning bonus points</p>
                      </td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>
</main>

{{-- Tab Switching JavaScript --}}

<script>
  const referralLink = "{{ url('/?refferel_code=' . Auth::user()->refferel_code) }}";
  const shareText    = "Join using my referral link & earn rewards!";

  // Shared copy utility — eliminates duplication between referral and affiliate copy buttons
  function copyToClipboard(value, btnId, feedbackId, feedbackMsg, fallbackInputId) {
    navigator.clipboard.writeText(value).then(() => {
      const btn      = document.getElementById(btnId);
      const feedback = document.getElementById(feedbackId);
      if (btn) {
        btn.textContent = 'Copied!';
        btn.disabled = true;
        setTimeout(() => { btn.textContent = 'Copy Link'; btn.disabled = false; }, 2000);
      }
      if (feedback) {
        feedback.textContent = feedbackMsg;
        setTimeout(() => { feedback.textContent = ''; }, 2000);
      }
    }).catch(() => {
      const input = document.getElementById(fallbackInputId);
      if (input) { input.select(); document.execCommand('copy'); }
    });
  }

  function copyReferral() {
    copyToClipboard(referralLink, 'copyReferralBtn', 'referralCopyFeedback', 'Referral link copied to clipboard', 'referralLink');
  }

  function copyAffiliateLink() {
    const input = document.getElementById('affiliateReferralLink');
    if (!input || !input.value) return;
    copyToClipboard(input.value, 'copyAffiliateBtn', 'affiliateCopyFeedback', 'Affiliate link copied to clipboard', 'affiliateReferralLink');
  }

  document.getElementById('whatsappShare').href =
    `https://wa.me/?text=${encodeURIComponent(shareText + ' ' + referralLink)}`;

  document.getElementById('facebookShare').href =
    `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(referralLink)}`;

  document.getElementById('twitterShare').href =
    `https://twitter.com/intent/tweet?text=${encodeURIComponent(shareText)}&url=${encodeURIComponent(referralLink)}`;

  document.getElementById('telegramShare').href =
    `https://t.me/share/url?url=${encodeURIComponent(referralLink)}&text=${encodeURIComponent(shareText)}`;
</script>


<script>
  function switchTab(event, tabName) {
    if (event) event.preventDefault();

    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(content => {
      content.classList.add('hidden');
    });

    // Remove active class from all tab links
    document.querySelectorAll('.tab-link').forEach(link => {
      link.classList.remove('active', 'bg-primary-100', 'dark:bg-primary-900/20', 'text-primary-800', 'dark:text-primary-400', 'font-semibold');
    });

    // Show selected tab content
    const selectedContent = document.getElementById('content-' + tabName);
    if (selectedContent) {
      selectedContent.classList.remove('hidden');
    }

    // Add active class to selected tab link
    const selectedLink = document.querySelector(`[data-tab="${tabName}"]`);
    if (selectedLink) {
      selectedLink.classList.add('active', 'bg-primary-100', 'dark:bg-primary-900/20', 'text-primary-800', 'dark:text-primary-400', 'font-semibold');
    }

    // Update URL hash without scrolling
    if (history.pushState) {
      history.pushState(null, null, '#' + tabName);
    } else {
      window.location.hash = tabName;
    }
  }

  // Handle initial page load with hash
  document.addEventListener('DOMContentLoaded', function() {
    // Check for _hash query param (from search/filter forms) or URL hash
    const urlParams = new URLSearchParams(window.location.search);
    const hashParam = urlParams.get('_hash');
    const hash = hashParam || window.location.hash.substring(1);
    if (hash) {
      switchTab(null, hash);
      // Clean URL: replace _hash param with actual hash
      if (hashParam) {
        urlParams.delete('_hash');
        const newSearch = urlParams.toString();
        const newUrl = window.location.pathname + (newSearch ? '?' + newSearch : '') + '#' + hash;
        history.replaceState(null, null, newUrl);
      }
    }

    // Attach event listener to add address form
    const addAddressForm = document.getElementById('myAccountAddressForm');
    if (addAddressForm) {
      addAddressForm.addEventListener('submit', function(e) {
        e.preventDefault();
        saveNewAddress(this);
      });
    }
  });

  // Toggle add address form
  function toggleAddAddressForm() {
    const form = document.getElementById('add-address-form');
    const editForm = document.getElementById('edit-address-form');

    // Hide edit form if open
    if (editForm && !editForm.classList.contains('hidden')) {
      editForm.classList.add('hidden');
    }

    // Toggle add form
    if (form) {
      form.classList.toggle('hidden');
      if (!form.classList.contains('hidden')) {
        const nameInput = document.getElementById('myAccountAddressForm_name');
        if (nameInput) nameInput.focus();
      }
    }
  }

  // Cancel address form
  function cancelAddressForm() {
    const addForm = document.getElementById('add-address-form');
    const editForm = document.getElementById('edit-address-form');

    if (addForm && !addForm.classList.contains('hidden')) {
      addForm.classList.add('hidden');
      const form = document.getElementById('myAccountAddressForm');
      if (form) form.reset();
    }

    if (editForm && !editForm.classList.contains('hidden')) {
      editForm.classList.add('hidden');
    }
  }

  // Edit address
  function editAddress(addressId) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch(`{{ url('/user/addresses') }}/${addressId}/edit`, {
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          'Accept': 'application/json'
        }
      })
      .then(async r => { const d = await r.json(); if (!r.ok) throw d; return d; })
      .then(data => {
        if (data.address) {
          showEditForm(data.address);
        }
      })
      .catch(error => {
        console.error('Error:', error);
        showToast('Failed to load address details', 'error');
      });
  }

  // Show edit form
  function showEditForm(address) {
    const addForm = document.getElementById('add-address-form');
    const editFormContainer = document.getElementById('edit-address-form');
    const editFormContent = document.getElementById('edit-address-form-content');

    // Hide add form
    if (addForm) addForm.classList.add('hidden');

    // Create edit form with populated data
    editFormContent.innerHTML = `
      <form id="editAddressForm" class="space-y-4">
        <input type="hidden" name="address_id" value="${address.id}">

        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Address Type <span class="text-red-600">*</span>
          </label>
          <div class="flex gap-4">
            <label class="flex items-center space-x-2 cursor-pointer">
              <input type="radio" name="type" value="home" ${address.type === 'home' ? 'checked' : ''}
                class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500" />
              <span class="text-sm text-gray-700 dark:text-gray-300">Home</span>
            </label>
            <label class="flex items-center space-x-2 cursor-pointer">
              <input type="radio" name="type" value="work" ${address.type === 'work' ? 'checked' : ''}
                class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500" />
              <span class="text-sm text-gray-700 dark:text-gray-300">Work</span>
            </label>
            <label class="flex items-center space-x-2 cursor-pointer">
              <input type="radio" name="type" value="other" ${address.type === 'other' ? 'checked' : ''}
                class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500" />
              <span class="text-sm text-gray-700 dark:text-gray-300">Other</span>
            </label>
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Full Name <span class="text-red-600">*</span>
          </label>
          <input type="text" name="name" value="${address.name}" required
            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Phone Number <span class="text-red-600">*</span>
          </label>
          <input type="tel" name="phone" value="${address.phone ?? ''}" required maxlength="10" minlength="10" pattern="[0-9]{10}" inputmode="numeric" placeholder="10-digit number"
            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Address Line 1 <span class="text-red-600">*</span>
          </label>
          <input type="text" name="address_line_1" value="${address.address_line_1}" required
            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Address Line 2
          </label>
          <input type="text" name="address_line_2" value="${address.address_line_2 || ''}"
            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" />
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Pincode <span class="text-red-600">*</span>
            </label>
            <input type="text" name="pincode" value="${address.pincode}" required maxlength="6" pattern="[0-9]{6}"
              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              City <span class="text-red-600">*</span>
            </label>
            <input type="text" name="city" value="${address.city}" required readonly
              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-300" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              State <span class="text-red-600">*</span>
            </label>
            <input type="text" name="state" value="${address.state}" required readonly
              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-300" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Country <span class="text-red-600">*</span>
            </label>
            <input type="text" name="country" value="India" readonly
              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-300" />
          </div>
        </div>

        <div class="flex items-start space-x-2">
          <input type="checkbox" name="is_default" value="1" ${address.is_default ? 'checked' : ''}
            class="mt-1 w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" />
          <label class="text-sm text-gray-700 dark:text-gray-300 cursor-pointer">
            Make this my default address
          </label>
        </div>

        <div class="flex gap-3">
          <button type="submit"
            class="px-6 py-2 bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
            Update Address
          </button>
          <button type="button" onclick="cancelAddressForm()"
            class="px-6 py-2 bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100 text-sm font-semibold hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors">
            Cancel
          </button>
        </div>
      </form>
    `;

    // Show edit form
    editFormContainer.classList.remove('hidden');

    // Attach submit handler
    document.getElementById('editAddressForm').addEventListener('submit', function(e) {
      e.preventDefault();
      updateAddress(address.id, this);
    });
  }

  // Update address — PUT with JSON (PHP only parses multipart for POST, not PUT)
  function updateAddress(addressId, form) {
    const formData = new FormData(form);
    const data = {};
    formData.forEach((value, key) => { if (key !== '_token') data[key] = value; });
    data.is_default = form.querySelector('[name="is_default"]')?.checked ? 1 : 0;

    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn.textContent;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    submitBtn.disabled = true;
    submitBtn.textContent = 'Updating...';

    fetch(`{{ url('/user/addresses') }}/${addressId}`, {
        method: 'PUT',
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
      })
      .then(async r => { const d = await r.json(); if (!r.ok) throw d; return d; })
      .then(data => {
        submitBtn.disabled = false;
        submitBtn.textContent = originalText;
        showToast(data.message || 'Address updated successfully', 'success');
        setTimeout(() => window.location.reload(), 1000);
      })
      .catch(error => {
        submitBtn.disabled = false;
        submitBtn.textContent = originalText;
        const msg = error.errors ? Object.values(error.errors).flat().join('\n') : (error.message || 'Failed to update address');
        showToast(msg, 'error');
      });
  }

  // Delete address
  function deleteAddress(addressId) {
    if (!confirm('Are you sure you want to delete this address?')) {
      return;
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch(`{{ url('/user/addresses') }}/${addressId}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          'Accept': 'application/json'
        }
      })
      .then(async r => { const d = await r.json(); if (!r.ok) throw d; return d; })
      .then(data => {
        showToast(data.message || 'Address deleted successfully', 'success');
        setTimeout(() => window.location.reload(), 1000);
      })
      .catch(error => {
        const msg = error.errors ? Object.values(error.errors).flat().join('\n') : (error.message || 'Failed to delete address');
        showToast(msg, 'error');
      });
  }

  // Set default address
  function setDefaultAddress(addressId) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch(`{{ url('/user/addresses') }}/${addressId}/set-default`, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          'Accept': 'application/json'
        }
      })
      .then(async r => { const d = await r.json(); if (!r.ok) throw d; return d; })
      .then(data => {
        showToast(data.message || 'Default address updated', 'success');
        setTimeout(() => window.location.reload(), 1000);
      })
      .catch(error => {
        const msg = error.errors ? Object.values(error.errors).flat().join('\n') : (error.message || 'Failed to update default address');
        showToast(msg, 'error');
      });
  }

  // Save new address
  function saveNewAddress(form) {
    const formData = new FormData(form);
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn.textContent;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    submitBtn.disabled = true;
    submitBtn.textContent = 'Saving...';

    fetch('{{ route("user.addresses.store") }}', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          'Accept': 'application/json'
        },
        body: formData
      })
      .then(async r => { const d = await r.json(); if (!r.ok) throw d; return d; })
      .then(data => {
        submitBtn.disabled = false;
        submitBtn.textContent = originalText;
        showToast(data.message || 'Address saved successfully', 'success');
        setTimeout(() => window.location.reload(), 1000);
      })
      .catch(error => {
        submitBtn.disabled = false;
        submitBtn.textContent = originalText;
        const msg = error.errors ? Object.values(error.errors).flat().join('\n') : (error.error || error.message || 'Failed to save address');
        showToast(msg, 'error');
      });
  }

  // Fetch pincode details — shared by add and edit forms
  function fetchPincodeDetails(formId) {
    const pincodeInput = document.getElementById(`${formId}_pincode`);
    const cityInput    = document.getElementById(`${formId}_city`);
    const stateInput   = document.getElementById(`${formId}_state`);

    if (!pincodeInput || !cityInput || !stateInput) return;

    const pincode = pincodeInput.value.trim();

    if (pincode.length !== 6 || !/^\d{6}$/.test(pincode)) {
      cityInput.value = '';
      stateInput.value = '';
      return;
    }

    cityInput.value  = 'Loading...';
    stateInput.value = 'Loading...';

    fetch(`https://api.postalpincode.in/pincode/${pincode}`)
      .then(r => r.json())
      .then(data => {
        if (data[0]?.Status === 'Success') {
          const po = data[0].PostOffice[0];
          cityInput.value  = po.District ?? '';
          stateInput.value = po.State    ?? '';
          const countryInput = document.getElementById(`${formId}_country`);
          if (countryInput) countryInput.value = po.Country ?? 'India';
        } else {
          cityInput.value  = '';
          stateInput.value = '';
          showToast('Pincode not found. Please enter city manually.', 'warning');
        }
      })
      .catch(() => {
        cityInput.value  = '';
        stateInput.value = '';
        showToast('Could not fetch location details', 'error');
      });
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

  // Remove single wishlist item
  function removeWishlistItem(wishlistId) {
    if (!confirm('Are you sure you want to remove this item from your wishlist?')) {
      return;
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch(`{{ url('/') }}/user/wishlist/${wishlistId}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          'Accept': 'application/json'
        }
      })
      .then(response => response.json())
      .then(data => {
        if (data.success || data.message) {
          showToast(data.message || 'Item removed from wishlist', 'success');
          setTimeout(() => window.location.reload(), 1000);
        } else {
          showToast(data.error || 'Failed to remove item', 'error');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        showToast('An error occurred while removing the item', 'error');
      });
  }

  // Switch order sub-tabs (Orders / Buy Again)
  function switchOrderSubTab(tab) {
    document.querySelectorAll('.order-subtab').forEach(btn => {
      btn.classList.remove('border-primary-800', 'dark:border-primary-400', 'text-primary-800', 'dark:text-primary-400');
      btn.classList.add('border-transparent', 'text-neutral-500', 'dark:text-neutral-400');
    });

    const activeBtn = document.getElementById('subtab-' + tab);
    if (activeBtn) {
      activeBtn.classList.add('border-primary-800', 'dark:border-primary-400', 'text-primary-800', 'dark:text-primary-400');
      activeBtn.classList.remove('border-transparent', 'text-neutral-500', 'dark:text-neutral-400');
    }

    document.getElementById('orders-subtab-content').classList.toggle('hidden', tab !== 'orders');
    document.getElementById('buyagain-subtab-content').classList.toggle('hidden', tab !== 'buyagain');
  }

  // Add to cart
  function addToCart(productId) {
    fetch('{{ url("/") }}/addcart/' + productId + '?quantity=1', {
      headers: {
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
      }
    })
    .then(response => response.json())
    .then(data => {
      if (data.error) {
        showToast(data.error, 'error');
      } else {
        showToast(data[1] || 'Product added to cart', 'success');
        // Update cart count in header if element exists
        const cartCount = document.querySelector('.cart-count, #cart-count');
        if (cartCount && data.totalQty !== undefined) {
          cartCount.textContent = data.totalQty;
        }
      }
    })
    .catch(error => {
      console.error('Error:', error);
      showToast('Could not add product to cart', 'error');
    });
  }

  // Request refund for a completed order
  function requestRefund(orderId) {
    if (!confirm('Submit a refund request for this order? Our team will review it within 1–2 business days.')) return;

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('{{ url("/") }}/user/order/' + orderId + '/refund-request', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': csrfToken,
        'Accept': 'application/json'
      }
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        showToast(data.message || 'Refund request submitted successfully.', 'success');
        setTimeout(() => window.location.reload(), 1500);
      } else {
        showToast(data.error || 'Failed to submit refund request.', 'error');
      }
    })
    .catch(error => {
      console.error('Error:', error);
      showToast('An error occurred. Please try again.', 'error');
    });
  }

  // View order details
  const orderDetailBase = '{{ url("/user/order") }}';
  function viewOrderDetails(orderId) {
    window.location.href = orderDetailBase + '/' + orderId;
  }

  // Cancel order
  function cancelOrder(orderId) {

  if (!confirm('Are you sure you want to cancel this order?')) return;

  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  fetch("{{ route('user-order-cancel', ':id') }}".replace(':id', orderId), {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': csrfToken,
      'Accept': 'application/json'
    }
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      showToast(data.message || 'Order cancelled successfully', 'success');
      setTimeout(() => location.reload(), 1000);
    } else {
      showToast(data.message || 'Failed to cancel order', 'error');
    }
  })
  .catch(error => {
    console.error(error);
    showToast('Something went wrong', 'error');
  });

}
  // Remove all wishlist items
  function removeAllWishlistItems() {
    if (!confirm('Are you sure you want to remove ALL items from your wishlist? This action cannot be undone.')) {
      return;
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('{{url('/')}}/user/wishlist/clear', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          'Accept': 'application/json'
        }
      })
      .then(response => response.json())
      .then(data => {
        if (data.success || data.message) {
          showToast(data.message || 'All items removed from wishlist', 'success');
          setTimeout(() => window.location.reload(), 1000);
        } else {
          showToast(data.error || 'Failed to clear wishlist', 'error');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        showToast('An error occurred while clearing the wishlist', 'error');
      });
  }
</script>

<style>
  .tab-link.active {
    background-color: rgb(255 247 237 / var(--tw-bg-opacity));
    color: rgb(234 88 12 / var(--tw-text-opacity));
  }

  .dark .tab-link.active {
    background-color: rgb(234 88 12 / 0.2);
    color: rgb(251 146 60 / var(--tw-text-opacity));
  }
</style>
<script>
  function activateAffiliate() {
    const btn = document.getElementById('activateAffiliateBtn');
    if (btn) {
      btn.textContent = 'Activating...';
      btn.disabled = true;
      btn.setAttribute('aria-busy', 'true');
    }
    fetch("{{ route('affiliate.activate') }}", {
        method: "POST",
        headers: {
          "X-CSRF-TOKEN": "{{ csrf_token() }}",
          "Content-Type": "application/json"
        }
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          location.reload();
        } else {
          if (btn) {
            btn.textContent = 'Activate Affiliate';
            btn.disabled = false;
            btn.removeAttribute('aria-busy');
          }
        }
      })
      .catch(() => {
        if (btn) {
          btn.textContent = 'Activate Affiliate';
          btn.disabled = false;
          btn.removeAttribute('aria-busy');
        }
      });
  }
</script>

@endsection