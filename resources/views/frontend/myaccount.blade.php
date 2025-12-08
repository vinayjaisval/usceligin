@extends('frontend.include.app')

@section('content')
<!-- Main Content -->
<main id="main-content" role="main" class="bg-gray-50 dark:bg-gray-900 min-h-screen">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-8">

    <!-- Breadcrumb Navigation -->
    @include('frontend.include.breadcrumb', ['items' => [
      ['label' => 'Home', 'url' => route('front.index')],
      ['label' => 'My Account']
    ]])

    <!-- Account Page Grid: Sidebar + Content -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8">

      <!-- Left Sidebar: Navigation Menu -->
      <aside class="lg:col-span-3">
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">

          <!-- User Profile Header -->
          <div class="p-6 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center space-x-4">
              <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-orange-600 text-white flex items-center justify-center text-xl font-bold uppercase">
                  {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                </div>
              </div>
              <div class="flex-1 min-w-0">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 truncate">
                  {{ Auth::user()->name ?? 'User' }}
                </h2>
              </div>
            </div>
          </div>

          <!-- Navigation Menu -->
          <nav class="p-2" aria-label="Account navigation">
            <a href="#dashboard"
               onclick="switchTab('dashboard'); return false;"
               id="nav-dashboard"
               class="account-nav-item active flex items-center justify-between px-4 py-3 text-sm font-medium text-gray-900 dark:text-gray-100 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
              <span>Dashboard</span>
              <span class="material-icons-outlined text-base">chevron_right</span>
            </a>

            <a href="#purchase-history"
               onclick="switchTab('purchase-history'); return false;"
               id="nav-purchase-history"
               class="account-nav-item flex items-center justify-between px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
              <span>Purchase History</span>
            </a>

            <a href="#wishlists"
               onclick="switchTab('wishlists'); return false;"
               id="nav-wishlists"
               class="account-nav-item flex items-center justify-between px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
              <span>Wishlists</span>
            </a>

            <a href="#manage-account"
               onclick="switchTab('manage-account'); return false;"
               id="nav-manage-account"
               class="account-nav-item flex items-center justify-between px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
              <span>Manage Account</span>
            </a>

            <a href="#customer-service"
               onclick="switchTab('customer-service'); return false;"
               id="nav-customer-service"
               class="account-nav-item flex items-center justify-between px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
              <span>Customer Service</span>
            </a>

            <a href="#affiliate"
               onclick="switchTab('affiliate'); return false;"
               id="nav-affiliate"
               class="account-nav-item flex items-center justify-between px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
              <span>Affiliate</span>
            </a>

            <a href="#celigin-points"
               onclick="switchTab('celigin-points'); return false;"
               id="nav-celigin-points"
               class="account-nav-item flex items-center justify-between px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
              <span>CELIGIN Points</span>
            </a>

            <a href="{{ route('user.logout') }}"
               class="account-nav-item flex items-center justify-between px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors border-t border-gray-200 dark:border-gray-700 mt-2">
              <span>Sign Out</span>
            </a>
          </nav>
        </div>
      </aside>

      <!-- Right Content Area -->
      <div class="lg:col-span-9">

        <!-- Dashboard Tab -->
        <div id="content-dashboard" class="tab-content">
          <div class="space-y-6">

            <!-- Join CELIGIN CLUB Card -->
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-8 text-center">
              <div class="flex justify-center mb-6">
                <span class="material-icons-outlined text-6xl text-gray-400 dark:text-gray-500">card_giftcard</span>
              </div>
              <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">Join CELIGIN CLUB</h2>
              <p class="text-base text-gray-600 dark:text-gray-400 mb-2">
                You currently don't have an Ulta Beauty Rewards® membership. Already signed up in store? Link your
              </p>
              <p class="text-base text-gray-600 dark:text-gray-400 mb-6">
                Member ID so you don't miss out on rewards! Not a member? Join free below.
              </p>
              <a href="{{ route('front.celigin-join-club') }}"
                 class="inline-block px-8 py-3 bg-gray-900 dark:bg-white text-white dark:text-gray-900 text-base font-semibold hover:bg-gray-800 dark:hover:bg-gray-100 transition-colors">
                Join Now
              </a>
            </div>

            <!-- No Purchases Card -->
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-8 text-center">
              <div class="flex justify-center mb-6">
                <svg viewBox="0 0 64 64" class="w-20 h-20" fill="none">
                  <path d="M16 24L32 8L48 24" fill="#F97316" opacity="0.2"/>
                  <path d="M16 24H48L44 56H20L16 24Z" fill="#F97316"/>
                  <circle cx="28" cy="52" r="2" fill="white"/>
                  <circle cx="40" cy="52" r="2" fill="white"/>
                  <path d="M32 8V24" stroke="#F97316" stroke-width="2"/>
                </svg>
              </div>
              <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">No Purchases</h3>
              <p class="text-base text-gray-600 dark:text-gray-400">
                See order details after your first purchase.
              </p>
            </div>

            <!-- Wishlist Card -->
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-8 text-center">
              <div class="flex justify-center mb-6">
                <svg viewBox="0 0 64 64" class="w-20 h-20" fill="none">
                  <path d="M32 52C32 52 8 38 8 22C8 14 14 8 22 8C26 8 30 10 32 14C34 10 38 8 42 8C50 8 56 14 56 22C56 38 32 52 32 52Z" fill="#F97316"/>
                  <path d="M32 52C32 52 8 38 8 22C8 14 14 8 22 8C26 8 30 10 32 14" fill="#EA580C"/>
                </svg>
              </div>
              <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">Wishlist</h3>
              <p class="text-base text-gray-600 dark:text-gray-400">
                Save a product to start tracking your favorites.
              </p>
            </div>

          </div>
        </div>

        <!-- Purchase History Tab -->
        <div id="content-purchase-history" class="tab-content hidden">
          <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-8">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Purchase History</h2>

            <!-- Empty State -->
            @include('frontend.include.empty-state', [
              'icon' => 'cart',
              'title' => 'No orders yet',
              'message' => 'You haven\'t placed any orders. Start shopping to see your purchase history here.',
              'buttonText' => 'Start Shopping',
              'buttonUrl' => route('front.index')
            ])
          </div>
        </div>

        <!-- Wishlists Tab -->
        <div id="content-wishlists" class="tab-content hidden">
          <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-8">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">My Wishlists</h2>

            <!-- Empty State -->
            <div class="text-center py-12">
              <span class="material-icons-outlined text-6xl text-gray-300 dark:text-gray-600 mb-4">favorite_border</span>
              <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">Your wishlist is empty</h3>
              <p class="text-base text-gray-600 dark:text-gray-400 mb-6">
                Save products you love to your wishlist.
              </p>
              <a href="{{ route('front.index') }}"
                 class="inline-block px-6 py-3 bg-orange-600 text-white text-base font-semibold hover:bg-orange-700 transition-colors">
                Browse Products
              </a>
            </div>
          </div>
        </div>

        <!-- Manage Account Tab -->
        <div id="content-manage-account" class="tab-content hidden">
          <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-8">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Manage Account</h2>

            <form class="space-y-6 max-w-2xl">
              @csrf

              <div>
                <label for="name" class="block text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2">
                  Full Name <span class="text-red-600">*</span>
                </label>
                <input type="text" id="name" name="name" value="{{ Auth::user()->name ?? '' }}" required
                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors text-base" />
              </div>

              <div>
                <label for="email" class="block text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2">
                  Email Address <span class="text-red-600">*</span>
                </label>
                <input type="email" id="email" name="email" value="{{ Auth::user()->email ?? '' }}" required
                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors text-base" />
              </div>

              <div>
                <label for="phone" class="block text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2">
                  Phone Number <span class="text-red-600">*</span>
                </label>
                <input type="tel" id="phone" name="phone" value="{{ Auth::user()->phone ?? '' }}" required
                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors text-base" />
              </div>

              <div>
                <button type="submit"
                  class="px-6 py-3 bg-orange-600 text-white text-base font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 transition-colors">
                  Save Changes
                </button>
              </div>
            </form>
          </div>
        </div>

        <!-- Customer Service Tab -->
        <div id="content-customer-service" class="tab-content hidden">
          <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-8">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Customer Service</h2>
            <p class="text-base text-gray-600 dark:text-gray-400 mb-6">
              Need help? Contact our customer service team.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="border border-gray-200 dark:border-gray-700 p-6">
                <span class="material-icons-outlined text-4xl text-orange-600 dark:text-orange-400 mb-4">email</span>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Email Support</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                  Send us an email and we'll respond within 24 hours.
                </p>
                <a href="mailto:{{ $ps->email }}" class="text-orange-600 dark:text-orange-400 hover:text-orange-700 dark:hover:text-orange-300 font-medium">
                  {{ $ps->email }}
                </a>
              </div>

              <div class="border border-gray-200 dark:border-gray-700 p-6">
                <span class="material-icons-outlined text-4xl text-orange-600 dark:text-orange-400 mb-4">phone</span>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Phone Support</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                  Call us for immediate assistance.
                </p>
                <a href="tel:{{ $ps->phone }}" class="text-orange-600 dark:text-orange-400 hover:text-orange-700 dark:hover:text-orange-300 font-medium">
                  {{ $ps->phone }}
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Affiliate Tab -->
        <div id="content-affiliate" class="tab-content hidden">
          <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-8">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Affiliate Program</h2>
            <p class="text-base text-gray-600 dark:text-gray-400">
              Join our affiliate program and earn rewards by referring friends and family.
            </p>
          </div>
        </div>

        <!-- CELIGIN Points Tab -->
        <div id="content-celigin-points" class="tab-content hidden">
          <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-8">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">CELIGIN Points</h2>

            <div class="border border-gray-200 dark:border-gray-700 p-8 text-center">
              <div class="mb-4">
                <span class="material-icons-outlined text-6xl text-orange-600 dark:text-orange-400">stars</span>
              </div>
              <p class="text-5xl font-bold text-orange-600 dark:text-orange-400 mb-3">0</p>
              <p class="text-base text-gray-600 dark:text-gray-400">Available Points</p>
            </div>
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
    // Remove active class from all nav items
    document.querySelectorAll('.account-nav-item').forEach(item => {
      item.classList.remove('active', 'bg-gray-50', 'dark:bg-gray-700');
    });

    // Hide all content tabs
    document.querySelectorAll('.tab-content').forEach(content => {
      content.classList.add('hidden');
    });

    // Add active class to clicked nav item
    const activeNav = document.getElementById(`nav-${tabName}`);
    if (activeNav) {
      activeNav.classList.add('active', 'bg-gray-50', 'dark:bg-gray-700');
    }

    // Show selected content
    const activeContent = document.getElementById(`content-${tabName}`);
    if (activeContent) {
      activeContent.classList.remove('hidden');
    }

    // Scroll to top
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }

  // Initialize on page load
  document.addEventListener('DOMContentLoaded', function() {
    // Set dashboard as default active
    switchTab('dashboard');
  });
</script>
@endsection
