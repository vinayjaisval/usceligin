{{--
  Product Card Component

  A reusable product card that displays product information with consistent styling.
  Used across: best-sellers, new-arrivals, sale, skin-care, my-wishlist, index (carousels)

  Usage:
    <x-product-card :product="$product" />
    <x-product-card :product="$product" badge-type="new" />
    <x-product-card :product="$product" badge-type="bestseller" />
    <x-product-card :product="$product" badge-type="sale" />
    <x-product-card :product="$product" :show-wishlist="false" />

  Props:
    - product (required): Product model instance
    - badgeType (optional): 'new', 'bestseller', 'sale', 'hot', 'featured' or null
    - showWishlist (optional): Show wishlist button (default: true)
    - showCart (optional): Show cart button (default: true)
    - class (optional): Additional CSS classes for the card
--}}

@props([
  'product',
  'badgeType' => null,
  'showWishlist' => true,
  'showCart' => true
])

@php
  // Determine thumbnail URL
  $thumbnail = $product->thumbnail
    ? asset('assets/images/thumbnails/' . $product->thumbnail)
    : asset('assets/images/noimage.png');

  // Calculate discount percentage
  $discount = round($product->offPercentage());

  // Determine badge to show - BRAND COLOR SCHEME
  $badgeConfig = null;
  if ($badgeType === 'new') {
    $badgeConfig = ['label' => 'New', 'class' => 'bg-semantic-success text-white'];
  } elseif ($badgeType === 'bestseller') {
    $badgeConfig = ['label' => 'Best Seller', 'class' => 'bg-primary-800 text-white'];
  } elseif ($badgeType === 'sale') {
    $badgeConfig = ['label' => 'Final Sale', 'class' => 'bg-semantic-error text-white'];
  } elseif ($badgeType === 'hot') {
    $badgeConfig = ['label' => 'Hot', 'class' => 'bg-semantic-error text-white'];
  } elseif ($badgeType === 'featured' && ($product->is_featured ?? false)) {
    $badgeConfig = ['label' => 'Featured', 'class' => 'bg-primary-600 text-white'];
  }
@endphp

<article
  class="group bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden transition-all duration-200 hover:shadow-lg {{ $attributes->get('class', '') }}"
  itemscope
  itemtype="https://schema.org/Product"
  role="listitem">

  <a href="{{ url('/item/' . $product->slug) }}"
     class="block"
     aria-label="View {{ $product->name }} details"
     itemprop="url">

    {{-- Product Image --}}
    <div class="relative overflow-hidden aspect-square bg-gray-100 dark:bg-gray-700">
      <img
        src="{{ $thumbnail }}"
        alt="{{ $product->name }}"
        width="300"
        height="300"
        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
        itemprop="image"
        loading="lazy">

      {{-- Product Badges --}}
      @if($badgeConfig || $discount > 0)
        <div class="absolute top-2 right-2 flex flex-col gap-1.5 sm:gap-2 z-10">
          @if($badgeConfig)
            <span class="px-2 py-0.5 sm:px-2.5 sm:py-1 text-[10px] sm:text-xs font-semibold text-white {{ $badgeConfig['class'] }}">
              {{ $badgeConfig['label'] }}
            </span>
          @endif

          @if($discount > 0)
            <span class="px-2 py-0.5 sm:px-2.5 sm:py-1 text-[10px] sm:text-xs font-semibold text-white bg-primary-600">
              {{ $discount }}% off
            </span>
          @endif
        </div>
      @endif
    </div>

    {{-- Product Info --}}
    <div class="p-3 sm:p-4">
      {{-- Pricing --}}
      <div class="flex items-center gap-2 mb-1.5 sm:mb-2">
        <span class="text-base sm:text-lg font-bold text-primary-800 dark:text-primary-400" itemprop="price">
          {{ $product->showPrice() }}
        </span>
        @if($product->showPreviousPrice())
          <span class="text-xs sm:text-sm text-neutral-500 dark:text-gray-400 line-through">
            {{ $product->showPreviousPrice() }}
          </span>
        @endif
      </div>

      {{-- Product Name --}}
      <h3 class="text-xs sm:text-sm font-medium text-neutral-900 dark:text-gray-100 line-clamp-2 group-hover:text-primary-700 dark:group-hover:text-primary-400 transition-colors duration-200"
          itemprop="name"
          title="{{ $product->name }}">
        {{ ucfirst(mb_strtolower($product->showName())) }}
      </h3>
    </div>
  </a>

  {{-- Product Actions --}}
  <div class="flex items-center space-x-2 p-2.5 sm:p-3 border-t border-gray-200 dark:border-gray-700">
    @if($showCart)
      {{-- Wide Add to Cart Button --}}
      <x-btn href="javascript:void(0);"
         class="add-to-cart-btn flex-1 !justify-center !px-2 sm:!px-3 !py-2 !text-sm"
         data-id="{{ $product->id }}"
         role="button"
         tabindex="0"
         aria-label="Add {{ $product->name }} to shopping cart">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="mr-1 sm:mr-2" aria-hidden="true" focusable="false">
          <circle cx="9" cy="21" r="1"></circle>
          <circle cx="20" cy="21" r="1"></circle>
          <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
        </svg>
        <span class="hidden sm:inline">Add to Cart</span>
        <span class="sm:hidden">Cart</span>
      </x-btn>
    @endif

    @if($showWishlist)
      {{-- Icon-only Wishlist Button --}}
      <a href="javascript:void(0);"
         class="add-wishlist-btn p-2 text-neutral-500 hover:text-primary-600 dark:hover:text-primary-400 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 transition-colors duration-200"
         data-id="{{ $product->id }}"
         role="button"
         tabindex="0"
         aria-label="Add {{ $product->name }} to wishlist">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false">
          <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
        </svg>
      </a>
    @endif
  </div>
</article>
