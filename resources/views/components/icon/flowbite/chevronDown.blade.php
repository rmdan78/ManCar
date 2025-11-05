@props(['class' => 'size-6'])

<svg
    {{
        $attributes->merge([
            'class' => $class,
        ])
    }}
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 24 24"
    width="24"
    height="24"
    stroke="currentColor"
    stroke-width="2"
    fill="none"
    stroke-linecap="round"
    stroke-linejoin="round"
    aria-hidden="true">
    <path
        stroke="currentColor"
        stroke-linecap="round"
        stroke-linejoin="round"
        stroke-width="2"
        d="m8 10 4 4 4-4" />
</svg>
