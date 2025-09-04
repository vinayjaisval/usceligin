@extends('layouts.front')
@section('content')
@include('partials.global.common-header')

@php
$billingAddresses = \App\Models\Address::where('user_id', Auth::user()->id)->where('is_billing', 1)->get();
$shippingAddresses = \App\Models\Address::where('user_id', Auth::user()->id)->where('is_billing', 2)->get();
$availableCoupons = App\Models\Coupon::where('status', 1)->get();
// In your controller
$billingAddressCount = App\Models\Address::where('is_billing', '1')->where('user_id', auth()->id())->count();
$shippingAddressCount = App\Models\Address::where('is_billing', '2')->where('user_id', auth()->id())->count();
@endphp
<style>
    .mybtn1, .mybtn2 {
         padding: 0px 12px; 
         margin-bottom: 00px;
   }
   .form-control {
      border: 1px solid #c4c4c4;
   }

   .form-check .form-check-label {
      width: auto;
   }

   .checkout__coupon-heading {
      align-items: center;
      background: #fff;
      border: 1px solid #bf8072;
      border-radius: 5px;
      color: #000;
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

   /* checkout */
   .card-all p,
   ol li {
      color: #000;

   }

   .card-all {
      border-radius: 8px;
   }

   .list-group-flush {
      border: 1px solid rgba(0, 0, 0, 0.125);
   }
</style>
<div class="container py-5">
   <div class="row">
      <div class="col-lg-12">
         <div class="checkout-area mb-0 pb-0">
            <div class="checkout-process">
               <ul class="nav" role="tablist">
                  <li class="nav-item">
                     <a class="nav-link active" id="pills-step1-tab" data-toggle="pill" href="#pills-step1" role="tab" aria-controls="pills-step1" aria-selected="true">
                        <span>1</span> Address
                        <i class="far fa-address-card"></i>
                     </a>
                  </li>
                  <!-- <li class="nav-item">
                     <a class="nav-link disabled" id="pills-step2-tab" data-toggle="pill" href="#pills-step2" role="tab" aria-controls="pills-step2" aria-selected="false">
                        <span>2</span> Orders
                        <i class="fas fa-dolly"></i>
                     </a>
                  </li> -->
                  <li class="nav-item">
                     <a class="nav-link disabled" id="pills-step3-tab" data-toggle="pill" href="#pills-step3" role="tab" aria-controls="pills-step3" aria-selected="false">
                        <span>2</span> Payment
                        <i class="far fa-credit-card"></i>
                     </a>
                  </li>
               </ul>
            </div>
         </div>
      </div>
      <hr>

      <!-- Billing Address -->
      <div class="row">
         <div class="col-md-8 mb-4">
            <div class="row">
               <div class="">
                  <div class="row" id="addressSection">
                     <div class="col-md-6 mb-4">
                        <h5>Choose a Billing Address</h5>
                           @if($billingAddressCount < 3)
                           <button class="btn rounded btn-outline-primary btn-sm mb-3"
                           data-bs-toggle="modal"
                           data-bs-target="#addressModal"
                           onclick="setAddressType('Billing')">
                           + Add New Billing Address
                           </button>
                           @else
                           <div class="alert alert-warning p-2">
                              You can only add up to 3 billing addresses. Please delete one before adding a new one.
                           </div>
                           @endif

                           <!-- <button class="btn rounded btn-outline-primary btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#addressModal" onclick="setAddressType('Billing')">+ Add New Billing Address</button> -->

                           @foreach($billingAddresses as $billing)

                           <div class="card card-all mb-3 border-primary mt-4">
                              <div class="card-body">
                                 <div class="form-check">
                                    <input class="form-check-input me-2" type="radio" name="billingAddress" value="{{ $billing->id }}" checked>
                                    <label class="form-check-label fw-bold">
                                       {{ $billing->customer_name }}
                                    </label>
                                 </div>
                                 <p class="mb-1">Add: {{ $billing->address }}</p>
                                 <p class="mb-1">Mobile No: {{ $billing->phone }}</p>
                                 <p class="fw-semibold mb-1">Pincode: {{ $billing->zip }}</p>
                               
                                 <div class="bb-customer-card-footer d-flex gap-2 justify-content-end">
                                  
                                 <form method="POST" action="{{ route('user-address-delete', $billing->id) }}" accept-charset="UTF-8" onsubmit="return confirm('Are you sure you want to delete this address?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="">
                                       <svg class="icon me-1 svg-icon-ti-ti-trash" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round">
                                             <path d="M4 7l16 0"></path>
                                             <path d="M10 11l0 6"></path>
                                             <path d="M14 11l0 6"></path>
                                             <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                             <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                       </svg>
                                    </button>
                                 </form>
                                 </div>
                              </div>
                           </div>
                           @endforeach
                     </div>

                     <!-- Shipping Address -->
                     <div class="col-md-6 mb-4">
                        <h5>Choose a Shipping Address</h5>
                        @if($shippingAddressCount < 3)
                           <button class="btn rounded btn-outline-primary btn-sm mb-3"
                           data-bs-toggle="modal"
                           data-bs-target="#addressModal"
                           onclick="setAddressType('Shipping')"  id="addShippingBtn"> 
                           + Add New Shipping Address
                           </button>
                           @else
                           <div class="alert alert-warning p-2">
                              You can only add up to 3 shipping addresses. Please delete one before adding a new one.
                           </div>
                           @endif
                           <!-- <button class="btn rounded btn-outline-primary btn-sm mb-3 me-2" data-bs-toggle="modal" data-bs-target="#addressModal" onclick="setAddressType('Shipping')">+ Add New Shipping Address</button> -->

                           @foreach($shippingAddresses as $shipping)


                           <div class="card card-all mb-3 border-primary mt-4">
                              <div class="card-body">
                                 <div class="form-check">
                                    <!-- <input class="form-check-input me-2" type="radio"  value="{{ $shipping->zip }}" name="shippingAddress" checked> -->
                                   
                                    
                                    <input class="form-check-input me-2" type="radio" value="{{ $shipping->zip }}"
                                    name="shippingAddress">
                                      
                                       



                                    <label class="form-check-label fw-bold">
                                       {{ $shipping->customer_name }}
                                    </label>
                                 </div>
                                 <p class="mb-1">{{ $shipping->address }}</p>
                                 <p class="mb-1">Mobile No.: {{ $shipping->phone }}</p>
                                 <p class="mb-1">Pincode: {{ $shipping->zip }}</p>

                                 <div class="bb-customer-card-footer d-flex gap-2 justify-content-end">
                                   
                                 <form method="POST" action="{{ route('user-address-delete', $shipping->id) }}" accept-charset="UTF-8" onsubmit="return confirm('Are you sure you want to delete this address?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="">
                                       <svg class="icon me-1 svg-icon-ti-ti-trash" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round">
                                             <path d="M4 7l16 0"></path>
                                             <path d="M10 11l0 6"></path>
                                             <path d="M14 11l0 6"></path>
                                             <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                             <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                       </svg>
                                    </button>
                                 </form>

                                 </div>
                              </div>
                           </div>
                           @endforeach
                     </div>
                  </div>

                  <div class="col-lg-12 mb-4">
                     <form id="checkout-form" method="POST" action="">
                        @csrf

                        <div id="paymentForm" class="card shadow-sm mt-4 d-none">
                           <div class="card-body">
                              <!-- <h5 class="fw-bold">Shipping Info</h5>
                              <hr>
                              <p class="text-muted">
                                 <i class="bi bi-person-fill text-danger me-2"></i>7065469499
                              </p>

                              <hr> -->

                              {{-- Payment Info --}}
                              <h5 class="fw-bold mt-4">Payment Info</h5>
                              <hr>

                              <div class="nav flex-column" role="tablist" aria-orientation="vertical">
                                 
                                 @foreach($gateways as $gt)
                                 @if($gt->checkout == 1)
                                 @if($gt->type == 'manual')
                                 <div class="form-check mb-3">
                                    <input class="form-check-input payment" type="radio" name="paymentMethod"
                                       id="manual_{{ $gt->id }}"
                                       data-val="{{ $gt->keyword }}"
                                       data-show="{{ $gt->showForm() }}"
                                       data-form="{{ $gt->showCheckoutLink() }}"
                                       data-href="{{ route('front.load.payment',['slug1' => $gt->showKeyword(),'slug2' => $gt->id]) }}">
                                    <label class="form-check-label fw-bold" for="manual_{{ $gt->id }}">
                                       {{ $gt->title }}
                                       @if($gt->subtitle)
                                       <div class="text-muted small">{{ $gt->subtitle }}</div>
                                       @endif
                                    </label>
                                 </div>
                                 @elseif($gt->type != 'manual')
                                 <div class="form-check mb-3">
                                    <input class="form-check-input payment" type="radio" name="paymentMethod"
                                       id="auto_{{ $gt->id }}"
                                       data-val="{{ $gt->keyword }}"
                                       data-show="{{ $gt->showForm() }}"
                                       data-form="{{ $gt->showCheckoutLink() }}"
                                       data-href="{{ route('front.load.payment',['slug1' => $gt->showKeyword(),'slug2' => $gt->id]) }}">
                                    <label class="form-check-label fw-bold" for="auto_{{ $gt->id }}">
                                       {{ $gt->name }}
                                       @if($gt->information)
                                       <div class="text-muted small">{{ $gt->getAutoDataText() }}</div>
                                       @endif
                                    </label>
                                 </div>
                                 @endif
                                 @endif
                                 @endforeach

                                 {{-- Wallet Checkout --}}
                                 @if(auth()->check())
                                 <div class="form-check mb-3">
                                    <input class="form-check-input payment" type="radio" name="paymentMethod"
                                       id="wallet_radio"
                                       data-val="wallet"
                                       data-show="no"
                                       data-form="{{ route('front.wallet.submit') }}">
                                    <label class="form-check-label fw-bold" for="wallet_radio">
                                       {{ __('Wallet') }}
                                       <div class="text-muted small">{{ __('Pay from your wallet') }}</div>
                                    </label>
                                 </div>
                                 @endif
                              </div>

                              {{-- Hidden Inputs --}}
                              <input type="hidden" name="selected_payment_method" id="selected_payment_method">
                              <input type="hidden" name="selected_payment_form" id="selected_payment_form">
                              <input type="hidden" name="coupon_code" id="coupon_code">
                              <input type="hidden" name="coupon_discount" class="coupon_discount">
                              <input type="hidden" name="total" id="grandtotal" value="0">
                              <input type="hidden" name="shippingCost" id="shippingCost" class ="shippingCost" value="0">
                              <input type="hidden" name="refferal_discount" value="{{$refferal_discount}}">

                              <input type="hidden" name="billingAddress" class="billingAddress" value="{{ $billing->id ?? '' }}">
                              <input type="hidden" name="shippingAddress" value="{{ $shipping->id ?? '' }}">
                              <!-- Action Buttons -->
                              <div class="d-flex gap-2 mt-4">
                                 <button class="btn btn-secondary mybtn11" type="button" onclick="goBackToAddress()">Back</button>
                                 <button type="submit" id="pay-now-btn" class="btn btn-danger mybtn2">{{ __('Pay Now') }}</button>
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>

               </div>
            </div>

         </div>


         @if(Session::has('cart'))
         @php
         $cartTotal = Session::get('cart')->totalPrice;
         
         $user = App\Models\User::where('id', Auth::id())->select('reffered_by')->first();
         $orderCount = App\Models\Order::where('user_id', Auth::id())->count();

         // Determine final total
         if (Session::has('coupon_total')) {
         $finalTotal = round($totalPrice * $curr->value, 2);
         } elseif (Session::has('coupon_total1')) {
         $finalTotal = preg_replace("/[^0-9,.]/", "", Session::get('coupon_total1'));
         } else {
         $finalTotal = round($totalPrice * $curr->value, 2);
         }
         @endphp

         {{-- Hidden Inputs --}}
         <input type="hidden" name="total" id="grandtotal" value="{{ $finalTotal }}">
         <input type="hidden" class="tgrandtotal" value="{{ $finalTotal }}">
         <input type="hidden" id="original_tax" value="0">
         <input type="hidden" id="wallet-price" name="wallet_price" value="0">
         <input type="hidden" id="refferal_discount" name="refferal_discount" value="{{$refferal_discount}}">

         <input type="hidden" id="ttotal" value="{{ App\Models\Product::convertPrice($totalPrice) }}">
         <input type="hidden" name="coupon_code" id="coupon_code" value="{{ Session::get('coupon_code') ?? '' }}">
         <input type="hidden" name="coupon_discount" class="coupon_discount" value="{{ Session::get('coupon') ?? '' }}">
         <input type="hidden" name="coupon_id" id="coupon_id" value="{{ Session::get('coupon_id') ?? '' }}">
         <input type="hidden" name="user_id" id="user_id" value="{{ Auth::id() }}">

         {{-- Referral Discount --}}
        
         @if($orderCount == 0 && $user && $user->reffered_by)
         <input type="hidden" id="refferal_discount" name="refferal_discount" value="{{ $refferal_discount ?? '0' }}">
         @endif

         {{-- Order Summary UI --}}
         <div class="col-md-4 mb-4">
            <div class="card card-all bg-light">
               <div class="card-body">
                  <h5 class="card-title mb-4">Order Summary (INR)</h5>
                  <ul class="list-group list-group-flush mb-3">
                     <li class="list-group-item d-flex justify-content-between fw-medium">
                        Sub Total
                        <span id="subTotal">{{ App\Models\Product::convertPrice($cartTotal) }}</span>
                     </li>

                     @if($orderCount == 0 && $user && $user->reffered_by)
                     <li class="list-group-item d-flex justify-content-between">
                        Referral Discount
                        <span class="text-success">-{{ App\Models\Product::convertPrice($refferal_discount ?? 0) }}</span>
                     </li>
                     @endif

                     <li class="list-group-item d-flex justify-content-between">
                        Discount
                        <span class="coupon_discount">
                           {{ App\Models\Product::convertPrice(0) }}
                        </span>
                     </li>

                     <li class="list-group-item d-flex justify-content-between">
                        Shipping Fee
                        <span class="shippingCost">{{ App\Models\Product::convertPrice(0) }}</span>
                     </li>
                  </ul>

                  <div class="d-flex justify-content-between fw-bold fs-5 mb-3">
                     <span>Total Amount</span>
                     <span id="total"></span>
                  </div>

                  <button class="btn btn-primary w-100 rounded" onclick="showPaymentForm()">CONTINUE TO PAYMENT</button>






               </div>
            </div>

            {{-- Coupon Section --}}
            <div class="my-4">
               <div class="border rounded-3 p-4 shadow-sm bg-white">
                  <div class="input-group mb-3">
                     <input type="text" class="form-control" placeholder="Coupon Code" id="couponCodeInput"
                        @if(Session::has('already')) value="{{ Session::get('already') }}" readonly @endif>

                     <button class="btn btn-outline-primary {{ Session::has('already') ? 'd-none' : '' }}" type="button" id="applyCouponBtn">
                        APPLY
                     </button>

                     <button class="btn btn-danger {{ Session::has('already') ? '' : 'd-none' }}" type="button" id="removeCouponBtn">
                        REMOVE
                     </button>
                  </div>

                  {{-- Available Coupons --}}
                  @if(!Session::has('refferel_user_id'))
                  @php
                  $coupon_use = App\Models\Order::where('user_id', Auth::id())->whereNotNull('coupon_code')->count();
                  $available_coupons = App\Models\Coupon::where('id', 1)->select('id', 'code', 'price')->get();
                
                
                  @endphp

                  @if($coupon_use == 0 && $available_coupons->count())
                  <div class="border border-primary rounded-3 p-3 mt-4 bg-light position-relative">
                     <div class="checkout__coupon-heading">
                        <img width="32" height="32" src="{{ asset('assets/images/coupon-code.gif') }}" alt="coupon code icon">
                        Coupon codes ({{ $available_coupons->count() }})
                     </div>

                     @foreach ($available_coupons as $item)
                     <h5 class="text-danger fw-bold mt-3">{{ $item->price }} %</h5>
                     <p class="mb-2 small">Discount {{ $item->price }}% — One-time use per customer only!</p>

                     <div class="input-group">
                        <input type="text" class="form-control bg-white" value="{{ $item->code }}" readonly>
                        <button class="btn btn-outline-primary" onclick="copyAndApplyCoupon('{{ $item->code }}')">Copy</button>
                     </div>
                     @endforeach
                  </div>
                  @endif
                  @endif
               </div>
            </div>
         </div>
         @endif


      </div>
   </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content border-0 rounded-3 shadow">
         <div class="modal-header border-0">
            <h5 class="modal-title fw-semibold">Add <span id="addressTypeTitle"></span> Address</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>

         <div class="modal-body pt-0">


            <form action="{{route('user-address-store')}}" method="POST">
               @csrf

               <div class="row">
                  <div class="col-md-6  mb-3">

                     <label class="form-label">Name</label>
                     <input type="text" name="customer_name" class="form-control" placeholder="Enter name">
                  </div>
                  <div class=" col-md-6  mb-3">
                     <label class="form-label">Phone No.</label>

                                   <input 
                                       class="input-field form-control border" 
                                       type="text" 
                                       name="phone" 
                                       placeholder="{{ __('Phone Number') }}" 
                                       required 
                                       maxlength="10"
                                       minlength="10"
                                       oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                       value="">

                     
                  </div>
                  <div class=" col-md-6  mb-3">
                     <label class="form-label">Email.</label>
                     <input type="text" name="email" class="form-control" placeholder="Enter Email">
                  </div>
                  <div class="col-md-6 mb-3">
                     <label class="form-label">Pin Code</label>
                     <input name="zip" id="zipp" type="text" class="input-field form-control border" placeholder="Pin Code" value="" maxlength="6">

                  </div>
               </div>
               <div class="row">

                  <div class="col-md-6 mb-3">
                     <label class="form-label">Country</label>
                     <input name="country" id="country_id" type="text" class="input-field form-control border" placeholder="Country" value="" readonly>

                     <!-- <input type="text" name="country" class="form-control" placeholder="Enter Country"> -->
                  </div>
                  <div class="col-md-6 mb-3">
                     <label class="form-label">State</label>
                     <input name="state_id" id="state_id" type="text" class="input-field form-control border" placeholder="State" value="" readonly>

                     <!-- <input type="text" name="state_id" class="form-control" placeholder="Enter State"> -->
                  </div>
                  <div class="col-md-6 mb-3">
                     <label class="form-label">City/Town</label>
                     <input name="city_id" id="city_id" type="text" class="input-field form-control border" placeholder="City" value="" readonly>

                     <!-- <input type="text" name="city_id" class="form-control" placeholder="Enter city/town"> -->
                  </div>
                  <div class="col-md-6 mb-3">
                     <label class="form-label">House No.</label>
                     <input type="text" name="flat_no" class="form-control" placeholder="Enter city/town">
                  </div>
                  <div class="col-md-6 mb-3">
                     <label class="form-label">Landmark</label>
                     <input type="text" name="landmark" class="form-control" placeholder="Enter landmark">
                  </div>
                  <input type="hidden" name="save_button_type" id="save_button_type" value="SHIPPING">
                  <input type="hidden" name="user_id" id="user_id" value="{{ Auth::check() ? Auth::user()->id : '' }}">

                  <div class=" col-md-6 mb-3">
                     <label class="form-label">Address</label>
                     <input type="text" name="address" class="form-control" placeholder="Enter Address">
                  </div>
               </div>
              
               <div class="form-check mb-3 " id="sameAddressDiv">
                  <input class="form-check-input" type="checkbox" id="sameAddressCheckbox" name="same_address_shipping" value="1">
                  <label class="form-check-label" for="sameAddressCheckbox">
                     Same as Shipping Address
                  </label>
               </div>

               <button type="submit" class="btn btn-dark w-100 rounded-1">SAVE <span id="saveBtnType"></span> ADDRESS</button>

            </form>
         </div>


      </div>
   </div>
</div>





@includeIf('partials.global.common-footer')
@endsection
@section('script')


<script>




   function showPaymentForm() {
      
      let shippingCost = parseFloat($(".shippingCost").text().replace(/[^\d.-]/g, ''));
   
      let billingAddress = parseFloat($(".billingAddress").val());
     

  

    // Validate
    if (isNaN(shippingCost) || shippingCost <= 0) {
        alert("Please select a valid shipping method before continuing to payment.");
        return;
    }
    if (isNaN(billingAddress) || billingAddress <= null) {
        alert("Please select a valid billing method before continuing to payment.");
        return;
    }

    // Show payment form section if valid
    
      document.getElementById('addressSection').classList.add('d-none'); // Hide addresses
      document.getElementById('paymentForm').classList.remove('d-none'); // Show payment
   }

   function goBackToAddress() {
      document.getElementById('paymentForm').classList.add('d-none'); // Hide payment
      document.getElementById('addressSection').classList.remove('d-none'); // Show addresses
   }

   function setAddressType(type) {
      document.getElementById('addressTypeTitle').innerText = type;
      document.getElementById('saveBtnType').innerText = type.toUpperCase();

   }
</script>
<script>
   document.addEventListener('DOMContentLoaded', function() {
      const span = document.getElementById('saveBtnType');
      const hiddenInput = document.getElementById('save_button_type');

      // Optional: if you're changing the span dynamically via JS, keep this in sync
      const observer = new MutationObserver(() => {
         hiddenInput.value = span.innerText.trim();
      });

      observer.observe(span, {
         childList: true
      });
   });
</script>

<script>
   function copyAndApplyCoupon(code) {
      alert('Copied coupon code: ' + code);
      navigator.clipboard.writeText(code).then(() => {
         $("#couponCodeInput").val(code);
         $("#applyCouponBtn").click();
      }).catch(err => {
         alert("Failed to copy coupon code.");
      });
   }
</script>


<script>
   $(document).ready(function() {
      const $couponInput = $("#couponCodeInput");
      const $applyBtn = $("#applyCouponBtn");
      const $removeBtn = $("#removeCouponBtn");
      const $discountAmount = $(".coupon_discount");
      const $total = $("#total");
     
     
      const $grandTotal = $("#grandtotal");
      const $tGrandTotal = $(".tgrandtotal");
      const $shippingCostInput = $(".shippingCost");

      const $subTotal = $("#subTotal");
      const $refferal_discount = $("#refferal_discount");

      const $coupon_discount = $(".coupon_discount");


      function parseCurrency(value) {
         if (!value || typeof value !== "string") return 0;
         return parseFloat(value.replace(/[₹,]/g, '').trim()) || 0;
      }

      function updateTotalDisplay(newTotal) {
         // Remove ₹ and commas from the string
         let cleanedTotal = newTotal.toString().replace(/[^0-9.]/g, "");

         let parsedTotal = parseFloat(cleanedTotal);

         if (isNaN(parsedTotal)) {
            console.error("Invalid total:", newTotal);
            parsedTotal = 0;
         }

         const formatted = "₹ " + parsedTotal.toFixed(2);
         console.log(formatted);

         // Update visible span
         $("#total").text(formatted);

         // Update hidden inputs
         $("#grandtotal").val(parsedTotal);
         $(".tgrandtotal").val(parsedTotal);
      }




      function getShippingCost() {

         return parseCurrency($shippingCostInput.val());
      }

      // Coupon Apply
      $applyBtn.on("click", function() {
         const code = $couponInput.val().trim();
         const subtotal = parseCurrency($subTotal.text());
         const shippingCost = getShippingCost();

         if (!code) {
            toastr.warning("Please enter a coupon code.");
            return;
         }

         $.ajax({
            type: "GET",
            url: mainurl + "/carts/coupon/check",
            data: {
               code: code,
               total: subtotal,
               shipping_cost: shippingCost
            },
            success: function(data) {
               console.log(data);
               if (data == 0) {
                  toastr.error("Coupon not found.");
                  $couponInput.val('');
               } else if (data[0] == 2 || data == 8) {
                  toastr.error("Coupon already used.");
                  $couponInput.val('');
               } else {
                  toastr.success("Coupon applied successfully!");
                  $couponInput.val(code).prop("readonly", true);
                  $applyBtn.addClass("d-none");
                  $removeBtn.removeClass("d-none");

                  // Update discount and total
                  $discountAmount.text("₹ " + data[2]);
                  updateTotalDisplay(data[0]);

                  $("#coupon_code").val(data[1]);
                  $(".coupon_discount").val(data[2]);

                  if (data[4] != 0) {
                     $(".dpercent").html('(' + data[4] + ')');
                  } else {
                     $(".dpercent").html('');
                  }
               }
            },
            error: function() {
               toastr.error("An error occurred while applying the coupon.");
            }
         });
      });

      // Coupon Remove
      $removeBtn.on("click", function(e) {
         e.preventDefault();
         const code = $couponInput.val().trim();

         const subtotal = parseCurrency($subTotal.text());

         const coupon_discount = parseCurrency($coupon_discount.text());

        
         const shippingCost = getShippingCost();

         // alert(shippingCost);

         $.ajax({
            type: "GET",
            url: mainurl + "/carts/coupon/check",
            data: {
               code: code,
               applied_coupon: 0,
               total: subtotal,
               coupon_discount: 0,
               shipping_cost: shippingCost
            },
            success: function(data) {
               console.log(data);
               toastr.info("Coupon removed successfully!");

               $couponInput.val("").prop("readonly", false);
               $applyBtn.removeClass("d-none");
               $removeBtn.addClass("d-none");

               $discountAmount.text("₹ 0.00");
               updateTotalDisplay(data.total || (subtotal + shippingCost));

               // Clear coupon-related hidden fields
               $("#coupon_code").val('');
               $(".coupon_discount").val('');
            },
            error: function() {
               toastr.error("An error occurred while removing the coupon.");
            }
         });
      });

      // Shipping Zip Handler
      function fetchShipping(zip) {
         if (!zip) return;

         $.ajax({
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: mainurl + "/getPinCodeDetails",
            type: 'POST',
            data: {
               zipcode: zip
            },
            success: function(response) {
               if (response.status) {
                  const cost = parseFloat(response.result.shipping_cost).toFixed(2);

                  $(".shippingCost").text("₹ " + cost);
                  $(".shippingCost").val(cost);

                  $shippingCostInput.val(cost);

                  // Recalculate total
                  const subtotal = parseCurrency($subTotal.text());
                  const referral_discount = parseCurrency($refferal_discount.val());

                  const discount = parseCurrency($discountAmount.text());
                  const final = subtotal - referral_discount - discount + parseFloat(cost);
                  console.log('Final:', referral_discount);
                  updateTotalDisplay(final);
               }
            },
            error: function(xhr, status, error) {
               console.error("Shipping error:", error);
            }
         });
      }


      const savedZip = localStorage.getItem('selectedShippingZip');
   console.log('Saved ZIP from localStorage:', savedZip); // For debugging

   // Check if saved ZIP exists and select the corresponding radio
   if (savedZip) {
      const radio = $(`input[name='shippingAddress'][value='${savedZip}']`);
      if (radio.length) {
         radio.prop('checked', true);
         fetchShipping(savedZip);
      } else {
         console.warn('No radio found for saved ZIP:', savedZip);
      }
   }

   // When user selects a different shipping address
   $("input[name='shippingAddress']").on('change', function () {
      const zip = $(this).val();
      console.log('ZIP selected:', zip); // For debugging
      localStorage.setItem('selectedShippingZip', zip);
      fetchShipping(zip);
   });


   });
</script>



<!-- <script>

$(document).on("click", "#pay-now-btn", function (e) {
   alert("clicked");
    e.preventDefault();

    let selectedPayment = $("input[name='paymentMethod']:checked");

    if (selectedPayment.length === 0) {
        alert("Please select a payment method.");
        return;
    }
    alert("Selected payment: " + selectedPayment.data("form"));

    let paymentData = {
        method: selectedPayment.data("val"),
        show: selectedPayment.data("show"),
        form: selectedPayment.data("form"),
        href: selectedPayment.data("href") || null
    };

    console.log("Selected Payment Method:", paymentData);

    // Optional: Submit via AJAX or set hidden form fields
    $("#selected_payment_method").val(paymentData.method);
    $("#selected_payment_form").val(paymentData.form);

    // If auto/manual wallet has its own form
    if (paymentData.form) {
        window.location.href = paymentData.form;
    }
});

</script> -->

<script>
$(document).on("click", "#pay-now-btn", function (e) {
   e.preventDefault();

   let selectedPayment = $("input[name='paymentMethod']:checked");

   if (selectedPayment.length === 0) {
      alert("Please select a payment method.");
      return;
   }

   let paymentData = {
      method: selectedPayment.data("val"),
      show: selectedPayment.data("show"),
      form: selectedPayment.data("form"),
      href: selectedPayment.data("href") || null
   };
console.log("Selected Payment Method:", paymentData);
   // Set hidden fields
   $("#selected_payment_method").val(paymentData.method);
   $("#selected_payment_form").val(paymentData.form);

   // ✅ Set the form action dynamically
   $("#checkout-form").attr("action", paymentData.form);

   // ✅ Submit the form
   $("#checkout-form").submit();
});

</script>

<script>
$(document).ready(function () {
    let fetchedPin = '';

    $('#zipp').on('keyup', function (e) {
        let pincode = $(this).val().trim();

        // Only trigger on exactly 6 digits and not previously fetched
        if (pincode.length === 6 && /^\d{6}$/.test(pincode) && pincode !== fetchedPin) {
            fetchedPin = pincode;

            // Optional: show loading indicator
            $('#city_id, #state_id, #country_id').val('Loading...');

            $.ajax({
                url: "https://api.postalpincode.in/pincode/" + pincode,
                type: "GET",
                success: function (response) {
                    if (response[0].Status === "Success" && response[0].PostOffice.length > 0) {
                        let postOffice = response[0].PostOffice[0];
                        $('#city_id').val(postOffice.District);
                        $('#state_id').val(postOffice.State);
                        $('#country_id').val(postOffice.Country);
                    } else {
                        $('#city, #state, #country').val('');
                        alert("Invalid PIN code.");
                    }
                },
                error: function () {
                    $('#city, #state, #country').val('');
                    alert("Could not fetch data. Try again.");
                }
            });
        } else if (pincode.length < 6) {
            $('#city_id, #state_id, #country_id').val('');
        }
    });
});
</script>
<script>
  document.getElementById('addShippingBtn').addEventListener('click', function () {
 
    // Hide the div when the button is clicked
    document.getElementById('sameAddressDiv').style.display = 'none';
  });
</script>
@endsection