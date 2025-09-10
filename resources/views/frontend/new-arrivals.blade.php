@extends('frontend.include.app')

@section('content')
<main id="main-content" role="main">
  <div class="container">
    <!-- Breadcrumb Navigation -->
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <ol class="breadcrumb-list">
        <li class="breadcrumb-item">
          <a href="{{ url('/') }}">Home</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">New Arrivals</li>
      </ol>
    </nav>

    <!-- Category Header -->
    <section class="category-header-wrapper">
      <!-- Category Title -->
      <div class="category-headline">
        <h1 class="category-title">New Arrivals</h1>
      </div>

      <!-- Filters Form -->
      <form id="filters-form" method="GET" action="{{ url()->current() }}">
        <!-- Category Tags as Buttons -->
        <nav class="category-tags" aria-label="Category filters">
          <ul class="category-tags-list" role="list">
            @php
              $categories = ['skin-care' => 'Skin Care', 'morning' => 'Morning', 'night' => 'Night', 'special-care' => 'Special Care', 'mens-care' => "Men's Care", 'dry-skin' => 'Dry Skin', 'complex-skin' => 'Complex Skin', 'sensitive-skin' => 'Sensitive Skin', 'troubled-skin' => 'Troubled Skin'];
              $currentCategory = request()->query('category');
            @endphp

            @foreach($categories as $slug => $label)
              <li>
                <button
                  type="submit"
                  name="category"
                  value="{{ $slug }}"
                  class="category-tag {{ $currentCategory === $slug ? 'active' : '' }}"
                  aria-pressed="{{ $currentCategory === $slug ? 'true' : 'false' }}"
                >
                  {{ $label }}
                </button>
              </li>
            @endforeach
            <li>
              <button
                type="submit"
                name="category"
                value=""
                class="category-tag {{ empty($currentCategory) ? 'active' : '' }}"
                aria-pressed="{{ empty($currentCategory) ? 'true' : 'false' }}"
              >
                All
              </button>
            </li>
          </ul>
        </nav>

        <!-- Sorting Dropdown -->
        <div class="category-controls">
          <div class="category-results">
            <span class="products-count" aria-live="polite">{{  $latest_products->count() }} results</span>
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

    <!-- Products Grid -->
    <div class="products-grid" id="products-grid" role="list">
      @forelse($prods as $prod)
        <article class="product-card" itemscope itemtype="https://schema.org/Product" role="listitem">
          <a href="{{ url('/item/'.$prod->slug) }}" class="product-link" aria-label="View {{ $prod->name }} details" itemprop="url">
            <div class="product-image">
              <img
                src="{{ $prod->thumbnail ? asset('assets/images/thumbnails/'.$prod->thumbnail) : asset('assets/images/noimage.png') }}"
                alt="{{ $prod->name }} - Latest breakthrough formula"
                width="300"
                height="300"
                itemprop="image"
              />
              <div class="product-badges">
                <span class="badge new">New</span>
                @if (round($prod->offPercentage()) > 0)
                  <span class="badge sale">{{ round($prod->offPercentage()) }}% off</span>
                @endif
              </div>
            </div>
            <div class="product-info">
              <div class="product-pricing">
               
                <span class="current-price" itemprop="price">{{ $prod->showPrice() }}</span>
                @if ($prod->showPreviousPrice())
                  <span class="original-price">{{ $prod->showPreviousPrice() }}</span>
                @endif
              </div>
              <h3 class="product-name" itemprop="name" title="{{ $prod->name }}">{{ ucfirst(mb_strtolower($prod->showName())) }}</h3>
            </div>
          </a>
          <div class="product-actions">
            <button class="wishlist-btn" aria-label="Add {{ $prod->name }} to wishlist" title="Add to Wishlist" type="button">
              <svg
                width="20"
                height="20"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                aria-hidden="true"
                focusable="false"
              >
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
              </svg>
            </button>
            <button class="cart-btn" aria-label="Add {{ $prod->name }} to cart" title="Add to Cart" type="button">
              <svg
                width="18"
                height="18"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                aria-hidden="true"
                focusable="false"
              >
                <path d="M6 2L3 6v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6l-3-4H6z"></path>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <path d="M16 10c0 2.2-1.8 4-4 4s-4-1.8-4-4"></path>
              </svg>
            </button>
          </div>
        </article>
      @empty
        <p>No products found.</p>
      @endforelse
    </div>

    <!-- Load More Section -->
    <div class="load-more-section">
      <button class="load-more-btn" type="button">Load More Products</button>
      <p class="load-more-text">Showing {{ $latest_products->count() }} of 48 products</p>
    </div>

    <!-- Join CELIGIN Banner -->
    <section class="join-celigin-banner">
      <div class="container">
        <div class="banner-grid">
          <div class="celigin-banner join-club">
            <img
              src="{{ asset('assets/frontend/images/join-club-banner.png') }}"
              alt="Join CELIGIN Club - Become a Brand Ambassador"
              class="banner-image"
            />
            <div class="banner-content">
              <span class="badge">JOIN CELIGIN CLUB</span>
              <h3>Become a Brand Ambassador</h3>
              <a href="{{ url('/join') }}" class="banner-btn">Join Now</a>
            </div>
          </div>

          <div class="celigin-banner cta-banner">
            <img
              src="{{ asset('assets/frontend/images/cell-education-banner.png') }}"
              alt="Cell For Education - CELIGIN Skincare Products"
              class="banner-image"
            />
            <div class="banner-content">
              <h3>Cell For Education</h3>
              <a href="{{ url('/education') }}" class="banner-btn secondary">Read More</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</main>

<!-- Auto submit on sort change -->
<script>
  document.getElementById('sort-select').addEventListener('change', function () {
    document.getElementById('filters-form').submit();
  });
</script>

@endsection
