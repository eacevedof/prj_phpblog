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
