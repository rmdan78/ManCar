@if (session()->has('success'))
    <dialog
        x-data
        x-init="$el.showModal()"
        class="modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <form method="dialog">
                <button class="btn btn-circle btn-ghost btn-sm absolute right-2 top-2">✕</button>
            </form>
            <div class="flex flex-col items-center overflow-hidden md:flex-row">
                <lottie-player
                    src="https://lottie.host/04e99f11-26d7-46fb-9081-2c8663f6b31f/ZFQQ1onOOC.json"
                    background=""
                    speed="1"
                    autoplay
                    loop
                    direction="1"
                    mode="normal"
                    class="flex h-full max-w-40 grow basis-0 scale-150 items-center md:grow-[4]"></lottie-player>
                <div class="flex h-full grow basis-0 flex-col justify-center md:grow-[8]">
                    <h3 class="my-2 text-center text-lg font-bold uppercase text-success md:text-left">
                        @lang('globals.successfull')
                    </h3>
                    <p class="mb-4 max-h-32 overflow-auto break-all">{{ session()->get('success') }}</p>
                    <small>@lang('globals.pressESCKeyOrClickOnXButtonToClose')</small>
                </div>
            </div>
        </div>
    </dialog>
@endif
