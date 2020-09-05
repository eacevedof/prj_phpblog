@extends('errors.errors-layout')

@section("pagetitle","Error 404")
@section('content')
<div id="notfound">
    <!--
        https://colorlib.com/wp/free-error-page-templates/
        https://colorlib.com/etc/404/colorlib-error-404-2/
    -->
    <div class="notfound">
        <div class="notfound-404">
            <h1>4<span>0</span>4</h1>
        </div>
        <h2>The content you requested could not be found!</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                @auth
                    <li class="breadcrumb-item" aria-current="page"><a href="/adm">Admin</a></li>
                @endauth
                <li class="breadcrumb-item" aria-current="page"><a href="/contacto">Contacto</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="/blog">Blog</a></li>
            </ol>
        </nav>
    </div>

</div>
@endsection
