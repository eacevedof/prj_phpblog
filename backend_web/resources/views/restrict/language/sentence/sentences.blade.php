@extends('restrict.restrict-layout')

@section('content')
<div class="container">
    @section("pagetitle", "update sentence")
    @include("restrict/elements/breadscrumb")
    @include("restrict/elements/sentence-tabs")
<!-- sentencesentences.vue -->
<sentencesentences></sentencesentences>
<!-- /sentencesentences.vue -->
    @include("restrict/elements/breadscrumb")
</div>
@endsection
