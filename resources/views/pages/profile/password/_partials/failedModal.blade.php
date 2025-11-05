@error('error')
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
                    src="https://lottie.host/f49526d3-ac72-459c-b178-571d48ab912d/ofyPJjQSIK.json"
                    background=""
                    speed="1"
                    autoplay
                    loop
                    direction="1"
                    mode="normal"
                    class="flex h-full max-w-40 grow basis-0 scale-125 items-center md:grow-[4]"></lottie-player>
                <div class="flex h-full grow basis-0 flex-col justify-center md:grow-[8]">
                    <h3 class="my-2 break-words text-center text-lg font-bold uppercase text-error md:text-left">
                        @lang('globals.failed')
                    </h3>
                    <p class="mb-4 max-h-32 overflow-auto break-all">{{ $message }}</p>
                    <small>@lang('globals.pressESCKeyOrClickOnXButtonToClose')</small>
                </div>
            </div>
        </div>
    </dialog>
@enderror
