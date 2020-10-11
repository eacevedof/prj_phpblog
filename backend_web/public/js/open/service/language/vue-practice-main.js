import funcs from "/js/open/helpers/openfuncs.js"
import openapi from "/js/open/helpers/openapi.js"
import db from "/js/open/helpers/opendb.js"


const LANGUAGES = {
    "1":"sp","2":"nl","3":"en"
}

new Vue({
    el: "#div-practice-main",
    data: {
        config:{},
        isfinished: true,

        question:{

        },

        questions:[],

    },//data

    mounted(){
        const config = db.select(LANG_CONFIG)
        if(config)
            this.config = {...config}
        console.log("vue-language-practice:",objpractice);
    },//mounted

    methods:{
        start(){

        },
        save(){

        }
    },//methods
})
