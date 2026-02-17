@extends('layouts.vendor-frontend')

@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">

  <!-- Stats Cards Grid -->
  @php
    $statsCards = [
      ['label' => 'Orders Pending', 'value' => count($pending), 'icon' => 'pending_actions', 'color' => 'amber', 'link' => route('vendor-order-index')],
      ['label' => 'Orders Processing', 'value' => count($processing), 'icon' => 'autorenew', 'color' => 'blue', 'link' => route('vendor-order-index')],
      ['label' => 'Orders Completed', 'value' => count($completed), 'icon' => 'check_circle', 'color' => 'green', 'link' => route('vendor-order-index')],
      ['label' => 'Total Products', 'value' => count($totalproducts), 'icon' => 'inventory_2', 'color' => 'purple', 'link' => route('vendor-prod-index')],
      ['label' => 'Total Items Sold', 'value' => App\Models\Order::where('seller_id', '=', $user->id)->where('status', '=', 'completed')->sum('totalQty'), 'icon' => 'shopping_bag', 'color' => 'pink'],
      ['label' => 'Current Balance', 'value' => App\Models\Product::vendorConvertPrice(auth()->user()->current_balance), 'icon' => 'account_balance_wallet', 'color' => 'emerald', 'isCurrency' => true],
    ];

    // Calculate earnings
    $datas = App\Models\Order::where('seller_id', Auth::user()->id);
    $totalPrice = $datas->count() > 0 ? $datas->sum('pay_amount') : 0;
    $discountOrCalculation = $totalPrice > 20000 ? $totalPrice * 0.05 : $totalPrice * 0.02;

    $statsCards[] = ['label' => 'Total Earning', 'value' => $discountOrCalculation, 'icon' => 'trending_up', 'color' => 'teal', 'isCurrency' => true];
    $statsCards[] = ['label' => 'Pending Commission', 'value' => App\Models\Product::vendorConvertPrice($user->admin_commission), 'icon' => 'payments', 'color' => 'orange', 'isCurrency' => true];
    $statsCards[] = ['label' => 'Total Customers', 'value' => App\Models\Order::where('seller_id', Auth::user()->id)->count('seller_id'), 'icon' => 'people', 'color' => 'indigo'];

    $colorClasses = [
      'amber' => 'bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-400 border-amber-200 dark:border-amber-800',
      'blue' => 'bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 border-blue-200 dark:border-blue-800',
      'green' => 'bg-green-50 dark:bg-green-900/20 text-green-600 dark:text-green-400 border-green-200 dark:border-green-800',
      'purple' => 'bg-purple-50 dark:bg-purple-900/20 text-purple-600 dark:text-purple-400 border-purple-200 dark:border-purple-800',
      'pink' => 'bg-pink-50 dark:bg-pink-900/20 text-pink-600 dark:text-pink-400 border-pink-200 dark:border-pink-800',
      'emerald' => 'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 border-emerald-200 dark:border-emerald-800',
      'teal' => 'bg-teal-50 dark:bg-teal-900/20 text-teal-600 dark:text-teal-400 border-teal-200 dark:border-teal-800',
      'orange' => 'bg-orange-50 dark:bg-orange-900/20 text-orange-600 dark:text-orange-400 border-orange-200 dark:border-orange-800',
      'indigo' => 'bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-400 border-indigo-200 dark:border-indigo-800',
    ];

    $iconBgClasses = [
      'amber' => 'bg-amber-100 dark:bg-amber-900/40',
      'blue' => 'bg-blue-100 dark:bg-blue-900/40',
      'green' => 'bg-green-100 dark:bg-green-900/40',
      'purple' => 'bg-purple-100 dark:bg-purple-900/40',
      'pink' => 'bg-pink-100 dark:bg-pink-900/40',
      'emerald' => 'bg-emerald-100 dark:bg-emerald-900/40',
      'teal' => 'bg-teal-100 dark:bg-teal-900/40',
      'orange' => 'bg-orange-100 dark:bg-orange-900/40',
      'indigo' => 'bg-indigo-100 dark:bg-indigo-900/40',
    ];
  @endphp

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach($statsCards as $card)
      <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-5 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
          <div class="flex-1">
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">{{ $card['label'] }}</p>
            <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">
              @if(isset($card['isCurrency']))
                {{ is_numeric($card['value']) ? number_format($card['value'], 2) : $card['value'] }}
              @else
                {{ $card['value'] }}
              @endif
            </p>
            @if(isset($card['link']))
              <a href="{{ $card['link'] }}" class="text-xs text-primary-600 dark:text-primary-400 hover:underline mt-2 inline-block">
                View All
              </a>
            @endif
          </div>
          <div class="w-12 h-12 {{ $iconBgClasses[$card['color']] }} flex items-center justify-center flex-shrink-0">
            <span class="material-icons-outlined text-2xl {{ str_replace(['bg-', 'border-'], 'text-', explode(' ', $colorClasses[$card['color']])[0]) }} {{ explode(' ', $colorClasses[$card['color']])[1] }}">{{ $card['icon'] }}</span>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  <!-- Two Column Layout: Recent Products & Orders -->
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    <!-- Recent Products -->
    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
      <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Recent Products</h2>
        <a href="{{ route('vendor-prod-index') }}" class="text-sm text-primary-600 dark:text-primary-400 hover:underline">
          View All
        </a>
      </div>

      <div class="overflow-x-auto">
        @if(count($pproducts) > 0)
          <table class="w-full">
            <thead class="bg-gray-50 dark:bg-gray-700/50">
              <tr>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Product</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Category</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Price</th>
                <th class="px-4 py-3 text-right text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Action</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
              @foreach($pproducts as $data)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                  <td class="px-4 py-3">
                    <div class="flex items-center gap-3">
                      <img src="{{ filter_var($data->photo, FILTER_VALIDATE_URL) ? $data->photo : asset('assets/images/products/' . $data->photo) }}"
                           alt="{{ $data->name }}"
                           class="w-10 h-10 object-cover bg-gray-100 dark:bg-gray-700">
                      <span class="text-sm text-gray-900 dark:text-gray-100 line-clamp-1">
                        {{ Str::limit(strip_tags($data->name), 30) }}
                      </span>
                    </div>
                  </td>
                  <td class="px-4 py-3">
                    <span class="text-sm text-gray-600 dark:text-gray-400">{{ $data->category->name }}</span>
                  </td>
                  <td class="px-4 py-3">
                    <span class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $data->showPrice() }}</span>
                  </td>
                  <td class="px-4 py-3 text-right">
                    <a href="{{ route('vendor-prod-edit', $data->id) }}"
                       class="inline-flex items-center gap-1 text-xs text-primary-600 dark:text-primary-400 hover:underline">
                      <span class="material-icons-outlined text-sm">visibility</span>
                      Details
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @else
          <div class="p-8 text-center">
            <span class="material-icons-outlined text-4xl text-gray-300 dark:text-gray-600 mb-2">inventory_2</span>
            <p class="text-sm text-gray-500 dark:text-gray-400">No products yet</p>
          </div>
        @endif
      </div>
    </div>

    <!-- Recent Orders -->
    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
      <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Recent Orders</h2>
        <a href="{{ route('vendor-order-index') }}" class="text-sm text-primary-600 dark:text-primary-400 hover:underline">
          View All
        </a>
      </div>

      <div class="overflow-x-auto">
        @if(count($rorders) > 0)
          <table class="w-full">
            <thead class="bg-gray-50 dark:bg-gray-700/50">
              <tr>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Order #</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Date</th>
                <th class="px-4 py-3 text-right text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Action</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
              @foreach($rorders as $data)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                  <td class="px-4 py-3">
                    <span class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $data->order_number }}</span>
                  </td>
                  <td class="px-4 py-3">
                    <span class="text-sm text-gray-600 dark:text-gray-400">{{ date('M d, Y', strtotime($data->created_at)) }}</span>
                  </td>
                  <td class="px-4 py-3 text-right">
                    <a href="{{ route('vendor-order-show', $data->id) }}"
                       class="inline-flex items-center gap-1 text-xs text-primary-600 dark:text-primary-400 hover:underline">
                      <span class="material-icons-outlined text-sm">visibility</span>
                      Details
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @else
          <div class="p-8 text-center">
            <span class="material-icons-outlined text-4xl text-gray-300 dark:text-gray-600 mb-2">receipt_long</span>
            <p class="text-sm text-gray-500 dark:text-gray-400">No orders yet</p>
          </div>
        @endif
      </div>
    </div>

  </div>

  <!-- Sales Chart -->
  <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
    <div class="p-4 border-b border-gray-200 dark:border-gray-700">
      <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Total Sales in Last 30 Days</h2>
    </div>
    <div class="p-4">
      <canvas id="salesChart" height="100"></canvas>
    </div>
  </div>

</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('salesChart').getContext('2d');

    const isDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const gridColor = isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)';
    const textColor = isDark ? '#9CA3AF' : '#6B7280';

    new Chart(ctx, {
      type: 'line',
      data: {
        labels: [{!! $days !!}],
        datasets: [{
          label: 'Sales',
          data: [{!! $sales !!}],
          borderColor: '#EA580C',
          backgroundColor: 'rgba(234, 88, 12, 0.1)',
          borderWidth: 2,
          fill: true,
          tension: 0.4,
          pointBackgroundColor: '#EA580C',
          pointBorderColor: '#fff',
          pointBorderWidth: 2,
          pointRadius: 4,
          pointHoverRadius: 6
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
          legend: {
            display: false
          }
        },
        scales: {
          x: {
            grid: {
              color: gridColor
            },
            ticks: {
              color: textColor
            }
          },
          y: {
            beginAtZero: true,
            grid: {
              color: gridColor
            },
            ticks: {
              color: textColor
            }
          }
        }
      }
    });
  });
</script>
@endsection
