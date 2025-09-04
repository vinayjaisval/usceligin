@include('frontend.include.header')
<!-- Main Content -->
<main id="main-content" role="main">
  <!-- Hero Carousel -->
  @if($ps->slider == 1)
  <section class="hero-section" aria-label="Featured products and offers">
    <div class="container">
      <div class="hero-swiper swiper">
        <div class="swiper-wrapper">
     
          @foreach($sliders as $data)
          <!-- Slide 1 -->
          <div class="swiper-slide">
            <div class="hero-slide">
              <div class="carousel-bg"></div>
              <div class="carousel-content">
                <h1 class="hero-title">{{$data->subtitle_text}},<br />{{$data->title_text}}</h1>
                <p class="hero-subtitle">
                  {{$data->details_text}}
                </p>
                <a href="{{$data->link}}" class="cta-btn">Shop Now</a>
                <div class="hero-badges">
                  <img
                    src="{{asset('assets/frontend/images/carousel-bg-1.png')}}"
                    alt="Certification badge"
                    width="120"
                    height="60" />
                  <img
                    src="{{asset('assets/images/sliders/'.$data->photo)}}"
                    alt="Award badge"
                    width="120"
                    height="60" />
                </div>
              </div>
            </div>
          </div>
          @endforeach
         
        </div>

        <!-- Navigation arrows -->
        <div
          class="swiper-button-next hero-nav-next"
          aria-label="Next slide"></div>
        <div
          class="swiper-button-prev hero-nav-prev"
          aria-label="Previous slide"></div>

        <!-- Pagination dots -->
        <div class="swiper-pagination hero-pagination"></div>
      </div>
    </div>
  </section>
  @endif
  <!-- Category Banners -->
  <section class="category-banners" aria-label="Shop by category">
    <div class="container">
      <div class="banner-grid">
        <article class="category-banner">
          <a href="{{$arrivals[0]['url']}}" class="banner-link-full">
            <div class="banner-image">
              <img
                src="{{asset('assets/images/arrival/'.$arrivals[0]['photo'])}}"
                alt="New arrivals collection"
                width="450"
                height="450" />
            </div>
            <div class="banner-content">
              <h3>{{$arrivals[0]['title']}}</h3>
              <p>{{$arrivals[0]['up_sale']}}</p>
              <span class="banner-link">
                Shop Now
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
              </span>
            </div>
          </a>
        </article>

        <article class="category-banner">
          <a href="{{$arrivals[1]['url']}}" class="banner-link-full">
            <div class="banner-image">
              <img
                src="{{asset('assets/images/arrival/'.$arrivals[1]['photo'])}}"
                alt="Best selling products"
                width="450"
                height="450" />
            </div>
            <div class="banner-content">
              <h3>{{$arrivals[1]['title']}}</h3>
              <p>{{$arrivals[1]['up_sale']}}</p>
              <span class="banner-link">
                Shop Now
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
              </span>
            </div>
          </a>
        </article>

        <article class="category-banner">
          <a href="/first-time-buyer" class="banner-link-full">
            <div class="banner-image">
              <img
                src="{{asset('assets/images/arrival/'.$arrivals[2]['photo'])}}"
                alt="First time buyer offers"
                width="450"
                height="450" />
            </div>
            <div class="banner-content">
              <h3>{{$arrivals[2]['title']}}</h3>
              <p>{{$arrivals[2]['up_sale']}}</p>
              <span class="banner-link">
                Discover Now
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
              </span>
            </div>
          </a>
        </article>

      </div>
    </div>
  </section>
  @if($ps->best_sellers==1)
  <!-- Best Sellers -->
  <section class="product-section" aria-labelledby="bestsellers-title">
    <div class="container">
      <div class="section-header">
        <h2 id="bestsellers-title">Our Bestsellers</h2>
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
          @foreach($best_products as $prod)
          <div class="swiper-slide">
            <article class="product-card">
              <div class="product-image">
                <img
                  src="{{ $prod->thumbnail ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"
                  alt="Premium skincare serum"
                  width="300"
                  height="300" />
                <div class="product-badges">
                  <span class="badge new">New</span>
                  <span class="badge sale">Sale</span>
                </div>
                <div class="product-actions">
                  <button class="wishlist-btn" aria-label="Add to wishlist">
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

                 

                  <button class="cart-btn" aria-label="Add to cart">
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
                      <path d="M16 10c0 2.2-1.8 4-4 4s-4-1.8-4-4"></path>
                    </svg>
                  </button> 
                </div>
              </div>
              <div class="product-info">
                <div class="product-pricing">
                  <span class="current-price">{{ $prod->showPrice() }}</span>
                  <span class="original-price">{{ $prod->showPreviousPrice() }}</span>
                </div>
                <h3 class="product-name" title="{{$prod->name}}">{{ ucfirst(mb_strtolower($prod->showName())) }}</h3>
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
@endif
@if($ps->deal_of_the_day==1)
  <!-- Special Offer Banner -->
  <section class="special-offer" aria-labelledby="special-offer-title">
    <div class="container">
      <div class="offer-grid">
        <div class="offer-image">
          <img
            src="{{ $gs->deal_background ? asset('assets/images/'.$gs->deal_background):asset('assets/images/noimage.png') }}"
            alt="Mountain Pine Bath Oil special offer product"
            width="400"
            height="600" />
        </div>
        <div class="offer-content">
          <div class="offer-badge">
            <span class="special-text">SPECIAL OFFER</span>
            <span class="discount-badge">-25%</span>
          </div>
          <h2 id="special-offer-title">{{ $gs->deal_title }}</h2>
          <p>
          {{ $gs->deal_details }}
          </p>

          <div
            class="countdown-timer"
            aria-label="Special offer countdown timer">
            <div class="time-unit">
              <span class="time-value">{{ $gs->deal_time }}</span>
              <!-- <span class="time-label">D</span> -->
            </div>
            <!-- <span class="separator">:</span>
            <div class="time-unit">
              <span class="time-value">20</span>
              <span class="time-label">M</span>
            </div>
            <span class="separator">:</span>
            <div class="time-unit">
              <span class="time-value">30</span>
              <span class="time-label">S</span>
            </div> -->
          </div>

          <a href="{{ route('front.category') }}" class="special-cta-btn">Get Only 39,00</a>
        </div>
      </div>
    </div>
  </section>
@endif
  <!-- Hot Deals (Similar structure to Best Sellers) -->

  
  <section
    class="product-section hot-deals"
    aria-labelledby="hotdeals-title">
    <div class="container">
      <div class="section-header">
        <h2 id="hotdeals-title">Hot Deals</h2>
        <a href="/hot-deals" class="view-all-link">
          Shop all hot deals
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

      <div class="hotdeals-swiper swiper">
        <div class="swiper-wrapper">
          <!-- Hot Deal 1 -->
          @foreach($hot_products as $prod)
          <div class="swiper-slide">
            <article class="product-card">
              <div class="product-image">
                <img
                  src="{{ $prod->thumbnail ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"
                  alt="Limited time offer product"
                  width="300"
                  height="300" />
                <div class="product-badges">
                  <span class="badge hot">Hot</span>
                  @if (round($prod->offPercentage() )>0)
                  <span class="badge sale">-{{ round($prod->offPercentage() )}}%</span>
                @endif
                 
                </div>
                <div class="product-actions">
                  <button class="wishlist-btn" aria-label="Add to wishlist">
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
                  <button class="cart-btn" aria-label="Add to cart">
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
                      <path d="M16 10c0 2.2-1.8 4-4 4s-4-1.8-4-4"></path>
                    </svg>
                  </button>
                </div>
              </div>
              <div class="product-info">
                <div class="product-pricing">
                  <span class="current-price">{{ $prod->showPrice() }}</span>
                  <span class="original-price">{{ $prod->showPreviousPrice() }}</span>
                </div>
                <h3 class="product-name" title="{{$prod->name}}">{{ ucfirst(mb_strtolower($prod->showName())) }}</h3>
              </div>
            </article>
          </div>
         @endforeach
        </div>

        <!-- Navigation arrows -->
        <div
          class="swiper-button-next hotdeals-nav-next"
          aria-label="Next hot deals"></div>
        <div
          class="swiper-button-prev hotdeals-nav-prev"
          aria-label="Previous hot deals"></div>
      </div>
    </div>
  </section>

  <!-- Instagram Feed -->
  <section class="instagram-feed" aria-labelledby="instagram-title">
    <div class="container">
      <div class="section-header">
        <div class="instagram-header">
          <div class="instagram-icon">
            <svg
              width="32"
              height="32"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2">
              <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
              <path
                d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
              <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
            </svg>
          </div>
          <h2 id="instagram-title">Instagram Feed</h2>
        </div>
        <a href="#" class="view-all-link">
          View all feeds
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

      <div
        class="instagram-grid"
        role="region"
        aria-label="Instagram posts">

        @foreach($blogs as $blog)
        <article class="instagram-post">
          <img
            src="{{ $blog->photo ? asset('assets/images/blogs/'.$blog->photo):asset('assets/images/noimage.png')}}"
            alt="Instagram post showing skincare routine"
            width="300"
            height="400" />
          <div class="video-overlay">
            <svg
              width="40"
              height="40"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2">
              <polygon points="5,3 19,12 5,21"></polygon>
            </svg>
          </div>
        </article>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Newsletter Banners -->
  <section class="newsletter-banners">
    <div class="container">
      <div class="banner-grid">
        <div class="newsletter-banner join-club">
          <div class="banner-bg"></div>
          <div class="banner-content">
            <span class="badge">JOIN CELIGIN CLUB</span>
            <h3>Become a Brand Ambassador</h3>
            <a href="/join" class="banner-btn">Join Now</a>
          </div>
        </div>

        <div class="newsletter-banner cta-banner">
          <div class="banner-bg"></div>
          <div class="banner-content">
            <h3>Call for Education</h3>
            <a href="/education" class="banner-btn secondary">Read More</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  @if($ps->blog==1)
  <!-- Blog Section -->
  <section class="blog-section" aria-labelledby="blog-title">
    <div class="container">
      <div class="section-header">
        <h2 id="blog-title">Blog</h2>
        <a href="/blog" class="view-all-link">
          View all posts
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

      <div class="blog-grid" role="region" aria-label="Latest blog posts">

      @foreach($blogs as $blog)
        <article class="blog-post">
          <div class="post-image">
            <img
              src="{{ $blog->photo ? asset('assets/images/blogs/'.$blog->photo):asset('assets/images/noimage.png')}}"
              alt="5 Essential Skincare Tips"
              width="400"
              height="300" />
          </div>
          <div class="post-content">
            <h3>{{ Str::limit($blog->title, 25) }}</h3>
            <a href="{{ route('front.blogshow',$blog->slug) }}" class="read-more">
              Read More
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
        </article>
        @endforeach
      
      </div>
    </div>
  </section>
  @endif
</main>
@include('frontend.include.footer')