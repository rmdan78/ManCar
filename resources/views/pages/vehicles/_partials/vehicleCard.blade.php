<div class="card w-full bg-base-100 shadow-xl">
    <figure class="relative w-full overflow-hidden bg-base-100">
        <div
            class="absolute z-0 aspect-video w-full scale-125 rounded-t-2xl bg-cover bg-center blur-3xl"
            style="background-image: url('{{ \StorageHelper::url($vehicle->thumbnail?->uri) }}')"></div>
        <img
            class="relative z-10 aspect-video w-full object-contain"
            src="{{ $vehicle->thumbnail?->uri ? \StorageHelper::url($vehicle->thumbnail?->uri) : '/images/illustrations/snap_the_moment_bg.svg' }}"
            loading="lazy"
            alt=" " />

        @if ($vehicle->status->codename === 'INUSED')
            <small
                class="absolute bottom-0 z-10 w-full bg-red-600/10 px-4 py-1 text-center font-semibold"
                style="
                    border-color: {{ $vehicle->status->settings['color'] }};
                    color: {{ $vehicle->status->settings['color'] }};
                ">
                @lang('globals.availableAt')
                : {{ $vehicle->available_at->format('d/m/Y H:i') }}
            </small>
        @endif
    </figure>
    <div class="card-body pb-4 pt-2">
        <header class="flex w-full flex-wrap items-center gap-2 border-b border-base-300 py-2 dark:border-neutral">
            <div
                class="size-4 shrink-0 rounded-md"
                style="background-color: {{ $vehicle->color }}"></div>
            <div class="badge badge-neutral shrink-0">{{ $vehicle->number_plate }}</div>
            <div
                class="badge badge-neutral badge-outline shrink-0 uppercase"
                style="
                    border-color: {{ $vehicle->status->settings['color'] }};
                    color: {{ $vehicle->status->settings['color'] }};
                ">
                @lang('pages.vehicles.status.' . Str::lower($vehicle->status->codename))
            </div>
        </header>

        <h2 class="card-title">{{ $vehicle->name }}</h2>
        <p class="mb-2 break-all text-sm text-base-content/60">{{ Str::limit($vehicle->description, 72) }}</p>

        @can('update', App\Models\Vehicle\Vehicle::class)
            <div class="card-actions justify-start">
                <a
                    href="{{ route('vehicles.byVehicleId.edit', $vehicle->id) }}"
                    class="btn btn-sm border border-yellow-500 bg-yellow-500 text-white hover:bg-yellow-500/80 dark:bg-opacity-70">
                    @lang('pages.vehicles.editText')
                </a>
                <button
                    x-on:click="
                        deleteId = '{{ $vehicle->id }}'
                        deleteTitle = '{{ addslashes($vehicle->name) }}'
                    "
                    onclick="deletePortfolioModal.showModal()"
                    class="btn btn-sm border border-red-600 bg-red-600 text-white hover:bg-red-600/80 dark:bg-opacity-70">
                    @lang('pages.vehicles.delete')
                </button>
            </div>
        @endcan
    </div>
</div>
