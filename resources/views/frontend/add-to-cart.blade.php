@extends('frontend.include.app')

@section('content')
<!-- Main Content -->
<main id="main-content" role="main">
  <div class="container">
    <!-- Breadcrumb Navigation -->
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <ol class="breadcrumb-list">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add to Cart</li>
      </ol>
    </nav>

    <!-- Loading Spinner -->
    <div class="loading-section" id="loading-section" style="display: none;">
      <div class="loading-spinner"></div>
      <p>Loading add to cart...</p>
    </div>

    @if(Session::has('cart'))
    <!-- Shopping Cart Section -->
    <section class="cart-section" role="main">
      <div class="cart-layout">

        <!-- Cart Items Section -->
        <div class="cart-items">

          <!-- Rewards Section -->
          <div class="rewards-banner">
            <div class="rewards-content">
              <div class="rewards-header">
                <svg
                  class="rewards-icon"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2">
                  <circle cx="12" cy="12" r="3"></circle>
                  <path d="M12 1v6m0 6v6"></path>
                  <path
                    d="m3.05 6.05 4.95 4.95m0 2v0m4.95 4.95L7.05 17.95"></path>
                </svg>
                <h2>Don't miss out on rewards!®</h2>
                <button
                  class="rewards-toggle"
                  aria-label="Toggle rewards details">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                  </svg>
                </button>
              </div>
              <div class="rewards-details">
                <div>
                  <p>
                    Get <strong>20+ points today</strong> with your purchase.
                    <button
                      class="info-btn"
                      aria-label="More information about rewards">
                      <svg
                        width="16"
                        height="16"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="16" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                      </svg>
                    </button>
                  </p>
                  <p class="rewards-subtitle">
                    The more you earn, the better the payoff.
                  </p>
                </div>
                <div class="rewards-tiers">
                  <div class="reward-tier">
                    <span class="points">100 PTS</span>
                    <span class="discount">₹3 off</span>
                  </div>
                  <div class="reward-tier">
                    <span class="points">500 PTS</span>
                    <span class="discount">₹17.50 off</span>
                  </div>
                  <div class="reward-tier">
                    <span class="points">1000 PTS</span>
                    <span class="discount">₹50 off</span>
                  </div>
                </div>

              </div>
              <div>
                <a href="#" class="join-btn">Join or sign in</a>
              </div>
            </div>
          </div>

          <!-- Free Delivery Banner -->
          <div class="delivery-banner">
            <svg
              class="delivery-icon"
              width="20"
              height="20"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2">
              <rect x="1" y="3" width="15" height="13"></rect>
              <polygon points="16,8 20,8 23,11 23,16 16,16 16,8"></polygon>
              <circle cx="5.5" cy="18.5" r="2.5"></circle>
              <circle cx="18.5" cy="18.5" r="2.5"></circle>
            </svg>
            <span><strong>Free same day delivery over ₹35</strong> Now through
              September 18.</span>
          </div>

          <div class="cart-header">
            <h2>Bag</h2>
            <span class="item-count">{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }} items</span>
          </div>

          <!-- Shipping Section -->
          <div class="shipping-section">
            <div class="shipping-header">
              <!-- Icon and shipping info -->
              <svg class="shipping-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="1" y="3" width="15" height="13"></rect>
                <polygon points="16,8 20,8 23,11 23,16 16,16 16,8"></polygon>
                <circle cx="5.5" cy="18.5" r="2.5"></circle>
                <circle cx="18.5" cy="18.5" r="2.5"></circle>
              </svg>
              <div class="shipping-info">
                <h3>Ship</h3>
                <p>You've earned <strong>FREE shipping</strong></p>
                <span class="item-count">{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }} items</span>
              </div>
              <a href="#" class="edit-btn">Edit all</a>
            </div>

            <!-- Cart Items -->
            @foreach ($products as $product)
            <div class="cart-item cremove{{ $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'), '', $product['values']) }}">
              <section>
                <div class="item-image">
                  <img src="{{ $product['item']['photo'] ? asset('assets/images/products/'.$product['item']['photo']) : asset('assets/images/noimage.png') }}"
                    alt="{{ $product['item']['name'] }}" width="80" height="80" />
                </div>
                <div class="item-info">
                  <h5 class="product-name">
                    {{ mb_strlen($product['item']['name'], 'UTF-8') > 35 ? mb_substr($product['item']['name'], 0, 35, 'UTF-8').'...' : $product['item']['name'] }}
                  </h5>
                  <div class="replenish-save">
                    <svg class="refresh-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <polyline points="23,4 23,10 17,10"></polyline>
                      <polyline points="1,20 1,14 7,14"></polyline>
                      <path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path>
                    </svg>
                    <span>Replenish and save</span>
                    <a href="#" class="add-btn">Add</a>
                  </div>
                </div>
              </section>

              <div class="item-details">
                <div class="item-controls">
                  <div class="quantity-price">
                    <select class="quantity-select" data-id="{{ $product['item']['id'] }}">
                      @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}" {{ $product['qty'] == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                    <span class="price">{{ App\Models\Product::convertPrice($product['price']) }}</span>
                  </div>

                  <!-- Delivery Options -->
                  <div class="delivery-options">
                    <a href="#" class="delivery-option active" aria-label="Ship delivery option">
                      <svg
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2">
                        <rect x="1" y="3" width="15" height="13"></rect>
                        <polygon points="16,8 20,8 23,11 23,16 16,16 16,8"></polygon>
                        <circle cx="5.5" cy="18.5" r="2.5"></circle>
                        <circle cx="18.5" cy="18.5" r="2.5"></circle>
                      </svg>
                      <span>Ship</span>
                    </a>
                    <a href="#" class="delivery-option" aria-label="Pickup delivery option">
                      <svg
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9,22 9,12 15,12 15,22"></polyline>
                      </svg>
                      <span>Pick up</span>
                    </a>
                    <a href="#" class="delivery-option" aria-label="Same day delivery option">
                      <svg
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12,6 12,12 16,14"></polyline>
                      </svg>
                      <span>Same day</span>
                    </a>
                  </div>

                 

                  <div class="item-actions">
                    <a href="javascript:void(0);"
                      class="remove cart-remove remove-btn"
                      data-class="cremove{{ $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'), '', $product['values']) }}"
                      data-href="{{ route('product.cart.remove', $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'), '', $product['values'])) }}">

                      <!-- <button class="remove-btn" aria-label="Remove item"> -->
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                          stroke-width="2">
                          <polyline points="3,6 5,6 21,6"></polyline>
                          <path
                            d="m19,6v14a2,2 0 0,1 -2,2H7a2,2 0 0,1 -2,-2V6m3,0V4a2,2 0 0,1 2,-2h4a2,2 0 0,1 2,2v2">
                          </path>
                        </svg>
                        Remove
                    </a>
                    <button class="save-later-btn" aria-label="Save for later">
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                      </svg>
                      Save for Later
                      </a>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>

          <!-- Saved for Later Section -->
          <div class="saved-later-section">
            <h3>Saved for later</h3>
            <p>Sign in to see your saved items.</p>
            <a href="#" class="sign-in-btn">Sign in</a>
          </div>
        </div>

        <!-- Order Summary Sidebar -->
        <div class="order-summary">
          <div class="summary-card">
            <h3>Order summary</h3>
            <div class="summary-line">
              <span>Subtotal ({{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }} item)</span>
              <span>{{ App\Models\Product::convertPrice($totalPrice) }}</span>
            </div>
            <div class="summary-line"><span>Shipping</span><span>₹6.95</span></div>
            <div class="shipping-note"><span>You are ₹15.00 away from free shipping</span></div>
            <div class="summary-line"><span>Estimated tax</span><span>Calculated at checkout</span></div>
            <div class="summary-total"><span>Estimated total</span><span>{{ App\Models\Product::convertPrice($mainTotal) }}</span></div>
            <button class="checkout-btn primary">Checkout</button>

            <div class="promo-section">
                <button class="promo-toggle">
                  <div>
                    <p>Add a coupon code</p>
                    <p class="promo-note">(enjoy 1 coupon per order)</p>
                  </div>
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                  </svg>
                </button>
              </div>
              <div class="gift-section">
                <button class="gift-toggle">
                  <div>
                    <p>Make this order a gift</p>
                    <p class="gift-note">
                      (available for eligible ship items only)
                    </p>
                  </div>
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                  </svg>
                </button>
              </div>
          </div>
          <div class="help-section">
            <h4>Need help?</h4>
            <p>We are here from 9am - 8pm IST, 7 days a week</p>
            <p class="phone-number">📞 +91 966-705-4665</p>
            <p class="chat-link">💬 Chat with a specialist</p>
          </div>
        </div>
      </div>
    </section>
    @else

    <!-- 🧺 Empty Cart Message -->
    <section class="empty-cart-section">
      <div class="empty-cart-content" style="text-align: center; padding: 60px 20px;">
        <img src="{{ asset('assets/frontend/images/cart1.jpg') }}" alt="Empty Cart" style="width: 150px; margin-bottom: 20px;">

        <h2>Your cart is empty</h2>
        <p>Looks like you haven’t added anything to your cart yet.</p>
        <a href="{{ route('front.index') }}" class="btn btn-primary" style="margin-top: 20px;">Continue Shopping</a>
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

        fetch('/celiginus/addnumcart', {
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