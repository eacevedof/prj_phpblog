<template>
    <div class="card">
        <div class="card-body">
            <form @submit="handleSubmit">
                <div class="row card-header res-formheader">
                    <div class="col-md-7 col-sm-6 pt-2">
                        <h1>Update post</h1>
                    </div>
                    <div class="col-md-2">
                        <a v-if="post.id_status==0" class="btn btn-dark res-btnformheader" :disabled="issending" target="_blank" :href="'/blog/draft/'+post.id">
                            Draft &nbsp;<i class="fa fa-window-maximize" aria-hidden="true"></i>
                        </a>
                        <a v-if="post.id_status!=0" class="btn btn-info res-btnformheader" :disabled="issending" target="_blank" :href="post.url_final">
                            View &nbsp;
                            <i class="fa fa-window-maximize" aria-hidden="true"></i>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary res-btnformheader" :disabled="issending">
                            {{btnsend}}
                            <img v-if="issending" src="/assets/images/loading-bw.gif" width="25" height="25"/>
                        </button>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger res-btnformheader" :disabled="issending" v-on:click="remove(post.id)">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                            <img v-if="issending" src="/assets/images/loading-bw.gif" width="25" height="25"/>
                        </button>
                    </div>
                </div>
                <div v-if="!issending"  class="form-row">
                    <div class="form-group col-md-2">
                        <label>Id</label>
                        <span class="form-control">{{ post.id }}</span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="sel-id_type">Category</label>
                        <select id="sel-id_type" v-model="post.id_type" class="form-control">
                            <option disabled value="">Choose one</option>
                            <option v-for="category in categories" :value="category.id">{{category.description}}</option>
                        </select>
                    </div>
                    <div class="form-check col-md-4" style="padding-top:35px">
                        <input type="checkbox" id="chk-is_page" v-model="post.is_page" value="1" />
                        <label for="chk-is_page" class="form-check-label"><b>Is single page</b></label>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="txt-title">title</label>
                        <input type="text" id="txt-title" v-model="post.title" maxlength="350" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="txt-slug">Slug</label>
                        <input type="text" id="txt-slug" v-model="post.slug" maxlength="150" class="form-control"/>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="txt-url_final">Permalink</label>
                        <input type="text" id="txt-url_final" v-model="post.url_final" maxlength="300" class="form-control"/>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="txt-subtitle">subtitle</label>
                        <input type="text" id="txt-subtitle" v-model="post.subtitle" maxlength="250" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="txa-content">content</label>
                        <textarea id="txa-content" v-model="post.content" rows="15" cols="10" class="form-control"></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="txa-excerpt">excerpt</label>
                        <textarea id="txa-excerpt" v-model="post.excerpt" maxlength="1000" rows="3" cols="5" class="form-control"></textarea>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="txt-url_img1">Url img1</label>
                        <input type="text" id="txt-url_img1" v-model="post.url_img1" maxlength="300" class="form-control"/>
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
                    <div class="form-group col-md-3">
                        <label for="dat-publish_date">Published</label>
                        <input type="date" id="dat-publish_date" v-model="post.publish_date" class="form-control" />
                    </div>
                    <div class="form-group col-md-3">
                        <label for="dat-last_update">Last update</label>
                        <input type="date" id="dat-last_update" v-model="post.last_update" class="form-control" />
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
                        <a v-if="post.id_status==0" class="btn btn-dark mt-4" :disabled="issending" target="_blank" :href="'/blog/draft/'+post.id">
                            Draft &nbsp;
                            <i class="fa fa-window-maximize" aria-hidden="true"></i>
                        </a>
                        <a v-if="post.id_status!=0" class="btn btn-info mt-4" :disabled="issending" target="_blank" :href="post.url_final">
                            View &nbsp;
                            <i class="fa fa-window-maximize" aria-hidden="true"></i>
                        </a>
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

    methods:{
        get_row(id){
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
                this.post.last_update = funcs.get_date(this.post.publish_date)
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

                Swal.fire({
                    icon: 'success',
                    title: `Post: "${self.post.description}" (${self.post.id}) <br/> changed`,
                    html: `<b>&#128578;</b>`,
                })

                this.get_row(self.post.id)

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

        handleSubmit: function(e) {
            e.preventDefault()
            this.update()
        }//handleSubmit(e)
    },

    async mounted() {
        const id = funcs.get_lastparam()
        this.get_row(id)
        this.categories = await apifetch.get_categories()
    }
}
</script>
