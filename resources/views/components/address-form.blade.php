@props(['address' => null, 'formId' => 'addressForm', 'showCancel' => false])

<form id="{{ $formId }}" class="space-y-4" onsubmit="return false;">
  @csrf

  @if($address)
  <input type="hidden" name="address_id" value="{{ $address->id }}">
  @endif

  <!-- Full Name -->
  <div>
    <label for="{{ $formId }}_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
      Full Name <span class="text-red-600">*</span>
    </label>
    <input
      type="text"
      id="{{ $formId }}_name"
      name="name"
      value="{{ $address->name ?? (Auth::check() ? Auth::user()->name : '') }}"
      required
      class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
      aria-required="true" />
  </div>

  <!-- Phone Number -->
  <div>
    <label for="{{ $formId }}_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
      Phone Number <span class="text-red-600">*</span>
    </label>
    <input
      type="tel"
      id="{{ $formId }}_phone"
      name="phone"
      value="{{ $address->phone ?? (Auth::check() ? Auth::user()->phone : '') }}"
      required
      placeholder="+919999499035"
      maxlength="15"
      class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
      aria-required="true" />
  </div>

  <!-- Pincode -->
  <div>
    <label for="{{ $formId }}_pincode" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
      Pincode <span class="text-red-600">*</span>
    </label>
    <input
      type="text"
      id="{{ $formId }}_pincode"
      name="pincode"
      value="{{ $address->pincode ?? '' }}"
      required
      maxlength="6"
      pattern="[0-9]{6}"
      class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
      aria-required="true"
      onkeyup="fetchPincodeDetails('{{ $formId }}')" />
  </div>

  <!-- Address Line 1 -->
  <div>
    <label for="{{ $formId }}_address_line_1" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
      Flat, House no., Building, Company, Apartment <span class="text-red-600">*</span>
    </label>
    <input
      type="text"
      id="{{ $formId }}_address_line_1"
      name="address_line_1"
      value="{{ $address->address_line_1 ?? '' }}"
      required
      class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
      aria-required="true" />
  </div>

  <!-- Address Line 2 -->
  <div>
    <label for="{{ $formId }}_address_line_2" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
      Area, Street, Sector, Village
    </label>
    <input
      type="text"
      id="{{ $formId }}_address_line_2"
      name="address_line_2"
      value="{{ $address->address_line_2 ?? '' }}"
      class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" />
  </div>

  <!-- City, State, Country Grid -->
  <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

    <!-- City -->
    <div>
      <label for="{{ $formId }}_city" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
        City/District <span class="text-red-600">*</span>
      </label>
      <input
        type="text"
        id="{{ $formId }}_city"
        name="city"
        value="{{ $address->city ?? '' }}"
        required
        readonly
        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-300"
        aria-required="true" />
    </div>

    <!-- State -->
    <div>
      <label for="{{ $formId }}_state" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
        State <span class="text-red-600">*</span>
      </label>
      <input
        type="text"
        id="{{ $formId }}_state"
        name="state"
        value="{{ $address->state ?? '' }}"
        required
        readonly
        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-300"
        aria-required="true" />
    </div>

    <!-- Country -->
    <div>
      <label for="{{ $formId }}_country" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
        Country
      </label>
      <input
        type="text"
        id="{{ $formId }}_country"
        name="country"
        value="India"
        readonly
        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-300" />
    </div>
  </div>

  <!-- Make Default Checkbox -->
  <div class="flex items-start space-x-2">
    <input
      type="checkbox"
      id="{{ $formId }}_is_default"
      name="is_default"
      value="1"
      {{ ($address && $address->is_default) ? 'checked' : '' }}
      class="mt-1 w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" />
    <label for="{{ $formId }}_is_default" class="text-sm text-gray-700 dark:text-gray-300 cursor-pointer">
      Make this my default delivery address
    </label>
  </div>

  <!-- Form Buttons -->
  <div class="flex gap-3">
    <button
      type="submit"
      class="px-6 py-2 bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
      {{ $address ? 'Update Address' : 'Use This Address' }}
    </button>

    @if($showCancel)
    <button
      type="button"
      onclick="cancelAddressForm()"
      class="px-6 py-2 bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100 text-sm font-semibold hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors">
      Cancel
    </button>
    @endif
  </div>
</form>
