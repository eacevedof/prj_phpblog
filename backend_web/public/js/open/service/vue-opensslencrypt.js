import openapi from "/js/open/helpers/openapi.js"
import funcs from "/js/open/helpers/openfuncs.js"

Vue.use(VueToast, {position:"top"})

const app = new Vue({
    el: "#form-opensslencrypt",
    data: {
        issending: false,
        btnsend: "Probar",

        methods: [],
        method: "",
        func: "",

        password: "",
        salt: "",
        option: "",
        iv: "",
        data: "",

        result: "",
    },

    async mounted(){
        //this.$refs.func.focus()
        this.methods = await openapi.get_sslmethods()
    },

    methods:{
        reset(){
            this.func = ""
            this.methods = ""
            this.password = ""
            this.data = ""
            this.result = ""
        },

        to_clipboard(){
            funcs.to_clipboard(this.password)
            const html = funcs.html_entities(this.password)
            this.$toast.open(`func: <b>${html}</b> now in clipboard`)
        },

        update_password(){
            const func = `/${this.func}/${this.methods}`
            this.password = func
        },

        on_submit: async function(e) {
            e.preventDefault()
            if(!this.func) return
            if(!this.data) return

            this.issending = true
            this.btnsend = "Procesando..."
            this.result = ""

            const response = await openapi.post_sslencrypt({
                method: this.method,
                func: this.func,
                password: this.password,
                salt: this.salt,
                option: this.option,
                iv: this.iv,
                data: this.data
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
            this.$nextTick(() => this.$refs.func.focus())
        }//on_submit

    },//methods
})
