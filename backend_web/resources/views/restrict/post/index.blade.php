@extends('restrict.restrict-layout')

@section('content')
<div class="container">
    @section("pagetitle", "Posts")
    @include("restrict/elements/breadscrumb")
    <postindex></postindex>
    @include("restrict/elements/breadscrumb")
    @include("common/elements/totop")
</div>
@endsection
