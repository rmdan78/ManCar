<dialog
    id="approveTransactionModal"
    class="modal">
    <div class="modal-box">
        <h3 class="text-center text-xl font-bold uppercase text-green-500">@lang('pages.requests.approve')</h3>
        <p class="py-4 text-center">@lang('pages.requests.approveConfirmation')</p>
        <div class="modal-action flex justify-center">
            <form method="dialog">
                <button class="btn btn-outline btn-secondary mr-2 px-8">
                    @lang('globals.close')
                </button>
            </form>
            <form
                method="POST"
                action="{{ route('vehicles.transactions.approves.patch') }}">
                @method('PATCH')
                @csrf

                <template x-for="transactionId in selectedTransactionIds">
                    <input
                        type="hidden"
                        name="transactionIds[]"
                        :value="transactionId" />
                </template>

                <button
                    class="btn btn-success bg-green-600 px-8 text-white"
                    type="submit">
                    @lang('pages.requests.approve')
                </button>
            </form>
        </div>
    </div>
</dialog>
