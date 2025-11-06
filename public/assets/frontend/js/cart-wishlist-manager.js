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
      baseUrl: window.location.origin + window.location.pathname.split('/').slice(0, 2).join('/'),
      urls: {
        addCart: '',
        addWishlist: ''
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

      // Auto-detect base URL from current page
      const currentPath = window.location.pathname;
      const pathParts = currentPath.split('/').filter(part => part);

      // If we're in a subfolder like /usceligin, include it
      if (pathParts.length > 0 && pathParts[0] !== 'addcart' && pathParts[0] !== 'addwishlist') {
        this.config.baseUrl = window.location.origin + '/' + pathParts[0];
      } else {
        this.config.baseUrl = window.location.origin;
      }

      // Set URLs with base path
      this.config.urls.addCart = this.config.baseUrl + '/addcart/';
      this.config.urls.addWishlist = this.config.baseUrl + '/addwishlist/';

      console.log('[CartWishlistManager] Base URL:', this.config.baseUrl);
      console.log('[CartWishlistManager] Cart URL:', this.config.urls.addCart);
      console.log('[CartWishlistManager] Wishlist URL:', this.config.urls.addWishlist);
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
     * Uses event delegation for dynamic content (works with Swiper, AJAX, etc.)
     */
    attachEventListeners() {
      // Use event delegation on document level for dynamically added buttons
      document.addEventListener('click', (e) => {
        // Check if clicked element is add-to-cart button
        const cartBtn = e.target.closest('.add-to-cart-btn');
        if (cartBtn) {
          e.preventDefault();
          const productId = cartBtn.dataset.id || cartBtn.dataset.productId;
          const quantity = cartBtn.dataset.quantity || 1;

          if (!productId) {
            console.error('[CartWishlistManager] Product ID not found on button:', cartBtn);
            return;
          }

          this.addToCart(productId, quantity);
          return;
        }

        // Check if clicked element is add-to-wishlist button
        const wishlistBtn = e.target.closest('.add-wishlist-btn');
        if (wishlistBtn) {
          e.preventDefault();
          const productId = wishlistBtn.dataset.id || wishlistBtn.dataset.productId;

          if (!productId) {
            console.error('[CartWishlistManager] Product ID not found on button:', wishlistBtn);
            return;
          }

          this.addToWishlist(productId);
          return;
        }
      });

      console.log('[CartWishlistManager] Event delegation attached to document for cart and wishlist buttons');
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
      console.log('[CartWishlistManager] Making request to:', url);

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
        if (!res.ok) {
          throw new Error(`HTTP error! status: ${res.status}`);
        }
        return res.json();
      })
      .then(data => {
        console.log('[CartWishlistManager] Response data:', data);

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
