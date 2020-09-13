import funcs from "/js/open/helpers/openfuncs.js"
import openapi from "/js/open/helpers/openapi.js"

const app = new Vue({
    el: "#form-convert",
    data: {
        csrf: funcs.get_csrftoken(),
        issending: false,
        btnsend: "Convertir",
        inputfile: null,
        link: "",

        maxuploadsize: 0,
        isoversized: false,
        overbytes: 0,
        filessize: 0,
    },
    methods:{
        reset(){
            this.pdfulpoad = ""
            this.$refs.inputfile.value = ""
        },

        on_change(){
            this.link = "",
                this.inputfile = this.$refs.inputfile || null
            console.log("files[0]",this.inputfile.files[0])
        },

        on_submit: function(e) {
            e.preventDefault()
            if(!this.inputfile.files[0]) return;

            this.issending = true
            this.btnsend = "Enviando..."
            const form = new FormData();
            form.append("action","pathtojpg.convert")
            form.append("_token",this.csrf)
            form.append("pdf",this.inputfile.files[0]);

            fetch('/services/conversion/pdf-to-jpg', {
                method: "post",
                body: form
            })
                .then(response => response.json())
                .then(response => {
                    this.issending = false
                    this.btnsend = "Enviando ..."
                    console.log("reponse ok",response)

                    if(typeof response.error != "undefined"){
                        return Swal.fire({
                            icon: 'warning',
                            title: 'Proceso incompleto',
                            html: 'No se ha podido procesar esta operación. Por favor inténtalo más tarde. Disculpa las molestias. <br/>'+response.error,
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
                    this.$refs.inputfile.value = ""
                })
                .catch(error => {
                    console.log("catch.error",error)
                    Swal.fire({
                        icon: 'error',
                        title: 'Vaya! Algo ha ido mal',
                        html: 'No se ha podido procesar esta operación. Por favor inténtalo más tarde. Disculpa las molestias. \n'+error,
                    })
                })
                .finally(()=>{
                    this.issending = false
                    this.btnsend = "Convertir"
                })
        }//on_submit
    },//methods

    mounted(){
        document.getElementById("form-convert").reset()
        //get maxsize
    }
})
