@extends('layouts.front')
@section('content')
@include('partials.global.common-header')
<!-- breadcrumb -->
<div class="full-row bg-light overlay-dark py-5"
   style="background-image: url({{ $gs->breadcrumb_banner ? asset('assets/images/'.$gs->breadcrumb_banner):asset('assets/images/noimage.png') }}); background-position: center center; background-size: cover;">
   <div class="container">
      <div class="row text-center text-white">
         <div class="col-12">
           
         </div>
         <div class="col-12">
            <nav aria-label="breadcrumb">
               <ol class="breadcrumb mb-0 d-inline-flex bg-transparent p-0">
                  <li class="breadcrumb-item"><a href="{{ route('front.index') }}">{{ __('Home') }}</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{ __('Testimonial') }}</li>
               </ol>
            </nav>
         </div>
      </div>
   </div>
</div>
<!-- breadcrumb -->

<!--==================== Blog Section Start ====================-->
<div class="full-row">
   <div class="container">
      <div class="row">
         <div class="col-lg-4 md-mb-50 order-lg-2">
            <div id="sidebar" class="sidebar-blog bg-light p-30">
             
              
               <div class="widget border-0 py-0 widget_recent_entries">
                  <h4 class="widget-title down-line">{{ __('Recent Testimonial') }}</h4>
                  <ul>
                     @foreach (App\Models\Testimonial::latest()->limit(4)->get() as $reblog)
                     <li>
                        <a href="{{ route('front.testimonialshow',$reblog->slug) }}">{{ mb_strlen($reblog->title,'UTF-8') > 45
                           ? mb_substr($reblog->title,0,45,'UTF-8')."..":$reblog->title }}</a>
                        <span class="post-date">{{ date('M d - Y',(strtotime($reblog->created_at))) }}</span>
                     </li>
                     @endforeach
                  </ul>
               </div>
             
            </div>
         </div>
         <div class="col-lg-8 order-lg-1">
            <div class="single-post">
               <div class="single-post-title">
                  <h3 class="mb-2 text-secondary">{{ $blog->title }}</h3>
                
               </div>
               <div class="img">
                  <img src="{{ asset('assets/images/blogs/'.$blog->photo) }}" class="img-fluid" alt="">
               </div>
               <div class="post-content pt-4 mb-5">
                  <p>{!! clean($blog->details , array('Attr.EnableID' => true)) !!}</p>
               </div>
               
               <script async src="https://static.addtoany.com/menu/page.js"></script>
               {{-- DISQUS START --}}
               @if($gs->is_disqus == 1)
               <div class="comments">
                  <div id="disqus_thread">
                     <script>
                        (function() {
                        var d = document, s = d.createElement('script');
                        s.src = 'https://{{ $gs->disqus }}.disqus.com/embed.js';
                        s.setAttribute('data-timestamp', +new Date());
                        (d.head || d.body).appendChild(s);
                        })();
                     </script>
                     <noscript>{{ __('Please enable JavaScript to view the') }} <a
                           href="https://disqus.com/?ref_noscript">{{ __('comments powered by Disqus.')
                           }}</a></noscript>
                  </div>
               </div>
               @endif
               {{-- DISQUS ENDS --}}
            </div>
         </div>
      </div>
   </div>
</div>
<!--==================== Blog Section End ====================-->
@includeIf('partials.global.common-footer')
@endsection