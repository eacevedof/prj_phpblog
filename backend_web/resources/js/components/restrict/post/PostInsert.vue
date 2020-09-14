<template>
    <div class="card">
        <div class="card-body">
            <form id="form-insert" @submit="handleSubmit">
                <div class="row card-header res-formheader">
                    <div class="col-md-9">
                        <h1>Insert post</h1>
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
                        <textarea id="txa-content" v-model="post.content" rows="25" cols="10" class="form-control"></textarea>
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
                        <label for="txt-url_img1">Url img1 *</label>
                        <input type="text" id="txt-url_img1" v-model="post.url_img1" maxlength="300" class="form-control" required/>
                        <a href="/adm/upload" class="btn btn-dark" ><i class="fa fa-clipboard" aria-hidden="true"></i> Upload</a>
                        <button type="button" class="btn btn-warning"
                                :disabled="issending"
                                v-on:click="load_lastupload()"
                        >
                            <i class="fa fa-clipboard" aria-hidden="true"></i> Get img
                            <img v-if="issending" src="/assets/images/loading-bw.gif" width="25" height="25"/>
                        </button>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txt-url_img2">Url img2</label>
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
<!--
                    <div class="form-group col-md-3">
                        <label for="dat-publish_date">Published</label>
                        <input type="date" id="dat-publish_date" v-model="post.publish_date" class="form-control" />
                    </div>
                    <div class="form-group col-md-3">
                        <label for="dat-last_update">Last update</label>
                        <input type="date" id="dat-last_update" v-model="post.last_update" class="form-control" />
                    </div>
-->
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
                    </div>
                </div>
            </form>
        </div>
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

    methods:{
        set_slug(){

        },

        load_lastupload(){
            const lastupload = db.select("last-upload")
            if(lastupload) {
                this.post.url_img1 = lastupload
                this.post.url_img2 = lastupload
            }
        },

        insert(){
            const self = this
            self.issending = true
            self.btnsend = CONST.BTN_IN_PROGRESS
            const url = `/api/post`

            fetch(url, {
                method: 'post',
                headers:{
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({_token:csrftoken, _action:"post.insert",...this.post})
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
                    title: `Post: "${self.post.url_final}" <br/> creado`,
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
            const idtype = this.post.id_type
            const category = this.categories.filter(obj => obj.id == idtype ).map(obj => obj.slug)
            return category
        },

        onchange_title(){
            this.post.slug = funcs.get_slug(this.post.title)
            const catslug = this.get_idtype_slug()
            this.post.url_final = "/blog/".concat(catslug).concat("/").concat(this.post.slug)
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
