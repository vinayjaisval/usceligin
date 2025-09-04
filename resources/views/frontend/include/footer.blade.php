

@php
    $phpArray = \App\Models\Product::orderBy('name','ASC')->pluck('name');
    //dd($phpArray);
    $jsonArray = json_encode($phpArray);
@endphp
<input type="hidden" id="myPhpValue" value="{{$jsonArray}}" />
<!-- Footer -->
<footer class="main-footer" role="contentinfo">
  <div class="container">
    <div class="footer-content">
      <div class="footer-section company-info">
        <h3>Company</h3>
        <div class="company-details">
          @if($ps->street != null)
          <address>
            {{ $ps->street }}
          </address>
          @endif
            <p class="phone">
            @if($ps->phone != null)
            <strong>{{ $ps->phone }}</strong><br />

            @endif

            @if($ps->email != null) 
            <a href="mailto:info@celiginglobal.com">{{ $ps->email }}</a>
            @endif
          </p>
        </div>
      </div>

      <div class="footer-section useful-links">
        <h3>Useful Links</h3>
        <ul>
        @if($ps->home == 1)
        <li>
                            <a href="{{ route('front.index') }}">{{ __('Home') }}</a>
                        </li>
          @endif
          <li>
            <a href="/shop" aria-expanded="false">Shop</a>
          </li>
          <li>
            <a href="/new-arrivals" aria-expanded="false">New Arrivals</a>
          </li>
          <li>
            <a href="/best-sellers" aria-expanded="false">Best Sellers</a>
          </li>
          <li>
            <a href="/skin-care" aria-expanded="false">Skin Care</a>
          </li>
          <li><a href="/join-celigin-club" class="gradient-text">Join CELIGIN CLUB</a></li>
          <li><a href="/sale">Sale</a></li>
        </ul>
      </div>

      <div class="footer-section info-links">
        <h3>Information</h3>
        <ul>
          <li><a href="/track-your-order">Track Your Order</a></li>
          <li><a href="/shipping">Shipping Info</a></li>
          <!-- <li><a href="/returns">Returns & Exchanges</a></li> -->
          @foreach(DB::table('pages')->where('footer','=',1)->get() as $data)
          <li><a href="{{ route('front.vendor',$data->slug) }}">{{ $data->title }}</a></li>

          @endforeach
          <!-- <li><a href="/terms">Terms of Service</a></li> -->
          @if($ps->faq == 1)
          <li>
              <a href="{{ route('front.faq') }}">{{ __('FAQ') }}</a>
          </li>
          @endif
          @if($ps->contact == 1)
                        <li>
                            <a href="{{ route('front.contact') }}">{{ __('Contact Us') }}</a>
                        </li>
                        @endif
        </ul>
      </div>

      <div class="footer-section newsletter">
        <h3>Good emails.</h3>
        <p>
          Enter your email below to be the first to know about new
          collections and product launches.
        </p>
        <form class="newsletter-form" aria-label="Newsletter signup">
          <input
            type="email"
            placeholder="Enter your email address"
            required
            aria-label="Email address" />
          <!-- <button type="submit">Subscribe</button> -->
        </form>
      </div>
    </div>

    <div class="footer-bottom">
      <div class="footer-left">
        <p>&copy; 2025 CELIGIN</p>
        <p class="powered-by">
          Powered by
          <a
            href="https://www.hucpl.com/"
            target="_blank"
            rel="noopener noreferrer">HUCPL</a>
        </p>
        <div class="social-links">
        @foreach(DB::table('social_links')->where('user_id',0)->where('status',1)->get() as $link)
                       

                        <a href="{{ $link->link }}" aria-label="Follow us on Facebook" target="_blank" rel="noopener noreferrer">
            <svg
              width="18"
              height="18"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2">
              <path
                d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
            </svg>
            <svg
              width="18"
              height="18"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2">
              <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
              <path
                d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
              <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
            </svg>
            <svg
              width="18"
              height="18"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2">
              <path
                d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path>
              <polygon points="9.75,15.02 15.5,11.75 9.75,8.48"></polygon>
            </svg>

          </a>
                    @endforeach
         
        </div>
      </div>

      <div class="footer-center">
        <div class="footer-logo">
          <a
            href="www.celiginglobal.com"
            aria-label="CELIGIN - Go to homepage">
            <img
              src="{{ asset('assets/images/'.$gs->logo) }}"
              alt="CELIGIN - Premium Cosmetics & Skincare"
              class="logo-img" />
          </a>
        </div>
      </div>

      <div class="footer-right">
        <div class="payment-methods">
          <img
            src="{{asset('assets/frontend/images/payment-visa.png')}}"
            alt="Visa"
            width="40"
            height="25" />
          <img
            src="{{asset('assets/frontend/images/payment-master.png')}}"
            alt="Mastercard"
            width="40"
            height="25" />
          <img
            src="{{asset('assets/frontend/images/payment-amax.png')}}"
            alt="American Express"
            width="40"
            height="25" />
          <img
            src="{{asset('assets/frontend/images/payment-rupay.png')}}"
            alt="Rupay"
            width="40"
            height="25" />
          <img
            src="{{asset('assets/frontend/images/payment-upi.png')}}"
            alt="UPI"
            width="40"
            height="25" />
        </div>
      </div>
    </div>
  </div>
</footer>

<!-- SwiperJS JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{asset('assets/frontend/js/script.js')}}"></script>
</body>

</html>