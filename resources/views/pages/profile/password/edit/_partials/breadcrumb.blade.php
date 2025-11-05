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
                href="{{ route('profile.edit') }}"
                class="text-base-content">
                @lang('pages.profile.title')
            </a>
        </li>
        <li>
            <a
                href="{{ route('profile.edit') }}"
                class="text-base-content">
                @lang('pages.profile.password.title')
            </a>
        </li>
        <li>
            @lang('pages.profile.password.edit.title')
        </li>
    </ul>
</div>
