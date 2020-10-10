import funcs from "/js/open/helpers/openfuncs.js"
import openapi from "/js/open/helpers/openapi.js"

const app = new Vue({
    el: "#form-convert",
    data: {
        csrf: funcs.get_csrftoken(),
        issending: false,
        btnsend: "Convertir",
        inputfile: null,
        link: "",

        filessize: 0,
        maxuploadsize: 0,
        isoversized: false,
        overbytes: 0,

    },

    async mounted(){
        console.log("vue-language-practice:",objpractice);
    },

    methods:{

    },//methods
})
