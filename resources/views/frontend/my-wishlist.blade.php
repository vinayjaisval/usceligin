@extends('frontend.include.app')

@section('content')
<main id="main-content" role="main">
  <div class="container">

    {{-- Breadcrumb --}}
    <x-breadcrumb title="My Wishlist" />

    {{-- Category Header --}}
    @php
      $tags = ['Skin Care', 'Morning', 'Night', 'Special Care', 'Men\'s Care', 'Dry Skin', 'Complex Skin', 'Sensitive Skin', 'Troubled Skin'];
    @endphp
    <x-category-header
      title="My Wishlist"
      :results-count="is_array($oldCart) ? count($oldCart) : 0"
      :show-sort="false">
      <x-slot:tags>
        @foreach ($tags as $tag)
          <li>
            <a href="#{{ Str::slug($tag) }}" class="category-tag" aria-label="{{ $tag }}">
              {{ $tag }}
            </a>
          </li>
        @endforeach
      </x-slot:tags>
    </x-category-header>

    {{-- Add non-functional sort dropdown manually (UI only) --}}
    <div class="category-controls" style="margin-top: -2rem;">
      <div class="category-results" style="visibility: hidden;">
        <span class="products-count"></span>
      </div>
      <div class="category-filters">
        <label for="sort-select" class="sort-label">Sort by</label>
        <select id="sort-select" class="filter-select" aria-label="Sort products by">
          <option value="popularity">Popularity</option>
          <option value="price-low">Price: Low to High</option>
          <option value="price-high">Price: High to Low</option>
        </select>
      </div>
    </div>

    {{-- Loading Spinner --}}
    <div class="loading-section" id="loading-section">
      <div class="loading-spinner"></div>
      <p>Loading wishlist...</p>
    </div>

    {{-- Wishlist Products --}}
    <div class="products-grid" id="products-grid" style="display: none;">
      @if (!empty($oldCart) && is_array($oldCart) && count($oldCart))
        @foreach($oldCart as $prod)
          <article class="product-card" itemscope itemtype="https://schema.org/Product">
            <a href="{{ url('/item/'.$prod['slug']) }}" class="product-link">
              <div class="product-image">
                <img
                  src="{{ $prod['photo'] ? asset('assets/images/products/'.$prod['photo']) : asset('assets/images/noimage.png') }}"
                  alt="{{ $prod['name'] }}"
                  width="300" height="300" />
                <div class="product-badges">
                  <span class="badge new">New</span>
                  <span class="badge sale">15% Off</span>
                </div>
              </div>
              <div class="product-info">
                <div class="product-pricing">
                  <span class="current-price" itemprop="price">₹ {{ $prod['price'] }}</span>
                </div>
                <h3 class="product-name" itemprop="name">{{ ucfirst(mb_strtolower($prod['name'])) }}</h3>
              </div>
            </a>
            <div class="product-actions">
              <x-cart-button :product-id="$prod['id']" />
            </div>
          </article>
        @endforeach
      @else
        <p>No items in your wishlist.</p>
      @endif
    </div>

    {{-- Load More --}}
    <div class="load-more-section">
      <button class="load-more-btn">Load More Products</button>
      <p class="load-more-text">Showing 12 of {{ is_array($oldCart) ? count($oldCart) : 0 }} products</p>
    </div>

  </div>

  {{-- CELIGIN Promotional Banners --}}
  <x-celigin-banners />
</main>
@endsection

@section('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Hide loader and show products
    const loader = document.getElementById('loading-section');
    const grid = document.getElementById('products-grid');
    if (grid && loader) {
      setTimeout(() => {
        loader.style.display = 'none';
        grid.style.display = 'grid';
      }, 800); // Simulate delay for UX
    }
  });
</script>

<!-- Centralized Cart & Wishlist Manager -->
<script src="{{ asset('assets/frontend/js/cart-wishlist-manager.js') }}"></script>
@endsection
