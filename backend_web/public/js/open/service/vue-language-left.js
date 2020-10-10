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
    },//data

    async mounted(){
        console.log("vue-language-left:",objpractice);
    },//mounted

    methods:{
        on_config(){
            alert("on config")
        }
    },//methods
})
