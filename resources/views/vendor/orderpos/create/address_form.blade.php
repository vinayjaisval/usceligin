@php

 $cartEmpty = !Session::has('cart') && !Session::has('admin_cart');

@endphp

<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- CART EMPTY ALERT --}}
@if($cartEmpty)
  <div class="alert alert-warning">
    Please add items to cart to calculate shipping cost.
  </div>
@endif

{{-- PASS CART FLAG TO JS --}}
<script>
  let CART_EMPTY = {{ $cartEmpty ? 'true' : 'false' }};
</script>

{{-- ================= SESSION ADDRESS ================= --}}
@if (Session::has('order_address'))
@php
$user = Session::get('order_address');
@endphp

<div class="row mt-2">
  <div class="col-md-4">
    <label>Name *</label>
    <input type="text" class="form-control" name="customer_name" value="{{ $user['customer_name'] }}" required>
  </div>
  <div class="col-md-4">
    <label>Email *</label>
    <input type="email" class="form-control" name="customer_email" value="{{ $user['customer_email'] }}" required>
  </div>
  <div class="col-md-4">
    <label>Phone *</label>
    <input type="text" class="form-control" name="customer_phone" value="{{ $user['customer_phone'] }}" required>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <label>Postal Code *</label>
    <input type="text" class="form-control zipcode" id="customer_zip" name="customer_zip"
           value="{{ $user['customer_zip'] }}" required>
    <span id="loader" style="display:none"><i class="fa fa-spinner fa-spin"></i></span>
  </div>

  <div class="col-md-6">
    <label>Country</label>
    <input type="text" class="form-control" id="customer_country" name="customer_country"
           value="{{ $user['customer_country'] }}" readonly required>
  </div>

  <div class="col-md-6">
    <label>City</label>
    <input type="text" class="form-control" id="customer_city" name="customer_city"
           value="{{ $user['customer_city'] }}" readonly required>
  </div>

  <div class="col-md-6">
    <label>State</label>
    <input type="text" class="form-control" id="customer_state" name="customer_state"
           value="{{ $user['customer_state'] }}" readonly required>
  </div>

  <div class="col-md-12">
    <label>Address *</label>
    <textarea class="form-control" name="customer_address" required>{{ $user['customer_address'] }}</textarea>
  </div>

  <input type="hidden" name="shipping_cost" id="shipping_cost" value="0">
</div>

@else

{{-- ================= GUEST USER ================= --}}
<div class="row mt-2">
  <div class="col-md-4">
    <label>Name *</label>
    <input type="text" class="form-control" name="customer_name" required>
  </div>
  <div class="col-md-4">
    <label>Email *</label>
    <input type="email" class="form-control" name="customer_email" required>
  </div>
  <div class="col-md-4">
    <label>Phone *</label>
    <input type="text" class="form-control" name="customer_phone" required>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <label>Postal Code *</label>
    <input type="text" class="form-control zipcode" id="customer_zip" name="customer_zip" required>
    <span id="loader" style="display:none"><i class="fa fa-spinner fa-spin"></i></span>
  </div>

  <div class="col-md-6">
    <label>Country</label>
    <input type="text" class="form-control" id="customer_country" name="customer_country" readonly required>
  </div>

  <div class="col-md-6">
    <label>City</label>
    <input type="text" class="form-control" id="customer_city" name="customer_city" readonly required>
  </div>

  <div class="col-md-6">
    <label>State</label>
    <input type="text" class="form-control" id="customer_state" name="customer_state" readonly required>
  </div>

  <div class="col-md-12">
    <label>Address *</label>
    <textarea class="form-control" name="customer_address" required></textarea>
  </div>

  <input type="hidden" name="shipping_cost" id="shipping_cost" value="0">
</div>
@endif

{{-- ================= SHIPPING JS ================= --}}
<script>
document.addEventListener('DOMContentLoaded', () => {

  const zipInput = document.getElementById('customer_zip');
  const loader = document.getElementById('loader');

  if (!zipInput) return;

  zipInput.addEventListener('input', async () => {

    /* CART EMPTY BLOCK */
    if (CART_EMPTY) {
      alert('❌ Pehle item cart me add karo, phir pincode bharo');
      zipInput.value = '';
      return;
    }

    let zip = zipInput.value.trim();

    if (!/^\d{0,6}$/.test(zip)) {
      zipInput.value = '';
      return;
    }

    if (zip.length !== 6) {
      resetShipping();
      return;
    }

    loader.style.display = 'inline-block';

    try {
      const res = await fetch(`${mainurl}/getPinCodeDetails`, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ zipcode: zip })
      });

      const data = await res.json();
      loader.style.display = 'none';

      if (!data.status) {
        alert(data.message || 'Shipping not available');
        resetShipping();
        return;
      }

      customer_city.value = data.result.city;
      customer_state.value = data.result.state;
      customer_country.value = data.result.country;
      shipping_cost.value = data.result.shipping_cost;

    } catch (e) {
      loader.style.display = 'none';
      alert('Error while calculating shipping');
      resetShipping();
    }
  });

  function resetShipping() {
    customer_city.value = '';
    customer_state.value = '';
    customer_country.value = '';
    shipping_cost.value = 0;
  }
});
</script>
