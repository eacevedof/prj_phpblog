@extends("open.open-layout")

@section("pagetitle",$seo["title"])
@section("pagedescription",$seo["description"])
@section("pagekeywords",$seo["keywords"])
@section("canonical",$canonical ?? "")

@section("container")
<!-- formulario de contacto -->
<div class="card opn-card">
    <div class="card-header">
        <h5 class="card-title mt-2">Formulario de contacto</h5>
    </div>
    @verbatim
    <div class="card-body">
        <form @submit="checkform" id="form-contact" class="row g-3">
            <div class="col-lg-6 col-sm-12">
                <label for="name">Nombre *</label>
                <input type="text" id="name" v-model="name" placeholder="...tu nombre" class="form-control" required="required">
            </div>
            <div class="col-lg-6 col-sm-12">
                <label for="email">Email *</label>
                <input id="email" type="email" v-model="email" placeholder="tu-email@dominio.com" class="form-control" required="required">
            </div>
            <div class="col-lg-6 col-sm-12">
                <label for="subject" class="form-label">Asunto *</label>
                <input type="text" id="subject" v-model="subject" placeholder="Asunto" class="form-control">
            </div>
            <div class="col-lg-12">
                <label for="message" class="form-label">Mensaje *</label>
                <textarea id="message" v-model="message" class="form-control"  placeholder="Mensaje" required="required" rows="5"></textarea>
            </div>
            <div class="col-lg-12">
                <button id="btn-contact" class="btn btn-dark" :disabled="issending" >
                    {{btnsend}}
                    <img v-if="issending" src="/assets/images/loading-bw.gif" width="25" height="25"/>
                </button>
            </div>
        </form>
    </div>
</div>
@endverbatim
<script>
const app = new Vue({
    el: "#form-contact",
    data: {
        errors:[],
        csrf: "{{ csrf_token() }}",
        issending: false,
        btnsend: "Enviar",
        name: "",
        email: "",
        subject: "",
        message: "",
    },
    methods:{
        reset(){
            this.name = ""
            this.email = ""
            this.subject = ""
            this.message = ""
        },


        checkform: function(e) {
            e.preventDefault()
            const self = this

            this.issending = true
            this.btnsend = "Enviando..."
            const data = new FormData();
            data.append("action","contact.email")
            data.append("_token",this.csrf)
            data.append("name",this.name)
            data.append("email",this.email)
            data.append("subject",this.subject)
            data.append("message",this.message)
            //console.log("data pre fetch",data)
            fetch('/email/contact', {
                method: "post",
                body: data
            })
            .then(response => response.json())
            .then(response => {
                this.issending = false
                this.btnsend = "Enviar"
                console.log("reponse ok",response)

                if(typeof response.error != "undefined"){
                    return Swal.fire({
                        icon: 'warning',
                        title: 'Proceso incompleto',
                        html: 'No se ha podido procesar tu mensaje. Por favor inténtalo más tarde. Disculpa las molestias. <br/>'+response.error,
                    })
                }
                Swal.fire({
                    icon: 'success',
                    title: 'Gracias por contactar conmigo!',
                    html: 'En breves momentos recibirás una copia del mensaje en tu email.',
                })
                self.reset()
            })
            .catch(error => {
                console.log("catch.error",error)
                Swal.fire({
                    icon: 'error',
                    title: 'Vaya! Algo ha ido mal (c)',
                    html: 'No se ha podido procesar tu mensaje. Por favor inténtalo más tarde. Disculpa las molestias. \n'+error,
                })
            })
            .finally(()=>{
                this.issending = false
                this.btnsend = "Enviar"
            })
        }
    },//methods

    mounted(){
        document.getElementById("form-contact").reset()
    }
})
</script>
@endsection
