@extends('layouts.vendor-frontend')

@section('page-title', 'Withdraw Now')

@section('content')
<div class="space-y-4">

  <!-- Page Header -->
  <div class="flex items-center justify-between">
    <div>
      <h1 class="text-xl font-bold text-gray-900 dark:text-gray-100">Withdraw Now</h1>
      <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Submit a withdrawal request from your current balance</p>
    </div>
    <a href="{{ route('vendor-wt-index') }}"
       class="inline-flex items-center gap-2 px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200 text-sm font-medium hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
      <span class="material-icons-outlined text-base">arrow_back</span>
      Back
    </a>
  </div>

  @include('alerts.admin.form-both')

  <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">

    <!-- Balance Info -->
    <div class="p-4 border-b border-gray-200 dark:border-gray-700 bg-emerald-50 dark:bg-emerald-900/20">
      <div class="flex items-center gap-3">
        <span class="material-icons-outlined text-2xl text-emerald-600 dark:text-emerald-400">account_balance_wallet</span>
        <div>
          <p class="text-xs text-emerald-600 dark:text-emerald-400 font-medium uppercase tracking-wide">Current Balance</p>
          <p class="text-xl font-bold text-emerald-700 dark:text-emerald-300">
            {{ App\Models\Product::vendorConvertPrice(Auth::user()->current_balance) }}
          </p>
        </div>
      </div>
    </div>

    <!-- Form -->
    <form id="geniusform" action="{{ route('vendor-wt-store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
      @csrf

      <!-- Withdraw Method -->
      <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
          {{ __('Withdraw Method') }} <span class="text-red-500">*</span>
        </label>
        <select class="w-full border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2.5 text-sm focus:outline-none focus:border-primary-500" name="methods" id="withmethod" required>
          <option value="">{{ __('Select Withdraw Method') }}</option>
          <option value="Paypal">{{ __('UPI') }}</option>
          <option value="Bank">{{ __('Bank') }}</option>
        </select>
      </div>

      <!-- Withdraw Amount -->
      <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
          {{ __('Withdraw Amount') }} <span class="text-red-500">*</span>
        </label>
        <input name="amount" placeholder="{{ __('Enter amount to withdraw') }}"
          class="w-full border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2.5 text-sm focus:outline-none focus:border-primary-500"
          type="text" value="{{ old('amount') }}" required>
      </div>

      <!-- UPI Fields -->
      <div id="paypal" class="hidden space-y-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
            {{ __('UPI ID') }} <span class="text-red-500">*</span>
          </label>
          <input name="acc_email" placeholder="{{ __('Enter your UPI ID') }}"
            class="w-full border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2.5 text-sm focus:outline-none focus:border-primary-500"
            type="text">
        </div>
      </div>

      <!-- Bank Fields -->
      <div id="bank" class="hidden space-y-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
            {{ __('Account Number / IBAN') }} <span class="text-red-500">*</span>
          </label>
          <input name="iban" placeholder="{{ __('Enter Account No or IBAN') }}"
            class="w-full border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2.5 text-sm focus:outline-none focus:border-primary-500"
            type="text">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
            {{ __('Swift Code') }} <span class="text-red-500">*</span>
          </label>
          <input name="swift" placeholder="{{ __('Enter Swift Code') }}"
            class="w-full border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2.5 text-sm focus:outline-none focus:border-primary-500"
            type="text">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
            {{ __('Account Name') }} <span class="text-red-500">*</span>
          </label>
          <input name="acc_name" placeholder="{{ __('Enter Account Name') }}"
            class="w-full border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2.5 text-sm focus:outline-none focus:border-primary-500"
            type="text">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
            {{ __('Account Address') }} <span class="text-red-500">*</span>
          </label>
          <input name="address" placeholder="{{ __('Enter Address') }}"
            class="w-full border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2.5 text-sm focus:outline-none focus:border-primary-500"
            type="text">
        </div>
      </div>

      <!-- Reference -->
      <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
          {{ __('Additional Reference') }} <span class="text-gray-400 font-normal">({{ __('Optional') }})</span>
        </label>
        <textarea class="w-full border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2.5 text-sm focus:outline-none focus:border-primary-500 resize-none"
          name="reference" rows="3" placeholder="{{ __('Additional Reference (Optional)') }}"></textarea>
      </div>

      <!-- Fee Notice -->
      <div class="p-3 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800">
        <div class="flex items-start gap-2">
          <span class="material-icons-outlined text-amber-600 dark:text-amber-400 text-base mt-0.5">info</span>
          <p class="text-xs text-amber-700 dark:text-amber-300">
            <strong>{{ __('Withdraw Fee:') }}</strong>
            {{ $sign->sign }}{{ $gs->withdraw_fee }} {{ __('and') }} {{ $gs->withdraw_charge }}%
            {{ __('will be deducted from your account.') }}
          </p>
        </div>
      </div>

      <hr class="border-gray-200 dark:border-gray-700">

      <div class="flex justify-end">
        <button name="addProduct_btn" type="submit"
          class="inline-flex items-center gap-2 px-6 py-2.5 bg-primary-600 text-white text-sm font-medium hover:bg-primary-700 transition-colors">
          <span class="material-icons-outlined text-base">send</span>
          {{ __('Submit Withdrawal') }}
        </button>
      </div>

    </form>
  </div>

</div>
@endsection

@section('scripts')
<script type="text/javascript">
(function($) {
  "use strict";
  $("#withmethod").change(function () {
    var method = $(this).val();
    if (method == "Bank") {
      $("#bank").removeClass('hidden').find('input, select').attr('required', true);
      $("#paypal").addClass('hidden').find('input').attr('required', false);
    } else if (method != "") {
      $("#bank").addClass('hidden').find('input, select').attr('required', false);
      $("#paypal").removeClass('hidden').find('input').attr('required', true);
    } else {
      $("#bank").addClass('hidden').find('input, select').attr('required', false);
      $("#paypal").addClass('hidden').find('input').attr('required', false);
    }
  });
})(jQuery);
</script>
@endsection
