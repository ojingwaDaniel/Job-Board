<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gradient-to-br from-indigo-100 via-teal-50 to-indigo-200 text-slate-700 antialiased">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 py-8">



        <nav class="flex justify-between text-2xl font-medium items-center">
            <ul>
                <li>
                    <a href="/">Home</a>
                </li>
            </ul>

            <ul class="flex space-x-2.5">
                @auth
                    <li>
                        {{ auth()->user()->name ?? 'Guest' }}
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            @method('Delete')
                            <button>Logout</button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}">Sign In</a></li>
                @endauth

            </ul>
        </nav>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="text-red-500">
                    {{$error}}
                </div>
            @endforeach

        @endif
        @if (session('success'))
            <div class=" my-8 p-4 rounded-md border-l-4 border-green-300 bg-green-100 text-green-900">
                <p>Success !!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif
        {{ $slot }}
    </div>
</body>

</html>
