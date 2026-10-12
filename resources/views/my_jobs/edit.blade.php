<x-layout>
    <x-card>
        <x-breadcrumbs :links="['Jobs'=> route('jobs.index'),'My Jobs'=> route('my-jobs.index'),'Edit '.$myJob->title => '']"/>
            <h1 class="font-medium text-center text-3xl mb-4">Edit A Job </h1>
            <form action="{{ route('my-jobs.update',$myJob) }}" method="post">
                @csrf
                @method("PUT")
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-label :required="true">Job Title</x-label>
                        <x-text-input name='title' type="text" placeholder='Mathematics Teacher' :value="$myJob->title"/>
                    </div>
                    <div>
                        <x-label :required="true">Job Location</x-label>
                        <x-text-input name='location' placeholder='Lagos'  :value="$myJob->location" />
                    </div>
                    <div class=" col-span-2">
                        <x-label :required="true">Job Description</x-label>
                        <x-text-input name='description' type="textarea"  :value="$myJob->description" />
                    </div>

                    <div class=" col-span-2">
                        <x-label :required="true">Job Salary</x-label>
                        <x-text-input name='salary' placeholder='$1,000' type="number"  :value="$myJob->salary"/>
                    </div>
                    <div>
                        <x-label :required="true">Experience</x-label>
                        <x-radio-group name='experience' :options="App\Models\Job::$experience" :all-option='false'  :value="$myJob->experience" />
                    </div>
                    <div>
                        <x-label :required="true">Category</x-label>
                        <x-radio-group name='category' :options="App\Models\Job::$category" :all-option='false'  :value="$myJob->category" />
                    </div>
                    <div class=" col-span-2 mt-5">
                        <x-button class="w-full">Edit Job</x-button>
                    </div>



                </div>

            </form>
    </x-card>
</x-layout>
