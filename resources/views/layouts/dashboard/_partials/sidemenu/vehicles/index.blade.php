<li class="font-bold">
    <a
        class="{{ routeIs('vehicles') ? 'active' : '' }}"
        href="{{ route('vehicles') }}">
        <x-icon.duotone.carRetro />
        @lang('layouts.dashboard.sidebar.menu.vehicles')
    </a>
</li>
