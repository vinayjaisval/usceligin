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

  // Determine badge to show
  $badgeConfig = null;
  if ($badgeType === 'new') {
    $badgeConfig = ['label' => 'New', 'class' => 'bg-green-600'];
  } elseif ($badgeType === 'bestseller') {
    $badgeConfig = ['label' => 'Best Seller', 'class' => 'bg-red-600'];
  } elseif ($badgeType === 'sale') {
    $badgeConfig = ['label' => 'Final Sale', 'class' => 'bg-red-600'];
  } elseif ($badgeType === 'hot') {
    $badgeConfig = ['label' => 'Hot', 'class' => 'bg-red-600'];
  } elseif ($badgeType === 'featured' && ($product->is_featured ?? false)) {
    $badgeConfig = ['label' => 'Featured', 'class' => 'bg-red-600'];
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
            <span class="px-2 py-0.5 sm:px-2.5 sm:py-1 text-[10px] sm:text-xs font-semibold text-white bg-orange-600">
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
        <span class="text-base sm:text-lg font-bold text-orange-600 dark:text-orange-500" itemprop="price">
          {{ $product->showPrice() }}
        </span>
        @if($product->showPreviousPrice())
          <span class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 line-through">
            {{ $product->showPreviousPrice() }}
          </span>
        @endif
      </div>

      {{-- Product Name --}}
      <h3 class="text-xs sm:text-sm font-medium text-gray-900 dark:text-gray-100 line-clamp-2 group-hover:text-orange-600 dark:group-hover:text-orange-500 transition-colors duration-200"
          itemprop="name"
          title="{{ $product->name }}">
        {{ ucfirst(mb_strtolower($product->showName())) }}
      </h3>
    </div>
  </a>

  {{-- Product Actions --}}
  <div class="flex items-center justify-center gap-2 sm:gap-3 p-2.5 sm:p-3 border-t border-gray-200 dark:border-gray-700">
    @if($showWishlist)
      <x-wishlist-button :product-id="$product->id" />
    @endif

    @if($showCart)
      <x-cart-button :product-id="$product->id" />
    @endif
  </div>
</article>
