<x-layout>
    <x-breadcrumbs :links="['My Jobs' => route('my-jobs.index')]" />

    <nav class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
        <ul class="flex justify-between items-center gap-4">
            <li>
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-lg bg-blue-600 flex items-center justify-center shadow-sm">
                        <span class="text-white font-semibold text-lg">
                            {{ strtoupper(substr(auth()->user()->employer->company_name, 0, 1)) }}
                        </span>
                    </div>
                    <div class="leading-tight">
                        <span class="block text-xs uppercase tracking-wider text-gray-500 font-medium">Company</span>
                        <span class="block text-lg font-semibold text-gray-900">
                            {{ auth()->user()->employer->company_name }}
                        </span>
                    </div>
                </div>
            </li>

            <li>
                <x-link-button :href="route('my-jobs.create')"
                    class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                    Create A Job
                </x-link-button>
            </li>
        </ul>
    </nav>

    <x-card class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 border-l-4 border-l-blue-600">
                <h1 class="font-semibold text-2xl text-gray-900">My Jobs</h1>
            </div>

            <div class="p-6 space-y-8">
                @forelse ($myJobs as $myJob)
                    <x-job-card :job="$myJob"
                        class="block border border-gray-200 rounded-xl bg-white overflow-hidden hover:border-blue-300 hover:shadow-md transition">


                        <div class="flex justify-end items-center gap-2 px-5 pt-4">
                            @if (!$myJob->deleted_at)
                              <form action="{{ route('my-jobs.destroy', $myJob) }}" method="post"
                                onsubmit="return confirm('Are you sure you want to delete this job? It can\'t be undone.')">
                                @csrf
                                @method('DELETE')
                                <x-button class="hover:bg-red-300 text-red-600">Delete this Job</x-button>
                            </form>
                            @else
                            <form action="{{ route('my-jobs.restore', $myJob) }}" method="post"
                                onsubmit="return confirm('Are you sure you want to restore this job? It can\'t') ">
                                @csrf
                                @method('PATCH')
                                <x-button class="bg-green-300 text-green-600">Restore this Job</x-button>
                            </form>
                                
                            @endif

                            @can('update', $myJob)
                                <x-link-button :href="route('my-jobs.edit', $myJob)" class="...">
                                    Edit job
                                </x-link-button>
                            @else
                                <span
                                    class="inline-flex items-center text-xs font-medium text-gray-400 bg-gray-50 border border-gray-200 px-3 py-1 rounded-full">
                                    Can't edit this Job
                                </span>
                            @endcan
                        </div>

                        <div class="p-5 divide-y divide-gray-100">
                            @forelse ($myJob->jobApplications as $jobApplication)
                                <div
                                    class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 py-4 first:pt-0 last:pb-0">
                                    <div class="flex items-start gap-3">
                                        <div
                                            class="h-10 w-10 shrink-0 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-medium text-sm">
                                            {{ strtoupper(substr($jobApplication->user->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">
                                                Applicant's name : {{ $jobApplication->user->name }}
                                            </p>
                                            <span class="text-xs text-gray-500">
                                                Applied {{ $jobApplication->created_at->diffForHumans() }}
                                            </span>
                                            <p class="mt-4">
                                                <x-link-button
                                                    class="inline-flex items-center text-sm font-medium text-blue-600 bg-black border border-blue-200 hover:bg-blue-50 hover:border-blue-300 px-3.5 py-1.5 rounded-lg transition shadow-sm">
                                                    View CV
                                                </x-link-button>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="shrink-0">
                                        <span
                                            class="inline-flex items-center text-sm font-semibold text-gray-800 bg-gray-100 px-3 py-1 rounded-full">
                                            Applicant Expected Salary :
                                            ${{ number_format($jobApplication->expected_salary) }}
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <div class="py-6 text-center">
                                    <span class="text-sm text-gray-400">no job Application yet</span>
                                </div>
                            @endforelse
                        </div>
                    </x-job-card>
                @empty
                    <div
                        class="flex flex-col items-center justify-center py-14 text-center bg-gray-50 rounded-xl border border-dashed border-gray-300">
                        <p class="text-sm text-gray-500">
                            No jobs yet — create a job
                            <x-link-button class="block mt-2" :href="route('my-jobs.create')">here!
                            </x-link-button>
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </x-card>
</x-layout>
