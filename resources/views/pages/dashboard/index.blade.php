@extends('layouts.dashboard.index')
@section('title', __('pages.dashboard.title') . ' - HMA Vehicle Booking')

@section('head')
    @vite(['resources/css/custom/fullcalendar.css'])
@endsection

@section('content')
    <section class="px-container mx-auto grid h-auto min-h-full w-full auto-rows-min grid-cols-12 gap-6">
        <header class="col-span-12 flex w-full items-center">
            <h2 class="mt-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                @lang('pages.dashboard.title')
            </h2>
        </header>

        @canany(['approve', 'reject'], \App\Models\Vehicle\Transaction\Transaction::class)
            <div class="col-span-12">
                <div
                    class="stats stats-vertical grid grid-cols-12 overflow-hidden border border-base-200 lg:stats-horizontal">
                    <div
                        class="stat col-span-12 w-full bg-base-100 transition-all hover:scale-105 hover:shadow-lg lg:col-span-4">
                        <div class="stat-figure text-secondary">
                            <x-icon.feather.users class="size-6 text-blue-600" />
                        </div>
                        <div class="stat-title mb-2 text-blue-600">
                            Total
                            @lang('globals.user')
                        </div>
                        <div class="stat-value mb-2 text-blue-600">{{ \App\Models\User\User::count() }}</div>
                        <div class="stat-desc max-w-40 text-wrap">@lang('pages.dashboard.stats.usersDesc')</div>
                    </div>

                    <div
                        class="stat col-span-12 w-full bg-base-100 transition-all hover:scale-105 hover:shadow-lg lg:col-span-4">
                        <div class="stat-figure text-secondary">
                            <x-icon.feather.truck class="size-6 text-violet-600" />
                        </div>
                        <div class="stat-title mb-2 text-violet-600">
                            Total
                            @lang('pages.vehicles.title')
                        </div>
                        <div class="stat-value mb-2 text-violet-600">{{ \App\Models\Vehicle\Vehicle::count() }}</div>
                        <div class="stat-desc max-w-40 text-wrap">@lang('pages.dashboard.stats.vehiclesDesc')</div>
                    </div>

                    <div
                        class="stat col-span-12 w-full bg-base-100 transition-all hover:scale-105 hover:shadow-lg lg:col-span-4">
                        <div class="stat-figure text-secondary">
                            <x-icon.feather.fileText class="size-6 text-primary-600" />
                        </div>
                        <div class="stat-title mb-2 text-primary-600">
                            Total
                            @lang('pages.requests.title')
                        </div>
                        <div class="stat-value mb-2 text-primary-600">
                            {{ \App\Models\Vehicle\Transaction\Transaction::count() }}
                        </div>
                        <div class="stat-desc max-w-40 text-wrap">@lang('pages.dashboard.stats.requestsDesc')</div>
                    </div>
                </div>
            </div>

            <div class="card col-span-12 w-full border border-base-200 bg-base-100 md:col-span-6">
                <div class="card-body h-full w-full">
                    <h2 class="card-title mb-3 text-base font-normal">
                        @lang('pages.requests.title')
                    </h2>
                    <canvas
                        id="requestsChart"
                        height="280"
                        class="h-full w-full"></canvas>
                </div>
            </div>

            <div class="card col-span-12 h-full max-h-96 w-full border border-base-200 bg-base-100 md:col-span-6">
                <div class="card-body h-full w-full overflow-auto">
                    <h2 class="card-title mb-3 text-base font-normal">@lang('pages.dashboard.topUsers')</h2>
                    <div
                        id="topUsersChart"
                        class="flex h-full w-full flex-col overflow-auto">
                        <table
                            x-ref="transactionsTable"
                            id="transactionsTable"
                            class="table table-zebra table-sm lg:table-md">
                            <thead class="sticky top-0 z-10 bg-base-100">
                                <tr>
                                    <th class="!pt-0">@lang('globals.name')</th>
                                    <th class="!pt-0 text-center">@lang('globals.total')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($topUsers as $user)
                                    <tr class="w-full border-b border-base-200 p-4">
                                        <td class="flex items-center gap-3">
                                            <div class="avatar">
                                                <div class="mask mask-squircle h-10 w-10 bg-base-300">
                                                    <img
                                                        src="{{ ($picture = $user->profilePicture?->uri) ? \StorageHelper::url($picture) : '/images/illustrations/user.svg' }}"
                                                        alt="Avatar" />
                                                </div>
                                            </div>
                                            <div>
                                                <div class="text-xs font-bold sm:text-sm">{{ $user->name }}</div>
                                                <div class="text-xs opacity-50 sm:text-sm">{{ $user->email }}</div>
                                            </div>
                                        </td>
                                        <td class="ml-auto text-center text-lg font-extrabold text-blue-600">
                                            {{ $user->transactions_count }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endcanany

        <div class="card col-span-12 h-auto min-h-[calc(100dvh-5rem)] w-full border border-base-200 bg-base-100">
            <div class="card-body h-full w-full">
                <div
                    id="transactionCalendar"
                    class="h-full w-full"></div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        const charts = @json($charts);
        const langs = @json($langs);
        const locale = '{{ $locale }}';
    </script>
    @vite(['resources/js/pages/dashboard/index.js'])
@endsection
