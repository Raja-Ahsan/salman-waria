@php
  $subjectLine = ($payload['subject'] ?? '') !== '' ? $payload['subject'] : '(no subject)';
  $company = ($payload['company'] ?? '') !== '' ? $payload['company'] : '—';
@endphp

@include('mail.layout', [
  'preheader' => 'New contact form message received.',
  'title' => 'New Contact Message',
  'subtitle' => 'A visitor has submitted the website contact form.',
  'footerNote' => 'Internal Notification',
  'contentHtml' => view('mail.partials.contact-owner-body', [
    'payload' => $payload,
    'subjectLine' => $subjectLine,
    'company' => $company,
  ])->render(),
])
