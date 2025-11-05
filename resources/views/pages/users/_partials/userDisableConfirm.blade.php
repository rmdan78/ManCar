<dialog
    id="disableUserModal"
    class="modal">
    <div class="modal-box">
        <h3 class="text-center text-xl font-bold uppercase text-red-500">
            @lang('pages.users.disable')
        </h3>
        <p class="py-4 text-center">
            @lang('pages.users.disableConfirmation')
        </p>
        <div class="modal-action flex justify-center">
            <form method="dialog">
                <button class="btn btn-outline btn-secondary mr-2 px-8">
                    @lang('globals.close')
                </button>
            </form>
            <form
                method="POST"
                action="{{ route('users.disables') }}">
                @csrf
                @method('PATCH')

                <template x-for="userId in selectedUserIds">
                    <input
                        type="hidden"
                        name="userIds[]"
                        :value="userId" />
                </template>

                <button
                    class="btn btn-error bg-red-600 px-8 text-white"
                    type="submit">
                    @lang('pages.users.disable')
                </button>
            </form>
        </div>
    </div>
</dialog>
