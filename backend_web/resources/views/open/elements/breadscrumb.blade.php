<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    @php
        $css = "active"
    @endphp
    @foreach($breadscrumb as $scrumb)
        <li class="breadcrumb-item @if($loop->last) {{$css}} @endif"><a href="{{$scrumb["url"]}}">{{$scrumb["text"]}}</a></li>
    @endforeach
    </ol>
</nav>
