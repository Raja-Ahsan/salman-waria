@php
  $subjectLine = ($payload['subject'] ?? '') !== '' ? $payload['subject'] : '(no subject)';
  $company = ($payload['company'] ?? '') !== '' ? $payload['company'] : '—';
@endphp
Hi {{ $payload['name'] }},

Thank you for contacting Salman Waria. Below is a copy of what you submitted.

Name: {{ $payload['name'] }}
Company: {{ $company }}
Email: {{ $payload['email'] }}
Subject: {{ $subjectLine }}

Message:
{{ $payload['message'] }}

— Salman Waria
