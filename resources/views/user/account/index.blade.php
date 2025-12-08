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
              <div class="text-2xl font-bold text-orange-600 dark:text-orange-400">0</div>
              <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">Total Orders</div>
            </div>
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-4 text-center">
              <div class="text-2xl font-bold text-orange-600 dark:text-orange-400">0</div>
              <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">Wishlist Items</div>
            </div>
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-4 text-center">
              <div class="text-2xl font-bold text-orange-600 dark:text-orange-400">0</div>
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

              {{-- Empty State - will be replaced with purchase records --}}
              <div class="text-center py-8">
                <p class="text-gray-600 dark:text-gray-400 mb-4">You haven't made any purchases yet</p>
                <a href="{{ route('front.index') }}" class="inline-block px-6 py-2 bg-orange-600 text-white text-sm font-semibold hover:bg-orange-700 transition-colors">
                  Start Shopping
                </a>
              </div>
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

              {{-- Empty State - will be replaced with wishlist products --}}
              <div class="text-center py-8">
                <p class="text-gray-600 dark:text-gray-400 mb-4">Your wishlist is empty</p>
                <a href="{{ route('front.index') }}" class="inline-block px-6 py-2 bg-orange-600 text-white text-sm font-semibold hover:bg-orange-700 transition-colors">
                  Browse Products
                </a>
              </div>
            </div>
          </div>
        </div>

        {{-- Purchase History Tab --}}
        <div id="content-purchases" class="tab-content hidden">
          <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 mb-6">Purchase History</h1>

          @include('frontend.include.empty-state', [
            'icon' => 'shopping_bag',
            'title' => 'No Purchases Yet',
            'description' => 'You haven\'t made any purchases. Start shopping to see your order history here.',
            'actionText' => 'Start Shopping',
            'actionUrl' => route('front.index')
          ])
        </div>

        {{-- Wishlists Tab --}}
        <div id="content-wishlists" class="tab-content hidden">
          <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 mb-6">Wishlists</h1>

          @include('frontend.include.empty-state', [
            'icon' => 'favorite_border',
            'title' => 'No Wishlist Items',
            'description' => 'You haven\'t saved any items yet. Browse our products and add favorites to your wishlist.',
            'actionText' => 'Browse Products',
            'actionUrl' => route('front.index')
          ])
        </div>

        {{-- Manage Account Tab --}}
        <div id="content-account" class="tab-content hidden">
          <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 mb-6">Manage Account</h1>

          <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 lg:p-8">
            <form method="POST" action="{{ route('user.account.update') }}" novalidate>
              @csrf

              {{-- Name Field --}}
              <div class="mb-6">
                <label for="name" class="block text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2">
                  Full Name <span class="text-red-600 dark:text-red-400">*</span>
                </label>
                <input
                  type="text"
                  id="name"
                  name="name"
                  value="{{ old('name', $user->name) }}"
                  required
                  class="w-full px-4 py-2.5 sm:py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors text-sm sm:text-base"
                  placeholder="Enter your full name" />
                @error('name')
                  <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
              </div>

              {{-- Email Field --}}
              <div class="mb-6">
                <label for="email" class="block text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2">
                  Email Address
                  @if($user->email_verified_at)
                    <span class="text-green-600 dark:text-green-400 text-xs ml-2">✓ Verified</span>
                  @endif
                </label>
                <input
                  type="email"
                  id="email"
                  name="email"
                  value="{{ old('email', $user->email) }}"
                  class="w-full px-4 py-2.5 sm:py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors text-sm sm:text-base"
                  placeholder="your@email.com" />
                @error('email')
                  <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
              </div>

              {{-- Phone Field --}}
              <div class="mb-6">
                <label for="phone" class="block text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2">
                  Mobile Number
                  @if($user->phone_verified_at)
                    <span class="text-green-600 dark:text-green-400 text-xs ml-2">✓ Verified</span>
                  @endif
                </label>
                <div class="relative flex items-center border border-gray-300 dark:border-gray-600 overflow-hidden focus-within:ring-2 focus-within:ring-orange-500 focus-within:border-orange-500">
                  <span class="bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-300 px-4 py-2.5 sm:py-3 text-sm font-medium border-r border-gray-300 dark:border-gray-600">+91</span>
                  <input
                    type="tel"
                    id="phone"
                    name="phone"
                    value="{{ old('phone', $user->phone ? substr($user->phone, -10) : '') }}"
                    class="flex-1 px-4 py-2.5 sm:py-3 border-0 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 outline-none text-sm sm:text-base"
                    placeholder="12345 67890"
                    maxlength="10" />
                </div>
                @error('phone')
                  <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
              </div>

              {{-- Account Info Box --}}
              <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-700">
                <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-3">Account Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                  <div>
                    <span class="text-gray-600 dark:text-gray-400">Account Type:</span>
                    <span class="text-gray-900 dark:text-gray-100 font-medium ml-2">
                      @if($user->is_admin) Admin
                      @elseif($user->is_vendor) Vendor
                      @else Customer
                      @endif
                    </span>
                  </div>
                  <div>
                    <span class="text-gray-600 dark:text-gray-400">Member Since:</span>
                    <span class="text-gray-900 dark:text-gray-100 font-medium ml-2">{{ $user->created_at->format('M d, Y') }}</span>
                  </div>
                  <div>
                    <span class="text-gray-600 dark:text-gray-400">Status:</span>
                    <span class="text-green-600 dark:text-green-400 font-medium ml-2">{{ $user->status ? 'Active' : 'Inactive' }}</span>
                  </div>
                  <div>
                    <span class="text-gray-600 dark:text-gray-400">Last Login:</span>
                    <span class="text-gray-900 dark:text-gray-100 font-medium ml-2">{{ $user->last_otp_sent_at ? $user->last_otp_sent_at->diffForHumans() : 'Never' }}</span>
                  </div>
                </div>
              </div>

              {{-- Update Button --}}
              <button
                type="submit"
                class="w-full px-6 py-3 bg-orange-600 text-white text-base font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-colors">
                Update Profile
              </button>
            </form>
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
              <div class="text-5xl font-bold text-orange-600 dark:text-orange-400 mb-2">0</div>
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

              <div class="border border-gray-200 dark:border-gray-700 p-4 text-center">
                <span class="material-icons-outlined text-2xl text-orange-600 dark:text-orange-400 mb-2">share</span>
                <h3 class="font-semibold text-gray-900 dark:text-gray-100 mb-1">Refer Friends</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">Earn bonus points for referrals</p>
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
  });
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
