import openapi from "/js/open/helpers/openapi.js"

Vue.use(VueToast, {position:"top"})

const app = new Vue({
    el: "#form-alarmclock",
    data: {
        isstarted: false,
        btnstart: "Inicio",
        btnstop: "Detener",
        btnreset: "Resetaar",

        hh: 0,
        mm: 0,
        ss: 0,

        strhh: "00",
        strmm: "00",
        strss: "00",

        remain:{
            hh:0,
            mm:0,
            ss:0,
        },

        audio: null
    },

    mounted(){
        this.$refs.hh.focus()
        this.audio = this.refs.audio
    },

    methods:{
        reset(){
            this.hh = ""
            this.mm = ""
            this.ss = ""
        },

        start(){
            this.isstarted = true
        },

        stop(){
            this.isstarted = false
        },

        hh_onchange(){
            if(parseInt(this.hh) >300) this.hh = "300"
            this.strhh = this.hh.padStart(2,"0")
        },

        mm_onchange(){
            if(parseInt(this.mm) > 59) this.mm = "59"
            this.strmm = this.mm.padStart(2,"0")
        },

        ss_onchange(){
            if(parseInt(this.ss) > 59) this.ss = "59"
            this.strss = this.ss.padStart(2,"0")
        },

    },//methods
})
