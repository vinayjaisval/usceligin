{{-- Shared DataTables CSS — include in @section('styles') on any page using DataTables --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<style>
  /* ── Light mode ─────────────────────────────────────────── */
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
  table.dataTable tbody tr:hover { background: #f9fafb; }
  .dataTables_wrapper .dataTables_filter input,
  .dataTables_wrapper .dataTables_length select {
    border: 1px solid #e5e7eb;
    padding: 5px 10px;
    font-size: 13px;
    border-radius: 0;
    outline: none;
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

  /* ── Dark mode (Tailwind class strategy: html.dark) ─────── */
  .dark table.dataTable thead th {
    background: #374151;
    color: #d1d5db;
    border-bottom-color: #4b5563;
  }
  .dark table.dataTable tbody td {
    color: #d1d5db;
    border-bottom-color: #374151;
  }
  .dark table.dataTable tbody tr { background: #1f2937; }
  .dark table.dataTable tbody tr:hover { background: #374151; }
  .dark .dataTables_wrapper { color: #d1d5db; }
  .dark .dataTables_wrapper .dataTables_filter input,
  .dark .dataTables_wrapper .dataTables_length select {
    background: #374151;
    border-color: #4b5563;
    color: #d1d5db;
  }
  .dark .dataTables_wrapper .dataTables_info { color: #9ca3af; }
  .dark .dataTables_wrapper .dataTables_paginate .paginate_button { color: #d1d5db !important; }
  .dark .dataTables_wrapper .dataTables_paginate .paginate_button.disabled { color: #6b7280 !important; }
</style>
