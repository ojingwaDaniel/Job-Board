    <x-layout>
        <x-breadcrumbs :links="['Jobs' => route('jobs.index'), $job->title => route('jobs.show', $job), 'Apply' => '#']" />
        <x-card>
            <x-job-card :$job></x-job-card>
            <h1 class="text-2xl font-medium">Your Job Application</h1>
            <form action="{{ route('jobs.application.store', $job) }}" method="post">
                @csrf
                <div class="mt-8">
                    <label for="expected_salary" class="block mb-4 text-slate-500">Expected Salary</label>
                    <x-text-input type="number" name="expected_salary" />
                    <x-button class="w-full">Apply</x-button>


                </div>


            </form>
        </x-card>
    </x-layout>
