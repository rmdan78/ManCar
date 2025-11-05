<form
    class="grid h-full w-full grid-cols-12 gap-x-4 gap-y-2"
    action="{{ route('profile.password.update') }}"
    method="POST"
    enctype="multipart/form-data">
    @method('PUT')
    @csrf

    <label class="form-control col-span-12 w-full">
        <div class="label">
            <h5 class="label-text text-base font-semibold">
                @lang('pages.profile.password.edit.formFields.oldPassowrd')
                :
            </h5>
        </div>
        <input
            required
            type="password"
            name="old_password"
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
                @lang('pages.profile.password.edit.formFields.newPassword')
                :
            </h5>
        </div>
        <input
            required
            type="password"
            name="new_password"
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
                @lang('pages.profile.password.edit.formFields.retypeNewPassword')
                :
            </h5>
        </div>
        <input
            required
            type="password"
            name="confirm_new_password"
            placeholder="@lang('globals.typeHere')"
            class="peer input input-bordered z-10 w-full" />
        <span
            class="-z-0 -mt-10 px-1 py-2 text-sm text-red-600 opacity-0 duration-300 peer-invalid:-mt-0 peer-invalid:opacity-100 dark:text-red-400">
            @lang('validation.required', ['attribute' => ''])
        </span>
    </label>

    <button
        class="btn btn-block sticky bottom-0 col-span-12 mt-4 bg-gradient-primary uppercase text-white dark:bg-opacity-70"
        type="submit">
        @lang('globals.save')
    </button>
</form>
