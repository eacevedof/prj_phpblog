@extends('restrict.restrict-layout')

@section('content')
<div class="container">
    @section("pagetitle", "update subject")
    @include("restrict/elements/breadscrumb")
    @include("restrict/elements/subject-tabs")
    <subjectupdate></subjectupdate>
    @include("restrict/elements/breadscrumb")
</div>
@endsection
