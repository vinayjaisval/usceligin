@extends('layouts.front')
@section('content')
@include('partials.global.common-header')




<style>
   @import url('https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&display=swap');

   body {
      overflow-x: hidden;
      font-family: 'Open-Sans ';
   }

   h1,
   h2,
   h3,
   h4,
   h5,
   h6,
   p {
      font-family: 'Open Sans';
   }

   .celigin-main-skinglobe,
   .unlock-title {
      background-color: #FCF7EE;
   }

   .shop-now-lady h1 {
      color: #BB8A8A;
      font-size: 40px;
      font-weight: 600;
   }

   .shop-now-lady h2 {
      background-color: #BB8A8A;
      color: #fff;
      font-size: 45px;
      width: 100%;
   }

   .shop-now-lady span {

      background-color: #FCF7EE;
      font-size: 16px;
      padding: 5px 30px;
   }

   .shop-now-lady a {
      color: #B07A7A;
   }

   .shop-now-lady p {
      color: #B07A7A;
      font-size: 18px;
      text-align: justify;
   }

   .shop-now-lady {
      margin-top: 100px;
   }

   .join-recently-title p {
      color: #B07A7A;
      font-size: 18px;

   }

   .join-recently-title-update button {
      background-color: #BB8A8A;
      font-family: 'Open Sans';
      font-size: 16px;
      outline: none;
   }

   .join-recently-title-update a {
      font-size: 20px;
      letter-spacing: 3px;
   }

   .ambassator-heading h2 {
      font-size: 40px;
      color: #9F5454;
      font-weight: 600 !important;
      letter-spacing: 3px;
   }

   .ambassator-heading p {
      font-size: 16px;
      color: #B07A7A;
   }

   .heading-text-brand h3 {
      color: #9F5454;
      font-weight: 600;
      font-size: 30px;

   }

   .heading-text-brand ul li {
      color: #B07A7A;
   }

   .heading-text-brand a {
      font-size: 14px;
   }

   .register-refer-point {
      background-color: #BB8A8A;
      width: 200px;
      height: 200px;
   }

   .number-title {
      display: inline-block;
      height: 40px;
      width: 40px;
      line-height: 2.4;
      color: #a96060;
      font-size: 15px;
      font-weight: 600;
   }

   .description-explainer {
      border-radius: 0% 0% 200px 200px;
      height: 90px;
   }

   .description-explainer p {
      color: #BB8A8A;
      font-size: 14px;

   }

   .number-title p {
      font-weight: 600;
      font-size: 14px;
   }

   .register-refer-point p {
      font-size: 12px;
   }

   .condition-apply {
      color: #BB8A8A;
      font-family: 'Open Sans';
   }

   .register-demand-title {
      background-color: #FCF7EE;
   }

   .celigin-img-trick img {
      width: 100%;
      height: auto;
   }

   .unlock-heading-text h2 {
      font-weight: 600;
      color: #BB8A8A;
      font-size: 30px;
   }

   .unlock-heading-text p {
      color: #B07A7A;
      font-size: 15px;
   }

   .meet-fix h2 {
      color: #BB8A8A;
      font-weight: 600;
      font-size: 40px;
   }

   .meet-fix p {
      color: #B07A7A;
      font-size: 15px;
   }

   .img-freelance-resource img {
      width: 200px;
      height: auto;
      z-index: 1;
      position: absolute;
      border-radius: 100%;
      padding: 15px;
   }

   .img-freelance-resource {
      height: 200px;
      width: 200px;
      padding: 15px;
   }

   .shadow-inside-text {
      background: #bb8a8a;
      width: 230px;
      height: 138px;
      border-radius: 0% 0% 200px 200px;
      top: 125px;
      left: 0px;
   }

   .social-media-ixcon {
      position: relative;
      margin-top: 20px;

   }

   .social-media-ixcon p {
      margin-left: -50px;
      font-size: 14px;
   }

   .face-icon-media {
      font-size: 30px;
      width: 125px;
      margin: auto;
      border-radius: 10px;
      margin-left: 50px;
      position: relative;
      top: 10px;
   }

   .girl-brand-story {
      margin-top: -34px;
   }
</style>

<!-- ===========================================your skin===================================================== -->
<section>
   <div class="celigin-main-skinglobe">
      <div class="skin-product-lady">
         <div class="container">
            <div class="row">
               <div class="col-lg-6">
                  <div class="shop-now-lady ">
                     <h1>Your Skin, Your Radiance, </h1>
                     <h2 class="px-3 d-flex justify-content-between align-items-center gap-5 pb-2">Your Celigin <span class="mt-2 rounded"><a href="{{ route('front.join-now-club') }}"> Join Now </a></span></h2>
                     <p>Experience Celigin—where skincare is an expression of your natural radiance.
                        Our curated selection of premium Korean skincare is designed to meet your unique needs,
                        helping you achieve glowing, confident skin.
                        Discover the best of Korean beauty, exclusively at Celigin.</p>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="shop-now-lady-image mt-3">
                     <img src="assets/images/friends.png" alt="friends">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

<!-- =========================================================Join Now========================================== -->
<section>
   <div class="join-now-title-edit py-4">
      <div class="container">
         <div class="row">
            <div class="col-lg-9">
               <div class="join-recently-title">
                  <p class="fw-normal">Join Our Growing Family As A Brand Ambassador And Share The Transformative Power
                     Of Our Premium Products With Your Community</p>
               </div>
            </div>
            <div class="col-lg-3">
               <div class="join-recently-title-update text-end">
                  <a href=" {{ route('front.join-now-club') }}">
                     <button class="px-3 py-2 rounded fw-bold text-uppercase text-white ">join Now</button></a>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

<!-- ======================================================Brand Ambassador======================================== -->
<section>
   <div class="brand-ambassator-title pt-4">
      <div class="ambassator-heading text-center">
         <h2>BECOME A BRAND AMBASSADOR</h2>
         <p class="fw-normal">Are You Passionate About Health, Beauty, and Empowering Others To Look And Feel Their Best? <br>
            Join Our Growing Family As A Brand Ambassador And Share The Transformative Power Of Our Premium
            Products With <br> Your Community
            Are You Passionate About Health, Beauty, and Empowering Others To Look And Feel Their Best?</p>
      </div>
      <div class="container mt-4">
         <div class="row">
            <div class="col-lg-8">
               <div class="heading-text-brand">
                  <h3 class="text-uppercase">Exclusive Ambassador Benefits:</h3>
                  <ul class="fw-normal">
                     <li>Be the first to experience and share our latest Korean skincare innovations.</li>
                     <li>Enjoy exclusive discounts on your favorite Celigin products.</li>
                     <li>Unlock unique rewards for your dedication and passion in promoting Celigin.</li>
                     <li>Earn commissions on sales generated through your personalized referral links.</li>
                     <li>Connect with a network of like-minded individuals who share your passion for beauty, wellness, and empowerment.</li>
                     <li>Access to special events, exclusive content, and more ways to connect with the brand you love.</li>
                  </ul>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="girl-brand-story">
                  <img id="slideshow" src="assets/images/girl-brand (3).png" alt="Slideshow Image">
                  <!-- <img src="assets/images/girl-brand.png" alt="girl"> -->
               </div>
            </div>
         </div>
      </div>
   </div>
</section>


<!-- ====================================================cards-details========================================== -->
<section>
   <div class="cards-discount-title mt-5">
      <div class="container py-5 position-relative width-shrink mx-auto">

         <!-- Vertical timeline line -->
         <div class="timeline-line"></div>

         <!-- 1. Initial Stage -->
         <div class="row mb-5 position-relative">
            <div class="col-md-6 d-flex">
               <div class="card border-0  p-3 text-start hover-card" style="width: 100%; z-index: 1;">
                  <div class="d-flex gap-5 d-fl">
                     <img src="https://cdn-icons-png.flaticon.com/512/6815/6815043.png" class="" style="height: 50px;" alt="Initial Icon">
                     <h6 class="fw-bold  mt-2">Initial Steps – Becoming an Affiliate User</h6>
                  </div>
                  <ol class="mt-3">
                     <li><span class="fw-bold"></span> Visit Website & Purchase: Anyone who buys a product on <a href="www.celiginglobal.com">www.celiginglobal.com</a> becomes eligible.</li>
                     <li><span class="fw-bold"></span>Automatic Enrollment: Upon purchase, the customer is automatically enrolled as an Affiliate User.</li>
                     <li><span class="fw-bold"></span>Referral Link Generation: A unique referral link is generated and assigned to the user.</li>
                  </ol>
               </div>
            </div>
         </div>

         <!-- 2. Business Manager -->
         <div class="row mb-5 position-relative cxdp">
            <div class="col-md-6 d-flex align-items-center ">
               <!-- <i class="fas fa-arrow-left text-secondary fs-2 me-3 d-none d-md-block"></i> -->
            </div>
            <div class="col-md-6 d-flex gap-5">
               <div class="card border-0  p-3 text-start hover-card" style="width:100%; z-index: 1;">
                  <div class="d-flex gap-5 d-fl">
                    <img src="https://cdn-icons-png.flaticon.com/512/4140/4140051.png" style="height: 50px;" alt="Girl Icon">

                     <h6 class="fw-bold  mt-2">Business Manager (BM)</h6>
                  </div>
                  <p class=" small mb-0 mt-3">Promotion after 3 or more people purchase through your referral link.</p>
                  <ol class="">
                     <li>8% commission on direct sales (your link).</li>
                     <li>5% commission on indirect sales (sales by people you’ve referred)</li>
                     <li>Quarterly target ₹1,00,000 = extra 2%.</li>
                     <li>Yearly target ₹5,00,000 = extra 2%.</li>
                  </ol>
               </div>
            </div>
         </div>

         <!-- 3. Sales Manager -->
         <div class="row mb-5 position-relative cxdp">
            <div class="col-md-6 d-flex ">
               <div class="card  border-0  p-3 text-start hover-card" style="width: 100%; z-index: 1;">
                  <div class="d-flex gap-5 d-fl">
                    <img src="https://cdn-icons-png.flaticon.com/512/4140/4140056.png" style="height: 50px;" alt="Professional Girl Icon">


                     <h6 class="fw-bold  mt-2">Sales Manager (SM)</h6>
                  </div>
                  <p class=" small mb-0 mt-3">Promotion from BM by growing network and hitting sales targets.</p>
                  <ol class="">
                     <li>8% on direct sales.</li>
                     <li>5% on indirect sales (from BMs in your network).</li>
                     <li>Quarterly target ₹3,00,000 = +5% bonus.</li>
                     <li>Yearly target ₹10,00,000 = +3% bonus.</li>
                  </ol>
               </div>
            </div>
            <div class="col-md-6 d-flex align-items-center">
               <!-- <i class="fas fa-ellipsis-v text-secondary fs-2"></i> -->
            </div>
         </div>

         <!-- 4. Celigin Partner -->
         <div class="row position-relative cxdp">
            <div class="col-md-6 d-flex align-items-center justify-content-end">
               <!-- <i class="fas fa-arrow-left text-secondary fs-2 me-3 d-none d-md-block"></i> -->
            </div>
            <div class="col-md-6 ">
               <div class="card  border-0  p-3 text-start hover-card" style="width: 100%; z-index: 1;">
                  <div class="d-flex gap-5 d-fl">
            <img src="https://cdn-icons-png.flaticon.com/512/4140/4140038.png" style="height: 50px;" alt="Professional Girl Icon">


                     <h6 class="fw-bold  mt-2">Celigin Partner (CP)</h6>
                  </div>
                  <p class=" small mb-0 mt-3">High-performing SMs/BMs with large, active networks.</p>
                  <ol class="">
                     <li>8% on direct sales.</li>
                     <li>5% on indirect sales (entire cluster).</li>
                     <li>Quarterly target ₹5,00,000 = +8%.</li>
                     <li>Yearly target ₹20,00,000 = +5%.</li>
                  </ol>
               </div>
            </div>
         </div>
         <div class="vn-red container mt-5" style="text-align: center;">
          <a href="assets/images/celigin.pdf" download="">
           <img src="assets/images/dwonpdf.svg" alt="Download PDF">
           </a>
        </div>
      </div>
   </div>


</section>
<!-- ===========================================registerand earn===================================================== -->

<section>
   <div class="register-demand-title mt-5 ">
      <div class="container">
         <div class="gift-point-earn d-flex justify-content-center gap-5 py-5 flex-wrap">
            <div class="register-refer-point rounded-circle text-center">
               <h4 class="rounded-circle bg-white mt-3 number-title">1</h4>
               <p class="text-uppercase m-2 text-white">Download The CELIGIN App</p>
               <div class="description-explainer bg-white m-2">
                  <p class="pt-2 p-2">Start here. Download the app to manage your business from anywhere.</p>
               </div>
            </div>
            <div class="register-refer-point rounded-circle text-center">
               <h4 class="rounded-circle bg-white mt-3 number-title">2</h4>
               <p class="text-uppercase m-2 text-white">Register And Verify</p>
               <div class="description-explainer bg-white m-2">
                  <p class="pt-2 p-2">Verify Your Email And Enroll As A Brand Ambassador.</p>
               </div>
            </div>
            <div class="register-refer-point rounded-circle text-center">
               <h4 class="rounded-circle bg-white mt-3 number-title">3</h4>
               <p class="text-uppercase m-2 text-white">Refer And Earn</p>
               <div class="description-explainer bg-white m-2">
                  <p class="pt-2 p-2">Refer 5* Potantial Customer And Become Celigin Club Member.</p>
               </div>
            </div>
            <div class="register-refer-point rounded-circle text-center">
               <h4 class="rounded-circle bg-white mt-3 number-title">4</h4>
               <p class="text-uppercase m-2 text-white">Agree Terms And Conditions</p>
               <div class="description-explainer bg-white m-2">
                  <p class="pt-2 p-2">Review The Privacy Policy And Brand Ambassador Agreement.</p>
               </div>
            </div>
            <div class="register-refer-point rounded-circle text-center">
               <h4 class="rounded-circle bg-white mt-3 number-title">5</h4>
               <p class="text-uppercase m-2 text-white">Make More Money By...</p>
               <div class="description-explainer bg-white m-2">
                  <p class="pt-2 p-2">Buy Your Beauty Box In-App And Kick-Start Your Journey.</p>
               </div>
            </div>
         </div>
         <div class="convert-sale-title text-center pb-5">
            <button class="bg-white condition-apply py-2 px-4 rounded">*T&Cs</button>
         </div>
      </div>
   </div>
</section>

<!-- =============================================unlock-glow============================================ -->

<section>
   <div class="unlock-title py-5">
      <div class="container">
         <div class="row">
            <div class="col-lg-6">
               <div class="unlock-heading-text mt-3">
                  <h2 class="text-uppercase">Unlock Your Celigin Glow!</h2>
                  <p>Discover the Celigin Beauty Box—a handpicked selection of premium skincare essentials.
                     For a limited time, enjoy 15% off your first purchase when you order today. Experience
                     the transformative power of Celigin at an exclusive price!</p>
                  <br>
                  <p>The contents of the Celigin Beauty Box, including item colors, may vary based on market
                     trends and available inventory. The value of the box may also fluctuate according to
                     product availability.</p>
               </div>
            </div>
            <div class="col-lg-6">
               <div class="celigin-img-trick">
                  <img src="assets/images/aesome.png" alt="aesome">
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

<!-- =====================================================freelancer============================================= -->

@php
$user=App\Models\User::where('reffered_times',5)->get();
@endphp
@if(count($user) > 0)
<section>
   <div class="freelancer-title py-5">
      <div class="meet-fix">
         <h2 class="text-center">MEET OUR INFLUENCER</h2>
         <p class="text-center fw-normal">Our dedicated influencer leverages expertise and creativity to deliver <br>
            impactful digital marketing solutions.</p>
      </div>
      <div class="container mb-3">
         <div class="row">
            @forelse ($user as $item)
            <div class="col-lg-3">
               <div class="free-meet">
                  <div class="img-freelance-resource rounded-circle position-relative">
                     <img src="{{asset('assets/images/users')}}/{{$item->photo}}" width="20px" height="20px" alt="ellipse" class="bg-white">
                     <div class="shadow-inside-text position-absolute">

                     </div>
                  </div>
               </div>
               @php
               $influencers = DB::table('influencers')->where('email', $item->email)->first();
               @endphp
               <div class="social-media-ixcon">
                  <div class="social-action text-center">
                     <p class="text-white">{{$item->name}}</p>
                     <div class="face-icon-media bg-white">
                        @if(!empty($influencers->instagram_profile_link))
                        <a href="{{$influencers->instagram_profile_link ?? ""}}" target="_blank">
                           <i class="fab fa-instagram"></i>
                        </a>
                        @endif
                        @if(!empty($influencers->youtube_profile_link))
                        <a href="{{$influencers->youtube_profile_link ?? ""}}" target="_blank">
                           <i class="fab fa-youtube"></i>
                        </a>
                        @endif
                        <!-- <a href="https://www.facebook.com/profile.php?id=61560546347818" target="_blank">
                           <i class="fab fa-facebook"></i>
                        </a>
                        <a href="https://www.youtube.com/@Celiginglobal" target="_blank">
                            <i class="fab fa-youtube"></i>
                        </a> -->
                     </div>
                  </div>
               </div>
            </div>
            @empty

            @endforelse
         </div>
      </div>
   </div>
</section>
@endif
<!-- ==================================================instagram===================================================== -->
<section>
   <div class="instagram-title py-5 mt-2">
      <div class="">
         <div class="row">
            <div class="col-lg-4">
               <div class="inatsgarm-us d-flex justify-content-center gap-2 ">
                  <img src="assets/images/Link56.png">
                  <img src="assets/images/Link61.png">
                  <img src="assets/images/Link57.png">
               </div>
            </div>
            <div class="col-lg-4">
               <div class="insta-text text-center ">
                  <span class="text-uppercase">Glow with us!</span>
                  <h5>Follow Us on Instagram</h5>
                  <p>Get the latest skincare tips, product launches, <br> and exclusive offers.</p>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="inatsgarm-us d-flex justify-content-center gap-2 ">
                  <img src="assets/images/cream58.png">
                  <img src="assets/images/Link59.png">
                  <img src="assets/images/Link60.png">
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<script>
   const images = ["assets/images/girl-brand (3).png", "assets/images/Frame 7.png"]; // List of image URLs
   let currentIndex = 0;

   function changeImage() {
      currentIndex = (currentIndex + 1) % images.length; // Loop through images
      document.getElementById('slideshow').src = images[currentIndex];
   }

   setInterval(changeImage, 3000); // Change image every 3 seconds
</script>

@includeIf('partials.global.common-footer')
@endsection