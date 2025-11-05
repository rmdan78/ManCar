<header class="col-span-12 flex h-auto w-full items-center">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        @lang('pages.requests.title')
    </h2>
    <a
        href="{{ route('vehicles.transactions.create') }}"
        class="btn btn-sm ml-4 bg-gradient-primary text-white dark:bg-opacity-70">
        <x-icon.feather.plusCircle />
        <span>
            @lang('pages.requests.add')
        </span>
    </a>
</header>
