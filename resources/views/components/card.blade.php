<!-- Nothing worth having comes easy. - Theodore Roosevelt -->
<div
    {{ $attributes->class([
        'bg-white/70 backdrop-blur-sm rounded-2xl shadow-lg border border-white/30 p-6 transition-all duration-300',
        'hover:shadow-xl hover:scale-[1.01]',
    ]) }}>
    {{ $slot }}
</div>
