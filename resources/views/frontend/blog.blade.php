@extends('frontend.include.app')

@section('content')
<!-- Main Content -->
<main id="main-content" role="main" class="bg-white dark:bg-gray-900">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <!-- Breadcrumb Navigation -->
    <nav aria-label="Breadcrumb" class="mb-6">
      <ol class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400">
        <li>
          <a href="{{ route('front.index') }}" class="hover:text-gray-900 dark:hover:text-gray-100 transition-colors duration-200">Home</a>
        </li>
        <li class="flex items-center">
          <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
          <span class="text-gray-900 dark:text-gray-100" aria-current="page">Blog</span>
        </li>
      </ol>
    </nav>

    <!-- Loading Spinner -->
    <div class="hidden fixed inset-0 bg-white dark:bg-gray-900 bg-opacity-90 dark:bg-opacity-90 z-50 flex items-center justify-center" id="loading-section">
      <div class="text-center">
        <div class="inline-block w-12 h-12 border-4 border-orange-600 border-t-transparent animate-spin"></div>
        <p class="mt-4 text-gray-900 dark:text-gray-100">Loading blog...</p>
      </div>
    </div>
  </div>

  <!-- Page Header -->
  <section class="bg-gray-50 dark:bg-gray-800 py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-gray-100 mb-4">Blog</h1>
      <p class="text-base sm:text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">Expert skincare tips, beauty trends, and product insights</p>
    </div>
  </section>

  <!-- Blog Content -->
  <section class="py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

        <!-- Left Column - Blog Listings (75% - 3 columns) -->
        <div class="lg:col-span-3">
          <div class="space-y-8">
            @foreach ($blogs as $blog)
            <article class="bg-white dark:bg-gray-800 shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden group">
              <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-1">
                  <a href="{{ route('front.blogshow',$blog->slug) }}" class="block aspect-[4/3] overflow-hidden">
                    <img
                      src="{{ $blog->photo ? asset('assets/images/blogs/'.$blog->photo):asset('assets/images/noimage.png')}}"
                      alt="{{ $blog->title }}"
                      class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                  </a>
                </div>
                <div class="md:col-span-2 p-6">
                  <div class="inline-block px-3 py-1 bg-orange-100 dark:bg-orange-900/30 text-orange-600 dark:text-orange-400 text-xs font-semibold mb-3">{{ $blog->tags }}</div>
                  <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-gray-100 mb-3 leading-tight hover:text-orange-600 dark:hover:text-orange-400 transition-colors">
                    <a href="{{ route('front.blogshow',$blog->slug) }}">{{ $blog->title }}</a>
                  </h2>
                  <div class="flex items-center space-x-3 text-xs text-gray-600 dark:text-gray-400 mb-4">
                    <time datetime="{{ $blog->created_at }}">{{ date('M d, Y',(strtotime($blog->created_at))) }}</time>
                    <span>•</span>
                    <span class="uppercase">BY TERESA GREENFELD</span>
                  </div>
                  <a href="{{ route('front.blogshow',$blog->slug) }}" class="inline-flex items-center text-sm font-medium text-orange-600 dark:text-orange-400 hover:text-orange-700 dark:hover:text-orange-300 transition-colors group">
                    Read More
                    <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform duration-200" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <line x1="7" y1="17" x2="17" y2="7"></line>
                      <polyline points="7,7 17,7 17,17"></polyline>
                    </svg>
                  </a>
                </div>
              </div>
            </article>
            @endforeach
          </div>

          <!-- Pagination -->
          <nav class="flex items-center justify-between mt-12 pt-8 border-t border-gray-200 dark:border-gray-700" aria-label="Blog pagination">
            <a href="#" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200" aria-label="Previous page">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="mr-2">
                <polyline points="15,18 9,12 15,6"></polyline>
              </svg>
              Previous
            </a>

            <div class="hidden sm:flex items-center space-x-2">
              {{ $blogs->links() }}
            </div>

            <a href="#" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200" aria-label="Next page">
              Next
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="ml-2">
                <polyline points="9,18 15,12 9,6"></polyline>
              </svg>
            </a>
          </nav>
        </div>

        <!-- Right Column - Sidebar (25% - 1 column) -->
        <aside class="lg:col-span-1">
          <div class="space-y-8 lg:sticky lg:top-24">

            <!-- Category Banners -->
            <section aria-label="Shop by category">
              <div class="space-y-6">
                @foreach($arrivals as $arrival)
                <article class="group overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300">
                  <a href="{{$arrival['url']}}" class="block relative">
                    <div class="aspect-square overflow-hidden bg-gray-100 dark:bg-gray-700">
                      <img
                        src="{{asset('assets/images/arrival/'.$arrival['photo'])}}"
                        alt="{{$arrival['title']}}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent flex flex-col justify-end p-6">
                      <h3 class="text-lg font-bold text-white mb-1">{{$arrival['title']}}</h3>
                      <p class="text-sm text-white/90 mb-3">{{$arrival['up_sale']}}</p>
                      <span class="inline-flex items-center text-sm font-medium text-white group-hover:translate-x-1 transition-transform duration-200">
                        Shop Now
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="ml-1">
                          <line x1="7" y1="17" x2="17" y2="7"></line>
                          <polyline points="7,7 17,7 17,17"></polyline>
                        </svg>
                      </span>
                    </div>
                  </a>
                </article>
                @endforeach
              </div>
            </section>

            <!-- Join CELIGIN Banner -->
            <section class="space-y-6">
              <div class="relative overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300 group">
                <img
                  src="{{asset('/assets/frontend/images/join-club-banner.png')}}"
                  alt="Join CELIGIN Club - Become a Brand Ambassador"
                  class="w-full aspect-[4/3] object-cover" />
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent flex flex-col justify-end p-6">
                  <span class="inline-block px-3 py-1 bg-pink-600 text-white text-xs font-bold uppercase mb-2 w-fit">JOIN CELIGIN CLUB</span>
                  <h3 class="text-lg font-bold text-white mb-4">Become a Brand Ambassador</h3>
                  <a href="/join" class="inline-block px-4 py-2 bg-orange-600 text-white text-sm font-semibold hover:bg-orange-700 transition-colors w-fit">Join Now</a>
                </div>
              </div>

              <div class="relative overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300 group">
                <img
                  src="{{asset('assets/frontend/images/cell-education-banner.png')}}"
                  alt="Cell For Education - CELIGIN Skincare Products"
                  class="w-full aspect-[4/3] object-cover" />
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent flex flex-col justify-end p-6">
                  <h3 class="text-lg font-bold text-white mb-4">Cell For Education</h3>
                  <a href="/education" class="inline-block px-4 py-2 bg-white text-gray-900 text-sm font-semibold hover:bg-gray-100 transition-colors w-fit">Read More</a>
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
