@extends('restrict.restrict-layout')

@section('content')
<div class="container">
    @section("pagetitle", "Sentence TRS")
    @include("restrict/elements/breadscrumb")
    @include("restrict/elements/subject-tabs")

    <sentencesentencetrs></sentencesentencetrs>

    @include("restrict/elements/breadscrumb")
</div>
@endsection
