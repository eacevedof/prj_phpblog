//sentencetrinsert.js
import funcs from "../../../../app/funcs"
import CONST from "../../../../app/constants"
import apifetch from "../../../../app/apifetch"
import sentence from "../../../../models/sentence";
import db from "../../../../app/db"

const csrftoken = funcs.get_csrftoken()
const idsentence = funcs.get_urlpiece(4)

export default {
    data(){
        return {
            btnsend: CONST.BTN_INISTATE,
            issending: false,

            sentence: {},
            languages: [],

            sentencetr: {
                description: "",
                translated: "",
                id_language: "",
                id_sentence: "",
            }
        }
    },

    async mounted() {
        this.sentencetr.id_sentence = idsentence
        this.languages = await apifetch.get_languages()
        this.sentence = await sentence.get_by_id(idsentence)
        const sentencetr = db.select("sentencetr.insert")
        if(sentencetr){
            this.sentencetr.id_language = sentencetr.id_language
            //this.sentencetr.id_sentence = sentencetr.id_sentence
        }
        this.$refs.txatranslated.focus()
    },

    methods:{
        redirect(idsentencetr) {
            //const idsubject = this.sentence.id_subject
            //window.location = `/adm/language/sentence/${idsentence}/sentencetr/insert`
            //if(idsentence) window.location = `/adm/language/subject/${idsubject}/sentence/${idsentence}/sentencetrs`
            //else window.location = `/adm/language/sentencetr/update/${idsentencetr}`
            window.location = `/adm/language/subject/${this.sentence.id_subject}/sentence/insert`
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
                db.save("sentencetr.insert", {...response.data})
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
