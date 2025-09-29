<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta name="description"
    content="CELIGIN - Premium cosmetics and skincare products. Discover your glow with our science-backed beauty solutions." />
  <title>CELIGIN - Premium Cosmetics & Skincare</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <!-- SwiperJS CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <!-- Plus Jakarta Sans font is now loaded via styles.css -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
  <!-- Toastify CSS -->
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">


</head>

<body>
  <!-- Skip to main content link for accessibility -->
  <a href="#main-content" class="skip-link">Skip to main content</a>



  <!-- Promotion Bar -->
  <div class="bg-orange-600 text-white" role="banner" aria-label="Promotional announcement">
    <div class="max-w-7xl mx-auto px-3 sm:px-5 lg:px-1">
      <div class="flex items-center justify-between py-1">
        @php
          use App\Models\Coupon;
          $available_coupons = Coupon::where('id', 1)->select('id', 'code', 'price')->get();
        @endphp

        <!-- Promotion Content -->
        <div class="flex items-center space-x-2 flex-1 min-w-0">
          <p class="text-sm font-medium truncate">
            <strong>10% off for new customers</strong>
          </p>
          <button
            class="px-2 py-1 bg-white text-orange-600 font-bold text-sm hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-orange-600 transition-colors duration-200 flex-shrink-0"
            data-code="{{ $available_coupons[0]->code }}" onclick="copyPromoCode(this)"
            aria-label="Copy promo code {{ $available_coupons[0]->code }}" title="Click to copy promo code">
            {{ $available_coupons[0]->code }}
          </button>
        </div>

        <!-- Close Button -->
        <button
          class="p-1 text-white hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-orange-600 transition-colors duration-200 ml-4"
          onclick="this.parentElement.parentElement.style.display='none'" aria-label="Close promotional banner">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
          </svg>
        </button>
      </div>
    </div>
  </div>


  <!-- Header -->
  <header class="bg-white border-b border-gray-200 sticky top-0 z-50" role="banner">
    <div class="max-w-7xl mx-auto px-3 sm:px-5 lg:px-1">
      <!-- Main Header -->
      <div class="grid grid-cols-3 items-center h-16 lg:h-20">

        <!-- Left: Search (Desktop) -->
        <div class="flex justify-start">
          <div class="hidden lg:block w-full max-w-xs">
            <form role="search" aria-label="Site search" onsubmit="return false;" class="relative">
              <input type="search" id="search-input" placeholder="Find your perfect skincare..." aria-label="Search for products"
                aria-expanded="false" aria-owns="search-dropdown" autocomplete="off"
                class="w-full pl-10 pr-4 py-2 border border-gray-300 text-base text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-800 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors duration-200" />
              <button type="button" aria-label="Submit search" id="search-btn"
                class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <circle cx="11" cy="11" r="8"></circle>
                  <path d="m21 21-4.35-4.35"></path>
                </svg>
              </button>

              <!-- Search Dropdown -->
              <div
                class="search-dropdown absolute top-full left-0 right-0 mt-1 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 shadow-lg hidden z-50"
                id="search-dropdown" role="listbox" aria-label="Search suggestions" aria-live="polite">
                <div class="search-suggestions-list" id="search-suggestions-list"></div>
              </div>
            </form>
          </div>

          <!-- Mobile: Account Button (shows on left on mobile) -->
          <a href="{{ route('sign-in') }}"
            class="lg:hidden p-2 text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 "
            aria-label="My account">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
              <circle cx="12" cy="7" r="4"></circle>
            </svg>
          </a>
        </div>

        <!-- Center: Logo -->
        <div class="flex justify-center">
          <a href="{{ route('front.index') }}" aria-label="CELIGIN - Go to homepage">
            <img src="{{ asset('assets/images/' . $gs->logo) }}" alt="CELIGIN - Premium Cosmetics & Skincare"
              class="h-8 lg:h-10 w-auto" />
          </a>
        </div>

        <!-- Right: Utility Buttons -->
        <div class="flex items-center justify-end space-x-2 lg:space-x-3">
          <!-- Mobile Search Button -->
          <button
            class="lg:hidden p-2 text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 "
            aria-label="Open search">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="11" cy="11" r="8"></circle>
              <path d="m21 21-4.35-4.35"></path>
            </svg>
          </button>

          <!-- Desktop Account (hidden on mobile) -->
          <a href="{{ route('sign-in') }}"
            class="hidden lg:block p-2 text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 "
            aria-label="My account">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
              <circle cx="12" cy="7" r="4"></circle>
            </svg>
          </a>

          <!-- Wishlist -->
          <a href="{{ route('front.wishlist') }}"
            class="relative p-2 text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 "
            aria-label="Wishlist">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path
                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
              </path>
            </svg>
            <span id="wishlist-count"
              class="absolute -top-1 -right-1 bg-orange-600 text-white text-sm h-5 w-5 flex items-center justify-center"
              aria-label="{{ Session::has('wishlist') ? count(Session::get('wishlist')) : '0' }} items in wishlist">
              {{ Session::has('wishlist') ? count(Session::get('wishlist')) : '0' }}
            </span>
          </a>

          <!-- Cart -->
          <a href="{{ route('front.cart') }}"
            class="relative p-2 text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 "
            aria-label="Shopping cart">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M9 22h6c2 0 3-1 3-3v-6c0-2-1-3-3-3H9c-2 0-3 1-3 3v6c0 2 1 3 3 3z"></path>
              <path d="M16 7V5a4 4 0 0 0-8 0v2"></path>
            </svg>
            <span
              class="cart-count absolute -top-1 -right-1 bg-orange-600 text-white text-sm h-5 w-5 flex items-center justify-center"
              id="cart-count"
              aria-label="{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }} items in cart">
              {{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}
            </span>
          </a>

          <!-- Theme Toggle -->
          <x-theme-toggle />

          <!-- Mobile Menu Button -->
          <button
            class="lg:hidden p-2 text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 "
            aria-label="Toggle menu" id="mobile-menu-button">
            <svg class="block h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>
      </div>

      <!-- Desktop Navigation -->
      <nav class="hidden lg:flex lg:space-x-8 lg:py-4 border-t border-gray-100" role="navigation"
        aria-label="Main navigation">
        <a href="{{route('front.new-arrivals')}}"
          class="text-gray-900 hover:text-orange-600 px-3 py-2 text-sm font-medium transition-colors duration-200 flex items-center space-x-1">
          <span>New Arrivals</span>
          <span class="inline-block px-1.5 py-0.5 bg-green-100 text-green-800 text-sm font-semibold ">New</span>
        </a>
        <a href="{{route('front.best-sellers')}}"
          class="text-gray-900 hover:text-orange-600 px-3 py-2 text-sm font-medium transition-colors duration-200">Best
          Sellers</a>
        <a href="{{route('front.skin-care')}}"
          class="text-gray-900 hover:text-orange-600 px-3 py-2 text-sm font-medium transition-colors duration-200">Skin
          Care</a>
        <a href="{{route('front.celigin-join-club')}}"
          class="bg-gradient-to-r from-pink-500 to-orange-500 bg-clip-text text-transparent px-3 py-2 text-sm font-semibold hover:from-pink-600 hover:to-orange-600 transition-all duration-200">Join
          CELIGIN CLUB</a>
        <a href="{{route('front.sales')}}"
          class="text-red-600 hover:text-red-700 px-3 py-2 text-sm font-medium transition-colors duration-200 flex items-center space-x-1">
          <span>Sale</span>
          <span class="inline-block px-1.5 py-0.5 bg-red-100 text-red-800 text-sm font-semibold ">Hot</span>
        </a>
      </nav>

      <!-- Mobile Navigation -->
      <div class="lg:hidden" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1 border-t border-gray-100">
          <a href="{{route('front.new-arrivals')}}"
            class="text-gray-900 hover:bg-gray-50 hover:text-orange-600 block px-3 py-2  text-base font-medium transition-all duration-200 flex items-center justify-between">
            <span class="flex items-center space-x-2">
              <span>New Arrivals</span>
              <span
                class="inline-block px-1.5 py-0.5 bg-green-100 text-green-800 text-sm font-semibold ">New</span>
            </span>
          </a>
          <a href="{{route('front.best-sellers')}}"
            class="text-gray-900 hover:bg-gray-50 hover:text-orange-600 block px-3 py-2  text-base font-medium transition-all duration-200">Best
            Sellers</a>
          <a href="{{route('front.skin-care')}}"
            class="text-gray-900 hover:bg-gray-50 hover:text-orange-600 block px-3 py-2  text-base font-medium transition-all duration-200">Skin
            Care</a>
          <a href="{{route('front.celigin-join-club')}}"
            class="bg-gradient-to-r from-pink-500 to-orange-500 bg-clip-text text-transparent block px-3 py-2  text-base font-semibold hover:bg-gray-50 transition-all duration-200">Join
            CELIGIN CLUB</a>
          <a href="{{route('front.sales')}}"
            class="text-red-600 hover:bg-gray-50 hover:text-red-700 block px-3 py-2  text-base font-medium transition-all duration-200 flex items-center justify-between">
            <span class="flex items-center space-x-2">
              <span>Sale</span>
              <span class="inline-block px-1.5 py-0.5 bg-red-100 text-red-800 text-sm font-semibold ">Hot</span>
            </span>
          </a>
        </div>
      </div>
    </div>
  </header>

  <script>
    // Mobile menu toggle functionality
    document.addEventListener('DOMContentLoaded', function () {
      const mobileMenuButton = document.getElementById('mobile-menu-button');
      const mobileMenu = document.getElementById('mobile-menu');

      if (mobileMenuButton && mobileMenu) {
        // Initially hide mobile menu
        mobileMenu.style.display = 'none';

        mobileMenuButton.addEventListener('click', function () {
          const isVisible = mobileMenu.style.display !== 'none';

          if (isVisible) {
            mobileMenu.style.display = 'none';
            mobileMenuButton.setAttribute('aria-expanded', 'false');
          } else {
            mobileMenu.style.display = 'block';
            mobileMenuButton.setAttribute('aria-expanded', 'true');
          }
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function (event) {
          if (!mobileMenuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
            mobileMenu.style.display = 'none';
            mobileMenuButton.setAttribute('aria-expanded', 'false');
          }
        });
      }
    });
  </script>