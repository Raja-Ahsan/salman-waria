@php
  $subjectLine = ($payload['subject'] ?? '') !== '' ? $payload['subject'] : '(no subject)';
  $company = ($payload['company'] ?? '') !== '' ? $payload['company'] : '—';
@endphp
New message from the Salman Waria website contact form.

Name: {{ $payload['name'] }}
Company: {{ $company }}
Email: {{ $payload['email'] }}
Subject: {{ $subjectLine }}

Message:
{{ $payload['message'] }}
