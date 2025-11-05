<form
    class="grid h-full w-full grid-cols-12 gap-x-4 gap-y-2"
    action="{{ route('vehicles.post') }}"
    method="POST"
    enctype="multipart/form-data">
    @csrf

    <label class="form-control col-span-12">
        <div class="flex flex-col px-1 py-2">
            <h5 class="label-text text-base font-semibold">
                @lang('pages.vehicles.create.formFields.thumbnail')
                :
            </h5>
        </div>
        <div class="group/contentEditorImageInputCard relative w-full overflow-hidden rounded-lg">
            <figure class="relative w-full overflow-hidden bg-base-300">
                <div
                    class="absolute -z-0 aspect-video w-full scale-125 rounded-t-2xl bg-cover bg-center blur-3xl"
                    style="background-image: url('/images/illustrations/snap_the_moment_bg.svg')"></div>
                <img
                    id="thumbnail"
                    src="/images/illustrations/snap_the_moment_bg.svg"
                    class="relative z-10 aspect-video w-full object-contain"
                    alt="" />
            </figure>
            <div
                class="group/contentEditorImageInputCardForeground absolute left-0 top-0 z-20 flex h-full w-full bg-base-300/60 opacity-0 transition-all group-hover/contentEditorImageInputCard:opacity-100">
                <div
                    class="absolute z-20 flex h-full w-full scale-[0.1] p-4 transition-all duration-300 group-hover/contentEditorImageInputCardForeground:scale-100">
                    <input
                        required
                        x-on:change="
                            (e) => {
                                updateImageOnChange(e, 'thumbnail')
                            }
                        "
                        type="file"
                        name="thumbnail"
                        class="file-input-default file-input file-input-bordered file-input-sm mt-auto w-full" />
                </div>
            </div>
        </div>
    </label>

    <label class="form-control col-span-12 w-full">
        <div class="label">
            <h5 class="label-text text-base font-semibold">
                @lang('pages.vehicles.create.formFields.name')
                :
            </h5>
        </div>
        <input
            required
            type="text"
            name="name"
            placeholder="@lang('globals.typeHere')"
            class="peer input input-bordered z-10 w-full" />
        <span
            class="-z-0 -mt-10 px-1 py-2 text-sm text-red-600 opacity-0 duration-300 peer-invalid:-mt-0 peer-invalid:opacity-100 dark:text-red-400">
            @lang('validation.required', ['attribute' => ''])
        </span>
    </label>

    <label class="form-control col-span-12 w-full md:col-span-6">
        <div class="flex flex-col px-1 py-2">
            <h5 class="label-text text-base font-semibold">
                @lang('pages.vehicles.create.formFields.boughtOn')
                :
            </h5>
        </div>
        <input
            required
            type="date"
            class="peer input input-bordered z-10 w-full"
            name="bought_on" />
        <span
            class="-z-0 -mt-10 px-1 py-2 text-sm text-red-600 opacity-0 duration-300 peer-invalid:-mt-0 peer-invalid:opacity-100 dark:text-red-400">
            @lang('validation.required', ['attribute' => ''])
        </span>
    </label>

    <label class="form-control col-span-12 w-full md:col-span-6">
        <div class="flex flex-col px-1 py-2">
            <h5 class="label-text text-base font-semibold">
                @lang('pages.vehicles.create.formFields.color')
                :
            </h5>
        </div>
        <input
            required
            type="color"
            class="peer input input-bordered z-10 w-full"
            name="color" />
        <span
            class="-z-0 -mt-10 px-1 py-2 text-sm text-red-600 opacity-0 duration-300 peer-invalid:-mt-0 peer-invalid:opacity-100 dark:text-red-400">
            @lang('validation.required', ['attribute' => ''])
        </span>
    </label>

    <label class="form-control col-span-12 w-full md:col-span-6">
        <div class="label">
            <h5 class="label-text text-base font-semibold">
                @lang('pages.vehicles.create.formFields.vehicleKind')
                :
            </h5>
        </div>
        <select
            required
            class="select select-bordered z-10 text-base"
            name="kind_id">
            <optgroup label="--- {{ Str::upper(__('globals.pickOne')) }} ---">
                @foreach ($kinds as $kind)
                    <option value="{{ $kind->id }}">{{ $kind->name }}</option>
                @endforeach
            </optgroup>
        </select>
        <span
            class="-z-0 -mt-10 px-1 py-2 text-sm text-red-600 opacity-0 duration-300 peer-invalid:-mt-0 peer-invalid:opacity-100 dark:text-red-400">
            @lang('validation.required', ['attribute' => ''])
        </span>
    </label>

    <label class="form-control col-span-12 w-full md:col-span-6">
        <div class="flex flex-col px-1 py-2">
            <h5 class="label-text text-base font-semibold">
                @lang('pages.vehicles.create.formFields.numberPlate')
                :
            </h5>
        </div>
        <input
            required
            type="text"
            class="peer input input-bordered z-10 w-full"
            name="number_plate" />
        <span
            class="-z-0 -mt-10 px-1 py-2 text-sm text-red-600 opacity-0 duration-300 peer-invalid:-mt-0 peer-invalid:opacity-100 dark:text-red-400">
            @lang('validation.required', ['attribute' => ''])
        </span>
    </label>

    <label class="form-control col-span-12 w-full">
        <div class="flex flex-col px-1 py-2">
            <h5 class="label-text text-base font-semibold">
                @lang('pages.vehicles.create.formFields.description')
                :
            </h5>
        </div>
        <textarea
            required
            class="peer textarea textarea-bordered z-10 w-full resize-none text-base"
            placeholder="@lang('pages.vehicles.create.formFields.descriptionPlaceholder')"
            rows="4"
            name="description"></textarea>
        <span
            class="-z-0 -mt-10 px-1 py-2 text-sm text-red-600 opacity-0 duration-300 peer-invalid:-mt-0 peer-invalid:opacity-100 dark:text-red-400">
            @lang('validation.required', ['attribute' => ''])
        </span>
    </label>

    <button
        class="btn btn-block sticky bottom-0 col-span-12 mt-4 bg-gradient-primary uppercase text-white dark:bg-opacity-70"
        type="submit">
        @lang('globals.send')
    </button>
</form>
