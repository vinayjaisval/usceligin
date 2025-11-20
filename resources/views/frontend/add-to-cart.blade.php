@extends('frontend.include.app')

@section('content')
<!-- Main Content -->
<main id="main-content" role="main" class="bg-white dark:bg-gray-900">
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
          <span class="text-gray-900 dark:text-gray-100" aria-current="page">Shopping Cart</span>
        </li>
      </ol>
    </nav>

    <!-- Loading Spinner -->
    <div class="hidden fixed inset-0 bg-white dark:bg-gray-900 bg-opacity-90 dark:bg-opacity-90 z-50 flex items-center justify-center" id="loading-section">
      <div class="text-center">
        <div class="inline-block w-12 h-12 border-4 border-orange-600 border-t-transparent animate-spin"></div>
        <p class="mt-4 text-gray-900 dark:text-gray-100">Loading cart...</p>
      </div>
    </div>

    @if(Session::has('cart'))
    <!-- Shopping Cart Section -->
    <section role="main">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Cart Items Section (2 columns on desktop) -->
        <div class="lg:col-span-2 space-y-6">

          <!-- Rewards Section -->
          <div class="bg-orange-50 dark:bg-orange-900/20 border-2 border-orange-200 dark:border-orange-800 p-6">
            <div class="flex items-start justify-between mb-4">
              <div class="flex items-center space-x-3">
                <!-- <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <circle cx="12" cy="12" r="3"></circle>
                  <path d="M12 1v6m0 6v6"></path>
                  <path d="m3.05 6.05 4.95 4.95m0 2v0m4.95 4.95L7.05 17.95"></path>
                </svg> -->
                <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100">Don't miss out on rewards!</h2>
              </div>
              <button class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors" aria-label="Toggle rewards details">
                <!-- <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <line x1="12" y1="5" x2="12" y2="19"></line>
                  <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg> -->
              </button>
            </div>

            <div class="space-y-4">
              <div>
                <p class="text-sm text-gray-700 dark:text-gray-300">
                  Get <strong>20+ points today</strong> with your purchase.
                  <button class="inline-flex items-center ml-1 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100" aria-label="More information about rewards">
                    <!-- <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                      <circle cx="12" cy="12" r="10"></circle>
                      <line x1="12" y1="16" x2="12" y2="12"></line>
                      <line x1="12" y1="8" x2="12.01" y2="8"></line>
                    </svg> -->
                  </button>
                </p>
                <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">The more you earn, the better the payoff.</p>
              </div>

              <div class="flex flex-wrap gap-3">
                <div class="bg-white dark:bg-gray-800 px-4 py-2 border border-gray-200 dark:border-gray-700">
                  <span class="block text-xs font-semibold text-gray-600 dark:text-gray-400">100 PTS</span>
                  <span class="block text-sm font-bold text-gray-900 dark:text-gray-100">₹3 off</span>
                </div>
                <div class="bg-white dark:bg-gray-800 px-4 py-2 border border-gray-200 dark:border-gray-700">
                  <span class="block text-xs font-semibold text-gray-600 dark:text-gray-400">500 PTS</span>
                  <span class="block text-sm font-bold text-gray-900 dark:text-gray-100">₹17.50 off</span>
                </div>
                <div class="bg-white dark:bg-gray-800 px-4 py-2 border border-gray-200 dark:border-gray-700">
                  <span class="block text-xs font-semibold text-gray-600 dark:text-gray-400">1000 PTS</span>
                  <span class="block text-sm font-bold text-gray-900 dark:text-gray-100">₹50 off</span>
                </div>
              </div>

              <a href="#" class="inline-block px-6 py-2 bg-orange-600 text-white text-sm font-semibold hover:bg-orange-700 transition-colors duration-200">Join or sign in</a>
            </div>
          </div>

          <!-- Free Delivery Banner -->
          <div class="flex items-center space-x-3 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 p-4">
            <svg class="w-5 h-5 text-green-600 dark:text-green-400 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="1" y="3" width="15" height="13"></rect>
              <polygon points="16,8 20,8 23,11 23,16 16,16 16,8"></polygon>
              <circle cx="5.5" cy="18.5" r="2.5"></circle>
              <circle cx="18.5" cy="18.5" r="2.5"></circle>
            </svg>
            <span class="text-sm text-gray-700 dark:text-gray-300"><strong>Free same day delivery over ₹35</strong> Now through September 18.</span>
          </div>

          <div class="flex items-center justify-between border-b border-gray-200 dark:border-gray-700 pb-4">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Bag</h2>
            <span class="text-sm text-gray-600 dark:text-gray-400">{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }} items</span>
          </div>

          <!-- Shipping Section -->
          <div class="space-y-4">
            <div class="flex items-center justify-between bg-gray-50 dark:bg-gray-800 p-4 border border-gray-200 dark:border-gray-700">
              <div class="flex items-center space-x-3">
                <svg class="w-6 h-6 text-gray-600 dark:text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <rect x="1" y="3" width="15" height="13"></rect>
                  <polygon points="16,8 20,8 23,11 23,16 16,16 16,8"></polygon>
                  <circle cx="5.5" cy="18.5" r="2.5"></circle>
                  <circle cx="18.5" cy="18.5" r="2.5"></circle>
                </svg>
                <div>
                  <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100">Ship</h3>
                  <p class="text-sm text-gray-600 dark:text-gray-400">You've earned <strong class="text-green-600 dark:text-green-400">FREE shipping</strong></p>
                  <span class="text-xs text-gray-500 dark:text-gray-500">{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }} items</span>
                </div>
              </div>
              <a href="#" class="text-sm text-orange-600 dark:text-orange-400 hover:text-orange-700 dark:hover:text-orange-300 font-medium">Edit all</a>
            </div>

            <!-- Cart Items -->
            @foreach ($products as $product)
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-4 cremove{{ $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'), '', $product['values']) }}">
              <div class="flex gap-4 mb-4">
                <div class="w-20 h-20 flex-shrink-0 bg-gray-100 dark:bg-gray-700">
                  <img src="{{ $product['item']['photo'] ? asset('assets/images/products/'.$product['item']['photo']) : asset('assets/images/noimage.png') }}"
                    alt="{{ $product['item']['name'] }}" class="w-full h-full object-cover" />
                </div>
                <div class="flex-1 min-w-0">
                  <h5 class="text-sm font-medium text-gray-900 dark:text-gray-100 line-clamp-2 mb-2">
                    {{ mb_strlen($product['item']['name'], 'UTF-8') > 35 ? mb_substr($product['item']['name'], 0, 35, 'UTF-8').'...' : $product['item']['name'] }}
                  </h5>
                  <div class="flex items-center space-x-2 text-xs text-gray-600 dark:text-gray-400">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <polyline points="23,4 23,10 17,10"></polyline>
                      <polyline points="1,20 1,14 7,14"></polyline>
                      <path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path>
                    </svg>
                    <span>Replenish and save</span>
                    <a href="#" class="text-orange-600 dark:text-orange-400 hover:underline font-medium">Add</a>
                  </div>
                </div>
              </div>

              <div class="space-y-4">
                <div class="flex items-center justify-between">
                  <select class="quantity-select px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-sm text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500" data-id="{{ $product['item']['id'] }}">
                    @for ($i = 1; $i <= 10; $i++)
                      <option value="{{ $i }}" {{ $product['qty'] == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                  </select>
                  <span class="text-lg font-bold text-gray-900 dark:text-gray-100">{{ App\Models\Product::convertPrice($product['price']) }}</span>
                </div>

                <!-- Delivery Options -->
                <div class="flex gap-2">
                  <a href="#" class="flex-1 flex items-center justify-center space-x-2 px-3 py-2 bg-orange-50 dark:bg-orange-900/20 border-2 border-orange-600 dark:border-orange-400 text-orange-600 dark:text-orange-400 text-xs font-medium hover:bg-orange-100 dark:hover:bg-orange-900/30 transition-colors" aria-label="Ship delivery option">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <rect x="1" y="3" width="15" height="13"></rect>
                      <polygon points="16,8 20,8 23,11 23,16 16,16 16,8"></polygon>
                      <circle cx="5.5" cy="18.5" r="2.5"></circle>
                      <circle cx="18.5" cy="18.5" r="2.5"></circle>
                    </svg>
                    <span>Ship</span>
                  </a>
                  <a href="#" class="flex-1 flex items-center justify-center space-x-2 px-3 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 text-xs font-medium hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors" aria-label="Pickup delivery option">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                      <polyline points="9,22 9,12 15,12 15,22"></polyline>
                    </svg>
                    <span>Pick up</span>
                  </a>
                  <a href="#" class="flex-1 flex items-center justify-center space-x-2 px-3 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 text-xs font-medium hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors" aria-label="Same day delivery option">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <circle cx="12" cy="12" r="10"></circle>
                      <polyline points="12,6 12,12 16,14"></polyline>
                    </svg>
                    <span>Same day</span>
                  </a>
                </div>

                <div class="flex items-center space-x-4 pt-2 border-t border-gray-200 dark:border-gray-700">
                  <a href="javascript:void(0);"
                    class="remove cart-remove flex items-center space-x-1 text-sm text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 font-medium transition-colors"
                    data-class="cremove{{ $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'), '', $product['values']) }}"
                    data-href="{{ route('product.cart.remove', $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'), '', $product['values'])) }}">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <polyline points="3,6 5,6 21,6"></polyline>
                      <path d="m19,6v14a2,2 0 0,1 -2,2H7a2,2 0 0,1 -2,-2V6m3,0V4a2,2 0 0,1 2,-2h4a2,2 0 0,1 2,2v2"></path>
                    </svg>
                    <span>Remove</span>
                  </a>
                  <button class="flex items-center space-x-1 text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 font-medium transition-colors" aria-label="Save for later">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                    </svg>
                    <span>Save for Later</span>
                  </button>
                </div>
              </div>
            </div>
            @endforeach
          </div>

          <!-- Saved for Later Section -->
          <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 text-center">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Saved for later</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Sign in to see your saved items.</p>
            <a href="{{ route('sign-in') }}" class="inline-block px-6 py-2 bg-orange-600 text-white text-sm font-semibold hover:bg-orange-700 transition-colors duration-200">Sign in</a>
          </div>
        </div>

        <!-- Order Summary Sidebar (1 column on desktop) -->
        <div class="lg:col-span-1 space-y-6">
          <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 sticky top-24">
            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-6">Order summary</h3>

            <div class="space-y-4 mb-6">
              <div class="flex items-center justify-between text-sm">
                <span class="text-gray-600 dark:text-gray-400">Subtotal ({{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }} item)</span>
                <span class="font-semibold text-gray-900 dark:text-gray-100">{{ App\Models\Product::convertPrice($totalPrice) }}</span>
              </div>
              <div class="flex items-center justify-between text-sm">
                <span class="text-gray-600 dark:text-gray-400">Shipping</span>
                <span class="font-semibold text-gray-900 dark:text-gray-100">₹6.95</span>
              </div>
              <div class="text-xs text-green-600 dark:text-green-400 bg-green-50 dark:bg-green-900/20 p-2 border border-green-200 dark:border-green-800">
                You are ₹15.00 away from free shipping
              </div>
              <div class="flex items-center justify-between text-sm">
                <span class="text-gray-600 dark:text-gray-400">Estimated tax</span>
                <span class="text-sm text-gray-600 dark:text-gray-400">Calculated at checkout</span>
              </div>
            </div>

            <div class="flex items-center justify-between py-4 border-t border-gray-200 dark:border-gray-700 mb-6">
              <span class="text-lg font-bold text-gray-900 dark:text-gray-100">Estimated total</span>
              <span class="text-lg font-bold text-gray-900 dark:text-gray-100">{{ App\Models\Product::convertPrice($mainTotal) }}</span>
            </div>

            <button class="w-full px-6 py-3 bg-orange-600 text-white text-base font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-colors duration-200 mb-4">Checkout</button>

            <div class="space-y-3">
              <button class="w-full flex items-center justify-between p-3 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-left hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                <div>
                  <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Add a coupon code</p>
                  <p class="text-xs text-gray-600 dark:text-gray-400">(enjoy 1 coupon per order)</p>
                </div>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gray-600 dark:text-gray-400">
                  <line x1="12" y1="5" x2="12" y2="19"></line>
                  <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
              </button>

              <button class="w-full flex items-center justify-between p-3 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-left hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                <div>
                  <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Make this order a gift</p>
                  <p class="text-xs text-gray-600 dark:text-gray-400">(available for eligible ship items only)</p>
                </div>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gray-600 dark:text-gray-400">
                  <line x1="12" y1="5" x2="12" y2="19"></line>
                  <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
              </button>
            </div>
          </div>

          <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6">
            <h4 class="text-base font-semibold text-gray-900 dark:text-gray-100 mb-3">Need help?</h4>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">We are here from 9am - 8pm IST, 7 days a week</p>
            <p class="text-sm text-gray-900 dark:text-gray-100 mb-2">📞 +91 966-705-4665</p>
            <p class="text-sm text-orange-600 dark:text-orange-400 hover:underline cursor-pointer">💬 Chat with a specialist</p>
          </div>
        </div>
      </div>
    </section>
    @else

    <!-- Empty Cart Message -->
    <section class="py-16">
      <div class="text-center">
        <img src="{{ asset('assets/frontend/images/cart1.jpg') }}" alt="Empty Cart" class="w-40 mx-auto mb-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-2">Your cart is empty</h2>
        <p class="text-gray-600 dark:text-gray-400 mb-6">Looks like you haven't added anything to your cart yet.</p>
        <a href="{{ route('front.index') }}" class="inline-block px-6 py-3 bg-orange-600 text-white text-base font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-colors duration-200">Continue Shopping</a>
      </div>
    </section>
    @endif

  </div>
</main>
@endsection

@section('scripts')
<script>
  function showLoader() {
    const loader = document.getElementById('loading-section');
    if (loader) loader.style.display = 'block';
  }

  function hideLoader() {
    const loader = document.getElementById('loading-section');
    if (loader) loader.style.display = 'none';
  }

  document.addEventListener('DOMContentLoaded', function() {
    hideLoader(); // hide on load

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
              'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
          })
          .then(res => res.json())
          .then(data => {
            hideLoader();
            if (data.success) {
              const element = document.querySelector('.' + itemClass);
              if (element) element.remove();

              Toastify({
                text: data.message || "Product removed from your cart",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#f44336"
              }).showToast();

              setTimeout(() => {
                window.location.reload();
              }, 500);
            } else {
              alert('Failed to remove item.');
            }
          })
          .catch(err => {
            hideLoader();
            alert('Something went wrong while removing the item.');
            console.error('Remove error:', err);
          });
      });
    });

    // Update quantity
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    document.querySelectorAll('.quantity-select').forEach(select => {
      select.addEventListener('change', function() {
        const id = this.dataset.id;
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
              qty
            })
          })
          .then(res => res.json())
          .then(data => {
            hideLoader();
            if (data.success) {
              window.location.reload();
            } else {
              alert('Failed to update quantity');
            }
          })
          .catch(err => {
            hideLoader();
            console.error('Error updating quantity:', err);
          });
      });
    });
  });
</script>
@endsection