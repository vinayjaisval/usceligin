{{--
  Centralized Cart & Wishlist Manager Script

  This is a reusable partial that provides cart and wishlist functionality.
  Include this in the @section('scripts') of any page that needs cart/wishlist features.

  Usage:
    @section('scripts')
      @include('frontend.include.cart-wishlist-script')
    @endsection
--}}

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
      this.cacheDOMElements();
      this.attachEventListeners();
    },

    cacheDOMElements() {
      this.dom.cartCount = document.getElementById('cart-count');
      this.dom.cartCountMobile = document.getElementById('cart-count-mobile');
      this.dom.wishlistCount = document.getElementById('wishlist-count');
      this.dom.wishlistCountMobile = document.getElementById('wishlist-count-mobile');
    },

    attachEventListeners() {
      // Event delegation for dynamically loaded content (Swiper, AJAX, etc.)
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
    },

    addToCart(productId, quantity = 1) {
      const url = `${this.config.urls.addCart}${productId}`;
      this.handleAction(url, (data) => {
        if (data.cart_count !== undefined) {
          this.updateCounter(this.dom.cartCount, data.cart_count);
          this.updateCounter(this.dom.cartCountMobile, data.cart_count);
        }
      });
    },

    addToWishlist(productId) {
      const url = `${this.config.urls.addWishlist}${productId}`;
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
        if (!res.ok) throw new Error(`HTTP ${res.status}`);
        return res.json();
      })
      .then(data => {
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

  // Expose to window for external access if needed
  window.CartWishlistManager = CartWishlistManager;

  // Auto-initialize when DOM is ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => CartWishlistManager.init());
  } else {
    CartWishlistManager.init();
  }

})(window);
</script>
