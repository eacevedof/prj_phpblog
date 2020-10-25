<template>
<div class="card">
    <div class="card-body">
        <form id="form-insert" @submit="handleSubmit">
            <div class="row card-header res-formheader">
                <div class="col-md-9">
                    <p>TR for: {{sentence.translatable}}</p>
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
                    <label for="sel-id_language">Language *</label>
                    <select id="sel-id_language" v-model="sentencetr.id_language" class="form-control" required>
                        <option disabled value="">Choose one</option>
                        <option v-for="language in languages" :value="language.id">{{language.description}}</option>
                    </select>
                </div>

                <div class="form-group col-md-12">
                    <label for="txa-translated">Translated *</label>
                    <textarea id="txa-translated" v-model="sentencetr.translated" maxlength="1000" rows="3" cols="5" class="form-control" required></textarea>
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
<script type="module" src="./sentencetrinsert.js"></script>
