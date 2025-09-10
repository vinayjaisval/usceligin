@extends('frontend.include.app')

@section('content')
<main id="main-content" role="main">
  <div class="container">
    <!-- Breadcrumb Navigation -->
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <ol class="breadcrumb-list">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Skin Care</li>
      </ol>
    </nav>

    <!-- Category Header -->
    <section class="category-header-wrapper">
      <!-- Title -->
      <div class="category-headline">
        <h1 class="category-title">Skin Care</h1>
      </div>
      @php
            $tags = [
              'cleansers', 'serums', 'moisturizers', 'masks',
              'toners', 'eye-care', 'treatments', 'sun-protection', 'exfoliants'
            ];
          @endphp
      <!-- Tags -->
      @if (!empty($tags))
        <nav class="category-tags" aria-label="Category filters">
          <ul class="category-tags-list" role="list">
            @foreach($tags as $tag)
              <li>
                <a href="{{ url()->current() . '?tag=' . $tag }}" class="category-tag {{ request('tag') == $tag ? 'active' : '' }}" aria-label="{{ ucfirst(str_replace('-', ' ', $tag)) }}">
                  {{ ucfirst(str_replace('-', ' ', $tag)) }}
                </a>
              </li>
            @endforeach
          </ul>
        </nav>
      @endif

      <!-- Product Count & Sort -->
      <div class="category-controls">
        <div class="category-results">
          <span class="products-count" aria-live="polite">{{ $prods->total() }} results</span>
        </div>

        <div class="category-filters">
          <form method="GET" id="sortForm">
            @if(request('tag'))
              <input type="hidden" name="tag" value="{{ request('tag') }}">
            @endif
            <label for="sort-select" class="sort-label">Sort by</label>
            <select name="sort" id="sort-select" class="filter-select" onchange="document.getElementById('sortForm').submit()">
              <option value="popularity" {{ request('sort') == 'popularity' ? 'selected' : '' }}>Popularity</option>
              <option value="price-low" {{ request('sort') == 'price-low' ? 'selected' : '' }}>Price: Low to High</option>
              <option value="price-high" {{ request('sort') == 'price-high' ? 'selected' : '' }}>Price: High to Low</option>
            </select>
          </form>
        </div>
      </div>
    </section>

    <!-- Products Grid -->
    <div class="products-grid" id="products-grid">
      @forelse($prods as $prod)
        <article class="product-card" itemscope itemtype="https://schema.org/Product">
          <a href="{{ url('/products', $prod->slug) }}" class="product-link" aria-label="View {{ $prod->showName() }} details">
            <div class="product-image">
              <img src="{{ $prod->thumbnail ? asset('assets/images/thumbnails/'.$prod->thumbnail) : asset('assets/images/noimage.png') }}" alt="{{ $prod->showName() }}" width="300" height="300" />
              <div class="product-badges">
                @if($prod->is_featured)
                  <span class="badge hot">Featured</span>
                @endif
                @if (round($prod->offPercentage()) > 0)
                  <span class="badge sale">{{ round($prod->offPercentage()) }}% off</span>
                @endif
              </div>
            </div>

            <div class="product-info">
              <div class="product-pricing">
                <span class="current-price">{{ $prod->showPrice() }}</span>
                @if ($prod->showPreviousPrice())
                  <span class="original-price">{{ $prod->showPreviousPrice() }}</span>
                @endif
              </div>
              <h3 class="product-name">{{ ucfirst(mb_strtolower($prod->showName())) }}</h3>
            </div>
          </a>

          <div class="product-actions">
            <a href="#" class="wishlist-btn" aria-label="Add to wishlist" title="Add to Wishlist" role="button">
              <!-- Wishlist SVG -->
            </a>
            <a href="#" class="cart-btn" aria-label="Add to cart" title="Add to Cart" role="button">
              <!-- Cart SVG -->
            </a>
          </div>
        </article>
      @empty
        <p>No products found in this category.</p>
      @endforelse
    </div>

    <!-- Pagination -->
    <div class="pagination-wrapper">
      {{ $prods->withQueryString()->links() }}
    </div>
    <div class="load-more-section">
      <button class="load-more-btn" type="button">Load More Products</button>
      <p class="load-more-text">Showing {{ $latest_products->count() }} of 48 products</p>
    </div>
    <!-- CELIGIN Banners -->
    <section class="join-celigin-banner">
      <div class="container">
        <div class="banner-grid">
          <div class="celigin-banner join-club">
            <img src="{{ asset('assets/frontend/images/join-club-banner.png') }}" alt="Join CELIGIN Club" class="banner-image" />
            <div class="banner-content">
              <span class="badge">JOIN CELIGIN CLUB</span>
              <h3>Become a Brand Ambassador</h3>
              <a href="{{ url('/join') }}" class="banner-btn">Join Now</a>
            </div>
          </div>

          <div class="celigin-banner cta-banner">
            <img src="{{ asset('assets/frontend/images/cell-education-banner.png') }}" alt="Cell For Education" class="banner-image" />
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
@endsection
