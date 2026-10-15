{{-- A job worth doing is worth doing well. --}}
@props(['job'])

<x-card padding="p-0"
    {{ $attributes->merge(['class' => 'group overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm transition duration-300 hover:-translate-y-0.5 hover:border-indigo-200 hover:shadow-xl hover:shadow-indigo-900/5']) }}>
    <div class="p-6">
        {{-- Header: avatar + title + salary --}}
        <div class="flex flex-wrap items-start justify-between gap-4">
            <div class="flex min-w-0 flex-1 items-start gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-sky-500 text-base font-bold text-white shadow-md shadow-indigo-500/20 ring-1 ring-white/20">
                    {{ mb_strtoupper(mb_substr($job->employer->company_name, 0, 1)) }}
                </div>

                <div class="min-w-0">
                    <div class="flex flex-wrap items-center gap-2">
                        <h2 class="text-lg font-semibold tracking-tight text-slate-900 transition-colors group-hover:text-indigo-700 sm:text-xl">
                            {{ $job->title }}
                        </h2>
                        @if ($job->deleted_at)
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-rose-50 px-2.5 py-0.5 text-xs font-medium text-rose-700 ring-1 ring-inset ring-rose-200">
                                <span class="h-1.5 w-1.5 rounded-full bg-rose-500"></span> Deleted
                            </span>
                        @endif
                    </div>

                    <div class="mt-1.5 flex flex-wrap items-center gap-x-3 gap-y-1 text-sm text-slate-500">
                        <span class="inline-flex items-center gap-1.5">
                            <svg class="h-3.5 w-3.5 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M19 21V5a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v16" />
                                <path d="M3 21h18" />
                                <path d="M9 7h1M9 11h1M14 7h1M14 11h1M10 21v-4a2 2 0 0 1 2-2h0a2 2 0 0 1 2 2v4" />
                            </svg>
                            <span class="truncate">{{ $job->employer->company_name }}</span>
                        </span>

                        <span class="h-3.5 w-px bg-slate-200" aria-hidden="true"></span>

                        <span class="inline-flex items-center gap-1.5">
                            <svg class="h-3.5 w-3.5 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0z" />
                                <circle cx="12" cy="10" r="3" />
                            </svg>
                            <span class="truncate">{{ $job->location }}</span>
                        </span>
                    </div>
                </div>
            </div>

            {{-- Salary badge --}}
            <div class="shrink-0 rounded-xl bg-slate-50 px-4 py-2 text-right ring-1 ring-inset ring-slate-200">
                <span class="block text-[10px] font-medium uppercase tracking-wider text-slate-400">Salary</span>
                <span class="block text-base font-semibold tabular-nums text-slate-900">
                    ${{ number_format($job->salary) }}<span class="ml-1 text-xs font-medium text-slate-500">/ yr</span>
                </span>
            </div>
        </div>

        {{-- Tags --}}
        <div class="mt-5 flex flex-wrap gap-2">
            <x-tag :href="route('jobs.index', ['experience' => $job->experience])" color="slate">
                {{ Str::ucfirst($job->experience) }}
            </x-tag>
            <x-tag :href="route('jobs.index', ['category' => $job->category])" color="slate">
                {{ $job->category }}
            </x-tag>
        </div>

        {{-- Slot (description / actions) --}}
        @if (trim($slot ?? '') !== '')
            <div class="mt-6 border-t border-slate-100 pt-5">
                {{ $slot }}
            </div>
        @endif
    </div>
</x-card>