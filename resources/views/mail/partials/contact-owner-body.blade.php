<p style="margin:0 0 16px;">A new inquiry just arrived. Reply directly to continue the conversation.</p>
@include('mail.partials.meta-table', [
  'rows' => [
    'Name' => e($payload['name']),
    'Company' => e($company),
    'Email' => '<a href="mailto:' . e($payload['email']) . '" style="color:#78b7ff;text-decoration:none;">' . e($payload['email']) . '</a>',
    'Subject' => e($subjectLine),
  ],
])
<div style="height:16px;"></div>
<div style="padding:16px;border-radius:12px;border:1px solid #243047;background:#0d1524;">
  <div style="font-size:12px;letter-spacing:0.08em;text-transform:uppercase;color:#93a6c6;margin-bottom:8px;">Message</div>
  <div style="white-space:pre-line;color:#e2e8f0;">{{ $payload['message'] }}</div>
</div>
