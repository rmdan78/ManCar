@extends('layouts.dashboard.index')
@section('title', __('pages.users.title') . ' - HMA Vehicle Booking')

@section('content')
    @include('pages.users._partials.successModal')
    @include('pages.users._partials.failedModal')
    @include('pages.users._partials.breadcrumb')

    <div
        class="px-container mx-auto grid h-full w-full grid-flow-row grid-cols-12 grid-rows-[auto_1fr] overflow-visible xl:grid-rows-[auto_1fr]"
        x-data="{
            userCheckboxes: [],
            selectedUserIds: [],
            isAllUserChecked: false,
            isSomeUserChecked: false,
            isOneUserChecked: false,

            checkAllUserCheckbox(e) {
                const isChecked = e.target.checked
                this.selectedUserIds = []

                this.userCheckboxes.forEach((checkbox) => {
                    checkbox.checked = isChecked
                    checkbox.dispatchEvent(new Event('change'))
                })
            },

            userCheckboxOnChange(e) {
                console.log('hai', e)
                const value = e.target.value

                if (e.target.checked) this.selectedUserIds.push(value)
                else {
                    const index = this.selectedUserIds.indexOf(value)
                    if (index >= 0) this.selectedUserIds.splice(index, 1)
                }
            },
        }"
        x-init="
            userCheckboxes = $refs.usersTable?.querySelectorAll('input.userCheckbox')

            $watch('selectedUserIds', (data) => {
                isAllUserChecked = false
                isSomeUserChecked = false
                isOneUserChecked = false

                if (data?.length === userCheckboxes?.length) isAllUserChecked = true
                if (data?.length >= 1) isSomeUserChecked = true
                if (data?.length === 1) isOneUserChecked = true
            })

            $watch('isAllUserChecked', (value) => {
                $refs.allUserCheckbox.checked = value
            })
        ">
        @include('pages.users._partials.userRecoverConfirm')
        @include('pages.users._partials.userDisableConfirm')
        @include('pages.users._partials.header')

        <div class="card col-span-12 h-full max-h-[calc(100dvh_-_12rem)] w-full overflow-visible bg-base-100 shadow-xl">
            <div class="card-body h-full w-full">
                @include('pages.users._partials.userCardHeader')
                @include('pages.users._partials.userTable')
            </div>
        </div>
    </div>
@endsection
