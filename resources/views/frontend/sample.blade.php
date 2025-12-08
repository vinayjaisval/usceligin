@extends('frontend.include.app')

@section('content')
<!-- Main Content -->
<main id="main-content" role="main" class="bg-gray-50 dark:bg-gray-900 min-h-screen">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-8">

    <!-- Breadcrumb Navigation -->
    @include('frontend.include.breadcrumb', ['items' => [
      ['label' => 'Home', 'url' => route('front.index')],
      ['label' => 'Sample Page']
    ]])

    <!-- Page Header -->
    <div class="mb-8 lg:mb-12">
      <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-gray-100 mb-4">
        Design System Reference
      </h1>
      <p class="text-base sm:text-lg text-gray-600 dark:text-gray-400 max-w-3xl">
        This page demonstrates the reusable UI components and design patterns used across the Celigin platform.
        All components follow Tailwind CSS conventions and support light/dark modes.
      </p>
    </div>

    <!-- Typography Section -->
    <section class="mb-12 lg:mb-16">
      <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 lg:p-8">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 mb-6">Typography</h2>

        <div class="space-y-4">
          <div>
            <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 dark:text-gray-100">Heading 1</h1>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">text-4xl sm:text-5xl font-bold</p>
          </div>

          <div>
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-gray-100">Heading 2</h2>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">text-3xl sm:text-4xl font-bold</p>
          </div>

          <div>
            <h3 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100">Heading 3</h3>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">text-2xl sm:text-3xl font-bold</p>
          </div>

          <div>
            <h4 class="text-xl sm:text-2xl font-semibold text-gray-900 dark:text-gray-100">Heading 4</h4>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">text-xl sm:text-2xl font-semibold</p>
          </div>

          <div>
            <p class="text-base sm:text-lg text-gray-600 dark:text-gray-400">
              Body text large - Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            </p>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">text-base sm:text-lg</p>
          </div>

          <div>
            <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">
              Body text regular - Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            </p>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">text-sm sm:text-base</p>
          </div>

          <div>
            <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400">
              Small text - Lorem ipsum dolor sit amet.
            </p>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">text-xs sm:text-sm</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Colors Section -->
    <section class="mb-12 lg:mb-16">
      <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 lg:p-8">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 mb-6">Color Palette</h2>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 lg:gap-6">
          <!-- Primary Orange -->
          <div>
            <div class="h-24 bg-orange-600 mb-2"></div>
            <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Primary Orange</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">bg-orange-600</p>
          </div>

          <!-- Orange Hover -->
          <div>
            <div class="h-24 bg-orange-700 mb-2"></div>
            <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Orange Hover</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">bg-orange-700</p>
          </div>

          <!-- Gray Background -->
          <div>
            <div class="h-24 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 mb-2"></div>
            <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Background</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">bg-gray-50 / gray-900</p>
          </div>

          <!-- White/Dark Card -->
          <div>
            <div class="h-24 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 mb-2"></div>
            <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Card Background</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">bg-white / gray-800</p>
          </div>

          <!-- Red Accent -->
          <div>
            <div class="h-24 bg-red-600 mb-2"></div>
            <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Red (Sale/Hot)</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">bg-red-600</p>
          </div>

          <!-- Green Accent -->
          <div>
            <div class="h-24 bg-green-600 mb-2"></div>
            <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Green (New)</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">bg-green-600</p>
          </div>

          <!-- Text Primary -->
          <div>
            <div class="h-24 bg-gray-900 dark:bg-gray-100 mb-2"></div>
            <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Text Primary</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">text-gray-900 / gray-100</p>
          </div>

          <!-- Text Secondary -->
          <div>
            <div class="h-24 bg-gray-600 dark:bg-gray-400 mb-2"></div>
            <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Text Secondary</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">text-gray-600 / gray-400</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Buttons Section -->
    <section class="mb-12 lg:mb-16">
      <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 lg:p-8">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 mb-6">Buttons</h2>

        <div class="space-y-6">
          <!-- Primary Buttons -->
          <div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Primary Buttons</h3>
            <div class="flex flex-wrap gap-4">
              <button class="px-6 py-3 bg-orange-600 text-white text-base font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 transition-colors">
                Large Button
              </button>
              <button class="px-5 py-2.5 bg-orange-600 text-white text-sm font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 transition-colors">
                Medium Button
              </button>
              <button class="px-4 py-2 bg-orange-600 text-white text-xs font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 transition-colors">
                Small Button
              </button>
            </div>
          </div>

          <!-- Secondary Buttons -->
          <div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Secondary Buttons</h3>
            <div class="flex flex-wrap gap-4">
              <button class="px-6 py-3 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-100 text-base font-semibold hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-500 transition-colors">
                Border Button
              </button>
              <button class="px-6 py-3 text-orange-600 dark:text-orange-400 text-base font-semibold hover:text-orange-700 dark:hover:text-orange-300 focus:outline-none focus:ring-2 focus:ring-orange-500 transition-colors">
                Text Button
              </button>
            </div>
          </div>

          <!-- Disabled State -->
          <div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Disabled State</h3>
            <div class="flex flex-wrap gap-4">
              <button disabled class="px-6 py-3 bg-gray-300 dark:bg-gray-700 text-gray-500 dark:text-gray-400 text-base font-semibold cursor-not-allowed">
                Disabled Button
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Form Elements Section -->
    <section class="mb-12 lg:mb-16">
      <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 lg:p-8">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 mb-6">Form Elements</h2>

        <div class="max-w-2xl space-y-6">
          <!-- Text Input -->
          <div>
            <label for="sample-input" class="block text-sm sm:text-base font-medium text-gray-700 dark:text-gray-300 mb-2">
              Text Input <span class="text-red-600">*</span>
            </label>
            <input
              type="text"
              id="sample-input"
              placeholder="Enter text..."
              class="w-full px-4 py-2.5 sm:py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors text-sm sm:text-base"
            />
          </div>

          <!-- Email Input -->
          <div>
            <label for="sample-email" class="block text-sm sm:text-base font-medium text-gray-700 dark:text-gray-300 mb-2">
              Email Address
            </label>
            <input
              type="email"
              id="sample-email"
              placeholder="you@example.com"
              class="w-full px-4 py-2.5 sm:py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors text-sm sm:text-base"
            />
          </div>

          <!-- Textarea -->
          <div>
            <label for="sample-textarea" class="block text-sm sm:text-base font-medium text-gray-700 dark:text-gray-300 mb-2">
              Message
            </label>
            <textarea
              id="sample-textarea"
              rows="4"
              placeholder="Enter your message..."
              class="w-full px-4 py-2.5 sm:py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors text-sm sm:text-base resize-none"
            ></textarea>
          </div>

          <!-- Select Dropdown -->
          <div>
            <label for="sample-select" class="block text-sm sm:text-base font-medium text-gray-700 dark:text-gray-300 mb-2">
              Select Option
            </label>
            <select
              id="sample-select"
              class="w-full px-4 py-2.5 sm:py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors text-sm sm:text-base"
            >
              <option>Option 1</option>
              <option>Option 2</option>
              <option>Option 3</option>
            </select>
          </div>

          <!-- Checkbox -->
          <div class="flex items-start">
            <input
              type="checkbox"
              id="sample-checkbox"
              class="mt-1 h-4 w-4 text-orange-600 border-gray-300 dark:border-gray-600 focus:ring-orange-500"
            />
            <label for="sample-checkbox" class="ml-3 text-sm sm:text-base text-gray-600 dark:text-gray-400">
              I agree to the terms and conditions
            </label>
          </div>

          <!-- Radio Buttons -->
          <div>
            <p class="block text-sm sm:text-base font-medium text-gray-700 dark:text-gray-300 mb-3">
              Choose an option
            </p>
            <div class="space-y-2">
              <div class="flex items-center">
                <input
                  type="radio"
                  id="radio1"
                  name="sample-radio"
                  class="h-4 w-4 text-orange-600 border-gray-300 dark:border-gray-600 focus:ring-orange-500"
                  checked
                />
                <label for="radio1" class="ml-3 text-sm sm:text-base text-gray-600 dark:text-gray-400">
                  Option 1
                </label>
              </div>
              <div class="flex items-center">
                <input
                  type="radio"
                  id="radio2"
                  name="sample-radio"
                  class="h-4 w-4 text-orange-600 border-gray-300 dark:border-gray-600 focus:ring-orange-500"
                />
                <label for="radio2" class="ml-3 text-sm sm:text-base text-gray-600 dark:text-gray-400">
                  Option 2
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Cards Section -->
    <section class="mb-12 lg:mb-16">
      <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 lg:p-8">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 mb-6">Cards</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <!-- Simple Card -->
          <div class="border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg sm:text-xl font-semibold text-gray-900 dark:text-gray-100 mb-3">Simple Card</h3>
            <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">
              This is a simple card with border. No shadow, clean design.
            </p>
          </div>

          <!-- Hover Card -->
          <div class="border border-gray-200 dark:border-gray-700 p-6 hover:border-orange-500 dark:hover:border-orange-500 transition-colors cursor-pointer">
            <h3 class="text-lg sm:text-xl font-semibold text-gray-900 dark:text-gray-100 mb-3">Hover Card</h3>
            <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">
              This card changes border color on hover.
            </p>
          </div>

          <!-- Highlighted Card -->
          <div class="bg-orange-50 dark:bg-orange-900/20 border border-orange-200 dark:border-orange-800 p-6">
            <h3 class="text-lg sm:text-xl font-semibold text-orange-900 dark:text-orange-100 mb-3">Highlighted Card</h3>
            <p class="text-sm sm:text-base text-orange-700 dark:text-orange-300">
              This card has orange background tint.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Badges & Labels Section -->
    <section class="mb-12 lg:mb-16">
      <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 lg:p-8">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 mb-6">Badges & Labels</h2>

        <div class="space-y-6">
          <!-- Status Badges -->
          <div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Status Badges</h3>
            <div class="flex flex-wrap gap-3">
              <span class="inline-block px-3 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-100 text-xs font-semibold rounded">New</span>
              <span class="inline-block px-3 py-1 bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-100 text-xs font-semibold rounded">Hot</span>
              <span class="inline-block px-3 py-1 bg-orange-100 dark:bg-orange-900 text-orange-800 dark:text-orange-100 text-xs font-semibold rounded">Sale</span>
              <span class="inline-block px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-100 text-xs font-semibold rounded">Featured</span>
              <span class="inline-block px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-100 text-xs font-semibold rounded">Default</span>
            </div>
          </div>

          <!-- Count Badges -->
          <div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Count Badges</h3>
            <div class="flex flex-wrap gap-4 items-center">
              <div class="relative inline-block">
                <svg class="w-6 h-6 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <span class="absolute -top-1 -right-1 bg-orange-600 dark:bg-orange-500 text-white text-xs h-5 w-5 flex items-center justify-center font-medium">3</span>
              </div>

              <div class="relative inline-block">
                <svg class="w-6 h-6 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
                <span class="absolute -top-1 -right-1 bg-orange-600 dark:bg-orange-500 text-white text-xs h-5 w-5 flex items-center justify-center font-medium">5</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Grid Layouts Section -->
    <section class="mb-12 lg:mb-16">
      <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 lg:p-8">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 mb-6">Grid Layouts</h2>

        <div class="space-y-8">
          <!-- 2 Column Grid -->
          <div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">2 Column Grid (md)</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="border border-gray-200 dark:border-gray-700 p-4 text-center">
                <p class="text-sm text-gray-600 dark:text-gray-400">Column 1</p>
              </div>
              <div class="border border-gray-200 dark:border-gray-700 p-4 text-center">
                <p class="text-sm text-gray-600 dark:text-gray-400">Column 2</p>
              </div>
            </div>
          </div>

          <!-- 3 Column Grid -->
          <div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">3 Column Grid (lg)</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
              <div class="border border-gray-200 dark:border-gray-700 p-4 text-center">
                <p class="text-sm text-gray-600 dark:text-gray-400">Column 1</p>
              </div>
              <div class="border border-gray-200 dark:border-gray-700 p-4 text-center">
                <p class="text-sm text-gray-600 dark:text-gray-400">Column 2</p>
              </div>
              <div class="border border-gray-200 dark:border-gray-700 p-4 text-center">
                <p class="text-sm text-gray-600 dark:text-gray-400">Column 3</p>
              </div>
            </div>
          </div>

          <!-- 4 Column Grid -->
          <div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">4 Column Grid (xl)</h3>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
              <div class="border border-gray-200 dark:border-gray-700 p-4 text-center">
                <p class="text-xs text-gray-600 dark:text-gray-400">Col 1</p>
              </div>
              <div class="border border-gray-200 dark:border-gray-700 p-4 text-center">
                <p class="text-xs text-gray-600 dark:text-gray-400">Col 2</p>
              </div>
              <div class="border border-gray-200 dark:border-gray-700 p-4 text-center">
                <p class="text-xs text-gray-600 dark:text-gray-400">Col 3</p>
              </div>
              <div class="border border-gray-200 dark:border-gray-700 p-4 text-center">
                <p class="text-xs text-gray-600 dark:text-gray-400">Col 4</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Note: This section has been moved to Material Icons section below -->

    <!-- Spacing Reference -->
    <section class="mb-12 lg:mb-16">
      <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 lg:p-8">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 mb-6">Spacing Reference</h2>

        <div class="space-y-4">
          <div>
            <p class="text-sm font-medium text-gray-900 dark:text-gray-100 mb-2">Container Padding</p>
            <p class="text-sm text-gray-600 dark:text-gray-400">px-4 sm:px-6 lg:px-8 (16px → 24px → 32px)</p>
          </div>

          <div>
            <p class="text-sm font-medium text-gray-900 dark:text-gray-100 mb-2">Vertical Spacing</p>
            <p class="text-sm text-gray-600 dark:text-gray-400">py-6 lg:py-8 (24px → 32px)</p>
          </div>

          <div>
            <p class="text-sm font-medium text-gray-900 dark:text-gray-100 mb-2">Grid Gaps</p>
            <p class="text-sm text-gray-600 dark:text-gray-400">gap-4 sm:gap-6 lg:gap-8 (16px → 24px → 32px)</p>
          </div>

          <div>
            <p class="text-sm font-medium text-gray-900 dark:text-gray-100 mb-2">Section Margins</p>
            <p class="text-sm text-gray-600 dark:text-gray-400">mb-8 lg:mb-12 (32px → 48px)</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Reusable Components Section -->
    <section class="mb-12 lg:mb-16">
      <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 lg:p-8">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 mb-6">Reusable Components</h2>
        <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400 mb-8">
          These are pre-built, reusable components located in <code class="px-2 py-1 bg-gray-100 dark:bg-gray-700 text-orange-600 dark:text-orange-400 text-xs">resources/views/frontend/include/</code>
        </p>

        <div class="space-y-12">
          <!-- Breadcrumb Component -->
          <div>
            <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">1. Breadcrumb Navigation</h3>

            <!-- Live Example -->
            <div class="mb-4 p-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600">
              @include('frontend.include.breadcrumb', ['items' => [
                ['label' => 'Home', 'url' => route('front.index')],
                ['label' => 'Shop', 'url' => '#'],
                ['label' => 'Current Page']
              ]])
            </div>

            <!-- Code Example -->
            <div class="bg-gray-900 text-gray-100 p-4 overflow-x-auto text-xs sm:text-sm">
              <pre><code>@include('frontend.include.breadcrumb', [
  'items' => [
    ['label' => 'Home', 'url' => route('front.index')],
    ['label' => 'Shop', 'url' => '#'],
    ['label' => 'Current Page'] // Last item has no URL
  ]
])</code></pre>
            </div>
          </div>

          <!-- Loading Spinner Component -->
          <div>
            <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">2. Loading Spinner</h3>

            <!-- Demo Button -->
            <div class="mb-4">
              <button
                onclick="showLoadingSpinner()"
                class="px-6 py-3 bg-orange-600 text-white text-sm font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 transition-colors">
                Show Loading Spinner (3 seconds)
              </button>
            </div>

            <!-- Code Example -->
            <div class="bg-gray-900 text-gray-100 p-4 overflow-x-auto text-xs sm:text-sm mb-4">
              <pre><code>@include('frontend.include.loading-spinner', [
  'id' => 'my-spinner',
  'message' => 'Loading products...'
])</code></pre>
            </div>

            <div class="bg-gray-900 text-gray-100 p-4 overflow-x-auto text-xs sm:text-sm">
              <pre><code>// Show spinner
document.getElementById('my-spinner').classList.remove('hidden');

// Hide spinner
document.getElementById('my-spinner').classList.add('hidden');</code></pre>
            </div>
          </div>

          <!-- Accordion Component -->
          <div>
            <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">3. Accordion</h3>

            <!-- Live Example - Default Type -->
            <div class="mb-6">
              <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Default Accordion (Multiple Open):</p>
              <div class="p-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600">
                @include('frontend.include.accordion', [
                  'id' => 'sample-accordion',
                  'type' => 'default',
                  'items' => [
                    [
                      'id' => 'acc1',
                      'title' => 'What is your return policy?',
                      'content' => '<p class="text-gray-600 dark:text-gray-400">We offer a 30-day return policy on all items. Products must be unused and in original packaging.</p>',
                      'open' => true
                    ],
                    [
                      'id' => 'acc2',
                      'title' => 'How long does shipping take?',
                      'content' => '<p class="text-gray-600 dark:text-gray-400">Standard shipping takes 5-7 business days. Express shipping is available for 2-3 day delivery.</p>'
                    ],
                    [
                      'id' => 'acc3',
                      'title' => 'Do you ship internationally?',
                      'content' => '<p class="text-gray-600 dark:text-gray-400">Yes, we ship to over 50 countries worldwide. International shipping rates vary by destination.</p>'
                    ]
                  ]
                ])
              </div>
            </div>

            <!-- Live Example - Radio Type -->
            <div class="mb-6">
              <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Radio Accordion (Single Selection):</p>
              <div class="p-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600">
                @include('frontend.include.accordion', [
                  'id' => 'payment-accordion',
                  'type' => 'radio',
                  'items' => [
                    [
                      'id' => 'payment1',
                      'title' => 'Credit/Debit Card',
                      'content' => '<p class="text-gray-600 dark:text-gray-400">Pay securely with Visa, MasterCard, or American Express.</p>',
                      'radio_name' => 'payment_method',
                      'radio_value' => 'card',
                      'open' => true
                    ],
                    [
                      'id' => 'payment2',
                      'title' => 'PayPal',
                      'content' => '<p class="text-gray-600 dark:text-gray-400">Fast and secure payment via PayPal account.</p>',
                      'radio_name' => 'payment_method',
                      'radio_value' => 'paypal'
                    ],
                    [
                      'id' => 'payment3',
                      'title' => 'Cash on Delivery',
                      'content' => '<p class="text-gray-600 dark:text-gray-400">Pay when you receive your order.</p>',
                      'radio_name' => 'payment_method',
                      'radio_value' => 'cod'
                    ]
                  ]
                ])
              </div>
            </div>

            <!-- Code Example -->
            <div class="bg-gray-900 text-gray-100 p-4 overflow-x-auto text-xs sm:text-sm">
              <pre><code>@include('frontend.include.accordion', [
  'id' => 'payment-accordion',
  'type' => 'radio', // 'default' or 'radio'
  'items' => [
    [
      'id' => 'item1',
      'title' => 'Accordion Title',
      'content' => '&lt;p&gt;HTML content here&lt;/p&gt;',
      'open' => true, // Optional: open by default
      'radio_name' => 'payment_method', // For radio type
      'radio_value' => 'card' // For radio type
    ]
  ]
])</code></pre>
            </div>
          </div>

          <!-- Empty State Component -->
          <div>
            <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">4. Empty State</h3>

            <!-- Live Examples -->
            <div class="space-y-6 mb-6">
              <!-- Empty Cart -->
              <div class="p-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600">
                @include('frontend.include.empty-state', [
                  'title' => 'Your cart is empty',
                  'message' => 'Looks like you haven\'t added anything to your cart yet',
                  'icon' => 'cart',
                  'buttonText' => 'Start Shopping',
                  'buttonUrl' => route('front.index')
                ])
              </div>

              <!-- No Search Results -->
              <div class="p-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600">
                @include('frontend.include.empty-state', [
                  'title' => 'No results found',
                  'message' => 'We couldn\'t find any products matching your search',
                  'icon' => 'search',
                  'buttonText' => 'Clear Search',
                  'buttonUrl' => '#'
                ])
              </div>

              <!-- Default/No Items -->
              <div class="p-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600">
                @include('frontend.include.empty-state', [
                  'title' => 'No items in your wardrobe',
                  'message' => 'Start adding items to build your collection',
                  'icon' => 'box',
                  'buttonText' => 'Browse Collection',
                  'buttonUrl' => route('front.index')
                ])
              </div>
            </div>

            <!-- Code Example -->
            <div class="bg-gray-900 text-gray-100 p-4 overflow-x-auto text-xs sm:text-sm">
              <pre><code>@include('frontend.include.empty-state', [
  'title' => 'Your cart is empty',
  'message' => 'Looks like you haven\'t added anything yet',
  'icon' => 'cart', // 'box', 'cart', 'search', or 'custom'
  'customSvg' => null, // Optional: provide custom SVG
  'buttonText' => 'Start Shopping',
  'buttonUrl' => route('front.index')
])</code></pre>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Material Icons Section -->
    <section class="mb-12 lg:mb-16">
      <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 lg:p-8">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 mb-6">Material Icons</h2>
        <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400 mb-8">
          Google Material Icons are integrated and ready to use. Browse all icons at
          <a href="https://fonts.google.com/icons" target="_blank" class="text-orange-600 dark:text-orange-400 hover:underline">fonts.google.com/icons</a>
        </p>

        <div class="space-y-8">
          <!-- Icon Variants -->
          <div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Icon Variants</h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-6">
              <!-- Outlined -->
              <div class="text-center">
                @include('frontend.include.icon', ['name' => 'favorite', 'variant' => 'outlined', 'size' => '2xl', 'class' => 'text-orange-600 dark:text-orange-400'])
                <p class="text-xs text-gray-600 dark:text-gray-400 mt-2">Outlined</p>
              </div>

              <!-- Filled -->
              <div class="text-center">
                @include('frontend.include.icon', ['name' => 'favorite', 'variant' => 'filled', 'size' => '2xl', 'class' => 'text-orange-600 dark:text-orange-400'])
                <p class="text-xs text-gray-600 dark:text-gray-400 mt-2">Filled</p>
              </div>

              <!-- Round -->
              <div class="text-center">
                @include('frontend.include.icon', ['name' => 'favorite', 'variant' => 'round', 'size' => '2xl', 'class' => 'text-orange-600 dark:text-orange-400'])
                <p class="text-xs text-gray-600 dark:text-gray-400 mt-2">Round</p>
              </div>

              <!-- Sharp -->
              <div class="text-center">
                @include('frontend.include.icon', ['name' => 'favorite', 'variant' => 'sharp', 'size' => '2xl', 'class' => 'text-orange-600 dark:text-orange-400'])
                <p class="text-xs text-gray-600 dark:text-gray-400 mt-2">Sharp</p>
              </div>

              <!-- Two Tone -->
              <div class="text-center">
                @include('frontend.include.icon', ['name' => 'favorite', 'variant' => 'two-tone', 'size' => '2xl', 'class' => 'text-orange-600 dark:text-orange-400'])
                <p class="text-xs text-gray-600 dark:text-gray-400 mt-2">Two-Tone</p>
              </div>
            </div>
          </div>

          <!-- Common Icons -->
          <div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Common Icons</h3>
            <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-6">
              <div class="text-center">
                @include('frontend.include.icon', ['name' => 'shopping_cart', 'size' => 'xl', 'class' => 'text-gray-600 dark:text-gray-400'])
                <p class="text-xs text-gray-600 dark:text-gray-400 mt-2">shopping_cart</p>
              </div>

              <div class="text-center">
                @include('frontend.include.icon', ['name' => 'favorite_border', 'size' => 'xl', 'class' => 'text-gray-600 dark:text-gray-400'])
                <p class="text-xs text-gray-600 dark:text-gray-400 mt-2">favorite_border</p>
              </div>

              <div class="text-center">
                @include('frontend.include.icon', ['name' => 'search', 'size' => 'xl', 'class' => 'text-gray-600 dark:text-gray-400'])
                <p class="text-xs text-gray-600 dark:text-gray-400 mt-2">search</p>
              </div>

              <div class="text-center">
                @include('frontend.include.icon', ['name' => 'account_circle', 'size' => 'xl', 'class' => 'text-gray-600 dark:text-gray-400'])
                <p class="text-xs text-gray-600 dark:text-gray-400 mt-2">account_circle</p>
              </div>

              <div class="text-center">
                @include('frontend.include.icon', ['name' => 'home', 'size' => 'xl', 'class' => 'text-gray-600 dark:text-gray-400'])
                <p class="text-xs text-gray-600 dark:text-gray-400 mt-2">home</p>
              </div>

              <div class="text-center">
                @include('frontend.include.icon', ['name' => 'menu', 'size' => 'xl', 'class' => 'text-gray-600 dark:text-gray-400'])
                <p class="text-xs text-gray-600 dark:text-gray-400 mt-2">menu</p>
              </div>

              <div class="text-center">
                @include('frontend.include.icon', ['name' => 'star', 'size' => 'xl', 'class' => 'text-gray-600 dark:text-gray-400'])
                <p class="text-xs text-gray-600 dark:text-gray-400 mt-2">star</p>
              </div>

              <div class="text-center">
                @include('frontend.include.icon', ['name' => 'local_offer', 'size' => 'xl', 'class' => 'text-gray-600 dark:text-gray-400'])
                <p class="text-xs text-gray-600 dark:text-gray-400 mt-2">local_offer</p>
              </div>

              <div class="text-center">
                @include('frontend.include.icon', ['name' => 'visibility', 'size' => 'xl', 'class' => 'text-gray-600 dark:text-gray-400'])
                <p class="text-xs text-gray-600 dark:text-gray-400 mt-2">visibility</p>
              </div>

              <div class="text-center">
                @include('frontend.include.icon', ['name' => 'arrow_forward', 'size' => 'xl', 'class' => 'text-gray-600 dark:text-gray-400'])
                <p class="text-xs text-gray-600 dark:text-gray-400 mt-2">arrow_forward</p>
              </div>

              <div class="text-center">
                @include('frontend.include.icon', ['name' => 'close', 'size' => 'xl', 'class' => 'text-gray-600 dark:text-gray-400'])
                <p class="text-xs text-gray-600 dark:text-gray-400 mt-2">close</p>
              </div>

              <div class="text-center">
                @include('frontend.include.icon', ['name' => 'check_circle', 'size' => 'xl', 'class' => 'text-gray-600 dark:text-gray-400'])
                <p class="text-xs text-gray-600 dark:text-gray-400 mt-2">check_circle</p>
              </div>
            </div>
          </div>

          <!-- Usage Code -->
          <div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Usage Example</h3>
            <div class="bg-gray-900 text-gray-100 p-4 overflow-x-auto text-xs sm:text-sm">
              <pre><code>@include('frontend.include.icon', [
  'name' => 'shopping_cart',
  'variant' => 'outlined', // or 'filled', 'round', 'sharp', 'two-tone'
  'size' => 'lg',          // 'xs', 'sm', 'base', 'lg', 'xl', '2xl'
  'class' => 'text-orange-600 dark:text-orange-400'
])</code></pre>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Usage Notes -->
    <section class="mb-12 lg:mb-16">
      <div class="bg-orange-50 dark:bg-orange-900/20 border border-orange-200 dark:border-orange-800 p-6 lg:p-8">
        <h2 class="text-2xl sm:text-3xl font-bold text-orange-900 dark:text-orange-100 mb-6">Usage Guidelines</h2>

        <div class="space-y-4 text-sm sm:text-base text-orange-800 dark:text-orange-200">
          <div>
            <h3 class="font-semibold mb-2">Responsive Design</h3>
            <ul class="list-disc list-inside space-y-1 ml-4">
              <li>Always use responsive classes: sm:, md:, lg:, xl:</li>
              <li>Mobile-first approach: base styles for mobile, add breakpoints for larger screens</li>
              <li>Test on all breakpoints: 320px, 640px, 768px, 1024px, 1280px</li>
            </ul>
          </div>

          <div>
            <h3 class="font-semibold mb-2">Dark Mode</h3>
            <ul class="list-disc list-inside space-y-1 ml-4">
              <li>Every color must have a dark: variant</li>
              <li>Use dark:bg-gray-800 for cards, dark:bg-gray-900 for backgrounds</li>
              <li>Text colors: dark:text-gray-100 (primary), dark:text-gray-400 (secondary)</li>
            </ul>
          </div>

          <div>
            <h3 class="font-semibold mb-2">Accessibility</h3>
            <ul class="list-disc list-inside space-y-1 ml-4">
              <li>Add aria-label to all icons and buttons</li>
              <li>Use semantic HTML: nav, main, section, article</li>
              <li>Include focus states: focus:ring-2 focus:ring-orange-500</li>
              <li>Ensure color contrast meets WCAG AA standards</li>
            </ul>
          </div>

          <div>
            <h3 class="font-semibold mb-2">Reusable Components</h3>
            <ul class="list-disc list-inside space-y-1 ml-4">
              <li>Header: @include('frontend.include.header')</li>
              <li>Footer: @include('frontend.include.footer')</li>
              <li>Layout: @extends('frontend.include.app')</li>
              <li>Always use consistent breadcrumb navigation</li>
            </ul>
          </div>
        </div>
      </div>
    </section>

  </div>
</main>
@endsection

<!-- Loading Spinner for Demo -->
@include('frontend.include.loading-spinner', [
  'id' => 'demo-spinner',
  'message' => 'Loading...'
])

@section('scripts')
<script>
  // Sample JavaScript for demonstration
  console.log('Sample page loaded successfully!');

  // Theme-aware logging
  const isDarkMode = document.documentElement.classList.contains('dark');
  console.log('Current theme:', isDarkMode ? 'Dark' : 'Light');

  // Loading Spinner Demo Function
  function showLoadingSpinner() {
    const spinner = document.getElementById('demo-spinner');
    spinner.classList.remove('hidden');

    // Hide after 3 seconds
    setTimeout(() => {
      spinner.classList.add('hidden');
    }, 3000);
  }
</script>
@endsection
