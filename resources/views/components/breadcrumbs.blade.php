<!-- An unexamined life is not worth living. - Socrates -->
@props(['links'])
<nav {{ $attributes->merge(['class' => 'text-sm mb-6']) }} aria-label="Breadcrumb">
    <ol class="flex items-center space-x-2">
        <li>
            <a href="/" class="text-indigo-600 hover:underline hover:text-indigo-800 transition">Home</a>
        </li>
        @foreach ($links as $label => $link)
            <li class="flex items-center space-x-2">
                <span class="text-slate-400">›</span>
                @if ($loop->last)
                    <span class="font-medium text-slate-700">{{ $label }}</span>
                @else
                    <a href="{{ $link }}" class="text-indigo-600 hover:underline hover:text-indigo-800 transition">{{ $label }}</a>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
