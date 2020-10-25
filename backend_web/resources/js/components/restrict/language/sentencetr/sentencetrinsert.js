//sentencetrinsert.js
import funcs from "../../../../app/funcs"
import CONST from "../../../../app/constants"
import apifetch from "../../../../app/apifetch"
import db from "../../../../app/db"

const csrftoken = funcs.get_csrftoken()
const idsentence = funcs.get_urlpiece(4)
alert(idsentence)
export default {
    data(){
        return {
            btnsend: CONST.BTN_INISTATE,
            issending: false,

            languages: [],
            sentence: {},

            sentencetr: {
                description: "",
                translated: "",
                id_language: "",
                id_sentence: "",
            }
        }
    },

    async mounted() {
        this.languages = await apifetch.get_languages()
        this.sentencetr.id_sentence = idsentence
    },

    methods:{
        redirect(idsentencetr) {
            if(idsentence) window.location = `/adm/language/subject/${idsentence}/sentencetrs`
            else window.location = `/adm/language/sentencetr/update/${idsentencetr}`
        },

        insert(){
            const self = this
            self.issending = true
            self.btnsend = CONST.BTN_IN_PROGRESS
            const url = `/api/language/sentencetr`

            fetch(url, {
                method: 'post',
                headers:{
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({_token:csrftoken, _action:"sentencetr.insert",...this.sentencetr})
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

                self.$toast.success(`Sentencetr saved. Nº ${response.data.id} | ${self.sentencetr.title}`)
                self.redirect()

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

    },//methods

}//export
