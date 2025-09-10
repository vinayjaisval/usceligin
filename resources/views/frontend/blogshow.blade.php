@extends('frontend.include.app')

@section('content')
    <!-- Main Content -->
    <main id="main-content" role="main">
      <div class="container">
        <!-- Breadcrumb Navigation -->
        <nav class="breadcrumb" aria-label="Breadcrumb">
          <ol class="breadcrumb-list">
            <li class="breadcrumb-item">
              <a href="{{ route('front.index') }}">Home</a>
            </li>
            <li class="breadcrumb-item">
              <a href="/blog">Blog</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">5 Essential Skincare Tips for Healthy Skin</li>
          </ol>
        </nav>

        <!-- Blog Article -->
        <article class="blog-article" itemscope itemtype="https://schema.org/BlogPosting">
          <!-- Blog Header -->
          <header class="blog-header">
            <div class="blog-header-content">
              <div class="blog-header-text">
                <!-- Category Tag -->

                <div class="blog-category">
                  <span class="category-tag">  Skin Care</span>
                </div>
           

                <!-- Article Title -->
                <h1 class="blog-title" itemprop="headline">
                {{ $blog->title }}
                </h1>

                <!-- Article Meta Information -->
                <div class="blog-meta">
                  <time class="blog-date" datetime="2025-01-15" itemprop="datePublished">
                  {{ date('M d -
                    Y',(strtotime($blog->date))) }}
                  </time>
                  <span class="blog-separator">|</span>
                  <span class="blog-views">{{ $blog->views }} {{ __('View(s)') }}</span>
                  <span class="blog-separator">|</span>
                  <span class="blog-source">Source: <span itemprop="author">{{ $blog->source }}</span></span>
                </div>
              </div>

              <!-- Hero Image -->
              <div class="blog-hero-image">
                <img
                  src="{{ asset('assets/images/blogs/'.$blog->photo) }}"
                  alt="Essential skincare products and routine demonstration"
                  width="600"
                  height="400"
                  itemprop="image"
                />
              </div>
            </div>
          </header>

          <!-- Article Content -->
          <div class="blog-content" itemprop="articleBody">
            <!-- Introduction -->
            <div class="blog-intro">
              <p class="lead">
               {!! clean($blog->details , array('Attr.EnableID' => true)) !!}
              </p>
            </div>

            <!-- Article Body -->
            <!-- <div class="blog-body">
              <p>
                In today's fast-paced world, maintaining a proper skincare routine has become more important than ever. Environmental factors, stress, and lifestyle choices all impact our skin's health and appearance. That's why establishing a solid foundation with proven skincare practices is essential for everyone, regardless of age or skin type.
              </p>

              <h2>1. Cleanse Properly Morning and Night</h2>
              <p>
                The foundation of any good skincare routine starts with proper cleansing. Use a gentle, pH-balanced cleanser twice daily to remove dirt, oil, and impurities without stripping your skin's natural moisture barrier. Our <strong>Gentle Foaming Cleanser</strong> is formulated specifically for daily use and suitable for all skin types.
              </p>

              <h2>2. Never Skip Moisturizer</h2>
              <p>
                Moisturizing is crucial for maintaining skin hydration and protecting the skin barrier. Even if you have oily skin, skipping moisturizer can actually cause your skin to produce more oil. Choose a moisturizer appropriate for your skin type - lightweight for oily skin, and richer formulations for dry skin.
              </p>

              <h2>3. Use Sunscreen Daily</h2>
              <p>
                Sun protection is the most important anti-aging step you can take. UV rays cause premature aging, dark spots, and increase skin cancer risk. Apply a broad-spectrum SPF 30 or higher every morning, even on cloudy days. Our <strong>Daily SPF Moisturizer</strong> combines hydration with superior sun protection.
              </p>

              <h2>4. Incorporate Vitamin C Serum</h2>
              <p>
                Vitamin C is a powerful antioxidant that helps brighten skin, reduce dark spots, and protect against environmental damage. Apply a vitamin C serum in the morning before your moisturizer and sunscreen. Our <strong>Advanced Vitamin C Serum</strong> contains stabilized vitamin C for maximum efficacy.
              </p>

              <h2>5. Be Consistent and Patient</h2>
              <p>
                Skincare results take time. Most products require 4-6 weeks of consistent use before you'll see noticeable improvements. Don't switch products too frequently, and always introduce new products gradually to avoid irritation.
              </p>

              <blockquote class="blog-quote">
                <p>
                  "Consistency is key in skincare. It's better to have a simple routine you follow daily than a complex one you use sporadically."
                </p>
                <cite>- Dr. Sarah Chen, CELIGIN Chief Dermatologist</cite>
              </blockquote>

              <h2>Building Your Routine</h2>
              <p>
                Start with the basics: cleanser, moisturizer, and sunscreen. Once your skin adjusts, you can gradually add targeted treatments like serums or exfoliants. Remember, everyone's skin is different, so what works for others might not work for you.
              </p>

              <p>
                For personalized skincare recommendations based on your specific skin type and concerns, consult with our skincare experts or visit our comprehensive product collection designed for every skin need.
              </p>
            </div> -->
          </div>

          <!-- Article Footer -->
          <footer class="blog-footer">
            <div class="blog-tags">
              <h3>Tags:</h3>
              <ul class="tag-list">
              @foreach($tags as $tag)
              @if(!empty($tag))
                <li><a href="{{ route('front.blogtags',$tag) }}" class="category-tag"> {{ $tag }}</a></li>
                @endif
                @endforeach
              
              </ul>
            </div>

            <!-- Share Buttons -->
            <div class="blog-share">
              <h3>Share this article:</h3>
              <div class="share-buttons">
                <a href="#" class="share-btn facebook" aria-label="Share on Facebook">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                  </svg>
                </a>
                <a href="#" class="share-btn twitter" aria-label="Share on Twitter">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                  </svg>
                </a>
                <a href="#" class="share-btn pinterest" aria-label="Share on Pinterest">
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
        <section class="related-articles" aria-labelledby="related-articles-title">
          <h2 id="related-articles-title">Related Articles</h2>
          <div class="related-articles-grid">

          @foreach (App\Models\Blog::latest()->limit(4)->get() as $reblog)
            <article class="related-article">
              <a href="{{ route('front.blogshow',$reblog->slug) }}" class="related-article-link">
                <div class="related-article-image">
                  <img
                    src="{{ asset('assets/images/blogs/'.$reblog->photo) }}"
                    alt="Understanding Vitamin C in Skincare"
                    width="300"
                    height="200"
                  />
                </div>
                <div class="related-article-content">
                  <h3>{{ mb_strlen($reblog->title,'UTF-8') > 45
                    ? mb_substr($reblog->title,0,45,'UTF-8')."..":$reblog->title }}</h3>
                  <p class="related-article-excerpt">
                  {{ Str::limit(strip_tags($reblog->details), 100) }}

                  </p>
                  <time class="related-article-date">{{ date('M d - Y',(strtotime($reblog->date))) }}</time>
                </div>
              </a>
            </article>
            @endforeach
           
          </div>
        </section>
      </div>
    </main>
   

    @endsection