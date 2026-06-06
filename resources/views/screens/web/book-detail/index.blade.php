@extends('layouts.web.master')

@section('meta_title', 'World in 2050 Book Preview & Details | Salman Waria')
@section('meta_description', 'Flip through free preview pages of World in 2050 by Salman Waria. Read chapters online before buying the #1 nanotechnology bestseller on Amazon.')
@section('meta_keywords', 'World in 2050 Book Preview')
@section('canonical_url', route('book-details'))

@php
    $amazonBookUrl = 'https://www.amazon.com/World-2050-Salman-Waria-ebook/dp/B0GFY23QP2/';
@endphp

@section('content')

      <header class="page-hero book-details-hero" aria-labelledby="book-details-heading">
        <div class="page-hero-bg" aria-hidden="true"></div>
        <div class="page-hero-inner reveal-up">
          <p class="section-eyebrow section-eyebrow--center">Preview</p>
          <h1 class="section-title page-hero-title text-center" id="book-details-heading">
            <span class="gold-text">World in 2050</span>
          </h1>
          <p class="section-sub section-sub--center page-hero-sub text-center">
            Flip the cover and browse free preview pages. Full book on Amazon.
          </p>
        </div>
      </header>

      <section class="book-details-viewer page-section bg-surface-1" aria-label="Book flip preview">
        <div class="container">
          <div class="book-flip-layout">
            <div class="book-flip-shell" id="book-flip-shell">
            <div
              id="stf-book"
              class="book-flip-mount"
              role="region"
              aria-label="Interactive book preview"
              data-pdf="{{ asset('book.pdf') }}"
              data-cover="{{ asset('images/book-cover.webp') }}"
              data-amazon="{{ $amazonBookUrl }}"
            ></div>
            </div>

            <p class="book-flip-loader" id="book-flip-loader" aria-live="polite">Opening book…</p>
            <p class="book-flip-error" id="book-flip-error" role="alert" hidden></p>

            <div class="book-flip-nav" id="book-flip-nav" hidden>
              <button type="button" class="book-flip-arrow book-flip-arrow--prev" id="book-flip-prev" aria-label="Previous page" disabled>
                <span class="book-flip-arrow-icon" aria-hidden="true">‹</span>
              </button>
              <button type="button" class="book-flip-arrow book-flip-arrow--next" id="book-flip-next" aria-label="Next page">
                <span class="book-flip-arrow-icon" aria-hidden="true">›</span>
              </button>
            </div>
<!--
            <p class="book-flip-counter" id="book-flip-counter" hidden></p> -->
          </div>

          <!-- <div class="book-details-back text-center" style="margin-top: clamp(32px, 5vw, 48px);">
            <a href="book.php" class="btn-secondary">Book overview</a>
            <a href="featured-book" class="btn-secondary">Home</a>
          </div>
        </div> -->
      </section>

@endsection

@push('scripts')
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
      <script src="https://unpkg.com/page-flip@2.0.7/dist/js/page-flip.browser.js"></script>
      <script src="{{ asset('js/book-flip.js') }}" defer></script>
@endpush
