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

        iquestion:0,
        ianswered:0,
        strquestion: "",
        stranswer: "",
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
            return
        }

        //funcs.pr(objpractice,"vue-language-practice")
        //console.log(JSON.stringify(objpractice))
    },//mounted

    methods:{
        restart(){
            this.isfinished = false
            this.iquestion = 1
            this.load_question()
        },
        start(){
            this.isfinished = false
            this.iquestion = 1
            this.load_question()
        },

        save(){
            const isok = this.is_good()
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

        load_questions(){
            this.questions = objpractice.sentences
        },

        load_question(){
            const iq = this.iquestion - 1;
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
                                .filter(obj => parseInt(obj.id_language) == parseInt(idlang))
                                .map(obj => obj.translated)
                                .join()
                                .toLowerCase()
                                .trim()
            return (this.stranswer.toLowerCase().trim() === answer)
        }

    },//methods
})
