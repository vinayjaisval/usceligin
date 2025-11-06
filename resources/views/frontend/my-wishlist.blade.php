@extends('frontend.include.app')

@section('content')
<main id="main-content" role="main" class="bg-white dark:bg-gray-900">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    {{-- Breadcrumb --}}
    <nav aria-label="Breadcrumb" class="mb-6">
      <ol class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400">
        <li>
          <a href="{{ route('front.index') }}" class="hover:text-gray-900 dark:hover:text-gray-100 transition-colors duration-200">Home</a>
        </li>
        <li class="flex items-center">
          <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
          <span class="text-gray-900 dark:text-gray-100" aria-current="page">My Wishlist</span>
        </li>
      </ol>
    </nav>

    {{-- Category Header --}}
    <section class="py-6 sm:py-8 lg:py-12" aria-labelledby="category-title">
      {{-- Title --}}
      <div class="mb-6 sm:mb-8">
        <h1 id="category-title" class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 dark:text-gray-100">
          My Wishlist
        </h1>
      </div>

      @php
        $tags = ['Skin Care', 'Morning', 'Night', 'Special Care', 'Men\'s Care', 'Dry Skin', 'Complex Skin', 'Sensitive Skin', 'Troubled Skin'];
      @endphp

      {{-- Category Tags --}}
      <nav class="mb-6 sm:mb-8" aria-label="Category filters">
        <div class="flex flex-wrap gap-2 sm:gap-3" role="list">
          @foreach ($tags as $tag)
            <a href="#{{ Str::slug($tag) }}"
              class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700"
              role="listitem"
              aria-label="{{ $tag }}">
              {{ $tag }}
            </a>
          @endforeach
        </div>
      </nav>

      {{-- Results Count & Sort Controls --}}
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 sm:mb-8 pb-4 sm:pb-6 border-b border-gray-200 dark:border-gray-700">
        {{-- Results Count --}}
        <div class="flex items-center">
          <span class="text-sm text-gray-600 dark:text-gray-400" aria-live="polite">
            <span class="font-semibold text-gray-900 dark:text-gray-100">{{ is_array($oldCart) ? count($oldCart) : 0 }}</span> results
          </span>
        </div>

        {{-- Sort Dropdown --}}
        <div class="flex items-center gap-2 sm:gap-3">
          <label for="sort-select" class="text-sm font-medium text-gray-700 dark:text-gray-300 whitespace-nowrap">Sort by</label>
          <select
            id="sort-select"
            class="px-3 py-2 text-sm bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors duration-200"
            aria-label="Sort products by">
            <option value="popularity">Popularity</option>
            <option value="price-low">Price: Low to High</option>
            <option value="price-high">Price: High to Low</option>
          </select>
        </div>
      </div>
    </section>

    {{-- Loading Spinner --}}
    <div class="hidden fixed inset-0 bg-white dark:bg-gray-900 bg-opacity-90 dark:bg-opacity-90 z-50 flex items-center justify-center" id="loading-section">
      <div class="text-center">
        <div class="inline-block w-12 h-12 border-4 border-orange-600 border-t-transparent animate-spin"></div>
        <p class="mt-4 text-gray-900 dark:text-gray-100">Loading wishlist...</p>
      </div>
    </div>

    {{-- Wishlist Products --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6 lg:gap-8 mb-12" id="products-grid">
      @if (!empty($oldCart) && is_array($oldCart) && count($oldCart))
        @foreach($oldCart as $prod)
          <article class="bg-white dark:bg-gray-800 shadow-sm overflow-hidden group hover:shadow-md transition-all duration-300" itemscope itemtype="https://schema.org/Product">
            <a href="{{ url('/item/'.$prod['slug']) }}" class="block focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
              <div class="relative aspect-square overflow-hidden bg-gray-100 dark:bg-gray-700">
                <img
                  src="{{ $prod['photo'] ? asset('assets/images/products/'.$prod['photo']) : asset('assets/images/noimage.png') }}"
                  alt="{{ $prod['name'] }}"
                  width="300"
                  height="300"
                  loading="lazy"
                  class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                <div class="absolute top-2 left-2 sm:top-3 sm:left-3 flex flex-col gap-1">
                  <span class="inline-block px-2 py-1 bg-green-600 text-white text-sm font-semibold" role="status">New</span>
                  <span class="inline-block px-2 py-1 bg-red-600 text-white text-sm font-semibold" role="status">15% Off</span>
                </div>
              </div>
              <div class="p-3 sm:p-4">
                <div class="mb-2">
                  <span class="text-base font-bold text-gray-900 dark:text-gray-100" itemprop="price">₹ {{ $prod['price'] }}</span>
                </div>
                <h3 class="text-sm font-medium text-gray-900 dark:text-gray-100 line-clamp-2 leading-relaxed" itemprop="name">
                  {{ ucfirst(mb_strtolower($prod['name'])) }}
                </h3>
              </div>
            </a>
            <div class="px-3 sm:px-4 pb-3 sm:pb-4">
              <x-cart-button :product-id="$prod['id']" />
            </div>
          </article>
        @endforeach
      @else
        <div class="col-span-full py-16 text-center">
          <p class="text-gray-600 dark:text-gray-400 text-lg">No items in your wishlist.</p>
        </div>
      @endif
    </div>

    {{-- Load More --}}
    @if (!empty($oldCart) && is_array($oldCart) && count($oldCart) > 0)
    <div class="py-8 sm:py-12 text-center border-t border-gray-200 dark:border-gray-700">
      <button
        type="button"
        class="inline-flex items-center px-6 sm:px-8 py-3 sm:py-4 bg-orange-600 text-white text-sm sm:text-base font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900 transition-all duration-200"
        aria-label="Load more products">
        Load More Products
      </button>
      <p class="mt-4 text-sm text-gray-600 dark:text-gray-400">
        Showing <span class="font-semibold text-gray-900 dark:text-gray-100">{{ is_array($oldCart) ? count($oldCart) : 0 }}</span> of {{ is_array($oldCart) ? count($oldCart) : 0 }} products
      </p>
    </div>
    @endif

  </div>

  {{-- CELIGIN Promotional Banners --}}
  <x-celigin-banners />
</main>
@endsection

@section('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Hide loader on page load
    const loader = document.getElementById('loading-section');
    if (loader) {
      loader.classList.add('hidden');
    }
  });
</script>

<!-- Centralized Cart & Wishlist Manager - INLINE VERSION (WAMP compatibility) -->
<script>
(function(window) {
  'use strict';

  const CartWishlistManager = {
    config: {
      csrfToken: '{{ csrf_token() }}',
      baseUrl: '{{ url("/") }}',
      urls: {
        addCart: '{{ url("/addcart") }}/',
        addWishlist: '{{ url("/addwishlist") }}/'
      }
    },

    dom: {
      cartCount: null,
      cartCountMobile: null,
      wishlistCount: null,
      wishlistCountMobile: null
    },

    init() {
      console.log('[CartWishlistManager] Initializing...');
      this.cacheDOMElements();
      this.attachEventListeners();
      console.log('[CartWishlistManager] Base URL:', this.config.baseUrl);
      console.log('[CartWishlistManager] Cart URL:', this.config.urls.addCart);
      console.log('[CartWishlistManager] Initialized successfully');
    },

    cacheDOMElements() {
      this.dom.cartCount = document.getElementById('cart-count');
      this.dom.cartCountMobile = document.getElementById('cart-count-mobile');
      this.dom.wishlistCount = document.getElementById('wishlist-count');
      this.dom.wishlistCountMobile = document.getElementById('wishlist-count-mobile');
    },

    attachEventListeners() {
      document.addEventListener('click', (e) => {
        const cartBtn = e.target.closest('.add-to-cart-btn');
        if (cartBtn) {
          e.preventDefault();
          const productId = cartBtn.dataset.id || cartBtn.dataset.productId;
          if (productId) {
            this.addToCart(productId, 1);
          }
          return;
        }

        const wishlistBtn = e.target.closest('.add-wishlist-btn');
        if (wishlistBtn) {
          e.preventDefault();
          const productId = wishlistBtn.dataset.id || wishlistBtn.dataset.productId;
          if (productId) {
            this.addToWishlist(productId);
          }
          return;
        }
      });
      console.log('[CartWishlistManager] Event listeners attached');
    },

    addToCart(productId, quantity = 1) {
      const url = `${this.config.urls.addCart}${productId}`;
      console.log('[CartWishlistManager] Adding to cart:', productId);
      console.log('[CartWishlistManager] Request to:', url);
      this.handleAction(url, (data) => {
        if (data.cart_count !== undefined) {
          this.updateCounter(this.dom.cartCount, data.cart_count);
          this.updateCounter(this.dom.cartCountMobile, data.cart_count);
        }
      });
    },

    addToWishlist(productId) {
      const url = `${this.config.urls.addWishlist}${productId}`;
      console.log('[CartWishlistManager] Adding to wishlist:', productId);
      console.log('[CartWishlistManager] Request to:', url);
      this.handleAction(url, (data) => {
        if (data.wishlist_count !== undefined) {
          this.updateCounter(this.dom.wishlistCount, data.wishlist_count);
          this.updateCounter(this.dom.wishlistCountMobile, data.wishlist_count);
        }
      });
    },

    handleAction(url, successCallback) {
      fetch(url, {
        method: 'GET',
        headers: {
          'X-CSRF-TOKEN': this.config.csrfToken,
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json'
        }
      })
      .then(res => {
        console.log('[CartWishlistManager] Response status:', res.status);
        if (!res.ok) throw new Error(`HTTP ${res.status}`);
        return res.json();
      })
      .then(data => {
        console.log('[CartWishlistManager] Response data:', data);
        if (data.success) {
          this.showNotification('success', data.message || 'Success');
          if (successCallback) successCallback(data);
        } else {
          this.showNotification('warning', data.message || 'Failed');
        }
      })
      .catch(error => {
        console.error('[CartWishlistManager] Error:', error);
        this.showNotification('error', 'An error occurred');
      });
    },

    updateCounter(element, value) {
      if (element) {
        element.textContent = value;
        element.setAttribute('aria-label', `${value} items`);
      }
    },

    showNotification(type, message) {
      if (typeof toastr !== 'undefined') {
        toastr[type](message);
      } else {
        console.log(`[${type.toUpperCase()}] ${message}`);
      }
    }
  };

  window.CartWishlistManager = CartWishlistManager;

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => CartWishlistManager.init());
  } else {
    CartWishlistManager.init();
  }

})(window);
</script>
@endsection
