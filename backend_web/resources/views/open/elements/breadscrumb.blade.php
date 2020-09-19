<nav aria-label="breadcrumb">
    <ol class="breadcrumb opn-breadscrumb">
        <li class="breadcrumb-item opn-breadscrumb-item"><a href="/">Inicio</a></li>
    @php
        $css = "active"
    @endphp
    @foreach($breadscrumb as $scrumb)
        <li class="breadcrumb-item opn-breadscrumb-item @if($loop->last) {{$css}} @endif"><a href="{{$scrumb["url"]}}">{{$scrumb["text"]}}</a></li>
    @endforeach
    </ol>
</nav>
