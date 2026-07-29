@include('mail.layout', [
  'preheader' => 'Welcome to Salman Waria updates.',
  'title' => 'You are subscribed',
  'subtitle' => 'Welcome to our newsletter community.',
  'contentHtml' => view('mail.partials.newsletter-welcome-body', [
    'email' => $email,
  ])->render(),
])
