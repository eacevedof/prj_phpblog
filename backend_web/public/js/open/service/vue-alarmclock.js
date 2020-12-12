import openapi from "/js/open/helpers/openapi.js"
import funcs from "/js/open/helpers/openfuncs.js"

Vue.use(VueToast, {position:"top"})

const app = new Vue({
    el: "#form-alarmclock",
    data: {
        issending: false,
        btnsend: "Inicio",

        query: "",
        result: "",
    },

    methods:{
        reset(){
            this.query = ""
            this.result = ""
        },

        to_clipboard(){
            funcs.to_clipboard(this.result)
            const html = funcs.html_entities(this.result)
            this.$toast.open(`result <b>${html}</b> now in clipboard`)
        },

        on_submit: async function(e) {
            e.preventDefault()
            if(!this.query.trim()) return
            this.issending = true
            this.btnsend = "Procesando..."
            this.result = ""

            const response = await openapi.post_formatquery({
                query: this.query,
            })

            if(typeof response.error != "undefined"){
                Swal.fire({
                    icon: 'error',
                    html: `Ha ocurrido un error.<br/> Motivo: <br/>
                           <b>${response.error}</b>`
                })
            }
            else{
                this.result = response.data
            }

            this.issending = false
            this.btnsend = "Inicio"
        }//on_submit

    },//methods
})
