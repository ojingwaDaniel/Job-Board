{{-- A job worth doing is worth doing well. --}}
@props(['job'])

<x-card padding="p-0" class="overflow-hidden">
    <div class="p-6">
        {{-- ── Header: title + salary ─────────────────────────────────── --}}
        <div class="flex flex-wrap items-start justify-between gap-3">
            <div class="min-w-0 flex-1">
                <h2 class="text-lg font-semibold tracking-tight text-slate-900 sm:text-xl">
                    {{ $job->title }}
                </h2>

                {{-- Employer + location --}}
                <div class="mt-1.5 flex flex-wrap items-center gap-x-3 gap-y-1 text-sm text-slate-500">
                    <span class="inline-flex items-center gap-1.5">
                        <svg class="h-3.5 w-3.5 text-slate-400"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M19 21V5a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v16"/>
                            <path d="M3 21h18"/>
                            <path d="M9 7h1M9 11h1M14 7h1M14 11h1M10 21v-4a2 2 0 0 1 2-2h0a2 2 0 0 1 2 2v4"/>
                        </svg>
                        <span class="truncate">{{ $job->employer->company_name }}</span>
                    </span>

                    <span class="h-3.5 w-px bg-slate-200" aria-hidden="true"></span>

                    <span class="inline-flex items-center gap-1.5">
                        <svg class="h-3.5 w-3.5 text-slate-400"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                        <span class="truncate">{{ $job->location }}</span>
                    </span>
                </div>
            </div>

            {{-- Salary badge --}}
            <div class="inline-flex shrink-0 items-center gap-1.5 rounded-lg
                        border border-slate-200 bg-slate-50 px-3 py-1.5">
                <svg class="h-3.5 w-3.5 text-slate-500"
                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                </svg>
                <span class="text-sm font-semibold tabular-nums text-slate-900">
                    ${{ number_format($job->salary) }}
                </span>
                <span class="text-xs font-medium text-slate-500">/ yr</span>
            </div>
        </div>

        {{-- ── Tags ───────────────────────────────────────────────────── --}}
        <div class="mt-4 flex flex-wrap gap-2">
            <x-tag :href="route('jobs.index', ['experience' => $job->experience])" color="slate">
                {{ Str::ucfirst($job->experience) }}
            </x-tag>
            <x-tag :href="route('jobs.index', ['category' => $job->category])" color="slate">
                {{ $job->category }}
            </x-tag>
        </div>

        {{-- ── Slot (description / actions) ───────────────────────────── --}}
        @if (trim($slot ?? '') !== '')
            <div class="mt-5 border-t border-slate-100 pt-5">
                {{ $slot }}
            </div>
        @endif
    </div>
</x-card>