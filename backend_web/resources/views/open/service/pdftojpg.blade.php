@extends("open.open-layout")

@section("pagetitle",$seo["title"])
@section("pagedescription",$seo["description"])
@section("pagekeywords",$seo["keywords"])

@section("container")
<div class="card app-card">
    <div class="card-header">
        <h2 class="card-title mt-2">{{$seo["description"]}}</h2>
    </div>
    @verbatim
    <div class="card-body">
        <form @submit="on_submit" id="form-convert" class="row g-3">
            <div class="col-sm-9">
                <label for="name">PDF *</label>
                <input type="file" class="form-control" required="required"
                       accept="application/pdf"
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
            <div class="row">
                <small class="badge bg-info text-white">max upload: {{maxuploadsize.toLocaleString("en")}}</small>
                <small v-if="filessize>0" class="badge bg-warning">selected: {{filessize.toLocaleString("en")}}</small>
                <small v-if="isoversized" class="badge bg-danger text-white">oversized: {{overbytes.toLocaleString("en")}}</small>
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
<script type="module">
import open from "/js/open/open.js"


const app = new Vue({
    el: "#form-convert",
    data: {
        csrf: "{{ csrf_token() }}",
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
</script>
@endsection
