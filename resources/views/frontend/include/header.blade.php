<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta
    name="description"
    content="CELIGIN - Premium cosmetics and skincare products. Discover your glow with our science-backed beauty solutions." />
  <title>CELIGIN - Premium Cosmetics & Skincare</title>
  <link rel="stylesheet" href="{{asset('assets/frontend/css/styles.css')}}" />
  <!-- SwiperJS CSS -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
    rel="stylesheet" />
</head>

<body>
  <!-- Skip to main content link for accessibility -->
  <a href="#main-content" class="skip-link">Skip to main content</a>

  <!-- Promotion Bar -->
  <div class="promo-bar" role="banner" aria-label="Promotional announcement">
    <div class="container">

      @php
      use App\Models\Coupon;
      $available_coupons = Coupon::where('id', 1)->select('id', 'code', 'price')->get();
      @endphp

      <p class="promo-text">
        <strong>10% off for new customers</strong>
        <span
          class="promo-code"
          data-code="{{ $available_coupons[0]->code }}"
          onclick="copyPromoCode(this)"
          title="Click to copy code">{{ $available_coupons[0]->code }}</span>
      </p>

      <script>
        function copyPromoCode(element) {
          const code = element.getAttribute('data-code');
          if (navigator.clipboard) {
            navigator.clipboard.writeText(code)
              .then(() => {
                alert('Promo code copied: ' + code);
              })
              .catch(err => {
                alert('Failed to copy promo code');
                console.error(err);
              });
          } else {
            // fallback for older browsers
            const textarea = document.createElement('textarea');
            textarea.value = code;
            document.body.appendChild(textarea);
            textarea.select();
            try {
              document.execCommand('copy');
              alert('Promo code copied: ' + code);
            } catch (err) {
              alert('Failed to copy promo code');
              console.error(err);
            }
            document.body.removeChild(textarea);
          }
        }
      </script>



      <button class="close-btn" aria-label="Close promotional banner">
        <svg
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="2">
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
      </button>
    </div>
  </div>

  <!-- Header -->
  <header class="main-header" role="banner">
    <div class="container">
      <!-- Utility Navigation -->
      <div class="nav-utility">
        <div class="search-bar">
          <form
            role="search"
            aria-label="Site search"
            onsubmit="return false;">
            <input
              type="search"
              id="search-input"
              placeholder="Search products..."
              aria-label="Search for products"
              aria-expanded="false"
              aria-owns="search-dropdown"
              autocomplete="off" />
            <button type="button" aria-label="Submit search" id="search-btn">
              <svg
                width="20"
                height="20"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2">
                <circle cx="11" cy="11" r="8"></circle>
                <path d="m21 21-4.35-4.35"></path>
              </svg>
            </button>

            <!-- Search Dropdown positioned below input -->
            <div
              class="search-dropdown"
              id="search-dropdown"
              role="listbox"
              aria-label="Search suggestions">
              <div
                class="search-suggestions-list"
                id="search-suggestions-list"></div>
            </div>
          </form>
        </div>

        <div class="logo">
          <a
            href="{{ route('front.index') }}"
            aria-label="CELIGIN - Go to homepage">
            <img
              src="{{ asset('assets/images/'.$gs->logo) }}"
              alt="CELIGIN - Premium Cosmetics & Skincare"
              class="logo-img" />
          </a>
        </div>

        <!-- Mobile menu toggle -->
        <button class="mobile-menu-toggle" aria-label="Toggle mobile menu" aria-expanded="false">
          <span class="hamburger-line"></span>
          <span class="hamburger-line"></span>
          <span class="hamburger-line"></span>
        </button>

        <div class="utility-buttons">
          <button class="account-btn" aria-label="My account">
            <svg
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
              <circle cx="12" cy="7" r="4"></circle>
            </svg>
          </button>
          <button class="wishlist-btn" aria-label="Wishlist">
            <svg
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2">
              <path
                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
            </svg>
          </button>
          <button class="cart-btn" aria-label="Shopping cart">
            <svg
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2">
              <path
                d="M9 22h6c2 0 3-1 3-3v-6c0-2-1-3-3-3H9c-2 0-3 1-3 3v6c0 2 1 3 3 3z"></path>
              <path d="M16 7V5a4 4 0 0 0-8 0v2"></path>
            </svg>
            <span class="cart-count" aria-label="0 items in cart">{{ Session::has('cart') ?
              count(Session::get('cart')->items) : '0' }}</span>
          </button>
          <button class="theme-toggle" aria-label="Toggle dark mode">
            <svg
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              class="sun-icon">
              <circle cx="12" cy="12" r="5"></circle>
              <line x1="12" y1="1" x2="12" y2="3"></line>
              <line x1="12" y1="21" x2="12" y2="23"></line>
              <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
              <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
              <line x1="1" y1="12" x2="3" y2="12"></line>
              <line x1="21" y1="12" x2="23" y2="12"></line>
              <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
              <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
            </svg>
            <svg
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              class="moon-icon">
              <path
                d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
            </svg>
          </button>
        </div>
      </div>

      <!-- Main Navigation -->
      <nav class="main-nav" role="navigation" aria-label="Main navigation">
        <ul class="nav-list">
         
          <li><a href="/" aria-current="page">Home</a></li>
        
          @if ($ps->home == 1)
          <li><a href="/shop">Shop</a></li>
          @endif
          <li><a href="/new-arrivals">New Arrivals
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="6,9 12,15 18,9"></polyline>
              </svg>
            </a></li>
          <li><a href="/best-sellers">Best Sellers
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="6,9 12,15 18,9"></polyline>
              </svg>
            </a></li>
          <li><a href="/skin-care">Skin Care
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="6,9 12,15 18,9"></polyline>
              </svg>
            </a></li>
          <li><a href="/join-celigin-club" class="gradient-text">Join CELIGIN CLUB</a></li>
          <li><a href="/sale">Sale</a></li>
        </ul>
      </nav>

      <!-- Mobile Menu Overlay -->
      <div class="mobile-menu-overlay" id="mobile-menu-overlay">
        <div class="mobile-menu-content">
          <!-- Close button positioned in top-right corner -->
          <button class="mobile-close-btn" aria-label="Close mobile menu">
            <svg
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2">
              <line x1="18" y1="6" x2="6" y2="18"></line>
              <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
          </button>

          <!-- Mobile Navigation -->
          <nav class="mobile-nav" role="navigation" aria-label="Mobile navigation">
            <ul class="mobile-nav-list">
              <li>
                <a href="/" aria-current="page">
                  <span>Home</span>
                </a>
              </li>
              <li>
                <a href="/shop">
                  <span>Shop</span>
                  <svg class="mobile-nav-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="9,18 15,12 9,6"></polyline>
                  </svg>
                </a>
              </li>
              <li>
                <a href="/new-arrivals">
                  <span>New Arrivals</span>
                  <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <span class="mobile-nav-badge">New</span>
                    <svg class="mobile-nav-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <polyline points="6,9 12,15 18,9"></polyline>
                    </svg>
                  </div>
                </a>
              </li>
              <li>
                <a href="/best-sellers">
                  <span>Best Sellers</span>
                  <svg class="mobile-nav-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="9,18 15,12 9,6"></polyline>
                  </svg>
                </a>
              </li>
              <li>
                <a href="/skin-care">
                  <span>Skin Care</span>
                  <svg class="mobile-nav-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="9,18 15,12 9,6"></polyline>
                  </svg>
                </a>
              </li>
              <li>
                <a href="/join-celigin-club" class="gradient-text">
                  <span>Join CELIGIN CLUB</span>
                </a>
              </li>
              <li>
                <a href="/sale">
                  <span>Sale</span>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </header>