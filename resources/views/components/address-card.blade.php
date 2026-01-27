@props(['address', 'selectable' => false, 'selected' => false, 'showActions' => true])

<div class="border border-gray-200 dark:border-gray-700 p-4 {{ $selected ? 'ring-2 ring-primary-600 dark:ring-primary-400 bg-primary-50 dark:bg-primary-900/10' : '' }} hover:border-primary-300 dark:hover:border-gray-600 transition-all cursor-pointer"
     onclick="{{ $selectable ? 'selectAddressCard(' . $address->id . ')' : '' }}">
  <div class="flex items-start gap-3">

    @if($selectable)
    <!-- Radio Button for Selection -->
    <input
      type="radio"
      name="selected_address"
      value="{{ $address->id }}"
      {{ $selected ? 'checked' : '' }}
      class="mt-0.5 w-4 h-4 text-primary-600 border-gray-300 focus:ring-primary-600"
      onclick="selectAddress({{ $address->id }})" />
    @endif

    <!-- Address Content -->
    <div class="flex-1 min-w-0">

      <!-- Type Badge & Default Badge -->
      <div class="flex items-center gap-2 mb-2">
        <span class="px-2 py-0.5 text-xs font-medium bg-gray-100 dark:bg-gray-700 text-neutral-700 dark:text-gray-300 uppercase">
          {{ ucfirst($address->type ?? 'home') }}
        </span>
        @if($address->is_default)
        <span class="px-2 py-0.5 text-xs font-medium bg-primary-100 text-primary-800 dark:bg-primary-900/30 dark:text-primary-300">
          Default
        </span>
        @endif
      </div>

      <!-- Name -->
      <h3 class="text-base font-bold text-neutral-900 dark:text-gray-100 mb-1">{{ $address->name }}</h3>

      <!-- Phone -->
      <p class="text-sm text-neutral-700 dark:text-gray-400 mb-1">{{ $address->phone }}</p>

      <!-- Full Address -->
      <div class="text-sm text-neutral-700 dark:text-gray-300 space-y-0.5">
        <p>{{ $address->address_line_1 }}@if($address->address_line_2), {{ $address->address_line_2 }}@endif</p>
        <p>{{ $address->city }}, {{ $address->state }} - {{ $address->pincode }}</p>
      </div>

      @if($showActions)
      <!-- Action Links -->
      <div class="flex items-center gap-4 mt-3 pt-3 border-t border-gray-200 dark:border-gray-700 text-sm">
        @if(!$address->is_default)
        <button
          type="button"
          onclick="event.stopPropagation(); setDefaultAddress({{ $address->id }})"
          class="text-primary-700 dark:text-primary-400 hover:text-primary-800 dark:hover:text-primary-300 font-medium transition-colors">
          Set as default
        </button>
        @endif

        <button
          type="button"
          onclick="event.stopPropagation(); editAddress({{ $address->id }})"
          class="text-primary-700 dark:text-primary-400 hover:text-primary-800 dark:hover:text-primary-300 font-medium transition-colors">
          Edit
        </button>

        <button
          type="button"
          onclick="event.stopPropagation(); deleteAddress({{ $address->id }})"
          class="text-semantic-error dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 font-medium transition-colors">
          Delete
        </button>
      </div>
      @endif

    </div>

  </div>
</div>
