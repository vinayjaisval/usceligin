<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description"
    content="CELIGIN - Premium cosmetics and skincare products. Discover your glow with our science-backed beauty solutions." />
  <title>CELIGIN - Premium Cosmetics & Skincare</title>
  @yield('head_seo')
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <!-- Plus Jakarta Sans font is now loaded via styles.css -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
  <!-- Toastify CSS -->
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <!-- Google Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <style>
    /* Mobile menu animation */
    #mobile-menu {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.3s ease-in-out;
    }

    #mobile-menu.show {
      max-height: 500px;
    }

  </style>
</head>
<body class="bg-white dark:bg-gray-900">
 

  <a href="#main-content" class="skip-link">Skip to main content</a>
 
  @php
  use App\Models\Coupon;
  $available_coupons = Coupon::where('id', 1)->select('id', 'code', 'price')->get();
  @endphp
  @if($available_coupons->isNotEmpty())
  <div id="promo-banner" class="bg-primary-600 dark:bg-primary-700 text-white" role="banner" aria-label="Promotional announcement">
    <div class="max-w-7xl mx-auto px-3 sm:px-5 lg:px-8">
      <div class="flex items-center justify-between py-1">
        <!-- Promotion Content -->
        <div class="flex items-center space-x-2 flex-1 min-w-0">
          <p class="text-sm font-medium truncate">
            <strong>10% off for new customers</strong>
          </p>
          <button
            class="px-2 py-1 bg-white text-primary-700 dark:text-primary-800 font-bold text-xs sm:text-sm hover:bg-gray-100 dark:hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-primary-600 dark:focus:ring-offset-primary-700 transition-colors duration-200 flex-shrink-0 rounded"
            data-code="{{ $available_coupons[0]->code }}" onclick="copyPromoCode(this)"
            aria-label="Copy promo code {{ $available_coupons[0]->code }}" title="Click to copy promo code">
            {{ $available_coupons[0]->code }}
          </button>
        </div>
        
        <button
          type="button"
          class="p-1 text-white hover:text-gray-200 dark:hover:text-gray-300 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-primary-600 dark:focus:ring-offset-primary-700 transition-colors duration-200 ml-4 rounded"
          onclick="closePromoBanner()" aria-label="Close promotional banner">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
          </svg>
        </button>
      </div>
    </div>
  </div>
  @endif
  <!-- Header -->
  <header class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 sticky top-0 z-50" role="banner">
    <div class="max-w-7xl mx-auto px-3 sm:px-5 lg:px-8">
      <!-- Desktop Header (lg and above) - UNCHANGED FROM ORIGINAL -->
      <div class="hidden lg:block">
        <div class="grid grid-cols-3 items-center h-20">
          <!-- Left: Search -->
          <div class="flex justify-start">
            <div class="w-full max-w-xs">
              <form role="search" aria-label="Site search" onsubmit="return false;" class="relative">
                <input type="search" id="search-input" placeholder="Find your perfect skincare..." aria-label="Search for products"
                  aria-expanded="false" aria-owns="search-dropdown" autocomplete="off"
                  class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 text-sm text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-800 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-colors duration-200 " />
                <button type="button" aria-label="Submit search" id="search-btn"
                  class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-300">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                  </svg>
                </button>

                <div
                  class="search-dropdown absolute top-full left-0 right-0 mt-1 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600  shadow-lg hidden z-50 max-h-96 overflow-y-auto"
                  id="search-dropdown" role="listbox" aria-label="Search suggestions" aria-live="polite">
                  <div class="search-suggestions-list" id="search-suggestions-list"></div>
                </div>
              </form>
            </div>
          </div>

          <!-- Center: Logo -->
          <div class="flex justify-center">
            <a href="{{ route('front.index') }}" aria-label="CELIGIN - Go to homepage">
              <img src="{{ asset('assets/images/' . $gs->logo) }}" alt="CELIGIN - Premium Cosmetics & Skincare"
                class="h-10 w-auto" />
            </a>
          </div>

          <!-- Right: Utility Buttons -->
          <div class="flex items-center justify-end space-x-3">
            <!-- Account -->
            @auth
            <a href="{{ route('user.account') }}"
              class="p-2 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 dark:focus:ring-offset-gray-900  transition-colors duration-200"
              aria-label="My account">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
              </svg>
            </a>
            @else
            <a href="{{ route('otp.login.form') }}"
              class="p-2 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 dark:focus:ring-offset-gray-900  transition-colors duration-200"
              aria-label="Sign in to your account">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
              </svg>
            </a>
            @endauth

            <a href="{{ route('front.wishlist') }}"
              class="relative p-2 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 dark:focus:ring-offset-gray-900  transition-colors duration-200"
              aria-label="Wishlist">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
              </svg>
              <span id="wishlist-count"
                class="absolute -top-1 -right-1 bg-red-600 dark:bg-red-500 text-white text-xs h-5 w-5 flex items-center justify-center "
                aria-label="{{ Session::has('wishlist') ? count(Session::get('wishlist')) : '0' }} items in wishlist">
                {{ Auth::check()
                    ? \App\Models\Wishlist::where('user_id', Auth::id())->count()
                    : count(Session::get('wishlist', []))
                }}
              </span>
            </a>

            <!-- Cart -->
            <a href="{{ route('front.cart') }}"
              class="relative p-2 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 dark:focus:ring-offset-gray-900  transition-colors duration-200"
              aria-label="Shopping cart">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="9" cy="21" r="1"></circle>
                <circle cx="20" cy="21" r="1"></circle>
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
              </svg>
              <span id="cart-count"
                class="absolute -top-1 -right-1 bg-red-600 dark:bg-red-500 text-white text-xs h-5 w-5 flex items-center justify-center "
                aria-label="{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }} items in cart">
                {{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}

              </span>
            </a>

            <!-- Theme Toggle -->
            <x-theme-toggle />
          </div>
        </div>

        <!-- Desktop Navigation -->
        <nav class="flex space-x-8 py-4 border-t border-gray-100 dark:border-gray-700 justify-center" role="navigation" aria-label="Main navigation">
          <a href="{{route('front.new-arrivals')}}"
            class="text-gray-900 dark:text-gray-100 hover:text-primary-700 dark:hover:text-primary-400 text-sm font-medium transition-colors duration-200 flex items-center space-x-1">
            <span>New Arrivals</span>
            <span class="inline-block px-1.5 py-0.5 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-100 text-xs font-semibold rounded">New</span>
          </a>
          <a href="{{route('front.best-sellers')}}"
            class="text-gray-900 dark:text-gray-100 hover:text-primary-700 dark:hover:text-primary-400 text-sm font-medium transition-colors duration-200">Best Sellers</a>
          <a href="{{route('front.skin-care')}}"
            class="text-gray-900 dark:text-gray-100 hover:text-primary-700 dark:hover:text-primary-400 text-sm font-medium transition-colors duration-200">Skin Care</a>
          <a href="{{route('front.celigin-join-club')}}"
            class="bg-gradient-to-r from-pink-500 to-blue-500 bg-clip-text text-transparent text-sm font-semibold hover:from-pink-600 hover:to-primary-600 transition-all duration-200">Join CELIGIN CLUB</a>
          <a href="{{route('front.sales')}}"
            class="text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 text-sm font-medium transition-colors duration-200 flex items-center space-x-1">
            <span>Sale</span>
            <span class="inline-block px-1.5 py-0.5 bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-100 text-xs font-semibold rounded">Hot</span>
          </a>
        </nav>
      </div>

      <div class="lg:hidden">
        <!-- Row 1: Logo and Actions -->
        <div class="flex items-center justify-between h-14">
          <!-- Logo - h-4 = 1rem -->
          <div class="flex-shrink-0">
            <a href="{{ route('front.index') }}" aria-label="CELIGIN - Go to homepage">
              <img src="{{ asset('assets/images/' . $gs->logo) }}" alt="CELIGIN - Premium Cosmetics & Skincare"
                class="h-4 w-auto" />
            </a>
          </div>

          <div class="flex items-center space-x-1">
            <!-- Account - Reduced icon size, proper padding -->
            @auth
            <a href="{{ route('user.account') }}"
              class="p-2.5 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 dark:focus:ring-offset-gray-900  transition-colors duration-200 touch-manipulation"
              aria-label="My account">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
              </svg>
            </a>
            @else
            <a href="{{ route('otp.login.form') }}"
              class="p-2.5 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 dark:focus:ring-offset-gray-900  transition-colors duration-200 touch-manipulation"
              aria-label="Sign in to your account">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
              </svg>
            </a>
            @endauth

            <!-- Wishlist -->
            <a href="{{ route('front.wishlist') }}"
              class="relative p-2.5 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 dark:focus:ring-offset-gray-900  transition-colors duration-200 touch-manipulation"
              aria-label="Wishlist">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
              </svg>
              <span id="wishlist-count-mobile"
                class="absolute top-0.5 right-0.5 bg-primary-600 dark:bg-primary-600 text-white text-xs h-4 w-4 flex items-center justify-center  font-medium"
                aria-label="{{ Session::has('wishlist') ? count(Session::get('wishlist')) : '0' }} items in wishlist">
                {{ Session::has('wishlist') ? count(Session::get('wishlist')) : '0' }}
              </span>
            </a>

            <a href="{{ route('front.cart') }}"
              class="relative p-2.5 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 dark:focus:ring-offset-gray-900  transition-colors duration-200 touch-manipulation"
              aria-label="Shopping cart">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="9" cy="21" r="1"></circle>
                <circle cx="20" cy="21" r="1"></circle>
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
              </svg>
              <span id="cart-count-mobile"
                class="absolute top-0.5 right-0.5 bg-primary-600 dark:bg-primary-600 text-white text-xs h-4 w-4 flex items-center justify-center  font-medium"
                aria-label="{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }} items in cart">
                {{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}
              </span>
            </a>

            <!-- Mobile Menu Button -->
            <button
              class="p-2.5 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 dark:focus:ring-offset-gray-900  transition-colors duration-200 touch-manipulation"
              aria-label="Toggle menu" id="mobile-menu-button" aria-expanded="false">
              <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="menu-icon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
              </svg>
              <svg class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="close-icon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
        </div>

        <!-- Row 2: Search Bar -->
        <div class="pb-3 pt-1">
          <form role="search" aria-label="Site search" onsubmit="return false;" class="relative">
            <input type="search" id="search-input-mobile" placeholder="Find your perfect skincare..." aria-label="Search for products"
              aria-expanded="false" aria-owns="search-dropdown-mobile" autocomplete="off"
              class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 text-sm text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-800 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-colors duration-200 " />
            <button type="button" aria-label="Submit search" id="search-btn-mobile"
              class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-300">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"></circle>
                <path d="m21 21-4.35-4.35"></path>
              </svg>
            </button>

            <!-- Mobile Search Dropdown -->
            <div
              class="search-dropdown absolute top-full left-0 right-0 mt-1 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600  shadow-lg hidden z-50 max-h-96 overflow-y-auto"
              id="search-dropdown-mobile" role="listbox" aria-label="Search suggestions" aria-live="polite">
              <div class="search-suggestions-list" id="search-suggestions-list-mobile"></div>
            </div>
          </form>
        </div>
      </div>

      <!-- Mobile Navigation Menu with smooth animation and dividers -->
      <nav class="lg:hidden border-t border-gray-100 dark:border-gray-700" id="mobile-menu" role="navigation" aria-label="Main navigation">
        <div class="divide-y divide-gray-100 dark:divide-gray-700">
          <a href="{{route('front.new-arrivals')}}"
            class="text-gray-900 dark:text-gray-100 hover:bg-gray-50 dark:hover:bg-gray-800 hover:text-primary-700 dark:hover:text-primary-400 flex items-center justify-between px-4 py-3 text-base font-medium transition-all duration-200">
            <span class="flex items-center space-x-2">
              <span>New Arrivals</span>
              <span class="inline-block px-1.5 py-0.5 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-100 text-xs font-semibold rounded">New</span>
            </span>
          </a>
          <a href="{{route('front.best-sellers')}}"
            class="text-gray-900 dark:text-gray-100 hover:bg-gray-50 dark:hover:bg-gray-800 hover:text-primary-700 dark:hover:text-primary-400 block px-4 py-3 text-base font-medium transition-all duration-200">Best Sellers</a>
          <a href="{{route('front.skin-care')}}"
            class="text-gray-900 dark:text-gray-100 hover:bg-gray-50 dark:hover:bg-gray-800 hover:text-primary-700 dark:hover:text-primary-400 block px-4 py-3 text-base font-medium transition-all duration-200">Skin Care</a>
          <a href="{{route('front.celigin-join-club')}}"
            class="bg-gradient-to-r from-pink-500 to-blue-500 bg-clip-text text-transparent block px-4 py-3 text-base font-semibold hover:bg-gray-50 dark:hover:bg-gray-800 transition-all duration-200">Join CELIGIN CLUB</a>
          <a href="{{route('front.sales')}}"
            class="text-red-600 dark:text-red-400 hover:bg-gray-50 dark:hover:bg-gray-800 hover:text-red-700 dark:hover:text-red-300 flex items-center justify-between px-4 py-3 text-base font-medium transition-all duration-200">
            <span class="flex items-center space-x-2">
              <span>Sale</span>
              <span class="inline-block px-1.5 py-0.5 bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-100 text-xs font-semibold rounded">Hot</span>
            </span>
          </a>
        </div>
      </nav>
    </div>
  </header>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const mobileMenuButton = document.getElementById('mobile-menu-button');
      const mobileMenu = document.getElementById('mobile-menu');
      const menuIcon = document.getElementById('menu-icon');
      const closeIcon = document.getElementById('close-icon');

      if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
          const isExpanded = mobileMenuButton.getAttribute('aria-expanded') === 'true';

          if (isExpanded) {
            // Close menu
            mobileMenu.classList.remove('show');
            mobileMenuButton.setAttribute('aria-expanded', 'false');
            menuIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
          } else {
            // Open menu
            mobileMenu.classList.add('show');
            mobileMenuButton.setAttribute('aria-expanded', 'true');
            menuIcon.classList.add('hidden');
            closeIcon.classList.remove('hidden');
          }
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
          if (!mobileMenuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
            mobileMenu.classList.remove('show');
            mobileMenuButton.setAttribute('aria-expanded', 'false');
            menuIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
          }
        });

        // Close menu when clicking a link
        const menuLinks = mobileMenu.querySelectorAll('a');
        menuLinks.forEach(link => {
          link.addEventListener('click', function() {
            mobileMenu.classList.remove('show');
            mobileMenuButton.setAttribute('aria-expanded', 'false');
            menuIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
          });
        });
      }

      // Sync cart/wishlist counts between desktop and mobile
      function syncCounts() {
        const wishlistDesktop = document.getElementById('wishlist-count');
        const wishlistMobile = document.getElementById('wishlist-count-mobile');
        const cartDesktop = document.getElementById('cart-count');
        const cartMobile = document.getElementById('cart-count-mobile');

        if (wishlistDesktop && wishlistMobile) {
          wishlistMobile.textContent = wishlistDesktop.textContent;
        }
        if (cartDesktop && cartMobile) {
          cartMobile.textContent = cartDesktop.textContent;
        }
      }

      // Initial sync
      syncCounts();

      // Create a MutationObserver to watch for changes
      const observerConfig = {
        childList: true,
        characterData: true,
        subtree: true
      };

      const wishlistDesktop = document.getElementById('wishlist-count');
      const cartDesktop = document.getElementById('cart-count');

      if (wishlistDesktop) {
        new MutationObserver(syncCounts).observe(wishlistDesktop, observerConfig);
      }
      if (cartDesktop) {
        new MutationObserver(syncCounts).observe(cartDesktop, observerConfig);
      }
    });
  </script>