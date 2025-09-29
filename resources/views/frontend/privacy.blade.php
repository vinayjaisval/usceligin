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
  <main class="min-h-screen flex items-center justify-center px-0 py-xl bg-gray-50 dark:bg-gray-900">
    <div class="w-full max-w-container-2xl mx-auto px-md lg:px-lg xl:px-xl">
      <div class="w-full max-w-4xl mx-auto">
        <article class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-heavy px-3xl py-3xl">
          <header class="mb-xl text-center">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-md">Privacy Policy</h1>
            <p class="text-gray-600 dark:text-gray-400">{{ config('app.name', 'CELIGIN') }} - Premium Beauty & Skincare</p>
          </header>

          <div class="prose max-w-none text-gray-900 dark:text-gray-100">
            <p class="text-lg mb-lg">
              At {{ config('app.name', 'CELIGIN') }}, we are committed to protecting your privacy and ensuring the security of your personal information.
            </p>

            <h2 class="text-xl font-semibold mb-md mt-xl">1. Information We Collect</h2>
            <p class="mb-lg">
              We collect information you provide directly to us, such as when you create an account, make a purchase, or contact us for support.
            </p>

            <h2 class="text-xl font-semibold mb-md mt-xl">2. How We Use Your Information</h2>
            <p class="mb-lg">
              We use the information we collect to provide, maintain, and improve our services, process transactions, and communicate with you.
            </p>

            <h2 class="text-xl font-semibold mb-md mt-xl">3. Information Sharing</h2>
            <p class="mb-lg">
              We do not sell, trade, or otherwise transfer your personal information to third parties without your consent, except as described in this policy.
            </p>

            <h2 class="text-xl font-semibold mb-md mt-xl">4. Data Security</h2>
            <p class="mb-lg">
              We implement appropriate security measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction.
            </p>

            <h2 class="text-xl font-semibold mb-md mt-xl">5. Contact Us</h2>
            <p class="mb-lg">
              If you have any questions about this Privacy Policy, please contact us through our official channels.
            </p>
          </div>

          <footer class="mt-xl pt-lg border-t border-gray-200 dark:border-gray-700 text-center">
            <a href="{{ route('front.index') }}"
               class="text-orange-600 dark:text-orange-400 hover:text-orange-700 dark:hover:text-orange-300 underline transition-colors duration-fast">
              Return to Homepage
            </a>
          </footer>
        </article>
      </div>
    </div>
  </main>
</body>

</html>