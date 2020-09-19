@extends("open.open-layout")

@section("pagetitle",$seo["title"])
@section("pagedescription",$seo["description"])
@section("pagekeywords",$seo["keywords"])

@section("container")
@include("open.elements.home-header")
<br/>
<h1 class="display-6 mb-3">Últimos artículos:</h1>
<div class="row">
@foreach ($result as $post)
    <div class="col-md-4">
        <div class="card mb-4 box-shadow" postid="{{$post->id}}">
            <a href="{{$post->url_final}}">
                <img class="card-img-top img-responsive img-thumbnail" src="{{$post->url_img1}}" alt="{{$post->title}}">
            </a>
            <div class="card-body">
                <h5 class="card-title">{{$post->title}}</h5>
                <p class="card-text">
                    {!! $post->excerpt !!}
                </p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <a href="{{$post->url_final}}" class="btn btn-md opn-btnblue opn-btnshadow">Leer más...</a>
                        @auth
                            <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                            <a href="/adm/post/update/{{$post->id}}" target="_blank" class="btn btn-sm btn-primary">Edit ({{$post->id}})</a>
                        @endauth
                    </div>
                    <small class="text-muted">{{ get_dmy_hi($post->publish_date) }}</small>
                </div>
            </div>
        </div>
    </div>
@endforeach
</div>
@endsection
