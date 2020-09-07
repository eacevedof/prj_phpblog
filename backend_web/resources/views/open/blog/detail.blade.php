@extends("open.open-layout")

@section("pagetitle",$seo["title"] ?? "")
@section("pagedescription",$seo["description"] ?? "")
@section("pagekeywords",$seo["keywords"] ?? "")

@section("container")
<div class="card lg-12">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="{{$result->url_img1}}" alt="{{$result->title}}" width="350">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">{{$result->title}}</h5>
                <p class="card-text">{{$result->content}}</p>
                <p class="card-text text-right">
                    <small class="text-muted">Autor: Eduardo A. F.</small><br/>
                    <small class="text-muted">Publicado: {{ get_ymd_hi($result->publish_date) }}</small>
                    @if( !empty($result->last_update) && ($result->last_update != $result->publish_date)){
                        <br/>
                        <small class="text-muted">Actualizado: {{ get_ymd_hi($result->last_update) }}</small>
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
