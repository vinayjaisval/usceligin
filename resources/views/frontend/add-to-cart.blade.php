@extends('frontend.include.app')

@section('content')
<!-- Main Content -->
<!-- <main id="main-content" role="main" class="bg-white dark:bg-gray-900"> -->
<main id="main-content" role="main" class="bg-gray-50 dark:bg-gray-900 min-h-screen">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <!-- Breadcrumb Navigation -->
    @include('frontend.include.breadcrumb', ['items' => [
      ['label' => 'Home', 'url' => route('front.index')],
      ['label' => 'Cart']
    ]])

    <!-- Loading Spinner -->
    @include('frontend.include.loading-spinner', [
      'id' => 'loading-section',
      'message' => 'Loading cart...'
    ])

    @if(Session::has('cart'))
    <!-- Shopping Cart Section -->
    <section role="main">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">

        <!-- Cart Items Section (2 columns on desktop) -->
        <div class="lg:col-span-2 space-y-6">

          <!-- Rewards Section with Collapsible -->
          <div class="bg-orange-50 dark:bg-orange-900/20 border border-orange-300 dark:border-orange-700">
            <button
              type="button"
              onclick="toggleRewards()"
              class="w-full flex items-center justify-between p-4 text-left bg-orange-50 dark:bg-orange-900/20 hover:bg-orange-100 dark:hover:bg-orange-900/30 transition-colors">
              <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-orange-600 dark:text-orange-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                </svg>
                <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100">Unlock Exclusive Rewards</h2>
              </div>
              <svg
                id="rewards-chevron"
                class="w-5 h-5 text-gray-600 dark:text-gray-400 transform transition-transform rotate-180"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>

            <div id="rewards-content" class="p-4 border-t border-orange-300 dark:border-orange-700 bg-orange-50 dark:bg-orange-900/20">
              <div class="space-y-4">
                <p class="text-sm text-gray-700 dark:text-gray-300">
                  Join our rewards program and earn points with every purchase. New members get <strong class="text-orange-600 dark:text-orange-400">20 bonus points</strong> instantly!
                </p>
                <p class="text-xs text-gray-600 dark:text-gray-400">
                  Redeem your points for discounts on future orders. The more you shop, the more you save.
                </p>

                <!-- Reward Tiers -->
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                  <div class="bg-white dark:bg-gray-800 px-4 py-3 border border-gray-200 dark:border-gray-700 text-center">
                    <span class="block text-xs font-semibold text-gray-600 dark:text-gray-400">100 PTS</span>
                    <span class="block text-sm font-bold text-orange-600 dark:text-orange-400">₹3 off</span>
                  </div>
                  <div class="bg-white dark:bg-gray-800 px-4 py-3 border border-gray-200 dark:border-gray-700 text-center">
                    <span class="block text-xs font-semibold text-gray-600 dark:text-gray-400">500 PTS</span>
                    <span class="block text-sm font-bold text-orange-600 dark:text-orange-400">₹17.50 off</span>
                  </div>
                  <div class="bg-white dark:bg-gray-800 px-4 py-3 border border-gray-200 dark:border-gray-700 text-center">
                    <span class="block text-xs font-semibold text-gray-600 dark:text-gray-400">1000 PTS</span>
                    <span class="block text-sm font-bold text-orange-600 dark:text-orange-400">₹50 off</span>
                  </div>
                </div>

                <a href="{{ route('sign-in') }}" class="inline-block px-6 py-2.5 bg-orange-600 text-white text-sm font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-colors duration-200">
                  Join Now & Earn Points
                </a>
              </div>
            </div>
          </div>

          <!-- Dismissible Free Delivery Alert -->
          <div class="relative flex items-start space-x-3 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 p-4" id="free-delivery-alert">
            <svg class="w-5 h-5 text-green-600 dark:text-green-400 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="1" y="3" width="15" height="13"></rect>
              <polygon points="16,8 20,8 23,11 23,16 16,16 16,8"></polygon>
              <circle cx="5.5" cy="18.5" r="2.5"></circle>
              <circle cx="18.5" cy="18.5" r="2.5"></circle>
            </svg>
            <div class="flex-1">
              <p class="text-sm text-gray-700 dark:text-gray-300">
                <strong class="font-semibold">Free same day delivery</strong> on orders over ₹{{ $gs->free_shipping_amount ?? 500 }}
              </p>
              <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Limited time offer. Order now!</p>
            </div>
            <button
              type="button"
              onclick="this.parentElement.remove();"
              class="flex-shrink-0 p-1 text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-200 focus:outline-none focus:ring-2 focus:ring-green-500 rounded transition-colors"
              aria-label="Dismiss alert">
              <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
              </svg>
            </button>
          </div>

          <!-- Cart Header -->
          <div class="flex items-center justify-between border-b border-gray-200 dark:border-gray-700 pb-4">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Shopping Bag</h2>
            <span class="text-sm text-gray-600 dark:text-gray-400">
              {{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }} {{ count(Session::get('cart')->items) === 1 ? 'item' : 'items' }}
            </span>
          </div>

          <!-- Cart Items -->
          <div class="space-y-4">
            @foreach ($products as $product)
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-4 sm:p-6 cremove{{ $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'), '', $product['values']) }}">
              <div class="flex flex-col sm:flex-row gap-4">
                <!-- Product Image -->
                <div class="w-full sm:w-24 h-32 sm:h-24 flex-shrink-0 bg-gray-100 dark:bg-gray-700 overflow-hidden">
                  <img
                    src="{{ $product['item']['photo'] ? asset('assets/images/products/'.$product['item']['photo']) : asset('assets/images/noimage.png') }}"
                    alt="{{ $product['item']['name'] }}"
                    class="w-full h-full object-cover" />
                </div>

                <!-- Product Details -->
                <div class="flex-1 min-w-0 space-y-3">
                  <!-- Product Name & Price -->
                  <div class="flex items-start justify-between gap-4">
                    <div class="flex-1 min-w-0">
                      <h3 class="text-sm sm:text-base font-semibold text-gray-900 dark:text-gray-100 line-clamp-2">
                        {{ $product['item']['name'] }}
                      </h3>
                      @if($product['size'] || $product['color'])
                      <div class="flex flex-wrap gap-2 mt-2 text-xs text-gray-600 dark:text-gray-400">
                        @if($product['size'])
                        <span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded">Size: {{ $product['size'] }}</span>
                        @endif
                        @if($product['color'])
                        <span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded">Color: {{ $product['color'] }}</span>
                        @endif
                      </div>
                      @endif
                    </div>
                    <span class="text-base sm:text-lg font-bold text-gray-900 dark:text-gray-100 whitespace-nowrap">
                      {{ App\Models\Product::convertPrice($product['price']) }}
                    </span>
                  </div>

                  <!-- Quantity Selector & Actions -->
                  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <!-- Quantity -->
                    <div class="flex items-center space-x-3">
                      <label for="qty-{{ $product['item']['id'] }}" class="text-sm text-gray-600 dark:text-gray-400">Qty:</label>
                      <select
                        id="qty-{{ $product['item']['id'] }}"
                        class="quantity-select px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-sm text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                        data-id="{{ $product['item']['id'] }}"
                        data-size="{{ $product['size'] }}"
                        data-color="{{ $product['color'] }}"
                        data-values="{{ str_replace(str_split(' ,'), '', $product['values']) }}">
                        @for ($i = 1; $i <= 10; $i++)
                          <option value="{{ $i }}" {{ $product['qty'] == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                      </select>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center space-x-4">
                      <button
                        type="button"
                        class="save-for-later-btn flex items-center space-x-1 text-sm text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium transition-colors"
                        data-id="{{ $product['item']['id'] }}"
                        data-size="{{ $product['size'] }}"
                        data-color="{{ $product['color'] }}"
                        data-values="{{ str_replace(str_split(' ,'), '', $product['values']) }}"
                        aria-label="Save for later">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                          <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                        </svg>
                        <span>Save for Later</span>
                      </button>
                      <a
                        href="javascript:void(0);"
                        class="remove cart-remove flex items-center space-x-1 text-sm text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 font-medium transition-colors"
                        data-class="cremove{{ $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'), '', $product['values']) }}"
                        data-href="{{ route('product.cart.remove', $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'), '', $product['values'])) }}"
                        aria-label="Remove from cart">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                          <polyline points="3,6 5,6 21,6"></polyline>
                          <path d="m19,6v14a2,2 0 0,1 -2,2H7a2,2 0 0,1 -2,-2V6m3,0V4a2,2 0 0,1 2,-2h4a2,2 0 0,1 2,2v2"></path>
                        </svg>
                        <span>Remove</span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>

          <!-- Saved for Later Section -->
          <div id="saved-for-later-section" class="hidden">
            <div class="border-t border-gray-200 dark:border-gray-700 pt-6 mt-6">
              <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">Saved for Later</h3>
              <div id="saved-items-container" class="space-y-4">
                <!-- Saved items will be added here dynamically -->
              </div>
            </div>
          </div>
        </div>

        <!-- Order Summary Sidebar (1 column on desktop) -->
        <div class="lg:col-span-1">
          <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 lg:sticky lg:top-24 space-y-6">
            <!-- Order Summary -->
            <div>
              

              @php
                $cartItemCount = Session::has('cart') ? count(Session::get('cart')->items) : 0;
              @endphp
              <div class="flex items-center justify-between py-4 mb-6">
                <span class="text-lg font-bold text-gray-900 dark:text-gray-100">Subtotal ({{ $cartItemCount }} {{ $cartItemCount === 1 ? 'item' : 'items' }})</span>
                <span class="text-lg font-bold text-gray-900 dark:text-gray-100">{{ App\Models\Product::convertPrice($mainTotal) }}</span>
              </div>

              <a href="{{ route('front.checkout') }}" onclick="prepareCheckout(event)" class="block w-full px-6 py-3 bg-orange-600 text-white text-center text-base font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-colors duration-200">
                Proceed to Checkout
              </a>
            </div>

          </div>
        </div>
      </div>
    </section>
    @else

    <!-- Empty Cart Message -->
    <section class="py-16">
      <div class="text-center max-w-md mx-auto">
        <div class="w-32 h-32 mx-auto mb-6 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center">
          <svg class="w-16 h-16 text-gray-400 dark:text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="9" cy="21" r="1"></circle>
            <circle cx="20" cy="21" r="1"></circle>
            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
          </svg>
        </div>
        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-2">Your Cart is Empty</h2>
        <p class="text-gray-600 dark:text-gray-400 mb-6">Start shopping to add items to your cart</p>
        <a href="{{ route('front.index') }}" class="inline-block px-6 py-3 bg-orange-600 text-white text-base font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-colors duration-200">
          Continue Shopping
        </a>
      </div>
    </section>
    @endif

  </div>
</main>
@endsection

@section('scripts')
<script>
  // Loader functions
  function showLoader() {
    const loader = document.getElementById('loading-section');
    if (loader) {
      loader.classList.remove('hidden');
      loader.classList.add('flex');
    }
  }

  function hideLoader() {
    const loader = document.getElementById('loading-section');
    if (loader) {
      loader.classList.add('hidden');
      loader.classList.remove('flex');
    }
  }

  // Show toast notification
  function showToast(message, type = 'success') {
    const backgroundColor = type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : '#f59e0b';
    Toastify({
      text: message,
      duration: 3000,
      close: true,
      gravity: "top",
      position: "right",
      backgroundColor: backgroundColor
    }).showToast();
  }

  // Toggle rewards section
  function toggleRewards() {
    const content = document.getElementById('rewards-content');
    const chevron = document.getElementById('rewards-chevron');

    content.classList.toggle('hidden');
    chevron.classList.toggle('rotate-180');
  }

  document.addEventListener('DOMContentLoaded', function() {
    hideLoader();
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Remove cart item
    const removeButtons = document.querySelectorAll('.cart-remove');
    removeButtons.forEach(button => {
      button.addEventListener('click', function() {
        const href = this.dataset.href;
        const itemClass = this.dataset.class;

        if (!href) return;

        showLoader();

        fetch(href, {
            method: 'GET',
            headers: {
              'X-Requested-With': 'XMLHttpRequest',
              'X-CSRF-TOKEN': csrfToken
            }
          })
          .then(res => res.json())
          .then(data => {
            hideLoader();
            if (data.success) {
              const element = document.querySelector('.' + itemClass);
              if (element) {
                element.style.opacity = '0';
                element.style.transform = 'scale(0.95)';
                setTimeout(() => element.remove(), 300);
              }

              showToast(data.message || "Product removed from cart", 'success');

              setTimeout(() => {
                window.location.reload();
              }, 500);
            } else {
              showToast('Failed to remove item', 'error');
            }
          })
          .catch(err => {
            hideLoader();
            showToast('Error removing item', 'error');
            console.error('Remove error:', err);
          });
      });
    });

    // Update quantity
    document.querySelectorAll('.quantity-select').forEach(select => {
      select.addEventListener('change', function() {
        const id = this.dataset.id;
        const size = this.dataset.size || '';
        const color = this.dataset.color || '';
        const values = this.dataset.values || '';
        const qty = this.value;

        showLoader();

        fetch('{{ route("details.cart") }}', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-Requested-With': 'XMLHttpRequest',
              'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
              id,
              size,
              color,
              values,
              qty
            })
          })
          .then(res => res.json())
          .then(data => {
            hideLoader();
            if (data.success) {
              showToast('Quantity updated', 'success');
              setTimeout(() => window.location.reload(), 500);
            } else {
              showToast('Failed to update quantity', 'error');
            }
          })
          .catch(err => {
            hideLoader();
            showToast('Error updating quantity', 'error');
            console.error('Error updating quantity:', err);
          });
      });
    });

    // Save for later functionality
    const savedItems = JSON.parse(localStorage.getItem('savedForLater') || '[]');
    const savedItemsContainer = document.getElementById('saved-items-container');
    const savedSection = document.getElementById('saved-for-later-section');

    // Load saved items
    function loadSavedItems() {
      if (savedItems.length > 0 && savedItemsContainer) {
        savedSection.classList.remove('hidden');
        savedItemsContainer.innerHTML = savedItems.map(item => `
          <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-4 sm:p-6">
            <div class="flex flex-col sm:flex-row gap-4">
              <div class="w-full sm:w-24 h-32 sm:h-24 flex-shrink-0 bg-gray-100 dark:bg-gray-700 overflow-hidden">
                <img src="${item.image}" alt="${item.name}" class="w-full h-full object-cover" />
              </div>
              <div class="flex-1 min-w-0 space-y-3">
                <div class="flex items-start justify-between gap-4">
                  <h4 class="text-sm sm:text-base font-semibold text-gray-900 dark:text-gray-100 line-clamp-2">${item.name}</h4>
                </div>
                <div class="flex items-center justify-end space-x-4">
                  <button
                    class="move-to-cart-btn flex items-center space-x-1 text-sm text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium transition-colors"
                    data-key="${item.key}">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <circle cx="9" cy="21" r="1"></circle>
                      <circle cx="20" cy="21" r="1"></circle>
                      <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                    <span>Move to Cart</span>
                  </button>
                  <button
                    class="remove-saved-btn flex items-center space-x-1 text-sm text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 font-medium transition-colors"
                    data-key="${item.key}">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <polyline points="3,6 5,6 21,6"></polyline>
                      <path d="m19,6v14a2,2 0 0,1 -2,2H7a2,2 0 0,1 -2,-2V6m3,0V4a2,2 0 0,1 2,-2h4a2,2 0 0,1 2,2v2"></path>
                    </svg>
                    <span>Remove</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        `).join('');

        // Attach event listeners to saved items
        document.querySelectorAll('.remove-saved-btn').forEach(btn => {
          btn.addEventListener('click', function() {
            const key = this.dataset.key;
            const index = savedItems.findIndex(item => item.key === key);
            if (index > -1) {
              savedItems.splice(index, 1);
              localStorage.setItem('savedForLater', JSON.stringify(savedItems));
              loadSavedItems();
              showToast('Item removed from saved items', 'success');
            }
          });
        });

        document.querySelectorAll('.move-to-cart-btn').forEach(btn => {
          btn.addEventListener('click', function() {
            const key = this.dataset.key;
            const item = savedItems.find(i => i.key === key);

            if (item) {
              // Add item back to cart via AJAX
              const addToCartData = {
                id: item.id,
                size: item.size,
                color: item.color,
                values: item.values,
                qty: 1
              };

              fetch('{{ route("details.cart") }}', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'X-Requested-With': 'XMLHttpRequest',
                  'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(addToCartData)
              })
              .then(res => res.json())
              .then(data => {
                if (data.success) {
                  // Remove from saved items
                  const index = savedItems.findIndex(i => i.key === key);
                  if (index > -1) {
                    savedItems.splice(index, 1);
                    localStorage.setItem('savedForLater', JSON.stringify(savedItems));
                  }

                  showToast('Item moved to cart', 'success');
                  setTimeout(() => window.location.reload(), 500);
                } else {
                  showToast('Failed to move item to cart', 'error');
                }
              })
              .catch(err => {
                showToast('Error moving item to cart', 'error');
                console.error('Move to cart error:', err);
              });
            }
          });
        });
      } else if (savedSection) {
        savedSection.classList.add('hidden');
      }
    }

    loadSavedItems();

    // Save for later button click
    document.querySelectorAll('.save-for-later-btn').forEach(button => {
      button.addEventListener('click', function() {
        const id = this.dataset.id;
        const size = this.dataset.size || '';
        const color = this.dataset.color || '';
        const values = this.dataset.values || '';
        const key = `${id}${size}${color}${values}`;

        // Get product details from the DOM
        const productCard = this.closest('.bg-white');
        const name = productCard.querySelector('h3').textContent.trim();
        const image = productCard.querySelector('img').src;

        // Save to localStorage
        if (!savedItems.find(item => item.key === key)) {
          savedItems.push({
            key,
            id,
            size,
            color,
            values,
            name,
            image
          });
          localStorage.setItem('savedForLater', JSON.stringify(savedItems));

          // Remove from cart
          const removeBtn = productCard.querySelector('.cart-remove');
          if (removeBtn) {
            removeBtn.click();
          }

          showToast('Item saved for later', 'success');
          setTimeout(() => loadSavedItems(), 600);
        } else {
          showToast('Item already in saved list', 'info');
        }
      });
    });
  });

  // Prepare checkout - save cart state before navigating
  function prepareCheckout(event) {
    // Store cart metadata in sessionStorage
    const cartData = {
      itemCount: {{ Session::has('cart') ? count(Session::get('cart')->items) : 0 }},
      totalPrice: {{ $totalPrice  }},
      timestamp: Date.now()
    };

    sessionStorage.setItem('cartMetadata', JSON.stringify(cartData));

    // Check if user is authenticated
    @if(!Auth::check())
      event.preventDefault();
      showToast('Please login to proceed to checkout', 'error');

      // Store intended URL for redirect after login
      sessionStorage.setItem('intendedUrl', '{{ route("front.checkout") }}');

      setTimeout(() => {
        window.location.href = '{{ route("sign-in") }}';
      }, 1000);
      return false;
    @endif

    // Continue to checkout
    return true;
  }
</script>
@endsection
