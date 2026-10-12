{{-- He who is contented is rich. — Laozi --}}
@props(['name', 'options' => [], 'allOption' => true, 'value' => ''])


<div role="radiogroup" aria-label="{{ $attributes->get('aria-label', Str::headline($name)) }}"
    {{ $attributes->class(['flex flex-col gap-2']) }}>
    @if ($allOption)
        <label for="{{$name}}" class="relative inline-flex cursor-pointer select-none">
            <input type="radio" name="{{ $name }}" value="" @checked(!request($name))
                >
            <span>All</span>
        </label>
    @endif


    @foreach ($options as $option)
        <label class="">
            <input  type="radio" name="{{ $name }}" value="{{ $option }}" @checked($option === ( $value ?? request($name) ))
            >
            <span>
            {{ Str::ucfirst($option) }}
            </span>
          
        </label>
    @endforeach
     @error($name)
        <div class="mt-1 text-sm text-rose-600">
            {{ $message }}
        </div>
    @enderror

</div>
