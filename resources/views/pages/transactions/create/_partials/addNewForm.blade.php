<form
    class="col-span-12 grid h-auto w-full grid-flow-row auto-rows-min grid-cols-12 grid-rows-[auto_1fr] content-start gap-6 overflow-visible xl:h-full xl:overflow-y-auto"
    action="{{ route('vehicles.transactions.post') }}"
    method="POST"
    enctype="multipart/form-data">
    @csrf

    <section
        class="card col-span-12 h-full w-full bg-base-100 shadow-xl xl:col-span-8"
        x-data="{
            usedOn: null,
            timeUsedOn: null,
        }"
        x-init="
            () => {
                $watch('timeUsedOn', () => {
                    $refs.timeEndsOnInput.dispatchEvent(new Event('change'))
                })
            }
        ">
        <div class="card-body grid h-full w-full auto-rows-min grid-cols-12 gap-x-4 gap-y-2 pb-0">
            <label class="form-control col-span-12 w-full">
                <div class="label">
                    <h5 class="label-text text-base font-semibold">
                        @lang('pages.requests.create.formFields.destination')
                        :
                    </h5>
                </div>
                <input
                    required
                    type="text"
                    name="destination"
                    placeholder="@lang('pages.requests.create.formFields.destinationPlaceholder')"
                    class="peer input input-bordered z-10 w-full" />
                <span
                    class="-z-0 -mt-10 px-1 py-2 text-sm text-red-600 opacity-0 duration-300 peer-invalid:-mt-0 peer-invalid:opacity-100 dark:text-red-400">
                    @lang('validation.required', ['attribute' => ''])
                </span>
            </label>

            <label class="form-control col-span-12 w-full md:col-span-6">
                <div class="flex flex-col px-1 py-2">
                    <h5 class="label-text text-base font-semibold">
                        @lang('pages.requests.create.formFields.usedOn')
                        :
                    </h5>
                </div>
                <input
                    required
                    min="{{ now()->addHour()->format('Y-m-d') }}"
                    max="{{ now()->addDay()->format('Y-m-d') }}"
                    type="date"
                    class="peer input input-bordered z-10 mb-4 w-full"
                    name="date_used_on"
                    x-on:change="
                        (e) => {
                            usedOn = e.target.value
                        }
                    " />
                <x-input.time
                    required="true"
                    min="{{ now()->addHour()->format('H:i') }}"
                    name="time_used_on"
                    class="peer input input-bordered z-10 w-full"
                    x-on:change="(e) => {
                        timeUsedOn = e.target.value;
                    }" />
                <span
                    class="-z-0 -mt-10 px-1 py-2 text-sm text-red-600 opacity-0 duration-300 peer-invalid:-mt-0 peer-invalid:opacity-100 dark:text-red-400">
                    Min. 1 jam sebelum digunakan, max. 1 hari berikutnya
                    {{-- Must be min. 1 hour before used, max. 1 day next --}}
                </span>
            </label>

            <label class="form-control col-span-12 w-full md:col-span-6">
                <div class="flex flex-col px-1 py-2">
                    <h5 class="label-text text-base font-semibold">
                        @lang('pages.requests.create.formFields.endsOn')
                        :
                    </h5>
                </div>
                <input
                    required
                    readonly
                    disabled
                    type="date"
                    class="peer input input-bordered z-10 mb-4 w-full"
                    name="date_ends_on"
                    :min="() => {
                        if(usedOn) return usedOn;
                    }"
                    :max="() => {
                        if(usedOn) {
                            const dateSplited =  usedOn?.split('T');
                            return ;
                        }
                    }"
                    :value="() => {
                        const date = new Date(usedOn);
                        date?.setTime(date?.getTime() + (60 * 60 * 1000) + (7 * 60 * 60 * 1000)); // 1Hour + (+7GMT)
                        if(usedOn) return date?.toISOString()?.split('T')?.[0];
                    }" />
                <x-input.time
                    required
                    class="peer input input-bordered z-10 w-full"
                    name="time_ends_on"
                    x-ref="timeEndsOnInput"
                    x-bind:min="() => {
                        const date = new Date(`1970-01-01T${timeUsedOn ?? '00:00'}:00`);
                        if(timeUsedOn) return date?.toLocaleTimeString([], {
                            hour12: false,
                            hour: '2-digit',
                            minute: '2-digit',
                        });
                    }"
                    x-bind:value="() => {
                        const date = new Date(`1970-01-01T${timeUsedOn ?? '00:00'}:00`);
                        date?.setTime(date?.getTime() + (3 * 60 * 60 * 1000)); // 3Hour
                        if(timeUsedOn) return date?.toLocaleTimeString([], {
                            hour12: false,
                            hour: '2-digit',
                            minute: '2-digit',
                        });
                    }" />
                <span
                    class="-z-0 -mt-10 px-1 py-2 text-sm text-red-600 opacity-0 duration-300 peer-invalid:-mt-0 peer-invalid:opacity-100 dark:text-red-400">
                    <span x-show="!timeUsedOn">@lang('validation.required', ['attribute' => ''])</span>
                    <span x-show="timeUsedOn">
                        @lang('validation.gt.numeric', ['attribute' => '', 'value' => ''])
                        <span x-text="timeUsedOn"></span>
                    </span>
                </span>
            </label>

            <label class="form-control col-span-12 w-full">
                <div class="flex flex-col px-1 py-2">
                    <h5 class="label-text text-base font-semibold">
                        @lang('pages.requests.create.formFields.description')
                        :
                    </h5>
                </div>
                <textarea
                    required
                    class="peer textarea textarea-bordered z-10 w-full resize-none text-base"
                    placeholder="@lang('pages.requests.create.formFields.descriptionPlaceholder')"
                    rows="4"
                    name="description"></textarea>
                <span
                    class="-z-0 -mt-10 px-1 py-2 text-sm text-red-600 opacity-0 duration-300 peer-invalid:-mt-0 peer-invalid:opacity-100 dark:text-red-400">
                    @lang('validation.required', ['attribute' => ''])
                </span>
            </label>

            <div class="sticky -bottom-20 z-40 col-span-12 mt-auto rounded-t-xl bg-base-100 py-4 pb-8">
                <button
                    class="btn btn-block sticky -bottom-10 z-40 col-span-12 mt-auto bg-gradient-primary uppercase text-white dark:bg-opacity-70"
                    type="submit">
                    @lang('globals.send')
                </button>
            </div>
        </div>
    </section>

    <section
        class="card col-span-12 row-start-1 h-auto w-full overflow-x-auto rounded-none xl:col-span-4 xl:row-start-auto xl:h-full xl:overflow-y-auto xl:overflow-x-hidden">
        <div
            class="card-body flex w-full snap-both snap-mandatory flex-row gap-4 overflow-x-auto p-0 px-4 !pb-9 xl:h-full xl:max-h-full xl:flex-col xl:overflow-y-auto xl:overflow-x-hidden">
            @if ($vehicles->isEmpty())
                <input
                    required
                    type="radio"
                    name="vehicle_id"
                    class="hidden" />

                <div class="card col-span-12 h-64 w-full shrink-0 overflow-x-visible rounded-2xl bg-base-200">
                    <div class="card-body flex h-full w-full items-center justify-center">
                        <h2 class="text-xl text-base-content/50">No Available Vehicle</h2>
                    </div>
                </div>
            @else
                @foreach ($vehicles as $vehicle)
                    @include('pages.transactions.create._partials.vehicleCard')
                @endforeach
            @endif
        </div>
    </section>
</form>
