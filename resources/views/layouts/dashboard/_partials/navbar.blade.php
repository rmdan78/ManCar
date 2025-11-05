<header class="z-40 w-full bg-base-100 py-4 shadow-md">
    <div class="px-container mx-auto flex h-full items-center justify-between">
        @include('layouts.dashboard._partials.mobileHumberger')

        <ul class="ml-auto flex flex-shrink-0 items-center space-x-4">
            {{-- @include('layouts.dashboard._partials.themeToggler') --}}
            {{-- @include('layouts.dashboard._partials.notificationsMenu') --}}
            @include('layouts.dashboard._partials.translateMenu')
        </ul>
    </div>
</header>
