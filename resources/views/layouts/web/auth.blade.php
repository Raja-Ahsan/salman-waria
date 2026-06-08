<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link rel="icon" href="{{ asset('favicon.png') }}" sizes="any" />
  <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('favicon.png') }}" />

  <title>@yield('meta_title', 'Sign In — Salman Waria')</title>
  <meta name="description" content="@yield('meta_description', 'Sign in to the Salman Waria admin dashboard.')" />
  <meta name="robots" content="noindex, nofollow" />

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css" crossorigin="anonymous" />

  <style>
    body.auth-body {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 24px;
      cursor: auto;
      background: #020209;
    }

    .auth-page-wrap {
      position: relative;
      width: 100%;
      max-width: 460px;
      z-index: 1;
    }

    .auth-page-bg {
      position: fixed;
      inset: 0;
      pointer-events: none;
      background:
        radial-gradient(ellipse 70% 50% at 50% 0%, rgba(201, 168, 76, 0.1) 0%, transparent 55%),
        radial-gradient(ellipse 50% 40% at 90% 90%, rgba(124, 58, 237, 0.07) 0%, transparent 50%),
        radial-gradient(ellipse 40% 35% at 5% 70%, rgba(0, 212, 255, 0.05) 0%, transparent 45%);
    }

    .auth-brand {
      text-align: center;
      margin-bottom: 28px;
    }

    .auth-brand a {
      font-family: 'Playfair Display', serif;
      font-size: clamp(1.5rem, 4vw, 1.85rem);
      font-weight: 700;
      color: var(--text-primary);
      text-decoration: none;
      letter-spacing: -0.02em;
    }

    .auth-brand a span {
      color: var(--gold);
    }

    .auth-brand-tag {
      margin-top: 8px;
      font-size: 0.78rem;
      letter-spacing: 0.14em;
      text-transform: uppercase;
      color: var(--text-muted);
    }
  </style>

  @stack('styles')
</head>
<body class="auth-body">
  <div class="auth-page-bg" aria-hidden="true"></div>

  <div class="auth-page-wrap">
    <div class="auth-brand">
      <a href="{{ url('/') }}">Salman <span>Waria</span></a>
      <p class="auth-brand-tag">Admin sign in</p>
    </div>

    @yield('content')
  </div>
</body>
</html>
