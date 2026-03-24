@extends('layouts.vendor-frontend')

@section('page-title', 'All Orders')

@section('styles')
@include('vendor.partials.datatables-styles')
@endsection

@section('content')
<div class="space-y-4">

  <!-- Page Header -->
  <div class="flex items-center justify-between flex-wrap gap-3">
    <div>
      <h1 class="text-xl font-bold text-gray-900 dark:text-gray-100">All Orders</h1>
      <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Manage and track all your customer orders</p>
    </div>
    <a href="{{ route('vendor-order-create') }}"
       class="inline-flex items-center gap-2 px-4 py-2 bg-primary-600 text-white text-sm font-medium hover:bg-primary-700 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
      <span class="material-icons-outlined text-base" aria-hidden="true">add</span>
      Add Order
    </a>
  </div>

  <!-- Orders Table Card -->
  <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
    <div class="p-4 border-b border-gray-200 dark:border-gray-700">
      <h2 id="orders-table-heading" class="text-base font-semibold text-gray-900 dark:text-gray-100">Order List</h2>
    </div>
    <div class="p-4">
      @include('alerts.admin.form-success')
      @include('alerts.form-success')
      <div class="overflow-x-auto">
        <table id="geniustable" class="w-full" cellspacing="0" aria-labelledby="orders-table-heading">
          <thead>
            <tr>
              <th scope="col">{{ __('Customer Email') }}</th>
              <th scope="col">{{ __('Order Number') }}</th>
              <th scope="col">{{ __('Total Qty') }}</th>
              <th scope="col">{{ __('Total Cost') }}</th>
              <th scope="col">{{ __('Total Commission') }}</th>
              <th scope="col">{{ __('Payment Status') }}</th>
              <th scope="col">{{ __('Options') }}</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>

</div>

{{-- ORDER STATUS MODAL --}}
<div id="confirm-delete1"
  class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50"
  role="dialog" aria-modal="true" aria-labelledby="status-modal-title">
  <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 w-full max-w-md mx-4">
    <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
      <h2 id="status-modal-title" class="text-base font-semibold text-gray-900 dark:text-gray-100">{{ __('Update Status') }}</h2>
      <button type="button" class="modal-close-btn p-1.5 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-primary-500" aria-label="Close dialog">
        <span class="material-icons-outlined text-xl" aria-hidden="true">close</span>
      </button>
    </div>
    <div class="p-4 space-y-3">
      <p class="text-sm text-gray-600 dark:text-gray-400 text-center">{{ __("You are about to update the order's Status.") }}</p>
      <p class="text-sm text-gray-600 dark:text-gray-400 text-center">{{ __('Do you want to proceed?') }}</p>
      <input type="hidden" id="t-add" value="{{ route('admin-order-track-add') }}">
      <input type="hidden" id="t-id" value="">
      <input type="hidden" id="t-title" value="">
      <label for="t-txt" class="sr-only">Tracking note</label>
      <textarea class="w-full border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 p-3 text-sm resize-none focus:outline-none focus:ring-2 focus:ring-primary-500" rows="3" placeholder="{{ __('Enter Your Tracking Note (Optional)') }}" id="t-txt" name="t-txt"></textarea>
    </div>
    <div class="p-4 border-t border-gray-200 dark:border-gray-700 flex items-center justify-center gap-3">
      <button type="button" class="modal-close-btn px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500">
        {{ __('Cancel') }}
      </button>
      <button type="button" class="px-4 py-2 text-sm font-medium text-white bg-green-600 hover:bg-green-700 transition-colors cursor-pointer order-btn focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
        {{ __('Proceed') }}
      </button>
    </div>
  </div>
</div>

{{-- EMAIL MODAL --}}
<div id="vendorform-modal"
  class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50"
  role="dialog" aria-modal="true" aria-labelledby="email-modal-title">
  <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 w-full max-w-md mx-4">
    <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
      <h2 id="email-modal-title" class="text-base font-semibold text-gray-900 dark:text-gray-100">{{ __('Send Email') }}</h2>
      <button type="button" class="email-modal-close p-1.5 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-primary-500" aria-label="Close dialog">
        <span class="material-icons-outlined text-xl" aria-hidden="true">close</span>
      </button>
    </div>
    <div class="p-4">
      <form id="emailreply" class="space-y-3" novalidate>
        @csrf
        <div>
          <label for="eml" class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1 uppercase tracking-wide">{{ __('Email') }} <span class="text-red-500" aria-hidden="true">*</span></label>
          <input type="email" id="eml" name="to"
            class="w-full border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 eml-val"
            placeholder="{{ __('customer@example.com') }}" required aria-required="true">
        </div>
        <div>
          <label for="subj" class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1 uppercase tracking-wide">{{ __('Subject') }} <span class="text-red-500" aria-hidden="true">*</span></label>
          <input type="text" id="subj" name="subject"
            class="w-full border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500"
            placeholder="{{ __('Email subject') }}" required aria-required="true">
        </div>
        <div>
          <label for="msg" class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1 uppercase tracking-wide">{{ __('Message') }} <span class="text-red-500" aria-hidden="true">*</span></label>
          <textarea id="msg" name="message" rows="4"
            class="w-full border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2 text-sm resize-none focus:outline-none focus:ring-2 focus:ring-primary-500"
            placeholder="{{ __('Your message…') }}" required aria-required="true"></textarea>
        </div>
        <button type="submit" id="emlsub"
          class="w-full px-4 py-2 bg-primary-600 text-white text-sm font-medium hover:bg-primary-700 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
          {{ __('Send Email') }}
        </button>
      </form>
    </div>
  </div>
</div>

{{-- DETAILS MODAL --}}
<div id="modal1"
  class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50"
  role="dialog" aria-modal="true" aria-labelledby="details-modal-title">
  <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 w-full max-w-md mx-4">
    <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
      <h2 id="details-modal-title" class="modal1-title text-base font-semibold text-gray-900 dark:text-gray-100"></h2>
      <button type="button" class="modal1-close p-1.5 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-primary-500" aria-label="Close dialog">
        <span class="material-icons-outlined text-xl" aria-hidden="true">close</span>
      </button>
    </div>
    <div class="modal1-body p-4 text-sm text-gray-700 dark:text-gray-300"></div>
    <div class="p-4 border-t border-gray-200 dark:border-gray-700 flex justify-end">
      <button type="button" class="modal1-close px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500">
        {{ __('Close') }}
      </button>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
(function($) {
  "use strict";

  var table = $('#geniustable').DataTable({
    ordering: false,
    processing: true,
    serverSide: true,
    ajax: '{{ route('vendor-order-datatables','none') }}',
    columns: [
      { data: 'customer_email', name: 'customer_email' },
      { data: 'id', name: 'id' },
      { data: 'totalQty', name: 'totalQty' },
      { data: 'pay_amount', name: 'pay_amount' },
      { data: 'seller_commission', name: 'seller_commission' },
      { data: 'payment_status', name: 'payment_status' },
      { data: 'action', searchable: false, orderable: false }
    ],
  });

  // ── Modal helpers ─────────────────────────────────────────
  function openModal(el) {
    el.classList.remove('hidden');
    el.classList.add('flex');
    // Move focus to first focusable element inside modal
    const focusable = el.querySelector('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
    if (focusable) focusable.focus();
  }
  function closeModal(el, returnFocus) {
    el.classList.add('hidden');
    el.classList.remove('flex');
    if (returnFocus) returnFocus.focus();
  }

  // ── Escape key closes any open modal ─────────────────────
  document.addEventListener('keydown', function(e) {
    if (e.key !== 'Escape') return;
    ['confirm-delete1', 'vendorform-modal', 'modal1'].forEach(id => {
      const el = document.getElementById(id);
      if (el && !el.classList.contains('hidden')) el.classList.add('hidden'), el.classList.remove('flex');
    });
  });

  // ── Status update modal ───────────────────────────────────
  var statusTrigger;
  $(document).on('click', '.order-status-btn', function() {
    statusTrigger = this;
    $('#t-id').val($(this).data('id'));
    $('#t-title').val($(this).data('status'));
    openModal(document.getElementById('confirm-delete1'));
  });
  document.querySelectorAll('.modal-close-btn').forEach(btn => {
    btn.addEventListener('click', () => closeModal(document.getElementById('confirm-delete1'), statusTrigger));
  });

  // ── Email modal ───────────────────────────────────────────
  var emailTrigger;
  $(document).on('click', '.email-vendor-btn', function() {
    emailTrigger = this;
    $('#eml').val($(this).data('email'));
    openModal(document.getElementById('vendorform-modal'));
  });
  document.querySelectorAll('.email-modal-close').forEach(btn => {
    btn.addEventListener('click', () => closeModal(document.getElementById('vendorform-modal'), emailTrigger));
  });

  // ── Details modal ─────────────────────────────────────────
  var detailsTrigger;
  $(document).on('click', '.details-modal-btn', function() {
    detailsTrigger = this;
    document.querySelector('.modal1-title').textContent = $(this).data('title') || '';
    document.querySelector('.modal1-body').innerHTML = $(this).data('body') || '';
    openModal(document.getElementById('modal1'));
  });
  document.querySelectorAll('.modal1-close').forEach(btn => {
    btn.addEventListener('click', () => closeModal(document.getElementById('modal1'), detailsTrigger));
  });

})(jQuery);
</script>
@endsection
