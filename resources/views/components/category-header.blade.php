{{--
  Category Header Component

  Displays category page header with title, filter tags, results count, and sort dropdown.
  Used across: best-sellers, new-arrivals, sale, skin-care, my-wishlist

  Usage:
    Simple (no tags):
    <x-category-header title="Best Sellers" :results-count="$prods->count()" />

    With tag links:
    <x-category-header title="Best Sellers" :results-count="$prods->count()">
      <x-slot:tags>
        @foreach($tags as $tag)
          <li>
            <a href="{{ route('front.best-sellers', ['tag' => $tag]) }}"
               class="category-tag {{ request('tag') === $tag ? 'active' : '' }}">
              {{ ucwords(str_replace('-', ' ', $tag)) }}
            </a>
          </li>
        @endforeach
      </x-slot:tags>
    </x-category-header>

    With tag buttons (form-based):
    <x-category-header title="New Arrivals" :results-count="$prods->count()" :show-sort="false">
      <x-slot:tags>
        @foreach($categories as $slug => $label)
          <li>
            <button type="submit" name="category" value="{{ $slug }}"
                    class="category-tag {{ request('category') === $slug ? 'active' : '' }}">
              {{ $label }}
            </button>
          </li>
        @endforeach
      </x-slot:tags>
    </x-category-header>

  Props:
    - title (required): Page title (h1)
    - resultsCount (required): Number of results to display
    - showSort (optional): Show sort dropdown (default: true)
    - sortFormId (optional): Form ID for sort (default: 'sort-form')
    - currentSort (optional): Currently selected sort option

  Slots:
    - tags (optional): Custom tag/filter navigation items (li elements)
--}}

@props([
  'title',
  'resultsCount',
  'showSort' => true,
  'sortFormId' => 'sort-form',
  'currentSort' => null
])

<section class="category-header-wrapper">
  {{-- Row 1: Title --}}
  <div class="category-headline">
    <h1 class="category-title">{{ $title }}</h1>
  </div>

  {{-- Row 2: Tags (if provided) --}}
  @if(isset($tags))
    <nav class="category-tags" aria-label="Category filters">
      <ul class="category-tags-list" role="list">
        {{ $tags }}
      </ul>
    </nav>
  @endif

  {{-- Row 3: Results Count & Sort Dropdown --}}
  <div class="category-controls">
    <div class="category-results">
      <span class="products-count" aria-live="polite">{{ $resultsCount }} results</span>
    </div>

    @if($showSort)
      <div class="category-filters">
        <form method="GET" id="{{ $sortFormId }}">
          {{-- Preserve existing query parameters --}}
          @foreach(request()->except(['sort', '_token']) as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
          @endforeach

          <label for="sort-select" class="sort-label">Sort by</label>
          <select id="sort-select" name="sort" class="filter-select"
                  onchange="document.getElementById('{{ $sortFormId }}').submit()"
                  aria-label="Sort products by">
            @php
              $sortValue = $currentSort ?? request('sort', 'popularity');
            @endphp
            <option value="popularity" {{ $sortValue === 'popularity' ? 'selected' : '' }}>Popularity</option>
            <option value="price-low" {{ $sortValue === 'price-low' ? 'selected' : '' }}>Price: Low to High</option>
            <option value="price-high" {{ $sortValue === 'price-high' ? 'selected' : '' }}>Price: High to Low</option>
          </select>
        </form>
      </div>
    @endif
  </div>
</section>
