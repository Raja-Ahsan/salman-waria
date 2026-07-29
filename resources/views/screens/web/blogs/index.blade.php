@extends('layouts.web.master')

@section('meta_title', 'Blog — Salman Waria | AI, Tech & Entrepreneurship')
@section('meta_description', 'Read Salman Waria\'s latest insights on AI, entrepreneurship, technology strategy, and building ventures across global markets.')
@section('meta_keywords', 'Salman Waria blog, AI insights, entrepreneurship, technology, futurism')
@section('canonical_url', route('blog.index'))

@section('content')

      <section class="page-hero" aria-labelledby="blog-hero-heading">
        <div class="page-hero-bg" aria-hidden="true"></div>
        <div class="page-hero-inner reveal-up">
          <p class="section-eyebrow section-eyebrow--center">Insights &amp; writing</p>
          <h1 class="section-title page-hero-title text-center" id="blog-hero-heading">
            The<br><span class="gold-text">Blog</span>
          </h1>
          <p class="section-sub section-sub--center page-hero-sub text-center">
            AI, entrepreneurship, and the forces reshaping business — from the desk of Salman Waria.
          </p>
        </div>
      </section>

      <section class="page-section bg-surface-1 blog-list-section" aria-label="Blog posts">
        <div class="container">
          <div class="blog-filter reveal-up" id="blog-filter" role="navigation" aria-label="Filter by category">
            <a
              href="{{ route('blog.index') }}"
              class="blog-filter-pill {{ ! $activeCategory ? 'is-active' : '' }}"
              data-blog-filter
              data-category="">All</a>
            @foreach ($categories as $category)
              <a
                href="{{ route('blog.index', ['category' => $category->slug]) }}"
                class="blog-filter-pill {{ $activeCategory?->id === $category->id ? 'is-active' : '' }}"
                data-blog-filter
                data-category="{{ $category->slug }}">
                {{ $category->name }}
              </a>
            @endforeach
          </div>

          <div id="blog-posts-area" class="blog-posts-area">
            @include('screens.web.blogs.partials.posts', ['posts' => $posts])
          </div>
        </div>
      </section>

@endsection

@push('scripts')
  <script>
    (function() {
      const area = document.getElementById('blog-posts-area');
      const filterNav = document.getElementById('blog-filter');
      const baseUrl = @json(route('blog.index'));
      let activeRequest = null;

      if (!area) return;

      function setLoading(isLoading) {
        area.classList.toggle('is-loading', isLoading);
        area.setAttribute('aria-busy', isLoading ? 'true' : 'false');
      }

      function setActivePill(categorySlug) {
        if (!filterNav) return;
        filterNav.querySelectorAll('[data-blog-filter]').forEach(function(pill) {
          const slug = pill.getAttribute('data-category') || '';
          pill.classList.toggle('is-active', slug === (categorySlug || ''));
        });
      }

      function buildFetchUrl(url) {
        const parsed = new URL(url, window.location.origin);
        return parsed.pathname + parsed.search;
      }

      function updateBrowserUrl(url) {
        const parsed = new URL(url, window.location.origin);
        const next = parsed.pathname + parsed.search;
        if (window.location.pathname + window.location.search !== next) {
          history.pushState({ blogFilter: true }, '', next);
        }
      }

      async function loadPosts(url, categorySlug) {
        if (activeRequest) {
          activeRequest.abort();
        }

        const controller = new AbortController();
        activeRequest = controller;

        setLoading(true);

        try {
          const response = await fetch(buildFetchUrl(url), {
            method: 'GET',
            headers: {
              'X-Requested-With': 'XMLHttpRequest',
              'Accept': 'application/json',
            },
            signal: controller.signal,
          });

          if (!response.ok) {
            throw new Error('Could not load posts.');
          }

          const data = await response.json();

          if (!data.success || !data.html) {
            throw new Error('Invalid response.');
          }

          area.innerHTML = data.html;
          setActivePill(categorySlug ?? data.category ?? '');
          updateBrowserUrl(url);

          const sectionTop = area.getBoundingClientRect().top + window.scrollY - 100;
          window.scrollTo({ top: Math.max(sectionTop, 0), behavior: 'smooth' });
        } catch (err) {
          if (err.name !== 'AbortError') {
            window.location.href = url;
          }
        } finally {
          if (activeRequest === controller) {
            activeRequest = null;
            setLoading(false);
          }
        }
      }

      if (filterNav) {
        filterNav.addEventListener('click', function(e) {
          const pill = e.target.closest('[data-blog-filter]');
          if (!pill) return;
          e.preventDefault();
          const categorySlug = pill.getAttribute('data-category') || '';
          const url = pill.getAttribute('href') || baseUrl;
          loadPosts(url, categorySlug);
        });
      }

      area.addEventListener('click', function(e) {
        const link = e.target.closest('#blog-pagination a.page-link');
        if (!link || link.closest('.disabled') || link.closest('.active')) return;
        e.preventDefault();
        loadPosts(link.href, getCurrentCategorySlug());
      });

      function getCurrentCategorySlug() {
        const active = filterNav && filterNav.querySelector('[data-blog-filter].is-active');
        return active ? (active.getAttribute('data-category') || '') : '';
      }

      window.addEventListener('popstate', function() {
        loadPosts(window.location.href, new URL(window.location.href).searchParams.get('category') || '');
      });
    })();
  </script>
@endpush
