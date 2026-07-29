<x-layout>
    <x-breadcrumbs :links="['Jobs' => route('jobs.index'), $job->title => '#']" class="mb-4"></x-breadcrumbs>
    <x-job-card :$job>
        <p class="text-sm text-slate-500 mb-4">{!! nl2br(e($job->description)) !!}</p>

    </x-job-card>
    <x-card>
        <h2 class=" text-lg mb-4">More {{$job->employer->company_name}} jobs</h2>
        @foreach ($job->employer->jobs as $otherJob)
           <div class="flex justify-between mb-4">
             <div>
                <a href="{{route("jobs.show",$otherJob)}}" class=" text-blue-900 text-medium hover:underline">{{$otherJob->title}}</a>
                <div>{{$otherJob->created_at->diffForHumans()}}</div>
             </div>
             <div>${{number_format($otherJob->salary)}}</div>
           </div>
            
        @endforeach

    </x-card>
</x-layout>
