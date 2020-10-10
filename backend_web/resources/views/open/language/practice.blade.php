@extends("open.language-layout")

@php
$subject = $result["subject"];
$title = sprintf($seo["title"], $subject->title) ?? "";
$jsonresult = json_encode($result);
@endphp

@section("pagetitle",$title)
@section("pagedescription",$seo["description"])
@section("pagekeywords",$seo["keywords"])

@section("container")
<link rel="stylesheet" href="https://kingsora.github.io/OverlayScrollbars/etc/os-theme-thin-dark.css">
<link rel="stylesheet" href="{{asset("assets/bulma-templates/css/prism.css")}}">
<link rel="stylesheet" href="{{asset("assets/bulma-templates/css/cheatsheet.css")}}">

@include("open.elements.bulma.practice-header")
<section class="section">
    <div class="container">
        <div class="columns">
            @include("open.elements.bulma.practice-left")

            @include("open.elements.bulma.practice-main")
        </div>
    </div>
</section>
<script>
const objpractice = {!! $jsonresult !!};
</script>
<script type="module" src="/js/open/service/vue-language-left.js"></script>
<script type="module" src="/js/open/service/vue-language-main.js"></script>
@endsection
