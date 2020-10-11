import funcs from "/js/open/helpers/openfuncs.js"
import openapi from "/js/open/helpers/openapi.js"
import db from "/js/open/helpers/opendb.js"
//import { ToastProgrammatic as Toast } from 'https://unpkg.com/buefy@0.9.3/dist/components/toast/index.js'
//console.log("window:",window.Toast.ToastProgrammatic)
const toast = window.Toast.ToastProgrammatic

const vueleft = new Vue({
    el: "#div-practice-left",
    data: {
        ismodal: false,
        language:{

        },
        config: {
            targets: ["nl","en"],
            seltargets: ["nl"],


            sources: ["es","nl","en"],
            selsource: "es",

            time: 0,
            level: 1,
            israndom:false,
            questions:20,
        }
    },//data

    mounted(){
        toast.open('Toasty!')
        console.log("vue-language-left:",objpractice);
    },//mounted

    methods:{
        modal(){
            const self = this
            return {
                close(){
                    self.ismodal = false;
                    document.getElementById("div-modal").classList.remove("is-active")
                },
                save(){
                    db.save("lang-config",{
                        seltargets: self.config.seltargets,
                        time: self.config.time
                    })
                }
            }
        },

        on_config(){
            //alert("on config")
            this.ismodal = !this.ismodal;
            const $modal = document.getElementById("div-modal")
            if(this.ismodal)
                $modal.classList.add("is-active")
            else
                $modal.classList.remove("is-active")
        },

    },//methods
})
