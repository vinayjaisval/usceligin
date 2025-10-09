@extends('frontend.include.app')

@section('content')
<!-- Main Content -->
<main id="main-content" role="main" class="bg-white dark:bg-gray-900">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <!-- Breadcrumb Navigation -->
    <nav aria-label="Breadcrumb" class="mb-6">
      <ol class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400">
        <li>
          <a href="index.html" class="hover:text-gray-900 dark:hover:text-gray-100 transition-colors duration-200">Home</a>
        </li>
        <li class="flex items-center">
          <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
          <span class="text-gray-900 dark:text-gray-100" aria-current="page">
            Travel Size Moroccanoil Treatment Hair Oil
          </span>
        </li>
      </ol>
    </nav>

    <!-- Loading Spinner -->
    <div class="hidden fixed inset-0 bg-white dark:bg-gray-900 bg-opacity-90 dark:bg-opacity-90 z-50 flex items-center justify-center" id="loading-section">
      <div class="text-center">
        <div class="inline-block w-12 h-12 border-4 border-orange-600 border-t-transparent animate-spin"></div>
        <p class="mt-4 text-gray-900 dark:text-gray-100">Loading product...</p>
      </div>
    </div>

    <!-- Product Detail Section -->
    <section role="main">

      <!-- Free Shipping Banner -->
      <div class="bg-orange-50 dark:bg-orange-900/20 border border-orange-200 dark:border-orange-800 p-4 mb-6 text-center">
        <span class="text-gray-900 dark:text-gray-100"><strong>FREE SHIPPING on all Beauty Steals!®</strong></span>
        <span class="text-sm text-gray-600 dark:text-gray-400 ml-2">Diamond & Platinum members only.</span>
      </div>



      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
        <!-- Product Images -->
        <div class="space-y-4 lg:sticky lg:top-6 lg:self-start">
          <div class="aspect-square bg-gray-100 dark:bg-gray-800 overflow-hidden">
            <img
              src="{{filter_var($productt->photo, FILTER_VALIDATE_URL) ?$productt->photo:asset('assets/images/products/'.$productt->photo)}}"
              alt="Travel Size Moroccanoil Treatment Hair Oil - Main product image"
              width="500"
              height="500"
              class="w-full h-full object-cover" />
          </div>
          <div class="grid grid-cols-4 sm:grid-cols-6 gap-2">
            @foreach($productt->galleries as $gal)
            <a href="#"
              class="aspect-square border-2 border-transparent hover:border-orange-600 dark:hover:border-orange-400 transition-colors duration-200 bg-gray-100 dark:bg-gray-800 overflow-hidden focus:outline-none focus:ring-2 focus:ring-orange-500 gallery-thumbnail"
              data-image="{{asset('assets/images/galleries/'.$gal->photo)}}"
              aria-label="View product image">
              <img
                src="{{asset('assets/images/galleries/'.$gal->photo)}}"
                alt="{{ $productt->name }} - Product view"
                width="80"
                height="80"
                class="w-full h-full object-cover" />
            </a>
            @endforeach
          </div>
        </div>

        <!-- Product Information -->
        <div class="space-y-5">
          <div>
            <h1 class="text-sm font-medium text-orange-600 dark:text-orange-400 uppercase tracking-wide">{{ ucfirst(mb_strtolower($productt->cat->title ?? '')) }}</h1>
          </div>
          <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 leading-tight">
            {{ ucfirst(mb_strtolower($productt->name)) }}
          </h2>

          <!-- Rating -->
          <div class="flex items-center gap-3" aria-label="{{ App\Models\Rating::ratings($productt->id) }} out of 5 stars">
            <div class="flex items-center">
              @php
                $rating = App\Models\Rating::ratings($productt->id);
                $fullStars = floor($rating);
                $hasHalfStar = ($rating - $fullStars) >= 0.5;
              @endphp
              @for($i = 1; $i <= 5; $i++)
                @if($i <= $fullStars)
                  <svg class="w-5 h-5 text-yellow-500 fill-current" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                  </svg>
                @elseif($i == $fullStars + 1 && $hasHalfStar)
                  <svg class="w-5 h-5 text-yellow-500" viewBox="0 0 24 24" aria-hidden="true">
                    <path fill="currentColor" d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" opacity="0.3"/>
                    <path stroke="currentColor" stroke-width="2" fill="none" d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                  </svg>
                @else
                  <svg class="w-5 h-5 text-yellow-500" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke="currentColor" stroke-width="2" fill="none" d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                  </svg>
                @endif
              @endfor
            </div>
            <span class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ number_format($rating, 1) }}</span>
            <a href="#reviews" class="text-sm text-orange-600 dark:text-orange-400 hover:underline">({{ App\Models\Rating::ratingCount($productt->id) }}) Reviews</a>
          </div>

          <!-- Price -->
          <div>
            <div class="flex items-center gap-3">
              <span class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $productt->showPrice() }}</span>
              @if($productt->showPreviousPrice() && $productt->showPreviousPrice() != $productt->showPrice())
                <span class="text-xl text-gray-500 dark:text-gray-400 line-through">{{ $productt->showPreviousPrice() }}</span>
              @endif
            </div>
          </div>

          <!-- Pickup and Delivery Options -->
          <div class="border-t border-gray-200 dark:border-gray-700 pt-5">
            <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100 mb-4">Pickup and delivery options</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
              <a href="#" class="flex items-start space-x-3 p-4 border-2 border-orange-600 dark:border-orange-400 bg-orange-50 dark:bg-orange-900/20 hover:bg-orange-100 dark:hover:bg-orange-900/30 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-orange-500 delivery-option" data-option="ship">
                <svg
                  class="w-5 h-5 text-gray-900 dark:text-gray-100 flex-shrink-0"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  aria-hidden="true">
                  <rect x="1" y="3" width="15" height="13"></rect>
                  <polygon points="16,8 20,8 23,11 23,16 16,16 16,8"></polygon>
                  <circle cx="5.5" cy="18.5" r="2.5"></circle>
                  <circle cx="18.5" cy="18.5" r="2.5"></circle>
                </svg>
                <div class="text-left">
                  <div class="font-semibold text-gray-900 dark:text-gray-100">Ship</div>
                  <div class="text-sm text-gray-600 dark:text-gray-400">Free standard shipping over ₹35</div>
                </div>
              </a>

              <a href="#" class="flex items-start space-x-3 p-4 border-2 border-gray-200 dark:border-gray-700 hover:border-orange-600 dark:hover:border-orange-400 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-orange-500 delivery-option" data-option="pickup">
                <svg
                  class="w-5 h-5 text-gray-900 dark:text-gray-100 flex-shrink-0"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  aria-hidden="true">
                  <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                  <polyline points="9,22 9,12 15,12 15,22"></polyline>
                </svg>
                <div class="text-left">
                  <div class="font-semibold text-gray-900 dark:text-gray-100">Pickup</div>
                  <div class="text-sm text-gray-600 dark:text-gray-400">Free ship to pick up</div>
                </div>
              </a>

              <a href="#" class="flex items-start space-x-3 p-4 border-2 border-gray-200 dark:border-gray-700 hover:border-orange-600 dark:hover:border-orange-400 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-orange-500 delivery-option" data-option="same-day">
                <svg
                  class="w-5 h-5 text-gray-900 dark:text-gray-100 flex-shrink-0"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  aria-hidden="true">
                  <circle cx="12" cy="12" r="10"></circle>
                  <polyline points="12,6 12,12 16,14"></polyline>
                </svg>
                <div class="text-left">
                  <div class="font-semibold text-gray-900 dark:text-gray-100">Same day</div>
                  <div class="text-sm text-gray-600 dark:text-gray-400">Free same day delivery over ₹35</div>
                </div>
              </a>
            </div>
          </div>

          <!-- Quantity, Add to Cart & Wishlist -->
          <div class="border-t border-gray-200 dark:border-gray-700 pt-5 space-y-4">
            <div class="flex items-stretch gap-3">
              <!-- Decrease Button -->
              <a href="#"
                id="decrease-qty"
                class="flex items-center justify-center w-12 h-12 border-2 border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-orange-500"
                aria-label="Decrease quantity">
                <svg
                  class="w-4 h-4 text-gray-900 dark:text-gray-100"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  aria-hidden="true">
                  <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
              </a>

              <!-- Quantity Display -->
              <div class="flex items-center justify-center min-w-[3rem] h-12 px-4 border-2 border-gray-300 dark:border-gray-600">
                <span id="product-quantity" class="text-lg font-semibold text-gray-900 dark:text-gray-100">1</span>
              </div>

              <!-- Increase Button -->
              <a href="#"
                id="increase-qty"
                class="flex items-center justify-center w-12 h-12 border-2 border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-orange-500"
                aria-label="Increase quantity">
                <svg
                  class="w-4 h-4 text-gray-900 dark:text-gray-100"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  aria-hidden="true">
                  <line x1="12" y1="5" x2="12" y2="19"></line>
                  <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
              </a>

              <!-- Wishlist Button -->
              <a href="#"
                id="add-to-wishlist-btn"
                data-product-id="{{ $productt->id }}"
                class="flex items-center justify-center w-12 h-12 border-2 border-gray-300 dark:border-gray-600 hover:border-red-500 dark:hover:border-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-500"
                aria-label="Add to wishlist">
                <svg
                  class="w-5 h-5 text-gray-600 dark:text-gray-400"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  aria-hidden="true">
                  <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                </svg>
              </a>
            </div>

            <!-- Add to Cart Button -->
            <a href="#"
              id="add-to-cart-btn"
              data-product-id="{{ $productt->id }}"
              class="block w-full text-center bg-orange-600 hover:bg-orange-700 dark:bg-orange-500 dark:hover:bg-orange-600 text-white py-4 font-semibold transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900"
              aria-label="Add {{ $productt->name }} to cart">
              Add to Cart
            </a>

            <p class="text-sm text-green-600 dark:text-green-400">
              @if($productt->stock && $productt->stock > 0)
                In stock and ready to ship. Usually ships out in 1-2 days
              @else
                <span class="text-red-600 dark:text-red-400">Out of stock</span>
              @endif
            </p>
          </div>

          <!-- Product Summary -->
          <div class="border-t border-gray-200 dark:border-gray-700 pt-5 space-y-5">
            <div>
              <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">Summary</h3>
              <div class="mb-4">
                <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-3">Highlights</h4>
                <div class="flex flex-wrap gap-2">
                  <span class="inline-flex items-center space-x-1 px-2 py-1 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-xs text-gray-900 dark:text-gray-100">
                    <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                      <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                      <polyline points="22,4 12,14.01 9,11.01"></polyline>
                    </svg>
                    <span>Clean Ingredients</span>
                  </span>
                  <span class="inline-flex items-center space-x-1 px-2 py-1 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 text-xs text-gray-900 dark:text-gray-100">
                    <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                      <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                    </svg>
                    <span>Cruelty Free</span>
                  </span>
                  <span class="inline-flex items-center space-x-1 px-2 py-1 bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-800 text-xs text-gray-900 dark:text-gray-100">
                    <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                      <path d="M17 8l4 4-4 4M7 8l-4 4 4 4"></path>
                      <path d="M12 2v20"></path>
                    </svg>
                    <span>Vegan</span>
                  </span>
                  <span class="inline-flex items-center space-x-1 px-2 py-1 bg-teal-50 dark:bg-teal-900/20 border border-teal-200 dark:border-teal-800 text-xs text-gray-900 dark:text-gray-100">
                    <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                      <path d="M3 12h18m-9-9v18"></path>
                    </svg>
                    <span>Sustainable</span>
                  </span>
                  <span class="inline-flex items-center space-x-1 px-2 py-1 bg-pink-50 dark:bg-pink-900/20 border border-pink-200 dark:border-pink-800 text-xs text-gray-900 dark:text-gray-100">
                    <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                      <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                    </svg>
                    <span>Give Back</span>
                  </span>
                </div>
              </div>
            </div>

            <div>
              <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                {{ $productt->summary ?? 'Discover premium quality beauty products designed to enhance your natural radiance. Formulated with carefully selected ingredients for optimal results.' }}
              </p>
            </div>

            <!-- Expandable Sections -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-5">
              <!-- Details Accordion -->
              <div class="accordion-item border-b border-gray-200 dark:border-gray-700">
                <a href="#"
                  class="accordion-trigger w-full flex items-center justify-between py-4 px-4 text-left hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-orange-500"
                  aria-expanded="false"
                  data-accordion="details">
                  <span class="text-base font-semibold text-gray-900 dark:text-gray-100">Details</span>
                  <svg
                    class="accordion-icon w-4 h-4 text-gray-900 dark:text-gray-100 transition-transform duration-200"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    aria-hidden="true">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                  </svg>
                </a>
                <div class="accordion-content hidden py-4 px-4 mt-1 mb-4 text-sm text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-800/50" id="details-content">
                  {!! $productt->description ?? '<p>Detailed product information coming soon.</p>' !!}
                </div>
              </div>

              <!-- How To Use Accordion -->
              <div class="accordion-item border-b border-gray-200 dark:border-gray-700">
                <a href="#"
                  class="accordion-trigger w-full flex items-center justify-between py-4 px-4 text-left hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-orange-500"
                  aria-expanded="false"
                  data-accordion="how-to-use">
                  <span class="text-base font-semibold text-gray-900 dark:text-gray-100">How To Use</span>
                  <svg
                    class="accordion-icon w-4 h-4 text-gray-900 dark:text-gray-100 transition-transform duration-200"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    aria-hidden="true">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                  </svg>
                </a>
                <div class="accordion-content hidden py-4 px-4 mt-1 mb-4 text-sm text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-800/50" id="how-to-use-content">
                  <ol class="list-decimal list-inside space-y-2">
                    <li>Apply a small amount to clean, damp skin or hair</li>
                    <li>Gently massage in circular motions</li>
                    <li>Allow to absorb fully before applying other products</li>
                    <li>Use daily for best results</li>
                  </ol>
                </div>
              </div>

              <!-- Ingredients Accordion -->
              <div class="accordion-item border-b border-gray-200 dark:border-gray-700">
                <a href="#"
                  class="accordion-trigger w-full flex items-center justify-between py-4 px-4 text-left hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-orange-500"
                  aria-expanded="false"
                  data-accordion="ingredients">
                  <span class="text-base font-semibold text-gray-900 dark:text-gray-100">Ingredients</span>
                  <svg
                    class="accordion-icon w-4 h-4 text-gray-900 dark:text-gray-100 transition-transform duration-200"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    aria-hidden="true">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                  </svg>
                </a>
                <div class="accordion-content hidden py-4 px-4 mt-1 mb-4 text-sm text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-800/50" id="ingredients-content">
                  <p class="leading-relaxed">
                    {{ $productt->ingredients ?? 'Aqua, Glycerin, Natural Extracts, Vitamin E, Hyaluronic Acid, and other premium ingredients. Full ingredient list available on product packaging.' }}
                  </p>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>

    </section>
  </div>

  <!-- Recommendations -->
  <section class="py-12 lg:py-16 bg-gray-50 dark:bg-gray-800" aria-labelledby="recommendations-title" role="region">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 lg:mb-12 gap-4">
            <h2 id="recommendations-title" class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 dark:text-gray-100">Recommendations</h2>
            <a href="{{ route('front.best-sellers') }}"
               class="inline-flex items-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors duration-200 group focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 "
               aria-label="View all recommended products">
              Shop all recommendations
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
                @foreach (App\Models\Product::where('type',$productt->type)->where('product_type',$productt->product_type)->withCount('ratings')->withAvg('ratings','rating')->take(12)->get() as $prod)
                <div class="swiper-slide">
                  <article class="bg-white dark:bg-gray-800 shadow-sm overflow-hidden group hover:shadow-md transition-all duration-300 " itemscope itemtype="https://schema.org/Product">
                    <a href="{{ url('/item/'.$prod->slug) }}"
                       class="block focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 "
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
                            <span class="inline-block px-2 py-1 {{ $tag['class'] }} text-white text-sm font-semibold mb-1 first:mb-0" role="status" aria-label="Product tag: {{ $tag['label'] }}">
                              {{ $tag['label'] }}
                            </span>
                          @endforeach
                        </div>
                      </div>
                      <div class="p-3 sm:p-4">
                        <div class="mb-2">
                          <span class="text-base font-bold text-gray-900 dark:text-gray-100" itemprop="price">{{ $prod->showPrice() }}</span>
                          @if($prod->showPreviousPrice() && $prod->showPreviousPrice() != $prod->showPrice())
                          <span class="text-sm text-gray-500 dark:text-gray-400 line-through ml-2">{{ $prod->showPreviousPrice() }}</span>
                          @endif
                        </div>
                        <h3 id="product-{{ $prod->id }}-desc" class="text-sm font-medium text-gray-900 dark:text-gray-100 line-clamp-2 leading-relaxed" itemprop="name" title="{{$prod->name}}">
                          {{ ucfirst(mb_strtolower($prod->showName())) }}
                        </h3>
                      </div>
                    </a>
                    <div class="px-3 sm:px-4 pb-3 sm:pb-4">
                      <div class="flex items-center space-x-2">
                        <a href="#"
                           class="flex-1 flex items-center justify-center px-2 sm:px-3 py-2 bg-orange-600 text-white text-sm font-medium hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-colors duration-200 add-to-cart-btn"
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
            <div class="swiper-button-next bestseller-nav-next !text-gray-600 !w-10 !h-10 !mt-0 !top-1/2 !-translate-y-1/2 !-right-5 after:!text-lg !bg-white !rounded-none !shadow-md hover:!bg-gray-50 !transition-all !duration-200" aria-label="Next products"></div>
            <div class="swiper-button-prev bestseller-nav-prev !text-gray-600 !w-10 !h-10 !mt-0 !top-1/2 !-translate-y-1/2 !-left-5 after:!text-lg !bg-white !rounded-none !shadow-md hover:!bg-gray-50 !transition-all !duration-200" aria-label="Previous products"></div>
          </div>
        </div>
  </section>
</main>

@endsection
@section('scripts')

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = '{{ csrf_token() }}';

    // ========================================
    // DOM Element Caching
    // ========================================
    const productQuantity = document.getElementById('product-quantity');
    const decreaseQty = document.getElementById('decrease-qty');
    const increaseQty = document.getElementById('increase-qty');
    const addToCartBtn = document.getElementById('add-to-cart-btn');
    const addToWishlistBtn = document.getElementById('add-to-wishlist-btn');
    const cartCount = document.getElementById('cart-count');
    const cartCountMobile = document.getElementById('cart-count-mobile');
    const wishlistCount = document.getElementById('wishlist-count');
    const wishlistCountMobile = document.getElementById('wishlist-count-mobile');

    // ========================================
    // Utility Functions
    // ========================================
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

    function updateCounter(element, value) {
      if (element) {
        element.textContent = value;
      }
    }

    // ========================================
    // Quantity Controls
    // ========================================
    let quantity = 1;
    const maxQuantity = {{ $productt->stock ?? 99 }};

    if (decreaseQty) {
      decreaseQty.addEventListener('click', function (e) {
        e.preventDefault();
        if (quantity > 1) {
          quantity--;
          productQuantity.textContent = quantity;
        }
      });
    }

    if (increaseQty) {
      increaseQty.addEventListener('click', function (e) {
        e.preventDefault();
        if (quantity < maxQuantity) {
          quantity++;
          productQuantity.textContent = quantity;
        } else {
          toastr.warning('Maximum stock reached');
        }
      });
    }

    // ========================================
    // Add to Cart
    // ========================================
    if (addToCartBtn) {
      addToCartBtn.addEventListener('click', function (e) {
        e.preventDefault();
        const productId = this.dataset.productId;
        handleAction(`/celiginus/addcart/${productId}?quantity=${quantity}`, data => {
          if (data.cart_count !== undefined) {
            updateCounter(cartCount, data.cart_count);
            updateCounter(cartCountMobile, data.cart_count);
          }
        });
      });
    }

    // Add to Cart from recommendations
    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
      button.addEventListener('click', function (e) {
        e.preventDefault();
        const productId = this.dataset.id;
        handleAction(`/celiginus/addcart/${productId}`, data => {
          if (data.cart_count !== undefined) {
            updateCounter(cartCount, data.cart_count);
            updateCounter(cartCountMobile, data.cart_count);
          }
        });
      });
    });

    // ========================================
    // Add to Wishlist
    // ========================================
    if (addToWishlistBtn) {
      addToWishlistBtn.addEventListener('click', function (e) {
        e.preventDefault();
        const productId = this.dataset.productId;
        handleAction(`/celiginus/addwishlist/${productId}`, data => {
          if (data.wishlist_count !== undefined) {
            updateCounter(wishlistCount, data.wishlist_count);
            updateCounter(wishlistCountMobile, data.wishlist_count);
          }
        });
      });
    }

    // Add to Wishlist from recommendations
    document.querySelectorAll('.add-wishlist-btn').forEach(button => {
      button.addEventListener('click', function (e) {
        e.preventDefault();
        const productId = this.dataset.id;
        handleAction(`/celiginus/addwishlist/${productId}`, data => {
          if (data.wishlist_count !== undefined) {
            updateCounter(wishlistCount, data.wishlist_count);
            updateCounter(wishlistCountMobile, data.wishlist_count);
          }
        });
      });
    });

    // ========================================
    // Gallery Image Switching
    // ========================================
    const mainImage = document.getElementById('main-product-image');
    const thumbnails = document.querySelectorAll('.gallery-thumbnail');

    thumbnails.forEach(thumbnail => {
      thumbnail.addEventListener('click', function (e) {
        e.preventDefault();
        const newImageSrc = this.dataset.image;
        if (mainImage && newImageSrc) {
          mainImage.src = newImageSrc;

          // Update active state
          thumbnails.forEach(t => t.classList.remove('border-orange-600', 'dark:border-orange-400'));
          this.classList.add('border-orange-600', 'dark:border-orange-400');
        }
      });
    });

    // ========================================
    // Delivery Options Selection
    // ========================================
    const deliveryOptions = document.querySelectorAll('.delivery-option');
    deliveryOptions.forEach(option => {
      option.addEventListener('click', function (e) {
        e.preventDefault();

        // Remove active state from all options
        deliveryOptions.forEach(opt => {
          opt.classList.remove('border-orange-600', 'dark:border-orange-400', 'bg-orange-50', 'dark:bg-orange-900/20');
          opt.classList.add('border-gray-200', 'dark:border-gray-700');
        });

        // Add active state to clicked option
        this.classList.remove('border-gray-200', 'dark:border-gray-700');
        this.classList.add('border-orange-600', 'dark:border-orange-400', 'bg-orange-50', 'dark:bg-orange-900/20');
      });
    });

    // ========================================
    // Accordion Functionality
    // ========================================
    const accordionTriggers = document.querySelectorAll('.accordion-trigger');

    accordionTriggers.forEach(trigger => {
      trigger.addEventListener('click', function (e) {
        e.preventDefault();

        const accordionItem = this.closest('.accordion-item');
        const content = accordionItem.querySelector('.accordion-content');
        const icon = this.querySelector('.accordion-icon');
        const isExpanded = this.getAttribute('aria-expanded') === 'true';

        // Close all other accordions
        accordionTriggers.forEach(otherTrigger => {
          if (otherTrigger !== this) {
            const otherItem = otherTrigger.closest('.accordion-item');
            const otherContent = otherItem.querySelector('.accordion-content');
            const otherIcon = otherTrigger.querySelector('.accordion-icon');

            otherContent.classList.add('hidden');
            otherTrigger.setAttribute('aria-expanded', 'false');
            otherIcon.style.transform = 'rotate(0deg)';
          }
        });

        // Toggle current accordion
        if (isExpanded) {
          content.classList.add('hidden');
          this.setAttribute('aria-expanded', 'false');
          icon.style.transform = 'rotate(0deg)';
        } else {
          content.classList.remove('hidden');
          this.setAttribute('aria-expanded', 'true');
          icon.style.transform = 'rotate(45deg)';
        }
      });
    });

  });
</script>

@endSection

