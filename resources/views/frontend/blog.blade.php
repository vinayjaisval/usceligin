@extends('frontend.include.app')

@section('content')
<!-- Main Content -->
<main id="main-content" role="main" class="bg-white dark:bg-gray-900">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <!-- Breadcrumb Navigation -->
    @include('frontend.include.breadcrumb', ['items' => [
      ['label' => 'Home', 'url' => route('front.index')],
      ['label' => 'Blog']
    ]])

    <!-- Loading Spinner -->
    @include('frontend.include.loading-spinner', [
      'id' => 'loading-section',
      'message' => 'Loading blog...'
    ])
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
      <div class="space-y-8">
        @foreach ($blogs as $blog)
        <article class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-all duration-300 overflow-hidden group">
          <div class="flex flex-col md:flex-row md:h-52">
            <!-- Blog Image -->
            <div class="md:w-1/3 flex-shrink-0">
              <a href="{{ route('front.blogshow',$blog->slug) }}" class="block">
                <div class="aspect-[16/10] md:aspect-auto md:h-52 bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                  <img
                    src="{{ $blog->photo ? asset('assets/images/blogs/'.$blog->photo):asset('assets/images/noimage.png')}}"
                    alt="{{ $blog->title }}"
                    class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-500"
                    loading="lazy" />
                </div>
              </a>
            </div>

            <!-- Blog Content -->
            <div class="md:w-2/3 p-4 flex flex-col justify-between">
              <div>
                <!-- Tag -->
                <div class="mb-1.5">
                  <span class="inline-block px-2.5 py-0.5 bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 text-[10px] font-semibold uppercase tracking-wide">{{ $blog->tags }}</span>
                </div>

                <!-- Title -->
                <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-1.5 leading-tight group-hover:text-primary-700 dark:group-hover:text-primary-400 transition-colors">
                  <a href="{{ route('front.blogshow',$blog->slug) }}">{{ $blog->title }}</a>
                </h2>

                <!-- Meta Info -->
                <div class="flex items-center space-x-2 text-[10px] text-gray-600 dark:text-gray-400 mb-2">
                  <time datetime="{{ $blog->created_at }}">{{ date('M d, Y',(strtotime($blog->created_at))) }}</time>
                  <span>•</span>
                  <span class="uppercase">BY TERESA GREENFELD</span>
                </div>

                <!-- Description/Excerpt -->
                @if($blog->details)
                <p class="text-sm text-gray-700 dark:text-gray-300 line-clamp-2 leading-relaxed">
                  {!! Str::limit(strip_tags($blog->details), 100) !!}
                </p>
                @endif
              </div>

              <!-- Read More Link -->
              <div class="mt-2">
                <a href="{{ route('front.blogshow',$blog->slug) }}" class="inline-flex items-center text-xs font-semibold text-primary-700 dark:text-primary-400 hover:text-primary-800 dark:hover:text-primary-300 transition-colors group/link">
                  Read More
                  <svg class="w-3.5 h-3.5 ml-1 group-hover/link:translate-x-1 transition-transform duration-200" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12,5 19,12 12,19"></polyline>
                  </svg>
                </a>
              </div>
            </div>
          </div>
        </article>
        @endforeach
      </div>

      <!-- Pagination -->
      @if($blogs->hasPages())
      <nav class="mt-10" aria-label="Blog pagination">
        <div class="flex items-center justify-center gap-2">
          {{-- Previous Button --}}
          @if ($blogs->onFirstPage())
            <span class="px-3 py-3 text-gray-400 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 cursor-not-allowed">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <polyline points="15,18 9,12 15,6"></polyline>
              </svg>
            </span>
          @else
            <a href="{{ $blogs->previousPageUrl() }}" class="px-3 py-3 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <polyline points="15,18 9,12 15,6"></polyline>
              </svg>
            </a>
          @endif

          {{-- Page Numbers --}}
          @foreach ($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
            @if ($page == $blogs->currentPage())
              <span class="px-4 py-2 text-white bg-primary-600 border border-primary-600 font-semibold">{{ $page }}</span>
            @else
              <a href="{{ $url }}" class="px-4 py-2 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-primary-700 dark:hover:text-primary-400 transition-colors">{{ $page }}</a>
            @endif
          @endforeach

          {{-- Next Button --}}
          @if ($blogs->hasMorePages())
            <a href="{{ $blogs->nextPageUrl() }}" class="px-3 py-3 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <polyline points="9,18 15,12 9,6"></polyline>
              </svg>
            </a>
          @else
            <span class="px-3 py-3 text-gray-400 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 cursor-not-allowed">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <polyline points="9,18 15,12 9,6"></polyline>
              </svg>
            </a>
          @endif
        </div>
      </nav>
      @endif
    </div>
  </section>
</main>

<style>
/* Line clamp utility for description */
.line-clamp-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>

@endsection
