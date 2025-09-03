@extends('layouts.front')

@section('content')
@include('partials.global.common-header')

<!-- breadcrumb -->
{{-- <div class="full-row bg-light overlay-dark py-5"
    style="background-image: url({{ $gs->breadcrumb_banner ? asset('assets/images/'.$gs->breadcrumb_banner):asset('assets/images/noimage.png') }}); background-position: center center; background-size: cover;">
<div class="container">
    <div class="row text-center text-white">
        <div class="col-12">
            <h3 class="mb-2 text-white">{{ __('Success') }}</h3>
        </div>
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 d-inline-flex bg-transparent p-0">
                    <li class="breadcrumb-item"><a href="{{ route('front.index') }}">{{ __('Home') }}</a></li>

                    <li class="breadcrumb-item active" aria-current="page">{{ __('Success') }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
</div> --}}

<!-- breadcrumb -->
<section class="tempcart">

    @if(!empty($tempcart))

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Starting of Dashboard data-table area -->
                <div class="content-box section-padding add-product-1">
                    <div class="top-area">
                        <div class="content order-de">
                            <h4 class="heading">
                                {{ __('THANK YOU FOR YOUR PURCHASE.') }}
                            </h4>
                            <p class="text">
                                {{ __("We'll email you an order confirmation with details and tracking info.") }}
                            </p>
                            <a href="{{ route('front.index') }}" style="color:green;font-weight: bold" class="link">{{
                                __('Continue Shopping') }}</a>
                            @for ($i = 0; $i < 10; $i++)
                                &nbsp;
                                &nbsp;
                                @endfor
                                <a href="{{ route('user-dashboard') }}" style="font-weight: bold" class="link">{{
                            __('Go to Dashboard') }}</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">

                            <div class="product__header">
                                <div class="row reorder-xs">
                                    <div class="col-lg-12">
                                        <div class="product-header-title">
                                            <h4>{{ __('Order#') }} {{$order->order_number}}</h4>
                                        </div>
                                    </div>
                                    @include('alerts.form-success')
                                    <div class="col-md-12" id="tempview">
                                        <div class="dashboard-content">
                                            <div class="view-order-page" id="print">
                                                <p class="order-date">{{ __('Order Date') }}
                                                    {{date('d-M-Y',strtotime($order->created_at))}}
                                                </p>

                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <h4 class="text-center">{{ __('Ordered Products:') }}</h4>
                                                        <thead>
                                                            <tr>
                                                                <th width="35%">{{ __(' Item Name') }}</th>
                                                                <th width="20%">{{ __('Quantity') }}</th>
                                                                <th>{{ __('Price') }}</th>
                                                                <th>{{ __('Total') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            @foreach($tempcart->items as $product)


                                                            <tr>
                                                                <td>
                                                                    <a href="{{ route('front.product', $product['item']['slug']) }}">
                                                                        <img src="{{ $product['item']['photo'] ? asset('assets/images/products/'.$product['item']['photo']) : asset('assets/images/noimage.png') }}" height="50" width="50" alt="Product image">

                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <b>{{ __('Quantity') }}</b>: {{$product['qty']}}
                                                                    <br>
                                                                    <!-- @if(!empty($product['size']))
                                                                    <b>{{ __('Size') }}</b>:
                                                                    {{ $product['item']['measure'] }}{{str_replace('-','
                                                                    ',$product['size'])}}
                                                                    <br>
                                                                    @endif -->
                                                                    <!-- @if(!empty($product['color']))
                                                                    <div class="d-flex mt-2">
                                                                        <b>{{ __('Color') }}</b>: <span id="color-bar"
                                                                            style="border: 10px solid #{{$product['color'] == "" ? "
                                                                            white" : $product['color']}};"></span>
                                                                    </div>
                                                                    @endif -->

                                                                    @if(!empty($product['keys']))

                                                                    @foreach( array_combine(explode(',',
                                                                    $product['keys']), explode(',', $product['values']))
                                                                    as $key => $value)

                                                                    <b>{{ ucwords(str_replace('_', ' ', $key)) }} :
                                                                    </b> {{ $value }} <br>
                                                                    @endforeach

                                                                    @endif

                                                                </td>

                                                                <td>{{
                                                                    \PriceHelper::showCurrencyPrice(($product['item_price']
                                                                    ) ) }}
                                                                </td>

                                                                <td>{{ \PriceHelper::showCurrencyPrice($product['price']
                                                                    ) }} <small>{{
                                                                        $product['discount'] == 0 ? '' :
                                                                        '('.$product['discount'].'% '.__('Off').')'
                                                                        }}</small>
                                                                </td>

                                                            </tr>
                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                                @if($order->dp == 1)



                                                @else
                                                @php
                                                $billingAddress = \App\Models\Address::find($order->billing_address_id);
                                                $shippingAddress = \App\Models\Address::find($order->shipping_address_id);
                                                $shippingAddress = \App\Models\User::find($order->shipping_address_id);


                                                @endphp
                                                <div class="billing-add-area">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <h5>{{ __('Billing Address') }}</h5>

                                                            <address>
                                                                {{ __('Name:') }} {{$billingAddress->customer_name}}<br>
                                                                {{ __('Email:') }} {{$billingAddress->email}}<br>
                                                                {{ __('Phone:') }} {{$billingAddress->phone}}<br>
                                                                {{ __('Country:') }} {{$billingAddress->country_id ?? '--'}}<br>

                                                                {{ __('State:') }} {{$billingAddress->state_id ?? '--'}}<br>
                                                                {{ __('City:') }} {{$billingAddress->city ?? '--'}}<br>
                                                                {{ __('Flat No:') }} {{$billingAddress->flat_no ?? '--'}}<br>

                                                                {{ __('Address:') }} {{$billingAddress->address ?? '--'}}<br>
                                                                {{__('Zip:')}}{{$billingAddress->zip ?? '--'}}
                                                            </address>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h5>{{ __('Payment Information') }}</h5>

                                                            @if ($gs->multiple_shipping == 0)
                                                            @if($order->shipping_cost != 0)
                                                            <p>{{ __('Shipping Cost') }}: ₹
                                                                {{
                                                                    \PriceHelper::showOrderCurrencyPrice($order->shipping_cost,$order->currency_sign)
                                                                    }}
                                                            </p>
                                                            @endif






                                                            @endif

                                                            @if($order->wallet_price != 0)
                                                            <p>{{ __('Paid From Wallet') }}:
                                                                {{
                                                                        \PriceHelper::showOrderCurrencyPrice(($order->wallet_price
                                                                        ),$order->currency_sign) }}
                                                            </p>

                                                            @if($order->method != "Wallet")

                                                            <p>{{$order->method}}:
                                                                {{
                                                                        \PriceHelper::showOrderCurrencyPrice(($order->pay_amount
                                                                        ),$order->currency_sign) }}
                                                            </p>

                                                            @endif

                                                            @endif
                                                            @if($order->refferal_discount)
                                                            <p>{{ __('Referral Discount :') }} ₹
                                                                {{ \PriceHelper::showOrderCurrencyPrice($order->refferal_discount,$order->currency_sign)}}
                                                            </p>
                                                            @endif

                                                            <p>
                                                                {{ __('Discount Coupon :') }} ₹
                                                                {{ \PriceHelper::showOrderCurrencyPrice(($order->coupon_discount ), $order->currency_sign) }}
                                                            </p>


                                                            <p>{{ __('Paid Amount:') }} ₹
                                                                @if($order->method != "Wallet")

                                                                {{\PriceHelper::showOrderCurrencyPrice((($order->pay_amount + $order->wallet_price )
                                                               ),$order->currency_sign) }}

                                                                @else
                                                                {{
                                                                \PriceHelper::showOrderCurrencyPrice(($order->wallet_price
                                                                * $order->currency_value),$order->currency_sign) }}
                                                                @endif



                                                            </p>
                                                            <p>{{ __('Payment Method:') }} {{$order->method}}</p>

                                                            @if($order->method != "Cash On Delivery" && $order->method
                                                            != "Wallet")
                                                            @if($order->method=="Stripe")
                                                            {{$order->method}} {{ __('Charge ID:') }}
                                                            <p>
                                                                {{$order->charge_id}}
                                                            </p>
                                                            @else
                                                            {{ __('Transaction ID:') }}
                                                            <p id="ttn">
                                                                {{$order->txnid}}
                                                            </p>
                                                            @endif

                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                <br>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Ending of Dashboard data-table area -->
            </div>

            @endif

</section>





@include('partials.global.common-footer')
@endsection

@section('script')


@endsection