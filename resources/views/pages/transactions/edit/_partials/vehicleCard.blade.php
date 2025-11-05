<div class="relative w-72 max-w-full shrink-0 snap-center rounded-2xl hover:ring-4 xl:w-auto">
    <input
        required
        @checked($vehicle->id === $transaction->vehicle->id)
        type="radio"
        id="vehicle-{{ $vehicle->id }}"
        name="vehicle_id"
        class="peer absolute left-10 top-20 z-0 opacity-0"
        value="{{ $vehicle->id }}" />
    <label
        class="card col-span-12 w-full cursor-pointer overflow-x-visible rounded-2xl bg-base-100 shadow-xl peer-checked:ring-4 peer-checked:ring-primary-600"
        for="vehicle-{{ $vehicle->id }}">
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
        <div class="card-body px-6 pb-4 pt-2">
            <h2 class="pb-2 font-bold">{{ $vehicle->name }}</h2>
            <div class="flex w-full flex-wrap items-center gap-2 pb-2 dark:border-neutral">
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
            </div>
        </div>
    </label>
</div>
