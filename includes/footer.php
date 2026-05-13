    </main>

    <!-- ── FOOTER ──────────────────────────────────────────── -->
    <footer role="contentinfo">
      <div class="footer-grid">
        <div>
          <div class="footer-brand-name">Salman Waria</div>
          <p class="footer-brand-desc">Serial entrepreneur, AI pioneer, and Amazon #1 bestselling author building the technological infrastructure of tomorrow — from Silicon Valley to Dubai.</p>
          <div class="footer-socials" aria-label="Social media links">
            <a href="https://www.facebook.com/salmanwariaofficial" target="_blank" rel="noopener noreferrer" class="footer-social" aria-label="Facebook"><i class="fa-brands fa-facebook-f" aria-hidden="true"></i></a>
            <a href="https://ae.linkedin.com/in/salman-waria-tech-entrepreneur" target="_blank" rel="noopener noreferrer" class="footer-social" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in" aria-hidden="true"></i></a>
            <a href="https://www.imdb.com/name/nm11841602/" style="font-size: 1.5rem; !important;" target="_blank" rel="noopener noreferrer" class="footer-social" aria-label="IMDb"><i class="fa-brands fa-imdb" aria-hidden="true"></i></a>
            <a href="https://www.instagram.com/salman.waria/" target="_blank" rel="noopener noreferrer" class="footer-social" aria-label="Instagram"><i class="fa-brands fa-instagram" aria-hidden="true"></i></a>
          </div>
        </div>
        <div>
          <div class="footer-col-title">Ventures</div>
          <ul class="footer-links">
            <li><a href="http://build-freedom.ai/" target="_blank" rel="noopener noreferrer">Freedom AI</a></li>
            <li><a href="#">Waria Bot</a></li>
            <li><a href="https://greatamerican.ai/" target="_blank" rel="noopener noreferrer">Great American Ai</a></li>
            <li><a href="https://www.aiestate.ae/" target="_blank" rel="noopener noreferrer">AI Estate Marketplace</a></li>
            <li><a href="#">Salman Waria's Tech Group</a></li>
          </ul>
        </div>
        <div>
          <div class="footer-col-title">Explore</div>
          <ul class="footer-links">
            <li><a href="<?php echo htmlspecialchars(sw_href('about'), ENT_QUOTES, 'UTF-8'); ?>">About</a></li>
            <li><a href="<?php echo htmlspecialchars(sw_href('book-details'), ENT_QUOTES, 'UTF-8'); ?>">World in 2050</a></li>
            <li><a href="<?php echo htmlspecialchars(sw_href('impact'), ENT_QUOTES, 'UTF-8'); ?>">Impact</a></li>
            <li><a href="<?php echo htmlspecialchars(sw_href('presence'), ENT_QUOTES, 'UTF-8'); ?>">Global Presence</a></li>
            <li><a href="<?php echo htmlspecialchars(sw_href('contact-us'), ENT_QUOTES, 'UTF-8'); ?>">Contact</a></li>
          </ul>
        </div>
        <div>
          <div class="footer-col-title">Stay Updated</div>
          <p style="font-size:0.85rem;color:var(--text-muted);line-height:1.65;margin-bottom:20px;">Get Salman Waria'slatest thinking on AI, entrepreneurship, and the future.</p>
          <form aria-label="Newsletter signup" onsubmit="handleNewsletterSubmit(event)">
            <div style="display:flex;gap:8px;">
              <input type="email" name="email" placeholder="your@email.com" required aria-label="Email for newsletter"
                style="flex:1;padding:12px 16px;background:var(--surface-3);border:1px solid var(--border-dim);border-radius:8px;color:var(--text-primary);font-size:0.85rem;font-family:'Space Grotesk',sans-serif;outline:none;"
                onfocus="this.style.borderColor='rgba(201,168,76,0.4)'"
                onblur="this.style.borderColor='var(--border-dim)'"
              />
              <button type="submit"
                style="padding:12px 18px;background:var(--gold);color:#000;border:none;border-radius:8px;font-weight:700;font-size:0.8rem;cursor:none;transition:filter 0.2s ease;white-space:nowrap;"
                onmouseover="this.style.filter='brightness(1.15)'"
                onmouseout="this.style.filter='brightness(1)'"
              >Subscribe</button>
            </div>
          </form>
        </div>
      </div>

      <div class="footer-bottom">
        <span>© 2026 Salman Waria. All rights reserved.</span>
        <div style="display:flex;gap:24px;">
          <a href="#">Privacy Policy</a>
          <a href="#">Terms of Use</a>
          <a href="#">Cookie Policy</a>
        </div>
      </div>
    </footer>

  </div><!-- end site-wrapper -->

  <script>
    // ─── LOADER ────────────────────────────────────────────────
    (function() {
      const loader = document.getElementById('loader');
      const bar = document.getElementById('loader-bar');
      const count = document.getElementById('loader-count');
      const logo = document.getElementById('loader-logo');

      let progress = 0;
      gsap.to(logo, { opacity: 1, y: 0, duration: 0.6, ease: 'power3.out', delay: 0.1 });

      const interval = setInterval(() => {
        progress += Math.random() * 18;
        if (progress >= 100) {
          progress = 100;
          clearInterval(interval);
          setTimeout(() => {
            gsap.to(loader, {
              opacity: 0, duration: 0.7, ease: 'power2.in',
              onComplete: () => { loader.style.display = 'none'; initAnimations(); }
            });
          }, 300);
        }
        bar.style.width = progress + '%';
        count.textContent = Math.floor(progress) + '%';
      }, 80);
    })();

    // ─── PARTICLE CANVAS ───────────────────────────────────────
    (function() {
      const canvas = document.getElementById('particle-canvas');
      const ctx = canvas.getContext('2d');
      let w, h, particles = [], mouse = { x: null, y: null };
      const GOLD = 'rgba(201,168,76,';

      function resize() {
        w = canvas.width = window.innerWidth;
        h = canvas.height = window.innerHeight;
      }
      resize();
      window.addEventListener('resize', resize);

      class Particle {
        constructor() { this.reset(); }
        reset() {
          this.x = Math.random() * w;
          this.y = Math.random() * h;
          this.vx = (Math.random() - 0.5) * 0.4;
          this.vy = (Math.random() - 0.5) * 0.4;
          this.r = Math.random() * 1.5 + 0.3;
          this.alpha = Math.random() * 0.5 + 0.1;
          this.life = Math.random() * 200 + 100;
          this.age = 0;
        }
        update() {
          this.x += this.vx; this.y += this.vy; this.age++;
          if (mouse.x) {
            const dx = mouse.x - this.x, dy = mouse.y - this.y;
            const dist = Math.sqrt(dx*dx + dy*dy);
            if (dist < 120) { this.vx -= dx/dist * 0.03; this.vy -= dy/dist * 0.03; }
          }
          if (this.age > this.life || this.x < 0 || this.x > w || this.y < 0 || this.y > h) this.reset();
        }
        draw() {
          const fade = this.age < 30 ? this.age/30 : this.age > this.life-30 ? (this.life-this.age)/30 : 1;
          ctx.beginPath();
          ctx.arc(this.x, this.y, this.r, 0, Math.PI*2);
          ctx.fillStyle = GOLD + this.alpha * fade + ')';
          ctx.fill();
        }
      }

      for (let i = 0; i < 120; i++) particles.push(new Particle());

      function drawConnections() {
        for (let i = 0; i < particles.length; i++) {
          for (let j = i+1; j < particles.length; j++) {
            const dx = particles[i].x - particles[j].x;
            const dy = particles[i].y - particles[j].y;
            const d = Math.sqrt(dx*dx + dy*dy);
            if (d < 100) {
              ctx.beginPath();
              ctx.moveTo(particles[i].x, particles[i].y);
              ctx.lineTo(particles[j].x, particles[j].y);
              ctx.strokeStyle = GOLD + (0.06 * (1 - d/100)) + ')';
              ctx.lineWidth = 0.5;
              ctx.stroke();
            }
          }
        }
      }

      function loop() {
        ctx.clearRect(0, 0, w, h);
        drawConnections();
        particles.forEach(p => { p.update(); p.draw(); });
        requestAnimationFrame(loop);
      }
      loop();

      document.addEventListener('mousemove', e => { mouse.x = e.clientX; mouse.y = e.clientY; });
    })();

    // ─── CUSTOM CURSOR ─────────────────────────────────────────
    (function() {
      const dot = document.getElementById('cursor-dot');
      const ring = document.getElementById('cursor-ring');
      let mx = 0, my = 0, rx = 0, ry = 0;

      document.addEventListener('mousemove', e => { mx = e.clientX; my = e.clientY; });

      function animateCursor() {
        dot.style.left = mx + 'px';
        dot.style.top = my + 'px';
        rx += (mx - rx) * 0.12;
        ry += (my - ry) * 0.12;
        ring.style.left = rx + 'px';
        ring.style.top = ry + 'px';
        requestAnimationFrame(animateCursor);
      }
      animateCursor();
    })();

    // ─── SCROLL PROGRESS ───────────────────────────────────────
    window.addEventListener('scroll', () => {
      const sp = document.getElementById('scroll-progress');
      const scrolled = window.scrollY;
      const total = document.body.scrollHeight - window.innerHeight;
      sp.style.width = (scrolled / total * 100) + '%';
    });

    // ─── NAV SCROLL ────────────────────────────────────────────
    window.addEventListener('scroll', () => {
      document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 20);
    });

    // ─── MOBILE MENU ───────────────────────────────────────────
    document.getElementById('nav-toggle').addEventListener('click', function() {
      const menu = document.getElementById('mobile-menu');
      const isOpen = menu.classList.toggle('open');
      this.setAttribute('aria-expanded', isOpen);
    });
    document.getElementById('close-menu').addEventListener('click', closeMobileMenu);
    function closeMobileMenu() {
      document.getElementById('mobile-menu').classList.remove('open');
      document.getElementById('nav-toggle').setAttribute('aria-expanded', 'false');
    }

    // ─── MAIN ANIMATIONS ───────────────────────────────────────
    function initAnimations() {
      gsap.registerPlugin(ScrollTrigger, TextPlugin);

      // Home hero only (inner pages omit #hero)
      if (document.getElementById('hero-heading')) {
        const tl = gsap.timeline({ defaults: { ease: 'power4.out' } });

        tl.to('#hero-eyebrow', { opacity: 1, y: 0, duration: 0.7 }, 0.1)
          .to('.hero-headline .word', {
            y: 0, duration: 0.8, stagger: 0.08, ease: 'power4.out'
          }, 0.3)
          .to('#hero-sub', { opacity: 1, y: 0, duration: 0.6 }, 0.8)
          .to('#hero-badges', { opacity: 1, y: 0, duration: 0.6 }, 1.0)
          .to('#hero-ctas', { opacity: 1, y: 0, duration: 0.6 }, 1.15)
          .to('#hero-stats', { opacity: 1, y: 0, duration: 0.6 }, 1.3)
          .to('#hero-right', { opacity: 1, x: 0, duration: 1.0, ease: 'power3.out' }, 0.6);
      }

      // Generic scroll reveals
      gsap.utils.toArray('.reveal-up').forEach((el, i) => {
        gsap.fromTo(el,
          { opacity: 0, y: 40 },
          {
            opacity: 1, y: 0, duration: 0.9,
            ease: 'power3.out',
            delay: parseFloat(el.style.getPropertyValue('--delay') || 0) / 1000,
            scrollTrigger: { trigger: el, start: 'top 88%', toggleActions: 'play none none none' }
          }
        );
      });

      gsap.utils.toArray('.reveal-left').forEach(el => {
        gsap.fromTo(el,
          { opacity: 0, x: -50 },
          { opacity: 1, x: 0, duration: 1, ease: 'power3.out',
            scrollTrigger: { trigger: el, start: 'top 85%', toggleActions: 'play none none none' } }
        );
      });

      gsap.utils.toArray('.reveal-right').forEach(el => {
        gsap.fromTo(el,
          { opacity: 0, x: 50 },
          { opacity: 1, x: 0, duration: 1, ease: 'power3.out',
            scrollTrigger: { trigger: el, start: 'top 85%', toggleActions: 'play none none none' } }
        );
      });

      // Timeline items
      gsap.utils.toArray('.timeline-item').forEach((el, i) => {
        gsap.fromTo(el,
          { opacity: 0, x: -30 },
          { opacity: 1, x: 0, duration: 0.7, delay: i * 0.12,
            scrollTrigger: { trigger: el, start: 'top 90%', toggleActions: 'play none none none' } }
        );
      });

      // Skill bars
      gsap.utils.toArray('.skill-fill').forEach(el => {
        const targetWidth = el.getAttribute('data-width') + '%';
        gsap.to(el, {
          width: targetWidth, duration: 1.4, ease: 'power3.out',
          scrollTrigger: { trigger: el, start: 'top 90%', toggleActions: 'play none none none' }
        });
      });

      // Counter animation
      gsap.utils.toArray('.impact-number').forEach(el => {
        const target = parseFloat(el.getAttribute('data-target'));
        const suffix = el.getAttribute('data-suffix') || '';
        const isDecimal = target % 1 !== 0;
        scrollTrigger({
          trigger: el, start: 'top 85%',
          onEnter: () => {
            let count = { val: 0 };
            gsap.to(count, {
              val: target, duration: 2.2, ease: 'power2.out',
              onUpdate: () => {
                el.textContent = (isDecimal ? count.val.toFixed(1) : Math.floor(count.val)) + suffix;
              }
            });
          }
        });
      });

      function scrollTrigger(opts) {
        const obs = new IntersectionObserver((entries) => {
          entries.forEach(entry => {
            if (entry.isIntersecting) { opts.onEnter(); obs.disconnect(); }
          });
        }, { threshold: 0.2 });
        obs.observe(document.querySelector(opts.trigger.replace ? opts.trigger : opts.trigger));
      }

      // Counter using native IntersectionObserver for reliability
      document.querySelectorAll('.impact-number').forEach(el => {
        const target = parseFloat(el.getAttribute('data-target'));
        const suffix = el.getAttribute('data-suffix') || '';
        const isDecimal = target % 1 !== 0;
        const obs = new IntersectionObserver((entries) => {
          if (entries[0].isIntersecting) {
            let count = { val: 0 };
            gsap.to(count, {
              val: target, duration: 2.5, ease: 'power2.out',
              onUpdate: () => {
                el.innerHTML = '<span>' + (isDecimal ? count.val.toFixed(1) : Math.floor(count.val)) + suffix + '</span>';
              }
            });
            obs.disconnect();
          }
        }, { threshold: 0.3 });
        obs.observe(el);
      });

      function swScrollToSectionTarget() {
        const id = window.__SW_SCROLL_TO_ID;
        if (!id) return;
        const el = document.getElementById(id);
        if (!el) return;
        requestAnimationFrame(() => {
          const nav = document.getElementById('navbar');
          const off = (nav && nav.offsetHeight) ? nav.offsetHeight + 12 : 80;
          const y = el.getBoundingClientRect().top + window.scrollY - off;
          window.scrollTo({ top: Math.max(0, y), behavior: 'auto' });
          if (typeof ScrollTrigger !== 'undefined') ScrollTrigger.refresh();
        });
      }
      swScrollToSectionTarget();
    }

    // ─── CONTACT FORM (PHP + PHPMailer via contact-submit.php) ───
    const swalContactTheme = {
      background: '#0e0e10',
      color: '#e8e4dc',
      confirmButtonColor: '#b8962e',
      cancelButtonColor: '#3a3a42',
      iconColor: '#c9a84c',
      customClass: {
        popup: 'swal-contact-popup',
        title: 'swal-contact-title',
        confirmButton: 'swal-contact-btn',
        htmlContainer: 'swal-contact-body',
      },
    };

    function contactFormResetButton(btn) {
      btn.textContent = 'Send Message →';
      btn.disabled = false;
      btn.style.opacity = '1';
      btn.style.background = '';
    }

    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
      contactForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        const btn = document.getElementById('form-submit');
        const successEl = document.getElementById('form-success');
        const errEl = document.getElementById('form-error');
        const tokenField = this.querySelector('input[name="csrf_token"]');
        if (errEl) { errEl.style.display = 'none'; errEl.textContent = ''; }
        if (successEl) successEl.style.display = 'none';

        const fd = new FormData(this);
        const payload = Object.fromEntries(fd.entries());

        btn.textContent = 'Sending...';
        btn.disabled = true;
        btn.style.opacity = '0.7';

        try {
          const submitUrl = "<?= $base ?>contact-submit.php";
          const res = await fetch(submitUrl, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
            body: JSON.stringify(payload)
          });
          let data = {};
          try {
            data = await res.json();
          } catch (_) {
            data = {};
          }

          if (data.csrf_token && tokenField) {
            tokenField.value = data.csrf_token;
          }

          if (data.ok) {
            contactForm.reset();
            if (tokenField && data.csrf_token) tokenField.value = data.csrf_token;
            if (typeof Swal !== 'undefined' && Swal.fire) {
              await Swal.fire({
                ...swalContactTheme,
                icon: 'success',
                title: 'Message received',
                html: 'Thank you for reaching out. <strong>Salman&rsquo;s team</strong> will respond within <strong>24 hours</strong>.',
                confirmButtonText: 'Great',
                timer: 5000,
                timerProgressBar: true,
                showClass: { popup: 'swal2-show-animate' },
                hideClass: { popup: 'swal2-hide-animate' },
              });
            } else if (successEl) {
              successEl.style.display = 'block';
            }
            contactFormResetButton(btn);
          } else if (data.error) {
            if (typeof Swal !== 'undefined' && Swal.fire) {
              await Swal.fire({
                ...swalContactTheme,
                icon: 'error',
                title: 'Couldn&rsquo;t send',
                text: data.error,
                confirmButtonText: 'Try again',
              });
            } else if (errEl) {
              errEl.textContent = data.error;
              errEl.style.display = 'block';
            }
            contactFormResetButton(btn);
          } else {
            const msg = 'Something went wrong. Please try again.';
            if (typeof Swal !== 'undefined' && Swal.fire) {
              await Swal.fire({ ...swalContactTheme, icon: 'error', title: 'Error', text: msg, confirmButtonText: 'OK' });
            } else if (errEl) {
              errEl.textContent = msg;
              errEl.style.display = 'block';
            }
            contactFormResetButton(btn);
          }
        } catch (_) {
          const net = 'Network error. Please check your connection and try again.';
          if (typeof Swal !== 'undefined' && Swal.fire) {
            await Swal.fire({ ...swalContactTheme, icon: 'error', title: 'Connection problem', text: net, confirmButtonText: 'OK' });
          } else if (errEl) {
            errEl.textContent = net;
            errEl.style.display = 'block';
          }
          contactFormResetButton(btn);
        }
      });
    }

    async function handleNewsletterSubmit(e) {
      e.preventDefault();
      const form = e.target;
      const emailInput = form.querySelector('input[name="email"]');
      const btn = form.querySelector('button');
      if (!emailInput || !btn) return;

      const email = (emailInput.value || '').trim();
      if (!email) return;

      const originalText = btn.textContent;
      btn.textContent = 'Subscribing...';
      btn.disabled = true;
      btn.style.opacity = '0.8';

      try {
        const submitUrl = "<?= $base ?>newsletter-submit.php";
        const res = await fetch(submitUrl, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
          body: JSON.stringify({ email })
        });

        let data = {};
        try {
          data = await res.json();
        } catch (_) {
          data = {};
        }

        if (data.ok) {
          form.reset();
          btn.textContent = '✓ Subscribed!';
          btn.style.background = '#10b981';
          setTimeout(() => {
            btn.textContent = originalText || 'Subscribe';
            btn.style.background = 'var(--gold)';
            btn.style.opacity = '1';
            btn.disabled = false;
          }, 3000);
          return;
        }

        const err = data.error || 'Could not subscribe right now. Please try again.';
        if (typeof Swal !== 'undefined' && Swal.fire) {
          await Swal.fire({ ...swalContactTheme, icon: 'error', title: 'Subscription failed', text: err, confirmButtonText: 'OK' });
        } else {
          alert(err);
        }
      } catch (_) {
        const net = 'Network error. Please check your connection and try again.';
        if (typeof Swal !== 'undefined' && Swal.fire) {
          await Swal.fire({ ...swalContactTheme, icon: 'error', title: 'Connection problem', text: net, confirmButtonText: 'OK' });
        } else {
          alert(net);
        }
      }

      btn.textContent = originalText || 'Subscribe';
      btn.style.background = 'var(--gold)';
      btn.style.opacity = '1';
      btn.disabled = false;
    }

    // ─── MAGNETIC HOVER EFFECT ─────────────────────────────────
    document.querySelectorAll('.btn-primary, .btn-secondary, .nav-cta').forEach(el => {
      el.addEventListener('mousemove', function(e) {
        const rect = this.getBoundingClientRect();
        const x = e.clientX - rect.left - rect.width/2;
        const y = e.clientY - rect.top - rect.height/2;
        gsap.to(this, { x: x*0.25, y: y*0.25, duration: 0.4, ease: 'power2.out' });
      });
      el.addEventListener('mouseleave', function() {
        gsap.to(this, { x: 0, y: 0, duration: 0.6, ease: 'elastic.out(1, 0.5)' });
      });
    });

    // ─── CURSOR TRAIL ──────────────────────────────────────────
    document.querySelectorAll('a, button, .empire-card, .fti-link, .prod-card, .location-card, .surface-panel').forEach(el => {
      el.addEventListener('mouseenter', () => {
        document.getElementById('cursor-dot').style.transform = 'translate(-50%,-50%) scale(1.8)';
        document.getElementById('cursor-ring').style.transform = 'translate(-50%,-50%) scale(1.5)';
        document.getElementById('cursor-ring').style.borderColor = 'rgba(201,168,76,0.8)';
      });
      el.addEventListener('mouseleave', () => {
        document.getElementById('cursor-dot').style.transform = 'translate(-50%,-50%) scale(1)';
        document.getElementById('cursor-ring').style.transform = 'translate(-50%,-50%) scale(1)';
        document.getElementById('cursor-ring').style.borderColor = 'rgba(201,168,76,0.5)';
      });
    });

    // ─── PARALLAX HERO VISUAL ──────────────────────────────────
    window.addEventListener('scroll', () => {
      const scrollY = window.scrollY;
      const mesh = document.querySelector('.hero-bg-mesh');
      if (mesh) mesh.style.transform = `translateY(${scrollY * 0.25}px)`;
    });

    // ─── KEYBOARD NAV ──────────────────────────────────────────
    document.addEventListener('keydown', e => {
      if (e.key === 'Escape') closeMobileMenu();
    });
  </script>
</body>
</html>
