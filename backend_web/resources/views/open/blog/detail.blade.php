@extends("open.open-layout")

@section("pagetitle",$seo["title"] ?? "")
@section("pagedescription",$seo["description"] ?? "")
@section("pagekeywords",$seo["keywords"] ?? "")

@section("container")
<div class="card lg-12">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="{{$post->url_img1}}" alt="{{$post->title}}" width="350">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">{{$post->title}}</h5>
                <p class="card-text">{{$post->content}}</p>
                <p class="card-text text-right">
                    <small class="text-muted">Author: Eduardo A. F.</small><br/>
                    <small class="text-muted">Published at: {{ get_ymd_hi($post->publish_date) }}</small>
                    @if( !empty($post->last_update) && ($post->last_update != $post->publish_date)){
                        <br/>
                        <small class="text-muted">Updated at: {{ get_ymd_hi($post->last_update) }}</small>
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
