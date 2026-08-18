<x-layout>
    <x-breadcrumbs :links="['Jobs' => route('jobs.index'), $job->title => '#']" class="mb-6" />

    <x-job-card :$job class="mb-6">
        <div class="text-sm text-slate-600  mb-4">{!! nl2br(e($job->description)) !!}</div>
        <span class="rounded-md bg-blue-900 text-white text-sm p-2 hover:bg-green-600 hover:text-white hover:cursor-pointer" >
            <a href="{{route('jobs.application.create',$job)}}">Apply for this job </a>

        </span>
 

       
   
          

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