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

<nav class="breadcrumb" aria-label="Breadcrumb">
  <ol class="breadcrumb-list">
    {{-- Home Link (Always First) --}}
    <li class="breadcrumb-item">
      <a href="{{ url('/') }}">Home</a>
    </li>

    {{-- Breadcrumb Items --}}
    @foreach($items as $item)
      @if($loop->last)
        {{-- Last item (current page) --}}
        <li class="breadcrumb-item active" aria-current="page">
          {{ $item['label'] }}
        </li>
      @else
        {{-- Intermediate items with links --}}
        <li class="breadcrumb-item">
          <a href="{{ $item['url'] ?? '#' }}">{{ $item['label'] }}</a>
        </li>
      @endif
    @endforeach
  </ol>
</nav>
