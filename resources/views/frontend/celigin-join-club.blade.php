@extends('frontend.include.app')

@section('title', 'Join Celigin Club - Affiliate & Influencer Program | Earn Up to 40% Commission')

@section('meta')
<meta name="description" content="Join Celigin's affiliate and influencer program. Earn up to 40% commission by promoting premium Korean skincare products. Free to join, no fees, monthly payouts.">
<meta name="keywords" content="celigin affiliate program, influencer marketing, korean skincare affiliate, earn commission, beauty affiliate program">
<meta property="og:title" content="Join Celigin Club - Earn Up to 40% Commission">
<meta property="og:description" content="Join our exclusive affiliate program and earn up to 40% commission by sharing premium Korean skincare products.">
<meta property="og:type" content="website">
<link rel="canonical" href="{{ url()->current() }}">
@endsection

@section('content')
<main id="main-content" role="main" class="bg-gray-50 dark:bg-gray-900 min-h-screen">

  {{-- Skip Link for Accessibility --}}
  <a href="#join-form" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-50 focus:px-4 focus:py-2 focus:bg-primary-600 focus:text-white">
    Skip to registration form
  </a>

  @php
    // Configuration data - can be moved to config or database
    $stats = [
      ['value' => '500+', 'label' => 'Creators', 'highlight' => false],
      ['value' => '20+', 'label' => 'Products', 'highlight' => false],
      ['value' => '40%', 'label' => 'Upto Commission', 'highlight' => true],
      ['value' => 'Korean', 'label' => 'Brand', 'highlight' => false],
    ];

    $videoCards = [
      ['src' => 'brand-1.mp4', 'rotate' => '18deg', 'rotateZ' => '-2deg', 'height' => 'h-52 sm:h-64 lg:h-80', 'width' => 'w-36 sm:w-44 lg:w-52'],
      ['src' => 'brand-2.mp4', 'rotate' => '10deg', 'rotateZ' => '-1deg', 'height' => 'h-56 sm:h-72 lg:h-[22rem]', 'width' => 'w-36 sm:w-44 lg:w-52'],
      ['src' => 'brand-3.mp4', 'rotate' => '0deg', 'rotateZ' => '0deg', 'height' => 'h-64 sm:h-80 lg:h-96', 'width' => 'w-40 sm:w-48 lg:w-56', 'center' => true],
      ['src' => 'brand-4.mp4', 'rotate' => '-10deg', 'rotateZ' => '1deg', 'height' => 'h-56 sm:h-72 lg:h-[22rem]', 'width' => 'w-36 sm:w-44 lg:w-52'],
      ['src' => 'brand-5.mp4', 'rotate' => '-18deg', 'rotateZ' => '2deg', 'height' => 'h-52 sm:h-64 lg:h-80', 'width' => 'w-36 sm:w-44 lg:w-52'],
    ];

    $steps = [
      ['number' => '01', 'icon' => 'person_add', 'title' => 'Join Us', 'description' => 'Quick sign up via email or phone - completely free'],
      ['number' => '02', 'icon' => 'link', 'title' => 'Get Your Link', 'description' => 'Create profile & receive your unique affiliate link'],
      ['number' => '03', 'icon' => 'share', 'title' => 'Share & Promote', 'description' => 'Share products you love on social media & beyond'],
      ['number' => '04', 'icon' => 'payments', 'title' => 'Earn Rewards', 'description' => 'Get up to <span class="font-bold text-amber-600 dark:text-amber-400">40% commission</span> on every sale', 'highlight' => true],
    ];

    $levels = [
      ['level' => 1, 'title' => 'Affiliate', 'requirement' => 'Starting level', 'commission' => '10%', 'style' => 'gray'],
      ['level' => 2, 'title' => 'Business Manager', 'requirement' => '3+ referrals', 'commission' => '20%', 'style' => 'gray-dark'],
      ['level' => 3, 'title' => 'Sales Manager', 'requirement' => '₹3L quarterly sales', 'commission' => '30%', 'style' => 'amber'],
      ['level' => 4, 'title' => 'Celigin Partner', 'requirement' => '₹5L quarterly sales', 'commission' => '40%', 'style' => 'gradient', 'top' => true],
    ];

    $faqs = [
      ['id' => 'faq1', 'title' => 'How do I join the Celigin Club?', 'content' => '<p class="text-gray-600 dark:text-gray-400">Fill out the registration form with your details. You\'ll receive your unique referral link within 24 hours.</p>', 'open' => true],
      ['id' => 'faq2', 'title' => 'Is there any fee to join?', 'content' => '<p class="text-gray-600 dark:text-gray-400">No, joining is completely free. No signup fees, no monthly fees, no hidden charges.</p>'],
      ['id' => 'faq3', 'title' => 'How and when do I get paid?', 'content' => '<p class="text-gray-600 dark:text-gray-400">Commissions are paid monthly by the 15th. Minimum payout is ₹500. Track earnings in your dashboard.</p>'],
      ['id' => 'faq4', 'title' => 'Do I need to buy products first?', 'content' => '<p class="text-gray-600 dark:text-gray-400">No purchase required. However, trying our products helps you share authentic experiences.</p>'],
      ['id' => 'faq5', 'title' => 'Where can I promote my link?', 'content' => '<p class="text-gray-600 dark:text-gray-400">Anywhere! Instagram, YouTube, Facebook, WhatsApp, blogs, or any platform you prefer.</p>'],
      ['id' => 'faq6', 'title' => 'How long does the cookie last?', 'content' => '<p class="text-gray-600 dark:text-gray-400">30 days. If someone clicks your link and buys within 30 days, you earn the commission.</p>'],
    ];
  @endphp

  {{-- ============================================
       SECTION 1: HERO
       ============================================ --}}
  <section aria-labelledby="hero-heading" class="bg-gradient-to-b from-amber-50 via-orange-50/50 to-white dark:from-gray-900 dark:via-gray-900 dark:to-gray-800 flex flex-col justify-center">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6">

      {{-- Premium Badge --}}
      <div class="flex justify-center mb-2 sm:mb-3">
        <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-gradient-to-r from-amber-100 to-orange-100 dark:from-amber-900/40 dark:to-orange-900/40 border border-amber-200/60 dark:border-amber-700/40 rounded-full mb-4">
          <span class="text-amber-600 dark:text-amber-400 text-xs" aria-hidden="true">✦</span>
          <span class="text-xs font-medium text-amber-700 dark:text-amber-300 uppercase tracking-wider">Exclusive Program</span>
          <span class="text-amber-600 dark:text-amber-400 text-xs" aria-hidden="true">✦</span>
        </div>
      </div>

      {{-- Headline --}}
      <div class="text-center mb-2 sm:mb-3">
        <h1 id="hero-heading" class="text-xl sm:text-2xl lg:text-4xl font-bold leading-snug">
          <span class="text-gray-900 dark:text-white">Affiliate & Influencer </span>
          <span class="bg-gradient-to-r from-amber-600 via-orange-500 to-amber-600 dark:from-amber-400 dark:via-orange-400 dark:to-amber-400 bg-clip-text text-transparent">Program</span>
        </h1>
      </div>

      {{-- Subtitle --}}
      <div class="text-center max-w-lg mx-auto mb-3 sm:mb-4">
        <p class="text-sm text-gray-600 dark:text-gray-400">
          Join our exclusive community - earn commissions by sharing premium Korean skincare.
        </p>
      </div>

      {{-- CTA Button --}}
      <div class="flex justify-center mb-4 sm:mb-5">
        <a href="#affiliate-form"
           class="inline-flex items-center gap-1.5 px-5 py-2 sm:px-7 sm:py-2.5 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white text-xs sm:text-sm font-semibold rounded-full shadow-lg shadow-orange-500/25 hover:shadow-orange-500/40 transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
          Join Celigin Club
          <span class="material-icons-outlined text-base sm:text-lg" aria-hidden="true">arrow_forward</span>
        </a>
      </div>

      {{-- Video Gallery --}}
      <div class="relative w-full mb-4 sm:mb-6 py-4" role="region" aria-label="Brand showcase videos">
        <div class="flex items-end justify-center gap-2 sm:gap-3 lg:gap-4 px-4 video-gallery">
          @foreach($videoCards as $index => $card)
            <div class="video-card relative flex-shrink-0 {{ $card['width'] }} {{ $card['height'] }} rounded-2xl overflow-hidden shadow-{{ isset($card['center']) ? 'xl' : 'lg' }} transition-all duration-500 {{ isset($card['center']) ? 'z-10' : '' }} bg-amber-50 dark:bg-gray-700"
                 style="transform: rotateY({{ $card['rotate'] }}) rotateZ({{ $card['rotateZ'] }}); transform-origin: center bottom;">
              <video class="w-full h-full object-cover" muted loop playsinline data-video-card aria-label="Brand showcase video {{ $index + 1 }}">
                <source src="{{ asset('assets/frontend/videos/' . $card['src']) }}" type="video/mp4">
              </video>
              <div class="absolute bottom-0 left-0 right-0 h-{{ isset($card['center']) ? '24' : '20' }} pointer-events-none video-gradient"></div>
            </div>
          @endforeach
        </div>
      </div>

      {{-- Stats Row --}}
      <div class="flex justify-center items-center gap-4 sm:gap-8 lg:gap-12 max-w-2xl mx-auto" role="list" aria-label="Program statistics">
        @foreach($stats as $index => $stat)
          @if($index > 0)
            <div class="w-px h-8 bg-gradient-to-b from-transparent via-gray-300 dark:via-gray-600 to-transparent" aria-hidden="true"></div>
          @endif
          <div class="text-center" role="listitem">
            <div class="text-base sm:text-xl lg:text-2xl font-bold {{ $stat['highlight'] ? 'bg-gradient-to-r from-amber-600 to-orange-500 dark:from-amber-400 dark:to-orange-400 bg-clip-text text-transparent' : 'text-gray-900 dark:text-white' }}">
              {{ $stat['value'] }}
            </div>
            <div class="text-xs text-gray-500 dark:text-gray-400">{{ $stat['label'] }}</div>
          </div>
        @endforeach
      </div>

    </div>
  </section>

  {{-- ============================================
       SECTION 2: HOW IT WORKS
       ============================================ --}}
  <section id="how-it-works" aria-labelledby="how-it-works-heading" class="relative bg-gradient-to-b from-white via-amber-50/20 to-white dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 py-20 lg:py-28 overflow-hidden">

    {{-- Background Decorative Elements --}}
    <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
      <div class="absolute top-20 left-10 w-72 h-72 bg-amber-200/20 dark:bg-amber-900/10 rounded-full blur-3xl"></div>
      <div class="absolute bottom-20 right-10 w-96 h-96 bg-orange-200/20 dark:bg-orange-900/10 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

      {{-- Section Header --}}
      <div class="text-center mb-16 lg:mb-20">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-gradient-to-r from-amber-100 to-orange-100 dark:from-amber-900/30 dark:to-orange-900/30 border border-amber-200/50 dark:border-amber-700/30 rounded-full mb-4">
          <span class="w-1.5 h-1.5 bg-amber-500 rounded-full animate-pulse" aria-hidden="true"></span>
          <span class="text-xs font-semibold text-amber-700 dark:text-amber-300 uppercase tracking-wider">Simple 4-Step Process</span>
        </div>
        <h2 id="how-it-works-heading" class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4">
          How It <span class="bg-gradient-to-r from-amber-600 to-orange-500 dark:from-amber-400 dark:to-orange-400 bg-clip-text text-transparent">Works</span>
        </h2>
        <p class="text-gray-500 dark:text-gray-400 max-w-md mx-auto">
          Start your journey to earning in just four simple steps
        </p>
      </div>

      {{-- Steps Timeline --}}
      <div class="relative">
        {{-- Connecting Line (Desktop) --}}
        <div class="hidden lg:block absolute top-24 left-[12%] right-[12%] h-0.5 bg-gradient-to-r from-amber-200 via-orange-300 to-amber-200 dark:from-amber-800 dark:via-orange-700 dark:to-amber-800" aria-hidden="true"></div>

        {{-- Steps Grid --}}
        <ol class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-6 list-none">
          @foreach($steps as $index => $step)
            <li class="group relative">
              <div class="relative {{ isset($step['highlight']) ? 'bg-gradient-to-br from-amber-50 to-orange-50 dark:from-amber-900/20 dark:to-orange-900/20 border-amber-200 dark:border-amber-700/50' : 'bg-white/80 dark:bg-gray-800/80 border-gray-100 dark:border-gray-700' }} backdrop-blur-sm p-6 lg:p-8 border shadow-lg shadow-gray-200/50 dark:shadow-none hover:shadow-xl hover:shadow-amber-200/30 dark:hover:shadow-amber-900/20 transition-all duration-500 hover:-translate-y-1">

                {{-- Step Number Badge --}}
                <div class="absolute -top-4 left-6 flex items-center justify-center w-8 h-8 bg-gradient-to-br from-amber-500 to-orange-500 text-white text-xs font-bold shadow-lg shadow-orange-500/30 {{ isset($step['highlight']) ? 'ring-2 ring-white dark:ring-gray-900' : '' }}" aria-hidden="true">
                  {{ $step['number'] }}
                </div>

                {{-- Icon Container --}}
                <div class="relative w-16 h-16 mx-auto mb-6 mt-2">
                  <div class="absolute inset-0 bg-gradient-to-br {{ isset($step['highlight']) ? 'from-amber-200 to-orange-200 dark:from-amber-800/60 dark:to-orange-800/60' : 'from-amber-100 to-orange-100 dark:from-amber-900/40 dark:to-orange-900/40' }} rounded-2xl rotate-6 group-hover:rotate-12 transition-transform duration-500" aria-hidden="true"></div>
                  <div class="relative w-full h-full bg-white dark:bg-gray-800 rounded-2xl flex items-center justify-center border {{ isset($step['highlight']) ? 'border-amber-300/50 dark:border-amber-600/50' : 'border-amber-200/50 dark:border-amber-700/50' }}">
                    <span class="material-icons-outlined text-3xl bg-gradient-to-br from-amber-600 to-orange-500 bg-clip-text text-transparent" aria-hidden="true">{{ $step['icon'] }}</span>
                  </div>
                </div>

                {{-- Content --}}
                <div class="text-center">
                  <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">{{ $step['title'] }}</h3>
                  <p class="text-sm {{ isset($step['highlight']) ? 'text-gray-600 dark:text-gray-300' : 'text-gray-500 dark:text-gray-400' }} leading-relaxed">
                    {!! $step['description'] !!}
                  </p>
                </div>

                @if(isset($step['highlight']))
                  <div class="absolute -top-3 -right-2 px-2 py-0.5 bg-gradient-to-r from-amber-500 to-orange-500 text-white text-[10px] font-bold uppercase tracking-wide shadow-lg">
                    Best Part
                  </div>
                @endif
              </div>

              @if($index < count($steps) - 1)
                <div class="flex justify-center my-4 lg:hidden" aria-hidden="true">
                  <span class="material-icons-outlined text-amber-400 dark:text-amber-600 text-2xl animate-bounce">keyboard_arrow_down</span>
                </div>
              @endif
            </li>
          @endforeach
        </ol>
      </div>

      {{-- CTA --}}
      <div class="text-center mt-14 lg:mt-16">
        <a href="#affiliate-form"
           class="group inline-flex items-center gap-2 px-8 py-3.5 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white font-semibold rounded-full shadow-lg shadow-orange-500/25 hover:shadow-orange-500/40 transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
          Start Earning Today
          <span class="material-icons-outlined text-lg group-hover:translate-x-1 transition-transform" aria-hidden="true">arrow_forward</span>
        </a>
        <p class="mt-4 text-sm text-gray-400 dark:text-gray-500">No fees • No commitments • Cancel anytime</p>
      </div>

    </div>
  </section>

  {{-- ============================================
       SECTION 3: AFFILIATE HUB
       ============================================ --}}
  <section id="affiliate-form" aria-labelledby="affiliate-hub-heading" class="relative bg-gradient-to-b from-gray-50 to-white dark:from-gray-900 dark:to-gray-800 py-16 lg:py-24 overflow-hidden">

    {{-- Background Decorative Elements --}}
    <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
      <div class="absolute top-0 right-0 w-96 h-96 bg-amber-100/40 dark:bg-amber-900/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
      <div class="absolute bottom-0 left-0 w-80 h-80 bg-orange-100/40 dark:bg-orange-900/10 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>
    </div>

    <h2 id="affiliate-hub-heading" class="sr-only">Join Celigin Affiliate Program</h2>

    <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-10 items-stretch">

        {{-- LEFT COLUMN: Commission Info & Levels --}}
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-xl shadow-gray-200/50 dark:shadow-none flex flex-col h-full">

          {{-- Header --}}
          <div class="bg-gradient-to-r from-amber-500 to-orange-500 p-6 lg:p-8">
            <div class="flex items-center gap-4">
              <div class="w-14 h-14 bg-white/20 backdrop-blur flex items-center justify-center flex-shrink-0" aria-hidden="true">
                <span class="material-icons-outlined text-white text-2xl">trending_up</span>
              </div>
              <div>
                <div class="text-sm text-white/80">Earn up to</div>
                <div class="text-3xl font-bold text-white">40% Commission</div>
              </div>
            </div>
          </div>

          {{-- Hot Items Link --}}
          <a href="{{ route('front.category', 'best-sellers') }}" class="block p-6 border-b border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors group focus:outline-none focus:ring-2 focus:ring-inset focus:ring-amber-500">
            <div class="flex items-center justify-between">
              <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center" aria-hidden="true">
                  <span class="material-icons-outlined text-amber-600 dark:text-amber-400 text-2xl">local_fire_department</span>
                </div>
                <div>
                  <h3 class="text-base font-semibold text-gray-900 dark:text-white group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">Hot Items to Promote</h3>
                  <p class="text-sm text-gray-500 dark:text-gray-400">Browse our best-selling products</p>
                </div>
              </div>
              <span class="material-icons-outlined text-gray-400 group-hover:text-amber-600 dark:group-hover:text-amber-400 text-xl transition-transform group-hover:translate-x-1" aria-hidden="true">chevron_right</span>
            </div>
          </a>

          {{-- Level Guide --}}
          <div class="p-6 lg:p-8 flex-1">
            <div class="flex items-center justify-between mb-5">
              <h3 class="text-lg font-bold text-gray-900 dark:text-white">Level Guide</h3>
              <span class="text-xs text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 px-2 py-1">Grow & Earn More</span>
            </div>

            <ul class="space-y-4" role="list">
              @foreach($levels as $level)
                @php
                  $bgClass = match($level['style']) {
                    'gray' => 'bg-gray-50 dark:bg-gray-700/50 border-gray-100 dark:border-gray-700',
                    'gray-dark' => 'bg-gray-50 dark:bg-gray-700/50 border-gray-200 dark:border-gray-600',
                    'amber' => 'bg-amber-50 dark:bg-amber-900/20 border-amber-100 dark:border-amber-800/30',
                    'gradient' => 'bg-gradient-to-r from-amber-50 to-orange-50 dark:from-amber-900/20 dark:to-orange-900/20 border-amber-200 dark:border-amber-700/30',
                    default => 'bg-gray-50 dark:bg-gray-700/50 border-gray-100 dark:border-gray-700',
                  };
                  $badgeClass = match($level['style']) {
                    'gray' => 'bg-gray-200 dark:bg-gray-600 text-gray-600 dark:text-gray-300',
                    'gray-dark' => 'bg-gray-400 dark:bg-gray-500 text-white',
                    'amber' => 'bg-amber-500 text-white',
                    'gradient' => 'bg-gradient-to-br from-amber-500 to-orange-500 text-white',
                    default => 'bg-gray-200 dark:bg-gray-600 text-gray-600 dark:text-gray-300',
                  };
                  $textClass = match($level['style']) {
                    'amber' => 'text-amber-600 dark:text-amber-400',
                    'gradient' => 'bg-gradient-to-r from-amber-600 to-orange-500 bg-clip-text text-transparent',
                    default => 'text-gray-700 dark:text-gray-300',
                  };
                @endphp
                <li class="flex items-center gap-4 p-3 {{ $bgClass }} border {{ isset($level['top']) ? 'relative' : '' }}">
                  @if(isset($level['top']))
                    <div class="absolute -top-2 -right-2 px-2 py-0.5 bg-gradient-to-r from-amber-500 to-orange-500 text-white text-[10px] font-bold uppercase">Top</div>
                  @endif
                  <div class="w-10 h-10 {{ $badgeClass }} flex items-center justify-center text-sm font-bold" aria-hidden="true">{{ $level['level'] }}</div>
                  <div class="flex-1">
                    <div class="text-sm font-semibold text-gray-900 dark:text-white">{{ $level['title'] }}</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ $level['requirement'] }}</div>
                  </div>
                  <div class="text-xl font-bold {{ $textClass }}">{{ $level['commission'] }}</div>
                </li>
              @endforeach
            </ul>

            <p class="text-xs text-gray-400 dark:text-gray-500 mt-5 text-center">*Terms & conditions apply</p>
          </div>
        </div>

        {{-- RIGHT COLUMN: Dashboard or Form --}}
        <div class="flex flex-col h-full">
          @auth
            {{-- LOGGED IN: Dashboard --}}
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-xl shadow-gray-200/50 dark:shadow-none flex flex-col h-full">
              <div class="bg-gray-900 dark:bg-gray-700 p-6 lg:p-8">
                <h3 class="text-xl font-bold text-white">Your Earnings</h3>
                <p class="text-sm text-gray-300 mt-1">Track your affiliate performance</p>
              </div>

              <div class="p-6 lg:p-8 flex-1 flex flex-col">
                <div class="grid grid-cols-2 gap-4 mb-6">
                  <div class="bg-gray-50 dark:bg-gray-700 p-4 border border-gray-200 dark:border-gray-600">
                    <div class="text-sm text-gray-500 dark:text-gray-400">Total Earnings</div>
                    <div class="text-2xl font-bold text-gray-900 dark:text-white">₹0.00</div>
                  </div>
                  <div class="bg-gradient-to-br from-amber-50 to-orange-50 dark:from-amber-900/20 dark:to-orange-900/20 p-4 border border-amber-200 dark:border-amber-700/30">
                    <div class="text-sm text-gray-500 dark:text-gray-400">Pending</div>
                    <div class="text-2xl font-bold text-amber-600 dark:text-amber-400">₹0.00</div>
                  </div>
                </div>

                <div class="mb-6">
                  <label for="referral-link" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Your Referral Link</label>
                  <div class="flex">
                    <input type="text" id="referral-link" readonly value="{{ url('/') }}?ref={{ auth()->user()->id ?? 'CODE' }}"
                           class="flex-1 px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-100 text-sm" />
                    <button type="button" id="copy-link-btn" aria-label="Copy referral link to clipboard"
                            class="px-4 bg-gray-900 dark:bg-gray-600 text-white hover:bg-gray-800 dark:hover:bg-gray-500 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                      <span class="material-icons-outlined text-lg" aria-hidden="true">content_copy</span>
                    </button>
                  </div>
                </div>

                <div class="grid grid-cols-3 gap-3 text-center mb-6">
                  <div class="py-4 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600">
                    <div class="text-xl font-bold text-gray-900 dark:text-white">0</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">Clicks</div>
                  </div>
                  <div class="py-4 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600">
                    <div class="text-xl font-bold text-gray-900 dark:text-white">0</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">Orders</div>
                  </div>
                  <div class="py-4 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600">
                    <div class="text-xl font-bold text-amber-600 dark:text-amber-400">10%</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">Commission</div>
                  </div>
                </div>

                <div class="mt-auto">
                  <a href="#" class="w-full inline-flex items-center justify-center gap-2 px-6 py-4 bg-primary-600 hover:bg-primary-700 text-white font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    Go to Dashboard
                    <span class="material-icons-outlined text-lg" aria-hidden="true">arrow_forward</span>
                  </a>
                </div>
              </div>
            </div>

          @else
            {{-- GUEST: Join Form --}}
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-xl shadow-gray-200/50 dark:shadow-none flex flex-col h-full">
              <div class="bg-gray-900 dark:bg-gray-700 p-6 lg:p-8 text-center">
                <h3 class="text-xl font-bold text-white">Join Now</h3>
                <p class="text-sm text-gray-300 mt-1">Start earning in less than 2 minutes</p>
              </div>

              <div class="p-6 lg:p-8 flex-1 flex flex-col">
                @if ($errors->any())
                  <div class="mb-5 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200" role="alert">
                    <ul class="list-disc list-inside space-y-1 text-sm">
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif

                @if (session('success'))
                  <div class="mb-5 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200" role="status">
                    <p class="font-medium">{{ session('success') }}</p>
                  </div>
                @endif

                <form action="{{ route('front.join-now-club-store') }}" method="POST" class="flex-1 flex flex-col" novalidate>
                  @csrf
                  <div class="space-y-4 flex-1">
                    <div>
                      <label for="name" class="block text-sm font-medium text-gray-900 dark:text-gray-100 mb-1.5">
                        Full Name <span class="text-red-500" aria-hidden="true">*</span>
                        <span class="sr-only">(required)</span>
                      </label>
                      <input type="text" id="name" name="name" required value="{{ old('name') }}" autocomplete="name"
                             class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-primary-600 focus:border-primary-600 focus:bg-white dark:focus:bg-gray-600 transition-colors"
                             placeholder="Your name"
                             aria-describedby="{{ $errors->has('name') ? 'name-error' : '' }}" />
                    </div>

                    <div>
                      <label for="email" class="block text-sm font-medium text-gray-900 dark:text-gray-100 mb-1.5">
                        Email <span class="text-red-500" aria-hidden="true">*</span>
                        <span class="sr-only">(required)</span>
                      </label>
                      <input type="email" id="email" name="email" required value="{{ old('email') }}" autocomplete="email"
                             class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-primary-600 focus:border-primary-600 focus:bg-white dark:focus:bg-gray-600 transition-colors"
                             placeholder="you@example.com" />
                    </div>

                    <div>
                      <label for="phone" class="block text-sm font-medium text-gray-900 dark:text-gray-100 mb-1.5">
                        Phone <span class="text-red-500" aria-hidden="true">*</span>
                        <span class="sr-only">(required)</span>
                      </label>
                      <input type="tel" id="phone" name="phone" required value="{{ old('phone') }}" autocomplete="tel"
                             class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-primary-600 focus:border-primary-600 focus:bg-white dark:focus:bg-gray-600 transition-colors"
                             placeholder="Your phone number" pattern="[0-9]{10,15}" />
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                      <div>
                        <label for="instagram" class="block text-sm font-medium text-gray-900 dark:text-gray-100 mb-1.5">
                          Instagram <span class="text-gray-400 text-xs">(Optional)</span>
                        </label>
                        <input type="text" id="instagram" name="instagram_profile_link" value="{{ old('instagram_profile_link') }}"
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-primary-600 focus:border-primary-600 focus:bg-white dark:focus:bg-gray-600 transition-colors"
                               placeholder="@username" />
                      </div>
                      <div>
                        <label for="youtube" class="block text-sm font-medium text-gray-900 dark:text-gray-100 mb-1.5">
                          YouTube <span class="text-gray-400 text-xs">(Optional)</span>
                        </label>
                        <input type="text" id="youtube" name="youtube_profile_link" value="{{ old('youtube_profile_link') }}"
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-primary-600 focus:border-primary-600 focus:bg-white dark:focus:bg-gray-600 transition-colors"
                               placeholder="Channel link" />
                      </div>
                    </div>

                    <div class="flex items-start">
                      <input type="checkbox" id="terms" name="terms" required
                             class="w-4 h-4 mt-1 text-primary-600 border-gray-300 dark:border-gray-600 focus:ring-primary-600 dark:bg-gray-700" />
                      <label for="terms" class="ml-3 text-sm text-gray-600 dark:text-gray-400">
                        I agree to the <a href="{{ route('front.page', 'terms-conditions') }}" class="text-primary-600 dark:text-primary-400 hover:underline focus:outline-none focus:ring-2 focus:ring-primary-500">Terms & Conditions</a> and <a href="{{ route('front.page', 'privacy-policy') }}" class="text-primary-600 dark:text-primary-400 hover:underline focus:outline-none focus:ring-2 focus:ring-primary-500">Privacy Policy</a>
                      </label>
                    </div>
                  </div>

                  <div class="mt-auto pt-6">
                    <button type="submit"
                            class="w-full px-6 py-4 bg-primary-600 text-white text-lg font-semibold hover:bg-primary-700 transition-colors flex items-center justify-center gap-2 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                      JOIN NOW
                      <span class="material-icons-outlined" aria-hidden="true">chevron_right</span>
                    </button>

                    <p class="text-sm text-gray-500 dark:text-gray-500 text-center mt-4">
                      Already a member?
                      <a href="{{ route('otp.login.form') }}" class="text-primary-600 dark:text-primary-400 font-medium hover:underline focus:outline-none focus:ring-2 focus:ring-primary-500">Login</a>
                    </p>
                  </div>
                </form>
              </div>
            </div>
          @endauth
        </div>

      </div>
    </div>
  </section>

  {{-- ============================================
       SECTION 4: FAQ
       ============================================ --}}
  <section aria-labelledby="faq-heading" class="bg-gray-50 dark:bg-gray-900 py-16 lg:py-24 border-t border-gray-200 dark:border-gray-700">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-12">
        <h2 id="faq-heading" class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-4">
          Frequently Asked Questions
        </h2>
      </div>

      @include('frontend.include.accordion', [
        'id' => 'affiliate-faq',
        'type' => 'default',
        'items' => $faqs
      ])

      <div class="mt-10 text-center">
        <a href="{{ route('front.contact') }}" class="text-primary-600 dark:text-primary-400 font-medium hover:underline focus:outline-none focus:ring-2 focus:ring-primary-500">
          Have more questions? Contact us
        </a>
      </div>
    </div>
  </section>

</main>

{{-- FAQ Schema Markup for SEO --}}
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    @foreach($faqs as $index => $faq)
    {
      "@type": "Question",
      "name": "{{ $faq['title'] }}",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "{{ strip_tags($faq['content']) }}"
      }
    }{{ $index < count($faqs) - 1 ? ',' : '' }}
    @endforeach
  ]
}
</script>
@endsection

@push('styles')
<style>
  .video-card {
    transform-style: preserve-3d;
    backface-visibility: hidden;
  }
  .video-card.is-playing {
    box-shadow: 0 20px 40px -10px rgba(251, 146, 60, 0.3);
  }
  .video-card:hover {
    transform: rotateY(0deg) rotateZ(0deg) scale(1.02) !important;
    z-index: 20;
  }
  .video-gradient {
    background: linear-gradient(to top, rgba(0,0,0,0.12) 0%, transparent 100%);
  }
</style>
@endpush

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Video Card Random Play
    const videos = document.querySelectorAll('[data-video-card]');
    const playingVideos = new Set();
    const maxSimultaneous = 2;

    function getRandomVideos(count) {
      const shuffled = Array.from(videos).sort(() => Math.random() - 0.5);
      return shuffled.slice(0, count);
    }

    function playRandomVideos() {
      videos.forEach(video => {
        video.pause();
        video.parentElement.classList.remove('is-playing');
      });
      playingVideos.clear();

      const selectedVideos = getRandomVideos(maxSimultaneous);
      selectedVideos.forEach(video => {
        video.play().catch(() => {});
        video.parentElement.classList.add('is-playing');
        playingVideos.add(video);
      });
    }

    if (videos.length > 0) {
      playRandomVideos();
      setInterval(playRandomVideos, 4000 + Math.random() * 2000);

      videos.forEach(video => {
        video.parentElement.addEventListener('mouseenter', () => {
          video.play().catch(() => {});
          video.parentElement.classList.add('is-playing');
        });
        video.parentElement.addEventListener('mouseleave', () => {
          if (!playingVideos.has(video)) {
            video.pause();
            video.parentElement.classList.remove('is-playing');
          }
        });
      });
    }

    // Copy Link Button
    const copyBtn = document.getElementById('copy-link-btn');
    if (copyBtn) {
      copyBtn.addEventListener('click', function() {
        const input = document.getElementById('referral-link');
        navigator.clipboard.writeText(input.value).then(() => {
          const icon = this.querySelector('.material-icons-outlined');
          icon.textContent = 'check';
          setTimeout(() => { icon.textContent = 'content_copy'; }, 2000);
        });
      });
    }
  });
</script>
@endpush
