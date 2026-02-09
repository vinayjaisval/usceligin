@extends('frontend.include.app')

@section('content')
<main id="main-content" role="main" class="bg-gray-50 dark:bg-gray-900 min-h-screen">

  {{-- ============================================
       SECTION 1: HERO (Luxury Style)
       ============================================ --}}
  <section class="bg-gradient-to-b from-amber-50 via-orange-50/50 to-white dark:from-gray-900 dark:via-gray-900 dark:to-gray-800 flex flex-col justify-center">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6">

      {{-- Premium Badge --}}
      <div class="flex justify-center mb-2 sm:mb-3">
        <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-gradient-to-r from-amber-100 to-orange-100 dark:from-amber-900/40 dark:to-orange-900/40 border border-amber-200/60 dark:border-amber-700/40 rounded-full mb-4">
          <span class="text-amber-600 dark:text-amber-400 text-xs">✦</span>
          <span class="text-[10px] sm:text-xs font-medium text-amber-700 dark:text-amber-300 uppercase tracking-wider">Exclusive Program</span>
          <span class="text-amber-600 dark:text-amber-400 text-xs">✦</span>
        </div>
      </div>

      {{-- Headline --}}
      <div class="text-center mb-2 sm:mb-3">
        <h1 class="text-xl sm:text-2xl lg:text-4xl font-bold leading-snug">
          <span class="text-gray-900 dark:text-white">Affiliate & Influencer </span>
          <span class="bg-gradient-to-r from-amber-600 via-orange-500 to-amber-600 dark:from-amber-400 dark:via-orange-400 dark:to-amber-400 bg-clip-text text-transparent">Program</span>
        </h1>
      </div>

      {{-- Subtitle --}}
      <div class="text-center max-w-lg mx-auto mb-3 sm:mb-4">
        <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400">
          Join our exclusive community - earn commissions by sharing premium Korean skincare.
        </p>
      </div>

      {{-- CTA Button --}}
      <div class="flex justify-center mb-4 sm:mb-5">
        <a href="#join-form"
           class="inline-flex items-center gap-1.5 px-5 py-2 sm:px-7 sm:py-2.5 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white text-xs sm:text-sm font-semibold rounded-full shadow-lg shadow-orange-500/25 hover:shadow-orange-500/40 transition-all">
          Join Celigin Club
          <span class="material-icons-outlined text-base sm:text-lg">arrow_forward</span>
        </a>
      </div>

      {{-- Video Gallery Section (3D Perspective Cards) --}}
      <div class="relative w-full mb-4 sm:mb-6 py-4">
        {{-- Video Cards Container --}}
        <div class="flex items-end justify-center gap-2 sm:gap-3 lg:gap-4 px-4" style="perspective: 1500px;">

          {{-- Video Card 1 (Left outer) --}}
          <div class="video-card relative flex-shrink-0 w-36 sm:w-44 lg:w-52 h-52 sm:h-64 lg:h-80 rounded-2xl overflow-hidden shadow-lg transition-all duration-500 bg-amber-50 dark:bg-gray-700"
               style="transform: rotateY(18deg) rotateZ(-2deg); transform-origin: center bottom;">
            <video class="w-full h-full object-cover" muted loop playsinline data-video-card>
              <source src="{{ asset('assets/frontend/videos/brand-1.mp4') }}" type="video/mp4">
            </video>
            <div class="absolute bottom-0 left-0 right-0 h-20 pointer-events-none" style="background: linear-gradient(to top, rgba(0,0,0,0.12) 0%, transparent 100%);"></div>
          </div>

          {{-- Video Card 2 (Left inner) --}}
          <div class="video-card relative flex-shrink-0 w-36 sm:w-44 lg:w-52 h-56 sm:h-72 lg:h-[22rem] rounded-2xl overflow-hidden shadow-lg transition-all duration-500 bg-amber-50 dark:bg-gray-700"
               style="transform: rotateY(10deg) rotateZ(-1deg); transform-origin: center bottom;">
            <video class="w-full h-full object-cover" muted loop playsinline data-video-card>
              <source src="{{ asset('assets/frontend/videos/brand-2.mp4') }}" type="video/mp4">
            </video>
            <div class="absolute bottom-0 left-0 right-0 h-20 pointer-events-none" style="background: linear-gradient(to top, rgba(0,0,0,0.12) 0%, transparent 100%);"></div>
          </div>

          {{-- Video Card 3 (Center - Largest) --}}
          <div class="video-card video-card-center relative flex-shrink-0 w-40 sm:w-48 lg:w-56 h-64 sm:h-80 lg:h-96 rounded-2xl overflow-hidden shadow-xl transition-all duration-500 z-10 bg-amber-50 dark:bg-gray-700"
               style="transform: rotateY(0deg) rotateZ(0deg); transform-origin: center bottom;">
            <video class="w-full h-full object-cover" muted loop playsinline data-video-card>
              <source src="{{ asset('assets/frontend/videos/brand-3.mp4') }}" type="video/mp4">
            </video>
            <div class="absolute bottom-0 left-0 right-0 h-24 pointer-events-none" style="background: linear-gradient(to top, rgba(0,0,0,0.12) 0%, transparent 100%);"></div>
          </div>

          {{-- Video Card 4 (Right inner) --}}
          <div class="video-card relative flex-shrink-0 w-36 sm:w-44 lg:w-52 h-56 sm:h-72 lg:h-[22rem] rounded-2xl overflow-hidden shadow-lg transition-all duration-500 bg-amber-50 dark:bg-gray-700"
               style="transform: rotateY(-10deg) rotateZ(1deg); transform-origin: center bottom;">
            <video class="w-full h-full object-cover" muted loop playsinline data-video-card>
              <source src="{{ asset('assets/frontend/videos/brand-4.mp4') }}" type="video/mp4">
            </video>
            <div class="absolute bottom-0 left-0 right-0 h-20 pointer-events-none" style="background: linear-gradient(to top, rgba(0,0,0,0.12) 0%, transparent 100%);"></div>
          </div>

          {{-- Video Card 5 (Right outer) --}}
          <div class="video-card relative flex-shrink-0 w-36 sm:w-44 lg:w-52 h-52 sm:h-64 lg:h-80 rounded-2xl overflow-hidden shadow-lg transition-all duration-500 bg-amber-50 dark:bg-gray-700"
               style="transform: rotateY(-18deg) rotateZ(2deg); transform-origin: center bottom;">
            <video class="w-full h-full object-cover" muted loop playsinline data-video-card>
              <source src="{{ asset('assets/frontend/videos/brand-5.mp4') }}" type="video/mp4">
            </video>
            <div class="absolute bottom-0 left-0 right-0 h-20 pointer-events-none" style="background: linear-gradient(to top, rgba(0,0,0,0.12) 0%, transparent 100%);"></div>
          </div>

        </div>
      </div>

      {{-- Random Video Play/Pause Script --}}
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          const videos = document.querySelectorAll('[data-video-card]');
          const playingVideos = new Set();
          const maxSimultaneous = 2; // Max videos playing at once

          function getRandomVideos(count) {
            const shuffled = Array.from(videos).sort(() => Math.random() - 0.5);
            return shuffled.slice(0, count);
          }

          function playRandomVideos() {
            // Pause all videos first
            videos.forEach(video => {
              video.pause();
              video.parentElement.classList.remove('is-playing');
            });
            playingVideos.clear();

            // Select random videos to play
            const selectedVideos = getRandomVideos(maxSimultaneous);
            selectedVideos.forEach(video => {
              video.play().catch(() => {}); // Catch autoplay restrictions
              video.parentElement.classList.add('is-playing');
              playingVideos.add(video);
            });
          }

          // Initial play
          playRandomVideos();

          // Rotate playing videos every 4-6 seconds
          setInterval(() => {
            playRandomVideos();
          }, 4000 + Math.random() * 2000);

          // Hover interaction - play on hover
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
        });
      </script>

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
      </style>

      {{-- Stats Row --}}
      <div class="flex justify-center items-center gap-4 sm:gap-8 lg:gap-12 max-w-2xl mx-auto">
        {{-- Stat 1 --}}
        <div class="text-center">
          <div class="text-base sm:text-xl lg:text-2xl font-bold text-gray-900 dark:text-white">500+</div>
          <div class="text-[10px] sm:text-xs text-gray-500 dark:text-gray-400">Creators</div>
        </div>
        <div class="w-px h-8 bg-gradient-to-b from-transparent via-gray-300 dark:via-gray-600 to-transparent"></div>
        {{-- Stat 2 --}}
        <div class="text-center">
          <div class="text-base sm:text-xl lg:text-2xl font-bold text-gray-900 dark:text-white">20+</div>
          <div class="text-[10px] sm:text-xs text-gray-500 dark:text-gray-400">Products</div>
        </div>
        <div class="w-px h-8 bg-gradient-to-b from-transparent via-gray-300 dark:via-gray-600 to-transparent"></div>
        {{-- Stat 3 --}}
        <div class="text-center">
          <div class="text-base sm:text-xl lg:text-2xl font-bold bg-gradient-to-r from-amber-600 to-orange-500 dark:from-amber-400 dark:to-orange-400 bg-clip-text text-transparent">40%</div>
          <div class="text-[10px] sm:text-xs text-gray-500 dark:text-gray-400">Upto Commission</div>
        </div>
        <div class="w-px h-8 bg-gradient-to-b from-transparent via-gray-300 dark:via-gray-600 to-transparent"></div>
        {{-- Stat 4 --}}
        <div class="text-center">
          <div class="text-base sm:text-xl lg:text-2xl font-bold text-gray-900 dark:text-white">Korean</div>
          <div class="text-[10px] sm:text-xs text-gray-500 dark:text-gray-400">Brand</div>
        </div>
      </div>

    </div>
  </section>


  {{-- ============================================
       SECTION 2: HOW IT WORKS (4 Steps) - Luxury Design
       ============================================ --}}
  <section id="how-it-works" class="relative bg-gradient-to-b from-white via-amber-50/20 to-white dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 py-20 lg:py-28 overflow-hidden">

    {{-- Background Decorative Elements --}}
    <div class="absolute inset-0 pointer-events-none">
      <div class="absolute top-20 left-10 w-72 h-72 bg-amber-200/20 dark:bg-amber-900/10 rounded-full blur-3xl"></div>
      <div class="absolute bottom-20 right-10 w-96 h-96 bg-orange-200/20 dark:bg-orange-900/10 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

      {{-- Section Header --}}
      <div class="text-center mb-16 lg:mb-20">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-gradient-to-r from-amber-100 to-orange-100 dark:from-amber-900/30 dark:to-orange-900/30 border border-amber-200/50 dark:border-amber-700/30 rounded-full mb-4">
          <span class="w-1.5 h-1.5 bg-amber-500 rounded-full animate-pulse"></span>
          <span class="text-xs font-semibold text-amber-700 dark:text-amber-300 uppercase tracking-wider">Simple 4-Step Process</span>
        </div>
        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4">
          How It <span class="bg-gradient-to-r from-amber-600 to-orange-500 dark:from-amber-400 dark:to-orange-400 bg-clip-text text-transparent">Works</span>
        </h2>
        <p class="text-gray-500 dark:text-gray-400 max-w-md mx-auto">
          Start your journey to earning in just four simple steps
        </p>
      </div>

      {{-- Steps Timeline --}}
      <div class="relative">

        {{-- Connecting Line (Desktop) --}}
        <div class="hidden lg:block absolute top-24 left-[12%] right-[12%] h-0.5 bg-gradient-to-r from-amber-200 via-orange-300 to-amber-200 dark:from-amber-800 dark:via-orange-700 dark:to-amber-800"></div>

        {{-- Steps Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-6">

          {{-- Step 1 --}}
          <div class="group relative">
            {{-- Card --}}
            <div class="relative bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm p-6 lg:p-8 border border-gray-100 dark:border-gray-700 shadow-lg shadow-gray-200/50 dark:shadow-none hover:shadow-xl hover:shadow-amber-200/30 dark:hover:shadow-amber-900/20 transition-all duration-500 hover:-translate-y-1">

              {{-- Step Number Badge --}}
              <div class="absolute -top-4 left-6 flex items-center justify-center w-8 h-8 bg-gradient-to-br from-amber-500 to-orange-500 text-white text-xs font-bold shadow-lg shadow-orange-500/30">
                01
              </div>

              {{-- Icon Container --}}
              <div class="relative w-16 h-16 mx-auto mb-6 mt-2">
                <div class="absolute inset-0 bg-gradient-to-br from-amber-100 to-orange-100 dark:from-amber-900/40 dark:to-orange-900/40 rounded-2xl rotate-6 group-hover:rotate-12 transition-transform duration-500"></div>
                <div class="relative w-full h-full bg-white dark:bg-gray-800 rounded-2xl flex items-center justify-center border border-amber-200/50 dark:border-amber-700/50">
                  <span class="material-icons-outlined text-3xl bg-gradient-to-br from-amber-600 to-orange-500 bg-clip-text text-transparent">person_add</span>
                </div>
              </div>

              {{-- Content --}}
              <div class="text-center">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Join Us</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                  Quick sign up via email or phone - completely free
                </p>
              </div>

            </div>

            {{-- Arrow (Mobile/Tablet) --}}
            <div class="flex justify-center my-4 lg:hidden">
              <span class="material-icons-outlined text-amber-400 dark:text-amber-600 text-2xl animate-bounce">keyboard_arrow_down</span>
            </div>
          </div>

          {{-- Step 2 --}}
          <div class="group relative">
            {{-- Card --}}
            <div class="relative bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm p-6 lg:p-8 border border-gray-100 dark:border-gray-700 shadow-lg shadow-gray-200/50 dark:shadow-none hover:shadow-xl hover:shadow-amber-200/30 dark:hover:shadow-amber-900/20 transition-all duration-500 hover:-translate-y-1">

              {{-- Step Number Badge --}}
              <div class="absolute -top-4 left-6 flex items-center justify-center w-8 h-8 bg-gradient-to-br from-amber-500 to-orange-500 text-white text-xs font-bold shadow-lg shadow-orange-500/30">
                02
              </div>

              {{-- Icon Container --}}
              <div class="relative w-16 h-16 mx-auto mb-6 mt-2">
                <div class="absolute inset-0 bg-gradient-to-br from-amber-100 to-orange-100 dark:from-amber-900/40 dark:to-orange-900/40 rounded-2xl rotate-6 group-hover:rotate-12 transition-transform duration-500"></div>
                <div class="relative w-full h-full bg-white dark:bg-gray-800 rounded-2xl flex items-center justify-center border border-amber-200/50 dark:border-amber-700/50">
                  <span class="material-icons-outlined text-3xl bg-gradient-to-br from-amber-600 to-orange-500 bg-clip-text text-transparent">link</span>
                </div>
              </div>

              {{-- Content --}}
              <div class="text-center">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Get Your Link</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                  Create profile & receive your unique affiliate link
                </p>
              </div>

            </div>

            {{-- Arrow (Mobile/Tablet) --}}
            <div class="flex justify-center my-4 lg:hidden">
              <span class="material-icons-outlined text-amber-400 dark:text-amber-600 text-2xl animate-bounce">keyboard_arrow_down</span>
            </div>
          </div>

          {{-- Step 3 --}}
          <div class="group relative">
            {{-- Card --}}
            <div class="relative bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm p-6 lg:p-8 border border-gray-100 dark:border-gray-700 shadow-lg shadow-gray-200/50 dark:shadow-none hover:shadow-xl hover:shadow-amber-200/30 dark:hover:shadow-amber-900/20 transition-all duration-500 hover:-translate-y-1">

              {{-- Step Number Badge --}}
              <div class="absolute -top-4 left-6 flex items-center justify-center w-8 h-8 bg-gradient-to-br from-amber-500 to-orange-500 text-white text-xs font-bold shadow-lg shadow-orange-500/30">
                03
              </div>

              {{-- Icon Container --}}
              <div class="relative w-16 h-16 mx-auto mb-6 mt-2">
                <div class="absolute inset-0 bg-gradient-to-br from-amber-100 to-orange-100 dark:from-amber-900/40 dark:to-orange-900/40 rounded-2xl rotate-6 group-hover:rotate-12 transition-transform duration-500"></div>
                <div class="relative w-full h-full bg-white dark:bg-gray-800 rounded-2xl flex items-center justify-center border border-amber-200/50 dark:border-amber-700/50">
                  <span class="material-icons-outlined text-3xl bg-gradient-to-br from-amber-600 to-orange-500 bg-clip-text text-transparent">share</span>
                </div>
              </div>

              {{-- Content --}}
              <div class="text-center">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Share & Promote</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                  Share products you love on social media & beyond
                </p>
              </div>

            </div>

            {{-- Arrow (Mobile/Tablet) --}}
            <div class="flex justify-center my-4 lg:hidden">
              <span class="material-icons-outlined text-amber-400 dark:text-amber-600 text-2xl animate-bounce">keyboard_arrow_down</span>
            </div>
          </div>

          {{-- Step 4 --}}
          <div class="group relative">
            {{-- Card with Highlight --}}
            <div class="relative bg-gradient-to-br from-amber-50 to-orange-50 dark:from-amber-900/20 dark:to-orange-900/20 p-6 lg:p-8 border border-amber-200 dark:border-amber-700/50 shadow-lg shadow-amber-200/30 dark:shadow-none hover:shadow-xl hover:shadow-amber-300/40 dark:hover:shadow-amber-900/30 transition-all duration-500 hover:-translate-y-1">

              {{-- Step Number Badge --}}
              <div class="absolute -top-4 left-6 flex items-center justify-center w-8 h-8 bg-gradient-to-br from-amber-500 to-orange-500 text-white text-xs font-bold shadow-lg shadow-orange-500/30 ring-2 ring-white dark:ring-gray-900">
                04
              </div>

              {{-- Icon Container --}}
              <div class="relative w-16 h-16 mx-auto mb-6 mt-2">
                <div class="absolute inset-0 bg-gradient-to-br from-amber-200 to-orange-200 dark:from-amber-800/60 dark:to-orange-800/60 rounded-2xl rotate-6 group-hover:rotate-12 transition-transform duration-500"></div>
                <div class="relative w-full h-full bg-white dark:bg-gray-800 rounded-2xl flex items-center justify-center border border-amber-300/50 dark:border-amber-600/50">
                  <span class="material-icons-outlined text-3xl bg-gradient-to-br from-amber-600 to-orange-500 bg-clip-text text-transparent">payments</span>
                </div>
              </div>

              {{-- Content --}}
              <div class="text-center">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Earn Rewards</h3>
                <p class="text-sm text-gray-600 dark:text-gray-300 leading-relaxed">
                  Get up to <span class="font-bold text-amber-600 dark:text-amber-400">40% commission</span> on every sale
                </p>
              </div>

              {{-- Highlight Badge --}}
              <div class="absolute -top-3 -right-2 px-2 py-0.5 bg-gradient-to-r from-amber-500 to-orange-500 text-white text-[10px] font-bold uppercase tracking-wide shadow-lg">
                Best Part
              </div>

            </div>
          </div>

        </div>
      </div>

      {{-- CTA --}}
      <div class="text-center mt-14 lg:mt-16">
        <a href="#join-form"
           class="group inline-flex items-center gap-2 px-8 py-3.5 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white font-semibold rounded-full shadow-lg shadow-orange-500/25 hover:shadow-orange-500/40 transition-all duration-300 hover:scale-105">
          Start Earning Today
          <span class="material-icons-outlined text-lg group-hover:translate-x-1 transition-transform">arrow_forward</span>
        </a>
        <p class="mt-4 text-sm text-gray-400 dark:text-gray-500">No fees • No commitments • Cancel anytime</p>
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
