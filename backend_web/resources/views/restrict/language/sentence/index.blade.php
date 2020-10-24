@extends('restrict.restrict-layout')

@section('content')
<div class="container">
    @section("pagetitle", "Sentences")
    @include("restrict/elements/breadscrumb")
    <sentenceindex></sentenceindex>
    @include("restrict/elements/breadscrumb")
</div>
@endsection
