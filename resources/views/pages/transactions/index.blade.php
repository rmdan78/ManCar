@extends('layouts.dashboard.index')
@section('title', __('pages.requests.title') . ' - HMA Vehicle Booking')

@section('content')
    @include('pages.transactions._partials.successModal')
    @include('pages.transactions._partials.failedModal')
    @include('pages.transactions._partials.breadcrumb')

    <div
        class="px-container mx-auto grid h-full w-full grid-flow-row grid-cols-12 grid-rows-[auto_1fr] overflow-visible xl:grid-rows-[auto_1fr]"
        x-data="{
            transactionCheckboxes: [],
            selectedTransactionIds: [],
            selectedProcessedTransactionIds: [],
            checkedTransactions: [],
            statusIndexes: {
                PENDING: 0,
                APPROVED: 1,
                REJECTED: 2,
                ONGOING: 3,
                COMPLETED: 4,
                EXPIRED: 5,
            },

            transactionCheckboxOnChange(e) {
                const target = e?.target
                const value = target?.value
                const status = target?.dataset?.status
                const statusIndex = this.statusIndexes?.[status]

                if (target.checked) {
                    this.selectedTransactionIds.push(value)

                    if (! this.checkedTransactions?.[statusIndex])
                        this.checkedTransactions[statusIndex] = []

                    this.checkedTransactions?.[statusIndex]?.push(value)
                } else {
                    const index1 = this.selectedTransactionIds.indexOf(value)
                    if (index1 >= 0) this.selectedTransactionIds.splice(index1, 1)

                    const index2 =
                        this.checkedTransactions?.[statusIndex]?.indexOf(value)
                    if (index2 >= 0)
                        this.checkedTransactions?.[statusIndex]?.splice(index2, 1)
                }

                console.table({
                    checkboxes: this.transactionCheckboxes?.length,
                    checkeds: this.checkedTransactions?.flat()?.length,
                    isAll: this.isAllTransactionChecked(),
                    hasSome: this.hasSomeTransactionChecked(),
                    hasOnlyOne: this.hasOnlyOneTransactionChecked(),
                    hasProcessed: this.hasProcessedTransactionChecked(),
                })
            },

            objectToValues(data) {
                return Object.values(data).flat()
            },

            isAllTransactionChecked() {
                return (
                    this.checkedTransactions.flat().length ===
                    this.transactionCheckboxes?.length
                )
            },

            hasSomeTransactionChecked(status = null) {
                if (status) return this.hasSomeTransactionByStatusChecked(status)
                return Boolean(this.checkedTransactions.flat().length)
            },

            hasSomeTransactionByStatusChecked(status) {
                return Boolean(this.checkedTransactions?.[status]?.length || false)
            },

            hasOnlyOneTransactionChecked() {
                return this.checkedTransactions.flat().length === 1
            },

            hasOnlyOneTransactionByStatusChecked(status) {
                return this.checkedTransactions?.[status]?.length === 1
            },

            hasProcessedTransactionChecked() {
                const data = [...this.checkedTransactions]
                delete data[this.statusIndexes.PENDING]
                return Boolean(data.flat().length)
            },
        }"
        x-init="
            transactionCheckboxes = $refs.transactionsTable?.querySelectorAll(
                'input.transactionCheckbox:enabled',
            )

            $watch('isAllTransactionChecked', (value) => {
                $refs.allTransactionCheckbox.checked = value
            })
        ">
        @include('pages.transactions._partials.filterTransactionModal')
        @include('pages.transactions._partials.transactionApproveConfirm')
        @include('pages.transactions._partials.transactionRejectConfirm')
        @include('pages.transactions._partials.transactionCompleteConfirm')
        @include('pages.transactions._partials.header')

        <div
            class="card-responsive card col-span-12 h-full max-h-[calc(100dvh_-_12rem)] w-full overflow-visible bg-base-100 shadow-xl">
            <div class="card-body h-full w-full">
                @include('pages.transactions._partials.transactionCardHeader')
                @include('pages.transactions._partials.transactionTable')
                @include('pages.transactions._partials.transactionPaginationLinks')
            </div>
        </div>
    </div>
@endsection
