@php
  $phpArray = \App\Models\Product::orderBy('name', 'ASC')->pluck('name');
  //dd($phpArray);
  $jsonArray = json_encode($phpArray);
@endphp
<input type="hidden" id="myPhpValue" value="{{$jsonArray}}" />

<!-- Footer -->
<footer class="bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700 py-12 lg:py-16"
  role="contentinfo">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 overflow-hidden">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
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
            class="w-full max-w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-800 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors duration-200 min-w-0" />
          <button type="submit"
            class="w-full bg-orange-600 hover:bg-orange-700 focus:ring-orange-500 dark:focus:ring-orange-400 text-white px-4 py-2 rounded-md text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-gray-900 transition-colors duration-200">Subscribe</button>
        </form>
      </div>
    </div>

    <div class="border-t border-gray-200 dark:border-gray-700 mt-12 pt-8">
      <div class="flex flex-col space-y-6">
        <!-- Desktop: 3-column layout | Mobile: stacked rows -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 lg:gap-6 items-center">

          <!-- Left Column: Copyright and Social Media - Mobile Left Aligned -->
          <div
            class="flex flex-col sm:flex-row sm:items-center space-y-3 sm:space-y-0 sm:space-x-4 text-left">
            <!-- Copyright Text -->
            <div class="text-sm text-gray-600 dark:text-gray-400 flex-shrink-0">
              <p>&copy; {{ date('Y') }} CELIGIN • Powered by <a href="https://www.hucpl.com/" target="_blank"
                  rel="noopener noreferrer"
                  class="text-gray-900 dark:text-gray-100 hover:text-orange-600 dark:hover:text-orange-400 transition-colors duration-200 font-medium">HUCPL</a>
              </p>
            </div>

            <!-- Social Media Icons -->
            <div class="flex items-center justify-start space-x-3 flex-shrink-0">
              @foreach(DB::table('social_links')->where('user_id', 0)->where('status', 1)->get() as $link)
                <a href="{{ $link->link }}" target="_blank" rel="noopener noreferrer"
                  class="text-gray-600 dark:text-gray-400 hover:text-orange-600 dark:hover:text-orange-400 transition-colors duration-200"
                  aria-label="Follow us on {{ strtolower(str_replace(['https://www.', 'https://', '.com', '.in'], '', $link->link)) }}">
                  @if(str_contains($link->link, 'facebook'))
                    <!-- Facebook Icon -->
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                      <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                    </svg>
                  @elseif(str_contains($link->link, 'instagram'))
                    <!-- Instagram Icon -->
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                      <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                      <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                      <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                    </svg>
                  @elseif(str_contains($link->link, 'linkedin'))
                    <!-- LinkedIn Icon -->
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                      <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                      <rect x="2" y="9" width="4" height="12"></rect>
                      <circle cx="4" cy="4" r="2"></circle>
                    </svg>
                  @else
                    <!-- Default Social Icon -->
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                    </svg>
                  @endif
                </a>
              @endforeach
            </div>
          </div>

          <!-- Center Column: Company Logo -->
          <div class="flex justify-start lg:justify-center">
            <a href="{{ route('front.index') }}" aria-label="CELIGIN - Go to homepage" class="block">
              <img src="{{ asset('assets/images/' . $gs->logo) }}" alt="CELIGIN - Premium Cosmetics & Skincare"
                class="h-5 w-auto opacity-80 hover:opacity-100 transition-opacity duration-200" />
            </a>
          </div>

          <!-- Right Column: Payment Methods -->
          <div class="flex items-center justify-start lg:justify-end space-x-2 overflow-x-auto">
            <img src="{{asset('assets/frontend/images/payment-visa.png')}}" alt="Visa"
              class="h-5 w-auto flex-shrink-0 opacity-75 hover:opacity-100 transition-opacity duration-200" />
            <img src="{{asset('assets/frontend/images/payment-master.png')}}" alt="Mastercard"
              class="h-5 w-auto flex-shrink-0 opacity-75 hover:opacity-100 transition-opacity duration-200" />
            <img src="{{asset('assets/frontend/images/payment-amax.png')}}" alt="American Express"
              class="h-5 w-auto flex-shrink-0 opacity-75 hover:opacity-100 transition-opacity duration-200" />
            <img src="{{asset('assets/frontend/images/payment-rupay.png')}}" alt="Rupay"
              class="h-5 w-auto flex-shrink-0 opacity-75 hover:opacity-100 transition-opacity duration-200" />
            <img src="{{asset('assets/frontend/images/payment-upi.png')}}" alt="UPI"
              class="h-5 w-auto flex-shrink-0 opacity-75 hover:opacity-100 transition-opacity duration-200" />
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