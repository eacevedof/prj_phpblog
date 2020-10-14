<template>
<div class="card">
    <div class="card-body">
        <form id="form-insert" @submit="handleSubmit">
            <div class="row card-header res-formheader">
                <div class="col-md-9">
                    <h1>Insert subject</h1>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-primary res-btnformheader" :disabled="issending">
                        {{btnsend}}
                        <img v-if="issending" src="/assets/images/loading-bw.gif" width="25" height="25"/>
                    </button>
                </div>
            </div>
            <div class="form-row mt-1">
                <div class="form-group col-md-4">
                    <label for="sel-id_type">Category *</label>
                    <select id="sel-id_type" v-model="subject.id_type" class="form-control" required>
                        <option disabled value="">Choose one</option>
                        <option v-for="category in categories" :value="category.id">{{category.description}}</option>
                    </select>
                </div>
                <div class="form-check col-md-4" style="padding-top:35px">
                    <input type="checkbox" id="chk-is_page" v-model="subject.is_page" value="1" />
                    <label for="chk-is_page" class="form-check-label"><b>Is single page</b></label>
                </div>
                <div class="form-group col-md-12">
                    <label for="txt-title">Title *</label>
                    <input type="text" id="txt-title" v-model="subject.title" @change="onchange_title()" maxlength="350" class="form-control" required>
                </div>
                <div class="form-group col-md-12">
                    <label for="txa-content">content</label>
                    <textarea id="txa-content" v-model="subject.content" rows="25" cols="10" class="form-control"></textarea>
                </div>
                <div class="form-group col-md-12">
                    <label for="txa-excerpt">excerpt</label>
                    <textarea id="txa-excerpt" v-model="subject.excerpt" maxlength="1000" rows="3" cols="5" class="form-control"></textarea>
                </div>
                <div class="form-group col-md-12">
                    <label for="txt-slug">Slug *</label>
                    <input type="text" id="txt-slug" v-model="subject.slug" maxlength="150" class="form-control" required/>
                </div>
                <div class="form-group col-md-12">
                    <label for="txt-url_final">Permalink *</label>
                    <input type="text" id="txt-url_final" v-model="subject.url_final" maxlength="300" class="form-control" required/>
                </div>
                <div class="form-group col-md-12">
                    <label for="txt-subtitle">subtitle</label>
                    <input type="text" id="txt-subtitle" v-model="subject.subtitle" maxlength="250" class="form-control">
                </div>
<!--
                <div class="form-group col-md-12">
                    <label for="txt-url_img1">Url img1</label>
                    <input type="text" id="txt-url_img1" v-model="subject.url_img1" maxlength="300" class="form-control"/>
                    <a href="/adm/upload" class="btn btn-dark" ><i class="fa fa-picture-o" aria-hidden="true"></i> Album</a>
                    <button type="button" class="btn btn-warning"
                            :disabled="issending"
                            v-on:click="load_lastupload()"
                    >
                        <i class="fa fa-clipboard" aria-hidden="true"></i> Get img
                        <img v-if="issending" src="/assets/images/loading-bw.gif" width="25" height="25"/>
                    </button>
                </div>
                <div class="form-group col-md-6">
                    <label for="txt-url_img2">Url img2</label>
                    <input type="text" id="txt-url_img2" v-model="subject.url_img2" maxlength="300" class="form-control"/>
                </div>
                <div class="form-group col-md-6">
                    <label for="txt-url_img3">Url img3</label>
                    <input type="text" id="txt-url_img3" v-model="subject.url_img3" maxlength="300" class="form-control">
                </div>
-->
                <div class="form-group col-md-3">
                    <label for="sel-id_user">User</label>
                    <select id="sel-id_user" v-model="subject.id_user" class="form-control">
                        <option value="1">1</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="sel-id_status">Status</label>
                    <select id="sel-id_status" v-model="subject.id_status" class="form-control">
                        <option value="0">Disabled</option>
                        <option value="1">Published</option>
                    </select>
                </div>
<!--
                <div class="form-group col-md-3">
                    <label for="dat-publish_date">Published</label>
                    <input type="date" id="dat-publish_date" v-model="subject.publish_date" class="form-control" />
                </div>
                <div class="form-group col-md-3">
                    <label for="dat-last_update">Last update</label>
                    <input type="date" id="dat-last_update" v-model="subject.last_update" class="form-control" />
                </div>
-->
                <div class="form-group col-md-6">
                    <label for="txt-seo_title">SEO Title</label>
                    <input type="text" id="txt-seo_title" v-model="subject.seo_title" maxlength="65" class="form-control"/>
                </div>
                <div class="form-group col-md-6">
                    <label for="txt-seo_description">SEO Description</label>
                    <input type="text" id="txt-seo_description" v-model="subject.seo_description" maxlength="160" class="form-control"/>
                </div>
                <div class="form-group col-md-4">
                    <label for="txt-description">Notes</label>
                    <input type="text" id="txt-description" v-model="subject.description" maxlength="250" class="form-control"/>
                </div>
                <div class="form-group col-md-2">
                    <label for="num-order_by">Position</label>
                    <input type="number" id="num-order_by" v-model="subject.order_by" value="100" class="form-control"/>
                </div>
                <div class="form-group col-md-4">
                    <button class="btn btn-primary res-btncol" :disabled="issending">
                        {{btnsend}}
                        <img v-if="issending" src="/assets/images/loading-bw.gif" width="25" height="25"/>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <Toasts
        :show-progress="true"
        :rtl="false"
        :max-messages="5"
        :time-out="5000"
        :closeable="true"
    ></Toasts>
</div>
</template>
<script type="module" src="./subjectinsert.js"></script>
