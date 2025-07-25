@extends('layouts.front')
@section('css')
<link rel="stylesheet" href="{{asset('assets/front/css/datatables.css')}}">
@endsection
@section('content')
@include('partials.global.common-header')
<!-- breadcrumb -->



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
<div class="full-row mt-5">
   <div class="container-fluid">
      <div class="mb-4 d-xl-none">
         <button class="dashboard-sidebar-btn btn bg-primary rounded">
            <i class="fas fa-bars"></i>
         </button>
      </div>
      <div class="row">
         <div class="col-xl-3">
            @include('partials.user.dashboard-sidebar')
         </div>
         <div class="col-xl-9">

            {{-- Success Message --}}
            @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
               <strong>{{ __('Success') }}:</strong> {{ Session::get('success') }}
               <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <!-- <div class="row g-4">


               {{-- My Wallet --}}

               <div class="col-lg-12 mb-4">
                  <div class="card border-0 rounded-4  text-white position-relative overflow-hidden"
                     style="background: linear-gradient(135deg, #F8FAFC, #F1F5F9);
                      border-radius: 15px;">
                     <div class="card-body p-4 position-relative z-1">
                        <h5 class="card-title mb-4 d-flex align-items-center text-black fs-5 justify-content-between ">
                           <div>
                              <i class="fas fa-wallet me-2 fs-4 "></i> {{ __('My Wallet') }}
                           </div>
                           <div class="d-flex align-items-center gap-2">
                              <i class="icofont-wallet text-primary me-2 fs-5"></i>
                              <span class="d-block opacity-75">{{ __('Wallet Balance') }}</span>
                              <span class="fw-bold mt-1 text-black">{{ App\Models\Product::vendorConvertPrice(Auth::user()->balance) }}</span>
                           </div>
                        </h5>
                        <div class="d-flex align-items-center justify-content-center  gap-2">
                           <i class="icofont-dollar vp-sucess text-warning me-2 fs-5"></i>
                           <span class="d-block opacity-75">{{ __('Affiliate Bonus') }}</span>
                           <span class="fw-semibold fs-5">{{ App\Models\Product::vendorConvertPrice($user->affilate_income) }}</span>
                           <i class="icofont-users-alt-5 text-success me-2 fs-5"></i>
                           <span class="d-block opacity-75">{{ __('Referral Bonus') }}</span>
                           <span class="fw-semibold fs-5">{{ App\Models\Product::vendorConvertPrice($user->referral_income) }}</span>
                        </div>
                        <hr class="my-4 border-white opacity-25">
                     </div>
                  </div>
               </div>


            </div> -->



            <div class="row row-cards-one">
               <div class="col-md-3">
                  <div class="mycard bg1">
                     <div class="left">
                        <h5 class="title">Total Orders! </h5>
                        <span class="number">{{ Auth::user()->orders()->count() }}</span>
                     </div>
                     <div class="right d-flex align-self-center">
                        <div class="icon">
                           <i class="fas fa-clock "></i>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="mycard bg2">
                     <div class="left">
                        <h5 class="title">Completed Orders!</h5>
                        <span class="number">{{ Auth::user()->orders()->where('status','completed')->count() }}</span>
                     </div>
                     <div class="right d-flex align-self-center">
                        <div class="icon">
                           <i class="icofont-check-circled"></i>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="mycard bg3">
                     <div class="left">
                        <h5 class="title">Pending Orders!</h5>
                        <span class="number">{{ Auth::user()->orders()->where('status','pending')->count() }}</span>
                     </div>
                     <div class="right d-flex align-self-center">
                        <div class="icon">
                           <i class="icofont-truck-alt"></i>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="mycard bg4">
                     <div class="left">
                        <h5 class="title">Cancelled Orders!</h5>
                        <span class="number">{{ Auth::user()->orders()->where('status','declined')->count() }}</span>

                     </div>
                     <div class="right d-flex align-self-center">
                        <div class="icon">
                           <i class="icofont-cart-alt"></i>
                        </div>
                     </div>
                  </div>
               </div>

            </div>







            {{-- Recent Orders --}}
            <div class="card shadow-sm border-0 rounded-3 mt-4">
               <div class="card-body">
                  <h5 class="card-title  mb-3"><i class="fas fa-box me-2"></i>{{ __('Recent Orders') }}</h5>
                  <div class="table-responsive">
                     <table class="table table-hover table-striped align-middle">
                        <thead class="">
                           <tr>
                              <th>{{ __('#Order') }}</th>
                              <th>{{ __('Date') }}</th>
                              <th>{{ __('Amount') }}</th>
                              <th>{{ __('Order Status') }}</th>
                              <th>{{ __('Cancel Order') }}</th>
                              <th>{{ __('View') }}</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach(Auth::user()->orders()->latest()->take(6)->get() as $order)


                           <tr>
                              <td>{{ $order->order_number }}</td>
                              <td>{{ date('d M Y',strtotime($order->created_at)) }}</td>
                              <td>{{ $order->pay_amount }}</td>

                              <td>
                                 <!-- @if($order->status == 'declined')
                                 <span class="badge bg-danger">Cancelled</span>
                                 @else
                                 <span class="badge bg-success">{{ ucfirst($order->status) }}</span>
                                 @endif -->

                                 <span class="badge 
                              @if($order->status == 'pending') bg-warning
                              @elseif($order->status == 'completed') bg-success
                              @elseif($order->status == 'declined') bg-danger
                              @else bg-secondary @endif">
                                    {{ ucwords($order->status) }}
                                 </span>
                              </td>
                              <td>

                                 @if($order->status == 'pending')
                                 <a class="btn btn-sm bbg-warning" href="{{ route('user-order-cancel',[$order->id]) }}">{{ __('Cancel') }}</a>
                                 @elseif($order->status == 'declined')
                                 <span class="badge bg-secondary">Already Cancelled</span>
                                 @else
                                 <span class="badge bg-info">{{ ucfirst($order->status) }}</span>
                                 @endif
                              </td>
                              <td>
                                 <a class="btn btn-sm " href="{{ route('user-order',$order->id) }}"><i class="fas fa-eye me-1 "></i></a>
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
</div>
<!--==================== Blog Section End ====================-->
@includeIf('partials.global.common-footer')

@endsection