<nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
    <a class="navbar-brand" href="{{ route('open.home') }}">Eduardo A. F.</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample09">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('open.home.aboutme') }}">Sobre mí</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('open.home.contact') }}">Contacto</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle"
                   href="{{ route('open.home.contact') }}" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Blog</a>
                <div class="dropdown-menu" aria-labelledby="dropdown09">
                    <a class="dropdown-item" href="/blog/php/">php</a>
                    <a class="dropdown-item" href="/blog/js">js</a>
                    <a class="dropdown-item" href="/blog/sql">sql</a>
                    <a class="dropdown-item" href="/blog/python">python</a>
                </div>
            </li>
        </ul>
        <form class="form-inline my-2 my-md-0">
            <input class="form-control" type="text" placeholder="Search" aria-label="Search">
        </form>
    </div>
</nav>