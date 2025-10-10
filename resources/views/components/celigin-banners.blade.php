{{--
  CELIGIN Promotional Banners Component

  Displays two promotional banners at the bottom of category pages.
  Used across: best-sellers, new-arrivals, sale, skin-care, my-wishlist

  Usage:
    <x-celigin-banners />

  Props:
    None - displays standard Join Club and Cell Education banners
--}}

<section class="join-celigin-banner">
  <div class="container">
    <div class="banner-grid">
      {{-- Join CELIGIN Club Banner --}}
      <div class="celigin-banner join-club">
        <img
          src="{{ asset('assets/frontend/images/join-club-banner.png') }}"
          alt="Join CELIGIN Club - Become a Brand Ambassador"
          class="banner-image"
        />
        <div class="banner-content">
          <span class="badge">JOIN CELIGIN CLUB</span>
          <h3>Become a Brand Ambassador</h3>
          <a href="{{ url('/join') }}" class="banner-btn">Join Now</a>
        </div>
      </div>

      {{-- Cell For Education Banner --}}
      <div class="celigin-banner cta-banner">
        <img
          src="{{ asset('assets/frontend/images/cell-education-banner.png') }}"
          alt="Cell For Education - CELIGIN Skincare Products"
          class="banner-image"
        />
        <div class="banner-content">
          <h3>Cell For Education</h3>
          <a href="{{ url('/education') }}" class="banner-btn secondary">Read More</a>
        </div>
      </div>
    </div>
  </div>
</section>
