import openapi from "/js/open/helpers/openapi.js"
import funcs from "/js/open/helpers/openfuncs.js"

Vue.use(VueToast, {position:"top"})

const app = new Vue({
    el: "#form-prettyquery",
    data: {
        issending: false,
        btnsend: "Formatear",

        length: 8,
        nonumbers: "",
        nochars: "",
        noletters: "",
        password: "",
    },


    methods:{
        reset(){
            this.length = 8
            this.nonumbers = ""
            this.nochars = ""
            this.noletters = ""
            this.password = ""
        },

        to_clipboard(){
            funcs.to_clipboard(this.password)
            const html = funcs.html_entities(this.password)
            this.$toast.open(`Password <b>${html}</b> now in clipboard`)
        },

        on_submit: async function(e) {
            e.preventDefault()
            if(!this.length) return
            this.issending = true
            this.btnsend = "Procesando..."
            this.password = ""

            const response = await openapi.post_passwconfig({
                length: this.length,
                nonumbers: this.nonumbers,
                nochars: this.nochars,
                noletters: this.noletters
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
                this.password = response
            }

            this.issending = false
            this.btnsend = "Formatear"
        }//on_submit

    },//methods
})
