@php
  $productsArray = \App\Models\Product::where('status', 1)
    ->orderBy('name', 'ASC')
    ->select('id', 'name', 'slug', 'thumbnail', 'price', 'previous_price')
    ->limit(50) // Limit for performance
    ->get()
    ->map(function($product) {
      return [
        'id' => $product->id,
        'name' => $product->name,
        'slug' => $product->slug,
        'image' => $product->thumbnail ? asset('assets/images/thumbnails/' . $product->thumbnail) : asset('assets/images/noimage.png'),
        'price' => $product->showPrice(),
        'previous_price' => $product->showPreviousPrice()
      ];
    });
  $productsJson = json_encode($productsArray);
@endphp
<input type="hidden" id="myProductsData" value="{{$productsJson}}" />

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

<!-- Header Functionality Scripts -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Initialize desktop search functionality
    initSearch();

    // Initialize mobile/tablet search functionality
    initMobileSearch();
  });

  // Theme Toggle Functionality
  function toggleTheme() {
    const html = document.documentElement;
    const currentTheme = html.classList.contains('dark') ? 'dark' : 'light';
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

    html.classList.toggle('dark');
    localStorage.setItem('theme', newTheme);

    // Update theme toggle icon visibility
    updateThemeIcon();
  }

  function initTheme() {
    const savedTheme = localStorage.getItem('theme');
    const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
    const theme = savedTheme || systemTheme;

    if (theme === 'dark') {
      document.documentElement.classList.add('dark');
    }

    updateThemeIcon();

    // Listen for system theme changes
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
      if (!localStorage.getItem('theme')) {
        if (e.matches) {
          document.documentElement.classList.add('dark');
        } else {
          document.documentElement.classList.remove('dark');
        }
        updateThemeIcon();
      }
    });
  }

  function updateThemeIcon() {
    const isDark = document.documentElement.classList.contains('dark');
    const sunIcon = document.querySelector('.theme-toggle .sun-icon');
    const moonIcon = document.querySelector('.theme-toggle .moon-icon');

    if (sunIcon && moonIcon) {
      if (isDark) {
        sunIcon.style.display = 'block';
        moonIcon.style.display = 'none';
      } else {
        sunIcon.style.display = 'none';
        moonIcon.style.display = 'block';
      }
    }
  }

  // Search Functionality
  function initSearch() {
    const searchInput = document.getElementById('search-input');
    const searchDropdown = document.getElementById('search-dropdown');
    const suggestionsList = document.getElementById('search-suggestions-list');
    const searchBtn = document.getElementById('search-btn');
    let searchTimeout;

    if (!searchInput || !searchDropdown || !suggestionsList) return;

    // Get products data from footer
    const productsData = document.getElementById('myProductsData');
    let products = [];

    if (productsData) {
      try {
        products = JSON.parse(productsData.value);
      } catch (e) {
        console.error('Error parsing products data:', e);
      }
    }

    // Search input handler
    searchInput.addEventListener('input', function() {
      const query = this.value.trim();

      clearTimeout(searchTimeout);

      if (query.length < 2) {
        hideSearchDropdown();
        return;
      }

      searchTimeout = setTimeout(() => {
        performSearch(query, products, suggestionsList, searchDropdown);
      }, 300);
    });

    // Search button handler
    if (searchBtn) {
      searchBtn.addEventListener('click', function() {
        const query = searchInput.value.trim();
        if (query) {
          window.location.href = `/search?q=${encodeURIComponent(query)}`;
        }
      });
    }

    // Form submission handler
    searchInput.closest('form').addEventListener('submit', function(e) {
      e.preventDefault();
      const query = searchInput.value.trim();
      if (query) {
        window.location.href = `/search?q=${encodeURIComponent(query)}`;
      }
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
      if (!searchInput.contains(e.target) && !searchDropdown.contains(e.target)) {
        hideSearchDropdown();
      }
    });

    // Hide dropdown on escape
    searchInput.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        hideSearchDropdown();
      }
    });
  }

  function performSearch(query, products, suggestionsList, dropdown) {
    const filteredProducts = products.filter(product =>
      product.name.toLowerCase().includes(query.toLowerCase())
    ).slice(0, 5);

    suggestionsList.innerHTML = '';

    if (filteredProducts.length > 0) {
      filteredProducts.forEach(product => {
        const item = document.createElement('div');
        item.className = 'flex items-center px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer border-b border-gray-100 dark:border-gray-600 last:border-b-0 transition-colors duration-200';

        // Create product image
        const imageContainer = document.createElement('div');
        imageContainer.className = 'flex-shrink-0 w-12 h-12 mr-3 rounded-md overflow-hidden bg-gray-100';

        const image = document.createElement('img');
        image.src = product.image;
        image.alt = product.name;
        image.className = 'w-full h-full object-cover';
        image.loading = 'lazy';

        // Handle image load errors
        image.onerror = function() {
          this.src = '/assets/images/noimage.png';
        };

        imageContainer.appendChild(image);

        // Create product info container
        const infoContainer = document.createElement('div');
        infoContainer.className = 'flex-1 min-w-0';

        // Product name
        const nameElement = document.createElement('div');
        nameElement.className = 'text-sm font-medium text-gray-900 dark:text-gray-100 truncate';
        nameElement.textContent = product.name;

        // Product price
        const priceContainer = document.createElement('div');
        priceContainer.className = 'flex items-center space-x-2 mt-1';

        const currentPrice = document.createElement('span');
        currentPrice.className = 'text-sm font-semibold text-orange-600 dark:text-orange-400';
        currentPrice.textContent = product.price;

        priceContainer.appendChild(currentPrice);

        // Previous price (if exists and different)
        if (product.previous_price && product.previous_price !== product.price) {
          const previousPrice = document.createElement('span');
          previousPrice.className = 'text-xs text-gray-500 line-through';
          previousPrice.textContent = product.previous_price;
          priceContainer.appendChild(previousPrice);
        }

        infoContainer.appendChild(nameElement);
        infoContainer.appendChild(priceContainer);

        // Assemble the item
        item.appendChild(imageContainer);
        item.appendChild(infoContainer);

        // Add click handler to go to product page
        item.addEventListener('click', function() {
          window.location.href = `/item/${product.slug}`;
        });

        suggestionsList.appendChild(item);
      });

      // Add "View all results" option
      const viewAllItem = document.createElement('div');
      viewAllItem.className = 'flex items-center justify-center px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer text-sm font-medium border-t border-gray-200 dark:border-gray-600 text-orange-600 dark:text-orange-400 transition-colors duration-200';

      const searchIcon = document.createElement('svg');
      searchIcon.className = 'w-4 h-4 mr-2';
      searchIcon.innerHTML = '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>';
      searchIcon.setAttribute('fill', 'none');
      searchIcon.setAttribute('viewBox', '0 0 20 20');

      const textSpan = document.createElement('span');
      textSpan.textContent = `View all results for "${query}"`;

      viewAllItem.appendChild(searchIcon);
      viewAllItem.appendChild(textSpan);

      viewAllItem.addEventListener('click', function() {
        window.location.href = `/search?q=${encodeURIComponent(query)}`;
      });
      suggestionsList.appendChild(viewAllItem);

      showSearchDropdown(dropdown);
    } else {
      // Show "No results found" message
      const noResultsItem = document.createElement('div');
      noResultsItem.className = 'px-4 py-6 text-center text-sm text-gray-500 dark:text-gray-400';
      noResultsItem.innerHTML = `
        <svg class="w-12 h-12 mx-auto mb-3 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.467-.881-6.08-2.33M15 17H9v-2.33A7.963 7.963 0 0115 17z"></path>
        </svg>
        <p class="font-medium">No products found</p>
        <p class="text-xs mt-1">Try searching with different keywords</p>
      `;
      suggestionsList.appendChild(noResultsItem);
      showSearchDropdown(dropdown);
    }
  }

  function showSearchDropdown(dropdown) {
    dropdown.classList.remove('hidden');
  }

  function hideSearchDropdown() {
    const dropdown = document.getElementById('search-dropdown');
    if (dropdown) {
      dropdown.classList.add('hidden');
    }
  }

  // Mobile Search Functionality (Inline dropdown for tablet/mobile)
  function initMobileSearch() {
    const searchInputMobile = document.getElementById('search-input-mobile');
    const searchDropdownMobile = document.getElementById('search-dropdown-mobile');
    const suggestionsListMobile = document.getElementById('search-suggestions-list-mobile');
    const searchBtnMobile = document.getElementById('search-btn-mobile');
    let searchTimeout;

    if (!searchInputMobile || !searchDropdownMobile || !suggestionsListMobile) return;

    // Get products data from footer
    const productsData = document.getElementById('myProductsData');
    let products = [];

    if (productsData) {
      try {
        products = JSON.parse(productsData.value);
      } catch (e) {
        console.error('Error parsing products data:', e);
      }
    }

    // Search input handler
    searchInputMobile.addEventListener('input', function() {
      const query = this.value.trim();

      clearTimeout(searchTimeout);

      if (query.length < 2) {
        hideSearchDropdownMobile();
        return;
      }

      searchTimeout = setTimeout(() => {
        performSearch(query, products, suggestionsListMobile, searchDropdownMobile);
      }, 300);
    });

    // Search button handler
    if (searchBtnMobile) {
      searchBtnMobile.addEventListener('click', function() {
        const query = searchInputMobile.value.trim();
        if (query) {
          window.location.href = `/search?q=${encodeURIComponent(query)}`;
        }
      });
    }

    // Form submission handler
    searchInputMobile.closest('form').addEventListener('submit', function(e) {
      e.preventDefault();
      const query = searchInputMobile.value.trim();
      if (query) {
        window.location.href = `/search?q=${encodeURIComponent(query)}`;
      }
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
      if (!searchInputMobile.contains(e.target) && !searchDropdownMobile.contains(e.target)) {
        hideSearchDropdownMobile();
      }
    });

    // Hide dropdown on escape
    searchInputMobile.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        hideSearchDropdownMobile();
      }
    });
  }

  function hideSearchDropdownMobile() {
    const dropdownMobile = document.getElementById('search-dropdown-mobile');
    if (dropdownMobile) {
      dropdownMobile.classList.add('hidden');
    }
  }

  function createMobileSearchOverlay() {
    const overlay = document.createElement('div');
    overlay.className = 'fixed inset-0 bg-black bg-opacity-50 z-50 lg:hidden';

    const searchContainer = document.createElement('div');
    searchContainer.className = 'bg-white dark:bg-gray-800 m-4 rounded-lg shadow-xl';

    // Header with close button
    const header = document.createElement('div');
    header.className = 'flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-600';

    const title = document.createElement('h2');
    title.className = 'text-lg font-semibold text-gray-900 dark:text-gray-100';
    title.textContent = 'Search Products';

    const closeBtn = document.createElement('button');
    closeBtn.type = 'button';
    closeBtn.className = 'p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 rounded-md';
    closeBtn.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>';

    header.appendChild(title);
    header.appendChild(closeBtn);

    // Search form
    const searchForm = document.createElement('form');
    searchForm.className = 'p-4';

    const searchInput = document.createElement('input');
    searchInput.type = 'search';
    searchInput.placeholder = 'Search products...';
    searchInput.className = 'w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400';

    const searchBtn = document.createElement('button');
    searchBtn.type = 'submit';
    searchBtn.className = 'w-full mt-3 px-4 py-3 bg-orange-600 text-white rounded-lg hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 font-medium';
    searchBtn.textContent = 'Search Products';

    searchForm.appendChild(searchInput);
    searchForm.appendChild(searchBtn);

    // Results container
    const resultsContainer = document.createElement('div');
    resultsContainer.className = 'max-h-60 overflow-y-auto';
    resultsContainer.id = 'mobile-search-results';

    searchContainer.appendChild(header);
    searchContainer.appendChild(searchForm);
    searchContainer.appendChild(resultsContainer);
    overlay.appendChild(searchContainer);

    // Get products data
    const productsData = document.getElementById('myProductsData');
    let products = [];
    if (productsData) {
      try {
        products = JSON.parse(productsData.value);
      } catch (e) {
        console.error('Error parsing products data:', e);
      }
    }

    // Mobile search functionality
    let mobileSearchTimeout;
    searchInput.addEventListener('input', function() {
      const query = this.value.trim();

      clearTimeout(mobileSearchTimeout);

      if (query.length < 2) {
        resultsContainer.innerHTML = '';
        return;
      }

      mobileSearchTimeout = setTimeout(() => {
        performMobileSearch(query, products, resultsContainer);
      }, 300);
    });

    // Event handlers
    searchForm.addEventListener('submit', function(e) {
      e.preventDefault();
      const query = searchInput.value.trim();
      if (query) {
        window.location.href = `/search?q=${encodeURIComponent(query)}`;
      }
    });

    closeBtn.addEventListener('click', function() {
      document.body.removeChild(overlay);
    });

    overlay.addEventListener('click', function(e) {
      if (e.target === overlay) {
        document.body.removeChild(overlay);
      }
    });

    document.body.appendChild(overlay);
    searchInput.focus();
  }

  function performMobileSearch(query, products, container) {
    const filteredProducts = products.filter(product =>
      product.name.toLowerCase().includes(query.toLowerCase())
    ).slice(0, 8);

    container.innerHTML = '';

    if (filteredProducts.length > 0) {
      filteredProducts.forEach(product => {
        const item = document.createElement('div');
        item.className = 'flex items-center px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer border-b border-gray-100 dark:border-gray-600 last:border-b-0';

        const imageContainer = document.createElement('div');
        imageContainer.className = 'flex-shrink-0 w-14 h-14 mr-3 rounded-lg overflow-hidden bg-gray-100';

        const image = document.createElement('img');
        image.src = product.image;
        image.alt = product.name;
        image.className = 'w-full h-full object-cover';
        image.loading = 'lazy';

        image.onerror = function() {
          this.src = '/assets/images/noimage.png';
        };

        imageContainer.appendChild(image);

        const infoContainer = document.createElement('div');
        infoContainer.className = 'flex-1 min-w-0';

        const nameElement = document.createElement('div');
        nameElement.className = 'text-sm font-medium text-gray-900 dark:text-gray-100 truncate';
        nameElement.textContent = product.name;

        const priceContainer = document.createElement('div');
        priceContainer.className = 'flex items-center space-x-2 mt-1';

        const currentPrice = document.createElement('span');
        currentPrice.className = 'text-sm font-semibold text-orange-600 dark:text-orange-400';
        currentPrice.textContent = product.price;

        priceContainer.appendChild(currentPrice);

        if (product.previous_price && product.previous_price !== product.price) {
          const previousPrice = document.createElement('span');
          previousPrice.className = 'text-xs text-gray-500 line-through';
          previousPrice.textContent = product.previous_price;
          priceContainer.appendChild(previousPrice);
        }

        infoContainer.appendChild(nameElement);
        infoContainer.appendChild(priceContainer);

        item.appendChild(imageContainer);
        item.appendChild(infoContainer);

        item.addEventListener('click', function() {
          window.location.href = `/item/${product.slug}`;
        });

        container.appendChild(item);
      });
    } else if (query.length >= 2) {
      const noResultsItem = document.createElement('div');
      noResultsItem.className = 'px-4 py-8 text-center text-sm text-gray-500 dark:text-gray-400';
      noResultsItem.innerHTML = `
        <svg class="w-16 h-16 mx-auto mb-4 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.467-.881-6.08-2.33M15 17H9v-2.33A7.963 7.963 0 0115 17z"></path>
        </svg>
        <p class="font-medium text-base mb-2">No products found</p>
        <p class="text-xs">Try searching with different keywords</p>
      `;
      container.appendChild(noResultsItem);
    }
  }

  // Update Cart Count
  function updateCartCount(count) {
    const cartCountElement = document.getElementById('cart-count');
    if (cartCountElement) {
      cartCountElement.textContent = count;
      cartCountElement.setAttribute('aria-label', `${count} items in cart`);
    }
  }

  // Update Wishlist Count
  function updateWishlistCount(count) {
    const wishlistCountElement = document.getElementById('wishlist-count');
    if (wishlistCountElement) {
      wishlistCountElement.textContent = count;
      wishlistCountElement.setAttribute('aria-label', `${count} items in wishlist`);
    }
  }

  // Promo Code Copy Function
  function copyPromoCode(element) {
    const code = element.getAttribute('data-code');

    if (navigator.clipboard && window.isSecureContext) {
      navigator.clipboard.writeText(code)
        .then(() => {
          if (typeof toastr !== 'undefined') {
            toastr.success(`Promo code copied: ${code}`);
          } else {
            alert(`Promo code copied: ${code}`);
          }
        })
        .catch(() => {
          fallbackCopy(code);
        });
    } else {
      fallbackCopy(code);
    }
  }

  function fallbackCopy(code) {
    const textarea = document.createElement('textarea');
    textarea.value = code;
    textarea.style.position = 'fixed';
    textarea.style.opacity = '0';
    document.body.appendChild(textarea);
    textarea.select();

    try {
      document.execCommand('copy');
      if (typeof toastr !== 'undefined') {
        toastr.success(`Promo code copied: ${code}`);
      } else {
        alert(`Promo code copied: ${code}`);
      }
    } catch (err) {
      console.error('Copy failed:', err);
      if (typeof toastr !== 'undefined') {
        toastr.error('Failed to copy promo code');
      } else {
        alert('Failed to copy promo code');
      }
    } finally {
      document.body.removeChild(textarea);
    }
  }
</script>

</body>

</html>