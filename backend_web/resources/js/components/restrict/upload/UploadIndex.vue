<template>
<div class="card">
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
                            <img :src="url" class="container-fluid"/>
                            <small>{{url}}</small>
                        </p>
                    </div>
                    <div class="card-footer text-muted">
                        <a class="btn btn-info" target="_blank" :href="url">
                            <i class="fa fa-window-maximize" aria-hidden="true"></i>
                        </a>
                        <button class="btn btn-danger" :disabled="issending"  v-on:click="remove(url)">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import funcs from "../../../app/funcs"
import CONST from "../../../app/constants"

const csrftoken = funcs.get_csrftoken()

export default {
    data(){
        return {
            issending: false,
            btnsend: CONST.BTN_INISTATE_REFRESH,
            columns: ["id","title","url_final","description"],
            rows: [],
        }
    },

    mounted() {
        this.load()
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

                    Swal.fire({
                        icon: 'success',
                        title: `Resource removed`,
                        html: `<a href="${response.data.urls[0]}" class="link-danger" target="_blank">
                                 <small>${response.data.urls[0]}</small>
                               </a>`,
                    })

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
    }
}
</script>
