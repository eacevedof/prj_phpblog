//sentence index
import funcs from "../../../../app/funcs"
import CONST from "../../../../app/constants"
import db from "../../../../app/db"
import sentence from "../../../../models/sentence";

const csrftoken = funcs.get_csrftoken()
const idsentence = funcs.get_urlpiece(6)

export default {
    data(){
        return {
            issending: false,
            btnsend: CONST.BTN_INISTATE_REFRESH,

            sentence:{},

            columns: ["id","ff_language","translated","description"],
            rows: [],

            filter:{
                original: [],
                search: "",
            }
        }
    },

    async mounted() {
        this.sentence = await sentence.get_by_id(idsentence)
        this.rows_load()
    },

    methods: {
        rows_load(){
            console.log("rows_load")
            const self = this
            self.issending = true
            self.btnsend = CONST.BTN_IN_PROGRESS
            const url = `/api/language/sentence/${idsentence}/sentencetrs`
            fetch(url, {
                method: 'get',
            })
            .then(response => response.json())
            .then(response => {
                //console.log("load.reponse",response)

                if(funcs.is_error(response)) {
                    return Swal.fire({
                        icon: 'warning',
                        title: CONST.TITLE_ERROR,
                        html: response.error,
                    })
                }

                self.rows = response.data
                self.filter.original = response.data
                self.filter.search = db.select("sentencetr-search")
                self.on_search()

            })
            .catch(error => {
                console.log("CATCH ERROR insert",error)
                Swal.fire({
                    icon: 'error',
                    title: CONST.TITLE_SERVERROR,
                    html: error.toString(),
                })
            })
            .finally(() => {
                self.issending = false;
                self.btnsend = CONST.BTN_INISTATE_REFRESH
            })
        },//load

        on_search(){
            if(!this.filter.search){
                db.delete("sentencetr-search")
                this.rows = [...this.filter.original]
                return
            }
            if(this.filter.original.length === 0) return
            const fields = Object.keys(this.filter.original[0])
            if(!fields) return

            const search = this.filter.search.toString().trim()
            db.save("sentencetr-search",search)
            const rows = this.filter.original.filter(obj => {
                const exist = fields.some(field => {
                    if(obj[field]===null) return false
                    const str = obj[field].toString()
                    return str.indexOf(search) !== -1
                })
                return exist
            })

            this.rows = [...rows]
        },

        insert(){
            const url = `/adm/language/sentence/${idsentence}/sentencetr/insert`
            document.location = url
        },

        edit(id){
            const url = `/adm/language/sentence/${idsentence}/sentencetr/update/${id}`
            document.location = url
        },

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
                    body: JSON.stringify({_token:csrftoken,_action:"sentence.delete"})
                })
                .then(response => response.json())
                .then(response => {
                    console.log("remove.response",response)
                    if(funcs.is_error(response)) {
                        return Swal.fire({
                            icon: 'warning',
                            title: CONST.TITLE_ERROR,
                            html: response.error,
                        })
                    }

                    self.rows_load()

                    Swal.fire({
                        icon: 'success',
                        title: `Sentence: ${id} has been removed`,
                        html: `<b>&#128578;</b>`,
                    })

                })
                .catch(error => {
                    console.log("CATCH ERROR remove",error)
                    Swal.fire({
                        icon: 'error',
                        title: CONST.TITLE_SERVERROR,
                        html: error.toString(),
                    })
                })
                .finally(() => {
                    self.issending = false;
                    self.btnsend = CONST.BTN_INISTATE_REFRESH
                })
            }
        },//emove
    }//methods
}
