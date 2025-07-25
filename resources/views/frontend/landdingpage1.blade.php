@extends('layouts.front')
@section('content')
@include('partials.global.common-header')

<section>
    <div class="lending-page-title">
        <div class="container-fluid ">
            <div class="row">
                <div class="col-lg-8">
                    <div class="leeding-title">
                       <iframe width="100%" height="500" src="https://www.youtube.com/embed/PGexVMix2iU?autoplay=1&amp;loop=1&amp;playlist=PGexVMix2iU&amp;mute=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen="">
                    </iframe>
                       <!-- <video id="videoBanner" width="100%" height="100%" class="rounded" loop autoplay playsinline muted>
                            <source src="assets/images/video/corien.mp4" type="video/mp4">
                            <source src="assets/images/video/corien.webm" type="video/webm">
                        </video> -->
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="celigin-item-new pt-5">
                        <!-- {{-- <span>Glow Beyond Expectations</span> --}} -->
                        <h1 class="fw-bold">Glow Beyond Expectations</h1>
                        <p>Experience radiant, youthful skin with Celigin. Our science-backed formulas
                             cleanse, hydrate, protect, and fight signs of aging for healthy, glowing skin.</p>
                        <a href="{{url('category')}}">Shop Now</a>
                    </div>
                   
                    <div id="slideshow">
                        @foreach($products as $product)
                            <a href="{{ route('front.product', $product->slug) }}"><img src="{{asset('')}}assets/images/thumbnails/{{ $product->thumbnail }}" alt="Product Image"></a>
                        @endforeach
                   </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    var slideShow = function(container) {
        this.images = []; //public var
        this.curImage = 0;
        for (i = 0; i < container.childElementCount; i++) {
            this.images.push(container.children[i]);
            this.images[i].style.display = "none";
        }

        // Handle going to to the next slide
        var nextSlide = function() {
            for (var i = 0; i < this.images.length; i++) {
                this.images[i].style.display = "none";
            }
            this.images[this.curImage].style.display = "block";
            this.curImage++;
            if (this.curImage >= this.images.length) {
                this.curImage = 0;
            }
            window.setTimeout(nextSlide.bind(this), 5000);
        };

        nextSlide.call(this);
    };
    var slike = document.getElementById("slideshow");
    slideShow(slike);
</script>

<!-- =================================shipping-section============================================= -->
<!-- <section>
    <div class="shipping-track">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="track-item d-flex justify-contetn-center align-items-center gap-2">
                        <div class="track-celigin">
                            <img src="assets/images/delivery.gif">
                        </div>
                        <div class="comfirm-track">
                            <span class="text-uppercase">Shipping</span>
                            <h4>Shipping World wide</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="track-item d-flex justify-contetn-center align-items-center gap-2">
                        <div class="track-celigin">
                            <img src="assets/images/administrative-assistant.gif">
                        </div>
                        <div class="comfirm-track">
                            <span class="text-uppercase">Hassle</span>
                            <h4>24*7 Customer Support</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="track-item d-flex justify-contetn-center align-items-center gap-2">
                        <div class="track-celigin">
                            <img src="assets/images/delivery-service_1.gif">
                        </div>
                        <div class="comfirm-track">
                            <span class="text-uppercase">Secured</span>
                            <h4>Safe Packaging</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->

<!-- =================================natural-section============================================= -->
<section>
    <div class="natural-title py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 text-center">
                    <div class="natural-item">
                        <img src="assets/images/image3__1_-removebg-preview.png" >
                    </div>
                    <div class="heading-pure pt-3">
                        <h3>Celigin Is Against On Animal Test</h3>
                        <!-- <p>We’re here for you anytime, anywhere!</p> -->
                 
                    </div>
                </div>
                <div class="col-lg-3 text-center">
                    <div class="natural-item">
                        <img src="assets/images/image21-removebg-preview.png">
                    </div>
                    <div class="heading-pure pt-3">
                        <h3>European Cosmetics Certifier Registered With CNP</h3>
                        <!-- <p>Enjoy our easy returns and exchanges policy</p> -->
                   
                    </div>
                </div>
                <div class="col-lg-3 text-center">
                    <div class="natural-item">
                        <img src="assets/images/image13.png">
                    </div>
                    <div class="heading-pure pt-3">
                        <h3>Exclusive Member Discounts</h3>
                        <!-- <p>Join our loyalty program for exclusive discounts</p> -->
                    
                    </div>
                </div>
                <div class="col-lg-3 text-center">
                    <div class="natural-item">
                        <img src="assets/images/image11.png">
                    </div>
                    <div class="heading-pure pt-3">
                        <h3>First-Time Buyer Discount</h3>
                        <!-- <p>Get an exclusive 10% off on your first purchase</p> -->
                     
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =============================================deeply-natural============================================== -->
 <Section>
        <div class="natural-item-deeply">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="cream-title">
                            <img src="assets/images/cream.png">
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="deeply-pure pt-5">
                            <span class="text-uppercase">PURE AND GENTLE</span>
                            <h3 class="fw-bold"> Celigin Radiant Foam Cleanser (150ml)
                                <br>
                                 ultimate cleanser for radiant, healthy skin</h3>
                            <p>Effortlessly removes impurities and dead skin cells while being gentle to your skin.</p>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="main-pure-cream d-flex  align-items-center gap-3">
                                    <div class="pure-icon">
                                        <img src="assets/images/links.png">
                                    </div>
                                    <div class="smooth-item">
                                        <h4>Gentle Cleansing</h4>
                                    </div>
                                </div>
                                <div class="main-pure-cream d-flex  align-items-center mt-4 gap-3">
                                    <div class="pure-icon">
                                        <img src="assets/images/Link → SVG (2).png">
                                    </div>
                                    <div class="smooth-item">
                                        <h4>Soft & Rich Foam</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="main-pure-cream d-flex  align-items-center gap-3">
                                    <div class="pure-icon">
                                        <img src="assets/images/Link → SVG.png">
                                    </div>
                                    <div class="smooth-item">
                                        <h4>Calming & Soothing</h4>
                                    </div>
                                </div>
                                <div class="main-pure-cream d-flex  align-items-center mt-4 gap-3">
                                    <div class="pure-icon">
                                        <img src="assets/images/Link → SVG (3).png">
                                    </div>
                                    <div class="smooth-item">
                                        <h4>Deep Hydration</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="chat-title d-flex align-items-center gap-5">
                                <a href="{{url('item/celigin-all-day-perfect-sunscreen-50ml-with-coscor-1000ppm-jgu3897e53')}}" class="shop-lilac mt-4 text-uppercase">SHOP NOW</a>
                                <div class="main-pure-cream d-flex  align-items-center mt-4 gap-3">
                                    <div class="pure-icon">
                                        <img src="assets/images/Link → SVG (4).png">
                                    </div>
                                    <div class="smooth-item">
                                        <h5>Chat Us Anytime</h5>
                                        <span>+91 96670 54665</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Section>


     <!-- ========================================fourth-banner======================================================== -->
     <section>
    <div class="bodys-product-title">

    </div>
</section>
    <!--
    =========================================================trending-product==================================== -->
<!-- 
=========================================================trending-product==================================== -->
<section>
        <div class="trending-title py-5">
            <div class="text-center hint-across">
                <span class="text-uppercase">Top Picks</span>
                <h3 class="fw-bold">New & Trending Products</h3>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <a href="{{url('item/celigin-all-day-perfect-sunscreen-50ml-with-coscor-1000ppm-jgu3897e53')}}"><img src="assets/images/Group-3.png" height="100%" class="bd-x"></a>
                                    </div>
                                    <div class="col-lg-8 mtd">
                                        <a href="{{url('how-to-use/night')}}"><img src="assets/images/Link.png" class="bd-x">
                                    </div>
                                    <div class="col-lg-8 mt-4">
                                        <a href="{{url('item/celigin-all-day-perfect-sunscreen-50ml-with-coscor-1000ppm-jgu3897e53')}}"><img src="assets/images/Frame 1.png" class="bd-x"></a>
                                    </div>
                                    <div class="col-lg-4 mt-4">
                                        <a href="{{url('item/celigin-signature-cell-biome-duo-cell-up-first-essence-50ml-with-coscor-10000ppm-vital-serum-50ml-with-coscor-30000ppm-lgt2449gis')}}">
                                        <img src="assets/images/Group-9.png" height="100%" class="bd-x"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 mtd">
                               <a href="{{url('item/celigin-daily-sun-finish-50ml-with-coscor-1000ppm-pon3478klj')}}"><img src="assets/images/ffff.png" height="100%" class="bd-x"></a> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<!-- ==================================================Slider================================================ -->
<section>
    <div class=" slide-container mt-4">
        <div class="slide-image">

            <span>15% Off On </span>
        </div>
        <div class="slide-image">
            <span>15% Off On </span>
        </div>
        <div class="slide-image">
            <span>15% Off On </span>
        </div>
        <div class="slide-image">
            <span>15% Off On </span>
        </div>
        <div class="slide-image">
            <span>15% Off On </span>
        </div>
        <div class="slide-image">
            <span>15% Off On </span>
        </div>
        <div class="slide-image">
            <span>15% Off On </span>
        </div>
        <div class="slide-image">
            <span>15% Off On </span>
        </div>
        <div class="slide-image">
            <span>15% Off On </span>
        </div>
        <div class="slide-image">
            <span>15% Off On </span>
        </div>
        <div class="slide-image">
            <span>15% Off On </span>
        </div>
        <div class="slide-image">
            <span>15% Off On </span>
        </div>
        <div class="slide-image">
            <span>15% Off On </span>
        </div>
        <div class="slide-image">
            <span>15% Off On </span>
        </div>
        <div class="slide-image">
            <span>15% Off On </span>
        </div>
    </div>
</section>

<!-- ==================================================Product-skin================================================ -->

<section>
    <div class="skin-prodcut py-5">
        <div class="text-center hint-across">
            <span class="text-uppercase">Top Picks</span>
            <h3 class="fw-bold">New&nbsp;&amp;&nbsp;Trending&nbsp;Products</h3>
        </div>
        <div class="container">
            <div class="row">
               
            @foreach($bestSelling as $product)
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 ">
                    <div class="skin-routine-title round">
                     <a href="{{ route('front.product', $product->slug) }}">
                        <img src="{{asset('')}}assets/images/thumbnails/{{ $product->thumbnail }}" alt="Product Image"></a>
                        <div class="shopping-click text-center">
                                <a href="{{ route('front.product', $product->slug) }}">Buy Now</a>
                            </div>

                            <div class="actual-price-now">
                           
                            @if($product->previous_price != 0)
                                    <h3> &#8377;{{$product->price}} <span> &#8377;{{$product->previous_price}} </span></h3>
                                    @else
                                    <h3> &#8377;{{$product->price}} </h3>
                                    @endif
                            </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
</section>

<!-- ==================================================body-Product-================================================ -->


<section>
    <div class="body-product-title">

    </div>
</section>

<!-- ==================================================core-collection-================================================ -->
<section>
        <div class="core-collection py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="core-title-collection">
                            <img src="assets/images/Background.png">
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="tabing-click">
                            <div class="d-flex justify-content-center align-items-center ">
                                <div class="">
                                    <nav>
                                        <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><img class="mx-2" src="assets/images/Vector (2).png ">All Products</button>
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="row">
                                            @foreach($allProducts as $product)
                                                <div class="col-md-4 col-sm-6 col-xs-6 col-6"> <!-- Adjust column size as per your requirement (col-md-4 = 3 items per row) -->
                                                    <div class="right-tab-care d-flex  gap-4">
                                                        <div class="care-image ">
                                                        <a href="{{ route('front.product', $product->slug) }}">
                                                        <img src="{{ asset('') }}assets/images/thumbnails/{{ $product->thumbnail }}" alt="Product Image">
                                                    </a>
                                                        </div>
                                                        <div class="right-text-care">
                                                            <h6>{{ Str::limit($product->name,30) }}</h6>
                                                            @if($product->sale_price != 0)
                                                                <span>{{ $product->sale_price }} – {{ round((($product->price - $product->sale_price) / $product->price) * 100) }}% Off</span>
                                                            @elseif($product->price != 0)
                                                                <span>{{ $product->price }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

   <!-- ================================================================= banner=================================== -->
   <section>
    <div class="body-product-titles">

    </div>
</section>
<!-- =======================================================Eye-eggs============================================== -->
<section>
    <div class="eye-title py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product-img-show d-flex gap-4">
                        <div class="buy-now">
                            <img src="assets/images/assets2.png">
                            <div class="shopping-click text-center">
                                <a href="{{url('item/celigin-brightening-peeling-toner-pad-50ml-x-70ea-with-coscor-5000ppm-s183736rl1')}}">Buy Now</a>
                            </div>
                        </div>

                        <div class="buy-now">
                            <img src="assets/images/assets1.png">
                            <div class="shopping-click text-center">
                                <a href="{{url('item/celigin-re-furesh-gelling-mask-25gm-x-10ea-with-coscor-5000ppm-7ng3996pse')}}">Buy Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="product-img-show mt-2 d-flex gap-4">
                        <div class="buy-now">
                            <img src="assets/images/celigin3.jpg">
                            <div class="shopping-click text-center">
                                <a href="{{url('item/celigin-daily-sun-finish-50ml-with-coscor-1000ppm-pon3478klj')}}">Buy Now</a>
                            </div>
                        </div>
                        <div class="buy-now">
                            <img src="assets/images/celigin4.jpg.png">
                            <div class="shopping-click text-center">
                            <a href="{{url('item/celigin-cells-queen-61gm-oxn32826v2')}}">Buy Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="content-egg pt-5">
                        <div class="under-cream">
                            <h3 class="fw-bold">CLEANSE, HYDRATE AND GLOW WITH CELIGIN</h3>
                            <p class="pt-5 text-black">Together, the Brightening Peeling Toner Pad and Refresh Gelling Mask create
                                 a skincare experience that will leave you feeling pampered and rejuvenated.
                                  Exfoliate and brighten, then hydrate and glow — it’s the ultimate skincare duo.
                                   Whether you're getting ready for a special moment or simply treating yourself to a dose of luxury, this duo will leave you with skin that’s glowing with radiance.</p>
                        </div>
                        <div class="order-title-text mt-4">
                            <!-- <div class="order-nigam-plan">
                                {{-- <h4> <img src="assets/images/Icon45.png"><span>Valentine's Day Combo Offer! Get 25% off until February 14, 2025!</span> to get it by <span> Dec 18, 2024</span></h4> --}}
                                <h4> <img src="assets/images/Icon (1).png"><span> 216 </span> Valentine's Day Combo Offer! Get 25% off until February 14, 2025!</h4>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<!-- ======================================================third-banner=========================================== -->
<section>
    <div class="body-products-title">

    </div>
</section>
<!-- ==================================================second-slider-================================================ -->

<!-- {{-- <section>
    <div class=" slide-container ">
        <div class="slide-image slider-secendory">
            <img src="assets/images/7 → brand-logo-2.webp.png">
        </div>
        <div class="slide-image slider-secendory">
            <img src="assets/images/7 → history-logo-1.webp.png">
        </div>
        <div class="slide-image slider-secendory">
            <img src="assets/images/7 → brand-logo-3.webp.png">
        </div>
        <div class="slide-image slider-secendory">
            <img src="assets/images/7 → brand-logo-4.webp.png">
        </div>
        <div class="slide-image slider-secendory">
            <img src="assets/images/7 → brand-logo-6.webp.png">
        </div>
        <div class="slide-image slider-secendory">
            <img src="assets/images/7 → brand-logo-5.webp.png">
        </div>
        <div class="slide-image slider-secendory">
            <img src="assets/images/7 → brand-logo-2.webp.png">
        </div>
        <div class="slide-image slider-secendory">
            <img src="assets/images/7 → history-logo-1.webp.png">
        </div>
        <div class="slide-image slider-secendory">
            <img src="assets/images/7 → brand-logo-3.webp.png">
        </div>
        <div class="slide-image slider-secendory">
            <img src="assets/images/7 → brand-logo-4.webp.png">
        </div>
        <div class="slide-image slider-secendory">
            <img src="assets/images/7 → brand-logo-6.webp.png">
        </div>
        <div class="slide-image slider-secendory">
            <img src="assets/images/7 → brand-logo-5.webp.png">
        </div>
        <div class="slide-image slider-secendory">
            <img src="assets/images/7 → brand-logo-2.webp.png">
        </div>
        <div class="slide-image slider-secendory">
            <img src="assets/images/7 → history-logo-1.webp.png">
        </div>
        <div class="slide-image slider-secendory">
            <img src="assets/images/7 → brand-logo-3.webp.png">
        </div>
        <div class="slide-image slider-secendory">
            <img src="assets/images/7 → brand-logo-4.webp.png">
        </div>
        <div class="slide-image slider-secendory">
            <img src="assets/images/7 → brand-logo-6.webp.png">
        </div>
        <div class="slide-image slider-secendory">
            <img src="assets/images/7 → brand-logo-5.webp.png">
        </div>
    </div>
</section> --}} -->

<!-- ==================================================testimonial-================================================ -->
<section>
        <main>
            <!-- <section class="testimonial-hero"> -->
            <div class="container-xxl py-5">
                <div class="container py-5">
                    <div class="testimonial-text g-5">
                        <section class="carousel-landmark wow fadeIn" data-wow-delay="0.5s">
                            <div id="carouselExampleCaptions"
                                class="carousel slide testimonial-carousel border-start border-primary">
                                <!-- <section>
                <div class="control-bar"></div>
            </section> -->
                                <div class="carousel-indicators">
                                    @if($testimonials->count() > 0)
                                     @foreach ($testimonials as $key => $itesms)
                                       <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{$key}}"
                                        class="@if($key == 0) {{'active'}} @endif" aria-current="true" aria-label="Slide {{$key+1}}"></button>
                                 @endforeach
                                    @endif
                                </div>
                                {{-- @dd($testimonials); --}}
                                <div class="carousel-inner"><!--The Carousel Container-->
                                  @if($testimonials->count() > 0)
                                   @foreach($testimonials as  $key => $testi)
                                    <div class="carousel-item carousel-item-{{$key+1}} {{ $key == 0 ? 'active' : '' }} ">
                                        <div class="testimonial-item ps-5 text-center">
                                            <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                                            <span class="text-uppercase">Testimonial</span>
                                            <p class="fs-4 textimal-text says-title fw-bold">{{$testi->title ?? ""}}</p>
                                            {{-- <div class="start-star mt-3">
                                                <i class="flaticon-star"></i>
                                                <i class="flaticon-star"></i>
                                                <i class="flaticon-star"></i>
                                                <i class="flaticon-star"></i>
                                                <i class="flaticon-star"></i>
                                            </div> --}}
                                            <div class="slider-test mt-3">
                                                <p>{{ Str::limit($testi->details ?? "",200) }}</p>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mt-4">
                                                <a href="{{url('testimonial').'/'.$testi->slug ?? ""}}"><img class="img-fluid flex-shrink-0 rounded-circle"
                                                    src="{{ $testi->photo ? url('assets/images/blogs/'.$testi->photo) : url('assets/images/noimage.png') }}"
                                                    style="width: 60px; height: 60px;"></a>
                                                {{-- <div class="ps-3">
                                                    <h5 class="mb-1">{{ $testi->name }}</h5>
                                                    <span class="at">{{ $testi->email }}</span>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                  @endif
                                    <!-- Control Buttons -->
                                    <div class="control-btn">
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                            <i class="fa fa-arrow-left"></i>
                                            <span class="carousel-control-prev-icon visually-hidden"
                                                aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                            <i class="fa fa-arrow-right"></i>
                                            <span class="carousel-control-next-icon visually-hidden"
                                                aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div><!--[carousel-item-3]-->
                                </div><!--[End of Container]-->
                            </div>
                        </section><!--End of Carousel Landmark-->
                    </div><!--End of row g-5-->
                </div><!-- container py-5 -->
            </div><!--End of Container-xxl py-5 -->
        </main>
    </section>


   
    <!-- ==================================================updated blog-================================================ -->
<section>
        <div class="blogs-title-update py-5">
            <div class="text-center hint-across">
                <span class="text-uppercase">Instant</span>
                <h3 class="fw-bold">News & Updated Blogs</h3>
            </div>
            <div class="container">
                <div class="row">
                  @foreach($blogs as $blog)
                    <div class="col-lg-4">
                        <div class="making-cbd">
                        <a href="{{ route('front.blogshow',$blog->slug) }}"><img src="{{ $blog->photo ? asset('assets/images/blogs/'.$blog->photo):asset('assets/images/noimage.png')}}" alt="Image not found!"></a>
                        </div>
                       
                         <!-- assets/images/blogs -->
                        <hr>
                        <div class="cbd-confo">
                            <h2>{{ Str::limit($blog->title, 25) }}</h2>
                            <p>{{ Str::limit($blog->details, 48) }}...</p>
                            <a href="{{ route('front.blogshow',$blog->slug) }}">Read more</a>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </section>


<!-- ==================================================instagram-section-================================================ -->
<section>
    <div class="instagram-title pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="inatsgarm-us d-flex justify-content-center gap-2">
                        <img src="assets/images/Link56.png">
                        <img src="assets/images/Link61.png">
                        <img src="assets/images/Link57.png">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="insta-text text-center">
                        <span class="text-uppercase">Glow with us!</span>
                        <h5>Follow Us on Instagram</h5>
                        <p>Get the latest skincare tips, product launches, <br> and exclusive offers.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="inatsgarm-us d-flex justify-content-center gap-2">
                        <img src="assets/images/cream58.png">
                        <img src="assets/images/Link59.png">
                        <img src="assets/images/Link60.png">
                    </div>
                </div>
            </div>
        </div>
</section>



@includeIf('partials.global.common-footer')
@endsection
@section('script')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var heroVideo = document.getElementById('videoBanner');

        // Start muted to ensure autoplay works
        heroVideo.muted = true;
        heroVideo.play().catch(error => console.log("Muted autoplay blocked:", error));

        // Wait for any user interaction to unmute
        window.addEventListener("click", function() {
            heroVideo.muted = false;
            heroVideo.play().catch(error => console.log("Autoplay blocked:", error));
        });
        window.addEventListener("scroll", function() {
            heroVideo.muted = false;
            heroVideo.play().catch(error => console.log("Autoplay blocked:", error));
        });
    });
</script>
@endsection