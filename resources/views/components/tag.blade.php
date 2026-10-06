{{-- An unexamined life is not worth living. — Socrates --}}
@props([
    'href' => null,
    'color' => 'slate',
])

@php
    $palettes = [
        'slate' => [
            'border-slate-200 bg-slate-50 text-slate-700',
            'hover:border-slate-300 hover:bg-slate-100 hover:text-slate-900',
        ],
        'blue' => [
            'border-blue-200 bg-blue-50 text-blue-700',
            'hover:border-blue-300 hover:bg-blue-100 hover:text-blue-800',
        ],
        'indigo' => [
            'border-indigo-200 bg-indigo-50 text-indigo-700',
            'hover:border-indigo-300 hover:bg-indigo-100 hover:text-indigo-800',
        ],
        'purple' => [
            'border-purple-200 bg-purple-50 text-purple-700',
            'hover:border-purple-300 hover:bg-purple-100 hover:text-purple-800',
        ],
        'teal' => [
            'border-teal-200 bg-teal-50 text-teal-700',
            'hover:border-teal-300 hover:bg-teal-100 hover:text-teal-800',
        ],
        'emerald' => [
            'border-emerald-200 bg-emerald-50 text-emerald-700',
            'hover:border-emerald-300 hover:bg-emerald-100 hover:text-emerald-800',
        ],
        'amber' => [
            'border-amber-200 bg-amber-50 text-amber-700',
            'hover:border-amber-300 hover:bg-amber-100 hover:text-amber-800',
        ],
        'rose' => [
            'border-rose-200 bg-rose-50 text-rose-700',
            'hover:border-rose-300 hover:bg-rose-100 hover:text-rose-800',
        ],
    ];

    $palette = $palettes[$color] ?? $palettes['slate'];
    $tagClasses = implode(' ', $palette);
@endphp

@if ($href)
    <a
        href="{{ $href }}"
        {{ $attributes->class([
            'group/tag inline-flex items-center gap-1.5 rounded-full border px-2.5 py-1',
            'text-xs font-medium',
            'transition-colors duration-150',
            'focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-900/40 focus-visible:ring-offset-2',
            $tagClasses,
        ]) }}
    >
        {{ $slot }}

        {{-- Tiny arrow appears on hover --}}
        <svg
            class="h-2.5 w-2.5 -translate-x-0.5 opacity-0 transition-all duration-150
                   group-hover/tag:translate-x-0 group-hover/tag:opacity-70"
            viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"
        >
            <path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>
        </svg>
    </a>
@else
    <span
        {{ $attributes->class([
            'inline-flex items-center gap-1.5 rounded-full border px-2.5 py-1',
            'text-xs font-medium',
            $tagClasses,
        ]) }}
    >
        {{ $slot }}
    </span>
@endif