@extends('restrict.restrict-layout')

@section("pagetitle", "Upload")
@section('content')
<div class="container">
    <input type="hidden" id="upload-token" value="{{$token}}"/>
    @include("restrict/elements/breadscrumb")
    <uploadindex />
</div>
@endsection
