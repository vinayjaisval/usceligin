@extends('frontend.include.app')

@section('content')
<main id="main-content" role="main" class="bg-white dark:bg-gray-900">

  {{-- ── BREADCRUMB ── --}}
  <div class="bg-white dark:bg-gray-900 border-b border-gray-100 dark:border-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
      @include('frontend.include.breadcrumb', [
      'items' => [
      ['label' => 'Home', 'url' => route('front.index')],
      ['label' => 'Contact Us'],
      ],
      ])
    </div>
  </div>

  {{-- ── PAGE TITLE ── --}}
  <section class="bg-gray-50 dark:bg-gray-800/50" aria-labelledby="contact-heading">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 sm:py-20 text-center">
      <h1 id="contact-heading"
        class="text-4xl sm:text-5xl font-bold text-gray-900 dark:text-white tracking-tight">
        Contact Us
      </h1>
      <p class="mt-4 text-base text-gray-500 dark:text-gray-400">
        We're here to help. Reach out to the right team and we'll get back to you as quickly as possible.
      </p>
    </div>
  </section>

  {{-- ── DEPARTMENT CARDS ── --}}
  <section aria-label="Contact departments">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 sm:grid-cols-3">

        {{-- Support --}}
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700
                    sm:border-r-0 p-6 flex gap-4 items-start">
          <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center"
            style="background-color:#1C3057;">
            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24"
              stroke="currentColor" stroke-width="1.8" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0
                       1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442
                       -.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
            </svg>
          </div>
          <div>
            <p class="text-xs font-semibold uppercase tracking-widest mb-1"
              style="color:#1C3057;">Customer Support</p>
            <a href="tel:+919876543210"
              class="block text-base font-bold text-gray-900 dark:text-white
                      hover:opacity-70 transition-opacity">
              +91 98765 43210
            </a>
            <a href="mailto:support@celigin.com"
              class="block text-sm text-gray-500 dark:text-gray-400
                      hover:opacity-70 transition-opacity mt-0.5">
              support@celigin.com
            </a>
          </div>
        </div>

        {{-- Marketing --}}
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700
                    sm:border-r-0 p-6 flex gap-4 items-start">
          <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center"
            style="background-color:#1C3057;">
            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24"
              stroke="currentColor" stroke-width="1.8" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5
                       a4.5 4.5 0 110-9h.75c.704 0 1.402-.03 2.09-.09
                       m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511
                       l-.657.38c-.55.318-1.26.117-1.527-.461a20.845 20.845 0 01-1.44-4.282
                       m3.102.069a18.03 18.03 0 01-.59-4.59c0-1.586.205-3.124.59-4.59
                       m0 9.18a23.848 23.848 0 018.835 2.535M10.34 6.66a23.847 23.847 0 008.835-2.535
                       m0 0A23.74 23.74 0 0018.795 3m.38 1.125a23.91 23.91 0 011.014 5.395
                       m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125
                       a23.91 23.91 0 001.014-5.395m-1.394-9.52
                       c.698.217 1.384.465 2.056.74" />
            </svg>
          </div>
          <div>
            <p class="text-xs font-semibold uppercase tracking-widest mb-1"
              style="color:#1C3057;">Marketing &amp; Partnerships</p>
            <a href="tel:+919876543210"
              class="block text-base font-bold text-gray-900 dark:text-white
                      hover:opacity-70 transition-opacity">
              +91 98765 43210
            </a>
            <a href="mailto:marketing@celigin.com"
              class="block text-sm text-gray-500 dark:text-gray-400
                      hover:opacity-70 transition-opacity mt-0.5">
              marketing@celigin.com
            </a>
          </div>
        </div>

        {{-- General --}}
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700
                    p-6 flex gap-4 items-start">
          <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center"
            style="background-color:#1C3057;">
            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24"
              stroke="currentColor" stroke-width="1.8" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227
                       1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21
                       l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379
                       c1.584-.233 2.707-1.626 2.707-3.228V6.741
                       c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3
                       c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
            </svg>
          </div>
          <div>
            <p class="text-xs font-semibold uppercase tracking-widest mb-1"
              style="color:#1C3057;">General Enquiry</p>
            <a href="tel:+919876543210"
              class="block text-base font-bold text-gray-900 dark:text-white
                      hover:opacity-70 transition-opacity">
              +91 98765 43210
            </a>
            <a href="mailto:hello@celigin.com"
              class="block text-sm text-gray-500 dark:text-gray-400
                      hover:opacity-70 transition-opacity mt-0.5">
              hello@celigin.com
            </a>
          </div>
        </div>

      </div>
    </div>
  </section>

  {{-- ── FORM + DETAILS ── --}}
  <section class="py-14 sm:py-16 lg:py-20" aria-label="Contact form and details">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-5 gap-10 lg:gap-16">

        {{-- ── LEFT: FORM ── --}}
        <div class="lg:col-span-3">
          <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-1">
            Send us a message
          </h2>
          <p class="text-sm text-gray-500 dark:text-gray-400 mb-8">
            Fill in the form below and our team will respond within 24 hours.
          </p>

          {{-- Success --}}
          @if(session('success'))
          <div role="alert"
            class="flex items-start gap-3 bg-emerald-50 dark:bg-emerald-900/20
                        border border-emerald-200 dark:border-emerald-700
                        text-emerald-800 dark:text-emerald-300 px-4 py-3 mb-6 text-sm">
            <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24"
              stroke="currentColor" stroke-width="2" aria-hidden="true">
              <path stroke-linecap="round" d="M5 13l4 4L19 7" />
            </svg>
            <span>{{ session('success') }}</span>
          </div>
          @endif

          {{-- Errors --}}
          @if($errors->any())
          <div role="alert"
            class="flex items-start gap-3 bg-red-50 dark:bg-red-900/20
                        border border-red-200 dark:border-red-700
                        text-red-700 dark:text-red-300 px-4 py-3 mb-6 text-sm">
            <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24"
              stroke="currentColor" stroke-width="2" aria-hidden="true">
              <path stroke-linecap="round"
                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71
                         c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378
                         c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
            </svg>
            <ul class="space-y-0.5">
              @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          <form action="{{ route('front.contact.submit') }}" method="POST"
            id="contact-form" novalidate aria-label="Contact form">
            @csrf

            {{-- Name + Email --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
              <div>
                <label for="contact-name"
                  class="block text-xs font-semibold uppercase tracking-wide
                              text-gray-600 dark:text-gray-400 mb-1.5">
                  Full Name <span class="text-red-500" aria-hidden="true">*</span>
                </label>
                <input id="contact-name" name="name" type="text"
                  value="{{ old('name') }}"
                  autocomplete="name" required
                  placeholder="Your full name"
                  class="w-full px-3 py-2.5 text-sm
                              bg-white dark:bg-gray-800
                              border border-gray-300 dark:border-gray-600
                              text-gray-900 dark:text-white
                              placeholder-gray-400 dark:placeholder-gray-500
                              focus:outline-none focus:ring-1 transition-colors
                              @error('name') border-red-400 @enderror"
                  style="focus-border-color:#1C3057;" />
                @error('name')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
              </div>

              <div>
                <label for="contact-email"
                  class="block text-xs font-semibold uppercase tracking-wide
                              text-gray-600 dark:text-gray-400 mb-1.5">
                  Email Address <span class="text-red-500" aria-hidden="true">*</span>
                </label>
                <input id="contact-email" name="email" type="email"
                  value="{{ old('email') }}"
                  autocomplete="email" required
                  placeholder="you@example.com"
                  class="w-full px-3 py-2.5 text-sm
                              bg-white dark:bg-gray-800
                              border border-gray-300 dark:border-gray-600
                              text-gray-900 dark:text-white
                              placeholder-gray-400 dark:placeholder-gray-500
                              focus:outline-none focus:ring-1 transition-colors
                              @error('email') border-red-400 @enderror" />
                @error('email')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
              </div>
            </div>

            {{-- Phone + Subject --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
              <div>
                <label for="contact-phone"
                  class="block text-xs font-semibold uppercase tracking-wide
                              text-gray-600 dark:text-gray-400 mb-1.5">
                  Phone Number
                </label>
                <input id="contact-phone" name="phone" type="tel"
                  value="{{ old('phone') }}"
                  autocomplete="tel"
                  placeholder="+91 00000 00000"
                  class="w-full px-3 py-2.5 text-sm
                              bg-white dark:bg-gray-800
                              border border-gray-300 dark:border-gray-600
                              text-gray-900 dark:text-white
                              placeholder-gray-400 dark:placeholder-gray-500
                              focus:outline-none focus:ring-1 transition-colors" />
              </div>

              <div>
                <label for="contact-subject"
                  class="block text-xs font-semibold uppercase tracking-wide
                              text-gray-600 dark:text-gray-400 mb-1.5">
                  Subject <span class="text-red-500" aria-hidden="true">*</span>
                </label>
                <select id="contact-subject" name="subject" required
                  class="w-full px-3 py-2.5 text-sm
                               bg-white dark:bg-gray-800
                               border border-gray-300 dark:border-gray-600
                               text-gray-900 dark:text-white
                               focus:outline-none focus:ring-1 transition-colors
                               @error('subject') border-red-400 @enderror">
                  <option value="" disabled {{ old('subject') ? '' : 'selected' }}>Select a topic</option>
                  <option value="Order Support" {{ old('subject') == 'Order Support'       ? 'selected' : '' }}>Order Support</option>
                  <option value="Returns & Refunds" {{ old('subject') == 'Returns & Refunds'   ? 'selected' : '' }}>Returns &amp; Refunds</option>
                  <option value="Product Enquiry" {{ old('subject') == 'Product Enquiry'     ? 'selected' : '' }}>Product Enquiry</option>
                  <option value="Vendor / Partnership" {{ old('subject') == 'Vendor / Partnership'? 'selected' : '' }}>Vendor / Partnership</option>
                  <option value="Marketing" {{ old('subject') == 'Marketing'           ? 'selected' : '' }}>Marketing</option>
                  <option value="Other" {{ old('subject') == 'Other'               ? 'selected' : '' }}>Other</option>
                </select>
                @error('subject')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
              </div>
            </div>

            {{-- Message --}}
            <div class="mb-6">
              <label for="contact-message"
                class="block text-xs font-semibold uppercase tracking-wide
                            text-gray-600 dark:text-gray-400 mb-1.5">
                Message <span class="text-red-500" aria-hidden="true">*</span>
              </label>
              <textarea id="contact-message" name="message"
                rows="5" required
                placeholder="Tell us how we can help…"
                class="w-full px-3 py-2.5 text-sm
                               bg-white dark:bg-gray-800
                               border border-gray-300 dark:border-gray-600
                               text-gray-900 dark:text-white
                               placeholder-gray-400 dark:placeholder-gray-500
                               focus:outline-none focus:ring-1 transition-colors resize-none
                               @error('message') border-red-400 @enderror">{{ old('message') }}</textarea>
              @error('message')
              <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <button type="submit" id="contact-submit"
              class="inline-flex items-center gap-2 text-white text-sm
                           font-semibold uppercase tracking-widest px-8 py-3
                           transition-opacity hover:opacity-90
                           focus:outline-none focus:ring-2 focus:ring-offset-2
                           dark:focus:ring-offset-gray-900"
              style="background-color:#1C3057;">
              <span id="submit-text">Send Message</span>
              <svg id="submit-spinner" class="hidden w-4 h-4 animate-spin"
                fill="none" viewBox="0 0 24 24" aria-hidden="true">
                <circle class="opacity-25" cx="12" cy="12" r="10"
                  stroke="currentColor" stroke-width="4" />
                <path class="opacity-75" fill="currentColor"
                  d="M4 12a8 8 0 018-8v8H4z" />
              </svg>
            </button>
          </form>
        </div>

        {{-- ── RIGHT: DETAILS ── --}}
        <div class="lg:col-span-2" aria-label="Contact information">

          {{-- Office Info --}}
          <div class="border border-gray-200 dark:border-gray-700 mb-6">
            <div class="px-5 py-3.5 border-b border-gray-200 dark:border-gray-700
                        bg-gray-50 dark:bg-gray-800">
              <h3 class="text-xs font-semibold uppercase tracking-widest"
                style="color:#1C3057;">Our Office</h3>
            </div>
            <div class="px-5 py-5 space-y-4">

              <div class="flex items-start gap-3">
                <svg class="w-4 h-4 mt-0.5 flex-shrink-0" style="color:#1C3057;"
                  fill="none" viewBox="0 0 24 24" stroke="currentColor"
                  stroke-width="2" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5
                           a7.5 7.5 0 1115 0z" />
                </svg>
                <address class="not-italic text-sm text-gray-600 dark:text-gray-300 leading-relaxed">
                  {{ $ps->street  ?? '123 Commerce Street, Andheri West, Mumbai — 400 053, India' }}
                </address>
              </div>

              <div class="flex items-center gap-3">
                <svg class="w-4 h-4 flex-shrink-0" style="color:#1C3057;"
                  fill="none" viewBox="0 0 24 24" stroke="currentColor"
                  stroke-width="2" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372
                           c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417
                           l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143
                           c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173
                           L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                </svg>
                <a href="tel:{{ preg_replace('/\s+/', '', $ps->phone ?? '+919876543210') }}"
                  class="text-sm text-gray-600 dark:text-gray-300 hover:opacity-70 transition-opacity">
                  {{ $ps->phone ?? '+91 98765 43210' }}
                </a>
              </div>

              <div class="flex items-center gap-3">
                <svg class="w-4 h-4 flex-shrink-0" style="color:#1C3057;"
                  fill="none" viewBox="0 0 24 24" stroke="currentColor"
                  stroke-width="2" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15
                           a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15
                           a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916
                           l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91
                           a2.25 2.25 0 01-1.07-1.916V6.75" />
                </svg>
                <a href="mailto:{{ $ps->email ?? 'hello@celigin.com' }}"
                  class="text-sm text-gray-600 dark:text-gray-300 hover:opacity-70 transition-opacity break-all">
                  {{ $ps->email ?? 'hello@celigin.com' }}
                </a>
              </div>

            </div>
          </div>

          {{-- Business Hours --}}
          <div class="border border-gray-200 dark:border-gray-700">
            <div class="px-5 py-3.5 border-b border-gray-200 dark:border-gray-700
                        bg-gray-50 dark:bg-gray-800">
              <h3 class="text-xs font-semibold uppercase tracking-widest"
                style="color:#1C3057;">Business Hours</h3>
            </div>
            <div class="px-5 py-5">
              <dl class="space-y-3 text-sm">
                <div class="flex justify-between items-center">
                  <dt class="text-gray-500 dark:text-gray-400">Monday – Friday</dt>
                  <dd class="font-medium text-gray-800 dark:text-gray-200">9:00 AM – 6:00 PM</dd>
                </div>
                <div class="flex justify-between items-center pt-3 border-t border-gray-100 dark:border-gray-700">
                  <dt class="text-gray-500 dark:text-gray-400">Saturday</dt>
                  <dd class="font-medium text-gray-800 dark:text-gray-200">10:00 AM – 4:00 PM</dd>
                </div>
                <div class="flex justify-between items-center pt-3 border-t border-gray-100 dark:border-gray-700">
                  <dt class="text-gray-500 dark:text-gray-400">Sunday</dt>
                  <dd class="text-gray-500 dark:text-gray-400">Closed</dd>
                </div>
              </dl>
              <p class="mt-4 text-xs text-gray-500 dark:text-gray-400 leading-relaxed">
                All times are in IST (UTC +5:30).
                Support emails are monitored 7 days a week.
              </p>
            </div>
          </div>



        </div>
      </div>
    </div>
  </section>

  {{-- ── GOOGLE MAP ── --}}
  <section aria-label="Office location on map">
    <div class="w-full overflow-hidden" style="height:420px;">

      <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3503.419213847519!2d77.314222!3d28.587198!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce4f62198efa1%3A0x34e1195e076ff950!2sB37%2C%20B%20Block%2C%20Sector%202%2C%20Noida%2C%20Uttar%20Pradesh%20201301!5e0!3m2!1sen!2sin!4v1774422573942!5m2!1sen!2sin" width="100%" height="100%"
        style="border:0; display:block; filter:grayscale(10%);"
        allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>

    </div>
  </section>


  {{-- ── BANNERS ── --}}
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
    <x-join-celigin-banners />
  </div>

</main>
@endsection

@section('scripts')
<script>
  (function() {
    var form = document.getElementById('contact-form');
    var btn = document.getElementById('contact-submit');
    var btnText = document.getElementById('submit-text');
    var spinner = document.getElementById('submit-spinner');

    if (!form) return;

    form.addEventListener('submit', function(e) {
      var valid = true;
      form.querySelectorAll('[required]').forEach(function(f) {
        if (!f.value.trim()) {
          valid = false;
          f.style.borderColor = '#f87171';
        }
      });
      if (!valid) {
        e.preventDefault();
        return;
      }
      btn.disabled = true;
      btnText.textContent = 'Sending…';
      spinner.classList.remove('hidden');
    });

    form.querySelectorAll('input, select, textarea').forEach(function(f) {
      f.addEventListener('input', function() {
        if (f.value.trim()) f.style.borderColor = '';
      });
    });
  })();
</script>
@endsection