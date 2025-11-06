@extends('frontend.include.app')

@section('content')
<main id="main-content" role="main">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    {{-- Breadcrumb --}}
    <div class="py-4 sm:py-6">
      <x-breadcrumb title="Sale" />
    </div>

    {{-- Category Header --}}
    <section class="py-6 sm:py-8 lg:py-12" aria-labelledby="category-title">
      {{-- Title --}}
      <div class="mb-6 sm:mb-8">
        <h1 id="category-title" class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 dark:text-gray-100">
          Sale
        </h1>
      </div>

      {{-- Category Tags --}}
      @php
        $tags = ['anti-aging', 'hydration', 'vitamin-c', 'serums', 'moisturizers', 'cleansers', 'eye-care', 'treatment', 'sensitive-skin'];
      @endphp
      <nav class="mb-6 sm:mb-8" aria-label="Category filters">
        <div class="flex flex-wrap gap-2 sm:gap-3" role="list">
          @foreach($tags as $tag)
            <a
              href="{{ route('front.sales', array_merge(request()->all(), ['tag' => $tag])) }}"
              class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900 {{ request('tag') === $tag ? 'bg-orange-600 text-white hover:bg-orange-700' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700' }}"
              role="listitem"
              aria-label="Filter by {{ ucwords(str_replace('-', ' ', $tag)) }}"
              aria-current="{{ request('tag') === $tag ? 'page' : 'false' }}">
              {{ ucwords(str_replace('-', ' ', $tag)) }}
            </a>
          @endforeach
        </div>
      </nav>

      {{-- Results Count & Sort Controls --}}
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 sm:mb-8 pb-4 sm:pb-6 border-b border-gray-200 dark:border-gray-700">
        {{-- Results Count --}}
        <div class="flex items-center">
          <span class="text-sm text-gray-600 dark:text-gray-400" aria-live="polite">
            <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $prods->count() }}</span> results
          </span>
        </div>

        {{-- Sort Dropdown --}}
        <form method="GET" id="sort-form" class="flex items-center gap-2 sm:gap-3">
          @if(request('tag'))
            <input type="hidden" name="tag" value="{{ request('tag') }}">
          @endif
          <label for="sort-select" class="text-sm font-medium text-gray-700 dark:text-gray-300 whitespace-nowrap">
            Sort by
          </label>
          <select
            id="sort-select"
            name="sort"
            class="px-3 py-2 text-sm bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 dark:focus:ring-offset-gray-900 transition-colors duration-200"
            aria-label="Sort products by"
            onchange="this.form.submit()">
            <option value="popularity" {{ request('sort') == 'popularity' ? 'selected' : '' }}>Popularity</option>
            <option value="price-low" {{ request('sort') == 'price-low' ? 'selected' : '' }}>Price: Low to High</option>
            <option value="price-high" {{ request('sort') == 'price-high' ? 'selected' : '' }}>Price: High to Low</option>
          </select>
        </form>
      </div>
    </section>

    {{-- Products Grid --}}
    <div
      class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6 lg:gap-8 mb-12"
      id="products-grid"
      role="list"
      aria-label="Sale products">
      @forelse ($prods as $prod)
        <x-product-card :product="$prod" badge-type="sale" />
      @empty
        <div class="col-span-full py-12 text-center">
          <p class="text-gray-600 dark:text-gray-400 text-lg">No products found.</p>
        </div>
      @endforelse
    </div>

    {{-- Load More Section --}}
    <div class="py-8 sm:py-12 text-center border-t border-gray-200 dark:border-gray-700">
      <button
        type="button"
        class="inline-flex items-center px-6 sm:px-8 py-3 sm:py-4 bg-orange-600 text-white text-sm sm:text-base font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
        aria-label="Load more products">
        Load More Products
      </button>
      <p class="mt-4 text-sm text-gray-600 dark:text-gray-400">
        Showing <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $prods->count() }}</span> products
      </p>
    </div>

  </div>

  {{-- Join CELIGIN Promotional Banners --}}
  <x-join-celigin-banners />
</main>
@endsection

@section('scripts')
  @include('frontend.include.cart-wishlist-script')
@endSection
