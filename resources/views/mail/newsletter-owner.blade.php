@include('mail.layout', [
  'preheader' => 'New newsletter subscriber.',
  'title' => 'New Newsletter Subscriber',
  'subtitle' => 'A visitor subscribed from the website.',
  'footerNote' => 'Internal Notification',
  'contentHtml' => view('mail.partials.newsletter-owner-body', [
    'email' => $email,
    'ipText' => $ipText,
  ])->render(),
])
