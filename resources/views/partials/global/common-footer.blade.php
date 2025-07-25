@php
$categories = App\Models\Category::with('subs')->where('status',1)->get();
$pages = App\Models\Page::get();
@endphp
@if($ps->newsletter==1)
    <!--==================== Newsleter Section Start ====================-->
    <div class="full-row bg-dark py-30 mt-5">
        <div class="container">
            <div class="row mx-auto">
                <div class="col-lg-7 col-md-6 ">
                    <div class="d-flex align-items-center h-100">
                        <h4 class="text-white mb-0 text-uppercase">{{ __('Sign up to newsletter') }}  </h4>
                    </div>
                </div>

                <div class="col-lg-5 col-md-12">
                    <form action="{{route('front.subscribe')}}" class="subscribe-form subscribeform  position-relative md-mt-20" method="POST">
                        @csrf
                        <input class="form-control rounded-pill mb-0" type="text" placeholder="Enter your email" aria-label="Address" name="email">
                        <button type="submit" class="btn btn-secondary rounded-right-pill text-white">{{ __('Send') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--==================== Newsleter Section End ====================-->
@endif
<!--==================== Newslatter Section End ====================-->

<!--==================== Footer Section Start ====================-->
<footer class="full-row bg-white border-footer p-0">
    <div class="container">
        <div class="row row-cols-xl-12 row-cols-md-2 row-cols-1">
            
            
            <div class="col-md-4">
                <div class="footer-widget ">
                    <!-- <div class="footer-logo mb-2">
                        <a href="{{ route('front.index') }}"><img src="{{ asset('assets/images/'.$gs->footer_logo) }}" alt="Image not found!" /></a>
                    </div> -->
                    <div class="widget-ecommerce-contact">
                        @if($ps->phone != null)
                        <span class="h6 text-secondary mt-1">{{ __('Contact & Support : ') }}{{ $ps->phone }}</span>
                        <!-- <div class="text-general "></div> -->
                        @endif
                        
                       
                        @if($ps->email != null)
                        <span class="h6 text-secondary mt-2">{{ __('Email : ') }}{{ $ps->email }}</span>
                        <!-- <div class="text-general">{{ $ps->email }}</div> -->
                        @endif
                         @if($ps->street != null)
                        <span class="h6 text-secondary mt-2">{{ __('Address : ') }}{{ $ps->street }}</span>
                        <!-- <div class="text-general"></div> -->
                        @endif
                    </div>
                </div>

                <div class="footer-widget media-widget mt-5 d-flex gap-2">

                    @foreach(DB::table('social_links')->where('user_id',0)->where('status',1)->get() as $link)
                        <a href="{{ $link->link }}" target="_blank">
                            <i class="{{ $link->icon }}"></i>
                        </a>
                    @endforeach
                </div>
            </div>
           
            <div class="col-md-2">
                <div class="footer-widget category-widget my-5">
                    <h6 class="widget-title ">{{ __('Information') }}</h6>
                    <ul>
                        @if($ps->home == 1)
                        <li>
                            <a href="{{ route('front.index') }}">{{ __('Home') }}</a>
                        </li>
                        @endif
                        @if($ps->blog == 1)
                            <!-- <li>
                                <a href="{{ route('front.blog') }}">{{ __('Blog') }}</a>
                            </li> -->
                        @endif
                        
                        
                         @if ($ps->testimonial == 1)
                            <!-- <li ">
                                <a  href="{{ route('front.testimonial') }}">{{ __('Testimonial')
                                    }}</a>
                            </li> -->
                        @endif
                                
                        
                        <!--    @if($ps->blog == 1)-->
                        <!--    <li>-->
                        <!--        <a href="{{ route('front.collaboration') }}">{{ __('Collaboration') }}</a>-->
                        <!--    </li>-->
                        <!--@endif-->
                        @if($ps->faq == 1)
                            <!-- <li>
                                <a href="{{ route('front.faq') }}">{{ __('FAQ') }}</a>
                            </li> -->
                            @endif
                            @foreach(DB::table('pages')->where('footer','=',1)->get() as $data)
                            <li><a href="{{ route('front.vendor',$data->slug) }}">{{ $data->title }}</a></li>
                        @endforeach
                        @if($ps->contact == 1)
                        <!-- <li>
                            <a href="{{ route('front.contact') }}">{{ __('Contact Us') }}</a>
                        </li> -->
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-md-2">
                <div class="footer-widget category-widget my-5">
                    <h6 class="widget-title ">{{ __('Blog') }}</h6>
                    <ul>
                        @if($ps->home == 1)
                        <!-- <li>
                            <a href="{{ route('front.index') }}">{{ __('Home') }}</a>
                        </li> -->
                        @endif
                        @if($ps->blog == 1)
                            <li>
                                <a href="{{ route('front.blog') }}">{{ __('Blog') }}</a>
                            </li>
                        @endif
                        
                        
                         @if ($ps->testimonial == 1)
                            <li ">
                                <a  href="{{ route('front.testimonial') }}">{{ __('Testimonial')
                                    }}</a>
                            </li>
                        @endif
                                
                        @if($ps->faq == 1)
                            <li>
                                <a href="{{ route('front.faq') }}">{{ __('FAQ') }}</a>
                            </li>
                            @endif
                            @foreach(DB::table('pages')->where('footer','=',1)->get() as $data)
                            <!-- <li><a href="{{ route('front.vendor',$data->slug) }}">{{ $data->title }}</a></li> -->
                        @endforeach
                        @if($ps->contact == 1)
                        <li>
                            <a href="{{ route('front.contact') }}">{{ __('Contact Us') }}</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="footer-widget widget-nav my-5">
                    <h6 class="widget-title mb-sm-4">{{ __('Recent Post') }}</h6>
                    <ul>
                        @foreach ($footer_blogs as $footer_blog)
                        <li>
                            <div class="post mb-3">
                                <div class="post-img">
                                    <img src="{{ asset('assets/images/blogs/'.$footer_blog->photo) }}" alt="">
                                  </div>
                                  <div class="post-details">
                                    <a href="{{ route('front.blogshow',$footer_blog->slug) }}">
                                        <h4 class="post-title">
                                            {{mb_strlen($footer_blog->title,'UTF-8') > 45 ? mb_substr($footer_blog->title,0,45,'UTF-8')." .." : $footer_blog->title}}
                                        </h4>
                                    </a>
                                    <p class="date">
                                        {{ date('M d - Y',(strtotime($footer_blog->date))) }}
                                    </p>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--==================== Footer Section End ====================-->

<!--==================== Copyright Section Start ====================-->
<div class="container">
    <div class="mx-auto text-center py-3">
        <span class=" limit sm-mb-10 d-block fw-bold text-black">{{ $gs->copyright }}</span>
    </div>
</div>

@if(isset($visited))

@if($gs->is_cookie == 1)
    <div class="cookie-bar-wrap show">
        <div class="container d-flex justify-content-center">
            <div class="col-xl-10 col-lg-12">
                <div class="row justify-content-center">
                    <div class="cookie-bar">
                        <div class="cookie-bar-text">
                            {{ __('The website uses cookies to ensure you get the best experience on our website.') }}
                        </div>
                        <div class="cookie-bar-action">
                            <button class="btn btn-primary btn-accept">
                             {{ __('GOT IT!') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@endif


<!--==================== Copyright Section End ====================-->

<!-- Scroll to top -->
<a href="#" class="scroller text-white" id="scroll"><i class="fa fa-angle-up"></i></a>
