//uploadinsert.js
import funcs from "../../../app/funcs"
import CONST from "../../../app/constants"

export default {
    data(){
        return {
            btnsend: CONST.BTN_INISTATE_UPLOAD,
            issending: false,

            upload: {
                content: "",
                url_img1: "",
                url_img2: "",
                url_img3: "",
            }
        }
    },

    methods:{
        on_change(){
            alert("X")
        },
        insert(){
            const self = this
            self.issending = true
            self.btnsend = CONST.BTN_IN_PROGRESS

            const url = funcs.get_uploadomain().concat("/upload/by-url")
            const form = new FormData()
            form.append("resource-usertoken",funcs.get_uploadtoken())
            form.append("folderdomain","eduardoaf.com")
            form.append("files",self.upload.content)

            fetch(url, {
                method: 'post',
                body: form
            })
                .then(response => response.json())
                .then(response => {

                    console.log("reponse",response)

                    if(funcs.is_error(response)) {
                        return Swal.fire({
                            icon: 'warning',
                            title: CONST.TITLE_ERROR,
                            text: response.error,
                        })
                    }

                    this.$toast.success(`Files "${url}" uploaded`)
                })
                .catch(error => {
                    console.log("CATCH ERROR insert",error)
                    Swal.fire({
                        icon: 'error',
                        title: CONST.TITLE_SERVERROR,
                        text: error.toString(),
                    })
                })
                .finally(() => {
                    self.issending = false;
                    self.btnsend = CONST.BTN_INISTATE_UPLOAD
                })
        },//insert

        handleSubmit: function(e) {
            e.preventDefault()
            this.insert()
        }//handleSubmit(e)
    },

    async mounted() {
        ;
    }
}
