@extends('frontend.include.app')

@section('content')
@php $referralDiscount = $refferal_discount ?? 0; @endphp
<style>
  .input-field {
    @apply w-full px-3 py-2 border border-gray-300 dark:border-gray-600
           rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100
           focus:ring-2 focus:ring-primary-600 text-sm;
  }
</style>
<!-- Main Content -->
<main id="main-content" role="main" class="bg-gray-50 dark:bg-gray-900 min-h-screen">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <!-- Breadcrumb Navigation -->
    @include('frontend.include.breadcrumb', ['items' => [
      ['label' => 'Home', 'url' => route('front.index')],
      ['label' => 'Cart', 'url' => route('front.cart')],
      ['label' => 'Checkout']
    ]])

    <!-- Page Title -->
    <div class="mb-6">
      <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100">Checkout</h1>
    </div>

    <!-- Checkout Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

      <!-- Left Column: Cart, Addresses, Payment -->
      <div class="lg:col-span-2 space-y-4">

        <!-- Cart Section -->
        <section class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700" id="cart-section">
          <div class="p-4 sm:p-6">
            <div class="flex items-center space-x-3 mb-4">
              <h2 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-gray-100">Cart</h2>
              <span class="text-sm text-gray-600 dark:text-gray-400">
                ({{ $totalQty }} {{ $totalQty === 1 ? 'item' : 'items' }})
              </span>
            </div>

            <!-- Cart Items -->
            <div class="space-y-3">
              @if(!empty($products))
                @foreach ($products as $product)
                <div class="flex gap-3 sm:gap-4 pb-3 border-b border-gray-200 dark:border-gray-700 last:border-0 last:pb-0">
                  <!-- Product Image -->
                  <div class="w-16 h-16 sm:w-20 sm:h-20 flex-shrink-0 bg-gray-100 dark:bg-gray-700 rounded overflow-hidden">
                    <img
                      src="{{ $product['item']['photo'] ? asset('assets/images/products/'.$product['item']['photo']) : asset('assets/images/noimage.png') }}"
                      alt="{{ $product['item']['name'] }}"
                      class="w-full h-full object-cover"
                      loading="lazy" />
                  </div>

                  <!-- Product Details -->
                  <div class="flex-1 min-w-0">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100 line-clamp-2">
                      {{ $product['item']['name'] }}
                    </h3>
                    <div class="flex flex-wrap items-center gap-2 mt-1 text-xs text-gray-600 dark:text-gray-400">
                      @if(!empty($product['size']))
                      <span class="px-2 py-0.5 bg-gray-100 dark:bg-gray-700 rounded">{{ $product['size'] }}</span>
                      @endif
                      @if(!empty($product['color']))
                      <span class="px-2 py-0.5 bg-gray-100 dark:bg-gray-700 rounded">{{ $product['color'] }}</span>
                      @endif
                      <span>Qty: {{ $product['qty'] }}</span>
                    </div>
                    <p class="text-sm font-bold text-gray-900 dark:text-gray-100 mt-1">
                      {{ App\Models\Product::convertPrice($product['price']) }}
                    </p>
                  </div>
                </div>
                @endforeach
              @endif
            </div>

            <a href="{{ route('front.cart') }}" class="inline-flex items-center space-x-1 text-sm text-primary-700 dark:text-primary-400 hover:text-primary-800 dark:hover:text-primary-300 font-medium mt-4 transition-colors">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
              </svg>
              <span>Modify Cart</span>
            </a>
          </div>
        </section>

        @include('frontend.checkout-address-section')

        <!-- Payment Method Section -->
        <section id="payment-section"
          class="relative bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">

          <!-- Lock overlay — shown when address not confirmed -->
          <div id="payment-lock-overlay"
            class="absolute inset-0 z-10 bg-white/80 dark:bg-gray-800/80 backdrop-blur-[2px] flex flex-col items-center justify-center gap-2 cursor-not-allowed">
            <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Confirm your delivery address first</p>
          </div>

          <div class="p-4 sm:p-6">
            <h2 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">
              Choose Payment Mode
            </h2>

            <div class="space-y-3">
              @if($codGateway)
                <!-- Cash on Delivery -->
                <label for="payment_cod"
                  class="flex items-start gap-4 p-4 border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 cursor-pointer hover:border-primary-600 dark:hover:border-primary-400 transition-all has-[:checked]:border-primary-600 has-[:checked]:bg-primary-100 dark:has-[:checked]:bg-primary-900/10">

                  <input type="radio"
                    name="payment_method"
                    data-form="{{ $codGateway->showCheckoutLink() }}"
                    value="{{ $codGateway->id }}"
                    id="payment_cod"
                    class="mt-1 w-4 h-4 text-primary-700 border-gray-300 focus:ring-primary-600"
                    checked />

                  <div class="flex-1">
                    <div class="flex items-center gap-2">
                      <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                      </svg>
                      <span class="font-semibold text-gray-900 dark:text-gray-100">Cash on Delivery</span>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                      Pay with Cash or UPI when your order is delivered
                    </p>
                  </div>
                </label>
              @endif

              @if($razorpayGateway)
                <!-- Razorpay -->
                <label for="payment_razorpay"
                  class="flex items-start gap-4 p-4 border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 cursor-pointer hover:border-primary-600 dark:hover:border-primary-400 transition-all has-[:checked]:border-primary-600 has-[:checked]:bg-primary-100 dark:has-[:checked]:bg-primary-900/10">

                  <input type="radio"
                    name="payment_method"
                    data-form="{{ $razorpayGateway->showCheckoutLink() }}"
                    value="{{ $razorpayGateway->id }}"
                    id="payment_razorpay"
                    class="mt-1 w-4 h-4 text-primary-700 border-gray-300 focus:ring-primary-600" />

                  <div class="flex-1">
                    <div class="flex items-center gap-2">
                      <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                      </svg>
                      <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $razorpayGateway->title ?? 'Razorpay' }}</span>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                      Pay securely using Card, UPI, Net Banking or Wallet
                    </p>
                  </div>
                </label>
              @endif

              @if(!$codGateway && !$razorpayGateway)
                <p class="text-sm text-gray-600 dark:text-gray-400 p-4 text-center">
                  No payment methods available
                </p>
              @endif
            </div>
          </div>
        </section>
      </div>

      <!-- Right Column: Order Summary -->
      <div class="lg:col-span-1">
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-4 sm:p-6 lg:sticky lg:top-6">

          <!-- Promo Code Collapsible -->
          <div class="border border-gray-300 dark:border-gray-600 mb-4">
            <button
              type="button"
              onclick="togglePromoCode()"
              class="w-full flex items-center justify-between p-3 text-left">
              <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-primary-700 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
                <span class="text-sm font-medium text-gray-900 dark:text-gray-100">Apply Promo Code</span>
              </div>
              <svg
                id="promo-chevron"
                class="w-5 h-5 text-gray-600 dark:text-gray-400 transform transition-transform"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>

            <div id="promo-content" class="hidden p-3 border-t border-gray-300 dark:border-gray-600">
              <form onsubmit="return applyCoupon();" class="flex gap-2">
                <input
                  type="text"
                  id="coupon_code"
                  placeholder="Enter code"
                  class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-sm text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-primary-600"
                  aria-label="Promo code" />
                <button
                  type="submit"
                  class="px-4 py-2 bg-primary-600 text-white text-sm font-semibold hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-600 transition-colors">
                  Apply
                </button>
              </form>
            </div>
          </div>

          <!-- Order Summary -->
          <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">Order Summary</h3>

          <div class="space-y-3 text-sm">
              
              <!-- Subtotal -->
              <div class="flex justify-between">
                  <span class="text-gray-600 dark:text-gray-400">
                      Subtotal MRP ({{ $totalQty }} {{ $totalQty === 1 ? 'item' : 'items' }})
                  </span>
                  <span class="font-semibold text-gray-900 dark:text-gray-100" id="subtotal-mrp">
                      {{ App\Models\Product::convertPrice($subtotalMRP) }}
                  </span>
              </div>

              <!-- Discount -->
              @if($discountMRP > 0 || $referralDiscount > 0)
              <div class="flex justify-between text-green-600 dark:text-green-400">
                  <span>Promo</span>
                  <span class="font-semibold" id="mrp-discount">
                      -{{ App\Models\Product::convertPrice($referralDiscount) }}
                  </span>
              </div>
              @endif

              <!-- Coupon -->
              <div id="applied-coupon-display" class="hidden flex justify-between items-center text-green-600 dark:text-green-400">
                  <span>Coupon Discount</span>
                  <div class="flex items-center space-x-2">
                      <span class="font-semibold" id="coupon-discount-amount">-₹0</span>
                      <button type="button" onclick="removeCoupon()" class="text-red-600 hover:text-red-700">
                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"/>
                          </svg>
                      </button>
                  </div>
              </div>
            <!-- @if($orderCount == 0 && $user && $user->reffered_by)
              <div class="flex justify-between " id="applied-refferal-display">
                <span class="text-gray-600 dark:text-gray-400">Refferal Discount</span>
                <span class="font-semibold text-gray-900 dark:text-gray-100" id="shipping-amount">
                  {{ App\Models\Product::convertPrice($refferal_discount ?? 0) }}
                </span>
              </div>
              @endif -->
              <!-- Shipping -->
              <div class="flex justify-between">
                  <span class="text-gray-600 dark:text-gray-400">Shipping</span>
                  <span class="font-semibold text-gray-900 dark:text-gray-100" id="shipping-amount">
                      {{ $shippingCost == 0 ? 'FREE' : App\Models\Product::convertPrice($shippingCost) }}
                  </span>
              </div>

              <!-- Taxes -->
              <div class="flex justify-between">
                  <span class="text-gray-600 dark:text-gray-400">Estimated Taxes (GST 18%)</span>
                  <span class="font-semibold text-gray-900 dark:text-gray-100" id="tax-amount">
                      {{ App\Models\Product::convertPrice($taxAmount) }}
                  </span>
              </div>
              @if($points > 0)
               <div class="flex justify-between items-center mt-3">
                  <label class="text-gray-600 dark:text-gray-400">
                      Use Celigin Points (Available: {{ $points }})
                  </label>

                  <input type="number"
                        id="points-input"
                        min="0"
                        max="{{ $points }}"
                        value="0"
                        class="w-24 border rounded px-2 py-1 text-right"
                  />
              </div>
              @endif


          </div>

            <!-- Total -->
            <div class="flex justify-between items-center py-4 border-t border-gray-200 dark:border-gray-700 mt-4">
                <span class="text-lg font-bold text-gray-900 dark:text-gray-100">Total</span>
                <span class="text-lg font-bold text-gray-900 dark:text-gray-100" id="final-total">
                    {{ App\Models\Product::convertPrice($finalTotal) }}
                </span>
            </div>

         

          <!-- Place Order Button -->
          <button
            id="place-order-btn"
            type="button"
            onclick="placeOrder()"
            disabled
            class="w-full px-6 py-3 bg-primary-600 text-white text-base font-semibold hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed disabled:pointer-events-none">
            Place your order
          </button>

          <!-- Terms -->
          <p class="text-xs text-gray-600 dark:text-gray-400 text-center mt-4">
            By ordering, you accept our
            <a href="{{ route('terms') }}" class="text-primary-700 dark:text-primary-400 hover:underline">terms</a>
            and
            <a href="{{ route('privacy') }}" class="text-primary-700 dark:text-primary-400 hover:underline">privacy policy</a>
          </p>
        </div>
      </div>
          <form id="checkoutForm" method="POST">
          @csrf

          <input type="hidden" name="selected_payment_method" id="selected_payment_method">
          <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
          <input type="hidden" name="total" id="total_hidden" value="{{ $finalTotal }}">

          <input type="hidden" name="subtotalMRP" id="subtotalMRP" value="{{ $subtotalMRP }}">
        
          <input type="hidden" name="shippingCost" id="shippingCost" value="{{ $shippingCost }}">

          <input type="hidden" name="taxAmount" id="taxAmount" value="{{ $taxAmount }}">

        <input type="hidden" id="points-used" name="points_used" value="0">

          <input type="hidden" name="coupon_code" id="hidden_coupon_code" value="">
          <input type="hidden" name="coupon_discount" id="hidden_coupon_discount" value="">

          @if($orderCount == 0 && $user && $user->reffered_by)
          <input type="hidden" id="refferal_discount" name="refferal_discount" value="{{ $refferal_discount ?? '0' }}">
          @endif


      </form>

    </div>
  </div>
</main>

<!-- Address Management Script -->
@include('frontend.checkout-address-script')

@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
  // If the browser restores this page from bfcache (user pressed Back after
  // a successful order), force a fresh request so the server can redirect
  // away when the cart is empty.
  window.addEventListener('pageshow', function(event) {
    if (event.persisted) {
      window.location.reload();
    }
  });

  const csrfToken     = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  const currencySign  = '{{ $gs->currency_sign ?? "₹" }}';
  const hasAddresses  = {{ (isset($addresses) && $addresses->count() > 0) ? 'true' : 'false' }};
  let selectedAddressId = {{ isset($defaultAddress) && $defaultAddress ? $defaultAddress->id : (isset($addresses) && $addresses->count() > 0 ? $addresses->first()->id : 'null') }};

  // ── Checkout progressive unlock state machine ────────────────────────────
  const checkoutState = {
    addressConfirmed: selectedAddressId !== null,
    paymentChosen: false, // resolved on DOMContentLoaded after radios are in DOM
  };

  function updateCheckoutState() {
    const lockOverlay   = document.getElementById('payment-lock-overlay');
    const placeOrderBtn = document.getElementById('place-order-btn');

    if (checkoutState.addressConfirmed) {
      lockOverlay.classList.add('hidden');
    } else {
      lockOverlay.classList.remove('hidden');
    }

    const canOrder = checkoutState.addressConfirmed && checkoutState.paymentChosen;
    placeOrderBtn.disabled = !canOrder;
  }
  // ── End state machine ────────────────────────────────────────────────────

  // Show address selection view
  function showAddressSelection() {
    document.getElementById('address-summary-view').classList.add('hidden');
    document.getElementById('address-selection-view').classList.remove('hidden');
    // Lock payment while user is editing the address
    checkoutState.addressConfirmed = false;
    updateCheckoutState();
  }

  // Cancel address selection (go back to summary)
  function cancelAddressSelection() {
    document.getElementById('address-selection-view').classList.add('hidden');
    document.getElementById('address-summary-view').classList.remove('hidden');

    // Hide add new form if open
    const newAddressForm = document.getElementById('new-address-form-container');
    if (newAddressForm) {
      newAddressForm.classList.add('hidden');
    }

    // Restore payment unlock if an address is still selected
    if (selectedAddressId) {
      checkoutState.addressConfirmed = true;
      updateCheckoutState();
    }
  }

  // Confirm address selection and go back to summary
  function confirmAddressSelection() {
    if (!selectedAddressId) {
      showToast('Please select an address', 'error');
      return;
    }

    showToast('Address selected successfully', 'success');
    setTimeout(() => {
      window.location.reload();
    }, 500);
  }

  // Show add new address form
  function showAddNewAddressForm() {
    const container = document.getElementById('new-address-form-container');
    const addBtn = document.getElementById('add-new-address-btn');

    if (container) {
      container.classList.remove('hidden');
      if (addBtn) addBtn.classList.add('hidden');
      document.getElementById('newAddressForm_name').focus();
    }
  }

  // Cancel address form
  function cancelAddressForm() {
    const container = document.getElementById('new-address-form-container');
    const addBtn = document.getElementById('add-new-address-btn');

    if (container) {
      container.classList.add('hidden');
      if (addBtn) addBtn.classList.remove('hidden');
      document.getElementById('newAddressForm').reset();
    }
  }

  // Select address (from radio button)
  function selectAddress(addressId) {
    selectedAddressId = addressId;
    console.log('Selected address ID:', addressId);
  }

  // Select address card (from card click)
  function selectAddressCard(addressId) {
    selectedAddressId = addressId;

    // Update radio button
    const radio = document.querySelector(`input[name="selected_address"][value="${addressId}"]`);
    if (radio) radio.checked = true;

    // Update card styling
    document.querySelectorAll('[onclick*="selectAddressCard"]').forEach(card => {
      card.classList.remove('ring-2', 'ring-primary-600', 'dark:ring-primary-400', 'bg-primary-100', 'dark:bg-primary-900/10');
    });

    event.currentTarget.classList.add('ring-2', 'ring-primary-600', 'dark:ring-primary-400', 'bg-primary-100', 'dark:bg-primary-900/10');

    console.log('Selected address ID:', addressId);
  }

  // Handle form submissions for new address (first-time or add new)
  document.addEventListener('DOMContentLoaded', function() {
    // First-time address form
    const firstAddressForm = document.getElementById('firstAddressForm');
    if (firstAddressForm) {
      firstAddressForm.addEventListener('submit', function(e) {
        e.preventDefault();
        // saveNewAddress(this);
      });
    }

    // New address form (for existing users adding more)
    const newAddressForm = document.getElementById('newAddressForm');
    if (newAddressForm) {
      newAddressForm.addEventListener('submit', function(e) {
        e.preventDefault();
        // saveNewAddress(this);
      });
    }

    // Resolve initial paymentChosen from whichever radio is pre-checked (e.g. COD)
    checkoutState.paymentChosen = document.querySelector('input[name="payment_method"]:checked') !== null;

    // Listen for payment method changes
    document.querySelectorAll('input[name="payment_method"]').forEach(function(radio) {
      radio.addEventListener('change', function() {
        checkoutState.paymentChosen = true;
        updateCheckoutState();
      });
    });

    // Apply initial state
    updateCheckoutState();
  });

  // Save new address via AJAX
  // function saveNewAddress(form) {
  //   const formData = new FormData(form);

  //   // Show loading state
  //   const submitBtn = form.querySelector('button[type="submit"]');
  //   const originalText = submitBtn.textContent;
  //   submitBtn.disabled = true;
  //   submitBtn.textContent = 'Saving...';

  //   fetch('{{ route("user.addresses.store") }}', {
  //     method: 'POST',
  //     headers: {
  //       'X-CSRF-TOKEN': csrfToken,
  //       'Accept': 'application/json'
  //     },
  //     body: formData
  //   })
  //   .then(response => response.json())
  //   .then(data => {
  //     submitBtn.disabled = false;
  //     submitBtn.textContent = originalText;
  //     console.log(data);
  //     if (data.success || data.message) {
  //       showToast(data.message || 'Address saved successfully', 'success');

  //       // Reload page to show new address
  //       setTimeout(() => {
  //         window.location.reload();
  //       }, 1000);
  //     } else {
  //       showToast(data.error || 'Failed to save address', 'error');
  //     }
  //   })
  //   .catch(error => {
  //     submitBtn.disabled = false;
  //     submitBtn.textContent = originalText;
  //     console.error('Error:', error);
  //     showToast('An error occurred while saving the address', 'error');
  //   });
  // }

  // Toggle billing address form
  function toggleBillingAddress() {
    const checkbox = document.getElementById('same_as_delivery');
    const billingContainer = document.getElementById('billing-address-container');

    if (checkbox && billingContainer) {
      if (checkbox.checked) {
        billingContainer.classList.add('hidden');
      } else {
        billingContainer.classList.remove('hidden');
      }
    }
  }

  // Fetch pincode details (for address forms)
  function fetchPincodeDetails(formId) {
    const pincodeInput = document.getElementById(`${formId}_pincode`);
    if (!pincodeInput) return;

    const pincode = pincodeInput.value.trim();

    if (pincode.length !== 6 || !/^\d{6}$/.test(pincode)) {
      document.getElementById(`${formId}_city`).value = '';
      document.getElementById(`${formId}_state`).value = '';
      return;
    }

    // Set loading state
    document.getElementById(`${formId}_city`).value = 'Loading...';
    document.getElementById(`${formId}_state`).value = 'Loading...';

    fetch(`https://api.postalpincode.in/pincode/${pincode}`)
      .then(response => response.json())
      .then(data => {
        if (data[0].Status === 'Success') {
          const post = data[0].PostOffice[0];
          document.getElementById(`${formId}_city`).value = post.District;
          document.getElementById(`${formId}_state`).value = post.State;
          document.getElementById(`${formId}_country`).value = post.Country;
        } else {
          document.getElementById(`${formId}_city`).value = '';
          document.getElementById(`${formId}_state`).value = '';
          showToast('Invalid pincode', 'error');
        }
      })
      .catch(error => {
        console.error('Error fetching pincode details:', error);
        document.getElementById(`${formId}_city`).value = '';
        document.getElementById(`${formId}_state`).value = '';
        showToast('Could not fetch location details', 'error');
      });
  }

  // Listen for ZIP code changes — recalculate totals when pincode is filled
  document.addEventListener('DOMContentLoaded', function() {
    const zipInput = document.getElementById('zip_code');
    if (zipInput) {
      zipInput.addEventListener('blur', function() {
        updateTotal(0);
      });
    }
  });

  // Toggle promo code section
  function togglePromoCode() {
    const content = document.getElementById('promo-content');
    const chevron = document.getElementById('promo-chevron');

    content.classList.toggle('hidden');
    chevron.classList.toggle('rotate-180');
  }


  // Apply coupon
  function applyCoupon() {
    const couponCode = document.getElementById('coupon_code').value.trim();


    if (!couponCode) {
      showToast('Please enter a coupon code', 'error');
      return false;
    }

    const submitBtn = event.target.querySelector('button[type="submit"]');
    const originalText = submitBtn.textContent;
    submitBtn.disabled = true;
    submitBtn.textContent = 'Applying...';

    const totalPrice = parseFloat('{{ $totalPrice }}');

    fetch(`/celigin/carts/coupon/check?code=${encodeURIComponent(couponCode)}&total=${totalPrice}`, {
      method: 'GET',
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': csrfToken
      }
    })
    .then(res => res.json())
    .then(data => {
      submitBtn.disabled = false;
      submitBtn.textContent = originalText;

      if (Array.isArray(data) && data[5] === 1) {
        const discount = data[2];

        // Update UI
        document.getElementById('applied-coupon-display').classList.remove('hidden');
        document.getElementById('coupon-discount-amount').textContent = '-' + currencySign + discount;

        // Clear input field
        document.getElementById('hidden_coupon_code').value = couponCode;
        document.getElementById('hidden_coupon_discount').value = discount;


        // Recalculate total
        updateTotal(discount);

        showToast('Coupon applied successfully!', 'success');

        // Close promo section
        togglePromoCode();
      } else if (data === 0) {
       
        showToast('Invalid or expired coupon code', 'error');
      } else if (data === 2) {
        showToast('Coupon already applied', 'info');
      } else if (data === 3) {
        showToast('Minimum order value not met', 'error');
      } else if (data === 8) {
        showToast('You have already used this coupon', 'error');
      } else {
        showToast('Unable to apply coupon', 'error');
      }
    })
    .catch(err => {
      submitBtn.disabled = false;
      submitBtn.textContent = originalText;
      showToast('Error applying coupon', 'error');
      console.error('Coupon error:', err);
    });
    return false;
  }

  // Remove coupon
  function removeCoupon() {
    document.getElementById('applied-coupon-display').classList.add('hidden');
    document.getElementById('coupon_code').value = '';
    updateTotal(0);
    showToast('Coupon removed', 'info');
  }

  // Update total
  function updateTotal(couponDiscount = 0) {
    const subtotal = parseFloat('{{ $subtotalMRP }}');
    const existingDiscount = parseFloat('{{ $discountMRP + $referralDiscount }}');
   
    const shipping = parseFloat('{{ $shippingCost }}');    
    const taxRate = 0.18; // 18% GST
    // Calculate tax on taxable amount (after all discounts)
    const taxableAmount = subtotal ;
    const taxAmount = taxableAmount * taxRate;
    // Update tax display
    const taxElement = document.getElementById('tax-amount');
    if (taxElement) {
      taxElement.textContent = currencySign + taxAmount.toFixed(2);
    }

    // Calculate final total
    const newTotal = taxableAmount - existingDiscount - couponDiscount + shipping + taxAmount;

    document.getElementById('final-total').textContent = currencySign + newTotal.toFixed(2);
    document.getElementById('total_hidden').value = newTotal;
  }

  // Place order
  function placeOrder() {
      const btn = document.getElementById('place-order-btn');

      // Guard: prevent double-submission
      if (btn.disabled) return;
      btn.disabled = true;
      btn.textContent = 'Placing order…';

      // 🔹 1. Payment method validate
      const paymentMethod = document.querySelector('input[name="payment_method"]:checked');
      if (!paymentMethod) {
          showToast('Please select a payment method', 'error');
          btn.disabled = false;
          btn.textContent = 'Place your order';
          return;
      }

      showToast('Processing order...', 'info');
      // 🔹 3. Get selected gateway details
      const gatewayId   = paymentMethod.value;
      const checkoutUrl = paymentMethod.dataset.form; // 👈 VERY IMPORTANT
      const shippingSpan = document.getElementById('shipping-amount');
      let text = shippingSpan.innerText.trim();
      let shippingCost = text.replace(/[^0-9.]/g, '');
      const discountMRP = document.getElementById('discountMRP');
      let discountText = shippingSpan.innerText.trim();
      let discountCoupen = discountText.replace(/[^0-9.]/g, '');
      // 🔹 4. Set hidden inputs
      document.getElementById('selected_payment_method').value = gatewayId;
      document.getElementById('shippingCost').value = shippingCost;


     
      // =============================
      // 🔹 COD FLOW (DIRECT SUBMIT)
      // =============================

      if (checkoutUrl.includes('cod')) {      
          document.getElementById('checkoutForm').action = checkoutUrl;
          document.getElementById('checkoutForm').submit();
          return;
      }

      // =============================
      // 🔹 ONLINE PAYMENT FLOW
      // =============================

      if (checkoutUrl.includes('razorpay')) {                
          document.getElementById('checkoutForm').action = checkoutUrl;
          document.getElementById('checkoutForm').submit();
          return;
      }

      // =============================
      // 🔹 OTHER GATEWAYS
      // =============================
      document.getElementById('checkoutForm').action = checkoutUrl;
      document.getElementById('checkoutForm').submit();
  }
  // Show toast notification
  function showToast(message, type = 'success') {
    const backgroundColor = type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : '#f59e0b';

    if (typeof Toastify !== 'undefined') {
      Toastify({
        text: message,
        duration: 3000,
        close: true,
        gravity: "top",
        position: "right",
        backgroundColor: backgroundColor
      }).showToast();
    } else {
      alert(message);
    }
  }
</script>
<script>
$(document).ready(function () {

    let fetchedPin = '';

    // MAIN URL FOR AJAX
    var mainurl = "{{ url('/') }}";
  fetchShippingCharge(null);
    // ----------------------------------------------------------
    // 🔹 ON PAGE LOAD → CHECK IF ZIP STORED IN LOCAL STORAGE
    // ----------------------------------------------------------
   
    // ----------------------------------------------------------
    // 🔹 WHEN USER TYPES PIN → SAVE TO LOCAL STORAGE
    // ----------------------------------------------------------
    $('#zip_code').on('keyup', function () {
        let pincode = $(this).val().trim();

        // Save pin live (even if incomplete)
        localStorage.setItem("zip_code", pincode);

        if (pincode.length === 6 && /^\d{6}$/.test(pincode) && pincode !== fetchedPin) {
            fetchedPin = pincode;
            autoFillAddress(pincode);
        } else if (pincode.length < 6) {
            $('#city, #state, #country').val('');
        }
    });

    // ----------------------------------------------------------
    // 🔹 FUNCTION: AUTO-FILL CITY / STATE / COUNTRY
    // ----------------------------------------------------------
    function autoFillAddress(pincode) {

        $('#city').val('Loading...');
        $('#state').val('Loading...');
        $('#country').val('Loading...');

        $.ajax({
            url: "https://api.postalpincode.in/pincode/" + pincode,
            type: "GET",
            success: function (response) {
                if (response[0].Status === "Success") {
                    let post = response[0].PostOffice[0];

                    $('#city').val(post.District);
                    $('#state').val(post.State);
                    $('#country').val(post.Country);

                    // After valid PIN → fetch shipping
                    fetchShippingCharge(pincode);
                }
                else {
                    $('#city, #state, #country').val('');
                    alert("Invalid PIN code.");
                }
            },
            error: function () {
                $('#city, #state, #country').val('');
                alert("Could not fetch data. Try again.");
            }
        });
    }

    // ----------------------------------------------------------
    // 🔹 FETCH SHIPPING COST
    // ----------------------------------------------------------
  

    function fetchShippingCharge(zip = null) {
     $.ajax({
        headers: { 
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
        },
        url: mainurl + "/getPinCodeDetails",
        type: "POST",
        data: { zipcode: zip }, // null bhi ja sakta hai

        success: function (response) {
            if (response.status) {
                const shippingCost = parseFloat(response.result.shipping_cost || 0);
                updateShipping(shippingCost);
            } else {
                updateShipping(0);
            }
        },
        error: function (err) {
            console.error("Shipping cost fetch error:", err);
        }
        });
    }


    // ----------------------------------------------------------
    // 🔹 UPDATE SHIPPING + TOTAL
    // ----------------------------------------------------------
    function updateShipping(shippingCost) {
        if (shippingCost == 0) {
            $('#shipping-amount').html("FREE").removeClass("text-gray-900").addClass("text-green-600");
        } else {
            $('#shipping-amount').html("₹" + shippingCost.toFixed(2)).removeClass("text-green-600").addClass("text-gray-900");
        }
        let subtotal = parseCurrency($("#subtotal-mrp").text());       
        let mrpDiscount = parseCurrency($("#mrp-discount").text());
        let couponDiscount = parseCurrency($("#coupon-discount-amount").text());
        let taxAmount = parseCurrency($("#tax-amount").text());
        
        let finalTotal = subtotal - mrpDiscount - couponDiscount + shippingCost + taxAmount;
      
        $("#final-total").html("₹" + finalTotal.toFixed(2));
    }

    // Helper
    function parseCurrency(val) {
        if (!val) return 0;
        return parseFloat(val.replace(/[₹,]/g, "")) || 0;
    }

});
</script>

<script>
function initiateRazorpay(checkoutUrl) {

    const totalAmount = document.getElementById('total_hidden').value;

    const options = {
        key: "{{ env('RAZORPAY_KEY') }}", // 🔥 DIRECT FROM .env
        amount: totalAmount * 100,
        currency: "INR",
        name: "{{ config('app.name') }}",
        description: "Order Payment",

        handler: function (response) {
            document.getElementById('razorpay_payment_id').value =
                response.razorpay_payment_id;

            const form = document.getElementById('checkoutForm');
            form.action = checkoutUrl;
            form.method = "POST";
            form.submit();
        },

        prefill: {
            name: "{{ Auth::user()->name ?? '' }}",
            email: "{{ Auth::user()->email ?? '' }}",
            contact: "{{ Auth::user()->phone ?? '' }}"
        },

        theme: {
            color: "#f97316"
        }
    };

    const rzp = new Razorpay(options);
    rzp.open();
}
</script>

<script>
    const maxPointsAllowed = {{ $points }};
    const availablePoints = {{ $points }};
    const originalTotal = {{ $finalTotal }};
    const pointsInput = document.getElementById('points-input');
    const finalTotalEl = document.getElementById('final-total');
    const pointsUsedInput = document.getElementById('points-used');
    pointsInput.addEventListener('input', function () {
        let usedPoints = parseInt(this.value) || 0;
        // Validation
        if (usedPoints > maxPointsAllowed) {
            usedPoints = maxPointsAllowed;
            this.value = maxPointsAllowed;
        }
        if (usedPoints > availablePoints) {
            usedPoints = availablePoints;
            this.value = availablePoints;
        }
        // Final total calculation
        let finalTotal = originalTotal - usedPoints;
        if (finalTotal < 0) finalTotal = 0;
        // Update UI
        finalTotalEl.innerText = '₹' + finalTotal.toLocaleString('en-IN');
        pointsUsedInput.value = usedPoints;
    });
</script>
@endsection
