<style>
/* ── Size pill active state ──────────────────────────── */
.siz-list { display:flex; flex-wrap:wrap; gap:8px; list-style:none; margin:0; padding:0; }
.siz-list li .box {
  display:inline-flex; align-items:center;
  padding:5px 14px; font-size:12px; font-weight:600;
  border:2px solid #e5e7eb; background:#fff; color:#374151;
  cursor:pointer; transition:border-color .15s, background .15s, color .15s;
  user-select:none;
}
.siz-list li .box:hover { border-color:#EA580C; }
.siz-list li.active .box { border-color:#EA580C; background:#fff7ed; color:#EA580C; }

/* ── Color swatch active state ───────────────────────── */
.color-list { display:flex; flex-wrap:wrap; gap:8px; list-style:none; margin:0; padding:0; }
.color-list li { display:none; }
.color-list li.show-colors { display:flex; }
.color-list .box {
  width:30px; height:30px; border:2px solid transparent;
  cursor:pointer; transition:all .15s; display:block;
  position:relative;
}
.color-list .box:hover { border-color:#6b7280; }
.color-list li.active .box {
  border-color:#111827;
  box-shadow:0 0 0 2px #fff, 0 0 0 4px #EA580C;
}

/* ── Attribute radio ─────────────────────────────────── */
.product-attr { accent-color:#EA580C; width:16px; height:16px; cursor:pointer; flex-shrink:0; }
</style>

<div class="space-y-5">

  {{-- ── Product Name ──────────────────────────────────── --}}
  <div class="pb-4 border-b border-gray-100 dark:border-gray-700">
    <h4 class="text-base font-bold text-gray-900 dark:text-gray-100 leading-snug mb-1">
      {{ $productt->name }}
    </h4>
    <div class="text-xl font-extrabold text-primary-600 dark:text-primary-400" id="sizeprice">
      {{ $productt->showPrice() }}
    </div>
  </div>

  {{-- ── Size Selector ─────────────────────────────────── --}}
  @if(!empty($productt->size))
  <div class="product-size">
    <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Size</p>
    <ul class="siz-list">
      @foreach(array_unique($productt->size) as $key => $data1)
        <li class="{{ $loop->first ? 'active' : '' }}" data-key="{{ str_replace(' ','',$data1) }}">
          <span class="box">{{ $data1 }}</span>
        </li>
      @endforeach
    </ul>
  </div>
  @endif

  {{-- ── Color Selector ────────────────────────────────── --}}
  @if(!empty($productt->color))
  <div class="product-color">
    <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Color</p>
    <ul class="color-list">
      @foreach($productt->color as $key => $data1)
        <li class="{{ $loop->first ? 'active show-colors' : '' }} {{ $productt->IsSizeColor($productt->size[$key]) ? str_replace(' ','',$productt->size[$key]) : '' }} {{ $productt->size[$key] == $productt->size[0] ? 'show-colors' : '' }}">
          <span class="box"
            data-color="{{ $productt->color[$key] }}"
            style="background-color:{{ $productt->color[$key] }}"
            title="{{ $productt->color[$key] }}">
            <input type="hidden" class="size" value="{{ $productt->size[$key] }}">
            <input type="hidden" class="size_qty" value="{{ $productt->size_qty[$key] }}">
            <input type="hidden" class="size_key" value="{{ $key }}">
            <input type="hidden" class="size_price" value="{{ round($productt->size_price[$key] * $curr->value, 2) }}">
          </span>
        </li>
      @endforeach
    </ul>
  </div>
  @endif

  {{-- ── Stock hidden input ────────────────────────────── --}}
  @if(!empty($productt->size))
    <input type="hidden" class="product-stock" value="{{ $productt->size_qty[0] }}">
  @else
    @if(!$productt->emptyStock())
      <input type="hidden" class="product-stock" value="{{ $productt->stock }}">
    @elseif($productt->type != 'Physical')
      <input type="hidden" class="product-stock" value="0">
    @else
      <input type="hidden" class="product-stock" value="">
    @endif
  @endif

  {{-- ── Attributes ────────────────────────────────────── --}}
  @if (!empty($productt->attributes))
    @php $attrArr = json_decode($productt->attributes, true); @endphp
  @endif
  @if (!empty($attrArr))
  <div class="product-attributes space-y-4 pt-1">
    @foreach ($attrArr as $attrKey => $attrVal)
      @if (array_key_exists("details_status", $attrVal) && $attrVal['details_status'] == 1)
      <div>
        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2 capitalize">
          {{ str_replace("_", " ", $attrKey) }}
        </p>
        <div class="space-y-2">
          @foreach ($attrVal['values'] as $optionKey => $optionVal)
          <label class="flex items-center gap-3 cursor-pointer group" for="{{ $attrKey }}{{ $optionKey }}">
            <input type="hidden" class="keys" value="">
            <input type="hidden" class="values" value="">
            <input type="radio"
              id="{{ $attrKey }}{{ $optionKey }}"
              name="{{ $attrKey }}"
              class="product-attr"
              data-key="{{ $attrKey }}"
              data-price="{{ $attrVal['prices'][$optionKey] * $curr->value }}"
              value="{{ $optionVal }}"
              {{ $loop->first ? 'checked' : '' }}>
            <span class="text-sm text-gray-700 dark:text-gray-300 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">
              {{ $optionVal }}
              @if (!empty($attrVal['prices'][$optionKey]))
                <span class="text-primary-600 dark:text-primary-400 font-semibold ml-1">
                  +{{ $curr->sign }}{{ $attrVal['prices'][$optionKey] * $curr->value }}
                </span>
              @endif
            </span>
          </label>
          @endforeach
        </div>
      </div>
      @endif
    @endforeach
  </div>
  @endif

  {{-- ── Hidden product fields ─────────────────────────── --}}
  <input type="hidden" id="product_price" value="{{ round($productt->vendorPrice() * $curr->value, 2) }}">
  <input type="hidden" id="product_id" value="{{ $productt->id }}">
  <input type="hidden" id="curr_pos" value="{{ $gs->currency_format }}">
  <input type="hidden" id="curr_sign" value="{{ $curr->sign }}">

  {{-- ── Quantity + Add to Cart ───────────────────────── --}}
  <div class="flex items-center gap-3 pt-4 border-t border-gray-100 dark:border-gray-700">

    {{-- Qty stepper --}}
    <div class="qty flex items-stretch border border-gray-200 dark:border-gray-600 overflow-hidden flex-shrink-0">
      <button type="button"
        class="qtminus w-10 flex items-center justify-center text-lg font-bold text-gray-600 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 dark:hover:text-primary-400 transition-colors border-r border-gray-200 dark:border-gray-600">
        −
      </button>
      <input type="text"
        class="qttotal w-12 h-10 text-center text-sm font-bold text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-primary-500/20 border-0"
        value="1">
      <button type="button"
        class="qtplus w-10 flex items-center justify-center text-lg font-bold text-gray-600 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 dark:hover:text-primary-400 transition-colors border-l border-gray-200 dark:border-gray-600">
        +
      </button>
    </div>

    {{-- Add / Out-of-stock --}}
    @if($productt->stock <= 0)
      <button type="button"
        class="flex-1 h-10 bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500 text-sm font-semibold cursor-not-allowed"
        disabled>
        Out of Stock
      </button>
    @else
      <button type="button" id="orderaddcrt"
        class="flex-1 h-10 bg-primary-600 hover:bg-primary-700 active:bg-primary-800 text-white text-sm font-semibold transition-colors flex items-center justify-center gap-2">
        <span class="material-icons-outlined text-base">add_shopping_cart</span>
        Add to Cart
      </button>
    @endif

  </div>

</div>

<script type="text/javascript">
(function($) {
"use strict";

var order_id = $('#order_id').val() || 0;

let gs = {!! json_encode(\App\Models\Generalsetting::first()->makeHidden(['stripe_key','stripe_secret','smtp_pass','instamojo_key','instamojo_token','paystack_key','paystack_email','paypal_business','paytm_merchant','paytm_secret','paytm_website','paytm_industry','paytm_mode','molly_key','razorpay_key','razorpay_secret'])) !!};

function number_format(number, decimals, dec_point, thousands_sep) {
  number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
  var n = !isFinite(+number) ? 0 : +number,
      prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
      sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
      dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
      s = '',
      toFixedFix = function(n, prec) { var k = Math.pow(10, prec); return '' + Math.round(n * k) / k; };
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  if ((s[1] || '').length < prec) { s[1] = s[1] || ''; s[1] += new Array(prec - s[1].length + 1).join('0'); }
  return s.join(dec);
}

var sizes = "", size_qty = "", size_price = "", size_key = "", colors = "", mstock = $('.product-stock').val();
var keys = "", values = "", prices = "";

/* ── Attribute change → recalculate price ────────────── */
$('.product-attr').on('change', function() {
  var total = mgetAmount() + mgetSizePrice();
  updatePrice(total.toFixed(2));
});

function mgetSizePrice() {
  var total = 0;
  if ($('.product-color .color-list li.active').length > 0) {
    total = parseFloat($('.product-color .color-list li.active').find('.size_price').val()) || 0;
  }
  return total;
}

function mgetAmount() {
  var total = parseFloat($('#product_price').val()) || 0;
  $(".product-attr:checked").each(function() { total += parseFloat($(this).data('price')) || 0; });
  return total;
}

function updatePrice(raw) {
  var formatted = number_format(raw, 2, gs.decimal_separator, gs.thousand_separator);
  var pos  = $('#curr_pos').val();
  var sign = $('#curr_sign').val();
  $('#sizeprice').html(pos == '0' ? sign + formatted : formatted + sign);
}

/* ── Size click ───────────────────────────────────────── */
$('.product-size .siz-list .box').on('click', function() {
  var parent = $(this).parent();
  $('.product-size .siz-list li').removeClass('active');
  parent.addClass('active');
  $('.qttotal').val('1');

  $('.product-color .color-list li').removeClass('show-colors');
  var size_color = $('.product-color .color-list li.' + parent.data('key'));
  size_color.addClass('show-colors').first().addClass('active');
  colors    = size_color.find('span.box').data('color') || '';
  size_qty  = size_color.find('.size_qty').val() || '';
  size_price = size_color.find('.size_price').val() || 0;
  size_key  = size_color.find('.size_key').val() || '';
  sizes     = size_color.find('.size').val() || '';
  mstock    = size_qty;

  updatePrice((mgetAmount() + parseFloat(size_price)).toFixed(2));
});

/* ── Color click ──────────────────────────────────────── */
$('.product-color .color-list .box').on('click', function() {
  var parent = $(this).parent();
  colors = $(this).data('color') || '';
  $('.product-color .color-list li').removeClass('active');
  parent.addClass('active');
  $('.qttotal').val('1');
  size_qty  = $(this).find('.size_qty').val() || '';
  size_price = $(this).find('.size_price').val() || 0;
  size_key  = $(this).find('.size_key').val() || '';
  sizes     = $(this).find('.size').val() || '';
  mstock    = size_qty;

  updatePrice((mgetAmount() + parseFloat(size_price)).toFixed(2));
});

/* ── Qty input: numbers only ─────────────────────────── */
$('.qttotal').on('keypress', function(e) {
  if (this.value.length == 0 && e.which == 48) return false;
  if (e.which != 8 && e.which != 32 && isNaN(String.fromCharCode(e.which))) e.preventDefault();
});

/* ── Minus ────────────────────────────────────────────── */
$('.qtminus').on('click', function() {
  var $q = $(this).siblings('.qttotal');
  var v = parseInt($q.val()) || 1;
  if (v > 1) $q.val(v - 1);
});

/* ── Plus ─────────────────────────────────────────────── */
$('.qtplus').on('click', function() {
  var $q = $(this).siblings('.qttotal');
  var v  = parseInt($q.val()) || 1;
  if (mstock !== "" && v >= parseInt(mstock)) return;
  $q.val(v + 1);
});

/* ── Add to Cart ──────────────────────────────────────── */
$(document).on("click", "#orderaddcrt", function() {
  var qty = $('.qttotal').val();
  var pid = $('#product_id').val();

  if ($('.product-attr').length > 0) {
    values = $(".product-attr:checked").map(function() { return $(this).val(); }).get();
    keys   = $(".product-attr:checked").map(function() { return $(this).data('key'); }).get();
    prices = $(".product-attr:checked").map(function() { return $(this).data('price'); }).get();
  }

  var colorVal = colors ? colors.substring(1) : '';
  var urlAdd = mainurl + "/vendor/order/create/addcart/" + order_id
             + "?id=" + pid + "&qty=" + qty
             + "&size=" + sizes + "&color=" + colorVal
             + "&size_qty=" + size_qty + "&size_price=" + size_price
             + "&size_key=" + size_key + "&keys=" + keys
             + "&values=" + values + "&prices=" + prices;

  // Visual feedback: disable button while loading
  var $btn = $(this);
  $btn.prop('disabled', true).html('<span class="material-icons-outlined text-base animate-spin">autorenew</span> Adding…');

  $.get(urlAdd, function(response) {
    $('#view_table_order').html(response);
    $('#addProductRemoveBtn').click();
  }).fail(function() {
    $btn.prop('disabled', false).html('<span class="material-icons-outlined text-base">add_shopping_cart</span> Add to Cart');
  });
});

})(jQuery);
</script>
