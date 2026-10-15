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
        body {
            font-family: 'Inter', ui-sans-serif, system-ui, -apple-system, sans-serif;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body
    class="flex min-h-screen flex-col bg-gradient-to-b from-slate-50 via-white to-slate-50 text-slate-700 antialiased
           selection:bg-indigo-100 selection:text-indigo-900">

    {{-- ── Header ──────────────────────────────────────────────────────── --}}
    <header class="sticky top-0 z-40 border-b border-slate-200/70 bg-white/80 backdrop-blur-xl supports-[backdrop-filter]:bg-white/70">
        <div class="mx-auto flex h-16 w-full max-w-5xl items-center justify-between px-4 sm:px-6 lg:px-8">

            {{-- Brand --}}
            <a href="/"
                class="group flex items-center gap-2.5 rounded-lg focus-visible:outline-none
                       focus-visible:ring-2 focus-visible:ring-indigo-500/40 focus-visible:ring-offset-2">
                <span
                    class="grid h-9 w-9 place-items-center rounded-xl bg-gradient-to-br from-indigo-500 to-sky-500
                           text-white shadow-md shadow-indigo-500/25 ring-1 ring-white/20
                           transition duration-200 group-hover:scale-105 group-hover:shadow-lg group-hover:shadow-indigo-500/30">
                    <svg class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <rect x="2" y="7" width="20" height="14" rx="2" />
                        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" />
                    </svg>
                </span>
                <span class="text-[15px] font-semibold tracking-tight text-slate-900">
                    {{ config('app.name', 'Laravel') }}
                </span>
            </a>

            {{-- Navigation --}}
            <nav class="flex items-center gap-1 sm:gap-1.5">
                @auth
                    @php
                        $navBase = 'group inline-flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium transition-colors duration-150 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/40';
                        $navIdle = 'text-slate-600 hover:bg-slate-100 hover:text-slate-900';
                        $navActive = 'bg-indigo-50 text-indigo-700';
                    @endphp

                    <a href="{{ route('my-job-applications.index') }}"
                        class="{{ $navBase }} {{ request()->routeIs('my-job-applications.*') ? $navActive : $navIdle }}">
                        <svg class="h-4 w-4 {{ request()->routeIs('my-job-applications.*') ? 'text-indigo-600' : 'text-slate-400 group-hover:text-indigo-600' }}"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" aria-hidden="true">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                            <path d="M14 2v6h6" />
                        </svg>
                        <span class="hidden sm:inline">My Applications</span>
                        <span class="sm:hidden">Applications</span>
                    </a>

                    <a href="{{ route('my-jobs.index') }}"
                        class="{{ $navBase }} {{ request()->routeIs('my-jobs.*') ? $navActive : $navIdle }}">
                        <svg class="h-4 w-4 {{ request()->routeIs('my-jobs.*') ? 'text-indigo-600' : 'text-slate-400 group-hover:text-indigo-600' }}"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" aria-hidden="true">
                            <rect x="3" y="3" width="7" height="9" rx="1" />
                            <rect x="14" y="3" width="7" height="5" rx="1" />
                            <rect x="14" y="12" width="7" height="9" rx="1" />
                            <rect x="3" y="16" width="7" height="5" rx="1" />
                        </svg>
                        <span class="hidden sm:inline">Employer's Dashboard</span>
                        <span class="sm:hidden">Dashboard</span>
                    </a>

                    <div class="mx-1 hidden h-5 w-px bg-slate-200 sm:block"></div>

                    {{-- User chip --}}
                    <div class="hidden items-center gap-2 rounded-full border border-slate-200 bg-white py-1 pl-1 pr-3 shadow-sm sm:flex">
                        <span
                            class="grid h-7 w-7 place-items-center rounded-full bg-gradient-to-br from-indigo-500 to-sky-500
                                   text-[11px] font-semibold uppercase text-white">
                            {{ mb_substr(auth()->user()->name, 0, 1) }}
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
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                <path d="m16 17 5-5-5-5" />
                                <path d="M21 12H9" />
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

                    <a href="{{ route('register') }}"
                        class="group inline-flex items-center gap-1.5 rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold
                               text-white shadow-sm transition-colors duration-150 hover:bg-slate-700
                               focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-900/40
                               focus-visible:ring-offset-2">
                        Get started
                        <svg class="h-3.5 w-3.5 transition-transform group-hover:translate-x-0.5" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                            stroke-linejoin="round" aria-hidden="true">
                            <path d="M5 12h14" />
                            <path d="m12 5 7 7-7 7" />
                        </svg>
                    </a>
                @endauth
            </nav>
        </div>
    </header>

    {{-- ── Main ────────────────────────────────────────────────────────── --}}
    <main class="mx-auto w-full max-w-5xl flex-1 px-4 py-10 sm:px-6 sm:py-12 lg:px-8">

        {{-- Validation errors --}}
        @if ($errors->any())
            <div class="mb-8 flex items-start gap-3.5 rounded-2xl border border-rose-200 bg-rose-50/80 p-4 shadow-sm
                        motion-safe:animate-[fadeInUp_.3s_ease-out]"
                role="alert">
                <span class="mt-px grid h-8 w-8 shrink-0 place-items-center rounded-full bg-rose-100 text-rose-600">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M12 8v5" />
                        <path d="M12 16h.01" />
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

        {{-- Flash messages --}}
        @php
            $flashes = [
                'success' => [
                    'title' => 'Success',
                    'box' => 'border-emerald-200 bg-emerald-50/80',
                    'icon' => 'bg-emerald-100 text-emerald-600',
                    'heading' => 'text-emerald-900',
                    'text' => 'text-emerald-800',
                    'path' => '<path d="M20 6 9 17l-5-5" />',
                ],
                'error' => [
                    'title' => 'Error',
                    'box' => 'border-rose-200 bg-rose-50/80',
                    'icon' => 'bg-rose-100 text-rose-600',
                    'heading' => 'text-rose-900',
                    'text' => 'text-rose-800',
                    'path' => '<circle cx="12" cy="12" r="10" /><path d="M12 8v5" /><path d="M12 16h.01" />',
                ],
                'delete' => [
                    'title' => 'Deleted',
                    'box' => 'border-slate-200 bg-slate-50/80',
                    'icon' => 'bg-slate-200 text-slate-600',
                    'heading' => 'text-slate-900',
                    'text' => 'text-slate-600',
                    'path' => '<path d="M3 6h18" /><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" /><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />',
                ],
            ];
        @endphp

        @foreach ($flashes as $key => $flash)
            @if (session($key))
                <div class="mb-8 flex items-start gap-3.5 rounded-2xl border {{ $flash['box'] }} p-4 shadow-sm
                            motion-safe:animate-[fadeInUp_.3s_ease-out]"
                    role="{{ $key === 'error' ? 'alert' : 'status' }}">
                    <span class="mt-px grid h-8 w-8 shrink-0 place-items-center rounded-full {{ $flash['icon'] }}">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                            stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            {!! $flash['path'] !!}
                        </svg>
                    </span>
                    <div class="min-w-0">
                        <p class="text-sm font-semibold {{ $flash['heading'] }}">{{ $flash['title'] }}</p>
                        <p class="mt-0.5 text-sm {{ $flash['text'] }}">{{ session($key) }}</p>
                    </div>
                </div>
            @endif
        @endforeach

        {{ $slot }}
    </main>

    {{-- ── Footer ──────────────────────────────────────────────────────── --}}
    <footer class="border-t border-slate-200/70 bg-white/60">
        <div
            class="mx-auto flex w-full max-w-5xl flex-col items-center justify-between gap-2 px-4 py-6
                   text-xs text-slate-400 sm:flex-row sm:px-6 lg:px-8">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
            <p class="flex items-center gap-1.5">
                Crafted with
                <svg class="h-3.5 w-3.5 text-rose-400" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path
                        d="M12 21s-6.7-4.35-9.33-8.02A5.5 5.5 0 0 1 12 6.5a5.5 5.5 0 0 1 9.33 6.48C18.7 16.65 12 21 12 21z" />
                </svg>
                for great teams
            </p>
        </div>
    </footer>
</body>

</html>