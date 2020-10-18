@extends('restrict.restrict-layout')

@section('content')
<div class="container">
    @section("pagetitle", "Posts")
    @include("restrict/elements/breadscrumb")
    <subjectindex></subjectindex>
    @include("restrict/elements/breadscrumb")
</div>
@endsection
