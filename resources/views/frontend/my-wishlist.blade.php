@extends('frontend.include.app')

@section('content')
<!-- Main Content -->
<main id="main-content" role="main">
  <div class="container">

    <!-- Breadcrumb Navigation -->
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <ol class="breadcrumb-list">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">My Wishlist</li>
      </ol>
    </nav>

    <!-- Category Header -->
    <section class="category-header-wrapper">

      <!-- Title -->
      <div class="category-headline">
        <h1 class="category-title">My Wishlist</h1>
      </div>

      <!-- Tags -->
      <nav class="category-tags" aria-label="Category filters">
        <ul class="category-tags-list" role="list">
          @php
            $tags = ['Skin Care', 'Morning', 'Night', 'Special Care', 'Men\'s Care', 'Dry Skin', 'Complex Skin', 'Sensitive Skin', 'Troubled Skin'];
          @endphp
          @foreach ($tags as $tag)
          <li>
            <a href="#{{ Str::slug($tag) }}" class="category-tag" aria-label="{{ $tag }}">{{ $tag }}</a>
          </li>
          @endforeach
        </ul>
      </nav>

      <!-- Controls -->
      <div class="category-controls">
        <div class="category-results">
          <span class="products-count" aria-live="polite">
            {{ is_array($oldCart) ? count($oldCart) : 0 }} results
          </span>
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

    </section>

    <!-- Dynamic Loader -->
    <div class="loading-section" id="loading-section">
      <div class="loading-spinner"></div>
      <p>Loading wishlist...</p>
    </div>

    <!-- Wishlist Products -->
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
            <a href="javascript:void(0);" class="cart-btn add-to-cart-btn"
              data-id="{{ $prod['id'] }}"
              aria-label="Add to cart"
              title="Add to Cart">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2">
                <path d="M6 2L3 6v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6l-3-4H6z"></path>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <path d="M16 10c0 2.2-1.8 4-4 4s-4-1.8-4-4"></path>
              </svg>
            </a>
          </div>
        </article>
        @endforeach
      @else
        <p>No items in your wishlist.</p>
      @endif
    </div>

    <!-- Load More -->
    <div class="load-more-section">
      <button class="load-more-btn">Load More Products</button>
      <p class="load-more-text">Showing 12 of {{ is_array($oldCart) ? count($oldCart) : 0 }} products</p>
    </div>

  </div>

  <!-- Join CELIGIN Banner -->
  <section class="join-celigin-banner">
    <div class="container">
      <div class="banner-grid">

        <div class="celigin-banner join-club">
          <img src="{{ asset('assets/frontend/images/join-club-banner.png') }}"
            alt="Join CELIGIN Club" class="banner-image" />
          <div class="banner-content">
            <span class="badge">JOIN CELIGIN CLUB</span>
            <h3>Become a Brand Ambassador</h3>
            <a href="/join" class="banner-btn">Join Now</a>
          </div>
        </div>

        <div class="celigin-banner cta-banner">
          <img src="{{ asset('assets/frontend/images/cell-education-banner.png') }}"
            alt="Cell For Education" class="banner-image" />
          <div class="banner-content">
            <h3>Cell For Education</h3>
            <a href="/education" class="banner-btn secondary">Read More</a>
          </div>
        </div>

      </div>
    </div>
  </section>

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

    const csrfToken = '{{ csrf_token() }}';

    function handleAction(url, successCallback) {
      fetch(url, {
        method: 'GET',
        headers: { 'X-CSRF-TOKEN': csrfToken }
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          toastr.success(data.message || 'Success');
          successCallback(data);
        } else {
          toastr.warning(data.message || 'Something went wrong.');
        }
      })
      .catch(error => {
        console.error('Request Error:', error);
        toastr.error('Unexpected error occurred.');
      });
    }

    // Add to cart
    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
      button.addEventListener('click', function (e) {
        e.preventDefault();
        const productId = this.dataset.id;
        handleAction(`/celiginus/addcart/${productId}`, data => {
          if (data.cart_count !== undefined) {
            const cartCountEl = document.getElementById('cart-count');
            if (cartCountEl) cartCountEl.innerText = data.cart_count;
          }
        });
      });
    });

    // Add to wishlist (if you include the buttons)
    document.querySelectorAll('.add-wishlist-btn').forEach(button => {
      button.addEventListener('click', function (e) {
        e.preventDefault();
        const productId = this.dataset.id;
        handleAction(`/celiginus/addwishlist/${productId}`, data => {
          if (data.wishlist_count !== undefined) {
            const wishCountEl = document.getElementById('wishlist-count');
            if (wishCountEl) wishCountEl.innerText = data.wishlist_count;
          }
        });
      });
    });

  });
</script>
@endsection
