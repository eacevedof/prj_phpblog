import funcs from "/js/open/helpers/openfuncs.js"
import openapi from "/js/open/helpers/openapi.js"

const app = new Vue({
    el: "#form-generate",
    data: {
        csrf: funcs.get_csrftoken(),
        issending: false,
        btnsend: "Generar",

        length: 8,
        nonumbers: "",
        nochars: "",
        noletters: "",
    },

    async mounted(){

    },

    methods:{
        reset(){
            this.length = 8
            this.nonumbers = ""
            this.nochars = ""
            this.noletters = ""
        },

        on_submit: function(e) {
            e.preventDefault()
            if(!this.length) return
            this.issending = true
            this.btnsend = "Procesando..."
            const form = new FormData();


            fetch('/services/conversion/pdf-to-jpg', {
                method: "post",
                body: form
            })
            .then(response => response.json())
            .then(response => {
                console.log("reponse ok",response)

                if(typeof response.error != "undefined"){
                    return Swal.fire({
                        icon: 'warning',
                        title: 'Proceso incompleto',
                        html: `Ha ocurrido un error en el proceso.<br/> Motivo: <br/>
                               <b>${response.error}</b>`
                    })
                }

                Swal.fire({
                    icon: 'success',
                    html: `
                    Descarga tus imágenes aqui:
                    <a class="link-success" target="_blank" href="${response.download}">Descargar</a>
                    `,
                })

                this.link = response.download

                //reset
                this.$refs.length.value = ""
                this.length = null
                this.filessize = 0
                this.isoversized = false
                this.overbytes = 0

            })
            .catch(error => {
                console.log("catch.error",error)
                Swal.fire({
                    icon: 'error',
                    title: 'Vaya! Algo ha ido mal',
                    html: `
                    No se ha podido ejecutar esta operación.<br/>
                    Error: <b>${error}</b>
                    `,
                })
            })
            .finally(()=>{
                this.issending = false
                this.btnsend = "Convertir"
            })
        }//on_submit

    },//methods
})
