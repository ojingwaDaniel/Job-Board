{{-- An unexamined life is not worth living. — Socrates --}}
@props([
    'formRef' => null,
    'type' => 'text',
    'name',
    'placeholder' => '',
    'value' => '',
    'icon' => null,
    'id' => null
])

@php
    $inputId = $name . '-' . \Illuminate\Support\Str::random(4);
    $hasError = $errors->has($name);
@endphp
@if ($type != 'textarea')
    <div class="w-full">
        {{-- Optional leading icon --}}
        @if ($icon)
            <div
                class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3
                    text-slate-400">
                {!! $icon !!}
            </div>
        @endif

        <input type="{{ $type }}" x-ref="input-{{ $name }}" name="{{ $name }}"
            id="{{ $id}}" value="{{ old($name, $value) }}" placeholder="{{ $placeholder }}"
            {{ $attributes->class([
                'peer w-full rounded-lg border bg-white px-3.5 py-2.5 text-sm',
                'text-slate-900 placeholder:text-slate-400',
                'shadow-sm transition-colors duration-150 ease-out',
                'focus:outline-none focus:ring-4',
                'disabled:cursor-not-allowed disabled:bg-slate-50 disabled:text-slate-400',
            
                'border-red-300 focus:border-red-400 focus:ring-red-100' => $errors->has($name),
            
                'border-slate-300 focus:border-slate-400 focus:ring-slate-200' => !$errors->has($name),
            ]) }}>
        {{-- Clear button --}}
        @if ($formRef)
            <button type="button" aria-label="Clear {{ $name }}"
                @click="$refs['input-{{ $name }}'].value = ''; $refs['{{ $formRef }}'].submit()"
                class="group absolute inset-y-0 right-0 my-auto mr-1.5 flex h-8 w-8 items-center justify-center
                   rounded-lg text-slate-400 transition-colors duration-150
                   hover:bg-slate-100 hover:text-slate-700
                   focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/40">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="h-3.5 w-3.5" stroke-linecap="round" stroke-linejoin="round"
                    aria-hidden="true">
                    <path d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        @endif
        {{-- Error message --}}
        @error($name)
            <div id="{{ $inputId }}-error" class="m-0 mt-1 p-0 text-sm text-rose-600">
                {{ $message }}
            </div>
        @enderror
    </div>
@else
    <textarea name="{{ $name }}" id="{{ $name }}" cols="10" rows="10" class="w-full ring-1"
        @class([
            'border-red-300 focus:border-red-400 focus:ring-red-100' => $errors->has(
                $name),
            'border-slate-300 focus:border-slate-400 focus:ring-slate-200' => !$errors->has(
                $name),
        ])>
    {{ old($name, $value) }}
</textarea>

@endif
