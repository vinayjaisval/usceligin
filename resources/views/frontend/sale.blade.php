@extends('frontend.include.app')

@section('content')

 @php
    $tags = \App\Models\Tag::all();
@endphp
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

     <form id="filters-form" method="GET" action="{{ url()->current() }}">
        {{-- Category Tags as Buttons --}}
        <nav class="mb-6 sm:mb-8" aria-label="Category filters">
          <div class="flex flex-wrap gap-2 sm:gap-3" role="list">

            <button
              type="submit"
              name="tags"
              value=""
              class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 dark:focus:ring-offset-gray-900 {{ empty($currentCategory) ? 'bg-primary-600 text-white hover:bg-primary-700' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700' }}"
              aria-pressed="{{ empty($currentCategory) ? 'true' : 'false' }}"
              role="listitem">
              All
            </button>

            @foreach($tags as $tag)
            <button
              type="submit"
              name="tags"
              value="{{ $tag->slug }}"
              class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 dark:focus:ring-offset-gray-900 {{ isset($currentCategory) && $currentCategory === $tag->slug ? 'bg-primary-600 text-white hover:bg-primary-700' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700' }}"
              aria-pressed="{{ isset($currentCategory) && $currentCategory === $tag->slug ? 'true' : 'false' }}"
              role="listitem">
              {{ $tag->name }}
            </button>
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
          <div class="flex items-center gap-2 sm:gap-3">
            <label for="sort-select" class="text-sm font-medium text-gray-700 dark:text-gray-300 whitespace-nowrap">
              Sort by
            </label>
            <select
              id="sort-select"
              name="sort"
              class="px-3 py-2 text-sm bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-primary-600 focus:border-primary-600 dark:focus:ring-offset-gray-900 transition-colors duration-200"
              aria-label="Sort products by"
              onchange="this.form.submit()">
              @php
              $currentSort = request()->query('sort', 'popularity');
              @endphp
              <option value="popularity" {{ $currentSort === 'popularity' ? 'selected' : '' }}>Popularity</option>
              <option value="price-low" {{ $currentSort === 'price-low' ? 'selected' : '' }}>Price: Low to High</option>
              <option value="price-high" {{ $currentSort === 'price-high' ? 'selected' : '' }}>Price: High to Low</option>
            </select>
          </div>
        </div>
      </form>
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
        class="inline-flex items-center px-6 sm:px-8 py-3 sm:py-4 bg-primary-600 text-white text-sm sm:text-base font-semibold hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 dark:focus:ring-offset-gray-900 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
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