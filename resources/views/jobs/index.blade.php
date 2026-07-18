<x-layout>
    <x-breadcrumbs :links="['Jobs'=> route('jobs.index')]" class="mb-4"></x-breadcrumbs>

    @foreach ($jobs as $job)
        <x-job-card class="mb-4" :$job>
           <div>
            <x-link-button :href="route('jobs.show',$job)">Show Details</x-link-button>
            </div>
             
        </x-job-card>
    @endforeach
</x-layout>