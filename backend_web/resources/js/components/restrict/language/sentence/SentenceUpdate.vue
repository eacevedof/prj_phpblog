<template>
<div class="card">
    <div class="card-body">
        <form @submit="handleSubmit">
            <div class="row card-header res-formheader"
                 v-bind:class="{ 'res-cardtitle': sentence.id_status == 1 }"
            >
                <div class="col-md-6 col-sm-6 pt-2">
                    <h1>Update sentence</h1>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-secondary mt-2 text-white" :disabled="issending" v-on:click="load_register(sentence.id)">
                        <i class="fa fa-refresh" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="col-md-2">
                    <a v-if="sentence.id_status==0" class="btn btn-dark mt-2" :disabled="issending" target="_blank" :href="'/blog/draft/'+sentence.id">
                        Draft &nbsp;<i class="fa fa-window-maximize" aria-hidden="true"></i>
                    </a>
                    <a v-if="sentence.id_status!=0" class="btn btn-info text-white mt-2" :disabled="issending" target="_blank" :href="sentence.url_final">
                        View &nbsp;
                        <i class="fa fa-window-maximize" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary mt-2" :disabled="issending">
                        {{btnsend}}
                        <img v-if="issending" src="/assets/images/loading-bw.gif" width="25" height="25"/>
                    </button>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger res-btnformheader" :disabled="issending" v-on:click="remove(sentence.id)">
                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <div class="form-row mt-1">
                <div class="form-group col-md-2">
                    <label>Id</label>
                    <span class="form-control">{{ sentence.id }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="sel-id_type_source">Source *</label>
                    <select id="sel-id_type_source" v-model="sentence.id_type_source" class="form-control" required>
                        <option disabled value="">Choose one</option>
                        <option v-for="source in sources" :value="source.id">{{source.description}}</option>
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <label for="txt-title">Title *</label>
                    <input type="text" id="txt-title" v-model="sentence.title" @change="onchange_title()" maxlength="350" class="form-control" required>
                </div>
                <div class="form-group col-md-12">
                    <label for="txt-url_resource">Url resource *</label>
                    <input type="text" id="txt-url_resource" v-model="sentence.url_resource" maxlength="300" class="form-control" required/>
                </div>
                <div class="form-group col-md-12">
                    <label for="txa-excerpt">excerpt</label>
                    <textarea id="txa-excerpt" v-model="sentence.excerpt" maxlength="1000" rows="3" cols="5" class="form-control"></textarea>
                </div>
                <div class="form-group col-md-12">
                    <label for="txt-url_img1">Url img1 (list)*</label>
                    <input type="text" id="txt-url_img1" v-model="sentence.url_img1" maxlength="300" class="form-control" required/>
                    <button type="button" class="btn btn-dark"
                            v-on:click="on_btnalbum"
                    ><i class="fa fa-picture-o" aria-hidden="true"></i> Album</button>
                    <button type="button" class="btn btn-warning"
                            :disabled="issending"
                            v-on:click="load_lastupload()"
                    >
                        <i class="fa fa-clipboard" aria-hidden="true"></i> Get img
                        <img v-if="issending" src="/assets/images/loading-bw.gif" width="25" height="25"/>
                    </button>
                </div>
                <div v-if="sentence.url_img1" class="col-6">
                    <a :href="sentence.url_img1" target="_blank">
                        <img :src="sentence.url_img1" class="img-thumbnail" :alt="sentence.url_img1" />
                    </a>
                </div>
                <div class="form-group col-md-6">
                    <label for="txt-url_img2">Url img2 (detail)</label>
                    <input type="text" id="txt-url_img2" v-model="sentence.url_img2" maxlength="300" class="form-control"/>
                </div>
                <div class="form-group col-md-12">
                    <label for="txt-slug">Slug *</label>
                    <input type="text" id="txt-slug" v-model="sentence.slug" maxlength="150" class="form-control" required/>
                </div>
                <div class="form-group col-md-12">
                    <label for="txt-url_final">Permalink *</label>
                    <input type="text" id="txt-url_final" v-model="sentence.url_final" maxlength="300" class="form-control" required/>
                </div>
                <div class="form-group col-md-3">
                    <label for="sel-id_status">Status</label>
                    <select id="sel-id_status" v-model="sentence.id_status" class="form-control">
                        <option value="0">Disable</option>
                        <option value="1">Enable</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="txt-seo_title">SEO Title</label>
                    <input type="text" id="txt-seo_title" v-model="sentence.seo_title" maxlength="65" class="form-control"/>
                </div>
                <div class="form-group col-md-6">
                    <label for="txt-seo_description">SEO Description</label>
                    <input type="text" id="txt-seo_description" v-model="sentence.seo_description" maxlength="160" class="form-control"/>
                </div>
                <div class="form-group col-md-4">
                    <label for="txt-description">Notes</label>
                    <input type="text" id="txt-description" v-model="sentence.description" maxlength="250" class="form-control"/>
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
<script type="module" src="./sentenceupdate.js"></script>
