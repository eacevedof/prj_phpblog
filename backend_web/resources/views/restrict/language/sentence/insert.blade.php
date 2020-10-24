@extends('restrict.restrict-layout')

@section('content')
<div class="container">
    @section("pagetitle", "Insert sentence")
    @include("restrict/elements/breadscrumb")
    @include("restrict/elements/subject-tabs")
    <sentenceinsert></sentenceinsert>
    @include("restrict/elements/breadscrumb")
</div>
@endsection
