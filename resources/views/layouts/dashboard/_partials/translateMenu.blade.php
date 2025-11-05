<li
    title="Change Language"
    class="dropdown dropdown-end">
    <button
        tabindex="0"
        class="btn btn-ghost btn-sm gap-0 px-1"
        aria-label="Language">
        <x-icon.flowbite.language class="size-6" />
        <x-icon.flowbite.chevronDown class="size-6" />
    </button>
    <div
        tabindex="0"
        class="dropdown-content top-px mt-16 max-h-[calc(100vh-10rem)] w-56 overflow-y-auto rounded-box border border-white/5 bg-base-200 text-base-content shadow-2xl outline outline-1 outline-black/5">
        <ul class="menu menu-sm gap-1">
            <li>
                <a
                    href="{{ '?lang=en' }}"
                    class="@if(\App::currentLocale() == 'en') active @endif">
                    <span
                        class="badge badge-outline badge-sm !pl-1.5 !pr-1 pt-px font-mono !text-[.6rem] font-bold tracking-widest opacity-50">
                        EN
                    </span>
                    <span class="font-[sans-serif]">English</span>
                </a>
            </li>
            <li>
                <a
                    href="{{ '?lang=id' }}"
                    class="@if(\App::currentLocale() == 'id') active @endif">
                    <span
                        class="badge badge-outline badge-sm !pl-1.5 !pr-1 pt-px font-mono !text-[.6rem] font-bold tracking-widest opacity-50">
                        ID
                    </span>
                    <span class="font-[sans-serif]">Indonesia</span>
                </a>
            </li>
        </ul>
    </div>
</li>
