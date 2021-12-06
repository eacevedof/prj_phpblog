import openapi from "/js/open/helpers/openapi.js"
import funcs from "/js/open/helpers/openfuncs.js"
import db from "/js/open/helpers/opendb.js"

Vue.use(VueToast, {position:"top"})

const app = new Vue({
    el: "#form-formatsql",
    data: {
        issending: false,
        btnsend: "Convertir",

        table: "",
        fields: "",
        colsep: "tab",
        from: "csv",
        to: "insert",
        rawdata: "",
        result: "",
    },

    mounted() {
        //console.log("mounted :)")
        const lastpost = db.select("tosql-config")
        if (lastpost) {
            this.table = lastpost.table
            this.fields = lastpost.fields
            this.colsep = lastpost.colsep
            this.from = lastpost.from
            this.to = lastpost.to
        }
    },

    methods:{
        reset(){
            this.rawdata = ""
            this.result = ""
        },

        to_clipboard(){
            funcs.to_clipboard(this.result)
            const html = funcs.html_entities(this.result)
            this.$toast.open(`result <b>${html}</b> now in clipboard`)
        },

        on_submit: async function(e) {
            e.preventDefault()
            if(!this.rawdata.trim()) return
            this.issending = true
            this.btnsend = "Procesando..."
            this.result = ""

            const post = {
                colsep: this.colsep,
                table: this.table,
                fields: this.fields,
                from: this.from,
                to: this.to,
                struct: this.rawdata
            }

            db.save("tosql-config", post)
            const response = await openapi.post_tosql(post)

            this.issending = false
            this.btnsend = "Convertir"
            if(response?.error){
                return Swal.fire({
                    icon: 'error',
                    html: `Ha ocurrido un error.<br/> Motivo: <br/>
                           <b>${response.error}</b>`
                })
            }
            this.result = response.data.join(";\n").concat(";")
        }//on_submit

    },//methods
})
