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
    <div class="column is-4">
        @foreach ($result as $post)
        <div class="card large">
            <div class="card-image">
                <figure class="image is-16by9">
                    <img :src="card.image" alt="Image">
                </figure>
            </div>
            <div class="card-content">
                <div class="media">
                    <div class="media-left">
                        <figure class="image is-48x48">
                            <img :src="card.avatar" alt="Image">
                        </figure>
                    </div>
                    <div class="media-content">
                        <p class="title is-4 no-padding">card.user.title</p>
                        <p>
                  <span class="title is-6">
                    <a :href=`http://twitter.com/${card.user.handle}`> card.user.handle </a> </span> </p>
                        <p class="subtitle is-6">card.user.title</p>
                    </div>
                </div>
                <div class="content">
                    card.content
                    <div class="background-icon"><span class="icon-twitter"></span></div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
