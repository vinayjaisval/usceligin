@extends('frontend.include.app')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Privacy Policy for CELIGIN - Premium Beauty & Skincare" />
  <meta name="robots" content="index, follow" />
  <meta name="theme-color" content="{{ config('app.theme_color', '#bc4f38') }}" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Privacy Policy | {{ config('app.name', 'CELIGIN') }} - Premium Beauty & Skincare</title>

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
          <span class="text-gray-900 dark:text-gray-100" aria-current="page">Privacy Policy</span>
        </li>
      </ol>
    </nav>
  </div>
  <div class="bg-gray-50 dark:bg-gray-800 py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-gray-100 mb-4">Privacy Policy</h1>
      <!-- <p class="text-base sm:text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">Expert skincare tips, beauty trends, and product insights</p> -->
    </div>
  </div>


  <article class="bg-white w-full max-w-4xl mx-auto dark:bg-gray-800 
   
    rounded-2xl p-10 transition-all duration-300">

    <div class="space-y-10 text-gray-800 dark:text-gray-200 leading-relaxed">
      <section class="border-l-4 border-orange-600 pl-6">
        <h2 class="text-lg font-semibold mb-md mt-xl">1. Information We Collect</h2>
        <p class="text-justify text-gray-600 text-base">
          We collect information you provide directly to us, such as when you create an account, make a purchase, or contact us for support.
        </p>
      </section>

      <section class="border-l-4 border-orange-600 pl-6">
        <h2 class="text-lg font-semibold mb-md mt-xl">2. How We Use Your Information</h2>
         <p class="text-justify text-gray-600 text-base">
          We use the information we collect to provide, maintain, and improve our services, process transactions, and communicate with you.
        </p>
      </section>

      <section class="border-l-4 border-orange-600 pl-6">
        <h2 class="text-lg font-semibold mb-md mt-xl">3. Information Sharing</h2>
         <p class="text-justify text-gray-600 text-base">
          We do not sell, trade, or otherwise transfer your personal information to third parties without your consent, except as described in this policy.
        </p>
      </section>

      <section class="border-l-4 border-orange-600 pl-6">
        <h2 class="text-lg font-semibold mb-md mt-xl">4. Data Security</h2>
         <p class="text-justify text-gray-600 text-base">
          We implement appropriate security measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction.
        </p>
      </section>

      <section class="border-l-4 border-orange-600 pl-6">
        <h2 class="text-lg font-semibold mb-md mt-xl">5. Contact Us</h2>
         <p class="text-justify text-gray-600 text-base">
          If you have any questions about this Privacy Policy, please contact us through our official channels.
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
</body>

</html>
@endsection