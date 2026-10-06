{{-- An unexamined life is not worth living. — Socrates --}}
@props(['links' => []])

<nav {{ $attributes->merge(['class' => 'mb-6']) }} aria-label="Breadcrumb">
    <ol class="flex flex-wrap items-center gap-y-1.5 text-sm">
        {{-- Home --}}
        <li class="flex items-center">
            <a href="/"
               class="group inline-flex items-center gap-1.5 rounded-lg px-2 py-1 font-medium
                      text-slate-500 transition-colors duration-150
                      hover:bg-slate-100 hover:text-slate-900
                      focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/40">
                <svg class="h-3.5 w-3.5 text-slate-400 transition-colors duration-150
                            group-hover:text-indigo-600"
                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M3 10.5 12 3l9 7.5"/>
                    <path d="M5 9.5V21h14V9.5"/>
                </svg>
                <span>Home</span>
            </a>
        </li>

        @foreach ($links as $label => $link)
            @php $isLast = $loop->last; @endphp

            <li class="flex items-center">
                {{-- Separator --}}
                <span class="mx-0.5 flex select-none items-center text-slate-300" aria-hidden="true">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m9 18 6-6-6-6"/>
                    </svg>
                </span>

                @if ($isLast)
                    {{-- Current page --}}
                    <span aria-current="page"
                          class="inline-flex items-center gap-1.5 rounded-lg bg-indigo-50 px-2.5 py-1
                                 text-sm font-semibold text-indigo-700 ring-1 ring-inset ring-indigo-500/15">
                        <span class="h-1.5 w-1.5 rounded-full bg-indigo-500 shadow-[0_0_0_3px_rgba(99,102,241,0.15)]"></span>
                        {{ $label }}
                    </span>
                @else
                    {{-- Intermediate link --}}
                    <a href="{{ $link }}"
                       class="group inline-flex items-center gap-1.5 rounded-lg px-2 py-1 font-medium
                              text-slate-500 transition-colors duration-150
                              hover:bg-slate-100 hover:text-slate-900
                              focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/40">
                        {{ $label }}
                        <svg class="h-3 w-3 -translate-x-0.5 opacity-0 transition-all duration-150
                                    group-hover:translate-x-0 group-hover:opacity-100 text-indigo-600"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>
                        </svg>
                    </a>
                @endif
            </li>
        @endforeach
    </ol>
</nav>