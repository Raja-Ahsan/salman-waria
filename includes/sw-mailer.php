<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;

require_once dirname(__DIR__) . '/vendor/autoload.php';

/**
 * @return array{0: array<string, mixed>, 1: array<string, mixed>}|false [mailCfg, smtp] or false
 */
function sw_mail_load_config()
{
    $configPath = __DIR__ . '/sw-config.php';
    if (!is_readable($configPath)) {
        return false;
    }
    $cfg = require $configPath;
    $mailCfg = $cfg['mail'];
    $smtp = $cfg['smtp'];

    if (($mailCfg['to_email'] ?? '') === '' || ($mailCfg['from_email'] ?? '') === '') {
        return false;
    }
    if (($smtp['username'] ?? '') === '' || ($smtp['password'] ?? '') === '') {
        return false;
    }

    return [$mailCfg, $smtp];
}

/**
 * @param array<string, mixed> $smtp
 * @param array<string, mixed> $mailCfg
 */
function sw_phpmailer_create(array $smtp, array $mailCfg): PHPMailer
{
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = $smtp['host'];
    $mail->Port = (int) $smtp['port'];
    $mail->SMTPAuth = true;
    $mail->Username = $smtp['username'];
    $mail->Password = $smtp['password'];

    $enc = $smtp['encryption'] ?? 'tls';
    if ($enc === 'ssl') {
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    } elseif ($enc === 'tls') {
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    } else {
        $mail->SMTPSecure = '';
    }

    $mail->CharSet = 'UTF-8';
    $mail->setFrom($mailCfg['from_email'], $mailCfg['from_name']);
    $fromLower = strtolower($mailCfg['from_email']);
    $smtpUser = strtolower((string) $smtp['username']);
    if ($smtpUser !== '' && $fromLower !== $smtpUser) {
        $mail->Sender = $smtp['username'];
    }

    return $mail;
}

/**
 * Escape dynamic text for safe HTML email rendering.
 */
function sw_mail_e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

/**
 * Build brand-styled HTML email layout compatible with major clients.
 */
function sw_mail_build_layout(string $preheader, string $title, string $subtitle, string $contentHtml, string $footerNote = ''): string
{
    $footer = $footerNote !== '' ? $footerNote : 'Salman Waria Team';
    return '<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>' . sw_mail_e($title) . '</title>
</head>
<body style="margin:0;padding:0;background-color:#0b0f19;font-family:Segoe UI,Roboto,Helvetica,Arial,sans-serif;color:#e5e7eb;">
  <div style="display:none;max-height:0;overflow:hidden;opacity:0;color:transparent;">' . sw_mail_e($preheader) . '</div>
  <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background:#0b0f19;padding:28px 12px;">
    <tr>
      <td align="center">
        <table role="presentation" cellpadding="0" cellspacing="0" width="640" style="max-width:640px;background:#121a2a;border:1px solid #243047;border-radius:18px;overflow:hidden;">
          <tr>
            <td style="padding:28px 28px 18px;background:linear-gradient(135deg,#151f33 0%,#0f1625 100%);border-bottom:1px solid #243047;">
              <div style="font-size:12px;letter-spacing:0.14em;text-transform:uppercase;color:#d4af37;font-weight:700;">Salman Waria</div>
              <h1 style="margin:10px 0 8px;font-size:26px;line-height:1.3;color:#ffffff;font-weight:700;">' . sw_mail_e($title) . '</h1>
              <p style="margin:0;color:#94a3b8;font-size:15px;line-height:1.6;">' . sw_mail_e($subtitle) . '</p>
            </td>
          </tr>
          <tr>
            <td style="padding:24px 28px;color:#cbd5e1;font-size:15px;line-height:1.75;">' . $contentHtml . '</td>
          </tr>
          <tr>
            <td style="padding:18px 28px;border-top:1px solid #243047;background:#0f1625;color:#7f8ea8;font-size:12px;line-height:1.6;">
              <div style="margin-bottom:4px;">' . sw_mail_e($footer) . '</div>
              <div>Sent from salmanwaria.com</div>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>';
}

/**
 * Render key-value details table for message metadata.
 *
 * @param array<string, string> $rows
 */
function sw_mail_build_meta_table(array $rows): string
{
    $html = '<table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;background:#0d1524;border:1px solid #243047;border-radius:12px;overflow:hidden;">';
    foreach ($rows as $label => $value) {
        $html .= '<tr>'
            . '<td style="padding:12px 14px;border-bottom:1px solid #1e2a3f;width:140px;color:#93a6c6;font-size:13px;vertical-align:top;">' . sw_mail_e($label) . '</td>'
            . '<td style="padding:12px 14px;border-bottom:1px solid #1e2a3f;color:#e2e8f0;font-size:14px;">' . $value . '</td>'
            . '</tr>';
    }
    $html .= '</table>';
    return $html;
}

/**
 * Team inbox only — this is the only mail that blocks the JSON response (fast UX).
 *
 * @param array{name: string, company: string|null, email: string, subject: string|null, message: string} $fields
 * @return array{0: bool, 1: string|null}
 */
function sw_send_contact_owner_notification(array $fields): array
{
    $loaded = sw_mail_load_config();
    if ($loaded === false) {
        return [false, 'Mail not configured — check `includes/sw-config.local.php`'];
    }
    [$mailCfg, $smtp] = $loaded;

    $subj = $fields['subject'] !== '' ? $fields['subject'] : '(no subject)';
    $company = $fields['company'] !== '' ? $fields['company'] : '—';

    $ownerBody = "New message from the Salman Waria website contact form.\n\n"
        . "Name: {$fields['name']}\n"
        . "Company: {$company}\n"
        . "Email: {$fields['email']}\n"
        . "Subject: {$subj}\n\n"
        . "Message:\n"
        . $fields['message'] . "\n";

    $ownerHtml = sw_mail_build_layout(
        'New contact form message received.',
        'New Contact Message',
        'A visitor has submitted the website contact form.',
        '<p style="margin:0 0 16px;">A new inquiry just arrived. Reply directly to continue the conversation.</p>'
        . sw_mail_build_meta_table([
            'Name' => sw_mail_e($fields['name']),
            'Company' => sw_mail_e($company),
            'Email' => '<a href="mailto:' . sw_mail_e($fields['email']) . '" style="color:#78b7ff;text-decoration:none;">' . sw_mail_e($fields['email']) . '</a>',
            'Subject' => sw_mail_e($subj),
        ])
        . '<div style="height:16px;"></div>'
        . '<div style="padding:16px;border-radius:12px;border:1px solid #243047;background:#0d1524;">'
        . '<div style="font-size:12px;letter-spacing:0.08em;text-transform:uppercase;color:#93a6c6;margin-bottom:8px;">Message</div>'
        . '<div style="white-space:pre-line;color:#e2e8f0;">' . sw_mail_e($fields['message']) . '</div>'
        . '</div>',
        'Internal Notification'
    );

    $mail = null;
    try {
        $mail = sw_phpmailer_create($smtp, $mailCfg);
        $mail->addAddress($mailCfg['to_email'], $mailCfg['to_name']);
        $mail->addReplyTo($fields['email'], $fields['name']);
        $mail->Subject = 'Contact — Salman Waria';
        $mail->isHTML(true);
        $mail->Body = $ownerHtml;
        $mail->AltBody = $ownerBody;
        $mail->send();

        return [true, null];
    } catch (PHPMailerException $e) {
        return [false, $e->getMessage()];
    } catch (\Throwable $e) {
        return [false, $e->getMessage()];
    } finally {
        if ($mail !== null) {
            $mail->smtpClose();
        }
    }
}

/**
 * Auto-reply to visitor. Call after HTTP response (e.g. register_shutdown_function) so submit feels fast.
 *
 * @param array{name: string, company: string|null, email: string, subject: string|null, message: string} $fields
 */
function sw_send_contact_visitor_confirmation(array $fields): void
{
    $loaded = sw_mail_load_config();
    if ($loaded === false) {
        return;
    }
    [$mailCfg, $smtp] = $loaded;

    $visitorLower = strtolower(trim($fields['email']));
    $ownerInboxLower = strtolower(trim((string) $mailCfg['to_email']));
    if ($visitorLower === $ownerInboxLower) {
        return;
    }

    $subj = $fields['subject'] !== '' ? $fields['subject'] : '(no subject)';
    $company = $fields['company'] !== '' ? $fields['company'] : '—';
    $visitorText = "Hi {$fields['name']},\n\n"
        . "Thank you for contacting Salman Waria. Below is a copy of what you submitted.\n\n"
        . "Name: {$fields['name']}\n"
        . "Company: {$company}\n"
        . "Email: {$fields['email']}\n"
        . "Subject: {$subj}\n\n"
        . "Message:\n"
        . $fields['message'] . "\n\n"
        . "— Salman Waria\n";
    $visitorHtml = sw_mail_build_layout(
        'Thanks for contacting Salman Waria.',
        'Thanks - we received your message',
        'Your request is in our inbox. The team will get back to you shortly.',
        '<p style="margin:0 0 16px;">Hi <strong style="color:#ffffff;">' . sw_mail_e($fields['name']) . '</strong>,</p>'
        . '<p style="margin:0 0 16px;">Thank you for contacting Salman Waria. Here is a copy of your submission:</p>'
        . sw_mail_build_meta_table([
            'Name' => sw_mail_e($fields['name']),
            'Company' => sw_mail_e($company),
            'Email' => sw_mail_e($fields['email']),
            'Subject' => sw_mail_e($subj),
        ])
        . '<div style="height:16px;"></div>'
        . '<div style="padding:16px;border-radius:12px;border:1px solid #243047;background:#0d1524;">'
        . '<div style="font-size:12px;letter-spacing:0.08em;text-transform:uppercase;color:#93a6c6;margin-bottom:8px;">Your Message</div>'
        . '<div style="white-space:pre-line;color:#e2e8f0;">' . sw_mail_e($fields['message']) . '</div>'
        . '</div>'
        . '<p style="margin:16px 0 0;color:#9fb0ca;">- Salman Waria</p>',
        'We appreciate your message'
    );

    $mail = null;
    try {
        $mail = sw_phpmailer_create($smtp, $mailCfg);
        $mail->addAddress($fields['email'], $fields['name']);
        $mail->addReplyTo($mailCfg['to_email'], $mailCfg['to_name']);
        $mail->Subject = 'Thanks — we received your message';
        $mail->isHTML(true);
        $mail->Body = $visitorHtml;
        $mail->AltBody = $visitorText;
        $mail->send();
    } catch (PHPMailerException | \Throwable $e) {
        error_log('[sw-mailer] visitor confirmation: ' . $e->getMessage());
    } finally {
        if ($mail !== null) {
            $mail->smtpClose();
        }
    }
}

/**
 * Synchronous: owner + visitor (slower; use contact-submit’s owner + shutdown for production).
 *
 * @param array{name: string, company: string|null, email: string, subject: string|null, message: string} $fields
 * @return array{0: bool, 1: string|null}
 */
function sw_send_contact_notification(array $fields): array
{
    [$ok, $err] = sw_send_contact_owner_notification($fields);
    if ($ok) {
        sw_send_contact_visitor_confirmation($fields);
    }

    return [$ok, $err];
}

/**
 * Send newsletter subscribe alert to admin inbox.
 *
 * @return array{0: bool, 1: string|null}
 */
function sw_send_newsletter_owner_notification(string $email, ?string $ip = null): array
{
    $loaded = sw_mail_load_config();
    if ($loaded === false) {
        return [false, 'Mail not configured — check `includes/sw-config.local.php`'];
    }
    [$mailCfg, $smtp] = $loaded;
    $ipText = $ip !== null && $ip !== '' ? $ip : 'Unknown';
    $text = "New newsletter subscription received.\n\n"
        . "Email: {$email}\n"
        . "IP: {$ipText}\n";
    $html = sw_mail_build_layout(
        'New newsletter subscriber.',
        'New Newsletter Subscriber',
        'A visitor subscribed from the website.',
        '<p style="margin:0 0 16px;">A new newsletter subscription was submitted.</p>'
        . sw_mail_build_meta_table([
            'Email' => '<a href="mailto:' . sw_mail_e($email) . '" style="color:#78b7ff;text-decoration:none;">' . sw_mail_e($email) . '</a>',
            'IP' => sw_mail_e($ipText),
        ]),
        'Internal Notification'
    );

    $mail = null;
    try {
        $mail = sw_phpmailer_create($smtp, $mailCfg);
        $mail->addAddress($mailCfg['to_email'], $mailCfg['to_name']);
        $mail->addReplyTo($mailCfg['to_email'], $mailCfg['to_name']);
        $mail->Subject = 'Newsletter — Salman Waria';
        $mail->isHTML(true);
        $mail->Body = $html;
        $mail->AltBody = $text;
        $mail->send();

        return [true, null];
    } catch (PHPMailerException | \Throwable $e) {
        return [false, $e->getMessage()];
    } finally {
        if ($mail !== null) {
            $mail->smtpClose();
        }
    }
}

/**
 * Send default confirmation mail to newsletter subscriber.
 *
 * @return array{0: bool, 1: string|null}
 */
function sw_send_newsletter_welcome(string $email): array
{
    $loaded = sw_mail_load_config();
    if ($loaded === false) {
        return [false, 'Mail not configured — check `includes/sw-config.local.php`'];
    }
    [$mailCfg, $smtp] = $loaded;
    $text = "Thanks for subscribing to Salman Waria updates.\n\n"
        . "You will receive new insights on AI, entrepreneurship, and the future.\n\n"
        . "If this was not you, you can ignore this email.\n\n"
        . "— Salman Waria Team\n";
    $html = sw_mail_build_layout(
        'Welcome to Salman Waria updates.',
        'You are subscribed',
        'Welcome to our newsletter community.',
        '<p style="margin:0 0 16px;">Thank you for subscribing with <strong style="color:#ffffff;">' . sw_mail_e($email) . '</strong>.</p>'
        . '<p style="margin:0 0 16px;">You will receive thoughtful insights on AI, entrepreneurship, and the future of intelligent systems.</p>'
        . '<table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;background:#0d1524;border:1px solid #243047;border-radius:12px;">'
        . '<tr><td style="padding:14px;color:#cbd5e1;font-size:14px;line-height:1.7;">If this subscription was not made by you, simply ignore this email and no further action is required.</td></tr>'
        . '</table>'
        . '<p style="margin:16px 0 0;color:#9fb0ca;">- Salman Waria Team</p>'
    );

    $mail = null;
    try {
        $mail = sw_phpmailer_create($smtp, $mailCfg);
        $mail->addAddress($email, $email);
        $mail->addReplyTo($mailCfg['to_email'], $mailCfg['to_name']);
        $mail->Subject = 'You are subscribed — Salman Waria';
        $mail->isHTML(true);
        $mail->Body = $html;
        $mail->AltBody = $text;
        $mail->send();

        return [true, null];
    } catch (PHPMailerException | \Throwable $e) {
        return [false, $e->getMessage()];
    } finally {
        if ($mail !== null) {
            $mail->smtpClose();
        }
    }
}
