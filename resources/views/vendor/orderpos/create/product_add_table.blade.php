@if(Session::has('admin_cart'))
@php $cart = Session::get('admin_cart'); @endphp

@include('alerts.admin.form-success')

@php $qty = 0; @endphp
@foreach($cart->items as $key1 => $product)
  @php $qty += $product['qty']; @endphp
  <div class="flex items-start gap-3 px-4 py-3 border-b border-gray-100 dark:border-gray-700/60 last:border-b-0 group">
    <img src="{{ asset('assets/images/products/' . $product['item']['photo']) }}"
         alt="{{ $product['item']['name'] }}"
         class="w-11 h-11 object-cover flex-shrink-0 bg-gray-100 dark:bg-gray-700">
    <div class="flex-1 min-w-0">
      <p class="text-xs font-medium text-gray-900 dark:text-gray-100 line-clamp-2 leading-snug">
        <a href="{{ route('front.product', $product['item']['slug']) }}" target="_blank" class="hover:text-primary-600 dark:hover:text-primary-400">
          {{ mb_strlen($product['item']['name'],'utf-8') > 38 ? mb_substr($product['item']['name'],0,38,'utf-8').'…' : $product['item']['name'] }}
        </a>
      </p>
      <div class="flex items-center gap-2 mt-0.5 flex-wrap">
        <span class="text-xs text-gray-400 dark:text-gray-500">Qty: {{ $product['qty'] }} {{ $product['item']['measure'] }}</span>
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
       class="removeOrder flex-shrink-0 p-1 text-gray-300 dark:text-gray-600 hover:text-red-500 dark:hover:text-red-400 transition-colors opacity-0 group-hover:opacity-100"
       title="Remove item">
      <span class="material-icons-outlined text-sm">close</span>
    </a>
  </div>
  <input type="hidden" value="{{ $qty }}" name="totalqty">
@endforeach

@else

{{-- Empty cart state (rendered into the scrollable slot) --}}
<div class="flex flex-col items-center justify-center py-10 text-center select-none">
  <span class="material-icons-outlined text-4xl text-gray-200 dark:text-gray-700 mb-2">shopping_cart</span>
  <p class="text-xs text-gray-400 dark:text-gray-500">Cart is empty</p>
  <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">Click <strong class="font-semibold">+</strong> on a product to add</p>
</div>

@endif
