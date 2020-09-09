@extends('restrict.restrict-layout')

@section("pagetitle", "Upload")
@section('content')
    <div class="container">
        @section("pagetitle", "Insert post")
        @include("restrict/elements/breadscrumb")
        <uploadindex />
    </div>
@endsection
