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
          <span class="material-icons-outlined text-green-600 dark:text-green-400 mr-3 mt-0.5">check_circle</span>
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
            <div class="w-20 h-20 rounded-full bg-orange-600 dark:bg-orange-500 text-white flex items-center justify-center text-3xl font-bold mb-3">
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
                <span class="material-icons-outlined mr-3">dashboard</span>
                <span>Dashboard</span>
              </div>
              <span class="material-icons-outlined text-gray-400 dark:text-gray-500">chevron_right</span>
            </a>

            <a href="#purchases"
               onclick="switchTab(event, 'purchases')"
               data-tab="purchases"
               class="tab-link flex items-center justify-between px-4 py-3 text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors cursor-pointer">
              <div class="flex items-center">
                <span class="material-icons-outlined mr-3">shopping_bag</span>
                <span>Purchase History</span>
              </div>
              <span class="material-icons-outlined text-gray-400 dark:text-gray-500">chevron_right</span>
            </a>

            <a href="#wishlists"
               onclick="switchTab(event, 'wishlists')"
               data-tab="wishlists"
               class="tab-link flex items-center justify-between px-4 py-3 text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors cursor-pointer">
              <div class="flex items-center">
                <span class="material-icons-outlined mr-3">favorite_border</span>
                <span>Wishlists</span>
              </div>
              <span class="material-icons-outlined text-gray-400 dark:text-gray-500">chevron_right</span>
            </a>

            <a href="#account"
               onclick="switchTab(event, 'account')"
               data-tab="account"
               class="tab-link flex items-center justify-between px-4 py-3 text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors cursor-pointer">
              <div class="flex items-center">
                <span class="material-icons-outlined mr-3">person</span>
                <span>Manage Account</span>
              </div>
              <span class="material-icons-outlined text-gray-400 dark:text-gray-500">chevron_right</span>
            </a>

            <a href="#support"
               onclick="switchTab(event, 'support')"
               data-tab="support"
               class="tab-link flex items-center justify-between px-4 py-3 text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors cursor-pointer">
              <div class="flex items-center">
                <span class="material-icons-outlined mr-3">support_agent</span>
                <span>Customer Service</span>
              </div>
              <span class="material-icons-outlined text-gray-400 dark:text-gray-500">chevron_right</span>
            </a>

            <a href="#affiliate"
               onclick="switchTab(event, 'affiliate')"
               data-tab="affiliate"
               class="tab-link flex items-center justify-between px-4 py-3 text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors cursor-pointer">
              <div class="flex items-center">
                <span class="material-icons-outlined mr-3">groups</span>
                <span>Affiliate</span>
              </div>
              <span class="material-icons-outlined text-gray-400 dark:text-gray-500">chevron_right</span>
            </a>

            <a href="#points"
               onclick="switchTab(event, 'points')"
               data-tab="points"
               class="tab-link flex items-center justify-between px-4 py-3 text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors cursor-pointer">
              <div class="flex items-center">
                <span class="material-icons-outlined mr-3">stars</span>
                <span>CELIGIN Points</span>
              </div>
              <span class="material-icons-outlined text-gray-400 dark:text-gray-500">chevron_right</span>
            </a>

            <form method="POST" action="{{ route('logout') }}" class="border-t border-gray-200 dark:border-gray-700 mt-2 pt-2">
              @csrf
              <button type="submit" class="w-full flex items-center justify-between px-4 py-3 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                <div class="flex items-center">
                  <span class="material-icons-outlined mr-3">logout</span>
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

          {{-- Quick Stats at Top --}}
          <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-4 text-center">
              <div class="text-2xl font-bold text-orange-600 dark:text-orange-400">{{ $totalOrders }}</div>
              <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">Total Orders</div>
            </div>
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-4 text-center">
              <div class="text-2xl font-bold text-orange-600 dark:text-orange-400">{{ $totalWishlistItems }}</div>
              <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">Wishlist Items</div>
            </div>
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-4 text-center">
              <div class="text-2xl font-bold text-orange-600 dark:text-orange-400">{{ $points }}</div>
              <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">Points Earned</div>
            </div>
          </div>

          {{-- Join CELIGIN CLUB Section --}}
          <div class="mb-6">
            <a href="{{ route('front.celigin-join-club') }}" class="block bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 hover:border-orange-500 dark:hover:border-orange-400 transition-colors group">
              <div class="flex items-center">
                <div class="w-16 h-16 bg-orange-100 dark:bg-orange-900/30 rounded-full flex items-center justify-center group-hover:bg-orange-200 dark:group-hover:bg-orange-900/50 transition-colors">
                  <span class="material-icons-outlined text-3xl text-orange-600 dark:text-orange-400">card_membership</span>
                </div>
                <div class="ml-6">
                  <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-1">Join CELIGIN CLUB</h3>
                  <p class="text-sm text-gray-600 dark:text-gray-400">Exclusive benefits and rewards for our members</p>
                </div>
              </div>
            </a>
          </div>

          {{-- Purchase History Section --}}
          <div class="mb-6">
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6">
              <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-orange-100 dark:bg-orange-900/30 rounded-full flex items-center justify-center">
                  <span class="material-icons-outlined text-orange-600 dark:text-orange-400 text-2xl">receipt_long</span>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 ml-4">Purchase History</h3>
              </div>

              @if($orders->count() > 0)
                <div class="space-y-4">
                  @foreach($orders as $order)
                    <div class="border border-gray-200 dark:border-gray-700 p-4">
                      <div class="flex justify-between items-start mb-2">
                        <div>
                          <h4 class="font-semibold text-gray-900 dark:text-gray-100">Order #{{ $order->order_number }}</h4>
                          <p class="text-sm text-gray-600 dark:text-gray-400">{{ $order->created_at->format('M d, Y') }}</p>
                        </div>
                        <span class="px-3 py-1 text-xs font-semibold
                          @if($order->status == 'completed') bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-200
                          @elseif($order->status == 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-200
                          @elseif($order->status == 'processing') bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-200
                          @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200
                          @endif">
                          {{ ucfirst($order->status) }}
                        </span>
                      </div>
                      <p class="text-sm text-gray-600 dark:text-gray-400">
                        Total: {{ $order->currency_sign }}{{ number_format($order->pay_amount, 2) }}
                      </p>
                    </div>
                  @endforeach
                </div>
              @else
                {{-- Empty State --}}
                <div class="text-center py-8">
                  <p class="text-gray-600 dark:text-gray-400 mb-4">You haven't made any purchases yet</p>
                  <a href="{{ route('front.index') }}" class="inline-block px-6 py-2 bg-orange-600 text-white text-sm font-semibold hover:bg-orange-700 transition-colors">
                    Start Shopping
                  </a>
                </div>
              @endif
            </div>
          </div>

          {{-- Wishlist Section --}}
          <div class="mb-6">
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6">
              <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-orange-100 dark:bg-orange-900/30 rounded-full flex items-center justify-center">
                  <span class="material-icons-outlined text-orange-600 dark:text-orange-400 text-2xl">favorite_border</span>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 ml-4">Wishlist</h3>
              </div>

              @if($wishlist->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                  @foreach($wishlist->take(4) as $item)
                    <div class="border border-gray-200 dark:border-gray-700 p-3 group hover:border-orange-500 dark:hover:border-orange-400 transition-colors">
                      @if($item->product && $item->product->photo)
                        <img src="{{ asset('assets/images/products/' . $item->product->photo) }}"
                             alt="{{ $item->product->name ?? 'Product' }}"
                             class="w-full h-32 object-cover mb-2">
                      @else
                        <div class="w-full h-32 bg-gray-200 dark:bg-gray-700 flex items-center justify-center mb-2">
                          <span class="text-gray-400 dark:text-gray-500 text-xs">No Image</span>
                        </div>
                      @endif
                      <h5 class="text-sm font-semibold text-gray-900 dark:text-gray-100 truncate">
                        {{ $item->product->name ?? 'Product' }}
                      </h5>
                      @if($item->product)
                        <p class="text-sm text-orange-600 dark:text-orange-400 font-semibold">
                          ₹ {{ number_format($item->product->price, 2) }}
                        </p>
                      @endif
                    </div>
                  @endforeach
                </div>
                @if($wishlist->count() > 4)
                  <div class="mt-4 text-center">
                    <a href="{{ route('front.wishlist') }}" class="text-orange-600 dark:text-orange-400 hover:text-orange-700 dark:hover:text-orange-300 text-sm font-semibold">
                      View All {{ $wishlist->count() }} Items →
                    </a>
                  </div>
                @endif
              @else
                {{-- Empty State --}}
                <div class="text-center py-8">
                  <p class="text-gray-600 dark:text-gray-400 mb-4">Your wishlist is empty</p>
                  <a href="{{ route('front.index') }}" class="inline-block px-6 py-2 bg-orange-600 text-white text-sm font-semibold hover:bg-orange-700 transition-colors">
                    Browse Products
                  </a>
                </div>
              @endif
            </div>
          </div>
        </div>

        {{-- Purchase History Tab --}}
        <div id="content-purchases" class="tab-content hidden">
          <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 mb-6">Purchase History</h1>

          @if($orders->count() > 0)
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6">
              <div class="space-y-4">
                @foreach($orders as $order)
                  <div class="border border-gray-200 dark:border-gray-700 p-4">
                    <div class="flex justify-between items-start mb-2">
                      <div>
                        <h4 class="font-semibold text-gray-900 dark:text-gray-100">Order #{{ $order->order_number }}</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $order->created_at->format('M d, Y h:i A') }}</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Items: {{ $order->totalQty }}</p>
                      </div>
                      <span class="px-3 py-1 text-xs font-semibold
                        @if($order->status == 'completed') bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-200
                        @elseif($order->status == 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-200
                        @elseif($order->status == 'processing') bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-200
                        @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200
                        @endif">
                        {{ ucfirst($order->status) }}
                      </span>
                    </div>
                    <div class="flex justify-between items-center mt-3">
                      <p class="text-base font-semibold text-gray-900 dark:text-gray-100">
                        Total: {{ $order->currency_sign }}{{ number_format($order->pay_amount, 2) }}
                      </p>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          @else
            @include('frontend.include.empty-state', [
              'icon' => 'shopping_bag',
              'title' => 'No Purchases Yet',
              'description' => 'You haven\'t made any purchases. Start shopping to see your order history here.',
              'actionText' => 'Start Shopping',
              'actionUrl' => route('front.index')
            ])
          @endif
        </div>

        {{-- Wishlists Tab --}}
        <div id="content-wishlists" class="tab-content hidden">
          <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 mb-6">Wishlists</h1>

          @if($wishlist->count() > 0)
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6">
              <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @foreach($wishlist as $item)
                  <div class="border border-gray-200 dark:border-gray-700 p-3 group hover:border-orange-500 dark:hover:border-orange-400 transition-colors">
                    @if($item->product && $item->product->photo)
                      <img src="{{ asset('assets/images/products/' . $item->product->photo) }}"
                           alt="{{ $item->product->name ?? 'Product' }}"
                           class="w-full h-32 object-cover mb-2">
                    @else
                      <div class="w-full h-32 bg-gray-200 dark:bg-gray-700 flex items-center justify-center mb-2">
                        <span class="text-gray-400 dark:text-gray-500 text-xs">No Image</span>
                      </div>
                    @endif
                    <h5 class="text-sm font-semibold text-gray-900 dark:text-gray-100 truncate" title="{{ $item->product->name ?? 'Product' }}">
                      {{ $item->product->name ?? 'Product' }}
                    </h5>
                    @if($item->product)
                      <p class="text-sm text-orange-600 dark:text-orange-400 font-semibold">
                        ₹ {{ number_format($item->product->price, 2) }}
                      </p>
                    @endif
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                      Added {{ $item->created_at->diffForHumans() }}
                    </p>
                  </div>
                @endforeach
              </div>
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
                    class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors text-sm"
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
                          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
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
                    class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors text-sm"
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
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                      </svg>
                      Verified
                    </span>
                  @endif
                </label>
                <div class="relative flex items-center border border-gray-300 dark:border-gray-600 overflow-hidden focus-within:ring-2 focus-within:ring-orange-500 focus-within:border-orange-500 transition-all">
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
              <div class="mb-6 p-5 bg-orange-50 dark:bg-orange-900/10 border border-orange-200 dark:border-orange-800">
                <div class="flex items-start gap-3 mb-4">
                  <span class="material-icons-outlined text-orange-600 dark:text-orange-400 text-xl mt-0.5">info</span>
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
              </div>

              {{-- Update Button --}}
              <div class="flex gap-3">
                <button
                  type="submit"
                  class="flex-1 sm:flex-none sm:px-8 py-3 bg-orange-600 text-white text-sm font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-colors">
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
                  class="hidden sm:inline-flex items-center gap-2 px-4 py-2 bg-orange-600 text-white text-sm font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 transition-colors">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
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
                  class="sm:hidden w-full mb-4 flex items-center justify-center gap-2 px-4 py-2.5 border-2 border-dashed border-orange-300 dark:border-orange-700 text-orange-600 dark:text-orange-400 text-sm font-semibold hover:bg-orange-50 dark:hover:bg-orange-900/20 transition-colors">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                  </svg>
                  Add New Address
                </button>
                @endif

                {{-- Address Cards Grid --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4" id="address-cards-container">
                  @foreach($addresses as $address)
                    <div class="relative group border-2 {{ $address->is_default ? 'border-orange-500 dark:border-orange-400 bg-orange-50/30 dark:bg-orange-900/10' : 'border-gray-200 dark:border-gray-700 hover:border-gray-300 dark:hover:border-gray-600' }} p-5 transition-all duration-200">

                      {{-- Default Badge (Top Right) --}}
                      @if($address->is_default)
                      <div class="absolute -top-2 -right-2 bg-orange-600 dark:bg-orange-500 text-white px-3 py-1 text-xs font-semibold shadow-md">
                        DEFAULT
                      </div>
                      @endif

                      {{-- Address Type Icon & Badge --}}
                      <div class="flex items-center gap-2 mb-3">
                        <span class="material-icons-outlined text-gray-400 dark:text-gray-500 text-lg">
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
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
                          class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-orange-600 dark:text-orange-400 hover:bg-orange-50 dark:hover:bg-orange-900/20 border border-orange-200 dark:border-orange-700 transition-colors">
                          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                          </svg>
                          Set as default
                        </button>
                        @endif

                        <button
                          type="button"
                          onclick="editAddress({{ $address->id }})"
                          class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 border border-gray-200 dark:border-gray-600 transition-colors">
                          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                          </svg>
                          Edit
                        </button>

                        <button
                          type="button"
                          onclick="deleteAddress({{ $address->id }})"
                          class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 border border-red-200 dark:border-red-700 transition-colors">
                          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
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

                  {{-- Address Type --}}
                  <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                      Address Type <span class="text-red-600">*</span>
                    </label>
                    <div class="flex gap-4">
                      <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="radio" name="type" value="home" checked
                          class="w-4 h-4 text-orange-600 border-gray-300 focus:ring-orange-500" />
                        <span class="text-sm text-gray-700 dark:text-gray-300">Home</span>
                      </label>
                      <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="radio" name="type" value="work"
                          class="w-4 h-4 text-orange-600 border-gray-300 focus:ring-orange-500" />
                        <span class="text-sm text-gray-700 dark:text-gray-300">Work</span>
                      </label>
                      <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="radio" name="type" value="other"
                          class="w-4 h-4 text-orange-600 border-gray-300 focus:ring-orange-500" />
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
                      class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors" />
                  </div>

                  {{-- Phone --}}
                  <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                      Phone Number <span class="text-red-600">*</span>
                    </label>
                    <input type="tel" name="phone" required maxlength="15"
                      class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors" />
                  </div>

                  {{-- Address Line 1 --}}
                  <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                      Address Line 1 <span class="text-red-600">*</span>
                    </label>
                    <input type="text" name="address_line_1" required
                      class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors" />
                  </div>

                  {{-- Address Line 2 --}}
                  <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                      Address Line 2
                    </label>
                    <input type="text" name="address_line_2"
                      class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors" />
                  </div>

                  {{-- Pincode, City, State, Country --}}
                  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div>
                      <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Pincode <span class="text-red-600">*</span>
                      </label>
                      <input type="text" name="pincode" id="myAccountAddressForm_pincode" required maxlength="6" pattern="[0-9]{6}"
                        onblur="fetchPincodeDetails('myAccountAddressForm')"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors" />
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
                      class="mt-1 w-4 h-4 text-orange-600 border-gray-300 rounded focus:ring-orange-500" />
                    <label class="text-sm text-gray-700 dark:text-gray-300 cursor-pointer">
                      Make this my default address
                    </label>
                  </div>

                  {{-- Buttons --}}
                  <div class="flex gap-3">
                    <button type="submit"
                      class="px-6 py-2 bg-orange-600 text-white text-sm font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 transition-colors">
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
                    <div class="w-20 h-20 bg-orange-100 dark:bg-orange-900/20 rounded-full flex items-center justify-center mx-auto mb-4">
                      <span class="material-icons-outlined text-5xl text-orange-600 dark:text-orange-400">add_location_alt</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">No Saved Addresses</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                      Add your delivery address to make checkout faster and easier. You can save up to 3 addresses.
                    </p>
                    <button
                      type="button"
                      onclick="toggleAddAddressForm()"
                      class="inline-flex items-center gap-2 px-6 py-3 bg-orange-600 text-white text-sm font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 transition-colors shadow-md">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
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

                    {{-- Address Type --}}
                    <div>
                      <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Address Type <span class="text-red-600">*</span>
                      </label>
                      <div class="flex gap-4">
                        <label class="flex items-center space-x-2 cursor-pointer">
                          <input type="radio" name="type" value="home" checked
                            class="w-4 h-4 text-orange-600 border-gray-300 focus:ring-orange-500" />
                          <span class="text-sm text-gray-700 dark:text-gray-300">Home</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                          <input type="radio" name="type" value="work"
                            class="w-4 h-4 text-orange-600 border-gray-300 focus:ring-orange-500" />
                          <span class="text-sm text-gray-700 dark:text-gray-300">Work</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                          <input type="radio" name="type" value="other"
                            class="w-4 h-4 text-orange-600 border-gray-300 focus:ring-orange-500" />
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
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors" />
                    </div>

                    {{-- Phone --}}
                    <div>
                      <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Phone Number <span class="text-red-600">*</span>
                      </label>
                      <input type="tel" name="phone" required maxlength="15"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors" />
                    </div>

                    {{-- Address Line 1 --}}
                    <div>
                      <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Address Line 1 <span class="text-red-600">*</span>
                      </label>
                      <input type="text" name="address_line_1" required
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors" />
                    </div>

                    {{-- Address Line 2 --}}
                    <div>
                      <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Address Line 2
                      </label>
                      <input type="text" name="address_line_2"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors" />
                    </div>

                    {{-- Pincode, City, State, Country --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                      <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                          Pincode <span class="text-red-600">*</span>
                        </label>
                        <input type="text" name="pincode" id="myAccountAddressForm_pincode" required maxlength="6" pattern="[0-9]{6}"
                          onblur="fetchPincodeDetails('myAccountAddressForm')"
                          class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors" />
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
                        class="mt-1 w-4 h-4 text-orange-600 border-gray-300 rounded focus:ring-orange-500" />
                      <label class="text-sm text-gray-700 dark:text-gray-300 cursor-pointer">
                        Make this my default address
                      </label>
                    </div>

                    {{-- Buttons --}}
                    <div class="flex gap-3">
                      <button type="submit"
                        class="px-6 py-2 bg-orange-600 text-white text-sm font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 transition-colors">
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
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
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
                <span class="material-icons-outlined text-orange-600 dark:text-orange-400 text-3xl mr-4">email</span>
                <div>
                  <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Email Support</h3>
                  <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Get help via email within 24 hours</p>
                  <a href="mailto:support@celigin.com" class="text-orange-600 dark:text-orange-400 hover:text-orange-700 dark:hover:text-orange-300 text-sm font-semibold">
                    support@celigin.com
                  </a>
                </div>
              </div>
            </div>

            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6">
              <div class="flex items-start">
                <span class="material-icons-outlined text-orange-600 dark:text-orange-400 text-3xl mr-4">phone</span>
                <div>
                  <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Phone Support</h3>
                  <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Talk to our support team</p>
                  <a href="tel:+911234567890" class="text-orange-600 dark:text-orange-400 hover:text-orange-700 dark:hover:text-orange-300 text-sm font-semibold">
                    +91 123 456 7890
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

        {{-- Affiliate Tab --}}
        <div id="content-affiliate" class="tab-content hidden">
          <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 mb-6">Affiliate Program</h1>

          <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 lg:p-8 text-center">
            <span class="material-icons-outlined text-6xl text-orange-600 dark:text-orange-400 mb-4">groups</span>
            <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-3">Join Our Affiliate Program</h2>
            <p class="text-gray-600 dark:text-gray-400 mb-6 max-w-2xl mx-auto">
              Earn rewards by referring friends and family. Share your unique referral link and get exclusive benefits.
            </p>
            <button class="px-6 py-3 bg-orange-600 text-white font-semibold hover:bg-orange-700 transition-colors">
              Learn More
            </button>
          </div>
        </div>

        {{-- CELIGIN Points Tab --}}
        <div id="content-points" class="tab-content hidden">
          <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 mb-6">CELIGIN Points</h1>

          <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 lg:p-8">
            <div class="text-center mb-8">
              <div class="text-5xl font-bold text-orange-600 dark:text-orange-400 mb-2">₹{{Auth::user()->current_balance ? Auth::user()->current_balance : 0}}</div>
              <p class="text-gray-600 dark:text-gray-400">Available Points</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div class="border border-gray-200 dark:border-gray-700 p-4 text-center">
                <span class="material-icons-outlined text-2xl text-orange-600 dark:text-orange-400 mb-2">shopping_cart</span>
                <h3 class="font-semibold text-gray-900 dark:text-gray-100 mb-1">Earn on Purchases</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">Get 1 point for every ₹100 spent</p>
              </div>

              <div class="border border-gray-200 dark:border-gray-700 p-4 text-center">
                <span class="material-icons-outlined text-2xl text-orange-600 dark:text-orange-400 mb-2">card_giftcard</span>
                <h3 class="font-semibold text-gray-900 dark:text-gray-100 mb-1">Redeem Rewards</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">Use points for discounts on orders</p>
              </div>
             @php
                $referralCode = Auth::user()->refferel_code ?? '';
               
                $referralLink = url('/?refferel_code=' . $referralCode);
            @endphp

<div class="border border-gray-200 dark:border-gray-700 p-4 text-center rounded cursor-pointer">
    <span class="material-icons-outlined text-2xl text-orange-600 dark:text-orange-400 mb-2">
        share
    </span>

    <h3 class="font-semibold text-gray-900 dark:text-gray-100 mb-1">
        Refer Friends
    </h3>

    <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
        Earn bonus points for referrals
    </p>

    <!-- Referral Input -->
    <input
        type="text"
        id="referralLink"
        value="{{ $referralLink }}"
        readonly
        class="w-full text-sm border rounded px-2 py-1 mb-2 text-center"
    >

    <!-- Copy Button -->
    <button
        onclick="copyReferral()"
        class="bg-orange-600 text-white px-4 py-1 rounded text-sm mb-3">
        Copy Link
    </button>

    <!-- Social Share Buttons -->
   <div class="flex justify-center gap-4 mt-4">

    <!-- WhatsApp -->
    <a id="whatsappShare" target="_blank"
       class="w-10 h-10 flex items-center justify-center rounded-full bg-green-500 hover:bg-green-600 transition">
        <svg class="w-5 h-5 fill-white" viewBox="0 0 32 32">
            <path d="M16.1 3C9.4 3 4 8.4 4 15.1c0 2.7.9 5.2 2.4 7.3L4 29l6.8-2.2c2 .9 4.2 1.4 6.5 1.4 6.7 0 12.1-5.4 12.1-12.1C28.2 8.4 22.8 3 16.1 3zm0 22.1c-2.1 0-4.1-.6-5.9-1.7l-.4-.2-4 1.3 1.3-3.9-.3-.4c-1.1-1.8-1.7-3.9-1.7-6.1 0-6 4.9-10.9 10.9-10.9S27 9.1 27 15.1 22.1 25.1 16.1 25.1zm6-8.2c-.3-.1-1.9-.9-2.2-1s-.5-.1-.7.1-.8 1-.9 1.2-.3.2-.6.1-1.2-.4-2.3-1.4c-.8-.7-1.4-1.6-1.5-1.9-.2-.3 0-.4.1-.6.1-.1.3-.3.4-.5.1-.2.1-.3.2-.5s0-.3 0-.5-.7-1.8-.9-2.4c-.2-.6-.4-.5-.7-.5h-.6c-.2 0-.5.1-.7.3-.2.2-.9.9-.9 2.1s.9 2.4 1 2.6c.1.2 1.7 2.6 4.2 3.6 2.4 1 2.4.7 2.8.7.4 0 1.4-.6 1.6-1.1.2-.5.2-1 .1-1.1z"/>
        </svg>
    </a>

    <!-- Facebook -->
    <a id="facebookShare" target="_blank"
       class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-600 hover:bg-blue-700 transition">
        <svg class="w-5 h-5 fill-white" viewBox="0 0 24 24">
            <path d="M22.675 0h-21.35C.6 0 0 .6 0 1.326v21.348C0 23.4.6 24 1.326 24h11.495v-9.294H9.691V11.01h3.13V8.309c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.464.099 2.795.143v3.24h-1.918c-1.504 0-1.795.715-1.795 1.763v2.31h3.587l-.467 3.696h-3.12V24h6.116C23.4 24 24 23.4 24 22.674V1.326C24 .6 23.4 0 22.675 0z"/>
        </svg>
    </a>

    <!-- Twitter / X -->
    <a id="twitterShare" target="_blank"
       class="w-10 h-10 flex items-center justify-center rounded-full bg-black hover:bg-gray-800 transition">
        <svg class="w-5 h-5 fill-white" viewBox="0 0 24 24">
            <path d="M18.244 2H21.49l-7.09 8.1L22.75 22h-6.39l-5-6.56L5.78 22H2.53l7.58-8.67L1.5 2h6.55l4.52 5.98L18.24 2z"/>
        </svg>
    </a>

    <!-- Telegram -->
    <a id="telegramShare" target="_blank"
       class="w-10 h-10 flex items-center justify-center rounded-full bg-sky-500 hover:bg-sky-600 transition">
        <svg class="w-5 h-5 fill-white" viewBox="0 0 24 24">
            <path d="M9.993 15.522l-.397 5.584c.568 0 .815-.245 1.111-.539l2.667-2.532 5.523 4.035c1.012.56 1.728.265 1.986-.935l3.6-16.88c.319-1.49-.538-2.07-1.515-1.7L1.353 9.6c-1.454.566-1.432 1.38-.248 1.745l5.524 1.72L19.41 5.44c.664-.44 1.27-.197.772.243"/>
        </svg>
    </a>

</div>

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
    const text = "Join using my referral link & earn rewards!";
 
    const shareText = "Join using my referral link and earn rewards!";

    function copyReferral() {
        navigator.clipboard.writeText(referralLink).then(() => {
            alert("Referral link copied!");
        });
    }
    document.getElementById('whatsappShare').href =
        `https://wa.me/?text=${encodeURIComponent(text + ' ' + referralLink)}`;

    document.getElementById('facebookShare').href =
        `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(referralLink)}`;

    document.getElementById('twitterShare').href =
        `https://twitter.com/intent/tweet?text=${encodeURIComponent(text)}&url=${encodeURIComponent(referralLink)}`;

    document.getElementById('telegramShare').href =
        `https://t.me/share/url?url=${encodeURIComponent(referralLink)}&text=${encodeURIComponent(text)}`;
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
      link.classList.remove('active', 'bg-orange-50', 'dark:bg-orange-900/20', 'text-orange-600', 'dark:text-orange-400');
    });

    // Show selected tab content
    const selectedContent = document.getElementById('content-' + tabName);
    if (selectedContent) {
      selectedContent.classList.remove('hidden');
    }

    // Add active class to selected tab link
    const selectedLink = document.querySelector(`[data-tab="${tabName}"]`);
    if (selectedLink) {
      selectedLink.classList.add('active', 'bg-orange-50', 'dark:bg-orange-900/20', 'text-orange-600', 'dark:text-orange-400');
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
    const hash = window.location.hash.substring(1);
    if (hash) {
      switchTab(null, hash);
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

    fetch(`/user/addresses/${addressId}/edit`, {
      headers: {
        'X-CSRF-TOKEN': csrfToken,
        'Accept': 'application/json'
      }
    })
    .then(response => response.json())
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
                class="w-4 h-4 text-orange-600 border-gray-300 focus:ring-orange-500" />
              <span class="text-sm text-gray-700 dark:text-gray-300">Home</span>
            </label>
            <label class="flex items-center space-x-2 cursor-pointer">
              <input type="radio" name="type" value="work" ${address.type === 'work' ? 'checked' : ''}
                class="w-4 h-4 text-orange-600 border-gray-300 focus:ring-orange-500" />
              <span class="text-sm text-gray-700 dark:text-gray-300">Work</span>
            </label>
            <label class="flex items-center space-x-2 cursor-pointer">
              <input type="radio" name="type" value="other" ${address.type === 'other' ? 'checked' : ''}
                class="w-4 h-4 text-orange-600 border-gray-300 focus:ring-orange-500" />
              <span class="text-sm text-gray-700 dark:text-gray-300">Other</span>
            </label>
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Full Name <span class="text-red-600">*</span>
          </label>
          <input type="text" name="name" value="${address.name}" required
            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors" />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Phone Number <span class="text-red-600">*</span>
          </label>
          <input type="tel" name="phone" value="${address.phone}" required maxlength="15"
            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors" />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Address Line 1 <span class="text-red-600">*</span>
          </label>
          <input type="text" name="address_line_1" value="${address.address_line_1}" required
            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors" />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Address Line 2
          </label>
          <input type="text" name="address_line_2" value="${address.address_line_2 || ''}"
            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors" />
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Pincode <span class="text-red-600">*</span>
            </label>
            <input type="text" name="pincode" value="${address.pincode}" required maxlength="6" pattern="[0-9]{6}"
              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors" />
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
            class="mt-1 w-4 h-4 text-orange-600 border-gray-300 rounded focus:ring-orange-500" />
          <label class="text-sm text-gray-700 dark:text-gray-300 cursor-pointer">
            Make this my default address
          </label>
        </div>

        <div class="flex gap-3">
          <button type="submit"
            class="px-6 py-2 bg-orange-600 text-white text-sm font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 transition-colors">
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

  // Update address
  function updateAddress(addressId, form) {
    const formData = new FormData(form);
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn.textContent;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    submitBtn.disabled = true;
    submitBtn.textContent = 'Updating...';

    fetch(`/user/addresses/${addressId}`, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': csrfToken,
        'X-HTTP-Method-Override': 'PUT',
        'Accept': 'application/json'
      },
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      submitBtn.disabled = false;
      submitBtn.textContent = originalText;

      if (data.success || data.message) {
        showToast(data.message || 'Address updated successfully', 'success');
        setTimeout(() => window.location.reload(), 1000);
      } else {
        showToast(data.error || 'Failed to update address', 'error');
      }
    })
    .catch(error => {
      submitBtn.disabled = false;
      submitBtn.textContent = originalText;
      console.error('Error:', error);
      showToast('An error occurred while updating the address', 'error');
    });
  }

  // Delete address
  function deleteAddress(addressId) {
    if (!confirm('Are you sure you want to delete this address?')) {
      return;
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch(`/user/addresses/${addressId}`, {
      method: 'DELETE',
      headers: {
        'X-CSRF-TOKEN': csrfToken,
        'Accept': 'application/json'
      }
    })
    .then(response => response.json())
    .then(data => {
      if (data.success || data.message) {
        showToast(data.message || 'Address deleted successfully', 'success');
        setTimeout(() => window.location.reload(), 1000);
      } else {
        showToast(data.error || 'Failed to delete address', 'error');
      }
    })
    .catch(error => {
      console.error('Error:', error);
      showToast('An error occurred while deleting the address', 'error');
    });
  }

  // Set default address
  function setDefaultAddress(addressId) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch(`/user/addresses/${addressId}/set-default`, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': csrfToken,
        'Accept': 'application/json'
      }
    })
    .then(response => response.json())
    .then(data => {
      if (data.success || data.message) {
        showToast(data.message || 'Default address updated', 'success');
        setTimeout(() => window.location.reload(), 1000);
      } else {
        showToast(data.error || 'Failed to update default address', 'error');
      }
    })
    .catch(error => {
      console.error('Error:', error);
      showToast('An error occurred while updating default address', 'error');
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
    .then(response => response.json())
    .then(data => {
      submitBtn.disabled = false;
      submitBtn.textContent = originalText;

      if (data.success || data.message) {
        showToast(data.message || 'Address saved successfully', 'success');
        setTimeout(() => window.location.reload(), 1000);
      } else {
        showToast(data.error || 'Failed to save address', 'error');
      }
    })
    .catch(error => {
      submitBtn.disabled = false;
      submitBtn.textContent = originalText;
      console.error('Error:', error);
      showToast('An error occurred while saving the address', 'error');
    });
  }

  // Fetch pincode details
  function fetchPincodeDetails(formId) {
    const pincodeInput = document.getElementById(`${formId}_pincode`);
    if (!pincodeInput) return;

    const pincode = pincodeInput.value.trim();

    if (pincode.length !== 6 || !/^\d{6}$/.test(pincode)) {
      document.getElementById(`${formId}_city`).value = '';
      document.getElementById(`${formId}_state`).value = '';
      return;
    }

    document.getElementById(`${formId}_city`).value = 'Loading...';
    document.getElementById(`${formId}_state`).value = 'Loading...';

    fetch(`https://api.postalpincode.in/pincode/${pincode}`)
      .then(response => response.json())
      .then(data => {
        if (data[0].Status === 'Success') {
          const post = data[0].PostOffice[0];
          document.getElementById(`${formId}_city`).value = post.District;
          document.getElementById(`${formId}_state`).value = post.State;
          document.getElementById(`${formId}_country`).value = post.Country;
        } else {
          document.getElementById(`${formId}_city`).value = '';
          document.getElementById(`${formId}_state`).value = '';
          showToast('Invalid pincode', 'error');
        }
      })
      .catch(error => {
        console.error('Error fetching pincode details:', error);
        document.getElementById(`${formId}_city`).value = '';
        document.getElementById(`${formId}_state`).value = '';
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
@endsection
