@props(['address' => null, 'formId' => 'addressForm', 'showCancel' => false, 'category' => 'delivery'])

@php
  $inputClass = 'w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 text-sm focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-colors';
  $readonlyClass = 'w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-300 text-sm';
  $labelClass = 'block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1';
@endphp

<form id="{{ $formId }}" class="space-y-4" novalidate>
  @csrf

  {{-- Hidden fields --}}
  <input type="hidden" name="address_category" value="{{ $category }}">
  @if($address)
    <input type="hidden" name="address_id" value="{{ $address->id }}">
  @endif

  {{-- Address Type --}}
  <div>
    <span class="{{ $labelClass }}">
      Address Type <span class="text-red-600" aria-hidden="true">*</span>
    </span>
    <div class="flex gap-4 mt-1" role="radiogroup" aria-label="Address type">
      @foreach(['home' => 'Home', 'work' => 'Work', 'other' => 'Other'] as $val => $label)
        <label class="flex items-center gap-1.5 cursor-pointer text-sm text-gray-700 dark:text-gray-300">
          <input
            type="radio"
            name="type"
            value="{{ $val }}"
            {{ ($address->type ?? 'home') === $val ? 'checked' : '' }}
            class="w-4 h-4 text-primary-700 border-gray-300 dark:border-gray-600 focus:ring-primary-600" />
          {{ $label }}
        </label>
      @endforeach
    </div>
  </div>

  {{-- Full Name --}}
  <div>
    <label for="{{ $formId }}_name" class="{{ $labelClass }}">
      Full Name <span class="text-red-600" aria-hidden="true">*</span>
      <span class="sr-only">(required)</span>
    </label>
    <input
      type="text"
      id="{{ $formId }}_name"
      name="name"
      value="{{ $address->name ?? (Auth::check() ? Auth::user()->name : '') }}"
      required
      autocomplete="name"
      class="{{ $inputClass }}"
      aria-required="true" />
  </div>

  {{-- Phone Number — +91 prefix + 10 digits --}}
  <div>
    <label for="{{ $formId }}_phone" class="{{ $labelClass }}">
      Phone Number <span class="text-red-600" aria-hidden="true">*</span>
      <span class="sr-only">(required, 10 digits)</span>
    </label>
    <div class="flex">
      <span class="inline-flex items-center px-3 py-2 border border-r-0 border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-600 text-gray-600 dark:text-gray-400 text-sm font-medium select-none"
            aria-hidden="true">+91</span>
      <input
        type="tel"
        id="{{ $formId }}_phone"
        name="phone"
        value="{{ $address->phone ?? (Auth::check() ? Auth::user()->phone : '') }}"
        required
        maxlength="10"
        minlength="10"
        pattern="[0-9]{10}"
        inputmode="numeric"
        placeholder="Enter 10-digit number"
        class="{{ $inputClass }}"
        aria-required="true"
        aria-describedby="{{ $formId }}_phone_hint" />
    </div>
    <p id="{{ $formId }}_phone_hint" class="mt-1 text-xs text-gray-500 dark:text-gray-400">10-digit mobile number without country code</p>
  </div>

  {{-- Pincode — triggers city/state auto-fill --}}
  <div>
    <label for="{{ $formId }}_pincode" class="{{ $labelClass }}">
      Pincode <span class="text-red-600" aria-hidden="true">*</span>
      <span class="sr-only">(required, 6 digits)</span>
    </label>
    <input
      type="text"
      id="{{ $formId }}_pincode"
      name="pincode"
      value="{{ $address->pincode ?? '' }}"
      required
      maxlength="6"
      pattern="[0-9]{6}"
      inputmode="numeric"
      placeholder="6-digit pincode"
      class="{{ $inputClass }}"
      aria-required="true"
      onkeyup="fetchPincodeDetails('{{ $formId }}')" />
  </div>

  {{-- Address Line 1 --}}
  <div>
    <label for="{{ $formId }}_address_line_1" class="{{ $labelClass }}">
      Flat, House no., Building, Company, Apartment <span class="text-red-600" aria-hidden="true">*</span>
      <span class="sr-only">(required)</span>
    </label>
    <input
      type="text"
      id="{{ $formId }}_address_line_1"
      name="address_line_1"
      value="{{ $address->address_line_1 ?? '' }}"
      required
      autocomplete="address-line1"
      class="{{ $inputClass }}"
      aria-required="true" />
  </div>

  {{-- Address Line 2 --}}
  <div>
    <label for="{{ $formId }}_address_line_2" class="{{ $labelClass }}">
      Area, Street, Sector, Village <span class="text-gray-400 dark:text-gray-500 font-normal text-xs">(Optional)</span>
    </label>
    <input
      type="text"
      id="{{ $formId }}_address_line_2"
      name="address_line_2"
      value="{{ $address->address_line_2 ?? '' }}"
      autocomplete="address-line2"
      class="{{ $inputClass }}" />
  </div>

  {{-- City / State / Country --}}
  <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
    <div>
      <label for="{{ $formId }}_city" class="{{ $labelClass }}">
        City / District <span class="text-red-600" aria-hidden="true">*</span>
      </label>
      <input
        type="text"
        id="{{ $formId }}_city"
        name="city"
        value="{{ $address->city ?? '' }}"
        required
        readonly
        placeholder="Auto-filled"
        class="{{ $readonlyClass }}"
        aria-required="true"
        aria-describedby="{{ $formId }}_geo_hint" />
    </div>

    <div>
      <label for="{{ $formId }}_state" class="{{ $labelClass }}">
        State <span class="text-red-600" aria-hidden="true">*</span>
      </label>
      <input
        type="text"
        id="{{ $formId }}_state"
        name="state"
        value="{{ $address->state ?? '' }}"
        required
        readonly
        placeholder="Auto-filled"
        class="{{ $readonlyClass }}"
        aria-required="true" />
    </div>

    <div>
      <label for="{{ $formId }}_country" class="{{ $labelClass }}">Country</label>
      <input
        type="text"
        id="{{ $formId }}_country"
        name="country"
        value="{{ $address->country ?? 'India' }}"
        readonly
        class="{{ $readonlyClass }}" />
    </div>
  </div>
  <p id="{{ $formId }}_geo_hint" class="text-xs text-gray-400 dark:text-gray-500 -mt-2">City and state are auto-filled from your pincode</p>

  {{-- Make Default --}}
  <div class="flex items-start gap-2">
    <input
      type="checkbox"
      id="{{ $formId }}_is_default"
      name="is_default"
      value="1"
      {{ ($address && $address->is_default) ? 'checked' : '' }}
      class="mt-0.5 w-4 h-4 text-primary-600 border-gray-300 dark:border-gray-600 focus:ring-primary-600 dark:bg-gray-700" />
    <label for="{{ $formId }}_is_default" class="text-sm text-gray-700 dark:text-gray-300 cursor-pointer">
      Make this my default address
    </label>
  </div>

  {{-- Buttons --}}
  <div class="flex gap-3 pt-1">
    <button
      type="submit"
      class="px-6 py-2 bg-primary-800 text-white text-sm font-semibold hover:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-primary-600 transition-colors">
      {{ $address ? 'Update Address' : 'Save Address' }}
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
