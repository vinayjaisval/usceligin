@php
  $user = Auth::user();
@endphp
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $gs->title ?? 'Vendor Dashboard' }} - @yield('page-title', 'Dashboard')</title>
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/' . ($gs->favicon ?? 'favicon.ico')) }}">

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- Google Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

  <!-- Toastify CSS -->
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

  @yield('styles')
</head>

<body class="bg-gray-50 dark:bg-gray-900 min-h-screen">

  <!-- Top Navigation Bar -->
  <header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">

        <!-- Logo -->
        <a href="{{ route('front.index') }}" class="flex-shrink-0">
          <img src="{{ asset('assets/images/' . ($gs->logo ?? 'logo.png')) }}" alt="Logo" class="h-8 w-auto">
        </a>

        <!-- Mobile Menu Button -->
        <button type="button" id="mobile-menu-btn" class="lg:hidden p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200" aria-label="Toggle menu">
          <span class="material-icons-outlined">menu</span>
        </button>

        <!-- Desktop Navigation -->
        <div class="hidden lg:flex items-center gap-4">
          <a href="{{ route('front.index') }}" class="text-sm text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 flex items-center gap-1">
            <span class="material-icons-outlined text-base">storefront</span>
            Visit Store
          </a>

          <!-- User Menu -->
          <div class="relative" x-data="{ open: false }">
            <button type="button" id="user-menu-btn" class="flex items-center gap-2 p-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
              <div class="w-8 h-8 bg-primary-600 text-white flex items-center justify-center text-sm font-bold uppercase">
                {{ substr($user->name ?? 'U', 0, 1) }}
              </div>
              <span class="text-sm font-medium hidden sm:block">{{ $user->name ?? 'User' }}</span>
              <span class="material-icons-outlined text-base">expand_more</span>
            </button>

            <div id="user-menu-dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-lg py-1 z-50">
              <a href="{{ route('user.account') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                My Account
              </a>
              <a href="{{ route('vendor-profile') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                Vendor Profile
              </a>
              <hr class="my-1 border-gray-200 dark:border-gray-700">
              <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                Sign Out
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main id="main-content" role="main" class="min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-8">

      <!-- Breadcrumb -->
      @hasSection('breadcrumb')
        @yield('breadcrumb')
      @else
        <nav class="mb-6" aria-label="Breadcrumb">
          <ol class="flex items-center space-x-2 text-sm">
            <li>
              <a href="{{ route('vendor.dashboard') }}" class="text-gray-500 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400">
                POS Dashboard
              </a>
            </li>
            @hasSection('page-title')
              <li class="flex items-center">
                <span class="material-icons-outlined text-gray-400 text-base mx-1">chevron_right</span>
                <span class="text-gray-900 dark:text-gray-100 font-medium">@yield('page-title')</span>
              </li>
            @endif
          </ol>
        </nav>
      @endif

      <!-- Page Grid: Sidebar + Content -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8">

        <!-- Left Sidebar: Navigation Menu -->
        <aside id="sidebar" class="lg:col-span-3 hidden lg:block">
          <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 sticky top-24">

            <!-- Vendor Profile Header -->
            <div class="p-4 border-b border-gray-200 dark:border-gray-700">
              <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                  <div class="w-10 h-10 bg-primary-600 text-white flex items-center justify-center text-lg font-bold uppercase">
                    {{ substr($user->name ?? 'U', 0, 1) }}
                  </div>
                </div>
                <div class="flex-1 min-w-0">
                  <h2 class="text-sm font-semibold text-gray-900 dark:text-gray-100 truncate">
                    {{ $user->name ?? 'Vendor' }}
                  </h2>
                  <p class="text-xs text-gray-500 dark:text-gray-400">POS Account</p>
                </div>
              </div>
            </div>

            <!-- Navigation Menu -->
            <nav class="p-2" aria-label="Vendor navigation">
              @php
                $currentRoute = Route::currentRouteName();
                $menuItems = [
                  ['route' => 'vendor.dashboard', 'icon' => 'dashboard', 'label' => 'Dashboard', 'match' => ['vendor.dashboard']],
                  ['route' => 'vendor-order-index', 'icon' => 'receipt_long', 'label' => 'All Orders', 'match' => ['vendor-order-index', 'vendor-order-show', 'vendor-order-edit']],
                  ['route' => 'vendor-order-create', 'icon' => 'add_shopping_cart', 'label' => 'Create Order', 'match' => ['vendor-order-create']],
                  ['route' => 'vendor-prod-index', 'icon' => 'inventory_2', 'label' => 'Products', 'match' => ['vendor-prod-index', 'vendor-prod-edit']],
                ];
              @endphp

              @foreach($menuItems as $item)
                @php
                  $isActive = in_array($currentRoute, $item['match']);
                @endphp
                <a href="{{ route($item['route']) }}"
                   class="flex items-center gap-3 px-4 py-3 text-sm font-medium transition-colors {{ $isActive ? 'bg-primary-50 dark:bg-gray-700 text-primary-700 dark:text-primary-400 border-l-2 border-primary-600' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                  <span class="material-icons-outlined text-lg">{{ $item['icon'] }}</span>
                  <span>{{ $item['label'] }}</span>
                </a>
              @endforeach

              <hr class="my-2 border-gray-200 dark:border-gray-700">

              <a href="{{ route('logout') }}"
                 class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-gray-700 transition-colors">
                <span class="material-icons-outlined text-lg">logout</span>
                <span>Sign Out</span>
              </a>
            </nav>
          </div>
        </aside>

        <!-- Mobile Sidebar (Overlay) -->
        <div id="mobile-sidebar" class="fixed inset-0 z-50 lg:hidden hidden">
          <div class="absolute inset-0 bg-black/50" id="sidebar-overlay"></div>
          <div class="absolute left-0 top-0 bottom-0 w-72 bg-white dark:bg-gray-800 shadow-xl overflow-y-auto">
            <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
              <span class="font-semibold text-gray-900 dark:text-gray-100">Menu</span>
              <button type="button" id="close-sidebar" class="p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400">
                <span class="material-icons-outlined">close</span>
              </button>
            </div>
            <nav class="p-2">
              @foreach($menuItems as $item)
                @php
                  $isActive = in_array($currentRoute, $item['match']);
                @endphp
                <a href="{{ route($item['route']) }}"
                   class="flex items-center gap-3 px-4 py-3 text-sm font-medium transition-colors {{ $isActive ? 'bg-primary-50 dark:bg-gray-700 text-primary-700 dark:text-primary-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                  <span class="material-icons-outlined text-lg">{{ $item['icon'] }}</span>
                  <span>{{ $item['label'] }}</span>
                </a>
              @endforeach
            </nav>
          </div>
        </div>

        <!-- Right Content Area -->
        <div class="lg:col-span-9">

          <!-- Alert Messages -->
          @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200" role="alert">
              <div class="flex items-center gap-2">
                <span class="material-icons-outlined text-lg">check_circle</span>
                <span>{{ session('success') }}</span>
              </div>
            </div>
          @endif

          @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200" role="alert">
              <div class="flex items-center gap-2">
                <span class="material-icons-outlined text-lg">error</span>
                <span>{{ session('error') }}</span>
              </div>
            </div>
          @endif

          @if($user->checkWarning())
            <div class="mb-6 p-4 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 text-amber-800 dark:text-amber-200" role="alert">
              <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                  <span class="material-icons-outlined text-lg">warning</span>
                  <span>{{ $user->displayWarning() }}</span>
                </div>
                <a href="{{ route('vendor-warning', $user->verifies()->where('admin_warning','=','1')->latest('id')->first()->id) }}"
                   class="text-sm font-medium text-amber-700 dark:text-amber-300 hover:underline">
                  Verify Now
                </a>
              </div>
            </div>
          @endif

          <!-- Page Content -->
          @yield('content')

        </div>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
      <p class="text-center text-sm text-gray-500 dark:text-gray-400">
        &copy; {{ date('Y') }} {{ $gs->title ?? 'Celigin' }}. All rights reserved.
      </p>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  <script>
    // Mobile sidebar toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileSidebar = document.getElementById('mobile-sidebar');
    const closeSidebar = document.getElementById('close-sidebar');
    const sidebarOverlay = document.getElementById('sidebar-overlay');

    if (mobileMenuBtn && mobileSidebar) {
      mobileMenuBtn.addEventListener('click', () => {
        mobileSidebar.classList.remove('hidden');
      });

      closeSidebar?.addEventListener('click', () => {
        mobileSidebar.classList.add('hidden');
      });

      sidebarOverlay?.addEventListener('click', () => {
        mobileSidebar.classList.add('hidden');
      });
    }

    // User menu dropdown
    const userMenuBtn = document.getElementById('user-menu-btn');
    const userMenuDropdown = document.getElementById('user-menu-dropdown');

    if (userMenuBtn && userMenuDropdown) {
      userMenuBtn.addEventListener('click', () => {
        userMenuDropdown.classList.toggle('hidden');
      });

      document.addEventListener('click', (e) => {
        if (!userMenuBtn.contains(e.target) && !userMenuDropdown.contains(e.target)) {
          userMenuDropdown.classList.add('hidden');
        }
      });
    }

    // Toast notification helper
    function showToast(message, type = 'success') {
      const bgColor = type === 'success' ? '#059669' : type === 'error' ? '#DC2626' : '#D97706';
      Toastify({
        text: message,
        duration: 3000,
        close: true,
        gravity: "top",
        position: "right",
        backgroundColor: bgColor
      }).showToast();
    }
  </script>

  @yield('scripts')
</body>
</html>
