<!DOCTYPE html>

<html
    x-data="initialData"
    {{-- :data-theme="dark ? 'dark' : 'light'" --}}
    lang="{{ App::currentLocale() }}">
    <head>
        <meta charset="UTF-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0" />
        <title>@yield('title', 'HMA Vehicle Booking')</title>
        <link
            rel="icon"
            href="/images/logo.webp" />
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
            rel="stylesheet" />
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

        @vite(['resources/css/layouts/dashboard/index.css'])
        @yield('head')
    </head>
    <body>
        <div
            class="flex h-screen w-full bg-gray-50 dark:bg-gray-900"
            :class="{ 'overflow-hidden': isSideMenuOpen}">
            @include('layouts.dashboard._partials.sidebar')
            @include('layouts.dashboard._partials.mobileSidebar')

            <div class="flex w-full flex-1 flex-col overflow-auto">
                @include('layouts.dashboard._partials.navbar')

                <main class="flex w-full shrink-0 grow flex-col overflow-y-auto">
                    @yield('content')
                    @include('layouts.dashboard._partials.footer')
                </main>
            </div>
        </div>

        @vite(['resources/js/layouts/dashboard/index.js'])
        @yield('scripts')
    </body>
</html>
