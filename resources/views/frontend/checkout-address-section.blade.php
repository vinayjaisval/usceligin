{{--
  Checkout Address Section Component
  Handles delivery and billing address selection with full CRUD operations
--}}

@php
  $maxAddresses = 3;
  $deliveryCount = isset($addresses) ? $addresses->count() : 0;
  $billingCount = isset($billingAddresses) ? $billingAddresses->count() : 0;
  $hasAddresses = $deliveryCount > 0;
@endphp

<section class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700" id="address-section">
  <div class="p-4 sm:p-6">

    @if($hasAddresses)
      {{-- RETURNING USER: Show Saved Addresses --}}
      @include('frontend.partials.checkout-delivery-section', [
        'addresses' => $addresses,
        'maxAddresses' => $maxAddresses
      ])

      {{-- Billing Address Section --}}
      <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
        <label class="flex items-start cursor-pointer">
          <input
            type="checkbox"
            id="same-as-shipping"
            name="same_as_shipping"
            checked
            onchange="AddressManager.toggleBillingSection()"
            class="w-4 h-4 text-primary-600 bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 rounded focus:ring-primary-600 mt-0.5">
          <span class="ml-2 text-sm text-neutral-700 dark:text-gray-300">
            Use same address for billing
          </span>
        </label>

        {{-- Billing Address Selection (Hidden by default) --}}
        <div id="billing-section" class="hidden mt-4">
          @include('frontend.partials.checkout-billing-section', [
            'deliveryAddresses' => $addresses,
            'billingAddresses' => $billingAddresses ?? collect(),
            'maxAddresses' => $maxAddresses
          ])
        </div>
      </div>

    @else
      {{-- FIRST TIME USER: Show Form Directly --}}
      <div id="first-time-container">
        <div class="mb-4">
          <h2 class="text-lg sm:text-xl font-bold text-neutral-900 dark:text-gray-100">
            Add delivery address
          </h2>
          <p class="text-sm text-neutral-700 dark:text-gray-400 mt-1">
            This will be your default shipping address
          </p>
        </div>

        <x-address-form formId="firstAddressForm" :showCancel="false" />

        <label class="mt-4 flex items-start cursor-pointer">
          <input
            type="checkbox"
            id="same-as-shipping-first"
            name="same_as_shipping"
            checked
            class="w-4 h-4 text-primary-600 bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 rounded focus:ring-primary-600 mt-0.5">
          <span class="ml-2 text-sm text-neutral-700 dark:text-gray-300">
            
            Use same address for billing
          </span>
        </label>
      </div>
    @endif

  </div>
</section>

<script>
/**
 * Address Manager - Handles all address CRUD operations
 * Follows DRY principles with unified functions for delivery and billing addresses
 */
const AddressManager = {
  // Configuration
  config: {
    apiUrl: '{{ url("/user/addresses") }}',
    csrfToken: document.querySelector('meta[name="csrf-token"]')?.content,
    maxAddresses: {{ $maxAddresses }},
    reloadDelay: 1000,
    classes: {
      selected: ['border-primary-600', 'bg-primary-50', 'dark:bg-primary-900/20'],
      unselected: ['border-gray-200', 'dark:border-gray-700'],
      disabled: ['opacity-50', 'pointer-events-none']
    }
  },

  // Icons
  icons: {
    plus: '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>',
    close: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>'
  },

  /**
   * Initialize the address manager
   */
  init() {
    this.attachFormHandlers();
    this.restoreStateFromUrl();
  },

  /**
   * Attach submit handlers to all address forms
   */
  attachFormHandlers() {
    // Delivery address forms
    this.attachEditFormHandlers('editAddressForm', 'delivery');
    this.attachNewFormHandler('newAddressForm', 'delivery');
    this.attachNewFormHandler('firstAddressForm', 'delivery');

    // Billing address forms
    this.attachEditFormHandlers('editBillingForm', 'billing');
    this.attachNewFormHandler('newBillingAddressForm', 'billing');
  },

  /**
   * Attach handlers to edit forms
   */
  attachEditFormHandlers(prefix, type) {
    document.querySelectorAll(`[id^="${prefix}"]`).forEach(form => {
      const addressId = form.id.replace(prefix, '');
      form.addEventListener('submit', (e) => {
        e.preventDefault();
        this.updateAddress(addressId, type);
      });
    });
  },

  /**
   * Attach handler to new address form
   */
  attachNewFormHandler(formId, type) {
    const form = document.getElementById(formId);
    if (form) {
      form.addEventListener('submit', (e) => {
        e.preventDefault();
        this.storeAddress(formId, type);
      });
    }
  },

  /**
   * Restore UI state from URL parameters
   */
  restoreStateFromUrl() {
    const params = new URLSearchParams(window.location.search);
    const billingOpen = params.get('billing') === 'open';
    const sourceBilling = params.get('source') === 'billing';

    if (billingOpen) {
      const checkbox = document.getElementById('same-as-shipping');
      if (checkbox) {
        checkbox.checked = false;
        this.toggleBillingSection();
      }

      if (sourceBilling) {
        const radio = document.getElementById('billing-separate');
        if (radio) {
          radio.checked = true;
          this.toggleBillingSource('billing');
        }
      }

      // Clean URL
      window.history.replaceState({}, document.title, window.location.pathname);

      // Scroll to billing section
      setTimeout(() => {
        document.getElementById('billing-section')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }, 100);
    }
  },

  // ==================== API Operations ====================

  /**
   * Generic API request handler
   */
  async apiRequest(url, method, data = null) {
    const options = {
      method,
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': this.config.csrfToken,
        'Accept': 'application/json'
      }
    };

    if (data) {
      options.body = JSON.stringify(data);
    }

    const response = await fetch(url, options);

    if (!response.ok) {
      const error = await response.json();
      throw error;
    }

    return response.json();
  },

  /**
   * Extract form data as object
   */
  getFormData(form) {
    const formData = new FormData(form);
    const data = {};

    formData.forEach((value, key) => {
      if (key !== '_token') {
        data[key] = value;
      }
    });

    data.is_default = form.querySelector('[name="is_default"]')?.checked ? 1 : 0;
    return data;
  },

  /**
   * Store new address
   */
  async storeAddress(formId, type) {
    const form = document.getElementById(formId);
   
    if (!form) {
      this.showToast('Form not found', 'error');
      return;
    }

    const data = this.getFormData(form);
    
    data.address_category = type;

    try {
      const result = await this.apiRequest(this.config.apiUrl, 'POST', data);
      this.showToast(result.message || 'Address added successfully!', 'success');
      this.reloadPage(type);
    } catch (error) {
      this.handleError(error, 'Failed to add address');
    }
  },

  /**
   * Update existing address
   */
  async updateAddress(addressId, type) {
    const formId = type === 'billing' ? `editBillingForm${addressId}` : `editAddressForm${addressId}`;
    const form = document.getElementById(formId);

    if (!form) {
      this.showToast('Form not found', 'error');
      return;
    }

    const data = this.getFormData(form);

    try {
      const result = await this.apiRequest(`${this.config.apiUrl}/${addressId}`, 'PUT', data);
      this.showToast(result.message || 'Address updated successfully!', 'success');
      this.reloadPage(type);
    } catch (error) {
      this.handleError(error, 'Failed to update address');
    }
  },

  /**
   * Delete address
   */
  async deleteAddress(addressId, type) {
    const confirmMsg = type === 'billing'
      ? 'Are you sure you want to delete this billing address?'
      : 'Are you sure you want to delete this address?';

    if (!confirm(confirmMsg)) return;

    try {
      const result = await this.apiRequest(`${this.config.apiUrl}/${addressId}`, 'DELETE');
      this.showToast(result.message || 'Address deleted successfully!', 'success');
      this.reloadPage(type);
    } catch (error) {
      this.handleError(error, 'Failed to delete address');
    }
  },

  /**
   * Set address as default
   */
  async setDefault(addressId, type) {
    const confirmMsg = type === 'billing'
      ? 'Set this as your default billing address?'
      : 'Set this address as your default delivery address?';

    if (!confirm(confirmMsg)) return;

    try {
      const result = await this.apiRequest(`${this.config.apiUrl}/${addressId}/set-default`, 'POST');
      this.showToast(result.message || 'Default address updated!', 'success');
      this.reloadPage(type);
    } catch (error) {
      this.handleError(error, 'Failed to update default address');
    }
  },

  // ==================== UI Operations ====================

  /**
   * Select delivery address
   */
  selectDeliveryAddress(addressId) {
    this.updateCardSelection('selected_address_id', 'address-card-', addressId);
  },

  /**
   * Select billing address from delivery list
   */
  selectBillingFromDelivery(addressId) {
    document.getElementById('billing-from-delivery').checked = true;
    this.toggleBillingSource('delivery');
    this.updateBillingCardSelection(addressId, 'billing-delivery-card-');
  },

  /**
   * Select billing address from billing list
   */
  selectBillingAddress(addressId) {
    document.getElementById('billing-separate').checked = true;
    this.toggleBillingSource('billing');
    this.updateBillingCardSelection(addressId, 'billing-card-');
  },

  /**
   * Update card selection styling
   */
  updateCardSelection(radioName, cardPrefix, selectedId) {
    const { selected, unselected } = this.config.classes;

    document.querySelectorAll(`[name="${radioName}"]`).forEach(radio => {
      radio.checked = false;
      const card = document.getElementById(`${cardPrefix}${radio.value}`);
      if (card) {
        card.classList.remove(...selected);
        card.classList.add(...unselected);
      }
    });

    const selectedRadio = document.getElementById(`address-${selectedId}`);
    const selectedCard = document.getElementById(`${cardPrefix}${selectedId}`);

    if (selectedRadio) selectedRadio.checked = true;
    if (selectedCard) {
      selectedCard.classList.remove(...unselected);
      selectedCard.classList.add(...selected);
    }
  },

  /**
   * Update billing card selection
   */
  updateBillingCardSelection(selectedId, selectedPrefix) {
    const { selected, unselected } = this.config.classes;

    document.querySelectorAll('[name="billing_address_id"]').forEach(radio => {
      radio.checked = false;

      ['billing-delivery-card-', 'billing-card-'].forEach(prefix => {
        const card = document.getElementById(`${prefix}${radio.value}`);
        if (card) {
          card.classList.remove(...selected);
          card.classList.add(...unselected);
        }
      });
    });

    const radioId = selectedPrefix === 'billing-delivery-card-'
      ? `billing-delivery-${selectedId}`
      : `billing-address-${selectedId}`;

    const selectedRadio = document.getElementById(radioId);
    const selectedCard = document.getElementById(`${selectedPrefix}${selectedId}`);

    if (selectedRadio) selectedRadio.checked = true;
    if (selectedCard) {
      selectedCard.classList.remove(...unselected);
      selectedCard.classList.add(...selected);
    }
  },

  /**
   * Toggle edit mode for address
   */
  editAddress(addressId, type = 'delivery') {
    const viewId = type === 'billing' ? `billing-view-${addressId}` : `address-view-${addressId}`;
    const editId = type === 'billing' ? `billing-edit-${addressId}` : `address-edit-${addressId}`;

    document.getElementById(viewId)?.classList.add('hidden');
    document.getElementById(editId)?.classList.remove('hidden');
  },

  /**
   * Cancel edit mode for address
   */
  cancelEdit(addressId, type = 'delivery') {
    const viewId = type === 'billing' ? `billing-view-${addressId}` : `address-view-${addressId}`;
    const editId = type === 'billing' ? `billing-edit-${addressId}` : `address-edit-${addressId}`;

    document.getElementById(viewId)?.classList.remove('hidden');
    document.getElementById(editId)?.classList.add('hidden');
  },

  /**
   * Toggle new address form visibility
   */
  toggleNewAddressForm(type = 'delivery') {
    const containerId = type === 'billing' ? 'new-billing-form-container' : 'new-address-form-container';
    const btnId = type === 'billing' ? 'add-billing-address-btn' : 'add-address-toggle-btn';
    const label = type === 'billing' ? 'Add billing address' : 'Add new address';

    const container = document.getElementById(containerId);
    const btn = document.getElementById(btnId);

    if (!container) return;

    const isHidden = container.classList.contains('hidden');
    container.classList.toggle('hidden');

    if (btn) {
      btn.innerHTML = isHidden ? 'Cancel' : `${this.icons.plus} ${label}`;
    }
  },

  /**
   * Toggle billing section visibility
   */
  toggleBillingSection() {
    const checkbox = document.getElementById('same-as-shipping');
    const section = document.getElementById('billing-section');

    if (checkbox && section) {
      section.classList.toggle('hidden', checkbox.checked);
    }
  },

  /**
   * Toggle billing source (delivery vs separate)
   */
  toggleBillingSource(source) {
    const deliveryList = document.getElementById('billing-delivery-list');
    const separateSection = document.getElementById('billing-separate-section');
    const addBtn = document.getElementById('add-billing-address-btn');
    const { disabled } = this.config.classes;

    if (source === 'delivery') {
      deliveryList?.classList.remove(...disabled);
      separateSection?.classList.add('hidden');
      addBtn?.classList.add('hidden');
    } else {
      deliveryList?.classList.add(...disabled);
      separateSection?.classList.remove('hidden');
      addBtn?.classList.remove('hidden');
    }
  },

  // ==================== Utilities ====================

  /**
   * Handle API errors
   */
  handleError(error, defaultMessage) {
    console.error('Address error:', error);

    if (error.errors) {
      const messages = Object.values(error.errors).flat().join('\n');
      this.showToast(messages || 'Validation error', 'error');
    } else {
      this.showToast(error.message || defaultMessage, 'error');
    }
  },

  /**
   * Reload page with optional billing state
   */
  reloadPage(type) {
    setTimeout(() => {
      if (type === 'billing') {
        const url = new URL(window.location.href);
        url.searchParams.set('billing', 'open');
        url.searchParams.set('source', 'billing');
        window.location.href = url.toString();
      } else {
        window.location.reload();
      }
    }, this.config.reloadDelay);
  },

  /**
   * Show toast notification
   */
  showToast(message, type = 'success') {
    const colors = {
      success: '#059669',
      error: '#DC2626',
      warning: '#D97706'
    };

    if (typeof Toastify !== 'undefined') {
      Toastify({
        text: message,
        duration: 3000,
        close: true,
        gravity: 'top',
        position: 'right',
        backgroundColor: colors[type] || colors.success
      }).showToast();
    } else {
      alert(message);
    }
  }
};

// Initialize on DOM ready
document.addEventListener('DOMContentLoaded', () => AddressManager.init());

// Global function aliases for onclick handlers in HTML
const selectDeliveryAddress = (id) => AddressManager.selectDeliveryAddress(id);
const selectBillingFromDelivery = (id) => AddressManager.selectBillingFromDelivery(id);
const selectBillingAddress = (id) => AddressManager.selectBillingAddress(id);
const setDefaultAddress = (id) => AddressManager.setDefault(id, 'delivery');

const setDefaultBillingAddress = (id) => AddressManager.setDefault(id, 'billing');
const deleteAddress = (id) => AddressManager.deleteAddress(id, 'delivery');
const deleteBillingAddress = (id) => AddressManager.deleteAddress(id, 'billing');
const editAddress = (id) => AddressManager.editAddress(id, 'delivery');
const editBillingAddress = (id) => AddressManager.editAddress(id, 'billing');
const cancelEditAddress = (id) => AddressManager.cancelEdit(id, 'delivery');
const cancelEditBillingAddress = (id) => AddressManager.cancelEdit(id, 'billing');
const toggleNewAddressForm = () => AddressManager.toggleNewAddressForm('delivery');
const toggleNewBillingAddressForm = () => AddressManager.toggleNewAddressForm('billing');
const handleAddressSelection = (id) => console.log('Selected address:', id);
</script>
