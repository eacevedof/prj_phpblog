import openapi from "/js/open/helpers/openapi.js"
import funcs from "/js/open/helpers/openfuncs.js"

Vue.use(VueToast, {position:"top"})

const app = new Vue({
    el: "#form-formatsql",
    data: {
        issending: false,
        btnsend: "Convertir",

        table: "xxxyyytt  ",
        fields: " a, b, c,,,",
        colsep: "tab",
        from: "csv",
        to: "insert",
        rawdata: "",
        result: "",
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

            const response = await openapi.post_tosql({
                colsep: this.colsep,
                table: this.table,
                fields: this.fields,
                from: this.from,
                to: this.to,
                struct: this.rawdata
            })

            if(response?.error){
                return Swal.fire({
                    icon: 'error',
                    html: `Ha ocurrido un error.<br/> Motivo: <br/>
                           <b>${response.error}</b>`
                })
            }

            this.result = response.data
            this.issending = false
            this.btnsend = "Convertir"
        }//on_submit

    },//methods
})
