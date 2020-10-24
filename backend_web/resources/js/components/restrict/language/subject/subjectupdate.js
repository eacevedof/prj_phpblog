//subjectupdate.js
import funcs from "../../../../app/funcs"
import CONST from "../../../../app/constants"
import apifetch from "../../../../app/apifetch"
import db from "../../../../app/db"
const csrftoken = funcs.get_csrftoken()

export default {
    data(){
        return {
            btnsend: CONST.BTN_INISTATE,
            issending: false,
            categories: [],
            subject: {
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
                this.subject.url_img1 = lastupload
                this.subject.url_img2 = lastupload
            }
        },

        load_register(id){
            const self = this
            self.issending = true
            self.btnsend = CONST.BTN_IN_PROGRESS

            const url = `/api/language/subject/${id}`
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

                    this.subject = response.data
                    this.subject.publish_date = funcs.get_date(this.subject.publish_date)
                    this.subject.last_update = funcs.get_date(this.subject.last_update)
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
            const url = `/api/language/subject/${this.subject.id}`

            fetch(url, {
                method: 'put',
                headers:{
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({_token:csrftoken,_action:"subject.update", ...this.subject})
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
                    this.$toast.success(`Subject saved. Nº ${self.subject.id} | ${self.subject.title}`)
                    this.load_register(self.subject.id)

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
                const url = `/api/language/subject/${id}`
                fetch(url, {
                    method: 'delete',
                    headers:{
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({_token:csrftoken,_action:"subject.delete"})
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
                            title: `Subject: ${id} has been removed`,
                            html: `<b>&#128578;</b>`,
                        })

                        document.location = "/adm/subjects"
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
            const idtype = this.subject.id_type
            const category = this.categories.filter(obj => obj.id == idtype ).map(obj => obj.slug)
            return category
        },

        get_idtype_urlfinal(){
            const idtype = this.subject.id_type
            const url = this.categories.filter(obj => obj.id == idtype ).map(obj => obj.url_final)
            return url
        },

        onchange_title(){
            this.subject.slug = funcs.get_slug(this.subject.title).concat(`-${this.subject.id}`)
            const url = this.get_idtype_urlfinal()
            //alert(url)
            //this.subject.url_final = url.concat("/").concat(this.subject.slug)
            this.subject.url_final = `${url}/${this.subject.slug}`
        },

        on_btnalbum(){
            db.save("last-slug",this.subject.slug)
            window.open("/adm/upload", "_blank").focus()
        },

        handleSubmit: function(e) {
            e.preventDefault()
            this.update()
        }//handleSubmit(e)
    },
}