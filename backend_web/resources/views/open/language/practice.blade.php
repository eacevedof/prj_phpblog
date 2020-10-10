@extends("open.language-layout")

@php
$title = sprintf($seo["title"],$result["subject"]->title) ?? "";
$subject = $result["subject"];
$jsonresult = json_encode($result);
@endphp

@section("pagetitle",$title)
@section("pagedescription",$seo["description"])
@section("pagekeywords",$seo["keywords"])

@section("container")
<link rel="stylesheet" href="https://kingsora.github.io/OverlayScrollbars/etc/os-theme-thin-dark.css">
<link rel="stylesheet" href="{{asset("assets/bulma-templates/css/prism.css")}}">
<link rel="stylesheet" href="{{asset("assets/bulma-templates/css/cheatsheet.css")}}">

<section class="hero is-primary">
    <div class="hero-body">
        <div class="columns">
            <div class="column is-12">
                <div class="container content">
                    <h1 class="title">{{$subject->title}}</h1>
                    <h3 class="subtitle">
                        {{$subject->excerpt}}
                    </h3>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="columns">
            @include("open.elements.bulma.practice-left")

            <div class="column is-10">
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
                        <pre><code class="language-javascript">const test = "test";</code></pre>
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
<script>
const practice = {!! $jsonresult !!};
</script>
<script type="module" src="/js/open/service/vue-language-practice.js"></script>
@endsection
