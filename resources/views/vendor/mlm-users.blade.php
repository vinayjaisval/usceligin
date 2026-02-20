@extends('layouts.vendor-frontend')

@section('page-title', 'Customers')

@section('styles')
<style>
  /* ── Referral tree connector lines ─────────────────────── */
  .tree-node { position: relative; padding-left: 24px; }
  .tree-node::before {
    content: '';
    position: absolute; left: 0; top: 0; bottom: 0;
    border-left: 2px solid #e5e7eb;
  }
  .tree-node::after {
    content: '';
    position: absolute; left: 0; top: 20px;
    width: 20px; border-top: 2px solid #e5e7eb;
  }
  .tree-node:last-child::before { height: 20px; }

  /* Dark mode tree lines */
  .dark .tree-node::before { border-left-color: #4b5563; }
  .dark .tree-node::after  { border-top-color: #4b5563; }
</style>
@endsection

@section('content')
<div class="space-y-4">

  <!-- Page Header -->
  <div>
    <h1 class="text-xl font-bold text-gray-900 dark:text-gray-100">Customers</h1>
    <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">View your customer network and referral tree</p>
  </div>

  <!-- Stats -->
  <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-5">
    <div class="flex items-center gap-4">
      <div class="w-12 h-12 bg-indigo-100 dark:bg-indigo-900/40 flex items-center justify-center" aria-hidden="true">
        <span class="material-icons-outlined text-2xl text-indigo-600 dark:text-indigo-400" aria-hidden="true">people</span>
      </div>
      <div>
        <p class="text-sm text-gray-500 dark:text-gray-400" id="customer-count-label">Total Customers</p>
        <p class="text-2xl font-bold text-gray-900 dark:text-gray-100" aria-labelledby="customer-count-label">{{ count($users) }}</p>
      </div>
    </div>
  </div>

  <!-- Customer List -->
  <section class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700" aria-labelledby="customer-network-heading">
    <div class="p-4 border-b border-gray-200 dark:border-gray-700">
      <h2 id="customer-network-heading" class="text-base font-semibold text-gray-900 dark:text-gray-100">Customer Network</h2>
    </div>

    @if(count($users) > 0)
      <!-- Table View -->
      <div class="overflow-x-auto">
        <table class="w-full" aria-labelledby="customer-network-heading">
          <thead class="bg-gray-50 dark:bg-gray-700/50">
            <tr>
              <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">#</th>
              <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Name</th>
              <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Email</th>
              <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Phone</th>
              <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Joined</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @foreach($users as $index => $customer)
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
              <td class="px-4 py-3 text-sm text-gray-500 dark:text-gray-400">{{ $index + 1 }}</td>
              <td class="px-4 py-3">
                <div class="flex items-center gap-3">
                  <div class="w-8 h-8 bg-indigo-100 dark:bg-indigo-900/40 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-sm font-bold uppercase" aria-hidden="true">
                    {{ substr($customer['name'] ?? 'U', 0, 1) }}
                  </div>
                  <span class="text-sm font-medium text-gray-900 dark:text-gray-100">
                    {{ $customer['name'] ?? 'N/A' }}
                  </span>
                </div>
              </td>
              <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-400">{{ $customer['email'] ?? 'N/A' }}</td>
              <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-400">{{ $customer['phone'] ?? 'N/A' }}</td>
              <td class="px-4 py-3 text-sm text-gray-500 dark:text-gray-400">
                {{ isset($customer['created_at']) ? \Carbon\Carbon::parse($customer['created_at'])->format('d M Y') : 'N/A' }}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <!-- Network Tree View -->
      <div class="p-4 border-t border-gray-200 dark:border-gray-700">
        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4 flex items-center gap-2" id="referral-tree-heading">
          <span class="material-icons-outlined text-base" aria-hidden="true">account_tree</span>
          Referral Tree View
        </h3>
        <div class="overflow-x-auto" role="tree" aria-labelledby="referral-tree-heading">
          @php
            $buildTree = function ($users, $parentId = null) use (&$buildTree) {
              $children = array_filter($users, fn($u) => $u['reffered_by'] == $parentId);
              if (empty($children)) return '';
              $html = '<ul class="space-y-2 mt-2" role="group">';
              foreach ($children as $user) {
                $html .= '<li class="tree-node" role="treeitem">';
                $html .= '<div class="inline-flex items-center gap-2 px-3 py-1.5 bg-indigo-50 dark:bg-indigo-900/20 border border-indigo-200 dark:border-indigo-800 text-sm text-indigo-700 dark:text-indigo-300">';
                $html .= '<span class="material-icons-outlined text-sm" aria-hidden="true">person</span>';
                $html .= htmlspecialchars($user['name']);
                $html .= '</div>';
                $html .= $buildTree($users, $user['id']);
                $html .= '</li>';
              }
              $html .= '</ul>';
              return $html;
            };
            echo $buildTree($users->toArray());
          @endphp
        </div>
      </div>

    @else
      <div class="p-12 text-center" role="status">
        <span class="material-icons-outlined text-5xl text-gray-300 dark:text-gray-600 mb-3 block" aria-hidden="true">people_outline</span>
        <h3 class="text-base font-medium text-gray-700 dark:text-gray-300 mb-1">No Customers Yet</h3>
        <p class="text-sm text-gray-500 dark:text-gray-400">Customers who sign up through your referral will appear here.</p>
      </div>
    @endif

  </section>

</div>
@endsection
