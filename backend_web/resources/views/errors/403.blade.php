@extends('errors.errors-layout')

@section("pagetitle","Error 403")
@section('content')
<div id="notfound">
    <div class="notfound">
        <div class="notfound-404">
            <h1>4<span>0</span>3</h1>
        </div>
        <h2>Forbidden content</h2>
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
