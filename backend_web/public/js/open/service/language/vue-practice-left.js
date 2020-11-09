import openapifetch from "/js/open/helpers/openapifetch.js"
import db from "/js/open/helpers/opendb.js"
import openvendorapi from "/js/open/helpers/openvendorapi.js"

const LANG_CONFIG = "lang-config"

new Vue({
    el: "#div-practice-left",
    data: {
        ismodal: false,

        config: {
            sourcelangs: [],
            targetlangs: [],

            selsource: "2", //es
            seltargets: ["3"], //nl

            time: 0,
            level: 1,

            israndom:false,
            questions:20,
        }
    },//data

    async mounted(){
        await this.load_languages()
        const config = db.select(LANG_CONFIG)
        if(config && Object.keys(config).length>0) {
            this.config = {...config}
        }
        else{
            db.save(LANG_CONFIG,{
                ...this.config
            })
        }
    },//mounted

    methods:{

        load_languages: async function () {
            //console.log("load_languages ini")
            const languages = await openapifetch.get_languages()
            //console.table(languages)
            this.config.sourcelangs = languages.map(obj => ({id:obj.id, code_erp:obj.code_erp, urlflag: openvendorapi.get_urlflag(obj.code_erp)}))
            this.config.targetlangs = [...this.config.sourcelangs]
            //console.log("load_languages end")
        },

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
                    location.reload()
                }
            }
        },

        on_config(){
            this.ismodal = true;
            const $modal = document.getElementById("div-modal")
            $modal.classList.add("is-active")
        },

    },//methods
})
