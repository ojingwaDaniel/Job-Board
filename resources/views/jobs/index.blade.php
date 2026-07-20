<x-layout>
    <x-breadcrumbs :links="['Jobs' => route('jobs.index')]" class="mb-4"></x-breadcrumbs>
    <x-card class="mb-4">
        <form action="{{ route('jobs.index') }}" method="GET">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <h4 class="mb-1">Search</h4>
                    <x-text-input name="search" value="{{request('search')}}"
                        placeholder="Search for any text of your interest"></x-text-input>
                </div>
                <div>
                    <h4 class="mb-1">Salary</h4>
                    <div class="flex gap-4">
                        <x-text-input name="min_salary" value="{{request('min_salary')}}" placeholder="From"></x-text-input>
                        <x-text-input name="max_salary" value="{{request('max_salary')}}" placeholder="To"></x-text-input>
                    </div>
                </div>
                <div class="flex flex-col mb-4">
                    <h4 class="mb-1">Experience</h4>
                    <label>
                        <input type="radio" name="experience"/>
                        All
                    </label>
                    <label>
                        <input type="radio" name="experience" value="entry"/>
                        Entry
                    </label><label>
                        <input type="radio" name="experience" value="intermediate"/>
                        Intermediate
                    </label>
                     </label><label>
                        <input type="radio" name="experience" value="senior"/>
                        Senior
                    </label>
                </div>
            </div>
            <button type="submit" class="w-full border border-slate-300">Filter</button>

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
