<x-layout>
    <x-breadcrumbs :links="['Jobs' => route('jobs.index')]" class="mb-4"></x-breadcrumbs>
    <x-card class="mb-4">
        <form action="{{ route('jobs.index') }}" method="GET">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <h4 class="mb-1">Search</h4>
                    <x-text-input name="search" value="{{ request('search') }}"
                        placeholder="Search for any text of your interest"></x-text-input>
                </div>
                <div>
                    <h4 class="mb-1">Salary</h4>
                    <div class="flex gap-4 items-center">
                        <x-text-input name="min_salary" value="{{ request('min_salary') }}"
                            placeholder="From"></x-text-input>
                        <x-text-input name="max_salary" value="{{ request('max_salary') }}"
                            placeholder="To"></x-text-input>
                    </div>
                </div>
                <div class="mb-4">
                    <h4 class="mb-1">Experience</h4>
                    <x-radio-group name="experience" :options="App\Models\Job::$experience" />



                </div>
                <div class="mb-4">
                    <h4 class="mb-1">Category</h4>
                    <x-radio-group name="category" :options="App\Models\Job::$category" />



                </div>
            </div>
            <div>
                <button type="submit" class=" border border-slate-300 py-1 px-1.5">Filter</button>
                <a href="{{ route('jobs.index') }}" class="rounded-md border py-1 px-1.5 border-slate-300">Reset</a>


            </div>


        </form>

    </x-card>
    @forelse ($jobs as $job)
        <x-job-card class="mb-4" :$job>
            <div>
                <x-link-button :href="route('jobs.show', $job)">Show Details</x-link-button>
            </div>

        </x-job-card>

    @empty
        <x-card>
            <div>
                No jobs is available within your filter
            </div>
        </x-card>
    @endforelse

</x-layout>
