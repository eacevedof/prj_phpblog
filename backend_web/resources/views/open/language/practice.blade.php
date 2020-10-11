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
<link rel="stylesheet" href="https://unpkg.com/buefy/dist/buefy.min.css">
@include("open.elements.bulma.practice-header")
<section class="section">
    <div class="container">
        <div class="columns">
            @include("open.elements.bulma.practice-left")
            @include("open.elements.bulma.practice-main")
        </div>
    </div>
</section>
<!--
https://buefy.org/documentation/start
-->
<script src="https://unpkg.com/vue"></script>
<!-- Full bundle -->
<script src="https://unpkg.com/buefy/dist/buefy.min.js"></script>
<!-- Individual components -->
<script src="https://unpkg.com/buefy/dist/components/toast"></script>
<script src="https://unpkg.com/buefy/dist/components/input"></script>

<script>
const objpractice = {!! $jsonresult !!};
const toast = window.Toast.ToastProgrammatic
</script>
<script type="module" src="/js/open/service/vue-language-left.js"></script>
<script type="module" src="/js/open/service/vue-language-main.js"></script>
@endsection
