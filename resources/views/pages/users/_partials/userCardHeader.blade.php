<header class="sticky top-10 z-40 flex rounded-xl border border-base-200 bg-base-200/50 p-3 backdrop-blur-md">
    <div
        class="tooltip before:z-[60] before:bg-green-200/90 before:text-green-600 after:border-t-green-200/90"
        data-tip="@lang('pages.users.recoverTooltip')">
        <button
            id="recoverUserButton"
            class="btn btn-success btn-sm mr-2 bg-green-600 text-white dark:bg-opacity-70"
            :class="!isSomeUserChecked ? ' btn-disabled' : ''"
            x-on:click="recoverUserModal.showModal()">
            <x-icon.feather.rotateCcw />
            <span class="hidden sm:inline">
                @lang('pages.users.recover')
            </span>
        </button>
    </div>

    <div
        class="group tooltip before:z-[60] before:bg-red-200/90 before:text-red-600 after:border-t-red-200/90"
        data-tip="@lang('pages.users.disableTooltip')">
        <button
            id="disableUserButton"
            class="bg-primary btn btn-error btn-sm mr-2 text-white dark:bg-opacity-70"
            :class="!isSomeUserChecked ? ' btn-disabled' : ''"
            x-on:click="disableUserModal.showModal()">
            <x-icon.feather.slash />
            <span class="hidden sm:inline">
                @lang('pages.users.disable')
            </span>
        </button>
    </div>

    <div
        class="group tooltip before:z-[60] before:bg-yellow-100/90 before:text-yellow-600 after:border-t-yellow-100/90"
        data-tip="@lang('pages.users.editTooltip')">
        <a
            id="editUserButton"
            :href="'{{ route('users.byUserId.edit', 'ID') }}'.replace('ID', selectedUserIds[0])"
            class="btn btn-warning btn-sm mr-2 bg-yellow-500 text-white dark:bg-opacity-70"
            :class="!isOneUserChecked ? ' btn-disabled' : ''">
            <x-icon.feather.editCircle />
            <span class="hidden sm:inline">
                @lang('pages.users.editText')
            </span>
        </a>
    </div>
</header>
