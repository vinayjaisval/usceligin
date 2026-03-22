@extends('frontend.include.app')

@section('content')

@php
  $refundDays        = config('order.refund_window_days', 5);
  $subtotal = 0;
  foreach (($cart['items'] ?? []) as $product) {
    $currencyValue = $order->currency_value ?: 1;
    $subtotal += round(($product['price'] / $currencyValue) * $currencyValue, 2);
  }

  // Use order-level address fields (captured at time of order) for accuracy
  $shipName    = $order->shipping_name    ?: $order->customer_name;
  $shipAddr    = $order->shipping_address ?: $order->customer_address;
  $shipCity    = $order->shipping_city    ?: $order->customer_city;
  $shipZip     = $order->shipping_zip     ?: $order->customer_zip;
  $shipState   = $order->shipping_state   ?: $order->customer_state;
  $shipCountry = $order->shipping_country ?: $order->customer_country;

  // Fallback to Address model when order-level fields are empty
  if (!$shipName) {
    $shippingAddress = \App\Models\Address::where('user_id', $order->user_id)
      ->where('address_category', 'delivery')
      ->first();
    $shipName    = $shippingAddress->name         ?? 'N/A';
    $shipAddr    = $shippingAddress->address_line_1 ?? 'N/A';
    $shipCity    = $shippingAddress->city          ?? 'N/A';
    $shipZip     = $shippingAddress->pincode        ?? '';
    $shipState   = $shippingAddress->state         ?? '';
    $shipCountry = $shippingAddress->country       ?? 'India';
  }

  $billName    = $order->customer_name;
  $billAddr    = $order->customer_address;
  $billCity    = $order->customer_city;
  $billZip     = $order->customer_zip;
  $billState   = $order->customer_state;
  $billCountry = $order->customer_country;

  if (!$billName) {
    $billingAddress = \App\Models\Address::where('user_id', $order->user_id)
      ->where('address_category', 'billing')
      ->first();
    $billName    = $billingAddress->name          ?? $shipName;
    $billAddr    = $billingAddress->address_line_1 ?? $shipAddr;
    $billCity    = $billingAddress->city           ?? $shipCity;
    $billZip     = $billingAddress->pincode         ?? $shipZip;
    $billState   = $billingAddress->state          ?? $shipState;
    $billCountry = $billingAddress->country        ?? $shipCountry;
  }

  $currSign = $order->currency_sign ?: '₹';
@endphp

{{-- Print styles: hide everything except the invoice card --}}
<style>
  @media print {
    /* Hide the entire page, then reveal only the invoice card */
    body * { visibility: hidden; }
    #invoice-card,
    #invoice-card * { visibility: visible; }
    #invoice-card {
      position: fixed;
      inset: 0;
      width: 100%;
      margin: 0;
      padding: 0;
      border: none !important;
      box-shadow: none !important;
    }
    /* Force white background, no dark mode in print */
    #invoice-card { background: #ffffff !important; }
    #invoice-card * { color-adjust: exact; -webkit-print-color-adjust: exact; }
  }
  @page { size: A4; margin: 12mm; }
</style>

<main class="bg-gray-50 dark:bg-gray-900 min-h-screen py-6 lg:py-10 no-print-bg" id="main-content" role="main">
  <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

    {{-- Toolbar: Back + Print + PDF --}}
    <div class="no-print flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
      <a href="{{ route('user.account') }}#purchases"
        class="inline-flex items-center gap-2 text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-primary-800 dark:hover:text-primary-400 transition-colors">
        <span class="material-icons-outlined text-base" aria-hidden="true">arrow_back</span>
        Back to Orders
      </a>
      <div class="flex items-center gap-3">
        <button type="button" onclick="window.print()"
          class="inline-flex items-center gap-2 px-5 py-2.5 border border-gray-300 dark:border-gray-600 text-sm font-semibold text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-600">
          <span class="material-icons-outlined text-base" aria-hidden="true">print</span>
          Print
        </button>
        <button type="button" onclick="downloadPDF()"
          class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary-800 text-white text-sm font-semibold hover:bg-primary-900 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-600">
          <span class="material-icons-outlined text-base" aria-hidden="true">download</span>
          Download PDF
        </button>
      </div>
    </div>

    {{-- Invoice Card --}}
    <div id="invoice-card" class="invoice-card bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">

      {{-- Invoice Header --}}
      <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-6 px-8 py-8 border-b border-gray-200 dark:border-gray-700">
        {{-- Brand --}}
        <div>
          @if(!empty($gs->logo))
            <img src="{{ asset('assets/images/' . $gs->logo) }}" alt="{{ $gs->title }}"
                 class="h-10 w-auto object-contain mb-1" />
          @else
            <span class="text-2xl font-black uppercase tracking-widest text-gray-900 dark:text-gray-100">
              {{ $gs->title ?? 'CELIGIN' }}
            </span>
          @endif
          @if(!empty($gs->address))
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $gs->address }}</p>
          @endif
          @if(!empty($gs->contact_email))
            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $gs->contact_email }}</p>
          @endif
        </div>

        {{-- Invoice Label + Number --}}
        <div class="text-right">
          <h1 class="text-3xl font-black uppercase tracking-widest text-gray-900 dark:text-gray-100">Invoice</h1>
          <p class="text-sm font-semibold text-gray-500 dark:text-gray-400 mt-1">
            #{{ sprintf('%08d', $order->id) }}
          </p>
          <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">
            {{ $order->created_at->format('d M Y') }}
          </p>
        </div>
      </div>

      {{-- Order Meta + Addresses --}}
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-0 divide-y sm:divide-y-0 sm:divide-x divide-gray-200 dark:divide-gray-700 px-0">

        {{-- Order Details --}}
        <div class="px-8 py-6">
          <h2 class="text-xs font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500 mb-3">Order Details</h2>
          <dl class="space-y-1.5 text-sm">
            <div class="flex flex-col">
              <dt class="text-xs text-gray-500 dark:text-gray-400">Order Number</dt>
              <dd class="font-semibold text-gray-900 dark:text-gray-100">{{ $order->order_number }}</dd>
            </div>
            <div class="flex flex-col">
              <dt class="text-xs text-gray-500 dark:text-gray-400">Order Date</dt>
              <dd class="font-medium text-gray-900 dark:text-gray-100">{{ $order->created_at->format('d M Y') }}</dd>
            </div>
            <div class="flex flex-col">
              <dt class="text-xs text-gray-500 dark:text-gray-400">Payment Method</dt>
              <dd class="font-medium text-gray-900 dark:text-gray-100">{{ $order->method ?: 'N/A' }}</dd>
            </div>
            <div class="flex flex-col">
              <dt class="text-xs text-gray-500 dark:text-gray-400">Shipping Method</dt>
              <dd class="font-medium text-gray-900 dark:text-gray-100">
                {{ $order->shipping === 'pickup' ? 'Pick Up' : 'Ship To Address' }}
              </dd>
            </div>
            <div class="flex flex-col">
              <dt class="text-xs text-gray-500 dark:text-gray-400">Status</dt>
              <dd>
                <span class="inline-block px-2 py-0.5 text-xs font-semibold uppercase tracking-wide
                  {{ in_array($order->status, ['completed', 'delivered']) ? 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400' : (in_array($order->status, ['cancelled']) ? 'bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400' : 'bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400') }}">
                  {{ ucfirst(str_replace('_', ' ', $order->status ?? 'pending')) }}
                </span>
              </dd>
            </div>
          </dl>
        </div>

        {{-- Shipping Address --}}
        <div class="px-8 py-6">
          <h2 class="text-xs font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500 mb-3">Ship To</h2>
          <address class="not-italic text-sm space-y-0.5">
            <p class="font-semibold text-gray-900 dark:text-gray-100">{{ $shipName ?: 'N/A' }}</p>
            @if($shipAddr)
              <p class="text-gray-600 dark:text-gray-400">{{ $shipAddr }}</p>
            @endif
            @if($shipCity || $shipZip)
              <p class="text-gray-600 dark:text-gray-400">{{ implode(' ', array_filter([$shipCity, $shipZip])) }}</p>
            @endif
            @if($shipState)
              <p class="text-gray-600 dark:text-gray-400">{{ $shipState }}</p>
            @endif
            @if($shipCountry)
              <p class="text-gray-600 dark:text-gray-400">{{ $shipCountry }}</p>
            @endif
            @if($order->customer_phone)
              <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $order->customer_phone }}</p>
            @endif
          </address>
        </div>

        {{-- Billing Address --}}
        <div class="px-8 py-6">
          <h2 class="text-xs font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500 mb-3">Bill To</h2>
          <address class="not-italic text-sm space-y-0.5">
            <p class="font-semibold text-gray-900 dark:text-gray-100">{{ $billName ?: $shipName ?: 'N/A' }}</p>
            @if($billAddr)
              <p class="text-gray-600 dark:text-gray-400">{{ $billAddr }}</p>
            @endif
            @if($billCity || $billZip)
              <p class="text-gray-600 dark:text-gray-400">{{ implode(' ', array_filter([$billCity, $billZip])) }}</p>
            @endif
            @if($billState)
              <p class="text-gray-600 dark:text-gray-400">{{ $billState }}</p>
            @endif
            @if($billCountry)
              <p class="text-gray-600 dark:text-gray-400">{{ $billCountry }}</p>
            @endif
            @if($order->customer_email)
              <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $order->customer_email }}</p>
            @endif
          </address>
        </div>

      </div>

      {{-- Line Items Table --}}
      <div class="border-t border-gray-200 dark:border-gray-700">
        <table class="w-full text-sm" aria-label="Order items">
          <thead class="bg-gray-50 dark:bg-gray-900/40">
            <tr>
              <th class="px-8 py-3 text-left text-xs font-bold uppercase tracking-widest text-gray-500 dark:text-gray-400">Product</th>
              <th class="px-4 py-3 text-center text-xs font-bold uppercase tracking-widest text-gray-500 dark:text-gray-400 hidden sm:table-cell">Qty</th>
              <th class="px-4 py-3 text-right text-xs font-bold uppercase tracking-widest text-gray-500 dark:text-gray-400 hidden sm:table-cell">Unit Price</th>
              <th class="px-8 py-3 text-right text-xs font-bold uppercase tracking-widest text-gray-500 dark:text-gray-400">Total</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
            @foreach(($cart['items'] ?? []) as $product)
              <tr>
                <td class="px-8 py-4">
                  <p class="font-medium text-gray-900 dark:text-gray-100">{{ $product['item']['name'] ?? 'Product' }}</p>
                  @if(!empty($product['size']))
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Size: {{ str_replace('-', ' ', $product['size']) }}</p>
                  @endif
                  @if(!empty($product['color']))
                    <p class="text-xs text-gray-500 dark:text-gray-400">Color: {{ $product['color'] }}</p>
                  @endif
                  @if(!empty($product['keys']))
                    @foreach(array_combine(explode(',', $product['keys']), explode(',', $product['values'])) as $key => $value)
                      <p class="text-xs text-gray-500 dark:text-gray-400">{{ ucwords(str_replace('_', ' ', $key)) }}: {{ $value }}</p>
                    @endforeach
                  @endif
                  {{-- Mobile: show qty + unit inline --}}
                  <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 sm:hidden">
                    Qty {{ $product['qty'] }} &times; {{ $currSign }}{{ number_format($product['item_price'] ?? 0, 2) }}
                  </p>
                </td>
                <td class="px-4 py-4 text-center text-gray-700 dark:text-gray-300 hidden sm:table-cell">
                  {{ $product['qty'] }}
                </td>
                <td class="px-4 py-4 text-right text-gray-700 dark:text-gray-300 hidden sm:table-cell">
                  {{ $currSign }}{{ number_format($product['item_price'] ?? 0, 2) }}
                  @if(($product['discount'] ?? 0) > 0)
                    <span class="block text-xs text-green-600 dark:text-green-400">{{ $product['discount'] }}% off</span>
                  @endif
                </td>
                <td class="px-8 py-4 text-right font-semibold text-gray-900 dark:text-gray-100">
                  {{ $currSign }}{{ number_format($product['price'] ?? 0, 2) }}
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      {{-- Totals --}}
      <div class="border-t border-gray-200 dark:border-gray-700 px-8 py-6">
        <div class="flex justify-end">
          <dl class="w-full max-w-xs space-y-2 text-sm">

            <div class="flex justify-between">
              <dt class="text-gray-500 dark:text-gray-400">Subtotal</dt>
              <dd class="font-medium text-gray-900 dark:text-gray-100">{{ $currSign }}{{ number_format($subtotal, 2) }}</dd>
            </div>

            @if(!empty($order->coupon_discount) && $order->coupon_discount != 0)
              <div class="flex justify-between">
                <dt class="text-gray-500 dark:text-gray-400">Coupon Discount{{ $order->coupon_code ? ' (' . $order->coupon_code . ')' : '' }}</dt>
                <dd class="font-medium text-green-600 dark:text-green-400">-{{ $currSign }}{{ number_format($order->coupon_discount, 2) }}</dd>
              </div>
            @endif

            @if(!empty($order->refferal_discount) && $order->refferal_discount != 0)
              <div class="flex justify-between">
                <dt class="text-gray-500 dark:text-gray-400">Referral Discount</dt>
                <dd class="font-medium text-green-600 dark:text-green-400">-{{ $currSign }}{{ number_format($order->refferal_discount, 2) }}</dd>
              </div>
            @endif

            <div class="flex justify-between">
              <dt class="text-gray-500 dark:text-gray-400">Shipping</dt>
              <dd class="font-medium text-gray-900 dark:text-gray-100">
                @if(($order->shipping_cost ?? 0) == 0)
                  <span class="text-green-600 dark:text-green-400">Free</span>
                @else
                  {{ $currSign }}{{ number_format($order->shipping_cost, 2) }}
                @endif
              </dd>
            </div>

            @if(!empty($order->packing_cost) && $order->packing_cost != 0)
              <div class="flex justify-between">
                <dt class="text-gray-500 dark:text-gray-400">Packing</dt>
                <dd class="font-medium text-gray-900 dark:text-gray-100">{{ $currSign }}{{ number_format($order->packing_cost, 2) }}</dd>
              </div>
            @endif

            @if(!empty($order->wallet_price) && $order->wallet_price != 0)
              <div class="flex justify-between">
                <dt class="text-gray-500 dark:text-gray-400">Paid from Wallet</dt>
                <dd class="font-medium text-gray-900 dark:text-gray-100">-{{ $currSign }}{{ number_format($order->wallet_price, 2) }}</dd>
              </div>
            @endif

            @if(!empty($order->tax) && $order->tax != 0)
              <div class="flex justify-between">
                <dt class="text-gray-500 dark:text-gray-400">Tax</dt>
                <dd class="font-medium text-gray-900 dark:text-gray-100">{{ $currSign }}{{ number_format($order->tax, 2) }}</dd>
              </div>
            @endif

            <div class="flex justify-between pt-3 border-t border-gray-200 dark:border-gray-700">
              <dt class="text-base font-bold text-gray-900 dark:text-gray-100">Total</dt>
              <dd class="text-base font-black text-gray-900 dark:text-gray-100">
                {{ $currSign }}{{ number_format($order->pay_amount + ($order->wallet_price ?? 0), 2) }}
              </dd>
            </div>

          </dl>
        </div>
      </div>

      {{-- Footer Note --}}
      <div class="border-t border-gray-200 dark:border-gray-700 px-8 py-5 bg-gray-50 dark:bg-gray-900/30">
        <p class="text-xs text-gray-400 dark:text-gray-500 text-center">
          Thank you for shopping with us.
        </p>
        @if(!empty($gs->address))
          <p class="text-xs text-gray-400 dark:text-gray-500 text-center mt-1">{{ $gs->address }}</p>
        @endif
      </div>

    </div>{{-- /invoice-card --}}

    {{-- Bottom toolbar (duplicate for convenience) --}}
    <div class="no-print flex justify-end gap-3 mt-6">
      <button type="button" onclick="window.print()"
        class="inline-flex items-center gap-2 px-5 py-2.5 border border-gray-300 dark:border-gray-600 text-sm font-semibold text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-600">
        <span class="material-icons-outlined text-base" aria-hidden="true">print</span>
        Print
      </button>
      <button type="button" onclick="downloadPDF()"
        class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary-800 text-white text-sm font-semibold hover:bg-primary-900 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-600">
        <span class="material-icons-outlined text-base" aria-hidden="true">download</span>
        Download PDF
      </button>
    </div>

  </div>
</main>

{{-- jsPDF for client-side PDF generation --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
  async function downloadPDF() {
    const btn = document.querySelector('[onclick="downloadPDF()"]');
    const originalHTML = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<span class="material-icons-outlined text-base animate-spin" aria-hidden="true">autorenew</span> Generating…';

    try {
      const { jsPDF } = window.jspdf;
      const card = document.getElementById('invoice-card');

      const canvas = await html2canvas(card, {
        scale: 2,
        useCORS: true,
        backgroundColor: '#ffffff',
        logging: false,
      });

      const imgData  = canvas.toDataURL('image/png');
      const pdf      = new jsPDF({ orientation: 'portrait', unit: 'mm', format: 'a4' });
      const pdfW     = pdf.internal.pageSize.getWidth();
      const pdfH     = (canvas.height * pdfW) / canvas.width;

      pdf.addImage(imgData, 'PNG', 0, 0, pdfW, pdfH);
      pdf.save('invoice-{{ $order->order_number }}.pdf');
    } catch (e) {
      console.error('PDF generation failed:', e);
      alert('Could not generate PDF. Please use the Print button instead.');
    } finally {
      btn.disabled = false;
      btn.innerHTML = originalHTML;
    }
  }
</script>

@endsection
