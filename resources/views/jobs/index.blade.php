<x-layout>
    <x-breadcrumbs :links="['Jobs' => route('jobs.index')]" class="mb-4"></x-breadcrumbs>
    <x-card class="mb-6" x-data>
        <form x-ref="filters" action="{{ route('jobs.index') }}" method="GET" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
             
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1">Search</label>
                    <x-text-input name="search" value="{{ request('search') }}" placeholder="Job title, keywords…"
                        formRef="filters"
                        class="w-full rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-indigo-500" />
                </div>
           
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1">Salary</label>
                    <div class="flex gap-3">
                        <x-text-input name="min_salary" value="{{ request('min_salary') }}" placeholder="Min"
                            formRef="filters"
                            class="w-1/2 rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-indigo-500" />
                        <x-text-input name="max_salary" value="{{ request('max_salary') }}" placeholder="Max"
                            formRef="filters"
                            class="w-1/2 rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-indigo-500" />
                    </div>
                </div>
            </div>

          
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h4 class="text-sm font-medium text-slate-600 mb-2">Experience</h4>
                    <x-radio-group name="experience" :options="App\Models\Job::$experience" class="flex flex-wrap gap-3" />
                </div>
                <div>
                    <h4 class="text-sm font-medium text-slate-600 mb-2">Category</h4>
                    <x-radio-group name="category" :options="App\Models\Job::$category" class="flex flex-wrap gap-3" />
                </div>
            </div>

      
            <div class="flex flex-col sm:flex-row gap-3 pt-2">
                <x-button type="submit"
                    class="flex-1 justify-center bg-gradient-to-r from-indigo-600 to-teal-500 hover:from-indigo-700 hover:to-teal-600 text-white shadow-md hover:shadow-lg transition-all duration-200">
                    Apply Filters
                </x-button>
                <a href="{{ route('jobs.index') }}"
                    class="flex-1 justify-center text-center rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 hover:border-slate-400 transition-colors">
                    Reset
                </a>
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
