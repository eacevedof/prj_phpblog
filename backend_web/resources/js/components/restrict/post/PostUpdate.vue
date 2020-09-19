<template>
<div class="card">
    <div class="card-body">
        <form @submit="handleSubmit">
            <div class="row card-header res-formheader"
               v-bind:class="{ 'res-cardtitle': post.id_status == 1 }"
            >
                <div class="col-md-6 col-sm-6 pt-2">
                    <h1>Update post</h1>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-secondary mt-2 text-white" :disabled="issending" v-on:click="load_register(post.id)">
                        <i class="fa fa-refresh" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="col-md-2">
                    <a v-if="post.id_status==0" class="btn btn-dark mt-2" :disabled="issending" target="_blank" :href="'/blog/draft/'+post.id">
                        Draft &nbsp;<i class="fa fa-window-maximize" aria-hidden="true"></i>
                    </a>
                    <a v-if="post.id_status!=0" class="btn btn-info text-white mt-2" :disabled="issending" target="_blank" :href="post.url_final">
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
                    <button type="button" class="btn btn-danger res-btnformheader" :disabled="issending" v-on:click="remove(post.id)">
                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label>Id</label>
                    <span class="form-control">{{ post.id }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="sel-id_type">Category *</label>
                    <select id="sel-id_type" v-model="post.id_type" class="form-control" required>
                        <option disabled value="">Choose one</option>
                        <option v-for="category in categories" :value="category.id">{{category.description}}</option>
                    </select>
                </div>
                <div class="form-check col-md-4" style="padding-top:35px">
                    <input type="checkbox" id="chk-is_page" v-model="post.is_page" value="1" />
                    <label for="chk-is_page" class="form-check-label"><b>Is single page</b></label>
                </div>
                <div class="form-group col-md-12">
                    <label for="txt-title">Title *</label>
                    <input type="text" id="txt-title" v-model="post.title" @change="onchange_title()" maxlength="350" class="form-control" required>
                </div>
                <div class="form-group col-md-12">
                    <label for="txa-content">content</label>
                    <textarea id="txa-content" v-model="post.content" rows="20" cols="10" class="form-control"></textarea>
                </div>
                <div class="form-group col-md-12">
                    <label for="txa-excerpt">excerpt</label>
                    <textarea id="txa-excerpt" v-model="post.excerpt" maxlength="1000" rows="3" cols="5" class="form-control"></textarea>
                </div>
                <div class="form-group col-md-12">
                    <label for="txt-slug">Slug *</label>
                    <input type="text" id="txt-slug" v-model="post.slug" maxlength="150" class="form-control" required/>
                </div>
                <div class="form-group col-md-12">
                    <label for="txt-url_final">Permalink *</label>
                    <input type="text" id="txt-url_final" v-model="post.url_final" maxlength="300" class="form-control" required/>
                </div>
                <div class="form-group col-md-12">
                    <label for="txt-subtitle">subtitle</label>
                    <input type="text" id="txt-subtitle" v-model="post.subtitle" maxlength="250" class="form-control">
                </div>
                <div class="form-group col-md-12">
                    <label for="txt-url_img1">Url img1 (list)*</label>
                    <input type="text" id="txt-url_img1" v-model="post.url_img1" maxlength="300" class="form-control" required/>
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
                <div v-if="post.url_img1" class="col-6">
                    <a :href="post.url_img1" target="_blank">
                        <img :src="post.url_img1" class="img-thumbnail" :alt="post.url_img1" />
                    </a>
                </div>
                <div class="form-group col-md-6">
                    <label for="txt-url_img2">Url img2 (detail)</label>
                    <input type="text" id="txt-url_img2" v-model="post.url_img2" maxlength="300" class="form-control"/>
                </div>
                <div class="form-group col-md-6">
                    <label for="txt-url_img3">Url img3</label>
                    <input type="text" id="txt-url_img3" v-model="post.url_img3" maxlength="300" class="form-control">
                </div>

                <div class="form-group col-md-3">
                    <label for="sel-id_user">User</label>
                    <select id="sel-id_user" v-model="post.id_user" class="form-control">
                        <option value="1">1</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="sel-id_status">Status</label>
                    <select id="sel-id_status" v-model="post.id_status" class="form-control">
                        <option value="0">Disabled</option>
                        <option value="1">Published</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="dat-publish_date">Published</label>
                    <input type="date" id="dat-publish_date" v-model="post.publish_date" class="form-control" readonly />
                </div>
                <div class="form-group col-md-3">
                    <label for="dat-last_update">Last update</label>
                    <input type="date" id="dat-last_update" v-model="post.last_update" class="form-control" readonly />
                </div>
                <div class="form-group col-md-6">
                    <label for="txt-seo_title">SEO Title</label>
                    <input type="text" id="txt-seo_title" v-model="post.seo_title" maxlength="65" class="form-control"/>
                </div>
                <div class="form-group col-md-6">
                    <label for="txt-seo_description">SEO Description</label>
                    <input type="text" id="txt-seo_description" v-model="post.seo_description" maxlength="160" class="form-control"/>
                </div>
                <div class="form-group col-md-4">
                    <label for="txt-description">Notes</label>
                    <input type="text" id="txt-description" v-model="post.description" maxlength="250" class="form-control"/>
                </div>
                <div class="form-group col-md-2">
                    <label for="num-order_by">Position</label>
                    <input type="number" id="num-order_by" v-model="post.order_by" value="100" class="form-control"/>
                </div>
                <div class="form-group col-md-4">
                    <button class="btn btn-primary res-btncol" :disabled="issending">
                        {{btnsend}}
                        <img v-if="issending" src="/assets/images/loading-bw.gif" width="25" height="25"/>
                    </button>
                    <a v-if="post.id_status==0" class="btn btn-dark mt-4 text-white" :disabled="issending" target="_blank" :href="'/blog/draft/'+post.id">
                        Draft &nbsp;
                        <i class="fa fa-window-maximize" aria-hidden="true"></i>
                    </a>
                    <a v-if="post.id_status!=0" class="btn btn-info mt-4 text-white" :disabled="issending" target="_blank" :href="post.url_final">
                        View &nbsp;
                        <i class="fa fa-window-maximize" aria-hidden="true"></i>
                    </a>
                    <button type="button" class="btn btn-secondary mt-4 text-white" :disabled="issending" v-on:click="load_register(post.id)">
                        <i class="fa fa-refresh" aria-hidden="true"></i>
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
<script>
import funcs from "../../../app/funcs"
import CONST from "../../../app/constants"
import apifetch from "../../../app/apifetch"
import db from "../../../app/db"
const csrftoken = funcs.get_csrftoken()

export default {
    data(){
        return {
            btnsend: CONST.BTN_INISTATE,
            issending: false,
            categories: [],
            post: {
                id: -1,
                description: "",
                id_type: 0,
                is_page: [],
                slug: "",
                url_final: "",
                title: "",
                subtitle: "",
                content: "",
                excerpt: "",
                url_img1: "",
                url_img2: "",
                url_img3: "",
                id_user: 1,
                id_status: 0,
                publish_date: "",
                last_update: "",
                seo_title: "",
                seo_description: "",
                order_by:100,
            }
        }
    },

    async mounted() {
        const id = funcs.get_lastparam()
        this.categories = await apifetch.get_categories()
        this.load_register(id)
    },

    methods:{
        load_lastupload(){
            const lastupload = db.select("last-upload")
            if(lastupload) {
                this.post.url_img1 = lastupload
                this.post.url_img2 = lastupload
            }
        },

        load_register(id){
            const self = this
            self.issending = true
            self.btnsend = CONST.BTN_IN_PROGRESS

            const url = `/api/post/${id}`
            fetch(url, {
                method: 'get',
            })
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

                this.post = response.data
                this.post.publish_date = funcs.get_date(this.post.publish_date)
                this.post.last_update = funcs.get_date(this.post.last_update)
            })
            .catch(error => {
                console.log("CATCH ERROR get_row",error)
                Swal.fire({
                    icon: 'error',
                    title: CONST.TITLE_SERVERROR,
                    text: error.toString()
                })
            })
            .finally(() => {
                self.issending = false;
                self.btnsend = CONST.BTN_INISTATE
            })
        },//get_row

        update(){
            const self = this
            self.issending = true
            self.btnsend = CONST.BTN_IN_PROGRESS
            const url = `/api/post/${this.post.id}`

            fetch(url, {
                method: 'put',
                headers:{
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({_token:csrftoken,_action:"post.update", ...this.post})
            })
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
                this.$toast.success(`Post saved. Nº ${self.post.id} | ${self.post.title}`)
                this.load_register(self.post.id)

            })
            .catch(error => {
                console.log("CATCH ERROR update",error)
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
        },//update

        remove(id){
            if(confirm(CONST.CONFIRM)){
                const self = this
                self.issending = true
                self.btnsend = CONST.BTN_IN_PROGRESS
                const url = `/api/post/${id}`
                fetch(url, {
                    method: 'delete',
                    headers:{
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({_token:csrftoken,_action:"post.delete"})
                })
                .then(response => response.json())
                .then(response => {
                    console.log("remove.response",response)

                    if(funcs.is_error(response)) {
                        return Swal.fire({
                            icon: 'warning',
                            title: CONST.TITLE_ERROR,
                            text: response.error,
                        })
                    }

                    Swal.fire({
                        icon: 'success',
                        title: `Post: ${id} has been removed`,
                        html: `<b>&#128578;</b>`,
                    })

                    document.location = "/adm/posts"
                })
                .catch(error => {
                    console.log("CATCH ERROR remove",error)
                    Swal.fire({
                        icon: 'error',
                        title: CONST.TITLE_SERVERROR,
                        text: error.toString(),
                    })
                })
                .finally(() => {
                    self.issending = false;
                    self.btnsend = CONST.BTN_INISTATE_REFRESH
                })
            }
        },

        get_idtype_slug(){
            const idtype = this.post.id_type
            const category = this.categories.filter(obj => obj.id == idtype ).map(obj => obj.slug)
            return category
        },

        get_idtype_urlfinal(){
            const idtype = this.post.id_type
            const url = this.categories.filter(obj => obj.id == idtype ).map(obj => obj.url_final)
            return url
        },

        onchange_title(){
            this.post.slug = funcs.get_slug(this.post.title).concat(`-${this.post.id}`)
            const url = this.get_idtype_urlfinal()
            //alert(url)
            //this.post.url_final = url.concat("/").concat(this.post.slug)
            this.post.url_final = `${url}/${this.post.slug}`
        },

        on_btnalbum(){
            db.save("last-slug",this.post.slug)
            window.open("/adm/upload", "_blank").focus()
        },

        handleSubmit: function(e) {
            e.preventDefault()
            this.update()
        }//handleSubmit(e)
    },

}
</script>
