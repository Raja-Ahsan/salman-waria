<p style="margin:0 0 16px;">A new newsletter subscription was submitted.</p>
@include('mail.partials.meta-table', [
  'rows' => [
    'Email' => '<a href="mailto:' . e($email) . '" style="color:#78b7ff;text-decoration:none;">' . e($email) . '</a>',
    'IP' => e($ipText),
  ],
])
