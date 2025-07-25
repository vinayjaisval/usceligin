@extends('layouts.front')

@section('content')
@include('partials.global.common-header')


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
                  <div class="widget border-0 p-40 widget_categories bg-light account-info">
                     <div class="process-steps-area">
                        @include('partials.user.order-process')
                     </div>
                     <div class="table-responsive">
                           <h5>{{ __('Ordered Products:') }}</h5>
                           <table class="table veiw-details-table">
                              <thead>
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
                                    <td data-label="{{ __('ID#') }}">
                                       <div>
                                          {{ $product['item']['id'] }}
                                       </div>
                                    </td>
                                    <td data-label="{{ __('Name') }}">
                                       <div>
                                          <input type="hidden" value="{{ $product['license'] }}">
                                          @if($product['item']['user_id'] != 0)
                                          @php
                                          $user = App\Models\User::find($product['item']['user_id']);
                                          @endphp
                                          @if(isset($user))
                                          <a target="_blank"
                                             href="{{ route('front.product', $product['item']['slug']) }}">{{mb_strlen($product['item']['name'],'UTF-8')
                                             > 50 ? mb_substr($product['item']['name'],0,50,'UTF-8').'...' :
                                             $product['item']['name']}}</a>
                                          @else
                                          <a target="_blank"
                                             href="{{ route('front.product', $product['item']['slug']) }}">
                                             {{mb_strlen($product['item']['name'],'UTF-8') > 50 ?
                                             mb_substr($product['item']['name'],0,50,'UTF-8').'...' :
                                             $product['item']['name']}}
                                          </a>
                                          @endif
                                          @else
                                          <a target="_blank"
                                             href="{{ route('front.product', $product['item']['slug']) }}">
                                             {{mb_strlen($product['item']['name'],'UTF-8') > 50 ?
                                             mb_substr($product['item']['name'],0,50,'UTF-8').'...' :
                                             $product['item']['name']}}
                                          </a>
                                          @endif
                                          @if($product['item']['type'] != 'Physical')
                                          @if($order->payment_status == 'Completed')
                                          @if($product['item']['file'] != null)
                                          <a href="{{ route('user-order-download',['slug' => $order->order_number , 'id' => $product['item']['id']]) }}"
                                             class="btn btn-sm btn-primary">
                                             <i class="fa fa-download"></i> {{ __('Download') }}
                                          </a>
                                          @else
                                          <a target="_blank" href="{{ $product['item']['link'] }}"
                                             class="btn btn-sm btn-primary">
                                             <i class="fa fa-download"></i> {{ __('Download') }}
                                          </a>
                                          @endif
                                          @if($product['license'] != '')
                                          <a href="javascript:;" data-toggle="modal" data-target="#confirm-delete"
                                             class="btn btn-sm btn-info product-btn" id="license"><i
                                                class="fa fa-eye"></i> {{ __('View License') }}</a>
                                          @endif
                                          @endif
                                          @endif
                                       </div>
                                    </td>
                                    <td data-label="{{ __('Details') }}">

                                       <div>
                                          <b>{{ __('Quantity') }}</b>: {{$product['qty']}} <br>
                                          @if(!empty($product['size']))
                                          <b>{{ __('Size') }}</b>: {{ $product['item']['measure'] }}{{str_replace('-','
                                          ',$product['size'])}} <br>
                                          @endif
                                          @if(!empty($product['color']))
                                          <div class="d-flex mt-2">
                                             <b>{{ __('Color') }}</b>: <span id="color-bar"
                                                style="width: 20px; height: 20px; display: inline-block; vertical-align: middle; border-radius: 50%; background: #{{$product['color']}};"></span>
                                          </div>
                                          @endif
                                          @if(!empty($product['keys']))
                                          @foreach( array_combine(explode(',', $product['keys']), explode(',',
                                          $product['values'])) as $key => $value)
                                          <b>{{ ucwords(str_replace('_', ' ', $key)) }} : </b> {{ $value }} <br>
                                          @endforeach
                                          @endif
                                       </div>
                                    </td>
                                    <td data-label="{{ __('Price') }}">
                                       <div>
                                          {{ \PriceHelper::showCurrencyPrice($product['item_price'] )}}
                                       </div>
                                    </td>
                                    <td data-label="{{ __('Total') }}">
                                       <div>
                                          {{ \PriceHelper::showCurrencyPrice(($product['item_price'] * $product['qty'] )
                                          ) }} <small>{{ $product['discount'] == 0 ? '' :
                                             '('.$product['discount'].'% '.__('Off').')' }}</small></small>
                                       </div>
                                    </td>
                                 </tr>
                                 @endforeach
                              </tbody>
                           </table>
                        </div>
                     <h4 class="widget-title down-line mb-30">{{ __('Purchased Items') }}</h4>
                     <div class="view-order-page">
                        <h3 class="order-code">{{ __('Order#') }} {{$order->order_number}} [{{$order->status}}]
                        </h3>
                        <div class="print-order text-right">
                           <a href="{{route('user-order-print',$order->id)}}" target="_blank" class="print-order-btn">
                              <i class="fa fa-print"></i> {{ __('Print Order') }}
                           </a>
                        </div>
                        <p class="order-date">{{ __('Order Date') }} {{date('d-M-Y',strtotime($order->created_at))}}
                        </p>
                        @php
                        $billingAddress = \App\Models\Address::find($order->billing_address_id);
                        $shippingAddress = \App\Models\Address::find($order->shipping_address_id);
                        @endphp

                        <div class="billing-add-area">
                           <div class="row">
                              {{-- Shipping Address --}}
                              <div class="col-md-6">
                                 <h5>{{ __('Shipping Address') }}</h5>
                                 <address>
                                    {{ __('Name:') }} {{ $shippingAddress->customer_name  ?? Null}}<br>
                                    {{ __('Email:') }} {{ $shippingAddress->email ?? Null}}<br>
                                    {{ __('Phone:') }} {{ $shippingAddress->phone ?? Null}}<br>
                                    {{ __('Address:') }} {{ $shippingAddress->address ?? Null}}<br>
                                    {{ $shippingAddress->city ?? Null}} - {{ $shippingAddress->zip ?? Null}}
                                 </address>
                              </div>

                              {{-- Billing Address --}}
                              <div class="col-md-6">
                                 <h5>{{ __('Billing Address') }}</h5>
                                 <address>
                                    {{ __('Name:') }} {{ $billingAddress->customer_name ?? Null}}<br>
                                    {{ __('Email:') }} {{ $billingAddress->email ?? Null}}<br>
                                    {{ __('Phone:') }} {{ $billingAddress->phone ?? Null}}<br>
                                    {{ __('Address:') }} {{ $billingAddress->address ?? Null}}<br>
                                    {{ $billingAddress->city ?? Null}} - {{ $billingAddress->zip ?? Null }}
                                 </address>
                              </div>
                           </div>

                           {{-- Payment Info --}}
                           <div class="row mt-4">
                              <div class="col-md-12">
                                 <h5>{{ __('Payment Information') }}</h5>
                                 <p>{{ __('Payment Status:') }}
                                    @if($order->payment_status == 'Pending')
                                    <strong class="text-danger">{{ __('Unpaid') }}</strong>
                                    @else
                                    <strong class="text-success">{{ __('Paid') }}</strong>
                                    @endif
                                 </p>

                                 <p>{{ __('Paid Amount:') }} ₹
                                    {{ \PriceHelper::showOrderCurrencyPrice($order->pay_amount, $order->currency_sign) }}
                                 </p>

                                 <p>{{ __('Payment Method:') }} {{ $order->method }}</p>

                                 @if($order->method != "Cash On Delivery")
                                 @if($order->method == "Stripe")
                                 <p>{{ __('Stripe Charge ID:') }} {{ $order->charge_id }}</p>
                                 @endif
                                 <p>{{ __('Transaction ID:') }} <span id="ttn">{{ $order->txnid }}</span></p>
                                 @endif
                              </div>
                           </div>
                        </div>

                        <br>
                      
                     </div>
                     <a class="back-btn theme-bg" href="{{ route('user-orders') }}"> {{ __('Back') }}</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--==================== Blog Section End ====================-->
{{-- Modal --}}
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
            <p class="text-center">{{ __('The Licenes Key is :') }} <span id="key"></span></p>
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
         'ordering': false,
         'info': false,
         'autoWidth': false,
         'responsive': true
      });

   })(jQuery);
</script>

@endsection