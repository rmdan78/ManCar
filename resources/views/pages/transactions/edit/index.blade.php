@extends('layouts.dashboard.index')
@section('title', __('pages.requests.edit.title') . ' - HMA Vehicle Booking')

@section('content')
    @include('pages.transactions._partials.successModal')
    @include('pages.transactions._partials.failedModal')
    @include('pages.transactions.edit._partials.breadcrumb')

    <div class="px-container mx-auto grid w-full grid-cols-12 grid-rows-[auto_1fr]">
        <header class="col-span-12 flex w-full items-center">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                @lang('pages.requests.edit.title')
            </h2>
            <div
                class="badge ml-2 shrink-0 font-bold"
                style="
                    background-color: {{ $transaction->status->settings['color'] }}2A;
                    color: {{ $transaction->status->settings['color'] }};
                ">
                {{ Str::upper($transaction->status->name) }}
            </div>
        </header>

        @include('pages.transactions.edit._partials.updateForm')
    </div>
@endsection
