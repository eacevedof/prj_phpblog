@isset($submenuservice)
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle {{ $catslug=="service" ? "active" : "" }}" href="#" id="submenu-blog" role="button" data-toggle="dropdown" aria-expanded="false">
        Servicios
    </a>
    <ul class="dropdown-menu" aria-labelledby="submenu-blog">
    @foreach($submenuservice as $item)
        <a class="dropdown-item" href="{{$item->url_final}}">{{$item->description}}</a>
    @endforeach
    </ul>
</li>
@endisset
