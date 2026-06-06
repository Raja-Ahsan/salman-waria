<article class="blog-card reveal-up">
  <a href="{{ route('blog.show', $post->slug) }}" class="blog-card-media" tabindex="-1" aria-hidden="true">
    @if ($post->featured_image)
      <img
        src="{{ storage_public_url($post->featured_image) }}"
        alt=""
        loading="lazy"
        decoding="async" />
    @else
      <div class="blog-card-media-placeholder" aria-hidden="true"></div>
    @endif
  </a>
  <div class="blog-card-body">
    <div class="blog-card-meta">
      @if ($post->category)
        <span class="blog-card-category">{{ $post->category->name }}</span>
      @endif
      @if ($post->published_at)
        <time datetime="{{ $post->published_at->toIso8601String() }}">{{ $post->published_at->format('M d, Y') }}</time>
      @endif
    </div>
    <h2 class="blog-card-title">
      <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
    </h2>
    @if ($post->excerpt())
      <p class="blog-card-excerpt">{{ $post->excerpt(140) }}</p>
    @endif
    <a href="{{ route('blog.show', $post->slug) }}" class="blog-card-link">Read article <span aria-hidden="true">→</span></a>
  </div>
</article>
