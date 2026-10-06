    <x-layout>
        <x-breadcrumbs :links="['Jobs' => route('jobs.index'), $job->title => route('jobs.show', $job), 'Apply' => '#']" />
        <x-card>
            <x-job-card :$job></x-job-card>
            <h1 class="text-2xl font-medium mt-20">Your Job Application</h1>
            <form action="{{ route('jobs.application.store', $job) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mt-8">
                    <x-label for="expected_salary" required="true">Expected Salary</x-label>
                    <x-text-input type="number" name="expected_salary" />
                    <x-label for="cv" class="mt-5 mb-5
                    block text-slate-500" required="true">Upload CV</x-label>
                    <x-text-input type='file' name='cv'  id="cv"/>
                    <x-button class="w-full mt-5">Apply</x-button>


                </div>


            </form>
        </x-card>
    </x-layout>
