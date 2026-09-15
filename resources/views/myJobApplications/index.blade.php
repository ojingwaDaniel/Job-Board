<x-layout>
    <x-breadcrumbs :links="['My Job Applications'=> route('my-job-applications.index')]">

    </x-breadcrumbs>
    @forelse ($applications as $application)
        <x-job-card :job="$application->job"></x-job-card>
    @empty
        
    @endforelse
</x-layout>