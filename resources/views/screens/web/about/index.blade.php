@extends('layouts.web.master')

@section('meta_title', 'About Salman Waria | Bio, Ventures & Tech Leadership')
@section('meta_description', 'The official biography of Salman Waria. Learn about his decade-long journey building AI product platforms, digital agencies, and cross-border ventures.')
@section('meta_keywords', 'About Salman Waria')
@section('canonical_url', route('about'))



@section('content')

      <!-- ── AUGMENT BANNER (Lovable clone; site nav stays in header) ── -->
      <section class="augment-hero" aria-labelledby="augment-hero-heading">
        <svg class="augment-hero-grid" style="opacity:0.1" aria-hidden="true">
          <defs>
            <pattern id="augment-hero-grid" width="48" height="48" patternUnits="userSpaceOnUse">
              <path d="M 48 0 L 0 0 0 48" fill="none" stroke="#64748b" stroke-width="0.6"></path>
            </pattern>
          </defs>
          <rect width="100%" height="100%" fill="url(#augment-hero-grid)"></rect>
        </svg>

        <div class="augment-hero-photo ken-burns" style="background-image:url('{{ asset('images/hero-red.jpg') }}')"></div>
        <div class="augment-hero-photo augment-hero-reveal" id="augment-hero-reveal" style="background-image:url('{{ asset('images/hero-reveal.jpg') }}')"></div>

        <div class="augment-hero-arcs" aria-hidden="true">
          <svg viewBox="0 0 380 700" preserveAspectRatio="xMaxYMid meet">
            <defs>
              <linearGradient id="augment-arcgrad-0" gradientUnits="userSpaceOnUse" x1="-121.51683391182524" y1="-29.79897291630158" x2="207.21635965964526" y2="390.9603274196097">
                <stop offset="0%" stop-color="#fff" stop-opacity="0"></stop>
                <stop offset="22%" stop-color="#fff" stop-opacity="0.5"></stop>
                <stop offset="55%" stop-color="#fff" stop-opacity="0.5"></stop>
                <stop offset="85%" stop-color="#fff" stop-opacity="0.1"></stop>
                <stop offset="100%" stop-color="#fff" stop-opacity="0"></stop>
              </linearGradient>
              <linearGradient id="augment-arcgrad-1" gradientUnits="userSpaceOnUse" x1="110.88119687094499" y1="-27.46984115924147" x2="87.50000000000006" y2="642.0800344948532">
                <stop offset="0%" stop-color="#fff" stop-opacity="0"></stop>
                <stop offset="22%" stop-color="#fff" stop-opacity="0.5"></stop>
                <stop offset="55%" stop-color="#fff" stop-opacity="0.5"></stop>
                <stop offset="85%" stop-color="#fff" stop-opacity="0.1"></stop>
                <stop offset="100%" stop-color="#fff" stop-opacity="0"></stop>
              </linearGradient>
              <linearGradient id="augment-arcgrad-2" gradientUnits="userSpaceOnUse" x1="336.33603408695836" y1="188.71592802415284" x2="32.14781741247583" y2="737.4859974957706">
                <stop offset="0%" stop-color="#fff" stop-opacity="0"></stop>
                <stop offset="22%" stop-color="#fff" stop-opacity="0.5"></stop>
                <stop offset="55%" stop-color="#fff" stop-opacity="0.5"></stop>
                <stop offset="85%" stop-color="#fff" stop-opacity="0.1"></stop>
                <stop offset="100%" stop-color="#fff" stop-opacity="0"></stop>
              </linearGradient>
            </defs>
            <g>
              <path class="arc-line" d="M -121.51683391182524 -29.79897291630158 A 330 330 0 0 1 207.21635965964526 390.9603274196097" fill="none" stroke="url(#augment-arcgrad-0)" stroke-width="1.1" style="--len:622.0353454107791;animation-delay:0.4s"></path>
              <circle class="arc-ring" cx="119.23726225146913" cy="62.61786588824515" r="7" fill="none" stroke="#fff" stroke-opacity="0.35" style="animation-delay:1.6s"></circle>
              <circle class="arc-dot" cx="119.23726225146913" cy="62.61786588824515" r="3.4" fill="#fff" style="animation-delay:1.3s"></circle>
              <text class="arc-text" x="135.23726225146913" y="66.61786588824515" fill="#fff" font-size="32" style="letter-spacing:-1px;animation-delay:1.45s">12<tspan font-size="19" dy="-10"></tspan></text>
              <text class="arc-text" x="137.23726225146913" y="84.61786588824515" fill="#fff" fill-opacity="0.8" font-size="8.5" font-weight="600" style="letter-spacing:2px;animation-delay:1.6s">Ventures</text>
            </g>
            <g>
              <path class="arc-line" d="M 110.88119687094499 -27.46984115924147 A 395 395 0 0 1 87.50000000000006 642.0800344948532" fill="none" stroke="url(#augment-arcgrad-1)" stroke-width="1.1" style="--len:799.7098632638018;animation-delay:0.62s"></path>
              <circle class="arc-ring" cx="284.7593766725428" cy="313.7853011974879" r="7" fill="none" stroke="#fff" stroke-opacity="0.35" style="animation-delay:1.82s"></circle>
              <circle class="arc-dot" cx="284.7593766725428" cy="313.7853011974879" r="3.4" fill="#fff" style="animation-delay:1.52s"></circle>
              <text class="arc-text" x="300.7593766725428" y="317.7853011974879" fill="#fff" font-size="32" style="letter-spacing:-1px;animation-delay:1.67s">2<tspan font-size="19" dy="-10"></tspan></text>
              <text class="arc-text" x="302.7593766725428" y="335.7853011974879" fill="#fff" fill-opacity="0.8" font-size="8.5" font-weight="600" style="letter-spacing:2px;animation-delay:1.82s">continents</text>
            </g>
            <g>
              <path class="arc-line" d="M 336.33603408695836 188.71592802415284 A 460 460 0 0 1 32.14781741247583 737.4859974957706" fill="none" stroke="url(#augment-arcgrad-2)" stroke-width="1.1" style="--len:690.4522520889567;animation-delay:0.8400000000000001s"></path>
              <circle class="arc-ring" cx="220.89630815577954" cy="619.5428504111387" r="7" fill="none" stroke="#fff" stroke-opacity="0.35" style="animation-delay:2.04s"></circle>
              <circle class="arc-dot" cx="220.89630815577954" cy="619.5428504111387" r="3.4" fill="#fff" style="animation-delay:1.7400000000000002s"></circle>
              <text class="arc-text" x="236.89630815577954" y="623.5428504111387" fill="#fff" font-size="32" style="letter-spacing:-1px;animation-delay:1.8900000000000001s">40<tspan font-size="19" dy="-10">+</tspan></text>
              <text class="arc-text" x="238.89630815577954" y="641.5428504111387" fill="#fff" fill-opacity="0.8" font-size="8.5" font-weight="600" style="letter-spacing:2px;animation-delay:2.04s">countries — book</text>
            </g>
          </svg>
        </div>

        <div class="augment-hero-copy">
          <!-- <p class="hero-rise augment-hero-kicker" style="animation-delay:0.15s">Gateway to your <span class="italic">augmented self</span></p> -->
          <h1 class="hero-rise augment-hero-title uppercase" id="augment-hero-heading" style="animation-delay:0.3s">Who I am</h1>
          <!-- <p class="hero-rise augment-hero-lead" style="animation-delay:0.5s">A future where carbon fiber, titanium, and human instinct align. Not machine. Not human. Something wonderfully poised between.</p> -->
          <!-- <a href="{{ url('/contact-us') }}" class="hero-rise augment-hero-cta" style="animation-delay:0.7s">
            Reserve Now
            <span class="augment-hero-shine" aria-hidden="true"></span>
          </a> -->
        </div>
      </section>

      <!-- ── PAGE HERO ─────────────────────────────────────── -->
      <section class="page-hero page-hero--after-banner" aria-labelledby="about-page-heading">
        <div class="page-hero-bg" aria-hidden="true"></div>
        <div class="page-hero-inner reveal-up">
          <p class="section-eyebrow section-eyebrow--center">The story</p>
          <h1 class="section-title page-hero-title text-center" id="about-page-heading">
          Salman Waria —The Global Entrepreneur. AI Architect.<br><span class="gold-text">Technology Innovator.</span>
          </h1>
          <p class="section-sub section-sub--center page-hero-sub text-center">
          Salman Waria has spent over a decade building companies that do not trail market trends. They set them. His work spans three continents, multiple industries, and a single conviction; that technology, deployed with precision, changes the trajectory of everything it touches.
          </p>
          <!-- <div class="stat-pills" role="list" aria-label="Highlights">
            <div class="stat-pill reveal-up" role="listitem"><strong>12+</strong> ventures</div>
            <div class="stat-pill reveal-up" role="listitem"><strong>#1</strong> Amazon — Nanotechnology</div>
            <div class="stat-pill reveal-up" role="listitem"><strong>2</strong> continents</div>
            <div class="stat-pill reveal-up" role="listitem"><strong>40+</strong> countries — book</div>
          </div> -->
        </div>
      </section>

      <!-- ── INTRO SPLIT ───────────────────────────────────── -->
      <section class="page-section bg-surface-1" aria-labelledby="about-bio-heading">
        <div class="container">
          <div class="split-2 align-center">
            <div class="media-frame reveal-left">
              <img
              src="{{ asset('images/salaman-waria-about-image-new.jpg') }}"
                alt="Salman Waria"
                width="600"
                height="560"
                loading="lazy"
                decoding="async"
              />
            </div>
            <div class="stack stack-lg reveal-right">
              <div class="page-block-header" style="margin-bottom: 0;">
                <!-- <p class="section-eyebrow">Who I am</p> -->
                <h2 class="section-title" id="about-bio-heading"><span class="gold-text">Salman Waria</span></h2>
              </div>
              <p class="text-prose">
             Undoubtedly a visionary. He started his first digital venture in Dubai at 19, and that early bet shaped the framework he still operates from: real markets, real capital ,real results

              </p>
              <p class="text-prose">
              Today, he leads a portfolio of companies across digital marketing, <strong>AI product development</strong>, media production, and technology consulting. His decisions are grounded in the real friction of building across different markets, regulatory environments, and cultures simultaneously.
              </p>
              <p class="text-prose">
              He is also the author of <strong>World In 2050</strong>, a book that interrogates the technological forces set to restructure civilisation over the next three decades.
              </p>
              <!-- <div class="inner-quote-block">
                <p>“The convergence of AI and nanotechnology will redefine every industry by 2035. We are building the infrastructure of that future today.”</p>
                <cite>— Salman Waria</cite>
              </div> -->
            </div>
          </div>
        </div>
      </section>

      <!-- ── PILLARS ─────────────────────────────────────────── -->
      <section class="page-section bg-surface-2" aria-labelledby="about-pillars-heading">
        <div class="container">
          <div class="page-block-header text-center reveal-up">
            <!-- <p class="section-eyebrow section-eyebrow--center">Focus areas</p> -->
            <h2 class="section-title" id="about-pillars-heading"><span class="gold-text">FOCUS AREAS</span></h2>
            <!-- <p class="section-sub section-sub--center">Principles you will see across products, investments, and writing — reusable on every inner page of this site.</p> -->
          </div>

          <div class="grid-cards grid-cards--5">
            <article class="surface-panel reveal-up">
              <!-- <div class="surface-panel-icon" aria-hidden="true">⚡</div> -->
              <h3 class="surface-panel-title">Artificial Intelligence and Product Development</h3>
              <!-- <p class="text-prose text-prose-sm surface-panel-lead">Designing systems that ship — from agent marketplaces to edge ML — with security and scale baked in from day one.</p> -->
            </article>
            <article class="surface-panel reveal-up">
              <!-- <div class="surface-panel-icon" aria-hidden="true">🌐</div> -->
              <h3 class="surface-panel-title">Digital Agency Operations and Brand Growth</h3>
              <!-- <p class="text-prose text-prose-sm surface-panel-lead">USA and UAE as twin hubs: Silicon Valley velocity paired with MENA partnerships and long-term regional growth.</p> -->
            </article>
            <article class="surface-panel reveal-up">
              <!-- <div class="surface-panel-icon" aria-hidden="true">📖</div> -->
              <h3 class="surface-panel-title">Cross-Border Market Expansion</h3>
              <!-- <p class="text-prose text-prose-sm surface-panel-lead"><em>World in 2050</em> and ongoing research translate complex technology into narratives executives and builders actually use.</p> -->
            </article>
            <article class="surface-panel reveal-up">
              <!-- <div class="surface-panel-icon" aria-hidden="true">🤝</div> -->
              <h3 class="surface-panel-title">Media Production and Technology-Led Storytelling</h3>
              <!-- <p class="text-prose text-prose-sm surface-panel-lead">Select collaborations with founders, enterprises, and institutions where AI strategy and execution must move as one.</p> -->
            </article>
            <article class="surface-panel reveal-up">
              <!-- <div class="surface-panel-icon" aria-hidden="true">🤝</div> -->
              <h3 class="surface-panel-title">Tech-Driven Business Strategy and Consulting</h3>
              <!-- <p class="text-prose text-prose-sm surface-panel-lead">Select collaborations with founders, enterprises, and institutions where AI strategy and execution must move as one.</p> -->
            </article>
          </div>
        </div>
      </section>

      <!-- ── SKILLS + SECOND VISUAL ──────────────────────────── -->
      <section class="page-section bg-surface-1" aria-labelledby="about-craft-heading">
        <div class="container">
          <div class="split-2 align-center">
            <div class="stack stack-lg reveal-left">
              <div class="page-block-header" style="margin-bottom: 0;">
                <!-- <p class="section-eyebrow">SKILLS AND CRAFT</p> -->
                <h2 class="section-title" id="about-craft-heading">SKILLS AND<br><span class="gold-text">CRAFT</span></h2>
              </div>
              <p class="text-prose">
              Salman works where technology and business intersect most. That is also where most companies lose ground.
              </p>
              <p class="text-prose">
              His technical grasp of AI systems, digital infrastructure, and emerging platforms lets him make decisions that most founders are not equipped to make. His experience building across the US, UAE, and South Asia gives him the pattern recognition that no curriculum teaches.
              </p>
              <p class="text-prose">
              He understands not just what technology can do, but what it should do and precisely when to move.
              </p>
              <!-- <div class="skills-grid">
                <div class="skill-item">
                  <div class="skill-label">AI architecture <span>96%</span></div>
                  <div class="skill-bar"><div class="skill-fill" data-width="96"></div></div>
                </div>
                <div class="skill-item">
                  <div class="skill-label">SaaS strategy <span>92%</span></div>
                  <div class="skill-bar"><div class="skill-fill" data-width="92"></div></div>
                </div>
                <div class="skill-item">
                  <div class="skill-label">Machine learning <span>89%</span></div>
                  <div class="skill-bar"><div class="skill-fill" data-width="89"></div></div>
                </div>
                <div class="skill-item">
                  <div class="skill-label">Venture building <span>98%</span></div>
                  <div class="skill-bar"><div class="skill-fill" data-width="98"></div></div>
                </div>
              </div> -->
            </div>
            <div class="media-frame reveal-right">
              <img
                src="{{ asset('images/salman-waria-03.jpeg') }}"
                alt="Salman Waria in his innovation environment"
                width="600"
                height="500"
                loading="lazy"
                decoding="async"
              />
            </div>
          </div>
        </div>
      </section>

      <!-- ── VISION & MISSION ─────────────────────────────────── -->
      <section class="page-section bg-surface-2 about-vm-section" aria-label="Vision and Mission">
        <div class="vm-bg" aria-hidden="true"></div>
        <div class="container">
          <div class="split-2 about-vm-split">
            <article class="surface-panel about-vm-panel reveal-left">
              <h3 class="about-vm-heading"><span class="gold-text">Vision</span></h3>
              <p class="text-prose about-vm-text">To build technology that expands human capability, accelerates global business growth, and shapes the future responsibly.</p>
            </article>
            <article class="surface-panel about-vm-panel reveal-right">
              <h3 class="about-vm-heading"><span class="gold-text">Mission</span></h3>
              <p class="text-prose about-vm-text">To create scalable AI-driven companies, digital infrastructure, and media systems that solve real-world problems across global markets.</p>
            </article>
          </div>
          <div class="text-center" style="margin-top: 40px;">
            <a href="{{ url('/contact-us') }}" class="btn-primary">Let’s Work Together!</a>
          </div>
        </div>
      </section>
      <!-- ── CTA ─────────────────────────────────────────────── -->
      <!-- <section class="page-section bg-surface-2 page-cta-strip" aria-labelledby="about-cta-heading">
        <div class="page-cta-inner reveal-up">
          <p class="section-eyebrow section-eyebrow--center">Next step</p>
          <h2 class="section-title page-cta-title text-center" id="about-cta-heading">Explore the rest<br><span class="gold-text">of the site</span></h2>
          <p class="section-sub section-sub--center page-cta-lead">Book, ventures, impact — or reach out directly from the home page.</p>
          <div class="page-cta-actions">
            <a href="contact-us.php" class="btn-primary">Contact</a>
            <a href="book-details.php" class="btn-secondary">World in 2050</a>
    
          </div>
        </div>
      </section> -->

@endsection

@push('scripts')
  <script>
    (function () {
      var hero = document.querySelector('.augment-hero');
      if (!hero) return;

      var reveal = document.getElementById('augment-hero-reveal');
      var gridPattern = document.getElementById('augment-hero-grid');
      var pointer = { x: -999, y: -999 };
      var mask = { x: -999, y: -999 };
      var grid = { x: 0, y: 0, tx: 0, ty: 0 };
      var raf = 0;
      var started = false;

      function maskImage(x, y) {
        return 'radial-gradient(circle 260px at ' + x + 'px ' + y + 'px,' +
          'rgba(255,255,255,1) 0%,' +
          'rgba(255,255,255,1) 40%,' +
          'rgba(255,255,255,0.75) 60%,' +
          'rgba(255,255,255,0.4) 75%,' +
          'rgba(255,255,255,0.12) 88%,' +
          'rgba(255,255,255,0) 100%)';
      }

      function applyMask(x, y) {
        if (!reveal) return;
        var img = maskImage(x, y);
        reveal.style.maskImage = img;
        reveal.style.webkitMaskImage = img;
        reveal.style.maskSize = '100% 100%';
        reveal.style.webkitMaskSize = '100% 100%';
      }

      applyMask(-999, -999);

      function tick() {
        mask.x += (pointer.x - mask.x) * 0.1;
        mask.y += (pointer.y - mask.y) * 0.1;
        grid.x += (grid.tx - grid.x) * 0.06;
        grid.y += (grid.ty - grid.y) * 0.06;

        if (reveal) {
          applyMask(mask.x, mask.y);
        }
        if (gridPattern) {
          gridPattern.setAttribute('x', String(grid.x));
          gridPattern.setAttribute('y', String(grid.y));
        }
        raf = requestAnimationFrame(tick);
      }

      window.addEventListener('mousemove', function (e) {
        var rect = hero.getBoundingClientRect();
        pointer.x = e.clientX - rect.left;
        pointer.y = e.clientY - rect.top;
        grid.tx = (e.clientX / window.innerWidth - 0.5) * 16;
        grid.ty = (e.clientY / window.innerHeight - 0.5) * 16;
      });

      raf = requestAnimationFrame(tick);

      function playIntro() {
        if (started) return;
        started = true;
        hero.classList.add('is-ready');
      }

      if (document.documentElement.classList.contains('sw-page-ready')) {
        playIntro();
      } else {
        document.addEventListener('sw:page-ready', playIntro, { once: true });
        setTimeout(playIntro, 4500);
      }
    })();
  </script>
@endpush

