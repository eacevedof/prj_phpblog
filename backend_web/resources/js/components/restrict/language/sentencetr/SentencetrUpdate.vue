<template>
<div class="card">
    <div class="card-body">
        <form @submit="handleSubmit">
            <div class="row card-header res-formheader">
                <div class="col-md-6 col-sm-6 pt-2">
                    <p><b>{{sentence.translatable}}</b></p>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-secondary mt-2 text-white" :disabled="issending" v-on:click="load_register(sentencetr.id)">
                        <i class="fa fa-refresh" aria-hidden="true"></i>
                    </button>
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
                <div class="form-group col-md-4">
                    <label for="sel-id_language">Language *</label>
                    <select id="sel-id_language" v-model="sentencetr.id_language" class="form-control" required>
                        <option disabled value="">Choose one</option>
                        <option v-for="language in languages" :value="language.id">{{language.description}}</option>
                    </select>
                </div>

                <div class="form-group col-md-12">
                    <label for="txa-translated">Translated *</label>
                    <textarea id="txa-translated" ref="txatranslated" v-model="sentencetr.translated" maxlength="1000" rows="3" cols="5" class="form-control" required></textarea>
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
