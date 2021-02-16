import db from "/js/open/helpers/opendb.js"

Vue.use(VueToast, {position:"top"})

const app = new Vue({
    el: "#form-ohmslaw",

    data: {
        v: 0,
        i: 0,
        r: 0,
    },

    mounted(){
        this.$refs.i.focus()
    },

    methods:{
        sanitize_input(){
            if(!this.v) this.v = 0
            if(!this.i) this.i = 0
            if(!this.r) this.r = 0
        },

        clear(){
            this.v = 0
            this.i = 0
            this.r = 0
            this.$refs.i.focus()
        },

        v_onchange(){
            if(parseInt(this.hh) >300) this.hh = "300"
            this.strhh = this.hh.padStart(2,"0")
            this.seconds = this.get_seconds()
        },

        i_onchange(){
            if(parseInt(this.mm) > 59) this.mm = "59"
            this.strmm = this.mm.padStart(2,"0")
            this.seconds = this.get_seconds()
        },

        r_onchange(){
            if(parseInt(this.ss) > 59) this.ss = "59"
            this.strss = this.ss.padStart(2,"0")
            this.seconds = this.get_seconds()
        },

    },//methods
})
