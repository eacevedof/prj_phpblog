//postinsert.js
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
        save_slug(){
            db.save("last-slug",this.post.slug)
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

                    self.$toast.success(`Post saved. Nº ${response.data.id} | ${self.post.title}`)
                    //self.save_slug()
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
            this.save_slug()
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
