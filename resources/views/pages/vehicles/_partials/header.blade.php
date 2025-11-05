<header class="col-span-12 flex w-full items-center">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        @lang('pages.vehicles.title')
    </h2>

    @can('create', App\Models\Vehicle\Vehicle::class)
        <a
            href="{{ route('vehicles.create') }}"
            class="btn btn-sm ml-4 bg-gradient-primary text-white dark:bg-opacity-70">
            <x-icon.feather.plusCircle />
            <span>
                @lang('pages.vehicles.add')
            </span>
        </a>
    @endcan
</header>
