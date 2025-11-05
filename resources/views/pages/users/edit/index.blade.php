@extends('layouts.dashboard.index')
@section('title', __('pages.users.edit.title') . ' - HMA Vehicle Booking')

@section('content')
    @include('pages.users._partials.successModal')
    @include('pages.users._partials.failedModal')
    @include('pages.users.edit._partials.breadcrumb')

    <div class="px-container mx-auto grid h-full w-full auto-rows-max grid-cols-12">
        <header class="col-span-12 flex w-full items-center">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                {{ $user->name }}
            </h2>
        </header>

        <section class="col-span-12">
            <div
                class="relative mb-8 h-auto max-w-lg overflow-auto rounded-lg bg-white px-4 py-3 shadow-md dark:bg-gray-800">
                @include('pages.users.edit._partials.updateForm')
            </div>
        </section>
    </div>
@endsection
