@extends('restrict.restrict-layout')

@section("pagetitle", "Admin")
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
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Upload</h5>
                    <p class="card-text">Manage images repository in upload.theframework.es</p>
                    <a href="/adm/upload" class="btn btn-primary">List</a>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Subject</h5>
                    <a href="/adm/language/subjects" class="btn btn-primary">List</a>
                    <a href="/adm/language/subject/insert" class="btn btn-dark">Create</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
