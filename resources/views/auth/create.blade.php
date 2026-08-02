<x-layout>
    <h1 class=" text-4xl font-medium text-center mb-8 text-slate-600">Sign in to your Account</h1>
    <x-card>
        <form action="{{ route('auth.store') }}" method="POST">
            <div>
                <label for="email" class=" mb-2 block">Email</label>
                <x-text-input name="email" type="email" placeholder="email address" />
            </div>
             <div>
                <label for="password" class=" mb-2 block">Password</label>
                <x-text-input name="password" type="password" placeholder="Password" />
            </div>
        </form>

    </x-card>
</x-layout>
