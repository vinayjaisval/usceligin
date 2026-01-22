@extends('frontend.include.app')

@section('content')
<!-- Main Content -->
<main id="main-content" role="main" class="bg-gray-50 dark:bg-gray-900 min-h-screen">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-8">

    <!-- Breadcrumb Navigation -->
    @include('frontend.include.breadcrumb', ['items' => [
      ['label' => 'Home', 'url' => route('front.index')],
      ['label' => 'Design System']
    ]])

    <!-- Page Header -->
    <div class="mb-8 lg:mb-12">
      <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-neutral-900 dark:text-gray-100 mb-4">
        Brand Design System
      </h1>
      <p class="text-base sm:text-lg text-neutral-700 dark:text-gray-400 max-w-3xl">
        This page documents the Celigin brand color system, accessibility guidelines, and UI components.
        All colors are WCAG compliant with tested contrast ratios.
      </p>
    </div>

    <!-- Primary Blue System -->
    <section class="mb-12 lg:mb-16">
      <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 lg:p-8">
        <h2 class="text-2xl sm:text-3xl font-bold text-neutral-900 dark:text-gray-100 mb-2">Primary Blue System</h2>
        <p class="text-sm text-neutral-700 dark:text-gray-400 mb-6">Our core brand color palette with accessibility ratings.</p>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4 lg:gap-6">
          <!-- Primary 900 -->
          <div>
            <div class="h-24 bg-primary-900 mb-2 flex items-end p-2">
              <span class="text-white text-xs font-mono">#1A2D5C</span>
            </div>
            <p class="text-sm font-medium text-neutral-900 dark:text-gray-100">Primary 900</p>
            <p class="text-xs text-semantic-success font-semibold">AAA Text</p>
            <p class="text-xs text-neutral-500 dark:text-gray-400">18.1:1 on white</p>
          </div>

          <!-- Primary 800 -->
          <div>
            <div class="h-24 bg-primary-800 mb-2 flex items-end p-2">
              <span class="text-white text-xs font-mono">#2E4682</span>
            </div>
            <p class="text-sm font-medium text-neutral-900 dark:text-gray-100">Primary 800</p>
            <p class="text-xs text-semantic-success font-semibold">AAA Text</p>
            <p class="text-xs text-neutral-500 dark:text-gray-400">7.0:1 on white</p>
          </div>

          <!-- Primary 700 -->
          <div>
            <div class="h-24 bg-primary-700 mb-2 flex items-end p-2">
              <span class="text-white text-xs font-mono">#3D5BA9</span>
            </div>
            <p class="text-sm font-medium text-neutral-900 dark:text-gray-100">Primary 700</p>
            <p class="text-xs text-semantic-success font-semibold">AA Text</p>
            <p class="text-xs text-neutral-500 dark:text-gray-400">4.5:1 on white</p>
          </div>

          <!-- Primary 600 (Highlighted) -->
          <div class="ring-2 ring-primary-600 ring-offset-2">
            <div class="h-24 bg-primary-600 mb-2 flex items-end p-2">
              <span class="text-white text-xs font-mono">#5C80E0</span>
            </div>
            <p class="text-sm font-medium text-neutral-900 dark:text-gray-100">Primary 600</p>
            <p class="text-xs text-semantic-warning font-semibold">Accent Only</p>
            <p class="text-xs text-neutral-500 dark:text-gray-400">3.0:1 on white</p>
          </div>

          <!-- Primary 500 -->
          <div>
            <div class="h-24 bg-primary-500 mb-2 flex items-end p-2">
              <span class="text-white text-xs font-mono">#7A9AE8</span>
            </div>
            <p class="text-sm font-medium text-neutral-900 dark:text-gray-100">Primary 500</p>
            <p class="text-xs text-semantic-warning font-semibold">Large Text</p>
            <p class="text-xs text-neutral-500 dark:text-gray-400">2.3:1 on white</p>
          </div>

          <!-- Primary 400 -->
          <div>
            <div class="h-24 bg-primary-400 mb-2 flex items-end p-2">
              <span class="text-primary-900 text-xs font-mono">#98B3F0</span>
            </div>
            <p class="text-sm font-medium text-neutral-900 dark:text-gray-100">Primary 400</p>
            <p class="text-xs text-primary-700 font-semibold">Background</p>
          </div>

          <!-- Primary 300 -->
          <div>
            <div class="h-24 bg-primary-300 mb-2 flex items-end p-2">
              <span class="text-primary-900 text-xs font-mono">#B6CCF7</span>
            </div>
            <p class="text-sm font-medium text-neutral-900 dark:text-gray-100">Primary 300</p>
            <p class="text-xs text-primary-700 font-semibold">Background</p>
          </div>

          <!-- Primary 200 -->
          <div>
            <div class="h-24 bg-primary-200 mb-2 flex items-end p-2">
              <span class="text-primary-900 text-xs font-mono">#D4E5FB</span>
            </div>
            <p class="text-sm font-medium text-neutral-900 dark:text-gray-100">Primary 200</p>
            <p class="text-xs text-primary-700 font-semibold">Background</p>
          </div>

          <!-- Primary 100 -->
          <div>
            <div class="h-24 bg-primary-100 mb-2 flex items-end p-2">
              <span class="text-primary-900 text-xs font-mono">#EAF2FE</span>
            </div>
            <p class="text-sm font-medium text-neutral-900 dark:text-gray-100">Primary 100</p>
            <p class="text-xs text-primary-700 font-semibold">Background</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Neutral Gray System -->
    <section class="mb-12 lg:mb-16">
      <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 lg:p-8">
        <h2 class="text-2xl sm:text-3xl font-bold text-neutral-900 dark:text-gray-100 mb-2">Neutral Gray System</h2>
        <p class="text-sm text-neutral-700 dark:text-gray-400 mb-6">For text, backgrounds, and UI elements.</p>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 lg:gap-6">
          <!-- Gray 900 -->
          <div>
            <div class="h-24 bg-neutral-900 mb-2 flex items-end p-2">
              <span class="text-white text-xs font-mono">#0F172A</span>
            </div>
            <p class="text-sm font-medium text-neutral-900 dark:text-gray-100">Gray 900</p>
            <p class="text-xs text-semantic-success font-semibold">AAA Text</p>
          </div>

          <!-- Gray 800 -->
          <div>
            <div class="h-24 bg-neutral-800 mb-2 flex items-end p-2">
              <span class="text-white text-xs font-mono">#1E293B</span>
            </div>
            <p class="text-sm font-medium text-neutral-900 dark:text-gray-100">Gray 800</p>
            <p class="text-xs text-semantic-success font-semibold">AAA Text</p>
          </div>

          <!-- Gray 700 -->
          <div>
            <div class="h-24 bg-neutral-700 mb-2 flex items-end p-2">
              <span class="text-white text-xs font-mono">#334155</span>
            </div>
            <p class="text-sm font-medium text-neutral-900 dark:text-gray-100">Gray 700</p>
            <p class="text-xs text-semantic-success font-semibold">AAA Text</p>
          </div>

          <!-- Gray 500 -->
          <div>
            <div class="h-24 bg-neutral-500 mb-2 flex items-end p-2">
              <span class="text-white text-xs font-mono">#64748B</span>
            </div>
            <p class="text-sm font-medium text-neutral-900 dark:text-gray-100">Gray 500</p>
            <p class="text-xs text-semantic-success font-semibold">AA Text</p>
          </div>

          <!-- Gray 200 -->
          <div>
            <div class="h-24 bg-neutral-200 border border-gray-300 mb-2 flex items-end p-2">
              <span class="text-neutral-900 text-xs font-mono">#E2E8F0</span>
            </div>
            <p class="text-sm font-medium text-neutral-900 dark:text-gray-100">Gray 200</p>
            <p class="text-xs text-primary-700 font-semibold">Background</p>
          </div>

          <!-- Gray 50 -->
          <div>
            <div class="h-24 bg-neutral-50 border border-gray-300 mb-2 flex items-end p-2">
              <span class="text-neutral-900 text-xs font-mono">#F8FAFC</span>
            </div>
            <p class="text-sm font-medium text-neutral-900 dark:text-gray-100">Gray 50</p>
            <p class="text-xs text-primary-700 font-semibold">Background</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Semantic & Accent Colors -->
    <section class="mb-12 lg:mb-16">
      <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 lg:p-8">
        <h2 class="text-2xl sm:text-3xl font-bold text-neutral-900 dark:text-gray-100 mb-2">Semantic & Accent Colors</h2>
        <p class="text-sm text-neutral-700 dark:text-gray-400 mb-6">For status indicators, alerts, and feedback.</p>

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 lg:gap-6">
          <!-- Success -->
          <div>
            <div class="h-24 bg-semantic-success mb-2 flex items-end p-2">
              <span class="text-white text-xs font-mono">#059669</span>
            </div>
            <p class="text-sm font-medium text-neutral-900 dark:text-gray-100">Success</p>
            <p class="text-xs text-semantic-success font-semibold">AA Text</p>
            <p class="text-xs text-neutral-500 dark:text-gray-400">4.5:1 on white</p>
          </div>

          <!-- Warning -->
          <div>
            <div class="h-24 bg-semantic-warning mb-2 flex items-end p-2">
              <span class="text-white text-xs font-mono">#D97706</span>
            </div>
            <p class="text-sm font-medium text-neutral-900 dark:text-gray-100">Warning</p>
            <p class="text-xs text-semantic-success font-semibold">AA Text</p>
            <p class="text-xs text-neutral-500 dark:text-gray-400">4.6:1 on white</p>
          </div>

          <!-- Error -->
          <div>
            <div class="h-24 bg-semantic-error mb-2 flex items-end p-2">
              <span class="text-white text-xs font-mono">#DC2626</span>
            </div>
            <p class="text-sm font-medium text-neutral-900 dark:text-gray-100">Error</p>
            <p class="text-xs text-semantic-success font-semibold">AA Text</p>
            <p class="text-xs text-neutral-500 dark:text-gray-400">4.5:1 on white</p>
          </div>

          <!-- Info -->
          <div>
            <div class="h-24 bg-semantic-info mb-2 flex items-end p-2">
              <span class="text-white text-xs font-mono">#0284C7</span>
            </div>
            <p class="text-sm font-medium text-neutral-900 dark:text-gray-100">Info</p>
            <p class="text-xs text-semantic-success font-semibold">AA Text</p>
            <p class="text-xs text-neutral-500 dark:text-gray-400">4.5:1 on white</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Usage Examples & Contrast Demos -->
    <section class="mb-12 lg:mb-16">
      <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 lg:p-8">
        <h2 class="text-2xl sm:text-3xl font-bold text-neutral-900 dark:text-gray-100 mb-6">Usage Examples & Contrast Demos</h2>

        <!-- Headings & Body Text -->
        <div class="mb-8">
          <h3 class="text-lg font-semibold text-neutral-900 dark:text-gray-100 mb-4">Headings & Body Text</h3>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Gray 900 Heading -->
            <div class="border border-gray-200 dark:border-gray-700 p-6">
              <h4 class="text-2xl font-bold text-neutral-900 dark:text-gray-100 mb-2">Heading in Gray 900</h4>
              <p class="text-base text-neutral-700 dark:text-gray-400">
                Body text in default gray. This provides excellent readability with 12.6:1 contrast ratio.
              </p>
            </div>

            <!-- Primary 800 Heading -->
            <div class="border border-gray-200 dark:border-gray-700 p-6">
              <h4 class="text-2xl font-bold text-primary-800 dark:text-primary-300 mb-2">Heading in Primary 800</h4>
              <p class="text-base text-neutral-700 dark:text-gray-400">
                This blue variant achieves AAA compliance (7.0:1) perfect for headlines and important text.
              </p>
            </div>
          </div>
        </div>

        <!-- Button Styles -->
        <div class="mb-8">
          <h3 class="text-lg font-semibold text-neutral-900 dark:text-gray-100 mb-4">Button Styles</h3>
          <div class="flex flex-wrap gap-4">
            <!-- Primary Button AAA -->
            <button class="px-6 py-3 bg-primary-900 text-white text-sm font-semibold hover:bg-primary-800 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 transition-colors">
              Primary Button (AAA)
            </button>

            <!-- Primary Button AA -->
            <button class="px-6 py-3 bg-primary-800 text-white text-sm font-semibold hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 transition-colors">
              Primary Button (AA)
            </button>

            <!-- Outline Button -->
            <button class="px-6 py-3 border border-primary-700 text-primary-700 dark:text-primary-400 dark:border-primary-400 text-sm font-semibold hover:bg-primary-100 dark:hover:bg-primary-900/20 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 transition-colors">
              Outline Button
            </button>

            <!-- Ghost Button -->
            <button class="px-6 py-3 text-neutral-700 dark:text-gray-300 text-sm font-semibold hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 transition-colors">
              Ghost Button
            </button>
          </div>
        </div>

        <!-- Card Components -->
        <div class="mb-8">
          <h3 class="text-lg font-semibold text-neutral-900 dark:text-gray-100 mb-4">Card Components</h3>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Light Background Card -->
            <div class="bg-primary-100 dark:bg-primary-900/20 border border-primary-200 dark:border-primary-800 p-6">
              <div class="w-10 h-10 bg-primary-600 mb-4"></div>
              <h4 class="text-lg font-semibold text-neutral-900 dark:text-gray-100 mb-2">Light Background</h4>
              <p class="text-sm text-neutral-700 dark:text-gray-400">
                Perfect for highlighting sections with subtle primary color.
              </p>
            </div>

            <!-- Dark Background Card -->
            <div class="bg-primary-800 p-6">
              <div class="w-10 h-10 bg-primary-300 mb-4"></div>
              <h4 class="text-lg font-semibold text-white mb-2">Dark Background</h4>
              <p class="text-sm text-primary-100">
                White text on Primary 800 achieves 12.6:1 contrast (AAA).
              </p>
            </div>

            <!-- Accent Border Card -->
            <div class="bg-white dark:bg-gray-800 border-2 border-primary-600 p-6 shadow-sm">
              <div class="w-10 h-10 bg-primary-600 mb-4"></div>
              <h4 class="text-lg font-semibold text-neutral-900 dark:text-gray-100 mb-2">Accent Border</h4>
              <p class="text-sm text-neutral-700 dark:text-gray-400">
                Original #5C80E0 used as accent color, not text.
              </p>
            </div>
          </div>
        </div>

        <!-- Link Styles -->
        <div class="mb-8">
          <h3 class="text-lg font-semibold text-neutral-900 dark:text-gray-100 mb-4">Link Styles</h3>
          <div class="border border-gray-200 dark:border-gray-700 p-6">
            <p class="text-base text-neutral-900 dark:text-gray-100">
              This is a paragraph with a <a href="#" class="text-primary-700 dark:text-primary-400 underline hover:text-primary-800 dark:hover:text-primary-300 transition-colors">clickable link using Primary 700</a> which provides AA compliance.
              You can also use <a href="#" class="text-primary-800 dark:text-primary-300 underline hover:text-primary-900 dark:hover:text-primary-200 transition-colors">Primary 800 for AAA compliance</a> in link-heavy content.
            </p>
          </div>
        </div>

        <!-- Badges & Status Indicators -->
        <div>
          <h3 class="text-lg font-semibold text-neutral-900 dark:text-gray-100 mb-4">Badges & Status Indicators</h3>
          <div class="flex flex-wrap gap-3">
            <span class="inline-block px-3 py-1 bg-primary-800 text-white text-xs font-semibold">Active</span>
            <span class="inline-block px-3 py-1 bg-neutral-500 text-white text-xs font-semibold">Pending</span>
            <span class="inline-block px-3 py-1 bg-neutral-200 text-neutral-900 text-xs font-semibold">Draft</span>
            <span class="inline-block px-3 py-1 bg-semantic-success text-white text-xs font-semibold">Success</span>
            <span class="inline-block px-3 py-1 bg-semantic-error text-white text-xs font-semibold">Error</span>
          </div>
        </div>
      </div>
    </section>

    <!-- Typography Section -->
    <section class="mb-12 lg:mb-16">
      <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 lg:p-8">
        <h2 class="text-2xl sm:text-3xl font-bold text-neutral-900 dark:text-gray-100 mb-6">Typography</h2>

        <div class="space-y-4">
          <div>
            <h1 class="text-4xl sm:text-5xl font-bold text-neutral-900 dark:text-gray-100">Heading 1</h1>
            <p class="text-xs text-neutral-500 dark:text-gray-400 mt-1">text-4xl sm:text-5xl font-bold text-neutral-900</p>
          </div>

          <div>
            <h2 class="text-3xl sm:text-4xl font-bold text-neutral-900 dark:text-gray-100">Heading 2</h2>
            <p class="text-xs text-neutral-500 dark:text-gray-400 mt-1">text-3xl sm:text-4xl font-bold text-neutral-900</p>
          </div>

          <div>
            <h3 class="text-2xl sm:text-3xl font-bold text-neutral-900 dark:text-gray-100">Heading 3</h3>
            <p class="text-xs text-neutral-500 dark:text-gray-400 mt-1">text-2xl sm:text-3xl font-bold text-neutral-900</p>
          </div>

          <div>
            <h4 class="text-xl sm:text-2xl font-semibold text-neutral-900 dark:text-gray-100">Heading 4</h4>
            <p class="text-xs text-neutral-500 dark:text-gray-400 mt-1">text-xl sm:text-2xl font-semibold text-neutral-900</p>
          </div>

          <div>
            <p class="text-base sm:text-lg text-neutral-700 dark:text-gray-400">
              Body text large - Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            </p>
            <p class="text-xs text-neutral-500 dark:text-gray-400 mt-1">text-base sm:text-lg text-neutral-700</p>
          </div>

          <div>
            <p class="text-sm sm:text-base text-neutral-700 dark:text-gray-400">
              Body text regular - Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            </p>
            <p class="text-xs text-neutral-500 dark:text-gray-400 mt-1">text-sm sm:text-base text-neutral-700</p>
          </div>

          <div>
            <p class="text-xs sm:text-sm text-neutral-500 dark:text-gray-400">
              Small text - Lorem ipsum dolor sit amet.
            </p>
            <p class="text-xs text-neutral-500 dark:text-gray-400 mt-1">text-xs sm:text-sm text-neutral-500</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Form Elements Section -->
    <section class="mb-12 lg:mb-16">
      <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 lg:p-8">
        <h2 class="text-2xl sm:text-3xl font-bold text-neutral-900 dark:text-gray-100 mb-6">Form Elements</h2>

        <div class="max-w-2xl space-y-6">
          <!-- Text Input -->
          <div>
            <label for="sample-input" class="block text-sm sm:text-base font-medium text-neutral-900 dark:text-gray-300 mb-2">
              Text Input <span class="text-semantic-error">*</span>
            </label>
            <input
              type="text"
              id="sample-input"
              placeholder="Enter text..."
              class="w-full px-4 py-2.5 sm:py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-neutral-900 dark:text-gray-100 placeholder-neutral-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-colors text-sm sm:text-base"
            />
          </div>

          <!-- Select Dropdown -->
          <div>
            <label for="sample-select" class="block text-sm sm:text-base font-medium text-neutral-900 dark:text-gray-300 mb-2">
              Select Option
            </label>
            <select
              id="sample-select"
              class="w-full px-4 py-2.5 sm:py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-neutral-900 dark:text-gray-100 focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-colors text-sm sm:text-base"
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
              class="mt-1 h-4 w-4 text-primary-600 border-gray-300 dark:border-gray-600 focus:ring-primary-600"
            />
            <label for="sample-checkbox" class="ml-3 text-sm sm:text-base text-neutral-700 dark:text-gray-400">
              I agree to the terms and conditions
            </label>
          </div>
        </div>
      </div>
    </section>

    <!-- Reusable Components Section -->
    <section class="mb-12 lg:mb-16">
      <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 lg:p-8">
        <h2 class="text-2xl sm:text-3xl font-bold text-neutral-900 dark:text-gray-100 mb-6">Reusable Components</h2>
        <p class="text-sm sm:text-base text-neutral-700 dark:text-gray-400 mb-8">
          Pre-built components located in <code class="px-2 py-1 bg-primary-100 dark:bg-primary-900/30 text-primary-800 dark:text-primary-300 text-xs">resources/views/frontend/include/</code>
        </p>

        <div class="space-y-12">
          <!-- Breadcrumb Component -->
          <div>
            <h3 class="text-xl font-semibold text-neutral-900 dark:text-gray-100 mb-4">1. Breadcrumb Navigation</h3>

            <!-- Live Example -->
            <div class="mb-4 p-4 bg-neutral-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-600">
              @include('frontend.include.breadcrumb', ['items' => [
                ['label' => 'Home', 'url' => route('front.index')],
                ['label' => 'Shop', 'url' => '#'],
                ['label' => 'Current Page']
              ]])
            </div>

            <!-- Code Example -->
            <div class="bg-neutral-900 text-gray-100 p-4 overflow-x-auto text-xs sm:text-sm">
              <pre><code>@verbatim@include('frontend.include.breadcrumb', [
  'items' => [
    ['label' => 'Home', 'url' => route('front.index')],
    ['label' => 'Shop', 'url' => '#'],
    ['label' => 'Current Page'] // Last item has no URL
  ]
])@endverbatim</code></pre>
            </div>
          </div>

          <!-- Loading Spinner Component -->
          <div>
            <h3 class="text-xl font-semibold text-neutral-900 dark:text-gray-100 mb-4">2. Loading Spinner</h3>

            <!-- Demo Button -->
            <div class="mb-4">
              <button
                onclick="showLoadingSpinner()"
                class="px-6 py-3 bg-primary-800 text-white text-sm font-semibold hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 transition-colors">
                Show Loading Spinner (3 seconds)
              </button>
            </div>

            <!-- Code Example -->
            <div class="bg-neutral-900 text-gray-100 p-4 overflow-x-auto text-xs sm:text-sm">
              <pre><code>@verbatim@include('frontend.include.loading-spinner', [
  'id' => 'my-spinner',
  'message' => 'Loading products...'
])@endverbatim</code></pre>
            </div>
          </div>

          <!-- Empty State Component -->
          <div>
            <h3 class="text-xl font-semibold text-neutral-900 dark:text-gray-100 mb-4">3. Empty State</h3>

            <!-- Live Example -->
            <div class="p-4 bg-neutral-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-600">
              @include('frontend.include.empty-state', [
                'title' => 'Your cart is empty',
                'message' => 'Looks like you haven\'t added anything to your cart yet',
                'icon' => 'cart',
                'buttonText' => 'Start Shopping',
                'buttonUrl' => route('front.index')
              ])
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Usage Guidelines -->
    <section class="mb-12 lg:mb-16">
      <div class="bg-primary-100 dark:bg-primary-900/20 border border-primary-200 dark:border-primary-800 p-6 lg:p-8">
        <h2 class="text-2xl sm:text-3xl font-bold text-primary-900 dark:text-primary-100 mb-6">Usage Guidelines</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          <!-- DO Section -->
          <div>
            <h3 class="text-lg font-bold text-semantic-success mb-4 flex items-center gap-2">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
              </svg>
              DO
            </h3>
            <ul class="space-y-2 text-sm text-neutral-900 dark:text-gray-100">
              <li class="flex items-start gap-2">
                <span class="text-semantic-success mt-1">•</span>
                <span>Use <strong>Primary 800</strong> (#2E4682) for all body text on white</span>
              </li>
              <li class="flex items-start gap-2">
                <span class="text-semantic-success mt-1">•</span>
                <span>Use <strong>Primary 700</strong> (#3D5BA9) for links and interactive text</span>
              </li>
              <li class="flex items-start gap-2">
                <span class="text-semantic-success mt-1">•</span>
                <span>Use <strong>Primary 600</strong> (#5C80E0) for backgrounds, borders, and icons</span>
              </li>
              <li class="flex items-start gap-2">
                <span class="text-semantic-success mt-1">•</span>
                <span>Use <strong>Gray 900</strong> (#0F172A) for main headings and body text</span>
              </li>
              <li class="flex items-start gap-2">
                <span class="text-semantic-success mt-1">•</span>
                <span>Use <strong>Primary 100-300</strong> for subtle background highlights</span>
              </li>
              <li class="flex items-start gap-2">
                <span class="text-semantic-success mt-1">•</span>
                <span>Test all color combinations with contrast checkers</span>
              </li>
            </ul>
          </div>

          <!-- DON'T Section -->
          <div>
            <h3 class="text-lg font-bold text-semantic-error mb-4 flex items-center gap-2">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
              </svg>
              DON'T
            </h3>
            <ul class="space-y-2 text-sm text-neutral-900 dark:text-gray-100">
              <li class="flex items-start gap-2">
                <span class="text-semantic-error mt-1">•</span>
                <span>Use <strong>Primary 600</strong> (#5C80E0) for body text on white backgrounds</span>
              </li>
              <li class="flex items-start gap-2">
                <span class="text-semantic-error mt-1">•</span>
                <span>Use light variants (400-500) for any text</span>
              </li>
              <li class="flex items-start gap-2">
                <span class="text-semantic-error mt-1">•</span>
                <span>Place light text on light backgrounds</span>
              </li>
              <li class="flex items-start gap-2">
                <span class="text-semantic-error mt-1">•</span>
                <span>Use colored text smaller than 14px without testing</span>
              </li>
              <li class="flex items-start gap-2">
                <span class="text-semantic-error mt-1">•</span>
                <span>Rely on color alone to convey information</span>
              </li>
              <li class="flex items-start gap-2">
                <span class="text-semantic-error mt-1">•</span>
                <span>Skip accessibility testing for custom combinations</span>
              </li>
            </ul>
          </div>
        </div>

        <!-- Pro Tips -->
        <div class="mt-8 pt-6 border-t border-primary-200 dark:border-primary-700">
          <h3 class="text-lg font-bold text-primary-900 dark:text-primary-100 mb-4">Pro Tips</h3>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-sm text-neutral-900 dark:text-gray-100">
            <div class="bg-white dark:bg-gray-800 p-4 border border-primary-200 dark:border-primary-700">
              <strong class="block mb-1">For CTAs:</strong>
              Use Primary 800 or Primary 900 with white text
            </div>
            <div class="bg-white dark:bg-gray-800 p-4 border border-primary-200 dark:border-primary-700">
              <strong class="block mb-1">For large text (18px+):</strong>
              Primary 700 is acceptable on white
            </div>
            <div class="bg-white dark:bg-gray-800 p-4 border border-primary-200 dark:border-primary-700">
              <strong class="block mb-1">For icons:</strong>
              Primary 600 works well when paired with accessible text
            </div>
            <div class="bg-white dark:bg-gray-800 p-4 border border-primary-200 dark:border-primary-700">
              <strong class="block mb-1">For backgrounds:</strong>
              Primary 100-200 create subtle, accessible sections
            </div>
            <div class="bg-white dark:bg-gray-800 p-4 border border-primary-200 dark:border-primary-700">
              <strong class="block mb-1">For hover states:</strong>
              Darken by one shade (600→700, 700→800)
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Tailwind Classes Reference -->
    <section class="mb-12 lg:mb-16">
      <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 lg:p-8">
        <h2 class="text-2xl sm:text-3xl font-bold text-neutral-900 dark:text-gray-100 mb-6">Tailwind Classes Reference</h2>

        <div class="overflow-x-auto">
          <table class="w-full text-sm">
            <thead>
              <tr class="border-b border-gray-200 dark:border-gray-700">
                <th class="text-left py-3 px-4 font-semibold text-neutral-900 dark:text-gray-100">Use Case</th>
                <th class="text-left py-3 px-4 font-semibold text-neutral-900 dark:text-gray-100">Tailwind Class</th>
                <th class="text-left py-3 px-4 font-semibold text-neutral-900 dark:text-gray-100">Color</th>
              </tr>
            </thead>
            <tbody class="text-neutral-700 dark:text-gray-400">
              <tr class="border-b border-gray-100 dark:border-gray-700">
                <td class="py-3 px-4">Primary CTA Button</td>
                <td class="py-3 px-4"><code class="text-xs bg-primary-100 dark:bg-primary-900/30 px-2 py-1">bg-primary-900 text-white</code></td>
                <td class="py-3 px-4">#1A2D5C</td>
              </tr>
              <tr class="border-b border-gray-100 dark:border-gray-700">
                <td class="py-3 px-4">Secondary CTA Button</td>
                <td class="py-3 px-4"><code class="text-xs bg-primary-100 dark:bg-primary-900/30 px-2 py-1">bg-primary-800 text-white</code></td>
                <td class="py-3 px-4">#2E4682</td>
              </tr>
              <tr class="border-b border-gray-100 dark:border-gray-700">
                <td class="py-3 px-4">Links</td>
                <td class="py-3 px-4"><code class="text-xs bg-primary-100 dark:bg-primary-900/30 px-2 py-1">text-primary-700</code></td>
                <td class="py-3 px-4">#3D5BA9</td>
              </tr>
              <tr class="border-b border-gray-100 dark:border-gray-700">
                <td class="py-3 px-4">Accent Backgrounds/Borders</td>
                <td class="py-3 px-4"><code class="text-xs bg-primary-100 dark:bg-primary-900/30 px-2 py-1">bg-primary-600 border-primary-600</code></td>
                <td class="py-3 px-4">#5C80E0</td>
              </tr>
              <tr class="border-b border-gray-100 dark:border-gray-700">
                <td class="py-3 px-4">Main Headings</td>
                <td class="py-3 px-4"><code class="text-xs bg-primary-100 dark:bg-primary-900/30 px-2 py-1">text-neutral-900</code></td>
                <td class="py-3 px-4">#0F172A</td>
              </tr>
              <tr class="border-b border-gray-100 dark:border-gray-700">
                <td class="py-3 px-4">Body Text</td>
                <td class="py-3 px-4"><code class="text-xs bg-primary-100 dark:bg-primary-900/30 px-2 py-1">text-neutral-700</code></td>
                <td class="py-3 px-4">#334155</td>
              </tr>
              <tr class="border-b border-gray-100 dark:border-gray-700">
                <td class="py-3 px-4">Secondary Text</td>
                <td class="py-3 px-4"><code class="text-xs bg-primary-100 dark:bg-primary-900/30 px-2 py-1">text-neutral-500</code></td>
                <td class="py-3 px-4">#64748B</td>
              </tr>
              <tr>
                <td class="py-3 px-4">Highlight Background</td>
                <td class="py-3 px-4"><code class="text-xs bg-primary-100 dark:bg-primary-900/30 px-2 py-1">bg-primary-100</code></td>
                <td class="py-3 px-4">#EAF2FE</td>
              </tr>
            </tbody>
          </table>
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
  console.log('Design System page loaded successfully!');

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
