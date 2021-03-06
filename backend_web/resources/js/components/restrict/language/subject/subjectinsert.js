//subjectinsert.js
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

            subject: {
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

    methods:{
        save_slug(){
            db.save("last-slug",this.subject.slug)
        },

        load_lastupload(){
            const lastupload = db.select("last-upload")
            if(lastupload) {
                this.subject.url_img1 = lastupload
                this.subject.url_img2 = lastupload
            }
        },

        insert(){
            const self = this
            self.issending = true
            self.btnsend = CONST.BTN_IN_PROGRESS
            const url = `/api/language/subject`

            fetch(url, {
                method: 'post',
                headers:{
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({_token:csrftoken, _action:"subject.insert",...this.subject})
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

                self.$toast.success(`Subject saved. Nº ${response.data.id} | ${self.subject.title}`)
                window.location = "/adm/language/subject/update/"+response.data.id

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

        onchange_title(){
            this.subject.slug = funcs.get_slug(this.subject.title)
            this.subject.url_final = "/idiomas/".concat(this.subject.slug)
            this.save_slug()
        },

        handleSubmit: function(e) {
            e.preventDefault()
            this.insert()
        }//handleSubmit(e)
    },

    async mounted() {
        this.sources = await apifetch.get_sources()
    }
}
