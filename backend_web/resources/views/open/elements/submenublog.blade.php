@isset($submenublog)
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle {{ $catslug=="blog" ? "active" : "" }}" href="#" id="submenu-blog" role="button" data-toggle="dropdown" aria-expanded="false">
        Secciones
    </a>
    <ul class="dropdown-menu" aria-labelledby="submenu-blog">
    @foreach($submenublog as $item)
        <a class="dropdown-item" href="{{$item->url_final}}">{{$item->description}}</a>
    @endforeach
    </ul>
</li>
@endisset
