<x-card class="mb-6 hover:border-indigo-300 transition-colors">
    <div class="flex flex-wrap justify-between items-start gap-2">
        <h2 class="text-xl font-semibold text-slate-800">{{ $job->title }}</h2>
        <div class="text-lg font-medium text-emerald-600">${{ number_format($job->salary) }}</div>
    </div>

    <div class="mt-3 flex flex-wrap justify-between items-center text-sm text-slate-500 gap-2">
        <div class="flex flex-wrap items-center gap-x-4 gap-y-1">
            <span class="flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                {{ $job->employer->company_name }}
            </span>
            <span class="flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                {{ $job->location }}
            </span>
        </div>
        <div class="flex flex-wrap gap-2">
            <x-tag :href="route('jobs.index', ['experience' => $job->experience])" color="blue">
                {{ Str::ucfirst($job->experience) }}
            </x-tag>
            <x-tag :href="route('jobs.index', ['category' => $job->category])" color="purple">
                {{ $job->category }}
            </x-tag>
        </div>
    </div>

    <div class="mt-4">
        {{ $slot }}
    </div>
</x-card>