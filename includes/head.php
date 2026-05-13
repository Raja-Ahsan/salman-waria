<?php
if (!isset($sw_base)) {
  $sw_base = 'assests';
}
$sw_h_base = htmlspecialchars($sw_base, ENT_QUOTES, 'UTF-8');
?><!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="robots" content="noindex, nofollow" />
  <title><?php echo isset($sw_page_title) ? htmlspecialchars($sw_page_title, ENT_QUOTES, 'UTF-8') : 'Salman Waria — Tech Visionary, Author & AI Pioneer'; ?></title>
  <meta name="description" content="<?php echo isset($sw_page_description) ? htmlspecialchars($sw_page_description, ENT_QUOTES, 'UTF-8') : 'Salman Waria — Serial entrepreneur, AI architect, Amazon #1 bestselling author of World in 2050, founder of Freedom.AI, Waria Bot, and visionary behind the future of intelligent technology.'; ?>" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo $sw_h_base; ?>/css/style.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" crossorigin="anonymous" />

  <!-- GSAP + ScrollTrigger -->
  <script src="https://cdn.jsdelivr.net/npm/gsap@3.15/dist/gsap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/gsap@3.15/dist/ScrollTrigger.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/gsap@3.15/dist/TextPlugin.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" crossorigin="anonymous"></script>

  <?php if (!empty($sw_is_home)) : ?>
  <script>
  (function () {
    window.__SW_SCROLL_TO_ID = <?php echo json_encode($sw_scroll_to_id ?? null); ?>;
    if (window.__SW_SCROLL_TO_ID) return;
    var raw = (location.hash || '').replace(/^#/, '');
    if (!raw) return;
    var allowed = {
      companies: 1, 'ai-products': 1, impact: 1, presence: 1, 'finest-tech': 1,
      vision: 1, hero: 1, contact: 1, book: 1, 'main-content': 1
    };
    if (!allowed[raw]) return;
    var slug = raw === 'book' ? 'featured-book' : raw;
    window.__SW_SCROLL_TO_ID = raw === 'book' ? 'book' : raw;
    var parts = location.pathname.split('/').filter(function (s) { return s.length; });
    var last = parts[parts.length - 1];
    if (last && (/\.php$/i.test(last))) {
      parts[parts.length - 1] = slug;
    } else {
      parts.push(slug);
    }
    try {
      var u = new URL(location.href);
      u.pathname = '/' + parts.join('/');
      u.hash = '';
      history.replaceState(null, '', u.pathname + u.search);
    } catch (e) {}
  })();
  </script>
  <?php endif; ?>

</head>
