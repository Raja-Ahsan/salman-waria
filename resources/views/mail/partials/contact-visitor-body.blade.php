<p style="margin:0 0 16px;">Hi <strong style="color:#ffffff;">{{ $payload['name'] }}</strong>,</p>
<p style="margin:0 0 16px;">Thank you for contacting Salman Waria. Here is a copy of your submission:</p>
@include('mail.partials.meta-table', [
  'rows' => [
    'Name' => e($payload['name']),
    'Company' => e($company),
    'Email' => e($payload['email']),
    'Subject' => e($subjectLine),
  ],
])
<div style="height:16px;"></div>
<div style="padding:16px;border-radius:12px;border:1px solid #243047;background:#0d1524;">
  <div style="font-size:12px;letter-spacing:0.08em;text-transform:uppercase;color:#93a6c6;margin-bottom:8px;">Your Message</div>
  <div style="white-space:pre-line;color:#e2e8f0;">{{ $payload['message'] }}</div>
</div>
<p style="margin:16px 0 0;color:#9fb0ca;">- Salman Waria</p>
