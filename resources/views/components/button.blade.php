{{-- I begin to speak only when I am certain what I will say is not better left unsaid. — Cato the Younger --}}
@props([
    'variant' => 'solid',   // solid | outline | ghost
    'size' => 'md',         // sm | md | lg
    'type' => 'submit',
])

@php
    $base = 'inline-flex items-center justify-center gap-2 rounded-lg font-semibold '
          . 'transition-colors duration-150 '
          . 'focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-900/40 focus-visible:ring-offset-2 '
          . 'disabled:cursor-not-allowed disabled:opacity-50';

    $sizes = [
        'sm' => 'px-3 py-1.5 text-xs',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-5 py-2.5 text-sm',
    ];

    $variants = [
        // Primary — matches the "Get started" button and selected radio chips
        'solid' => 'bg-slate-900 text-white hover:bg-slate-800',

        // Secondary — white surface, hairline border
        'outline' => 'border border-slate-200 bg-white text-slate-700 '
                   . 'hover:border-slate-300 hover:bg-slate-50 hover:text-slate-900',

        // Tertiary — no border, tinted hover
        'ghost' => 'text-slate-600 hover:bg-slate-100 hover:text-slate-900',
    ];
@endphp

<button
    type="{{ $type }}"
    {{ $attributes->class([
        $base,
        $sizes[$size] ?? $sizes['md'],
        $variants[$variant] ?? $variants['solid'],
    ]) }}
>
    {{ $slot }}
</button>