<li class="font-bold">
    <a
        class="{{ routeIs('vehicles.transactions') ? 'active' : '' }}"
        href="{{ route('vehicles.transactions') }}">
        <x-icon.duotone.drawerFile />
        @lang('layouts.dashboard.sidebar.menu.requests')
    </a>
</li>
