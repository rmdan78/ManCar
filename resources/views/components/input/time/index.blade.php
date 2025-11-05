@props([
    'class' => '',
    'seconds' => false,
])

<input
    {{ $attributes->except('style', 'tabindex') }}
    @class(['customTimeInputForValue', $class])
    type="time"
    tabindex="-1"
    style="width: 0; height: 0; opacity: 0 !important" />

<div
    {{ $attributes->only(['style', 'disabled']) }}
    @class(['customTimeInput', $class])>
    <div class="customTimeInput_inputGroup">
        <label>
            <input
                @disabled($attributes['disabled'])
                data-type="hours"
                type="number"
                class="customTimeInput_inputGroup_hours"
                value="00"
                step="1"
                min="0"
                max="23"
                maxlength="2" />
        </label>

        <label>
            <input
                @disabled($attributes['disabled'])
                data-type="minutes"
                type="number"
                class="customTimeInput_inputGroup_minutes"
                value="00"
                step="1"
                min="0"
                max="59"
                maxlength="2" />
        </label>

        @if ($seconds)
            <label>
                <input
                    @disabled($attributes['disabled'])
                    data-type="seconds"
                    type="number"
                    class="customTimeInput_inputGroup_seconds"
                    value="00"
                    step="1"
                    min="0"
                    max="59" />
            </label>
        @endif
    </div>
</div>
