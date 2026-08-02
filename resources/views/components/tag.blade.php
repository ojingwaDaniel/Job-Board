
    <!-- An unexamined life is not worth living. - Socrates -->
@props(['href', 'color'])

@php
$colors = [
    'blue'   => 'bg-blue-100 text-blue-800 hover:bg-blue-200',
    'purple' => 'bg-purple-100 text-purple-800 hover:bg-purple-200',
    

];

@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => "inline-flex items-center px-3 py-1 rounded-full text-xs font-medium transition-colors $colors[$color]"]) }}>
    {{ $slot }}
</a>