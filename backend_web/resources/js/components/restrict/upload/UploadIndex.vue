<template>
<div class="card">
    <div class="row m-0 p-0 mt-4">
        <div class="form-group col-md-10 mb-2">
            <input type="text" class="form-control" placeholder="url to upload::name"
               ref="urlupload"
               @focus="$event.target.select()"
               v-model="upload.urlupload"
               v-on:keyup.enter="upload_byurl()"
            />
        </div>
        <div class="form-group col-md-2 mb-0">
            <button type="button" class="btn btn-dark" :disabled="issending" v-on:click="upload_byurl()">
                {{btnsend2}}
                <img v-if="issending" src="/assets/images/loading-bw.gif" width="25" height="25"/>
            </button>
        </div>
    </div>

    <div class="card-body">
        <div class="row card-header res-formheader">
            <div class="col-md-9">
                <h1>Upload</h1>
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary res-btnformheader" :disabled="issending" v-on:click="load()">
                    {{btnsend}}
                    <img v-if="issending" src="/assets/images/loading-bw.gif" width="25" height="25"/>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3" v-for="(url, i) in rows" :key="i">
                <div class="card">
                    <div class="card-body">
                        <p class="card-text">
                            <a :href="url" target="_blank">
                                <img :src="url" class="container-fluid"/>
                            </a>
                            <small :id="'rawlink-'+i">{{url}}</small>
                        </p>
                    </div>
                    <div class="card-footer text-muted">
                        <button class="btn btn-info" :disabled="issending"  v-on:click="copycb(i)">
                            <i class="fa fa-clipboard" aria-hidden="true"></i>
                        </button>
                        <button class="btn btn-danger" :disabled="issending"  v-on:click="remove(url)">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
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

<script>
import funcs from "../../../app/funcs"
import CONST from "../../../app/constants"

export default {
    data(){
        return {
            issending: false,
            btnsend: CONST.BTN_INISTATE_REFRESH,
            btnsend2: CONST.BTN_INISTATE_UPLOAD,
            rows: [],
            upload:{
                urlupload: ""
            }
        }
    },

    mounted() {
        this.load()
        this.$refs.urlupload.focus();
    },

    methods: {
        load(){
            console.log("...loading")
            const self = this
            self.issending = true
            self.btnsend = CONST.BTN_IN_PROGRESS

            const url = funcs.get_uploadomain().concat("/files")
            const form = new FormData()
            form.append("resource-usertoken",funcs.get_uploadtoken())
            form.append("folderdomain","eduardoaf.com")

            fetch(url, {
                method: 'post',
                body: form,
            })
            .then(response => response.json())
            .then(response => {
                console.log("load.reponse",response)

                if(funcs.is_error(response)) {
                    return Swal.fire({
                        icon: 'warning',
                        title: CONST.TITLE_ERROR,
                        html: response.error,
                    })
                }
                self.rows = response.data.files
            })
            .catch(error => {
                console.log("CATCH ERROR list",error)
                Swal.fire({
                    icon: 'error',
                    title: CONST.TITLE_SERVERROR,
                    html: error.toString(),
                })
            })
            .finally(() => {
                self.issending = false;
                self.btnsend = CONST.BTN_INISTATE_REFRESH
            })
        },//load

        remove(resurl){
            if(confirm(CONST.CONFIRM)){
                const self = this
                self.issending = true
                self.btnsend = CONST.BTN_IN_PROGRESS

                const url = funcs.get_uploadomain().concat("/remove")
                const form = new FormData()
                form.append("resource-usertoken",funcs.get_uploadtoken())
                form.append("urls[]",resurl)

                fetch(url, {
                    method: 'post',
                    body: form
                })
                .then(response => response.json())
                .then(response => {
                    console.log("remove.response",response)

                    if(funcs.is_error(response)) {
                        return Swal.fire({
                            icon: 'warning',
                            title: CONST.TITLE_ERROR,
                            html: response.error,
                        })
                    }

                    self.load()

                    self.$toast.info(`Resource removed: ${response.data.urls[0]}`)
                })
                .catch(error => {
                    console.log("CATCH ERROR remove",error)
                    Swal.fire({
                        icon: 'error',
                        title: CONST.TITLE_SERVERROR,
                        html: error.toString(),
                    })
                })
                .finally(() => {
                    self.issending = false;
                    self.btnsend = CONST.BTN_INISTATE_REFRESH
                })
            }
        },

        copycb(i){
            const el = document.getElementById("rawlink-"+i)
            if(el) {
                const url = el.innerText
                funcs.to_clipboard(url)
                this.$toast.success(`link in clipboard!!`)
            }
        },

        upload_byurl(){
            const self = this

            if(!self.upload.urlupload.trim()){
                self.upload.urlupload = ""
                self.$toast.warning("You must fill input with a valid url")
                self.$refs.urlupload.focus();
                return
            }

            self.issending = true
            self.btnsend2 = CONST.BTN_IN_PROGRESS

            const url = funcs.get_uploadomain().concat("/upload/by-url")
            const form = new FormData()
            form.append("resource-usertoken",funcs.get_uploadtoken())
            form.append("folderdomain","eduardoaf.com")
            form.append("files",self.upload.urlupload)

            fetch(url, {
                method: 'post',
                body: form
            })
            .then(response => response.json())
            .then(response => {

                console.log("reponse",response)

                if(funcs.is_error(response)) {
                    return Swal.fire({
                        icon: 'warning',
                        title: CONST.TITLE_ERROR,
                        html: response.error,
                    })
                }

                self.load()
                self.upload.urlupload = ""
                self.$toast.success(`Files "${url}" uploaded`)
                self.$refs.urlupload.focus();
            })
            .catch(error => {
                console.log("CATCH ERROR upload",error)
                Swal.fire({
                    icon: 'error',
                    title: CONST.TITLE_SERVERROR,
                    html: error.toString(),
                })
            })
            .finally(() => {
                self.issending = false;
                self.btnsend2 = CONST.BTN_INISTATE_UPLOAD
            })
        },//upload_byurl
    }
}
</script>
