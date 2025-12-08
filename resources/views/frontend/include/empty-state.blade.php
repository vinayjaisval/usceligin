@props([
  'title' => 'No items found',
  'message' => '',
  'icon' => 'box', // 'box', 'cart', 'search', 'custom'
  'customSvg' => null,
  'buttonText' => null,
  'buttonUrl' => null
])

{{--
  Reusable Empty State Component

  Usage:
  @include('frontend.include.empty-state', [
    'title' => 'Your cart is empty',
    'message' => 'Looks like you haven\'t added anything yet',
    'icon' => 'cart',
    'buttonText' => 'Start Shopping',
    'buttonUrl' => route('front.index')
  ])
--}}

<div class="flex flex-col items-center justify-center py-12 lg:py-16 px-4">
  <!-- Icon -->
  <div class="w-48 h-48 sm:w-64 sm:h-64 mb-6 lg:mb-8">
    @if($customSvg)
      {!! $customSvg !!}
    @elseif($icon === 'cart')
      <svg viewBox="0 0 24 24" class="w-full h-full text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
      </svg>
    @elseif($icon === 'search')
      <svg viewBox="0 0 200 200" class="w-full h-full text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor">
        <circle cx="80" cy="80" r="40" stroke-width="8"/>
        <line x1="110" y1="110" x2="160" y2="160" stroke-width="8" stroke-linecap="round"/>
      </svg>
    @else
      {{-- Default: Box icon --}}
      <svg viewBox="0 0 200 200" class="w-full h-full" aria-hidden="true">
        <!-- Wardrobe illustration -->
        <rect x="50" y="40" width="100" height="120" fill="#A0D8D8" stroke="#6B7280" stroke-width="2"/>
        <rect x="50" y="40" width="50" height="120" fill="#FCA5A5" stroke="#6B7280" stroke-width="2"/>
        <rect x="100" y="40" width="50" height="120" fill="#FCA5A5" stroke="#6B7280" stroke-width="2"/>
        <path d="M 40 40 L 50 30 L 150 30 L 160 40 Z" fill="#C084FC"/>
        <circle cx="75" cy="100" r="3" fill="#374151"/>
        <circle cx="125" cy="100" r="3" fill="#374151"/>
        <ellipse cx="125" cy="90" rx="15" ry="10" fill="#FCD34D"/>
        <circle cx="120" cy="88" r="2" fill="#374151"/>
        <circle cx="130" cy="88" r="2" fill="#374151"/>
        <line x1="60" y1="50" x2="60" y2="70" stroke="#EC4899" stroke-width="2"/>
        <line x1="70" y1="50" x2="70" y2="75" stroke="#EC4899" stroke-width="2"/>
        <line x1="80" y1="50" x2="80" y2="70" stroke="#EC4899" stroke-width="2"/>
        <ellipse cx="105" cy="165" rx="60" ry="5" fill="#E5E7EB"/>
      </svg>
    @endif
  </div>

  <!-- Title -->
  <h3 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-gray-100 mb-2 text-center">
    {{ $title }}
  </h3>

  <!-- Message -->
  @if($message)
    <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400 mb-6 lg:mb-8 text-center max-w-md">
      {{ $message }}
    </p>
  @endif

  <!-- Action Button -->
  @if($buttonText && $buttonUrl)
    <a
      href="{{ $buttonUrl }}"
      class="px-6 py-3 bg-orange-600 text-white text-sm sm:text-base font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 transition-colors">
      {{ $buttonText }}
    </a>
  @endif
</div>
