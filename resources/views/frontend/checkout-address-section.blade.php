<!-- Address Section -->
<section class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700" id="address-section">
  <div class="p-4 sm:p-6">

    @if(isset($addresses) && $addresses->count() > 0)
      <!-- RETURNING USER: Show Saved Addresses -->

      <div class="mb-4 flex items-center justify-between">
        <div>
          <h2 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-gray-100">
            Select delivery address
          </h2>
          <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
            {{ $addresses->count() }} saved {{ $addresses->count() === 1 ? 'address' : 'addresses' }}
          </p>
        </div>

        @if($addresses->count() < 3)
        <button
          type="button"
          onclick="toggleNewAddressForm()"
          id="add-address-toggle-btn"
          class="text-sm text-orange-600 dark:text-orange-400 hover:text-orange-700 dark:hover:text-orange-300 font-medium transition-colors flex items-center gap-1">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
          </svg>
          Add new address
        </button>
        @else
        <p class="text-xs text-gray-500 dark:text-gray-400">Maximum 3 addresses allowed</p>
        @endif
      </div>

      <!-- Saved Addresses List -->
      <div class="space-y-3 mb-4" id="addresses-list">
        @foreach($addresses as $index => $address)
        <div id="address-container-{{ $address->id }}" class="address-item">
          <!-- View Mode -->
          <label
            class="block relative cursor-pointer group address-view"
            id="address-view-{{ $address->id }}"
            for="address-{{ $address->id }}">

            <input
              type="radio"
              name="selected_address_id"
              id="address-{{ $address->id }}"
              value="{{ $address->id }}"
              {{ $address->is_default ? 'checked' : '' }}
              class="peer sr-only"
              onchange="handleAddressSelection({{ $address->id }})"
              required>

            <!-- Address Card -->
            <div class="relative border-2 peer-checked:border-orange-600 peer-checked:bg-orange-50 dark:peer-checked:bg-orange-900/20 border-gray-200 dark:border-gray-700 hover:border-gray-300 dark:hover:border-gray-600 transition-all p-4">

            <!-- Selected Indicator -->
            <div class="absolute top-3 right-3 w-5 h-5 border-2 border-gray-300 dark:border-gray-600 rounded-full peer-checked:border-orange-600 peer-checked:bg-orange-600 flex items-center justify-center">
              <svg class="w-3 h-3 text-white hidden peer-checked:block" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
              </svg>
            </div>

            <!-- Address Type & Default Badge -->
            <div class="flex items-center gap-2 mb-2">
              <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 uppercase">
                {{ ucfirst($address->type ?? 'home') }}
              </span>
              @if($address->is_default)
              <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-orange-700 dark:text-orange-300 bg-orange-100 dark:bg-orange-900/30">
                Default
              </span>
              @endif
            </div>

            <!-- Name & Phone -->
            <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-1">
              {{ $address->name }}
            </h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">
              {{ $address->phone }}
            </p>

            <!-- Address -->
            <p class="text-sm text-gray-700 dark:text-gray-300">
              {{ $address->address_line_1 }}@if($address->address_line_2), {{ $address->address_line_2 }}@endif
            </p>
            <p class="text-sm text-gray-700 dark:text-gray-300">
              {{ $address->city }}, {{ $address->state }} - {{ $address->pincode }}
            </p>

            <!-- Actions (visible on hover or when selected) -->
            <div class="mt-3 pt-3 border-t border-gray-200 dark:border-gray-700 flex flex-wrap gap-3 text-xs">

              @if(!$address->is_default)
              <button
                type="button"
                onclick="event.stopPropagation(); setDefaultAddress({{ $address->id }})"
                class="text-orange-600 dark:text-orange-400 hover:text-orange-700 dark:hover:text-orange-300 font-medium">
                Set as default
              </button>
              @endif

              <button
                type="button"
                onclick="event.stopPropagation(); editAddress({{ $address->id }})"
                class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium">
                Edit
              </button>

              <button
                type="button"
                onclick="event.stopPropagation(); deleteAddress({{ $address->id }})"
                class="text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 font-medium">
                Delete
              </button>
            </div>

          </div>
        </label>

        <!-- Edit Mode (Hidden by default) -->
        <div id="address-edit-{{ $address->id }}" class="hidden address-edit border-2 border-orange-300 dark:border-orange-600 bg-orange-50/50 dark:bg-orange-900/10 p-4">
          <div class="flex items-center justify-between mb-3">
            <h3 class="text-md font-semibold text-gray-900 dark:text-gray-100">Edit Address</h3>
            <button
              type="button"
              onclick="cancelEditAddress({{ $address->id }})"
              class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
              </svg>
            </button>
          </div>
          <x-address-form formId="editAddressForm{{ $address->id }}" :address="$address" :showCancel="false" />
        </div>
      </div>
        @endforeach
      </div>

      <!-- Add New Address Form (Hidden initially) -->
      @if($addresses->count() < 3)
      <div id="new-address-form-container" class="hidden mt-4 border-2 border-orange-200 dark:border-orange-800 bg-orange-50/50 dark:bg-orange-900/10 p-4">
        <div class="flex items-center justify-between mb-3">
          <h3 class="text-md font-semibold text-gray-900 dark:text-gray-100">Add a new address</h3>
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

      <!-- Billing Address Section -->
      <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
        <div class="flex items-start">
          <input
            type="checkbox"
            id="same-as-shipping-saved"
            name="same_as_shipping"
            checked
            onchange="toggleBillingAddressSection()"
            class="w-4 h-4 text-orange-600 bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 rounded focus:ring-orange-500 mt-0.5">
          <label for="same-as-shipping-saved" class="ml-2 text-sm text-gray-700 dark:text-gray-300">
            Use same address for billing
          </label>
        </div>

        <!-- Billing Address Selection (Hidden by default) -->
        <div id="billing-address-section" class="hidden mt-4 p-4 bg-gray-50 dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700">
          <h3 class="text-md font-semibold text-gray-900 dark:text-gray-100 mb-3">
            Select billing address
          </h3>

          <div class="space-y-3">
            @foreach($addresses as $address)
            <label
              class="block relative cursor-pointer group"
              for="billing-address-{{ $address->id }}">

              <input
                type="radio"
                name="billing_address_id"
                id="billing-address-{{ $address->id }}"
                value="{{ $address->id }}"
                {{ $address->is_default ? 'checked' : '' }}
                class="peer sr-only">

              <!-- Billing Address Card (Simplified) -->
              <div class="relative border-2 peer-checked:border-blue-600 peer-checked:bg-blue-50 dark:peer-checked:bg-blue-900/20 border-gray-200 dark:border-gray-700 hover:border-gray-300 dark:hover:border-gray-600 transition-all p-3">

                <!-- Selected Indicator -->
                <div class="absolute top-2 right-2 w-4 h-4 border-2 border-gray-300 dark:border-gray-600 rounded-full peer-checked:border-blue-600 peer-checked:bg-blue-600 flex items-center justify-center">
                  <svg class="w-2.5 h-2.5 text-white hidden peer-checked:block" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                  </svg>
                </div>

                <!-- Address Info -->
                <div class="pr-6">
                  <div class="flex items-center gap-2 mb-1">
                    <span class="text-xs font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 px-2 py-0.5 uppercase">
                      {{ ucfirst($address->type ?? 'home') }}
                    </span>
                    @if($address->is_default)
                    <span class="text-xs font-medium text-orange-700 dark:text-orange-300 bg-orange-100 dark:bg-orange-900/30 px-2 py-0.5">
                      Default
                    </span>
                    @endif
                  </div>

                  <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $address->name }}</p>
                  <p class="text-xs text-gray-700 dark:text-gray-300 mt-1">
                    {{ $address->address_line_1 }}@if($address->address_line_2), {{ $address->address_line_2 }}@endif
                  </p>
                  <p class="text-xs text-gray-700 dark:text-gray-300">
                    {{ $address->city }}, {{ $address->state }} - {{ $address->pincode }}
                  </p>
                </div>

              </div>
            </label>
            @endforeach
          </div>
        </div>
      </div>

    @else
      <!-- FIRST TIME USER: Show Form Directly -->

      <div id="first-time-address-container">
        <div class="mb-4">
          <h2 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-gray-100">
            Add delivery address
          </h2>
          <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
            This will be your default shipping address
          </p>
        </div>

        <x-address-form formId="firstAddressForm" :showCancel="false" />

        <!-- Same as Shipping Checkbox -->
        <div class="mt-4 flex items-start">
          <input
            type="checkbox"
            id="same-as-shipping-first"
            name="same_as_shipping"
            checked
            class="w-4 h-4 text-orange-600 bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 rounded focus:ring-orange-500 mt-0.5">
          <label for="same-as-shipping-first" class="ml-2 text-sm text-gray-700 dark:text-gray-300">
            Use same address for billing
          </label>
        </div>
      </div>

    @endif

  </div>
</section>

<script>
// Handle address selection
function handleAddressSelection(addressId) {
  console.log('Selected address:', addressId);
}

// Toggle new address form
function toggleNewAddressForm() {
  const container = document.getElementById('new-address-form-container');
  const btn = document.getElementById('add-address-toggle-btn');

  if (container.classList.contains('hidden')) {
    container.classList.remove('hidden');
    btn.textContent = 'Cancel';
  } else {
    container.classList.add('hidden');
    btn.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg> Add new address';
  }
}

// Set address as default
function setDefaultAddress(addressId) {
  if (!confirm('Set this address as your default delivery address?')) {
    return;
  }

  fetch(`/user/addresses/${addressId}/set-default`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    }
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      location.reload();
    } else {
      alert(data.error || 'Failed to update default address');
    }
  })
  .catch(error => {
    console.error('Error:', error);
    alert('An error occurred. Please try again.');
  });
}

// Edit address - Show inline edit form
function editAddress(addressId) {
  // Hide view mode
  document.getElementById(`address-view-${addressId}`).classList.add('hidden');
  // Show edit mode
  document.getElementById(`address-edit-${addressId}`).classList.remove('hidden');
}

// Cancel edit address - Hide edit form
function cancelEditAddress(addressId) {
  // Show view mode
  document.getElementById(`address-view-${addressId}`).classList.remove('hidden');
  // Hide edit mode
  document.getElementById(`address-edit-${addressId}`).classList.add('hidden');
}

// Delete address
function deleteAddress(addressId) {
  if (!confirm('Are you sure you want to delete this address?')) {
    return;
  }

  fetch(`/usceligin/user/addresses/${addressId}`, {
    method: 'DELETE',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    }
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      location.reload();
    } else {
      alert(data.error || 'Failed to delete address');
    }
  })
  .catch(error => {
    console.error('Error:', error);
    alert('An error occurred. Please try again.');
  });
}

// Toggle billing address section
function toggleBillingAddressSection() {
  const checkbox = document.getElementById('same-as-shipping-saved');
  const billingSection = document.getElementById('billing-address-section');

  if (checkbox && billingSection) {
    if (checkbox.checked) {
      billingSection.classList.add('hidden');
    } else {
      billingSection.classList.remove('hidden');
    }
  }
}
</script>
