@extends('layouts.front')
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.0/dist/sweetalert2.min.css">

@endsection
@section('content')
@include('partials.global.common-header')
@php
$billingAddresses = \App\Models\Address::where('user_id', Auth::user()->id)->where('is_billing', 1)->get();
$shippingAddresses = \App\Models\Address::where('user_id', Auth::user()->id)->where('is_billing', 2)->get();
$availableCoupons = App\Models\Coupon::where('status', 1)->get();
@endphp
<div class="container my-5">
    <form action="" method="POST">
        @csrf
        <div class="row">
            {{-- Left Column: Address Selection --}}
            <div class="col-lg-8">
              

                {{-- Shipping Addresses --}}
                <h5 class="mt-5">Choose a Shipping Address</h5>
                <button type="button" class="btn btn-sm btn-outline-primary mb-3" data-bs-toggle="modal" data-bs-target="#addShippingModal">
                    + Add New Shipping Address
                </button>

                <div class="row">
                    @foreach($shippingAddresses as $shipping)
                    <div class="col-md-6 mb-3">
                        <div class="card h-100 {{ old('shipping_address_id') == $shipping->id ? 'border-primary' : '' }}">
                            <div class="card-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="shipping_address_id" value="{{ $shipping->id }}" {{ $loop->first ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold">{{ $shipping->name }}</label>
                                </div>
                                <p class="mb-1">{{ $shipping->address }}</p>
                                <p class="mb-1">Mobile No.: {{ $shipping->phone }}</p>
                                <div class="mt-2">
                                    <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                    <button type="button" class="btn btn-sm btn-outline-danger">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>


                {{-- Billing Addresses --}}
                <h5>Choose a Billing Address</h5>
                <button type="button" class="btn btn-sm btn-outline-primary mb-3" data-bs-toggle="modal" data-bs-target="#addBillingModal">
                    + Add New Billing Address
                </button>

                <div class="row">
                    @foreach($billingAddresses as $billing)
                    <div class="col-md-6 mb-3">
                        <div class="card h-100 {{ old('billing_address_id') == $billing->id ? 'border-primary' : '' }}">
                            <div class="card-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="billing_address_id" value="{{ $billing->id }}" {{ $loop->first ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold">{{ $billing->name }}</label>
                                </div>
                                <p class="mb-1">{{ $billing->address }}</p>
                                <p class="mb-1">Mobile No.: {{ $billing->phone }}</p>
                                @if($billing->company_name)
                                    <p class="mb-1 fw-bold">{{ $billing->company_name }}</p>
                                    <p class="mb-0">GSTIN: {{ $billing->gst_number }}</p>
                                @endif
                                <div class="mt-2">
                                    <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                    <button type="button" class="btn btn-sm btn-outline-danger">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Right Column: Order Summary --}}
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header fw-bold">Order Summary (INR)</div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <span>Artwork MRP</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Discount</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>GST</span>
                        </div>
                        <div class="d-flex justify-content-between fw-bold">
                            <span>Sub Total</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <span>Shipping Fee</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Shipping GST</span>
                        </div>
                        <hr>
                        {{-- COUPON SECTION --}}
                        <div class="card mb-4">
                           <div class="card-header fw-bold">Apply Coupon</div>
                           <div class="card-body">
                              <div class="input-group">
                                    <input type="text" name="coupon_code" id="coupon_code" class="form-control" placeholder="Enter coupon code">
                                    <button type="button" class="btn btn-outline-primary" onclick="applyCoupon()">Apply</button>
                              </div>
                              @if(session('coupon'))
                                    <div class="mt-2 text-success">
                                       <strong>Applied:</strong>  - ₹ OFF
                                    </div>
                              @endif
                           </div>
                        </div>
                        @if(isset($availableCoupons) && count($availableCoupons))
                        <div class="card mb-4">
                           <div class="card-header fw-bold">Available Coupons</div>
                           <div class="card-body">
                                 <ul class="list-group">
                                    @foreach($availableCoupons as $coupon)
                                       <li class="list-group-item d-flex justify-content-between align-items-center">
                                             <div>
                                                <strong>{{ $coupon->code }}</strong> - ₹{{ $coupon->price }} off
                                                <small class="d-block text-muted">{{ $coupon->description }}</small>
                                             </div>
                                             <button type="button" class="btn btn-sm btn-outline-success" onclick="useCoupon('{{ $coupon->code }}')">Use</button>
                                       </li>
                                    @endforeach
                                 </ul>
                           </div>
                        </div>
                     @endif

                        <div class="d-flex justify-content-between fw-bold fs-5">
                            <span>Total Amount</span>
                        </div>
                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-primary w-100">CONTINUE TO PAYMENT</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>




@include('includes.address-form', ['type' => 'billing'])
@include('includes.address-form', ['type' => 'shipping'])


@includeIf('partials.global.common-footer')
@endsection
@section('script')
<script src="https://js.paystack.co/v1/inline.js"></script>
<!-- <script src="https://sdk.mercadopago.com/js/v2"></script>
<script src="https://www.2checkout.com/checkout/api/2co.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.0/dist/sweetalert2.all.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->


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

<script>
    function useCoupon(code) {
        document.getElementById('coupon_code').value = code;
        applyCoupon();
    }

    function applyCoupon() {
        const code = document.getElementById('coupon_code').value;
        if (!code) return alert('Please enter a coupon code.');

        fetch('', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({ coupon_code: code }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Coupon applied successfully!');
                location.reload(); // Reload to update discount values
            } else {
                alert(data.message || 'Invalid coupon code.');
            }
        });
    }
</script>


@endsection 