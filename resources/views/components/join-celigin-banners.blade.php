{{--
  Join CELIGIN Banners Component

  Displays two promotional banners: "Join CELIGIN Club" and "Cell For Education"
  Used across: homepage, category pages (best-sellers, new-arrivals, sale, skin-care, my-wishlist)

  Usage:
    <x-join-celigin-banners />

  Props:
    None - displays standard Join Club and Cell Education banners
--}}

<section class="py-12 lg:py-16 bg-white dark:bg-gray-900">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
      {{-- Join CELIGIN Club Banner --}}
      <div class="relative overflow-hidden group cursor-pointer">
        <img src="{{ asset('assets/frontend/images/join-club-banner.png') }}"
          alt="Join CELIGIN Club - Become a Brand Ambassador"
          class="w-full h-64 lg:h-80 object-cover group-hover:scale-105 transition-transform duration-300" />
        <div class="absolute inset-y-0 left-0 w-1/2 flex flex-col justify-center text-left p-6">
          <span
            class="inline-block px-3 py-1 bg-amber-600 dark:bg-amber-500 text-white text-sm font-semibold mb-4 uppercase tracking-wide w-fit">
            JOIN CELIGIN CLUB
          </span>
          <h3 class="text-xl sm:text-2xl lg:text-3xl font-bold text-black dark:text-white mb-6">
            Become a Brand Ambassador
          </h3>
          <a href="{{ url('celigin-join-club') }}"
            class="inline-flex items-center px-4 py-2 bg-amber-600 text-white font-medium hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 w-fit text-sm"
            aria-label="Join CELIGIN Club to become a brand ambassador">
            Join Now
          </a>
        </div>
      </div>

      {{-- Cell For Education Banner --}}
      <div class="relative overflow-hidden group cursor-pointer">
        <img src="{{ asset('assets/frontend/images/cell-education-banner.png') }}"
          alt="Cell For Education - CELIGIN Skincare Products"
          class="w-full h-64 lg:h-80 object-cover group-hover:scale-105 transition-transform duration-300" />
        <div class="absolute inset-x-0 bottom-0 flex items-end justify-between p-6">
          <h3 class="text-xl sm:text-2xl lg:text-3xl font-bold text-black dark:text-white">
            Cell For Education
          </h3>
          <!-- <x-btn href="{{ url('celigin-join-club') }}" size="sm"
            aria-label="Learn more about Cell For Education program">
            Read More
          </x-btn> -->
        </div>
      </div>
    </div>
  </div>
</section>
