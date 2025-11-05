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
                href="{{ route('vehicles.transactions') }}"
                class="text-base-content">
                @lang('pages.requests.title')
            </a>
        </li>
        <li>@lang('pages.requests.edit.title')</li>
    </ul>
</div>
