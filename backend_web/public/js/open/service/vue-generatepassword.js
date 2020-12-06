import openapi from "/js/open/helpers/openapi.js"
//import VueBootstrapToasts from "vue-bootstrap-toasts"
//console.log(window.Toast.ToastProgrammatic)

//Vue.use(window['vue-bootstrap-toasts'].default)
//Vue.use(window.Toast)

const app = new Vue({
    el: "#form-generate",
    data: {
        issending: false,
        btnsend: "Generar",

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
            alert(this.password)
            window.Toast.ToastProgrammatic.open(`Subject saved. Nº ${this.password}`)
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
            this.btnsend = "Generar"
        }//on_submit

    },//methods
})
