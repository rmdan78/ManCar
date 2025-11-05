<div class="flex h-full flex-col overflow-x-auto">
    <table
        x-ref="transactionsTable"
        id="transactionsTable"
        class="table table-zebra table-sm lg:table-md">
        <thead class="sticky top-0 z-10 bg-base-100">
            <tr>
                <th>
                    <label>
                        <input
                            @disabled($transactions->whereIn('status.codename', ['PENDING', 'ONGOING'])->isEmpty())
                            x-ref="allTransactionCheckbox"
                            id="checkAllTransaction"
                            type="checkbox"
                            class="checkbox checkbox-sm"
                            x-on:click="
                                (e) => {
                                    const isChecked = e.target.checked
                                    selectedTransactionIds = []

                                    transactionCheckboxes.forEach((checkbox) => {
                                        if (checkbox.checked && isChecked) return
                                        checkbox.checked = isChecked
                                        checkbox.dispatchEvent(new Event('change'))
                                    })
                                }
                            " />
                    </label>
                </th>
                <th>@lang('pages.requests.tableFields.request')</th>
                <th>@lang('pages.requests.tableFields.usageTime')</th>
                <th>@lang('pages.requests.tableFields.destination')</th>
                <th>@lang('pages.requests.tableFields.vehicle')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr id="{{ $transaction->id }}">
                    <th>
                        <label>
                            <input
                                @disabled(collect(['REJECTED', 'APPROVED', 'COMPLETED', 'EXPIRED'])->contains($transaction->status->codename))
                                type="checkbox"
                                class="transactionCheckbox checkbox checkbox-sm"
                                value="{{ $transaction->id }}"
                                data-status="{{ $transaction->status->codename }}"
                                x-on:change="transactionCheckboxOnChange" />
                        </label>
                    </th>
                    <td>
                        <div class="flex min-w-40 items-center gap-3">
                            <div class="avatar">
                                <div class="mask mask-squircle h-12 w-12 bg-base-300">
                                    <img
                                        src="{{ ($picture = $transaction->user->profilePicture?->uri) ? \StorageHelper::url($picture) : '/images/illustrations/user.svg' }}"
                                        alt="Avatar" />
                                </div>
                            </div>
                            <div>
                                <span class="block text-sm font-bold">{{ $transaction->user->name }}</span>
                                <span class="block text-sm opacity-50">{{ $transaction->user->email }}</span>
                                <span class="text-xs opacity-50">
                                    {{ $transaction->created_at->format('d/m/y H:i:s') }}
                                </span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="flex min-w-32 flex-col">
                            <div
                                class="badge badge-sm mb-1 shrink-0 font-bold uppercase"
                                style="
                                    background-color: {{ $transaction->status->settings['color'] }}2A;
                                    color: {{ $transaction->status->settings['color'] }};
                                ">
                                @lang('pages.requests.status.' . Str::lower($transaction->status->codename))
                            </div>
                            <span class="ml-1 text-sm font-semibold opacity-50">
                                {{ $transaction->used_on->format('H:i') }} -
                                {{ $transaction->ends_on->format('H:i') }}
                            </span>
                            <span class="ml-1 text-sm opacity-50">
                                {{ ($usedOn = $transaction->used_on->format('d/m/y')) == now()->format('d/m/y') ? __('globals.today') : $usedOn }}
                            </span>
                        </div>
                    </td>
                    <td>
                        <div class="flex min-w-40 sm:min-w-28">
                            <textarea
                                readonly
                                class="textarea textarea-bordered w-full resize text-sm leading-normal">
{{ $transaction->destination }}</textarea
                            >
                        </div>
                    </td>
                    <td>
                        <div class="flex min-w-28 flex-col items-start">
                            <div class="mb-1 flex items-center">
                                <div
                                    class="mr-2 size-3 shrink-0 rounded-sm"
                                    style="background-color: {{ $transaction->vehicle->color }}"></div>
                                <div class="badge badge-neutral badge-sm mr-2 shrink-0">
                                    {{ $transaction->vehicle->number_plate }}
                                </div>
                            </div>
                            <div>
                                <span class="text-sm">{{ $transaction->vehicle->name }}</span>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
