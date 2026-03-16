@php
  $cartEmpty = !Session::has('cart') && !Session::has('admin_cart');
  $sessionAddr = Session::has('order_address') ? Session::get('order_address') : null;
@endphp

<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
window.CART_EMPTY = {{ $cartEmpty ? 'true' : 'false' }};
</script>
{{-- Cart empty notice --}}
@if($cartEmpty)
<div class="flex items-start gap-2 p-3 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 mb-4 text-xs text-amber-700 dark:text-amber-300">
  <span class="material-icons-outlined text-sm mt-0.5 flex-shrink-0">info</span>
  <span>Add products to cart first to calculate shipping cost.</span>
</div>
@endif

{{-- Row 1: Name, Email, Phone --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-3">
  <div>
    <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1 uppercase tracking-wide">
      Name <span class="text-red-500">*</span>
    </label>
    <input type="text"
      class="w-full border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2 text-sm focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500/20 transition-colors"
      name="customer_name"
      value="{{ $sessionAddr['customer_name'] ?? $user->name ?? ''}}"
      placeholder="Full name"
      required>
  </div>
  <div>
    <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1 uppercase tracking-wide">
      Email <span class="text-red-500">*</span>
    </label>
    <input type="email"
      class="w-full border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2 text-sm focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500/20 transition-colors"
      name="customer_email"
      value="{{ $sessionAddr['customer_email'] ?? $user->email ?? ''}}"
      placeholder="email@example.com"
      required>
  </div>
  <div>
    <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1 uppercase tracking-wide">
      Phone <span class="text-red-500">*</span>
    </label>
    <input type="text"
      class="w-full border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2 text-sm focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500/20 transition-colors"
      name="customer_phone"
      value="{{ $sessionAddr['customer_phone'] ?? $user->phone ?? ''}}"
      placeholder="Phone number"
      required>
  </div>
</div>

{{-- Row 2: Postal Code + auto-fill fields --}}
<div class="grid grid-cols-2 gap-3 mb-3">
  <div class="relative">
    <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1 uppercase tracking-wide">
      Postal Code <span class="text-red-500">*</span>
    </label>
    <div class="relative">
      <input type="text"
        class="zipcode w-full border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2 pr-8 text-sm focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500/20 transition-colors"
        id="customer_zip"
        name="customer_zip"
        value="{{ $sessionAddr['customer_zip'] ?? $user->zip ?? ''}}"
        placeholder="6-digit pincode"
        maxlength="6"
        >
      <span id="loader" class="absolute right-2 top-2.5 hidden">
        <svg class="animate-spin h-4 w-4 text-primary-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
        </svg>
      </span>
    </div>
    <p class="text-xs text-gray-400 mt-0.5">City, state & country auto-fill on valid pincode</p>
  </div>
  <div>
    <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1 uppercase tracking-wide">Country</label>
    <input type="text"
      class="w-full border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-600 text-gray-700 dark:text-gray-300 px-3 py-2 text-sm cursor-not-allowed"
      id="customer_country"
      name="customer_country"
      value="{{ $sessionAddr['customer_country'] ?? $user->country ?? '' }}"
      placeholder="Auto-filled"
      readonly>
  </div>
</div>

<div class="grid grid-cols-2 gap-3 mb-3">
  <div>
    <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1 uppercase tracking-wide">City</label>
    <input type="text"
      class="w-full border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-600 text-gray-700 dark:text-gray-300 px-3 py-2 text-sm cursor-not-allowed"
      id="customer_city"
      name="customer_city"
      value="{{ $sessionAddr['customer_city'] ?? $user->city_id ?? '' }}"
      placeholder="Auto-filled"
      readonly>
  </div>
  <div>
    <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1 uppercase tracking-wide">State</label>
    <input type="text"
      class="w-full border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-600 text-gray-700 dark:text-gray-300 px-3 py-2 text-sm cursor-not-allowed"
      id="customer_state"
      name="customer_state"
      value="{{ $sessionAddr['customer_state'] ?? $user->city_id ?? '' }}"
      placeholder="Auto-filled"
      readonly>
  </div>
</div>

{{-- Row 3: Full Address --}}
<div class="mb-3">
  <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1 uppercase tracking-wide">
    Address <span class="text-red-500">*</span>
  </label>
  <textarea
    class="w-full border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2 text-sm focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500/20 transition-colors resize-none"
    name="customer_address"
    rows="2"
    placeholder="Street address, area, landmark..."
    required>{{ $sessionAddr['customer_address'] ?? $user->address ?? '' }}</textarea>
</div>

<input type="hidden" name="shipping_cost" id="shipping_cost" value="{{ $sessionAddr['shipping_cost'] ?? 0 }}">

<script>
document.addEventListener('DOMContentLoaded', () => {
  const zipInput = document.getElementById('customer_zip');
 
  const loader = document.getElementById('loader');
  if (!zipInput) return;

  zipInput.addEventListener('input', async () => {
    if (CART_EMPTY) {
      zipInput.value = '';
      return;
    }
    let zip = zipInput.value.trim();
    if (!/^\d{0,6}$/.test(zip)) { zipInput.value = ''; return; }
    if (zip.length !== 6) { resetShipping(); return; }

    loader.classList.remove('hidden');
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
      loader.classList.add('hidden');
      if (!data.status) { resetShipping(); return; }
      customer_city.value = data.result.city;
      customer_state.value = data.result.state;
      customer_country.value = data.result.country;
      shipping_cost.value = data.result.shipping_cost;
    } catch (e) {
      loader.classList.add('hidden');
      resetShipping();
    }
  });

  function resetShipping() {
    document.getElementById('customer_city').value = '';
    document.getElementById('customer_state').value = '';
    document.getElementById('customer_country').value = '';
    document.getElementById('shipping_cost').value = 0;
  }
});
</script>
