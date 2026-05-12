<?php

/**
 * POST handler for contact form (JSON). Expects: name, email, message, optional company, subject, csrf_token.
 */
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'Method not allowed.']);
    exit;
}

require_once __DIR__ . '/includes/sw-session.php';

$raw = file_get_contents('php://input');
$data = [];
if ($raw !== false && $raw !== '') {
    $data = json_decode($raw, true);
    if (!is_array($data)) {
        $data = [];
    }
}
// Merge POST (FormData) if client sent multipart
if (empty($data) && !empty($_POST)) {
    $data = $_POST;
}

$token = isset($data['csrf_token']) ? (string) $data['csrf_token'] : '';
if ($token === '' || !hash_equals($_SESSION['sw_csrf_contact'] ?? '', $token)) {
    http_response_code(403);
    echo json_encode(['ok' => false, 'error' => 'Invalid security token. Please refresh the page and try again.']);
    exit;
}

$name = isset($data['name']) ? trim((string) $data['name']) : '';
$email = isset($data['email']) ? trim((string) $data['email']) : '';
$company = isset($data['company']) ? trim((string) $data['company']) : '';
$subject = isset($data['subject']) ? trim((string) $data['subject']) : '';
$message = isset($data['message']) ? trim((string) $data['message']) : '';

if ($name === '' || mb_strlen($name) > 160) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Please enter a valid name.']);
    exit;
}
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Please enter a valid email address.']);
    exit;
}
if ($message === '' || mb_strlen($message) > 10000) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Please enter a message (max 10000 characters).']);
    exit;
}
if (mb_strlen($company) > 200) {
    $company = mb_substr($company, 0, 200);
}
if (mb_strlen($subject) > 300) {
    $subject = mb_substr($subject, 0, 300);
}

$fields = [
    'name'    => $name,
    'company' => $company,
    'email'   => $email,
    'subject' => $subject,
    'message' => $message,
];

require_once __DIR__ . '/includes/sw-mailer.php';
[$mailOk, $mailErr] = sw_send_contact_owner_notification($fields);
if ($mailOk) {
    // Visitor copy runs after JSON is sent — user sees success ~1 SMTP round faster
    $visitorFields = $fields;
    register_shutdown_function(static function () use ($visitorFields): void {
        sw_send_contact_visitor_confirmation($visitorFields);
    });
}

// New token for next submit
$_SESSION['sw_csrf_contact'] = bin2hex(random_bytes(32));

if ($mailOk) {
    echo json_encode(['ok' => true, 'csrf_token' => $_SESSION['sw_csrf_contact']]);
    exit;
}

if ($mailErr !== null) {
    error_log('[contact-submit] SMTP: ' . $mailErr);
}
http_response_code(502);
echo json_encode([
    'ok'         => false,
    'error'      => 'Could not deliver your message email right now. Please try again later.',
    'csrf_token' => $_SESSION['sw_csrf_contact'],
]);
