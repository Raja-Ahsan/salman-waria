<?php

/**
 * POST handler for newsletter subscription (JSON or FormData). Expects: email.
 */
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'Method not allowed.']);
    exit;
}

$raw = file_get_contents('php://input');
$data = [];
if ($raw !== false && $raw !== '') {
    $data = json_decode($raw, true);
    if (!is_array($data)) {
        $data = [];
    }
}
if (empty($data) && !empty($_POST)) {
    $data = $_POST;
}

$email = isset($data['email']) ? trim((string) $data['email']) : '';
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 254) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Please enter a valid email address.']);
    exit;
}

$ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? null;
if (is_string($ip) && str_contains($ip, ',')) {
    $ip = trim(explode(',', $ip)[0]);
}

require_once __DIR__ . '/includes/sw-mailer.php';
[$ownerOk, $ownerErr] = sw_send_newsletter_owner_notification($email, is_string($ip) ? $ip : null);
if ($ownerOk) {
    $subscriberEmail = $email;
    register_shutdown_function(static function () use ($subscriberEmail): void {
        [$ok, $err] = sw_send_newsletter_welcome($subscriberEmail);
        if (!$ok && $err !== null) {
            error_log('[newsletter-submit] SMTP welcome: ' . $err);
        }
    });
}

if ($ownerOk) {
    echo json_encode(['ok' => true, 'message' => 'Subscribed successfully.']);
    exit;
}

if ($ownerErr !== null) {
    error_log('[newsletter-submit] SMTP owner: ' . $ownerErr);
}
http_response_code(502);
echo json_encode([
    'ok'    => false,
    'error' => 'Could not send your subscription email right now. Please try again later.',
]);
