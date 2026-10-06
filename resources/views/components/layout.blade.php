<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#ffffff">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', ui-sans-serif, system-ui, -apple-system, sans-serif; }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(8px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body class="flex min-h-screen flex-col bg-white text-slate-700 antialiased
             selection:bg-indigo-100 selection:text-indigo-900">

    {{-- ── Header ──────────────────────────────────────────────────────── --}}
    <header class="sticky top-0 z-40 border-b border-slate-200 bg-white">
        <div class="mx-auto flex h-16 w-full max-w-4xl items-center justify-between px-4 sm:px-6">

            {{-- Brand --}}
            <a href="/" class="group flex items-center gap-2.5 rounded-lg focus-visible:outline-none
                               focus-visible:ring-2 focus-visible:ring-indigo-500/40 focus-visible:ring-offset-2">
                <span class="grid h-9 w-9 place-items-center rounded-lg
                             bg-indigo-600 text-white
                             transition duration-200 group-hover:bg-indigo-700">
                    <svg class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <rect x="2" y="7" width="20" height="14" rx="2"/>
                        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                    </svg>
                </span>
                <span class="text-[15px] font-semibold tracking-tight text-slate-900">
                    {{ config('app.name', 'Laravel') }}
                </span>
            </a>

            {{-- Navigation --}}
            <nav class="flex items-center gap-1 sm:gap-1.5">
                @auth
                    <a href="{{ route('my-job-applications.index') }}"
                       class="group inline-flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium
                              text-slate-600 transition-colors duration-150
                              hover:bg-slate-100 hover:text-slate-900
                              focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/40">
                        <svg class="h-4 w-4 text-slate-400 transition-colors group-hover:text-indigo-600"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <path d="M14 2v6h6"/>
                        </svg>
                        <span class="hidden sm:inline">My Applications</span>
                        <span class="sm:hidden">Applications</span>
                    </a>

                    <div class="mx-1 hidden h-5 w-px bg-slate-200 sm:block"></div>

                    {{-- User chip --}}
                    <div class="hidden items-center gap-2 rounded-full border border-slate-200 bg-white
                                py-1 pl-1 pr-3 sm:flex">
                        <span class="grid h-7 w-7 place-items-center rounded-full
                                     bg-indigo-600 text-[11px] font-semibold uppercase text-white">
                            {{ mb_substr(auth()->user()->name ?? 'U', 0, 1) }}
                        </span>
                        <span class="max-w-[10rem] truncate text-xs font-medium text-slate-700">
                            {{ auth()->user()->name }}
                        </span>
                    </div>

                    {{-- Logout --}}
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="inline-flex items-center gap-1.5 rounded-lg px-3 py-2 text-sm font-medium
                                       text-slate-500 transition-colors duration-150
                                       hover:bg-rose-50 hover:text-rose-600
                                       focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-rose-500/40">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                                <path d="m16 17 5-5-5-5"/>
                                <path d="M21 12H9"/>
                            </svg>
                            <span class="hidden sm:inline">Logout</span>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                       class="rounded-lg px-3.5 py-2 text-sm font-medium text-slate-600 transition-colors duration-150
                              hover:bg-slate-100 hover:text-slate-900
                              focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/40">
                        Sign in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="inline-flex items-center gap-1.5 rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold
                                  text-white transition-colors duration-150
                                  hover:bg-indigo-700
                                  focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/40
                                  focus-visible:ring-offset-2">
                            Get started
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>
                            </svg>
                        </a>
                    @endif
                @endauth
            </nav>
        </div>
    </header>

    {{-- ── Main ────────────────────────────────────────────────────────── --}}
    <main class="mx-auto w-full max-w-4xl flex-1 px-4 py-10 sm:px-6 sm:py-12">

        {{-- Validation errors --}}
        @if ($errors->any())
            <div class="mb-8 flex items-start gap-3.5 rounded-xl border border-rose-200 bg-rose-50 p-4
                        motion-safe:animate-[fadeInUp_.3s_ease-out]"
                 role="alert">
                <span class="mt-px grid h-8 w-8 shrink-0 place-items-center rounded-full
                             bg-rose-100 text-rose-600">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="12" cy="12" r="10"/><path d="M12 8v5"/><path d="M12 16h.01"/>
                    </svg>
                </span>
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-rose-900">
                        {{ $errors->count() === 1 ? 'Something needs your attention' : 'Please fix the following' }}
                    </p>
                    <ul class="mt-1.5 list-disc space-y-0.5 pl-4 text-sm text-rose-800 marker:text-rose-400">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        {{-- Success --}}
        @if (session('success'))
            <div class="mb-8 flex items-start gap-3.5 rounded-xl border border-emerald-200 bg-emerald-50 p-4
                        motion-safe:animate-[fadeInUp_.3s_ease-out]"
                 role="status">
                <span class="mt-px grid h-8 w-8 shrink-0 place-items-center rounded-full
                             bg-emerald-100 text-emerald-600">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M20 6 9 17l-5-5"/>
                    </svg>
                </span>
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-emerald-900">Success</p>
                    <p class="mt-0.5 text-sm text-emerald-800">{{ session('success') }}</p>
                </div>
            </div>
        @endif
         @if (session('error'))
            <div class="mb-8 flex items-start gap-3.5 rounded-xl border border-red-200 bg-emerald-50 p-4
                        motion-safe:animate-[fadeInUp_.3s_ease-out]"
                 role="status">
                <span class="mt-px grid h-8 w-8 shrink-0 place-items-center rounded-full
                             bg-red-100 text-red-600">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M20 6 9 17l-5-5"/>
                    </svg>
                </span>
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-red-900">Error</p>
                    <p class="mt-0.5 text-sm text-red-800">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        {{-- Deleted flash --}}
        @if (session('delete'))
            <div class="mb-8 flex items-start gap-3.5 rounded-xl border border-slate-200 bg-slate-50 p-4
                        motion-safe:animate-[fadeInUp_.3s_ease-out]"
                 role="status">
                <span class="mt-px grid h-8 w-8 shrink-0 place-items-center rounded-full
                             bg-slate-200 text-slate-600">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M3 6h18"/>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/>
                        <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                    </svg>
                </span>
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-slate-900">Deleted</p>
                    <p class="mt-0.5 text-sm text-slate-600">{{ session('delete') }}</p>
                </div>
            </div>
        @endif

        {{ $slot }}
    </main>

    {{-- ── Footer ──────────────────────────────────────────────────────── --}}
    <footer class="border-t border-slate-200">
        <div class="mx-auto flex w-full max-w-4xl flex-col items-center justify-between gap-2 px-4 py-6
                    text-xs text-slate-400 sm:flex-row sm:px-6">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
            <p class="flex items-center gap-1.5">
                Crafted with
                <svg class="h-3.5 w-3.5 text-rose-400" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path d="M12 21s-6.7-4.35-9.33-8.02A5.5 5.5 0 0 1 12 6.5a5.5 5.5 0 0 1 9.33 6.48C18.7 16.65 12 21 12 21z"/>
                </svg>
                for great teams
            </p>
        </div>
    </footer>
</body>
</html>