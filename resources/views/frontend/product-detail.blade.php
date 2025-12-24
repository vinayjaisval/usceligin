@extends('frontend.include.app')

@section('content')
  <!-- Main Content -->
  <main id="main-content" role="main" class="bg-white dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 mb-16">
      <!-- Breadcrumb Navigation -->
      @include('frontend.include.breadcrumb', ['items' => [
        ['label' => 'Home', 'url' => route('front.index')],
        ['label' => ucfirst(mb_strtolower($productt->name))]
      ]])

      <!-- Loading Spinner -->
      @include('frontend.include.loading-spinner', [
        'id' => 'loading-section',
        'message' => 'Loading product...'
      ])

      <!-- Product Detail Section -->
      <section role="main">

        <!-- Free Shipping Banner -->
        <div
          class="bg-orange-50 dark:bg-orange-900/20 border border-orange-200 dark:border-orange-800 p-4 mb-6 text-center">
          <span class="text-gray-900 dark:text-gray-100"><strong>FREE SHIPPING on all Beauty Steals!</strong></span>
          <span class="text-sm text-gray-600 dark:text-gray-400 ml-2">Diamond & Platinum members only.</span>
        </div>



        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
          <!-- Product Images -->
          <div class="space-y-4 lg:sticky lg:top-6 lg:self-start">
            <div class="aspect-square bg-gray-100 dark:bg-gray-800 overflow-hidden">
              <img
                id="main-product-image"
                src="{{filter_var($productt->photo, FILTER_VALIDATE_URL) ? $productt->photo : asset('assets/images/products/' . $productt->photo)}}"
                alt="{{ $productt->name }} - Main product image" width="500" height="500"
                class="w-full h-full object-cover" />
            </div>
            <div class="grid grid-cols-4 sm:grid-cols-6 gap-2">
              @foreach($productt->galleries as $gal)
                <a href="#"
                  class="aspect-square border-2 border-transparent hover:border-orange-600 dark:hover:border-orange-400 transition-colors duration-200 bg-gray-100 dark:bg-gray-800 overflow-hidden focus:outline-none focus:ring-2 focus:ring-orange-500 gallery-thumbnail"
                  data-image="{{asset('assets/images/galleries/' . $gal->photo)}}" aria-label="View product image">
                  <img src="{{asset('assets/images/galleries/' . $gal->photo)}}" alt="{{ $productt->name }} - Product view"
                    width="80" height="80" class="w-full h-full object-cover" />
                </a>
              @endforeach
            </div>
          </div>

          <!-- Product Information -->
          <div class="space-y-5">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 leading-tight">
              {{ ucfirst(mb_strtolower($productt->name)) }}
            </h1>

            <!-- Rating -->
            <div class="flex items-center gap-3"
              aria-label="{{ App\Models\Rating::ratings($productt->id) }} out of 5 stars">
              <div class="flex items-center">
                @php
                  $rating = App\Models\Rating::ratings($productt->id);
                  $fullStars = floor($rating);
                  $hasHalfStar = ($rating - $fullStars) >= 0.5;
                @endphp
                @for($i = 1; $i <= 5; $i++)
                  @if($i <= $fullStars)
                    <svg class="w-5 h-5 text-yellow-500 fill-current" viewBox="0 0 24 24" aria-hidden="true">
                      <path
                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                    </svg>
                  @elseif($i == $fullStars + 1 && $hasHalfStar)
                    <svg class="w-5 h-5 text-yellow-500" viewBox="0 0 24 24" aria-hidden="true">
                      <path fill="currentColor"
                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"
                        opacity="0.3" />
                      <path stroke="currentColor" stroke-width="2" fill="none"
                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                    </svg>
                  @else
                    <svg class="w-5 h-5 text-yellow-500" viewBox="0 0 24 24" aria-hidden="true">
                      <path stroke="currentColor" stroke-width="2" fill="none"
                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                    </svg>
                  @endif
                @endfor
              </div>
              <span class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ number_format($rating, 1) }}</span>
              <a href="#reviews"
                class="text-sm text-orange-600 dark:text-orange-400 hover:underline">({{ App\Models\Rating::ratingCount($productt->id) }})
                Reviews</a>
            </div>

            <!-- Price -->
            <div>
              <div class="flex items-center gap-3">
                <span class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $productt->showPrice() }}</span>
                @if($productt->showPreviousPrice() && $productt->showPreviousPrice() != $productt->showPrice())
                  <span
                    class="text-xl text-gray-500 dark:text-gray-400 line-through">{{ $productt->showPreviousPrice() }}</span>
                @endif
              </div>
            </div>

            <!-- Pickup and Delivery Options -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-5">
              <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100 mb-4">Pickup and delivery options</h3>
              <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                @php
                  $deliveryOptions = [
                    [
                      'id' => 'ship',
                      'title' => 'Ship',
                      'description' => 'Free standard shipping over ₹35',
                      'icon' => '<rect x="1" y="3" width="15" height="13"></rect><polygon points="16,8 20,8 23,11 23,16 16,16 16,8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle>',
                      'isActive' => true
                    ],
                    [
                      'id' => 'pickup',
                      'title' => 'Pickup',
                      'description' => 'Free ship to pick up',
                      'icon' => '<path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9,22 9,12 15,12 15,22"></polyline>',
                      'isActive' => false
                    ],
                    [
                      'id' => 'same-day',
                      'title' => 'Same day',
                      'description' => 'Free same day delivery over ₹35',
                      'icon' => '<circle cx="12" cy="12" r="10"></circle><polyline points="12,6 12,12 16,14"></polyline>',
                      'isActive' => false
                    ]
                  ];
                @endphp

                @foreach($deliveryOptions as $option)
                  <a href="#"
                    class="flex items-start space-x-3 p-4 border-2 {{ $option['isActive'] ? 'border-orange-600 dark:border-orange-400 bg-orange-50 dark:bg-orange-900/20 hover:bg-orange-100 dark:hover:bg-orange-900/30' : 'border-gray-200 dark:border-gray-700 hover:border-orange-600 dark:hover:border-orange-400 hover:bg-gray-50 dark:hover:bg-gray-800' }} transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-orange-500 delivery-option"
                    data-option="{{ $option['id'] }}">
                    <svg class="w-5 h-5 text-gray-900 dark:text-gray-100 flex-shrink-0" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" aria-hidden="true">
                      {!! $option['icon'] !!}
                    </svg>
                    <div class="text-left">
                      <div class="font-semibold text-gray-900 dark:text-gray-100">{{ $option['title'] }}</div>
                      <div class="text-sm text-gray-600 dark:text-gray-400">{{ $option['description'] }}</div>
                    </div>
                  </a>
                @endforeach
              </div>
            </div>

            <!-- Quantity, Add to Cart & Wishlist -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-5 space-y-4">
              <div class="flex items-stretch gap-3">
                <!-- Decrease Button -->
                <a href="#" id="decrease-qty"
                  class="flex items-center justify-center w-12 h-12 border-2 border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-orange-500"
                  aria-label="Decrease quantity">
                  <svg class="w-4 h-4 text-gray-900 dark:text-gray-100" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                  </svg>
                </a>

                <!-- Quantity Display -->
                <div
                  class="flex items-center justify-center min-w-[3rem] h-12 px-4 border-2 border-gray-300 dark:border-gray-600">
                  <span id="product-quantity" class="text-lg font-semibold text-gray-900 dark:text-gray-100">1</span>
                </div>

                <!-- Increase Button -->
                <a href="#" id="increase-qty"
                  class="flex items-center justify-center w-12 h-12 border-2 border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-orange-500"
                  aria-label="Increase quantity">
                  <svg class="w-4 h-4 text-gray-900 dark:text-gray-100" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                  </svg>
                </a>

                <!-- Wishlist Button -->
                <a href="#" id="add-to-wishlist-btn" data-product-id="{{ $productt->id }}"
                  class="flex items-center justify-center w-12 h-12 border-2 border-gray-300 dark:border-gray-600 hover:border-red-500 dark:hover:border-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-500"
                  aria-label="Add to wishlist">
                  <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path
                      d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                    </path>
                  </svg>
                </a>
              </div>

              <!-- Add to Cart Button -->
              <a href="#" id="add-to-cart-btn" data-product-id="{{ $productt->id }}"
                class="block w-full flex items-center justify-center px-4 py-4 bg-orange-600 text-white text-base font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-colors duration-200"
                role="button" tabindex="0" aria-label="Add {{ $productt->name }} to cart">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                  class="mr-2" aria-hidden="true" focusable="false">
                  <circle cx="9" cy="21" r="1"></circle>
                  <circle cx="20" cy="21" r="1"></circle>
                  <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
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
                    @php
                      $highlights = [
                        ['label' => 'Clean Ingredients', 'color' => 'green', 'icon' => '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22,4 12,14.01 9,11.01"></polyline>'],
                        ['label' => 'Cruelty Free', 'color' => 'blue', 'icon' => '<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>'],
                        ['label' => 'Vegan', 'color' => 'purple', 'icon' => '<path d="M17 8l4 4-4 4M7 8l-4 4 4 4"></path><path d="M12 2v20"></path>'],
                        ['label' => 'Sustainable', 'color' => 'teal', 'icon' => '<path d="M3 12h18m-9-9v18"></path>'],
                        ['label' => 'Give Back', 'color' => 'pink', 'icon' => '<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>']
                      ];
                    @endphp

                    @foreach($highlights as $highlight)
                      <span class="inline-flex items-center space-x-1 px-2 py-1 bg-{{ $highlight['color'] }}-50 dark:bg-{{ $highlight['color'] }}-900/20 border border-{{ $highlight['color'] }}-200 dark:border-{{ $highlight['color'] }}-800 text-xs text-gray-900 dark:text-gray-100">
                        <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                          {!! $highlight['icon'] !!}
                        </svg>
                        <span>{{ $highlight['label'] }}</span>
                      </span>
                    @endforeach
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
                @php
                  $accordionSections = [
                    [
                      'id' => 'details',
                      'title' => 'Details',
                      'content' => $productt->description ?? '<p>Detailed product information coming soon.</p>',
                      'isHtml' => true
                    ],
                    [
                      'id' => 'how-to-use',
                      'title' => 'How To Use',
                      'content' => $productt->how_to_use ?? '<ol class="list-decimal list-inside space-y-2"><li>Apply a small amount to clean, damp skin or hair</li><li>Gently massage in circular motions</li><li>Allow to absorb fully before applying other products</li><li>Use daily for best results</li></ol>',
                      'isHtml' => true
                    ],
                    [
                      'id' => 'ingredients',
                      'title' => 'Ingredients',
                      'content' => $productt->ingredients ?? '<p>Aqua, Glycerin, Natural Extracts, Vitamin E, Hyaluronic Acid, and other premium ingredients. Full ingredient list available on product packaging.</p>',
                      'isHtml' => true
                    ]
                  ];
                @endphp

                @foreach($accordionSections as $section)
                  <div class="accordion-item border-b border-gray-200 dark:border-gray-700">
                    <a href="#"
                      class="accordion-trigger w-full flex items-center justify-between py-4 px-4 text-left hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-orange-500"
                      aria-expanded="false" data-accordion="{{ $section['id'] }}">
                      <span class="text-base font-semibold text-gray-900 dark:text-gray-100">{{ $section['title'] }}</span>
                      <svg class="accordion-icon w-4 h-4 text-gray-900 dark:text-gray-100 transition-transform duration-200"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                      </svg>
                    </a>
                    <div
                      class="accordion-content hidden py-4 px-4 mt-1 mb-4 text-sm text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-800/50"
                      id="{{ $section['id'] }}-content">
                      @if($section['isHtml'])
                        {!! clean($section['content'], [
                            'HTML.Allowed' => 'p,br,strong,em,ul,ol,li,span',
                            'AutoFormat.RemoveEmpty' => true
                        ]) !!}
                      @else
                        {{ $section['content'] }}
                      @endif
                    </div>
                  </div>
                @endforeach
              </div>
            </div>

          </div>
        </div>

      </section>
    </div>

    <!-- Recommendations -->
    <section class="py-12 lg:py-8 bg-gray-50 dark:bg-gray-800" aria-labelledby="recommendations-title" role="region">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 lg:mb-12 gap-4">
          <h2 id="recommendations-title"
            class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 dark:text-gray-100">Recommendations</h2>
          <a href="{{ route('front.best-sellers') }}"
            class="inline-flex items-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors duration-200 group focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 "
            aria-label="View all recommended products">
            Shop all recommendations
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              class="ml-2 w-4 h-4 group-hover:translate-x-1 transition-transform duration-200" aria-hidden="true"
              focusable="false">
              <line x1="7" y1="17" x2="17" y2="7"></line>
              <polyline points="7,7 17,7 17,17"></polyline>
            </svg>
          </a>
        </div>

        <div class="relative">
          <div class="bestseller-swiper swiper">
            <div class="swiper-wrapper">
              @foreach (App\Models\Product::where('type', $productt->type)->where('product_type', $productt->product_type)->withCount('ratings')->withAvg('ratings', 'rating')->take(12)->get() as $prod)
                <div class="swiper-slide">
                  <article
                    class="bg-white dark:bg-gray-800 shadow-sm overflow-hidden group hover:shadow-md transition-all duration-300 "
                    itemscope itemtype="https://schema.org/Product">
                    <a href="{{ url('/item/' . $prod->slug) }}"
                      class="block focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 "
                      aria-describedby="product-{{ $prod->id }}-desc">
                      <div class="relative aspect-square overflow-hidden">
                        <img
                          src="{{ $prod->thumbnail ? asset('assets/images/thumbnails/' . $prod->thumbnail) : asset('assets/images/noimage.png') }}"
                          alt="{{ $prod->name }} - Premium skincare product" width="300" height="300" loading="lazy"
                          decoding="async" itemprop="image"
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
                            <span
                              class="inline-block px-2 py-1 {{ $tag['class'] }} text-white text-sm font-semibold mb-1 first:mb-0"
                              role="status" aria-label="Product tag: {{ $tag['label'] }}">
                              {{ $tag['label'] }}
                            </span>
                          @endforeach
                        </div>
                      </div>
                      <div class="p-3 sm:p-4">
                        <div class="mb-2">
                          <span class="text-base font-bold text-gray-900 dark:text-gray-100"
                            itemprop="price">{{ $prod->showPrice() }}</span>
                          @if($prod->showPreviousPrice() && $prod->showPreviousPrice() != $prod->showPrice())
                            <span
                              class="text-sm text-gray-500 dark:text-gray-400 line-through ml-2">{{ $prod->showPreviousPrice() }}</span>
                          @endif
                        </div>
                        <h3 id="product-{{ $prod->id }}-desc"
                          class="text-sm font-medium text-gray-900 dark:text-gray-100 line-clamp-2 leading-relaxed"
                          itemprop="name" title="{{$prod->name}}">
                          {{ ucfirst(mb_strtolower($prod->showName())) }}
                        </h3>
                      </div>
                    </a>
                    <div class="px-3 sm:px-4 pb-3 sm:pb-4">
                      <div class="flex items-center space-x-2">
                        <a href="#"
                          class="flex-1 flex items-center justify-center px-2 sm:px-3 py-2 bg-orange-600 text-white text-sm font-medium hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-colors duration-200 add-to-cart-btn"
                          data-id="{{ $prod->id }}" role="button" tabindex="0"
                          aria-label="Add {{ $prod->name }} to shopping cart">
                          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="mr-1 sm:mr-2" aria-hidden="true" focusable="false">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                          </svg>
                          <span class="hidden sm:inline">Add to Cart</span>
                          <span class="sm:hidden">Cart</span>
                        </a>
                        <a href="#"
                          class="p-2 text-gray-400 hover:text-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors duration-200 add-wishlist-btn"
                          data-id="{{ $prod->id }}" role="button" tabindex="0"
                          aria-label="Add {{ $prod->name }} to wishlist">
                          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            aria-hidden="true" focusable="false">
                            <path
                              d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                            </path>
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
          <div
            class="swiper-button-next bestseller-nav-next !text-gray-600 !w-10 !h-10 !mt-0 !top-1/2 !-translate-y-1/2 !-right-5 after:!text-lg !bg-white !rounded-none !shadow-md hover:!bg-gray-50 !transition-all !duration-200"
            aria-label="Next products"></div>
          <div
            class="swiper-button-prev bestseller-nav-prev !text-gray-600 !w-10 !h-10 !mt-0 !top-1/2 !-translate-y-1/2 !-left-5 after:!text-lg !bg-white !rounded-none !shadow-md hover:!bg-gray-50 !transition-all !duration-200"
            aria-label="Previous products"></div>
        </div>
      </div>
    </section>
  </main>

@endsection
@section('scripts')

<script>
  document.addEventListener('DOMContentLoaded', function () {
    'use strict';

    // ========================================
    // Configuration
    // ========================================
    const CONFIG = {
      csrfToken: '{{ csrf_token() }}',
      maxQuantity: {{ $productt->stock ?? 99 }},
      baseUrl: '{{ url("/") }}',
      urls: {
        addCart: '{{ url("/addcart") }}/',
        addWishlist: '{{ url("/addwishlist") }}/'
      }
    };

    // ========================================
    // DOM Element Caching
    // ========================================
    const DOM = {
      // Quantity controls
      productQuantity: document.getElementById('product-quantity'),
      decreaseQty: document.getElementById('decrease-qty'),
      increaseQty: document.getElementById('increase-qty'),

      // Action buttons
      addToCartBtn: document.getElementById('add-to-cart-btn'),
      addToWishlistBtn: document.getElementById('add-to-wishlist-btn'),

      // Counters
      cartCount: document.getElementById('cart-count'),
      cartCountMobile: document.getElementById('cart-count-mobile'),
      wishlistCount: document.getElementById('wishlist-count'),
      wishlistCountMobile: document.getElementById('wishlist-count-mobile'),

      // Gallery
      mainImage: document.getElementById('main-product-image'),
      thumbnails: document.querySelectorAll('.gallery-thumbnail'),

      // Options
      deliveryOptions: document.querySelectorAll('.delivery-option'),
      accordionTriggers: document.querySelectorAll('.accordion-trigger')
    };

    // ========================================
    // Utility Functions
    // ========================================
    const Utils = {
      handleAction(url, successCallback) {
        fetch(url, {
          method: 'GET',
          headers: { 'X-CSRF-TOKEN': CONFIG.csrfToken }
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
      },

      updateCounter(element, value) {
        if (element) element.textContent = value;
      },

      updateBothCounters(counter1, counter2, value) {
        this.updateCounter(counter1, value);
        this.updateCounter(counter2, value);
      },

      toggleActiveState(element, activeClasses, inactiveClasses) {
        element.classList.remove(...inactiveClasses);
        element.classList.add(...activeClasses);
      }
    };

    // ========================================
    // Quantity Management
    // ========================================
    const QuantityManager = {
      quantity: 1,

      init() {
        if (DOM.decreaseQty) {
          DOM.decreaseQty.addEventListener('click', (e) => {
            e.preventDefault();
            this.decrease();
          });
        }

        if (DOM.increaseQty) {
          DOM.increaseQty.addEventListener('click', (e) => {
            e.preventDefault();
            this.increase();
          });
        }
      },

      decrease() {
        if (this.quantity > 1) {
          this.quantity--;
          this.updateDisplay();
        }
      },

      increase() {
        if (this.quantity < CONFIG.maxQuantity) {
          this.quantity++;
          this.updateDisplay();
        } else {
          toastr.warning('Maximum stock reached');
        }
      },

      updateDisplay() {
        if (DOM.productQuantity) {
          DOM.productQuantity.textContent = this.quantity;
        }
      },

      get() {
        return this.quantity;
      }
    };

    // ========================================
    // Cart & Wishlist Handlers (All Products)
    // ========================================
    const CartWishlistManager = {
      init() {
        // Main add to cart (with quantity support)
        if (DOM.addToCartBtn) {
          DOM.addToCartBtn.addEventListener('click', (e) => {
            e.preventDefault();
            const productId = e.currentTarget.dataset.productId;
            this.addToCart(productId, QuantityManager.get());
          });
        }

        // Main add to wishlist
        if (DOM.addToWishlistBtn) {
          DOM.addToWishlistBtn.addEventListener('click', (e) => {
            e.preventDefault();
            const productId = e.currentTarget.dataset.productId;
            this.addToWishlist(productId);
          });
        }

        // Recommendations carousel - using event delegation for dynamic buttons
        document.addEventListener('click', (e) => {
          // Handle recommendations cart buttons (different from main product button)
          const recCartBtn = e.target.closest('.add-to-cart-btn');
          if (recCartBtn && recCartBtn !== DOM.addToCartBtn) {
            e.preventDefault();
            const productId = recCartBtn.dataset.id || recCartBtn.dataset.productId;
            if (productId) {
              this.addToCart(productId, 1);
            }
            return;
          }

          // Handle recommendations wishlist buttons
          const recWishlistBtn = e.target.closest('.add-wishlist-btn');
          if (recWishlistBtn && recWishlistBtn !== DOM.addToWishlistBtn) {
            e.preventDefault();
            const productId = recWishlistBtn.dataset.id || recWishlistBtn.dataset.productId;
            if (productId) {
              this.addToWishlist(productId);
            }
            return;
          }
        });
      },

      addToCart(productId, quantity = 1) {
        const url = `${CONFIG.urls.addCart}${productId}${quantity > 1 ? `?quantity=${quantity}` : ''}`;
        Utils.handleAction(url, (data) => {
          if (data.cart_count !== undefined) {
            Utils.updateBothCounters(DOM.cartCount, DOM.cartCountMobile, data.cart_count);
          }
        });
      },

      addToWishlist(productId) {
        Utils.handleAction(`${CONFIG.urls.addWishlist}${productId}`, (data) => {
          if (data.wishlist_count !== undefined) {
            Utils.updateBothCounters(DOM.wishlistCount, DOM.wishlistCountMobile, data.wishlist_count);
          }
        });
      }
    };

    // ========================================
    // Gallery Handler
    // ========================================
    const GalleryManager = {
      init() {
        if (!DOM.mainImage || !DOM.thumbnails.length) return;

        DOM.thumbnails.forEach(thumbnail => {
          thumbnail.addEventListener('click', (e) => {
            e.preventDefault();
            this.switchImage(e.currentTarget);
          });
        });
      },

      switchImage(thumbnail) {
        const newImageSrc = thumbnail.dataset.image;
        if (newImageSrc) {
          DOM.mainImage.src = newImageSrc;
          DOM.thumbnails.forEach(t => t.classList.remove('border-orange-600', 'dark:border-orange-400'));
          thumbnail.classList.add('border-orange-600', 'dark:border-orange-400');
        }
      }
    };

    // ========================================
    // Delivery Options Handler
    // ========================================
    const DeliveryManager = {
      activeClasses: ['border-orange-600', 'dark:border-orange-400', 'bg-orange-50', 'dark:bg-orange-900/20'],
      inactiveClasses: ['border-gray-200', 'dark:border-gray-700'],

      init() {
        DOM.deliveryOptions.forEach(option => {
          option.addEventListener('click', (e) => {
            e.preventDefault();
            this.setActive(e.currentTarget);
          });
        });
      },

      setActive(selectedOption) {
        DOM.deliveryOptions.forEach(opt => {
          opt.classList.remove(...this.activeClasses);
          opt.classList.add(...this.inactiveClasses);
        });

        selectedOption.classList.remove(...this.inactiveClasses);
        selectedOption.classList.add(...this.activeClasses);
      }
    };

    // ========================================
    // Accordion Handler
    // ========================================
    const AccordionManager = {
      init() {
        DOM.accordionTriggers.forEach(trigger => {
          trigger.addEventListener('click', (e) => {
            e.preventDefault();
            this.toggle(e.currentTarget);
          });
        });
      },

      toggle(trigger) {
        const isExpanded = trigger.getAttribute('aria-expanded') === 'true';

        // Close all accordions
        this.closeAll();

        // Open clicked accordion if it was closed
        if (!isExpanded) {
          this.open(trigger);
        }
      },

      closeAll() {
        DOM.accordionTriggers.forEach(trigger => {
          const item = trigger.closest('.accordion-item');
          const content = item.querySelector('.accordion-content');
          const icon = trigger.querySelector('.accordion-icon');

          content.classList.add('hidden');
          trigger.setAttribute('aria-expanded', 'false');
          icon.style.transform = 'rotate(0deg)';
        });
      },

      open(trigger) {
        const item = trigger.closest('.accordion-item');
        const content = item.querySelector('.accordion-content');
        const icon = trigger.querySelector('.accordion-icon');

        content.classList.remove('hidden');
        trigger.setAttribute('aria-expanded', 'true');
        icon.style.transform = 'rotate(45deg)';
      }
    };

    // ========================================
    // Initialize All Modules
    // ========================================
    QuantityManager.init();
    CartWishlistManager.init();
    GalleryManager.init();
    DeliveryManager.init();
    AccordionManager.init();
  });
</script>

@endSection