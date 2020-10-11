import funcs from "/js/open/helpers/openfuncs.js"
import openapi from "/js/open/helpers/openapi.js"
import db from "/js/open/helpers/opendb.js"

const vueleft = new Vue({
    el: "#div-practice-left",
    data: {
        ismodal: false,
        language:{

        },
        config: {
            sources: ["es","nl","en"],
            targets: ["nl","en"],


            selsource: "es",
            seltargets: ["nl"],
            time: 0,
            level: 1,
            israndom:false,
            questions:20,
        }
    },//data

    mounted(){
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
                        ...self.config
                    })
                    toast.open({
                        message: "Configuración guardada",
                        type:"is-success",
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
