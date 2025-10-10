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
    $badgeConfig = ['label' => 'New', 'class' => 'badge new'];
  } elseif ($badgeType === 'bestseller') {
    $badgeConfig = ['label' => 'Best Seller', 'class' => 'badge hot'];
  } elseif ($badgeType === 'sale') {
    $badgeConfig = ['label' => 'Final Sale', 'class' => 'badge hot'];
  } elseif ($badgeType === 'hot') {
    $badgeConfig = ['label' => 'Hot', 'class' => 'badge hot'];
  } elseif ($badgeType === 'featured' && ($product->is_featured ?? false)) {
    $badgeConfig = ['label' => 'Featured', 'class' => 'badge hot'];
  }
@endphp

<article class="product-card {{ $attributes->get('class', '') }}" itemscope itemtype="https://schema.org/Product" role="listitem">
  <a href="{{ url('/item/' . $product->slug) }}" class="product-link" aria-label="View {{ $product->name }} details" itemprop="url">

    {{-- Product Image --}}
    <div class="product-image">
      <img
        src="{{ $thumbnail }}"
        alt="{{ $product->name }}"
        width="300"
        height="300"
        itemprop="image"
        loading="lazy">

      {{-- Product Badges --}}
      <div class="product-badges">
        @if($badgeConfig)
          <span class="{{ $badgeConfig['class'] }}">{{ $badgeConfig['label'] }}</span>
        @endif

        @if($discount > 0)
          <span class="badge sale">{{ $discount }}% off</span>
        @endif
      </div>
    </div>

    {{-- Product Info --}}
    <div class="product-info">
      {{-- Pricing --}}
      <div class="product-pricing">
        <span class="current-price" itemprop="price">{{ $product->showPrice() }}</span>
        @if($product->showPreviousPrice())
          <span class="original-price">{{ $product->showPreviousPrice() }}</span>
        @endif
      </div>

      {{-- Product Name --}}
      <h3 class="product-name" itemprop="name" title="{{ $product->name }}">
        {{ ucfirst(mb_strtolower($product->showName ?? $product->name)) }}
      </h3>
    </div>
  </a>

  {{-- Product Actions --}}
  <div class="product-actions">
    @if($showWishlist)
      <x-wishlist-button :product-id="$product->id" />
    @endif

    @if($showCart)
      <x-cart-button :product-id="$product->id" />
    @endif
  </div>
</article>
