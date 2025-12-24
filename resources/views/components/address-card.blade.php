@props(['address', 'selectable' => false, 'selected' => false, 'showActions' => true])

<div class="border border-gray-200 dark:border-gray-700 p-4 {{ $selected ? 'ring-2 ring-orange-600 dark:ring-orange-400 bg-orange-50 dark:bg-orange-900/10' : '' }} hover:border-gray-300 dark:hover:border-gray-600 transition-all cursor-pointer"
     onclick="{{ $selectable ? 'selectAddressCard(' . $address->id . ')' : '' }}">
  <div class="flex items-start gap-3">

    @if($selectable)
    <!-- Radio Button for Selection -->
    <input
      type="radio"
      name="selected_address"
      value="{{ $address->id }}"
      {{ $selected ? 'checked' : '' }}
      class="mt-0.5 w-4 h-4 text-orange-600 border-gray-300 focus:ring-orange-500"
      onclick="selectAddress({{ $address->id }})" />
    @endif

    <!-- Address Content -->
    <div class="flex-1 min-w-0">

      <!-- Name with Default Badge -->
      <div class="flex items-center gap-2 mb-1">
        <h3 class="text-base font-bold text-gray-900 dark:text-gray-100">{{ $address->name }}</h3>
        @if($address->is_default)
        <span class="px-2 py-0.5 text-xs font-medium bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200">
          Default
        </span>
        @endif
      </div>

      <!-- Full Address -->
      <div class="text-sm text-gray-700 dark:text-gray-300 space-y-0.5">
        <p>{{ $address->address_line_1 }}@if($address->address_line_2), {{ $address->address_line_2 }}@endif</p>
        <p>{{ $address->city }}, {{ $address->state }} - {{ $address->pincode }}</p>
        <p class="text-gray-600 dark:text-gray-400">{{ $address->country }}</p>
        <p class="mt-2">
          <span class="font-medium text-gray-900 dark:text-gray-100">Phone:</span>
          <span>{{ $address->phone }}</span>
        </p>
      </div>

      @if($showActions)
      <!-- Action Links -->
      <div class="flex items-center gap-4 mt-3 text-sm">
        <button
          type="button"
          onclick="event.stopPropagation(); editAddress({{ $address->id }})"
          class="text-orange-600 dark:text-orange-400 hover:text-orange-700 dark:hover:text-orange-300 font-medium transition-colors">
          Edit address
        </button>

        @if(!$address->is_default)
        <span class="text-gray-300 dark:text-gray-600">|</span>
        <button
          type="button"
          onclick="event.stopPropagation(); deleteAddress({{ $address->id }})"
          class="text-gray-600 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 font-medium transition-colors">
          Delete
        </button>
        @endif

        @if(!$address->is_default)
        <span class="text-gray-300 dark:text-gray-600">|</span>
        <button
          type="button"
          onclick="event.stopPropagation(); setDefaultAddress({{ $address->id }})"
          class="text-gray-600 dark:text-gray-400 hover:text-orange-600 dark:hover:text-orange-400 font-medium transition-colors">
          Set as Default
        </button>
        @endif
      </div>
      @endif

    </div>

  </div>
</div>
