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

        },

        i_onchange(){

        },

        r_onchange(){

        },

    },//methods
})
