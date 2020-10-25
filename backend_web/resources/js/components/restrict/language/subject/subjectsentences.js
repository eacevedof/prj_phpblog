//subject index
import funcs from "../../../../app/funcs"
import CONST from "../../../../app/constants"
import db from "../../../../app/db"

const csrftoken = funcs.get_csrftoken()
const idsubject = funcs.get_urlpiece(4)

export default {
    data(){
        return {
            issending: false,
            btnsend: CONST.BTN_INISTATE_REFRESH,
            columns: ["id","as_language","as_type","translatable","description"],

            rows: [],

            filter:{
                original: [],
                search: "",
            }
        }
    },

    mounted() {
        this.rows_load()
    },

    methods: {
        rows_load(){
            console.log("rows_load")
            const self = this
            self.issending = true
            self.btnsend = CONST.BTN_IN_PROGRESS
            const url = `/api/language/subject/${idsubject}/sentences`
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
                //console.log("rows_load.rows"); console.table(self.rows)
                self.filter.original = response.data
                self.filter.search = db.select("subject-search")
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
                db.delete("subject-search")
                this.rows = [...this.filter.original]
                return
            }
            if(this.filter.original.length === 0) return
            const fields = Object.keys(this.filter.original[0])
            if(!fields) return

            const search = this.filter.search.toString().trim()
            db.save("subject-search",search)
            const rows = this.filter.original.filter(obj => {
                const exist = fields.some(field => {
                    if(obj[field]===null) return false
                    const str = obj[field].toString()
                    return str.indexOf(search) !== -1
                })
                return exist
            })

            this.rows = [...rows]
            //console.log("rows filtered"); console.table(this.rows)
        },

        insert(){
            const url = `/adm/language/subject/${idsubject}/sentence/insert`
            document.location = url
        },

        edit(id){
            const url = `/adm/language/sentence/update/${id}`
            document.location = url
        },

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
                    body: JSON.stringify({_token:csrftoken,_action:"subject.delete"})
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
                        title: `Subject: ${id} has been removed`,
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
        },
    }
}
