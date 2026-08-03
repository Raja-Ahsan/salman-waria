@if ($paginator->hasPages())
  <div class="blog-pager">
    <p class="blog-pager-meta">
      Showing
      <span>{{ $paginator->firstItem() }}</span>
      to
      <span>{{ $paginator->lastItem() }}</span>
      of
      <span>{{ $paginator->total() }}</span>
      results
    </p>

    <ul class="blog-pager-list">
      @if ($paginator->onFirstPage())
        <li class="is-disabled"><span aria-hidden="true">&lsaquo;</span></li>
      @else
        <li>
          <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous">&lsaquo;</a>
        </li>
      @endif

      @foreach ($elements as $element)
        @if (is_string($element))
          <li class="is-disabled"><span>{{ $element }}</span></li>
        @endif

        @if (is_array($element))
          @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
              <li class="is-active" aria-current="page"><span>{{ $page }}</span></li>
            @else
              <li><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
            @endif
          @endforeach
        @endif
      @endforeach

      @if ($paginator->hasMorePages())
        <li>
          <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next">&rsaquo;</a>
        </li>
      @else
        <li class="is-disabled"><span aria-hidden="true">&rsaquo;</span></li>
      @endif
    </ul>
  </div>
@endif
