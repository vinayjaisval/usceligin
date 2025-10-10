{{--
  Breadcrumb Navigation Component

  Displays breadcrumb navigation for page hierarchy.
  Used across: best-sellers, new-arrivals, sale, skin-care, my-wishlist, product-detail, and more

  Usage:
    Simple (single level):
    <x-breadcrumb title="Best Sellers" />

    Multi-level:
    <x-breadcrumb :items="[
      ['label' => 'Products', 'url' => '/products'],
      ['label' => 'Skincare', 'url' => '/skincare'],
      ['label' => 'Moisturizers']
    ]" />

    With title prop:
    <x-breadcrumb title="My Wishlist" />

  Props:
    - title (optional): Simple title for single-level breadcrumb
    - items (optional): Array of breadcrumb items with 'label' and optional 'url'
--}}

@props(['title' => null, 'items' => []])

@php
  // If title is provided, create simple items array
  if ($title && empty($items)) {
    $items = [['label' => $title]];
  }
@endphp

<nav aria-label="Breadcrumb" class="mb-6">
  <ol class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400">
    {{-- Home Link (Always First) --}}
    <li>
      <a href="{{ url('/') }}" class="hover:text-gray-900 dark:hover:text-gray-100 transition-colors duration-200">
        Home
      </a>
    </li>

    {{-- Breadcrumb Items --}}
    @foreach($items as $item)
      <li class="flex items-center">
        {{-- Separator Arrow --}}
        <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>

        @if($loop->last)
          {{-- Last item (current page) --}}
          <span class="text-gray-900 dark:text-gray-100" aria-current="page">
            {{ $item['label'] }}
          </span>
        @else
          {{-- Intermediate items with links --}}
          <a href="{{ $item['url'] ?? '#' }}" class="hover:text-gray-900 dark:hover:text-gray-100 transition-colors duration-200">
            {{ $item['label'] }}
          </a>
        @endif
      </li>
    @endforeach
  </ol>
</nav>
