@extends('layouts.web.master')

@section('meta_title', $metaTitle)
@section('meta_description', $metaDescription)
@section('meta_keywords', $post->meta_keywords ?? 'Salman Waria blog')
@section('canonical_url', $post->canonical_url ?: route('blog.show', $post->slug))

@section('content')

      <section class="page-hero page-hero--compact" aria-labelledby="post-heading">
        <div class="page-hero-bg" aria-hidden="true"></div>
        <div class="page-hero-inner reveal-up">
          <p class="section-eyebrow section-eyebrow--center">
            @if ($post->category)
              {{ $post->category->name }}
            @else
              Blog
            @endif
          </p>
          <h1 class="section-title page-hero-title text-center" id="post-heading">{{ $post->title }}</h1>
          <p class="section-sub section-sub--center page-hero-sub text-center blog-post-byline">
            @if ($post->published_at)
              <time datetime="{{ $post->published_at->toIso8601String() }}">{{ $post->published_at->format('F j, Y') }}</time>
            @endif
            @if ($post->author)
              <span class="blog-post-byline-sep" aria-hidden="true">·</span>
              <span>{{ $post->author->name }}</span>
            @endif
          </p>

          @if ($post->featured_image)
            <div class="blog-detail-hero-image reveal-up">
              <img
                src="{{ storage_public_url($post->featured_image) }}"
                alt="{{ $post->title }}"
                loading="eager"
                decoding="async" />
            </div>
          @endif
        </div>
      </section>

      <section class="page-section bg-surface-1 blog-detail-section" aria-label="Article content">
        <div class="container">
          <div class="blog-detail-layout">
            <article class="blog-detail-article reveal-up">
              <div class="blog-prose">
                {!! normalize_storage_urls($post->content) !!}
              </div>

              <footer class="blog-detail-footer">
                <a href="{{ route('blog.index') }}" class="btn-secondary">← Back to Blog</a>
              </footer>
            </article>
          </div>

          @if ($post->hasFaqs())
            <section class="page-section bg-surface-2 faq-section blog-faq-section" id="blog-faq" aria-labelledby="blog-faq-heading">
              <div class="faq-bg" aria-hidden="true"></div>
              <div class="container">
                <div class="faq-header reveal-up">
                  <div class="section-eyebrow section-eyebrow--center">Common questions</div>
                  <h2 class="section-title text-center" id="blog-faq-heading"><span class="gold-text">FAQs</span></h2>
                </div>

                <div class="faq-list">
                  @foreach ($post->faqs as $index => $faq)
                    @php
                      $faqNum = $index + 1;
                      $btnId = 'blog-faq-btn-'.$faqNum;
                      $panelId = 'blog-faq-panel-'.$faqNum;
                    @endphp
                    <div class="faq-item reveal-up">
                      <button type="button" class="faq-trigger" id="{{ $btnId }}" aria-expanded="false" aria-controls="{{ $panelId }}">
                        <span class="faq-question">{{ $faq['question'] }}</span>
                        <span class="faq-icon" aria-hidden="true"></span>
                      </button>
                      <div class="faq-panel" id="{{ $panelId }}" role="region" aria-labelledby="{{ $btnId }}" hidden>
                        <p class="faq-answer">{{ $faq['answer'] }}</p>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            </section>
          @endif

          @if ($related->isNotEmpty())
            <div class="blog-related reveal-up">
              <div class="page-block-header text-center">
                <h2 class="section-title">Related <span class="gold-text">Articles</span></h2>
              </div>
              <div class="blog-grid blog-grid--3">
                @foreach ($related as $item)
                  <article class="blog-card blog-card--compact">
                    @if ($item->featured_image)
                      <a href="{{ route('blog.show', $item->slug) }}" class="blog-card-media" tabindex="-1" aria-hidden="true">
                        <img src="{{ storage_public_url($item->featured_image) }}" alt="" loading="lazy" decoding="async" />
                      </a>
                    @endif
                    <div class="blog-card-body">
                      @if ($item->category)
                        <span class="blog-card-category">{{ $item->category->name }}</span>
                      @endif
                      <h3 class="blog-card-title">
                        <a href="{{ route('blog.show', $item->slug) }}">{{ $item->title }}</a>
                      </h3>
                      <a href="{{ route('blog.show', $item->slug) }}" class="blog-card-link">Read article <span aria-hidden="true">→</span></a>
                    </div>
                  </article>
                @endforeach
              </div>
            </div>
          @endif
        </div>
      </section>

@endsection

@push('scripts')
  <script>
    (function () {
      document.querySelectorAll('.faq-section').forEach(function (root) {
        root.querySelectorAll('.faq-trigger').forEach(function (btn) {
          btn.addEventListener('click', function () {
            var expanded = this.getAttribute('aria-expanded') === 'true';
            var panelId = this.getAttribute('aria-controls');
            var panel = panelId ? document.getElementById(panelId) : null;
            var item = this.closest('.faq-item');
            if (!panel) return;
            if (expanded) {
              this.setAttribute('aria-expanded', 'false');
              panel.hidden = true;
              if (item) item.classList.remove('is-open');
              return;
            }
            root.querySelectorAll('.faq-item').forEach(function (el) {
              el.classList.remove('is-open');
            });
            root.querySelectorAll('.faq-trigger').forEach(function (b) {
              b.setAttribute('aria-expanded', 'false');
              var pid = b.getAttribute('aria-controls');
              var p = pid ? document.getElementById(pid) : null;
              if (p) p.hidden = true;
            });
            this.setAttribute('aria-expanded', 'true');
            panel.hidden = false;
            if (item) item.classList.add('is-open');
          });
        });
      });
    })();
  </script>
@endpush
