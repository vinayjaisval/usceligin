@extends('layouts.vendor-frontend')

@section('page-title', 'All Orders')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<style>
  .dataTables_wrapper .dataTables_filter input {
    border: 1px solid #e5e7eb;
    padding: 6px 10px;
    border-radius: 0;
    outline: none;
    font-size: 13px;
  }
  .dataTables_wrapper .dataTables_length select {
    border: 1px solid #e5e7eb;
    padding: 4px 8px;
    border-radius: 0;
    font-size: 13px;
  }
  table.dataTable thead th {
    background: #f9fafb;
    color: #374151;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border-bottom: 2px solid #e5e7eb;
    padding: 10px 14px;
  }
  table.dataTable tbody td {
    padding: 10px 14px;
    font-size: 13px;
    color: #374151;
    border-bottom: 1px solid #f3f4f6;
    vertical-align: middle;
  }
  table.dataTable tbody tr:hover {
    background: #f9fafb;
  }
  .dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background: #EA580C !important;
    color: #fff !important;
    border: none !important;
    border-radius: 0 !important;
  }
  .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background: #EA580C !important;
    color: #fff !important;
    border-color: #EA580C !important;
    border-radius: 0 !important;
  }
</style>
@endsection

@section('content')
<div class="space-y-4">

  <!-- Page Header -->
  <div class="flex items-center justify-between">
    <div>
      <h1 class="text-xl font-bold text-gray-900 dark:text-gray-100">All Orders</h1>
      <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Manage and track all your customer orders</p>
    </div>
    <a href="{{ route('vendor-order-create') }}"
       class="inline-flex items-center gap-2 px-4 py-2 bg-primary-600 text-white text-sm font-medium hover:bg-primary-700 transition-colors">
      <span class="material-icons-outlined text-base">add</span>
      Add Order
    </a>
  </div>

  <!-- Orders Table Card -->
  <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
    <div class="p-4 border-b border-gray-200 dark:border-gray-700">
      <h2 class="text-base font-semibold text-gray-900 dark:text-gray-100">Order List</h2>
    </div>
    <div class="p-4">
      @include('alerts.admin.form-success')
      @include('alerts.form-success')
      <div class="overflow-x-auto">
        <table id="geniustable" class="w-full" cellspacing="0">
          <thead>
            <tr>
              <th>{{ __('Customer Email') }}</th>
              <th>{{ __('Order Number') }}</th>
              <th>{{ __('Total Qty') }}</th>
              <th>{{ __('Total Cost') }}</th>
              <th>{{ __('Total Commission') }}</th>
              <th>{{ __('Order Status') }}</th>
              <th>{{ __('Options') }}</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>

</div>

{{-- ORDER STATUS MODAL --}}
<div id="confirm-delete1" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50">
  <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 w-full max-w-md mx-4">
    <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
      <h4 class="text-base font-semibold text-gray-900 dark:text-gray-100">{{ __('Update Status') }}</h4>
      <button type="button" class="modal-close-btn p-1 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
        <span class="material-icons-outlined text-xl">close</span>
      </button>
    </div>
    <div class="p-4 space-y-3">
      <p class="text-sm text-gray-600 dark:text-gray-400 text-center">{{ __("You are about to update the order's Status.") }}</p>
      <p class="text-sm text-gray-600 dark:text-gray-400 text-center">{{ __('Do you want to proceed?') }}</p>
      <input type="hidden" id="t-add" value="{{ route('admin-order-track-add') }}">
      <input type="hidden" id="t-id" value="">
      <input type="hidden" id="t-title" value="">
      <textarea class="w-full border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 p-3 text-sm resize-none" rows="3" placeholder="{{ __('Enter Your Tracking Note (Optional)') }}" id="t-txt"></textarea>
    </div>
    <div class="p-4 border-t border-gray-200 dark:border-gray-700 flex items-center justify-center gap-3">
      <button type="button" class="modal-close-btn px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
        {{ __('Cancel') }}
      </button>
      <a class="px-4 py-2 text-sm font-medium text-white bg-green-600 hover:bg-green-700 transition-colors cursor-pointer order-btn">
        {{ __('Proceed') }}
      </a>
    </div>
  </div>
</div>

{{-- EMAIL MODAL --}}
<div id="vendorform-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50">
  <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 w-full max-w-md mx-4">
    <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
      <h5 class="text-base font-semibold text-gray-900 dark:text-gray-100">{{ __('Send Email') }}</h5>
      <button type="button" class="email-modal-close p-1 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
        <span class="material-icons-outlined text-xl">close</span>
      </button>
    </div>
    <div class="p-4">
      <form id="emailreply" class="space-y-3">
        @csrf
        <input type="email" class="w-full border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2 text-sm eml-val" id="eml" name="to" placeholder="{{ __('Email') }} *" required>
        <input type="text" class="w-full border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2 text-sm" id="subj" name="subject" placeholder="{{ __('Subject') }} *" required>
        <textarea class="w-full border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2 text-sm resize-none" name="message" id="msg" placeholder="{{ __('Your Message') }} *" rows="4" required></textarea>
        <button class="w-full px-4 py-2 bg-primary-600 text-white text-sm font-medium hover:bg-primary-700 transition-colors" id="emlsub" type="submit">{{ __('Send Email') }}</button>
      </form>
    </div>
  </div>
</div>

{{-- DETAILS MODAL --}}
<div id="modal1" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50">
  <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 w-full max-w-md mx-4">
    <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
      <h5 class="modal1-title text-base font-semibold text-gray-900 dark:text-gray-100"></h5>
      <button type="button" class="modal1-close p-1 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
        <span class="material-icons-outlined text-xl">close</span>
      </button>
    </div>
    <div class="modal1-body p-4 text-sm text-gray-700 dark:text-gray-300"></div>
    <div class="p-4 border-t border-gray-200 dark:border-gray-700 flex justify-end">
      <button type="button" class="modal1-close px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
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

  // Modal helpers
  function openModal(el) { el.classList.remove('hidden'); el.classList.add('flex'); }
  function closeModal(el) { el.classList.add('hidden'); el.classList.remove('flex'); }

  // Status update modal
  $(document).on('click', '.order-status-btn', function() {
    $('#t-id').val($(this).data('id'));
    $('#t-title').val($(this).data('status'));
    openModal(document.getElementById('confirm-delete1'));
  });
  document.querySelectorAll('.modal-close-btn').forEach(btn => {
    btn.addEventListener('click', () => closeModal(document.getElementById('confirm-delete1')));
  });

  // Email modal
  $(document).on('click', '.email-vendor-btn', function() {
    $('#eml').val($(this).data('email'));
    openModal(document.getElementById('vendorform-modal'));
  });
  document.querySelectorAll('.email-modal-close').forEach(btn => {
    btn.addEventListener('click', () => closeModal(document.getElementById('vendorform-modal')));
  });

  // Details modal
  $(document).on('click', '.details-modal-btn', function() {
    var title = $(this).data('title') || '';
    var body = $(this).data('body') || '';
    document.querySelector('.modal1-title').textContent = title;
    document.querySelector('.modal1-body').innerHTML = body;
    openModal(document.getElementById('modal1'));
  });
  document.querySelectorAll('.modal1-close').forEach(btn => {
    btn.addEventListener('click', () => closeModal(document.getElementById('modal1')));
  });

})(jQuery);
</script>
@endsection
