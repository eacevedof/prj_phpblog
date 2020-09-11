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
        <div class="form-group col-md-10 mb-2">
            <input type="file" class="form-control" multiple
                ref="filesupload"
                @change="on_fileschange()"
            />
        </div>
        <div class="form-group col-md-2 mb-0">
            <button type="button" class="btn btn-dark"
                :disabled="issending || isoversized" v-on:click="on_upload()"
            >
                {{btnsend2}}
                <img v-if="issending" src="/assets/images/loading-bw.gif" width="25" height="25"/>
            </button>
        </div>
        <div class="d-flex m-0 mt-1 pl-3" style="flex-wrap: wrap;">
            <small class="badge bg-info text-white">max upload: {{maxuploadsize.toLocaleString("en")}}</small>
            <small v-if="filessize>0" class="badge bg-warning">selected: {{filessize.toLocaleString("en")}}</small>
            <small v-if="isoversized" class="badge bg-danger text-white">oversized: {{overbytes.toLocaleString("en")}}</small>
            <small v-for="(file, i) in upload.files" :key="i">{{i+1}} - {{file.name}} ({{ file.size.toLocaleString("en") }})&nbsp;&nbsp;</small>
        </div>
    </div>

<!-- card start -->
    <div class="card-body">
        <div class="row card-header res-formheader">
            <div class="col-md-6 mt-2">
                <h1>Uploaded files:</h1><small>({{rows.length}})</small>
            </div>
            <div class="col-md-3">
                <div class="form-group mt-3">
                    <select id="sel-folders" v-model="selfolder" class="form-control" required>
                        <option v-for="(folder, i) in folders" :value="folder" :key="i">{{folder}}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3 mt-3">
                <button class="btn btn-primary" :disabled="issending" v-on:click="load_rows()">
                    {{btnsend}}
                    <img v-if="issending" src="/assets/images/loading-bw.gif" width="25" height="25"/>
                </button>
            </div>
        </div>

<!-- cards -->
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
                        <button class="btn btn-danger" :disabled="issending"  v-on:click="remove_file(url)">
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
import apiupload from "../../../app/apiupload";

export default {

    data(){
        return {
            issending: false,
            btnsend: CONST.BTN_INISTATE_REFRESH,
            btnsend2: CONST.BTN_INISTATE_UPLOAD,

            selfolder: "eduardoaf.com",

            maxuploadsize: 0,
            isoversized: false,
            overbytes: 0,
            filessize: 0,

            folders: [],
            rows: [],

            upload:{
                urlupload: "",
                files: [],
            }
        }
    },

    async mounted() {
        console.log("upload.async mounted()")
        this.maxuploadsize = await apiupload.get_maxsize()
        this.maxuploadsize = parseInt(this.maxuploadsize)
        await this.load_folders()
        await this.load_rows()
        this.$refs.urlupload.focus();
    },

    methods: {
        async load_folders() {this.folders = await apiupload.get_folders() },

        async load_rows() {
            const self = this
            self.issending = true
            self.btnsend = CONST.BTN_IN_PROGRESS

            try{
                const r = await apiupload.get_files(self.selfolder)
                //funcs.pr(r,"load_rows")
                if(funcs.is_error(r)) {
                    return Swal.fire({
                        icon: 'warning',
                        title: CONST.TITLE_ERROR,
                        html: r.error,
                    })
                }
                self.rows = r
            }
            catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: CONST.TITLE_SERVERROR,
                    html: error.toString(),
                })
            }
            finally {
                self.issending = false;
                self.btnsend = CONST.BTN_INISTATE_REFRESH
            }
        },//load_rows

        async remove_file(urlfile){
            if(confirm(CONST.CONFIRM)) {
                const self = this
                self.issending = true
                self.btnsend = CONST.BTN_IN_PROGRESS

                try {
                    const r = await apiupload.remove_file(urlfile)
                    if (funcs.is_error(r)) {
                        return Swal.fire({
                            icon: 'warning',
                            title: CONST.TITLE_ERROR,
                            html: r.error,
                        })
                    }

                    self.$toast.info(`Resource removed: ${r[0]}`)
                    await self.load_rows()
                }
                catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: CONST.TITLE_SERVERROR,
                        html: error.toString(),
                    })
                }
                finally {
                    self.issending = false;
                    self.btnsend = CONST.BTN_INISTATE_REFRESH
                }
            }
        },//remove_file

        async upload_files(){
            const self = this

            if(self.upload.files.length==0)return

            const url = funcs.get_uploadomain().concat("/upload/multiple")
            const form = new FormData()
            form.append("resource-usertoken",funcs.get_uploadtoken())
            form.append("folderdomain",this.selfolder)

            for(const file of self.upload.files)
                form.append("files[]", file, file.name);

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
                    self.$toast.success(`Files uploaded (${response.data.url.length}): ${response.data.url.join(", ")}`)
                    if(response.data.warning.length>0)
                        self.$toast.warning(`Files not uploaded (${response.data.warning.length}): ${response.data.warning.join(", ")}`)
                    self.reset_filesupload()
                })
                .catch(error => {
                    console.log("CATCH ERROR upload_files",error)
                    Swal.fire({
                        icon: 'error',
                        title: CONST.TITLE_SERVERROR,
                        html: error.toString(),
                    })
                })
        },

        async on_upload(){
            this.upload_byurl()
            this.upload_files()
        },//on_upload

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
            form.append("folderdomain",this.selfolder)
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

                self.load_rows()
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

        on_fileschange(){
            this.upload.files = this.$refs.filesupload.files || []

            let size = 0
            for(const file of this.upload.files)
                size += file.size

            this.filessize = size
            this.isoversized = (size>=this.maxuploadsize)
            this.overbytes = (size - this.maxuploadsize)
        },

        reset_filesupload(){
            this.$refs.filesupload.value = ""
            this.upload.files = []
            this.filessize = 0
            this.isoversized = false
            this.overbytes = 0
        },
    }
}
</script>
