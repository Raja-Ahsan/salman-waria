<div id="blog-posts-wrapper">
  @if ($posts->count())
    <div class="blog-grid" id="blog-posts-grid">
      @foreach ($posts as $post)
        @include('screens.web.blogs.partials.card', ['post' => $post])
      @endforeach
    </div>

    @if ($posts->hasPages())
      <nav class="blog-pagination reveal-up" id="blog-pagination" aria-label="Blog pagination">
        {{ $posts->withQueryString()->onEachSide(1)->links('pagination::bootstrap-5') }}
      </nav>
    @endif
  @else
    <div class="blog-empty reveal-up" id="blog-posts-empty">
      <p class="text-prose text-center">No published posts in this category yet.</p>
    </div>
  @endif
</div>
