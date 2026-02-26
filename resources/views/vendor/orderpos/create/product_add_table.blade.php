@if(Session::has('admin_cart'))
@php $cart = Session::get('admin_cart'); @endphp

@include('alerts.admin.form-success')

<!-- Cart Items -->
<div class="border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
  <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
    <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100 flex items-center gap-2">
      <span class="material-icons-outlined text-base text-primary-500">shopping_cart</span>
      Cart
      <span class="inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-primary-600 rounded-full">
        {{ count($cart->items) }}
      </span>
    </h3>
  </div>

  <div class="divide-y divide-gray-100 dark:divide-gray-700">
    @php $qty = 0; @endphp
    @foreach($cart->items as $key1 => $product)
      @php $qty += $product['qty']; @endphp
      <div class="flex items-start gap-3 p-3">
        <img src="{{ asset('assets/images/products/' . $product['item']['photo']) }}"
             alt="{{ $product['item']['name'] }}"
             class="w-12 h-12 object-cover flex-shrink-0 bg-gray-100 dark:bg-gray-700">
        <div class="flex-1 min-w-0">
          <p class="text-xs font-medium text-gray-900 dark:text-gray-100 line-clamp-2 leading-snug">
            <a href="{{ route('front.product', $product['item']['slug']) }}" target="_blank" class="hover:text-primary-600">
              {{ mb_strlen($product['item']['name'],'utf-8') > 40 ? mb_substr($product['item']['name'],0,40,'utf-8').'...' : $product['item']['name'] }}
            </a>
          </p>
          <div class="flex items-center gap-2 mt-1">
            <span class="text-xs text-gray-500 dark:text-gray-400">Qty: {{ $product['qty'] }} {{ $product['item']['measure'] }}</span>
            @if($product['discount'] != 0)
              <span class="text-xs text-green-600 font-medium">{{ $product['discount'] }}% off</span>
            @endif
          </div>
          <p class="text-xs font-semibold text-primary-600 dark:text-primary-400 mt-0.5">
            {{ App\Models\Product::convertPrice($product['price']) }}
          </p>
        </div>
        <a href="javascript:;"
           data-href="{{ route('vendor.order.remove.cart', $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])) }}"
           class="removeOrder flex-shrink-0 p-1 text-gray-400 hover:text-red-500 dark:hover:text-red-400 transition-colors"
           title="Remove">
          <span class="material-icons-outlined text-base">close</span>
        </a>
      </div>
      <input type="hidden" value="{{ $qty }}" name="totalqty">
      <input type="hidden" value="{{ $cart->totalPrice }}" name="totalprice">

    @endforeach
  </div>

  <!-- Cart Total -->
  <div class="p-3 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
    <div class="flex items-center justify-between text-sm">
      <span class="text-gray-500 dark:text-gray-400">Subtotal ({{ $qty }} items)</span>
      <span class="font-bold text-gray-900 dark:text-gray-100">{{ App\Models\Product::convertPrice($cart->totalPrice) }}</span>
    </div>
  </div>

  <!-- View & Continue -->
  <div class="p-3">
    <button type="submit"
      class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-primary-600 hover:bg-primary-700 text-white text-sm font-semibold transition-colors">
      <span>View & Continue</span>
      <span class="material-icons-outlined text-base">arrow_forward</span>
    </button>
  </div>
</div>

@else

<!-- Empty Cart State -->
<div class="border border-dashed border-gray-200 dark:border-gray-600 p-6 text-center">
  <span class="material-icons-outlined text-4xl text-gray-300 dark:text-gray-600 mb-2">shopping_cart</span>
  <p class="text-sm text-gray-500 dark:text-gray-400">Your cart is empty.</p>
  <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Click the <strong>+</strong> button on a product to add it.</p>
</div>

@endif
