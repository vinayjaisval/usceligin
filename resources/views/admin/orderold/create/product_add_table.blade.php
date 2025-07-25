
@if (Session::has('admin_cart'))
    @php
        $cart = Session::get('admin_cart');
      
    @endphp

<div class="mr-table allproduct">

  @include('alerts.admin.form-success') 
  <div class="table-responsive">
     <table id="example2" class="table table-hover dt-responsive" cellspacing="0" width="100%">
        <thead>
           <tr>
           <tr>
              <th>{{ __('Product ID#') }}</th>
              <th>{{ __('Product Title') }}</th>
              <th>{{ __('Price') }}</th>
              <th>{{ __('Details') }}</th>
              <th>{{ __('Subtotal') }}</th>
            
              <th>{{ __('Action') }}</th>
           </tr>
           </tr>
        </thead>
        <tbody>
           @foreach($cart->items as $key1 => $product)
          
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
             
              <td>
                 <a href="javascript:;"  data-href="{{ route('admin.order.remove.cart',$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])) }}" class="mybtn1 removeOrder"><i class="fa fa-trash"></i> {{ __('Remove') }}</a>
              </td>
           </tr>
           @endforeach
        </tbody>
     </table>
  </div>
  <div class="row">
   
    
    <div class="col-lg-12 text-right">
      <button type="submit" class="mybtn1">View & Continue</button>
    </div>

  </div>
</div>


@endif



