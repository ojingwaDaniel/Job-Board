<x-layout>
    <h1 class=" text-4xl font-medium text-center mb-8 text-slate-600">Sign in to your Account</h1>
    <x-card>
        
        <form action="{{ route('auth.store') }}" method="POST">
            @csrf
            <div>
                <label for="email" class=" mb-2 block">Email</label>
                <x-text-input name="email" type="email" placeholder="email address"/>
            </div>
            <div>
                <label for="password" class=" mb-2 block">Password</label>
                <x-text-input name="password" type="password" placeholder="Password" />
            </div>
            <div class="flex justify-between mb-8">
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="remember" id="remember">
                    <label>Remember me</label>
                </div>
                <div>
                    <a href="#" class=" hover:underline text-blue-700">Forget Password</a>
                </div>

            </div>
            <x-button class="w-full">Login</x-button>
        </form>

    </x-card>
</x-layout>
