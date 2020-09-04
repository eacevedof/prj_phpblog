@extends("open.open-layout")

@section("pagetitle",$seo["title"])
@section("pagedescription",$seo["description"])
@section("pagekeywords",$seo["keywords"])

@section("container")
    @parent
    <div class="row">
        @foreach ($result as $post)
            <div class="col-md-4">
                <div class="card mb-4 box-shadow" postid="{{$post->id}}">
                    <img class="card-img-top img-responsive img-thumbnail" src="{{$post->url_img1}}" alt="{{$post->title}}">
                    <div class="card-body">
                        <p class="card-text">
                            {{$post->excerpt}}
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="/blog/{{$post->url_final}}" type="button" class="btn btn-md btn-primary">Read</a>
                                @auth
                                <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                                <a href="/adm/post/update/{{$post->id}}" target="_blank" class="btn btn-sm btn-primary">Edit</a>
                                @endauth
                            </div>
                            <small class="text-muted">9 mins</small>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach

    </div>
@endsection
