<template>
<div class="card">
    <div class="card-body">
        <form id="form-insert" @submit="handleSubmit">
            <div class="row card-header res-formheader">
                <div class="col-md-9">
                    <h1>Insert upload</h1>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-primary res-btnformheader" :disabled="issending">
                        {{btnsend}}
                        <img v-if="issending" src="/assets/images/loading-bw.gif" width="25" height="25"/>
                    </button>
                </div>
            </div>
            <div class="form-row mt-1">
                <div class="form-group col-md-12">
                    <label for="txa-content">By urls</label>
                    <textarea id="txa-content"
                              v-model="upload.content" rows="5" cols="10" class="form-control"
                              placeholder="<urlimg>:<name>;<urlimg1>:<name1>..."
                    ></textarea>
                </div>
                <div class="form-group col-md-12">
                    <label for="fil-url_img1">Url img1</label>
                    <input type="file" id="fil-url_img1" @change="on_change()" maxlength="300" class="form-control"/>
                </div>
                <div class="form-group col-md-12">
                    <label for="fil-url_img2">Url img2</label>
                    <input type="file" id="fil-url_img2" @change="on_change()" maxlength="300" class="form-control"/>
                </div>
                <div class="form-group col-md-12">
                    <label for="fil-url_img3">Url img3</label>
                    <input type="file" id="fil-url_img3" @change="on_change()" maxlength="300" class="form-control">
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
        :time-out="1000"
        :closeable="true"
    ></Toasts>
</div>
</template>
<script type="module" src="./uploadinsert.js"></script>
