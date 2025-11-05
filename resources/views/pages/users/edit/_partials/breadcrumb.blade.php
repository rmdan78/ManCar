<div
    class="px-container breadcrumbs sticky top-0 z-30 border-b border-b-base-300 text-sm backdrop-blur-xl dark:border-neutral">
    <ul>
        <li>
            <a
                href="{{ route('dashboard') }}"
                class="text-base-content">
                @lang('pages.dashboard.title')
            </a>
        </li>
        <li>
            <a
                href="{{ route('users') }}"
                class="text-base-content">
                @lang('pages.users.title')
            </a>
        </li>
        <li>
            @lang('pages.users.edit.title')
        </li>
    </ul>
</div>
