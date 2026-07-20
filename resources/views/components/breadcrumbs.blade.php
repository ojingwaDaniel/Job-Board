<!-- An unexamined life is not worth living. - Socrates -->
@props(['links'])
<nav {{ $attributes }}>
    <ul class="flex space-x-3 ">
        <li>
            <a href="/">Home</a>
        </li>
        @foreach ($links as $label => $link)
            <li>→</li>
            <li>
                <a href="{{ $link }}">{{ $label }}</a>
            </li>
        @endforeach

    </ul>
</nav>
