@extends("open.open-layout")

@section("pagetitle",$seo["title"] ?? "")
@section("pagedescription",$seo["description"] ?? "")
@section("pagekeywords",$seo["keywords"] ?? "")

@section("container")

@include("open.elements.hashlinks")

<div class="card lg-12 app-card">
    <div class="row g-0">
        <div class="col-md-12">
            <div class="card-body">
                <h1 class="card-title display-6">{{$result->title}}</h1>
                <img src="{{$result->url_img1}}" alt="{{$result->title}}" width="350" class="pull-left mr-3">
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
