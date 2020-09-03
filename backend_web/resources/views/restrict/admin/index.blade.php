@extends('restrict.restrict-layout')

@section('content')
<div class="container">
    @include("restrict/elements/breadscrumb")
    <div class="row">
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Posts</h5>
                    <p class="card-text">Manage all articles and single pages</p>
                    <a href="/adm/posts" class="btn btn-primary">List</a>
                    <a href="/adm/post/insert" class="btn btn-dark">Create</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
