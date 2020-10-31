@extends('restrict.restrict-layout')

@section('content')
<div class="container">
    @section("pagetitle", "Insert sentencetr")
    @include("restrict/elements/breadscrumb")
    @include("restrict/elements/subject-tabs")
    <sentencetrinsert></sentencetrinsert>
    @include("restrict/elements/breadscrumb")
</div>
<script type="application/javascript">
//const idsubject = "{{$idsubject}}"
</script>
@endsection
