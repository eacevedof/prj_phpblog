@extends('restrict.restrict-layout')

@section('content')
<div class="container">
    @section("pagetitle", "Insert post")
    @include("restrict/elements/breadscrumb")
    <postinsert />
</div>
@endsection
