@extends("open.open-layout")

@section("pagetitle",$seo["title"])
@section("pagedescription",$seo["description"])
@section("pagekeywords",$seo["keywords"])



@section("container")
<div class="card app-card">
    <div class="card-header">
        <h5 class="card-title mt-2">Conversor PDF a JPG</h5>
    </div>
    @verbatim
    <div class="card-body">
        <form @submit="on_submit" id="form-convert" class="row g-3">
            <div class="col-sm-9">
                <label for="name">PDF *</label>
                <input type="file" class="form-control" required="required"
                       accept="application/pdf,application/vnd.ms-excel"
                       ref="inputfile"
                       @change="on_change"
                >
            </div>
            <div class="col-sm-3 m-0 p-0 pt-4">
                <button id="btn-contact" class="btn btn-dark m-0 mt-3" :disabled="issending" >
                    {{btnsend}}
                    <img v-if="issending" src="/assets/images/loading-bw.gif" width="25" height="25"/>
                </button>
            </div>
            <div v-if="link!=''" class="col-sm-12">
                <span>Tus imágenes:</span>
                <a class="link-success" target="_blank"
                   :href="link"
                >Descargar</a>
            </div>
        </form>
    </div>
</div>
@endverbatim
<script>
const app = new Vue({
    el: "#form-convert",
    data: {
        errors:[],
        csrf: "{{ csrf_token() }}",
        issending: false,
        btnsend: "Convertir",
        inputfile: null,
        link: "",
    },
    methods:{
        reset(){
            this.pdfulpoad = ""
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

            fetch('/servicios/pdf-a-jpg/convert', {
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
        }
    },//methods

    mounted(){
        document.getElementById("form-convert").reset()
    }
})
</script>
@endsection
