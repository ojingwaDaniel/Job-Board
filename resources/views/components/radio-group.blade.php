{{-- He who is contented is rich. — Laozi --}}
@props([
    'name',
    'options' => [],
    'allLabel' => 'All',
    'showAll' => true,
])

@php
    $current = request($name);

    $chipBase = 'inline-flex items-center gap-1.5 rounded-full border bg-white '
              . 'px-3 py-1.5 text-xs font-medium '
              . 'transition-colors duration-150 '
              . 'peer-focus-visible:ring-2 peer-focus-visible:ring-slate-900/40 peer-focus-visible:ring-offset-2';

    // Idle: light slate border, muted text
    $chipIdle = 'border-slate-200 text-slate-600 hover:border-slate-300 hover:bg-slate-50 hover:text-slate-900';

    // Selected: solid dark — matches the "Get started" button and user avatar
    $chipActive = 'border-slate-900 bg-slate-900 text-white';

    $dotBase = 'grid h-3 w-3 place-items-center rounded-full border transition-colors duration-150';

    // Idle dot: hollow with slate border
    $dotIdle = 'border-slate-300';

    // Selected dot: white fill on the dark chip
    $dotActive = 'border-white bg-white';

    // Checkmark color on the dark chip
    $checkColor = 'text-slate-900';
@endphp

<div
    role="radiogroup"
    aria-label="{{ $attributes->get('aria-label', Str::headline($name)) }}"
    {{ $attributes->class(['flex flex-wrap items-center gap-2']) }}
>
    @if ($showAll)
        <label class="relative inline-flex cursor-pointer select-none">
            <input
                type="radio"
                name="{{ $name }}"
                value=""
                @checked(!$current)
                class="peer sr-only"
            >
            <span class="{{ $chipBase }} {{ $chipIdle }}
                         peer-checked:border-slate-900 peer-checked:bg-slate-900 peer-checked:text-white">
                <span class="{{ $dotBase }} {{ $dotIdle }}
                             peer-checked:border-white peer-checked:bg-white" aria-hidden="true">
                    <svg class="h-2 w-2 {{ $checkColor }} opacity-0 transition-opacity duration-150
                                peer-checked:opacity-100"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="4" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 6 9 17l-5-5"/>
                    </svg>
                </span>
                {{ $allLabel }}
            </span>
        </label>
    @endif

    @foreach ($options as $option)
        <label class="relative inline-flex cursor-pointer select-none">
            <input
                type="radio"
                name="{{ $name }}"
                value="{{ $option }}"
                @checked($current === (string) $option)
                class="peer sr-only"
            >
            <span class="{{ $chipBase }} {{ $chipIdle }}
                         peer-checked:border-slate-900 peer-checked:bg-slate-900 peer-checked:text-white">
                <span class="{{ $dotBase }} {{ $dotIdle }}
                             peer-checked:border-white peer-checked:bg-white" aria-hidden="true">
                    <svg class="h-2 w-2 {{ $checkColor }} opacity-0 transition-opacity duration-150
                                peer-checked:opacity-100"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="4" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 6 9 17l-5-5"/>
                    </svg>
                </span>
                {{ Str::ucfirst($option) }}
            </span>
        </label>
    @endforeach
</div>