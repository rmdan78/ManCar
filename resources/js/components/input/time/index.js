const defaultTimeInputs = document.querySelectorAll('input.customTimeInputForValue[type="time"]');

function validateInput(val) {
    return fillString(val.replace(/[^0-9]+/g, "").substring(0,2), 2, '0');
};

function fillString(value, length, character) {
    return `${character.repeat(length)}${value}`.slice(-length);
}

function startActions(defaultTimeInput) {
    const customInputs = defaultTimeInput?.nextElementSibling?.querySelectorAll('input[type="number"]');
    const time = {};

    function initDefaultValue() {
        const val = defaultTimeInput.value;
        if(!val) return;

        const splitedVal = val.split(':');
        customInputs[0].value = splitedVal[0];
        customInputs[1].value = splitedVal[1];
    }

    initDefaultValue();
    defaultTimeInput.addEventListener('change', initDefaultValue);

    customInputs.forEach((input) => {
        time[input.dataset.type] = input.value ?? '00';

        input.addEventListener('focus', () => input.select());
        input.addEventListener('input', (e) => {
            const validatedValue = validateInput(e.target.value);
            input.value = validatedValue;

            time[e.target.dataset.type] = validatedValue;
            defaultTimeInput.value = Object.values(time)?.join(':');
            defaultTimeInput.dispatchEvent(new Event('change'));
            defaultTimeInput.dispatchEvent(new Event('input'));
        })
    });
}

defaultTimeInputs.forEach(element => startActions(element));
