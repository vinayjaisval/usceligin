@extends('frontend.include.app')

@section('content')
<!-- Main Content -->
<main id="main-content" role="main" class="bg-gray-50 dark:bg-gray-900 min-h-screen">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <!-- Breadcrumb Navigation -->
    <nav aria-label="Breadcrumb" class="mb-6">
      <ol class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400">
        <li>
          <a href="{{ route('front.index') }}" class="hover:text-gray-900 dark:hover:text-gray-100 transition-colors duration-200">Home</a>
        </li>
        <li class="flex items-center">
          <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
          <span class="text-gray-900 dark:text-gray-100" aria-current="page">My Account</span>
        </li>
      </ol>
    </nav>

    <!-- Account Page Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

      <!-- Left Sidebar: Navigation -->
      <div class="lg:col-span-1">
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">

          <!-- Account Header -->
          <div class="p-4 sm:p-6 border-b border-gray-200 dark:border-gray-700">
            <h1 class="text-xl font-bold text-gray-900 dark:text-gray-100">Account</h1>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
              Welcome <span class="text-orange-600 dark:text-orange-400 font-medium">{{ Auth::check() ? Auth::user()->name : 'Guest' }}</span>
            </p>
          </div>

          <!-- Navigation Menu -->
          <nav class="p-2" aria-label="Account navigation">

            <!-- Overview -->
            <a href="#overview"
               onclick="switchTab('overview'); return false;"
               id="tab-overview"
               class="account-tab active flex items-center space-x-3 px-4 py-3 text-sm font-medium text-gray-900 dark:text-gray-100 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
              </svg>
              <span>Overview</span>
            </a>

            <!-- Orders Section -->
            <div class="mt-4">
              <p class="px-4 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Orders</p>
              <a href="#orders"
                 onclick="switchTab('orders'); return false;"
                 id="tab-orders"
                 class="account-tab flex items-center space-x-3 px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <span>Orders & Returns</span>
              </a>
            </div>

            <!-- Credits Section -->
            <div class="mt-4">
              <p class="px-4 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Credits</p>
              <a href="#coupons"
                 onclick="switchTab('coupons'); return false;"
                 id="tab-coupons"
                 class="account-tab flex items-center space-x-3 px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
                <span>Coupons</span>
              </a>
              <a href="#rewards"
                 onclick="switchTab('rewards'); return false;"
                 id="tab-rewards"
                 class="account-tab flex items-center space-x-3 px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Celigin RewardCash</span>
              </a>
            </div>

            <!-- Account Section -->
            <div class="mt-4">
              <p class="px-4 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Account</p>
              <a href="#profile"
                 onclick="switchTab('profile'); return false;"
                 id="tab-profile"
                 class="account-tab flex items-center space-x-3 px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span>Profile</span>
              </a>
              <a href="#addresses"
                 onclick="switchTab('addresses'); return false;"
                 id="tab-addresses"
                 class="account-tab flex items-center space-x-3 px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span>Addresses</span>
              </a>
              <a href="#password"
                 onclick="switchTab('password'); return false;"
                 id="tab-password"
                 class="account-tab flex items-center space-x-3 px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
                <span>Password</span>
              </a>
            </div>

            <!-- List Section -->
            <div class="mt-4 mb-4">
              <p class="px-4 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">List</p>
              <a href="#wishlist"
                 onclick="switchTab('wishlist'); return false;"
                 id="tab-wishlist"
                 class="account-tab flex items-center space-x-3 px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
                <span>My Wishlist</span>
              </a>
              <a href="#savelater"
                 onclick="switchTab('savelater'); return false;"
                 id="tab-savelater"
                 class="account-tab flex items-center space-x-3 px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                </svg>
                <span>Save Later</span>
              </a>
            </div>

          </nav>
        </div>
      </div>

      <!-- Right Content Area -->
      <div class="lg:col-span-3">

        <!-- Overview Tab -->
        <div id="content-overview" class="tab-content">
          <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">Account Overview</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <!-- Account Details Card -->
              <div class="border border-gray-200 dark:border-gray-700 p-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3">Account Details</h3>
                <div class="space-y-2 text-sm">
                  <p class="text-gray-600 dark:text-gray-400">
                    <span class="font-medium text-gray-900 dark:text-gray-100">Name:</span> {{ Auth::user()->name ?? 'N/A' }}
                  </p>
                  <p class="text-gray-600 dark:text-gray-400">
                    <span class="font-medium text-gray-900 dark:text-gray-100">Email:</span> {{ Auth::user()->email ?? 'N/A' }}
                  </p>
                  <p class="text-gray-600 dark:text-gray-400">
                    <span class="font-medium text-gray-900 dark:text-gray-100">Phone:</span> {{ Auth::user()->phone ?? 'N/A' }}
                  </p>
                </div>
                <a href="#profile" onclick="switchTab('profile'); return false;" class="inline-block mt-4 text-sm text-orange-600 dark:text-orange-400 hover:text-orange-700 font-medium">
                  Edit Profile →
                </a>
              </div>

              <!-- Address Card -->
              <div class="border border-gray-200 dark:border-gray-700 p-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3">Default Address</h3>
                @if(Auth::check() && Auth::user()->address)
                <div class="text-sm text-gray-600 dark:text-gray-400">
                  <p>{{ Auth::user()->address }}</p>
                  <p>{{ Auth::user()->city }}, {{ Auth::user()->state }} {{ Auth::user()->zip }}</p>
                </div>
                @else
                <p class="text-sm text-gray-500 dark:text-gray-400">No default address set</p>
                @endif
                <a href="#addresses" onclick="switchTab('addresses'); return false;" class="inline-block mt-4 text-sm text-orange-600 dark:text-orange-400 hover:text-orange-700 font-medium">
                  Manage Addresses →
                </a>
              </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-6">
              <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Quick Actions</h3>
              <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <a href="#orders" onclick="switchTab('orders'); return false;" class="flex flex-col items-center p-4 border border-gray-200 dark:border-gray-700 hover:border-orange-500 dark:hover:border-orange-500 transition-colors">
                  <svg class="w-8 h-8 text-orange-600 dark:text-orange-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                  </svg>
                  <span class="text-sm font-medium text-gray-900 dark:text-gray-100">My Orders</span>
                </a>
                <a href="#wishlist" onclick="switchTab('wishlist'); return false;" class="flex flex-col items-center p-4 border border-gray-200 dark:border-gray-700 hover:border-orange-500 dark:hover:border-orange-500 transition-colors">
                  <svg class="w-8 h-8 text-orange-600 dark:text-orange-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                  </svg>
                  <span class="text-sm font-medium text-gray-900 dark:text-gray-100">Wishlist</span>
                </a>
                <a href="#coupons" onclick="switchTab('coupons'); return false;" class="flex flex-col items-center p-4 border border-gray-200 dark:border-gray-700 hover:border-orange-500 dark:hover:border-orange-500 transition-colors">
                  <svg class="w-8 h-8 text-orange-600 dark:text-orange-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                  </svg>
                  <span class="text-sm font-medium text-gray-900 dark:text-gray-100">Coupons</span>
                </a>
                <a href="{{ route('front.cart') }}" class="flex flex-col items-center p-4 border border-gray-200 dark:border-gray-700 hover:border-orange-500 dark:hover:border-orange-500 transition-colors">
                  <svg class="w-8 h-8 text-orange-600 dark:text-orange-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                  </svg>
                  <span class="text-sm font-medium text-gray-900 dark:text-gray-100">Shopping Cart</span>
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Orders Tab -->
        <div id="content-orders" class="tab-content hidden">
          <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 min-h-[600px]">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Orders & Returns</h2>

            <!-- Empty State -->
            <div class="flex flex-col items-center justify-center py-16">
              <div class="w-64 h-64 mb-6">
                <svg viewBox="0 0 200 200" class="w-full h-full">
                  <!-- Wardrobe illustration -->
                  <rect x="50" y="40" width="100" height="120" fill="#A0D8D8" stroke="#6B7280" stroke-width="2"/>
                  <rect x="50" y="40" width="50" height="120" fill="#FCA5A5" stroke="#6B7280" stroke-width="2"/>
                  <rect x="100" y="40" width="50" height="120" fill="#FCA5A5" stroke="#6B7280" stroke-width="2"/>
                  <!-- Top -->
                  <path d="M 40 40 L 50 30 L 150 30 L 160 40 Z" fill="#C084FC"/>
                  <!-- Handles -->
                  <circle cx="75" cy="100" r="3" fill="#374151"/>
                  <circle cx="125" cy="100" r="3" fill="#374151"/>
                  <!-- Cat -->
                  <ellipse cx="125" cy="90" rx="15" ry="10" fill="#FCD34D"/>
                  <circle cx="120" cy="88" r="2" fill="#374151"/>
                  <circle cx="130" cy="88" r="2" fill="#374151"/>
                  <!-- Hangers -->
                  <line x1="60" y1="50" x2="60" y2="70" stroke="#EC4899" stroke-width="2"/>
                  <line x1="70" y1="50" x2="70" y2="75" stroke="#EC4899" stroke-width="2"/>
                  <line x1="80" y1="50" x2="80" y2="70" stroke="#EC4899" stroke-width="2"/>
                  <!-- Shadow -->
                  <ellipse cx="105" cy="165" rx="60" ry="5" fill="#E5E7EB"/>
                </svg>
              </div>
              <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">You haven't placed any order yet!</h3>
              <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">Order section is empty. After placing order, You can track them from here!</p>
              <a href="{{ route('front.index') }}" class="px-6 py-3 bg-orange-600 text-white text-sm font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 transition-colors">
                Start Shopping
              </a>
            </div>
          </div>
        </div>

        <!-- Coupons Tab -->
        <div id="content-coupons" class="tab-content hidden">
          <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">My Coupons</h2>
            <p class="text-gray-600 dark:text-gray-400">No coupons available at the moment.</p>
          </div>
        </div>

        <!-- Rewards Tab -->
        <div id="content-rewards" class="tab-content hidden">
          <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Celigin RewardCash</h2>
            <div class="border border-gray-200 dark:border-gray-700 p-6 text-center">
              <p class="text-4xl font-bold text-orange-600 dark:text-orange-400 mb-2">₹0</p>
              <p class="text-sm text-gray-600 dark:text-gray-400">Available RewardCash</p>
            </div>
          </div>
        </div>

        <!-- Profile Tab -->
        <div id="content-profile" class="tab-content hidden">
          <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">My Profile</h2>

            <form class="space-y-4">
              @csrf
              <div>
                <label for="profile_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                  Full Name <span class="text-red-600">*</span>
                </label>
                <input
                  type="text"
                  id="profile_name"
                  name="name"
                  value="{{ Auth::user()->name ?? '' }}"
                  class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors"
                  required />
              </div>

              <div>
                <label for="profile_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                  Email Address <span class="text-red-600">*</span>
                </label>
                <input
                  type="email"
                  id="profile_email"
                  name="email"
                  value="{{ Auth::user()->email ?? '' }}"
                  class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors"
                  required />
              </div>

              <div>
                <label for="profile_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                  Phone Number <span class="text-red-600">*</span>
                </label>
                <input
                  type="tel"
                  id="profile_phone"
                  name="phone"
                  value="{{ Auth::user()->phone ?? '' }}"
                  class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors"
                  required />
              </div>

              <button type="submit" class="px-6 py-2 bg-orange-600 text-white text-sm font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 transition-colors">
                Save Changes
              </button>
            </form>
          </div>
        </div>

        <!-- Addresses Tab -->
        <div id="content-addresses" class="tab-content hidden">
          <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center justify-between mb-6">
              <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">My Addresses</h2>
              <button class="px-4 py-2 bg-orange-600 text-white text-sm font-semibold hover:bg-orange-700 transition-colors">
                + Add New Address
              </button>
            </div>

            @if(Auth::check() && Auth::user()->address)
            <div class="border border-gray-200 dark:border-gray-700 p-4">
              <div class="flex items-start justify-between">
                <div>
                  <p class="font-semibold text-gray-900 dark:text-gray-100">{{ Auth::user()->name }}</p>
                  <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ Auth::user()->address }}</p>
                  <p class="text-sm text-gray-600 dark:text-gray-400">{{ Auth::user()->city }}, {{ Auth::user()->state }} {{ Auth::user()->zip }}</p>
                  <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Phone: {{ Auth::user()->phone }}</p>
                </div>
                <button class="text-sm text-orange-600 dark:text-orange-400 hover:text-orange-700 font-medium">Edit</button>
              </div>
            </div>
            @else
            <p class="text-gray-600 dark:text-gray-400">No saved addresses yet.</p>
            @endif
          </div>
        </div>

        <!-- Password Tab -->
        <div id="content-password" class="tab-content hidden">
          <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Change Password</h2>

            <form class="space-y-4 max-w-md">
              @csrf
              <div>
                <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                  Current Password <span class="text-red-600">*</span>
                </label>
                <input
                  type="password"
                  id="current_password"
                  name="current_password"
                  class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors"
                  required />
              </div>

              <div>
                <label for="new_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                  New Password <span class="text-red-600">*</span>
                </label>
                <input
                  type="password"
                  id="new_password"
                  name="new_password"
                  class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors"
                  required />
              </div>

              <div>
                <label for="confirm_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                  Confirm New Password <span class="text-red-600">*</span>
                </label>
                <input
                  type="password"
                  id="confirm_password"
                  name="confirm_password"
                  class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors"
                  required />
              </div>

              <button type="submit" class="px-6 py-2 bg-orange-600 text-white text-sm font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 transition-colors">
                Update Password
              </button>
            </form>
          </div>
        </div>

        <!-- Wishlist Tab -->
        <div id="content-wishlist" class="tab-content hidden">
          <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">My Wishlist</h2>
            <p class="text-gray-600 dark:text-gray-400">Your wishlist is empty.</p>
          </div>
        </div>

        <!-- Save Later Tab -->
        <div id="content-savelater" class="tab-content hidden">
          <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Saved for Later</h2>
            <p class="text-gray-600 dark:text-gray-400">No items saved for later.</p>
          </div>
        </div>

      </div>

    </div>
  </div>
</main>
@endsection

@section('scripts')
<script>
  function switchTab(tabName) {
    // Remove active class from all tabs
    document.querySelectorAll('.account-tab').forEach(tab => {
      tab.classList.remove('active', 'bg-orange-50', 'dark:bg-orange-900/20', 'text-orange-600', 'dark:text-orange-400', 'border-l-4', 'border-orange-600');
      tab.classList.add('text-gray-700', 'dark:text-gray-300');
    });

    // Hide all content
    document.querySelectorAll('.tab-content').forEach(content => {
      content.classList.add('hidden');
    });

    // Add active class to clicked tab
    const activeTab = document.getElementById(`tab-${tabName}`);
    if (activeTab) {
      activeTab.classList.add('active', 'bg-orange-50', 'dark:bg-orange-900/20', 'text-orange-600', 'dark:text-orange-400', 'border-l-4', 'border-orange-600');
      activeTab.classList.remove('text-gray-700', 'dark:text-gray-300');
    }

    // Show selected content
    const activeContent = document.getElementById(`content-${tabName}`);
    if (activeContent) {
      activeContent.classList.remove('hidden');
    }

    // Scroll to top of content area
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }

  // Set default tab styling on page load
  document.addEventListener('DOMContentLoaded', function() {
    const overviewTab = document.getElementById('tab-overview');
    if (overviewTab) {
      overviewTab.classList.add('bg-orange-50', 'dark:bg-orange-900/20', 'text-orange-600', 'dark:text-orange-400', 'border-l-4', 'border-orange-600');
      overviewTab.classList.remove('text-gray-700', 'dark:text-gray-300');
    }
  });
</script>

<style>
  .account-tab.active {
    border-left: 4px solid #ea580c;
  }
</style>
@endsection
