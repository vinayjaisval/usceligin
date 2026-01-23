{{--
  Checkout Billing Address Section
  @param Collection $deliveryAddresses - User's delivery addresses (for quick selection)
  @param Collection $billingAddresses - User's billing addresses
  @param int $maxAddresses - Maximum allowed addresses per category
--}}

@php
  $billingCount = $billingAddresses->count();
  $canAddBilling = $billingCount < $maxAddresses;
  $showNewFormByDefault = $billingCount === 0;
@endphp

<h3 class="text-lg font-bold text-neutral-900 dark:text-gray-100 mb-4">
  Select billing address
</h3>

{{-- Option 1: Use a Delivery Address --}}
<div class="mb-6">
  <label class="flex items-center gap-2 mb-3 cursor-pointer">
    <input
      type="radio"
      name="billing_source"
      id="billing-from-delivery"
      value="delivery"
      checked
      onchange="AddressManager.toggleBillingSource('delivery')"
      class="w-4 h-4 text-primary-600 border-gray-300 focus:ring-primary-600">
    <span class="text-sm font-medium text-neutral-900 dark:text-gray-100">
      Use a delivery address
    </span>
  </label>

  {{-- Delivery Addresses Grid --}}
  <div id="billing-delivery-list" class="ml-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
    @foreach($deliveryAddresses as $address)
      <div
        class="block relative cursor-pointer group"
        onclick="selectBillingFromDelivery({{ $address->id }})">

        <div class="relative border-2 border-gray-200 dark:border-gray-700 hover:border-primary-300 dark:hover:border-gray-600 transition-all p-3 h-full"
             id="billing-delivery-card-{{ $address->id }}">

          {{-- Radio & Default Badge --}}
          <div class="flex items-center justify-between mb-2">
            <div class="flex items-center gap-2">
              <input
                type="radio"
                name="billing_address_id"
                id="billing-delivery-{{ $address->id }}"
                value="{{ $address->id }}"
                data-source="delivery"
                {{ $address->is_default ? 'checked' : '' }}
                class="w-4 h-4 text-primary-600 border-2 border-gray-300 dark:border-gray-500 focus:ring-primary-600 focus:ring-2 cursor-pointer">
              @if($address->is_default)
                <span class="text-xs font-medium text-primary-800 dark:text-primary-300 bg-primary-100 dark:bg-primary-900/30 px-2 py-0.5">
                  Default
                </span>
              @endif
            </div>
          </div>

          {{-- Address Info --}}
          <p class="text-sm font-semibold text-neutral-900 dark:text-gray-100 truncate">{{ $address->name }}</p>
          <p class="text-xs text-neutral-700 dark:text-gray-300 mt-1 line-clamp-2">
            {{ $address->address_line_1 }}@if($address->address_line_2), {{ $address->address_line_2 }}@endif
          </p>
          <p class="text-xs text-neutral-700 dark:text-gray-300">
            {{ $address->city }}, {{ $address->state }} - {{ $address->pincode }}
          </p>
        </div>
      </div>
    @endforeach
  </div>
</div>

{{-- Option 2: Use a Different Billing Address --}}
<div class="border-t border-gray-200 dark:border-gray-700 pt-4">
  <div class="flex items-center justify-between mb-3">
    <label class="flex items-center gap-2 cursor-pointer">
      <input
        type="radio"
        name="billing_source"
        id="billing-separate"
        value="billing"
        onchange="AddressManager.toggleBillingSource('billing')"
        class="w-4 h-4 text-primary-600 border-gray-300 focus:ring-primary-600">
      <span class="text-sm font-medium text-neutral-900 dark:text-gray-100">
        Use a different billing address
      </span>
    </label>

    @if($canAddBilling)
      <button
        type="button"
        onclick="toggleNewBillingAddressForm()"
        id="add-billing-address-btn"
        class="hidden text-sm text-primary-700 dark:text-primary-400 hover:text-primary-800 dark:hover:text-primary-300 font-medium transition-colors flex items-center gap-1">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Add billing address
      </button>
    @endif
  </div>

  {{-- Billing Addresses Section --}}
  <div id="billing-separate-section" class="hidden ml-6">

    {{-- Saved Billing Addresses --}}
    @if($billingCount > 0)
      <div class="space-y-2 mb-4" id="billing-addresses-list">
        @foreach($billingAddresses as $billingAddress)
          @include('frontend.partials.address-card', [
            'address' => $billingAddress,
            'type' => 'billing',
            'selectable' => true,
            'showActions' => true
          ])
        @endforeach
      </div>
    @else
      <p class="text-sm text-neutral-700 dark:text-gray-400 mb-4" id="no-billing-message">
        No billing addresses saved. Add one below.
      </p>
    @endif

    {{-- New Billing Address Form --}}
    @if($canAddBilling)
      <div id="new-billing-form-container" class="{{ $showNewFormByDefault ? '' : 'hidden' }} border-2 border-primary-200 dark:border-primary-800 bg-primary-50 dark:bg-primary-900/10 p-4">
        <div class="flex items-center justify-between mb-3">
          <h4 class="text-md font-semibold text-neutral-900 dark:text-gray-100">Add billing address</h4>
          @if(!$showNewFormByDefault)
            <button
              type="button"
              onclick="toggleNewBillingAddressForm()"
              class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
              </svg>
            </button>
          @endif
        </div>
        <x-address-form formId="newBillingAddressForm" :showCancel="false" />
      </div>
    @else
      <p class="text-xs text-gray-500 dark:text-gray-400">Maximum {{ $maxAddresses }} billing addresses allowed</p>
    @endif
  </div>
</div>
