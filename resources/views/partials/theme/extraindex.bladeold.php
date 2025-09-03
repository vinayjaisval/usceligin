<!--==================== Service Section Start ====================-->
<!-- <div class="full-row bg-light py-4">
    <div class="container">
        <div class="row row-cols-xl-3 row-cols-sm-2 row-cols-1 gy-4 gy-xl-0">
            {{-- <div class="col">
                <div class="simple-service px-3 md-my-10 d-flex align-items-center">
                    <div class="box-80px rounded-pill position-relative bg-white"><i
                            class="flaticon-money flat-medium text-secondary xy-center position-absolute"></i></div>
                    <div class="ms-3">
                        <h5 class="mb-1 font-500"><a href="service.html"
                                class="text-dark hover-text-primary transation-this">Money Gurantee</a></h5>
                        <div class="font-small text-secondary">
                            <span>With A 30 Days</span>
                        </div>
                    </div>
                </div>
            </div> --}}
            @foreach (DB::table('services')->get() as $service)
                <div class="col">
                    <div class="simple-service px-3 md-my-10 d-flex align-items-center">
                        <div class="box-80px rounded-pill position-relative bg-white">
                            <img class="flat-medium text-secondary xy-center position-absolute"
                                src="{{asset('assets/images/services/'.$service->photo)}}" alt="">
                        </div>
                        <div class="ms-3 tp-center">
                            <h5 class="mb-1 font-500">{{$service->title}}</h5>
                            <div class="font-small text-secondary">
                                <span>{{$service->details}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div> -->
<!-- <section>
    <div class="slide-container">
        <div class="slide-track">

            <div class="slide-image"><span>10% off on first order</span></div>
            <div class="slide-image"><span>10% off on first order</span></div>
            <div class="slide-image"><span>10% off on first order</span></div>
            <div class="slide-image"><span>10% off on first order</span></div>
            <div class="slide-image"><span>10% off on first order</span></div>
            <div class="slide-image"><span>10% off on first order</span></div>
            <div class="slide-image"><span>10% off on first order</span></div>
            <div class="slide-image"><span>10% off on first order</span></div>
            <div class="slide-image"><span>10% off on first order</span></div>
            <div class="slide-image"><span>10% off on first order</span></div>

            <div class="slide-image"><span>10% off on first order</span></div>
            <div class="slide-image"><span>10% off on first order</span></div>
            <div class="slide-image"><span>10% off on first order</span></div>
            <div class="slide-image"><span>10% off on first order</span></div>
            <div class="slide-image"><span>10% off on first order</span></div>
        </div>
    </div>
</section> -->
<section>
    <div class="natural-title py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 text-center">
                    <div class="natural-item">
                        <img src="assets/images/image3__1_-removebg-preview.png">
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




<!-- ========================================fourth-banner======================================================== -->






<!--==================== Service Section End ====================-->


@if($ps->top_big_trending==1)
<!--==================== Top Collection Section Start ====================-->
<div class="full-row bg-white mt-4">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="top-collection-tab nav-tab-active-secondary">
                    <ul class="nav nav-pills list-color-general justify-content-center mb-4">
                        <li class="nav-item">
                            <a class="nav-link active font-data" data-bs-toggle="pill" href="#pills-new-arrival-two">{{ __('
                                All Product') }}</a>
                        </li>

                        <!-- <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="pill" href="#pills-best-selling-two">{{ __('Best
                                Selling') }}</a>
                        </li> -->

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="pills-new-arrival-two">
                            <div class="products product-style-1">
                                <div
                                    class="row g-4 row-cols-xl-4 row-cols-md-3 row-cols-sm-2 row-cols-2 e-title-general e-title-hover-primary e-image-bg-light e-hover-image-zoom e-info-center">

                                    @foreach($latest_products as $prod)
                                    <div class="col">
                                        @include('partials.product.home-product')
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-Trending-two">
                            <div class="products product-style-1">
                                <div
                                    class="row g-4 row-cols-xl-4 row-cols-md-3 row-cols-sm-2 row-cols-2 e-title-general e-title-hover-primary e-image-bg-light e-hover-image-zoom e-info-center">
                                    @foreach($trending_products as $prod)
                                    <div class="col">
                                        @include('partials.product.home-product')
                                    </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-best-selling-two">
                            <div class="products product-style-1">
                                <div
                                    class="row g-4 row-cols-xl-4 row-cols-md-3 row-cols-sm-2 row-cols-2 e-title-general e-title-hover-primary e-image-bg-light e-hover-image-zoom e-info-center">
                                    @foreach($sale_products as $prod)
                                    <div class="col">
                                        @include('partials.product.home-product')
                                    </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-featured-two">
                            <div class="products product-style-1">
                                <div
                                    class="row g-4 row-cols-xl-4 row-cols-md-3 row-cols-sm-2 row-cols-2 e-title-general e-title-hover-primary e-image-bg-light e-hover-image-zoom e-info-center">
                                    @foreach($popular_products as $prod)
                                    <div class="col">
                                        @include('partials.product.home-product')
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
<!--==================== Top Collection Section End ====================-->
@endif
<section>
    <div class="bodys-product-title">

    </div>
</section>
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
                            ultimate cleanser for radiant, healthy skin
                        </h3>
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

<section>
    <div class="trending-title py-4">
        <div class="text-center hint-across">
            <span class="text-uppercase">Top Picks</span>
            <h3 class="fw-bold">New & Trending Products</h3>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row mt-4">
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


@if($ps->category==1)
<div class="full-row mt-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="text-center hint-across">

                <h3 class="fw-bold">The Hottest Seller This Month!</h3>
            </div>
        </div>
        <div class="products product-style-1">
            <div
                class="row mt-3 row-cols-xl-4 row-cols-md-3 row-cols-sm-2 row-cols-2 e-title-general e-title-hover-primary e-image-bg-light e-hover-image-zoom e-info-center">

                @foreach($popular_products as $prod)
                <div class="col">
                    @include('partials.product.home-product')
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!--==================== Top Products Section End ====================-->
@endif
<section>
    <div class="body-product-title">

    </div>
</section>
<!-- @if($ps->deal_of_the_day==1) -->

<!--==================== Deal of the day Section Start ====================-->
<!-- <div class="full-row bg-light">
    <div class="container">
        <div class="row offer-product align-items-center">
            <div class="col-xl-5 col-lg-7">
                <h1 class="down-line-secondary text-dark text-uppercase mb-30">{{ __('EPIC DEAL') }}</h1>
                <div class="product type-product">
                    <div class="product-wrapper">
                        <div class="product-info">

                            <h3 class="product-title">{{ $gs->deal_title }}</h3>

                            <div class="font-fifteen">
                                <p>{{ $gs->deal_details }}</p>
                            </div>
                            <div class="time-count time-box text-center my-30 flex-between w-75"
                                data-countdown="{{ $gs->deal_time }}"></div>
                            <a href="{{ route('front.category') }}"
                                class="btn btn-dark text-uppercase rounded-0">{{ __('Shop Now') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-5 offset-xl-1">

                <div class="xs-mt-30"><img
                        src="{{ $gs->deal_background ? asset('assets/images/'.$gs->deal_background):asset('assets/images/noimage.png') }}"
                        alt=""></div>

            </div>
        </div>
    </div>
</div> -->
<!--==================== Deal of the day Section End ====================-->

<!-- @endif -->
<!--==================== Deal of the day Section End ====================-->



<!--==================== Service Section Start ====================-->
<!-- @if ($ps->partner==1)
<div class="full-row bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">

                <h2 class="main-title mb-4 text-center text-secondary">{{ $gs->partner_title }}</h2>
                <span class="mb-30 sub-title text-general font-medium ordenery-font font-400 text-center">{{
                    $gs->partner_text }}</span>
            </div>
        </div>
        <div class="row g-3">
            @foreach (DB::table('partners')->get() as $data)
            <div class="col-6 col-sm-4 col-lg-3 col-xl-2">
                <div class="simple-service">
                    <img src="{{ asset('assets/images/partner/'.$data->photo) }}" alt="">

                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endif -->

<!--==================== Service Section End ====================-->

<!--==================== Top Products Section Start ====================-->
{{--@if($ps->best_sellers==1)
<div class="full-row mt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
               
                <h2 class="main-title mb-5 text-center text-secondary">{{ __('Best Selling Products') }}</h2>

</div>
</div>

<div class="row">
    <div class="col-12">

        <div class="products product-style-1 owl-mx-15">
            <div
                class="four-carousel owl-carousel dot-disable nav-arrow-middle-show e-title-general e-title-hover-primary e-image-bg-light  e-info-center e-title-general e-title-hover-primary e-image-bg-light e-hover-image-zoom e-info-center">
                @foreach($best_products as $prod)
                <div class="item">
                    @include('partials.product.home-product')
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endif--}}
<!--==================== Top Products Section End ====================-->



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
                        <!-- <div class="order-title-text mt-4">
                            <div class="order-nigam-plan">
                                {{-- <h4> <img src="assets/images/Icon45.png"><span>Valentine's Day Combo Offer! Get 25% off until February 14, 2025!</span> to get it by <span> Dec 18, 2024</span></h4> --}}
                                <h4> <img src="assets/images/Icon (1).png"><span> 216 </span> Valentine's Day Combo Offer! Get 25% off until February 14, 2025!</h4>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>



<section>
    <main>
        <div class="container-xxl py-5">
            <div class="container py-5">
                <div class="testimonial-text g-5">
                    <section class="carousel-landmark wow fadeIn" data-wow-delay="0.5s">
                        <div id="carouselExampleCaptions"
                            class="carousel slide testimonial-carousel border-start border-primary"
                            data-bs-ride="carousel"
                            data-bs-interval="5000">

                            <!-- Indicators -->
                            <!-- <div class="carousel-indicators">
                                @if($testimonials->count() > 0)
                                    @foreach ($testimonials as $key => $item)
                                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{$key}}"
                                            class="@if($key == 0) active @endif" aria-current="true" aria-label="Slide {{$key+1}}"></button>
                                    @endforeach
                                @endif
                            </div> -->

                            <!-- Carousel Items -->
                            <div class="carousel-inner">
                                @if($testimonials->count() > 0)
                                    @foreach($testimonials as $key => $testi)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            <div class="row align-items-center px-4">
                                                
                                                <!-- Left: Image -->
                                                <div class="col-md-6 text-center mb-4 mb-md-0">
                                                    <a href="{{ url('testimonial').'/'.$testi->slug ?? "" }}">
                                                        <img class="img-fluid rounded-circle shadow"
                                                            src="{{ $testi->photo ? url('assets/images/blogs/'.$testi->photo) : url('assets/images/noimage.png') }}"
                                                            style="width: 200px; height: 200px; object-fit: cover;">
                                                    </a>
                                                </div>

                                                <!-- Right: Text -->
                                                <div class="col-md-6">
                                                    <div class="testimonial-item ps-md-4">
                                                        <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                                                        <span class="text-uppercase d-block mb-2">Testimonial</span>
                                                        <h5 class="fs-4 textimal-text says-title fw-bold">{{ $testi->title ?? "" }}</h5>
                                                        <p>{{ Str::limit($testi->details ?? "", 200) }}</p>
                                                        <h6>{{ $testi->source ?? "" }}</h6>
                                                        <div class="testimonial-rating mt-2">
                                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i><i class="far fa-star"></i>
                                                    </div>
                                                    </div>
                                                    
                                                   
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <!-- Optional Prev/Next Controls -->
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>

                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>
</section>


</div>
</div>
</div>
</main>
</section>




<!-- ==================================================updated blog-================================================ -->
<section>
    <div class="blogs-title-update py-5">
        <div class="text-center hint-across">
            <span class="text-uppercase">Instant</span>
            <h3 class="fw-bold">News & Updated Blogs</h3>
        </div>
        <div class="container mt-4">
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
                        <p>{!! Str::limit(strip_tags($blog->details), 48) !!}...</p>
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

<!--==================== Our Blog Section Start ====================-->
<!-- @if($ps->blog==1)
<div class="full-row ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <h2 class="main-title  text-center text-secondary">{{ __('Latest Post') }}</h2>
                <span class="mb-5 sub-title text-general font-medium ordenery-font font-400 text-center">{{ __('Explore The Newest Innovations And Initiatives From Celigin.') }}</span>
            </div>
        </div>
        <div class="row row-cols-lg-2 row-cols-1">
            @foreach ($blogs as $blog)
            <div class="col">
                <div class="thumb-latest-blog text-center transation hover-img-zoom mb-3">
                    <div class="post-image overflow-hidden">
                        <a href="{{ route('front.blogshow',$blog->slug) }}">
                            <img src="{{ asset('assets/images/blogs/'.$blog->photo) }}" alt="Image not found!">
                        </a>

                    </div>
                    <div class="post-content">
                        <h3><a href="{{ route('front.blogshow',$blog->slug) }}"
                                class="transation text-dark hover-text-primary d-table my-10 mx-sm-auto">{{
                                mb_strlen($blog->title,'UTF-8') > 200 ?
                                mb_substr($blog->title,0,200,'UTF-8')."...":$blog->title }}</a></h3>
                        <div class="post-meta font-small text-uppercase list-color-general my-3">
                            <p class="post-date">{{ date('d M, Y',strtotime($blog->created_at)) }}</p>
                        </div>
                        <a href="{{ route('front.blogshow',$blog->slug) }}" class="btn-link-left-line">{{ __('Read
                            More') }}</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div> -->
<!--==================== Our Blog Section End ====================-->
<!-- @endif -->

@includeIf('partials.global.common-footer')
<!-- ✅ Load jQuery first -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets/front/js/extraindex.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const carousel = document.querySelector('#carouselExampleCaptions');
        if (carousel) {
            new bootstrap.Carousel(carousel, {
                interval: 5000, // 5 seconds
                ride: 'carousel',
                pause: false,
                wrap: true
            });
        }
    });
</script>
