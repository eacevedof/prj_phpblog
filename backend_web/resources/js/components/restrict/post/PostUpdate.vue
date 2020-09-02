<template>
    <div class="card">
        <div class="card-header">
            <h1>New article</h1>
        </div>
        <div class="card-body">
            <form @submit="handleSubmit">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="txt-description">Hidden description</label>
                        <input type="text" id="txt-description" v-model="post.description" maxlength="250" class="form-control"/>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="sel-id_type">Category</label>
                        <select id="sel-id_type" v-model="post.id_type" class="form-control">
                            <option disabled value="">Choose one</option>
                            <option value="1">Generic</option>
                            <option value="2">Single page</option>
                            <option value="3">Blog Php</option>
                            <option value="4">Blog Js</option>
                            <option value="5">Blog SQL</option>
                            <option value="6">Blog Docker</option>
                        </select>
                    </div>
                    <div class="form-check col-md-4" style="padding-top:35px">
                        <input type="checkbox" id="chk-is_page" v-model="post.is_page" value="1" />
                        <label for="chk-is_page" class="form-check-label"><b>Is single page</b></label>
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
                        <label for="txt-title">title</label>
                        <input type="text" id="txt-title" v-model="post.title" maxlength="350" class="form-control">
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
                    <div class="form-group col-md-2">
                        <label for="num-order_by">Position</label>
                        <input type="number" id="num-order_by" v-model="post.order_by" value="100" class="form-control"/>
                    </div>
                    <div class="form-group col-md-4">
                        <button class="btn btn-primary" :disabled="issending" style="margin-top:28px;" >
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
import custom from "../../../custom"
let csrftoken = custom.get_csrftoken()
//console.log(csrftoken,"csrftoken")
const BTN_INISTATE = "Guardar"
const BTN_IN_PROGRESS = "Procesando..."

export default {
    data(){
        return {
            btnsend: BTN_INISTATE,
            issending: false,
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
        insert(){
            const self = this
            self.issending = true
            self.btnsend = BTN_IN_PROGRESS
            const url = `/api/post`
            const data = new FormData();

            data.append("_token",csrftoken)
            data.append("action","post.insert")
            data.append("description",this.post.description)
            data.append("id_type",this.post.id_type)
            data.append("is_page",this.post.is_page[0] || 0)
            data.append("slug",this.post.slug)
            data.append("url_final",this.post.url_final)
            data.append("title",this.post.title)
            data.append("subtitle",this.post.subtitle)
            data.append("content",this.post.content)
            data.append("excerpt",this.post.excerpt)
            data.append("url_img1",this.post.url_img1)
            data.append("url_img2",this.post.url_img2)
            data.append("url_img3",this.post.url_img3)
            data.append("id_user",this.post.id_user)
            data.append("id_status",this.post.id_status)
            data.append("publish_date",this.post.publish_date)
            data.append("last_update",this.post.last_update)
            data.append("seo_title",this.post.seo_title)
            data.append("seo_description",this.post.seo_description)
            data.append("order_by",this.post.order_by)

            fetch(url, {
                method: 'post',
                body: data,
                //si voy a enviar un json
                //headers:{'Content-Type': 'application/json'},
            })
            //.then(response => console.log(response,"RESPONSE"))
            .then(response => response.json())
            .then(response => {

                console.log("reponse",response)

                if(typeof response.error !== "undefined") {
                    return Swal.fire({
                        icon: 'warning',
                        title: 'Esta acción no se ha podido completar',
                        text: response.error,
                    })
                }

                Swal.fire({
                    icon: 'success',
                    title: `Post: "${self.post.description}" <br/> creado`,
                    html: `<b>&#128578;</b>`,
                })

            })
            .catch(error => {
                console.log("CATCH ERROR insert",error)
                Swal.fire({
                    icon: 'error',
                    title: 'Vaya! Ha ocurrido un error',
                    text: error.toString(),
                })
            })
            .finally(() => {
                self.issending = false;
                self.btnsend = BTN_INISTATE
            })
        },//insert

        handleSubmit: function(e) {
            e.preventDefault()
            this.insert()
        }//handleSubmit(e)
    },

    mounted() {
        console.log('Post Insert mounted.')
    }
}
</script>
