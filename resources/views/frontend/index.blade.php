@include('frontend.include.header')
<!-- Main Content -->
<main id="main-content" role="main">
  <!-- Hero Carousel -->



  @if($ps->slider == 1)
  <section class="hero-section" aria-label="Featured products and offers">
    <div class="container">
      <div class="hero-swiper swiper">
        <div class="swiper-wrapper">
          <!-- Slide 1 -->

          @foreach($sliders as $data)
          <div class="swiper-slide">
            <div class="hero-slide">
              <div class="carousel-bg">
                <img
                  src="{{asset('assets/images/sliders/'.$data->photo)}}"
                  alt="Hero background - Your Glow, Our Science"
                  class="carousel-image" />
              </div>
              <div class="carousel-content">
                <h2 class="hero-title">{{$data->subtitle_text}},<br />{{$data->title_text}}</h2>
                <p class="hero-subtitle">
                  {{$data->details_text}}
                </p>
                <a href="{{$data->link}}" class="cta-btn">Shop Now</a>
                <div class="hero-badges">
                  <img
                    src="{{asset('assets/frontend/images/peta-banner.png')}}"
                    alt="Peta badge" />
                  <img
                    src="{{asset('assets/frontend/images/cpnp-banner.png')}}"
                    alt="CPNP badge" />
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
        <article class="instagram-post">
        <blockquote class="instagram-media" data-instgrm-permalink="https://www.instagram.com/p/DI2-xXWPXMu/?utm_source=ig_embed&amp;utm_campaign=loading" data-instgrm-version="14" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);">
          <div style="padding:16px;"> <a href="https://www.instagram.com/p/DI2-xXWPXMu/?utm_source=ig_embed&amp;utm_campaign=loading" style=" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank">
              <div style=" display: flex; flex-direction: row; align-items: center;">
                <div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;"></div>
                <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;">
                  <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;"></div>
                  <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;"></div>
                </div>
              </div>
              <div style="padding: 19% 0;"></div>
              <div style="display:block; height:50px; margin:0 auto 12px; width:50px;"><svg width="50px" height="50px" viewBox="0 0 60 60" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink">
                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g transform="translate(-511.000000, -20.000000)" fill="#000000">
                      <g>
                        <path d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631"></path>
                      </g>
                    </g>
                  </g>
                </svg></div>
              <div style="padding-top: 8px;">
                <div style=" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">View this post on Instagram</div>
              </div>
              <div style="padding: 12.5% 0;"></div>
              <div style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;">
                <div>
                  <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);"></div>
                  <div style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;"></div>
                  <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);"></div>
                </div>
                <div style="margin-left: 8px;">
                  <div style=" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;"></div>
                  <div style=" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)"></div>
                </div>
                <div style="margin-left: auto;">
                  <div style=" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);"></div>
                  <div style=" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);"></div>
                  <div style=" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);"></div>
                </div>
              </div>
              <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;">
                <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;"></div>
                <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;"></div>
              </div>
            </a>
            <p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;"><a href="https://www.instagram.com/p/DI2-xXWPXMu/?utm_source=ig_embed&amp;utm_campaign=loading" style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;" target="_blank">A post shared by Celigin Global (@celiginglobal)</a></p>
          </div>
        </blockquote>
        </article>
        <article class="instagram-post">
        <blockquote class="instagram-media" data-instgrm-permalink="https://www.instagram.com/p/DNNZuezPKyS/?utm_source=ig_embed&amp;utm_campaign=loading" data-instgrm-version="14" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);">
          <div style="padding:16px;"> <a href="https://www.instagram.com/p/DNNZuezPKyS/?utm_source=ig_embed&amp;utm_campaign=loading" style=" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank">
              <div style=" display: flex; flex-direction: row; align-items: center;">
                <div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;"></div>
                <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;">
                  <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;"></div>
                  <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;"></div>
                </div>
              </div>
              <div style="padding: 19% 0;"></div>
              <div style="display:block; height:50px; margin:0 auto 12px; width:50px;"><svg width="50px" height="50px" viewBox="0 0 60 60" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink">
                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g transform="translate(-511.000000, -20.000000)" fill="#000000">
                      <g>
                        <path d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631"></path>
                      </g>
                    </g>
                  </g>
                </svg></div>
              <div style="padding-top: 8px;">
                <div style=" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">View this post on Instagram</div>
              </div>
              <div style="padding: 12.5% 0;"></div>
              <div style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;">
                <div>
                  <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);"></div>
                  <div style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;"></div>
                  <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);"></div>
                </div>
                <div style="margin-left: 8px;">
                  <div style=" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;"></div>
                  <div style=" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)"></div>
                </div>
                <div style="margin-left: auto;">
                  <div style=" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);"></div>
                  <div style=" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);"></div>
                  <div style=" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);"></div>
                </div>
              </div>
              <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;">
                <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;"></div>
                <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;"></div>
              </div>
            </a>
            <p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;"><a href="https://www.instagram.com/p/DNNZuezPKyS/?utm_source=ig_embed&amp;utm_campaign=loading" style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;" target="_blank">A post shared by Celigin Global (@celiginglobal)</a></p>
          </div>
        </blockquote>
        </article>
        <article class="instagram-post">
        <blockquote class="instagram-media" data-instgrm-permalink="https://www.instagram.com/p/DMhZouMRaQH/?utm_source=ig_embed&amp;utm_campaign=loading" data-instgrm-version="14" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);">
          <div style="padding:16px;"> <a href="https://www.instagram.com/p/DMhZouMRaQH/?utm_source=ig_embed&amp;utm_campaign=loading" style=" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank">
              <div style=" display: flex; flex-direction: row; align-items: center;">
                <div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;"></div>
                <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;">
                  <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;"></div>
                  <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;"></div>
                </div>
              </div>
              <div style="padding: 19% 0;"></div>
              <div style="display:block; height:50px; margin:0 auto 12px; width:50px;"><svg width="50px" height="50px" viewBox="0 0 60 60" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink">
                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g transform="translate(-511.000000, -20.000000)" fill="#000000">
                      <g>
                        <path d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631"></path>
                      </g>
                    </g>
                  </g>
                </svg></div>
              <div style="padding-top: 8px;">
                <div style=" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">View this post on Instagram</div>
              </div>
              <div style="padding: 12.5% 0;"></div>
              <div style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;">
                <div>
                  <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);"></div>
                  <div style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;"></div>
                  <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);"></div>
                </div>
                <div style="margin-left: 8px;">
                  <div style=" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;"></div>
                  <div style=" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)"></div>
                </div>
                <div style="margin-left: auto;">
                  <div style=" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);"></div>
                  <div style=" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);"></div>
                  <div style=" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);"></div>
                </div>
              </div>
              <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;">
                <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;"></div>
                <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;"></div>
              </div>
            </a>
            <p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;"><a href="https://www.instagram.com/p/DMhZouMRaQH/?utm_source=ig_embed&amp;utm_campaign=loading" style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;" target="_blank">A post shared by Celigin Global (@celiginglobal)</a></p>
          </div>
        </blockquote>
        </article>
        <script async src="//www.instagram.com/embed.js"></script>
        <!-- <article class="instagram-post">
          <img
            src="https://via.placeholder.com/300x400/f0f0f0/666?text=Instagram+Post"
            alt="Instagram post featuring product showcase"
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
        </article> -->

        <!-- <article class="instagram-post">
          <img
            src="https://via.placeholder.com/300x400/f8f8f8/666?text=Instagram+Post"
            alt="Instagram post with beauty tips"
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

        <article class="instagram-post">
          <img
            src="https://via.placeholder.com/300x400/e0e0e0/666?text=Instagram+Post"
            alt="Instagram post demonstrating product application"
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

        <article class="instagram-post">
          <img
            src="https://via.placeholder.com/300x400/ececec/666?text=Instagram+Post"
            alt="Instagram post with customer testimonial"
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
        </article> -->
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