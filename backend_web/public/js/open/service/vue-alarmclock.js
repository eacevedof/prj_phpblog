import openapi from "/js/open/helpers/openapi.js"

Vue.use(VueToast, {position:"top"})

const app = new Vue({
    el: "#form-alarmclock",
    data: {
        isstarted: false,
        btnstart: "Inicio",
        btnstop: "Detener",
        btnreset: "Resetaar",

        hh: "0",
        mm: "0",
        ss: "20",

        strhh: "",
        strmm: "",
        strss: "",

        remain:{
            hh:0,
            mm:0,
            ss:0,
        },

        audio: null,
        seconds: 0,

        intevalid: 0,
    },

    mounted(){
        this.strhh = this.hh.padStart(2,"0")
        this.strmm = this.mm.padStart(2,"0")
        this.strss = this.ss.padStart(2,"0")
        this.$refs.hh.focus()
        //this.$nextTick(() => this.audio = this.refs.audio)
    },

    methods:{

        discount(){
            const self = this
            this.intevalid = setInterval(function(){
                self.seconds = self.seconds - 1
                if(self.seconds === 0)
                    clearInterval(self.intevalid)
            },
            1000)
            console.log("interval-id",self.intevalid)
        },

        get_seconds() {
            return (parseInt(this.hh)*60*60) + (parseInt(this.mm)*60) + parseInt(this.ss)
        },

        start(){
            this.isstarted = true
            this.seconds = this.get_seconds()
            this.discount()
        },

        stop(){
            this.isstarted = false
        },

        reset(){
            this.stop()
            this.hh = 0
            this.mm = 0
            this.ss = 20
            this.start()
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
