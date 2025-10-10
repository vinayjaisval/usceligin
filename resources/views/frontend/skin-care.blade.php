@extends('frontend.include.app')

@section('content')
<main id="main-content" role="main">
  <div class="container">

    {{-- Breadcrumb --}}
    <x-breadcrumb title="Skin Care" />

    {{-- Category Header --}}
    @php
      $tags = ['cleansers', 'serums', 'moisturizers', 'masks', 'toners', 'eye-care', 'treatments', 'sun-protection', 'exfoliants'];
    @endphp
    <x-category-header title="Skin Care" :results-count="$prods->total()" sort-form-id="sortForm">
      <x-slot:tags>
        @foreach($tags as $tag)
          <li>
            <a href="{{ url()->current() . '?tag=' . $tag }}"
               class="category-tag {{ request('tag') == $tag ? 'active' : '' }}"
               aria-label="{{ ucfirst(str_replace('-', ' ', $tag)) }}">
              {{ ucfirst(str_replace('-', ' ', $tag)) }}
            </a>
          </li>
        @endforeach
      </x-slot:tags>
    </x-category-header>

    {{-- Products Grid --}}
    <div class="products-grid" id="products-grid">
      @forelse($prods as $prod)
        <x-product-card :product="$prod" badge-type="featured" />
      @empty
        <p>No products found in this category.</p>
      @endforelse
    </div>

    {{-- Pagination --}}
    <div class="pagination-wrapper">
      {{ $prods->withQueryString()->links() }}
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
<!-- Centralized Cart & Wishlist Manager -->
<script src="{{ asset('assets/frontend/js/cart-wishlist-manager.js') }}"></script>
@endSection
