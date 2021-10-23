Vue.use(VueToast, {position:"top"})

let intervalid = 0

const DEFAULT = {
    HH: 0,
    MM: 0,
    SS: 0,
}

const app = new Vue({
    el: "#form-alarmclock",

    data: {
        isstarted: false,

        btnstart: "Iniciar",
        btnstop: "Detener",
        btnrestart: "Reiniciar",

        hh: DEFAULT.HH,
        mm: DEFAULT.MM,
        ss: DEFAULT.SS,

        strhh: DEFAULT.HH.toString().padStart(2,"0"),
        strmm: DEFAULT.MM.toString().padStart(2,"0"),
        strss: DEFAULT.SS.toString().padStart(2,"0"),

        audio: null,
        seconds: 0,
        percent: "0",
        hhmmss: "",
    },

    mounted(){
        this.$refs.hh.focus()
        this.audio = this.$refs.audio
    },

    methods:{

        play_sound(){this.audio.play()},

        stop_sound(){
            this.audio.pause()
            this.audio.currentTime = 0
        },

        sanitize_input(){
            if(!this.hh) this.hh = 0
            if(!this.mm) this.mm = 0
            if(!this.ss) this.ss = 0
        },

        discount(){
            const self = this
            intervalid = setInterval(function(){
                self.seconds = self.seconds - 1
                self.hhmmss = self.get_hhmmss()
                self.percent = self.get_percent()
                console.log(self.percent)
                if(self.seconds === 0) {
                    self.play_sound()
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

        get_percent(){
            const total = this.get_seconds()
            if(!total) return 0
            return (Math.floor((this.seconds * 100) / total)).toString().concat("%")
        },

        get_hhmmss(){
            const objdate = new Date(null);
            objdate.setSeconds(this.seconds)
            return objdate.toISOString().substr(11,8)
        },

        start(){
            this.sanitize_input()
            this.isstarted = true
            this.seconds = this.get_seconds()
            if(this.seconds)
                this.discount()
        },

        stop(){
            this.btnstart = "Iniciar"
            this.percent = 0
            this.stop_sound()

            this.isstarted = false
            this.seconds = this.get_seconds()
            clearInterval(intervalid)
        },

        restart(){
            this.stop()
            this.start()
        },

        clear(){
            this.hh = DEFAULT.HH
            this.mm = DEFAULT.MM
            this.ss = DEFAULT.SS
            this.strhh = DEFAULT.HH.toString().padStart(2,"0")
            this.strmm = DEFAULT.MM.toString().padStart(2,"0")
            this.strss = DEFAULT.SS.toString().padStart(2,"0")
            this.seconds = this.get_seconds()
            this.hhmmss = this.get_hhmmss()
            this.$refs.hh.focus()
        },

        hh_onchange(){
            if(parseInt(this.hh) >300) this.hh = "300"
            this.strhh = this.hh.padStart(2,"0")
            this.seconds = this.get_seconds()
        },

        mm_onchange(){
            if(parseInt(this.mm) > 59) this.mm = "59"
            this.strmm = this.mm.padStart(2,"0")
            this.seconds = this.get_seconds()
        },

        ss_onchange(){
            if(parseInt(this.ss) > 59) this.ss = "59"
            this.strss = this.ss.padStart(2,"0")
            this.seconds = this.get_seconds()
        },

    },//methods
})
