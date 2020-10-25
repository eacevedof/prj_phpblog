//sentenceupdate.js
import funcs from "../../../../app/funcs"
import CONST from "../../../../app/constants"
import apifetch from "../../../../app/apifetch"
import db from "../../../../app/db"
const csrftoken = funcs.get_csrftoken()
const idsubject = funcs.get_urlpiece(4)

export default {
    data(){
        return {
            btnsend: CONST.BTN_INISTATE,
            issending: false,

            contexts: [],
            languages: [],
            types: [],

            sentence: {
                id: "",
                description: "",
                id_subject: "",
                id_context: "",
                translatable: "",
                id_language: "",
                is_notificable: "",
                id_type: "",
                id_status: "",
            }
        }
    },

    async mounted() {
        const id = funcs.get_lastparam()
        this.contexts = await apifetch.get_contexts()
        this.languages = await apifetch.get_languages()
        this.types = await apifetch.get_types()
        this.load_register(id)
    },

    methods:{
        redirect(idsentence) {
            if(!idsubject) window.location = `/adm/language/sentence/update/${idsentence}`
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
                this.$toast.success(`Sentence saved. Nº ${self.sentence.id} | ${self.sentence.description}`)
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
        },//remove

        handleSubmit: function(e) {
            e.preventDefault()
            this.update()
        },//handleSubmit(e)
    },
}
