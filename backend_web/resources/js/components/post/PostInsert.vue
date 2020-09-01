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
                        <input type="text" id="txt-description" v-model="form.description" maxlength="250" class="form-control"/>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="sel-id_type">Category</label>
                        <select id="sel-id_type" v-model="form.id_type" class="form-control">
                            <option value="">Choose one</option>
                            <option value="single-page">Single page</option>
                            <option value="blog-php">Php</option>
                            <option value="blog-js">Js</option>
                            <option value="blog-docker">Docker</option>
                        </select>
                    </div>
                    <div class="form-check col-md-4" style="padding-top:35px">
                        <input type="checkbox" id="chk-is_page" v-model="form.is_page" value="1" />
                        <label for="chk-is_page" class="form-check-label"><b>Is single page</b></label>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="txt-slug">Slug</label>
                        <input type="text" id="txt-slug" v-model="form.slug" maxlength="150" class="form-control"/>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="txt-url_final">Permalink</label>
                        <input type="text" id="txt-url_final" v-model="form.url_final" maxlength="300" class="form-control"/>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="txt-title">title</label>
                        <input type="text" id="txt-title" v-model="form.title" maxlength="350" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="txt-subtitle">subtitle</label>
                        <input type="text" id="txt-subtitle" v-model="form.subtitle" maxlength="250" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="txa-content">content</label>
                        <textarea id="txa-content" v-model="form.content" rows="15" cols="10" class="form-control"></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="txa-excerpt">excerpt</label>
                        <textarea id="txa-excerpt" v-model="form.excerpt" maxlength="1000" rows="3" cols="5" class="form-control"></textarea>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="txt-url_img1">Url img1</label>
                        <input type="text" id="txt-url_img1" v-model="form.url_img1" maxlength="300" class="form-control"/>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txt-url_img2">Url img2</label>
                        <input type="text" id="txt-url_img2" v-model="form.url_img2" maxlength="300" class="form-control"/>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txt-url_img3">Url img3</label>
                        <input type="text" id="txt-url_img3" v-model="form.url_img3" maxlength="300" class="form-control">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="sel-id_user">User</label>
                        <select id="sel-id_user" v-model="form.id_user" class="form-control">
                            <option value="1">1</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="sel-id_status">Status</label>
                        <select id="sel-id_status" v-model="form.id_status" class="form-control">
                            <option value="0">Disabled</option>
                            <option value="1">Published</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="dat-publish_date">Published</label>
                        <input type="date" id="dat-publish_date" v-model="form.publish_date" class="form-control" />
                    </div>
                    <div class="form-group col-md-3">
                        <label for="dat-last_update">Last update</label>
                        <input type="date" id="dat-last_update" v-model="form.last_update" class="form-control" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txt-seo_title">SEO Title</label>
                        <input type="text" id="txt-seo_title" v-model="form.seo_title" maxlength="65" class="form-control"/>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txt-seo_description">SEO Description</label>
                        <input type="text" id="txt-seo_description" v-model="form.seo_description" maxlength="160" class="form-control"/>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="num-order_by">Position</label>
                        <input type="number" id="num-order_by" v-model="form.order_by" value="100" class="form-control"/>
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
let csrftoken = get_csrftoken()

console.log(csrftoken,"csrftoken")
const BTN_INISTATE = "Guardar"
const BTN_IN_PROGRESS = "Procesando..."
const BTN_CONFIRM = "Confirmar"

export default {
    data(){
        return {
            btnsend: BTN_INISTATE,
            issending: false,
            form: {
                description: "",
                id_type: 0,
                is_page: 0,
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
            const url = `/adm/post/insert`
            const data = new FormData();
            data.append("_token",csrftoken)
            data.append("action","post.insert")
            data.append("description",this.form.description)
            data.append("id_type",this.form.id_type)
            data.append("is_page",this.form.is_page)
            data.append("slug",this.form.slug)
            data.append("url_final",this.form.url_final)
            data.append("title",this.form.title)
            data.append("subtitle",this.form.subtitle)
            data.append("content",this.form.content)
            data.append("excerpt",this.form.excerpt)
            data.append("url_img1",this.form.url_img1)
            data.append("url_img2",this.form.url_img2)
            data.append("url_img3",this.form.url_img3)
            data.append("id_user",this.form.id_user)
            data.append("publish_date",this.form.publish_date)
            data.append("last_update",this.form.last_update)
            data.append("seo_title",this.form.seo_title)
            data.append("seo_description",this.form.seo_description)
            data.append("order_by",this.form.order_by)


            fetch(url, {
                method: 'post',
                body: data
            })
            .then(response => response.json())
            .then(response => {
                self.issending = false
                self.btnsend = BTN_INISTATE

                console.log("reponse",response)

                if(response.title == "success") {
                    Swal.fire({
                        icon: 'success',
                        title: `${self.description} <br/> Datos guardados`,
                        html: ``,
                    })
                    self.showconfirm = true;
                    self.btnsend = BTN_CONFIRM
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Esta acción no se ha podido completar',
                        text: response.description,
                    })
                }
            })
            .catch(error => {
                self.issending = false
                self.btnsend = BTN_INISTATE
                console.log("CATCH ERROR insert",error)
                Swal.fire({
                    icon: 'error',
                    title: 'Vaya! Ha ocurrido un error',
                    text: error.toString(),
                })
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
