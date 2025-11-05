<div class="flex h-full flex-col py-4 text-base-content">
    <div
        class="mb-2 flex w-full items-center rounded-xl bg-primary-50 px-4 py-6 transition-all duration-300 dark:bg-primary-50 dark:bg-opacity-10">
        <div class="avatar mr-4">
            <div class="w-12 rounded-xl bg-gradient-primary p-1 dark:bg-opacity-70">
                <img src="{{ '/images/logo/hma-nobackground.webp' }}" />
            </div>
        </div>

        <div class="flex flex-col items-start">
            <a
                class="w-full text-sm font-bold text-base-content"
                href="#">
                H. M. A.
            </a>
            <small class="text-xs font-semibold text-base-content/50">VEHICLE BOOKING</small>
        </div>
    </div>

    <ul class="sidemenu menu w-full rounded-lg">
        @include('layouts.dashboard._partials.sidemenu.dashboard.index')
        @include('layouts.dashboard._partials.sidemenu.transactions.index')
        @include('layouts.dashboard._partials.sidemenu.vehicles.index')

        @can('view', App\Models\User\User::class)
            @include('layouts.dashboard._partials.sidemenu.users.index')
        @endcan
    </ul>

    <div class="dropdown dropdown-top mb-2 mt-auto w-full">
        <div
            tabindex="0"
            role="button"
            class="btn mt-4 flex h-auto w-full flex-nowrap justify-start gap-0 rounded-xl border-0 bg-base-100 bg-cover p-4 text-start shadow-xl dark:bg-base-300">
            <div class="avatar mr-4">
                <div class="mask mask-squircle size-10 bg-base-300/60">
                    <img
                        src="{{ session('user')->profilePicture?->uri ? \StorageHelper::url(session('user')->profilePicture?->uri) : '/images/illustrations/user.svg' }}" />
                </div>
            </div>
            <div class="shrink-1 z-10 flex w-3/4 flex-col">
                <h6
                    class="shrink-1 overflow-hidden text-ellipsis whitespace-nowrap text-sm font-bold text-base-content">
                    {{ session('user')->name }}
                </h6>
                <small class="text-xs text-base-content text-base-content/50">
                    {{ session('user')->roles[0]->name }}
                </small>
            </div>
        </div>

        <div
            class="dropdown-content absolute flex w-dvw max-w-72 flex-col items-center rounded-xl border border-slate-400/50 bg-base-100/50 p-4 shadow-lg backdrop-blur-lg md:max-w-96">
            <div class="mb-4 flex w-full flex-col items-center rounded-xl text-center">
                <div class="avatar mb-2">
                    <div class="mask mask-squircle size-20 bg-base-300">
                        <img
                            src="{{ session('user')->profilePicture?->uri ? \StorageHelper::url(session('user')->profilePicture?->uri) : '/images/illustrations/user.svg' }}" />
                    </div>
                </div>
                <div class="z-10 flex w-full flex-col items-center">
                    <small class="badge badge-neutral mb-1 text-xs">
                        {{ session('user')->roles[0]->name }}
                    </small>
                    <h6 class="break-words text-lg font-bold text-base-content">
                        {{ session('user')->name }}
                    </h6>
                </div>
            </div>

            <a
                href="{{ route('profile.edit') }}"
                class="btn btn-outline btn-sm mb-4 w-full rounded-full shadow-none">
                <x-icon.feather.editCircle />
                <span>@lang('globals.updateProfile')</span>
            </a>

            <div class="join join-vertical mb-4 w-full">
                {{--
                    <div class="dark:base-300/10 join-item w-full border-0 bg-base-300/30 hover:bg-base-300/50">
                    <button class="btn w-full cursor-not-allowed border-0 !bg-transparent shadow-none">
                    <x-icon.feather.plusCircle />
                    <span>@lang('globals.addOtherHMAAccount')</span>
                    </button>
                    </div>
                --}}
                <form
                    action="{{ route('signOut.delete') }}"
                    method="POST"
                    class="join-item w-full border-0 bg-base-300/30 hover:bg-base-300/50">
                    @method('DELETE')
                    @csrf
                    <button
                        type="submit"
                        class="btn w-full border-0 !bg-transparent text-red-600 shadow-none">
                        <x-icon.feather.logOut />
                        <span>@lang('globals.signOut')</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
