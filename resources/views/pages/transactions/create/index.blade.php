@extends('layouts.dashboard.index')
@section('title', __('pages.requests.create.title') . ' - HMA Vehicle Booking')

@section('content')
    @include('pages.transactions._partials.successModal')
    @include('pages.transactions._partials.failedModal')
    @include('pages.transactions.create._partials.breadcrumb')

    <div class="px-container mx-auto grid h-full w-full auto-rows-auto grid-cols-12">
        <header class="col-span-12 flex w-full items-center">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                @lang('pages.requests.create.title')
            </h2>
        </header>

        @include('pages.transactions.create._partials.addNewForm')
    </div>
@endsection
