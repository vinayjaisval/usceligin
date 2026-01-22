@props(['items' => []])

{{--
  Reusable Breadcrumb Component

  Usage:
  @include('frontend.include.breadcrumb', ['items' => [
    ['label' => 'Home', 'url' => route('front.index')],
    ['label' => 'Products', 'url' => route('front.products')],
    ['label' => 'Current Page'] // Last item has no URL
  ]])

  Or simple usage:
  @include('frontend.include.breadcrumb', ['items' => [
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'Blog']
  ]])
--}}

<nav aria-label="Breadcrumb" class="mb-6 lg:mb-8">
  <ol class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-300">
    @foreach($items as $index => $item)
      @if($index > 0)
        <li class="flex items-center">
          <span class="material-icons-outlined text-base mx-2 text-gray-400 dark:text-gray-500" aria-hidden="true">chevron_right</span>
        </li>
      @endif

      <li>
        @if(isset($item['url']) && !$loop->last)
          <a href="{{ $item['url'] }}" class="text-primary-700 dark:text-primary-400 hover:text-primary-800 dark:hover:text-primary-300 transition-colors duration-200">
            {{ $item['label'] }}
          </a>
        @else
          <span class="text-gray-900 dark:text-gray-100 font-semibold" aria-current="page">
            {{ $item['label'] }}
          </span>
        @endif
      </li>
    @endforeach
  </ol>
</nav>
