@extends('layouts.vendor')

@section('styles')

<style type="text/css">
   .order-table-wrap table#example2 {
      margin: 10px 20px;
   }
</style>

<style>
  .coupon-wrapper {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
  }

  .coupon-wrapper input {
    padding: 8px 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    flex: 1;
    min-width: 200px;
  }

  .coupon-wrapper button {
    padding: 8px 14px;
    border: none;
    background-color: #007bff;
    color: white;
    border-radius: 4px;
    cursor: pointer;
    transition: background 0.3s ease;
  }

  .coupon-wrapper button:hover {
    background-color: #0056b3;
  }

  .coupon-wrapper #remove-coupon {
    background-color: #dc3545;
  }

  .coupon-wrapper #remove-coupon:hover {
    background-color: #b02a37;
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
                  <a href="{{ route('vendor.dashboard') }}">{{ __('Dashboard') }} </a>
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
   @if($cart && isset($cart->items))
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
                           <!-- <th>{{ __('Discount') }}</th> -->

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
                              <!-- <td class="product-subtotal">
                                 <p class="d-inline-block"
                                    id="prc{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">
                                    {{ App\Models\Product::convertPrice($product['discount']) }}
                                 </p>
                                 @if ($product['discount'] != 0)
                                 <strong>{{$product['discount']}} %{{__('off')}}</strong>
                                 @endif
                              </td> -->
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
                           <th width="45%">{{ __('Total Qty') }}</th>
                           <th width="10%">:</th>
                           <td width="45%">{{$qty}}</td>
                        </tr>
                        <tr>
                           <th width="45%">{{ __('Discount') }}</th>
                           <th width="10%">:</th>
                           <td width="45%" id="discount">0</td>
                        
                        
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
                           <th width="30%">{{ __('Coupon') }}</th>
                           <th width="5%">:</th>
                           <td width="65%">
                              <div class="coupon-wrapper">
                                 <input type="text" id="coupon-code" placeholder="Enter Coupon Code" />
                                 <button id="apply-coupon">Apply</button>
                                 <button id="remove-coupon" style="display: none;">Remove</button>
                              </div>
                           </td>
                           </tr>

                           <tr>
                              <th>
                                 <input type="radio" class="payment_method_radio" value="cod" name="payment_method" checked> COD 
                                 <input type="radio" class="payment_method_radio" value="online" name="payment_method"> Online

                                 <input type="hidden" id="coupenediscount" value="0">
                                 <input type="hidden" id="shipping_cost_total" value="{{ intval($shipping_cost['shipping_cost'] * $qty) }}">
                                 <input type="hidden" id="amount_total" value="{{ intval($cart->totalPrice + $shipping_cost['shipping_cost'] * $qty) }}">
                              </th>
                           </tr>

                           <tr>
                              <td>
                                 <form id="orderForm" method="GET" action="{{ route('vendor-order-create-submit', ['method' => 'cod']) }}">
                                       @csrf
                                       <input type="hidden" name="coupon_discount" id="form_coupon_discount" value="0">
                                       <input type="hidden" name="shipping_cost" id="form_shipping_cost" value="{{ intval($shipping_cost['shipping_cost'] * $qty) }}">
                                       <input type="hidden" name="total" id="form_total" value="{{ intval($cart->totalPrice + $shipping_cost['shipping_cost'] * $qty) }}">
                                       <input type="hidden" name="payment_method" id="form_payment_method" value="cod">

                                       <button type="submit" class="mybtn1" id="submitButton" onclick="prepareForm()">Order Submit</button>
                                 </form>
                              </td>
                           </tr>

                           <style>
                              .disabled {
                                 color: grey;
                                 background-color: lightgrey;
                                 pointer-events: none;
                              }
                           </style>




                           <!-- <td>
                              <a href="{{route('vendor-order-create-submit', ['method' => 'cod'])}}" class="mybtn1" id="submitButton" onclick="disableButton()">Order Submit</a>
                           </td> -->

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

   @else
    <tr>
        <td colspan="5">
            <p class="text-danger">Your cart is empty.</p>
        </td>
    </tr>
@endif
</div>

@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function prepareForm() {
        // Disable the button
        const button = document.getElementById("submitButton");
        button.innerHTML = "Submitting...";
        button.classList.add('disabled');

        // Get selected payment method
        const selectedMethod = document.querySelector('input[name="payment_method"]:checked').value;

        // Set values in hidden fields
        document.getElementById('form_payment_method').value = selectedMethod;
        document.getElementById('form_coupon_discount').value = parseFloat($('#coupenediscount').val()) || 0;
        document.getElementById('form_shipping_cost').value = parseFloat($('#shipping_cost_total').val()) || 0;
        document.getElementById('form_total').value = parseFloat($('#amount_total').val()) || 0;

        // Update form action
        const form = document.getElementById('orderForm');
        const baseAction = `{{ url('vendor/order/create/order/submit') }}`;
        form.action = `${baseAction}?method=${selectedMethod}`;
    }

    // Optional: If user changes payment method before submission
    $('.payment_method_radio').on('change', function () {
        const selectedMethod = $('input[name="payment_method"]:checked').val();
        $('#form_payment_method').val(selectedMethod);
    });
</script>
<script>
$(document).ready(function () {
    var couponApplied = false;

    // Parse initial prices from the DOM
    var originalTotalPrice = parseFloat($('#total').text().replace(/[^\d.-]/g, ''));
    var discount = parseFloat($('#discount').text().replace(/[^\d.-]/g, ''));

    // Apply Coupon
    $('#apply-coupon').on('click', function () {
        var couponCode = $('#coupon-code').val();
        var gtotal = document.getElementById('total').innerText.trim();

        if (couponApplied) {
            alert('Coupon has already been applied.');
            return;
        }

        $.ajax({
            url: '{{ route('applyCoupon') }}',
            method: 'POST',
            data: {
                coupon_code: couponCode,
                total: gtotal,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                if (response.success) {
                    $('#total').text(response.new_total);
                    $('#discount').text(response.discount);
                    $("#coupenediscount").val(Math.floor(response.discount));

                    // Update submit button URL
                    updateSubmitButtonUrl();

                    couponApplied = true;

                    // Toggle UI
                    $('#coupon-code, #apply-coupon').hide();
                    $('#remove-coupon').show();
                } else {
                    alert(response.message);
                }
            },
            error: function () {
                alert('Error applying coupon.');
            }
        });
    });

    // Remove Coupon
    $('#remove-coupon').on('click', function () {
        $('#total').text('₹' + originalTotalPrice);
        $('#discount').text('₹' + discount);
        $("#coupenediscount").val(0);

        $('#remove-coupon').hide();
        $('#coupon-code, #apply-coupon').show();
        $('#coupon-code').val('');

        couponApplied = false;

        // Update submit button URL again
        updateSubmitButtonUrl();
    });

    // Update submit button URL on payment method change
    $('.payment_method').on('click', function () {
     
        updateSubmitButtonUrl();
    });

    // Function to build and update the submit button URL
    function updateSubmitButtonUrl() {
        var payment_method = $('.payment_method:checked').val();
       
        var coupenediscount = parseFloat($('#coupenediscount').val().trim()) || 0;
        var shipping_cost = parseFloat($('#shipping_cost_total').val().trim()) || 0;
        var total = parseFloat($('#amount_total').val().trim()) || 0;

        if (payment_method === 'cod' || payment_method === 'online') {
            var url = `{{ url('vendor/order/create/order/submit') }}?method=${payment_method}`
                    + `&code=${encodeURIComponent(coupenediscount)}`
                    + `&shipping_cost=${encodeURIComponent(shipping_cost)}`
                    + `&total=${encodeURIComponent(total)}`;
                    alert(url);
            $('#submitButton').attr('href', url);
        }
    }
});


function disableButton() {
    var button = document.getElementById("submitButton");
    button.innerHTML = "Submitting...";
    button.style.pointerEvents = "none";
    button.classList.add('disabled');

    // Before submitting, set form field values
    document.getElementById('form_coupon_discount').value = parseFloat($('#coupenediscount').val()) || 0;
    document.getElementById('form_shipping_cost').value = parseFloat($('#shipping_cost_total').val()) || 0;
    document.getElementById('form_total').value = parseFloat($('#amount_total').val()) || 0;
}

</script>



@endsection

