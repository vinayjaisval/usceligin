@props(['id' => 'loading-spinner', 'message' => 'Loading...'])

{{--
  Reusable Loading Spinner Component

  Usage:
  @include('frontend.include.loading-spinner', ['id' => 'my-spinner', 'message' => 'Loading products...'])

  JavaScript to show/hide:
  document.getElementById('my-spinner').classList.remove('hidden');
  document.getElementById('my-spinner').classList.add('hidden');
--}}

<div
  id="{{ $id }}"
  class="hidden fixed inset-0 bg-white/95 dark:bg-gray-900/95 backdrop-blur-sm z-50 flex items-center justify-center"
  role="status"
  aria-live="polite">
  <div class="text-center bg-white dark:bg-gray-800 p-8 border border-gray-200 dark:border-gray-700">
    <div class="inline-block w-12 h-12 border-4 border-primary-600 dark:border-primary-500 border-t-transparent rounded-full animate-spin" aria-hidden="true"></div>
    <p class="mt-4 text-gray-900 dark:text-gray-100 font-medium">{{ $message }}</p>
    <span class="sr-only">{{ $message }}</span>
  </div>
</div>
