@extends('frontend.include.app')

@section('content')
<main id="main-content" role="main" class="bg-gray-50 dark:bg-gray-900 min-h-screen">

  {{-- ============================================
       SECTION 1: HERO
       ============================================ --}}
  <section class="relative bg-gradient-to-br from-orange-50 via-amber-50 to-orange-100 dark:from-gray-800 dark:via-gray-850 dark:to-gray-900 overflow-hidden">
    {{-- Background Pattern --}}
    <div class="absolute inset-0 opacity-5 dark:opacity-10">
      <div class="absolute top-0 left-0 w-full h-full" style="background-image: radial-gradient(circle at 2px 2px, currentColor 1px, transparent 0); background-size: 40px 40px;"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-20">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
        {{-- Left: Content --}}
        <div class="text-center lg:text-left relative z-10">
          <span class="inline-block px-4 py-1.5 bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300 text-sm font-semibold mb-4 uppercase tracking-wide">
            Affiliate & Influencer Program
          </span>
          <h1 class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-bold text-gray-900 dark:text-gray-100 mb-4 leading-tight">
            Your Skin, Your Radiance,
            <span class="text-primary-600 dark:text-primary-400">Your Celigin</span>
          </h1>
          <p class="text-base sm:text-lg text-gray-600 dark:text-gray-400 mb-8 max-w-xl mx-auto lg:mx-0">
            Join our growing family as a Brand Ambassador and share the transformative power of premium Korean skincare with your community. Earn commissions, unlock rewards, and grow with us.
          </p>
          <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
            <a href="#join-form"
               class="inline-flex items-center justify-center px-8 py-3.5 bg-primary-600 text-white font-semibold hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 dark:focus:ring-offset-gray-900 transition-all">
              <span class="material-icons-outlined mr-2 text-xl">rocket_launch</span>
              Join Now
            </a>
            <a href="#how-it-works"
               class="inline-flex items-center justify-center px-8 py-3.5 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 font-semibold border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-750 transition-all">
              <span class="material-icons-outlined mr-2 text-xl">play_circle</span>
              How It Works
            </a>
          </div>
        </div>

        {{-- Right: Image --}}
        <div class="relative flex justify-center lg:justify-end">
          <div class="relative w-full max-w-md lg:max-w-lg">
            <img src="{{ asset('assets/frontend/images/join-club-banner.png') }}"
                 alt="Join Celigin Club"
                 class="w-full h-auto relative z-10"
                 loading="eager" />
            {{-- Decorative Elements --}}
            <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-primary-200 dark:bg-primary-900/30 -z-10"></div>
            <div class="absolute -top-4 -left-4 w-16 h-16 bg-amber-200 dark:bg-amber-900/30 -z-10"></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- ============================================
       SECTION 2: STATS
       ============================================ --}}
  <section id="stats-section" class="bg-primary-600 dark:bg-primary-700">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14">
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 lg:gap-12 text-center">
        {{-- Stat 1 --}}
        <div>
          <div class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-2">
            500+
          </div>
          <div class="text-base text-white/80 font-medium">
            Active Creators
          </div>
        </div>
        {{-- Stat 2 --}}
        <div>
          <div class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-2">
            50+
          </div>
          <div class="text-base text-white/80 font-medium">
            Premium Products
          </div>
        </div>
        {{-- Stat 3 --}}
        <div>
          <div class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-2">
            8%
          </div>
          <div class="text-base text-white/80 font-medium">
            Commission Rate
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- ============================================
       SECTION 3: HOW IT WORKS (3 Steps)
       ============================================ --}}
  <section id="how-it-works" class="bg-white dark:bg-gray-800 py-16 lg:py-24">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
      {{-- Section Header --}}
      <div class="text-center mb-12 lg:mb-16">
        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-4">
          How It Works
        </h2>
        <p class="text-lg text-gray-600 dark:text-gray-400">
          Start earning in 3 simple steps
        </p>
      </div>

      {{-- Steps --}}
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 lg:gap-12">
        {{-- Step 1 --}}
        <div class="text-center">
          <div class="w-20 h-20 mx-auto mb-6 bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
            <span class="material-icons-outlined text-4xl text-primary-600 dark:text-primary-400">person_add</span>
          </div>
          <div class="text-sm font-semibold text-primary-600 dark:text-primary-400 mb-2 uppercase tracking-wide">Step 1</div>
          <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Sign Up</h3>
          <p class="text-gray-600 dark:text-gray-400">
            Register with your social handles and basic details. It's free and takes 2 minutes.
          </p>
        </div>

        {{-- Step 2 --}}
        <div class="text-center">
          <div class="w-20 h-20 mx-auto mb-6 bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
            <span class="material-icons-outlined text-4xl text-primary-600 dark:text-primary-400">share</span>
          </div>
          <div class="text-sm font-semibold text-primary-600 dark:text-primary-400 mb-2 uppercase tracking-wide">Step 2</div>
          <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Recommend Products</h3>
          <p class="text-gray-600 dark:text-gray-400">
            Share your unique link on social media, blogs, or with friends and family.
          </p>
        </div>

        {{-- Step 3 --}}
        <div class="text-center">
          <div class="w-20 h-20 mx-auto mb-6 bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
            <span class="material-icons-outlined text-4xl text-primary-600 dark:text-primary-400">payments</span>
          </div>
          <div class="text-sm font-semibold text-primary-600 dark:text-primary-400 mb-2 uppercase tracking-wide">Step 3</div>
          <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Earn Commission</h3>
          <p class="text-gray-600 dark:text-gray-400">
            Earn <strong>8% commission</strong> on every purchase made through your link.
          </p>
        </div>
      </div>

      {{-- CTA --}}
      <div class="text-center mt-12">
        <a href="#join-form"
           class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-primary-600 hover:bg-primary-700 text-white text-lg font-semibold transition-colors">
          Get Started Now
          <span class="material-icons-outlined">arrow_forward</span>
        </a>
      </div>
    </div>
  </section>

  {{-- ============================================
       SECTION 4: 3-COLUMN DETAILS
       ============================================ --}}
  <section class="bg-gray-50 dark:bg-gray-900 py-16 lg:py-24 border-t border-gray-200 dark:border-gray-700">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
      {{-- Section Header --}}
      <div class="text-center mb-12 lg:mb-16">
        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-4">
          Everything You Need to Succeed
        </h2>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Column 1: Quick Links --}}
        <div class="bg-white dark:bg-gray-800 p-6 border border-gray-200 dark:border-gray-700">
          <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6 flex items-center">
            <span class="material-icons-outlined text-primary-600 dark:text-primary-400 mr-2">link</span>
            Quick Links
          </h3>
          <ul class="space-y-3">
            <li>
              <a href="#" class="flex items-center justify-between py-2 text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                <span>Affiliate Dashboard</span>
                <span class="material-icons-outlined text-sm">chevron_right</span>
              </a>
            </li>
            <li>
              <a href="{{ route('front.category', 'best-sellers') }}" class="flex items-center justify-between py-2 text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                <span>Hot Items to Promote</span>
                <span class="material-icons-outlined text-sm">chevron_right</span>
              </a>
            </li>
            <li>
              <a href="#" class="flex items-center justify-between py-2 text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                <span>Invite Other Affiliates</span>
                <span class="material-icons-outlined text-sm">chevron_right</span>
              </a>
            </li>
            <li>
              <a href="#" class="flex items-center justify-between py-2 text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                <span>Marketing Resources</span>
                <span class="material-icons-outlined text-sm">chevron_right</span>
              </a>
            </li>
          </ul>
        </div>

        {{-- Column 2: Earnings --}}
        <div class="bg-white dark:bg-gray-800 p-6 border border-gray-200 dark:border-gray-700">
          <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6 flex items-center">
            <span class="material-icons-outlined text-primary-600 dark:text-primary-400 mr-2">payments</span>
            Your Earnings
          </h3>
          <div class="space-y-4">
            <div class="p-4 bg-primary-50 dark:bg-primary-900/20 border-l-4 border-primary-600">
              <div class="text-sm text-gray-600 dark:text-gray-400">Per Sale Commission</div>
              <div class="text-2xl font-bold text-gray-900 dark:text-white">8%</div>
            </div>
            <div class="p-4 bg-green-50 dark:bg-green-900/20 border-l-4 border-green-600">
              <div class="text-sm text-gray-600 dark:text-gray-400">Your Referrals Get</div>
              <div class="text-2xl font-bold text-gray-900 dark:text-white">15% OFF</div>
            </div>
            <div class="p-4 bg-blue-50 dark:bg-blue-900/20 border-l-4 border-blue-600">
              <div class="text-sm text-gray-600 dark:text-gray-400">Network Bonus</div>
              <div class="text-2xl font-bold text-gray-900 dark:text-white">+5%</div>
              <div class="text-xs text-gray-500 dark:text-gray-500 mt-1">On indirect sales from your network</div>
            </div>
          </div>
        </div>

        {{-- Column 3: Sharing Methods --}}
        <div class="bg-white dark:bg-gray-800 p-6 border border-gray-200 dark:border-gray-700">
          <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6 flex items-center">
            <span class="material-icons-outlined text-primary-600 dark:text-primary-400 mr-2">share</span>
            Ways to Share
          </h3>
          <ul class="space-y-4">
            <li class="flex items-start">
              <span class="material-icons-outlined text-green-500 mr-3 mt-0.5 text-lg">check_circle</span>
              <div>
                <span class="font-medium text-gray-900 dark:text-white">Coupon Sites</span>
                <p class="text-sm text-gray-500 dark:text-gray-500">GrabOn, CouponDunia, etc.</p>
              </div>
            </li>
            <li class="flex items-start">
              <span class="material-icons-outlined text-green-500 mr-3 mt-0.5 text-lg">check_circle</span>
              <div>
                <span class="font-medium text-gray-900 dark:text-white">Social Media</span>
                <p class="text-sm text-gray-500 dark:text-gray-500">Instagram, YouTube, Facebook</p>
              </div>
            </li>
            <li class="flex items-start">
              <span class="material-icons-outlined text-green-500 mr-3 mt-0.5 text-lg">check_circle</span>
              <div>
                <span class="font-medium text-gray-900 dark:text-white">Direct Messaging</span>
                <p class="text-sm text-gray-500 dark:text-gray-500">WhatsApp, Telegram, SMS</p>
              </div>
            </li>
            <li class="flex items-start">
              <span class="material-icons-outlined text-green-500 mr-3 mt-0.5 text-lg">check_circle</span>
              <div>
                <span class="font-medium text-gray-900 dark:text-white">Bio Links</span>
                <p class="text-sm text-gray-500 dark:text-gray-500">Add to your profile bios</p>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  {{-- ============================================
       SECTION 5: COMMISSION TIERS
       ============================================ --}}
  <section class="bg-white dark:bg-gray-800 py-16 lg:py-24 border-t border-gray-200 dark:border-gray-700">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
      {{-- Section Header --}}
      <div class="text-center mb-12 lg:mb-16">
        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-4">
          Grow Your Earnings
        </h2>
        <p class="text-lg text-gray-600 dark:text-gray-400">
          Unlock higher commissions as you grow
        </p>
      </div>

      {{-- Commission Tiers --}}
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        {{-- Tier 1 --}}
        <div class="bg-gray-50 dark:bg-gray-900 p-6 border border-gray-200 dark:border-gray-700 text-center">
          <div class="text-3xl font-bold text-gray-900 dark:text-white mb-2">8%</div>
          <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Affiliate</h3>
          <p class="text-sm text-gray-500 dark:text-gray-500">Starting level</p>
        </div>

        {{-- Tier 2 --}}
        <div class="bg-blue-50 dark:bg-blue-900/20 p-6 border border-blue-200 dark:border-blue-800 text-center">
          <div class="text-3xl font-bold text-blue-600 dark:text-blue-400 mb-2">13%</div>
          <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Business Manager</h3>
          <p class="text-sm text-gray-500 dark:text-gray-500">3+ referrals</p>
        </div>

        {{-- Tier 3 --}}
        <div class="bg-purple-50 dark:bg-purple-900/20 p-6 border border-purple-200 dark:border-purple-800 text-center">
          <div class="text-3xl font-bold text-purple-600 dark:text-purple-400 mb-2">16%</div>
          <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Sales Manager</h3>
          <p class="text-sm text-gray-500 dark:text-gray-500">₹3L quarterly</p>
        </div>

        {{-- Tier 4 --}}
        <div class="bg-primary-50 dark:bg-primary-900/20 p-6 border border-primary-200 dark:border-primary-800 text-center">
          <div class="text-3xl font-bold text-primary-600 dark:text-primary-400 mb-2">21%</div>
          <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Celigin Partner</h3>
          <p class="text-sm text-gray-500 dark:text-gray-500">₹5L quarterly</p>
        </div>
      </div>

      <p class="text-center text-sm text-gray-500 dark:text-gray-500 mt-8">*Terms & conditions apply</p>
    </div>
  </section>

  {{-- ============================================
       SECTION 6: FAQ
       ============================================ --}}
  <section class="bg-gray-50 dark:bg-gray-900 py-16 lg:py-24 border-t border-gray-200 dark:border-gray-700">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
      {{-- Section Header --}}
      <div class="text-center mb-12">
        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-4">
          Frequently Asked Questions
        </h2>
      </div>

      {{-- FAQ Accordion --}}
      @include('frontend.include.accordion', [
        'id' => 'affiliate-faq',
        'type' => 'default',
        'items' => [
          [
            'id' => 'faq1',
            'title' => 'How do I join the Celigin Club?',
            'content' => '<p class="text-gray-600 dark:text-gray-400">Fill out the registration form with your details. You\'ll receive your unique referral link within 24 hours.</p>',
            'open' => true
          ],
          [
            'id' => 'faq2',
            'title' => 'Is there any fee to join?',
            'content' => '<p class="text-gray-600 dark:text-gray-400">No, joining is completely free. No signup fees, no monthly fees, no hidden charges.</p>'
          ],
          [
            'id' => 'faq3',
            'title' => 'How and when do I get paid?',
            'content' => '<p class="text-gray-600 dark:text-gray-400">Commissions are paid monthly by the 15th. Minimum payout is ₹500. Track earnings in your dashboard.</p>'
          ],
          [
            'id' => 'faq4',
            'title' => 'Do I need to buy products first?',
            'content' => '<p class="text-gray-600 dark:text-gray-400">No purchase required. However, trying our products helps you share authentic experiences.</p>'
          ],
          [
            'id' => 'faq5',
            'title' => 'Where can I promote my link?',
            'content' => '<p class="text-gray-600 dark:text-gray-400">Anywhere! Instagram, YouTube, Facebook, WhatsApp, blogs, or any platform you prefer.</p>'
          ],
          [
            'id' => 'faq6',
            'title' => 'How long does the cookie last?',
            'content' => '<p class="text-gray-600 dark:text-gray-400">30 days. If someone clicks your link and buys within 30 days, you earn the commission.</p>'
          ]
        ]
      ])

      {{-- Contact Link --}}
      <div class="mt-10 text-center">
        <a href="{{ route('front.contact') }}" class="text-primary-600 dark:text-primary-400 font-medium hover:underline">
          Have more questions? Contact us
        </a>
      </div>
    </div>
  </section>

  {{-- ============================================
       SECTION 7: REGISTRATION FORM
       ============================================ --}}
  <section id="join-form" class="bg-gray-50 dark:bg-gray-900 py-16 lg:py-24 border-t border-gray-200 dark:border-gray-700">
    <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
      {{-- Section Header --}}
      <div class="text-center mb-8">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mb-2">
          Join Now
        </h2>
        <p class="text-gray-600 dark:text-gray-400">
          Start earning in less than 2 minutes
        </p>
      </div>

      {{-- Registration Form --}}
      <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 lg:p-8">

        {{-- Error Messages --}}
        @if ($errors->any())
          <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200">
            <ul class="list-disc list-inside space-y-1 text-sm">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        {{-- Success Message --}}
        @if (session('success'))
          <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200">
            <p class="font-medium">{{ session('success') }}</p>
          </div>
        @endif

        <form action="{{ route('front.join-now-club-store') }}" method="POST" class="space-y-5">
          @csrf

          {{-- Name Field --}}
          <div>
            <label for="name" class="block text-sm font-medium text-gray-900 dark:text-gray-100 mb-1.5">
              Full Name <span class="text-red-500">*</span>
            </label>
            <input
              type="text"
              id="name"
              name="name"
              required
              value="{{ old('name') }}"
              class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-colors"
              placeholder="Your name" />
          </div>

          {{-- Email Field --}}
          <div>
            <label for="email" class="block text-sm font-medium text-gray-900 dark:text-gray-100 mb-1.5">
              Email <span class="text-red-500">*</span>
            </label>
            <input
              type="email"
              id="email"
              name="email"
              required
              value="{{ old('email') }}"
              class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-colors"
              placeholder="you@example.com" />
          </div>

          {{-- Phone Field --}}
          <div>
            <label for="phone" class="block text-sm font-medium text-gray-900 dark:text-gray-100 mb-1.5">
              Phone <span class="text-red-500">*</span>
            </label>
            <input
              type="tel"
              id="phone"
              name="phone"
              required
              value="{{ old('phone') }}"
              class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-colors"
              placeholder="Your phone number"
              pattern="[0-9]{10,15}" />
          </div>

          {{-- Social Links Row --}}
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label for="instagram" class="block text-sm font-medium text-gray-900 dark:text-gray-100 mb-1.5">
                Instagram <span class="text-gray-400 text-xs">(Optional)</span>
              </label>
              <input
                type="url"
                id="instagram"
                name="instagram_profile_link"
                value="{{ old('instagram_profile_link') }}"
                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-colors"
                placeholder="@username" />
            </div>
            <div>
              <label for="youtube" class="block text-sm font-medium text-gray-900 dark:text-gray-100 mb-1.5">
                YouTube <span class="text-gray-400 text-xs">(Optional)</span>
              </label>
              <input
                type="url"
                id="youtube"
                name="youtube_profile_link"
                value="{{ old('youtube_profile_link') }}"
                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-colors"
                placeholder="Channel link" />
            </div>
          </div>

          {{-- Terms Checkbox --}}
          <div class="flex items-start">
            <input
              type="checkbox"
              id="terms"
              name="terms"
              required
              class="w-4 h-4 mt-1 text-primary-600 border-gray-300 dark:border-gray-600 focus:ring-primary-600 dark:bg-gray-700" />
            <label for="terms" class="ml-3 text-sm text-gray-600 dark:text-gray-400">
              I agree to the <a href="#" class="text-primary-600 dark:text-primary-400 hover:underline">Terms</a> and <a href="#" class="text-primary-600 dark:text-primary-400 hover:underline">Privacy Policy</a>
            </label>
          </div>

          {{-- Submit Button --}}
          <button
            type="submit"
            class="w-full px-6 py-4 bg-primary-600 text-white text-lg font-semibold hover:bg-primary-700 transition-colors flex items-center justify-center gap-2">
            JOIN NOW
            <span class="material-icons-outlined">chevron_right</span>
          </button>

          {{-- Sign In Link --}}
          <p class="text-sm text-gray-500 dark:text-gray-500 text-center">
            Already a member?
            <a href="{{ route('otp.login.form') }}" class="text-primary-600 dark:text-primary-400 font-medium hover:underline">
              Login
            </a>
          </p>
        </form>
      </div>
    </div>
  </section>

</main>
@endsection
