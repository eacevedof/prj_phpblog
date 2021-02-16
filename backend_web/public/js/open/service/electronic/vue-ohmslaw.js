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
            if(this.i!=0 || this.r!=0){

            }
        },

        i_onchange(){
            if(this.v!=0 || this.r!=0){
                if(this.v===0){
                    this.v = this.i * this.r
                }
            }
        },

        r_onchange(){
            if(this.v!==0 || this.i!==0){
                if(this.v===0){
                    this.v = this.i * this.r
                }
                else if(this.r!==0) {
                    this.i = this.v / this.r
                }
            }
        },

    },//methods
})
