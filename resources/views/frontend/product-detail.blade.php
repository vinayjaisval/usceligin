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

        <!-- Promo Banner -->
        <div class="bg-primary-100 dark:bg-primary-900/20 border border-primary-200 dark:border-primary-800 mb-6">
          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 px-5 py-4">
            <div>
              <p class="font-bold text-gray-900 dark:text-gray-100 text-sm sm:text-base">FREE SHIPPING on all Beauty Steals!</p>
              <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mt-0.5">Diamond & Platinum members only. Join CELIGIN CLUB to unlock exclusive perks.</p>
            </div>
            <a href="{{ route('front.celigin-join-club') }}"
              class="flex-shrink-0 inline-flex items-center px-4 py-2 bg-primary-700 dark:bg-primary-600 text-white text-xs sm:text-sm font-semibold hover:bg-primary-800 dark:hover:bg-primary-500 transition-colors">
              Join CELIGIN CLUB
            </a>
          </div>
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
                  class="aspect-square border-2 border-transparent hover:border-primary-600 dark:hover:border-primary-400 transition-colors duration-200 bg-gray-100 dark:bg-gray-800 overflow-hidden focus:outline-none focus:ring-2 focus:ring-primary-600 gallery-thumbnail"
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
                class="text-sm text-primary-700 dark:text-primary-400 hover:underline">({{ App\Models\Rating::ratingCount($productt->id) }})
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

            <!-- Quantity, Add to Cart & Wishlist -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-5 space-y-4">
              <div class="flex items-stretch gap-3">
                <!-- Decrease Button -->
                <a href="#" id="decrease-qty"
                  class="flex items-center justify-center w-12 h-12 border-2 border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-primary-600"
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
                  class="flex items-center justify-center w-12 h-12 border-2 border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-primary-600"
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
                class="block w-full flex items-center justify-center px-4 py-4 bg-primary-600 text-white text-base font-semibold hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 transition-colors duration-200"
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

            <!-- Social Share -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-5">
              <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3">Share this product</p>
              <div class="flex items-center gap-2">
                @php
                  $shareUrl = urlencode(url()->current());
                  $shareText = urlencode($productt->name);
                @endphp
                <a href="https://wa.me/?text={{ $shareText }}%20{{ $shareUrl }}" target="_blank" rel="noopener"
                  class="flex items-center justify-center w-9 h-9 bg-green-500 text-white hover:bg-green-600 transition-colors"
                  aria-label="Share on WhatsApp">
                  <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" rel="noopener"
                  class="flex items-center justify-center w-9 h-9 bg-blue-600 text-white hover:bg-blue-700 transition-colors"
                  aria-label="Share on Facebook">
                  <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
                <a href="https://twitter.com/intent/tweet?text={{ $shareText }}&url={{ $shareUrl }}" target="_blank" rel="noopener"
                  class="flex items-center justify-center w-9 h-9 bg-black dark:bg-gray-700 text-white hover:bg-gray-800 dark:hover:bg-gray-600 transition-colors"
                  aria-label="Share on X (Twitter)">
                  <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                </a>
                <a href="https://t.me/share/url?url={{ $shareUrl }}&text={{ $shareText }}" target="_blank" rel="noopener"
                  class="flex items-center justify-center w-9 h-9 bg-sky-500 text-white hover:bg-sky-600 transition-colors"
                  aria-label="Share on Telegram">
                  <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg>
                </a>
                <button onclick="copyProductLink()"
                  class="flex items-center justify-center w-9 h-9 border border-gray-300 dark:border-gray-600 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
                  aria-label="Copy product link">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                </button>
                <span id="copy-link-feedback" class="text-xs text-green-600 dark:text-green-400 hidden">Copied!</span>
              </div>
            </div>

            <!-- Product Accordions -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-5">
              @php
                $accordionSections = [
                  [
                    'id' => 'summary',
                    'title' => 'Summary',
                    'type' => 'summary',
                  ],
                  [
                    'id' => 'benefits',
                    'title' => 'Benefits',
                    'content' => $productt->benefits ?? '<ul class="list-disc list-inside space-y-2"><li>Deeply nourishes and hydrates skin</li><li>Reduces the appearance of fine lines</li><li>Brightens and evens skin tone</li><li>Gentle formula suitable for all skin types</li><li>Dermatologically tested</li></ul>',
                    'isHtml' => true,
                  ],
                  [
                    'id' => 'how-to-use',
                    'title' => 'How To Use',
                    'content' => $productt->how_to_use ?? '<ol class="list-decimal list-inside space-y-2"><li>Apply a small amount to clean, damp skin</li><li>Gently massage in circular motions until absorbed</li><li>Follow with moisturizer if needed</li><li>Use morning and evening for best results</li></ol>',
                    'isHtml' => true,
                  ],
                  [
                    'id' => 'ingredients',
                    'title' => 'Ingredients',
                    'content' => $productt->ingredients ?? '<p class="text-sm leading-relaxed">Aqua, Glycerin, Natural Extracts, Vitamin E, Hyaluronic Acid, Niacinamide, Aloe Vera Leaf Extract, and other premium ingredients. Full ingredient list available on product packaging.</p>',
                    'isHtml' => true,
                  ],
                  [
                    'id' => 'return-policy',
                    'title' => 'Return / Refund Policy',
                    'type' => 'policy',
                  ],
                ];
              @endphp

              @foreach($accordionSections as $section)
                @php $isSummary = isset($section['type']) && $section['type'] === 'summary'; @endphp
                <div class="accordion-item border-b border-gray-200 dark:border-gray-700">
                  <button type="button"
                    class="accordion-trigger w-full flex items-center justify-between py-4 px-1 text-left hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors duration-200 focus:outline-none"
                    aria-expanded="{{ $isSummary ? 'true' : 'false' }}" data-accordion="{{ $section['id'] }}">
                    <span class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $section['title'] }}</span>
                    <svg class="accordion-icon w-4 h-4 text-gray-500 dark:text-gray-400 transition-transform duration-200 flex-shrink-0"
                      viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                      <line x1="12" y1="5" x2="12" y2="19"></line>
                      <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                  </button>

                  <div class="accordion-content {{ $isSummary ? '' : 'hidden' }} pb-4 text-sm text-gray-700 dark:text-gray-300" id="{{ $section['id'] }}-content">

                    {{-- Summary --}}
                    @if($isSummary)
                      @php
                        $tags = collect(is_array($productt->tags)
                          ? $productt->tags
                          : json_decode($productt->tags ?? '[]', true)
                        )->filter()->values();
                      @endphp

                      {{-- 1. Chips --}}
                      <div class="flex flex-wrap gap-2 mb-5">
                        @if($tags->isNotEmpty())
                          @foreach($tags as $tag)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-xs font-medium text-green-800 dark:text-green-300">
                              <svg class="w-3 h-3 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                                <polyline points="20 6 9 17 4 12"></polyline>
                              </svg>
                              {{ $tag }}
                            </span>
                          @endforeach
                        @else
                          <span class="text-sm text-gray-400 dark:text-gray-500">—</span>
                        @endif
                      </div>

                      {{-- 2. Item details table --}}
                      <ul class="mb-5 divide-y divide-gray-100 dark:divide-gray-700 border border-gray-100 dark:border-gray-700">
                        <li class="flex items-center justify-between px-3 py-2.5">
                          <span class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Item Form</span>
                          <span class="text-sm text-gray-900 dark:text-gray-100 font-medium">
                            {{ !empty($productt->size) ? $productt->size : '—' }}
                          </span>
                        </li>
                        <li class="flex items-center justify-between px-3 py-2.5">
                          <span class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Item Weight</span>
                          <span class="text-sm text-gray-900 dark:text-gray-100 font-medium">
                            {{ !empty($productt->measure) ? $productt->measure : '—' }}
                          </span>
                        </li>
                      </ul>

                      {{-- 3. Summary paragraph --}}
                      @if(!empty($productt->details))
                        <div class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                          {!! clean($productt->details, ['HTML.Allowed' => 'p,br,b,strong,em,ul,ol,li,span,div', 'AutoFormat.RemoveEmpty' => true]) !!}
                        </div>
                      @else
                        <p class="text-sm text-gray-400 dark:text-gray-500">—</p>
                      @endif

                    {{-- Return/Refund Policy --}}
                    @elseif(isset($section['type']) && $section['type'] === 'policy')
                      <div class="space-y-4">

                        {{-- Non-returnable notice --}}
                        <div class="flex items-start gap-3 p-3 bg-amber-50 dark:bg-amber-900/10 border border-amber-200 dark:border-amber-800">
                          <svg class="w-4 h-4 text-amber-600 dark:text-amber-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
                          <div>
                            <p class="text-xs font-semibold text-amber-800 dark:text-amber-300 mb-0.5">Non-Returnable Item</p>
                            <p class="text-xs text-amber-700 dark:text-amber-400">Due to the personal care nature of this product, we are unable to accept returns once the item has been opened or used.</p>
                          </div>
                        </div>

                        {{-- Exception: damaged / wrong / defective --}}
                        <div class="flex items-start gap-3 p-3 bg-blue-50 dark:bg-blue-900/10 border border-blue-200 dark:border-blue-800">
                          <svg class="w-4 h-4 text-blue-600 dark:text-blue-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                          <div>
                            <p class="text-xs font-semibold text-blue-800 dark:text-blue-300 mb-1">Received a damaged, wrong, or defective item?</p>
                            <p class="text-xs text-blue-700 dark:text-blue-400">You may raise a refund or replacement request within <strong>5 days of delivery</strong>. Visit <a href="{{ route('user.account') }}#purchases" class="underline font-semibold hover:text-blue-900 dark:hover:text-blue-200">Your Orders</a>, attach a clear photo of the item showing the issue, and submit your request — our team will review it promptly.</p>
                          </div>
                        </div>

                        {{-- Quick summary list --}}
                        <ul class="space-y-2 text-xs text-gray-600 dark:text-gray-400">
                          <li class="flex items-start gap-2">
                            <svg class="w-3.5 h-3.5 text-green-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                            Refund or replacement processed within 3–5 business days of approval
                          </li>
                          <li class="flex items-start gap-2">
                            <svg class="w-3.5 h-3.5 text-green-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                            Photo evidence required via Your Orders for all claims
                          </li>
                          <li class="flex items-start gap-2">
                            <svg class="w-3.5 h-3.5 text-red-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            Claims raised after 5 days of delivery will not be accepted
                          </li>
                        </ul>

                        {{-- Actions --}}
                        <div class="flex flex-wrap items-center gap-3 pt-1">
                          <a href="{{ route('user.account') }}#purchases"
                            class="inline-flex items-center gap-1.5 px-4 py-2 bg-gray-900 dark:bg-gray-100 text-white dark:text-gray-900 text-xs font-semibold hover:bg-gray-700 dark:hover:bg-gray-300 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Request Refund via Orders
                          </a>
                          <a href="{{ route('front.return-refund-policy') }}"
                            class="inline-flex items-center gap-1.5 text-xs font-medium text-primary-600 dark:text-primary-400 hover:underline">
                            Read full policy →
                          </a>
                        </div>

                      </div>

                    {{-- Standard HTML content --}}
                    @else
                      {!! clean($section['content'] ?? '', [
                          'HTML.Allowed' => 'p,br,strong,em,ul,ol,li,span',
                          'AutoFormat.RemoveEmpty' => true
                      ]) !!}
                    @endif

                  </div>
                </div>
              @endforeach
            </div>

          </div>
        </div>

      </section>
    </div>

    <!-- Product Content Sections -->
    @php
      // Gallery images — fallback to main product photo if gallery is empty
      $galleries = $productt->galleries ?? collect();
      $galleryImages = $galleries->map(fn($g) => asset('assets/images/galleries/' . $g->photo))->values();
      $mainPhoto = filter_var($productt->photo, FILTER_VALIDATE_URL)
        ? $productt->photo
        : asset('assets/images/products/' . $productt->photo);

      // Only include sections that have actual content saved in the database
      $contentSections = collect([
        [
          'label'   => 'Summary',
          'heading' => 'About This Product',
          'body'    => $productt->summary,
          'isHtml'  => false,
        ],
        [
          'label'   => 'Benefits',
          'heading' => 'Why You\'ll Love It',
          'body'    => $productt->benefits,
          'isHtml'  => true,
        ],
        [
          'label'   => 'How To Use',
          'heading' => 'How To Use',
          'body'    => $productt->how_to_use,
          'isHtml'  => true,
        ],
        [
          'label'   => 'Ingredients',
          'heading' => 'Key Ingredients',
          'body'    => $productt->ingredients,
          'isHtml'  => false,
        ],
      ])->filter(fn($s) => !empty(trim(strip_tags($s['body'] ?? ''))))->values();
    @endphp

    @if($contentSections->isNotEmpty())
      @foreach($contentSections as $index => $cs)
        @php
          // Pick a gallery image for this section; cycle through available ones
          $sectionImage = $galleryImages->get($index) ?? $galleryImages->get($index % max($galleryImages->count(), 1)) ?? $mainPhoto;
          $isEven = $index % 2 === 0;
        @endphp
        <section class="border-t border-gray-100 dark:border-gray-800">
          <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-center">

              {{-- Image: gallery photo for this section --}}
              <div class="{{ $isEven ? 'order-1' : 'order-1 lg:order-2' }}">
                <div class="aspect-[4/3] bg-gray-100 dark:bg-gray-800 overflow-hidden">
                  <img
                    src="{{ $sectionImage }}"
                    alt="{{ $productt->name }} — {{ $cs['label'] }}"
                    class="w-full h-full object-cover"
                    loading="lazy" />
                </div>
              </div>

              {{-- Text: pulled directly from product fields --}}
              <div class="{{ $isEven ? 'order-2' : 'order-2 lg:order-1' }}">
                <p class="text-xs font-semibold tracking-widest uppercase text-primary-600 dark:text-primary-400 mb-3">{{ $cs['label'] }}</p>
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 mb-4 leading-snug">{{ $cs['heading'] }}</h2>
                <div class="w-10 h-0.5 bg-primary-600 dark:bg-primary-400 mb-6"></div>
                <div class="text-sm sm:text-base text-gray-700 dark:text-gray-300 leading-relaxed">
                  @if($cs['isHtml'])
                    {!! clean($cs['body'], ['HTML.Allowed' => 'p,br,strong,em,ul,ol,li,span', 'AutoFormat.RemoveEmpty' => true]) !!}
                  @else
                    <p>{{ $cs['body'] }}</p>
                  @endif
                </div>
              </div>

            </div>
          </div>
        </section>
      @endforeach
    @endif

    <!-- Reviews Section -->
    @php
      $reviews    = App\Models\Rating::where('product_id', $productt->id)->orderBy('id', 'desc')->get();
      $avgRating  = App\Models\Rating::where('product_id', $productt->id)->avg('rating') ?? 0;
      $reviewCount = (int) App\Models\Rating::ratingCount($productt->id);
    @endphp
    <section class="border-t border-gray-100 dark:border-gray-800">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">

        <div class="mb-8">
          <p class="text-xs font-semibold tracking-widest uppercase text-primary-600 dark:text-primary-400 mb-2">Customer Feedback</p>
          <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100">Reviews</h2>
          <div class="w-10 h-0.5 bg-primary-600 dark:bg-primary-400 mt-4"></div>
        </div>

        @if($reviews->count() > 0)
          {{-- Rating summary --}}
          <div class="flex items-center gap-6 mb-10 pb-8 border-b border-gray-200 dark:border-gray-700">
            <div class="text-center">
              <p class="text-5xl font-bold text-gray-900 dark:text-gray-100">{{ number_format($avgRating, 1) }}</p>
              <div class="flex items-center justify-center gap-0.5 mt-2">
                @for($i = 1; $i <= 5; $i++)
                  <svg class="w-4 h-4 {{ $i <= round($avgRating) ? 'text-yellow-500' : 'text-gray-300 dark:text-gray-600' }} fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                @endfor
              </div>
              <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $reviewCount }} {{ Str::plural('review', $reviewCount) }}</p>
            </div>
          </div>

          {{-- Review list --}}
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($reviews as $review)
              <div class="border border-gray-200 dark:border-gray-700 p-5">
                <div class="flex items-center justify-between mb-3">
                  <span class="font-semibold text-gray-900 dark:text-gray-100 text-sm">{{ $review->user->name ?? 'Customer' }}</span>
                  <div class="flex items-center gap-0.5">
                    @for($i = 1; $i <= 5; $i++)
                      <svg class="w-3.5 h-3.5 {{ $i <= $review->rating ? 'text-yellow-500' : 'text-gray-300 dark:text-gray-600' }} fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    @endfor
                  </div>
                </div>
                @if($review->review)
                  <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">{{ $review->review }}</p>
                @endif
                @if($review->review_date)
                  <p class="text-xs text-gray-400 dark:text-gray-500 mt-3">{{ $review->review_date }}</p>
                @endif
              </div>
            @endforeach
          </div>

        @else
          <div class="text-center py-12 border border-dashed border-gray-200 dark:border-gray-700">
            <svg class="w-12 h-12 text-gray-300 dark:text-gray-600 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
            <p class="text-gray-500 dark:text-gray-400">No reviews yet. Be the first to review this product!</p>
          </div>
        @endif

      </div>
    </section>

    <!-- Comments Section -->
    <section class="border-t border-gray-100 dark:border-gray-800">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">

        <div class="mb-8">
          <p class="text-xs font-semibold tracking-widest uppercase text-primary-600 dark:text-primary-400 mb-2">Join the conversation</p>
          <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100">Comments</h2>
          <div class="w-10 h-0.5 bg-primary-600 dark:bg-primary-400 mt-4"></div>
        </div>

        @auth
          <form class="mb-10 max-w-2xl" onsubmit="submitComment(event, {{ $productt->id }})">
            @csrf
            <textarea name="comment" rows="4"
              class="w-full px-4 py-3 text-sm border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors resize-none"
              placeholder="Share your thoughts about this product..."></textarea>
            <button type="submit"
              class="mt-3 px-6 py-2.5 bg-gray-900 dark:bg-gray-100 text-white dark:text-gray-900 text-sm font-semibold hover:bg-gray-700 dark:hover:bg-gray-300 transition-colors">
              Post Comment
            </button>
          </form>
        @else
          <div class="mb-8 max-w-2xl p-4 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
            <p class="text-sm text-gray-600 dark:text-gray-400">
              <a href="{{ route('otp.login.form') }}" class="text-primary-600 dark:text-primary-400 font-medium hover:underline">Sign in</a> to leave a comment.
            </p>
          </div>
        @endauth

        <div id="comments-list" class="max-w-2xl">
          <p class="text-sm text-gray-400 dark:text-gray-500">No comments yet. Start the conversation!</p>
        </div>

      </div>
    </section>

    <!-- Recommendations -->
    <section class="py-12 lg:py-16 bg-gray-50 dark:bg-gray-800" aria-labelledby="recommendations-title" role="region">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 lg:mb-12 gap-4">
          <h2 id="recommendations-title"
            class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 dark:text-gray-100">Recommendations</h2>
          <a href="{{ route('front.best-sellers') }}"
            class="inline-flex items-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors duration-200 group focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 dark:focus:ring-offset-gray-800 "
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
                      class="block focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 dark:focus:ring-offset-gray-800 "
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
                              $productTags[] = ['label' => 'Hot', 'class' => 'bg-primary-600'];
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
                          class="flex-1 flex items-center justify-center px-2 sm:px-3 py-2 bg-primary-600 text-white text-sm font-medium hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 transition-colors duration-200 add-to-cart-btn"
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
          DOM.thumbnails.forEach(t => t.classList.remove('border-primary-600', 'dark:border-primary-400'));
          thumbnail.classList.add('border-primary-600', 'dark:border-primary-400');
        }
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
      },

      initOpenState() {
        // Rotate icon for any accordion already open on page load
        document.querySelectorAll('.accordion-trigger[aria-expanded="true"]').forEach(trigger => {
          const icon = trigger.querySelector('.accordion-icon');
          if (icon) icon.style.transform = 'rotate(45deg)';
        });
      }
    };

    // ========================================
    // Initialize All Modules
    // ========================================
    QuantityManager.init();
    CartWishlistManager.init();
    GalleryManager.init();
    AccordionManager.init();
    AccordionManager.initOpenState();
  });

  function copyProductLink() {
    navigator.clipboard.writeText(window.location.href).then(function() {
      var feedback = document.getElementById('copy-link-feedback');
      if (feedback) {
        feedback.classList.remove('hidden');
        setTimeout(function() { feedback.classList.add('hidden'); }, 2000);
      }
    });
  }

  function submitComment(e, productId) {
    e.preventDefault();
    var form = e.target;
    var textarea = form.querySelector('textarea[name="comment"]');
    var text = textarea ? textarea.value.trim() : '';
    if (!text) return;
    // Placeholder — integrate with your comments endpoint when ready
    var list = document.getElementById('comments-list');
    if (list) {
      list.innerHTML = '<p class="text-xs text-gray-500 dark:text-gray-400 py-2">Comment submitted. It will appear after approval.</p>';
    }
    if (textarea) textarea.value = '';
  }
</script>

@endSection