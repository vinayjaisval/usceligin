{{--
  Wishlist Button Component

  A standardized wishlist button with heart icon for adding products to wishlist.

  Usage:
    <x-wishlist-button :product-id="$product->id" />
    <x-wishlist-button :product-id="$product->id" size="large" :show-text="true" />
    <x-wishlist-button :product-id="123" size="small" />

  Props:
    - productId (required): Product ID to add to wishlist
    - size (optional): 'small', 'medium' (default), 'large'
    - showText (optional): Show "Add to Wishlist" text (default: false)
    - class (optional): Additional CSS classes
--}}

@props([
  'productId',
  'size' => 'medium',
  'showText' => false
])

@php
  $sizes = [
    'small' => 'w-4 h-4',
    'medium' => 'w-5 h-5',
    'large' => 'w-6 h-6'
  ];
  $iconSize = $sizes[$size] ?? $sizes['medium'];
@endphp

<a href="javascript:void(0);"
   class="wishlist-btn add-wishlist-btn {{ $attributes->get('class', '') }}"
   data-id="{{ $productId }}"
   aria-label="Add to wishlist"
   title="Add to Wishlist"
   role="button">
  {{-- Heart Icon --}}
  <svg
    class="{{ $iconSize }} {{ $showText ? 'mr-2' : '' }}"
    viewBox="0 0 24 24"
    fill="none"
    stroke="currentColor"
    stroke-width="2"
    aria-hidden="true"
    focusable="false">
    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
  </svg>

  @if($showText)
    <span>Add to Wishlist</span>
  @endif
</a>
