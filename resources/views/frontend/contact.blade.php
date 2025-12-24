@extends('frontend.include.app')

@section('content')

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
                <span class="text-gray-900 dark:text-gray-100" aria-current="page">Contact Us</span>
            </li>
        </ol>
    </nav>
</div>
<div class="bg-gray-50 dark:bg-gray-800 py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-gray-100 mb-4">Contact Us</h1>
    </div>
</div>


<div class="py-8">
    {{-- Registration Form --}}
    <div class="max-w-4xl mx-auto py-6">
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
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          <div class="">
            <label for="name" class="block text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2">
              Name <span class="text-red-600 dark:text-red-400">*</span>
            </label>
            <input
              type="text"
              id="name"
              name="name"
              required
              value="{{ old('name') }}"
              class="w-full px-4 py-2.5 sm:py-3 border outline-none border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors text-sm sm:text-base"
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
              class="w-full px-4 py-2.5 sm:py-3 border outline-none border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors text-sm sm:text-base"
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
              class="w-full px-4 py-2.5 sm:py-3 border outline-none border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors text-sm sm:text-base"
              placeholder="Enter your phone number"
              pattern="[0-9]{10,15}"
              aria-required="true" />
            @error('phone')
              <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>
            {{-- Password --}}
          <div>
            <label for="youtube" class="block text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2">
             Password <span class="text-red-600 dark:text-red-400">*</span>
              <!-- <span class="text-gray-500 dark:text-gray-400 font-normal">(Optional)</span> -->
            </label>
            <input
              type="pass"
              id="pass"
              name="password"
              value=""
              class="w-full px-4 py-2.5 sm:py-3 border outline-none border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors text-sm sm:text-base"
              placeholder="Enter your Password" />
            @error('youtube_profile_link')
              <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>
    </div>

   
     {{-- Submit Button --}}
          <div class="pt-4">
            <button
              type="submit"
              class="w-full px-6 py-3 bg-orange-600 text-white text-base font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-colors">
              Submit
            </button>
          </div>
          {{-- Additional Info --}}
          <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
            <p class="text-sm text-gray-600 dark:text-gray-400 text-center">
              Already have an account?
              <a href="{{ route('otp.login.form') }}" class="text-orange-600 dark:text-orange-400 hover:text-orange-700 dark:hover:text-orange-300 font-semibold transition-colors">
                Sign In
              </a>
            </p>
          </div>
        </form>
      </div>


    <div class="connect-title max-w-6xl mx-auto px-4 sm:px-6  py-6">
        <div class="heading-body text-center mb-10">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-gray-100">
                Connect With Us
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class=" dark:bg-gray-800 shadow-xl p-6 text-center hover:-translate-y-2 transition-all duration-300 border">
                <div class="w-16 h-16 mx-auto flex items-center justify-center rounded-full bg-gradient-to-r from-red-600 to-orange-700 shadow-md">
                    <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 21s-6-5-6-10a6 6 0 1 1 12 0c0 5-6 10-6 10z" />
                    </svg>
                </div>
                <h4 class="text-lg font-semibold mt-4">Our Office Address</h4>
                <p class="text-sm text-gray-600 dark:text-gray-300 mt-2 leading-relaxed">
                    1st Floor B-37, Sector 2 Noida <br> Uttar Pradesh 201301
                </p>
            </div>
            <div class=" dark:bg-gray-800 shadow-xl  p-6 text-center hover:-translate-y-2 transition-all duration-300 border">
                <div class="w-16 h-16 mx-auto flex items-center justify-center rounded-full bg-gradient-to-r from-red-500 to-red-700 shadow-md">
                    <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                        fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2
                    19.79 19.79 0 0 1-8.63-3.07
                    19.5 19.5 0 0 1-6-6
                    19.79 19.79 0 0 1-3.07-8.67
                    A2 2 0 0 1 4.11 2h3
                    a2 2 0 0 1 2 1.72
                    12.31 12.31 0 0 0 .67 2.73
                    2 2 0 0 1-.45 2.11L7.09 9.91
                    a16 16 0 0 0 6 6l1.35-1.24
                    a2 2 0 0 1 2.11-.45
                    12.31 12.31 0 0 0 2.73.67
                    A2 2 0 0 1 22 16.92z" />
                    </svg>
                </div>
                <h4 class="text-lg font-semibold mt-4">Phone Number</h4>
                <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">+91 96670 54665</p>
            </div>
            <div class=" shadow-xl  p-6 text-center hover:-translate-y-2 transition-all duration-300 border">
                <div class="w-16 h-16 mx-auto flex items-center justify-center rounded-full bg-gradient-to-r from-red-400 to-orange-700 shadow-md">
                    <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                        fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="5" width="18" height="14" rx="2" ry="2"></rect>
                        <polyline points="3 7 12 13 21 7"></polyline>
                    </svg>
                </div>
                <h4 class="text-lg font-semibold mt-4">Our Email</h4>
                <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">info@celiginglobal.com</p>
            </div>
        </div>
    </div>
</div>
































@endsection