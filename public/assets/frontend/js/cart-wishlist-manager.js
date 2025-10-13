/**
 * Centralized Cart & Wishlist Management Module
 * Works with both Tailwind CSS and custom CSS pages
 *
 * @version 1.0.0
 * @date 2025-10-09
 *
 * Features:
 * - Unified cart/wishlist functionality across all pages
 * - Automatic desktop/mobile counter synchronization
 * - CSRF token handling
 * - Toastr notification integration
 * - Works with both data-id and data-product-id attributes
 *
 * Usage:
 *   <script src="{{ asset('assets/frontend/js/cart-wishlist-manager.js') }}"></script>
 *   <script>
 *     document.addEventListener('DOMContentLoaded', function() {
 *       window.CartWishlistManager.init();
 *     });
 *   </script>
 */

(function(window) {
  'use strict';

  const CartWishlistManager = {
    // Configuration
    config: {
      csrfToken: '',
      urls: {
        addCart: '/celiginus/addcart/',
        addWishlist: '/celiginus/addwishlist/'
      }
    },

    // DOM cache
    dom: {
      cartCount: null,
      cartCountMobile: null,
      wishlistCount: null,
      wishlistCountMobile: null
    },

    /**
     * Initialize the cart/wishlist manager
     * Call this on DOMContentLoaded
     */
    init() {
      this.loadConfig();
      this.cacheDOMElements();
      this.attachEventListeners();
      console.log('[CartWishlistManager] Initialized successfully');
    },

    /**
     * Load configuration from page
     */
    loadConfig() {
      // Get CSRF token from meta tag
      const csrfMetaTag = document.querySelector('meta[name="csrf-token"]');
      if (csrfMetaTag) {
        this.config.csrfToken = csrfMetaTag.getAttribute('content');
      } else {
        console.warn('[CartWishlistManager] CSRF token meta tag not found');
      }
    },

    /**
     * Cache frequently accessed DOM elements
     */
    cacheDOMElements() {
      this.dom.cartCount = document.getElementById('cart-count');
      this.dom.cartCountMobile = document.getElementById('cart-count-mobile');
      this.dom.wishlistCount = document.getElementById('wishlist-count');
      this.dom.wishlistCountMobile = document.getElementById('wishlist-count-mobile');
    },

    /**
     * Attach event listeners to cart/wishlist buttons
     * Uses event delegation for dynamic content
     */
    attachEventListeners() {
      // Add to cart buttons
      document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', (e) => {
          e.preventDefault();
          const productId = button.dataset.id || button.dataset.productId;
          const quantity = button.dataset.quantity || 1;

          if (!productId) {
            console.error('[CartWishlistManager] Product ID not found on button:', button);
            return;
          }

          this.addToCart(productId, quantity);
        });
      });

      // Add to wishlist buttons
      document.querySelectorAll('.add-wishlist-btn').forEach(button => {
        button.addEventListener('click', (e) => {
          e.preventDefault();
          const productId = button.dataset.id || button.dataset.productId;

          if (!productId) {
            console.error('[CartWishlistManager] Product ID not found on button:', button);
            return;
          }

          this.addToWishlist(productId);
        });
      });

      console.log('[CartWishlistManager] Attached listeners to',
        document.querySelectorAll('.add-to-cart-btn').length, 'cart buttons and',
        document.querySelectorAll('.add-wishlist-btn').length, 'wishlist buttons'
      );
    },

    /**
     * Add product to cart
     * @param {string|number} productId - Product ID
     * @param {number} quantity - Quantity to add (default: 1)
     */
    addToCart(productId, quantity = 1) {
      const url = `${this.config.urls.addCart}${productId}${quantity > 1 ? `?quantity=${quantity}` : ''}`;

      this.handleAction(url, (data) => {
        // Update cart counters
        if (data.cart_count !== undefined) {
          this.updateCounter(this.dom.cartCount, data.cart_count);
          this.updateCounter(this.dom.cartCountMobile, data.cart_count);
        }
      });
    },

    /**
     * Add product to wishlist
     * @param {string|number} productId - Product ID
     */
    addToWishlist(productId) {
      const url = `${this.config.urls.addWishlist}${productId}`;

      this.handleAction(url, (data) => {
        // Update wishlist counters
        if (data.wishlist_count !== undefined) {
          this.updateCounter(this.dom.wishlistCount, data.wishlist_count);
          this.updateCounter(this.dom.wishlistCountMobile, data.wishlist_count);
        }
      });
    },

    /**
     * Generic action handler with fetch API
     * @param {string} url - API endpoint URL
     * @param {Function} successCallback - Callback function on success
     */
    handleAction(url, successCallback) {
      fetch(url, {
        method: 'GET',
        headers: {
          'X-CSRF-TOKEN': this.config.csrfToken,
          'X-Requested-With': 'XMLHttpRequest'
        }
      })
      .then(res => {
        if (!res.ok) {
          throw new Error(`HTTP error! status: ${res.status}`);
        }
        return res.json();
      })
      .then(data => {
        if (data.success) {
          // Show success notification
          this.showNotification('success', data.message || 'Success');

          // Execute success callback
          if (typeof successCallback === 'function') {
            successCallback(data);
          }
        } else {
          // Show warning notification
          this.showNotification('warning', data.message || 'Something went wrong.');
        }
      })
      .catch(error => {
        console.error('[CartWishlistManager] Request Error:', error);
        this.showNotification('error', 'Unexpected error occurred. Please try again.');
      });
    },

    /**
     * Update counter element with new value
     * @param {HTMLElement|null} element - Counter element
     * @param {number|string} value - New counter value
     */
    updateCounter(element, value) {
      if (element) {
        element.textContent = value;
        element.setAttribute('aria-label', `${value} items`);
      }
    },

    /**
     * Show notification using toastr if available
     * @param {string} type - Notification type (success, warning, error)
     * @param {string} message - Notification message
     */
    showNotification(type, message) {
      if (typeof toastr !== 'undefined') {
        toastr[type](message);
      } else if (typeof Toastify !== 'undefined') {
        // Fallback to Toastify
        const backgroundColor = {
          success: '#4caf50',
          warning: '#ff9800',
          error: '#f44336'
        };

        Toastify({
          text: message,
          duration: 3000,
          close: true,
          gravity: 'top',
          position: 'right',
          backgroundColor: backgroundColor[type] || '#333'
        }).showToast();
      } else {
        // Fallback to console
        console.log(`[CartWishlistManager] ${type.toUpperCase()}: ${message}`);
      }
    },

    /**
     * Manually trigger cart addition (for programmatic use)
     * @param {string|number} productId - Product ID
     * @param {number} quantity - Quantity to add
     */
    triggerAddToCart(productId, quantity = 1) {
      this.addToCart(productId, quantity);
    },

    /**
     * Manually trigger wishlist addition (for programmatic use)
     * @param {string|number} productId - Product ID
     */
    triggerAddToWishlist(productId) {
      this.addToWishlist(productId);
    },

    /**
     * Get current cart count
     * @returns {number} Cart count
     */
    getCartCount() {
      return this.dom.cartCount ? parseInt(this.dom.cartCount.textContent) : 0;
    },

    /**
     * Get current wishlist count
     * @returns {number} Wishlist count
     */
    getWishlistCount() {
      return this.dom.wishlistCount ? parseInt(this.dom.wishlistCount.textContent) : 0;
    }
  };

  // Expose to window for global access
  window.CartWishlistManager = CartWishlistManager;

  // Auto-initialize if autoInit is set
  if (window.CartWishlistAutoInit !== false) {
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', function() {
        CartWishlistManager.init();
      });
    } else {
      // DOM already loaded
      CartWishlistManager.init();
    }
  }

})(window);
