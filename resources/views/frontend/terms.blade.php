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

  <!-- Theme System Integration -->
  <script>
    (function() {
      const THEME_KEY = 'usceligin-theme';
      const LEGACY_KEY = 'theme';
      const VALID_THEMES = ['light', 'dark'];

      const getInitialTheme = () => {
        const saved = localStorage.getItem(THEME_KEY);
        if (saved && VALID_THEMES.includes(saved)) return saved;

        const legacy = localStorage.getItem(LEGACY_KEY);
        if (legacy && VALID_THEMES.includes(legacy)) return legacy;

        return window.matchMedia?.('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
      };

      const theme = getInitialTheme();
      if (theme === 'dark') {
        document.documentElement.setAttribute('data-theme', 'dark');
      }
    })();
  </script>

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{asset('assets/frontend/images/favicon.ico')}}" />
</head>

<body>
  <main class="min-h-screen flex items-center justify-center px-0 py-xl bg-bg-tertiary">
    <div class="w-full max-w-container-2xl mx-auto px-md lg:px-lg xl:px-xl">
      <div class="w-full max-w-4xl mx-auto">
        <article class="bg-bg-primary border border-border-light rounded-lg shadow-heavy px-3xl py-3xl">
          <header class="mb-xl text-center">
            <h1 class="text-3xl font-bold text-text-primary mb-md">Terms and Conditions</h1>
            <p class="text-text-secondary">{{ config('app.name', 'CELIGIN') }} - Premium Beauty & Skincare</p>
          </header>

          <div class="prose max-w-none text-text-primary">
            <p class="text-lg mb-lg">
              Welcome to {{ config('app.name', 'CELIGIN') }}. These terms and conditions outline the rules and regulations for the use of our website and services.
            </p>

            <h2 class="text-xl font-semibold mb-md mt-xl">1. Acceptance of Terms</h2>
            <p class="mb-lg">
              By accessing and using this website, you accept and agree to be bound by the terms and provision of this agreement.
            </p>

            <h2 class="text-xl font-semibold mb-md mt-xl">2. Use License</h2>
            <p class="mb-lg">
              Permission is granted to temporarily download one copy of the materials on {{ config('app.name', 'CELIGIN') }}'s website for personal, non-commercial transitory viewing only.
            </p>

            <h2 class="text-xl font-semibold mb-md mt-xl">3. Content Policy</h2>
            <p class="mb-lg">
              The content published on this website is protected by copyright and other intellectual property laws. Unauthorized use is prohibited.
            </p>

            <h2 class="text-xl font-semibold mb-md mt-xl">4. Contact Information</h2>
            <p class="mb-lg">
              If you have any questions about these Terms and Conditions, please contact us through our official channels.
            </p>
          </div>

          <footer class="mt-xl pt-lg border-t border-border-light text-center">
            <a href="{{ route('front.index') }}"
               class="text-accent-primary hover:text-accent-dark underline transition-colors duration-fast">
              Return to Homepage
            </a>
          </footer>
        </article>
      </div>
    </div>
  </main>
</body>

</html>