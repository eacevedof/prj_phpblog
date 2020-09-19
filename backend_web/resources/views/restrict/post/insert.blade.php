@extends('restrict.restrict-layout')

@section('content')
<div class="container">
    @section("pagetitle", "Insert post")
    @include("restrict/elements/breadscrumb")
    <postinsert></postinsert>
    @include("restrict/elements/breadscrumb")
</div>
@endsection
