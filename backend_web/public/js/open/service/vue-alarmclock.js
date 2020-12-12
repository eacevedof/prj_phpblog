import openapi from "/js/open/helpers/openapi.js"

Vue.use(VueToast, {position:"top"})

let intervalid = 0

const DEFAULT = {
    HH: "00",
    MM: "00",
    SS: "10",
}

const app = new Vue({
    el: "#form-alarmclock",

    data: {
        isstarted: false,

        btnstart: "Inicio",
        btnstop: "Detener",
        btnreset: "Reinicio",

        hh: DEFAULT.HH,
        mm: DEFAULT.MM,
        ss: DEFAULT.SS,

        audio: null,
        seconds: 0,
    },

    mounted(){
        this.strhh = this.hh.padStart(2,"0")
        this.strmm = this.mm.padStart(2,"0")
        this.strss = this.ss.padStart(2,"0")
        this.$refs.hh.focus()
        this.audio = this.$refs.audio
    },

    methods:{

        sound(){
            this.audio.play()
        },

        discount(){
            const self = this
            intervalid = setInterval(function(){
                self.seconds = self.seconds - 1
                if(self.seconds === 0) {
                    self.sound()
                    clearInterval(intervalid)
                    self.start()
                }
            },
            1000)
            console.log("interval-id",intervalid)
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
            clearInterval(intervalid)
        },

        restart(){
            this.stop()
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
