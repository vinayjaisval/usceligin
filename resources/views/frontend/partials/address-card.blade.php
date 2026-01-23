{{--
  Reusable Address Card Component
  @param Address $address - The address model
  @param string $type - 'delivery' or 'billing'
  @param bool $selectable - Show radio button for selection
  @param bool $showActions - Show edit/delete/set-default actions
  @param bool $compact - Use compact layout (for billing selection from delivery)
--}}

@php
  $type = $type ?? 'delivery';
  $selectable = $selectable ?? true;
  $showActions = $showActions ?? true;
  $compact = $compact ?? false;

  $isBilling = $type === 'billing';
  $containerId = $isBilling ? "billing-container-{$address->id}" : "address-container-{$address->id}";
  $viewId = $isBilling ? "billing-view-{$address->id}" : "address-view-{$address->id}";
  $editId = $isBilling ? "billing-edit-{$address->id}" : "address-edit-{$address->id}";
  $cardId = $isBilling ? "billing-card-{$address->id}" : "address-card-{$address->id}";
  $radioName = $isBilling ? "billing_address_id" : "selected_address_id";
  $radioId = $isBilling ? "billing-address-{$address->id}" : "address-{$address->id}";
  $selectFn = $isBilling ? "selectBillingAddress" : "selectDeliveryAddress";
  $editFn = $isBilling ? "editBillingAddress" : "editAddress";
  $cancelFn = $isBilling ? "cancelEditBillingAddress" : "cancelEditAddress";
  $deleteFn = $isBilling ? "deleteBillingAddress" : "deleteAddress";
  $setDefaultFn = $isBilling ? "setDefaultBillingAddress" : "setDefaultAddress";
  $editFormId = $isBilling ? "editBillingForm{$address->id}" : "editAddressForm{$address->id}";
  $selectedClasses = $address->is_default ? 'border-primary-600 bg-primary-50 dark:bg-primary-900/20' : '';
@endphp

<div id="{{ $containerId }}" class="address-item">
  {{-- View Mode --}}
  <div
    class="block relative cursor-pointer group"
    id="{{ $viewId }}"
    onclick="{{ $selectFn }}({{ $address->id }})">

    <div class="relative border-2 border-gray-200 dark:border-gray-700 hover:border-primary-300 dark:hover:border-gray-600 transition-all p-4 {{ $selectedClasses }}"
         id="{{ $cardId }}"
         data-address-id="{{ $address->id }}">

      {{-- Radio Button & Default Badge --}}
      @if($selectable)
        <div class="absolute top-3 right-3 flex items-center gap-2">
          @if($address->is_default)
            <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-primary-800 dark:text-primary-300 bg-primary-100 dark:bg-primary-900/30">
              Default
            </span>
          @endif
          <input
            type="radio"
            name="{{ $radioName }}"
            id="{{ $radioId }}"
            value="{{ $address->id }}"
            {{ $address->is_default ? 'checked' : '' }}
            class="w-5 h-5 text-primary-600 border-2 border-gray-300 dark:border-gray-500 focus:ring-primary-600 focus:ring-2 cursor-pointer"
            {{ !$isBilling ? 'required' : '' }}>
        </div>
      @endif

      {{-- Address Content --}}
      <div class="{{ $selectable ? 'pr-20' : '' }}">
        <h3 class="text-sm font-semibold text-neutral-900 dark:text-gray-100 mb-1">
          {{ $address->name }}
        </h3>
        <p class="text-sm text-neutral-700 dark:text-gray-400 mb-1">
          {{ $address->phone }}
        </p>
        <p class="text-sm text-neutral-700 dark:text-gray-300">
          {{ $address->address_line_1 }}@if($address->address_line_2), {{ $address->address_line_2 }}@endif
        </p>
        <p class="text-sm text-neutral-700 dark:text-gray-300">
          {{ $address->city }}, {{ $address->state }} - {{ $address->pincode }}
        </p>
      </div>

      {{-- Actions --}}
      @if($showActions)
        <div class="mt-3 pt-3 border-t border-gray-200 dark:border-gray-700 flex flex-wrap gap-4 text-xs">
          @if(!$address->is_default)
            <button
              type="button"
              onclick="event.stopPropagation(); {{ $setDefaultFn }}({{ $address->id }})"
              class="text-primary-700 dark:text-primary-400 hover:text-primary-800 dark:hover:text-primary-300 font-medium transition-colors">
              Set as default
            </button>
          @endif

          <button
            type="button"
            onclick="event.stopPropagation(); {{ $editFn }}({{ $address->id }})"
            class="text-primary-700 dark:text-primary-400 hover:text-primary-800 dark:hover:text-primary-300 font-medium transition-colors">
            Edit
          </button>

          <button
            type="button"
            onclick="event.stopPropagation(); {{ $deleteFn }}({{ $address->id }})"
            class="text-semantic-error dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 font-medium transition-colors">
            Delete
          </button>
        </div>
      @endif
    </div>
  </div>

  {{-- Edit Mode --}}
  @if($showActions)
    <div id="{{ $editId }}" class="hidden border-2 border-primary-300 dark:border-primary-600 bg-primary-50 dark:bg-primary-900/10 p-4">
      <div class="flex items-center justify-between mb-3">
        <h3 class="text-md font-semibold text-neutral-900 dark:text-gray-100">
          Edit {{ $isBilling ? 'Billing ' : '' }}Address
        </h3>
        <button
          type="button"
          onclick="{{ $cancelFn }}({{ $address->id }})"
          class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>
      <x-address-form :formId="$editFormId" :address="$address" :showCancel="false" />
    </div>
  @endif
</div>
