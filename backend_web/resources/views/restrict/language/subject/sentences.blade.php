@extends('restrict.restrict-layout')

@section('content')
<div class="container">
    @section("pagetitle", "update subject")
    @include("restrict/elements/breadscrumb")
    @include("restrict/elements/subject-tabs")
<script>
const idsubject = {!! $idsubject !!};
//alert(idsubject)
</script>
<!-- subjectsentences.vue -->
<subjectsentences></subjectsentences>
<!-- /subjectsentences.vue -->
    @include("restrict/elements/breadscrumb")
</div>
@endsection
