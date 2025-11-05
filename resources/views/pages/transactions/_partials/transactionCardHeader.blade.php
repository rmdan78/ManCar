@php
    use App\Models\Vehicle\Transaction\Transaction;
@endphp

<header
    class="flex flex-wrap gap-2 rounded-md border border-base-200 bg-base-200/50 p-3 backdrop-blur-md md:rounded-xl">
    <div
        class="group tooltip mx-0 flex before:z-[60] before:bg-slate-100/90 before:text-slate-600 after:border-t-slate-100/90"
        data-tip="@lang('pages.requests.filterTooltip')">
        <button
            id="filterTransactionButton"
            x-on:click="filterTransactionModal.showModal()"
            class="btn btn-sm flex shrink-0 border border-slate-500 bg-slate-500 p-2 text-white hover:bg-slate-500/80 dark:bg-opacity-70">
            <x-icon.feather.filter class="size-4" />
        </button>
    </div>

    @can('approve', Transaction::class)
        <div
            class="group tooltip mx-0 flex before:z-[60] before:bg-emerald-100/90 before:text-emerald-600 after:border-t-emerald-100/90"
            data-tip="@lang('globals.export')">
            <a
                id="filterTransactionButton"
                href="{{ route('vehicles.transactions.export') }}"
                class="btn btn-sm flex shrink-0 border border-emerald-500 bg-emerald-500 p-2 text-white hover:bg-emerald-500/80 dark:bg-opacity-70">
                <x-icon.feather.download class="size-4" />
            </a>
        </div>
    @endcan

    @can('approve', Transaction::class)
        <div
            class="group tooltip mx-0 flex before:z-[60] before:bg-green-200/90 before:text-green-600 after:border-t-green-200/90"
            data-tip="@lang('pages.requests.approveTooltip')">
            <button
                id="approveTransactionButton"
                x-on:click="approveTransactionModal.showModal()"
                class="btn btn-sm flex shrink-0 border border-green-600 bg-green-600 text-white hover:bg-green-600/80 dark:bg-opacity-70"
                :class="!hasSomeTransactionChecked() || hasProcessedTransactionChecked() ? ' btn-disabled' : null">
                <x-icon.feather.checkCircle class="size-4" />
                <span class="hidden lg:inline">
                    @lang('pages.requests.approve')
                </span>
            </button>
        </div>
    @endcan

    @can('reject', Transaction::class)
        <div
            class="group tooltip mx-0 flex before:z-[60] before:bg-red-200/90 before:text-red-600 after:border-t-red-200/90"
            data-tip="@lang('pages.requests.rejectTooltip')">
            <button
                id="rejectTransactionButton"
                x-on:click="rejectTransactionModal.showModal()"
                class="btn btn-sm flex shrink-0 border border-red-600 bg-red-600 text-white hover:bg-red-600/80 dark:bg-opacity-70"
                :class="!hasSomeTransactionChecked() || hasProcessedTransactionChecked() ? ' btn-disabled' : null">
                <x-icon.feather.xCircle class="size-4" />
                <span class="hidden lg:inline">
                    @lang('pages.requests.reject')
                </span>
            </button>
        </div>
    @endcan

    <div
        class="group tooltip mx-0 flex before:z-[60] before:bg-yellow-100/90 before:text-yellow-600 after:border-t-yellow-100/90"
        data-tip="@lang('pages.requests.editTooltip')">
        <a
            id="editTransactionButton"
            :href="'{{ route('vehicles.transactions.byTransactionId.edit', 'ID') }}'.replace('ID', selectedTransactionIds[0])"
            class="btn btn-sm flex shrink-0 border border-yellow-500 bg-yellow-500 text-white hover:bg-yellow-500/80 dark:bg-opacity-70"
            :class="!hasOnlyOneTransactionChecked() || hasProcessedTransactionChecked() || hasSomeTransactionChecked(statusIndexes.ONGOING) ? ' btn-disabled' : null">
            <x-icon.feather.editCircle class="size-4" />
            <span class="hidden lg:inline">
                @lang('pages.requests.editText')
            </span>
        </a>
    </div>

    @can('reject', Transaction::class)
        <div
            class="group tooltip mx-0 flex before:z-[60] before:bg-blue-100/90 before:text-blue-600 after:border-t-blue-100/90"
            data-tip="@lang('pages.requests.completeTooltip')">
            <button
                id="completeTransactionButton"
                x-on:click="completeTransactionModal.showModal()"
                class="btn btn-sm flex shrink-0 border border-blue-500 bg-blue-500 text-white hover:bg-blue-500/80 dark:bg-opacity-70"
                :class="!hasSomeTransactionChecked(statusIndexes.ONGOING) ? ' btn-disabled' : null">
                <x-icon.feather.circle class="size-4" />
                <span class="hidden lg:inline">
                    @lang('pages.requests.complete')
                </span>
            </button>
        </div>
    @endcan
</header>
