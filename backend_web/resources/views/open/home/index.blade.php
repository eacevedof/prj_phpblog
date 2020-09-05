@extends("open.open-layout")

@section("pagetitle",$seo["title"])
@section("pagedescription",$seo["description"])
@section("pagekeywords",$seo["keywords"])

@section("container")
<div class="card">
    <div class="card-header" style="background:#343A40;">
        <h5 class="card-title" style="color:white">Blog de Eduardo Acevedo - Desarrollador fullstack</h5>
    </div>
    <div class="card-body">
        <img class="img-fluid rounded" src="https://resources.theframework.es/eduardoaf.com/20200905/160818-logo-eduardoafcom.png" />
        <p class="card-text">Artículos de tecnología en general</p>
        <a href="/blog" class="btn app-btnblue app-btnshadow">Blog</a>
    </div>
    <div class="card-footer text-muted text-right" style="background:#343A40; color:white !important;">
        Última actualización: {{$updatedat ?? ""}}
    </div>
</div>
<br/>
<h1 class="display-6">Últimos artículos:</h1>
<br/>
<div class="row">
@foreach ($result as $post)
    <div class="col-md-4">
        <div class="card mb-4 box-shadow" postid="{{$post->id}}">
            <img class="card-img-top img-responsive img-thumbnail" src="{{$post->url_img1}}" alt="{{$post->title}}">
            <div class="card-body">
                <h5 class="card-title">{{$post->title}}</h5>
                <p class="card-text">
                    {{$post->excerpt}}
                </p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <a href="/blog{{$post->url_final}}" type="button" class="btn btn-md app-btnblue app-btnshadow">Leer más...</a>
                        @auth
                            <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                            <a href="/adm/post/update/{{$post->id}}" target="_blank" class="btn btn-sm btn-primary">Edit ({{$post->id}})</a>
                        @endauth
                    </div>
                    <small class="text-muted">{{ get_ymd_hi($post->publish_date) }}</small>
                </div>
            </div>
        </div>
    </div>
@endforeach
</div>
@endsection
