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
                    <textarea id="txa-content" v-model="upload.content" rows="25" cols="10" class="form-control"></textarea>
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
<script>
import funcs from "../../../app/funcs"
import CONST from "../../../app/constants"

export default {
    data(){
        return {
            btnsend: CONST.BTN_INISTATE,
            issending: false,

            upload: {
                content: "",
                url_img1: "",
                url_img2: "",
                url_img3: "",
            }
        }
    },

    methods:{
        on_change(){
            alert("X")
        },
        insert(){
            const self = this
            self.issending = true
            self.btnsend = CONST.BTN_IN_PROGRESS
            const url = `/api/post`
            const form = new FormData()

            fetch(url, {
                method: 'post',
                body: form
            })
            //.then(response => console.log(response,"RESPONSE"))
            .then(response => response.json())
            .then(response => {

                console.log("reponse",response)

                if(funcs.is_error(response)) {
                    return Swal.fire({
                        icon: 'warning',
                        title: CONST.TITLE_ERROR,
                        text: response.error,
                    })
                }

                Swal.fire({
                    icon: 'success',
                    title: `Post: "${self.upload.url_final}" <br/> creado`,
                    html: `<b>&#128578;</b>`,
                })

                window.location = "/adm/post/update/"+response.data.id
            })
            .catch(error => {
                console.log("CATCH ERROR insert",error)
                Swal.fire({
                    icon: 'error',
                    title: CONST.TITLE_SERVERROR,
                    text: error.toString(),
                })
            })
            .finally(() => {
                self.issending = false;
                self.btnsend = CONST.BTN_INISTATE
            })
        },//insert

        get_idtype_slug(){
            const idtype = this.upload.id_type
            const category = this.categories.filter(obj => obj.id == idtype ).map(obj => obj.slug)
            return category
        },

        onchange_title(){
            this.upload.slug = funcs.get_slug(this.upload.title)
            const catslug = this.get_idtype_slug()
            this.upload.url_final = "/blog/".concat(catslug).concat("/").concat(this.upload.slug)
        },

        handleSubmit: function(e) {
            e.preventDefault()
            this.insert()
        }//handleSubmit(e)
    },

    async mounted() {
        this.categories = await apifetch.get_categories()
        //funcs.pr(this.categories)
    }
}
</script>
