@extends('frontend.include.app')

@section('content')
<main id="main-content" role="main">
  <div class="container">

    {{-- Breadcrumb --}}
    <x-breadcrumb title="Best Sellers" />

    {{-- Category Header --}}
    @php
      $tags = ['anti-aging', 'hydration', 'vitamin-c', 'serums', 'moisturizers', 'cleansers', 'eye-care', 'treatment', 'sensitive-skin'];
    @endphp
    <x-category-header title="Best Sellers" :results-count="$prods->count()">
      <x-slot:tags>
        @foreach($tags as $tag)
          <li>
            <a href="{{ route('front.best-sellers', array_merge(request()->all(), ['tag' => $tag])) }}"
               class="category-tag {{ request('tag') === $tag ? 'active' : '' }}">
              {{ ucwords(str_replace('-', ' ', $tag)) }}
            </a>
          </li>
        @endforeach
      </x-slot:tags>
    </x-category-header>

    {{-- Product Grid --}}
    <div class="products-grid" id="products-grid">
      @forelse ($prods as $prod)
        <x-product-card :product="$prod" badge-type="bestseller" />
      @empty
        <p>No products found.</p>
      @endforelse
    </div>

    {{-- Load More Placeholder --}}
    <div class="load-more-section">
      <button class="load-more-btn">Load More Products</button>
      <p class="load-more-text">Showing {{ $prods->count() }} products</p>
    </div>

  </div>

  {{-- CELIGIN Promotional Banners --}}
  <x-celigin-banners />
</main>
@endsection

@section('scripts')
<!-- Centralized Cart & Wishlist Manager -->
<script src="{{ asset('assets/frontend/js/cart-wishlist-manager.js') }}"></script>
@endSection
