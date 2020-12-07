import openapi from "/js/open/helpers/openapi.js"
import funcs from "/js/open/helpers/openfuncs.js"

Vue.use(VueToast, {position:"top"})

const app = new Vue({
    el: "#form-pregmatchall",
    data: {
        issending: false,
        btnsend: "Probar",

        pattern: "",
        flags: "",
        final: "",
        text: "",
        result: "",
    },

    methods:{
        reset(){
            this.pattern = ""
            this.flags = ""
            this.final = ""
            this.text = ""
            this.result = ""
        },

        to_clipboard(){

            funcs.to_clipboard(pattern)
            this.$toast.open(`Pattern: ${pattern} now in clipboard`)
        },

        update_final(){
            const pattern = `/${this.pattern}/${this.flags}`
            this.final = pattern
        },

        on_submit: async function(e) {
            e.preventDefault()
            if(!this.pattern) return
            this.issending = true
            this.btnsend = "Procesando..."
            this.result = ""

            const response = await openapi.post_pregmatchaall({
                pattern: this.pattern,
                flags: this.flags,
                text: this.text
            })

            console.log("R",response)

            if(typeof response.error != "undefined"){
                Swal.fire({
                    icon: 'warning',
                    title: 'Proceso incompleto',
                    html: `Ha ocurrido un error en el proceso.<br/> Motivo: <br/>
                           <b>${response.error}</b>`
                })
            }
            else{
                this.result = response
            }

            this.issending = false
            this.btnsend = "Probar"
        }//on_submit

    },//methods
})
