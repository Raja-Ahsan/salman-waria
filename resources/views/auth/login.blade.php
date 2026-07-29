@extends('layouts.web.auth')

@section('meta_title', 'Sign In — Salman Waria')
@section('meta_description', 'Secure sign in to the Salman Waria admin dashboard.')

@push('styles')
<style>
  .auth-panel {
    padding: clamp(28px, 5vw, 40px);
    box-shadow: 0 24px 80px rgba(0, 0, 0, 0.4);
  }

  .auth-panel-icon {
    width: 52px;
    height: 52px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--gold-dim);
    border: 1px solid var(--border);
    color: var(--gold);
    font-size: 1.25rem;
    margin-bottom: 20px;
  }

  .auth-panel-heading {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.35rem, 3vw, 1.65rem);
    color: var(--text-primary);
    margin-bottom: 8px;
    line-height: 1.2;
  }

  .auth-panel-lead {
    font-size: 0.92rem;
    color: var(--text-secondary);
    line-height: 1.6;
    margin-bottom: 24px;
  }

  .auth-form {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }

  .auth-alert {
    padding: 14px 16px;
    border-radius: 12px;
    font-size: 0.88rem;
    line-height: 1.5;
    margin-bottom: 4px;
  }

  .auth-alert--success {
    background: rgba(34, 197, 94, 0.1);
    border: 1px solid rgba(34, 197, 94, 0.25);
    color: #86efac;
  }

  .auth-alert--error {
    background: rgba(239, 68, 68, 0.08);
    border: 1px solid rgba(239, 68, 68, 0.22);
    color: #fca5a5;
  }

  .auth-alert--error ul {
    list-style: none;
    margin: 0;
    padding: 0;
  }

  .auth-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    flex-wrap: wrap;
  }

  .auth-remember {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    user-select: none;
  }

  .auth-remember input {
    width: 18px;
    height: 18px;
    accent-color: var(--gold);
    cursor: pointer;
  }

  .auth-remember span {
    font-size: 0.88rem;
    color: var(--text-secondary);
  }

  .auth-link {
    font-size: 0.88rem;
    color: var(--gold);
    text-decoration: none;
    border-bottom: 1px solid rgba(201, 168, 76, 0.35);
    transition: color 0.2s ease, border-color 0.2s ease;
  }

  .auth-link:hover {
    color: var(--gold-light);
    border-bottom-color: var(--gold);
  }

  .auth-submit {
    width: 100%;
    margin-top: 4px;
    cursor: pointer;
  }

  .auth-back {
    margin-top: 24px;
    padding-top: 24px;
    border-top: 1px solid var(--border-dim);
    text-align: center;
  }

  .auth-back a {
    font-size: 0.88rem;
    color: var(--text-muted);
    text-decoration: none;
    transition: color 0.2s ease;
  }

  .auth-back a:hover {
    color: var(--text-primary);
  }
</style>
@endpush

@section('content')
  <div class="surface-panel auth-panel">
    <div class="auth-panel-icon" aria-hidden="true">
      <i class="fa-solid fa-lock"></i>
    </div>

    <h1 class="auth-panel-heading">Welcome back</h1>
    <p class="auth-panel-lead">Sign in with your admin credentials to continue.</p>

    @if (session('status'))
      <div class="auth-alert auth-alert--success" role="status">
        {{ session('status') }}
      </div>
    @endif

    @if ($errors->any())
      <div class="auth-alert auth-alert--error" role="alert">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="auth-form">
      @csrf

      <div class="form-group">
        <label for="email">Email address</label>
        <input
          id="email"
          class="form-input"
          type="email"
          name="email"
          value="{{ old('email') }}"
          placeholder="you@example.com"
          required
          autofocus
          autocomplete="username"
        />
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input
          id="password"
          class="form-input"
          type="password"
          name="password"
          placeholder="••••••••"
          required
          autocomplete="current-password"
        />
      </div>

      <div class="auth-row">
        <label for="remember_me" class="auth-remember">
          <input id="remember_me" type="checkbox" name="remember" />
          <span>{{ __('Remember me') }}</span>
        </label>

        @if (Route::has('password.request'))
          <a class="auth-link" href="{{ route('password.request') }}">
            {{ __('Forgot your password?') }}
          </a>
        @endif
      </div>

      <button type="submit" class="form-submit auth-submit">
        {{ __('Log in') }}
      </button>
    </form>

    <div class="auth-back">
      <a href="{{ url('/') }}">← Back to website</a>
    </div>
  </div>
@endsection
