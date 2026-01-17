@props([
    'title' => '',
    'open' => false,
    'variant' => 'default', // default, orange, white
    'size' => 'default', // default, sm, lg
])

@php
$variantClasses = [
    'orange' => 'bg-blue-50 dark:bg-blue-900/20 border-2 border-blue-200 dark:border-blue-800',
    'white' => 'bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600',
    'default' => 'bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700',
];

$sizeClasses = [
    'sm' => 'p-3',
    'default' => 'p-4',
    'lg' => 'p-6',
];

$variantClass = $variantClasses[$variant] ?? $variantClasses['default'];
$sizeClass = $sizeClasses[$size] ?? $sizeClasses['default'];
$uniqueId = 'collapsible-' . uniqid();
@endphp

<div {{ $attributes->merge(['class' => "$variantClass $sizeClass"]) }}>
  <!-- Header with Toggle Button -->
  <div class="flex items-center justify-between cursor-pointer" onclick="toggleCollapsible('{{ $uniqueId }}')">
    <div class="flex-1">
      @if($title)
        <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100">{{ $title }}</h3>
      @else
        {{ $header ?? '' }}
      @endif
    </div>
    <button
      type="button"
      class="flex-shrink-0 ml-3 p-1 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 rounded"
      aria-label="Toggle section"
      aria-expanded="{{ $open ? 'true' : 'false' }}"
      id="{{ $uniqueId }}-button">
      <!-- Plus Icon (when collapsed) -->
      <svg
        class="w-4 h-4 {{ $open ? 'hidden' : 'block' }}"
        id="{{ $uniqueId }}-plus"
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="2">
        <line x1="12" y1="5" x2="12" y2="19"></line>
        <line x1="5" y1="12" x2="19" y2="12"></line>
      </svg>
      <!-- Minus Icon (when expanded) -->
      <svg
        class="w-4 h-4 {{ $open ? 'block' : 'hidden' }}"
        id="{{ $uniqueId }}-minus"
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="2">
        <line x1="5" y1="12" x2="19" y2="12"></line>
      </svg>
    </button>
  </div>

  <!-- Collapsible Content -->
  <div
    class="overflow-hidden transition-all duration-300 {{ $open ? 'max-h-screen mt-4' : 'max-h-0' }}"
    id="{{ $uniqueId }}-content">
    {{ $slot }}
  </div>
</div>

<script>
  function toggleCollapsible(id) {
    const content = document.getElementById(id + '-content');
    const button = document.getElementById(id + '-button');
    const plusIcon = document.getElementById(id + '-plus');
    const minusIcon = document.getElementById(id + '-minus');

    if (content.classList.contains('max-h-0')) {
      // Expand
      content.classList.remove('max-h-0');
      content.classList.add('max-h-screen', 'mt-4');
      button.setAttribute('aria-expanded', 'true');
      plusIcon.classList.add('hidden');
      plusIcon.classList.remove('block');
      minusIcon.classList.remove('hidden');
      minusIcon.classList.add('block');
    } else {
      // Collapse
      content.classList.add('max-h-0');
      content.classList.remove('max-h-screen', 'mt-4');
      button.setAttribute('aria-expanded', 'false');
      plusIcon.classList.remove('hidden');
      plusIcon.classList.add('block');
      minusIcon.classList.add('hidden');
      minusIcon.classList.remove('block');
    }
  }
</script>
