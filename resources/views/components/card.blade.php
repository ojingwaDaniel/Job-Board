{{-- Nothing worth having comes easy. — Theodore Roosevelt --}}
@props([
    'interactive' => false,
    'padding' => 'p-6',
])

<div
    {{ $attributes->class([
        // Base surface
        'rounded-xl border border-slate-200 bg-white',
        'shadow-sm shadow-slate-900/[0.04]',
        // Padding
        $padding,
        // Smooth transitions
        'transition-colors duration-150',
        // Interactive states (opt-in)
        $interactive ? 'hover:border-slate-300' : '',
    ]) }}
>
    {{ $slot }}
</div>