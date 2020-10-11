//vue-language-left.js
//import funcs from "/js/open/helpers/openfuncs.js"
//import openapi from "/js/open/helpers/openapi.js"
import db from "/js/open/helpers/opendb.js"

const LANG_CONFIG = "lang-config"

new Vue({
    el: "#div-practice-left",
    data: {
        ismodal: false,

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
        //console.log("vue-language-left:",objpractice);
        const config = db.select(LANG_CONFIG)
        if(config)
            this.config = {...config}

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
                    db.save(LANG_CONFIG,{
                        ...self.config
                    })
                    self.modal().close()
                    toast.open({
                        message: "Configuración guardada",
                        type:"is-success",
                    })
                }
            }
        },

        on_config(){
            this.ismodal = true;
            const $modal = document.getElementById("div-modal")
            if(this.ismodal)
                $modal.classList.add("is-active")
        },

    },//methods
})
