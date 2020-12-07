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
        final: "//",
        text: "",
        result: "",
    },

    mounted(){
        this.$refs.pattern.focus()
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
            funcs.to_clipboard(this.final)
            this.$toast.open(`Pattern: ${this.final} now in clipboard`)
        },

        update_final(){
            const pattern = `/${this.pattern}/${this.flags}`
            this.final = pattern
        },

        on_submit: async function(e) {
            e.preventDefault()
            if(!this.pattern) return
            if(!this.text) return

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
                    icon: 'error',
                    html: `Ha ocurrido un error.<br/> Motivo: <br/>
                           <b>${response.error}</b>`
                })
            }
            else{
                this.result = response.data
            }

            this.issending = false
            this.btnsend = "Probar"
            this.$nextTick(() => this.$refs.pattern.focus())
        }//on_submit

    },//methods
})
