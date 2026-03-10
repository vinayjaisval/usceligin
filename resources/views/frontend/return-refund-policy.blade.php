@extends('frontend.include.app')

@section('content')
<main id="main-content" role="main" class="bg-white dark:bg-gray-900">

  {{-- Hero --}}
  <div class="bg-gray-50 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14">
      @include('frontend.include.breadcrumb', ['items' => [
        ['label' => 'Home', 'url' => route('front.index')],
        ['label' => 'Return & Refund Policy']
      ]])
      <div class="mt-4">
        <p class="text-xs font-semibold tracking-widest uppercase text-primary-600 dark:text-primary-400 mb-2">Policy</p>
        <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-gray-100">Return &amp; Refund Policy</h1>
        <div class="w-12 h-0.5 bg-primary-600 dark:bg-primary-400 mt-4"></div>
        <p class="mt-4 text-sm text-gray-600 dark:text-gray-400 max-w-2xl">
          We want you to be completely satisfied with every purchase. Please read our policy carefully to understand your options if something goes wrong.
        </p>
      </div>
    </div>
  </div>

  @php
    $refundDays = config('order.refund_window_days', 5);
    $sections = [
      ['id' => 'what-can-return',     'heading' => 'What can I return?',                                               'body' => '<p>You may return most items sold on CELIGIN if they are in their original, unused, and unopened condition within the eligible return window. Eligible items include products that were received in a damaged condition, were defective on arrival, or were delivered incorrectly (wrong product or wrong variant).</p><p class="mt-3">To be accepted for return, items must be:</p><ul class="mt-2 space-y-1 list-disc list-inside"><li>Unused and in their original sealed packaging</li><li>Reported within ' . $refundDays . ' days of delivery</li><li>Accompanied by a clear photograph of the item and its condition</li></ul>'],
      ['id' => 'non-returnable',      'heading' => 'What are non-returnable items?',                                    'body' => '<p>Due to the nature of personal care and beauty products, the following cannot be returned under any circumstances:</p><ul class="mt-3 space-y-1 list-disc list-inside"><li>Products that have been opened, used, or had their seal broken</li><li>Items purchased during clearance or final-sale events</li><li>Skincare, cosmetics, and wellness products for hygiene reasons</li><li>Gift cards and digital vouchers</li><li>Items returned beyond the ' . $refundDays . '-day post-delivery window</li></ul><p class="mt-3">If you are unsure whether your item qualifies, please contact our support team before initiating a return.</p>'],
      ['id' => 'how-to-return',       'heading' => 'How to return items?',                                              'body' => '<p>Follow these steps to initiate a return:</p><ol class="mt-3 space-y-3 list-decimal list-inside"><li>Sign in to your account and go to <strong>My Account → Purchase History</strong>.</li><li>Locate the order containing the item you wish to return.</li><li>Click <strong>Request Refund / Return</strong> next to the relevant item.</li><li>Select the reason for your return and upload clear photographs showing the issue.</li><li>Submit your request — our team will review it within 1–2 business days and confirm pickup or next steps via email.</li></ol><p class="mt-3">Do not send items back without receiving confirmation from our team, as unconfirmed returns may not be accepted.</p>'],
      ['id' => 'return-status',       'heading' => 'Where can I check the status of my return?',                       'body' => '<p>Once your return request has been submitted, you can track its progress at any time:</p><ul class="mt-3 space-y-1 list-disc list-inside"><li>Sign in and visit <strong>My Account → Purchase History</strong></li><li>Select the order in question</li><li>The current status of your return or refund request will be displayed alongside the order details</li></ul><p class="mt-3">You will also receive email notifications at each stage — when your request is received, reviewed, approved, and when the refund is processed.</p>'],
      ['id' => 'return-gift',         'heading' => 'How can I return a Gift?',                                          'body' => '<p>If you received a CELIGIN product as a gift and wish to return it, please reach out to our Customer Support team directly with the following information:</p><ul class="mt-3 space-y-1 list-disc list-inside"><li>The order number (if available on the packaging or gift receipt)</li><li>The name or email of the person who placed the original order</li><li>Clear photographs of the item and its condition</li></ul><p class="mt-3">Gift returns are subject to the same eligibility criteria — the item must be unused, in original packaging, and reported within ' . $refundDays . ' days of you receiving it. Refunds for gift returns will be issued as CELIGIN store credit to avoid disclosing the original purchase price to the gift recipient.</p>'],
      ['id' => 'return-gift-card',    'heading' => 'How can I return a Gift Card?',                                     'body' => '<p>Gift cards purchased on CELIGIN are <strong>non-refundable and non-returnable</strong> once issued. This applies to both physical and digital gift cards.</p><p class="mt-3">If a gift card was purchased but never delivered to the recipient, or if there was a technical issue with the card, please contact our support team and we will investigate and resolve the matter on a case-by-case basis.</p>'],
      ['id' => 'replacement',         'heading' => 'Can my order be replaced?',                                         'body' => '<p>Yes — replacements are available for orders where the item received was:</p><ul class="mt-3 space-y-1 list-disc list-inside"><li>Damaged in transit</li><li>Defective or not functioning as described</li><li>The wrong product or variant compared to what was ordered</li></ul><p class="mt-3">Replacement requests must be raised within <strong>' . $refundDays . ' days of delivery</strong>. Subject to stock availability, we will dispatch a replacement at no additional cost. If the item is out of stock, a full refund will be offered instead.</p>'],
      ['id' => 'replacement-address', 'heading' => 'Can the replacement be delivered to a different address?',          'body' => '<p>Replacements are typically dispatched to the original delivery address on the order. However, if you need the replacement sent to a different address, please mention this clearly when submitting your return/replacement request via <strong>Your Orders</strong>.</p><p class="mt-3">Our team will accommodate address changes where possible, provided the new address is within our serviceable delivery zones. Please note that address changes for replacements may add 1–2 business days to the estimated delivery time.</p>'],
      ['id' => 'wrong-item',          'heading' => 'What can I do if I receive a wrong item?',                          'body' => '<p>We sincerely apologise if you received an item that does not match your order. Here is what to do:</p><ol class="mt-3 space-y-2 list-decimal list-inside"><li>Do not open or use the wrong item — keep it in its original condition.</li><li>Go to <strong>My Account → Purchase History</strong> and select the relevant order.</li><li>Choose <strong>Wrong Item Received</strong> as the reason and upload a photo of the item you received alongside the packaging label.</li><li>Submit your request — we will arrange a free pickup of the wrong item and dispatch the correct one within 3–5 business days.</li></ol>'],
      ['id' => 'shipping-refund',     'heading' => 'How can I request a refund for a standard shipping charge?',        'body' => '<p>Shipping charges are refunded in the following situations:</p><ul class="mt-3 space-y-1 list-disc list-inside"><li>The order was cancelled before it was shipped</li><li>The item delivered was incorrect or defective and a return was approved</li><li>The delivery was significantly delayed beyond the promised window due to our error</li></ul><p class="mt-3">To request a shipping refund, raise a support request via <strong>Your Orders</strong> and select the relevant reason. Shipping refunds are credited back to the original payment method within 5–7 business days of approval.</p>'],
      ['id' => 'warranty-refund',     'heading' => 'How can I request a refund for a missing warranty card or user manual?', 'body' => '<p>If your order arrived without a warranty card or user manual that was promised or listed as included, you are entitled to raise a complaint. Here\'s how:</p><ol class="mt-3 space-y-2 list-decimal list-inside"><li>Visit <strong>My Account → Purchase History</strong> and open the relevant order.</li><li>Select <strong>Missing Item in Package</strong> as the issue type.</li><li>Upload a photograph of the contents received and describe what is missing.</li><li>Our team will review the claim and either arrange to send the missing document or issue a partial refund as applicable.</li></ol><p class="mt-3">Please note that warranty cards are managed by the manufacturer. If the card was absent, we will liaise with the brand on your behalf.</p>'],
    ];
  @endphp

  {{-- Content --}}
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-10 lg:gap-16">

      {{-- Sidebar TOC (desktop) --}}
      <aside class="lg:col-span-1 hidden lg:block">
        <div class="sticky top-6 lg:top-8">
          <p class="text-xs font-semibold tracking-widest uppercase text-gray-400 dark:text-gray-500 mb-4" id="toc-label">On this page</p>
          <nav aria-labelledby="toc-label" class="space-y-1">
            @foreach($sections as $section)
              <a href="#{{ $section['id'] }}"
                class="block text-sm text-gray-600 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 py-1 border-l-2 border-transparent hover:border-primary-600 dark:hover:border-primary-400 pl-3 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                {{ $section['heading'] }}
              </a>
            @endforeach
          </nav>
        </div>
      </aside>

      {{-- Mobile TOC dropdown --}}
      <div class="lg:hidden col-span-1">
        <details class="border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
          <summary class="flex items-center justify-between px-4 py-3 text-sm font-semibold text-gray-900 dark:text-gray-100 cursor-pointer list-none select-none focus:outline-none focus:ring-2 focus:ring-primary-500">
            <span>Jump to section</span>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
          </summary>
          <nav aria-label="Policy sections" class="px-4 pb-3 space-y-1">
            @foreach($sections as $section)
              <a href="#{{ $section['id'] }}"
                class="block text-sm text-gray-600 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 py-1 focus:outline-none focus:ring-2 focus:ring-primary-500">
                {{ $section['heading'] }}
              </a>
            @endforeach
          </nav>
        </details>
      </div>

      {{-- Article --}}
      <article class="lg:col-span-3 space-y-12" aria-label="Return and refund policy details">

        {{-- $sections is defined once above the grid — DRY: used for both TOC and article --}}

        @foreach($sections as $i => $section)
          <section id="{{ $section['id'] }}"
            tabindex="-1"
            class="{{ $i > 0 ? 'border-t border-gray-100 dark:border-gray-800 pt-10' : '' }}"
            aria-labelledby="heading-{{ $section['id'] }}">
            <h2 id="heading-{{ $section['id'] }}" class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">{{ $section['heading'] }}</h2>
            <div class="text-sm sm:text-base text-gray-600 dark:text-gray-400 leading-relaxed">
              {!! $section['body'] !!}
            </div>
          </section>
        @endforeach

        {{-- CTA --}}
        <div class="border-t border-gray-100 dark:border-gray-800 pt-10">
          <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-base font-bold text-gray-900 dark:text-gray-100 mb-2">Still have questions?</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Our support team is here to help. You can raise a request directly from your order or get in touch with us.</p>
            <div class="flex flex-col sm:flex-row gap-3">
              <a href="{{ route('user.account') }}#purchases"
                class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-gray-900 dark:bg-gray-100 text-white dark:text-gray-900 text-sm font-semibold hover:bg-gray-700 dark:hover:bg-gray-300 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-500">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Go to Your Orders
              </a>
              <a href="{{ route('user.account') }}#support"
                class="inline-flex items-center justify-center gap-2 px-4 py-2.5 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 text-sm font-semibold hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-500">
                Contact Support
              </a>
            </div>
          </div>
        </div>

      </article>
    </div>
  </div>

</main>
@endsection
