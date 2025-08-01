@extends('layouts.front')

@section('content')
@include('partials.global.common-header')

<style>
   .input-group-text {
      padding: 11px;
      border-radius: 5px 0px 0px 5px;
   }
   .send-otp, #verify-otp{
          border-radius: 0px 5px 5px 0px;
   }
   .radius-opt{
       border-radius: 5px 0px 0px 5px !important;
   }

   .smaller {
      white-space:nowrap;
   }

   .input-width {
      width: 80%;
      margin: auto;
   }
</style>

<div class="full-row py-5">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-lg-6 col-md-8">
            <div class="registration-form border p-4 rounded shadow">
               @include('includes.admin.form-login')
               <h3 class="text-center mb-4">{{ __('Login with OTP') }}</h3>

               <!-- Tab Buttons -->
               <div class="d-flex justify-content-center mb-3">
                  <button class="tab-btn btn btn-outline-primary border-rds me-2 active" id="phone-tab">Phone</button>

                  <button class="tab-btn btn btn-outline-primary border-rdss" id="email-tab">Email</button>
               </div>

               <!-- Input Forms -->
               <div id="input-form">
                  <div class="mb-3 d-none" id="email-group">
                     <div class="d-flex input-width">
                        <input type="email" id="email" class="form-control radius-opt" placeholder="Enter your email">
                        <button id="send-otp" class=" send-otp btn btn-primary smaller">Send OTP</button>
                     </div>
                  </div>
                  <div class="mb-3 " id="phone-group">

                     <div class="d-flex justify-content-between align-items-center input-width">
                        <span class="input-group-text">+91</span>
                        <input type="text"
                           id="phone"
                           class="form-control"
                           placeholder="Enter your phone number"
                           maxlength="10"
                           oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);"
                           required>

                        <button id="send-otp" class=" send-otp btn btn-primary smaller">Send OTP</button>
                     </div>
                  </div>


               </div>

               <!-- OTP Section -->
               <div class="mt-4 d-none" id="otp-section">
                  <div class="mb-3 d-flex input-width">
                     <input type="text" id="otp" class="form-control radius-opt" placeholder="Enter OTP">
                     <button id="verify-otp" class="btn btn-primary smaller">Verify OTP</button>
                  </div>

               </div>

               <!-- Message Area -->
               <div id="message" class="mt-3 text-center text-danger fw-bold"></div>
            </div>
         </div>
      </div>
   </div>
</div>

@include('partials.global.common-footer')
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   let loginType = 'phone';

   // Tab switching
   $('.tab-btn').click(function() {
      $('.tab-btn').removeClass('active');
      $(this).addClass('active');

      loginType = $(this).attr('id') === 'phone-tab' ? 'phone' : 'email';

      $('#email-group').toggleClass('d-none', loginType !== 'email');
      $('#phone-group').toggleClass('d-none', loginType !== 'phone');

      // Reset fields and OTP section
      $('#otp-section').addClass('d-none');
      $('#otp').val('');
      $('#message').text('');
   });

   // Send OTP
   $('.send-otp').click(function() {
      let data = {};
      if (loginType === 'email') {
         const email = $('#email').val();
         if (!email) return $('#message').text('Please enter your email.');
         data.email = email;
      } else {
         const phone = $('#phone').val();
         if (!phone) return $('#message').text('Please enter your phone number.');
         data.phone = phone;
      }

      data.type = loginType;

      $.ajax({
         url: "{{ route('send-otp') }}",
         method: "POST",
         data: data,
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         success: function(res) {
            $('#otp-section').removeClass('d-none');
            $('#message').removeClass('text-danger').addClass('text-success').text(res.message);
         },
         error: function(err) {
            const msg = err.responseJSON?.message || 'Something went wrong.';
            $('#message').removeClass('text-success').addClass('text-danger').text(msg);
         }
      });
   });

   // Verify OTP
   $('#verify-otp').click(function() {
      const otp = $('#otp').val();
      if (!otp) return $('#message').text('Please enter the OTP.');

      let data = {
         otp: otp
      };
      if (loginType === 'email') {
         data.email = $('#email').val();
      } else {
         data.phone = $('#phone').val();
      }
      data.type = loginType;

      $.ajax({
         url: "{{ route('verify-otp') }}",
         method: "POST",
         data: data,
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         success: function(res) {
            $('#message').removeClass('text-danger').addClass('text-success').text(res.message);
            if (res.success) {
               setTimeout(() => {
                  window.location.href = "{{ route('front.checkout')}}";
               }, 1000);
            }
         },
         error: function(err) {
            const msg = err.responseJSON?.message || 'OTP verification failed.';
            $('#message').removeClass('text-success').addClass('text-danger').text(msg);
         }
      });
   });
</script>
@endsection