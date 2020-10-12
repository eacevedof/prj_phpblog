import funcs from "/js/open/helpers/openfuncs.js"
import openapi from "/js/open/helpers/openapi.js"
import db from "/js/open/helpers/opendb.js"
//https://devhints.io/bulma

const LANG_CONFIG = "lang-config"

const LANGUAGES = {
    "1":"en","2":"sp","3":"nl"
}

new Vue({
    el: "#div-practice-main",
    data: {
        config:{},
        isfinished: true,

        iquestions: 0,
        questions:[],
        answers:[],

        idquestion: -1,
        iquestion:0,
        strquestion: "",
        stranswer: "",
        expanswer: "",

        langsource: "",
        langtarget: "",
        btnnext: "Siguiente"

    },//data

    mounted(){
        console.log("main mounted")
        const config = db.select(LANG_CONFIG)
        if(config) {
            this.load_questions()
            this.config = {...config}
            if(this.config.questions>0)
                this.iquestions = this.config.questions < this.questions.length ? this.config.questions: this.questions.length
            console.log("mounted iquestions",this.iquestions)
            //return
        }

        //funcs.pr(objpractice,"vue-language-practice")
        //console.log(JSON.stringify(objpractice))
    },//mounted

    methods:{
        restart(){
            this.answers = []
            this.isfinished = false
            this.iquestion = 1
            this.load_question()
            //this.$refs.answer.focus()
        },

        start(){
            this.answers = []
            this.isfinished = false
            this.iquestion = 1
            this.load_question()
            //this.$refs.answer.focus()
            console.log("refs",this.$refs,"refs.answer",this.$refs["answer"])
            this.focusanswer()
        },

        save(){
            const isok = this.is_good()
            this.focusanswer()
            if(isok) {
                toast.open({
                    message: "Respuesta correcta",
                    type:"is-success",
                })
                this.answers.push({"q": this.iquestion, "lang": this.langsource, "r": this.stranswer, "gr": ""})
                this.iquestion++
                //if(this.iquestion)
                this.load_question()
                return
            }
            toast.open({
                message: "Respuesta incorrecta",
                type:"is-danger",
            })
        },

        focusanswer(){
            const answer = this.$refs.answer
            if(answer) {
                answer.focus()
                answer.select()
            }
        },

        load_questions(){
            this.questions = objpractice.sentences
        },

        load_question(){
            console.log("idquestion",this.idquestion,"translate iquestions", this.iquestions)
            if(this.iquestion > this.iquestions) {
                this.isfinished = true
                return
            }

            this.stranswer = ""
            this.expanswer = ""

            const iq = this.iquestion - 1;
            console.log("iq",iq)
            this.idquestion = this.questions[iq].id
            this.strquestion = this.questions[iq].translatable
            this.langsource = LANGUAGES[this.questions[iq].id_language]
            this.langtarget = this.config.seltargets[0]
            if(this.iquestion === this.iquestions)
                this.btnnext = "Finalizar"
            //alert(this.langtarget)
        },

        is_good(){
            //const iq = this.iquestion - 1;
            const idlang = Object.keys(LANGUAGES).find(key => LANGUAGES[key]==this.langtarget)
            const answer = objpractice.sentence_tr
                                .filter(obj => parseInt(obj.id_language) === parseInt(idlang))
                                .filter(obj => obj.id_sentence === this.idquestion)
                                .map(obj => obj.translated)
                                .join()
                                .toLowerCase()
                                .trim()
            if(debug)  this.expanswer = answer
            return (this.stranswer.toLowerCase().trim() === answer)
        }

    },//methods
})
