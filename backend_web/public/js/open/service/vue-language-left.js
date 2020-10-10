import funcs from "/js/open/helpers/openfuncs.js"
import openapi from "/js/open/helpers/openapi.js"

const vueleft = new Vue({
    el: "#div-practice-left",
    data: {
        language:{
            source: "es",
            targets: ["en"],
        },
        time: 0,
        level: 1,
        ismodal: false,
    },//data

    async mounted(){
        console.log("vue-language-left:",objpractice);
    },//mounted

    methods:{
        modal: function(){
            const self = this
            return {
                closeit: function(){
                    self.ismodal = false;
                    document.getElementById("div-modal").classList.remove("is-active")
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
