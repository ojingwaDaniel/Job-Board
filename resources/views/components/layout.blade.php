<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

<body class="min-h-screen bg-gradient-to-br from-indigo-100 via-teal-50 to-indigo-200 text-slate-700 antialiased">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 py-8">
        {{ $slot }}
    </div>
</body>

</html>
