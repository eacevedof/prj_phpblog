@extends("open.open-layout")

@section("pagetitle",$seo["title"] ?? "")
@section("pagedescription",$seo["description"] ?? "")
@section("pagekeywords",$seo["keywords"] ?? "")

@section("container")
    @parent
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4 box-shadow">
                <img class="card-img-top irounded float-left" src="{{$post->url_img1}}" alt="{{$post->title}}">
                <div class="card-body">
                    <p class="card-text">{{$post->content}}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">9 mins</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
