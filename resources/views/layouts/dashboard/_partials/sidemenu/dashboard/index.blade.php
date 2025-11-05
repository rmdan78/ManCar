<li class="font-bold">
    <a
        class="{{ routeIs('dashboard') ? 'active' : '' }}"
        href="{{ route('dashboard') }}">
        <x-icon.duotone.birdHouse />
        @lang('layouts.dashboard.sidebar.menu.dashboard')
    </a>
</li>
