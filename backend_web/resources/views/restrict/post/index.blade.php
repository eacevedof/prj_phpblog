@extends('restrict.restrict-layout')

@section('content')
<div class="container">
    @section("pagetitle", "Posts")
    @include("restrict/elements/breadscrumb")
    <posts />
</div>
@endsection
