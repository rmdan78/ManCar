@extends('layouts.dashboard.index')
@section('title', __('pages.vehicles.title') . ' - HMA Vehicle Booking')

@section('content')
    @include('pages.vehicles._partials.successModal')
    @include('pages.vehicles._partials.failedModal')
    @include('pages.vehicles._partials.breadcrumb')

    <div class="px-container mx-auto grid h-full w-full auto-rows-max grid-cols-12">
        @include('pages.vehicles._partials.header')

        <section
            class="col-span-12 grid grid-flow-row grid-cols-1 gap-6 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4"
            x-data="{ deleteId: null, deleteTitle: null }">
            @foreach ($vehicles as $vehicle)
                @include('pages.vehicles._partials.vehicleCard')
            @endforeach

            @include('pages.vehicles._partials.vehicleDeleteConfirm')
        </section>
    </div>
@endsection
