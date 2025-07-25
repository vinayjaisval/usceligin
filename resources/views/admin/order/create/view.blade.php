@extends('layouts.admin')

@section('styles')

<style type="text/css">
   .order-table-wrap table#example2 {
      margin: 10px 20px;
   }
</style>

@endsection


@section('content')

<div class="content-area">
   <div class="mr-breadcrumb">
      <div class="row">
         <div class="col-lg-12">
            <h4 class="heading">{{ __('Order Details') }} <a class="add-btn" href="javascript:history.back();"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h4>
            <ul class="links">
               <li>
                  <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
               </li>
               <li>
                  <a href="javascript:;">{{ __('Orders') }}</a>
               </li>
               <li>
                  <a href="javascript:;">{{ __('Order Details') }}</a>
               </li>
            </ul>
         </div>
      </div>
   </div>
   <div class="order-table-wrap">
      <div class="row">

         <div class="col-lg-12 order-details-table">
            <div class="mr-table">
               <h4 class="title">
                  {{ __('Products') }}
               </h4>
               <div class="table-responsive">
                  <table class="table table-hover dt-responsive" cellspacing="0" width="100%">
                     <thead>
                        <tr>
                        <tr>
                           <th>{{ __('Product ID#') }}</th>
                           <th>{{ __('Product Title') }}</th>
                           <th>{{ __('Price') }}</th>
                           <th>{{ __('Details') }}</th>
                           <th>{{ __('Discount') }}</th>

                           <th>{{ __('Subtotal') }}</th>

                        </tr>
                        </tr>
                     </thead>
                     <tbody>
                        
                        @php
                         $shipping_cost = Session::get('order_address');
                         $qty = 0;
                        @endphp
                        @foreach($cart->items as $key1 => $product)
                              @php
                                 $qty += $product['qty'];
                              @endphp
                        <tr>
                           <td><input type="hidden" value="{{$key1}}">{{ $product['item']['id'] }}</td>
                           <td>
                              <img src="{{asset('assets/images/products/'.$product['item']['photo'])}}" alt="">
                              <br>
                              <input type="hidden" value="{{ $product['license'] }}">
                              <a target="_blank" href="{{ route('front.product', $product['item']['slug']) }}">{{mb_strlen($product['item']['name'],'utf-8') > 30 ? mb_substr($product['item']['name'],0,30,'utf-8').'...' : $product['item']['name']}}</a>
                           </td>
                           <td class="product-price">
                              <span>{{ App\Models\Product::convertPrice($product['item_price']) }}
                              </span>
                           </td>
                           <td>
                             
                              <p>
                                 <strong>{{ __('Qty') }} :</strong> {{$product['qty']}} {{ $product['item']['measure'] }}
                              </p>
                              @if(!empty($product['keys']))
                              @foreach( array_combine(explode(',', $product['keys']), explode(',', $product['values'])) as $key => $value)
                              <p>
                                 <b>{{ ucwords(str_replace('_', ' ', $key))  }} : </b> {{ $value }}
                              </p>
                              @endforeach
                              @endif
                           </td>
                           <td class="product-subtotal">
                              <p class="d-inline-block"
                                 id="prc{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">
                                 {{ App\Models\Product::convertPrice($product['discount']) }}
                              </p>
                              @if ($product['discount'] != 0)
                              <strong>{{$product['discount']}} %{{__('off')}}</strong>
                              @endif
                           </td>
                           <td class="product-subtotal">
                              <p class="d-inline-block"
                                 id="prc{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">
                                 {{ App\Models\Product::convertPrice($product['price']) }}
                              </p>
                              @if ($product['discount'] != 0)
                              <strong>{{$product['discount']}} %{{__('off')}}</strong>
                              @endif
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
         <div class="col-lg-6 my-5">
            <div class="special-box">
               <div class="heading-area">
                  <h4 class="title">
                     {{ __('Customer Details') }}
                  </h4>
               </div>
               <div class="table-responsive-sm">
                  <table class="table">
                     <tbody>
                        <tr>
                           <th width="45%">{{ __('Name') }}</th>
                           <th width="10%">:</th>
                           <td width="45%">{{$address['customer_name']}}</td>
                        </tr>
                        <tr>
                           <th width="45%">{{ __('Email') }}</th>
                           <th width="10%">:</th>
                           <td width="45%">{{$address['customer_email']}}</td>
                        </tr>
                        <tr>
                           <th width="45%">{{ __('Phone') }}</th>
                           <th width="10%">:</th>
                           <td width="45%">{{$address['customer_phone']}}</td>
                        </tr>
                        <tr>
                           <th width="45%">{{ __('Address') }}</th>
                           <th width="10%">:</th>
                           <td width="45%">{{$address['customer_address']}}</td>
                        </tr>
                        <tr>
                           <th width="45%">{{ __('Country') }}</th>
                           <th width="10%">:</th>
                           <td width="45%">{{$address['customer_country'] ? $address['customer_country'] : '--'}}</td>
                        </tr>
                        @if(@$address['customer_city'] != null)
                        <tr>
                           <th width="45%">{{ __('State') }}</th>
                           <th width="10%">:</th>
                           <td width="45%">{{$address['customer_state'] ? $address['customer_state'] : '--'}}</td>
                        </tr>
                        @endif
                        <tr>
                           <th width="45%">{{ __('City') }}</th>
                           <th width="10%">:</th>
                           <td width="45%">{{$address['customer_city'] ? $address['customer_city'] : '--'}}</td>
                        </tr>
                        <tr>
                           <th width="45%">{{ __('Postal Code') }}</th>
                           <th width="10%">:</th>
                           <td width="45%">{{$address['customer_zip'] ? $address['customer_zip'] : '--'}}</td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
         <div class="col-lg-6 my-5 ">
            <div class="special-box">
               <div class="heading-area">
                  <h4 class="title">
                     {{ __('Order Details') }}
                  </h4>
               </div>

               <div class="table-responsive-sm">
                  <table class="table">
                     <tbody>
                        <tr>
                           <th width="45%">{{ __('Total Products') }}</th>
                           <th width="10%">:</th>
                           <td width="45%">{{count($cart->items)}}</td>
                        </tr>
                        <tr>
                           <th width="45%">{{ __('Total Quintity') }}</th>
                           <th width="10%">:</th>
                           <td width="45%">{{$qty}}</td>
                        </tr>
                        <tr>
                           <th width="45%">{{ __('Discount') }}</th>
                           <th width="10%">:</th>
                           <td width="45%" id="discount">{{App\Models\Product::convertPrice($cart->discount)}}</td>
                        
                        
                        
                        </tr>

                        <tr>
                           <th width="45%">{{ __('Shipping Cost') }}</th>
                           <th width="10%">:</th>
                           <td width="45%" id="shipping_cost">{{intval($shipping_cost['shipping_cost']*$qty) }}</td>
                        </tr>
                        <tr>
                           <th width="45%">{{ __('Total Amount') }}</th>
                           <th width="10%">:</th>
                           <td width="45%" id="total">{{intval($cart->totalPrice+$shipping_cost['shipping_cost']*$qty)}}</td>
                        
                        </tr>

                        <tr>
                           <th width="45%">{{ __('Coupen ') }}</th>
                           <th width="10%">:</th>
                           <td width="45%"> 
                           <input type="text" id="coupon-code" placeholder="Enter Coupon Code" />
                           <button id="apply-coupon">Apply Coupon</button>
                           <button id="remove-coupon" style="display:none;">Remove Coupon</button>
                         </td>
                        </tr>
                        <tr>

                        <th>
                           <input type="radio" class="payment_method" value="cod" name="payment_method" checked>In hand 
                           <input type="radio" class="payment_method" value="online" name="payment_method">Online
                           <input type="hidden" name="coupane" id="coupenediscount">
                        </th>
                        <th></th>

                     
                        </tr>
                        
                        <tr>
                           <!-- <td>
                              <a href="{{route('admin-order-create-submit')}}" class="mybtn1">Order Submit</a>
                           </td> -->

                           <td>
                              <a href="{{route('admin-order-create-submit', ['method' => 'cod'])}}" class="mybtn1" id="submitButton" onclick="disableButton()">Order Submit</a>
                           </td>

                           <script>
                              function disableButton() {
                                 var button = document.getElementById("submitButton");
                                 button.innerHTML = "Submitting..."; // Optional: Change the button text while it's being disabled
                                 button.style.pointerEvents = "none"; // Disable the button click
                                 button.classList.add('disabled'); // Optional: Add a class for further customization (e.g., change appearance)
                              }
                           </script>

                           <style>
                              /* Optional: Add some CSS to style the disabled button */
                              .disabled {
                                 color: grey;
                                 background-color: lightgrey;
                              }
                           </style>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>



    // Global variable to track if the coupon is applied or not
var couponApplied = false;
var originalTotalPrice = parseFloat($('#total').text().replace(/[^\d.-]/g, ''));
var discount = parseFloat($('#discount').text().replace(/[^\d.-]/g, ''));


$('#apply-coupon').on('click', function() {
    var couponCode = $('#coupon-code').val();
    var gtotal = document.getElementById('total').innerText.trim();

    // Check if coupon has already been applied
    if (couponApplied) {
        alert('Coupon has already been applied.');
        return; // Exit the function if coupon is already applied
    }

    // Proceed with AJAX if the coupon hasn't been applied yet
    $.ajax({
        url: '{{ route('applyCoupon') }}',  // Define this route in your routes file
        method: 'POST',
        data: {
            coupon_code: couponCode,
            total: gtotal,
            _token: '{{ csrf_token() }}'  // CSRF token for security
        },
        success: function(response) {
            if (response.success) {
                // Update the total price with the new value
                $('#total').text(response.new_total);
                $('#discount').text(response.discount);
                $("#coupenediscount").val(Math.floor(response.discount));
                $('#submitButton').attr('href', `{!! route('admin-order-create-submit', ['method' => 'cod', 'code' => '']) !!}` + Math.floor(response.discount));

                couponApplied = true;

                // Hide the coupon input and apply button
                $('#coupon-code').hide();
                $('#apply-coupon').hide();

                // Show the "Remove Coupon" button
                $('#remove-coupon').show();

            } else {
                // Show an error message if the coupon is invalid
                alert(response.message);
            }
        },
        error: function(xhr) {
            alert('Error applying coupon.');
        }
    });
});

// "Remove Coupon" Button Click Handler
$('#remove-coupon').on('click', function() {
    // Optionally, make an AJAX call to remove the coupon (if necessary)
    
    // Reset total price to original
    $('#total').text('₹' + originalTotalPrice);
    $('#discount').text('₹' + discount);
   

    // Hide the "Remove Coupon" button
    $('#remove-coupon').hide();

    // Show the coupon input and apply button again
    $('#coupon-code').show();
    $('#apply-coupon').show();

    // Optionally, reset the coupon code field
    $('#coupon-code').val('');

    // Mark coupon as removed
    couponApplied = false;
});
   </script>
   <script>

// $(document).ready(function () {
//     $('.payment_method').on('click', function () {
//         var payment_method = $(this).val();
//         var coupenediscount = $('#coupenediscount').val().trim();  // Added `.trim()` for safety

//         if (payment_method === 'cod' || payment_method === 'online') {
//             var url = '{{ route('admin-order-create-submit', ['method' => '__METHOD__', 'code' => '__CODE__']) }}'
//                 .replace('__METHOD__', payment_method)
//                 .replace('__CODE__', encodeURIComponent(coupenediscount)); // Encode for URL safety

//             $('#submitButton').attr('href', url);
//         }
//     });
// });

$(document).ready(function () {
    $('.payment_method').on('click', function () {
        var payment_method = $(this).val();
        var coupenediscount = $('#coupenediscount').val().trim(); // Added `.trim()` for safety

        if (payment_method === 'cod' || payment_method === 'online') {
            var url = `{{ url('admin/order/create/order/submit') }}?method=${payment_method}&code=${encodeURIComponent(Math.floor(coupenediscount))}`;

            $('#submitButton').attr('href', url);
        }
    });
});

   </script>
@endsection

