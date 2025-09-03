<!--==================== Service Section Start ====================-->
<style>
    .offer-badge {
        display: inline-flex;
        align-items: center;
        font-size: 12px;
        letter-spacing: 1px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .offer-badge span {
        background: #2e6449;
        color: #fff;
        padding: 2px 8px;
        border-radius: 4px;
        margin-left: 5px;
        font-size: 11px;
    }

    .offer-title {
        font-size: 25px;
        font-weight: bold;
        margin: 10px 0;
        color: #000;
    }

    .offer-desc {
        font-size: 13px;
        color: #555;
        margin: 15px 0;
    }

    .countdown {
        font-size: 30px;
        font-weight: bold;
        color: #2e6449;
        margin: 15px 0;
    }

    .offer-btn {
        display: inline-block;
        background: #000;
        color: #fff;
        padding: 12px 20px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 14px;
        font-weight: bold;
        transition: 0.3s;
    }

    .card {
        box-shadow: none;
        border-radius: none;
    }

    .offer-btn:hover {
        background: #2e6449;
    }

    /* brand-ambassator */
    .image-hint-across img,
    .mg-beauty img {
        width: 100%;
        height: 300px;
        object-fit: cover;
    }

    .product-card {
        border: none;
        /* background: #fff; */
    }

    .product-card img {
        /* border-radius: 10px; */
        width: 100%;
        height: auto;
    }

    .product-title {
        font-size: 14px;
        margin-top: 8px;
    }

    .price {
        font-weight: bold;
    }

    .old-price {
        text-decoration: line-through;
        color: #777;
        font-size: 13px;
        margin-left: 5px;
    }

    .swiper-button-next,
    .swiper-button-prev {
        color: #000;
    }

    .swiper-wrapper {
        display: flex;
    }

    .swiper-button-next,
    .swiper-button-prev {
        color: #000 !important;
    }

    .swiper-button-next:after,
    .swiper-rtl .swiper-button-prev:after {
        content: 'next';
        font-size: 25px !important;
    }

    .swiper-button-prev:after,
    .swiper-rtl .swiper-button-next:after {
        content: 'prev';
        font-size: 25px !important;
    }

    .tag {
        right: 20px;
        background: red;
        color: #fff;
        padding: 3px 20px;
        top: 10px;
        border-radius: 5px;
    }

    .tags {
        right: 20px;
        background: green;
        color: #fff;
        padding: 3px 20px;
        top: 10px;
        border-radius: 5px;
    }


    /* instagram-reels */
    .insta-section {
  max-width: 1000px;
  margin: auto;
  padding: 20px;
  font-family: Arial, sans-serif;
}

.insta-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 15px;
}

.insta-header h2 {
  display: flex;
  align-items: center;
  font-size: 20px;
}

.insta-header img {
  height: 20px;
  margin-right: 8px;
}

.view-all {
  font-size: 14px;
  text-decoration: none;
  color: #555;
}

.reel-card {
  position: relative;
  width: 150px;
  height: 260px;
  overflow: hidden;
  border-radius: 20px;
}

.reel-card img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 20px;
}

.play-icon {
  position: absolute;
  top: 8px;
  right: 8px;
  font-size: 20px;
  color: white;
  background: rgba(0,0,0,0.4);
  border-radius: 50%;
  padding: 5px;
}
.card .reels-tranding{
    width: 100% !important;
    height: 400px !important;
}

</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
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
<!-- <section>
    <div class="natural-title py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6 col-xs-6 col-6 text-center">
                    <div class="natural-item">
                        <img src="assets/images/image3__1_-removebg-preview.png">
                    </div>
                    <div class="heading-pure pt-3">
                        <h3>Celigin Is Against On Animal Test</h3>
                  

                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-6 col-6 text-center">
                    <div class="natural-item">
                        <img src="assets/images/image21-removebg-preview.png">
                    </div>
                    <div class="heading-pure pt-3">
                        <h3>European Cosmetics Certifier Registered With CNP</h3>
                

                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-6 col-6 text-center">
                    <div class="natural-item">
                        <img src="assets/images/image13.png">
                    </div>
                    <div class="heading-pure pt-3">
                        <h3>Exclusive Member Discounts</h3>
                 

                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-6 col-6 text-center">
                    <div class="natural-item">
                        <img src="assets/images/image11.png">
                    </div>
                    <div class="heading-pure pt-3">
                        <h3>First-Time Buyer Discount</h3>
                    

                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->



<!-- ==========================================================card-product-============================================= -->
<section>
    <div class="classnew-arrivals">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="arrivals-title">
                        <img src="assets/images/Container 1.png">
                    </div>
                </div>
                  <div class="col-lg-4 col-md-6 col-12">
                    <div class="arrivals-title">
                        <img src="assets/images/Container 2.png">
                    </div>
                </div>
                    <div class="col-lg-4 col-md-6 col-12">
                    <div class="arrivals-title">
                        <img src="assets/images/Container 3.png">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =====================================================our-best-sellers=========================================== -->
<section>
    <div class="container mt-5">

        <!-- Section Title -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold">Our Bestsellers</h3>
            <a href="#" class="text-dark text-decoration-none">
                Shop all products <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>

        <!-- Swiper Slider -->
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">

                <!-- Slide 1 -->
                <div class="swiper-slide position-relative">
                    <div class="card product-card">
                        <img src="assets/images/Container 1.png" alt="product">

                        <div class="card-body text-center">
                            <p class="price lh-1">₹6,693 <span class="old-price">₹7,437.50</span></p>
                            <p class="product-title">Celigin royal intensive cream</p>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="swiper-slide position-relative">
                    <div class="card product-card">
                        <img src="assets/images/Container 2.png" alt="product">
                        <div class="tag position-absolute">
                            <span>New</span>
                        </div>
                        <div class="card-body text-center">
                            <p class="price lh-1">₹12,771 <span class="old-price">₹14,491</span></p>
                            <p class="product-title">Celigin cells queen</p>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="swiper-slide position-relative">
                    <div class="card product-card">
                        <img src="assets/images/Container 3.png" alt="product">
                        <div class="tags position-absolute">
                            <span>Sale</span>
                        </div>
                        <div class="card-body text-center">
                            <p class="price lh-1">₹2,992 <span class="old-price">₹3,325</span></p>
                            <p class="product-title">Celigin daily sun finish</p>
                        </div>
                    </div>
                </div>

                <!-- Slide 4 -->
                <div class="swiper-slide">
                    <div class="card product-card">
                        <img src="assets/images/Container 2.png" alt="product">
                        <div class="card-body text-center">
                            <p class="price lh-1">₹4,331 <span class="old-price">₹4,812</span></p>
                            <p class="product-title">Celigin re-furesh gelling mask</p>
                        </div>
                    </div>
                </div>

                <!-- Slide 5 -->
                <div class="swiper-slide position-relative">
                    <div class="card product-card">
                        <img src="assets/images/Container 3.png" alt="product">
                        <div class="tags position-absolute">
                            <span>Sale</span>
                        </div>
                        <div class="card-body text-center">
                            <p class="price lh-1">₹2,599 <span class="old-price">₹2,887.50</span></p>
                            <p class="product-title">Celigin radiant foam cleanser</p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Navigation arrows -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>
<!-- <section>
    <div class="bodys-product-title">

    </div>
</section> -->
<!-- <Section>
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
</Section> -->

<section>
    <div class="trending-title py-4">
        <!-- <div class="text-center hint-across">
            <span class="text-uppercase">Top Picks</span>
            <h3 class="fw-bold">New & Trending Products</h3>
        </div> -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row mt-4">
                        <div class="col-lg-8">
                            <!-- <div class="row"> -->
                            <!-- <div class="col-lg-4">
                                    <a href="{{url('item/celigin-all-day-perfect-sunscreen-50ml-with-coscor-1000ppm-jgu3897e53')}}"><img src="assets/images/Group-3.png" height="100%" class="bd-x"></a>
                                </div> -->
                            <!-- <div class="col-lg-8 mtd">
                                    <a href="{{url('how-to-use/night')}}"><img src="assets/images/Link.png" class="bd-x">
                                </div> -->
                            <!-- <div class="col-lg-8 mt-4">
                                    <a href="{{url('item/celigin-all-day-perfect-sunscreen-50ml-with-coscor-1000ppm-jgu3897e53')}}"><img src="assets/images/Frame 1.png" class="bd-x"></a>
                                </div> -->
                            <div class="d-flex gap-5 align-items-baseline">
                                <a href="{{url('item/celigin-signature-cell-biome-duo-cell-up-first-essence-50ml-with-coscor-10000ppm-vital-serum-50ml-with-coscor-30000ppm-lgt2449gis')}}">
                                    <img src="assets/images/Group-9.png" height="350" class="bd-x"></a>
                                <a href="{{url('item/celigin-daily-sun-finish-50ml-with-coscor-1000ppm-pon3478klj')}}">
                                    <img src="assets/images/ffff.png" height="550" class="bd-x"></a>

                            </div>
                        </div>
                        <div class="col-lg-4 mtd">
                            <div class="offer-card py-4">
                                <div class="offer-badge">
                                    SPECIAL OFFER <span>-25%</span>
                                </div>

                                <div class="offer-title">
                                    Celigin daily sun finish (50ml) with coscor 1,000ppm
                                </div>

                                <div class="offer-desc">
                                    Experience superior sun protection with SPF 50+ and PA++ in our SUNFINISH sunscreen.
                                </div>

                                <div class="countdown" id="countdown">10 D : 20 H : 30 M : 45 S</div>

                                <a href="#" class="offer-btn">Get Only $39.00</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===================================================hot-deals============================================ -->
<section>
    <div class="container my-5">

        <!-- Section Title -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">Hot Deals</h3>
            <a href="#" class="text-dark text-decoration-none">
                Shop all products <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>

        <!-- Swiper Slider -->
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">

                <!-- Slide 1 -->
                <div class="swiper-slide position-relative">
                    <div class="card product-card">
                        <img src="assets/images/Container 1.png" alt="product">

                        <div class="card-body text-center">
                            <p class="price lh-1">₹6,693 <span class="old-price">₹7,437.50</span></p>
                            <p class="product-title">Celigin royal intensive cream</p>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="swiper-slide position-relative">
                    <div class="card product-card">
                        <img src="assets/images/Container 2.png" alt="product">
                        <div class="tag position-absolute">
                            <span>New</span>
                        </div>
                        <div class="card-body text-center">
                            <p class="price lh-1">₹12,771 <span class="old-price">₹14,491</span></p>
                            <p class="product-title">Celigin cells queen</p>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="swiper-slide position-relative">
                    <div class="card product-card">
                        <img src="assets/images/Container 3.png" alt="product">
                        <div class="tags position-absolute">
                            <span>Sale</span>
                        </div>
                        <div class="card-body text-center">
                            <p class="price lh-1">₹2,992 <span class="old-price">₹3,325</span></p>
                            <p class="product-title">Celigin daily sun finish</p>
                        </div>
                    </div>
                </div>

                <!-- Slide 4 -->
                <div class="swiper-slide">
                    <div class="card product-card">
                        <img src="assets/images/Container 2.png" alt="product">
                        <div class="card-body text-center">
                            <p class="price lh-1">₹4,331 <span class="old-price">₹4,812</span></p>
                            <p class="product-title">Celigin re-furesh gelling mask</p>
                        </div>
                    </div>
                </div>

                <!-- Slide 5 -->
                <div class="swiper-slide position-relative">
                    <div class="card product-card">
                        <img src="assets/images/Container 3.png" alt="product">
                        <div class="tags position-absolute">
                            <span>Sale</span>
                        </div>
                        <div class="card-body text-center">
                            <p class="price lh-1">₹2,599 <span class="old-price">₹2,887.50</span></p>
                            <p class="product-title">Celigin radiant foam cleanser</p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Navigation arrows -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>

<!-- -------------------------------------------------------instagram-reels Start-------------------------------------------- -->

<section>
    <div class="container mt-5">

        <!-- Section Title -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold"><img src="assets/images/instagram 1.png" class="mx-3 instagram-resd"> Instagram Feed</h3>
            <a href="#" class="text-dark text-decoration-none">
                View all Feeds <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>

        <!-- Swiper Slider -->
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">

                <!-- Slide 1 -->
                <div class="swiper-slide position-relative">
                    <div class="card product-card">
                        <img src="assets/images/Frame 20.png" alt="Reels" class="reels-tranding">
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="swiper-slide position-relative">
                    <div class="card product-card">
                      <img src="assets/images/Frame 21.png" alt="Reels" class="reels-tranding">
                       
                      
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="swiper-slide position-relative">
                    <div class="card product-card">
                       <img src="assets/images/Frame 22.png" alt="Reels" class="reels-tranding">
                       
                    </div>
                </div>

                <!-- Slide 4 -->
                <div class="swiper-slide">
                    <div class="card product-card">
                       <img src="assets/images/Frame 23.png" alt="Reels" class="reels-tranding">
                    </div>
                </div>

                <!-- Slide 5 -->
                <div class="swiper-slide position-relative">
                    <div class="card product-card">
                    <img src="assets/images/Frame 24.png" alt="Reels" class="reels-tranding">
                     
                </div>

            </div>

            <!-- Navigation arrows -->
            <!-- <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div> -->
        </div>
    </div>
</section>



<!-- -------------------------------------------------------instagram-reels End-------------------------------------------- -->







</div>
</div>
</div>
</main>
</section>




<!-- ==================================================updated blog-================================================ -->
<section>
    <div class="blogs-title-update mt-5">
        <!-- <div class="text-center hint-across">
            <span class="text-uppercase">Instant</span>
            <h3 class="fw-bold">News & Updated Blogs</h3>
        </div> -->
        <div class="container extra-index-glow">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="fw-bold mb-0">Blogs</h4>
                    <a href="#" class="text-decoration-none fw-medium text-dark d-flex align-items-center">
                        View all post
                        <span class="ms-1">→</span>
                    </a>
                </div>
           
            <div class="row">
                @foreach($blogs as $blog)
                <div class="col-lg-4">
                    <div class="making-cbd">
                        <a href="{{ route('front.blogshow',$blog->slug) }}"><img src="{{ $blog->photo ? asset('assets/images/blogs/'.$blog->photo):asset('assets/images/noimage.png')}}" alt="Image not found!"></a>
                    </div>

                    <!-- assets/images/blogs -->
                    <!-- <hr> -->
                    <div class="cbd-confo mt-2">
                        <h2>{{ Str::limit($blog->title, 25) }}</h2>
                        <!-- <p>{!! Str::limit(strip_tags($blog->details), 48) !!}...</p> -->
                        <a href="{{ route('front.blogshow',$blog->slug) }}">Read more <i class="fas fa-arrow-right ms-1"></i></a>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>


<!-- ==================================================instagram-section-================================================ -->
<!-- <section>
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
</section> -->


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
<!-- Font Awesome for icons -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<!-- Bootstrap & Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 4, // default (for very large screens)
        spaceBetween: 20,
        loop: true,
        // autoplay: {
        //   delay: 2500,
        //   disableOnInteraction: false,
        // },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            320: {
                slidesPerView: 1
            },
            576: {
                slidesPerView: 2
            },
            768: {
                slidesPerView: 3
            },
            992: {
                slidesPerView: 4
            },
            //   1200: { slidesPerView: 5 } // 👈 show 5 cards on desktops
        }
    });
</script>

<!-- ✅ Load jQuery first -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets/front/js/extraindex.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
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
<script>
    // Countdown Timer (Set Offer End Date)
    const countdownEl = document.getElementById('countdown');
    const offerEnd = new Date().getTime() + (10 * 24 * 60 * 60 * 1000); // 10 days from now

    setInterval(() => {
        let now = new Date().getTime();
        let distance = offerEnd - now;

        if (distance < 0) {
            countdownEl.innerHTML = "OFFER ENDED";
            return;
        }

        let days = Math.floor(distance / (1000 * 60 * 60 * 24));
        let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((distance % (1000 * 60)) / 1000);

        countdownEl.innerHTML = `${days} D : ${hours} H : ${minutes} M : ${seconds} S`;
    }, 1000);
</script>
<script>
  const swiper = new Swiper('.insta-swiper', {
    slidesPerView: 2.5,
    spaceBetween: 15,
    breakpoints: {
      640: {
        slidesPerView: 3.5,
      },
      768: {
        slidesPerView: 4.5,
      },
      1024: {
        slidesPerView: 5.5,
      }
    }
  });
</script>
