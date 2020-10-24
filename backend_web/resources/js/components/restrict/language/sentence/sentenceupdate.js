//sentenceupdate.js
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
            sources: [],

            sentence: {
                id: -1,
                description: "",
                slug: "",
                url_final: "",
                url_img1: "",
                url_img2: "",
                title: "",
                excerpt: "",
                url_resource: "",
                id_type_source: "",
                id_status: 0,
                seo_title: "",
                seo_description: "",
            }
        }
    },

    async mounted() {
        const id = funcs.get_lastparam()
        this.sources = await apifetch.get_sources()
        this.load_register(id)
    },

    methods:{
        load_lastupload(){
            const lastupload = db.select("last-upload")
            if(lastupload) {
                this.sentence.url_img1 = lastupload
                this.sentence.url_img2 = lastupload
            }
        },

        load_register(id){
            const self = this
            self.issending = true
            self.btnsend = CONST.BTN_IN_PROGRESS

            const url = `/api/language/sentence/${id}`
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

                this.sentence = response.data
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
            const url = `/api/language/sentence/${this.sentence.id}`

            fetch(url, {
                method: 'put',
                headers:{
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({_token:csrftoken,_action:"sentence.update", ...this.sentence})
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
                this.$toast.success(`Sentence saved. Nº ${self.sentence.id} | ${self.sentence.title}`)
                this.load_register(self.sentence.id)

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
                const url = `/api/language/sentence/${id}`
                fetch(url, {
                    method: 'delete',
                    headers:{
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({_token:csrftoken,_action:"sentence.delete"})
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
                        title: `Sentence: ${id} has been removed`,
                        html: `<b>&#128578;</b>`,
                    })

                    document.location = "/adm/language/sentences"
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

        onchange_title(){
            this.sentence.slug = funcs.get_slug(this.sentence.title).concat(`-${this.sentence.id}`)
            this.sentence.url_final = `/idiomas/${this.sentence.slug}`
        },

        on_btnalbum(){
            db.save("last-slug",this.sentence.slug)
            window.open("/adm/upload", "_blank").focus()
        },

        handleSubmit: function(e) {
            e.preventDefault()
            this.update()
        },//handleSubmit(e)
    },
}
