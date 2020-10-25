@extends('restrict.restrict-layout')

@section('content')
<div class="container">
    @section("pagetitle", "update sentence")
    @include("restrict/elements/breadscrumb")
    @include("restrict/elements/subject-tabs")
    <sentenceupdate></sentenceupdate>
    @include("restrict/elements/breadscrumb")
</div>
@endsection
