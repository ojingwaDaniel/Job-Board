{{-- Happiness is not something readymade. It comes from your own actions. — Dalai Lama --}}
@props([
    'href' => '#',
    'variant' => 'solid',   // solid | outline | ghost
    'size' => 'md',         // sm | md | lg
    'arrow' => true,        // show sliding arrow on hover
])

@php
    $base = 'group/btn inline-flex items-center justify-center rounded-lg font-semibold '
          . 'transition-colors duration-150 '
          . 'focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-900/40 focus-visible:ring-offset-2';

    $sizes = [
        'sm' => 'px-3 py-1.5 text-xs',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-5 py-2.5 text-sm',
    ];

    $variants = [
        'solid'   => 'bg-slate-900 text-white hover:bg-slate-800',
        'outline' => 'border border-slate-200 bg-white text-slate-700 '
                   . 'hover:border-slate-300 hover:bg-slate-50 hover:text-slate-900',
        'ghost'   => 'text-slate-600 hover:bg-slate-100 hover:text-slate-900',
    ];
@endphp

<a
    href="{{ $href }}"
    {{ $attributes->class([
        $base,
        $sizes[$size] ?? $sizes['md'],
        $variants[$variant] ?? $variants['solid'],
    ]) }}
>
    {{ $slot }}

    @if ($arrow)
        {{-- Sliding arrow: -ml-3 cancels the w-3 so it reserves zero width at rest --}}
        <svg
            class="h-3 w-3 -ml-3 opacity-0 transition-all duration-150
                   group-hover/btn:ml-0 group-hover/btn:opacity-100"
            viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
            aria-hidden="true"
        >
            <path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>
        </svg>
    @endif
</a>