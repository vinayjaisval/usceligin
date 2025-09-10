@extends('frontend.include.app')

@section('content')
<!-- Main Content -->
<main id="main-content" class="main">
  <div class="container">
    <!-- Breadcrumb Navigation -->
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <ol class="breadcrumb-list">
        <li class="breadcrumb-item">
          <a href="{{ route('front.index') }}">Home</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          Blog
        </li>
      </ol>
    </nav>

    <!-- Loading Spinner -->
    <div class="loading-section" id="loading-section">
      <div class="loading-spinner"></div>
      <p>Loading blog...</p>
    </div>
  </div>

  <!-- Page Header -->
  <section class="page-header">
    <div class="container">
      <h1>Blog</h1>
      <p>Expert skincare tips, beauty trends, and product insights</p>
    </div>
  </section>

  <!-- Blog Content -->
  <section class="blog-section">
    <div class="container">
      <div class="blog-layout">
        <!-- Left Column - Blog Listings (80%) -->
        <div class="blog-main">
          <div class="blog-list">
            <!-- Blog Post 1 -->

            @foreach ($blogs as $blog)
            <article class="blog-post">
              <div class="blog-post-image">
                <img
                  src="{{ $blog->photo ? asset('assets/images/blogs/'.$blog->photo):asset('assets/images/noimage.png')}}"
                  alt="Vitamin C serum benefits for skin"
                  width="400"
                  height="250" />
              </div>
              <div class="blog-post-content">
                <div class="category-tag"> {{ $blog->tags }}</div>
                <h2>
                  <a href="{{ route('front.blogshow',$blog->slug) }}"> {{ $blog->title }}</a>
                </h2>
                <div class="blog-meta">
                  <time datetime="2024-12-15">{{ date('M-d-Y',(strtotime($blog->created_at))) }}</time>
                  <span class="blog-author">BY TERESA GREENFELD</span>
                </div>
              </div>
            </article>
            @endforeach
          </div>

          <!-- Pagination -->
          <nav class="pagination" aria-label="Blog pagination">
            <a
              href="#"
              class="pagination-btn prev"
              aria-label="Previous page">
              <svg
                width="16"
                height="16"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2">
                <polyline points="15,18 9,12 15,6"></polyline>
              </svg>
              Previous
            </a>
            <div class="pagination-numbers">
            {{ $blogs->links() }}
            </div>
            
            <a href="#" class="pagination-btn next" aria-label="Next page">
              Next
              <svg
                width="16"
                height="16"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2">
                <polyline points="9,18 15,12 9,6"></polyline>
              </svg>
            </a>
          </nav>
        </div>

        <!-- Right Column - Sidebar (20%) -->
        <aside class="blog-sidebar">
          <div class="sidebar-section">
            <!-- Category Banners -->
            <section
              class="scategory-banners"
              aria-label="Shop by category">
              <div class="banner-grid">
              <article class="category-banner">
          <a href="{{$arrivals[0]['url']}}" class="banner-link-full">
            <div class="banner-image">
              <img
                src="{{asset('assets/images/arrival/'.$arrivals[0]['photo'])}}"
                alt="New arrivals collection"
                width="450"
                height="450" />
            </div>
            <div class="banner-content">
              <h3>{{$arrivals[0]['title']}}</h3>
              <p>{{$arrivals[0]['up_sale']}}</p>
              <span class="banner-link">
                Shop Now
                <svg
                  width="16"
                  height="16"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2">
                  <line x1="7" y1="17" x2="17" y2="7"></line>
                  <polyline points="7,7 17,7 17,17"></polyline>
                </svg>
              </span>
            </div>
          </a>
        </article>

        <article class="category-banner">
          <a href="{{$arrivals[1]['url']}}" class="banner-link-full">
            <div class="banner-image">
              <img
                src="{{asset('assets/images/arrival/'.$arrivals[1]['photo'])}}"
                alt="Best selling products"
                width="450"
                height="450" />
            </div>
            <div class="banner-content">
              <h3>{{$arrivals[1]['title']}}</h3>
              <p>{{$arrivals[1]['up_sale']}}</p>
              <span class="banner-link">
                Shop Now
                <svg
                  width="16"
                  height="16"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2">
                  <line x1="7" y1="17" x2="17" y2="7"></line>
                  <polyline points="7,7 17,7 17,17"></polyline>
                </svg>
              </span>
            </div>
          </a>
        </article>

        <article class="category-banner">
          <a href="/first-time-buyer" class="banner-link-full">
            <div class="banner-image">
              <img
                src="{{asset('assets/images/arrival/'.$arrivals[2]['photo'])}}"
                alt="First time buyer offers"
                width="450"
                height="450" />
            </div>
            <div class="banner-content">
              <h3>{{$arrivals[2]['title']}}</h3>
              <p>{{$arrivals[2]['up_sale']}}</p>
              <span class="banner-link">
                Discover Now
                <svg
                  width="16"
                  height="16"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2">
                  <line x1="7" y1="17" x2="17" y2="7"></line>
                  <polyline points="7,7 17,7 17,17"></polyline>
                </svg>
              </span>
            </div>
          </a>
        </article>
              </div>
            </section>

            <!-- Join CELIGIN Banner -->
            <section class="join-celigin-banner">
              <div class="banner-grid">
                <div class="celigin-banner join-club">
                  <img
                    src="{{asset('/assets/frontend/images/join-club-banner.png')}}"
                    alt="Join CELIGIN Club - Become a Brand Ambassador"
                    class="banner-image" />
                  <div class="banner-content">
                    <div class="banner-text">
                      <span class="badge">JOIN CELIGIN CLUB</span>
                      <h3>Become a Brand Ambassador</h3>
                    </div>
                    <a href="/join" class="banner-btn">Join Now</a>
                  </div>
                </div>

                <div class="celigin-banner cta-banner">
                  <img
                    src="{{asset('assets/frontend/images/cell-education-banner.png')}}"
                    alt="Cell For Education - CELIGIN Skincare Products"
                    class="banner-image" />
                  <div class="banner-content">
                    <div class="banner-text">
                      <h3>Cell For Education</h3>
                    </div>
                    <a href="/education" class="banner-btn secondary">Read More</a>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </aside>
      </div>
    </div>
  </section>
</main>

@endsection