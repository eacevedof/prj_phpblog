@extends('restrict.restrict-layout')

@section('content')
<div class="container">
    @section("pagetitle", "Insert upload")
    @include("restrict/elements/breadscrumb")
    <uploadinsert />
</div>
@endsection
