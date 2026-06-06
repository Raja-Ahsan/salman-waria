@extends('layouts.web.master')

@section('meta_title', 'Contact — Salman Waria')
@section('meta_description', 'Get in touch with Salman Waria for partnerships, speaking, media, and AI ventures — Silicon Valley & Dubai.')
@section('meta_keywords', 'contact Salman Waria, partnerships, speaking inquiries, media contact, AI ventures, Silicon Valley, Dubai, hello@salmanwaria.com')
@section('canonical_url', route('contact-us'))

@section('content')

      <!-- ── PAGE HERO ─────────────────────────────────────── -->
      <section class="page-hero" aria-labelledby="contact-hero-heading">
        <div class="page-hero-bg" aria-hidden="true"></div>
        <div class="page-hero-inner reveal-up">
          <p class="section-eyebrow section-eyebrow--center">Get in touch</p>
          <h1 class="section-title page-hero-title text-center" id="contact-hero-heading">
            Let's Build<br><span class="gold-text">Something Meaningful</span>
          </h1>
          <p class="section-sub section-sub--center page-hero-sub text-center">
            Partnerships, speaking, media, and enterprise AI — the same team reads every message.
          </p>
        </div>
      </section>

      <!-- ── CONTACT (from home layout) ────────────────────── -->
      <section id="contact" class="contact-page-section" aria-labelledby="contact-heading">
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
              <p class="section-sub">Whether you're a founder seeking a strategic partner, a publisher interested in speaking engagements, or an enterprise exploring AI solutions — Salman's team is ready.</p>

              <div class="contact-info-items">
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
                    <div class="contact-info-value"><a href="mailto:hello@salmanwaria.com">hello@salmanwaria.com</a></div>
                  </div>
                </div>
                <div class="contact-info-item">
                  <div class="contact-info-icon" aria-hidden="true">💼</div>
                  <div>
                    <div class="contact-info-label">Business Development</div>
                    <div class="contact-info-value"><a href="mailto:ventures@salmanwaria.com">ventures@salmanwaria.com</a></div>
                  </div>
                </div>
                <div class="contact-info-item">
                  <div class="contact-info-icon" aria-hidden="true">📖</div>
                  <div>
                    <div class="contact-info-label">Speaking &amp; Media</div>
                    <div class="contact-info-value"><a href="mailto:media@salmanwaria.com">media@salmanwaria.com</a></div>
                  </div>
                </div>
              </div>
            </div>

            <div class="reveal-right">
              <form class="contact-form" id="contact-form" novalidate aria-labelledby="contact-form-label" action="#" method="post">
                @csrf
                <input type="hidden" name="csrf_token" value="{{ csrf_token() }}" />
                <h3 id="contact-form-label" class="contact-form-heading">Send a Message</h3>
                <p class="contact-form-lead">Response within 24 hours guaranteed.</p>

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

                <div id="form-error" class="contact-form-error" style="display:none;padding:16px;background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.35);border-radius:12px;color:#f87171;font-size:0.9rem;text-align:center;" role="alert"></div>
                <div id="form-success" class="contact-form-success" style="display:none;padding:16px;background:rgba(16,185,129,0.1);border:1px solid rgba(16,185,129,0.3);border-radius:12px;color:#34d399;font-size:0.9rem;text-align:center;" role="alert">
                  ✓ Message sent! The team will respond within 24 hours.
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>

@endsection
