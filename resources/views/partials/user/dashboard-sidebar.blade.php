@php 

  $user = Auth::user();

@endphp

<div class="dashboard-overlay">&nbsp;</div>
<div class="bb-customer-sidebar-heading">
  <div class="d-flex align-items-center gap-3 p-4">
    <div class="position-relative">
      <div class="wrapper-image">
        <img src="{{ $user->photo ? asset('assets/images/users/'.$user->photo):asset('assets/images/'.$gs->user_image) }}" data-bb-lazy="true"class="rounded-circle border border-2 border-white shadow-sm"loading="lazy"alt="Billy Dicki">
      
      </div>
      <div class="position-absolute bottom-0 end-0 bg-success rounded-circle border border-2 border-white"></div>
    </div>
    <div class="flex-1 min-w-0">
    <div class="name fw-semibold text-truncate"> {{ $user->name ?: $user->phone }}</div>
    <div class="email text-muted small text-truncate"> {{ $user->email ?? null }}</div>
    </div>
  </div>

  <div id="sidebar" class="sidebar-blog">
    <div class="dashbaord-sidebar-close d-xl-none">
      <i class="fas fa-times"></i>
    </div>
    <div class="widget border-0 py-0 widget_categories">
      <ul>
        <li class="px-3">
          <a class="{{ Request::url() == route('user-dashboard') ? 'active' : '' }}"href="{{ route('user-dashboard') }}">
            <i class="fa fa-home mr-2 mx-2"></i> Dashboard </a>
        </li>

        @php
        $referral_user = App\Models\Product::referralUser();
        $completed_order = App\Models\Product::completeOrder();
        $user_affiliated_times = App\Models\User::where('id', Auth::user()->id)->value('reffered_times');
        @endphp

        @if($user_affiliated_times >= 3)
        <li class="px-3">
          <a href="{{ route('vendor.dashboard') }}">
            <i class="fa fa-cash-register mr-2 mx-2"></i>

            {{ __('Pos') }}
          </a>
        </li>

        @endif

        <li class="px-3">
          <a class="{{ Request::url() == route('user-orders') ? 'active' : '' }}"

            href="{{ route('user-orders') }}">
            <i class="fa fa-shopping-bag mr-2 mx-2"></i>

            {{ __('Purchased Items') }}
          </a>
        </li>

        @if($user_affiliated_times >= 3)
        <li class="px-3">
          <a class="{{ Request::url() == route('user-affilate-program') ? 'active' : '' }}"

            href="{{ route('user-affilate-program') }}">
            <i class="fas fa-handshake mr-2 mx-1"></i>

            {{ __('Affiliate Program') }}
          </a>
        </li>

        @endif

        @if($completed_order->count() >= 1)
        <li class="px-3">
          <a class="{{ Request::url() == route('user-referral-link') ? 'active' : '' }}"

            href="{{ route('user-referral-link') }}">
            <i class="fa fa-link mr-2 mx-2"></i>

            {{ __('Referral Link') }}
          </a>
        </li>

        @endif

        <li class="px-3">
          <a class="{{ Request::url() == route('user-message-index') ? 'active' : '' }}"

            href="{{ route('user-message-index') }}">
            <i class="fas fa-ticket-alt mr-2 mx-1"></i>

            {{ __('Tickets') }}
          </a>
        </li>

        <li class="px-3">
          <a class="{{ Request::url() == route('user-address') ? 'active' : '' }}"

            href="{{ route('user-address') }}">
            <i class="fas fa-map-marker-alt mr-2 mx-1"></i>

            {{ __('Address') }}
          </a>
        </li>

        <li class="px-3">
          <a class="{{ Request::url() == route('user-journey') ? 'active' : '' }}"

            href="{{ route('user-journey') }}">
            <i class="fas fa-flag mr-2 mx-1"></i>

            {{ __('Affiliate Journey') }}
          </a>
        </li>

        <li class="px-3">
          <a class="{{ Request::url() == route('user-profile') ? 'active' : '' }}"

            href="{{ route('user-profile') }}">
            <i class="fas fa-edit mr-2 mx-1"></i>

            {{ __('Edit Profile') }}
          </a>
        </li>

        <li class="px-3">
          <a class="{{ Request::url() == route('user-reset') ? 'active' : '' }}"

            href="{{ route('user-reset') }}">
            <i class="fas fa-redo mr-2 mx-1"></i>

            {{ __('Reset Password') }}
          </a>
        </li>

        <li class="px-3">
          <a href="{{ route('user-logout') }}">
            <i class="fas fa-sign-out-alt mr-2 mx-1"></i>

            {{ __('Logout') }}
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>