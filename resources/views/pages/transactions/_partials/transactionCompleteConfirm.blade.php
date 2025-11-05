<dialog
    id="completeTransactionModal"
    class="modal">
    <div class="modal-box">
        <h3 class="text-center text-xl font-bold uppercase text-blue-500">@lang('pages.requests.complete')</h3>
        <p class="py-4 text-center">@lang('pages.requests.completeConfirmation')</p>
        <div class="modal-action flex justify-center">
            <form method="dialog">
                <button class="btn btn-outline btn-secondary mr-2 px-8">
                    @lang('globals.close')
                </button>
            </form>
            <form
                method="POST"
                action="{{ route('vehicles.transactions.completes.patch') }}">
                @method('PATCH')
                @csrf

                <template x-for="transactionId in selectedTransactionIds">
                    <input
                        type="hidden"
                        name="transactionIds[]"
                        :value="transactionId" />
                </template>

                <button
                    class="btn bg-blue-500 px-8 text-white hover:bg-blue-500/80 dark:bg-opacity-70"
                    type="submit">
                    @lang('pages.requests.complete')
                </button>
            </form>
        </div>
    </div>
</dialog>
