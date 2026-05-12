<?php
$sw_base = 'assests';

$ventures = [
  'american-digital-agency' => [
    'title' => 'American Digital Agency',
    'lead' => 'Connecting brands with the audiences who convert, not just browse.',
    'body' => 'Built for brands that need acquisition and retention to work in sync — creative, media, and analytics aligned so every touchpoint moves people closer to action.',
    'external_url' => '',
  ],
  'logic-works' => [
    'title' => 'Logic Works',
    'lead' => 'Technology and storytelling fused to produce digital outcomes that endure.',
    'body' => 'Product discipline meets narrative craft: systems, content, and engineering designed together so digital experiences stay fast, coherent, and commercially defensible over time.',
    'external_url' => '',
  ],
  'logic-works-dubai' => [
    'title' => 'Logic Works (Dubai)',
    'lead' => 'Moving at the speed of the world\'s most competitive technology market.',
    'body' => 'Focused on the Gulf\'s high-velocity landscape — where execution windows are short, expectations are global, and technology-led storytelling has to perform from day one.',
    'external_url' => '',
  ],
  'logic-media-house' => [
    'title' => 'Logic Media House',
    'lead' => 'Where cinematic craft meets modern technology to build brands through story.',
    'body' => 'Film-grade production values paired with distribution-native formats — so brand stories feel premium everywhere they are seen, from social to long-form.',
    'external_url' => '',
  ],
];

$raw = isset($_GET['slug']) ? (string) $_GET['slug'] : '';
$slug = preg_replace('/[^a-z0-9-]+/', '', strtolower($raw));

if ($slug === '' || !isset($ventures[$slug])) {
  header('Location: index.php#finest-tech', true, 302);
  exit;
}

$v = $ventures[$slug];
$sw_page_title = $v['title'] . ' — Salman Waria';
$sw_page_description = $v['lead'];

require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/header.php';
?>

      <section class="page-section bg-surface-1" aria-labelledby="venture-heading">
        <div class="container">
          <nav aria-label="Breadcrumb" style="margin-bottom: 24px;">
            <a href="index.php#finest-tech" class="venture-back-link">← Finest Tech Innovator</a>
          </nav>
          <div class="page-block-header" style="margin-bottom: 28px;">
            <h1 class="section-title" id="venture-heading"><?php echo htmlspecialchars($v['title'], ENT_QUOTES, 'UTF-8'); ?></h1>
          </div>
          <p class="text-prose" style="font-size: 1.15rem; color: var(--text-primary); margin-bottom: 20px;">
            <?php echo htmlspecialchars($v['lead'], ENT_QUOTES, 'UTF-8'); ?>
          </p>
          <p class="text-prose" style="max-width: 720px;">
            <?php echo htmlspecialchars($v['body'], ENT_QUOTES, 'UTF-8'); ?>
          </p>
          <?php if (!empty($v['external_url'])): ?>
            <p style="margin-top: 32px;">
              <a href="<?php echo htmlspecialchars($v['external_url'], ENT_QUOTES, 'UTF-8'); ?>" class="btn-primary" target="_blank" rel="noopener noreferrer">Visit website</a>
            </p>
          <?php endif; ?>
        </div>
      </section>

<?php
require __DIR__ . '/includes/footer.php';
