@extends("open.open-layout")

@section("pagetitle",$seo["title"])
@section("pagedescription",$seo["description"])
@section("pagekeywords",$seo["keywords"])

@section("container")
<!-- formulario de contacto -->
<div class="form-contact_container">
    @verbatim
    <form @submit="checkform" id="form-contact" class="contact_form">
        <div>
            <div class="row">
                <div class="col-lg-6">
                    <label for="name">Nombre</label>
                    <input type="text" id="name" v-model="name" placeholder="...tu nombre" class="contact_input" required="required">
                </div>
                <div class="col-lg-6">
                    <label for="email">Email</label>
                    <input id="email" type="email" v-model="email" placeholder="tu-email@dominio.com" class="contact_input" required="required">
                </div>
            </div>
        </div>
        <div><input type="text" v-model="subject" placeholder="Asunto" class="contact_input" style="margin-top:15px"></div>
        <div><textarea v-model="message" class="contact_input contact_textarea" placeholder="Mensaje" required="required" style="margin-top:15px;"></textarea></div>
        <button id="btn-contact" class="contact_form_button" :disabled="issending" >
            {{btnsend}}
            <img v-if="issending" src="/assets/images/loading-bw.gif" width="25" height="25"/>
        </button>
    </form>
    @endverbatim
</div>
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
            const self = this
            console.log("checkform")
            e.preventDefault()
            this.issending = true
            this.btnsend = "Enviando..."
            const data = new FormData();
            data.append("action","contact.email")
            data.append("_token",this.csrf)
            data.append("name",this.name)
            data.append("email",this.email)
            data.append("subject",this.subject)
            data.append("message",this.message)
            console.log("data pre fetch",data)
            fetch('/email/contact', {
                method: "post",
                body: data
            })
            .then(response => {
                this.issending = false
                this.btnsend = "Enviar"
                console.log("reponse ok",response)
                if(response.ok) {
                    //console.log("e.target",e.target)
                    Swal.fire({
                        icon: 'success',
                        title: 'Gracias por contactar con nosotros!',
                        html: 'En breves momentos recibirás una copia del mensaje en tu email.',
                    })
                    self.reset()
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Proceso incompleto',
                        text: 'No se ha podido procesar tu mensaje. Por favor inténtalo más tarde o prueba por teléfono (34 91 455 74 43).  Disculpa las molestias.',
                    })
                }
            })
            .catch(error => {
                console.log("catch.error",error)
                Swal.fire({
                    icon: 'error',
                    title: 'Vaya! Algo ha ido mal',
                    text: 'No se ha podido procesar tu mensaje. Por favor inténtalo más tarde o prueba por teléfono (34 91 455 74 43).  Disculpa las molestias.'+error.toString(),
                })
            })
            .finally(()=>{
                this.issending = false
                this.btnsend = "Enviar"
            })
        }
    },//methods
    mounted(){
        console.log("form-contact.html.twig mounted")
        document.getElementById("form-contact").reset()
    }
})
</script>
@endsection
