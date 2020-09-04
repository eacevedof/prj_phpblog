@extends("open.open-layout")

@section("pagetitle",$seo["title"] ?? "")
@section("pagedescription",$seo["description"] ?? "")
@section("pagekeywords",$seo["keywords"] ?? "")

@section("container")
    @parent
    <div class="card lg-12">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{$post->url_img1}}" alt="{{$post->title}}" width="350">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{$post->title}}</h5>
                    <p class="card-text">{{$post->content}}</p>
                    <p class="card-text">
                        <small class="text-muted">Published at: {{ get_ymd_hi($post->publish_date) }}</small>
                        @if( !empty($post->last_update) && ($post->last_update != $post->publish_date)){
                            <small class="text-muted">Updated at: {{ get_ymd_hi($post->last_update) }}</small>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="card text-center">
        <div class="card-header">
            Featured
        </div>
        <div class="card-body">
            <h5 class="card-title">Special title treatment</h5>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
        <div class="card-footer text-muted">
            2 days ago
        </div>
    </div>
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
