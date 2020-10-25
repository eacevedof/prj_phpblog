@extends('restrict.restrict-layout')

@section('content')
<div class="container">
    @section("pagetitle", "update sentencetr")
    @include("restrict/elements/breadscrumb")
    @include("restrict/elements/subject-tabs")
    <sentencetrupdate></sentencetrupdate>
    @include("restrict/elements/breadscrumb")
</div>
@endsection
