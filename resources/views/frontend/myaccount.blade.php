@extends('frontend.include.app')

@section('content')
<!-- Main Content -->
<main id="main-content" role="main" class="bg-gray-50 dark:bg-gray-900 min-h-screen">
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
                <div class="w-12 h-12 bg-primary-600 text-white flex items-center justify-center text-xl font-bold uppercase">
                  {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                </div>
              </div>
              <div class="flex-1 min-w-0">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 truncate">
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
               class="account-nav-item active flex items-center justify-between px-4 py-3 text-sm font-medium text-gray-900 dark:text-gray-100 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
              <span>Dashboard</span>
              <span class="material-icons-outlined text-base">chevron_right</span>
            </a>

            <a href="#purchase-history"
               onclick="switchTab('purchase-history'); return false;"
               id="nav-purchase-history"
               class="account-nav-item flex items-center justify-between px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
              <span>Purchase History</span>
            </a>

            <a href="#wishlists"
               onclick="switchTab('wishlists'); return false;"
               id="nav-wishlists"
               class="account-nav-item flex items-center justify-between px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
              <span>Wishlists</span>
            </a>

            <a href="#manage-account"
               onclick="switchTab('manage-account'); return false;"
               id="nav-manage-account"
               class="account-nav-item flex items-center justify-between px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
              <span>Manage Account</span>
            </a>

            <a href="#customer-service"
               onclick="switchTab('customer-service'); return false;"
               id="nav-customer-service"
               class="account-nav-item flex items-center justify-between px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
              <span>Customer Service</span>
            </a>

            <a href="#affiliate"
               onclick="switchTab('affiliate'); return false;"
               id="nav-affiliate"
               class="account-nav-item flex items-center justify-between px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
              <span>Affiliate</span>
            </a>

            <a href="#celigin-points"
               onclick="switchTab('celigin-points'); return false;"
               id="nav-celigin-points"
               class="account-nav-item flex items-center justify-between px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
              <span>CELIGIN Points</span>
            </a>

            <a href="{{ route('user.logout') }}"
               class="account-nav-item flex items-center justify-between px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors border-t border-gray-200 dark:border-gray-700 mt-2">
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
                <span class="material-icons-outlined text-6xl text-gray-400 dark:text-gray-500">card_giftcard</span>
              </div>
              <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">Join CELIGIN CLUB</h2>
              <p class="text-base text-gray-600 dark:text-gray-400 mb-2">
                You currently don't have an Ulta Beauty Rewards® membership. Already signed up in store? Link your
              </p>
              <p class="text-base text-gray-600 dark:text-gray-400 mb-6">
                Member ID so you don't miss out on rewards! Not a member? Join free below.
              </p>
              <a href="{{ route('front.celigin-join-club') }}"
                 class="inline-block px-8 py-3 bg-gray-900 dark:bg-white text-white dark:text-gray-900 text-base font-semibold hover:bg-gray-800 dark:hover:bg-gray-100 transition-colors">
                Join Now
              </a>
            </div>

            <!-- No Purchases Card -->
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-8 text-center">
              <div class="flex justify-center mb-6">
                <svg viewBox="0 0 64 64" class="w-20 h-20" fill="none">
                  <path d="M16 24L32 8L48 24" fill="#F97316" opacity="0.2"/>
                  <path d="M16 24H48L44 56H20L16 24Z" fill="#F97316"/>
                  <circle cx="28" cy="52" r="2" fill="white"/>
                  <circle cx="40" cy="52" r="2" fill="white"/>
                  <path d="M32 8V24" stroke="#F97316" stroke-width="2"/>
                </svg>
              </div>
              <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">No Purchases</h3>
              <p class="text-base text-gray-600 dark:text-gray-400">
                See order details after your first purchase.
              </p>
            </div>

            <!-- Wishlist Card -->
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-8 text-center">
              <div class="flex justify-center mb-6">
                <svg viewBox="0 0 64 64" class="w-20 h-20" fill="none">
                  <path d="M32 52C32 52 8 38 8 22C8 14 14 8 22 8C26 8 30 10 32 14C34 10 38 8 42 8C50 8 56 14 56 22C56 38 32 52 32 52Z" fill="#F97316"/>
                  <path d="M32 52C32 52 8 38 8 22C8 14 14 8 22 8C26 8 30 10 32 14" fill="#EA580C"/>
                </svg>
              </div>
              <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">Wishlist</h3>
              <p class="text-base text-gray-600 dark:text-gray-400">
                Save a product to start tracking your favorites.
              </p>
            </div>

          </div>
        </div>

        <!-- Purchase History Tab -->
        <div id="content-purchase-history" class="tab-content hidden">
          <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-8">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Purchase History</h2>

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
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">My Wishlists</h2>

            <!-- Empty State -->
            <div class="text-center py-12">
              <span class="material-icons-outlined text-6xl text-gray-300 dark:text-gray-600 mb-4">favorite_border</span>
              <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">Your wishlist is empty</h3>
              <p class="text-base text-gray-600 dark:text-gray-400 mb-6">
                Save products you love to your wishlist.
              </p>
              <a href="{{ route('front.index') }}"
                 class="inline-block px-6 py-3 bg-primary-600 text-white text-base font-semibold hover:bg-primary-700 transition-colors">
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
              <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Personal Information</h2>

              <form class="space-y-6 max-w-2xl">
                @csrf

                <div>
                  <label for="name" class="block text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2">
                    Full Name <span class="text-red-600">*</span>
                  </label>
                  <input type="text" id="name" name="name" value="{{ Auth::user()->name ?? '' }}" required
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-colors text-base" />
                </div>

                <div>
                  <label for="email" class="block text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2">
                    Email Address <span class="text-red-600">*</span>
                  </label>
                  <input type="email" id="email" name="email" value="{{ Auth::user()->email ?? '' }}" required
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-colors text-base" />
                </div>

                <div>
                  <label for="phone" class="block text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2">
                    Phone Number <span class="text-red-600">*</span>
                  </label>
                  <input type="tel" id="phone" name="phone" value="{{ Auth::user()->phone ?? '' }}" required
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-colors text-base" />
                </div>

                <div>
                  <button type="submit"
                    class="px-6 py-3 bg-primary-600 text-white text-base font-semibold hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-600 transition-colors">
                    Save Changes
                  </button>
                </div>
              </form>
            </div>

            <!-- Saved Addresses Section -->
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-8">
              <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Saved Addresses</h2>
                @if(Auth::user()->addresses->count() < 3)
                <button
                  type="button"
                  onclick="toggleAddAddressForm()"
                  class="px-4 py-2 bg-primary-600 text-white text-sm font-semibold hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-600 transition-colors">
                  + Add New Address
                </button>
                @endif
              </div>

              @if(Auth::user()->addresses->count() > 0)
                <!-- Address Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4" id="address-cards-container">
                  @foreach(Auth::user()->addresses as $address)
                    <x-address-card
                      :address="$address"
                      :selectable="false"
                      :showActions="true" />
                  @endforeach
                </div>

                <!-- Add Address Form (Hidden) -->
                <div id="add-address-form" class="hidden mt-6 border-t border-gray-200 dark:border-gray-700 pt-6">
                  <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Add New Address</h3>
                  <x-address-form formId="myAccountAddressForm" :showCancel="true" />
                </div>

                <!-- Edit Address Modal/Form (Hidden) -->
                <div id="edit-address-form" class="hidden mt-6 border-t border-gray-200 dark:border-gray-700 pt-6">
                  <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Edit Address</h3>
                  <div id="edit-address-form-content"></div>
                </div>

              @else
                <!-- No Addresses Empty State -->
                <div class="text-center py-12 border-2 border-dashed border-gray-300 dark:border-gray-600">
                  <span class="material-icons-outlined text-6xl text-gray-300 dark:text-gray-600 mb-4">location_on</span>
                  <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">No Saved Addresses</h3>
                  <p class="text-base text-gray-600 dark:text-gray-400 mb-6">
                    Add an address to make checkout faster next time.
                  </p>
                  <button
                    type="button"
                    onclick="toggleAddAddressForm()"
                    class="inline-block px-6 py-3 bg-primary-600 text-white text-base font-semibold hover:bg-primary-700 transition-colors">
                    Add Your First Address
                  </button>
                </div>

                <!-- Add Address Form (Will be shown when clicked) -->
                <div id="add-address-form" class="hidden mt-6 border-t border-gray-200 dark:border-gray-700 pt-6">
                  <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Add New Address</h3>
                  <x-address-form formId="myAccountAddressForm" :showCancel="true" />
                </div>
              @endif

              @if(Auth::user()->addresses->count() >= 3)
                <p class="mt-4 text-sm text-gray-600 dark:text-gray-400 text-center">
                  You've reached the maximum limit of 3 saved addresses. Delete an existing address to add a new one.
                </p>
              @endif
            </div>

          </div>
        </div>

        <!-- Customer Service Tab -->
        <div id="content-customer-service" class="tab-content hidden">
          <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-8">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Customer Service</h2>
            <p class="text-base text-gray-600 dark:text-gray-400 mb-6">
              Need help? Contact our customer service team.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="border border-gray-200 dark:border-gray-700 p-6">
                <span class="material-icons-outlined text-4xl text-primary-700 dark:text-primary-400 mb-4">email</span>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Email Support</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                  Send us an email and we'll respond within 24 hours.
                </p>
                <a href="mailto:{{ $ps->email }}" class="text-primary-700 dark:text-primary-400 hover:text-primary-800 dark:hover:text-primary-300 font-medium">
                  {{ $ps->email }}
                </a>
              </div>

              <div class="border border-gray-200 dark:border-gray-700 p-6">
                <span class="material-icons-outlined text-4xl text-primary-700 dark:text-primary-400 mb-4">phone</span>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Phone Support</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
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
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Affiliate Program</h2>
            <p class="text-base text-gray-600 dark:text-gray-400">
              Join our affiliate program and earn rewards by referring friends and family.
            </p>
          </div>
        </div>

        <!-- CELIGIN Points Tab -->
        <div id="content-celigin-points" class="tab-content hidden">
          <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-8">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">CELIGIN Points</h2>

            <div class="border border-gray-200 dark:border-gray-700 p-8 text-center">
              <div class="mb-4">
                <span class="material-icons-outlined text-6xl text-primary-700 dark:text-primary-400">stars</span>
              </div>
              <p class="text-5xl font-bold text-primary-700 dark:text-primary-400 mb-3">0</p>
              <p class="text-base text-gray-600 dark:text-gray-400">Available Points</p>
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
      item.classList.remove('active', 'bg-gray-50', 'dark:bg-gray-700');
    });

    // Hide all content tabs
    document.querySelectorAll('.tab-content').forEach(content => {
      content.classList.add('hidden');
    });

    // Add active class to clicked nav item
    const activeNav = document.getElementById(`nav-${tabName}`);
    if (activeNav) {
      activeNav.classList.add('active', 'bg-gray-50', 'dark:bg-gray-700');
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

  // Edit Address
  function editAddress(addressId) {
    // Fetch address data and show edit form
    fetch(`/myaccount/addresses/${addressId}/edit`, {
      headers: {
        'X-CSRF-TOKEN': csrfToken,
        'Accept': 'application/json'
      }
    })
    .then(response => response.json())
    .then(data => {
      if (data.address) {
        showEditForm(data.address);
      }
    })
    .catch(error => {
      console.error('Error:', error);
      showToast('Failed to load address details', 'error');
    });
  }

  // Show Edit Form
  function showEditForm(address) {
    const addForm = document.getElementById('add-address-form');
    const editFormContainer = document.getElementById('edit-address-form');
    const editFormContent = document.getElementById('edit-address-form-content');

    // Hide add form
    if (addForm) addForm.classList.add('hidden');

    // Create edit form with populated data
    editFormContent.innerHTML = `
      <form id="editAddressForm" class="space-y-4">
        <input type="hidden" name="address_id" value="${address.id}">

        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Address Type <span class="text-red-600">*</span>
          </label>
          <div class="flex gap-4">
            <label class="flex items-center space-x-2 cursor-pointer">
              <input type="radio" name="type" value="home" ${address.type === 'home' ? 'checked' : ''}
                class="w-4 h-4 text-primary-700 border-gray-300 focus:ring-primary-600" />
              <span class="text-sm text-gray-700 dark:text-gray-300">Home</span>
            </label>
            <label class="flex items-center space-x-2 cursor-pointer">
              <input type="radio" name="type" value="work" ${address.type === 'work' ? 'checked' : ''}
                class="w-4 h-4 text-primary-700 border-gray-300 focus:ring-primary-600" />
              <span class="text-sm text-gray-700 dark:text-gray-300">Work</span>
            </label>
            <label class="flex items-center space-x-2 cursor-pointer">
              <input type="radio" name="type" value="other" ${address.type === 'other' ? 'checked' : ''}
                class="w-4 h-4 text-primary-700 border-gray-300 focus:ring-primary-600" />
              <span class="text-sm text-gray-700 dark:text-gray-300">Other</span>
            </label>
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Full Name <span class="text-red-600">*</span>
          </label>
          <input type="text" name="name" value="${address.name}" required
            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-colors" />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Phone Number <span class="text-red-600">*</span>
          </label>
          <input type="tel" name="phone" value="${address.phone}" required maxlength="15"
            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-colors" />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Address Line 1 <span class="text-red-600">*</span>
          </label>
          <input type="text" name="address_line_1" value="${address.address_line_1}" required
            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-colors" />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Address Line 2
          </label>
          <input type="text" name="address_line_2" value="${address.address_line_2 || ''}"
            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-colors" />
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Pincode <span class="text-red-600">*</span>
            </label>
            <input type="text" name="pincode" value="${address.pincode}" required maxlength="6" pattern="[0-9]{6}"
              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-colors" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              City <span class="text-red-600">*</span>
            </label>
            <input type="text" name="city" value="${address.city}" required readonly
              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-300" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              State <span class="text-red-600">*</span>
            </label>
            <input type="text" name="state" value="${address.state}" required readonly
              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-300" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Country <span class="text-red-600">*</span>
            </label>
            <input type="text" name="country" value="India" readonly
              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-300" />
          </div>
        </div>

        <div class="flex items-start space-x-2">
          <input type="checkbox" name="is_default" value="1" ${address.is_default ? 'checked' : ''}
            class="mt-1 w-4 h-4 text-primary-700 border-gray-300 rounded focus:ring-primary-600" />
          <label class="text-sm text-gray-700 dark:text-gray-300 cursor-pointer">
            Make this my default address
          </label>
        </div>

        <div class="flex gap-3">
          <button type="submit"
            class="px-6 py-2 bg-primary-600 text-white text-sm font-semibold hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-600 transition-colors">
            Update Address
          </button>
          <button type="button" onclick="cancelAddressForm()"
            class="px-6 py-2 bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100 text-sm font-semibold hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors">
            Cancel
          </button>
        </div>
      </form>
    `;

    // Show edit form
    editFormContainer.classList.remove('hidden');

    // Attach submit handler
    document.getElementById('editAddressForm').addEventListener('submit', function(e) {
      e.preventDefault();
      updateAddress(address.id, this);
    });
  }

  // Update Address
  function updateAddress(addressId, form) {
    const formData = new FormData(form);
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn.textContent;
    submitBtn.disabled = true;
    submitBtn.textContent = 'Updating...';

    fetch(`/myaccount/addresses/${addressId}`, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': csrfToken,
        'X-HTTP-Method-Override': 'PUT',
        'Accept': 'application/json'
      },
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      submitBtn.disabled = false;
      submitBtn.textContent = originalText;

      if (data.success || data.message) {
        showToast(data.message || 'Address updated successfully', 'success');
        setTimeout(() => window.location.reload(), 1000);
      } else {
        showToast(data.error || 'Failed to update address', 'error');
      }
    })
    .catch(error => {
      submitBtn.disabled = false;
      submitBtn.textContent = originalText;
      console.error('Error:', error);
      showToast('An error occurred while updating the address', 'error');
    });
  }

  // Delete Address
  function deleteAddress(addressId) {
    if (!confirm('Are you sure you want to delete this address?')) {
      return;
    }

    fetch(`/myaccount/addresses/${addressId}`, {
      method: 'DELETE',
      headers: {
        'X-CSRF-TOKEN': csrfToken,
        'Accept': 'application/json'
      }
    })
    .then(response => response.json())
    .then(data => {
      if (data.success || data.message) {
        showToast(data.message || 'Address deleted successfully', 'success');
        setTimeout(() => window.location.reload(), 1000);
      } else {
        showToast(data.error || 'Failed to delete address', 'error');
      }
    })
    .catch(error => {
      console.error('Error:', error);
      showToast('An error occurred while deleting the address', 'error');
    });
  }

  // Set Default Address
  function setDefaultAddress(addressId) {
    fetch(`/myaccount/addresses/${addressId}/set-default`, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': csrfToken,
        'Accept': 'application/json'
      }
    })
    .then(response => response.json())
    .then(data => {
      if (data.success || data.message) {
        showToast(data.message || 'Default address updated', 'success');
        setTimeout(() => window.location.reload(), 1000);
      } else {
        showToast(data.error || 'Failed to update default address', 'error');
      }
    })
    .catch(error => {
      console.error('Error:', error);
      showToast('An error occurred while updating default address', 'error');
    });
  }

  // Show Toast Notification
  function showToast(message, type = 'success') {
    const backgroundColor = type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : '#f59e0b';

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
    // Set dashboard as default active
    switchTab('dashboard');

    // Attach event listener to add address form
    const addAddressForm = document.getElementById('myAccountAddressForm');
    if (addAddressForm) {
      addAddressForm.addEventListener('submit', function(e) {
        e.preventDefault();
        saveNewAddress(this);
      });
    }
  });

  // Save new address
  function saveNewAddress(form) {
    const formData = new FormData(form);
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn.textContent;
    submitBtn.disabled = true;
    submitBtn.textContent = 'Saving...';

    fetch('{{ route("user.addresses.store") }}', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': csrfToken,
        'Accept': 'application/json'
      },
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      submitBtn.disabled = false;
      submitBtn.textContent = originalText;

      if (data.success || data.message) {
        showToast(data.message || 'Address saved successfully', 'success');
        setTimeout(() => window.location.reload(), 1000);
      } else {
        showToast(data.error || 'Failed to save address', 'error');
      }
    })
    .catch(error => {
      submitBtn.disabled = false;
      submitBtn.textContent = originalText;
      console.error('Error:', error);
      showToast('An error occurred while saving the address', 'error');
    });
  }

  // Fetch pincode details
  function fetchPincodeDetails(formId) {
    const pincodeInput = document.getElementById(`${formId}_pincode`);
    if (!pincodeInput) return;

    const pincode = pincodeInput.value.trim();

    if (pincode.length !== 6 || !/^\d{6}$/.test(pincode)) {
      document.getElementById(`${formId}_city`).value = '';
      document.getElementById(`${formId}_state`).value = '';
      return;
    }

    document.getElementById(`${formId}_city`).value = 'Loading...';
    document.getElementById(`${formId}_state`).value = 'Loading...';

    fetch(`https://api.postalpincode.in/pincode/${pincode}`)
      .then(response => response.json())
      .then(data => {
        if (data[0].Status === 'Success') {
          const post = data[0].PostOffice[0];
          document.getElementById(`${formId}_city`).value = post.District;
          document.getElementById(`${formId}_state`).value = post.State;
          document.getElementById(`${formId}_country`).value = post.Country;
        } else {
          document.getElementById(`${formId}_city`).value = '';
          document.getElementById(`${formId}_state`).value = '';
          showToast('Invalid pincode', 'error');
        }
      })
      .catch(error => {
        console.error('Error fetching pincode details:', error);
        document.getElementById(`${formId}_city`).value = '';
        document.getElementById(`${formId}_state`).value = '';
        showToast('Could not fetch location details', 'error');
      });
  }
</script>
@endsection
