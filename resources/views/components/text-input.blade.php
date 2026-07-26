<!-- An unexamined life is not worth living. - Socrates -->
@props(['formId' => null])
<div class="relative">
    @if ($formId)
        <button type="button" class="absolute top-2 right-1.5 "
            onclick="document.getElementById('{{ $name }}').value=''; document.getElementById('{{$formId}}').submit()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-4 text-slate-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>

        </button>
    @endif

    <input type="text"
        class="mb-4 w-full ring-1 ring-slate-300 px-2.5 py-1.5 rounded-md text-sm placeholder:text-slate-300 focus:ring-2"
        placeholder="{{ $placeholder }}" name="{{ $name }}" value="{{ $value }}"
        id="{{ $name }}">

</div>
