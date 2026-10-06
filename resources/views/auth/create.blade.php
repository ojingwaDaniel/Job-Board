<x-layout>
    <div class="mx-auto w-full max-w-md">
        {{-- ── Header ─────────────────────────────────────────────────── --}}
        <div class="mb-8 text-center">
            <div
                class="mx-auto mb-5 grid h-14 w-14 place-items-center rounded-2xl
                        bg-gradient-to-br from-indigo-500 via-indigo-500 to-teal-400
                        text-white shadow-lg shadow-indigo-500/25 ring-1 ring-white/25">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <rect x="3" y="11" width="18" height="11" rx="2" />
                    <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                </svg>
            </div>

            <h1 class="t">
                Welcome back
            </h1>
            <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
                Sign in to continue to your account
            </p>
        </div>

        {{-- ── Card ───────────────────────────────────────────────────── --}}
        <x-card>
            <form action="{{ route('auth.store') }}" method="POST" class="space-y-5">
                @csrf

                {{-- Email --}}
                <div>
                    <x-label for="email"
                        class="mb-1.5 block text-xs font-semibold uppercase tracking-wide
                                  text-slate-500 dark:text-slate-400" required="true">
                        Email
                    </x-label>
                    <x-text-input id="email" name="email" type="email" placeholder="you@example.com" autocomplete="email"
                        autofocus />
                </div>

                {{-- Password --}}
                <div>
                    <div class="mt-5 flex items-center justify-between">
                        <x-label for="password" required="true">
                            Password
                        </x-label>

                    </div>
                    <x-text-input id="password" name="password" type="password" placeholder="••••••••"
                        autocomplete="current-password" />
                </div>
                <div class="flex justify-between mt-3">
                    <label class="group flex cursor-pointer select-none items-center gap-2.5 w-fit">
                        <input type="checkbox" name="remember" id="remember" />
                       
                        <span
                            class="text-sm text-slate-900 group-hover:text-slate-900 transition-colors
                                 dark:text-slate-900">
                            Remember me for 30 days
                        </span>
                    </label>
                    <a href="#"
                        class="text-xs font-medium text-indigo-600 transition-colors
                                  hover:text-indigo-800 hover:underline
                                  focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/40
                                  focus-visible:ring-offset-1 rounded
                                  dark:text-indigo-400 dark:hover:text-indigo-300">
                        Forgot password?
                    </a>

                </div>


           

                {{-- Submit --}}
                <x-button type="submit"
                    class=" mt-3 group inline-flex w-full items-center justify-center gap-2 rounded-xl
                           bg-gradient-to-r from-indigo-600 via-indigo-600 to-teal-500 px-5 py-3
                           text-sm font-semibold text-white shadow-lg shadow-indigo-500/25
                           transition-all duration-200
                           hover:-translate-y-0.5 hover:shadow-xl hover:shadow-indigo-500/35
                           focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/40
                           focus-visible:ring-offset-2">
                    Sign in
                    <svg class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-0.5"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M5 12h14" />
                        <path d="m12 5 7 7-7 7" />
                    </svg>
                </x-button>
            </form>

            {{-- Divider + Signup prompt --}}
            @if (Route::has('register'))
                <div class="my-6 flex items-center gap-4">
                    <span class="h-px flex-1 bg-slate-200 dark:bg-white/10" aria-hidden="true"></span>
                    <span class="text-xs font-medium uppercase tracking-wide text-slate-400 dark:text-slate-500">
                        New here?
                    </span>
                    <span class="h-px flex-1 bg-slate-200 dark:bg-white/10" aria-hidden="true"></span>
                </div>

                <a href="{{ route('register') }}"
                    class="group inline-flex w-full items-center justify-center gap-2 rounded-xl
                          border border-slate-200 bg-white px-5 py-2.5
                          text-sm font-medium text-slate-700 shadow-sm
                          transition-all duration-200
                          hover:-translate-y-0.5 hover:border-slate-300 hover:bg-slate-50 hover:shadow
                          focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-400/40
                          focus-visible:ring-offset-2
                          dark:border-white/10 dark:bg-white/5 dark:text-slate-200
                          dark:hover:border-white/20 dark:hover:bg-white/10 dark:hover:text-white">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                        <circle cx="8.5" cy="7" r="4" />
                        <path d="M20 8v6M23 11h-6" />
                    </svg>
                    Create an account
                </a>
            @endif
        </x-card>

        {{-- Footer note --}}
        <p class="mt-6 text-center text-xs text-slate-400 dark:text-slate-500">
            By signing in, you agree to our
            <a href="#"
                class="underline decoration-slate-300 underline-offset-2 hover:text-slate-600
                               dark:hover:text-slate-300">Terms</a>
            and
            <a href="#"
                class="underline decoration-slate-300 underline-offset-2 hover:text-slate-600
                               dark:hover:text-slate-300">Privacy
                Policy</a>.
        </p>
    </div>
</x-layout>
