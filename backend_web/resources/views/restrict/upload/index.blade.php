@extends('restrict.restrict-layout')

@section("pagetitle", "Upload")
@section('content')
<div class="container">
    <input type="hidden" id="upload-token" value="{{$token}}"/>
    <input type="hidden" id="upload-domain" value="{{$uploaddomain}}"/>
    <span id="span-top"></span>
    @include("restrict/elements/breadscrumb")
    <uploadindex />
</div>
@endsection
