@extends('restrict.restrict-layout')

@section('content')
<div class="container">
    @section("pagetitle", "Insert subject")
    @include("restrict/elements/breadscrumb")
    <subjectinsert></subjectinsert>
    @include("restrict/elements/breadscrumb")
</div>
@endsection
