<x-layout>
    {{-- ── Breadcrumbs ───────────────────────────────────────────────── --}}
    <x-breadcrumbs :links="['My Job Applications' => route('my-job-applications.index')]" class="mb-4" />

    {{-- ── Page header ───────────────────────────────────────────────── --}}
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">
                Activity
            </p>
            <h1 class="mt-1.5 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
                My applications
            </h1>
            <p class="mt-2 max-w-xl text-sm text-slate-500">
                Track the roles you've applied to and see how your expectations compare.
            </p>
        </div>

        @if ($applications->count())
            <div class="inline-flex items-center gap-2 self-start rounded-full border border-slate-200 bg-white
                        px-3.5 py-1.5 text-xs font-medium text-slate-600
                        sm:self-auto">
                <span class="relative flex h-2 w-2">
                    <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-slate-400 opacity-60"></span>
                    <span class="relative inline-flex h-2 w-2 rounded-full bg-slate-700"></span>
                </span>
                {{ $applications->count() }}
                {{ \Illuminate\Support\Str::plural('application', $applications->count()) }}
            </div>
        @endif
    </div>

    {{-- ── Applications list ─────────────────────────────────────────── --}}
    <div class="space-y-4">
        @forelse ($applications as $application)
            @php
                $applicantCount = max(0, $application->job->job_applications_count - 1);
                $othersAvg = $application->job->job_applications_avg_expected_salary;
                $mine = $application->expected_salary;
                $diff = $othersAvg && $mine ? $mine - $othersAvg : null;
            @endphp

            <x-job-card :job="$application->job">
                {{-- ── Application meta panel ──────────────────────────── --}}
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

                    {{-- Applied --}}
                    <div class="flex items-start gap-3">
                        <span class="grid h-9 w-9 shrink-0 place-items-center rounded-lg
                                     bg-slate-100 text-slate-600">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <circle cx="12" cy="12" r="10"/>
                                <path d="M12 6v6l4 2"/>
                            </svg>
                        </span>
                        <div class="min-w-0">
                            <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-400">
                                Applied
                            </p>
                            <p class="mt-0.5 text-sm font-medium text-slate-800">
                                {{ $application->created_at->diffForHumans() }}
                            </p>
                            <p class="mt-0.5 text-xs text-slate-400">
                                {{ $application->created_at->format('M j, Y') }}
                            </p>
                        </div>
                    </div>

                    {{-- Your asking salary --}}
                    <div class="flex items-start gap-3">
                        <span class="grid h-9 w-9 shrink-0 place-items-center rounded-lg
                                     bg-slate-100 text-slate-600">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                            </svg>
                        </span>
                        <div class="min-w-0">
                            <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-400">
                                Your asking salary
                            </p>
                            <p class="mt-0.5 text-sm font-semibold tabular-nums text-slate-900">
                                ${{ number_format($mine) }}
                            </p>
                            @if ($diff !== null)
                                <p class="mt-0.5 text-xs font-medium tabular-nums
                                          {{ $diff > 0 ? 'text-amber-600' : 'text-emerald-600' }}">
                                    {{ $diff > 0 ? '+' : '' }}${{ number_format(abs($diff)) }}
                                    vs. avg
                                </p>
                            @endif
                        </div>
                    </div>

                    {{-- Others average --}}
                    <div class="flex items-start gap-3">
                        <span class="grid h-9 w-9 shrink-0 place-items-center rounded-lg
                                     bg-slate-100 text-slate-600">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M3 3v18h18"/>
                                <path d="m7 14 4-4 3 3 5-6"/>
                            </svg>
                        </span>
                        <div class="min-w-0">
                            <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-400">
                                Others average
                            </p>
                            <p class="mt-0.5 text-sm font-semibold tabular-nums text-slate-900">
                                @if ($othersAvg)
                                    ${{ number_format($othersAvg) }}
                                @else
                                    <span class="text-slate-400">—</span>
                                @endif
                            </p>
                            @if ($othersAvg)
                                <p class="mt-0.5 text-xs text-slate-400">
                                    Based on other applicants
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- ── Footer: applicant count + actions ──────────────── --}}
                <div class="mt-5 flex flex-wrap items-center justify-between gap-3
                            border-t border-slate-100 pt-4">
                    <div class="inline-flex items-center gap-2 text-xs text-slate-500">
                        <svg class="h-3.5 w-3.5 text-slate-400"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="8.5" cy="7" r="4"/>
                            <path d="M17 11a4 4 0 0 1 0 8"/>
                            <path d="M23 21a4 4 0 0 0-3-3.87"/>
                        </svg>
                        <span>
                            <span class="font-semibold text-slate-700">{{ $applicantCount }}</span>
                            {{ \Illuminate\Support\Str::plural('other applicant', $applicantCount) }}
                            on this job
                        </span>
                    </div>

                    <div class="flex items-center gap-2">
                        <x-link-button
                            :href="route('jobs.show', $application->job)"
                            variant="outline"
                            size="sm"
                            :arrow="false"
                        >
                            View job
                        </x-link-button>

                        <form
                            action="{{ route('my-job-applications.destroy', $application) }}"
                            method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this application?')"
                        >
                            @csrf
                            @method('DELETE')
                            <x-button
                                type="submit"
                                variant="ghost"
                                size="sm"
                                class="text-rose-600 hover:bg-rose-50 hover:text-rose-700"
                            >
                                Delete
                            </x-button>
                        </form>
                    </div>
                </div>
            </x-job-card>
        @empty
            {{-- ── Empty state ────────────────────────────────────────── --}}
            <x-card>
                <div class="flex flex-col items-center justify-center px-6 py-16 text-center">
                    <span class="mb-5 grid h-16 w-16 place-items-center rounded-2xl
                                 bg-slate-100 text-slate-500">
                        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <path d="M14 2v6h6"/>
                            <path d="M9 15h6"/>
                            <path d="M9 11h3"/>
                        </svg>
                    </span>

                    <h3 class="text-lg font-semibold tracking-tight text-slate-900">
                        No applications yet
                    </h3>
                    <p class="mt-1.5 max-w-sm text-sm text-slate-500">
                        When you apply to a job, it will show up here so you can track its status and compare salaries.
                    </p>

                    <x-link-button
                        :href="route('jobs.index')"
                        variant="solid"
                        size="lg"
                        class="mt-6"
                    >
                        Browse jobs
                    </x-link-button>
                </div>
            </x-card>
        @endforelse
    </div>
</x-layout>