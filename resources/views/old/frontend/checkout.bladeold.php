@extends('layouts.front')
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.0/dist/sweetalert2.min.css">
<style>
   .checkout__coupon-section {
      margin-top: 2rem;
      position: relative;
   }
   .checkout__coupon-heading {
      align-items: center;
      background: #fff;
      border: 1px solid var(--bs-primary);
      border-radius: 5px;
      color: var(--bs-primary);
      display: flex;
      font-size: 14px;
      font-weight: 600;
      gap: .25rem;
      inset-inline-start: 1rem;
      margin-bottom: 0;
      padding: .25rem .5rem;
      position: absolute;
      top: -1rem;
      z-index: 999;
   }
   .checkout__coupon-list {
      border: 1px dashed var(--bs-primary);
      border-radius: 8px;
      display: flex;
      flex-direction: column;
      gap: .75rem;
      margin-bottom: 1rem;
      max-height: 600px;
      overflow-y: auto;
      padding: 2rem .75rem .75rem;
   }
   .checkout__coupon-item {
      border-radius: 8px;
      box-shadow: 0 0 4px 0 hsla(0, 0%, 80%, .75);
      cursor: pointer;
      display: flex;
      min-width: 16rem;
      transition: all .2s;
   }
   .checkout__coupon-item-content {
      flex: 2;
      padding: .5rem 1rem;
      position: relative;
   }
   .checkout__coupon-item-description {
      color: #4d4d4d;
      display: block;
      font-size: 13px;
      min-width: 135px;
      transition: all .2s;
   }
   .checkout__coupon-item-code {
      align-items: center;
      background: #efefef;
      border-radius: 4px;
      display: flex;
      justify-content: space-between;
      margin-top: .5rem;
      padding: .5rem;
   }
   .select2-container .select2-selection--single{
    height: 45px !important;
   }
   .select2-container--default .select2-selection--single .select2-selection__rendered {

       margin-left: 9px;
       margin-top: 7px;
   }
   textarea.form-control {
    min-height: calc(1.5em + 7.75rem + 2px);
   }
</style>
@endsection
@section('content')
@include('partials.global.common-header')

<section class="checkout">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="checkout-area mb-0 pb-0">
               <div class="checkout-process">
                  <ul class="nav" role="tablist">
                     <li class="nav-item">
                        <a class="nav-link active" id="pills-step1-tab" data-toggle="pill" href="#pills-step1"
                           role="tab" aria-controls="pills-step1" aria-selected="true">
                           <span>1</span> {{ __('Address') }}
                           <i class="far fa-address-card"></i>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link disabled" id="pills-step2-tab" data-toggle="pill" href="#pills-step2"
                           role="tab" aria-controls="pills-step2" aria-selected="false">
                           <span>2</span> {{ __('Orders') }}
                           <i class="fas fa-dolly"></i>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link disabled" id="pills-step3-tab" data-toggle="pill" href="#pills-step3"
                           role="tab" aria-controls="pills-step3" aria-selected="false">
                           <span>3</span> {{ __('Payment') }}
                           <i class="far fa-credit-card"></i>
                        </a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="col-lg-8">
            <form id="" action="" method="POST" class="checkoutform">
               @include('includes.form-success')
               @include('includes.form-error')
               {{ csrf_field() }}
               <div class="checkout-area">
                  <div class="tab-content" id="pills-tabContent">
                     <div class="tab-pane fade show active" id="pills-step1" role="tabpanel"
                        aria-labelledby="pills-step1-tab">
                        <div class="content-box">
                           <div class="content">
                              <div class="submit-loader" style="display: none;">
                                 <img src=""
                                    alt="">
                              </div>
                              <!-- <div class="personal-info">
                                 <h5 class="title">
                                    {{ __('Personal Information') }} :
                                 </h5>
                                 <div class="row">
                                    <div class="col-lg-6">
                                       <input type="text" id="personal-name" class="form-control" name="personal_name"
                                          placeholder="{{ __('Enter Your Name')}}"
                                          value="{{ Auth::check() ? Auth::user()->name : '' }}" {{ Auth::check()
                                          ? 'readonly' : '' }}>
                                    </div>
                                    <div class="col-lg-6">
                                       <input type="email" id="personal-email" class="form-control"
                                          name="personal_email" placeholder="{{ __('Enter Your Email') }}"
                                          value="{{ Auth::check() ? Auth::user()->email : '' }}" {{ Auth::check()
                                          ? 'readonly' : '' }}>
                                    </div>
                                 </div>
                                 @if(!Auth::check())
                                 <div class="row">
                                    <div class="col-lg-12 mt-3">
                                       <input class="styled-checkbox" id="open-pass" type="checkbox" value="1"
                                          name="pass_check">
                                       <label for="open-pass">{{ __('Create an account ?') }}</label>
                                    </div>
                                 </div>
                                 <div class="row set-account-pass d-none">
                                    <div class="col-lg-6">
                                       <input type="password" name="personal_pass" id="personal-pass"
                                          class="form-control" placeholder="{{ __('Enter Your Password') }}">
                                    </div>
                                    <div class="col-lg-6">
                                       <input type="password" name="personal_confirm" id="personal-pass-confirm"
                                          class="form-control" placeholder="{{ __('Confirm Your Password') }}">
                                    </div>
                                 </div>
                                 @endif
                              </div> -->
                              <div class="billing-address">
                                 <h5 class="title">
                                    {{ __('Billing Details') }}
                                 </h5>
                                 <div class="row">
                                   
                                    <div class="col-lg-6 mb-2 d-none" id="shipshow">
                                       <select class="form-control" name="pickup_location">
                                          @foreach($pickups as $pickup)
                                          <option value="{{$pickup->location}}">{{$pickup->location}}
                                          </option>
                                          @endforeach
                                       </select>
                                    </div>
                                    <div class="col-lg-6">
                                       <input class="form-control" type="text" name="customer_name"
                                          placeholder="{{ __('Full Name') }}" required=""
                                          value="{{ Auth::check() ? Auth::user()->name : '' }}">
                                    </div>
                                    <div class="col-lg-6">
                                       <input class="form-control" type="text" name="customer_email"
                                          placeholder="{{ __('Email') }}" required=""
                                          value="{{ Auth::check() ? Auth::user()->email : '' }}">
                                    </div>
                                    <div class="col-lg-6">
                                          <input 
                                          class="form-control" 
                                          type="text" 
                                          name="customer_phone" 
                                          placeholder="{{ __('Phone Number') }}" 
                                          required 
                                          maxlength="10"
                                          oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                          value="{{ Auth::check() ? Auth::user()->phone : '' }}">

                                    
                                    </div>
                                   
                                    <div class="col-lg-6">
                                    
                                       <input 
                                       class="form-control zipcode" 
                                       type="text" 
                                       name="customer_zip" 
                                       placeholder="{{ __('Postal Code') }}" 
                                       required 
                                       maxlength="6"
                                       pattern="[0-9]{6}"
                                       value="{{ Auth::check() ? Auth::user()->zip : '' }}" 
                                       id="zipcode"
                                       title="Enter a 6-digit postal code">
                                       <span id="pincodeerror" class="text-danger"></span>
                                    </div>

                                    <div class="col-lg-6">
                                       <input class="form-control" type="text" name="customer_country" 
                                          placeholder="{{ __('Country') }}"  value="{{ Auth::check() ? Auth::user()->country : '' }}" required="" id="select_country" readonly>
                                    
                                    </div>
                                    <div class="col-lg-6">
                                    <input class="form-control" type="text" name="customer_state"
                                       placeholder="{{ __('State') }}"  value="{{ Auth::check() ? Auth::user()->state_id : '' }}" required="" id="show_state" readonly>

                                 
                                    </div>
                                    <div class="col-lg-6">
                                       <input class="form-control" type="text" name="customer_city"
                                       placeholder="{{ __('City') }}"  value="{{ Auth::check() ? Auth::user()->city_id : '' }}" required="" id="show_city" readonly>
                                    
                                    
                                    </div>

                                 

                                  
                                    @if(Session::has('coupon_total'))
                                    <input type="hidden" name="total" id="grandtotal" value="{{round($totalPrice * $curr->value,2)}}">
                                    <input type="hidden" class="tgrandtotal" value="{{ $totalPrice }}">
                                    @elseif(Session::has('coupon_total1'))
                                    <input type="hidden" name="total" id="grandtotal" value="{{ preg_replace(" /[^0-9,.]/", "" ,
                                       Session::get('coupon_total1') ) }}">
                                    <input type="hidden" class="tgrandtotal" value="{{ preg_replace(" /[^0-9,.]/", "" ,
                                       Session::get('coupon_total1') ) }}">
                                    @else
                                    <input type="hidden" name="total" id="grandtotal" value="{{round($totalPrice * $curr->value,2)}}">
                                    <input type="hidden" class="tgrandtotal" value="{{round($totalPrice * $curr->value,2)}}">
                                    @endif
                                    @php
                                       $orderCount = App\Models\Order::where('user_id', Auth::user()->id)->count();
                                    @endphp
                                    @if($orderCount == 0)
                                       @php
                                          $user = App\Models\User::where('id', Auth::user()->id)->select('reffered_by')->first();
                                       @endphp
                                       @if($user && $user->reffered_by)
                                       <input type="hidden" id="refferal_discount" name="refferal_discount" value="{{$refferal_discount ?? '0'}}">
                                       @endif
                                    @endif
                                   
                                    <div class="col-lg-12 my-2">
                                       <textarea class="form-control " name="customer_address" placeholder="{{ __('Address') }}" required="">{{ Auth::check() ? Auth::user()->address : '' }}</textarea>
                                    </div>
                                 </div>
                              </div>
                              <div class="row {{ $digital == 1 ? 'd-none' : '' }}">
                                 <div class="col-lg-12 mt-3 d-flex">
                                    <input class="styled-checkbox" id="ship-diff-address" type="checkbox"
                                       value="value1">
                                    <label for="ship-diff-address">{{ __('Ship to a Different Address?') }}</label>
                                 </div>
                              </div>
                              <div class="ship-diff-addres-area d-none">
                                 <h5 class="title">
                                    {{ __('Shipping Details') }}
                                 </h5>
                                 <div class="row">
                                    <div class="col-lg-6">
                                       <input class="form-control ship_input" type="text" name="shipping_name"
                                          id="shippingFull_name" placeholder="{{ __('Full Name') }}">
                                       <input type="hidden" name="shipping_email" value="">
                                    </div>
                                    <div class="col-lg-6">
                                       <input class="form-control ship_input" type="text" name="shipping_phone"
                                          id="shipingPhone_number" placeholder="{{ __('Phone Number') }}">
                                    </div>
                                 </div>
                                 <div class="row">
                                    
                                    <div class="col-lg-6">
                                       <input class="form-control ship_input zipcodee" type="text" name="shipping_zip"
                                          id="shippingPostal_code" placeholder="{{ __('Postal Code') }}">


                                    </div>

                                    <div class="col-lg-6">
                                     
                                       <input class="form-control ship_input" type="text" name="shipping_country" 
                                             placeholder="{{ __('Country') }}"  value="" required="" id="select_countrye" readonly>
                                         
                                   
                                   
                                          </div>
                                 </div>
                                 <div class="row">

                               

                                 <div class="col-lg-6">
                                       
                                       
                                          <input class="form-control ship_input" type="text" name="shipping_state"
                                             placeholder="{{ __('State') }}"  value="" required="" id="show_statee" readonly>
                                         

                                    </div>
                                    <div class="col-lg-6">
                                     
                                          <input class="form-control ship_input" type="text" name="shipping_city" 
                                             placeholder="{{ __('City') }}"  value="{{ Auth::check() ? Auth::user()->city_id : '' }}" required="" id="show_citye" readonly>
                                        
                                    </div>
                                   
                                    <div class="col-lg-12">
                                       <input class="form-control ship_input" type="text" name="shipping_address"
                                          id="shipping_address" placeholder="{{ __('Address') }}">
                                        

                                    </div>
                                 </div>
                                
                              </div>
                              <div class="order-note mt-3">
                                 <div class="row">
                                    <div class="col-lg-12">
                                       <input type="text" id="Order_Note" class="form-control" name="order_notes"
                                          placeholder="{{ __('Order Note') }} ({{ __('Optional') }})">
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-lg-12  mt-3">
                                    <div class="bottom-area paystack-area-btn">
                                    @if (Auth::guard('web')->check())
                                       <button type="submit" class="mybtn1">{{ __('Continues') }}</button>
                                       @else
                                       
                                        <a href="{{ route('user.login') }}" class="bottom-area">{{ __('User
                                            Login') }}</a>
                                            @endif
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="tab-pane fade show" id="pills-step2" role="tabpanel" aria-labelledby="pills-step2-tab">
                        <div class="content-box">
                           <div class="content">
                              <div class="order-area">

                                 @php
                                 foreach ($products as $key => $item) {
                                 $userId = $item["user_id"];
                                 if (!isset($resultArray[$userId])) {
                                 $resultArray[$userId] = [];
                                 }
                                 $resultArray[$userId][$key] = $item;
                                 }
                                 @endphp


                                 @php
                                 $is_Digital = 1;
                                 @endphp

                                 @foreach($resultArray as $vendor_id => $array_product)
                                 @php

                                 if($vendor_id != 0){
                                 $shipping = App\Models\Shipping::where('user_id',$vendor_id)->get();
                                 $packaging = App\Models\Package::where('user_id',$vendor_id)->get();
                                 $vendor = App\Models\User::findOrFail($vendor_id);
                                 }else{
                                 $shipping = App\Models\Shipping::where('user_id',0)->get();
                                 $packaging = App\Models\Package::where('user_id',0)->get();
                                 $vendor = App\Models\Admin::findOrFail(1);
                                 }

                                 @endphp
                                 <div class="py-4" style="border-bottom:1px solid #ddd">

                                    @foreach ($array_product as $product)
                                    @php
                                    if($product['dp'] == 0){
                                    $is_Digital = 0;
                                    }
                                    @endphp
                                    <div class="order-item border-bottom-0">
                                       <div class="product-img">
                                          <div class="d-flex">
                                             <img
                                                src=" {{ asset('assets/images/products/'.$product['item']['photo']) }}"
                                                height="80" width="80" class="p-1">
                                          </div>
                                       </div>
                                       <div class="product-content">
                                          <p class="name"><a
                                                href="{{ route('front.product', $product['item']['slug']) }}"
                                                target="_blank">{{ $product['item']['name'] }}</a></p>
                                          <div class="unit-price d-flex">
                                             <h5 class="label mr-2">{{ __('Price') }} : </h5>
                                             <p>{{ App\Models\Product::convertPrice($product['item_price']) }}
                                             </p>
                                          </div>
                                          @if(!empty($product['size']))
                                          <div class="unit-price d-flex">
                                             <h5 class="label mr-2">{{ __('Size') }} : </h5>
                                             <p>{{str_replace('-',' ',$product['size'])}}</p>
                                          </div>
                                          @endif
                                          @if(!empty($product['color']))
                                          <div class="unit-price d-flex">
                                             <h5 class="label mr-2">{{ __('Color') }} : </h5>
                                             <span id="color-bar"
                                                style="border: 10px solid {{$product['color'] == "" ? " white" : '#'
                                                .$product['color']}};"></span>
                                          </div>
                                          @endif
                                          @if(!empty($product['keys']))
                                          @foreach( array_combine(explode(',', $product['keys']), explode(',',
                                          $product['values'])) as $key => $value)
                                          <div class="quantity d-flex">
                                             <h5 class="label mr-2">{{ ucwords(str_replace('_', ' ', $key)) }} :
                                             </h5>
                                             <span class="qttotal">{{ $value }} </span>
                                          </div>
                                          @endforeach
                                          @endif
                                          <div class="quantity d-flex">
                                             <h5 class="label mr-2">{{ __('Quantity') }} : </h5>
                                             <span class="qttotal">{{ $product['qty'] }} </span>
                                          </div>
                                          <div class="total-price d-flex">
                                             <h5 class="label mr-2">{{ __('Total Price') }} : </h5>
                                             <p>
                                                {{ App\Models\Product::convertPrice($product['price']) }}
                                                <small>{{ $product['discount'] == 0 ? '' : '('.$product['discount'].'%
                                                   '.__('Off').')' }}</small>
                                             </p>
                                          </div>
                                       </div>
                                    </div>
                                    @endforeach
                                   

                                 </div>
                                 @php
                                 $is_Digital = 1;
                                 @endphp
                                 @endforeach
                              </div>
                              <div class="row">
                                 <div class="col-lg-12 mt-3">
                                    <div class="bottom-area">
                                       <a href="javascript:;" id="step1-btn" class="mybtn11 mr-3  btn btn-secondary">{{ __('Back') }}</a>
                                       <a href="javascript:;" id="step3-btn" class="mybtn11 btn btn-secondary">{{ __('Continue') }}</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     
                     <div class="tab-pane fade show" id="pills-step3" role="tabpanel" aria-labelledby="pills-step3-tab">
                        <div class="content-box">
                           <div class="content">
                              <div class="billing-info-area {{ $digital == 1 ? 'd-none' : '' }}">
                                 <h4 class="title">
                                    {{ __('Shipping Info') }}
                                 </h4>
                                 <ul class="info-list">
                                    <li>
                                       <p id="shipping_user"></p>
                                    </li>
                                    
                                    <li>
                                       <p id="shipping_phone"></p>
                                    </li>
                                    <li>
                                       <p id="shipping_email"></p>
                                    </li>
                                 </ul>
                              </div>
                              <div class="payment-information">
                                 <h4 class="title">
                                    {{ __('Payment Info') }}
                                 </h4>
                                 <div class="row">
                                    <div class="col-lg-12">
                                       <div class="nav flex-column" role="tablist" aria-orientation="vertical">
                                          @foreach($gateways as $gt)
                                          @if ($gt->checkout == 1)
                                          @if($gt->type == 'manual')
                                          @if($digital == 0)
                                          <a class="nav-link payment" data-val="" data-show="{{$gt->showForm()}}"
                                             data-form="{{ $gt->showCheckoutLink() }}"
                                             data-href="{{ route('front.load.payment',['slug1' => $gt->showKeyword(),'slug2' => $gt->id]) }}"
                                             id="v-pills-tab{{ $gt->id }}-tab" data-toggle="pill"
                                             href="#v-pills-tab{{ $gt->id }}" role="tab"
                                             aria-controls="v-pills-tab{{ $gt->id }}" aria-selected="false">
                                             <div class="icon">
                                                <span class="radio"></span>
                                             </div>
                                             <p>
                                                {{ $gt->title }}
                                                @if($gt->subtitle != null)
                                                <small>
                                                   {{ $gt->subtitle }}
                                                </small>
                                                @endif
                                             </p>
                                          </a>
                                          @endif
                                          @else
                                          <a class="nav-link payment" data-val="{{ $gt->keyword }}"
                                             data-show="{{$gt->showForm()}}" data-form="{{ $gt->showCheckoutLink() }}"
                                             data-href="{{ route('front.load.payment',['slug1' => $gt->showKeyword(),'slug2' => $gt->id]) }}"
                                             id="v-pills-tab{{ $gt->id }}-tab" data-toggle="pill"
                                             href="#v-pills-tab{{ $gt->id }}" role="tab"
                                             aria-controls="v-pills-tab{{ $gt->id }}" aria-selected="false">
                                             <div class="icon">
                                                <span class="radio"></span>
                                             </div>
                                             <p>
                                                {{ $gt->name }}
                                                @if($gt->information != null)
                                                <small>
                                                   {{ $gt->getAutoDataText() }}
                                                </small>
                                                @endif
                                             </p>
                                          </a>
                                          @endif
                                          @endif
                                          @endforeach

                                          @if (auth()->check())
                                          {{-- wallet checkout start --}}
                                          <a class="nav-link payment" href="javascript:;" data-show="no"
                                             data-val="{{ $gt->keyword }}" data-toggle="pill" role="tab"
                                             data-form="{{ route('front.wallet.submit') }}"
                                             aria-controls="v-pills-tab{{ $gt->id }}" aria-selected="false">
                                             <div class="icon">
                                                <span class="radio"></span>
                                             </div>
                                             <p>
                                                {{ __('Wallet') }}
                                                @if($gt->information != null)
                                                <small>
                                                   {{ __('Pay from your wallet') }}
                                                </small>
                                                @endif

                                             </p>
                                          </a>
                                          {{-- wallet checkout end --}}
                                          @endif



                                       </div>
                                    </div>
                                    <div class="col-lg-12">
                                       <div class="pay-area d-none">
                                          <div class="tab-content" id="v-pills-tabContent">
                                             @foreach($gateways as $gt)
                                             @if($gt->type == 'manual')
                                             @if($digital == 0)
                                             <div class="tab-pane fade" id="v-pills-tab{{ $gt->id }}" role="tabpanel"
                                                aria-labelledby="v-pills-tab{{ $gt->id }}-tab">
                                             </div>
                                             @endif
                                             @else
                                             <div class="tab-pane fade" id="v-pills-tab{{ $gt->id }}" role="tabpanel"
                                                aria-labelledby="v-pills-tab{{ $gt->id }}-tab">
                                             </div>
                                             @endif
                                             @endforeach
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-lg-12 mt-3">
                                    <div class="bottom-area">
                                       <a href="javascript:;" id="step2-btn" class="mybtn1 mr-3">{{ __('Back') }}</a>
                                       <button type="submit" id="final-btn" class="mybtn2">{{ __('Pay Now') }}</button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               @if ($gs->multiple_shipping == 0)
               <input type="hidden" name="shipping_id" id="multi_shipping_id" value="{{@$shipping_data[0]->id}}">
               <input type="hidden" name="packaging_id" id="multi_packaging_id" value="{{@$package_data[0]->id}}">
               @endif


               <input type="hidden" name="dp" value="{{$digital}}">
               <input type="hidden" id="input_tax" name="tax" value="">
               <input type="hidden"  name="shipping_cost" class="shipping_cost_view" value="">

               <input type="hidden" id="input_tax_type" name="tax_type" value="">
               <input type="hidden" name="totalQty" value="{{$totalQty}}">
               <input type="hidden" name="vendor_shipping_id" value="{{ $vendor_shipping_id }}">
               <input type="hidden" name="vendor_packing_id" value="{{ $vendor_packing_id }}">
               <input type="hidden" name="currency_sign" value="{{ $curr->sign }}">
               <input type="hidden" name="currency_name" value="{{ $curr->name }}">
               <input type="hidden" name="currency_value" value="{{ $curr->value }}">
               @php
               @endphp
               @if(Session::has('coupon_total'))
               <input type="hidden" name="total" id="grandtotal" value="{{round($totalPrice * $curr->value,2)}}">
               <input type="hidden" class="tgrandtotal" value="{{ $totalPrice }}">
               @elseif(Session::has('coupon_total1'))
               <input type="hidden" name="total" id="grandtotal" value="{{ preg_replace(" /[^0-9,.]/", "" ,
                  Session::get('coupon_total1') ) }}">
               <input type="hidden" class="tgrandtotal" value="{{ preg_replace(" /[^0-9,.]/", "" ,
                  Session::get('coupon_total1') ) }}">
               @else
               <input type="hidden" name="total" id="grandtotal" value="{{round($totalPrice * $curr->value,2)}}">
               <input type="hidden" class="tgrandtotal" value="{{round($totalPrice * $curr->value,2)}}">
               @endif
               <input type="hidden" id="original_tax" value="0">
               <input type="hidden" id="wallet-price" name="wallet_price" value="0">
               <input type="hidden" id="ttotal"
                  value="{{ Session::has('cart') ? App\Models\Product::convertPrice($totalPrice) : '0' }}">
               <input type="hidden" name="coupon_code" id="coupon_code"
                  value="{{ Session::has('coupon_code') ? Session::get('coupon_code') : '' }}">
               <input type="hidden" name="coupon_discount" id="coupon_discount"
                  value="{{ Session::has('coupon') ? Session::get('coupon') : '' }}">
               <input type="hidden" name="coupon_id" id="coupon_id"
                  value="{{ Session::has('coupon') ? Session::get('coupon_id') : '' }}">
               <input type="hidden" name="user_id" id="user_id"
                  value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->id : '' }}">
            </form>
         </div>

         @if(Session::has('cart'))
         <div class="col-lg-4">
            <div class="right-area">
               <div class="order-box">
                  <h4 class="title">{{ __('PRICE DETAILS') }}</h4>
                  <ul class="order-list">
                     <li>
                        <p>
                           {{ __('Total MRP') }}
                        </p>
                        <P>
                           <b class="cart-total">{{ Session::has('cart') ?
                              App\Models\Product::convertPrice(Session::get('cart')->totalPrice) : '0.00' }}</b>
                        </P>
                     </li>
                    
                     @if($orderCount == 0)
                        @if($user && $user->reffered_by)
                        <li>
                           <p>
                              {{ __('Refferel Discount') }}
                           </p>
                           <p class="float-end">- {{App\Models\Product::convertPrice($refferal_discount ?? 0)}}</p>
                        </li>
                     @endif
                    @endif
                     <li class="">
                        <p>
                           {{ __('Shipping Cost')}}
                        </p>
                        <P>
                           <b> <span class="shipping_cost">{{App\Models\Product::convertPrice(0)}}</span> </b>
                        </P>
                     </li>


                     @if(Session::has('coupon'))
                     <li class="discount-bar">
                        <p>
                           {{ __('Discount') }} <span class="dpercent">{{ Session::get('coupon_percentage') == 0 ? '' :
                              '('.Session::get('coupon_percentage').')' }}</span>
                        </p>
                        <P>
                           @if($gs->currency_format == 0)
                           <b id="discount">{{ $curr->sign }}{{ Session::get('coupon') }}</b>
                           @else
                           <b id="discount">{{ Session::get('coupon') }}{{ $curr->sign }}</b>
                           @endif
                        </P>
                     </li>
                     @else
                     <li class="discount-bar d-none">
                        <p>
                           {{ __('Discount') }} <span class="dpercent"></span>
                        </p>
                        <P>
                           <b id="discount">{{ $curr->sign }}{{ Session::get('coupon') }}</b>
                        </P>
                     </li>
                     @endif
                  </ul>

                  <div class="cupon-box">
                     <div id="coupon-link" >
                        <img src="{{ asset('assets/front/images/tag.png') }}">
                        {{ __('Have a promotion code?') }}
                     </div>
                     <form id="check-coupon-form" class="coupon">
                        <input type="text" placeholder="{{ __('Coupon Code') }}" id="code" required=""
                           autocomplete="off">
                        <button type="submit">{{ __('Apply') }}</button>
                     </form>
                     <form class="applied_coupon_code" style="display: none">
                        <input type="text"  id="coupon_code_show" required=""
                           autocomplete="off">
                        <input type="text"  id="coupon_value" style="display: none" value="coupon">

                        <button  id="remove_coupon" >
                               {{ __('Remove') }}
                        </button>
                     </form>       
                  </div>
                

                  <div class="final-price">
                     <span>{{ __('Final Price') }} :</span>
                     @if(Session::has('coupon_total'))
                        @if($gs->currency_format == 0)
                           <span id="final-cost">{{ $curr->sign }}{{ $totalPrice }}</span>
                        @else
                           <span id="final-cost">{{ $totalPrice }}{{ $curr->sign }}</span>
                        @endif
                     @elseif(Session::has('coupon_total1'))
                           <span id="final-cost"> {{ Session::get('coupon_total1') }}</span>
                     @else
                           <span id="final-cost">{{ App\Models\Product::convertPrice($totalPrice) }}</span>
                     @endif
                  </div>
                     @if(!Session::has('refferel_user_id'))
                        @php
                           $coupon_use =App\Models\Order::where('user_id',Auth::user()->id)->whereNotNull('coupon_code')->count();
                           $coupon = App\Models\Coupon::where('id', 2)->select('id', 'code', 'price')->get();
                        @endphp
                        @if($coupon_use == 0)
                           @if(count($coupon) > 0)
                           <div class="checkout__coupon-section">
                              <div class="checkout__coupon-heading">
                                 <img width="32" height="32" src="{{ asset('assets/images/coupon-code.gif') }}" alt="coupon code icon">
                                 Coupon codes ({{ count($coupon) }})
                              </div>
                              <div class="checkout__coupon-list">
                                 @foreach ($coupon as $item)
                                       <div class="checkout__coupon-item">
                                          <div class="checkout__coupon-item-icon"></div>
                                          <div class="checkout__coupon-item-content">
                                             <div class="checkout__coupon-item-title">
                                                   <h4>{{ $item->price }} %</h4>
                                             </div>
                                             <div class="checkout__coupon-item-description">
                                                   Discount {{ $item->price }} % limited to use coupon code per customer. This coupon can only be used once per customer!
                                             </div>
                                             <div class="checkout__coupon-item-code">
                                                   <span id="coupon-code-{{ $item->id }}">{{ $item->code }}</span>
                                                   <button type="button" onclick="copyCouponCode('{{ $item->code }}')">
                                                      {{ __('Copy') }}
                                                   </button>
                                             </div>                      
                                          </div>
                                       </div>
                                 @endforeach
                              </div>
                           </div>
                           @endif
                        @endif
                     @endif
                 
               </div>
            </div>
         </div>
         @endif
   
      </div>
   </div>
</section>








@includeIf('partials.global.common-footer')
@endsection
@section('script')
<script src="https://js.paystack.co/v1/inline.js"></script>
<script src="https://sdk.mercadopago.com/js/v2"></script>
<script src="https://www.2checkout.com/checkout/api/2co.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.0/dist/sweetalert2.all.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
   function copyCouponCode(code) {
       navigator.clipboard.writeText(code).then(() => {
           alert("Coupon code copied: " + code);
       }).catch(err => {
           console.error('Error copying text: ', err);
       });
   }
</script>
<script type="text/javascript">
   $('a.payment:first').addClass('active');

   $('.checkoutform').attr('action',$('a.payment:first').attr('data-form'));
   $($('a.payment:first').attr('href')).load($('a.payment:first').data('href'));


   	var show = $('a.payment:first').data('show');
   	if(show != 'no') {
   		$('.pay-area').removeClass('d-none');
   	}
   	else {
   		$('.pay-area').addClass('d-none');
   	}
   $($('a.payment:first').attr('href')).addClass('active').addClass('show');
</script>
<script type="text/javascript">
   var coup = 0;
   var pos = {{ $gs->currency_format }};
   @if(isset($checked))
   	$('#comment-log-reg1').modal('show');
   @endif

  let mship = 0;
  let mpack = 0;


   var ftotal = parseFloat($('#grandtotal').val());
      ftotal = parseFloat(ftotal).toFixed(2);

      if(pos == 0){
         $('#final-cost').html('{{ $curr->sign }}'+ftotal)
      }
      else{
         $('#final-cost').html(ftotal+'{{ $curr->sign }}')
      }
      $('#grandtotal').val(ftotal);


      let original_tax = 0;

   	$(document).on('change','#select_country',function(){

   		$(this).attr('data-href');
   		let state_id = 0;
   		let country_id = $('#select_country option:selected').attr('data');
   		let is_state = $('option:selected', this).attr('rel');
   		let is_auth = $('option:selected', this).attr('rel1');
   		let is_user = $('option:selected', this).attr('rel5');
   		let state_url = $('option:selected', this).attr('data-href');
         // alert(is_state);
   		if(is_auth == 1 || is_state == 1) {
   			if(is_state == 1){
   				$('.select_state').removeClass('d-none');
   				$.get(state_url,function(response){

                  console.log(response);
   					$('#show_state').html(response.data);
   					// if(is_user==1){
   					// 	tax_submit(country_id,response.state);
   					// }else{
   					// 	tax_submit(country_id,state_id);
   					// }

   				});

   			}else{
   				// tax_submit(country_id,state_id);
   				hide_state();
   			}

   		}else{
   			// tax_submit(country_id,state_id);
   			hide_state();
   		}

   	});


   	$(document).on('change','#show_state',function(){
   		let state_id = $(this).val();
   		let country_id = $('#select_country option:selected').attr('data');
   		// tax_submit(country_id,state_id);
         $.get("{{route('state.wise.city')}}",{state_id:state_id},function(data){
            $('#show_city').parent().removeClass('d-none');
            $('#show_city').html(data.data);
         });
   	});


   	function hide_state(){
   		$('.select_state').addClass('d-none');
   	}


   $(document).ready(function(){
      
      getShipping();
      getPacking();

      let country_id = $('#select_country option:selected').attr('data');
      let state_id = $('#select_country option:selected').attr('rel2');
      let is_state = $('#select_country option:selected', this).attr('rel');
      let is_auth = $('#select_country option:selected', this).attr('rel1');
      let state_url = $('#select_country option:selected', this).attr('data-href');

      if(is_auth == 1 && is_state ==1) {
         if(is_state == 1){
            $('.select_state').removeClass('d-none');
            $.get(state_url,function(response){
               $('#show_state').html(response.data);
               // tax_submit(country_id,response.state);
            });

         }else{
            // tax_submit(country_id,state_id);
            hide_state();
         }
      }else{
         // tax_submit(country_id,state_id);
         hide_state();
      }
   });


   


   $('#shipop').on('change',function(){

      var val = $(this).val();
      if(val == 'pickup'){
         $('#shipshow').removeClass('d-none');
         $("#ship-diff-address").parent().addClass('d-none');
         $('.ship-diff-addres-area').addClass('d-none');
         $('.ship-diff-addres-area input, .ship-diff-addres-area select').prop('required',false);
      }
      else{
         $('#shipshow').addClass('d-none');
         $("#ship-diff-address").parent().removeClass('d-none');
         $('.ship-diff-addres-area').removeClass('d-none');
         $('.ship-diff-addres-area input, .ship-diff-addres-area select').prop('required',true);
      }

   });

   $('.shipping').on('click',function(){
      getShipping();
   	
      let ref = $(this).attr('ref');
      let view = $(this).attr('view');
      let title = $(this).attr('data-form');
      $('#shipping_text'+ref).html(title +'+'+ view);
      var totalsss = $('.tgrandtotal').val();
      var ttotal = parseFloat($('.tgrandtotal').val()) + parseFloat(mship) + parseFloat(mpack);
    
      ttotal = parseFloat(ttotal).toFixed(2);
    
   	if(pos == 0){
   			$('#final-cost').html('{{ $curr->sign }}'+ttotal);
   		}
   		else{
   			$('#final-cost').html(ttotal+'{{ $curr->sign }}');
   		}
      $('#grandtotal').val(ttotal);
      $('#multi_shipping_id').val($(this).val());

   })


   $('.packing').on('click',function(){
      getPacking();
      let ref = $(this).attr('ref');
      let view = $(this).attr('view');
      let title = $(this).attr('data-form');
      $('#packing_text'+ref).html(title +'+'+ view);
      var ttotal = parseFloat($('.tgrandtotal').val()) + parseFloat(mship) + parseFloat(mpack);
      ttotal = parseFloat(ttotal).toFixed(2);
      if(pos == 0){
   			$('#final-cost').html('{{ $curr->sign }}'+ttotal);
   		}
   		else{
   			$('#final-cost').html(ttotal+'{{ $curr->sign }}');
   		}
      $('#grandtotal').val(ttotal);
      $('#multi_packaging_id').val($(this).val());
   })

   $("#check-coupon-form").on('submit', function () {

      var val = $("#code").val();

      
      var total = $("#grandtotal").val();
      var shipping_cost = $('.shipping_cost_view').val();
      ship_cost = parseFloat(shipping_cost.replace(/[₹,]/g, '').trim());
         $.ajax({
                  type: "GET",
                  url:mainurl+"/carts/coupon/check",
                  data:{code:val, total:total, shipping_cost:ship_cost},
                  success:function(data){
                    
                     if(data == 0)
                     {
                        toastr.error('{{__('Coupon not found')}}');
                           $("#code").val("");
                     }
                     else if(data[0] == 2)
                     {
                        toastr.error('{{__('Coupon already have been taken')}}');
                        $("#check-coupon-form").hide();
                        $("#coupon-link").hide();
                        $(".applied_coupon_code").show();
                        $("#coupon_code_show").val(data[1]);
                        $("#code").val("");
                     }

                     else if(data==8)
                     {
                        toastr.error('{{__('All redy use Coupon ')}}');
                        $("#code").val("");
                     }
                     else
                     {
                     $("#check-coupon-form").toggle();
                     $(".discount-bar").removeClass('d-none');
                  if(pos == 0){
                     $('.total-cost-dum #total-cost').html('{{ $curr->sign }}'+data[0]);
                     $('#discount').html('{{ $curr->sign }}'+data[2]);
                  }
                  else{
                     $('.total-cost-dum #total-cost').html(data[0]);
                     $('#discount').html(data[2]+'{{ $curr->sign }}');
                  }
                     $('#grandtotal').val(data[0]);
                     $('.tgrandtotal').val(data[0]);
                     $('#coupon_code').val(data[1]);
                     $('#coupon_discount').val(data[2]);
                     if(data[4] != 0){
                     $('.dpercent').html('('+data[4]+')');
                     }
                     else{
                     $('.dpercent').html('');
                     }
                  var ttotal = data[6] + parseFloat(mship) + parseFloat(mpack);
                  ttotal = parseFloat(ttotal);
                     if(ttotal % 1 != 0)
                     {
                        ttotal = ttotal.toFixed(2);
                     }

                        if(pos == 0){
                           $('#final-cost').html('{{ $curr->sign }}'+ttotal)
                        }
                        else{
                           $('#final-cost').html(ttotal+'{{ $curr->sign }}')
                        }
                           $('.applied_coupon_code').show();
                           $("#coupon-link").hide();
                           toastr.success(lang.coupon_found);
                           $("#code").val("");
                           $("#coupon_code_show").val(data[1]);
                              }
                           }
                        });
            return false;
   });

    $(".applied_coupon_code").on('submit', function (e) {
        e.preventDefault();
        var coupon_code = $("#coupon_code_show").val();
        var total = $("#grandtotal").val();
        var applied_coupon = $("#coupon_value").val();
        var coupon_discount = $("#coupon_discount").val();
        var shipping_cost = $('.shipping_cost_view').val();
         ship_cost = parseFloat(shipping_cost.replace(/[₹,]/g, '').trim());
        $.ajax({
            type: "GET", 
            url: mainurl + "/carts/coupon/check",
            data: {
                code: coupon_code,
                total: total,
                shipping_cost: ship_cost,
                applied_coupon: applied_coupon,
                coupon_discount: coupon_discount
            },
            success: function(data) {
                if (data['remove_coupen']) {
                    toastr.error('{{__('Coupon Remove Successfully')}}');
                }
               $("#check-coupon-form").show();
               $('.applied_coupon_code').hide();
               $('#final-cost').html(data['total'])
               $(".discount-bar").addClass('d-none');
               $("#coupon-link").show();
            },
            error: function(xhr, status, error) {
                toastr.error('{{__('An error occurred')}}');
                console.error("AJAX Error: ", status, error);
            }
        });
    });

      // $('.applied_coupon_code').on('click',function(){
      //    preventDefault();
      //    alert('new');
      //    window.location.href = "{{url('checkout')}}?remove_coupon=remove";
      // });`

      // Password Checking

   $("#open-pass").on( "change", function() {
      if(this.checked){
         $('.set-account-pass').removeClass('d-none');
         $('.set-account-pass input').prop('required',true);
         $('#personal-email').prop('required',true);
         $('#personal-name').prop('required',true);
      }
      else{
         $('.set-account-pass').addClass('d-none');
         $('.set-account-pass input').prop('required',false);
         $('#personal-email').prop('required',false);
         $('#personal-name').prop('required',false);

      }
   });

   // Password Checking Ends

   // Shipping Address Checking

   $("#ship-diff-address").on( "change", function() {
         if(this.checked){
            $('.ship-diff-addres-area').removeClass('d-none');
            $('.ship-diff-addres-area input, .ship-diff-addres-area select').prop('required',true);
         }
         else{
            $('.ship-diff-addres-area').addClass('d-none');
            $('.ship-diff-addres-area input, .ship-diff-addres-area select').prop('required',false);
         }

   });


   // Shipping Address Checking Ends


   
   function getShipping(shippingcost){
      if(shippingcost){
      let curr = parseFloat(shippingcost);
      $('.shipping_cost_view').html('{{ $curr->sign }}'+curr);
      $('.shipping_cost').html('{{ $curr->sign }}'+curr);
      $('.shipping_cost_view').val(curr);   

      var grandtotalString = $('.tgrandtotal').val();
      var grandtotal = parseFloat(grandtotalString.replace(/[₹,]/g, '').trim());
      var ttotal = grandtotal + curr + parseFloat(mpack);
        ttotal = Math.round(ttotal * 100) / 100;
      $('#final-cost').html('{{ $curr->sign }}'+ttotal);
      
     } else {
      mship = 0;
         $('.shipping_cost_view').html('{{ $curr->sign }}'+mship);
            $('.shipping').each(function(){
               if($(this).is(':checked')){
                  mship += parseFloat($(this).attr('data-price'));
               }
               $('.shipping_cost_view').html('{{ $curr->sign }}'+mship);
            });
     }
   }

   function getPacking(){
      mpack = 0;
      $('.packing').each(function(){
            if($(this).is(':checked')){
               mpack += parseFloat($(this).attr('data-price'));
            }
            $('.packing_cost_view').html('{{ $curr->sign }}'+mpack);
      });
   }



</script>
<script type="text/javascript">
   var ck = 0;

   	$('.checkoutform').on('submit',function(e){

   		if(ck == 0) {
   			e.preventDefault();
   		$('#pills-step1').removeClass('active');
   		$('#pills-step2-tab').click();

   	}else {
   		$('#preloader').show();
   	}

   	$('#pills-step2').addClass('active');
   	});



   // Step 2 btn DONE

   $('#step1-btn').on('click',function(){
   		$('#pills-step2').removeClass('active');
   		$('#pills-step1').addClass('active');
   		$('#pills-step1-tab').click();
   	});

       $('#step2-btn').on('click',function(){
   		$('#pills-step3').removeClass('active');
   		$('#pills-step2').addClass('active');
   		 $('#pills-step2-tab').removeClass('active');
   		 $('#pills-step3-tab').addClass('disabled');
   		$('#pills-step2-tab').click();


   	});



   	$('#step3-btn').on('click',function(){

   	 	if($('a.payment:first').data('val') == 'paystack'){
   			$('.checkoutform').attr('id','step1-form');
   		}

   		$('#pills-step2').removeClass('active');
   		$('#pills-step3-tab').click();

   		var shipping_user  = !$('input[name="shipping_name"]').val() ? $('input[name="name"]').val() : $('input[name="shipping_name"]').val();
   		var shipping_location  = !$('input[name="shipping_address"]').val() ? $('input[name="customer_address"]').val() : $('input[name="shipping_address"]').val();
   		var shipping_phone = !$('input[name="shipping_phone"]').val() ? $('input[name="phone"]').val() : $('input[name="shipping_phone"]').val();
   		var shipping_email= !$('input[name="shipping_email"]').val() ? $('input[name="email"]').val() : $('input[name="shipping_email"]').val();

   		$('#shipping_user').html('<i class="fas fa-user"></i>'+shipping_user);
   		$('#shipping_location').html('<i class="fas fas fa-map-marker-alt"></i>'+shipping_location);
   		$('#shipping_phone').html('<i class="fas fa-phone"></i>'+shipping_phone);
   		$('#shipping_email').html('<i class="fas fa-envelope"></i>'+shipping_email);

   		$('#pills-step1-tab').addClass('active');
   		$('#pills-step2-tab').addClass('active');
           $('#pills-step3').addClass('active');

   	});

   	$('#final-btn').on('click',function(){
   		ck = 1;
   	})



   	$('.payment').on('click',function(){

   		if($(this).data('val') == 'paystack'){
   			$('.checkoutform').attr('id','step1-form');
   		}

   		else if($(this).data('val') == 'mercadopago'){
   			$('.checkoutform').attr('id','mercadopago');
   			checkONE= 1;
   		}
   		else {
   			$('.checkoutform').attr('id','');
   		}
   		$('.checkoutform').attr('action',$(this).attr('data-form'));
           $('.payment').removeClass('active');
           $(this).addClass('active');
   		$('.pay-area #v-pills-tabContent .tab-pane.fade').not($(this).attr('href')).html('');
   		var show = $(this).attr('data-show');
   		if(show != 'no') {
   			$('.pay-area').removeClass('d-none');
   		}
   		else {
   			$('.pay-area').addClass('d-none');
   		}
   		$($('#v-pills-tabContent .tap-pane').removeClass('active show'));
   		$($('#v-pills-tabContent #'+$(this).attr('aria-controls'))).addClass('active show').load($(this).attr('data-href'));
   	})

           $(document).on('submit','#step1-form',function(){
           	$('#preloader').hide();
               var val = $('#sub').val();
               var total = $('#grandtotal').val();
   			    total = Math.round(total);
                   if(val == 0)
                   {
                   var handler = PaystackPop.setup({
                     key: '{{$paystack['key']}}',
                     email: $('input[name=customer_email]').val(),
                     amount: total * 100,
                     currency: "{{$curr->name}}",
                     ref: ''+Math.floor((Math.random() * 1000000000) + 1),
                     callback: function(response){
                       $('#ref_id').val(response.reference);
                       $('#sub').val('1');
                       $('#final-btn').click();
                     },
                     onClose: function(){
                     	window.location.reload();
                     }
                   });
                   handler.openIframe();
                       return false;
                   }
                   else {
                   	$('#preloader').show();
                       return true;
                   }
           });


   // Step 2 btn DONE



   	$('#step3-btn').on('click',function(){
        
   	 	if($('a.payment:first').data('val') == 'paystack'){
   			$('.checkoutform').attr('id','step1-form');
   		}
   		else if($('a.payment:first').data('val') == 'voguepay'){
   			$('.checkoutform').attr('id','voguepay');
   		}
   		else {
   			$('.checkoutform').attr('id','twocheckout');
   		}
   		$('#pills-step3-tab').removeClass('disabled');
   		$('#pills-step3-tab').click();

   		var shipping_user  = !$('input[name="shipping_name"]').val() ? $('input[name="customer_name"]').val() : $('input[name="shipping_name"]').val();
   		var shipping_location  = !$('input[name="shipping_address"]').val() ? $('input[name="customer_address"]').val() : $('input[name="shipping_address"]').val();
   		var shipping_phone = !$('input[name="shipping_phone"]').val() ? $('input[name="customer_phone"]').val() : $('input[name="shipping_phone"]').val();
   		var shipping_email= !$('input[name="shipping_email"]').val() ? $('input[name="customer_email"]').val() : $('input[name="shipping_email"]').val();

   		$('#shipping_user').html('<i class="fas fa-user"></i>'+shipping_user);
   		$('#shipping_location').html('<i class="fas fas fa-map-marker-alt"></i>'+shipping_location);
   		$('#shipping_phone').html('<i class="fas fa-phone"></i>'+shipping_phone);
   		$('#shipping_email').html('<i class="fas fa-envelope"></i>'+shipping_email);

   		$('#pills-step1-tab').addClass('active');
   		$('#pills-step2-tab').addClass('active');
   	});

        $(".mybtn1").click(function(e) {
            e.preventDefault(); // stop form from submitting

            let zipcode = $("#zipcode").val();
            $("#pincodeerror").html(''); // clear previous errors

            if (zipcode === '') {
               $("#pincodeerror").html('Please enter your zipcode');
               return false;
            }

            $.ajax({
               headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               url: mainurl + "/getPinCodeDetails",
               type: 'POST',
               data: { zipcode: zipcode },
               success: function(response) {
                     if (response.status === false) {
                        $('#pills-step2').removeClass('active');
                        $('#pills-step1').addClass('active');
                        $('#pills-step1-tab').click();
                        $("#pincodeerror").html(response.message);
                        return false;
                     } else {
                        // success: go to next step or apply shipping
                        getShipping(response.result.shipping_cost);

                        // Optionally activate step 2 if needed:
                        $('#pills-step1').removeClass('active');
                        $('#pills-step2').addClass('active');
                        $('#pills-step2-tab').click();
                     }
               },
               error: function() {
                     $("#pincodeerror").html("Please enter valid zipcode. Please try again.");
               }
            });
         });

   
      $(".mybtn2").click(function(){
         let zipcode = $("#zipcode").val();
         if(zipcode==''){
            $("#pincodeerror").html('Please enter your zipcode');
            return false;
         }
         Swal.fire({
            title: 'Please Wait!',
          
            allowOutsideClick: false,
            showCancelButton: false,
            showConfirmButton: false,
            onBeforeOpen: () => {
              Swal.showLoading()
              setTimeout(() => {
                Swal.hideLoading()
              }, 5000)
            },
         })
         $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:mainurl+"/getPinCodeDetails",
                type: 'post',
                data: { zipcode: zipcode },
                success: function(response)
                {
                  if(response.status==false){
                     $('#pills-step2').removeClass('active');
                     $('#pills-step1').addClass('active');
                     $('#pills-step1-tab').click();
                     $("#pincodeerror").html(response.message);
                     return false;
                  } else {
                     getShipping(response.result);
                     console.log("this is tesssss==================>",response);
                     console.log(response.result);
                  }
                }
            });
      });
      $(document).ready(function() {
      $('.js-example-basic-single').select2();
});



$(document).ready(function () {
    $('.zipcode').on('keyup', function (e) {
        let zipcode = $(this).val();
        // Allow only numeric input
        if (!/^\d+$/.test(zipcode)) {
            $(this).val('');
            return;
        }
        if (zipcode.length === 6) {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:mainurl+"/getPinCodeDetails",
                type: 'post',
                data: { zipcode: zipcode },
                success: function (response) {
                    if(response.status==true){
                        $("#show_state").val(response.result.state);
                        $("#show_city").val(response.result.city);
                        $("#select_country").val(response.result.country); 
                        return false;
                    } else {
                        getShipping(response.result.shipping_cost);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error: ', error);
                }
            });
        }
    });
});



$(document).ready(function () {
    $('.zipcodee').on('keyup', function (e) {
        let zipcode = $(this).val();
       
        // Allow only numeric input
        if (!/^\d+$/.test(zipcode)) {
            $(this).val('');
            return;
        }
        if (zipcode.length === 6) {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:mainurl+"/getPinCodeDetails",
                type: 'post',
                data: { zipcode: zipcode },
                success: function (response) {
                    if(response.status==true){
                        $("#show_statee").val(response.result.state);
                        $("#show_citye").val(response.result.city);
                        $("#select_countrye").val(response.result.country); 
                        return false;
                    } else {
                        getShipping(response.result.shipping_cost);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error: ', error);
                }
            });
        }
    });
});



</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const zipInput = document.getElementById('zipcode');
        const errorSpan = document.getElementById('pincodeerror');

        zipInput.addEventListener('input', function () {
            // Remove all non-digit characters
            this.value = this.value.replace(/\D/g, '');

            if (this.value.length > 6) {
                this.value = this.value.slice(0, 6); // Trim to 6 digits
            }

            if (this.value.length === 6) {
                errorSpan.textContent = '';
                this.classList.remove('is-invalid');
            } else {
                errorSpan.textContent = 'Please enter a 6-digit ZIP code.';
                this.classList.add('is-invalid');
            }
        });
    });
</script>


@endsection 