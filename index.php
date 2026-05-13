<?php
require __DIR__ . '/includes/sw-session.php';
$sw_base = 'assests';

$sw_is_home = true;
$sw_scroll_to_id = null;
$sw_home_section_paths = ['companies', 'ai-products', 'impact', 'presence', 'finest-tech', 'vision', 'hero', 'contact', 'featured-book', 'main-content'];
if (!empty($_GET['sw_section']) && is_string($_GET['sw_section'])) {
  $sw_sec = preg_replace('/[^a-z0-9-]+/', '', strtolower($_GET['sw_section']));
  if (in_array($sw_sec, $sw_home_section_paths, true)) {
    $sw_scroll_to_id = $sw_sec === 'featured-book' ? 'book' : $sw_sec;
  }
}

require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/header.php';
?>

      <!-- ── HERO ──────────────────────────────────────────── -->
      <section id="hero" aria-labelledby="hero-heading">
        <div class="hero-bg-mesh" aria-hidden="true"></div>
        <div class="hero-grid-lines" aria-hidden="true"></div>

        <div class="hero-content">
          <div class="hero-left">
            <div class="hero-eyebrow" id="hero-eyebrow">
              <span class="dot" aria-hidden="true"></span>
              Tech Visionary &amp; AI Pioneer
            </div>

            <h1 class="hero-headline" id="hero-heading">
              <span class="line"><span class="word gold-text">Salman Waria</span> <span class="word">The Digital </span></span>
              <span class="line"><span class="word">& Tech</span></span>
              <span class="line"><span class="word"></span><span class="word">Entrepreneur</span></span>
             
            </h1>

            <p class="hero-sub" id="hero-sub">
            Technology entrepreneur, futurist, and AI architect building the next generation of intelligent systems, digital infrastructure, and globally scalable ventures. Operating across elite innovation markets from Silicon Valley to the Gulf, Salman Waria works at the intersection of technology, power, and the future of civilisation.
            </p>

            <div class="hero-badges" id="hero-badges">
              <span class="badge badge-gold">Amazon #1 Bestseller</span>
              <span class="badge badge-cyan">Founder of Freedom.AI</span>
              <span class="badge badge-purple">Creator of Waria Bot</span>
              <span class="badge badge-gold">USA &amp; UAE Ventures</span>
            </div>

            <div class="hero-ctas" id="hero-ctas">
              <a href="contact" class="btn-primary">Work With Me to Build Something Innovative</a>
              <!-- <a href="#book" class="btn-secondary">Read the Book</a> -->
            </div>

            <div class="hero-stats" id="hero-stats">
              <div class="hero-stat">
                <span class="hero-stat-num">5</span>
                <span class="hero-stat-label">Companies Founded</span>
              </div>
              <div class="hero-stat">
                <span class="hero-stat-num">4</span>
                <span class="hero-stat-label">AI Platforms</span>
              </div>
              <div class="hero-stat">
                <span class="hero-stat-num">#1</span>
                <span class="hero-stat-label">Nano technology</span>
              </div>
              <div class="hero-stat">
                <span class="hero-stat-num">2</span>
                <span class="hero-stat-label">Continents</span>
              </div>
            </div>
          </div>

          <div class="hero-right" id="hero-right" aria-hidden="true">
            <div class="portrait-frame">
              <img
                src="<?php echo htmlspecialchars($sw_base, ENT_QUOTES, 'UTF-8'); ?>/images/salmanwaria.jpg"
                alt="Salman Waria, Tech Entrepreneur"
                width="420" height="520"
                loading="eager" fetchpriority="high"
                decoding="async"
              />
              <div class="portrait-overlay">
                <div class="portrait-name">Salman Waria</div>
                <div class="portrait-title">Entrepreneur · Author · AI Architect</div>
              </div>
            </div>

            <!-- Floating Cards -->
            <div class="float-card fc-1">
              <!-- <div class="float-card-icon">🏆</div> -->
              <div>
                <div class="float-card-label">Amazon Ranking</div>
                <div class="float-card-value">#1 Nanotechnology</div>
              </div>
            </div>
            <div class="float-card fc-2">
              <!-- <div class="float-card-icon">🤖</div> -->
              <div>
                <div class="float-card-label">AI Products Live</div>
                <div class="float-card-value">Freedom.AI · Waria Bot</div>
              </div>
            </div>
            <div class="float-card fc-3">
              <!-- <div class="float-card-icon">🌍</div> -->
              <div>
                <div class="float-card-label">Global Presence</div>
                <div class="float-card-value">USA &amp; UAE</div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- ── MARQUEE ─────────────────────────────────────────── -->
      <div class="marquee-section" aria-hidden="true">
        <div class="marquee-track">
          <!-- Items duplicated for seamless loop -->
          <div class="marquee-item"><span class="dot"></span> Freedom.AI</div>
          <div class="marquee-item"><span class="dot"></span> Waria Bot</div>
          <div class="marquee-item"><span class="dot"></span> World in 2050</div>
          <div class="marquee-item"><span class="dot"></span> Great American Ai</div>
          <div class="marquee-item"><span class="dot"></span> Amazon #1 Bestseller</div>
          <div class="marquee-item"><span class="dot"></span> Silicon Valley</div>
          <div class="marquee-item"><span class="dot"></span> Dubai, UAE</div>
          <div class="marquee-item"><span class="dot"></span> Machine Learning</div>
          <div class="marquee-item"><span class="dot"></span> Nanotechnology</div>
          <div class="marquee-item"><span class="dot"></span> SaaS Platforms</div>
          <!-- Duplicate -->
          <div class="marquee-item"><span class="dot"></span> Freedom.AI</div>
          <div class="marquee-item"><span class="dot"></span> Waria Bot</div>
          <div class="marquee-item"><span class="dot"></span> World in 2050</div>
          <div class="marquee-item"><span class="dot"></span> Great American Ai</div>
          <div class="marquee-item"><span class="dot"></span> Amazon #1 Bestseller</div>
          <div class="marquee-item"><span class="dot"></span> Silicon Valley</div>
          <div class="marquee-item"><span class="dot"></span> Dubai, UAE</div>
          <div class="marquee-item"><span class="dot"></span> Machine Learning</div>
          <div class="marquee-item"><span class="dot"></span> Nanotechnology</div>
          <div class="marquee-item"><span class="dot"></span> SaaS Platforms</div>
        </div>
      </div>

      <!-- ── ABOUT ───────────────────────────────────────────── -->
      <section id="about" aria-labelledby="about-heading">
        <div class="container">
          <div class="about-grid">
            <div class="about-visual reveal-left">
              <div class="about-img-wrap">
                <img
                   src="<?php echo htmlspecialchars($sw_base, ENT_QUOTES, 'UTF-8'); ?>/images/salman-waria-03.jpeg"
                  alt="Salman Waria in his innovation lab"
                  width="600" height="500"
                  loading="lazy" decoding="async"
                />
              </div>
              <div class="about-quote-card">
                <p class="about-quote-text">"The convergence of AI and nanotechnology will redefine every industry by 2035. We are building the infrastructure of that future today."</p>
                <div class="about-quote-author">— Salman Waria</div>
              </div>
            </div>

            <div class="about-content reveal-right">
              <div>
                <div class="section-eyebrow">The Visionary</div>
                <h2 class="section-title" id="about-heading">
                DIGITAL<br><span class="gold-text">ENTREPRENEUR</span>
                </h2>
              </div>

              <p class="about-paragraph">
              Salman Waria builds more than companies. He engineers digital ecosystems designed to outlast trends and outperform competition.
              </p>
              <p class="about-paragraph">
              With ventures operating across three continents, he pairs technical depth with entrepreneurial precision. Every brand carries a clear purpose. Every system is built to scale.
              </p>

              <!-- <div class="skills-grid">
                <div class="skill-item">
                  <div class="skill-label">AI Architecture <span>96%</span></div>
                  <div class="skill-bar"><div class="skill-fill" data-width="96"></div></div>
                </div>
                <div class="skill-item">
                  <div class="skill-label">SaaS Strategy <span>92%</span></div>
                  <div class="skill-bar"><div class="skill-fill" data-width="92"></div></div>
                </div>
                <div class="skill-item">
                  <div class="skill-label">Machine Learning <span>89%</span></div>
                  <div class="skill-bar"><div class="skill-fill" data-width="89"></div></div>
                </div>
                <div class="skill-item">
                  <div class="skill-label">Venture Building <span>98%</span></div>
                  <div class="skill-bar"><div class="skill-fill" data-width="98"></div></div>
                </div>
              </div> -->
            </div>
          </div>
        </div>
      </section>

      <!-- ── FINEST TECH INNOVATOR (agency grid) ─────────────── -->
      <section id="finest-tech" aria-labelledby="finest-tech-heading">
        <div class="fti-bg" aria-hidden="true"></div>
        <div class="container">
          <div class="companies-header reveal-up">
         
            <h2 class="section-title" id="finest-tech-heading">FINEST TECH<br><span class="gold-text">INNOVATOR</span></h2>
         
          </div>
        </div>

        <div class="fti-grid" role="list">
          <a href="https://americandigitalagency.us/" target="_blank" rel="noopener noreferrer" class="fti-link">
            <article class="fti-card reveal-up" role="listitem">
              <div class="fti-card-number" aria-hidden="true">01</div>
              <h3 class="fti-card-title">American Digital Agency</h3>
              <p class="fti-card-desc">Connecting brands with the audiences who convert, not just browse.</p>
              <div class="fti-card-footer">
                <span class="flag-badge">Learn more</span>
              </div>
            </article>
          </a>
          <a href="https://logicworks.ae/" target="_blank" rel="noopener noreferrer" class="fti-link">
            <article class="fti-card reveal-up" role="listitem">
              <div class="fti-card-number" aria-hidden="true">02</div>
              <h3 class="fti-card-title">Logic Works</h3>
              <p class="fti-card-desc">Technology and storytelling fused to produce digital outcomes that endure.</p>
              <div class="fti-card-footer">
                <span class="flag-badge">Learn more</span>
              </div>
            </article>
          </a>
          <a href="#" target="_blank" rel="noopener noreferrer" class="fti-link">
            <article class="fti-card reveal-up" role="listitem">
              <div class="fti-card-number" aria-hidden="true">03</div>
              <h3 class="fti-card-title">Logic Works (Dubai)</h3>
              <p class="fti-card-desc">Moving at the speed of the world&apos;s most competitive technology market.</p>
              <div class="fti-card-footer">
                <span class="flag-badge">Learn more</span>
              </div>
            </article>
          </a>
          <a href="#" target="_blank" rel="noopener noreferrer" class="fti-link">
            <article class="fti-card reveal-up" role="listitem">
              <div class="fti-card-number" aria-hidden="true">04</div>
              <h3 class="fti-card-title">Logic Media House</h3>
              <p class="fti-card-desc">Where cinematic craft meets modern technology to build brands through story.</p>
              <div class="fti-card-footer">
                <span class="flag-badge">Learn more</span>
              </div>
            </article>
          </a>
        </div>
      </section>

 


      <!-- ── BOOK ────────────────────────────────────────────── -->
      <section id="book" aria-labelledby="book-heading">
        <div class="book-bg-radial" aria-hidden="true"></div>
        <div class="container">
          <div class="book-layout">

            <!-- 3D Book Visual -->
            <div class="book-visual reveal-left">
              <div class="book-3d">
                <div class="book-cover">
                  <img
                    src="<?php echo htmlspecialchars($sw_base, ENT_QUOTES, 'UTF-8'); ?>/images/book-cover.webp"
                    alt="World in 2050 — book cover"
                    width="280"
                    height="380"
                    loading="lazy"
                    decoding="async"
                  />
                </div>
              </div>
            </div>

            <!-- Book Content -->
            <div class="book-content reveal-right">
              <div>
                <div class="section-eyebrow">How Salman Waria Inspires Through Tech Leadership</div>
                <h2 class="book-title-large" id="book-heading">
                  <span class="gold-text">World in 2050</span> —<br>THE FUTURE<br>UNVEILED
                </h2>
              </div>

              <div class="book-awards">
                <div class="award-chip">
                  <!-- <div class="award-chip-icon">🥇</div> -->
                  <div class="award-chip-text">#1 Nanotechnology — Amazon</div>
                </div>
                <div class="award-chip">
                  <!-- <div class="award-chip-icon">🌐</div> -->
                  <div class="award-chip-text">Top Seller — Amazon Worldwide</div>
                </div>
                <div class="award-chip">
                  <!-- <div class="award-chip-icon">📚</div> -->
                  <div class="award-chip-text">Featured in 40+ Countries</div>
                </div>
              </div>

              <p class="book-desc">
              Thirty years from now, the rules will have changed completely. Salman Waria has written the book that maps exactly where this is heading and why it is closer than most people think.
              </p>

              <div class="book-rating" aria-label="4.9 out of 5 stars">
                <div class="stars" aria-hidden="true">★★★★★</div>
                <strong style="color: var(--text-primary);">4.9</strong>
                <span style="color: var(--text-muted);">&nbsp;· 12,400+ global reviews</span>
              </div>

              <div class="book-cta-row">
                <a
                  href="https://www.amazon.com/World-2050-Salman-Waria-ebook/dp/B0GFY23QP2/ref=tmm_kin_swatch_0?_encoding=UTF8&dib_tag=se&dib=eyJ2IjoiMSJ9.PBG-mFrGUgrl94o4BOCVQuho7yuCOrzXme6rU20aCZxHaHiw2fU9rWgPR4Ebh2bIRJU9e19YVEvgDbqkDtFQkXxAc4ai9Fr7i4iUNh0splXb-i3kc6eYs7moZ5I4tg0VQjS_OR5E9zgQCyZgLKGSgPJ1WgRYoBZjgNvIUA2QLUi5CsE2E5rkrSRCP4bkGe_ynMrQfkjFKvAQH-nfdZ_SCs8Oq0ByiZIt5oUb5_RAHwQ.SuN81h4m0UJJZ57Vd6YP6Un2dcLDznSwFaP4XCah8Dc&qid=1770239182&sr=1-1"
                  target="_blank"
                  rel="noopener noreferrer"
                  class="btn-primary"
                  aria-label="Get World in 2050 on Amazon"
                >Get on Amazon</a>
                <a href="book-details.php" class="btn-secondary">Read the Book</a>
              </div>
            </div>
          </div>
        </div>
      </section>


    <!-- ── New Section ──────────────────────────────── -->
    <section id="companies" aria-labelledby="companies-heading">
        <!-- <div class="container">
          <div class="companies-header reveal-up">
            <div class="section-eyebrow">The Portfolio</div>
            <h2 class="section-title" id="companies-heading">THE AI PRODUCTS REDEFINING <br><span class="gold-text">THEIR CATEGORIES</span></h2>
            <p class="section-sub">Salman Waria's AI product portfolio is not a feature suite assembled under one brand. Each product was engineered to solve a specific, high-value problem that the existing technology market had failed to address with any real precision.</p>
          </div>
        </div> -->

        <div class="empire-grid" role="list" >

          <article class="empire-card reveal-up" role="listitem" style="--delay:0" >
         
          
            <h3 class="empire-name">THE BUILDER BEHIND THE BRAND</h3> 
            <p class="empire-desc">Salman did not study digital entrepreneurship in a classroom. He started living it at 19 in Dubai, building his first agency long before most people had settled on a direction.</p>
            <p class="empire-desc">That single venture became the foundation for a cross-continental portfolio now spanning the United States, the UAE, and South Asia. Each company was built to solve a real problem, penetrate a specific market, and grow with discipline.</p>
            <p class="empire-desc">He has never built a side project. Every venture in his portfolio is treated as infrastructure something designed to last and lead in its category.</p>
            <p class="empire-desc">Technology is the vehicle. Strategic clarity is the engine. Results are the only score that counts.</p>
          
          </article>
          
          <article class="empire-card reveal-up" role="listitem" style="--delay:0" >
         
          
         <h3 class="empire-name">WHERE TECHNOLOGY MEETS PURPOSE</h3> 
         <p class="empire-desc">Most companies purchase technology. Salman Waria builds it from the ground up.</p>
         <p class="empire-desc">From AI product development to cross-border digital infrastructure, his work sits at the intersection of what technology can do and what real markets need. Most ventures fail in that gap. He consistently finds footing there.</p>
         <p class="empire-desc">His companies have served thousands of clients across software development, digital marketing, media production, and AI-powered business systems.</p>
         <p class="empire-desc">The through line across every project is precision-led thinking and technology applied with intent, not just capability.</p>
       
       </article>

       <article class="empire-card reveal-up" role="listitem" style="--delay:0" >
         
          
         <h3 class="empire-name">THE LONG VIEW BEHIND EVERY DECISION</h3> 
         <p class="empire-desc">Salman Waria is the author of World In 2050, a book examining how artificial superintelligence, quantum computing, and genetic engineering will reshape civilisation within three decades.</p>
         <p class="empire-desc">That investment in the long horizon is not separate from his business work. It is the compass behind it.</p>
         <p class="empire-desc">Every company he builds, every system he engineers, and every market he enters is guided by a clear-eyed view of where technology is heading. He is not catching up with the future.</p>
         <p class="empire-desc">He is building from the inside.</p>
       
       </article>


       <article class="empire-card reveal-up" role="listitem" style="--delay:0" >
         
          
         <h3 class="empire-name">THE TECHNOLOGY HE OPERATES IN</h3> 
         <p class="empire-desc">Salman's work spans digital strategy, full-stack software development, AI product design, performance marketing, and media production. He does not work in one lane because he understands that the most durable businesses are built at the convergence of several.</p>
         <p class="empire-desc">That multi-domain perspective lets him identify opportunities that single-focus operators miss. When you see through the lens of technology, marketing, and storytelling simultaneously, the strategy sharpens at every level.</p>
         <p class="empire-desc">He has worked with startups at ideation and with global enterprises at scale. The methodology adapts. The standard never does.</p>
        
       
       </article>
          </a>
        </div>
      </section>


      <!-- ── AI PRODUCTS ─────────────────────────────────────── -->
      <section id="ai-products" aria-labelledby="ai-products-heading">
        <div class="container">
          <div class="products-header reveal-up">
            <!-- <div class="section-eyebrow">AI Ventures</div> -->
            <h2 class="section-title" id="ai-products-heading">
            THE AI PRODUCTS REDEFINING<br><span class="gold-text">THEIR CATEGORIES</span>
            </h2>
            <p class="section-sub">Salman Waria's AI product portfolio is not a feature suite assembled under one brand. Each product was engineered to solve a specific, high-value problem that the existing technology market had failed to address with any real precision.</p>
          </div>

          <div class="products-bento">

            <!-- Freedom.AI -->
            <article class="prod-card prod-card-1 reveal-up" aria-labelledby="prod-freedom-heading">
              <div class="prod-card-bg" aria-hidden="true"></div>
              <!-- <span class="prod-badge badge-flagship">Flagship Product</span> -->
              <div class="prod-logo">
                <!-- <div class="prod-logo-icon prod-logo-icon-1" aria-hidden="true">⚡</div> -->
                <div class="prod-logo-name">
                  Freedom.AI
                  <!-- <span>AI Web Builder Platform</span> -->
                </div>
              </div>
              <!-- <h3 class="prod-headline" id="prod-freedom-heading">Build Anything.<br>Ship Everything.</h3> -->
              <p class="prod-desc">A sovereign AI system designed for complete privacy and on-device intelligence without cloud dependency.</p>
              <div class="prod-features">
                <div class="prod-feature"><span class="prod-feature-dot" aria-hidden="true" style="width:6px;height:6px;background:var(--gold);border-radius:50%;flex-shrink:0;margin-right:-4px;"></span>Fully local AI processing</div>
                <div class="prod-feature"><span style="width:6px;height:6px;background:var(--gold);border-radius:50%;flex-shrink:0;"></span>Zero third-party data exposure</div>
                <div class="prod-feature"><span style="width:6px;height:6px;background:var(--gold);border-radius:50%;flex-shrink:0;"></span>Built for privacy and auto</div>
              </div>
              <a href="http://build-freedom.ai/" target="_blank" rel="noopener noreferrer" class="prod-link" aria-label="Explore Freedom.AI">
                Explore Freedom AI
                <span class="prod-link-arrow" aria-hidden="true">→</span>
              </a>
            </article>

            <!-- Waria Bot -->
            <article class="prod-card prod-card-2 reveal-up" aria-labelledby="prod-bolt-heading">
              <div class="prod-card-bg" aria-hidden="true"></div>
              <!-- <span class="prod-badge badge-live">Live</span> -->
              <div class="prod-logo">
                <!-- <div class="prod-logo-icon prod-logo-icon-2" aria-hidden="true">🔬</div> -->
                <div class="prod-logo-name">
                  Waria Bot
                  <!-- <span>Local ML System</span> -->
                </div>
              </div>
              <!-- <h3 class="prod-headline" id="prod-freedom-heading">Build Anything.<br>Ship Everything.</h3> -->
              <p class="prod-desc">A domain-focused conversational AI platform engineered for intelligent workflow execution and contextual accuracy.</p>
              <div class="prod-features">
                <div class="prod-feature"><span style="width:6px;height:6px;background:var(--cyan);border-radius:50%;flex-shrink:0;"></span>Low-latency AI responses</div>
                <div class="prod-feature"><span style="width:6px;height:6px;background:var(--cyan);border-radius:50%;flex-shrink:0;"></span>Domain-specific intelligence</div>
                <div class="prod-feature"><span style="width:6px;height:6px;background:var(--cyan);border-radius:50%;flex-shrink:0;"></span>Advanced workflow automation</div>
              </div>
              <a href="#" class="prod-link" aria-label="Learn about Waria Bot" style="color:var(--cyan);">
                Explore Waria Bot
                <span class="prod-link-arrow" aria-hidden="true">→</span>
              </a>
            </article>

            <!-- AI Agent Marketplace -->
            <article class="prod-card prod-card-3 reveal-up" aria-labelledby="prod-market-heading">
                <div class="prod-card-bg" aria-hidden="true"></div>
                <!-- <span class="prod-badge badge-new">New</span> -->
              <div class="prod-logo">
                <!-- <div class="prod-logo-icon prod-logo-icon-3" aria-hidden="true">🏪</div> -->
                <div class="prod-logo-name">
                  Great American Ai
                  <!-- <span>AI SaaS Marketplace</span> -->
                </div>
              </div>
              <!-- <h3 class="prod-headline" id="prod-market-heading">The World's Most Comprehensive AI Agent Marketplace</h3> -->
              <p class="prod-desc">An AI-powered analytics and automation platform designed specifically for the US business ecosystem.</p>
              <div class="prod-features">
                <div class="prod-feature"><span style="width:6px;height:6px;background:#a78bfa;border-radius:50%;flex-shrink:0;"></span>AI-driven decision intelligence</div>
                <div class="prod-feature"><span style="width:6px;height:6px;background:#a78bfa;border-radius:50%;flex-shrink:0;"></span>Enterprise automation systems</div>
                <div class="prod-feature"><span style="width:6px;height:6px;background:#a78bfa;border-radius:50%;flex-shrink:0;"></span>Built for American market operations</div>
              </div>
              <a href="https://greatamerican.ai/" target="_blank" rel="noopener noreferrer" class="prod-link" aria-label="Visit Great American Ai" style="color:#a78bfa;">
                Visit Great American Ai
                <span class="prod-link-arrow" aria-hidden="true">→</span>
              </a>
            </article>

            <!-- NeuralGrid -->
            <article class="prod-card prod-card-4 reveal-up" aria-labelledby="prod-neural-heading">
              <div class="prod-card-bg" aria-hidden="true"></div>
              <div class="prod-logo">
                <!-- <div class="prod-logo-icon prod-logo-icon-4" aria-hidden="true">📡</div> -->
                <div class="prod-logo-name">
                  AI Estate Marketplace
                  <!-- <span>AUTONOMOUS AI PROPERTY ECOSYSTEM</span> -->
                </div>
              </div>
              <!-- <h3 class="prod-headline" id="prod-neural-heading">The AI Estate Marketplace<br>of Enterprise AI.</h3> -->
              <p class="prod-desc">A machine learning platform transforming property discovery, valuation, and real estate intelligence.</p>
              <div class="prod-features">
                <div class="prod-feature"><span style="width:6px;height:6px;background:#34d399;border-radius:50%;flex-shrink:0;"></span>AI-powered property insights</div>
                <div class="prod-feature"><span style="width:6px;height:6px;background:#34d399;border-radius:50%;flex-shrink:0;"></span>Smart valuation modelling</div>
                <div class="prod-feature"><span style="width:6px;height:6px;background:#34d399;border-radius:50%;flex-shrink:0;"></span>Intelligent transaction systems</div>
              </div>
              <a href="https://www.aiestate.ae/" target="_blank" rel="noopener noreferrer" class="prod-link" aria-label="Explore AI Estate Marketplace" style="color:#34d399;">
                Explore AI Estate Marketplace
                <span class="prod-link-arrow" aria-hidden="true">→</span>
              </a>
            </article>

          </div>
        </div>
      </section>

      <!-- ── VISION QUOTE ────────────────────────────────────── -->
      <section id="vision" aria-labelledby="vision-quote">
        <blockquote class="vision-quote reveal-up" id="vision-quote">
          The most dangerous thing an entrepreneur can do is think small. The future doesn't belong to those who wait — it belongs to those bold enough to build it before anyone else can see it.
        </blockquote>
        <p class="vision-attr reveal-up">— Salman Waria, World in 2050</p>
      </section>

      <!-- ── IMPACT STATS ────────────────────────────────────── -->
      <section id="impact" aria-labelledby="impact-heading">
        <div class="impact-bg" aria-hidden="true"></div>
        <div class="container">
          <div class="impact-header reveal-up">
            <!-- <div class="section-eyebrow">By the Numbers</div> -->
            <h2 class="section-title" id="impact-heading">
            What I Do As a<br><span class="gold-text">Tech ENTREPRENEUR</span>
            </h2>
            <!-- <p class="section-sub">Two decade of building, launching, and scaling technology that touches millions of lives across 40+ countries.</p> -->
          </div>

          <div class="impact-grid" role="list">
            <div class="impact-stat reveal-up" role="listitem">
              <div class="impact-number" data-target="12" data-suffix="+">1</div>
              <div class="impact-label">DIGITAL STRATEGY & GROWTH</div>
              <div class="impact-divider"></div>
            </div>
            <div class="impact-stat reveal-up" role="listitem">
              <div class="impact-number" data-target="2.8" data-suffix="M+">2</div>
              <div class="impact-label">TECH INNOVATION & AI SOLUTIONS</div>
              <div class="impact-divider"></div>
            </div>
            <div class="impact-stat reveal-up" role="listitem">
              <div class="impact-number" data-target="40" data-suffix="+">3</div>
              <div class="impact-label">BRAND DEVELOPMENT & STORYTELLING</div>
              <div class="impact-divider"></div>
            </div>
            <div class="impact-stat reveal-up" role="listitem">
              <div class="impact-number" data-target="500" data-suffix="M+">4</div>
              <div class="impact-label">BUSINESS SCALING & GLOBAL EXPANSION</div>
              <div class="impact-divider"></div>
            </div>
            <div class="impact-stat reveal-up" role="listitem">
              <div class="impact-number" data-target="500" data-suffix="M+">5</div>
              <div class="impact-label">DIGITAL MARKETING & PERFORMANCE ADS</div>
              <div class="impact-divider"></div>
            </div>
          </div>
        </div>
      </section>

      <!-- ── GLOBAL PRESENCE ─────────────────────────────────── -->
      <section id="presence" aria-labelledby="presence-heading">
        <div class="container">
          <div class="presence-layout">
            <div class="reveal-left">
              <div class="section-eyebrow">Global Presence</div>
              <h2 class="section-title" id="presence-heading">
              Building Across Global<br><span class="gold-text">Innovation Hubs</span>
              </h2>
              <p class="section-sub" style="margin-bottom:48px;">Salman Waria operates across leading technology and business markets, building AI ventures, digital infrastructure, and scalable systems designed for global impact.</p>

              <div class="presence-locations">
                <div class="location-card reveal-up">
                  <div class="location-flag" aria-hidden="true">🇺🇸</div>
                  <div class="location-info">
                    <div class="location-country">United States</div>
                    <div class="location-city">Silicon Valley, California · New York · Austin, Texas</div>
                    <div class="location-companies">AI innovation, product development, venture strategy, and technology-led business expansion across North America.</div>
                  </div>
                  <div class="location-dot" aria-hidden="true"></div>
                </div>
                <div class="location-card reveal-up">
                  <div class="location-flag" aria-hidden="true">🇦🇪</div>
                  <div class="location-info">
                    <div class="location-country">United Arab Emirates</div>
                    <div class="location-city">Dubai · Abu Dhabi</div>
                    <div class="location-companies">Cross-border ventures, digital transformation, media innovation, and AI ecosystem development across the Middle East.</div>
                  </div>
                  <div class="location-dot" aria-hidden="true"></div>
                </div>
              </div>
            </div>

            <div class="reveal-right">
              <div class="section-eyebrow">Journey</div>
              <h2 class="section-title">Milestones That<br><span class="gold-text">Shaped the Journey</span></h2>
              <div class="timeline-track" style="margin-top:40px;">
                <div class="timeline-item">
                  <div class="timeline-dot" aria-hidden="true"></div>
                  <div class="timeline-year">2014</div>
                  <div class="timeline-event">Started First Digital Venture</div>
                  <div class="timeline-detail">Launched his first digital business in Dubai at 19, building the foundation for future ventures across technology, media, and AI.</div>
                </div>
                <div class="timeline-item">
                  <div class="timeline-dot" aria-hidden="true"></div>
                  <div class="timeline-year">2018</div>
                  <div class="timeline-event">Expanded Across Global Markets</div>
                  <div class="timeline-detail">Scaled operations across the United States, the UAE, and South Asia, working across digital growth, branding, and technology infrastructure.</div>
                </div>
                <div class="timeline-item">
                  <div class="timeline-dot" aria-hidden="true"></div>
                  <div class="timeline-year">2023</div>
                  <div class="timeline-event">Entered AI Product Development</div>
                  <div class="timeline-detail">Began building AI-focused platforms and systems designed around automation, scalable infrastructure, and emerging technologies.</div>
                </div>
                <div class="timeline-item">
                  <div class="timeline-dot" aria-hidden="true"></div>
                  <div class="timeline-year">2025</div>
                  <div class="timeline-event">Published World In 2050</div>
                  <div class="timeline-detail">Released the technology and futurism book exploring AI, quantum computing, genetic engineering, and the future of civilisation.</div>
                </div>
                <div class="timeline-item">
                  <div class="timeline-dot" aria-hidden="true"></div>
                  <div class="timeline-year">2026</div>
                  <div class="timeline-event">Building the Next Generation of AI Ventures</div>
                  <div class="timeline-detail">Focused on developing scalable AI products, intelligent systems, and technology-driven businesses designed for global markets.</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- ── CONTACT ─────────────────────────────────────────── -->
      <section id="contact" aria-labelledby="contact-heading">
        <div class="contact-bg" aria-hidden="true"></div>
        <div class="container">
          <div class="contact-inner">
            <div class="contact-left reveal-left">
              <div>
                <div class="section-eyebrow">Get in Touch</div>
                <h2 class="section-title" id="contact-heading">
                  Let's Build<br><span class="gold-text">Something<br>Meaningful</span>
                </h2>
              </div>
              <p class="section-sub">Looking to build a company, exploring AI solutions, seeking strategic collaboration, or interested in media and speaking opportunities, Salman Waria’s team is ready to connect.</p>
              <p class="section-sub">The next decade will belong to those who move early, think globally, and build with precision. Start the conversation today.</p>

              <!-- <div class="contact-info-items">
                <div class="contact-info-item">
                  <div class="contact-info-icon" aria-hidden="true">📍</div>
                  <div>
                    <div class="contact-info-label">Headquarters</div>
                    <div class="contact-info-value">Silicon Valley, CA &amp; Dubai, UAE</div>
                  </div>
                </div>
                <div class="contact-info-item">
                  <div class="contact-info-icon" aria-hidden="true">✉️</div>
                  <div>
                    <div class="contact-info-label">General Inquiries</div>
                    <div class="contact-info-value">hello@adrianvoss.com</div>
                  </div>
                </div>
                <div class="contact-info-item">
                  <div class="contact-info-icon" aria-hidden="true">💼</div>
                  <div>
                    <div class="contact-info-label">Business Development</div>
                    <div class="contact-info-value">ventures@adrianvoss.com</div>
                  </div>
                </div>
                <div class="contact-info-item">
                  <div class="contact-info-icon" aria-hidden="true">📖</div>
                  <div>
                    <div class="contact-info-label">Speaking &amp; Media</div>
                    <div class="contact-info-value">media@adrianvoss.com</div>
                  </div>
                </div>
              </div> -->
            </div>

            <div class="reveal-right">
              <form class="contact-form" id="contact-form" novalidate aria-labelledby="contact-form-label" action="contact-submit.php" method="post">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['sw_csrf_contact'], ENT_QUOTES, 'UTF-8'); ?>" />
                <h3 id="contact-form-label" style="font-family:'Playfair Display',serif;font-size:1.6rem;color:var(--text-primary);margin-bottom:8px;">Send a Message</h3>
                <p style="font-size:0.9rem;color:var(--text-secondary);margin-bottom:8px;">Response within 24 hours guaranteed.</p>

                <div class="form-grid">
                  <div class="form-group">
                    <label for="form-name">First Name</label>
                    <input type="text" id="form-name" name="name" class="form-input" placeholder="John" required autocomplete="given-name" aria-required="true" />
                  </div>
                  <div class="form-group">
                    <label for="form-company">Company</label>
                    <input type="text" id="form-company" name="company" class="form-input" placeholder="Acme Corp" autocomplete="organization" />
                  </div>
                </div>

                <div class="form-group">
                  <label for="form-email">Email Address</label>
                  <input type="email" id="form-email" name="email" class="form-input" placeholder="john@company.com" required autocomplete="email" aria-required="true" />
                </div>

                <div class="form-group">
                  <label for="form-subject">Subject</label>
                  <input type="text" id="form-subject" name="subject" class="form-input" placeholder="Partnership Opportunity / Speaking / AI Solutions..." />
                </div>

                <div class="form-group">
                  <label for="form-message">Message</label>
                  <textarea id="form-message" name="message" class="form-textarea" placeholder="Tell Salman about your vision, challenge, or opportunity..." required aria-required="true"></textarea>
                </div>

                <button type="submit" class="form-submit" id="form-submit">
                  Send Message →
                </button>

                <div id="form-error" style="display:none;padding:16px;background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.35);border-radius:12px;color:#f87171;font-size:0.9rem;text-align:center;" role="alert"></div>
                <div id="form-success" style="display:none;padding:16px;background:rgba(16,185,129,0.1);border:1px solid rgba(16,185,129,0.3);border-radius:12px;color:#34d399;font-size:0.9rem;text-align:center;" role="alert">
                  ✓ Message sent! The team will respond within 24 hours.
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>

<?php
require __DIR__ . '/includes/footer.php';
