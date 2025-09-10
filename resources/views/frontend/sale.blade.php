@extends('frontend.include.app')

@section('content')
<main id="main-content" role="main">
  <div class="container">

    <!-- Breadcrumb -->
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <ol class="breadcrumb-list">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Best Sellers</li>
      </ol>
    </nav>

    <!-- Category Header -->
    <section class="category-header-wrapper">
      <!-- Row 1: Title -->
      <div class="category-headline">
        <h1 class="category-title">Sale</h1>
      </div>

      <!-- Row 2: Tags -->
      <nav class="category-tags" aria-label="Category filters">
        <ul class="category-tags-list" role="list">
          @php
            $tags = ['anti-aging', 'hydration', 'vitamin-c', 'serums', 'moisturizers', 'cleansers', 'eye-care', 'treatment', 'sensitive-skin'];
          @endphp
          @foreach($tags as $tag)
            <li>
              <a href="{{ route('front.sales', array_merge(request()->all(), ['tag' => $tag])) }}"
                 class="category-tag {{ request('tag') === $tag ? 'active' : '' }}">
                {{ ucwords(str_replace('-', ' ', $tag)) }}
              </a>
            </li>
          @endforeach
        </ul>
      </nav>

      <!-- Row 3: Sort Dropdown -->
      <div class="category-controls">
        <div class="category-results">
          <span class="products-count" aria-live="polite">{{ $prods->count() }} results</span>
        </div>
        <div class="category-filters">
          <form method="GET" id="sort-form">
            @if(request('tag'))
              <input type="hidden" name="tag" value="{{ request('tag') }}">
            @endif
            <label for="sort-select" class="sort-label">Sort by</label>
            <select id="sort-select" name="sort" class="filter-select" onchange="document.getElementById('sort-form').submit()">
              <option value="popularity" {{ request('sort') == 'popularity' ? 'selected' : '' }}>Popularity</option>
              <option value="price-low" {{ request('sort') == 'price-low' ? 'selected' : '' }}>Price: Low to High</option>
              <option value="price-high" {{ request('sort') == 'price-high' ? 'selected' : '' }}>Price: High to Low</option>
            </select>
          </form>
        </div>
      </div>
    </section>

    <!-- Product Grid -->
    <div class="products-grid" id="products-grid">
      @forelse ($prods as $prod)
        <article class="product-card" itemscope itemtype="https://schema.org/Product">
          <a href="{{ url('/products/' . $prod->slug) }}" class="product-link">
            <div class="product-image">
              <img src="{{ $prod->thumbnail ? asset('assets/images/thumbnails/'.$prod->thumbnail) : asset('assets/images/noimage.png') }}" width="300" height="300">
              <div class="product-badges">
                  <span class="badge sale">45% Off</span>
                  <span class="badge hot">Final Sale</span>
                </div>
            </div>
            <div class="product-info">
              <div class="product-pricing">
              <span class="current-price" itemprop="price">{{ $prod->showPrice() }}</span>
                @if ($prod->showPreviousPrice())
                  <span class="original-price">{{ $prod->showPreviousPrice() }}</span>
                @endif
              </div>
              <h3 class="product-name">{{ $prod->name }}</h3>
            </div>
          </a>
        </article>
      @empty
        <p>No products found.</p>
      @endforelse
    </div>

    <!-- Load More Placeholder -->
    <div class="load-more-section">
    <button class="load-more-btn" type="button">Load More Products</button>

      <p class="load-more-text">Showing {{ $prods->count() }} products</p>
    </div>

  </div>

  <section class="join-celigin-banner">
        <div class="container">
          <div class="banner-grid">
            <div class="celigin-banner join-club">
              <img 
                src="{{asset('assets/frontend/images/join-club-banner.png')}}" 
                alt="Join CELIGIN Club - Become a Brand Ambassador"
                class="banner-image"
              />
              <div class="banner-content">
                <span class="badge">JOIN CELIGIN CLUB</span>
                <h3>Become a Brand Ambassador</h3>
                <a href="/join" class="banner-btn">Join Now</a>
              </div>
            </div>

            <div class="celigin-banner cta-banner">
              <img 
                src="{{asset('assets/frontend/images/cell-education-banner.png')}}" 
                alt="Cell For Education - CELIGIN Skincare Products"
                class="banner-image"
              />
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
