<li class="font-bold">
    <a
        class="{{ routeIs('users') ? 'active' : '' }}"
        href="{{ route('users') }}">
        <x-icon.duotone.multipleManWoman />
        @lang('layouts.dashboard.sidebar.menu.users')
    </a>
</li>
