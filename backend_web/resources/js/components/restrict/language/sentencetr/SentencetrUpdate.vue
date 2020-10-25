<template>
<div class="card">
    <div class="card-body">
        <form @submit="handleSubmit">
            <div class="row card-header res-formheader"
                 v-bind:class="{ 'res-cardtitle': sentencetr.id_status == 1 }"
            >
                <div class="col-md-6 col-sm-6 pt-2">
                    <h1>Update sentencetr</h1>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-secondary mt-2 text-white" :disabled="issending" v-on:click="load_register(sentencetr.id)">
                        <i class="fa fa-refresh" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="col-md-2">
                    <a v-if="sentencetr.id_status==0" class="btn btn-dark mt-2" :disabled="issending" target="_blank" :href="'/blog/draft/'+sentencetr.id">
                        Draft &nbsp;<i class="fa fa-window-maximize" aria-hidden="true"></i>
                    </a>
                    <a v-if="sentencetr.id_status!=0" class="btn btn-info text-white mt-2" :disabled="issending" target="_blank" :href="sentencetr.url_final">
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
                    <button type="button" class="btn btn-danger res-btnformheader" :disabled="issending" v-on:click="remove(sentencetr.id)">
                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <div class="form-row mt-1">
                <div class="form-group col-md-2">
                    <label>Id</label>
                    <span class="form-control">{{ sentencetr.id }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="sel-id_language">Language *</label>
                    <select id="sel-id_language" v-model="sentencetr.id_language" class="form-control" required>
                        <option disabled value="">Choose one</option>
                        <option v-for="language in languages" :value="language.id">{{language.description}}</option>
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="sel-id_type">Type *</label>
                    <select id="sel-id_type" v-model="sentencetr.id_type" class="form-control" required>
                        <option disabled value="">Choose one</option>
                        <option v-for="type in types" :value="type.id">{{type.description}}</option>
                    </select>
                </div>

                <div class="form-group col-md-12">
                    <label for="txa-translatable">Translatable *</label>
                    <textarea id="txa-translatable" v-model="sentencetr.translatable" maxlength="1000" rows="3" cols="5" class="form-control" required></textarea>
                </div>

                <div class="form-group col-md-4">
                    <label for="sel-id_context">Context</label>
                    <select id="sel-id_context" v-model="sentencetr.id_context" class="form-control">
                        <option disabled value="">Choose one</option>
                        <option v-for="context in contexts" :value="context.id">{{context.description}}</option>
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label for="sel-is_notificable">Notificable</label>
                    <select id="sel-is_notificable" v-model="sentencetr.is_notificable" class="form-control">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label for="sel-id_status">Status</label>
                    <select id="sel-id_status" v-model="sentencetr.id_status" class="form-control">
                        <option value="0">Disable</option>
                        <option value="1">Enable</option>
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="txt-description">Notes</label>
                    <input type="text" id="txt-description" v-model="sentencetr.description" maxlength="250" class="form-control"/>
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
<script type="module" src="./sentencetrupdate.js"></script>
