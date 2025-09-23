@php
  $phpArray = \App\Models\Product::orderBy('name', 'ASC')->pluck('name');
  //dd($phpArray);
  $jsonArray = json_encode($phpArray);
@endphp
<input type="hidden" id="myPhpValue" value="{{$jsonArray}}" />
<!-- Footer -->
<footer class="bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700 py-12 lg:py-16"
  role="contentinfo">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
      <div class="space-y-4">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Company</h3>
        <div class="space-y-3">
          @if($ps->street != null)
            <address class="text-sm text-gray-600 dark:text-gray-400 not-italic leading-relaxed">
              {{ $ps->street }}
            </address>
          @endif
          <div class="text-sm text-gray-600 dark:text-gray-400">
            @if($ps->phone != null)
              <p class="font-medium text-gray-900">{{ $ps->phone }}</p>
            @endif

            @if($ps->email != null)
              <a href="mailto:info@celiginglobal.com"
                class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors duration-200">{{ $ps->email }}</a>
            @endif
          </div>
        </div>
      </div>

      <div class="space-y-4">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Useful Links</h3>
        <ul class="space-y-2">
          @if($ps->home == 1)
            <li>
              <a href="{{ route('front.index') }}"
                class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors duration-200">{{ __('Home') }}</a>
            </li>
          @endif
          <li>
            <a href="/shop" aria-expanded="false"
              class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors duration-200">Shop</a>
          </li>
          <li>
            <a href="/new-arrivals" aria-expanded="false"
              class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors duration-200">New
              Arrivals</a>
          </li>
          <li>
            <a href="/best-sellers" aria-expanded="false"
              class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors duration-200">Best
              Sellers</a>
          </li>
          <li>
            <a href="/skin-care" aria-expanded="false"
              class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors duration-200">Skin
              Care</a>
          </li>
          <li><a href="/join-celigin-club"
              class="text-sm bg-gradient-to-r from-pink-500 to-orange-500 bg-clip-text text-transparent font-medium hover:from-pink-600 hover:to-orange-600 transition-all duration-200">Join
              CELIGIN CLUB</a></li>
          <li><a href="/sale"
              class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors duration-200">Sale</a>
          </li>
        </ul>
      </div>

      <div class="space-y-4">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Information</h3>
        <ul class="space-y-2">
          <li><a href="/track-your-order"
              class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors duration-200">Track
              Your Order</a></li>
          <li><a href="/shipping"
              class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors duration-200">Shipping
              Info</a></li>
          @foreach(DB::table('pages')->where('footer', '=', 1)->get() as $data)
            <li><a href="{{ route('front.vendor', $data->slug) }}"
                class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors duration-200">{{ $data->title }}</a>
            </li>
          @endforeach
          <li><a href="{{ route('front.blog') }}"
              class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors duration-200">Blog</a>
          </li>
          @if($ps->faq == 1)
            <li>
              <a href="{{ route('front.faq') }}"
                class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors duration-200">{{ __('FAQ') }}</a>
            </li>
          @endif
          @if($ps->contact == 1)
            <li>
              <a href="{{ route('front.contact') }}"
                class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors duration-200">{{ __('Contact Us') }}</a>
            </li>
          @endif
        </ul>
      </div>

      <div class="space-y-4">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Good emails.</h3>
        <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
          Enter your email below to be the first to know about new
          collections and product launches.
        </p>
        <form class="space-y-3" aria-label="Newsletter signup">
          <input type="email" placeholder="Enter your email address" required aria-label="Email address"
            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-800 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors duration-200" />
          <button type="submit"
            class="w-full bg-orange-600 hover:bg-orange-700 focus:ring-orange-500 dark:focus:ring-orange-400 text-white px-4 py-2 rounded-md text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-gray-900 transition-colors duration-200">Subscribe</button>
        </form>
      </div>
    </div>

    <div class="border-t border-gray-200 dark:border-gray-700 mt-12 pt-8">
      <div class="flex flex-col space-y-6">
        <!-- Desktop: 3-column layout | Mobile: stacked rows -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8 items-center">

          <!-- Left Column: Copyright and Social Media - Single Row -->
          <div class="flex flex-col sm:flex-row sm:items-center space-y-3 sm:space-y-0 sm:space-x-6 text-center sm:text-left">
            <!-- Copyright Text -->
            <div class="text-sm text-gray-600 dark:text-gray-400">
              <p>&copy; {{ date('Y') }} CELIGIN • Powered by <a href="https://www.hucpl.com/" target="_blank" rel="noopener noreferrer" class="text-gray-900 dark:text-gray-100 hover:text-orange-600 dark:hover:text-orange-400 transition-colors duration-200 font-medium">HUCPL</a></p>
            </div>

            <!-- Social Media Icons -->
            <div class="flex items-center justify-center sm:justify-start space-x-4">
              @foreach(DB::table('social_links')->where('user_id', 0)->where('status', 1)->get() as $link)
                <a href="{{ $link->link }}" target="_blank" rel="noopener noreferrer"
                  class="text-gray-600 dark:text-gray-400 hover:text-orange-600 dark:hover:text-orange-400 transition-colors duration-200"
                  aria-label="Follow us on {{ strtolower(str_replace(['https://www.', 'https://', '.com', '.in'], '', $link->link)) }}">
                  @if(str_contains($link->link, 'facebook'))
                    <!-- Facebook Icon -->
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                      <path fill-rule="evenodd"
                        d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                        clip-rule="evenodd" />
                    </svg>
                  @elseif(str_contains($link->link, 'instagram'))
                    <!-- Instagram Icon -->
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                      <path fill-rule="evenodd"
                        d="M12.017 0C8.396 0 7.929.01 7.102.048 6.273.088 5.718.222 5.238.42a5.893 5.893 0 0 0-2.126 1.384 5.893 5.893 0 0 0-1.384 2.126C1.53 4.41 1.396 4.965 1.356 5.794.318 6.622.308 7.089.308 12.017c0 4.928.01 5.395.048 6.222.04.829.174 1.384.372 1.864.2.78.478 1.441.923 1.885.444.445 1.105.723 1.885.923.48.198 1.035.332 1.864.372.827.04 1.294.048 6.222.048 4.928 0 5.395-.01 6.222-.048.829-.04 1.384-.174 1.864-.372.78-.2 1.441-.478 1.885-.923.445-.444.723-1.105.923-1.885.198-.48.332-1.035.372-1.864.04-.827.048-1.294.048-6.222 0-4.928-.01-5.395-.048-6.222-.04-.829-.174-1.384-.372-1.864a5.893 5.893 0 0 0-.923-1.885A5.893 5.893 0 0 0 19.5.42C19.02.222 18.465.088 17.636.048 16.808.008 16.341 0 11.413 0h.604zm-.034 5.838a.995.995 0 0 0 0 1.99c2.211 0 4.011 1.8 4.011 4.011s-1.8 4.011-4.011 4.011-4.011-1.8-4.011-4.011c0-.182.012-.358.035-.53a.995.995 0 0 0-1.99 0c-.023.172-.035.348-.035.53 0 3.317 2.704 6.021 6.021 6.021s6.021-2.704 6.021-6.021-2.704-6.021-6.021-6.021z"
                        clip-rule="evenodd" />
                      <path d="m17.338 6.988-.69.001a1.125 1.125 0 1 1 .69-.001z" />
                    </svg>
                  @elseif(str_contains($link->link, 'linkedin'))
                    <!-- LinkedIn Icon -->
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                      <path
                        d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                    </svg>
                  @else
                    <!-- Default Social Icon -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                    </svg>
                  @endif
                </a>
              @endforeach
            </div>
          </div>

          <!-- Center Column: Company Logo -->
          <div class="flex justify-center">
            <a href="{{ route('front.index') }}" aria-label="CELIGIN - Go to homepage" class="block">
              <img src="{{ asset('assets/images/' . $gs->logo) }}" alt="CELIGIN - Premium Cosmetics & Skincare"
                class="h-8 w-auto opacity-80 hover:opacity-100 transition-opacity duration-200" />
            </a>
          </div>

          <!-- Right Column: Payment Methods -->
          <div class="flex items-center justify-center lg:justify-end space-x-3">
            <span class="text-xs text-gray-500 dark:text-gray-400 mr-2 hidden sm:inline">We accept:</span>
            <img src="{{asset('assets/frontend/images/payment-visa.png')}}" alt="Visa" width="40" height="25"
              class="h-6 w-auto opacity-75 hover:opacity-100 transition-opacity duration-200" />
            <img src="{{asset('assets/frontend/images/payment-master.png')}}" alt="Mastercard" width="40" height="25"
              class="h-6 w-auto opacity-75 hover:opacity-100 transition-opacity duration-200" />
            <img src="{{asset('assets/frontend/images/payment-amax.png')}}" alt="American Express" width="40"
              height="25" class="h-6 w-auto opacity-75 hover:opacity-100 transition-opacity duration-200" />
            <img src="{{asset('assets/frontend/images/payment-rupay.png')}}" alt="Rupay" width="40" height="25"
              class="h-6 w-auto opacity-75 hover:opacity-100 transition-opacity duration-200" />
            <img src="{{asset('assets/frontend/images/payment-upi.png')}}" alt="UPI" width="40" height="25"
              class="h-6 w-auto opacity-75 hover:opacity-100 transition-opacity duration-200" />
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<button
  class="fixed bottom-6 right-6 bg-orange-600 text-white p-3 rounded-full shadow-lg hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-all duration-200 z-50 opacity-0 pointer-events-none"
  id="scrollToTop" aria-label="Scroll to top">
  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5">
    <polyline points="18,15 12,9 6,15"></polyline>
  </svg>
</button>

<!-- SwiperJS JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{asset('assets/frontend/js/script.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- Toastify JS -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

</body>

</html>