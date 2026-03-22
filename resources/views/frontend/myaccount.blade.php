@extends('frontend.include.app')

@section('content')
<!-- Main Content -->
<main id="main-content" role="main" class="bg-neutral-50 dark:bg-gray-900 min-h-screen">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-8">

    <!-- Breadcrumb Navigation -->
    @include('frontend.include.breadcrumb', ['items' => [
      ['label' => 'Home', 'url' => route('front.index')],
      ['label' => 'My Account']
    ]])

    <!-- Account Page Grid: Sidebar + Content -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8">

      <!-- Left Sidebar: Navigation Menu -->
      <aside class="lg:col-span-3">
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">

          <!-- User Profile Header -->
          <div class="p-6 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center space-x-4">
              <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-primary-800 text-white flex items-center justify-center text-xl font-bold uppercase">
                  {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                </div>
              </div>
              <div class="flex-1 min-w-0">
                <h2 class="text-lg font-semibold text-neutral-900 dark:text-gray-100 truncate">
                  {{ Auth::user()->name ?? 'User' }}
                </h2>
              </div>
            </div>
          </div>

          <!-- Navigation Menu -->
          <nav class="p-2" aria-label="Account navigation">
            <a href="#dashboard"
               onclick="switchTab('dashboard'); return false;"
               id="nav-dashboard"
               class="account-nav-item active flex items-center justify-between px-4 py-3 text-sm font-medium text-neutral-900 dark:text-gray-100 hover:bg-primary-50 dark:hover:bg-gray-700 transition-colors">
              <span>Dashboard</span>
              <span class="material-icons-outlined text-base">chevron_right</span>
            </a>

            <a href="#purchase-history"
               onclick="switchTab('purchase-history'); return false;"
               id="nav-purchase-history"
               class="account-nav-item flex items-center justify-between px-4 py-3 text-sm font-medium text-neutral-700 dark:text-gray-300 hover:bg-primary-50 dark:hover:bg-gray-700 transition-colors">
              <span>Purchase History</span>
            </a>

            <a href="#wishlists"
               onclick="switchTab('wishlists'); return false;"
               id="nav-wishlists"
               class="account-nav-item flex items-center justify-between px-4 py-3 text-sm font-medium text-neutral-700 dark:text-gray-300 hover:bg-primary-50 dark:hover:bg-gray-700 transition-colors">
              <span>Wishlists</span>
            </a>

            <a href="#manage-account"
               onclick="switchTab('manage-account'); return false;"
               id="nav-manage-account"
               class="account-nav-item flex items-center justify-between px-4 py-3 text-sm font-medium text-neutral-700 dark:text-gray-300 hover:bg-primary-50 dark:hover:bg-gray-700 transition-colors">
              <span>Manage Account</span>
            </a>

            <a href="#customer-service"
               onclick="switchTab('customer-service'); return false;"
               id="nav-customer-service"
               class="account-nav-item flex items-center justify-between px-4 py-3 text-sm font-medium text-neutral-700 dark:text-gray-300 hover:bg-primary-50 dark:hover:bg-gray-700 transition-colors">
              <span>Customer Service</span>
            </a>

            <a href="#affiliate"
               onclick="switchTab('affiliate'); return false;"
               id="nav-affiliate"
               class="account-nav-item flex items-center justify-between px-4 py-3 text-sm font-medium text-neutral-700 dark:text-gray-300 hover:bg-primary-50 dark:hover:bg-gray-700 transition-colors">
              <span>Affiliate</span>
            </a>

            <a href="#celigin-points"
               onclick="switchTab('celigin-points'); return false;"
               id="nav-celigin-points"
               class="account-nav-item flex items-center justify-between px-4 py-3 text-sm font-medium text-neutral-700 dark:text-gray-300 hover:bg-primary-50 dark:hover:bg-gray-700 transition-colors">
              <span>CELIGIN Points</span>
            </a>

            <a href="{{ route('user.logout') }}"
               class="account-nav-item flex items-center justify-between px-4 py-3 text-sm font-medium text-semantic-error dark:text-red-400 hover:bg-red-50 dark:hover:bg-gray-700 transition-colors border-t border-gray-200 dark:border-gray-700 mt-2">
              <span>Sign Out</span>
            </a>
          </nav>
        </div>
      </aside>

      <!-- Right Content Area -->
      <div class="lg:col-span-9">

        <!-- Dashboard Tab -->
        <div id="content-dashboard" class="tab-content">
          <div class="space-y-6">

            <!-- Join CELIGIN CLUB Card -->
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-8 text-center">
              <div class="flex justify-center mb-6">
                <span class="material-icons-outlined text-6xl text-primary-600 dark:text-primary-400">card_giftcard</span>
              </div>
              <h2 class="text-2xl font-bold text-neutral-900 dark:text-gray-100 mb-4">Join CELIGIN CLUB</h2>
              <p class="text-base text-neutral-700 dark:text-gray-400 mb-2">
                You currently don't have an Ulta Beauty Rewards® membership. Already signed up in store? Link your
              </p>
              <p class="text-base text-neutral-700 dark:text-gray-400 mb-6">
                Member ID so you don't miss out on rewards! Not a member? Join free below.
              </p>
              <a href="{{ route('front.celigin-join-club') }}"
                 class="inline-block px-8 py-3 bg-primary-800 dark:bg-primary-600 text-white text-base font-semibold hover:bg-primary-900 dark:hover:bg-primary-700 transition-colors shadow-sm hover:shadow-md">
                Join Now
              </a>
            </div>

            <!-- No Purchases Card -->
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-8 text-center">
              <div class="flex justify-center mb-6">
                <svg viewBox="0 0 64 64" class="w-20 h-20" fill="none">
                  <path d="M16 24L32 8L48 24" fill="#5C80E0" opacity="0.2"/>
                  <path d="M16 24H48L44 56H20L16 24Z" fill="#2E4682"/>
                  <circle cx="28" cy="52" r="2" fill="white"/>
                  <circle cx="40" cy="52" r="2" fill="white"/>
                  <path d="M32 8V24" stroke="#2E4682" stroke-width="2"/>
                </svg>
              </div>
              <h3 class="text-xl font-bold text-neutral-900 dark:text-gray-100 mb-2">No Purchases</h3>
              <p class="text-base text-neutral-700 dark:text-gray-400">
                See order details after your first purchase.
              </p>
            </div>

            <!-- Wishlist Card -->
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-8 text-center">
              <div class="flex justify-center mb-6">
                <svg viewBox="0 0 64 64" class="w-20 h-20" fill="none">
                  <path d="M32 52C32 52 8 38 8 22C8 14 14 8 22 8C26 8 30 10 32 14C34 10 38 8 42 8C50 8 56 14 56 22C56 38 32 52 32 52Z" fill="#5C80E0"/>
                  <path d="M32 52C32 52 8 38 8 22C8 14 14 8 22 8C26 8 30 10 32 14" fill="#2E4682"/>
                </svg>
              </div>
              <h3 class="text-xl font-bold text-neutral-900 dark:text-gray-100 mb-2">Wishlist</h3>
              <p class="text-base text-neutral-700 dark:text-gray-400">
                Save a product to start tracking your favorites.
              </p>
            </div>

          </div>
        </div>

        <!-- Purchase History Tab -->
        <div id="content-purchase-history" class="tab-content hidden">
          <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-8">
            <h2 class="text-2xl font-bold text-neutral-900 dark:text-gray-100 mb-6">Purchase History</h2>

            <!-- Empty State -->
            @include('frontend.include.empty-state', [
              'icon' => 'cart',
              'title' => 'No orders yet',
              'message' => 'You haven\'t placed any orders. Start shopping to see your purchase history here.',
              'buttonText' => 'Start Shopping',
              'buttonUrl' => route('front.index')
            ])
          </div>
        </div>

        <!-- Wishlists Tab -->
        <div id="content-wishlists" class="tab-content hidden">
          <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-8">
            <h2 class="text-2xl font-bold text-neutral-900 dark:text-gray-100 mb-6">My Wishlists</h2>

            <!-- Empty State -->
            <div class="text-center py-12">
              <span class="material-icons-outlined text-6xl text-primary-300 dark:text-primary-600 mb-4">favorite_border</span>
              <h3 class="text-xl font-bold text-neutral-900 dark:text-gray-100 mb-2">Your wishlist is empty</h3>
              <p class="text-base text-neutral-700 dark:text-gray-400 mb-6">
                Save products you love to your wishlist.
              </p>
              <a href="{{ route('front.index') }}"
                 class="inline-block px-6 py-3 bg-primary-800 text-white text-base font-semibold hover:bg-primary-900 transition-colors shadow-sm hover:shadow-md">
                Browse Products
              </a>
            </div>
          </div>
        </div>

        <!-- Manage Account Tab -->
        <div id="content-manage-account" class="tab-content hidden">
          <div class="space-y-6">

            <!-- Personal Information Section -->
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-8">
              <h2 class="text-2xl font-bold text-neutral-900 dark:text-gray-100 mb-6">Personal Information</h2>

              <form class="space-y-6 max-w-2xl">
                @csrf

                <div>
                  <label for="name" class="block text-sm font-semibold text-neutral-900 dark:text-gray-100 mb-2">
                    Full Name <span class="text-semantic-error">*</span>
                  </label>
                  <input type="text" id="name" name="name" value="{{ Auth::user()->name ?? '' }}" required
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-neutral-900 dark:text-gray-100 focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-colors text-base" />
                </div>

                <div>
                  <label for="email" class="block text-sm font-semibold text-neutral-900 dark:text-gray-100 mb-2">
                    Email Address <span class="text-semantic-error">*</span>
                  </label>
                  <input type="email" id="email" name="email" value="{{ Auth::user()->email ?? '' }}" required
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-neutral-900 dark:text-gray-100 focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-colors text-base" />
                </div>

                <div>
                  <label for="phone" class="block text-sm font-semibold text-neutral-900 dark:text-gray-100 mb-2">
                    Phone Number <span class="text-semantic-error">*</span>
                  </label>
                  <input type="tel" id="phone" name="phone" value="{{ Auth::user()->phone ?? '' }}" required
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-neutral-900 dark:text-gray-100 focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-colors text-base" />
                </div>

                <div>
                  <button type="submit"
                    class="px-6 py-3 bg-primary-800 text-white text-base font-semibold hover:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-primary-600 transition-colors shadow-sm hover:shadow-md">
                    Save Changes
                  </button>
                </div>
              </form>
            </div>

            <!-- Saved Addresses Section -->
            @php
              $myDeliveryAddresses = Auth::user()->addresses->where('address_category', 'delivery');
              $myDeliveryCount = $myDeliveryAddresses->count();
              $myCanAddAddress = $myDeliveryCount < 3;
            @endphp
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-8">
              <div class="flex items-center justify-between mb-2">
                <div>
                  <h2 class="text-2xl font-bold text-neutral-900 dark:text-gray-100">Saved Addresses</h2>
                  <p class="text-sm text-neutral-700 dark:text-gray-400 mt-0.5">Manage your delivery and billing addresses (Maximum 3 addresses)</p>
                </div>
                @if($myCanAddAddress)
                  <button
                    type="button"
                    onclick="toggleAddAddressForm()"
                    class="px-4 py-2 bg-primary-800 text-white text-sm font-semibold hover:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-primary-600 transition-colors">
                    + Add New Address
                  </button>
                @endif
              </div>

              @if($myDeliveryCount > 0)
                <!-- Address Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6" id="address-cards-container">
                  @foreach($myDeliveryAddresses as $address)
                    <x-address-card
                      :address="$address"
                      :selectable="false"
                      :showActions="true" />
                  @endforeach
                </div>

                <!-- Add Address Form (Hidden) -->
                <div id="add-address-form" class="hidden mt-6 border-t border-gray-200 dark:border-gray-700 pt-6">
                  <h3 class="text-lg font-semibold text-neutral-900 dark:text-gray-100 mb-4">Add New Address</h3>
                  <x-address-form formId="myAccountAddressForm" :showCancel="true" category="delivery" />
                </div>

                <!-- Edit Address Form (Hidden) -->
                <div id="edit-address-form" class="hidden mt-6 border-t border-gray-200 dark:border-gray-700 pt-6">
                  <h3 class="text-lg font-semibold text-neutral-900 dark:text-gray-100 mb-4">Edit Address</h3>
                  <div id="edit-address-form-content"></div>
                </div>

              @else
                <!-- No Addresses Empty State -->
                <div class="text-center py-12 mt-4 border-2 border-dashed border-primary-200 dark:border-gray-600">
                  <span class="material-icons-outlined text-6xl text-primary-300 dark:text-primary-600 mb-4">location_on</span>
                  <h3 class="text-xl font-bold text-neutral-900 dark:text-gray-100 mb-2">No Saved Addresses</h3>
                  <p class="text-base text-neutral-700 dark:text-gray-400 mb-6">
                    Add an address to make checkout faster next time.
                  </p>
                  <button
                    type="button"
                    onclick="toggleAddAddressForm()"
                    class="inline-block px-6 py-3 bg-primary-800 text-white text-base font-semibold hover:bg-primary-900 transition-colors">
                    Add Your First Address
                  </button>
                </div>

                <!-- Add Address Form (Will be shown when clicked) -->
                <div id="add-address-form" class="hidden mt-6 border-t border-gray-200 dark:border-gray-700 pt-6">
                  <h3 class="text-lg font-semibold text-neutral-900 dark:text-gray-100 mb-4">Add New Address</h3>
                  <x-address-form formId="myAccountAddressForm" :showCancel="true" category="delivery" />
                </div>
              @endif

              @if(!$myCanAddAddress)
                <p class="mt-4 text-sm text-neutral-700 dark:text-gray-400 text-center">
                  You've reached the maximum limit of 3 saved addresses. Delete an existing address to add a new one.
                </p>
              @endif
            </div>

          </div>
        </div>

        <!-- Customer Service Tab -->
        <div id="content-customer-service" class="tab-content hidden">
          <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-8">
            <h2 class="text-2xl font-bold text-neutral-900 dark:text-gray-100 mb-6">Customer Service</h2>
            <p class="text-base text-neutral-700 dark:text-gray-400 mb-6">
              Need help? Contact our customer service team.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="border border-gray-200 dark:border-gray-700 p-6 hover:border-primary-300 transition-colors">
                <span class="material-icons-outlined text-4xl text-primary-700 dark:text-primary-400 mb-4 block">email</span>
                <h3 class="text-lg font-semibold text-neutral-900 dark:text-gray-100 mb-2">Email Support</h3>
                <p class="text-sm text-neutral-700 dark:text-gray-400 mb-4">
                  Send us an email and we'll respond within 24 hours.
                </p>
                <a href="mailto:{{ $ps->email }}" class="text-primary-700 dark:text-primary-400 hover:text-primary-800 dark:hover:text-primary-300 font-medium">
                  {{ $ps->email }}
                </a>
              </div>

              <div class="border border-gray-200 dark:border-gray-700 p-6 hover:border-primary-300 transition-colors">
                <span class="material-icons-outlined text-4xl text-primary-700 dark:text-primary-400 mb-4 block">phone</span>
                <h3 class="text-lg font-semibold text-neutral-900 dark:text-gray-100 mb-2">Phone Support</h3>
                <p class="text-sm text-neutral-700 dark:text-gray-400 mb-4">
                  Call us for immediate assistance.
                </p>
                <a href="tel:{{ $ps->phone }}" class="text-primary-700 dark:text-primary-400 hover:text-primary-800 dark:hover:text-primary-300 font-medium">
                  {{ $ps->phone }}
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Affiliate Tab -->
        <div id="content-affiliate" class="tab-content hidden">
          <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-8">
            <h2 class="text-2xl font-bold text-neutral-900 dark:text-gray-100 mb-6">Affiliate Program</h2>
            <p class="text-base text-neutral-700 dark:text-gray-400">
              Join our affiliate program and earn rewards by referring friends and family.
            </p>
          </div>
        </div>

        <!-- CELIGIN Points Tab -->
        <div id="content-celigin-points" class="tab-content hidden">
          <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-8">
            <h2 class="text-2xl font-bold text-neutral-900 dark:text-gray-100 mb-6">CELIGIN Points</h2>

            <div class="border border-primary-200 dark:border-gray-700 p-8 text-center bg-primary-50 dark:bg-gray-700">
              <div class="mb-4">
                <span class="material-icons-outlined text-6xl text-primary-600 dark:text-primary-400">stars</span>
              </div>
              <p class="text-5xl font-bold text-primary-800 dark:text-primary-400 mb-3">0</p>
              <p class="text-base text-neutral-700 dark:text-gray-400">Available Points</p>
            </div>
          </div>
        </div>

      </div>
    </div>

  </div>
</main>
@endsection

@section('scripts')
<script>
  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  function switchTab(tabName) {
    // Remove active class from all nav items
    document.querySelectorAll('.account-nav-item').forEach(item => {
      item.classList.remove('active', 'bg-primary-50', 'dark:bg-gray-700', 'text-primary-800', 'border-l-2', 'border-primary-600');
    });

    // Hide all content tabs
    document.querySelectorAll('.tab-content').forEach(content => {
      content.classList.add('hidden');
    });

    // Add active class to clicked nav item
    const activeNav = document.getElementById(`nav-${tabName}`);
    if (activeNav) {
      activeNav.classList.add('active', 'bg-primary-50', 'dark:bg-gray-700', 'text-primary-800', 'border-l-2', 'border-primary-600');
    }

    // Show selected content
    const activeContent = document.getElementById(`content-${tabName}`);
    if (activeContent) {
      activeContent.classList.remove('hidden');
    }

    // Scroll to top
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }

  // Toggle Add Address Form
  function toggleAddAddressForm() {
    const form = document.getElementById('add-address-form');
    const editForm = document.getElementById('edit-address-form');

    // Hide edit form if open
    if (editForm && !editForm.classList.contains('hidden')) {
      editForm.classList.add('hidden');
    }

    // Toggle add form
    if (form) {
      form.classList.toggle('hidden');
      if (!form.classList.contains('hidden')) {
        document.getElementById('myAccountAddressForm_name').focus();
      }
    }
  }

  // Cancel Address Form
  function cancelAddressForm() {
    const addForm = document.getElementById('add-address-form');
    const editForm = document.getElementById('edit-address-form');

    if (addForm && !addForm.classList.contains('hidden')) {
      addForm.classList.add('hidden');
      document.getElementById('myAccountAddressForm').reset();
    }

    if (editForm && !editForm.classList.contains('hidden')) {
      editForm.classList.add('hidden');
    }
  }

  // Edit Address — fetch data then render inline edit form
  function editAddress(addressId) {
    fetch(`{{ url('/user/addresses') }}/${addressId}/edit`, {
      headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
    })
    .then(r => { if (!r.ok) throw r; return r.json(); })
    .then(data => { if (data.address) showEditForm(data.address); })
    .catch(() => showToast('Failed to load address details', 'error'));
  }

  // Build and show the inline edit form
  function showEditForm(address) {
    const addForm = document.getElementById('add-address-form');
    const editFormContainer = document.getElementById('edit-address-form');
    const editFormContent = document.getElementById('edit-address-form-content');

    if (addForm) addForm.classList.add('hidden');

    const inp = (name, val, extra = '') =>
      `<input type="text" name="${name}" value="${val ?? ''}" ${extra}
        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 text-sm focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-colors" />`;

    const inpRO = (name, id, val) =>
      `<input type="text" id="${id}" name="${name}" value="${val ?? ''}" readonly
        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-300 text-sm" />`;

    const typeRadio = (val, label) =>
      `<label class="flex items-center gap-1.5 cursor-pointer text-sm text-gray-700 dark:text-gray-300">
        <input type="radio" name="type" value="${val}" ${address.type === val ? 'checked' : ''}
          class="w-4 h-4 text-primary-700 border-gray-300 focus:ring-primary-600" />
        ${label}
      </label>`;

    const lbl = (text, req = false) =>
      `<span class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">${text}${req ? ' <span class="text-red-600" aria-hidden="true">*</span>' : ''}</span>`;

    editFormContent.innerHTML = `
      <form id="editAccountAddressForm" class="space-y-4" novalidate>
        <input type="hidden" name="address_id" value="${address.id}">
        <input type="hidden" name="address_category" value="${address.address_category ?? 'delivery'}">

        <div>
          ${lbl('Address Type', true)}
          <div class="flex gap-4">${typeRadio('home','Home')}${typeRadio('work','Work')}${typeRadio('other','Other')}</div>
        </div>

        <div>${lbl('Full Name', true)}${inp('name', address.name, 'required')}</div>

        <div>
          ${lbl('Phone Number', true)}
          <div class="flex">
            <span class="inline-flex items-center px-3 py-2 border border-r-0 border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-600 text-gray-600 dark:text-gray-400 text-sm font-medium select-none">+91</span>
            <input type="tel" name="phone" value="${address.phone ?? ''}" required maxlength="10" minlength="10"
              pattern="[0-9]{10}" inputmode="numeric" placeholder="10-digit number"
              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 text-sm focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-colors" />
          </div>
          <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">10-digit mobile number without country code</p>
        </div>

        <div>
          ${lbl('Pincode', true)}
          <input type="text" name="pincode" id="editAccountAddressForm_pincode" value="${address.pincode ?? ''}"
            required maxlength="6" pattern="[0-9]{6}" inputmode="numeric" placeholder="6-digit pincode"
            onkeyup="fetchPincodeDetails('editAccountAddressForm')"
            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 text-sm focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-colors" />
        </div>

        <div>${lbl('Flat, House no., Building, Company, Apartment', true)}${inp('address_line_1', address.address_line_1, 'required')}</div>
        <div>${lbl('Area, Street, Sector, Village')}${inp('address_line_2', address.address_line_2)}</div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
          <div>${lbl('City / District', true)}${inpRO('city', 'editAccountAddressForm_city', address.city)}</div>
          <div>${lbl('State', true)}${inpRO('state', 'editAccountAddressForm_state', address.state)}</div>
          <div>${lbl('Country')}${inpRO('country', 'editAccountAddressForm_country', address.country ?? 'India')}</div>
        </div>
        <p class="text-xs text-gray-400 dark:text-gray-500 -mt-2">City and state are auto-filled from your pincode</p>

        <div class="flex items-start gap-2">
          <input type="checkbox" name="is_default" value="1" id="edit_is_default" ${address.is_default ? 'checked' : ''}
            class="mt-0.5 w-4 h-4 text-primary-700 border-gray-300 focus:ring-primary-600" />
          <label for="edit_is_default" class="text-sm text-gray-700 dark:text-gray-300 cursor-pointer">Make this my default address</label>
        </div>

        <div class="flex gap-3 pt-1">
          <button type="submit" class="px-6 py-2 bg-primary-800 text-white text-sm font-semibold hover:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-primary-600 transition-colors">
            Update Address
          </button>
          <button type="button" onclick="cancelAddressForm()"
            class="px-6 py-2 bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100 text-sm font-semibold hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors">
            Cancel
          </button>
        </div>
      </form>
    `;

    // Show edit form and attach submit handler
    editFormContainer.classList.remove('hidden');
    document.getElementById('editAccountAddressForm').addEventListener('submit', function(e) {
      e.preventDefault();
      updateAddress(address.id, this);
    });
  }

  // Update Address — PUT /user/addresses/{id}
  function updateAddress(addressId, form) {
    // Build JSON payload — PHP only parses multipart/form-data for POST, not PUT
    const formData = new FormData(form);
    const data = {};
    formData.forEach((value, key) => { if (key !== '_token') data[key] = value; });
    data.is_default = form.querySelector('[name="is_default"]')?.checked ? 1 : 0;

    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn.textContent.trim();
    submitBtn.disabled = true;
    submitBtn.textContent = 'Updating...';

    fetch(`{{ url('/user/addresses') }}/${addressId}`, {
      method: 'PUT',
      headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json', 'Content-Type': 'application/json' },
      body: JSON.stringify(data)
    })
    .then(async r => { const d = await r.json(); if (!r.ok) throw d; return d; })
    .then(data => {
      showToast(data.message || 'Address updated successfully', 'success');
      setTimeout(() => window.location.reload(), 1000);
    })
    .catch(error => {
      submitBtn.disabled = false;
      submitBtn.textContent = originalText;
      const msg = error.errors ? Object.values(error.errors).flat().join('\n') : (error.message || 'Failed to update address');
      showToast(msg, 'error');
    });
  }

  // Delete Address — DELETE /user/addresses/{id}
  function deleteAddress(addressId) {
    if (!confirm('Are you sure you want to delete this address?')) return;

    fetch(`{{ url('/user/addresses') }}/${addressId}`, {
      method: 'DELETE',
      headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
    })
    .then(async r => { const d = await r.json(); if (!r.ok) throw d; return d; })
    .then(data => {
      showToast(data.message || 'Address deleted successfully', 'success');
      setTimeout(() => window.location.reload(), 1000);
    })
    .catch(() => showToast('Failed to delete address', 'error'));
  }

  // Set Default Address — POST /user/addresses/{id}/set-default
  function setDefaultAddress(addressId) {
    fetch(`{{ url('/user/addresses') }}/${addressId}/set-default`, {
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
    })
    .then(async r => { const d = await r.json(); if (!r.ok) throw d; return d; })
    .then(data => {
      showToast(data.message || 'Default address updated', 'success');
      setTimeout(() => window.location.reload(), 1000);
    })
    .catch(() => showToast('Failed to update default address', 'error'));
  }

  // Show Toast Notification
  function showToast(message, type = 'success') {
    const backgroundColor = type === 'success' ? '#059669' : type === 'error' ? '#DC2626' : '#D97706';

    if (typeof Toastify !== 'undefined') {
      Toastify({
        text: message,
        duration: 3000,
        close: true,
        gravity: "top",
        position: "right",
        backgroundColor: backgroundColor
      }).showToast();
    } else {
      alert(message);
    }
  }

  // Handle form submission for adding new address
  document.addEventListener('DOMContentLoaded', function() {
    // Hash → tab ID mapping (supports external links like #account, #points, #support)
    const hashTabMap = {
      'dashboard': 'dashboard',
      'purchase-history': 'purchase-history',
      'wishlists': 'wishlists',
      'manage-account': 'manage-account',
      'account': 'manage-account',
      'customer-service': 'customer-service',
      'support': 'customer-service',
      'affiliate': 'affiliate',
      'celigin-points': 'celigin-points',
      'points': 'celigin-points',
    };

    // Determine tab from URL hash or default to dashboard
    const hash = window.location.hash.replace('#', '');
    const targetTab = hashTabMap[hash] || 'dashboard';
    switchTab(targetTab);

    // Attach event listener to add address form
    const addAddressForm = document.getElementById('myAccountAddressForm');
    if (addAddressForm) {
      addAddressForm.addEventListener('submit', function(e) {
        e.preventDefault();
        saveNewAddress(this);
      });
    }
  });

  // Save new address — POST /user/addresses
  function saveNewAddress(form) {
    const formData = new FormData(form);
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn.textContent.trim();
    submitBtn.disabled = true;
    submitBtn.textContent = 'Saving...';

    fetch('{{ route("user.addresses.store") }}', {
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
      body: formData
    })
    .then(async r => { const d = await r.json(); if (!r.ok) throw d; return d; })
    .then(data => {
      showToast(data.message || 'Address saved successfully', 'success');
      setTimeout(() => window.location.reload(), 1000);
    })
    .catch(error => {
      submitBtn.disabled = false;
      submitBtn.textContent = originalText;
      const msg = error.errors ? Object.values(error.errors).flat().join('\n') : (error.error || 'Failed to save address');
      showToast(msg, 'error');
    });
  }

  // Fetch pincode details — shared by add form and edit form
  function fetchPincodeDetails(formId) {
    const pincodeInput = document.getElementById(`${formId}_pincode`);
    const cityInput    = document.getElementById(`${formId}_city`);
    const stateInput   = document.getElementById(`${formId}_state`);

    if (!pincodeInput || !cityInput || !stateInput) return;

    const pincode = pincodeInput.value.trim();

    if (pincode.length !== 6 || !/^\d{6}$/.test(pincode)) {
      cityInput.value = '';
      stateInput.value = '';
      return;
    }

    cityInput.value  = 'Loading...';
    stateInput.value = 'Loading...';

    fetch(`https://api.postalpincode.in/pincode/${pincode}`)
      .then(r => r.json())
      .then(data => {
        if (data[0]?.Status === 'Success') {
          const po = data[0].PostOffice[0];
          cityInput.value  = po.District ?? '';
          stateInput.value = po.State    ?? '';
          const countryInput = document.getElementById(`${formId}_country`);
          if (countryInput) countryInput.value = po.Country ?? 'India';
        } else {
          cityInput.value  = '';
          stateInput.value = '';
          showToast('Pincode not found. Please enter city and state manually.', 'warning');
        }
      })
      .catch(() => {
        cityInput.value  = '';
        stateInput.value = '';
        showToast('Could not fetch location details. Please try again.', 'error');
      });
  }
</script>
@endsection
