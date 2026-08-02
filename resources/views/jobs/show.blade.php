<x-layout>
    <x-breadcrumbs :links="['Jobs' => route('jobs.index'), $job->title => '#']" class="mb-6" />

    <x-job-card :$job class="mb-6">
        <p class="text-sm text-slate-600 leading-relaxed mb-4">{!! nl2br(e($job->description)) !!}</p>
    </x-job-card>

    <x-card class="mb-6">
        <h2 class="text-lg font-semibold text-slate-800 mb-4">More from {{ $job->employer->company_name }}</h2>
        <div class="divide-y divide-slate-200">
            @foreach ($job->employer->jobs as $otherJob)
                <div class="flex flex-wrap justify-between items-center py-3 first:pt-0 last:pb-0">
                    <div>
                        <a href="{{ route('jobs.show', $otherJob) }}"
                           class="text-indigo-700 hover:text-indigo-900 hover:underline font-medium transition">
                            {{ $otherJob->title }}
                        </a>
                        <div class="text-xs text-slate-400">{{ $otherJob->created_at->diffForHumans() }}</div>
                    </div>
                    <div class="text-sm font-medium text-emerald-600">${{ number_format($otherJob->salary) }}</div>
                </div>
            @endforeach
        </div>
    </x-card>
</x-layout>