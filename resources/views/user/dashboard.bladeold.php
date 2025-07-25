@extends('layouts.front')
@section('css')
    <link rel="stylesheet" href="{{asset('assets/front/css/datatables.css')}}">
@endsection
@section('content')
@include('partials.global.common-header')
<!-- breadcrumb -->
<div class="container my-5">
  <div class="row text-center">
  @php
    $user = Auth::user();

    // Count completed orders
    $completedOrdersCount = $user->orders()->where('payment_status', 'Completed')->count();

    // Get all orders where this user is in affilate_users (you need to fix this condition — see note below)
    $ordersWithAffiliate = App\Models\Order::where('status', 'completed')
        ->where('affilate_user', $user->id) // assumes affilate_users is JSON string
        ->get();

    $affiliateOrdersCount = $ordersWithAffiliate->count();
   

    // Sum of all affiliate order payments
    $totalPrice = $ordersWithAffiliate->sum('pay_amount');
    $convertedTotal = (float) App\Models\Product::vendorConvertPrice($totalPrice);
    @endphp


    <!-- User -->
    <div class="col-md-3 mb-4">
      <div class="card shadow-sm h-100">
        <div class="card-body d-flex flex-column justify-content-center">
          <h5 class="card-title">User</h5>
          <div class="d-flex align-items-center justify-content-center gap-2">
            @if ($completedOrdersCount <= 0)
              <p class="card-text mb-0">Welcome! Make your first purchase to get your referral link and start earning.</p>
            @else
              <p class="card-text mb-0">
                You’ve completed {{ $affiliateOrdersCount }} Referral
                Complete {{ 3 - $affiliateOrdersCount }} more to unlock your Affiliate status!
              </p>
              <span style="font-size: 1.5rem; color: #0dcaf0; user-select: none;">➡️</span>
            @endif
          </div>
        </div>
      </div>
    </div>

    <!-- Become Affiliate -->
    <div class="col-md-3 mb-4">
      <div class="card shadow-sm h-100">
        <div class="card-body d-flex flex-column justify-content-center">
          <h5 class="card-title"> Affiliate User</h5>
          <div class="d-flex align-items-center justify-content-center gap-2">
            @if ($completedOrdersCount <= 3)
              <p class="card-text mb-0">You’re eligible to become an affiliate. Start earning now!</p>
              <span style="font-size: 1.5rem; color: #0d6efd; user-select: none;">➡️</span>
          
              @else
              <p class="card-text mb-0">
              You’re not yet eligible for Affiliate status complete {{ 3 - $affiliateOrdersCount }} successful referrals to unlock it.
              </p>
              <span style="font-size: 1.5rem; color: #0dcaf0; user-select: none;">➡️</span>
            @endif
          </div>
        </div>
      </div>
    </div>

    <!-- Business Manager -->
    <div class="col-md-3 mb-4">
      <div class="card shadow-sm h-100">
        <div class="card-body d-flex flex-column justify-content-center">
          <h5 class="card-title">Business Manager</h5>
          <div class="d-flex align-items-center justify-content-center gap-2">
            @if ($totalPrice < 50000)
              <p class="card-text mb-0">
              BMs have POS to increase sales, earn commissions, and reach the ₹{{ 50000 - $totalPrice }} quarterly target.
              </p>
              <span style="font-size: 1.5rem; color: #0d6efd; user-select: none;">➡️</span>
            @elseif ($totalPrice >= 50000 && $totalPrice < 100000)
              <p class="card-text mb-0">You are now a Business Manager. Access new tools and perks.</p>
            @else
              <p class="card-text mb-0">Congratulations! You are a Celigin Partner.</p>
            @endif
          </div>
        </div>
      </div>
    </div>

    <!-- Celigin Partner -->
    <div class="col-md-3 mb-4">
      <div class="card shadow-sm h-100">
        <div class="card-body d-flex flex-column justify-content-center">
          <h5 class="card-title">Celigin Partner</h5>
          <p class="card-text">
            @if ($totalPrice >= 100000)
            Celigin Partners use POS, grow their network, and earn extra incentives by achieving the ₹5,00,000 quarterly target.
            @else
            Celigin Partners use POS, grow their network, and earn extra incentives by achieving the ₹5,00,000 quarterly target.
            @endif
          </p>
        </div>
      </div>
    </div>

  </div>
</div>



@if (session()->has('message'))
    <div class="full-row bg-white py-3">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-success text-center">
                        <p>{{ session('message') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
<!-- breadcrumb -->
<!--==================== Blog Section Start ====================-->
<div class="full-row">
   <div class="container">
        <div class="mb-4 d-xl-none">
            <button class="dashboard-sidebar-btn btn bg-primary rounded">
                <i class="fas fa-bars"></i>
            </button>
        </div>
      <div class="row">
         <div class="col-xl-4">
            @include('partials.user.dashboard-sidebar')
         </div>
         <div class="col-xl-8">
            @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
               <strong>{{__('Success')}}</strong> {{Session::get('success')}}
            </div>
            @endif
            <div class="row">
               <div class="col-lg-6">
                  <div class="widget border-0 p-30 widget_categories bg-light account-info">
                     <h4 class="widget-title down-line mb-30">{{ __('Account Information') }}</h4>
                     <div class="user-info">
                        <h5 class="title">{{ $user->name }}</h5>
                        <p><span class="user-title">{{ __('Email') }}:</span> {{ $user->email }}</p>
                        @if($user->phone != null)
                        <p><span class="user-title">{{ __('Phone') }}:</span> {{ $user->phone }}</p>
                        @endif
                        @if($user->fax != null)
                        <p><span class="user-title">{{ __('Aadhar No') }}:</span> {{ $user->fax }}</p>
                        @endif
                        @if($user->city != null)
                        <p><span class="user-title">{{ __('City') }}:</span> {{ $user->city }}</p>
                        @endif
                        @if($user->zip != null)
                        <p><span class="user-title">{{ __('Zip') }}:</span> {{ $user->zip }}</p>
                        @endif
                        @if($user->address != null)
                        <p><span class="user-title">{{ __('Address') }}:</span> {{ $user->address }}</p>
                        @endif
                     </div>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="widget border-0 p-30 widget_categories bg-light account-info">
                     <h4 class="widget-title down-line mb-30">{{ __('My Wallet') }}</h4>
                     <div class="user-info">
                        <h5 class="title">{{ __('Affiliate Bonus') }}:</h5>
                        <h5 class="title w-price">{{ App\Models\Product::vendorConvertPrice($user->affilate_income) }}</h5>
                        <hr>
                        @php
                           $referrl_user = App\Models\Product::referralUser();
                        @endphp
                        <h5 class="title">{{ __('Referral Bonus') }}:</h5>
                        <h5 class="title w-price">{{ App\Models\Product::vendorConvertPrice($user->referral_income) }}</h5>
                        <hr>
                        
                        <h5 class="title w-title">{{ __('Wallet Balance') }}</h5>
                        <h5 class="title w-price mb-3">  {{ App\Models\Product::vendorConvertPrice(Auth::user()->balance) }}</h5>
                        <!-- <a href="{{ route('user-deposit-create') }}" class="mybtn1 sm "> <i class="fas fa-plus"></i> {{ __('Add Deposit') }}</a> -->
                        <!-- <h5 class="title w-price mb-3">
                        {{ App\Models\Product::vendorConvertPrice($user->affilate_income + $user->referral_income) }}
                        </h5>   -->
                     </div>
                  </div>
               </div>
            </div>
            {{-- Statistic section --}}
            <div class="row mt-3">
               <div class="col-lg-6">
                  <div class="widget border-0 p-30 widget_categories bg-light account-info card c-info-box-area">
                     <div class="c-info-box box2">
                        <p>{{ Auth::user()->orders()->count() }}</p>
                     </div>
                     <div class="c-info-box-content">
                        <h6 class="title">{{ __('Total Orders') }}</h6>
                        <p class="text">{{ __('All Time') }}</p>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="widget border-0 p-30 widget_categories bg-light account-info card c-info-box-area">
                     <div class="c-info-box box1">
                        <p>{{ Auth::user()->orders()->where('status','pending')->count() }}</p>
                     </div>
                     <div class="c-info-box-content">
                        <h6 class="title">{{ __('Pending Orders') }}</h6>
                        <p class="text">{{ __('All Time') }}</p>
                     </div>
                  </div>
               </div>
            </div>
           
         </div>
      </div>
       {{-- Statistic section End--}}
       <div class="row table-responsive-lg mt-3">
         <div class="col-lg-12">
            <div class="widget border-0 p-30 widget_categories bg-light account-info">
               <h4 class="widget-title down-line mb-30">{{ __('Recent Orders') }}</h4>
               <div class="table-responsive">
                  <table class="table order-table" cellspacing="0" width="100%">
                     <thead>
                        <tr>
                           <th>{{ __('#Order') }}</th>
                           <th>{{ __('Date') }}</th>
                           <th>{{ __('Order Total') }}</th>
                           <th>{{ __('Order Status') }}</th>
                           <th>{{ __('Cancel Order') }}</th>
                           <th>{{ __('View') }}</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach(Auth::user()->orders()->latest()->take(6)->get() as $order)
                        <tr>
                           <td data-label="{{ __('#Order') }}">
                              <div>
                                 {{$order->order_number}}
                              </div>
                           </td>
                           <td data-label="{{ __('Date') }}">
                              <div>
                                 {{date('d M Y',strtotime($order->created_at))}}
                              </div>
                           </td>
                           <td data-label="{{ __('Order Total') }}">
                              <div>
                                 {{ \PriceHelper::showAdminCurrencyPrice(($order->pay_amount  * $order->currency_value),$order->currency_sign) }}
                              </div>
                           </td>
                           <td data-label="{{ __('Order Status') }}">
                              @if($order->status == 'declined')
                                 <div class="order-status {{ $order->status }} text-dark">
                                    {{ 'Order Cancelled' }}
                                 </div>
                              @else
                                 <div class="order-status {{ $order->status }}">
                                    {{ucwords($order->status)}}
                                 </div>
                              @endif
                           </td>
                           <td data-label="{{ __('Cancel Order') }}">
                              <div>
                                @if($order->status == 'declined')
                                       <a class="mybtn1 sm1 cancel-order-btn disabled" href="javascript:;">
                                          {{ __('Order Cancelled Successfully') }}
                                       </a>
                                    @elseif($order->status == 'pending')
                                       <a class="mybtn1 sm1 cancel-order-btn" href="{{route('user-order-cancel',[$order->id])}}">
                                          {{ __('Cancel Order') }}
                                       </a>
                                    @else
                                       <div class="order-status {{ $order->status }}">
                                          {{ucwords($order->status)}}
                                       </div>
                                @endif
                              </div>
                           </td>
                           <td data-label="{{ __('View') }}">
                              <div>
                                 <a class="mybtn1 sm1" href="{{route('user-order',$order->id)}}">
                                    {{ __('View Order') }}
                                 </a>
                              </div>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--==================== Blog Section End ====================-->
@includeIf('partials.global.common-footer')

@endsection