@extends('frontend.include.app')

@section('head_seo')
  <title>Join Celigin Club — 3 Ways to Earn | Points, Affiliate & Seller</title>
  <meta name="description" content="Join Celigin Club and choose your way to earn — collect loyalty points, earn affiliate commissions up to 40%, or become a seller and grow your business with premium Korean skincare." />
  <meta name="keywords" content="celigin club, earn points, affiliate program, become a seller, korean skincare, earn commission, referral program" />
  <link rel="canonical" href="{{ url()->current() }}" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="Join Celigin Club — 3 Ways to Earn" />
  <meta property="og:description" content="Points. Affiliate. Seller. Three powerful ways to earn with Celigin's premium Korean skincare ecosystem." />
  <meta property="og:url" content="{{ url()->current() }}" />
  <meta property="og:image" content="{{ asset('assets/frontend/images/celigin-affiliate-og.jpg') }}" />
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="Join Celigin Club — 3 Ways to Earn" />
  <meta name="twitter:description" content="Points. Affiliate. Seller. Three powerful ways to earn with Celigin's premium Korean skincare ecosystem." />
@endsection

@section('content')
<main id="main-content" role="main" class="bg-gray-50 dark:bg-gray-900 min-h-screen">

  <a href="#earn-ways" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-50 focus:px-4 focus:py-2 focus:bg-primary-600 focus:text-white">
    Skip to earning options
  </a>

  @php
    // visible: mobile=1 card (center only), tablet sm=3 cards, desktop lg=all 5
    // shadow/grad_h are static strings so Tailwind scanner detects them in production build
    $videoCards = [
      ['src' => 'brand-1.mp4', 'rotate' => '18deg',  'rotateZ' => '-2deg', 'height' => 'h-52 sm:h-64 lg:h-80',       'width' => 'w-36 sm:w-44 lg:w-52', 'visible' => 'hidden lg:block', 'shadow' => 'shadow-lg',  'grad_h' => 'h-20'],
      ['src' => 'brand-2.mp4', 'rotate' => '10deg',  'rotateZ' => '-1deg', 'height' => 'h-56 sm:h-72 lg:h-[22rem]', 'width' => 'w-36 sm:w-44 lg:w-52', 'visible' => 'hidden sm:block', 'shadow' => 'shadow-lg',  'grad_h' => 'h-20'],
      ['src' => 'brand-3.mp4', 'rotate' => '0deg',   'rotateZ' => '0deg',  'height' => 'h-72 sm:h-80 lg:h-96',       'width' => 'w-48 sm:w-48 lg:w-56', 'visible' => 'block',          'shadow' => 'shadow-xl',  'grad_h' => 'h-24', 'center' => true],
      ['src' => 'brand-4.mp4', 'rotate' => '-10deg', 'rotateZ' => '1deg',  'height' => 'h-56 sm:h-72 lg:h-[22rem]', 'width' => 'w-36 sm:w-44 lg:w-52', 'visible' => 'hidden sm:block', 'shadow' => 'shadow-lg',  'grad_h' => 'h-20'],
      ['src' => 'brand-5.mp4', 'rotate' => '-18deg', 'rotateZ' => '2deg',  'height' => 'h-52 sm:h-64 lg:h-80',       'width' => 'w-36 sm:w-44 lg:w-52', 'visible' => 'hidden lg:block', 'shadow' => 'shadow-lg',  'grad_h' => 'h-20'],
    ];

    $levels = [
      ['level' => 1, 'title' => 'Affiliate', 'requirement' => 'Starting level', 'commission' => '10%', 'style' => 'gray'],
      ['level' => 2, 'title' => 'Business Manager', 'requirement' => '3+ referrals', 'commission' => '20%', 'style' => 'gray-dark'],
      ['level' => 3, 'title' => 'Sales Manager', 'requirement' => '₹3L quarterly sales', 'commission' => '30%', 'style' => 'amber'],
      ['level' => 4, 'title' => 'Celigin Partner', 'requirement' => '₹5L quarterly sales', 'commission' => '40%', 'style' => 'gradient', 'top' => true],
    ];

    $faqs = [
      ['id' => 'faq1', 'title' => 'How do I start earning Celigin Points?', 'content' => '<p class="text-gray-600 dark:text-gray-400">Sign in to your account and start shopping or referring friends. Points are automatically credited after each qualifying purchase or successful referral. Visit My Account → Points to track your balance.</p>', 'open' => true],
      ['id' => 'faq2', 'title' => 'Is there any fee to join the Affiliate Program?', 'content' => '<p class="text-gray-600 dark:text-gray-400">No, joining is completely free. No signup fees, no monthly fees, no hidden charges. Submit the form and receive your unique referral link within 24 hours.</p>'],
      ['id' => 'faq3', 'title' => 'How and when do affiliates get paid?', 'content' => '<p class="text-gray-600 dark:text-gray-400">Commissions are paid monthly by the 15th. Minimum payout is ₹500. Track all earnings in your affiliate dashboard.</p>'],
      ['id' => 'faq4', 'title' => 'How do I become a Celigin Seller?', 'content' => '<p class="text-gray-600 dark:text-gray-400">Register for a seller account, list your products, and start selling. Access your seller dashboard to manage inventory, orders, and payouts. Our team will guide you through the onboarding process.</p>'],
      ['id' => 'faq5', 'title' => 'Can I do both Affiliate and Seller at the same time?', 'content' => '<p class="text-gray-600 dark:text-gray-400">Yes! You can combine multiple earning programs. Shop and earn points, refer customers as an affiliate, and sell your own products — all from one account.</p>'],
      ['id' => 'faq6', 'title' => 'How long does the affiliate cookie last?', 'content' => '<p class="text-gray-600 dark:text-gray-400">30 days. If someone clicks your link and buys within 30 days, you earn the commission regardless of when they complete the purchase.</p>'],
    ];

    $inputClass = 'w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 text-sm focus:ring-2 focus:ring-primary-600 focus:border-primary-600 focus:bg-white dark:focus:bg-gray-600 transition-colors';

    $earningCards = [
      [
        'num' => '01',
        'category' => 'Loyalty Program',
        'title' => 'CELIGIN Points',
        'description' => 'Earn points every time you shop or refer a friend. Redeem them for discounts on your next order.',
        'description_html' => false,
        'benefits' => ['Earn on every purchase', 'Refer friends &amp; earn bonus points', 'Redeem as instant discounts'],
        'cta_label' => 'View My Points',
        'cta_href' => route('user.account') . '#points',
        'icon' => 'stars',
        'scheme' => 'blue',
        'featured' => false,
      ],
      [
        'num' => '02',
        'category' => 'Affiliate &amp; Influencer',
        'title' => 'CELIGIN Affiliate',
        'description' => 'Get a unique referral link, share it with your audience, and earn up to <span class="font-bold text-amber-600 dark:text-amber-400">40% commission</span> on every sale.',
        'description_html' => true,
        'benefits' => ['Up to 40% commission per sale', '30-day cookie tracking', 'Monthly payouts from ₹500'],
        'cta_label' => 'Join as Affiliate',
        'cta_href' => '#affiliate-form',
        'icon' => 'link',
        'scheme' => 'amber',
        'featured' => true,
      ],
      [
        'num' => '03',
        'category' => 'Marketplace Seller',
        'title' => 'Become a Seller',
        'description' => 'List your products on Celigin, reach thousands of customers, and run your own online store with ease.',
        'description_html' => false,
        'benefits' => ['List &amp; sell your products', 'Access seller dashboard &amp; analytics', 'Grow your business online'],
        'cta_label' => 'Start Selling',
        'cta_href' => '/vendor/dashboard?tab=purchases',
        'icon' => 'storefront',
        'scheme' => 'emerald',
        'featured' => false,
      ],
    ];
  @endphp

  {{-- ============================================
       SECTION 1: HERO
       Mobile: video first (full-width), content below
       Desktop: content first, video below, stats last
       ============================================ --}}
  <section aria-labelledby="hero-heading" class="bg-gradient-to-b from-amber-50 via-orange-50/50 to-white dark:from-gray-900 dark:via-gray-900 dark:to-gray-800">
    <div class="max-w-7xl mx-auto flex flex-col">

      {{-- Video Gallery — order-1 on mobile (first), order-3 on sm+ (after content) --}}
      <div class="order-1 sm:order-3 w-full overflow-hidden sm:py-4 sm:px-6 lg:px-8" role="region" aria-label="Brand showcase videos">
        <div class="flex items-end justify-center gap-0 sm:gap-3 lg:gap-4 sm:px-4 video-gallery">
          @foreach($videoCards as $index => $card)
            <div class="video-card relative flex-shrink-0 {{ $card['visible'] }} {{ isset($card['center']) ? 'w-full sm:w-48 lg:w-56 h-[56vw] sm:h-80 lg:h-96' : $card['width'] . ' ' . $card['height'] }} {{ $card['shadow'] }} {{ isset($card['center']) ? 'z-10' : '' }} overflow-hidden bg-amber-50 dark:bg-gray-700"
                 data-rotate-y="{{ $card['rotate'] }}" data-rotate-z="{{ $card['rotateZ'] }}"
                 role="img" aria-label="Celigin brand showcase video {{ $index + 1 }} of {{ count($videoCards) }}">
              <video class="w-full h-full object-cover" muted loop playsinline data-video-card aria-hidden="true">
                <source src="{{ asset('assets/frontend/videos/' . $card['src']) }}" type="video/mp4">
              </video>
              <div class="absolute bottom-0 left-0 right-0 {{ $card['grad_h'] }} pointer-events-none video-gradient"></div>
            </div>
          @endforeach
        </div>
      </div>

      {{-- Text content — order-2 on mobile (below video), order-1 on sm+ (first) --}}
      <div class="order-2 sm:order-1 px-4 sm:px-6 lg:px-8 pt-6 sm:pt-4 sm:pb-0 pb-2">

        {{-- Badge --}}
        <div class="flex justify-center mb-2 sm:mb-3">
          <div class="inline-flex items-center gap-2 px-3 py-1 bg-gradient-to-r from-amber-100 to-orange-100 dark:from-amber-900/40 dark:to-orange-900/40 border border-amber-200/60 dark:border-amber-700/40">
            <span class="w-1.5 h-1.5 bg-amber-500 animate-pulse" aria-hidden="true"></span>
            <span class="text-xs font-semibold text-amber-700 dark:text-amber-300 uppercase tracking-wider">3 Ways to Earn</span>
            <span class="w-1.5 h-1.5 bg-amber-500 animate-pulse" aria-hidden="true"></span>
          </div>
        </div>

        {{-- Headline --}}
        <div class="text-center mb-2 sm:mb-3">
          <h1 id="hero-heading" class="text-xl sm:text-2xl lg:text-4xl font-bold leading-snug">
            <span class="text-gray-900 dark:text-white">Join the </span>
            <span class="bg-gradient-to-r from-amber-600 via-orange-500 to-amber-600 dark:from-amber-400 dark:via-orange-400 dark:to-amber-400 bg-clip-text text-transparent">Celigin Club</span>
            <span class="text-gray-900 dark:text-white"> — Pick Your Path</span>
          </h1>
        </div>

        {{-- Subtitle --}}
        <div class="text-center max-w-xl mx-auto mb-3 sm:mb-4">
          <p class="text-sm text-gray-600 dark:text-gray-400">
            Shop & earn points. Share & earn commissions. Sell & build your business.<br class="hidden sm:block">
            One club, three powerful ways to grow with premium Korean skincare.
          </p>
        </div>

        {{-- CTA Button --}}
        <div class="flex justify-center">
          <a href="#earn-ways"
             class="inline-flex items-center gap-1.5 px-5 py-2 sm:px-7 sm:py-2.5 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white text-xs sm:text-sm font-semibold shadow-lg shadow-orange-500/25 hover:shadow-orange-500/40 transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
            Explore All Ways to Earn
            <span class="material-icons-outlined text-base sm:text-lg" aria-hidden="true">arrow_forward</span>
          </a>
        </div>

      </div>

      {{-- Stats Row — always last --}}
      <div class="order-3 sm:order-4 px-4 sm:px-6 lg:px-8 py-5 sm:py-4 flex flex-nowrap justify-center items-center gap-x-3 sm:gap-x-8 lg:gap-x-12 max-w-2xl mx-auto w-full" role="list" aria-label="Program statistics">
        @php
          $stats = [
            ['value' => '3', 'label' => 'Earn Programs', 'highlight' => false],
            ['value' => '500+', 'label' => 'Creators', 'highlight' => false],
            ['value' => '40%', 'label' => 'Upto Commission', 'highlight' => true],
            ['value' => 'Free', 'label' => 'To Join', 'highlight' => false],
          ];
        @endphp
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
       SECTION 2: THREE WAYS TO EARN
       ============================================ --}}
  <section id="earn-ways" aria-labelledby="earn-ways-heading" class="bg-white dark:bg-gray-900 py-14 lg:py-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

      {{-- Section Header --}}
      <div class="text-center mb-10 lg:mb-14">
        <h2 id="earn-ways-heading" class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-3">
          Choose Your <span class="bg-gradient-to-r from-amber-600 to-orange-500 dark:from-amber-400 dark:to-orange-400 bg-clip-text text-transparent">Earning Path</span>
        </h2>
        <p class="text-gray-500 dark:text-gray-400 max-w-md mx-auto text-sm">
          Each program is designed for a different way you engage — pick one or stack them all.
        </p>
      </div>

      {{-- Earning Cards (data-driven) --}}
      <div class="grid grid-cols-1 md:grid-cols-3 gap-5 lg:gap-6">

        @foreach($earningCards as $card)
          @php
            $s = $card['scheme'];
            $schemes = [
              'blue'    => ['card'      => 'from-blue-50 to-indigo-50 dark:from-gray-800 dark:to-gray-800',
                            'border'    => 'border border-blue-100 dark:border-gray-700 hover:border-blue-300 dark:hover:border-blue-600 hover:shadow-xl hover:shadow-blue-200/40 dark:hover:shadow-none',
                            'accent'    => 'from-blue-400 to-indigo-500',
                            'accent_h'  => 'h-1',
                            'icon_bg'   => 'from-blue-100 to-indigo-100 dark:from-blue-900/40 dark:to-indigo-900/40 border-blue-200/50 dark:border-blue-700/30',
                            'icon_text' => 'text-blue-600 dark:text-blue-400',
                            'num'       => 'text-blue-100 dark:text-gray-700',
                            'cat'       => 'text-blue-500 dark:text-blue-400',
                            'check'     => 'text-blue-500 dark:text-blue-400',
                            'cta'       => 'bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-600 focus:ring-blue-500',
                            'cta_extra' => ''],
              'amber'   => ['card'      => 'from-amber-50 to-orange-50 dark:from-gray-800 dark:to-gray-800',
                            'border'    => 'border-2 border-amber-400 dark:border-amber-600 shadow-xl shadow-amber-200/40 dark:shadow-none hover:shadow-2xl hover:shadow-amber-300/50 dark:hover:shadow-none md:-mt-3',
                            'accent'    => 'from-amber-400 via-orange-400 to-amber-500',
                            'accent_h'  => 'h-1.5',
                            'icon_bg'   => 'from-amber-100 to-orange-100 dark:from-amber-900/40 dark:to-orange-900/40 border-amber-200/50 dark:border-amber-700/30',
                            'icon_text' => 'text-amber-600 dark:text-amber-400',
                            'num'       => 'text-amber-100 dark:text-gray-700',
                            'cat'       => 'text-amber-600 dark:text-amber-400',
                            'check'     => 'text-amber-500 dark:text-amber-400',
                            'cta'       => 'bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 shadow-lg shadow-orange-500/30 focus:ring-amber-500',
                            'cta_extra' => ''],
              'emerald' => ['card'      => 'from-emerald-50 to-teal-50 dark:from-gray-800 dark:to-gray-800',
                            'border'    => 'border border-emerald-100 dark:border-gray-700 hover:border-emerald-300 dark:hover:border-emerald-600 hover:shadow-xl hover:shadow-emerald-200/40 dark:hover:shadow-none',
                            'accent'    => 'from-emerald-400 to-teal-500',
                            'accent_h'  => 'h-1',
                            'icon_bg'   => 'from-emerald-100 to-teal-100 dark:from-emerald-900/40 dark:to-teal-900/40 border-emerald-200/50 dark:border-emerald-700/30',
                            'icon_text' => 'text-emerald-600 dark:text-emerald-400',
                            'num'       => 'text-emerald-100 dark:text-gray-700',
                            'cat'       => 'text-emerald-600 dark:text-emerald-400',
                            'check'     => 'text-emerald-500 dark:text-emerald-400',
                            'cta'       => 'bg-emerald-600 hover:bg-emerald-700 dark:bg-emerald-700 dark:hover:bg-emerald-600 focus:ring-emerald-500',
                            'cta_extra' => ''],
            ];
            $sc = $schemes[$s];
          @endphp

          <article class="group relative bg-gradient-to-br {{ $sc['card'] }} {{ $sc['border'] }} transition-all duration-300 flex flex-col"
                   aria-labelledby="card-{{ $loop->index }}-title">

            {{-- Top accent bar --}}
            <div class="{{ $sc['accent_h'] }} bg-gradient-to-r {{ $sc['accent'] }}" aria-hidden="true"></div>

            {{-- Featured badge --}}
            @if($card['featured'])
              <div class="absolute -top-3 left-1/2 -translate-x-1/2 px-3 py-0.5 bg-gradient-to-r from-amber-500 to-orange-500 text-white text-[10px] font-bold uppercase tracking-wider shadow-lg" role="note" aria-label="Most popular program">
                Most Popular
              </div>
            @endif

            <div class="p-6 flex-1 flex flex-col">
              {{-- Icon + Number --}}
              <div class="flex items-start justify-between mb-4" aria-hidden="true">
                <div class="w-12 h-12 bg-gradient-to-br {{ $sc['icon_bg'] }} flex items-center justify-center border">
                  <span class="material-icons-outlined text-2xl {{ $sc['icon_text'] }}">{{ $card['icon'] }}</span>
                </div>
                <span class="text-3xl font-black {{ $sc['num'] }} select-none">{{ $card['num'] }}</span>
              </div>

              {{-- Content --}}
              <div class="mb-5 flex-1">
                <div class="text-[10px] font-bold uppercase tracking-widest {{ $sc['cat'] }} mb-1">{!! $card['category'] !!}</div>
                <h3 id="card-{{ $loop->index }}-title" class="text-lg font-bold text-gray-900 dark:text-white mb-2">{{ $card['title'] }}</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed mb-4">
                  @if($card['description_html'])
                    {!! $card['description'] !!}
                  @else
                    {{ $card['description'] }}
                  @endif
                </p>

                {{-- Benefits list --}}
                <ul class="space-y-1.5" role="list">
                  @foreach($card['benefits'] as $benefit)
                    <li class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
                      <span class="material-icons-outlined {{ $sc['check'] }} text-base flex-shrink-0" aria-hidden="true">check_circle</span>
                      {!! $benefit !!}
                    </li>
                  @endforeach
                </ul>
              </div>

              {{-- CTA --}}
              <a href="{{ $card['cta_href'] }}"
                 class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 {{ $sc['cta'] }} text-white text-sm font-semibold transition-all focus:outline-none focus:ring-2 focus:ring-offset-2">
                {{ $card['cta_label'] }}
                <span class="material-icons-outlined text-base" aria-hidden="true">arrow_forward</span>
              </a>
            </div>
          </article>

        @endforeach
      </div>

      {{-- Compare note --}}
      <p class="text-center text-xs text-gray-400 dark:text-gray-500 mt-6">
        All programs are free to join &nbsp;·&nbsp; No hidden fees &nbsp;·&nbsp; Stack multiple programs for maximum earnings
      </p>

    </div>
  </section>

  {{-- ============================================
       SECTION 3: AFFILIATE HUB (Deep Dive)
       ============================================ --}}
  <section id="affiliate-form" aria-labelledby="affiliate-hub-heading" class="relative bg-gradient-to-b from-gray-50 to-white dark:from-gray-900 dark:to-gray-800 py-14 lg:py-20 overflow-hidden border-t border-gray-200 dark:border-gray-700">

    {{-- Background Decorative Elements --}}
    <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
      <div class="absolute top-0 right-0 w-96 h-96 bg-amber-100/40 dark:bg-amber-900/10 blur-3xl -translate-y-1/2 translate-x-1/2"></div>
      <div class="absolute bottom-0 left-0 w-80 h-80 bg-orange-100/40 dark:bg-orange-900/10 blur-3xl translate-y-1/2 -translate-x-1/2"></div>
    </div>

    <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

      {{-- Section Header --}}
      <div class="text-center mb-10">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-gradient-to-r from-amber-100 to-orange-100 dark:from-amber-900/30 dark:to-orange-900/30 border border-amber-200/50 dark:border-amber-700/30 mb-3">
          <span class="w-1.5 h-1.5 bg-amber-500" aria-hidden="true"></span>
          <span class="text-xs font-semibold text-amber-700 dark:text-amber-300 uppercase tracking-wider">Affiliate Program</span>
        </div>
        <h2 id="affiliate-hub-heading" class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mb-2">
          Your Affiliate <span class="bg-gradient-to-r from-amber-600 to-orange-500 dark:from-amber-400 dark:to-orange-400 bg-clip-text text-transparent">Hub</span>
        </h2>
        <p class="text-sm text-gray-500 dark:text-gray-400">Commission levels, top products, and your registration — all in one place.</p>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-10 items-stretch">

        {{-- LEFT COLUMN: Commission Info & Levels --}}
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-xl shadow-gray-200/50 dark:shadow-none flex flex-col h-full">

          {{-- Header --}}
          <div class="bg-gradient-to-r from-amber-500 to-orange-500 p-5">
            <div class="flex items-center gap-3">
              <div class="w-12 h-12 bg-white/20 backdrop-blur flex items-center justify-center flex-shrink-0" aria-hidden="true">
                <span class="material-icons-outlined text-white text-xl">trending_up</span>
              </div>
              <div>
                <div class="text-xs text-white/80">Earn up to</div>
                <div class="text-2xl font-bold text-white">40% Commission</div>
              </div>
            </div>
          </div>

          {{-- Hot Items to Promote --}}
          @php
            $hotProducts = \App\Models\Product::where('status', 1)
              ->where('best', 1)
              ->select('id', 'name', 'slug', 'photo')
              ->take(5)
              ->get();
          @endphp
          <div class="p-5 border-b border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between mb-3">
              <div class="flex items-center gap-2">
                <span class="material-icons-outlined text-amber-500 text-xl" aria-hidden="true">local_fire_department</span>
                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Hot Items to Promote</h3>
              </div>
              <a href="{{ route('front.sales') }}" class="text-xs font-medium text-amber-600 dark:text-amber-400 hover:underline focus:outline-none focus:ring-2 focus:ring-amber-500">
                View All
              </a>
            </div>
            <div class="flex items-center gap-1.5">
              @forelse($hotProducts as $product)
                <a href="{{ route('front.product', $product->slug) }}" class="group flex-1" title="{{ $product->name }}">
                  <div class="aspect-square bg-gray-100 dark:bg-gray-700 overflow-hidden border border-gray-200 dark:border-gray-600 group-hover:border-amber-400 transition-colors">
                    <img src="{{ asset('assets/images/products/' . $product->photo) }}" alt="{{ $product->name }}" class="w-full h-full object-cover" loading="lazy">
                  </div>
                </a>
              @empty
                <p class="text-xs text-gray-400">No products available</p>
              @endforelse
              @if($hotProducts->count() >= 5)
                <a href="{{ route('front.sales') }}" class="flex-1 aspect-square bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-700 flex items-center justify-center hover:bg-amber-100 dark:hover:bg-amber-900/40 transition-colors" title="View all products">
                  <span class="material-icons-outlined text-amber-600 dark:text-amber-400 text-xl" aria-hidden="true">arrow_forward</span>
                </a>
              @endif
            </div>
          </div>

          {{-- Level Guide --}}
          <div class="p-5 flex-1">
            <div class="flex items-center justify-between mb-3">
              <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Commission Level Guide</h3>
              <span class="text-[10px] text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 px-2 py-0.5">Grow & Earn More</span>
            </div>

            <ul class="space-y-2" role="list">
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
                <li class="flex items-center gap-3 p-2.5 {{ $bgClass }} border {{ isset($level['top']) ? 'relative' : '' }}">
                  @if(isset($level['top']))
                    <div class="absolute -top-1.5 -right-1.5 px-1.5 py-0.5 bg-gradient-to-r from-amber-500 to-orange-500 text-white text-[9px] font-bold uppercase">Top</div>
                  @endif
                  <div class="w-8 h-8 {{ $badgeClass }} flex items-center justify-center text-xs font-bold" aria-hidden="true">{{ $level['level'] }}</div>
                  <div class="flex-1 min-w-0">
                    <div class="text-xs font-semibold text-gray-900 dark:text-white truncate">{{ $level['title'] }}</div>
                    <div class="text-[10px] text-gray-500 dark:text-gray-400 truncate">{{ $level['requirement'] }}</div>
                  </div>
                  <div class="text-base font-bold {{ $textClass }}">{{ $level['commission'] }}</div>
                </li>
              @endforeach
            </ul>

            <p class="text-[10px] text-gray-400 dark:text-gray-500 mt-3 text-center">*Terms & conditions apply</p>
          </div>
        </div>

        {{-- RIGHT COLUMN: Dashboard or Form --}}
        <div class="flex flex-col h-full">
          @auth
            {{-- LOGGED IN: Dashboard --}}
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-xl shadow-gray-200/50 dark:shadow-none flex flex-col h-full">
              <div class="bg-gray-900 dark:bg-gray-700 p-5">
                <h3 class="text-lg font-bold text-white">Your Earnings</h3>
                <p class="text-xs text-gray-300 mt-0.5">Track your affiliate performance</p>
              </div>

              <div class="p-5 flex-1 flex flex-col">
                <div class="grid grid-cols-2 gap-3 mb-4">
                  <div class="bg-gray-50 dark:bg-gray-700 p-3 border border-gray-200 dark:border-gray-600">
                    <div class="text-xs text-gray-500 dark:text-gray-400">Total Earnings</div>
                    <div class="text-xl font-bold text-gray-900 dark:text-white">₹0.00</div>
                  </div>
                  <div class="bg-gradient-to-br from-amber-50 to-orange-50 dark:from-amber-900/20 dark:to-orange-900/20 p-3 border border-amber-200 dark:border-amber-700/30">
                    <div class="text-xs text-gray-500 dark:text-gray-400">Pending</div>
                    <div class="text-xl font-bold text-amber-600 dark:text-amber-400">₹0.00</div>
                  </div>
                </div>

                <div class="mb-4">
                  <label for="referral-link" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1.5">Your Referral Link</label>
                  <div class="flex">
                    <input type="text" id="referral-link" readonly value="{{ url('/') }}?ref={{ auth()->user()->id ?? 'CODE' }}"
                           class="flex-1 px-3 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-100 text-xs" />
                    <button type="button" id="copy-link-btn" aria-label="Copy referral link to clipboard"
                            class="px-3 bg-gray-900 dark:bg-gray-600 text-white hover:bg-gray-800 dark:hover:bg-gray-500 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                      <span class="material-icons-outlined text-base" aria-hidden="true">content_copy</span>
                    </button>
                  </div>
                </div>

                <div class="grid grid-cols-3 gap-2 text-center mb-4">
                  <div class="py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600">
                    <div class="text-lg font-bold text-gray-900 dark:text-white">0</div>
                    <div class="text-[10px] text-gray-500 dark:text-gray-400">Clicks</div>
                  </div>
                  <div class="py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600">
                    <div class="text-lg font-bold text-gray-900 dark:text-white">0</div>
                    <div class="text-[10px] text-gray-500 dark:text-gray-400">Orders</div>
                  </div>
                  <div class="py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600">
                    <div class="text-lg font-bold text-amber-600 dark:text-amber-400">10%</div>
                    <div class="text-[10px] text-gray-500 dark:text-gray-400">Commission</div>
                  </div>
                </div>

                <div class="mt-auto">
                  <a href="#" class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 bg-primary-600 hover:bg-primary-700 text-white text-sm font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    Go to Dashboard
                    <span class="material-icons-outlined text-base" aria-hidden="true">arrow_forward</span>
                  </a>
                </div>
              </div>
            </div>

          @else
            {{-- GUEST: Join Form --}}
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-xl shadow-gray-200/50 dark:shadow-none flex flex-col h-full">
              <div class="bg-gray-900 dark:bg-gray-700 p-5 text-center">
                <h3 class="text-lg font-bold text-white">Join as Affiliate</h3>
                <p class="text-xs text-gray-300 mt-0.5">Start earning in less than 2 minutes</p>
              </div>

              <div class="p-5 flex-1 flex flex-col">
                @if ($errors->any())
                  <div class="mb-4 p-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200" role="alert">
                    <ul class="list-disc list-inside space-y-1 text-xs">
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif

                @if (session('success'))
                  <div class="mb-4 p-3 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200" role="status">
                    <p class="font-medium text-sm">{{ session('success') }}</p>
                  </div>
                @endif

                <form action="{{ route('front.join-now-club-store') }}#affiliate-form" method="POST" class="flex-1 flex flex-col" id="join-form">
                  @csrf
                  <div class="space-y-3 flex-1">
                    <div>
                      <label for="name" class="block text-xs font-medium text-gray-900 dark:text-gray-100 mb-1">
                        Full Name <span class="text-red-500" aria-hidden="true">*</span>
                        <span class="sr-only">(required)</span>
                      </label>
                      <input type="text" id="name" name="name" required value="{{ old('name') }}" autocomplete="name"
                             class="{{ $inputClass }}"
                             placeholder="Your name" />
                    </div>

                    <div>
                      <label for="email" class="block text-xs font-medium text-gray-900 dark:text-gray-100 mb-1">
                        Email <span class="text-red-500" aria-hidden="true">*</span>
                        <span class="sr-only">(required)</span>
                      </label>
                      <input type="email" id="email" name="email" required value="{{ old('email') }}" autocomplete="email"
                             class="{{ $inputClass }}"
                             placeholder="you@example.com" />
                    </div>

                    <div>
                      <label for="phone" class="block text-xs font-medium text-gray-900 dark:text-gray-100 mb-1">
                        Phone <span class="text-red-500" aria-hidden="true">*</span>
                        <span class="sr-only">(required)</span>
                      </label>
                      <input type="tel" id="phone" name="phone" required value="{{ old('phone') }}" autocomplete="tel"
                             class="{{ $inputClass }}"
                             placeholder="Your phone number" pattern="[0-9]{10,15}" />
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                      <div>
                        <label for="instagram" class="block text-xs font-medium text-gray-900 dark:text-gray-100 mb-1">
                          Instagram <span class="text-gray-400 text-[10px]">(Optional)</span>
                        </label>
                        <input type="text" id="instagram" name="instagram_profile_link" value="{{ old('instagram_profile_link') }}"
                               class="{{ $inputClass }}"
                               placeholder="@username" />
                      </div>
                      <div>
                        <label for="youtube" class="block text-xs font-medium text-gray-900 dark:text-gray-100 mb-1">
                          YouTube <span class="text-gray-400 text-[10px]">(Optional)</span>
                        </label>
                        <input type="text" id="youtube" name="youtube_profile_link" value="{{ old('youtube_profile_link') }}"
                               class="{{ $inputClass }}"
                               placeholder="Channel link" />
                      </div>
                    </div>

                    <div class="flex items-start">
                      <input type="checkbox" id="terms" name="terms" required
                             class="w-4 h-4 mt-0.5 text-primary-600 border-gray-300 dark:border-gray-600 focus:ring-primary-600 dark:bg-gray-700" />
                      <label for="terms" class="ml-2 text-xs text-gray-600 dark:text-gray-400">
                        I agree to the <a href="{{ route('terms') }}" class="text-primary-600 dark:text-primary-400 hover:underline focus:outline-none focus:ring-2 focus:ring-primary-500">Terms</a> and <a href="{{ route('privacy') }}" class="text-primary-600 dark:text-primary-400 hover:underline focus:outline-none focus:ring-2 focus:ring-primary-500">Privacy Policy</a>
                      </label>
                    </div>
                  </div>

                  <div class="mt-auto pt-4">
                    <button type="submit"
                            class="w-full px-5 py-3 bg-primary-600 text-white text-sm font-semibold hover:bg-primary-700 transition-colors flex items-center justify-center gap-2 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                      JOIN AS AFFILIATE
                      <span class="material-icons-outlined" aria-hidden="true">chevron_right</span>
                    </button>

                    <p class="text-xs text-gray-500 dark:text-gray-500 text-center mt-3">
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
  <section aria-labelledby="faq-heading" class="bg-gray-50 dark:bg-gray-900 py-14 lg:py-20 border-t border-gray-200 dark:border-gray-700">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-10">
        <h2 id="faq-heading" class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mb-2">
          Frequently Asked Questions
        </h2>
        <p class="text-sm text-gray-500 dark:text-gray-400">Everything you need to know about the Celigin Club programs.</p>
      </div>

      @include('frontend.include.accordion', [
        'id' => 'affiliate-faq',
        'type' => 'default',
        'items' => $faqs
      ])

      <div class="mt-8 text-center">
        <a href="{{ route('front.contact') }}" class="text-primary-600 dark:text-primary-400 font-medium hover:underline focus:outline-none focus:ring-2 focus:ring-primary-500">
          Have more questions? Contact us
        </a>
      </div>
    </div>
  </section>

</main>

{{-- Video Card Styles --}}
<style>
  /* Mobile/tablet: no 3D — only center card shows, display flat */
  .video-card {
    --rotate-y: 0deg;
    --rotate-z: 0deg;
    transform-style: preserve-3d;
    backface-visibility: hidden;
    transform-origin: center bottom;
    transform: none;
    transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.4s ease;
  }
  /* Desktop: apply fan effect */
  @media (min-width: 1024px) {
    .video-card {
      transform: rotateY(var(--rotate-y)) rotateZ(var(--rotate-z)) scale(1);
    }
    .video-card:hover {
      transform: rotateY(0deg) rotateZ(0deg) scale(1.08) !important;
      z-index: 30;
      box-shadow: 0 30px 60px -15px rgba(251, 146, 60, 0.5);
    }
  }
  .video-card.is-playing {
    box-shadow: 0 20px 40px -10px rgba(251, 146, 60, 0.4);
  }
  .video-gradient {
    background: linear-gradient(to top, rgba(0,0,0,0.12) 0%, transparent 100%);
  }
</style>

{{-- Breadcrumb Schema for SEO --}}
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "Home",
      "item": "{{ url('/') }}"
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": "Join Celigin Club",
      "item": "{{ url()->current() }}"
    }
  ]
}
</script>

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

@section('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Video Cards Setup
    const cards = document.querySelectorAll('.video-card');
    const videos = document.querySelectorAll('[data-video-card]');
    const playingVideos = new Set();
    const maxSimultaneous = 2;

    // Set initial transforms via CSS custom properties
    cards.forEach(card => {
      const rotateY = card.dataset.rotateY || '0deg';
      const rotateZ = card.dataset.rotateZ || '0deg';
      card.style.setProperty('--rotate-y', rotateY);
      card.style.setProperty('--rotate-z', rotateZ);
    });

    // Ensure videos are muted (required for autoplay)
    videos.forEach(video => {
      video.muted = true;
      video.playsInline = true;
    });

    function playVideo(video) {
      video.muted = true;
      video.play().then(() => {
        video.parentElement.classList.add('is-playing');
        playingVideos.add(video);
      }).catch(() => {});
    }

    function pauseVideo(video) {
      video.pause();
      video.parentElement.classList.remove('is-playing');
      playingVideos.delete(video);
    }

    function getRandomVideos(count) {
      const arr = Array.from(videos);
      const shuffled = [];
      while (shuffled.length < count && arr.length > 0) {
        const idx = Math.floor(Math.random() * arr.length);
        shuffled.push(arr.splice(idx, 1)[0]);
      }
      return shuffled;
    }

    function playRandomVideos() {
      videos.forEach(video => pauseVideo(video));
      const selectedVideos = getRandomVideos(maxSimultaneous);
      selectedVideos.forEach(video => playVideo(video));
    }

    function scheduleNextRotation() {
      const delay = 4000 + Math.random() * 2000;
      setTimeout(() => {
        playRandomVideos();
        scheduleNextRotation();
      }, delay);
    }

    function initVideos() {
      if (videos.length === 0) return;

      setTimeout(() => {
        playRandomVideos();
        scheduleNextRotation();
      }, 500);

      cards.forEach(card => {
        const video = card.querySelector('[data-video-card]');
        card.addEventListener('mouseenter', () => {
          if (video) playVideo(video);
        });
        card.addEventListener('mouseleave', () => {
          if (video && !playingVideos.has(video)) pauseVideo(video);
        });
      });
    }

    initVideos();

    document.addEventListener('visibilitychange', () => {
      if (document.hidden) {
        videos.forEach(video => video.pause());
      } else {
        playRandomVideos();
      }
    });

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

    @if($errors->any())
      const formSection = document.getElementById('affiliate-form');
      if (formSection) {
        setTimeout(() => {
          formSection.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }, 100);
      }
    @endif

    if (window.location.hash === '#affiliate-form') {
      const formSection = document.getElementById('affiliate-form');
      if (formSection) {
        setTimeout(() => {
          formSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }, 100);
      }
    }
  });
</script>
@endsection
