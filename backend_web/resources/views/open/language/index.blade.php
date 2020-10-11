@extends("open.language-layout")

@section("pagetitle",$seo["title"])
@section("pagedescription",$seo["description"])
@section("pagekeywords",$seo["keywords"])

@section("container")
    <link rel="stylesheet" href="https://unpkg.com/buefy/dist/buefy.min.css">
<div class="container">
    <div class="section">
        <div class="columns">
            <div class="column has-text-centered">
                <h1 class="title is-4">{{$seo["title"]}}</h1><br>
            </div>
        </div>
        <div class="row columns is-multiline">
            @foreach ($result as $subject)
                <div class="column is-3">
                    <div class="card large" subject="{{$subject->id}}">
                        <div class="card-image">
                            <figure class="image is-16by9">
                                <a href="/idiomas/{{$subject->slug}}">
                                    <img src="{{$subject->url_img1}}" alt="{{$subject->title}}">
                                </a>
                            </figure>
                        </div>
                        <div class="card-content">
                            <div class="media">
                                <div class="media-content">
                                    <p class="title is-4 no-padding">{{$subject->title}}</p>
                                    <p>
                                        <span class="title is-6">
                                            <a href="/idiomas/{{$subject->slug}}" class="button is-success">Practica!</a>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="content">
                                <p>
                                {{$subject->excerpt}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
