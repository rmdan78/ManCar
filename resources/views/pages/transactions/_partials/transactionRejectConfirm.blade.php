<dialog
    id="rejectTransactionModal"
    class="modal">
    <div class="modal-box">
        <h3 class="text-center text-xl font-bold uppercase text-red-500">@lang('pages.requests.reject')</h3>
        <p class="py-4 text-center">@lang('pages.requests.rejectConfirmation')</p>
        <div class="modal-action flex justify-center">
            <form method="dialog">
                <button class="btn btn-outline btn-secondary mr-2 px-8">
                    @lang('globals.close')
                </button>
            </form>
            <form
                method="POST"
                action="{{ route('vehicles.transactions.rejects.patch') }}">
                @method('PATCH')
                @csrf

                <template x-for="transactionId in selectedTransactionIds">
                    <input
                        type="hidden"
                        name="transactionIds[]"
                        :value="transactionId" />
                </template>

                <button
                    class="btn btn-error bg-red-600 px-8 text-white"
                    type="submit">
                    @lang('pages.requests.reject')
                </button>
            </form>
        </div>
    </div>
</dialog>
