<!-- Address Section -->
<section class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700" id="address-section">
  <div class="p-4 sm:p-6">

    @if(isset($addresses) && $addresses->count() > 0)
      <!-- RETURNING USER: Show Saved Addresses -->

      <div class="mb-4 flex items-center justify-between">
        <div>
          <h2 class="text-lg sm:text-xl font-bold text-neutral-900 dark:text-gray-100">
            Select delivery address
          </h2>
          <p class="text-sm text-neutral-700 dark:text-gray-400 mt-1">
            {{ $addresses->count() }} saved {{ $addresses->count() === 1 ? 'address' : 'addresses' }}
          </p>
        </div>

        @if($addresses->count() < 3)
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
        <p class="text-xs text-gray-500 dark:text-gray-400">Maximum 3 addresses allowed</p>
        @endif
      </div>

      <!-- Saved Addresses List -->
      <div class="space-y-3 mb-4" id="addresses-list">
        @foreach($addresses as $index => $address)
        <div id="address-container-{{ $address->id }}" class="address-item">
          <!-- View Mode -->
          <div
            class="block relative cursor-pointer group address-view"
            id="address-view-{{ $address->id }}"
            onclick="selectDeliveryAddress({{ $address->id }})">

            <!-- Address Card -->
            <div class="relative border-2 border-gray-200 dark:border-gray-700 hover:border-primary-300 dark:hover:border-gray-600 transition-all p-4 {{ $address->is_default ? 'border-primary-600 bg-primary-50 dark:bg-primary-900/20' : '' }}"
                 id="address-card-{{ $address->id }}"
                 data-address-id="{{ $address->id }}">

            <!-- Radio Button & Default Badge -->
            <div class="absolute top-3 right-3 flex items-center gap-2">
              @if($address->is_default)
              <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-primary-800 dark:text-primary-300 bg-primary-100 dark:bg-primary-900/30">
                Default
              </span>
              @endif
              <input
                type="radio"
                name="selected_address_id"
                id="address-{{ $address->id }}"
                value="{{ $address->id }}"
                {{ $address->is_default ? 'checked' : '' }}
                class="w-5 h-5 text-primary-600 border-2 border-gray-300 dark:border-gray-500 focus:ring-primary-600 focus:ring-2 cursor-pointer"
                onchange="handleAddressSelection({{ $address->id }})"
                required>
            </div>

            <!-- Name & Phone -->
            <h3 class="text-sm font-semibold text-neutral-900 dark:text-gray-100 mb-1">
              {{ $address->name }}
            </h3>
            <p class="text-sm text-neutral-700 dark:text-gray-400 mb-1">
              {{ $address->phone }}
            </p>

            <!-- Address -->
            <p class="text-sm text-neutral-700 dark:text-gray-300">
              {{ $address->address_line_1 }}@if($address->address_line_2), {{ $address->address_line_2 }}@endif
            </p>
            <p class="text-sm text-neutral-700 dark:text-gray-300">
              {{ $address->city }}, {{ $address->state }} - {{ $address->pincode }}
            </p>

            <!-- Actions (visible on hover or when selected) -->
            <div class="mt-3 pt-3 border-t border-gray-200 dark:border-gray-700 flex flex-wrap gap-4 text-xs">

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

          </div>
        </div>

        <!-- Edit Mode (Hidden by default) -->
        <div id="address-edit-{{ $address->id }}" class="hidden address-edit border-2 border-primary-300 dark:border-primary-600 bg-primary-50 dark:bg-primary-900/10 p-4">
          <div class="flex items-center justify-between mb-3">
            <h3 class="text-md font-semibold text-neutral-900 dark:text-gray-100">Edit Address</h3>
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

      <!-- Billing Address Section -->
      <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
        <div class="flex items-start">
          <input
            type="checkbox"
            id="same-as-shipping-saved"
            name="same_as_shipping"
            checked
            onchange="toggleBillingAddressSection()"
            class="w-4 h-4 text-primary-600 bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 rounded focus:ring-primary-600 mt-0.5">
          <label for="same-as-shipping-saved" class="ml-2 text-sm text-neutral-700 dark:text-gray-300">
            Use same address for billing
          </label>
        </div>

        <!-- Billing Address Selection (Hidden by default) -->
        <div id="billing-address-section" class="hidden mt-4 p-4 bg-neutral-50 dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700">
          <h3 class="text-md font-semibold text-neutral-900 dark:text-gray-100 mb-3">
            Select billing address
          </h3>

          <div class="space-y-3">
            @foreach($addresses as $address)
            <div
              class="block relative cursor-pointer group"
              onclick="selectBillingAddress({{ $address->id }})">

              <!-- Billing Address Card (Simplified) -->
              <div class="relative border-2 border-gray-200 dark:border-gray-700 hover:border-primary-300 dark:hover:border-gray-600 transition-all p-3 {{ $address->is_default ? 'border-primary-600 bg-primary-50 dark:bg-primary-900/20' : '' }}"
                   id="billing-card-{{ $address->id }}">

                <!-- Radio Button & Default Badge -->
                <div class="absolute top-2 right-2 flex items-center gap-2">
                  @if($address->is_default)
                  <span class="text-xs font-medium text-primary-800 dark:text-primary-300 bg-primary-100 dark:bg-primary-900/30 px-2 py-0.5">
                    Default
                  </span>
                  @endif
                  <input
                    type="radio"
                    name="billing_address_id"
                    id="billing-address-{{ $address->id }}"
                    value="{{ $address->id }}"
                    {{ $address->is_default ? 'checked' : '' }}
                    class="w-4 h-4 text-primary-600 border-2 border-gray-300 dark:border-gray-500 focus:ring-primary-600 focus:ring-2 cursor-pointer">
                </div>

                <!-- Address Info -->
                <div class="pr-8">

                  <p class="text-sm font-semibold text-neutral-900 dark:text-gray-100">{{ $address->name }}</p>
                  <p class="text-xs text-neutral-700 dark:text-gray-300 mt-1">
                    {{ $address->address_line_1 }}@if($address->address_line_2), {{ $address->address_line_2 }}@endif
                  </p>
                  <p class="text-xs text-neutral-700 dark:text-gray-300">
                    {{ $address->city }}, {{ $address->state }} - {{ $address->pincode }}
                  </p>
                </div>

              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>

    @else
      <!-- FIRST TIME USER: Show Form Directly -->

      <div id="first-time-address-container">
        <div class="mb-4">
          <h2 class="text-lg sm:text-xl font-bold text-neutral-900 dark:text-gray-100">
            Add delivery address
          </h2>
          <p class="text-sm text-neutral-700 dark:text-gray-400 mt-1">
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
            class="w-4 h-4 text-primary-600 bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 rounded focus:ring-primary-600 mt-0.5">
          <label for="same-as-shipping-first" class="ml-2 text-sm text-neutral-700 dark:text-gray-300">
            Use same address for billing
          </label>
        </div>
      </div>

    @endif

  </div>
</section>

<script>
// CSRF Token for all fetch requests
const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

// Select delivery address - Update visual state
function selectDeliveryAddress(addressId) {
  // Uncheck all radio buttons and remove styling
  document.querySelectorAll('[name="selected_address_id"]').forEach(radio => {
    radio.checked = false;
    const card = document.getElementById(`address-card-${radio.value}`);
    if (card) {
      card.classList.remove('border-primary-600', 'bg-primary-50', 'dark:bg-primary-900/20');
      card.classList.add('border-gray-200', 'dark:border-gray-700');
    }
  });

  // Check selected radio and add styling
  const selectedRadio = document.getElementById(`address-${addressId}`);
  const selectedCard = document.getElementById(`address-card-${addressId}`);
  if (selectedRadio) {
    selectedRadio.checked = true;
  }
  if (selectedCard) {
    selectedCard.classList.remove('border-gray-200', 'dark:border-gray-700');
    selectedCard.classList.add('border-primary-600', 'bg-primary-50', 'dark:bg-primary-900/20');
  }

  handleAddressSelection(addressId);
}

// Handle address selection
function handleAddressSelection(addressId) {
  console.log('Selected address:', addressId);
  // You can add additional logic here, like updating a hidden form field
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

  fetch(`{{ url('/user/addresses') }}/${addressId}/set-default`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrfToken,
      'Accept': 'application/json'
    }
  })
  .then(response => {
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    return response.json();
  })
  .then(data => {
    if (data.success || data.message) {
      showToast(data.message || 'Default address updated!', 'success');
      setTimeout(() => location.reload(), 1000);
    } else {
      showToast(data.error || 'Failed to update default address', 'error');
    }
  })
  .catch(error => {
    console.error('Set default error:', error);
    showToast('An error occurred. Please try again.', 'error');
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

// Update address - Submit edit form
function updateAddress(addressId) {
  const form = document.getElementById(`editAddressForm${addressId}`);
  if (!form) {
    showToast('Form not found', 'error');
    return;
  }

  const formData = new FormData(form);
  const data = {};
  formData.forEach((value, key) => {
    if (key !== '_token') {
      data[key] = value;
    }
  });

  // Handle checkbox (is_default)
  data.is_default = form.querySelector('[name="is_default"]')?.checked ? 1 : 0;

  fetch(`{{ url('/user/addresses') }}/${addressId}`, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrfToken,
      'Accept': 'application/json'
    },
    body: JSON.stringify(data)
  })
  .then(response => {
    if (!response.ok) {
      return response.json().then(err => { throw err; });
    }
    return response.json();
  })
  .then(data => {
    if (data.success || data.message) {
      showToast(data.message || 'Address updated successfully!', 'success');
      setTimeout(() => location.reload(), 1000);
    } else {
      showToast(data.error || 'Failed to update address', 'error');
    }
  })
  .catch(error => {
    console.error('Update error:', error);
    if (error.errors) {
      // Show validation errors
      const errorMessages = Object.values(error.errors).flat().join('\n');
      showToast(errorMessages || 'Validation error occurred', 'error');
    } else {
      showToast(error.message || 'An error occurred. Please try again.', 'error');
    }
  });
}

// Initialize edit form submit handlers
document.addEventListener('DOMContentLoaded', function() {
  // Attach submit handlers to all edit address forms
  document.querySelectorAll('[id^="editAddressForm"]').forEach(form => {
    const addressId = form.id.replace('editAddressForm', '');
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      updateAddress(addressId);
    });
  });
});

// Delete address
function deleteAddress(addressId) {
  if (!confirm('Are you sure you want to delete this address?')) {
    return;
  }

  fetch(`{{ url('/user/addresses') }}/${addressId}`, {
    method: 'DELETE',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrfToken,
      'Accept': 'application/json'
    }
  })
  .then(response => {
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    return response.json();
  })
  .then(data => {
    if (data.success || data.message) {
      showToast(data.message || 'Address deleted successfully!', 'success');
      setTimeout(() => location.reload(), 1000);
    } else {
      showToast(data.error || 'Failed to delete address', 'error');
    }
  })
  .catch(error => {
    console.error('Delete error:', error);
    showToast('An error occurred. Please try again.', 'error');
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

// Select billing address - Update visual state
function selectBillingAddress(addressId) {
  // Uncheck all billing radio buttons and remove styling
  document.querySelectorAll('[name="billing_address_id"]').forEach(radio => {
    radio.checked = false;
    const card = document.getElementById(`billing-card-${radio.value}`);
    if (card) {
      card.classList.remove('border-primary-600', 'bg-primary-50', 'dark:bg-primary-900/20');
      card.classList.add('border-gray-200', 'dark:border-gray-700');
    }
  });

  // Check selected radio and add styling
  const selectedRadio = document.getElementById(`billing-address-${addressId}`);
  const selectedCard = document.getElementById(`billing-card-${addressId}`);
  if (selectedRadio) {
    selectedRadio.checked = true;
  }
  if (selectedCard) {
    selectedCard.classList.remove('border-gray-200', 'dark:border-gray-700');
    selectedCard.classList.add('border-primary-600', 'bg-primary-50', 'dark:bg-primary-900/20');
  }
}

// Show toast notification (uses Toastify if available, else alert)
function showToast(message, type = 'success') {
  const backgroundColor = type === 'success' ? '#059669' : type === 'error' ? '#DC2626' : '#D97706';

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
