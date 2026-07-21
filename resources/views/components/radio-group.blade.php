<!-- He who is contented is rich. - Laozi -->
{{-- @props(['name','options']) --}}
<div>
    <label>
        <input type="radio" name="{{$name}}" @checked(!request($name))  value=""/>
        All
    </label>
    @foreach ($options as $option)
    <label>
        <input type="radio" name="{{$name}}" value="{{$option}}" @checked(request($name) === $option) />
        {{$option}}
    </label>
        
    @endforeach
    

</div>
