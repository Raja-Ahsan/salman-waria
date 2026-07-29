<!DOCTYPE html>
<html lang="en" data-theme="dark"@if(!empty($sw_scroll_to_id)) class="sw-scroll-pending"@endif>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link rel="canonical" href="@yield('canonical_url', url('/'))" />
  <link rel="icon" href="{{ asset('images/favicon.svg') }}" type="image/svg+xml" sizes="48x48" />

  
<meta name="google-site-verification" content="OPbi_5hQ4dNS85Ue08ncjlKJ6rirjdZJnCHfCQwZXL4" />






<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-ED0EJ1YPLN"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());
gtag('config', 'G-ED0EJ1YPLN');
</script>

  <title>@yield('meta_title', 'Salman Waria — Tech Visionary, Author & AI Pioneer')</title>
  <meta name="description" content="@yield('meta_description', 'Salman Waria — Serial entrepreneur, AI architect, Amazon #1 bestselling author of World in 2050, founder of Freedom.AI, Waria Bot, and visionary behind the future of intelligent technology.')" />
  <meta name="keywords" content="@yield('meta_keywords', 'Salman Waria, tech visionary, AI pioneer, entrepreneur, World in 2050, Freedom.AI, Waria Bot, nanotechnology, futurist, Silicon Valley, UAE')" />

  {{-- Dynamic JSON-LD: pass schemas from route/controller --}}
  @if (!empty($organization_schema))
    {!! $organization_schema !!}
  @endif

  @if (!empty($product_schema))
    {!! $product_schema !!}
  @endif

  @if (!empty($custom_schema))
    {!! $custom_schema !!}
  @endif

  @if (!empty($blog_schema))
    {!! $blog_schema !!}
  @endif

  @if (!empty($faq_schema))
    {!! $faq_schema !!}
  @endif
  
  @if (!empty($book_schema))
    {!! $book_schema !!}
  @endif

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" crossorigin="anonymous" />

  <!-- GSAP + ScrollTrigger -->
  <script src="https://cdn.jsdelivr.net/npm/gsap@3.15/dist/gsap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/gsap@3.15/dist/ScrollTrigger.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/gsap@3.15/dist/TextPlugin.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" crossorigin="anonymous"></script>

  @if (request()->routeIs('home', 'home.section.*'))
  <style>
    html.sw-scroll-pending #loader { display: none !important; }
  </style>
  <script>
  (function () {
    window.__SW_HOME_SECTIONS = {
      companies: 1, 'ai-ventures': 1, impact: 1, presence: 1, 'finest-tech': 1,
      vision: 1, hero: 1, contact: 1, book: 1, 'main-content': 1
    };
    window.__SW_SCROLL_TO_ID = @json($sw_scroll_to_id ?? null);
    if (!window.__SW_SCROLL_TO_ID) {
      var slug = (location.pathname || '/').replace(/^\/+|\/+$/g, '');
      if (slug && window.__SW_HOME_SECTIONS[slug]) {
        window.__SW_SCROLL_TO_ID = slug === 'featured-book' ? 'book' : slug;
      }
    }
    if (window.__SW_SCROLL_TO_ID) {
      history.scrollRestoration = 'manual';
      document.documentElement.classList.add('sw-scroll-pending');
    }

    window.swScrollToSectionNow = function () {
      var id = window.__SW_SCROLL_TO_ID;
      if (!id) return false;
      var el = document.getElementById(id);
      if (!el) return false;
      var nav = document.getElementById('navbar');
      var off = (nav && nav.offsetHeight) ? nav.offsetHeight + 12 : 80;
      var y = el.getBoundingClientRect().top + window.scrollY - off;
      window.scrollTo({ top: Math.max(0, y), behavior: 'auto' });
      return true;
    };

    window.swRevealAfterSectionScroll = function () {
      document.documentElement.classList.remove('sw-scroll-pending');
    };

    function swEarlySectionScroll() {
      if (!window.__SW_SCROLL_TO_ID) return;
      if (window.swScrollToSectionNow()) {
        window.swRevealAfterSectionScroll();
      }
    }

    document.addEventListener('DOMContentLoaded', function () {
      swEarlySectionScroll();
      [0, 50, 120, 250, 500].forEach(function (ms) {
        setTimeout(swEarlySectionScroll, ms);
      });
    });
  })();
  </script>
  @endif

  <script>
  function scrollToSection(id, event) {
    var section = document.getElementById(id);
    if (!section) return;
    if (document.getElementById('hero-heading')) {
      if (event) event.preventDefault();
      var nav = document.getElementById('navbar');
      var off = (nav && nav.offsetHeight) ? nav.offsetHeight + 12 : 80;
      var y = section.getBoundingClientRect().top + window.scrollY - off;
      window.scrollTo({ top: Math.max(0, y), behavior: 'smooth' });
      if (history.pushState) {
        history.pushState(null, '', '/' + id);
      }
      window.__SW_SCROLL_TO_ID = id;
      if (typeof window.swRevealAfterSectionScroll === 'function') {
        window.swRevealAfterSectionScroll();
      }
      return false;
    }
  }
  </script>

</head>
