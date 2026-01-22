@extends('frontend.include.app')

@section('content')
<main id="main-content" role="main" class="bg-gray-50 dark:bg-gray-900 min-h-screen">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-8">

    {{-- Breadcrumb --}}
    @include('frontend.include.breadcrumb', ['items' => [
      ['label' => 'Home', 'url' => route('front.index')],
      ['label' => 'Join Celigin Club']
    ]])

    {{-- Page Header --}}
    <div class="text-center mb-8 lg:mb-12">
      <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-gray-100 mb-4">
        Join Celigin Club
      </h1>
      <p class="text-base sm:text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
        Become a member of our exclusive community and enjoy special benefits, rewards, and early access to new products.
      </p>
    </div>

    {{-- Registration Form --}}
    <div class="max-w-2xl mx-auto">
      <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 lg:p-8">

        {{-- Error Messages --}}
        @if ($errors->any())
          <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200">
            <div class="flex items-start">
              <span class="material-icons-outlined text-red-600 dark:text-red-400 mr-3 mt-0.5">error</span>
              <div class="flex-1">
                <h3 class="font-semibold mb-2">Please correct the following errors:</h3>
                <ul class="list-disc list-inside space-y-1">
                  @foreach ($errors->all() as $error)
                    <li class="text-sm">{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        @endif

        {{-- Success Message --}}
        @if (session('success'))
          <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200">
            <div class="flex items-start">
              <span class="material-icons-outlined text-green-600 dark:text-green-400 mr-3 mt-0.5">check_circle</span>
              <div class="flex-1">
                <p class="font-semibold">{{ session('success') }}</p>
              </div>
            </div>
          </div>
        @endif

        <form action="{{ route('front.join-now-club-store') }}" method="POST" class="space-y-6">
          @csrf

          {{-- Name Field --}}
          <div>
            <label for="name" class="block text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2">
              Name <span class="text-red-600 dark:text-red-400">*</span>
            </label>
            <input
              type="text"
              id="name"
              name="name"
              required
              value="{{ old('name') }}"
              class="w-full px-4 py-2.5 sm:py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-colors text-sm sm:text-base"
              placeholder="Enter your full name"
              aria-required="true" />
            @error('name')
              <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>

          {{-- Email Field --}}
          <div>
            <label for="email" class="block text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2">
              Email Address <span class="text-red-600 dark:text-red-400">*</span>
            </label>
            <input
              type="email"
              id="email"
              name="email"
              required
              value="{{ old('email') }}"
              class="w-full px-4 py-2.5 sm:py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-colors text-sm sm:text-base"
              placeholder="Enter your email address"
              aria-required="true" />
            @error('email')
              <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>

          {{-- Phone Field --}}
          <div>
            <label for="phone" class="block text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2">
              Phone Number <span class="text-red-600 dark:text-red-400">*</span>
            </label>
            <input
              type="tel"
              id="phone"
              name="phone"
              required
              value="{{ old('phone') }}"
              class="w-full px-4 py-2.5 sm:py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-colors text-sm sm:text-base"
              placeholder="Enter your phone number"
              pattern="[0-9]{10,15}"
              aria-required="true" />
            @error('phone')
              <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>

          {{-- Instagram Profile Link --}}
          <div>
            <label for="instagram" class="block text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2">
              Instagram Profile Link
              <span class="text-gray-500 dark:text-gray-400 font-normal">(Optional)</span>
            </label>
            <input
              type="url"
              id="instagram"
              name="instagram_profile_link"
              value="{{ old('instagram_profile_link') }}"
              class="w-full px-4 py-2.5 sm:py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-colors text-sm sm:text-base"
              placeholder="https://instagram.com/yourusername" />
            @error('instagram_profile_link')
              <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>

          {{-- YouTube Profile Link --}}
          <div>
            <label for="youtube" class="block text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2">
              YouTube Profile Link
              <span class="text-gray-500 dark:text-gray-400 font-normal">(Optional)</span>
            </label>
            <input
              type="url"
              id="youtube"
              name="youtube_profile_link"
              value="{{ old('youtube_profile_link') }}"
              class="w-full px-4 py-2.5 sm:py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-colors text-sm sm:text-base"
              placeholder="https://youtube.com/yourchannel" />
            @error('youtube_profile_link')
              <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>

          {{-- Submit Button --}}
          <div class="pt-4">
            <button
              type="submit"
              class="w-full px-6 py-3 bg-primary-600 text-white text-base font-semibold hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-colors">
              Register for Celigin Club
            </button>
          </div>

          {{-- Additional Info --}}
          <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
            <p class="text-sm text-gray-600 dark:text-gray-400 text-center">
              Already have an account?
              <a href="{{ route('otp.login.form') }}" class="text-primary-700 dark:text-primary-400 hover:text-primary-800 dark:hover:text-primary-300 font-semibold transition-colors">
                Sign In
              </a>
            </p>
          </div>
        </form>
      </div>

      {{-- Benefits Section --}}
      <div class="mt-8 lg:mt-12 grid grid-cols-1 md:grid-cols-3 gap-4 lg:gap-6">
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 text-center">
          <span class="material-icons-outlined text-4xl text-primary-700 dark:text-primary-400 mb-3">card_giftcard</span>
          <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Exclusive Rewards</h3>
          <p class="text-sm text-gray-600 dark:text-gray-400">Earn points on every purchase and redeem for discounts</p>
        </div>

        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 text-center">
          <span class="material-icons-outlined text-4xl text-primary-700 dark:text-primary-400 mb-3">notifications_active</span>
          <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Early Access</h3>
          <p class="text-sm text-gray-600 dark:text-gray-400">Get first access to new products and special sales</p>
        </div>

        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 text-center">
          <span class="material-icons-outlined text-4xl text-primary-700 dark:text-primary-400 mb-3">local_offer</span>
          <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Special Offers</h3>
          <p class="text-sm text-gray-600 dark:text-gray-400">Receive member-only discounts and birthday gifts</p>
        </div>
      </div>
    </div>

  </div>
</main>
@endsection
