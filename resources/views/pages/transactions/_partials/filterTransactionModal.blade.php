<dialog
    id="filterTransactionModal"
    class="modal modal-bottom sm:modal-middle">
    <div class="modal-box px-4 md:px-6">
        <form method="dialog">
            <button class="btn btn-circle btn-ghost btn-sm absolute right-2 top-2">✕</button>
        </form>
        <h3 class="mb-6 text-center text-xl font-bold uppercase text-slate-500">@lang('pages.requests.filter')</h3>
        <form
            method="GET"
            class="grid grid-cols-12 gap-2 gap-y-4"
            action="{{ route('vehicles.transactions') }}">
            <div class="form-control col-span-12">
                <h5 class="label label-text text-base font-semibold">
                    @lang('pages.requests.filterFields.transactionStatus')
                    :
                </h5>
                <div class="grid grid-cols-12">
                    @foreach ($statuses as $status)
                        <label class="label col-span-6 cursor-pointer justify-start p-1">
                            <input
                                class="checkbox checkbox-xs mr-2 lg:checkbox-sm"
                                name="status_ids[]"
                                type="checkbox"
                                @checked(collect(request()->status_ids)->contains($status->id) || request()->status_ids == null)
                                value="{{ $status->id }}" />
                            <div
                                class="badge badge-sm shrink-0 font-bold uppercase lg:badge-md"
                                style="
                                    background-color: {{ $status->settings['color'] }}2A;
                                    color: {{ $status->settings['color'] }};
                                ">
                                @lang('pages.requests.status.' . Str::lower($status->codename))
                            </div>
                        </label>
                    @endforeach
                </div>
                {{--
                    <div
                    class="max-h-20 overflow-auto grid grid-cols-12 rounded-md border px-4 py-2 text-base uppercase ring-base-content/20 ring-offset-2 hover:ring-2">
                    </div>
                --}}
            </div>

            <label class="form-control col-span-6 w-full">
                <div class="label">
                    <h5 class="label-text text-base font-semibold">
                        @lang('globals.from')
                        :
                    </h5>
                </div>
                <input
                    required
                    type="date"
                    name="from_date"
                    class="peer input input-bordered z-10 w-full"
                    value="{{ now()->subMonths(6)->format('Y-m-d') }}" />
            </label>

            <label class="form-control col-span-6 w-full">
                <div class="label">
                    <h5 class="label-text text-base font-semibold">
                        @lang('globals.until')
                        :
                    </h5>
                </div>
                <input
                    required
                    type="date"
                    name="until_date"
                    class="peer input input-bordered z-10 w-full"
                    value="{{ now()->format('Y-m-d') }}" />
            </label>

            <label class="form-control col-span-6 w-full">
                <div class="label">
                    <h5 class="label-text text-base font-semibold">
                        @lang('pages.requests.filterFields.perPage')
                        :
                    </h5>
                </div>
                <input
                    required
                    type="number"
                    name="per_page"
                    step="5"
                    min="5"
                    max="50"
                    class="peer input input-bordered z-10 w-full"
                    value="{{ $transactions->perPage() }}" />
            </label>

            <label class="form-control col-span-6 w-full">
                <div class="label">
                    <h5 class="label-text text-base font-semibold">
                        @lang('pages.requests.filterFields.page')
                        :
                    </h5>
                </div>
                <input
                    required
                    type="number"
                    name="page"
                    step="1"
                    min="1"
                    max="{{ $transactions->lastPage() }}"
                    class="peer input input-bordered z-10 w-full"
                    value="{{ $transactions->currentPage() }}" />
            </label>

            <button
                class="btn col-span-12 mt-4 w-full bg-slate-500 px-8 uppercase text-white hover:bg-slate-500/80 dark:bg-opacity-70"
                type="submit">
                @lang('globals.apply')
            </button>
        </form>
    </div>
</dialog>
