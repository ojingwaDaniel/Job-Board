
    <!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->

@props(['required' => false,'for' => null])
<label class="block mb-3 mt-4 text-slate-900 text-sm font-medium" for="{{$for}}">
    {{$slot}}
    @if ($required)
        <span>*</span>
    @endif
</label>