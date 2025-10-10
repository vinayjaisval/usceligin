@extends('frontend.include.app')

@section('content')
<main id="main-content" role="main">
  <div class="container">

    {{-- Breadcrumb --}}
    <x-breadcrumb title="New Arrivals" />

    {{-- Category Header with Form-based Filtering --}}
    <section class="category-header-wrapper">
      <div class="category-headline">
        <h1 class="category-title">New Arrivals</h1>
      </div>

      <form id="filters-form" method="GET" action="{{ url()->current() }}">
        {{-- Category Tags as Buttons --}}
        <nav class="category-tags" aria-label="Category filters">
          <ul class="category-tags-list" role="list">
            @php
              $categories = [
                'skin-care' => 'Skin Care',
                'morning' => 'Morning',
                'night' => 'Night',
                'special-care' => 'Special Care',
                'mens-care' => "Men's Care",
                'dry-skin' => 'Dry Skin',
                'complex-skin' => 'Complex Skin',
                'sensitive-skin' => 'Sensitive Skin',
                'troubled-skin' => 'Troubled Skin'
              ];
              $currentCategory = request()->query('category');
            @endphp

            @foreach($categories as $slug => $label)
              <li>
                <button type="submit" name="category" value="{{ $slug }}"
                        class="category-tag {{ $currentCategory === $slug ? 'active' : '' }}"
                        aria-pressed="{{ $currentCategory === $slug ? 'true' : 'false' }}">
                  {{ $label }}
                </button>
              </li>
            @endforeach
            <li>
              <button type="submit" name="category" value=""
                      class="category-tag {{ empty($currentCategory) ? 'active' : '' }}"
                      aria-pressed="{{ empty($currentCategory) ? 'true' : 'false' }}">
                All
              </button>
            </li>
          </ul>
        </nav>

        {{-- Sort Controls --}}
        <div class="category-controls">
          <div class="category-results">
            <span class="products-count" aria-live="polite">{{ $latest_products->count() }} results</span>
          </div>
          <div class="category-filters">
            <label for="sort-select" class="sort-label">Sort by</label>
            <select id="sort-select" class="filter-select" name="sort" aria-label="Sort products by">
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
    <div class="products-grid" id="products-grid" role="list">
      @forelse($prods as $prod)
        <x-product-card :product="$prod" badge-type="new" />
      @empty
        <p>No products found.</p>
      @endforelse
    </div>

    {{-- Load More Section --}}
    <div class="load-more-section">
      <button class="load-more-btn" type="button">Load More Products</button>
      <p class="load-more-text">Showing {{ $latest_products->count() }} of 48 products</p>
    </div>

    {{-- CELIGIN Promotional Banners --}}
    <x-celigin-banners />
  </div>
</main>
@endsection

@section('scripts')
<script>
  document.getElementById('sort-select').addEventListener('change', function () {
    document.getElementById('filters-form').submit();
  });
</script>

<!-- Centralized Cart & Wishlist Manager -->
<script src="{{ asset('assets/frontend/js/cart-wishlist-manager.js') }}"></script>
@endSection
