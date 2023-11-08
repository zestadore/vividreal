@if ($type=='password')
    <div class="form-group">
        <label for="{{$name}}"><strong>{{$title}} @if($required=="True")<span style="color:red;"> *</span>@endif</strong></label>
        <input id="{{$id}}" type="{{$type}}" class="{{$class}}" name="{{$name}}" value="{{ old($name) }}" placeholder="{{$title}}" @if($required=="True") required @endif autocomplete="{{$name}}" autofocus>
        @error($name)
            <span class="error mt-2 text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    
@elseif($type=='textarea')
    <div class="form-group">
        <label for="{{$name}}"><strong>{{$title}} @if($required=="True")<span style="color:red;"> *</span>@endif</strong></label>
        <textarea id="{{$id}}" cols="30" rows="5" class="{{$class}}" name="{{$name}}" value="{{ old($name) }}" placeholder="{{$title}}" @if($required=="True") required @endif autocomplete="{{$name}}" autofocus></textarea>
        @error($name)
            <span class="error mt-2 text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
@elseif($type=='number')
    <div class="form-group">
        <label for="{{$name}}"><strong>{{$title}} @if($required=="True")<span style="color:red;"> *</span>@endif</strong></label>
        <input id="{{$id}}" type="{{$type}}" class="{{$class}}" name="{{$name}}" value="{{ old($name) }}" placeholder="{{$title}}" @if($required=="True") required @endif autocomplete="{{$name}}" autofocus>
        @error($name)
            <span class="error mt-2 text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
@elseif($type=='file')
    <div class="form-group">
        <label for="{{$name}}"><strong>{{$title}} @if($required=="True")<span style="color:red;"> *</span>@endif</strong></label>
        <input type="file" class="{{$class}}" name="{{$name}}" id="{{$id}}" value="{{ old($name) }}" placeholder="{{$title}}" @if($required=="True") required @endif autocomplete="{{$name}}" autofocus style="width:100% !important;">
        @error($name)
            <span class="error mt-2 text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
@elseif($type=='date')
    <div class="form-group">
        <label for="{{$name}}"><strong>{{$title}} @if($required=="True")<span style="color:red;"> *</span>@endif</strong></label>
        <input id="{{$id}}" type="{{$type}}" class="{{$class}}" name="{{$name}}" value="{{ old($name) }}" placeholder="{{$title}}" @if($required=="True") required @endif autocomplete="{{$name}}" autofocus>
        @error($name)
            <span class="error mt-2 text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
@else
    <div class="form-group">
        <label for="{{$name}}"><strong>{{$title}} @if($required=="True")<span style="color:red;"> *</span>@endif</strong></label>
        <input id="{{$id}}" type="{{$type}}" class="{{$class}}" name="{{$name}}" value="{{ old($name) }}" placeholder="{{$title}}" @if($required=="True") required @endif autocomplete="{{$name}}" autofocus>
        @error($name)
            <span class="error mt-2 text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
@endif