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
