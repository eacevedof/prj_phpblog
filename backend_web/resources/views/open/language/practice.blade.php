@extends("open.language-layout")

@php $title = sprintf($seo["title"],$result["subject"]->title) ?? "" @endphp

@section("pagetitle",$title)
@section("pagedescription",$seo["description"])
@section("pagekeywords",$seo["keywords"])

@section("container")

<div class="columns">
    <div class="column has-text-centered">
        <h1 class="title" style="color: ghostwhite;">{{$title}}</h1><br>
    </div>
</div>
<div class="row">
    @php $subject = $result["subject"] @endphp
    <h2>{{$subject->title}}</h2>
    <p>
    {{$subject->excerpt}}
    </p>
</div>
<section class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-3">
                <aside class="is-medium menu">
                    <p class="menu-label">
                        categories
                    </p>
                    <ul class="menu-list">
                        <li class="is-right"><a href="#const" class="is-active"><i class="fab fa-css3-alt"></i> CSS</a></li>
                        <li><a href="#let" class="is-active"><i class="fab fa-js"></i> JS</a></li>
                        <li><a href="#let" class="is-active"><i class="fab fa-html5"></i> HTML</a></li>
                    </ul>
                    <p class="menu-label">
                        More to read...
                    </p>
                    <ul class="menu-list">
                        <li><span class="tag is-white is-medium">Lorem</span></li>
                        <li><span class="tag is-white is-medium">Ipsum</span></li>
                        <li><span class="tag is-white is-medium">Dolor</span></li>
                        <li><span class="tag is-white is-medium">Animi</span></li>
                        <li><span class="tag is-white is-medium">Eximi</span></li>
                        <li><span class="tag is-white is-medium">Nullius</span></li>
                        <li><span class="tag is-white is-medium">Oxipi</span></li>
                        <li><span class="tag is-white is-medium">Vultus</span></li>
                        <li><span class="tag is-white is-medium">Voluptatis</span></li>
                        <li><span class="tag is-white is-medium">Exomarphis</span></li>
                        <li><span class="tag is-white is-medium">Finimi</span></li>
                        <li><span class="tag is-white is-medium">Aenigma</span></li>
                        <li><span class="tag is-white is-medium">Arkham</span></li>
                        <li><span class="tag is-white is-medium">Blue</span></li>
                        <li><span class="tag is-white is-medium">Medium</span></li>
                    </ul>
                </aside>
            </div>
            <div class="column is-9">
                <div class="content is-medium">
                    <h3 class="title is-3">Snippets ¯\_(ツ)_/¯</h3>
                    <div class="box">
                        <h4 id="const" class="title is-3">const</h4>
                        <article class="message is-primary">
                  <span class="icon has-text-primary">
                  <i class="fab fa-js"></i>
                  </span>
                            <div class="message-body">
                                Block-scoped. Cannot be re-assigned. Not immutable.
                            </div>
                        </article>
                        <pre><code class="language-javascript">const test = 'test';</code></pre>
                    </div>
                    <div class="box">
                        <h4 id="let" class="title is-3">let</h4>
                        <article class="message is-primary">
                <span class="icon has-text-primary">
                  <i class="fas fa-info-circle"></i>
                </span>
                            <div class="message-body">
                                Block-scoped. Can be re-assigned.
                            </div>
                        </article>
                        <pre><code class="language-javascript">let i = 0;</code></pre>
                    </div>
                    <h3 class="title is-3">More to Come...</h3>
                    <div class="box">
                        <h4 id="lorem" class="title is-4">More to come...</h4>
                        <article class="message is-primary">
              <span class="icon has-text-primary">
                <i class="fas fa-info-circle"></i>
              </span>
                            <div class="message-body">
                                Lorem ipsum dolor sit amet, mea ne viderer veritus menandri, id scaevola gloriatur instructior sit.
                            </div>
                        </article>
                        <pre><code class="language-javascript">let i = 0;</code></pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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
