<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Your CELIGIN account dashboard. Manage your profile, orders, and preferences." />
  <meta name="keywords" content="CELIGIN account, user dashboard, profile management, my account" />
  <meta name="theme-color" content="#bc4f38" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>My Account | CELIGIN - Premium Beauty & Skincare</title>

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
  <main class="min-h-screen bg-bg-tertiary">
    <!-- Header -->
    <header class="bg-bg-primary border-b border-border-light shadow-sm">
      <div class="w-full max-w-container-2xl mx-auto px-md lg:px-lg xl:px-xl py-md">
        <div class="flex items-center justify-between">
          <div class="flex items-center gap-lg">
            <img src="{{ asset('assets/images/' . ($gs->logo ?? 'logo.png')) }}"
              alt="{{ config('app.name', 'CELIGIN') }} - Premium Beauty & Skincare"
              class="h-8 max-w-[6rem] object-contain" width="96" height="32" />
            <h1 class="text-xl font-semibold text-text-primary">My Account</h1>
          </div>

          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn--secondary btn--sm">
              <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor" class="mr-xs">
                <path d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                <path d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
              </svg>
              Logout
            </button>
          </form>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <div class="w-full max-w-container-2xl mx-auto px-md lg:px-lg xl:px-xl py-xl">
      <div class="max-w-2xl mx-auto">

        <!-- Success Message -->
        @if(session('success'))
        <div class="alert alert-success mb-lg">
          <svg class="alert-icon" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
          </svg>
          <div class="alert-content">
            <div class="alert-message">{{ session('success') }}</div>
          </div>
        </div>
        @endif

        <!-- Profile Information -->
        <section class="bg-bg-primary border border-border-light rounded-lg shadow-heavy p-xl mb-lg">
          <header class="mb-lg">
            <h2 class="text-2xl font-semibold text-text-primary mb-xs">Profile Information</h2>
            <p class="text-text-secondary">Update your account details and verified contact information.</p>
          </header>

          <form method="POST" action="{{ route('user.account.update') }}" novalidate>
            @csrf

            <!-- Name Field -->
            <div class="mb-lg">
              <label for="name" class="block text-sm font-medium text-text-primary mb-xs">
                Full Name<abbr class="text-danger ml-1" title="required">*</abbr>
              </label>
              <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                class="w-full px-md py-sm border border-border-medium rounded-none text-base text-text-primary bg-bg-primary transition-all duration-fast focus:outline-none focus:border-accent-primary focus:shadow-[0_0_0_0.125rem_rgba(188,79,56,0.1)] placeholder:text-text-tertiary"
                placeholder="Enter your full name" required />
              @error('name')
              <p class="text-sm text-danger mt-xs">{{ $message }}</p>
              @enderror
            </div>

            <!-- Email Field -->
            <div class="mb-lg">
              <label for="email" class="block text-sm font-medium text-text-primary mb-xs">
                Email Address
                @if($user->email_verified_at)
                <span class="text-success text-xs ml-xs">✓ Verified</span>
                @endif
              </label>
              <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                class="w-full px-md py-sm border border-border-medium rounded-none text-base text-text-primary bg-bg-primary transition-all duration-fast focus:outline-none focus:border-accent-primary focus:shadow-[0_0_0_0.125rem_rgba(188,79,56,0.1)] placeholder:text-text-tertiary"
                placeholder="your@email.com" />
              @error('email')
              <p class="text-sm text-danger mt-xs">{{ $message }}</p>
              @enderror
            </div>

            <!-- Phone Field -->
            <div class="mb-lg">
              <label for="phone" class="block text-sm font-medium text-text-primary mb-xs">
                Mobile Number
                @if($user->phone_verified_at)
                <span class="text-success text-xs ml-xs">✓ Verified</span>
                @endif
              </label>
              <div class="relative flex items-center border border-border-medium rounded-none overflow-hidden focus-within:border-accent-primary focus-within:shadow-[0_0_0_0.125rem_rgba(188,79,56,0.1)]">
                <span class="bg-bg-tertiary text-text-secondary px-sm py-sm text-sm font-medium border-r border-border-medium flex-shrink-0">+91</span>
                <input type="tel" id="phone" name="phone" value="{{ old('phone', $user->phone ? substr($user->phone, -10) : '') }}"
                  class="flex-1 px-md py-sm border-0 text-base text-text-primary bg-bg-primary outline-none placeholder:text-text-tertiary"
                  placeholder="12345 67890" maxlength="11" />
              </div>
              @error('phone')
              <p class="text-sm text-danger mt-xs">{{ $message }}</p>
              @enderror
            </div>

            <!-- Account Information -->
            <div class="mb-lg p-md bg-bg-tertiary rounded border border-border-light">
              <h3 class="text-sm font-medium text-text-primary mb-sm">Account Details</h3>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-sm text-sm">
                <div>
                  <span class="text-text-secondary">Account Type:</span>
                  <span class="text-text-primary font-medium ml-xs">
                    @if($user->is_admin) Admin
                    @elseif($user->is_vendor) Vendor
                    @else Customer
                    @endif
                  </span>
                </div>
                <div>
                  <span class="text-text-secondary">Joined:</span>
                  <span class="text-text-primary font-medium ml-xs">{{ $user->created_at->format('M d, Y') }}</span>
                </div>
                <div>
                  <span class="text-text-secondary">Status:</span>
                  <span class="text-success font-medium ml-xs">{{ $user->status ? 'Active' : 'Inactive' }}</span>
                </div>
                <div>
                  <span class="text-text-secondary">Last Login:</span>
                  <span class="text-text-primary font-medium ml-xs">{{ $user->last_otp_sent_at ? $user->last_otp_sent_at->diffForHumans() : 'Never' }}</span>
                </div>
              </div>
            </div>

            <!-- Update Button -->
            <button type="submit" class="btn btn--primary">
              Update Profile
            </button>
          </form>
        </section>

        <!-- Additional Account Actions -->
        <section class="bg-bg-primary border border-border-light rounded-lg shadow-heavy p-xl">
          <header class="mb-lg">
            <h2 class="text-2xl font-semibold text-text-primary mb-xs">Account Actions</h2>
            <p class="text-text-secondary">Manage your account settings and preferences.</p>
          </header>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-md">
            <!-- Orders -->
            <a href="#" class="block p-md border border-border-light rounded hover:border-accent-primary transition-colors duration-fast group">
              <div class="flex items-center gap-sm">
                <div class="w-10 h-10 bg-accent-primary/10 rounded flex items-center justify-center group-hover:bg-accent-primary/20 transition-colors duration-fast">
                  <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" class="text-accent-primary">
                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                  </svg>
                </div>
                <div>
                  <h3 class="font-medium text-text-primary">Order History</h3>
                  <p class="text-sm text-text-secondary">View your past orders and tracking</p>
                </div>
              </div>
            </a>

            <!-- Wishlist -->
            <a href="#" class="block p-md border border-border-light rounded hover:border-accent-primary transition-colors duration-fast group">
              <div class="flex items-center gap-sm">
                <div class="w-10 h-10 bg-accent-primary/10 rounded flex items-center justify-center group-hover:bg-accent-primary/20 transition-colors duration-fast">
                  <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" class="text-accent-primary">
                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                  </svg>
                </div>
                <div>
                  <h3 class="font-medium text-text-primary">Wishlist</h3>
                  <p class="text-sm text-text-secondary">Manage your saved products</p>
                </div>
              </div>
            </a>

            <!-- Addresses -->
            <a href="#" class="block p-md border border-border-light rounded hover:border-accent-primary transition-colors duration-fast group">
              <div class="flex items-center gap-sm">
                <div class="w-10 h-10 bg-accent-primary/10 rounded flex items-center justify-center group-hover:bg-accent-primary/20 transition-colors duration-fast">
                  <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" class="text-accent-primary">
                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                  </svg>
                </div>
                <div>
                  <h3 class="font-medium text-text-primary">Addresses</h3>
                  <p class="text-sm text-text-secondary">Manage delivery addresses</p>
                </div>
              </div>
            </a>

            <!-- Support -->
            <a href="#" class="block p-md border border-border-light rounded hover:border-accent-primary transition-colors duration-fast group">
              <div class="flex items-center gap-sm">
                <div class="w-10 h-10 bg-accent-primary/10 rounded flex items-center justify-center group-hover:bg-accent-primary/20 transition-colors duration-fast">
                  <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" class="text-accent-primary">
                    <path d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"/>
                  </svg>
                </div>
                <div>
                  <h3 class="font-medium text-text-primary">Help & Support</h3>
                  <p class="text-sm text-text-secondary">Get help with your account</p>
                </div>
              </div>
            </a>
          </div>
        </section>
      </div>
    </div>
  </main>
</body>

</html>