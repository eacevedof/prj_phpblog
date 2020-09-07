@extends("open.open-layout")

@section("pagetitle",$seo["title"] ?? "")
@section("pagedescription",$seo["description"] ?? "")
@section("pagekeywords",$seo["keywords"] ?? "")

@section("container")
<h1 class="display-6 mt-4 mb-3"> Blog - Todos los artículos:</h1>
<p>
    <small>Total: {{$result->count()}}</small>
</p>
<p>
    <a href="/blog/javascript"
</p>
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
