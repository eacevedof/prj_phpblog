@extends("open.language-layout")

@section("pagetitle",$seo["title"])
@section("pagedescription",$seo["description"])
@section("pagekeywords",$seo["keywords"])

@section("container")
<div class="columns">
    <div class="column has-text-centered">
        <h1 class="title" style="color: ghostwhite;">{{$seo["title"]}}</h1><br>
    </div>
</div>
<div class="row columns is-multiline">
    @foreach ($result as $subject)
    <div class="column is-4">
        <div class="card large" subject="{{$subject->id}}">
            <div class="card-image">
                <figure class="image is-16by9">
                    <img src="{{$subject->url_img1}}" alt="{{$subject->title}}">
                </figure>
            </div>
            <div class="card-content">
                <div class="media">
                    <div class="media-content">
                        <p class="title is-4 no-padding">{{$subject->title}}</p>
                        <p>
                            <span class="title is-6">
                                <a href="/idiomas/{{$subject->slug}}">Practica!</a>
                            </span>
                        </p>
                        <p class="subtitle is-6">{{$subject->slug}}</p>
                    </div>
                </div>
                <div class="content">
                    {{$subject->excerpt}}
                    <div class="background-icon"><span class="icon-twitter"></span></div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
