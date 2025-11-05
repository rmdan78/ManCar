<div class="h-full overflow-x-auto">
    <table
        x-ref="usersTable"
        id="usersTable"
        class="table table-zebra table-sm lg:table-md">
        <thead class="sticky top-0 z-10 bg-base-100">
            <tr>
                <th>
                    <label>
                        <input
                            x-ref="allUserCheckbox"
                            id="checkAllUser"
                            type="checkbox"
                            class="checkbox checkbox-sm"
                            x-on:click="checkAllUserCheckbox" />
                    </label>
                </th>
                <th>@lang('pages.users.tableFields.name')</th>
                <th>@lang('pages.users.tableFields.roles')</th>
                <th>@lang('pages.users.tableFields.status')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th>
                        <label>
                            <input
                                type="checkbox"
                                class="userCheckbox checkbox checkbox-sm"
                                value="{{ $user->id }}"
                                x-on:change="userCheckboxOnChange" />
                        </label>
                    </th>
                    <td>
                        <div class="flex min-w-40 items-center gap-3">
                            <div class="avatar">
                                <div class="mask mask-squircle h-12 w-12 bg-base-300">
                                    <img
                                        src="{{ $user->profilePicture?->uri ? \StorageHelper::url($user->profilePicture?->uri) : '/images/illustrations/user.svg' }}"
                                        alt="Avatar" />
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <div class="font-bold">
                                    {{ $user->name }}
                                </div>
                                <small class="text-sm opacity-50">
                                    {{ $user->employee_id }}
                                </small>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="flex min-w-40 flex-col items-start">
                          <div class="font-bold">
                            {{ $user->roles->first()?->name ?? '-' }}
                        </div>
                            <small class="text-sm opacity-50">{{ $user->email }}</small>
                        </div>
                    </td>
                    <td>
                        <div class="flex min-w-36 flex-col">
                            <div class="font-bold">
                                @if ($user->deleted_at)
                                    <span class="text-red-600">DISABLED</span>
                                @else
                                    <span class="text-green-600">ACTIVE</span>
                                @endif
                            </div>
                            <small class="text-sm opacity-50">
                                {{ $user->updated_at->format('Y/m/d H:i') }}
                            </small>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
