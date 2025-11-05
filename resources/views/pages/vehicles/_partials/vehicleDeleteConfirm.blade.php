<dialog
    id="deletePortfolioModal"
    class="modal">
    <div class="modal-box">
        <h3
            class="text-lg font-bold"
            x-text="deleteTitle"></h3>
        <p class="py-4">
            @lang('pages.vehicles.deleteConfirm')
        </p>
        <div class="modal-action">
            <form method="dialog">
                <button class="btn btn-info mr-2">
                    @lang('globals.close')
                </button>
            </form>
            <form
                method="POST"
                :action="'{{ route('vehicles.byVehicleId.delete', '') }}/' + deleteId">
                @method('DELETE')
                @csrf
                <button
                    class="btn btn-outline btn-error"
                    type="submit">
                    @lang('pages.vehicles.delete')
                </button>
            </form>
        </div>
    </div>
</dialog>
