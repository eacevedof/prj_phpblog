@isset($blogsubmenu)
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="blog-submenu" role="button" data-toggle="dropdown" aria-expanded="false">
        Blog
    </a>
    <ul class="dropdown-menu" aria-labelledby="blog-submenu">
    @foreach($blogsubmenu as $item)
        <a class="dropdown-item" href="{{$item->slug}}">{{$item->description}}</a>
    @endforeach
    </ul>
</li>
@endisset
