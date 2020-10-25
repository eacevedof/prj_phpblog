@extends('restrict.restrict-layout')

@section('content')
<div class="container">
    @section("pagetitle", "Sentencetrs")
    @include("restrict/elements/breadscrumb")
    <sentencetrindex></sentencetrindex>
    @include("restrict/elements/breadscrumb")
</div>
@endsection
