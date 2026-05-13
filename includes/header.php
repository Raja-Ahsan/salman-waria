<body>
  <a href="#main-content" class="skip-link">Skip to main content</a>

  <!-- Custom Cursor -->
  <div id="cursor-dot" aria-hidden="true"></div>
  <div id="cursor-ring" aria-hidden="true"></div>

  <!-- Scroll Progress -->
  <div id="scroll-progress" aria-hidden="true"></div>

  <!-- Loader -->
  <div id="loader" role="status" aria-label="Loading">
    <div class="loader-logo" id="loader-logo">Salman Waria</div>
    <div class="loader-bar-wrap">
      <div class="loader-bar" id="loader-bar"></div>
    </div>
    <div class="loader-count" id="loader-count">0%</div>
  </div>

  <!-- Particle Canvas -->
  <canvas id="particle-canvas" aria-hidden="true"></canvas>

  <!-- Noise Overlay -->
  <div class="noise-overlay" aria-hidden="true"></div>

  <div class="site-wrapper">

    <!-- Hamburger → X when menu open (aria-expanded set in footer JS; no matching rules in main CSS) -->
    <style>
      #nav-toggle {
        position: relative;
        justify-content: center;
      }
      #nav-toggle[aria-expanded="true"] span:nth-child(1) {
        transform: translateY(7px) rotate(45deg);
      }
      #nav-toggle[aria-expanded="true"] span:nth-child(2) {
        opacity: 0;
        transform: scaleX(0);
      }
      #nav-toggle[aria-expanded="true"] span:nth-child(3) {
        transform: translateY(-7px) rotate(-45deg);
      }
    </style>

    <!-- ── NAVIGATION ─────────────────────────────────────── -->
    <nav id="navbar" role="navigation" aria-label="Main navigation">
      <a href="<?php echo htmlspecialchars(sw_href(''), ENT_QUOTES, 'UTF-8'); ?>" class="nav-logo" aria-label="Salman Waria home">Salman <span>Waria</span></a>
      <ul class="nav-links">
      <li><a href="<?php echo htmlspecialchars(sw_href(''), ENT_QUOTES, 'UTF-8'); ?>">Home</a></li>
        <li><a href="<?php echo htmlspecialchars(sw_href('about'), ENT_QUOTES, 'UTF-8'); ?>">About</a></li>
        <li><a href="<?php echo htmlspecialchars(sw_href('companies'), ENT_QUOTES, 'UTF-8'); ?>">Empire</a></li>
        <li><a href="<?php echo htmlspecialchars(sw_href('book'), ENT_QUOTES, 'UTF-8'); ?>">Book</a></li>
        <li><a href="<?php echo htmlspecialchars(sw_href('ai-products'), ENT_QUOTES, 'UTF-8'); ?>">AI Ventures</a></li>
        <li><a href="<?php echo htmlspecialchars(sw_href('impact'), ENT_QUOTES, 'UTF-8'); ?>">Impact</a></li>
        <li><a href="<?php echo htmlspecialchars(sw_href('contact-us'), ENT_QUOTES, 'UTF-8'); ?>">Contact</a></li>
      </ul>
      <a href="<?php echo htmlspecialchars(sw_href('contact-us'), ENT_QUOTES, 'UTF-8'); ?>" class="nav-cta">Connect</a>
      <button class="nav-toggle" id="nav-toggle" aria-label="Open navigation menu" aria-expanded="false">
        <span></span><span></span><span></span>
      </button>
    </nav>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobile-menu" role="dialog" aria-modal="true" aria-label="Mobile navigation">
      <button class="close-btn" id="close-menu" aria-label="Close navigation">✕</button>
      <a href="<?php echo htmlspecialchars(sw_href(''), ENT_QUOTES, 'UTF-8'); ?>" onclick="closeMobileMenu()">Home</a>
      <a href="<?php echo htmlspecialchars(sw_href('about'), ENT_QUOTES, 'UTF-8'); ?>" onclick="closeMobileMenu()">About</a>
      <a href="<?php echo htmlspecialchars(sw_href('companies'), ENT_QUOTES, 'UTF-8'); ?>" onclick="closeMobileMenu()">Empire</a>
      <a href="<?php echo htmlspecialchars(sw_href('book'), ENT_QUOTES, 'UTF-8'); ?>" onclick="closeMobileMenu()">Book</a>
      <a href="<?php echo htmlspecialchars(sw_href('ai-products'), ENT_QUOTES, 'UTF-8'); ?>" onclick="closeMobileMenu()">AI Ventures</a>
      <a href="<?php echo htmlspecialchars(sw_href('impact'), ENT_QUOTES, 'UTF-8'); ?>" onclick="closeMobileMenu()">Impact</a>
      <a href="<?php echo htmlspecialchars(sw_href('contact-us'), ENT_QUOTES, 'UTF-8'); ?>" onclick="closeMobileMenu()">Contact</a>
    </div>

    <main id="main-content">

