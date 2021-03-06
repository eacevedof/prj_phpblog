//sentencetrupdate.js
import funcs from "../../../../app/funcs"
import CONST from "../../../../app/constants"
import apifetch from "../../../../app/apifetch"
import sentence from "../../../../models/sentence";

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
                id: "",
                description: "",
                translated: "",
                id_language: "",
                id_sentence: "",
            }
        }
    },

    async mounted() {
        const id = funcs.get_lastparam()
        this.sentencetr.id_sentence = idsentence
        this.languages = await apifetch.get_languages()
        this.sentence = await sentence.get_by_id(idsentence)

        this.$refs.txatranslated.focus()
        this.load_register(id)
    },

    methods:{
        redirect(idsentencetr) {
            if(!idsubject) window.location = `/adm/language/sentencetr/update/${idsentencetr}`
        },

        load_register(id){
            const self = this
            self.issending = true
            self.btnsend = CONST.BTN_IN_PROGRESS

            const url = `/api/language/sentencetr/${id}`
            //alert(url)
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

                this.sentencetr = response.data
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
            const url = `/api/language/sentencetr/${this.sentencetr.id}`

            fetch(url, {
                method: 'put',
                headers:{
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({_token:csrftoken,_action:"sentencetr.update", ...this.sentencetr})
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
                this.$toast.success(`Sentencetr saved. Nº ${self.sentencetr.id} | ${self.sentencetr.translated}`)
                this.load_register(self.sentencetr.id)
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
                const url = `/api/language/sentencetr/${id}`
                fetch(url, {
                    method: 'delete',
                    headers:{
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({_token:csrftoken,_action:"sentencetr.delete"})
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
                        title: `Sentencetr: ${id} has been removed`,
                        html: `<b>&#128578;</b>`,
                    })

                    document.location = "/adm/language/sentencetrs"
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
