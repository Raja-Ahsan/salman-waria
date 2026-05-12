<?php
$sw_base = 'assests';
$sw_page_title = 'World in 2050 — The Book | Salman Waria';
$sw_page_description = 'World in 2050: Salman Waria’s Amazon #1 futurist book on nanotechnology, AI, and the technologies reshaping civilization — a blueprint, not speculation.';
$sw_amazon_book = 'https://www.amazon.com/World-2050-Salman-Waria-ebook/dp/B0GFY23QP2/';
require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/header.php';
?>

      <!-- ── PAGE HERO ─────────────────────────────────────── -->
      <section class="page-hero" aria-labelledby="book-page-hero-heading">
        <div class="page-hero-bg" aria-hidden="true"></div>
        <div class="page-hero-inner reveal-up">
          <p class="section-eyebrow section-eyebrow--center">The book</p>
          <h1 class="section-title page-hero-title text-center" id="book-page-hero-heading">
            <span class="gold-text">World in 2050 <br>(Spoiler: It’s Wild)</span>
          </h1>
          <p class="section-sub section-sub--center page-hero-sub text-center">
          A research-driven exploration of the technologies, systems, and global forces shaping the world of 2050. 
          </p>
          <!-- <div class="stat-pills" role="list" aria-label="Book recognition">
            <div class="stat-pill reveal-up" role="listitem"><strong>#1</strong> Nanotechnology</div>
            <div class="stat-pill reveal-up" role="listitem"><strong>40+</strong> countries</div>
            <div class="stat-pill reveal-up" role="listitem"><strong>4.9</strong> rating</div>
            <div class="stat-pill reveal-up" role="listitem"><strong>12k+</strong> reviews</div>
          </div> -->
        </div>
      </section>

      <!-- ── HERO PRODUCT (same treatment as home #book) ─────── -->
      <section class="book-section page-section" aria-labelledby="book-page-heading">
        <div class="book-bg-radial" aria-hidden="true"></div>
        <div class="container">
          <div class="book-layout">

            <div class="book-visual reveal-left">
              <div class="book-3d">
                <div class="book-cover">
                  <img
                    src="<?php echo $sw_h_base; ?>/images/book-cover.webp"
                    alt="World in 2050 — book cover"
                    width="280"
                    height="380"
                    loading="eager"
                    fetchpriority="high"
                    decoding="async"
                  />
                </div>
              </div>
            </div>

            <div class="book-content reveal-right">
              <div>
                <p class="section-eyebrow">Salman Waria</p>
                <h2 class="book-title-large" id="book-page-heading">
                  <span class="gold-text">World in 2050</span> —<br>The year is 2050!
                </h2>
              </div>

              <div class="book-awards">
                <div class="award-chip">
                  <!-- <div class="award-chip-icon" aria-hidden="true">🥇</div> -->
                  <div class="award-chip-text">#1 Nanotechnology — Amazon</div>
                </div>
                <div class="award-chip">
                  <!-- <div class="award-chip-icon" aria-hidden="true">🌐</div> -->
                  <div class="award-chip-text">Top seller — Amazon worldwide</div>
                </div>
                <div class="award-chip">
                  <!-- <div class="award-chip-icon" aria-hidden="true">📚</div> -->
                  <div class="award-chip-text">Featured in 40+ countries</div>
                </div>
              </div>

              <p class="book-desc">
              They once said the world would end before we reached this point. Instead, humanity entered the most technologically accelerated era in history.
From artificial intelligence and genetic engineering to quantum computing and autonomous systems, technology is reshaping civilisation faster than most people realise.

              </p>
              <p class="book-desc">
              In World In 2050, Salman Waria explores the systems, breakthroughs, and power shifts defining the next era of humanity.
Machines govern critical infrastructure. Genetically optimised humans outlive every statistical ceiling set in this decade. Quantum processors have cracked the encryption that governments still trust with their most classified intelligence.
None of this is science fiction. It is the documented trajectory of what is already moving.

              </p>
            

              <div class="book-rating" aria-label="4.9 out of 5 stars, over twelve thousand four hundred global reviews">
                <div class="stars" aria-hidden="true">★★★★★</div>
                <strong style="color: var(--text-primary);">4.9</strong>
                <span style="color: var(--text-muted);">· 12,400+ global reviews</span>
              </div>

              <div class="book-cta-row">
                <a
                  href="<?php echo htmlspecialchars($sw_amazon_book, ENT_QUOTES, 'UTF-8'); ?>"
                  class="btn-primary"
                  target="_blank"
                  rel="noopener noreferrer"
                  aria-label="Get World in 2050 on Amazon (opens in new tab)"
                >Get on Amazon</a>
                <a href="book-details.php" class="btn-secondary">Read the Book Before the World Catches Up</a>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- ── THE WORLD IN 2050 BOOK (manifesto) ───────────────── -->
      <section class="page-section bg-surface-1 book-prose-focus" aria-labelledby="book-world-2050-heading">
        <div class="book-prose-focus-bg" aria-hidden="true"></div>
        <div class="container">
          <div class="book-prose-focus-inner reveal-up">
            <h2 class="section-title text-center" id="book-world-2050-heading">The World in 2050 <span class="gold-text">Book</span></h2>
            <div class="book-prose-focus-body">
              <p class="text-prose">Most books about the future keep one foot planted in the present. They nudge familiar variables forward, announce modest projections, and label it vision. The world in 2050 does not work that way.</p>
              <p class="text-prose">Salman Waria spent years tracking four forces accelerating simultaneously — artificial superintelligence, quantum computing, genetic engineering, and the structural fracture of the global power order. Most writers examine these individually. Waria maps what happens when they collide.</p>
              <p class="text-prose book-prose-focus-emphasis">The answer is not comfortable. It is also not avoidable.</p>
              <p class="text-prose">Every chapter in this book is built on documented technological trajectories and real geopolitical movement. The conclusions are not speculative. They are the logical extension of what is already in progress.</p>
              <p class="text-prose">You will not read this book quickly. Not because it is difficult, but because you will keep stopping to look up and recalibrate what you thought you understood about the world around you.</p>
            </div>
          </div>
        </div>
      </section>

      <!-- ── THEMES ──────────────────────────────────────────── -->
      <section class="page-section bg-surface-2" aria-labelledby="book-themes-heading">
        <div class="container">
          <div class="page-block-header text-center reveal-up">
            <!-- <p class="section-eyebrow section-eyebrow--center">Inside the book</p> -->
            <h2 class="section-title" id="book-themes-heading">WHAT IS THIS BOOK<br><span class="gold-text">ABOUT?</span></h2>
            <p class="section-sub section-sub--center">No chapter stands in isolation. Each one builds on the last. By the final page, the world you live in looks different from it did when you opened this book.</p>
          </div>

          <div class="grid-cards">
            <article class="surface-panel reveal-up">
              <!-- <div class="surface-panel-icon" aria-hidden="true">🔬</div> -->
              <h3 class="surface-panel-title">Artificial Superintelligence</h3>
              <p class="text-prose text-prose-sm surface-panel-lead">What becomes permanent when machines outpace human cognition across every domain simultaneously? Not in theory. In practice, in your lifetime.</p>
            
            </article>
            <article class="surface-panel reveal-up">
              <!-- <div class="surface-panel-icon" aria-hidden="true">🤖</div> -->
              <h3 class="surface-panel-title">Quantum Computing</h3>
              <p class="text-prose text-prose-sm surface-panel-lead">Why are the encrypted financial systems, national defence networks, and internet infrastructure that billions depend on structurally unprepared for what is coming, and how fast that window is closing? </p>
            </article>
            <article class="surface-panel reveal-up">
              <!-- <div class="surface-panel-icon" aria-hidden="true">🏙️</div> -->
              <h3 class="surface-panel-title">Genetic Engineering</h3>
              <p class="text-prose text-prose-sm surface-panel-lead">The civilizational question that follows when biology becomes programmable, heritable, and scalable. Society has not had this conversation yet. It needs to.</p>
            </article>
            <article class="surface-panel reveal-up">
              <!-- <div class="surface-panel-icon" aria-hidden="true">⛓️</div> -->
              <h3 class="surface-panel-title">The Multipolar Power Order</h3>
              <p class="text-prose text-prose-sm surface-panel-lead">How technological supremacy has replaced military force as the primary currency of global influence, and which countries understand this better than others.</p>
            </article>
          </div>
        </div>
      </section>

      <!-- ── FOR WHO + QUOTE ─────────────────────────────────── -->
      <section class="page-section bg-surface-1" aria-labelledby="book-audience-heading">
        <div class="container">
          <div class="split-2 align-center">
            <div class="stack stack-lg reveal-left">
              <div class="page-block-header" style="margin-bottom: 0;">
                <!-- <p class="section-eyebrow">Who it is for</p> -->
                <h2 class="section-title" id="book-audience-heading">THE AUTHOR</h2>
              </div>
              <p class="text-prose">
              Salman Waria is not writing about the future from the outside. He is building it.
              </p>
              <p class="text-prose">
              Over a decade as a technologist and entrepreneur across the United States, the UAE, and South Asia, Waria has operated inside the systems, decisions, and power shifts that most people read about after the fact.
              </p>
              <p class="text-prose">
              He founded his first digital agency in Ashburn, Virginia, at 19. That became the launchpad for ventures spanning five countries. Through Logic Works, he built reinforcement learning systems and large language models that pushed operational efficiency in real enterprise environments by up to 80%.
              </p>
              <p class="text-prose">
              Right now, he is developing an AI laptop designed to bridge Pakistan, the United States, and the Middle East. A project that embodies his belief in technology as an integrating force in a world fracturing along geopolitical lines.
              </p>
            </div>
            <div class="reveal-right">
              <div class="inner-quote-block">
              <p class="text-prose">
              His grandfather, Yaqoob Waria, was a prominent self-help author who taught him early that the boundary between what is possible and what is not is always further than people assume. That inheritance, combined with over a decade of building technology companies across three continents, gave him the lens through which this book was written.
The world in 2050 is not a prediction. It is a map, written by someone who has spent years inside the territory.

              </p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- ── BOOK FAQ ─────────────────────────────────────────── -->
      <section class="page-section bg-surface-2 faq-section" id="book-faq" aria-labelledby="book-faq-heading">
        <div class="faq-bg" aria-hidden="true"></div>
        <div class="container">
          <div class="faq-header reveal-up">
            <div class="section-eyebrow section-eyebrow--center">Reader questions</div>
            <h2 class="section-title text-center" id="book-faq-heading"><span class="gold-text">FAQs</span></h2>
       
          </div>

          <div class="faq-list">
            <div class="faq-item reveal-up">
              <button type="button" class="faq-trigger" id="book-faq-btn-1" aria-expanded="false" aria-controls="book-faq-panel-1">
                <span class="faq-question">What Will Happen in the World in 2050?</span>
                <span class="faq-icon" aria-hidden="true"></span>
              </button>
              <div class="faq-panel" id="book-faq-panel-1" role="region" aria-labelledby="book-faq-btn-1" hidden>
                <p class="faq-answer">By 2050, AI, quantum computing, and genetic engineering are expected to reshape economies, governments, and daily life. World in 2050 explores how these technologies could redefine civilisation.</p>
              </div>
            </div>
            <div class="faq-item reveal-up">
              <button type="button" class="faq-trigger" id="book-faq-btn-2" aria-expanded="false" aria-controls="book-faq-panel-2">
                <span class="faq-question">Will AI Rule the World by 2050?</span>
                <span class="faq-icon" aria-hidden="true"></span>
              </button>
              <div class="faq-panel" id="book-faq-panel-2" role="region" aria-labelledby="book-faq-btn-2" hidden>
                <p class="faq-answer">AI may not rule the world, but it will reshape power, decision-making, and global influence. The most advanced AI systems will likely determine which nations and organisations lead the future.</p>
              </div>
            </div>
            <div class="faq-item reveal-up">
              <button type="button" class="faq-trigger" id="book-faq-btn-3" aria-expanded="false" aria-controls="book-faq-panel-3">
                <span class="faq-question">What Is World In 2050 by Salman Waria About?</span>
                <span class="faq-icon" aria-hidden="true"></span>
              </button>
              <div class="faq-panel" id="book-faq-panel-3" role="region" aria-labelledby="book-faq-btn-3" hidden>
                <p class="faq-answer">World In 2050 examines the convergence of AI, quantum computing, genetic engineering, and geopolitical change, and how these forces may transform human civilisation by 2050.</p>
              </div>
            </div>
            <div class="faq-item reveal-up">
              <button type="button" class="faq-trigger" id="book-faq-btn-4" aria-expanded="false" aria-controls="book-faq-panel-4">
                <span class="faq-question">Is World In 2050 a Future Technology Book?</span>
                <span class="faq-icon" aria-hidden="true"></span>
              </button>
              <div class="faq-panel" id="book-faq-panel-4" role="region" aria-labelledby="book-faq-btn-4" hidden>
                <p class="faq-answer">Yes, but it also explores geopolitics, economics, and the societal impact of emerging technologies shaping the future.</p>
              </div>
            </div>
            <div class="faq-item reveal-up">
              <button type="button" class="faq-trigger" id="book-faq-btn-5" aria-expanded="false" aria-controls="book-faq-panel-5">
                <span class="faq-question">Who Should Read World In 2050?</span>
                <span class="faq-icon" aria-hidden="true"></span>
              </button>
              <div class="faq-panel" id="book-faq-panel-5" role="region" aria-labelledby="book-faq-btn-5" hidden>
                <p class="faq-answer">Entrepreneurs, investors, technologists, policymakers, and anyone interested in understanding where technology and society are heading.</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- ── CTA ─────────────────────────────────────────────── -->
      <!-- <section class="page-section bg-surface-2 page-cta-strip" aria-labelledby="book-cta-heading">
        <div class="page-cta-inner reveal-up">
          <p class="section-eyebrow section-eyebrow--center">Get the book</p>
          <h2 class="section-title page-cta-title text-center" id="book-cta-heading">Start reading<br><span class="gold-text">World in 2050</span></h2>
          <p class="section-sub section-sub--center page-cta-lead">E-book and print via Amazon. Opens in a new tab.</p>
          <div class="page-cta-actions">
            <a
              href="<?php echo htmlspecialchars($sw_amazon_book, ENT_QUOTES, 'UTF-8'); ?>"
              class="btn-primary"
              target="_blank"
              rel="noopener noreferrer"
            >Shop on Amazon</a>
         
            <a href="contact-us.php" class="btn-secondary">Contact Us</a>
          </div>
        </div>
      </section> -->

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

<?php
require __DIR__ . '/includes/footer.php';
