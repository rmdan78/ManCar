@extends('layouts.dashboard.index')
@section('title', __('pages.vehicles.edit.title') . ' - HMA Vehicle Booking')

@section('content')
    @include('pages.vehicles._partials.successModal')
    @include('pages.vehicles._partials.failedModal')
    @include('pages.vehicles.edit._partials.breadcrumb')

    <div class="px-container mx-auto grid h-full w-full auto-rows-max grid-cols-12">
        <header class="col-span-12 flex w-full items-center">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                {{ $vehicle->name }}
            </h2>
        </header>

        <section class="col-span-12">
            <div
                class="relative mb-8 h-auto max-w-lg overflow-auto rounded-lg bg-white px-4 py-3 shadow-md dark:bg-gray-800">
                @include('pages.vehicles.edit._partials.updateForm')
            </div>
        </section>
    </div>
@endsection
