@extends('frontend.include.app')

@section('content')
<!-- Main Content -->
<main id="main-content" role="main">
  <!-- Hero Carousel -->
  <section class="relative overflow-hidden" aria-label="Featured products and offers" role="region">
    <div class="max-w-7xl mx-auto">
      <div class="hero-swiper swiper" role="group" aria-roledescription="carousel" aria-label="Product showcase carousel">
        <div class="swiper-wrapper">
          <!-- Slide 1 -->
          <article class="swiper-slide" role="group" aria-roledescription="slide" aria-label="1 of 3">
            <div class="relative h-[400px] sm:h-[500px] lg:h-[600px] flex items-center bg-cover bg-center bg-no-repeat"
                 style="background-image: url('{{asset('assets/frontend/images/carousel-bg-1.png')}}')"
                 role="img"
                 aria-label="Woman with glowing skin representing premium skincare">
              <div class="relative z-10 w-full px-4 sm:px-6 lg:px-8">
                <div class="flex justify-center lg:justify-end">
                  <div class="max-w-md text-center lg:text-left">
                    <h2 class="text-2xl sm:text-3xl md:text-3xl lg:text-4xl font-bold text-black mb-4 leading-tight">
                      Transform Your Skin<br />With Premium Skincare
                    </h2>
                    <p id="slide-1-desc" class="text-sm sm:text-base lg:text-base text-gray-700 mb-6 sm:mb-8 leading-relaxed">
                      Discover clinically proven formulas that deliver visible results. Get radiant, healthy skin with our award-winning products.
                    </p>
                    <div class="flex justify-center lg:justify-start mb-6 sm:mb-8">
                      <a href="/products"
                         class="inline-flex items-center px-4 sm:px-6 py-2 sm:py-3 bg-orange-600 text-white font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-all duration-200 text-sm sm:text-base"
                         aria-describedby="slide-1-desc">
                        Shop Now
                      </a>
                    </div>
                    <div class="flex items-center justify-center lg:justify-start space-x-4" role="group" aria-label="Certification badges">
                      <img
                        src="{{asset('assets/frontend/images/peta-banner.png')}}"
                        alt="PETA Certified - Cruelty-free products"
                        class="h-8 sm:h-10 lg:h-12 w-auto" />
                      <img
                        src="{{asset('assets/frontend/images/cpnp-banner.png')}}"
                        alt="CPNP Registered - EU compliant cosmetics"
                        class="h-8 sm:h-10 lg:h-12 w-auto" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </article>

          <!-- Slide 2 -->
          <article class="swiper-slide" role="group" aria-roledescription="slide" aria-label="2 of 3">
            <div class="relative h-[400px] sm:h-[500px] lg:h-[600px] flex items-center bg-cover bg-center bg-no-repeat"
                 style="background-image: url('{{asset('assets/frontend/images/carousel-bg-2.png')}}')"
                 role="img"
                 aria-label="Happy women enjoying skincare together">
              <div class="relative z-10 w-full px-4 sm:px-6 lg:px-8">
                <div class="flex justify-center lg:justify-end">
                  <div class="max-w-md text-center lg:text-left">
                    <h2 class="text-2xl sm:text-3xl md:text-3xl lg:text-4xl font-bold text-black mb-4 leading-tight">
                      Limited Time Offer<br />Up to 50% Off
                    </h2>
                    <p id="slide-2-desc" class="text-sm sm:text-base lg:text-base text-gray-700 mb-6 sm:mb-8 leading-relaxed">
                      Don't miss out on our biggest sale of the year! Shop bestselling skincare products at unbeatable prices.
                    </p>
                    <div class="flex justify-center lg:justify-start mb-6 sm:mb-8">
                      <a href="/products"
                         class="inline-flex items-center px-4 sm:px-6 py-2 sm:py-3 bg-orange-600 text-white font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-all duration-200 text-sm sm:text-base"
                         aria-describedby="slide-2-desc">
                        Shop Now
                      </a>
                    </div>
                    <div class="flex items-center justify-center lg:justify-start space-x-4" role="group" aria-label="Certification badges">
                      <img
                        src="{{asset('assets/frontend/images/peta-banner.png')}}"
                        alt="PETA Certified - Cruelty-free products"
                        class="h-8 sm:h-10 lg:h-12 w-auto" />
                      <img
                        src="{{asset('assets/frontend/images/cpnp-banner.png')}}"
                        alt="CPNP Registered - EU compliant cosmetics"
                        class="h-8 sm:h-10 lg:h-12 w-auto" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </article>

          <!-- Slide 3 -->
          <article class="swiper-slide" role="group" aria-roledescription="slide" aria-label="3 of 3">
            <div class="relative h-[400px] sm:h-[500px] lg:h-[600px] flex items-center bg-cover bg-center bg-no-repeat"
                 style="background-image: url('{{asset('assets/frontend/images/carousel-bg-3.png')}}')"
                 role="img"
                 aria-label="New skincare products showcasing latest innovations">
              <div class="relative z-10 w-full px-4 sm:px-6 lg:px-8">
                <div class="flex justify-center lg:justify-end">
                  <div class="max-w-md text-center lg:text-left">
                    <h2 class="text-2xl sm:text-3xl md:text-3xl lg:text-4xl font-bold text-black mb-4 leading-tight">
                      New Arrivals<br />Just Launched
                    </h2>
                    <p id="slide-3-desc" class="text-sm sm:text-base lg:text-base text-gray-700 mb-6 sm:mb-8 leading-relaxed">
                      Be the first to try our latest innovations. Fresh formulas, proven results, exclusively available now.
                    </p>
                    <div class="flex justify-center lg:justify-start mb-6 sm:mb-8">
                      <a href="/products"
                         class="inline-flex items-center px-4 sm:px-6 py-2 sm:py-3 bg-orange-600 text-white font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-all duration-200 text-sm sm:text-base"
                         aria-describedby="slide-3-desc">
                        Explore Collection
                      </a>
                    </div>
                    <div class="flex items-center justify-center lg:justify-start space-x-4" role="group" aria-label="Certification badges">
                      <img
                        src="{{asset('assets/frontend/images/peta-banner.png')}}"
                        alt="PETA Certified - Cruelty-free products"
                        class="h-8 sm:h-10 lg:h-12 w-auto" />
                      <img
                        src="{{asset('assets/frontend/images/cpnp-banner.png')}}"
                        alt="CPNP Registered - EU compliant cosmetics"
                        class="h-8 sm:h-10 lg:h-12 w-auto" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </article>
        </div>

        <!-- Navigation arrows -->
        <button class="swiper-button-next hero-nav-next !text-gray-600 !w-10 !h-10 sm:!w-12 sm:!h-12 !mt-0 !top-1/2 !-translate-y-1/2 !right-2 sm:!right-4 lg:!right-8 after:!text-lg sm:after:!text-2xl !bg-white !bg-opacity-80 !rounded-full hover:!bg-opacity-100 !transition-all !duration-200"
                aria-label="Next slide"
                type="button"></button>
        <button class="swiper-button-prev hero-nav-prev !text-gray-600 !w-10 !h-10 sm:!w-12 sm:!h-12 !mt-0 !top-1/2 !-translate-y-1/2 !left-2 sm:!left-4 lg:!left-8 after:!text-lg sm:after:!text-2xl !bg-white !bg-opacity-80 !rounded-full hover:!bg-opacity-100 !transition-all !duration-200"
                aria-label="Previous slide"
                type="button"></button>

        <!-- Pagination dots -->
        <div class="swiper-pagination hero-pagination !bottom-4 sm:!bottom-6 !left-1/2 !transform !-translate-x-1/2"
             role="tablist"
             aria-label="Slide navigation"></div>
      </div>
    </div>
  </section>

  <!-- Category Banners -->
  <section class="py-12 lg:py-16 bg-white" aria-labelledby="category-banners-title" role="region">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 id="category-banners-title" class="text-2xl lg:text-3xl font-bold text-gray-900 mb-8 lg:mb-12 text-center">Shop by Category</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
        <article class="group relative overflow-hidden shadow-sm hover:shadow-md transition-all duration-300">
          <a href="/products"
             class="block focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2"
             aria-describedby="category-1-desc"
             role="button"
             tabindex="0">
            <div class="relative min-h-[300px] sm:min-h-[350px] lg:min-h-[450px] overflow-hidden">
              <img
                src="{{asset('assets/frontend/images/main-banner-1.png')}}"
                alt="New arrivals premium skincare collection"
                width="450"
                height="450"
                loading="lazy"
                decoding="async"
                class="w-full min-h-[300px] sm:min-h-[350px] lg:min-h-[450px] h-full object-cover group-hover:scale-105 transition-transform duration-300" />
              <div class="absolute inset-0 flex flex-col justify-between p-3 sm:p-4 lg:p-6">
                <header>
                  <h3 class="text-base sm:text-lg lg:text-xl xl:text-2xl font-bold mb-1 sm:mb-2 leading-tight text-gray-900">
                    New Arrivals
                  </h3>
                  <p id="category-1-desc" class="text-xs sm:text-sm lg:text-base leading-relaxed text-gray-700">
                    Starting at ₹5500.00
                  </p>
                </header>
                <footer class="mt-auto">
                  <span class="inline-flex items-center text-xs sm:text-sm lg:text-base font-medium text-orange-600 group-hover:translate-x-1 transition-transform duration-200">
                    <span class="sr-only">Shop</span>
                    Shop Now
                    <svg
                      width="16"
                      height="16"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      class="ml-1 sm:ml-2 w-3 h-3 sm:w-4 sm:h-4"
                      aria-hidden="true"
                      focusable="false">
                      <line x1="7" y1="17" x2="17" y2="7"></line>
                      <polyline points="7,7 17,7 17,17"></polyline>
                    </svg>
                  </span>
                </footer>
              </div>
            </div>
          </a>
        </article>

        <article class="group relative overflow-hidden shadow-sm hover:shadow-md transition-all duration-300">
          <a href="/products"
             class="block focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2"
             aria-describedby="category-2-desc"
             role="button"
             tabindex="0">
            <div class="relative min-h-[300px] sm:min-h-[350px] lg:min-h-[450px] overflow-hidden">
              <img
                src="{{asset('assets/frontend/images/main-banner-2.png')}}"
                alt="Best selling gentle cleansing collection"
                width="450"
                height="450"
                loading="lazy"
                decoding="async"
                class="w-full min-h-[300px] sm:min-h-[350px] lg:min-h-[450px] h-full object-cover group-hover:scale-105 transition-transform duration-300" />
              <div class="absolute inset-0 flex flex-col justify-between p-3 sm:p-4 lg:p-6">
                <header>
                  <h3 class="text-base sm:text-lg lg:text-xl xl:text-2xl font-bold mb-1 sm:mb-2 leading-tight text-gray-900">
                    Best Sellers
                  </h3>
                  <p id="category-2-desc" class="text-xs sm:text-sm lg:text-base leading-relaxed text-gray-700">
                    At ₹5500.00
                  </p>
                </header>
                <footer class="mt-auto">
                  <span class="inline-flex items-center text-xs sm:text-sm lg:text-base font-medium text-orange-600 group-hover:translate-x-1 transition-transform duration-200">
                    <span class="sr-only">Shop</span>
                    Shop Now
                    <svg
                      width="16"
                      height="16"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      class="ml-1 sm:ml-2 w-3 h-3 sm:w-4 sm:h-4"
                      aria-hidden="true"
                      focusable="false">
                      <line x1="7" y1="17" x2="17" y2="7"></line>
                      <polyline points="7,7 17,7 17,17"></polyline>
                    </svg>
                  </span>
                </footer>
              </div>
            </div>
          </a>
        </article>

        <article class="group relative overflow-hidden shadow-sm hover:shadow-md transition-all duration-300">
          <a href="/products"
             class="block focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2"
             aria-describedby="category-3-desc"
             role="button"
             tabindex="0">
            <div class="relative min-h-[300px] sm:min-h-[350px] lg:min-h-[450px] overflow-hidden">
              <img
                src="{{asset('assets/frontend/images/main-banner-3.png')}}"
                alt="Celigin Hot Sale Collection"
                width="450"
                height="450"
                loading="lazy"
                decoding="async"
                class="w-full min-h-[300px] sm:min-h-[350px] lg:min-h-[450px] h-full object-cover group-hover:scale-105 transition-transform duration-300" />
              <div class="absolute inset-0 flex flex-col justify-between p-3 sm:p-4 lg:p-6">
                <header>
                  <h3 class="text-base sm:text-lg lg:text-xl xl:text-2xl font-bold mb-1 sm:mb-2 leading-tight text-gray-900">
                    Hot Sale
                  </h3>
                  <p id="category-3-desc" class="text-xs sm:text-sm lg:text-base leading-relaxed text-gray-700">
                    30% Off and Below - Don't Miss Out!
                  </p>
                </header>
                <footer class="mt-auto">
                  <span class="inline-flex items-center text-xs sm:text-sm lg:text-base font-medium text-orange-600 group-hover:translate-x-1 transition-transform duration-200">
                    <span class="sr-only">Discover</span>
                    Discover Now
                    <svg
                      width="16"
                      height="16"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      class="ml-1 sm:ml-2 w-3 h-3 sm:w-4 sm:h-4"
                      aria-hidden="true"
                      focusable="false">
                      <line x1="7" y1="17" x2="17" y2="7"></line>
                      <polyline points="7,7 17,7 17,17"></polyline>
                    </svg>
                  </span>
                </footer>
              </div>
            </div>
          </a>
        </article>

      </div>
    </div>
  </section>

  @if($ps->best_sellers==1)
  <section class="py-12 lg:py-16 bg-gray-50" aria-labelledby="bestsellers-title" role="region">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 lg:mb-12 gap-4">
        <h2 id="bestsellers-title" class="text-2xl lg:text-3xl font-bold text-gray-900">Our Bestsellers</h2>
        <a href="{{ route('front.best-sellers') }}"
           class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors duration-200 group focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2"
           aria-label="View all bestselling products">
          Shop all best sellers
          <svg
            width="16"
            height="16"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            class="ml-2 w-4 h-4 group-hover:translate-x-1 transition-transform duration-200"
            aria-hidden="true"
            focusable="false">
            <line x1="7" y1="17" x2="17" y2="7"></line>
            <polyline points="7,7 17,7 17,17"></polyline>
          </svg>
        </a>
      </div>

      <div class="relative">
        <div class="bestseller-swiper swiper">
          <div class="swiper-wrapper">
            @foreach($best_products as $prod)
            <div class="swiper-slide">
              <article class="bg-white shadow-sm overflow-hidden group hover:shadow-md transition-all duration-300" itemscope itemtype="https://schema.org/Product">
                <a href="{{ url('/item/'.$prod->slug) }}"
                   class="block focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2"
                   aria-describedby="product-{{ $prod->id }}-desc">
                  <div class="relative aspect-square overflow-hidden">
                    <img
                      src="{{ $prod->thumbnail ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"
                      alt="{{ $prod->name }} - Premium skincare product"
                      width="300"
                      height="300"
                      loading="lazy"
                      decoding="async"
                      itemprop="image"
                      class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                    <div class="absolute top-2 left-2 sm:top-3 sm:left-3">
                      @php
                        $productTags = [];
                        if ($prod->offPercentage() > 0) {
                          $productTags[] = ['label' => 'Sale', 'class' => 'bg-red-600'];
                        }
                        if ($prod->is_featured) {
                          $productTags[] = ['label' => 'Hot', 'class' => 'bg-orange-600'];
                        }
                        if (empty($productTags)) {
                          $productTags[] = ['label' => 'New', 'class' => 'bg-green-600'];
                        }
                      @endphp
                      @foreach($productTags as $tag)
                        <span class="inline-block px-2 py-1 {{ $tag['class'] }} text-white text-xs font-semibold mb-1 first:mb-0" role="status" aria-label="Product tag: {{ $tag['label'] }}">
                          {{ $tag['label'] }}
                        </span>
                      @endforeach
                    </div>
                  </div>
                  <div class="p-3 sm:p-4">
                    <div class="mb-2">
                      <span class="text-base sm:text-lg font-bold text-gray-900" itemprop="price">{{ $prod->showPrice() }}</span>
                      @if($prod->showPreviousPrice() && $prod->showPreviousPrice() != $prod->showPrice())
                      <span class="text-xs sm:text-sm text-gray-500 line-through ml-2">{{ $prod->showPreviousPrice() }}</span>
                      @endif
                    </div>
                    <h3 id="product-{{ $prod->id }}-desc" class="text-xs sm:text-sm font-medium text-gray-900 line-clamp-2 leading-relaxed" itemprop="name" title="{{$prod->name}}">
                      {{ ucfirst(mb_strtolower($prod->showName())) }}
                    </h3>
                  </div>
                </a>
                <div class="px-3 sm:px-4 pb-3 sm:pb-4">
                  <div class="flex items-center space-x-2">
                    <a href="#"
                       class="flex-1 flex items-center justify-center px-2 sm:px-3 py-2 bg-orange-600 text-white text-xs sm:text-sm font-medium hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-colors duration-200 add-to-cart-btn"
                       data-id="{{ $prod->id }}"
                       role="button"
                       tabindex="0"
                       aria-label="Add {{ $prod->name }} to shopping cart">
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="mr-1 sm:mr-2" aria-hidden="true" focusable="false">
                        <path d="M6 2L3 6v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6l-3-4H6z"></path>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <path d="M16 10c0 2.2-1.8 4-4 4s-4-1.8-4-4"></path>
                      </svg>
                      <span class="hidden sm:inline">Add to Cart</span>
                      <span class="sm:hidden">Cart</span>
                    </a>
                    <a href="#"
                       class="p-2 text-gray-400 hover:text-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors duration-200 add-wishlist-btn"
                       data-id="{{ $prod->id }}"
                       role="button"
                       tabindex="0"
                       aria-label="Add {{ $prod->name }} to wishlist">
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                      </svg>
                    </a>
                  </div>
                </div>
              </article>
            </div>
            @endforeach
          </div>
        </div>

        <!-- Navigation arrows -->
        <div class="swiper-button-next bestseller-nav-next !text-gray-600 !w-10 !h-10 !mt-0 !top-1/2 !-translate-y-1/2 !-right-5 after:!text-lg !bg-white !rounded-full !shadow-md hover:!bg-gray-50 !transition-all !duration-200" aria-label="Next products"></div>
        <div class="swiper-button-prev bestseller-nav-prev !text-gray-600 !w-10 !h-10 !mt-0 !top-1/2 !-translate-y-1/2 !-left-5 after:!text-lg !bg-white !rounded-full !shadow-md hover:!bg-gray-50 !transition-all !duration-200" aria-label="Previous products"></div>
      </div>
    </div>
  </section>
  @endif

  @if($ps->deal_of_the_day==1)
  <!-- Special Offer Banner -->
  <section class="py-12 lg:py-16 bg-gray-50" aria-labelledby="special-offer-title" role="region">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-10 gap-6 lg:gap-8 items-stretch">

        <!-- Banner Image (70% width on desktop) -->
        <div class="lg:col-span-7">
          <div class="relative h-64 sm:h-80 lg:h-full min-h-[300px] overflow-hidden">
            <img
              src="{{ asset('assets/frontend/images/special-sale.png') }}"
              alt="Celigin daily sun finish sunscreen with natural ingredients"
              width="400"
              height="500"
              loading="lazy"
              decoding="async"
              class="w-full h-full object-cover" />
          </div>
        </div>

        <!-- Content Section (30% width on desktop) -->
        <div class="lg:col-span-3 flex flex-col justify-center p-6 lg:p-8">
          <header class="mb-6">
            <div class="flex items-center justify-start mb-4">
              <span class="inline-block px-3 py-1 text-green-900 text-xs font-bold uppercase tracking-wide" role="status" aria-label="Special offer badge">Special Offer</span>
              <span class="inline-block px-3 py-1 bg-green-600 text-white text-sm font-bold ml-2" role="status" aria-label="25 percent discount">-25%</span>
            </div>

            <h2 id="special-offer-title" class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900 mb-4 leading-tight">
              Celigin daily sun finish<br />
              (50ml) with coscor<br />
              1,000ppm
            </h2>

            <p class="text-sm sm:text-base text-gray-600 mb-6 leading-relaxed">
              Experience superior sun protection with SPF 50+ and PA+++ in our SUNFINISH sunscreen.
            </p>
          </header>
          

          <!-- CTA Button -->
          <footer>
            <a href="{{ route('front.category') }}"
               class="inline-flex items-center justify-center w-full sm:w-auto px-4 sm:px-6 py-2 sm:py-3 bg-orange-600 text-white font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-all duration-200 text-sm sm:text-base"
               aria-label="Get special offer price of ₹39.00">
              Get Only ₹39.00
            </a>
          </footer>
          </div>
        </div>

      </div>
    </div>
  </section>
  @endif
  
  <!-- Hot Deals -->
  <section class="py-12 lg:py-16 bg-red-50" aria-labelledby="hotdeals-title" role="region">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 lg:mb-12 gap-4">
        <h2 id="hotdeals-title" class="text-2xl lg:text-3xl font-bold text-gray-900 flex items-center">
          <span class="mr-3">🔥</span>Hot Deals
        </h2>
        <a href="{{ route('front.sales') }}"
           class="inline-flex items-center text-sm font-medium text-red-600 hover:text-red-700 transition-colors duration-200 group focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
           aria-label="View all hot deals and sales">
          Shop all hot deals
          <svg
            width="16"
            height="16"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            class="ml-2 w-4 h-4 group-hover:translate-x-1 transition-transform duration-200"
            aria-hidden="true"
            focusable="false">
            <line x1="7" y1="17" x2="17" y2="7"></line>
            <polyline points="7,7 17,7 17,17"></polyline>
          </svg>
        </a>
      </div>

      <div class="relative">
        <div class="hotdeals-swiper swiper">
          <div class="swiper-wrapper">
            @foreach($hot_products as $prod)
            <div class="swiper-slide">
              <article class="bg-white shadow-sm overflow-hidden group hover:shadow-md transition-all duration-300 border border-red-100" itemscope itemtype="https://schema.org/Product">
                <a href="{{ url('/item/'.$prod->slug) }}"
                   class="block focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                   aria-describedby="hotdeal-{{ $prod->id }}-desc">
                  <div class="relative aspect-square overflow-hidden">
                    <img
                      src="{{ $prod->thumbnail ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"
                      alt="{{ $prod->name }} - Limited time hot deal product"
                      width="300"
                      height="300"
                      loading="lazy"
                      decoding="async"
                      itemprop="image"
                      class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                    <div class="absolute top-2 left-2 sm:top-3 sm:left-3 flex flex-col space-y-1">
                      <span class="inline-block px-2 py-1 bg-red-600 text-white text-xs font-semibold" role="status" aria-label="Product tag: Hot Deal">
                        🔥 Hot
                      </span>
                      @if (round($prod->offPercentage() )>0)
                      <span class="inline-block px-2 py-1 bg-orange-600 text-white text-xs font-semibold" role="status" aria-label="Discount: {{ round($prod->offPercentage() )}} percent off">
                        -{{ round($prod->offPercentage() )}}%
                      </span>
                      @endif
                    </div>
                  </div>
                  <div class="p-3 sm:p-4">
                    <div class="mb-2">
                      <span class="text-base sm:text-lg font-bold text-red-600" itemprop="price">{{ $prod->showPrice() }}</span>
                      @if($prod->showPreviousPrice() && $prod->showPreviousPrice() != $prod->showPrice())
                      <span class="text-xs sm:text-sm text-gray-500 line-through ml-2">{{ $prod->showPreviousPrice() }}</span>
                      @endif
                    </div>
                    <h3 id="hotdeal-{{ $prod->id }}-desc" class="text-xs sm:text-sm font-medium text-gray-900 line-clamp-2 leading-relaxed" itemprop="name" title="{{$prod->name}}">
                      {{ ucfirst(mb_strtolower($prod->showName())) }}
                    </h3>
                  </div>
                </a>
                <div class="px-3 sm:px-4 pb-3 sm:pb-4">
                  <div class="flex items-center space-x-2">
                    <a href="#"
                       class="flex-1 flex items-center justify-center px-2 sm:px-3 py-2 bg-red-600 text-white text-xs sm:text-sm font-medium hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors duration-200 add-to-cart-btn"
                       data-id="{{ $prod->id }}"
                       role="button"
                       tabindex="0"
                       aria-label="Add {{ $prod->name }} to shopping cart">
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="mr-1 sm:mr-2" aria-hidden="true" focusable="false">
                        <path d="M6 2L3 6v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6l-3-4H6z"></path>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <path d="M16 10c0 2.2-1.8 4-4 4s-4-1.8-4-4"></path>
                      </svg>
                      <span class="hidden sm:inline">Add to Cart</span>
                      <span class="sm:hidden">Cart</span>
                    </a>
                    <a href="#"
                       class="p-2 text-gray-400 hover:text-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors duration-200 add-wishlist-btn"
                       data-id="{{ $prod->id }}"
                       role="button"
                       tabindex="0"
                       aria-label="Add {{ $prod->name }} to wishlist">
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                      </svg>
                    </a>
                  </div>
                </div>
              </article>
            </div>
            @endforeach
          </div>
        </div>

        <!-- Navigation arrows -->
        <div class="swiper-button-next hotdeals-nav-next !text-red-600 !w-10 !h-10 !mt-0 !top-1/2 !-translate-y-1/2 !-right-5 after:!text-lg !bg-white !rounded-full !shadow-md hover:!bg-red-50 !transition-all !duration-200" aria-label="Next hot deals"></div>
        <div class="swiper-button-prev hotdeals-nav-prev !text-red-600 !w-10 !h-10 !mt-0 !top-1/2 !-translate-y-1/2 !-left-5 after:!text-lg !bg-white !rounded-full !shadow-md hover:!bg-red-50 !transition-all !duration-200" aria-label="Previous hot deals"></div>
      </div>
    </div>
  </section>

  <!-- Instagram Feed -->
  <section class="py-12 lg:py-16 bg-gray-50" aria-labelledby="instagram-title">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between mb-8 lg:mb-12">
        <div class="flex items-center space-x-3">
          <div class="flex items-center justify-center w-10 h-10 bg-gradient-to-br from-purple-600 via-pink-600 to-orange-600 rounded-lg">
            <svg
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              stroke="white"
              stroke-width="2"
              class="w-6 h-6">
              <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
              <path
                d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
              <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
            </svg>
          </div>
          <h2 id="instagram-title" class="text-2xl lg:text-3xl font-bold text-gray-900">Instagram Feed</h2>
        </div>
        <a href="#" class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors duration-200 group">
          View all feeds
          <svg
            width="16"
            height="16"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            class="ml-2 w-4 h-4 group-hover:translate-x-1 transition-transform duration-200">
            <line x1="7" y1="17" x2="17" y2="7"></line>
            <polyline points="7,7 17,7 17,17"></polyline>
          </svg>
        </a>
      </div>

      <div
        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8"
        role="region"
        aria-label="Instagram posts">
        <article class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300">
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
        <article class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300">
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
        <article class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300">
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

      </div>
    </div>
  </section>

  <!-- Join CELIGIN Banner -->
  <section class="py-12 lg:py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
        <div class="relative overflow-hidden group cursor-pointer">
          <img
            src="{{ asset('assets/frontend/images/join-club-banner.png') }}"
            alt="Join CELIGIN Club - Become a Brand Ambassador"
            class="w-full h-64 lg:h-80 object-cover group-hover:scale-105 transition-transform duration-300" />
          <div class="absolute inset-y-0 left-0 w-1/2 flex flex-col justify-center text-left p-6">
            <span class="inline-block px-3 py-1 bg-orange-600 text-white text-xs font-semibold rounded-full mb-4 uppercase tracking-wide w-fit">JOIN CELIGIN CLUB</span>
            <h3 class="text-2xl lg:text-3xl font-bold text-black mb-6">Become a Brand Ambassador</h3>
            <a href="/join" class="inline-flex items-center px-4 py-2 bg-orange-600 text-white font-medium hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-all duration-200 w-fit text-sm" aria-label="Join CELIGIN Club to become a brand ambassador">
              Join Now
            </a>
          </div>
        </div>

        <div class="relative overflow-hidden group cursor-pointer">
          <img
            src="{{ asset('assets/frontend/images/cell-education-banner.png') }}"
            alt="Cell For Education - CELIGIN Skincare Products"
            class="w-full h-64 lg:h-80 object-cover group-hover:scale-105 transition-transform duration-300" />
          <div class="absolute inset-x-0 bottom-0 flex items-end justify-between p-6">
            <h3 class="text-2xl lg:text-3xl font-bold text-black">Cell For Education</h3>
            <a href="/education" class="inline-flex items-center px-4 py-2 bg-orange-600 text-white font-medium hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-all duration-200 text-sm" aria-label="Learn more about Cell For Education program">
              Read More
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  @if($ps->blog==1)
  <!-- Blog Section -->
  <section class="py-12 lg:py-16 bg-gray-50" aria-labelledby="blog-title">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between mb-8 lg:mb-12">
        <h2 id="blog-title" class="text-2xl lg:text-3xl font-bold text-gray-900">Blog</h2>
        <a href="/blog" class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors duration-200 group">
          View all posts
          <svg
            width="16"
            height="16"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            class="ml-2 w-4 h-4 group-hover:translate-x-1 transition-transform duration-200">
            <line x1="7" y1="17" x2="17" y2="7"></line>
            <polyline points="7,7 17,7 17,17"></polyline>
          </svg>
        </a>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8" role="region" aria-label="Latest blog posts">

        @foreach($blogs as $blog)
        <article class="bg-white shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300 group">
          <div class="aspect-w-16 aspect-h-12 overflow-hidden">
            <img
              src="{{ $blog->photo ? asset('assets/images/blogs/'.$blog->photo):asset('assets/images/noimage.png')}}"
              alt="{{ $blog->title }}"
              width="400"
              height="300"
              class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300" />
          </div>
          <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-3 line-clamp-2">{{ Str::limit($blog->title, 25) }}</h3>
            <a href="{{ route('front.blogshow',$blog->slug) }}" class="inline-flex items-center text-sm font-medium text-orange-600 hover:text-orange-700 transition-colors duration-200 group">
              Read More
              <svg
                width="16"
                height="16"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                class="ml-2 w-4 h-4 group-hover:translate-x-1 transition-transform duration-200">
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

@endsection

@section('scripts')

<script>
  document.addEventListener('DOMContentLoaded', function () {

    const csrfToken = '{{ csrf_token() }}'; // Store once, use multiple times

    // Utility function to handle fetch requests
    function handleAction(url, successCallback, errorCallback) {
      // Show loading state
      const loadingToast = toastr.info('Processing...', '', { timeOut: 0, closeButton: false });

      fetch(url, {
        method: 'GET',
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        }
      })
        .then(response => {
          // Clear loading toast
          toastr.clear(loadingToast);

          if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
          }
          return response.json();
        })
        .then(data => {
          if (data.success) {
            toastr.success(data.message || 'Action completed successfully!');
            if (typeof successCallback === 'function') {
              successCallback(data);
            }
          } else {
            toastr.warning(data.message || 'Something went wrong. Please try again.');
            if (typeof errorCallback === 'function') {
              errorCallback(data);
            }
          }
        })
        .catch(error => {
          // Clear loading toast
          toastr.clear(loadingToast);

          console.error('Request Error:', error);
          toastr.error('Network error occurred. Please check your connection and try again.');

          if (typeof errorCallback === 'function') {
            errorCallback({ error: error.message });
          }
        });
    }

    // Event delegation for Add to Cart buttons (works with dynamic content)
    document.addEventListener('click', function(e) {
      // Handle Add to Cart buttons
      if (e.target.closest('.add-to-cart-btn')) {
        e.preventDefault();

        const button = e.target.closest('.add-to-cart-btn');
        const productId = button.dataset.id;

        if (!productId) {
          toastr.error('Product ID not found. Please try again.');
          return;
        }

        // Disable button during request
        button.disabled = true;
        button.style.opacity = '0.6';

        handleAction(
          `/celiginus/addcart/${productId}`,
          // Success callback
          function(data) {
            if (data.cart_count !== undefined) {
              updateCartCount(data.cart_count);
            }
            // Re-enable button
            button.disabled = false;
            button.style.opacity = '1';
          },
          // Error callback
          function(data) {
            // Re-enable button on error
            button.disabled = false;
            button.style.opacity = '1';
          }
        );
      }

      // Handle Add to Wishlist buttons
      if (e.target.closest('.add-wishlist-btn')) {
        e.preventDefault();

        const button = e.target.closest('.add-wishlist-btn');
        const productId = button.dataset.id;

        if (!productId) {
          toastr.error('Product ID not found. Please try again.');
          return;
        }

        // Disable button during request
        button.disabled = true;
        button.style.opacity = '0.6';

        handleAction(
          `/celiginus/addwishlist/${productId}`,
          // Success callback
          function(data) {
            if (data.wishlist_count !== undefined) {
              updateWishlistCount(data.wishlist_count);
            }

            // Optional: Change heart icon to filled state
            const heartIcon = button.querySelector('svg path');
            if (heartIcon) {
              heartIcon.setAttribute('fill', 'currentColor');
              button.classList.add('text-red-500');
              button.classList.remove('text-gray-400');
            }

            // Re-enable button
            button.disabled = false;
            button.style.opacity = '1';
          },
          // Error callback
          function(data) {
            // Re-enable button on error
            button.disabled = false;
            button.style.opacity = '1';
          }
        );
      }
    });

    // Initialize Swiper carousels after DOM is ready
    setTimeout(function() {
      initializeCarousels();
    }, 100);

  });

  // Initialize carousel functionality
  function initializeCarousels() {
    // Bestsellers Swiper
    if (document.querySelector('.bestseller-swiper')) {
      new Swiper('.bestseller-swiper', {
        slidesPerView: 1,
        spaceBetween: 20,
        navigation: {
          nextEl: '.bestseller-nav-next',
          prevEl: '.bestseller-nav-prev',
        },
        breakpoints: {
          640: {
            slidesPerView: 2,
            spaceBetween: 20,
          },
          768: {
            slidesPerView: 3,
            spaceBetween: 24,
          },
          1024: {
            slidesPerView: 4,
            spaceBetween: 24,
          },
        },
        loop: true,
        autoplay: {
          delay: 4000,
          disableOnInteraction: false,
        }
      });
    }

    // Hot Deals Swiper
    if (document.querySelector('.hotdeals-swiper')) {
      new Swiper('.hotdeals-swiper', {
        slidesPerView: 1,
        spaceBetween: 20,
        navigation: {
          nextEl: '.hotdeals-nav-next',
          prevEl: '.hotdeals-nav-prev',
        },
        breakpoints: {
          640: {
            slidesPerView: 2,
            spaceBetween: 20,
          },
          768: {
            slidesPerView: 3,
            spaceBetween: 24,
          },
          1024: {
            slidesPerView: 4,
            spaceBetween: 24,
          },
        },
        loop: true,
        autoplay: {
          delay: 5000,
          disableOnInteraction: false,
        }
      });
    }

    // Hero Swiper
    if (document.querySelector('.hero-swiper')) {
      new Swiper('.hero-swiper', {
        slidesPerView: 1,
        spaceBetween: 0,
        navigation: {
          nextEl: '.hero-nav-next',
          prevEl: '.hero-nav-prev',
        },
        pagination: {
          el: '.hero-pagination',
          clickable: true,
        },
        loop: true,
        autoplay: {
          delay: 6000,
          disableOnInteraction: false,
        },
        effect: 'fade',
        fadeEffect: {
          crossFade: true
        }
      });
    }
  }

  // Utility function to safely update cart count (defined globally)
  if (typeof window.updateCartCount === 'undefined') {
    window.updateCartCount = function(count) {
      const cartCountElement = document.getElementById('cart-count');
      if (cartCountElement) {
        cartCountElement.textContent = count;
        cartCountElement.setAttribute('aria-label', `${count} items in cart`);
      }
    };
  }

  // Utility function to safely update wishlist count (defined globally)
  if (typeof window.updateWishlistCount === 'undefined') {
    window.updateWishlistCount = function(count) {
      const wishlistCountElement = document.getElementById('wishlist-count');
      if (wishlistCountElement) {
        wishlistCountElement.textContent = count;
        wishlistCountElement.setAttribute('aria-label', `${count} items in wishlist`);
      }
    };
  }
</script>

@endSection