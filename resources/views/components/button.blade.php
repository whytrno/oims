@php
    $class = "md:col-span-2 inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-9 px-4 py-2 ";

    if(isset($color)){
        $class .= "bg-$color hover:bg-$color/90 ";
    }else{
        $class .= "bg-primary hover:bg-primary/90 ";
    }

    if(isset($width)){
        $class .= "w-$width ";
    }else{
        $class .= "w-full ";
    }
@endphp

@if(isset($action) && isset($title))
    <a href="{{route($action)}}"
       class="{{$class}}">
        {{$title}}
    </a>
@else
    <button
            class="{{$class}}"
            type="{{isset($type) ?? 'button'}}">
        {{isset($title) ? $title : 'Submit'}}
    </button>
@endif