<form
    class="grid h-full w-full grid-cols-12 gap-x-4 gap-y-2"
    action="{{ route('users.post') }}"
    method="POST"
    enctype="multipart/form-data">
    @csrf

    <label class="form-control col-span-12 flex flex-col items-center">
        <div class="group/contentEditorImageInputCard mask mask-squircle relative w-full max-w-60 overflow-hidden">
            <figure class="mask mask-squircle relative h-full w-full overflow-hidden">
                <div
                    class="absolute -z-0 aspect-square w-full scale-125 rounded-t-2xl bg-cover bg-center blur-3xl"
                    style="background-image: url('/images/illustrations/user.svg')"></div>
                <img
                    id="profilePicture"
                    class="relative z-10 aspect-square w-full object-cover"
                    src="/images/illustrations/user.svg"
                    loading="lazy"
                    alt=" " />
            </figure>
            <div
                class="group/contentEditorImageInputCardForeground absolute left-0 top-0 z-20 flex h-full w-full bg-base-300 opacity-0 transition-all group-hover/contentEditorImageInputCard:opacity-100">
                <div
                    class="absolute z-20 flex h-full w-full scale-[0.1] p-4 transition-all duration-300 group-hover/contentEditorImageInputCardForeground:scale-100">
                    <input
                        x-on:change="
                            (e) => {
                                updateImageOnChange(e, 'profilePicture')
                            }
                        "
                        type="file"
                        name="profilePicture"
                        class="file-input-default file-input file-input-bordered file-input-xs mb-10 mt-auto w-full sm:file-input-sm" />
                </div>
            </div>
        </div>
    </label>

    <label class="form-control col-span-12 w-full">
        <div class="label">
            <h5 class="label-text text-base font-semibold">
                @lang('pages.users.create.formFields.name')
                :
            </h5>
        </div>
        <input
            required
            type="text"
            name="name"
            pattern="[\w\s\.\,]{3,}"
            placeholder="@lang('globals.typeHere')"
            class="peer input input-bordered z-10 w-full" />
        <span
            class="-z-0 -mt-10 px-1 py-2 text-sm text-red-600 opacity-0 duration-300 peer-invalid:-mt-0 peer-invalid:opacity-100 dark:text-red-400">
            @lang('validation.required', ['attribute' => ''])
        </span>
    </label>

    <label class="form-control col-span-12 w-full">
        <div class="label">
            <h5 class="label-text text-base font-semibold">
                @lang('pages.users.create.formFields.employeeId')
                :
            </h5>
        </div>
        <input
            required
            type="text"
            inputmode="numeric"
            name="employee_id"
            pattern="[0-9]{4,}"
            placeholder="@lang('globals.typeHere')"
            class="peer input input-bordered z-10 w-full" />
        <span
            class="-z-0 -mt-10 px-1 py-2 text-sm text-red-600 opacity-0 duration-300 peer-invalid:-mt-0 peer-invalid:opacity-100 dark:text-red-400">
            @lang('validation.required', ['attribute' => ''])
        </span>
    </label>

    <label class="form-control col-span-12 w-full">
        <div class="label">
            <h5 class="label-text text-base font-semibold">
                @lang('pages.users.create.formFields.email')
                :
            </h5>
        </div>
        <input
            required
            type="email"
            name="email"
            placeholder="@lang('globals.typeHere')"
            class="peer input input-bordered z-10 w-full" />
        <span
            class="-z-0 -mt-10 px-1 py-2 text-sm text-red-600 opacity-0 duration-300 peer-invalid:-mt-0 peer-invalid:opacity-100 dark:text-red-400">
            @lang('validation.required', ['attribute' => ''])
        </span>
    </label>

    <label class="form-control col-span-12 w-full">
        <div class="label">
            <h5 class="label-text text-base font-semibold">
                @lang('pages.users.create.formFields.roles')
                :
            </h5>
        </div>
        <select
            class="select select-bordered z-10 text-base"
            name="role_id">
            <optgroup label="--- {{ Str::upper(__('globals.pickOne')) }} ---">
                @foreach ($roles as $role)
                    <option
                        value="{{ $role->id }}"
                        @selected($role->codename === 'USER')>
                        {{ $role->name }}
                    </option>
                @endforeach
            </optgroup>
        </select>
        <span
            class="-z-0 -mt-10 px-1 py-2 text-sm text-red-600 opacity-0 duration-300 peer-invalid:-mt-0 peer-invalid:opacity-100 dark:text-red-400">
            @lang('validation.required', ['attribute' => ''])
        </span>
    </label>

    <label class="form-control col-span-12 w-full">
        <div class="label flex flex-col items-start">
            <h5 class="label-text text-base font-semibold">
                @lang('pages.users.create.formFields.password')
                :
            </h5>
            <span class="label-text-alt text-yellow-600">
                @lang('pages.users.create.formFields.passwordWarning')
                :
            </span>
        </div>
        <input
            required
            readonly
            disabled
            type="text"
            name="password"
            placeholder="@lang('globals.typeHere')"
            class="peer input input-bordered z-10 w-full"
            value="password" />
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
