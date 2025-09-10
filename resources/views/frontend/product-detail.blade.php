@extends('frontend.include.app')

@section('content')
<!-- Main Content -->
<main id="main-content" role="main">
  <div class="container">
    <!-- Breadcrumb Navigation -->
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <ol class="breadcrumb-list">
        <li class="breadcrumb-item">
          <a href="index.html">Home</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          Travel Size Moroccanoil Treatment Hair Oil
        </li>
      </ol>
    </nav>

    <!-- Loading Spinner -->
    <div class="loading-section" id="loading-section">
      <div class="loading-spinner"></div>
      <p>Loading product...</p>
    </div>

    <!-- Product Detail Section -->
    <section class="product-detail" role="main">

      <!-- Free Shipping Banner -->
      <div class="free-shipping-banner">
        <span><strong>FREE SHIPPING on all Beauty Steals!®</strong></span>
        <span class="banner-note">Diamond & Platinum members only.</span>
      </div>



      <div class="product-layout">
        <!-- Product Images -->
        <div class="product-images">
          <div class="main-image">
            <img
              src="{{filter_var($productt->photo, FILTER_VALIDATE_URL) ?$productt->photo:asset('assets/images/products/'.$productt->photo)}}"
              alt="Travel Size Moroccanoil Treatment Hair Oil - Main product image"
              width="500"
              height="500" />
          </div>
          <div class="thumbnail-grid">
            @foreach($productt->galleries as $gal)
            <button
              class="thumbnail "
              aria-label="View main product image">
              <img
                src="{{asset('assets/images/galleries/'.$gal->photo)}}"
                alt="Product view 1"
                width="80"
                height="80" />
            </button>
            @endforeach
          </div>
        </div>

        <!-- Product Information -->
        <div class="product-info">
          <div class="brand-name">
            <h1 class="brand">{{ ucfirst(mb_strtolower($productt->name)) }}</h1>
          </div>
          <h2 class="product-title">
            Travel Size Moroccanoil Treatment Hair Oil
          </h2>

          <!-- Rating -->
          <div class="rating-section">
            <div class="stars" aria-label="4.5 out of 5 stars">
              <span class="star filled">{{ App\Models\Rating::ratings($productt->id) }} ★</span>
             
            </div>
            <span class="rating-number">4.5</span>
            <a href="#reviews" class="reviews-link">({{ App\Models\Rating::ratingCount($productt->id) }}) Reviews</a>
          </div>

          <!-- <div class="size-selection">
            <span class="size-label">Size</span>
          </div> -->

          <!-- Price -->
          <div class="price-section">
            <span class="current-price">{{ $productt->showPrice() }}</span>
            <div class="price-details">
              <svg
                class="info-icon"
                width="16"
                height="16"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="16" x2="12" y2="12"></line>
                <line x1="12" y1="8" x2="12.01" y2="8"></line>
              </svg>
              <span class="afterpay">Afterpay available for orders over ₹35</span>
            </div>
            <div class="loyalty-program">
              <svg
                class="crown-icon"
                width="16"
                height="16"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2">
                <path d="M2 20h20l-10-12L2 20z"></path>
                <path d="M12 8l-2-3 2-3 2 3-2 3z"></path>
              </svg>
              <span><strong>Replenish & Save</strong></span>
            </div>
            <!-- <div class="size-info">
              <span>Size: 0.68 oz</span>
            </div> -->
          </div>

          <!-- Pickup and Delivery Options -->
          <div class="fulfillment-options">
            <h3>Pickup and delivery options</h3>
            <div class="option-buttons">
              <button class="option-btn active">
                <svg
                  width="20"
                  height="20"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2">
                  <rect x="1" y="3" width="15" height="13"></rect>
                  <polygon
                    points="16,8 20,8 23,11 23,16 16,16 16,8"></polygon>
                  <circle cx="5.5" cy="18.5" r="2.5"></circle>
                  <circle cx="18.5" cy="18.5" r="2.5"></circle>
                </svg>
                <div class="option-content">
                  <span class="option-title">Ship</span>
                  <span class="option-subtitle">Free standard shipping over ₹35</span>
                </div>
              </button>

              <button class="option-btn">
                <svg
                  width="20"
                  height="20"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2">
                  <path
                    d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                  <polyline points="9,22 9,12 15,12 15,22"></polyline>
                </svg>
                <div class="option-content">
                  <span class="option-title">Pickup</span>
                  <span class="option-subtitle">Free ship to pick up</span>
                </div>
              </button>

              <button class="option-btn">
                <svg
                  width="20"
                  height="20"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2">
                  <circle cx="12" cy="12" r="10"></circle>
                  <polyline points="12,6 12,12 16,14"></polyline>
                </svg>
                <div class="option-content">
                  <span class="option-title">Same day</span>
                  <span class="option-subtitle">Free same day delivery over ₹35</span>
                </div>
              </button>
            </div>
          </div>

          <!-- Quantity and Add to Bag -->
          <div class="purchase-section">
            <div class="quantity-selection">
              <button
                class="quantity-btn minus"
                aria-label="Decrease quantity">
                <svg
                  width="16"
                  height="16"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2">
                  <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
              </button>
              <span class="quantity-display">1</span>
              <span class="quantity-label">IN BAG</span>
              <button
                class="quantity-btn plus"
                aria-label="Increase quantity">
                <svg
                  width="16"
                  height="16"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2">
                  <line x1="12" y1="5" x2="12" y2="19"></line>
                  <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
              </button>
              <button class="favorite-btn" aria-label="Add to favorites">
                <svg
                  width="20"
                  height="20"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2">
                  <path
                    d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                </svg>
              </button>
            </div>
            <p class="shipping-note">
              In stock and ready to ship. Usually ships out in 1-2 days
            </p>
          </div>

          <!-- Product Summary -->
          <div class="product-summary">
            <h3>Summary</h3>
            <div class="highlights">
              <h4>Highlights</h4>
              <div class="highlight-badges">
                <span class="badge clean">
                  <svg
                    width="16"
                    height="16"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22,4 12,14.01 9,11.01"></polyline>
                  </svg>
                  Clean Ingredients
                </span>
                <span class="badge cruelty-free">
                  <svg
                    width="16"
                    height="16"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2">
                    <path
                      d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                  </svg>
                  Cruelty Free
                </span>
                <span class="badge vegan">
                  <svg
                    width="16"
                    height="16"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2">
                    <path d="M17 8l4 4-4 4M7 8l-4 4 4 4"></path>
                    <path d="M12 2v20"></path>
                  </svg>
                  Vegan
                </span>
                <span class="badge sustainable">
                  <svg
                    width="16"
                    height="16"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2">
                    <path d="M3 12h18m-9-9v18"></path>
                  </svg>
                  Sustainable Packaging
                </span>
                <span class="badge give-back">
                  <svg
                    width="16"
                    height="16"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2">
                    <path
                      d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                  </svg>
                  Give Back
                </span>
              </div>
            </div>

            <div class="product-description">
              <p>
                Moroccanoil Treatment is an oil-infused hair treatment
                that smooths frizz, detangles, conditions, provides heat
                protection, and increases shine by up to 118%.*
              </p>
            </div>

            <!-- Expandable Sections -->
            <div class="expandable-sections">
              <button class="section-toggle" aria-expanded="false">
                <span>Details</span>
                <svg
                  width="16"
                  height="16"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2">
                  <line x1="12" y1="5" x2="12" y2="19"></line>
                  <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
              </button>
              <button class="section-toggle" aria-expanded="false">
                <span>How To Use</span>
                <svg
                  width="16"
                  height="16"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2">
                  <line x1="12" y1="5" x2="12" y2="19"></line>
                  <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
              </button>
              <button class="section-toggle" aria-expanded="false">
                <span>Ingredients</span>
                <svg
                  width="16"
                  height="16"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2">
                  <line x1="12" y1="5" x2="12" y2="19"></line>
                  <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
              </button>
            </div>
          </div>

          <!-- Frequently Bought Together -->
          <div class="frequently-bought">
            <h3>Frequently bought together</h3>
            <span class="item-count">3 items</span>
            <div class="bundle-items">
              <div class="bundle-item current">
                <input type="checkbox" id="item1" checked />
                <label for="item1">
                  <img
                    src="./assets/images/moroccanoil-small.jpg"
                    alt="Current Product"
                    width="60"
                    height="60" />
                </label>
              </div>
              <div class="bundle-item">
                <input type="checkbox" id="item2" />
                <label for="item2">
                  <div class="item-details">
                    <span class="brand">Moroccanoil</span>
                    <span class="name">Travel Size Moroccanoil Treatment Hair Oil</span>
                    <div class="rating">★★★★★</div>
                    <span class="price">₹20.00</span>
                  </div>
                  <img
                    src="./assets/images/moroccanoil-hydrating.jpg"
                    alt="High Shine Gloss Mask"
                    width="60"
                    height="60" />
                </label>
              </div>
              <div class="bundle-item">
                <input type="checkbox" id="item3" />
                <label for="item3">
                  <div class="item-details">
                    <span class="brand">Moroccanoil</span>
                    <span class="name">Frizz Shield Spray</span>
                    <div class="rating">★★★★★</div>
                    <span class="price">₹28.00</span>
                  </div>
                  <img
                    src="./assets/images/moroccanoil-spray.jpg"
                    alt="Frizz Shield Spray"
                    width="60"
                    height="60" />
                </label>
              </div>
            </div>
            <div class="bundle-total">
              <span class="original-price">Original: ₹68.00</span>
            </div>
            <a href="#" class="add-to-bag-btn">Add 3 to Bag</a>
          </div>
        </div>
      </div>

      <!-- Recommendations -->
      <section
        class="product-section"
        aria-labelledby="bestsellers-title">
        <div class="container">
          <div class="section-header">
            <h2 id="bestsellers-title">Recommendations</h2>
            <a href="/best-sellers" class="view-all-link">
              Shop all best sellers
              <svg
                width="16"
                height="16"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2">
                <line x1="7" y1="17" x2="17" y2="7"></line>
                <polyline points="7,7 17,7 17,17"></polyline>
              </svg>
            </a>
          </div>

          <div class="bestseller-swiper swiper">
            <div class="swiper-wrapper">
              <!-- Product 1 -->
              @foreach (App\Models\Product::where('type',$productt->type)->where('product_type',$productt->product_type)->withCount('ratings')
              ->withAvg('ratings','rating')->take(12)->get() as $item)

              <div class="swiper-slide">
                <article
                  class="product-card"
                  itemscope
                  itemtype="https://schema.org/Product">
                  <a
                    href="{{ route('front.product', $item->slug) }}"
                    class="product-link"
                    aria-label="View Vitamin C Brightening Serum details">
                    <div class="product-image">
                      <img
                        src="{{ $item->photo ? asset('assets/images/products/'.$item->photo):asset('assets/images/noimage.png')}}"
                        alt="Vitamin C Brightening Serum - Premium anti-aging skincare product"
                        width="300"
                        height="300" />
                      <div class="product-badges">
                        <span class="badge new">New</span>
                        <span class="badge sale">{{ round($item->offPercentage()),2}}%</span>
                      </div>
                    </div>
                    <div class="product-info">
                      <div class="product-pricing">
                        <span class="current-price" itemprop="price">{{ $item->showPrice()}}</span>
                      </div>
                      <h3 class="product-name" itemprop="name">
                        {{
                        ucfirst(mb_strtolower($item->showName()))}}
                      </h3>
                    </div>
                  </a>
                  <div class="product-actions">
                    <a
                      href="#"
                      class="wishlist-btn"
                      aria-label="Add to wishlist"
                      title="Add to Wishlist"
                      role="button">
                      <svg
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2">
                        <path
                          d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                      </svg>
                    </a>
                    <a
                      href="#"
                      class="cart-btn"
                      aria-label="Add to cart"
                      title="Add to Cart"
                      role="button">
                      <svg
                        width="18"
                        height="18"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2">
                        <path
                          d="M6 2L3 6v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6l-3-4H6z"></path>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <path
                          d="M16 10c0 2.2-1.8 4-4 4s-4-1.8-4-4"></path>
                      </svg>
                    </a>
                  </div>
                </article>
              </div>
              @endforeach
            </div>

            <!-- Navigation arrows -->
            <div
              class="swiper-button-next bestseller-nav-next"
              aria-label="Next products"></div>
            <div
              class="swiper-button-prev bestseller-nav-prev"
              aria-label="Previous products"></div>
          </div>
        </div>
      </section>

    </section>
  </div>
</main>

@endsection