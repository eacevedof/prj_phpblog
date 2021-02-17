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
        clear(){
            this.v = 0
            this.i = 0
            this.r = 0
            this.$refs.i.focus()
        },

        v_onchange(){
            if(this.v!==0) {
                if(this.i!==0) {
                    this.r = this.v / this.i
                }
                else {
                    this.i = this.v / this.r
                }
            }
        },

        i_onchange(){
            if(this.i!==0) {
                this.v = this.i / this.r
            }
        },

        r_onchange(){

        },

    },//methods
})
