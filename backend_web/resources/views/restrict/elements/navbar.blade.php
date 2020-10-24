<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="position: sticky !important; top:0; z-index: 1;">
    <div class="container">
        <a class="navbar-brand" href="/" target="_blank">Home</a>
        @auth
            <a class="navbar-brand" href="/adm">Admin</a>
        @endauth

        <!-- hamburguesa -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbartop" aria-controls="navbartop" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbartop">
            <!-- Left Side Of Navbar -->
            @auth
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a id="module-posts" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Posts
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="module-posts">
                        <a class="dropdown-item" href="/adm/posts">Posts</a>
                        <a class="dropdown-item" href="/adm/post/insert">Insert post</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a id="module-upload" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Upload
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="module-upload">
                        <a class="dropdown-item" href="/adm/upload">Uploads</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a id="module-posts" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Subjects
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="module-posts">
                        <a class="dropdown-item" href="/adm/language/subjects">Subjects</a>
                        <a class="dropdown-item" href="/adm/language/subject/insert">Insert subject</a>
                    </div>
                </li>
            </ul>
            @endauth

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register') && env('APP_ENV')!='prod')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                <!--esto pinta un inpu thidden llamado _token-->
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
