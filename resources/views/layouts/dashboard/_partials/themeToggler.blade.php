<li
    title="Switch Theme"
    class="dropdown dropdown-end">
    <label
        tabindex="0"
        role="button"
        class="btn btn-ghost btn-sm gap-0 px-1 text-primary-600"
        aria-label="Language">
        <div class="swap swap-rotate">
            <input
                type="checkbox"
                x-on:change="toggleTheme"
                :checked="dark"
                class="hidden" />
            <x-icon.feather.moon class="swap-on size-5 fill-current" />
            <x-icon.feather.sun class="swap-off size-5 fill-current" />
        </div>
    </label>
</li>
