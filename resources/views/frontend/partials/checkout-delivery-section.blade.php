{{--
  Checkout Delivery Address Section
  @param Collection $addresses - User's delivery addresses
  @param int $maxAddresses - Maximum allowed addresses
--}}

@php
  $addressCount = $addresses->count();
  $canAddMore = $addressCount < $maxAddresses;
@endphp

{{-- Header --}}
<div class="mb-4 flex items-center justify-between">
  <div>
    <h2 class="text-lg sm:text-xl font-bold text-neutral-900 dark:text-gray-100">
      Select delivery address
    </h2>
    <p class="text-sm text-neutral-700 dark:text-gray-400 mt-1">
      {{ $addressCount }} saved {{ Str::plural('address', $addressCount) }}
    </p>
  </div>

  @if($canAddMore)
    <button
      type="button"
      onclick="toggleNewAddressForm()"
      id="add-address-toggle-btn"
      class="text-sm text-primary-700 dark:text-primary-400 hover:text-primary-800 dark:hover:text-primary-300 font-medium transition-colors flex items-center gap-1">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
      </svg>
      Add new address
    </button>
  @else
    <p class="text-xs text-gray-500 dark:text-gray-400">Maximum {{ $maxAddresses }} addresses allowed</p>
  @endif
</div>

{{-- Address List --}}
<div class="space-y-3 mb-4" id="addresses-list">
  @foreach($addresses as $address)
    @include('frontend.partials.address-card', [
      'address' => $address,
      'type' => 'delivery',
      'selectable' => true,
      'showActions' => true,
      'compact' => false
    ])
  @endforeach
</div>

{{-- New Address Form --}}
@if($canAddMore)
  <div id="new-address-form-container" class="hidden mt-4 border-2 border-primary-200 dark:border-primary-800 bg-primary-50 dark:bg-primary-900/10 p-4">
    <div class="flex items-center justify-between mb-3">
      <h3 class="text-md font-semibold text-neutral-900 dark:text-gray-100">Add a new address</h3>
      <button
        type="button"
        onclick="toggleNewAddressForm()"
        class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>
    <x-address-form formId="newAddressForm" :showCancel="false" />
  </div>
@endif
