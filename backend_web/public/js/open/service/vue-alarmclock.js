import openapi from "/js/open/helpers/openapi.js"

Vue.use(VueToast, {position:"top"})

const app = new Vue({
    el: "#form-alarmclock",
    data: {
        isstarted: false,
        btnstart: "Inicio",
        btnend: "Finalizar",

        hh: 0,
        mm: 0,
        ss: 0,
    },

    mounted(){
        //this.$refs.hh.focus()
    },

    methods:{
        reset(){
            this.hh = ""
            this.mm = ""
            this.ss = ""
        },

        start(){

        },

        end(){

        },



    },//methods
})
