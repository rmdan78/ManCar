<dialog
    id="recoverUserModal"
    class="modal">
    <div class="modal-box">
        <h3 class="text-center text-xl font-bold uppercase text-green-500">
            @lang('pages.users.recover')
        </h3>
        <p class="py-4 text-center">
            @lang('pages.users.recoverConfirmation')
        </p>
        <div class="modal-action flex justify-center">
            <form method="dialog">
                <button class="btn btn-outline btn-secondary mr-2 px-8">
                    @lang('globals.close')
                </button>
            </form>
            <form
                method="POST"
                action="{{ route('users.recovers') }}">
                @csrf
                @method('PATCH')

                <template x-for="userId in selectedUserIds">
                    <input
                        type="hidden"
                        name="userIds[]"
                        :value="userId" />
                </template>

                <button
                    class="btn btn-success bg-green-600 px-8 text-white"
                    type="submit">
                    @lang('pages.users.recover')
                </button>
            </form>
        </div>
    </div>
</dialog>
