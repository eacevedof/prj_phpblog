@extends('restrict.restrict-layout')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>New article</h1>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="form-group">
                    <label for="txt-description">Hidden description</label>
                    <input type="text" id="txt-description" name="description" maxlength="250" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="txt-slug">Slug</label>
                    <input type="text" id="txt-slug" name="slug" maxlength="150" class="form-control"/>
                </div>
                <div class="form-check">
                    <input type="checkbox" id="chk-is_page" name="is_page" class="form-check-input"/>
                    <label for="chk-is_page" class="form-check-label">Is single page</label>
                </div>
                <div class="form-group">
                    <label for="sel-id_type">Category</label>
                    <select id="sel-id_type" name="id_type">
                        <option value="">Choose one</option>
                        <option value="single-page">Single page</option>
                        <option value="blog-php">Php</option>
                        <option value="blog-js">Js</option>
                        <option value="blog-docker">Docker</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="txt-url_final">Permalink</label>
                    <input type="text" id="chk-url_final" name="url_final" maxlength="300" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="txt-url_img1">Url img1</label>
                    <input type="text" id="chk-url_img1" name="url_img1" maxlength="300" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="txt-url_img2">Url img2</label>
                    <input type="text" id="chk-url_img2" name="url_img2" maxlength="300" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="txt-url_img3">Url img3</label>
                    <input type="text" id="chk-url_img3" name="url_img3" maxlength="300" class="form-control">
                </div>
                <div class="form-group">
                    <label for="txt-title">title</label>
                    <input type="text" id="txt-title" name="title" maxlength="350" class="form-control">
                </div>
                <div class="form-group">
                    <label for="txt-subtitle">subtitle</label>
                    <input type="text" id="txt-subtitle" name="subtitle" maxlength="250" class="form-control">
                </div>
                <div class="form-group">
                    <label for="txa-excerpt">excerpt</label>
                    <textarea id="txa-excerpt" name="excerpt" maxlength="1000" rows="4" cols="5" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="txa-content">content</label>
                    <textarea id="txa-content" name="content" rows="10" cols="10" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="sel-id_user">User</label>
                    <select id="sel-id_user" name="id_user" class="form-control">
                        <option value="1">1</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sel-id_status">User</label>
                    <select id="sel-id_status" name="id_status" class="form-control">
                        <option value="0">disabled</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="dat-publish_date">Published</label>
                    <input type="date" id="dat-publish_date" name="publish_date" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="dat-last_update">Published</label>
                    <input type="date" id="dat-last_update" name="last_update" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="txt-seo_title">seo_title</label>
                    <input type="text" id="txt-seo_title" name="seo_title" maxlength="65" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="txt-seo_description">seo_description</label>
                    <input type="text" id="txt-seo_description" name="seo_description" maxlength="160" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="num-order_by">order_by</label>
                    <input type="number" id="num-order_by" name="order_by" class="form-control"/>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

    </div>
</div>
@endsection
