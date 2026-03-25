@extends('layouts.vendor-frontend')

@section('page-title', 'Top Earning')

@section('styles')
@include('vendor.partials.datatables-styles')
<link href="{{ asset('assets/admin/css/jquery-ui.css') }}" rel="stylesheet">
<style>
  .ui-datepicker { z-index: 9999 !important; }
</style>
@endsection

@section('content')
<div class="space-y-4">

  <!-- Page Header -->
  <div>
    <h1 class="text-xl font-bold text-gray-900 dark:text-gray-100">Top Earning</h1>
    <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Track your earnings by date range</p>
  </div>

  @include('includes.admin.form-both')

  <!-- Filter Card -->
  <form action="{{ route('vendor.income') }}" method="GET" role="search" aria-label="Filter earnings by date range">
    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-4">
      <h2 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3 flex items-center gap-2">
        <span class="material-icons-outlined text-base" aria-hidden="true">date_range</span>
        Filter by Date Range
      </h2>
      <div class="flex flex-wrap items-end gap-3">
        <div class="flex-1 min-w-[180px]">
          <label for="start-date" class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Start Date</label>
          <input type="text" id="start-date" autocomplete="off"
            class="discount_date w-full border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500"
            value="{{ $start_date != '' ? $start_date->format('d-m-Y') : '' }}"
            name="start_date" placeholder="DD-MM-YYYY" aria-label="Start date (DD-MM-YYYY)">
        </div>
        <div class="flex-1 min-w-[180px]">
          <label for="end-date" class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">End Date</label>
          <input type="text" id="end-date" autocomplete="off"
            class="discount_date w-full border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500"
            value="{{ $end_date != '' ? $end_date->format('d-m-Y') : '' }}"
            name="end_date" placeholder="DD-MM-YYYY" aria-label="End date (DD-MM-YYYY)">
        </div>
        <div class="flex items-center gap-2">
          <button type="submit"
            class="inline-flex items-center gap-1.5 px-4 py-2 bg-primary-600 text-white text-sm font-medium hover:bg-primary-700 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
            <span class="material-icons-outlined text-base" aria-hidden="true">search</span>
            Filter
          </button>
          <button type="button" id="reset"
            class="inline-flex items-center gap-1.5 px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200 text-sm font-medium hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500">
            <span class="material-icons-outlined text-base" aria-hidden="true">refresh</span>
            Reset
          </button>
        </div>
      </div>
    </div>
  </form>

  <!-- Total Earning Banner -->
  @if($start_date != '' || $end_date != '')
  <div class="bg-teal-50 dark:bg-teal-900/20 border border-teal-200 dark:border-teal-800 p-4" role="status">
    <div class="flex items-center gap-3">
      <span class="material-icons-outlined text-2xl text-teal-600 dark:text-teal-400" aria-hidden="true">trending_up</span>
      <div>
        <p class="text-xs text-teal-600 dark:text-teal-400 font-medium uppercase tracking-wide">Total Earning</p>
        <p class="text-lg font-bold text-teal-700 dark:text-teal-300">
          @if($start_date != '') {{ $start_date->format('d M Y') }} @endif
          @if($start_date != '' && $end_date != '') — @endif
          @if($end_date != '') {{ $end_date->format('d M Y') }} @endif
          :
          <span class="text-xl">₹{{ $total }}</span>
        </p>
      </div>
    </div>
  </div>
  @else
  <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-5" role="status">
    <div class="flex items-center gap-4">
      <div class="w-12 h-12 bg-teal-100 dark:bg-teal-900/40 flex items-center justify-center" aria-hidden="true">
        <span class="material-icons-outlined text-2xl text-teal-600 dark:text-teal-400" aria-hidden="true">trending_up</span>
      </div>
      <div>
        <p class="text-sm text-gray-500 dark:text-gray-400">Total Earning (All Time)</p>
        <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">₹{{ $total }}</p>
      </div>
    </div>
  </div>
  @endif

  <!-- Earnings Table -->
  <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
    <div class="p-4 border-b border-gray-200 dark:border-gray-700">
      <h2 id="earnings-table-heading" class="text-base font-semibold text-gray-900 dark:text-gray-100">Earning Records</h2>
    </div>
    <div class="p-4">
      @include('includes.admin.form-success')
      <div class="overflow-x-auto">
        <table id="geniustable" class="w-full" cellspacing="0" aria-labelledby="earnings-table-heading">
          <thead>
            <tr>
              <th scope="col">{{ __('Order Number') }}</th>
              <th scope="col">{{ __('Total Earning') }}</th>
              <th scope="col">{{ __('Payment Method') }}</th>
              <th scope="col">{{ __('Txn ID') }}</th>
              <th scope="col">{{ __('Order Date') }}</th>
            </tr>
          </thead>
          <tbody>
            @foreach($datas as $data)
            <tr>
              <td>
                <a href="{{ route('vendor-order-invoice', $data->order_number) }}"
                   class="text-primary-600 dark:text-primary-400 hover:underline font-medium focus:outline-none focus:ring-2 focus:ring-primary-500">
                  {{ $data->order_number }}
                </a>
              </td>
              <td class="font-medium text-teal-600 dark:text-teal-400">
                ₹ {{ round($data->seller_commission, 2) }}
              </td>
              <td>{{ $data->method }}</td>
              <td class="text-gray-500 dark:text-gray-400 text-xs">{{ $data->txnid }}</td>
              <td>{{ $data->created_at->format('d M Y') }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/admin/js/jqueryui.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
  $('#geniustable').DataTable();

  if (typeof $.fn.datepicker !== 'undefined') {
    $('.discount_date').datepicker({
      dateFormat: 'dd-mm-yy',
      changeMonth: true,
      changeYear: true,
    });
  }

  $(document).on('click', '#reset', function() {
    $('.discount_date').val('');
    location.href = '{{ route('vendor.income') }}';
  });
</script>
@endsection
