<div
    x-show="isSideMenuOpen"
    x-transition:enter="transition duration-150 ease-in-out"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition duration-150 ease-in-out"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-40 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"></div>
<aside
    class="fixed inset-y-0 z-50 mt-16 w-72 flex-shrink-0 overflow-x-visible bg-white px-4 md:hidden dark:bg-base-100"
    x-show="isSideMenuOpen"
    x-transition:enter="transition duration-150 ease-in-out"
    x-transition:enter-start="-translate-x-20 transform opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition duration-150 ease-in-out"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="-translate-x-20 transform opacity-0"
    @click.away="closeSideMenu"
    @keydown.escape="closeSideMenu">
    @include('layouts.dashboard._partials.sidebarContent')
</aside>
