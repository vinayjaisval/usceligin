@extends('layouts.vendor-frontend')

@section('page-title', 'POS — Sell Product')

@section('styles')
<link href="{{ asset('assets/admin/css/jquery-ui.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<style>
  /* ── Product Card ─────────────────────────────────────────── */
  .product-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    transition: border-color .2s, box-shadow .2s, transform .2s;
    cursor: pointer;
    position: relative;
  }
  @media (prefers-reduced-motion: reduce) {
    .product-card { transition: border-color .2s; }
    .product-card .card-img img { transition: none; }
  }
  .product-card:hover {
    border-color: #EA580C;
    box-shadow: 0 8px 24px -4px rgba(234,88,12,.15);
    transform: translateY(-2px);
  }
  .product-card .card-img {
    aspect-ratio: 1/1;
    overflow: hidden;
    background: #f9fafb;
    flex-shrink: 0;
  }
  .product-card .card-img img {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform .35s ease;
  }
  .product-card:hover .card-img img { transform: scale(1.07); }
  .product-card .card-body {
    padding: 10px 10px 6px;
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 4px;
  }
  .product-card .card-name {
    font-size: 12px;
    font-weight: 500;
    color: #111827;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    line-height: 1.4;
    min-height: 33px;
  }
  .product-card .card-price {
    font-size: 13px;
    font-weight: 700;
    color: #EA580C;
  }
  .product-card .card-add {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 8px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    border-top: 1px solid #f3f4f6;
    background: #f9fafb;
    color: #374151;
    transition: background .15s, color .15s;
    cursor: pointer;
    border: none;
    width: 100%;
  }
  .product-card:hover .card-add { background: #EA580C; color: #fff; border-top-color: #EA580C; }
  /* Added-to-cart badge */
  .product-card .added-badge {
    position: absolute; top: 8px; right: 8px;
    background: #16a34a; color: #fff;
    font-size: 10px; font-weight: 700;
    padding: 2px 7px; display: none;
  }
  .product-card.in-cart .added-badge { display: block; }
  .product-card.in-cart { border-color: #16a34a; }
  .product-card.in-cart .card-add { background: #f0fdf4; color: #16a34a; border-top-color: #bbf7d0; }
  .product-card:hover.in-cart .card-add { background: #16a34a; color: #fff; }

  /* ── Dark mode: Product Card ──────────────────────────────── */
  .dark .product-card { background: #1f2937; border-color: #374151; }
  .dark .product-card:hover { border-color: #EA580C; }
  .dark .product-card .card-img { background: #374151; }
  .dark .product-card .card-name { color: #f3f4f6; }
  .dark .product-card .card-price { color: #fb923c; }
  .dark .product-card .card-add { background: #374151; color: #d1d5db; border-top-color: #4b5563; }
  .dark .product-card:hover .card-add { background: #EA580C; color: #fff; }
  .dark .product-card.in-cart { border-color: #16a34a; }
  .dark .product-card.in-cart .card-add { background: #052e16; color: #4ade80; border-top-color: #166534; }
  .dark .product-card:hover.in-cart .card-add { background: #16a34a; color: #fff; }

  /* ── Skeleton loader ──────────────────────────────────────── */
  .skeleton { animation: pulse 1.5s infinite; background: #f3f4f6; }
  .dark .skeleton { background: #374151; }
  @keyframes pulse { 0%,100%{opacity:1} 50%{opacity:.5} }
  @media (prefers-reduced-motion: reduce) { .skeleton { animation: none; } }

  /* ── Pagination ───────────────────────────────────────────── */
  .page-btn {
    min-width: 32px; height: 32px;
    display: inline-flex; align-items: center; justify-content: center;
    font-size: 12px; font-weight: 500;
    border: 1px solid #e5e7eb;
    color: #374151;
    transition: all .15s;
    cursor: pointer;
  }
  .dark .page-btn { border-color: #4b5563; color: #d1d5db; }
  .page-btn:hover:not(:disabled) { border-color: #EA580C; color: #EA580C; }
  .page-btn.active { background: #EA580C; border-color: #EA580C; color: #fff; }
  .page-btn:disabled { opacity: .35; cursor: default; }

  /* ── Select2 ──────────────────────────────────────────────── */
  .select2-container--default .select2-selection--single {
    border: 1px solid #e5e7eb; border-radius: 0; height: 40px;
  }
  .select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 38px; padding-left: 12px; font-size: 13px; color: #374151;
  }
  .select2-container--default .select2-selection--single .select2-selection__arrow { height: 38px; }
  .select2-dropdown { border-radius: 0 !important; }

  /* ── Form inputs ──────────────────────────────────────────── */
  .pos-input {
    width: 100%;
    border: 1px solid #e5e7eb;
    background: #fff;
    color: #111827;
    padding: 10px 12px;
    font-size: 13px;
    outline: none;
    transition: border-color .15s;
  }
  .pos-input:focus { border-color: #EA580C; box-shadow: 0 0 0 3px rgba(234,88,12,.08); }
  .pos-input.readonly-field { background: #f9fafb; color: #6b7280; cursor: not-allowed; }
  .pos-label {
    display: block;
    font-size: 11px;
    font-weight: 600;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 5px;
  }

  /* ── Step pill ────────────────────────────────────────────── */
  .step-pill {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 4px 12px;
    font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .06em;
    border: 1.5px solid currentColor;
  }

  /* ── Sticky bottom bar (mobile) ───────────────────────────── */
  @media (max-width: 1023px) {
    #cart-fab {
      position: fixed; bottom: 20px; right: 20px; z-index: 40;
    }
  }
</style>
@endsection

@section('content')
<div class="space-y-6">

  {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
       HEADER
  ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
  <div class="flex items-center justify-between flex-wrap gap-3">
    <div>
      <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100 tracking-tight">POS - Sell Product</h1>
    </div>
    <div class="flex items-center gap-2">
      <div id="cart-count-badge" class="hidden items-center gap-2 px-3 py-2 bg-green-50 border border-green-200 text-green-700 text-sm font-semibold"
        role="status" aria-live="polite" aria-atomic="true">
        <span class="material-icons-outlined text-base" aria-hidden="true">shopping_cart</span>
        <span id="badge-count">0</span><span class="sr-only"> products</span> in cart
      </div>
      <a href="{{ route('vendor-order-index') }}"
         class="inline-flex items-center gap-1.5 px-3 py-2 border border-gray-300 dark:border-gray-600 text-gray-600 dark:text-gray-300 text-sm hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
        <span class="material-icons-outlined text-sm">arrow_back</span>
        Orders
      </a>
    </div>
  </div>

  {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
       STEP 1 — PRODUCT GRID
  ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
  <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">

    <!-- Section Header -->
    <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between gap-4 flex-wrap">
      <div class="flex items-center gap-3">
        <span class="flex items-center justify-center w-7 h-7 bg-primary-600 text-white text-xs font-bold flex-shrink-0">1</span>
        <div>
          <h2 class="text-sm font-bold text-gray-900 dark:text-gray-100">Select Products</h2>
          <p class="text-xs text-gray-500 dark:text-gray-400">Click a product card to add it to the cart</p>
        </div>
      </div>
      <!-- Search -->
      <div class="relative flex-1 max-w-xs">
        <label for="product-search" class="sr-only">Search products</label>
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" aria-hidden="true">
          <span class="material-icons-outlined text-base">search</span>
        </span>
        <input type="search" id="product-search"
          class="w-full border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 pl-9 pr-3 py-2 text-sm focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/10"
          placeholder="Search products…"
          aria-label="Search products">
      </div>
    </div>

    <!-- Product Grid -->
    <div class="p-5">
      <div id="product-grid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 xl:grid-cols-5 gap-3">
        {{-- Skeleton placeholders --}}
        @for($i = 0; $i < 10; $i++)
        <div class="border border-gray-100 overflow-hidden">
          <div class="skeleton aspect-square"></div>
          <div class="p-3 space-y-2">
            <div class="skeleton h-3 w-3/4"></div>
            <div class="skeleton h-3 w-1/2"></div>
            <div class="skeleton h-8 w-full mt-2"></div>
          </div>
        </div>
        @endfor
      </div>
    </div>

    <!-- Pagination -->
    <div class="px-5 pb-4 flex items-center justify-between flex-wrap gap-3">
      <span id="product-count-text" class="text-xs text-gray-400"></span>
      <div id="product-pagination" class="flex items-center gap-1"></div>
    </div>

  </div>

  {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
       STEP 2 + 3 — CUSTOMER FORM + CART
  ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
  <form action="{{ route('vendor-order-create-submit', ['method' => 'cod']) }}" method="POST" id="pos-form">
    @csrf
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

      {{-- ─── CUSTOMER DETAILS (2/3) ──────────────── --}}
      <div class="lg:col-span-2">
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 h-full">

          <!-- Card Header -->
          <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center gap-3">
            <span class="flex items-center justify-center w-7 h-7 bg-primary-600 text-white text-xs font-bold flex-shrink-0">2</span>
            <div>
              <h2 class="text-sm font-bold text-gray-900 dark:text-gray-100">Customer Details</h2>
              <p class="text-xs text-gray-500 dark:text-gray-400">Select existing or fill in manually</p>
            </div>
          </div>

          <div class="p-5 space-y-5">

            <!-- Existing Customer Dropdown -->
            <div>
              <label class="pos-label">
                <span class="material-icons-outlined text-xs align-middle">manage_search</span>
                Existing Customer <span class="font-normal text-gray-400 normal-case">(optional — auto-fills form)</span>
              </label>
              <select name="user_id" id="order_create_user" class="order_create_user w-full">
                <option value="">— New / Walk-in Customer —</option>
                @foreach(App\Models\User::where('seller_id', Auth::user()->id)->get() as $usr)
                  <option value="{{ $usr->id }}"
                    {{ Session::has('order_address') && Session::get('order_address')['user_id'] == $usr->id ? 'selected' : '' }}>
                    {{ $usr->name }} · {{ $usr->phone }}
                  </option>
                @endforeach
              </select>
            </div>

            <!-- Divider -->
            <div class="flex items-center gap-3">
              <div class="flex-1 border-t border-gray-100 dark:border-gray-700"></div>
              <span class="text-xs text-gray-400 uppercase tracking-wider">Contact Info</span>
              <div class="flex-1 border-t border-gray-100 dark:border-gray-700"></div>
            </div>

            <!-- Address Form -->
            <div id="order_create_user_address">
              @include('vendor.orderpos.create.address_form')
            </div>

          </div>
        </div>
      </div>

      {{-- ─── CART SUMMARY (1/3) ──────────────────── --}}
      <div class="lg:col-span-1">
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 sticky top-24">

          <!-- Card Header -->
          <div class="px-4 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center gap-3">
            <span class="flex items-center justify-center w-7 h-7 bg-primary-600 text-white text-xs font-bold flex-shrink-0">3</span>
            <div>
              <h2 class="text-sm font-bold text-gray-900 dark:text-gray-100">Cart & Confirm</h2>
              <p class="text-xs text-gray-500 dark:text-gray-400">Review before placing order</p>
            </div>
          </div>

          <!-- Cart Items -->
          <div id="view_table_order">
            @include('vendor.orderpos.create.product_add_table')
          </div>

        </div>
      </div>

    </div>
  </form>

</div>

{{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
     PRODUCT ADD MODAL
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
<div id="add-product"
  class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm p-4"
  role="dialog" aria-modal="true" aria-labelledby="add-product-title">
  <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 w-full max-w-lg max-h-[90vh] flex flex-col shadow-2xl">
    <div class="flex items-center justify-between px-5 py-4 border-b border-gray-200 dark:border-gray-700 flex-shrink-0">
      <div class="flex items-center gap-2">
        <span class="material-icons-outlined text-primary-500" aria-hidden="true">add_shopping_cart</span>
        <h2 id="add-product-title" class="text-sm font-bold text-gray-900 dark:text-gray-100">Add to Cart</h2>
      </div>
      <button type="button" id="pos-modal-close"
        class="p-1.5 text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500"
        aria-label="Close dialog">
        <span class="material-icons-outlined" aria-hidden="true">close</span>
      </button>
    </div>
    <div id="product-show" class="p-5 overflow-y-auto flex-1 text-sm text-gray-700 dark:text-gray-300">
      <div class="flex items-center justify-center py-10">
        <svg class="animate-spin h-7 w-7 text-primary-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
        </svg>
      </div>
    </div>
    <div class="px-5 py-3 border-t border-gray-200 dark:border-gray-700 flex-shrink-0">
      <button type="button" id="addProductRemoveBtn"
        class="w-full py-2.5 text-sm font-medium text-gray-600 dark:text-gray-300 border border-gray-200 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500">
        Close
      </button>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('assets/admin/js/jqueryui.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
/* ═══════════════════════════════════════════════════════════════
   POS PRODUCT BROWSER
═══════════════════════════════════════════════════════════════ */
const POS = {
  endpoint: '{{ route('vendor-order-product-datatables') }}',
  perPage: 10,
  page: 0,
  total: 0,
  search: '',
  draw: 1,
  inCartIds: new Set(),

  /* Fetch from DataTables endpoint */
  async fetch() {
    const params = new URLSearchParams({
      draw: this.draw++,
      start: this.page * this.perPage,
      length: this.perPage,
      'search[value]': this.search,
      'search[regex]': false,
      'columns[0][data]': 'name',
      'columns[0][name]': 'name',
      'columns[0][searchable]': true,
      'columns[0][orderable]': false,
      'columns[1][data]': 'action',
      'columns[1][name]': 'action',
      'columns[1][searchable]': false,
      'columns[1][orderable]': false,
    });
    const res = await fetch(`${this.endpoint}?${params}`, {
      headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
    });
    const json = await res.json();
    this.total = json.recordsFiltered || json.recordsTotal || 0;
    return json.data || [];
  },

  /* Parse server-rendered HTML row → clean object */
  parseRow(row) {
    const nd = document.createElement('div'); nd.innerHTML = row.name;
    const img = nd.querySelector('img');
    const small = nd.querySelector('small');
    const ad = document.createElement('div'); ad.innerHTML = row.action;
    const btn = ad.querySelector('.order_product_add');
    return {
      id: btn ? btn.getAttribute('data-href') : null,
      img: img ? img.src : '',
      name: img ? img.alt : nd.textContent.trim().split('\n')[0].trim(),
      price: small ? small.textContent.trim() : '',
    };
  },

  /* Render one product card */
  cardHtml(p) {
    const inCart = this.inCartIds.has(p.id);
    return `
      <div class="product-card${inCart ? ' in-cart' : ''}" data-id="${p.id}">
        <span class="added-badge">✓ Added</span>
        <div class="card-img">
          <img src="${p.img}" alt="${p.name}" loading="lazy"
               onerror="this.src='{{ asset('assets/images/noimage.png') }}'">
        </div>
        <div class="card-body">
          <div class="card-name">${p.name}</div>
          <div class="card-price">${p.price}</div>
        </div>
        <button type="button" class="card-add order_product_add" data-href="${p.id}"
          aria-label="${inCart ? 'Add more of ' + p.name : 'Add ' + p.name + ' to cart'}">
          <span class="material-icons-outlined" style="font-size:14px" aria-hidden="true">add_shopping_cart</span>
          ${inCart ? 'Add More' : 'Add to Cart'}
        </button>
      </div>`;
  },

  /* Render pagination */
  paginationHtml() {
    const totalPages = Math.ceil(this.total / this.perPage);
    if (totalPages <= 1) return '';
    const btnClass = (active, disabled) =>
      `page-btn${active ? ' active' : ''}${disabled ? ' disabled-btn' : ''}`;

    let html = `<button class="${btnClass(false, this.page===0)}" data-page="${this.page-1}" ${this.page===0?'disabled':''} aria-label="Previous page">
      <span class="material-icons-outlined" style="font-size:16px" aria-hidden="true">chevron_left</span></button>`;

    const range = Array.from({length: totalPages}, (_, i) => i)
      .filter(i => i===0 || i===totalPages-1 || Math.abs(i-this.page)<=1);

    let prev = -1;
    for (const i of range) {
      if (prev !== -1 && i - prev > 1) html += `<span class="page-btn" style="border:none;color:#9ca3af;cursor:default" aria-hidden="true">…</span>`;
      html += `<button class="${btnClass(i===this.page, false)}" data-page="${i}" aria-label="Page ${i+1}" ${i===this.page?'aria-current="page"':''}>${i+1}</button>`;
      prev = i;
    }

    html += `<button class="${btnClass(false, this.page>=totalPages-1)}" data-page="${this.page+1}" ${this.page>=totalPages-1?'disabled':''} aria-label="Next page">
      <span class="material-icons-outlined" style="font-size:16px" aria-hidden="true">chevron_right</span></button>`;
    return html;
  },

  /* Full render cycle */
  async render() {
    const grid = document.getElementById('product-grid');
    const countText = document.getElementById('product-count-text');
    const pagination = document.getElementById('product-pagination');

    // Loading skeletons
    grid.innerHTML = Array(this.perPage).fill(`
      <div class="border border-gray-100 overflow-hidden">
        <div class="skeleton aspect-square"></div>
        <div class="p-3 space-y-2">
          <div class="skeleton h-3 rounded w-3/4"></div>
          <div class="skeleton h-3 rounded w-1/2"></div>
          <div class="skeleton h-8 rounded w-full mt-2"></div>
        </div>
      </div>`).join('');

    try {
      const rows = await this.fetch();
      if (!rows.length) {
        grid.innerHTML = `<div class="col-span-full py-16 text-center text-gray-400">
          <span class="material-icons-outlined text-5xl block mb-2">inventory_2</span>
          No products found.
        </div>`;
        countText.textContent = '';
        pagination.innerHTML = '';
        return;
      }
      const start = this.page * this.perPage + 1;
      const end = Math.min(start + rows.length - 1, this.total);
      countText.textContent = `Showing ${start}–${end} of ${this.total} products`;
      grid.innerHTML = rows.map(r => this.cardHtml(this.parseRow(r))).join('');
      pagination.innerHTML = this.paginationHtml();
      this.bindPagination();
    } catch (e) {
      grid.innerHTML = `<div class="col-span-full py-8 text-center text-red-400 text-sm">Failed to load products.</div>`;
    }
  },

  bindPagination() {
    document.querySelectorAll('#product-pagination .page-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const p = parseInt(btn.dataset.page);
        if (isNaN(p) || btn.disabled) return;
        this.page = p;
        this.render();
        document.getElementById('product-grid').scrollIntoView({behavior: 'smooth', block: 'start'});
      });
    });
  },

  init() {
    this.render();

    // Search with debounce
    let debounce;
    document.getElementById('product-search').addEventListener('input', e => {
      clearTimeout(debounce);
      debounce = setTimeout(() => {
        this.search = e.target.value;
        this.page = 0;
        this.render();
      }, 350);
    });
  }
};

/* ═══════════════════════════════════════════════════════════════
   MODAL
═══════════════════════════════════════════════════════════════ */
function openModal() {
  const m = document.getElementById('add-product');
  m.classList.remove('hidden'); m.classList.add('flex');
  document.body.style.overflow = 'hidden';
}
function closeModal() {
  const m = document.getElementById('add-product');
  m.classList.add('hidden'); m.classList.remove('flex');
  document.body.style.overflow = '';
}
document.getElementById('pos-modal-close').addEventListener('click', closeModal);
document.getElementById('addProductRemoveBtn').addEventListener('click', closeModal);
document.getElementById('add-product').addEventListener('click', e => { if (e.target === e.currentTarget) closeModal(); });

/* ═══════════════════════════════════════════════════════════════
   ADD TO CART CLICK
═══════════════════════════════════════════════════════════════ */
$(document).on('click', '.order_product_add', function(e) {
  e.preventDefault();
  const productId = $(this).attr('data-href');
  openModal();
  $('#product-show').html(`
    <div class="flex items-center justify-center py-10">
      <svg class="animate-spin h-7 w-7 text-primary-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
      </svg>
    </div>`)
  .load(mainurl + '/vendor/order/create/product-show/' + productId, function() {
    // Mark card as in-cart on successful add
    POS.inCartIds.add(productId);
    updateCartBadge();
  });
});

/* ═══════════════════════════════════════════════════════════════
   REMOVE FROM CART
═══════════════════════════════════════════════════════════════ */
$(document).on('click', '.removeOrder', function(e) {
  e.preventDefault();
  if (!confirm('Remove this product from cart?')) return;
  $.ajax({
    url: $(this).attr('data-href'), type: 'GET',
    success(data) { $('#view_table_order').html(data); updateCartBadge(); }
  });
});

/* ═══════════════════════════════════════════════════════════════
   EXISTING CUSTOMER → AUTO-FILL
═══════════════════════════════════════════════════════════════ */
$(document).on('change', '#order_create_user', function() {
  const user_id = $(this).val();
  if (user_id) {
    $.ajax({
      url: mainurl + '/vendor/order/create/user-address',
      type: 'GET', data: { user_id },
      success(data) { $('#order_create_user_address').html(data); }
    });
  } else {
    $('#order_create_user_address').find('input, textarea').val('');
  }
});

/* ═══════════════════════════════════════════════════════════════
   CART BADGE COUNTER
═══════════════════════════════════════════════════════════════ */
function updateCartBadge() {
  const items = document.querySelectorAll('#view_table_order .removeOrder');
  const count = items.length;
  const badge = document.getElementById('cart-count-badge');
  const num = document.getElementById('badge-count');
  if (count > 0) {
    badge.classList.remove('hidden'); badge.classList.add('flex');
    num.textContent = count;
  } else {
    badge.classList.add('hidden'); badge.classList.remove('flex');
  }
}

/* ═══════════════════════════════════════════════════════════════
   INIT
═══════════════════════════════════════════════════════════════ */
$(document).ready(function() {
  // Select2
  $('.order_create_user').select2({
    placeholder: '— New / Walk-in Customer —',
    allowClear: true
  });

  // Boot product browser
  POS.init();

  // Initial cart badge
  updateCartBadge();
});
</script>
@endsection
