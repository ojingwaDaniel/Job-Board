<x-layout>
    {{-- ── Breadcrumbs ───────────────────────────────────────────────── --}}
    <x-breadcrumbs :links="['Jobs' => route('jobs.index')]" class="mb-4" />

    {{-- ── Page heading ───────────────────────────────────────────────── --}}
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.14em] text-indigo-600">
                Opportunities
            </p>
            <h1 class="mt-1.5 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
                Find your next role
            </h1>
            <p class="mt-2 max-w-xl text-sm text-slate-500">
                Browse curated positions from teams shipping meaningful work.
            </p>
        </div>

        {{-- Result count chip --}}
        <div class="inline-flex items-center gap-2 self-start rounded-full border border-slate-200 bg-white
                    px-3.5 py-1.5 text-xs font-medium text-slate-600
                    sm:self-auto">
            <span class="relative flex h-2 w-2">
                <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-60"></span>
                <span class="relative inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
            </span>
            {{ $jobs->count() }} {{ \Illuminate\Support\Str::plural('job', $jobs->count()) }} available
        </div>
    </div>

    {{-- ── Filters ────────────────────────────────────────────────────── --}}
    <x-card class="mb-8" x-data>
        <div class="flex items-center gap-2.5 border-b border-slate-100 px-5 py-4 sm:px-6">
            <span class="grid h-8 w-8 place-items-center rounded-lg bg-indigo-50 text-indigo-600">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M22 3H2l8 9.46V19l4 2v-8.54L22 3z"/>
                </svg>
            </span>
            <div>
                <h2 class="text-sm font-semibold text-slate-900">Filters</h2>
                <p class="text-xs text-slate-500">Narrow down by keywords, salary, and fit</p>
            </div>
        </div>

        <form x-ref="filters" action="{{ route('jobs.index') }}" method="GET"
              class="space-y-6 px-5 py-6 sm:px-6">

            {{-- Row 1: Search + Salary --}}
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <div>
                    <label for="search"
                           class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-500">
                        Search
                    </label>
                    <div class="relative">
                        <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3
                                     text-slate-400">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/>
                            </svg>
                        </span>
                        <x-text-input name="search" value="{{ request('search') }}"
                            placeholder="Job title, keywords…"
                            formRef="filters"
                            class="w-full pl-9" />
                    </div>
                </div>

                <div>
                    <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-500">
                        Salary range
                    </label>
                    <div class="flex items-center gap-2">
                        <x-text-input name="min_salary" value="{{ request('min_salary') }}"
                            placeholder="Min"
                            formRef="filters"
                            class="flex-1" />
                        <span class="h-px w-3 shrink-0 bg-slate-300" aria-hidden="true"></span>
                        <x-text-input name="max_salary" value="{{ request('max_salary') }}"
                            placeholder="Max"
                            formRef="filters"
                            class="flex-1" />
                    </div>
                </div>
            </div>

            {{-- Divider --}}
            <div class="border-t border-dashed border-slate-200"></div>

            {{-- Row 2: Experience + Category --}}
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <h3 class="mb-2.5 text-xs font-semibold uppercase tracking-wide text-slate-500">
                        Experience
                    </h3>
                    <x-radio-group name="experience" :options="App\Models\Job::$experience"
                        class="flex flex-wrap gap-2" />
                </div>
                <div>
                    <h3 class="mb-2.5 text-xs font-semibold uppercase tracking-wide text-slate-500">
                        Category
                    </h3>
                    <x-radio-group name="category" :options="App\Models\Job::$category"
                        class="flex flex-wrap gap-2" />
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex flex-col gap-3 border-t border-slate-100 pt-5 sm:flex-row">
                <x-button type="submit"
                    class="group inline-flex flex-1 items-center justify-center gap-2 rounded-lg
                           bg-indigo-600 px-5 py-2.5
                           text-sm font-semibold text-white
                           transition-colors duration-150
                           hover:bg-indigo-700
                           focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/40
                           focus-visible:ring-offset-2">
                    <svg class="h-4 w-4 transition-transform duration-150 group-hover:scale-110"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/>
                    </svg>
                    Apply filters
                </x-button>

                <a href="{{ route('jobs.index') }}"
                   class="inline-flex flex-1 items-center justify-center gap-2 rounded-lg
                          border border-slate-200 bg-white px-5 py-2.5 text-sm font-medium text-slate-700
                          transition-colors duration-150
                          hover:border-slate-300 hover:bg-slate-50
                          focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-400/40
                          focus-visible:ring-offset-2">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M3 12a9 9 0 1 0 3-6.7L3 8"/><path d="M3 3v5h5"/>
                    </svg>
                    Reset
                </a>
            </div>
        </form>
    </x-card>

    {{-- ── Results ────────────────────────────────────────────────────── --}}
    <div class="space-y-4">
        @forelse ($jobs as $job)
            <x-job-card :$job>
                <div>
                    <x-link-button :href="route('jobs.show', $job)">
                        Show details
                    </x-link-button>
                </div>
            </x-job-card>
        @empty
            {{-- Empty state --}}
            <x-card>
                <div class="flex flex-col items-center justify-center px-6 py-14 text-center">
                    <span class="mb-5 grid h-16 w-16 place-items-center rounded-2xl
                                 bg-indigo-50 text-indigo-600">
                        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/>
                            <path d="M8 11h6"/>
                        </svg>
                    </span>

                    <h3 class="text-lg font-semibold tracking-tight text-slate-900">
                        No jobs match your filters
                    </h3>
                    <p class="mt-1.5 max-w-sm text-sm text-slate-500">
                        Try broadening your salary range or removing a filter to see more opportunities.
                    </p>

                    <a href="{{ route('jobs.index') }}"
                       class="mt-6 inline-flex items-center gap-2 rounded-lg
                              bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white
                              transition-colors duration-150
                              hover:bg-slate-800
                              focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-900/40
                              focus-visible:ring-offset-2">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M3 12a9 9 0 1 0 3-6.7L3 8"/><path d="M3 3v5h5"/>
                        </svg>
                        Clear filters
                    </a>
                </div>
            </x-card>
        @endforelse
    </div>
</x-layout>