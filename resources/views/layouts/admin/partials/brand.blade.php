<a href="{{ route('admin.dashboard') }}" class="sw-admin-brand {{ $compact ?? false ? 'sw-admin-brand--compact' : '' }}" aria-label="Salman Waria Admin Dashboard">
    <span class="sw-admin-brand__name">Salman <span class="sw-admin-brand__accent">Waria</span></span>
    @unless ($compact ?? false)
        <span class="sw-admin-brand__tag">Admin Panel</span>
    @endunless
</a>
