@extends('restrict.restrict-layout')

@section('content')
<div class="container">
    Insert Post
    <form action="">
        <div class="form-group">
            <label for="txt-description">description</label>
            <input type="text" id="txt-description" name="description" maxlength="250">
        </div>
        <div class="form-group">
            <label for="txt-slug">slug</label>
            <input type="text" id="txt-slug" name="slug" maxlength="150">
        </div>
        <div class="form-group">
            <label for="chk-is_page">is_page</label>
            <input type="checkbox" id="chk-is_page" name="is_page">
        </div>
        <div class="form-group">
            <label for="txt-url_final">url_final</label>
            <input type="text" id="chk-url_final" name="url_final" maxlength="300">
        </div>
        <div class="form-group">
            <label for="sel-id_type">Type</label>
            <select id="sel-id_type" name="id_type">
                <option>...</option>
            </select>
        </div>
        <div class="form-group">
            <label for="txt-url_img1">Url img1</label>
            <input type="text" id="chk-url_img1" name="url_img1" maxlength="300">
        </div>
        <div class="form-group">
            <label for="txt-url_img2">Url img2</label>
            <input type="text" id="chk-url_img2" name="url_img2" maxlength="300">
        </div>
        <div class="form-group">
            <label for="txt-url_img3">Url img3</label>
            <input type="text" id="chk-url_img3" name="url_img3" maxlength="300">
        </div>
        <div class="form-group">
            <label for="txt-title">title</label>
            <input type="text" id="txt-title" name="title" maxlength="350">
        </div>
        <div class="form-group">
            <label for="txt-subtitle">subtitle</label>
            <input type="text" id="txt-subtitle" name="subtitle" maxlength="250">
        </div>
        <div class="form-group">
            <label for="txa-excerpt">excerpt</label>
            <textarea id="txa-excerpt" name="excerpt" maxlength="1000" rows="4" cols="5"></textarea>
        </div>
        <div class="form-group">
            <label for="txa-content">content</label>
            <textarea id="txa-content" name="content" rows="10" cols="10"></textarea>
        </div>
        <div class="form-group">
            <label for="sel-id_user">User</label>
            <select id="sel-id_user" name="id_user">
                <option value="1">1</option>
            </select>
        </div>
        <div class="form-group">
            <label for="sel-id_status">User</label>
            <select id="sel-id_status" name="id_status">
                <option value="0">disabled</option>
            </select>
        </div>
        <div class="form-group">
            <label for="dat-publish_date">Published</label>
            <input type="date" id="dat-publish_date" name="publish_date">
        </div>
        <div class="form-group">
            <label for="dat-last_update">Published</label>
            <input type="date" id="dat-last_update" name="last_update">
        </div>
        <div class="form-group">
            <label for="txt-seo_title">seo_title</label>
            <input type="text" id="txt-seo_title" name="seo_title" maxlength="65">
        </div>
        <div class="form-group">
            <label for="txt-seo_description">seo_description</label>
            <input type="text" id="txt-seo_description" name="seo_description" maxlength="160">
        </div>
        <div class="form-group">
            <label for="num-order_by">order_by</label>
            <input type="number" id="num-order_by" name="order_by">
        </div>
    </form>
</div>
@endsection
