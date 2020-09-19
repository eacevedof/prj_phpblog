@extends('restrict.restrict-layout')

@section('content')
<div class="container">
    @section("pagetitle", "update post")
    @include("restrict/elements/breadscrumb")
    <span id="span-top"></span>
    <postupdate></postupdate>
    @include("restrict/elements/breadscrumb")
    @include("common/elements/totop")
</div>
@endsection
