@extends('frontend.include.app')

@section('content')
<!-- Main Content -->
<main id="main-content" role="main" class="bg-gray-50 dark:bg-gray-900 min-h-screen">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-8">

    <!-- Breadcrumb Navigation -->
    <nav aria-label="Breadcrumb" class="mb-6 lg:mb-8">
      <ol class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400">
        <li>
          <a href="{{ route('front.index') }}" class="hover:text-gray-900 dark:hover:text-gray-100 transition-colors duration-200">Home</a>
        </li>
        <li class="flex items-center">
          <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
          <span class="text-gray-900 dark:text-gray-100" aria-current="page">Sample Page</span>
        </li>
      </ol>
    </nav>

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

    <!-- Icons Section -->
    <section class="mb-12 lg:mb-16">
      <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 lg:p-8">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 mb-6">Common Icons</h2>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
          <!-- User Icon -->
          <div class="flex flex-col items-center">
            <svg class="w-8 h-8 text-gray-600 dark:text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            <p class="text-xs text-gray-600 dark:text-gray-400">User</p>
          </div>

          <!-- Cart Icon -->
          <div class="flex flex-col items-center">
            <svg class="w-8 h-8 text-gray-600 dark:text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <p class="text-xs text-gray-600 dark:text-gray-400">Cart</p>
          </div>

          <!-- Heart Icon -->
          <div class="flex flex-col items-center">
            <svg class="w-8 h-8 text-gray-600 dark:text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
            </svg>
            <p class="text-xs text-gray-600 dark:text-gray-400">Wishlist</p>
          </div>

          <!-- Search Icon -->
          <div class="flex flex-col items-center">
            <svg class="w-8 h-8 text-gray-600 dark:text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <circle cx="11" cy="11" r="8"></circle>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-4.35-4.35"></path>
            </svg>
            <p class="text-xs text-gray-600 dark:text-gray-400">Search</p>
          </div>

          <!-- Home Icon -->
          <div class="flex flex-col items-center">
            <svg class="w-8 h-8 text-gray-600 dark:text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            <p class="text-xs text-gray-600 dark:text-gray-400">Home</p>
          </div>

          <!-- Tag Icon -->
          <div class="flex flex-col items-center">
            <svg class="w-8 h-8 text-gray-600 dark:text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
            </svg>
            <p class="text-xs text-gray-600 dark:text-gray-400">Tag</p>
          </div>
        </div>
      </div>
    </section>

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

@section('scripts')
<script>
  // Sample JavaScript for demonstration
  console.log('Sample page loaded successfully!');

  // Theme-aware logging
  const isDarkMode = document.documentElement.classList.contains('dark');
  console.log('Current theme:', isDarkMode ? 'Dark' : 'Light');
</script>
@endsection
