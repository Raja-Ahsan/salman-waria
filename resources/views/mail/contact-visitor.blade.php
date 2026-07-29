@php
  $subjectLine = ($payload['subject'] ?? '') !== '' ? $payload['subject'] : '(no subject)';
  $company = ($payload['company'] ?? '') !== '' ? $payload['company'] : '—';
@endphp

@include('mail.layout', [
  'preheader' => 'Thanks for contacting Salman Waria.',
  'title' => 'Thanks - we received your message',
  'subtitle' => 'Your request is in our inbox. The team will get back to you shortly.',
  'footerNote' => 'We appreciate your message',
  'contentHtml' => view('mail.partials.contact-visitor-body', [
    'payload' => $payload,
    'subjectLine' => $subjectLine,
    'company' => $company,
  ])->render(),
])
