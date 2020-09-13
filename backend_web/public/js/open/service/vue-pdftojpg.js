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

        filessize: 0,
        maxuploadsize: 0,
        isoversized: false,
        overbytes: 0,

    },

    async mounted(){
        document.getElementById("form-convert").reset()
        this.maxuploadsize = await openapi.get_maxsize()
    },

    methods:{
        reset(){
            this.pdfulpoad = ""
            this.$refs.inputfile.value = ""
        },

        on_change(){
            //alert(1)
            this.link = ""
            this.inputfile = this.$refs.inputfile || null
            this.filessize = this.inputfile.files.length ? this.inputfile.files[0].size : 0
            this.overbytes = 0
            this.isoversized = false

            const overbytes = this.filessize - this.maxuploadsize
            if(overbytes>0){
                this.isoversized = true
                this.overbytes = overbytes
            }

            //console.log("files",this.inputfile.files)
        },

        on_submit: function(e) {
            e.preventDefault()
            if(!this.inputfile.files[0]) return

            this.issending = true
            this.btnsend = "Procesando..."
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

                //reset
                this.$refs.inputfile.value = ""
                this.inputfile = null
                this.filessize = 0
                this.isoversized = false
                this.overbytes = 0

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
})
