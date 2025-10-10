{{--
  Cart Button Component

  A standardized cart button that ensures visual consistency across the entire site.
  Uses the shopping cart icon (matches header) instead of shopping bag icon.

  Usage:
    <x-cart-button :product-id="$product->id" />
    <x-cart-button :product-id="$product->id" size="large" :show-text="true" />
    <x-cart-button :product-id="123" size="small" />

  Props:
    - productId (required): Product ID to add to cart
    - size (optional): 'small', 'medium' (default), 'large'
    - showText (optional): Show "Add to Cart" text (default: false)
    - quantity (optional): Quantity to add (default: 1)
    - class (optional): Additional CSS classes
--}}

@props([
  'productId',
  'size' => 'medium',
  'showText' => false,
  'quantity' => 1
])

@php
  $sizes = [
    'small' => 'w-4 h-4',
    'medium' => 'w-[18px] h-[18px]',
    'large' => 'w-5 h-5'
  ];
  $iconSize = $sizes[$size] ?? $sizes['medium'];
@endphp

<a href="javascript:void(0);"
   class="cart-btn add-to-cart-btn {{ $attributes->get('class', '') }}"
   data-id="{{ $productId }}"
   data-quantity="{{ $quantity }}"
   aria-label="Add to cart"
   title="Add to Cart"
   role="button">
  {{-- Standardized Cart Icon (matches header) --}}
  <svg
    class="{{ $iconSize }} {{ $showText ? 'mr-1 sm:mr-2' : '' }}"
    viewBox="0 0 24 24"
    fill="none"
    stroke="currentColor"
    stroke-width="2"
    aria-hidden="true"
    focusable="false">
    <circle cx="9" cy="21" r="1"></circle>
    <circle cx="20" cy="21" r="1"></circle>
    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
  </svg>

  @if($showText)
    <span class="hidden sm:inline">Add to Cart</span>
    <span class="sm:hidden">Cart</span>
  @endif
</a>
