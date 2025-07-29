@extends('layouts.front')

@section('content')
@include('partials.global.common-header')

<!-- breadcrumb -->
{{-- Uncomment if breadcrumb needed --}}
{{--
<div class="full-row bg-light overlay-dark py-5"
     style="background-image: url({{ $gs->breadcrumb_banner ? asset('assets/images/'.$gs->breadcrumb_banner):asset('assets/images/noimage.png') }}); background-position: center center; background-size: cover;">
   <div class="container">
      <div class="row text-center text-white">
         <div class="col-12">
            <h3 class="mb-2 text-white">{{ __('Purchased Items') }}</h3>
         </div>
         <div class="col-12">
            <nav aria-label="breadcrumb">
               <ol class="breadcrumb mb-0 d-inline-flex bg-transparent p-0">
                  <li class="breadcrumb-item"><a href="{{ route('user-dashboard') }}">{{ __('Dashboard') }}</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{ __('Purchased Items') }}</li>
               </ol>
            </nav>
         </div>
      </div>
   </div>
</div>
--}}
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
            <div class="row">
               <div class="col-lg-12">
                  <div class="card shadow-sm bg-white p-4">

                     <!-- Order Process Steps -->
                     <div class="mb-4">
                        @include('partials.user.order-process')
                     </div>

                     <!-- Title & Print -->
                     <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0">{{ __('Purchased Items') }}</h4>
                        <a href="{{ route('user-order-print', $order->id) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                           <i class="fa fa-print me-1"></i> {{ __('Print Order') }}
                        </a>
                     </div>

                     <!-- Order Meta -->
                     <div class="mb-4">
                        <h5 class="text-muted">{{ __('Order#') }} <span class="text-dark">{{ $order->order_number }}</span> 
                           <span class="badge bg-dark text-white">{{ $order->status }}</span>
                        </h5>
                        <p class="text-muted">{{ __('Order Date') }}: {{ date('d-M-Y', strtotime($order->created_at)) }}</p>
                     </div>

                     <!-- Ordered Products -->
                     <div class="table-responsive mb-4">
                        <h5 class="mb-3">{{ __('Ordered Products') }}</h5>
                        <table class="table table-bordered align-middle table-hover">
                           <thead class="table-light">
                              <tr>
                                 <th>{{ __('ID#') }}</th>
                                 <th>{{ __('Name') }}</th>
                                 <th>{{ __('Details') }}</th>
                                 <th>{{ __('Price') }}</th>
                                 <th>{{ __('Total') }}</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach($cart['items'] ?? [] as $product)
                              <tr>
                                 <td>{{ $product['item']['id'] }}</td>
                                 <td>
                                    <a href="{{ route('front.product', $product['item']['slug']) }}" target="_blank">
                                       {{ \Illuminate\Support\Str::limit($product['item']['name'], 50) }}
                                    </a>

                                    @if($product['item']['type'] != 'Physical' && $order->payment_status == 'Completed')
                                       @if($product['item']['file'] || $product['item']['link'])
                                          <div class="mt-2">
                                             <a href="{{ route('user-order-download',['slug' => $order->order_number, 'id' => $product['item']['id']]) }}"
                                                class="btn btn-sm btn-primary me-2">
                                                <i class="fa fa-download"></i> {{ __('Download') }}
                                             </a>
                                          </div>
                                       @endif

                                       @if($product['license'])
                                          <a href="javascript:;" data-toggle="modal" data-target="#confirm-delete"
                                             class="btn btn-sm btn-outline-info mt-2" onclick="$('#key').text('{{ $product['license'] }}')">
                                             <i class="fa fa-eye"></i> {{ __('View License') }}
                                          </a>
                                       @endif
                                    @endif
                                 </td>
                                 <td>
                                    <div><b>{{ __('Qty') }}</b>: {{ $product['qty'] }}</div>
                                    @if(!empty($product['size']))
                                    <div><b>{{ __('Size') }}</b>: {{ $product['size'] }}</div>
                                    @endif
                                    @if(!empty($product['color']))
                                    <div class="mt-1"><b>{{ __('Color') }}</b>:
                                       <span style="width: 20px; height: 20px; border-radius: 50%; display: inline-block; background-color: #{{ $product['color'] }}"></span>
                                    </div>
                                    @endif
                                    @if(!empty($product['keys']))
                                    @foreach(array_combine(explode(',', $product['keys']), explode(',', $product['values'])) as $key => $value)
                                    <div><b>{{ ucwords(str_replace('_', ' ', $key)) }}</b>: {{ $value }}</div>
                                    @endforeach
                                    @endif
                                 </td>
                                 <td>
                                    {{ \PriceHelper::showCurrencyPrice($product['item_price']) }}
                                 </td>
                                 <td>
                                    {{ \PriceHelper::showCurrencyPrice($product['item_price'] * $product['qty']) }}
                                    @if($product['discount'])
                                    <small class="text-danger">({{ $product['discount'] }}% Off)</small>
                                    @endif
                                 </td>
                              </tr>
                              @endforeach
                           </tbody>
                        </table>
                     </div>

                     <!-- Address and Payment Info -->
                     @php
                        $billingAddress = \App\Models\Address::find($order->billing_address_id);
                        $shippingAddress = \App\Models\Address::find($order->shipping_address_id);
                     @endphp

                     <div class="row mb-4">
                        <div class="col-md-6">
                           <h6 class="fw-bold">{{ __('Shipping Address') }}</h6>
                           <address class="small">
                              <strong>{{ __('Name:') }}</strong> {{ $shippingAddress->customer_name ?? '-' }}<br>
                              <strong>{{ __('Email:') }}</strong> {{ $shippingAddress->email ?? '-' }}<br>
                              <strong>{{ __('Phone:') }}</strong> {{ $shippingAddress->phone ?? '-' }}<br>
                              <strong>{{ __('Address:') }}</strong> {{ $shippingAddress->address ?? '-' }},
                              {{ $shippingAddress->city ?? '-' }} - {{ $shippingAddress->zip ?? '-' }}
                           </address>
                        </div>
                        <div class="col-md-6">
                           <h6 class="fw-bold">{{ __('Billing Address') }}</h6>
                           <address class="small">
                              <strong>{{ __('Name:') }}</strong> {{ $billingAddress->customer_name ?? '-' }}<br>
                              <strong>{{ __('Email:') }}</strong> {{ $billingAddress->email ?? '-' }}<br>
                              <strong>{{ __('Phone:') }}</strong> {{ $billingAddress->phone ?? '-' }}<br>
                              <strong>{{ __('Address:') }}</strong> {{ $billingAddress->address ?? '-' }},
                              {{ $billingAddress->city ?? '-' }} - {{ $billingAddress->zip ?? '-' }}
                           </address>
                        </div>
                     </div>

                     <div class="mb-4">
                        <h6 class="fw-bold">{{ __('Payment Information') }}</h6>
                        <p><strong>{{ __('Status:') }}</strong>
                           @if($order->payment_status == 'Pending')
                           <span class="badge bg-warning text-dark">{{ __('Unpaid') }}</span>
                           @else
                           <span class="badge bg-success">{{ __('Paid') }}</span>
                           @endif
                        </p>
                        <p><strong>{{ __('Paid Amount:') }}</strong>
                           {{ \PriceHelper::showOrderCurrencyPrice($order->pay_amount * $order->currency_value, $order->currency_sign) }}
                        </p>
                        <p><strong>{{ __('Method:') }}</strong> {{ $order->method }}</p>
                        @if($order->method != 'Cash On Delivery')
                        @if($order->method == 'Stripe')
                        <p><strong>{{ __('Charge ID:') }}</strong> {{ $order->charge_id }}</p>
                        @endif
                        <p><strong>{{ __('Transaction ID:') }}</strong> {{ $order->txnid }}</p>
                        @endif
                     </div>

                     <!-- Back Button -->
                     <div class="text-end">
                        <a href="{{ route('user-orders') }}" class="btn normal-secondry">
                           {{ __('Back to Orders') }}
                        </a>
                     </div>

                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--==================== Blog Section End ====================-->

{{-- License Modal --}}
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header d-block text-center">
            <h4 class="modal-title d-inline-block">{{ __('License Key') }}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <p class="text-center">{{ __('The License Key is :') }} <span id="key" class="fw-bold text-primary"></span></p>
         </div>
         <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('Close') }}</button>
         </div>
      </div>
   </div>
</div>

@includeIf('partials.global.common-footer')

@endsection

@section('script')
<script type="text/javascript">
   (function($) {
      "use strict";
      $('#example').dataTable({
         "ordering": false,
         'paging': false,
         'lengthChange': false,
         'searching': false,
         'info': false,
         'autoWidth': false,
         'responsive': true
      });
   })(jQuery);
</script>
@endsection
