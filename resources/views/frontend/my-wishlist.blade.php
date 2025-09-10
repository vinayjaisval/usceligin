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
            <li class="breadcrumb-item active" aria-current="page">My wishlist</li>
          </ol>
        </nav>

        <!-- Category Header - 3 Row Grid Layout -->
        <section class="category-header-wrapper">
          <!-- Row 1: Category Title -->
          <div class="category-headline">
            <h1 class="category-title">My Wishlist</h1>
          </div>
          
          <!-- Row 2: Category Tags -->
          <nav class="category-tags" aria-label="Category filters">
            <ul class="category-tags-list" role="list">
              

              <li><a href="#skin-care" class="category-tag" aria-label="Skin Care">Skin Care</a></li>
              <li><a href="#morning"  class="category-tag" aria-label="Morning">Morning</a></li>
              <li><a href="#night"  class="category-tag" aria-label="Night">Night</a></li>
              <li><a href="#special-care"  class="category-tag" aria-label="Special Care">Special Care</a></li>
              <li><a href="#mens-care"  class="category-tag" aria-label="mens-care">Men's Care</a></li>
              <li><a href="#dry-skin"  class="category-tag" aria-label="dry-skin">Dry Skin</a></li>
              <li><a href="#complex-skin"  class="category-tag" aria-label="complex-skin">Complex Skin</a></li>
              <li><a href="#sensitive-skin"  class="category-tag" aria-label="sensitive-skin">Sensitive Skin</a></li>
              <li><a href="#troubled-skin"  class="category-tag" aria-label="troubled-skin">Troubled Skin</a></li>

            </ul>
          </nav>
          
          <!-- Row 3: Results Count & Filter Dropdown (2 columns) -->
          <div class="category-controls">
            <div class="category-results">
              <span class="products-count" aria-live="polite">48 results</span>
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

        <!-- Loading Spinner -->
        <div class="loading-section" id="loading-section">
          <div class="loading-spinner"></div>
          <p>Loading new arrivals...</p>
        </div>

        <!-- Products Grid -->
        <div class="products-grid" id="products-grid">
          <!-- Product 1 -->
          <article class="product-card" itemscope itemtype="https://schema.org/Product">
            <a href="/products/advanced-vitamin-c-serum" class="product-link" aria-label="View Advanced Vitamin C Serum details">
              <div class="product-image">
                <img
                  src="./assets/images/sample-prodcut-image.png"
                  alt="Advanced Vitamin C Serum - Latest breakthrough formula"
                  width="300"
                  height="300"
                />
                <div class="product-badges">
                  <span class="badge new">New</span>
                  <span class="badge sale">15% Off</span>
                </div>
              </div>
              <div class="product-info">
                <div class="product-pricing">
                  <span class="current-price" itemprop="price">$42.99</span>
                  <span class="original-price">$49.99</span>
                </div>
                <h3 class="product-name" itemprop="name">Advanced Vitamin C Serum</h3>
              </div>
            </a>
            <div class="product-actions">
              <a href="#" class="wishlist-btn" aria-label="Add to wishlist" title="Add to Wishlist" role="button">
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
              <a href="#" class="cart-btn" aria-label="Add to cart" title="Add to Cart" role="button">
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

          <!-- Product 2 -->
          <article class="product-card" itemscope itemtype="https://schema.org/Product">
            <a href="/products/ultra-hydrating-night-cream" class="product-link" aria-label="View Ultra Hydrating Night Cream details">
              <div class="product-image">
                <img
                  src="./assets/images/sample-prodcut-image.png"
                  alt="Ultra Hydrating Night Cream - New premium formula"
                  width="300"
                  height="300"
                />
                <div class="product-badges">
                  <span class="badge new">New</span>
                </div>
              </div>
              <div class="product-info">
                <div class="product-pricing">
                  <span class="current-price" itemprop="price">$59.99</span>
                </div>
                <h3 class="product-name" itemprop="name">Ultra Hydrating Night Cream</h3>
              </div>
            </a>
            <div class="product-actions">
              <a href="#" class="wishlist-btn" aria-label="Add to wishlist" title="Add to Wishlist" role="button">
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
              <a href="#" class="cart-btn" aria-label="Add to cart" title="Add to Cart" role="button">
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

          <!-- Product 3 -->
          <article class="product-card" itemscope itemtype="https://schema.org/Product">
            <a href="/products/brightening-eye-treatment" class="product-link" aria-label="View Brightening Eye Treatment details">
              <div class="product-image">
                <img
                  src="./assets/images/sample-prodcut-image.png"
                  alt="Brightening Eye Treatment - Revolutionary new formula"
                  width="300"
                  height="300"
                />
                <div class="product-badges">
                  <span class="badge new">New</span>
                  <span class="badge sale">20% Off</span>
                </div>
              </div>
              <div class="product-info">
                <div class="product-pricing">
                  <span class="current-price" itemprop="price">$35.99</span>
                  <span class="original-price">$44.99</span>
                </div>
                <h3 class="product-name" itemprop="name">Brightening Eye Treatment</h3>
              </div>
            </a>
            <div class="product-actions">
              <a href="#" class="wishlist-btn" aria-label="Add to wishlist" title="Add to Wishlist" role="button">
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
              <a href="#" class="cart-btn" aria-label="Add to cart" title="Add to Cart" role="button">
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

          <!-- Product 4 -->
          <article class="product-card" itemscope itemtype="https://schema.org/Product">
            <a href="/products/gentle-foam-cleanser" class="product-link" aria-label="View Gentle Foam Cleanser details">
              <div class="product-image">
                <img
                  src="./assets/images/sample-prodcut-image.png"
                  alt="Gentle Foam Cleanser - New gentle formula"
                  width="300"
                  height="300"
                />
                <div class="product-badges">
                  <span class="badge hot">HOT</span>
                </div>
              </div>
              <div class="product-info">
                <div class="product-pricing">
                  <span class="current-price" itemprop="price">$24.99</span>
                </div>
                <h3 class="product-name" itemprop="name">Gentle Foam Cleanser</h3>
              </div>
            </a>
            <div class="product-actions">
              <a href="#" class="wishlist-btn" aria-label="Add to wishlist" title="Add to Wishlist" role="button">
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
              <a href="#" class="cart-btn" aria-label="Add to cart" title="Add to Cart" role="button">
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

          <!-- Product 5 -->
          <article class="product-card" itemscope itemtype="https://schema.org/Product">
            <a href="/products/retinol-renewal-serum" class="product-link" aria-label="View Retinol Renewal Serum details">
              <div class="product-image">
                <img
                  src="./assets/images/sample-prodcut-image.png"
                  alt="Retinol Renewal Serum - Latest breakthrough anti-aging"
                  width="300"
                  height="300"
                />
                <div class="product-badges">
                  <span class="badge hot">HOT</span>
                  <span class="badge sale">50% Off</span>
                </div>
              </div>
              <div class="product-info">
                <div class="product-pricing">
                  <span class="current-price" itemprop="price">$67.99</span>
                  <span class="original-price">$89.99</span>
                </div>
                <h3 class="product-name" itemprop="name">Retinol Renewal Serum</h3>
              </div>
            </a>
            <div class="product-actions">
              <a href="#" class="wishlist-btn" aria-label="Add to wishlist" title="Add to Wishlist" role="button">
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
              <a href="#" class="cart-btn" aria-label="Add to cart" title="Add to Cart" role="button">
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

          <!-- Product 6 -->
          <article class="product-card" itemscope itemtype="https://schema.org/Product">
            <a href="/products/hydrating-face-mist" class="product-link" aria-label="View Hydrating Face Mist details">
              <div class="product-image">
                <img
                  src="./assets/images/sample-prodcut-image.png"
                  alt="Hydrating Face Mist - New refreshing formula"
                  width="300"
                  height="300"
                />
                <div class="product-badges">
                  <span class="badge new">New</span>
                </div>
              </div>
              <div class="product-info">
                <div class="product-pricing">
                  <span class="current-price" itemprop="price">$19.99</span>
                </div>
                <h3 class="product-name" itemprop="name">Hydrating Face Mist</h3>
              </div>
            </a>
            <div class="product-actions">
              <a href="#" class="wishlist-btn" aria-label="Add to wishlist" title="Add to Wishlist" role="button">
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
              <a href="#" class="cart-btn" aria-label="Add to cart" title="Add to Cart" role="button">
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

          <!-- Product 7 -->
          <article class="product-card" itemscope itemtype="https://schema.org/Product">
            <a href="/products/nourishing-lip-balm" class="product-link" aria-label="View Nourishing Lip Balm details">
              <div class="product-image">
                <img
                  src="./assets/images/sample-prodcut-image.png"
                  alt="Nourishing Lip Balm - New organic formula"
                  width="300"
                  height="300"
                />
                <div class="product-badges">
                  <span class="badge new">New</span>
                  <span class="badge sale">10% Off</span>
                </div>
              </div>
              <div class="product-info">
                <div class="product-pricing">
                  <span class="current-price" itemprop="price">$8.99</span>
                  <span class="original-price">$9.99</span>
                </div>
                <h3 class="product-name" itemprop="name">Nourishing Lip Balm</h3>
              </div>
            </a>
            <div class="product-actions">
              <a href="#" class="wishlist-btn" aria-label="Add to wishlist" title="Add to Wishlist" role="button">
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
              <a href="#" class="cart-btn" aria-label="Add to cart" title="Add to Cart" role="button">
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

          <!-- Product 8 -->
          <article class="product-card" itemscope itemtype="https://schema.org/Product">
            <a href="/products/exfoliating-body-scrub" class="product-link" aria-label="View Exfoliating Body Scrub details">
              <div class="product-image">
                <img
                  src="./assets/images/sample-prodcut-image.png"
                  alt="Exfoliating Body Scrub - New natural ingredients"
                  width="300"
                  height="300"
                />
                <div class="product-badges">
                  <span class="badge new">New</span>
                </div>
              </div>
              <div class="product-info">
                <div class="product-pricing">
                  <span class="current-price" itemprop="price">$32.99</span>
                </div>
                <h3 class="product-name" itemprop="name">Exfoliating Body Scrub</h3>
              </div>
            </a>
            <div class="product-actions">
              <a href="#" class="wishlist-btn" aria-label="Add to wishlist" title="Add to Wishlist" role="button">
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
              <a href="#" class="cart-btn" aria-label="Add to cart" title="Add to Cart" role="button">
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

          <!-- Product 9 -->
          <article class="product-card" itemscope itemtype="https://schema.org/Product">
            <a href="/products/antioxidant-face-mask" class="product-link" aria-label="View Antioxidant Face Mask details">
              <div class="product-image">
                <img
                  src="./assets/images/sample-prodcut-image.png"
                  alt="Antioxidant Face Mask - New weekly treatment"
                  width="300"
                  height="300"
                />
                <div class="product-badges">
                  <span class="badge new">New</span>
                  <span class="badge sale">30% Off</span>
                </div>
              </div>
              <div class="product-info">
                <div class="product-pricing">
                  <span class="current-price" itemprop="price">$28.99</span>
                  <span class="original-price">$39.99</span>
                </div>
                <h3 class="product-name" itemprop="name">Antioxidant Face Mask</h3>
              </div>
            </a>
            <div class="product-actions">
              <a href="#" class="wishlist-btn" aria-label="Add to wishlist" title="Add to Wishlist" role="button">
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
              <a href="#" class="cart-btn" aria-label="Add to cart" title="Add to Cart" role="button">
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

          <!-- Product 10 -->
          <article class="product-card" itemscope itemtype="https://schema.org/Product">
            <a href="/products/daily-spf-moisturizer" class="product-link" aria-label="View Daily SPF Moisturizer details">
              <div class="product-image">
                <img
                  src="./assets/images/sample-prodcut-image.png"
                  alt="Daily SPF Moisturizer - New lightweight protection"
                  width="300"
                  height="300"
                />
                <div class="product-badges">
                  <span class="badge new">New</span>
                </div>
              </div>
              <div class="product-info">
                <div class="product-pricing">
                  <span class="current-price" itemprop="price">$38.99</span>
                </div>
                <h3 class="product-name" itemprop="name">Daily SPF Moisturizer</h3>
              </div>
            </a>
            <div class="product-actions">
              <a href="#" class="wishlist-btn" aria-label="Add to wishlist" title="Add to Wishlist" role="button">
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
              <a href="#" class="cart-btn" aria-label="Add to cart" title="Add to Cart" role="button">
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

          <!-- Product 11 -->
          <article class="product-card" itemscope itemtype="https://schema.org/Product">
            <a href="/products/peptide-recovery-cream" class="product-link" aria-label="View Peptide Recovery Cream details">
              <div class="product-image">
                <img
                  src="./assets/images/sample-prodcut-image.png"
                  alt="Peptide Recovery Cream - New advanced repair"
                  width="300"
                  height="300"
                />
                <div class="product-badges">
                  <span class="badge new">New</span>
                  <span class="badge sale">18% Off</span>
                </div>
              </div>
              <div class="product-info">
                <div class="product-pricing">
                  <span class="current-price" itemprop="price">$74.99</span>
                  <span class="original-price">$89.99</span>
                </div>
                <h3 class="product-name" itemprop="name">Peptide Recovery Cream</h3>
              </div>
            </a>
            <div class="product-actions">
              <a href="#" class="wishlist-btn" aria-label="Add to wishlist" title="Add to Wishlist" role="button">
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
              <a href="#" class="cart-btn" aria-label="Add to cart" title="Add to Cart" role="button">
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

          <!-- Product 12 -->
          <article class="product-card" itemscope itemtype="https://schema.org/Product">
            <a href="/products/brightening-toner-pads" class="product-link" aria-label="View Brightening Toner Pads details">
              <div class="product-image">
                <img
                  src="./assets/images/sample-prodcut-image.png"
                  alt="Brightening Toner Pads - New pre-soaked treatment"
                  width="300"
                  height="300"
                />
                <div class="product-badges">
                  <span class="badge new">New</span>
                </div>
              </div>
              <div class="product-info">
                <div class="product-pricing">
                  <span class="current-price" itemprop="price">$26.99</span>
                </div>
                <h3 class="product-name" itemprop="name">Brightening Toner Pads</h3>
              </div>
            </a>
            <div class="product-actions">
              <a href="#" class="wishlist-btn" aria-label="Add to wishlist" title="Add to Wishlist" role="button">
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
              <a href="#" class="cart-btn" aria-label="Add to cart" title="Add to Cart" role="button">
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
        </div>

        <!-- Load More Section -->
        <div class="load-more-section">
          <button class="load-more-btn">Load More Products</button>
          <p class="load-more-text">Showing 12 of 48 products</p>
        </div>
      </div>

      <!-- Join CELIGIN Banner -->
      <section class="join-celigin-banner">
        <div class="container">
          <div class="banner-grid">
            <div class="celigin-banner join-club">
              <img 
                src="./assets/images/join-club-banner.png" 
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
                src="./assets/images/cell-education-banner.png" 
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