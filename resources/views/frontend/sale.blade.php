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
          <a href="{{ url('/item', $prod->slug) }}" class="product-link">
            <div class="product-image">
              <img src="{{ $prod->thumbnail ? asset('assets/images/thumbnails/'.$prod->thumbnail) : asset('assets/images/noimage.png') }}" width="300" height="300">
              <div class="product-badges">
              @if (round($prod->offPercentage()) > 0)
                <span class="badge sale">{{ round($prod->offPercentage()) }}% off</span>
              @endif
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
          <div class="product-actions">
          <a href="#" class="wishlist-btn add-wishlist-btn" data-id="{{ $prod->id }}" aria-label="Add to wishlist" title="Add to Wishlist" role="button">
             
              <svg
                  width="20"
                  height="20"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                >
                  <path
                    d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"
                  ></path>
                </svg>
              </a>
              <a href="javascript:void(0);" class="cart-btn add-to-cart-btn"
                  data-id="{{ $prod->id }}"
                  aria-label="Add to cart"
                  title="Add to Cart"
                  role="button">
              
              <svg
                  width="18"
                  height="18"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                >
                  <path
                    d="M6 2L3 6v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6l-3-4H6z"
                  ></path>
                  <line x1="3" y1="6" x2="21" y2="6"></line>
                  <path d="M16 10c0 2.2-1.8 4-4 4s-4-1.8-4-4"></path>
                </svg>
              </a>
            </div>
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

@section('scripts')

<script>
  document.getElementById('sort-select').addEventListener('change', function () {
    document.getElementById('filters-form').submit();
  });
</script>



<script>
  document.addEventListener('DOMContentLoaded', function () {

    const csrfToken = '{{ csrf_token() }}'; // Store once, use multiple times

    // Utility function to handle fetch requests
    function handleAction(url, successCallback) {
      fetch(url, {
        method: 'GET',
        headers: {
          'X-CSRF-TOKEN': csrfToken
        }
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

    // Add to Cart
    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
      button.addEventListener('click', function (e) {
        e.preventDefault();
        const productId = this.dataset.id;
        handleAction(`/celiginus/addcart/${productId}`, data => {
          if (data.cart_count !== undefined) {
            document.getElementById('cart-count').innerText = data.cart_count;
          }
        });
      });
    });

    // Add to Wishlist
    document.querySelectorAll('.add-wishlist-btn').forEach(button => {
      button.addEventListener('click', function (e) {
        e.preventDefault();
        const productId = this.dataset.id;
        handleAction(`/celiginus/addwishlist/${productId}`, data => {
          if (data.wishlist_count !== undefined) {
            document.getElementById('wishlist-count').innerText = data.wishlist_count;
          }
        });
      });
    });

  });
</script>

@endSection

