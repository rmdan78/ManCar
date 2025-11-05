@extends('layouts.auth.index')
@section('title', __('pages.auth.signIn.title') . ' - HMA Vehicle Booking')

@section('content')
    <div
        class="px-container flex h-full min-h-dvh w-full flex-col items-center justify-center bg-gray-50 dark:bg-gray-900">
        <div class="mx-auto mt-auto w-full max-w-4xl overflow-hidden rounded-lg bg-white shadow-xl dark:bg-gray-800">
            <main class="flex flex-col overflow-y-auto md:flex-row">
                <div class="h-32 md:h-auto md:w-1/2">
                    <img
                        aria-hidden="true"
                        class="h-full w-full object-cover dark:hidden"
                        src="{{ asset('images/stocks/hma-login-illustration.webp') }}"
                        alt="Office" />
                    <img
                        aria-hidden="true"
                        class="hidden h-full w-full object-cover dark:block"
                        src="{{ asset('images/stocks/hma-login-illustration.webp') }}"
                        alt="Office" />
                </div>

                <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                    <form
                        class="w-full"
                        method="POST"
                        action="{{ route('signIn.post') }}">
                        <h1 class="mb-4 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                            @lang('pages.auth.signIn.title')
                            <span class="block text-sm font-normal opacity-80">
                                <span>@lang('globals.into')</span>
                                <span class="text-primary-600">@lang('globals.APP_NAME')</span>
                            </span>
                        </h1>

                        @csrf

                        <label class="form-control mb-2 w-full">
                            <div class="label">
                                <span class="label-text">
                                    @lang('pages.auth.signIn.username')
                                </span>
                            </div>
                            <input
                                type="text"
                                name="username"
                                placeholder="@lang('pages.auth.signIn.usernamePlaceholder')"
                                class="input input-bordered w-full" />
                        </label>

                        <label class="form-control mb-2 w-full">
                            <div class="label">
                                <span class="label-text">@lang('pages.auth.signIn.password')</span>
                            </div>
                            <input
                                type="password"
                                name="password"
                                placeholder="@lang('pages.auth.signIn.passwordPlaceholder')"
                                class="input input-bordered w-full" />
                        </label>

                        <button
                            type="submit"
                            class="btn btn-primary mt-4 w-full">
                            @lang('pages.auth.signIn.submit')
                        </button>

                        {{--
                            <p class="mt-4">
                            <a
                            class="text-primary text-sm font-medium hover:underline"
                            href="">
                            @lang('pages.auth.signIn.forgotPassword')
                            </a>
                            </p>
                        --}}
                    </form>
                </div>
            </main>
        </div>

        @include('layouts.dashboard._partials.footer')
    </div>
@endsection
