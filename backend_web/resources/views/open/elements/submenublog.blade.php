@isset($submenublog)
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="submenu-blog" role="button" data-toggle="dropdown" aria-expanded="false">
        Blog
    </a>
    <ul class="dropdown-menu" aria-labelledby="submenu-blog">
    @foreach($submenublog as $item)
        <a class="dropdown-item" href="{{$item->slug}}">{{$item->description}}</a>
    @endforeach
    </ul>
</li>
@endisset
