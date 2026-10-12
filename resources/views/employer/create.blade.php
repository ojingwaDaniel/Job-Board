<x-layout>
     <h1 class=" font-medium text-4xl text-center mb-4">Create An Employer's Account</h1>
    <x-card>
       
        <form action="{{route('employer.store')}}" method="POST">
            @csrf
            <div>
                <x-label for="company_name" required="true">Company Name</x-label>
            <x-text-input type="text" id="company_name" placeholder="e.g Microsoft" name="company_name" />
            </div>
            <x-button class="w-full mt-4"> Create </x-button>
        </form>
    </x-card>
</x-layout>