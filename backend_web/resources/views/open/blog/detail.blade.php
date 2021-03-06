@extends("open.open-layout")

@isset($isdraft)
    @section("pagetitle","Draft: ".$result->id)
@endisset
@section("pagetitle",$seo["title"] ?? "")
@section("pagedescription",$seo["description"] ?? "")
@section("pagekeywords",$seo["keywords"] ?? "")
@section("canonical",$canonical ?? "")

@section("container")

@include("open.elements.hashlinks")

@if(!isset($isdraft))
@auth
<div class="row">
    <div class="col-12 mb-3">
        <a href="/adm/post/update/{{$result->id}}" target="_blank" class="btn btn-sm btn-primary pull-right">Edit ({{$result->id}})</a>
    </div>
</div>
@endauth
@endif

<div class="card lg-12 opn-card mb-2">
    <div class="row g-0">
        <div class="col-md-12">
            <div class="card-body">
                <h1 class="card-title mb-3">{{$result->title}}</h1>
                @if($result->url_img2)
                    <a href="{{$result->url_img2}}" target="_blank">
                        <img src="{{$result->url_img2}}" alt="{{$result->title}}" width="450" class="pull-left mr-3 img-fluid">
                    </a>
                @endif
                <p class="card-text">{!!$result->content!!}</p>
                <p class="card-text text-right">
                    <small class="text-muted">Autor: Eduardo A. F.</small><br/>
                    <small class="text-muted">Publicado: {{ get_dmy_hi($result->publish_date) }}</small>
                    @if($result->last_update > $result->publish_date)
                        <br/>
                        <small class="text-muted">Actualizado: {{ get_dmy_hi($result->last_update) }}</small>
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>

@if(!isset($isdraft))
@auth
<div class="row">
    <div class="col-12 mb-3">
        <a href="/adm/post/update/{{$result->id}}" target="_blank" class="btn btn-sm btn-primary pull-right">Edit ({{$result->id}})</a>
    </div>
</div>
@endauth
@endif

@include("open.elements.hashlinks")
@endsection
