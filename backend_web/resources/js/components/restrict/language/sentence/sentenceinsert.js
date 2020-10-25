//sentenceinsert.js
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
                description: "",
                id_subject: "",
                id_context: "",
                translatable: "",
                id_language: "",
                is_notificable: "0",
                id_type: "",
                id_status: "0",
            }
        }
    },

    methods:{

        insert(){
            const self = this
            self.issending = true
            self.btnsend = CONST.BTN_IN_PROGRESS
            const url = `/api/language/sentence`

            fetch(url, {
                method: 'post',
                headers:{
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({_token:csrftoken, _action:"sentence.insert",...this.sentence})
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

                self.$toast.success(`Sentence saved. Nº ${response.data.id} | ${self.sentence.title}`)
                window.location = "/adm/language/sentence/update/"+response.data.id

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

        handleSubmit: function(e) {
            e.preventDefault()
            this.insert()
        }//handleSubmit(e)
    },

    async mounted() {
        this.contexts = await apifetch.get_contexts()
        this.languages = await apifetch.get_languages()
        this.types = await apifetch.get_types()
        this.sentence.id_subject = idsubject
    }
}