@extends('frontend.include.app')

@section('content')
<!-- Main Content -->
<main id="main-content" role="main" class="bg-white dark:bg-gray-900">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <!-- Breadcrumb Navigation -->
    @include('frontend.include.breadcrumb', ['items' => [
      ['label' => 'Home', 'url' => route('front.index')],
      ['label' => 'Blog', 'url' => route('front.blog')],
      ['label' => Str::limit($blog->title, 30)]
    ]])

    <!-- Blog Article -->
    <article class="max-w-4xl mx-auto" itemscope itemtype="https://schema.org/BlogPosting">
      <!-- Blog Header -->
      <header class="mb-8 lg:mb-12">
        <!-- Category Tag -->
        <div class="mb-4">
          <span class="inline-block px-3 py-1 bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 text-sm font-semibold">Skin Care</span>
        </div>

        <!-- Article Title -->
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-gray-100 leading-tight mb-6" itemprop="headline">
          {{ $blog->title }}
        </h1>

        <!-- Article Meta Information -->
        <div class="flex flex-wrap items-center gap-3 text-sm text-gray-600 dark:text-gray-400 mb-8">
          <time datetime="{{ $blog->date }}" itemprop="datePublished">
            {{ date('M d, Y',(strtotime($blog->date))) }}
          </time>
          <span>|</span>
          <span>{{ $blog->views }} {{ __('View(s)') }}</span>
          <span>|</span>
          <span>Source: <span itemprop="author" class="font-medium">{{ $blog->source }}</span></span>
        </div>

        <!-- Hero Image -->
        <div class="aspect-video overflow-hidden bg-gray-100 dark:bg-gray-700 mb-8">
          <img
            src="{{ url('assets/images/blogs/'.$blog->photo) }}"
            alt="{{ $blog->title }}"
            itemprop="image"
            class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-500" />
        </div>
      </header>

      <!-- Article Content -->
      <div class="prose prose-lg dark:prose-invert max-w-none mb-12" itemprop="articleBody">
        {!! clean($blog->details, [
            'HTML.Allowed' => 'p,br,strong,em,ul,ol,li,h2,h3,h4,h5,h6,blockquote,a[href],img[src|alt],code,pre',
            'AutoFormat.RemoveEmpty' => true,
            'AutoFormat.AutoParagraph' => true,
            'Attr.AllowedFrameTargets' => ['_blank'],
            'HTML.Nofollow' => true
        ]) !!}
      </div>

      <!-- Article Footer -->
      <footer class="border-t border-gray-200 dark:border-gray-700 pt-8 space-y-8">
        <!-- Tags -->
        <div>
          <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Tags:</h3>
          <div class="flex flex-wrap gap-2">
            @foreach($tags as $tag)
              @if(!empty($tag))
                <a href="{{ route('front.blogtags',$tag) }}"
                  class="px-3 py-1 bg-gray-100 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 text-sm font-medium hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors duration-200">
                  {{ $tag }}
                </a>
              @endif
            @endforeach
          </div>
        </div>

        <!-- Share Buttons -->
        <div>
          <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Share this article:</h3>
          <div class="flex gap-3">
            <a href="#" class="flex items-center justify-center w-10 h-10 bg-primary-600 text-white hover:bg-primary-700 transition-colors duration-200" aria-label="Share on Facebook">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
              </svg>
            </a>
            <a href="#" class="flex items-center justify-center w-10 h-10 bg-primary-600 text-white hover:bg-primary-600 transition-colors duration-200" aria-label="Share on Twitter">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
              </svg>
            </a>
            <a href="#" class="flex items-center justify-center w-10 h-10 bg-red-600 text-white hover:bg-red-700 transition-colors duration-200" aria-label="Share on Pinterest">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="3"></circle>
                <path d="M12 1v6m0 6v6m11-7h-6m-6 0H1"></path>
              </svg>
            </a>
          </div>
        </div>
      </footer>
    </article>

    <!-- Related Articles -->
    <section class="mt-16 lg:mt-24" aria-labelledby="related-articles-title">
      <h2 id="related-articles-title" class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 mb-8">Related Articles</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach (App\Models\Blog::latest()->limit(4)->get() as $reblog)
        <article class="bg-white dark:bg-gray-800 shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden group">
          <a href="{{ route('front.blogshow',$reblog->slug) }}" class="block">
            <div class="aspect-video overflow-hidden bg-gray-100 dark:bg-gray-700">
              <img
                src="{{ asset('assets/images/blogs/'.$reblog->photo) }}"
                alt="{{ $reblog->title }}"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
            </div>
            <div class="p-4">
              <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100 mb-2 line-clamp-2 leading-tight">
                {{ mb_strlen($reblog->title,'UTF-8') > 45 ? mb_substr($reblog->title,0,45,'UTF-8')."..":$reblog->title }}
              </h3>
              <p class="text-sm text-gray-600 dark:text-gray-400 mb-3 line-clamp-2">
                {{ Str::limit(strip_tags($reblog->details), 100) }}
              </p>
              <time class="text-xs text-gray-500 dark:text-gray-500">{{ date('M d, Y',(strtotime($reblog->date))) }}</time>
            </div>
          </a>
        </article>
        @endforeach
      </div>
    </section>

  </div>
</main>

@endsection
