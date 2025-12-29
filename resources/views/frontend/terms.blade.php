@extends('frontend.include.app')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Terms and Conditions for CELIGIN - Premium Beauty & Skincare" />
  <meta name="robots" content="index, follow" />
  <meta name="theme-color" content="{{ config('app.theme_color', '#bc4f38') }}" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Terms and Conditions | {{ config('app.name', 'CELIGIN') }} - Premium Beauty & Skincare</title>

  <!-- Preconnect for performance -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

  <!-- Compiled CSS with Tailwind and Custom Styles -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- Tailwind Dark Mode Initialization -->
  <script>
    // Simple Tailwind dark mode initialization
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
      document.documentElement.classList.add('dark');
    } else {
      document.documentElement.classList.remove('dark');
    }
  </script>

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{asset('assets/frontend/images/favicon.ico')}}" />
</head>

<body>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <nav aria-label="Breadcrumb" class="mb-6">
      <ol class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400">
        <li>
          <a href="http://localhost/celigin" class="hover:text-gray-900 dark:hover:text-gray-100 transition-colors duration-200">Home</a>
        </li>
        <li class="flex items-center">
          <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
          <span class="text-gray-900 dark:text-gray-100" aria-current="page">Terms and Conditions</span>
        </li>
      </ol>
    </nav>
  </div>
  <div class="bg-gray-50 dark:bg-gray-800 py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-gray-100 mb-4">Terms and Conditions</h1>
      <p class="text-base sm:text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">Laravel - Premium Beauty & Skincare celigin</p>
    </div>
  </div>
  <main class=" flex items-center justify-center px-0  dark:bg-gray-900">
    <div class="w-full max-w-container-2xl mx-auto px-md lg:px-lg xl:px-3xl">
      <div class="w-full max-w-4xl mx-auto">
        <article class="bg-white dark:border-gray-700  lg:px-3xl sm:px-xl py-10">
          <!-- <header class="mb-xl text-center">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-md">Terms and Conditions</h1>
            <p class="text-gray-600 dark:text-gray-400">{{ config('app.name', 'CELIGIN') }} - Premium Beauty & Skincare</p>
          </header> -->

          <div class="prose max-w-none text-gray-900 dark:text-gray-100">
            <p class="text-lg mb-lg text-justify">
              Welcome to {{ config('app.name', 'CELIGIN') }}. These terms and conditions outline the rules and regulations for the use of our website and services.
            </p>
            <section class="border-l-4 border-orange-600 pl-6">
              <h2 class="text-lg font-semibold mb-md mt-xl">1. Acceptance of Terms</h2>
              <p class="text-start text-gray-600 text-base">
                By accessing and using this website, you accept and agree to be bound by the terms and provision of this agreement.
              </p>
            </section>
            <section class="border-l-4 border-orange-600 pl-6">
              <h2 class="text-lg font-semibold mb-md mt-xl">2. Use License</h2>
              <p class="text-start text-gray-600 text-base">
                Permission is granted to temporarily download one copy of the materials on {{ config('app.name', 'CELIGIN') }}'s website for personal, non-commercial transitory viewing only.
              </p>
            </section>
            <section class="border-l-4 border-orange-600 pl-6">
              <h2 class="text-lg font-semibold mb-md mt-xl">3. Content Policy</h2>
            <p class="text-start text-gray-600 text-base">
                The content published on this website is protected by copyright and other intellectual property laws. Unauthorized use is prohibited.
              </p>
            </section>
            <section class="border-l-4 border-orange-600 pl-6">
              <h2 class="text-lg font-semibold mb-md mt-xl">4. Contact Information</h2>
               <p class="text-start text-gray-600 text-base">
                If you have any questions about these Terms and Conditions, please contact us through our official channels.
              </p>
            </section>
          </div>
          <footer class="mt-14 text-center">
            <a href="{{ route('front.index') }}"
              class="inline-block bg-orange-600 hover:bg-orange-700 text-white px-8 py-3 
                  text-sm font-semibold shadow-md hover:shadow-lg transition-all duration-300">
              ⟵ Return to Homepage 
            </a>
          </footer>
        </article>
      </div>
    </div>
  </main>
</body>

</html>
@endsection