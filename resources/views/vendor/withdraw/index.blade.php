@extends('layouts.vendor-frontend')

@section('page-title', 'Withdraw')

@section('styles')
@include('vendor.partials.datatables-styles')
@endsection

@section('content')
<div class="space-y-4">

  <!-- Page Header -->
  <div class="flex items-center justify-between flex-wrap gap-3">
    <div>
      <h1 class="text-xl font-bold text-gray-900 dark:text-gray-100">My Withdrawals</h1>
      <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">View and manage your withdrawal requests</p>
    </div>
    <a href="{{ route('vendor-wt-create') }}"
       class="inline-flex items-center gap-2 px-4 py-2 bg-primary-600 text-white text-sm font-medium hover:bg-primary-700 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
      <span class="material-icons-outlined text-base" aria-hidden="true">add</span>
      Withdraw Now
    </a>
  </div>

  <!-- Balance Card -->
  <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-5">
    <div class="flex items-center gap-4">
      <div class="w-12 h-12 bg-emerald-100 dark:bg-emerald-900/40 flex items-center justify-center" aria-hidden="true">
        <span class="material-icons-outlined text-2xl text-emerald-600 dark:text-emerald-400" aria-hidden="true">account_balance_wallet</span>
      </div>
      <div>
        <p class="text-sm text-gray-500 dark:text-gray-400">Current Balance</p>
        <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">
          {{ App\Models\Product::vendorConvertPrice(auth()->user()->current_balance) }}
        </p>
      </div>
    </div>
  </div>

  <!-- Withdrawals Table -->
  <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
    <div class="p-4 border-b border-gray-200 dark:border-gray-700">
      <h2 id="withdrawals-table-heading" class="text-base font-semibold text-gray-900 dark:text-gray-100">Withdrawal History</h2>
    </div>
    <div class="p-4">
      @include('alerts.admin.form-success')
      <div class="overflow-x-auto">
        <table id="geniustable" class="w-full" cellspacing="0" aria-labelledby="withdrawals-table-heading">
          <thead>
            <tr>
              <th scope="col">{{ __('Withdraw Date') }}</th>
              <th scope="col">{{ __('Method') }}</th>
              <th scope="col">{{ __('Account') }}</th>
              <th scope="col">{{ __('Amount') }}</th>
              <th scope="col">{{ __('Status') }}</th>
            </tr>
          </thead>
          <tbody>
            @foreach($withdraws as $withdraw)
            <tr>
              <td>{{ date('d M Y', strtotime($withdraw->created_at)) }}</td>
              <td>{{ $withdraw->method }}</td>
              <td>{{ $withdraw->method != 'Bank' ? $withdraw->acc_email : $withdraw->iban }}</td>
              <td class="font-medium">{{ $sign->sign }}{{ round($withdraw->amount * $sign->value, 2) }}</td>
              <td>
                @php
                  $statusColors = [
                    'pending'  => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400',
                    'approved' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
                    'rejected' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
                  ];
                  $statusColor = $statusColors[strtolower($withdraw->status)]
                    ?? 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300';
                @endphp
                <span class="inline-flex items-center px-2.5 py-0.5 text-xs font-medium {{ $statusColor }}">
                  {{ ucfirst($withdraw->status) }}
                </span>
              </td>
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
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
  (function($) {
    "use strict";
    $('#geniustable').DataTable({ ordering: false });
  })(jQuery);
</script>
@endsection
