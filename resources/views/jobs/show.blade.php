<x-layout>
    {{-- ── Breadcrumbs ───────────────────────────────────────────────── --}}
    <x-breadcrumbs :links="['Jobs' => route('jobs.index'), $job->title => '#']" class="mb-6" />

    {{-- ── Job details card ──────────────────────────────────────────── --}}
    <x-job-card :$job class="mb-8">
        {{-- Description --}}
        <div
            class="prose prose-sm max-w-none text-slate-600
                    prose-headings:text-slate-900 prose-headings:font-semibold
                    prose-strong:text-slate-900
                    prose-a:text-slate-900 prose-a:no-underline hover:prose-a:underline">
            {!! nl2br(e($job->description)) !!}
        </div>

        {{-- ── Apply / Already applied ───────────────────────────────── --}}
        <div class="mt-6 border-t border-slate-100 pt-5">

            @guest
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div class="flex items-start gap-3">
                        <span
                            class="grid h-9 w-9 shrink-0 place-items-center rounded-lg
                             bg-slate-100 text-slate-600">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M12 20h9" />
                                <path d="M16.5 3.5a2.121 2.121 0 1 1 3 3L7 19l-4 1 1-4 12.5-12.5z" />
                            </svg>
                        </span>

                        <div class="min-w-0">
                            <p class="text-sm font-semibold text-slate-900">
                                Ready to apply?
                            </p>

                            <p class="mt-0.5 text-xs text-slate-500">
                                Sign in to apply for this job.
                            </p>
                        </div>
                    </div>

                    <x-link-button :href="route('login')" variant="solid" size="lg" class="shrink-0">
                        Sign in to apply
                    </x-link-button>
                </div>
            @else
                @can('apply', $job)
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div class="flex items-start gap-3">
                            <span
                                class="grid h-9 w-9 shrink-0 place-items-center rounded-lg
                                 bg-slate-100 text-slate-600">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M12 20h9" />
                                    <path d="M16.5 3.5a2.121 2.121 0 1 1 3 3L7 19l-4 1 1-4 12.5-12.5z" />
                                </svg>
                            </span>

                            <div class="min-w-0">
                                <p class="text-sm font-semibold text-slate-900">
                                    Ready to apply?
                                </p>

                                <p class="mt-0.5 text-xs text-slate-500">
                                    Takes a minute. You can always edit your application later.
                                </p>
                            </div>
                        </div>

                        <x-link-button :href="route('jobs.application.create', $job)" variant="solid" size="lg" class="shrink-0">
                            Apply now
                        </x-link-button>
                    </div>
                @else
                    <div
                        class="flex items-center gap-3 rounded-lg
                        border border-slate-200 bg-slate-50 px-4 py-3">

                        <span
                            class="grid h-8 w-8 shrink-0 place-items-center rounded-full
                             bg-slate-900 text-white">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M20 6 9 17l-5-5" />
                            </svg>
                        </span>

                        <div class="min-w-0">
                            <p class="text-sm font-semibold text-slate-900">
                                Application submitted
                            </p>

                            <p class="mt-0.5 text-xs text-slate-500">
                                You've already applied for this job. We'll be in touch.
                            </p>
                        </div>
                    </div>
                @endcan

            @endguest

        </div>
    </x-job-card>

    {{-- ── More from employer ────────────────────────────────────────── --}}
    <x-card padding="p-0">
        {{-- Section header --}}
        <div class="flex items-center justify-between gap-4 border-b border-slate-100 px-6 py-4">
            <div class="flex items-center gap-3">
                <span
                    class="grid h-9 w-9 shrink-0 place-items-center rounded-lg
                             bg-slate-900 text-sm font-semibold uppercase text-white">
                    {{ mb_substr($job->employer->company_name, 0, 1) }}
                </span>
                <div class="min-w-0">
                    <h2 class="text-sm font-semibold text-slate-900">
                        More from {{ $job->employer->company_name }}
                    </h2>
                    <p class="text-xs text-slate-500">
                        {{ $job->employer->jobs->count() }}
                        {{ \Illuminate\Support\Str::plural('open role', $job->employer->jobs->count()) }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Job list --}}
        @if ($job->employer->jobs->count())
            <ul class="divide-y divide-slate-100">
                @foreach ($job->employer->jobs as $otherJob)
                    @php $isCurrent = $otherJob->is($job); @endphp
                    <li>
                        <a href="{{ route('jobs.show', $otherJob) }}"
                            class="group/row flex flex-wrap items-center justify-between gap-3
                                  px-6 py-4 transition-colors duration-150
                                  hover:bg-slate-50
                                  focus-visible:outline-none focus-visible:bg-slate-50">
                            <div class="min-w-0">
                                <div class="flex items-center gap-2">
                                    <span
                                        class="truncate font-medium text-slate-800
                                                 transition-colors duration-150
                                                 group-hover/row:text-slate-900">
                                        {{ $otherJob->title }}
                                    </span>
                                    @if ($isCurrent)
                                        <span
                                            class="shrink-0 rounded-full
                                                     bg-slate-900 px-2 py-0.5
                                                     text-[10px] font-semibold uppercase tracking-wide
                                                     text-white">
                                            Current
                                        </span>
                                    @endif
                                </div>
                                <p class="mt-0.5 text-xs text-slate-400">
                                    Posted {{ $otherJob->created_at->diffForHumans() }}
                                </p>
                            </div>

                            <div class="flex items-center gap-3">
                                <span class="text-sm font-semibold tabular-nums text-slate-900">
                                    ${{ number_format($otherJob->salary) }}
                                </span>
                                <svg class="h-3.5 w-3.5 -translate-x-1 text-slate-300 opacity-0
                                            transition-all duration-150
                                            group-hover/row:translate-x-0 group-hover/row:opacity-100
                                            group-hover/row:text-slate-700"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                    stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M5 12h14" />
                                    <path d="m12 5 7 7-7 7" />
                                </svg>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="px-6 py-10 text-center">
                <p class="text-sm text-slate-500">
                    No other open roles from this employer right now.
                </p>
            </div>
        @endif
    </x-card>
</x-layout>
