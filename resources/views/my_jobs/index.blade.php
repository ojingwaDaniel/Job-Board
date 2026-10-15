<x-layout>
    <x-breadcrumbs :links="['My Jobs' => route('my-jobs.index')]" />

    @php
        $totalApplications = $myJobs->sum(fn($job) => $job->jobApplications->count());
        $companyName = auth()->user()->employer->company_name;
    @endphp

    <div class="min-h-screen bg-gradient-to-b from-slate-50 via-white to-slate-50">
        <div class="mx-auto max-w-5xl px-4 pb-20 pt-8 sm:px-6 lg:px-8">

            {{-- Header --}}
            <header class="relative overflow-hidden rounded-3xl bg-slate-900 px-6 py-8 shadow-xl shadow-slate-900/10 sm:px-10 sm:py-10">
                <div class="pointer-events-none absolute -right-20 -top-24 h-72 w-72 rounded-full bg-indigo-500/30 blur-3xl"></div>
                <div class="pointer-events-none absolute -bottom-24 left-10 h-64 w-64 rounded-full bg-sky-500/20 blur-3xl"></div>

                <div class="relative flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center gap-4">
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-500 to-sky-500 text-xl font-bold text-white shadow-lg shadow-indigo-500/30 ring-1 ring-white/20">
                            {{ mb_strtoupper(mb_substr($companyName, 0, 1)) }}
                        </div>
                        <div class="leading-tight">
                            <span class="block text-[11px] font-semibold uppercase tracking-[0.18em] text-slate-400">Employer workspace</span>
                            <h1 class="mt-1 text-2xl font-semibold tracking-tight text-white sm:text-3xl">{{ $companyName }}</h1>
                        </div>
                    </div>

                    <a href="{{ route('my-jobs.create') }}"
                        class="group inline-flex items-center justify-center gap-2 rounded-xl bg-white px-5 py-3 text-sm font-semibold text-slate-900 shadow-sm transition hover:bg-slate-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-slate-900">
                        <svg class="h-4 w-4 transition-transform group-hover:rotate-90" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Create a job
                    </a>
                </div>

                {{-- Stats --}}
                <dl class="relative mt-8 grid grid-cols-2 gap-3 sm:max-w-md">
                    <div class="rounded-2xl bg-white/5 px-5 py-4 ring-1 ring-white/10 backdrop-blur">
                        <dt class="text-xs font-medium text-slate-400">Jobs posted</dt>
                        <dd class="mt-1 text-2xl font-semibold text-white">{{ $myJobs->count() }}</dd>
                    </div>
                    <div class="rounded-2xl bg-white/5 px-5 py-4 ring-1 ring-white/10 backdrop-blur">
                        <dt class="text-xs font-medium text-slate-400">Total applicants</dt>
                        <dd class="mt-1 text-2xl font-semibold text-white">{{ $totalApplications }}</dd>
                    </div>
                </dl>
            </header>

            {{-- Section title --}}
            <div class="mb-5 mt-12 flex items-end justify-between">
                <div>
                    <h2 class="text-xl font-semibold tracking-tight text-slate-900">My jobs</h2>
                    <p class="mt-1 text-sm text-slate-500">Manage your listings and review incoming applications.</p>
                </div>
            </div>

            <div class="space-y-6">
                @forelse ($myJobs as $myJob)
                    <x-job-card :job="$myJob"
                        class="block overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm ring-1 ring-transparent transition duration-300 hover:-translate-y-0.5 hover:border-indigo-200 hover:shadow-xl hover:shadow-indigo-900/5">

                        {{-- Actions bar --}}
                        <div class="flex flex-wrap items-center justify-between gap-3 border-t border-slate-100 bg-slate-50/60 px-5 py-3">
                            <div>
                                @if ($myJob->deleted_at)
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-rose-50 px-2.5 py-1 text-xs font-medium text-rose-700 ring-1 ring-inset ring-rose-200">
                                        <span class="h-1.5 w-1.5 rounded-full bg-rose-500"></span> Deleted
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 ring-1 ring-inset ring-emerald-200">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Active
                                    </span>
                                @endif
                            </div>

                            <div class="flex items-center gap-2">
                                @can('update', $myJob)
                                    <a href="{{ route('my-jobs.edit', $myJob) }}"
                                        class="inline-flex items-center gap-1.5 rounded-lg bg-white px-3.5 py-2 text-xs font-semibold text-slate-700 shadow-sm ring-1 ring-inset ring-slate-200 transition hover:bg-slate-50 hover:text-slate-900 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500">
                                        <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                        Edit
                                    </a>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-400 ring-1 ring-inset ring-slate-200">
                                        Can't edit this job
                                    </span>
                                @endcan

                                @if (!$myJob->deleted_at)
                                    <form action="{{ route('my-jobs.destroy', $myJob) }}" method="post"
                                        onsubmit="return confirm('Are you sure you want to delete this job? It can\'t be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center gap-1.5 rounded-lg px-3.5 py-2 text-xs font-semibold text-rose-600 ring-1 ring-inset ring-rose-200 transition hover:bg-rose-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-rose-500">
                                            <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm4 0a1 1 0 112 0v6a1 1 0 11-2 0V8z" clip-rule="evenodd" />
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('my-jobs.restore', $myJob) }}" method="post"
                                        onsubmit="return confirm('Are you sure you want to restore this job?')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="inline-flex items-center gap-1.5 rounded-lg bg-emerald-600 px-3.5 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500 focus-visible:ring-offset-2">
                                            Restore
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>

                        {{-- Applications --}}
                        <div class="border-t border-slate-100 px-5 py-5">
                            <div class="mb-4 flex items-center justify-between">
                                <h3 class="text-sm font-semibold text-slate-900">Applications</h3>
                                <span class="rounded-full bg-indigo-50 px-2.5 py-0.5 text-xs font-semibold text-indigo-700 ring-1 ring-inset ring-indigo-100">
                                    {{ $myJob->jobApplications->count() }}
                                </span>
                            </div>

                            <div class="space-y-3">
                                @forelse ($myJob->jobApplications as $jobApplication)
                                    <div class="flex flex-col gap-4 rounded-xl border border-slate-100 bg-white p-4 transition hover:border-slate-200 hover:bg-slate-50/50 sm:flex-row sm:items-center sm:justify-between">
                                        <div class="flex items-center gap-3.5">
                                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-indigo-100 to-sky-100 text-sm font-semibold text-indigo-700 ring-1 ring-inset ring-indigo-200/60">
                                                {{ mb_strtoupper(mb_substr($jobApplication->user->name, 0, 2)) }}
                                            </div>
                                            <div class="min-w-0">
                                                <p class="truncate text-sm font-semibold text-slate-900">{{ $jobApplication->user->name }}</p>
                                                <p class="mt-0.5 text-xs text-slate-500">Applied {{ $jobApplication->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>

                                        <div class="flex flex-wrap items-center gap-3 sm:justify-end">
                                            <div class="rounded-lg bg-slate-50 px-3 py-1.5 ring-1 ring-inset ring-slate-200">
                                                <span class="block text-[10px] font-medium uppercase tracking-wider text-slate-400">Expected salary</span>
                                                <span class="block text-sm font-semibold text-slate-900">${{ number_format($jobApplication->expected_salary) }}</span>
                                            </div>

                                            <a href="{{ route('job-application.viewCv', $jobApplication) }}" target="_blank" rel="noopener"
                                                class="inline-flex items-center gap-1.5 rounded-lg bg-slate-900 px-4 py-2.5 text-xs font-semibold text-white shadow-sm transition hover:bg-slate-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-slate-900 focus-visible:ring-offset-2">
                                                <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                                                </svg>
                                                View CV
                                            </a>
                                        </div>
                                    </div>
                                @empty
                                    <div class="flex flex-col items-center justify-center rounded-xl border border-dashed border-slate-200 bg-slate-50/50 py-8 text-center">
                                        <svg class="h-8 w-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                        </svg>
                                        <p class="mt-2 text-sm font-medium text-slate-500">No applications yet</p>
                                        <p class="text-xs text-slate-400">Applicants will appear here as they apply.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </x-job-card>
                @empty
                    <div class="flex flex-col items-center justify-center rounded-3xl border border-dashed border-slate-300 bg-white px-6 py-20 text-center shadow-sm">
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600 ring-1 ring-inset ring-indigo-100">
                            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </div>
                        <h3 class="mt-5 text-lg font-semibold text-slate-900">No jobs yet</h3>
                        <p class="mt-1 max-w-sm text-sm text-slate-500">Post your first job to start receiving applications from candidates.</p>
                        <a href="{{ route('my-jobs.create') }}"
                            class="mt-6 inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                            Create your first job
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-layout>