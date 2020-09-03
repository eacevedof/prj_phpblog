@extends('restrict.restrict-layout')

@section('content')
<div class="container">
    @section("pagetitle", "Update post")
    @include("restrict/elements/breadscrumb")
    <postupdate/>
</div>
@endsection
