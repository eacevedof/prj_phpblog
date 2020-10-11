import funcs from "/js/open/helpers/openfuncs.js"
import openapi from "/js/open/helpers/openapi.js"
import db from "/js/open/helpers/opendb.js"

const LANG_CONFIG = "lang-config"

const LANGUAGES = {
    "1":"sp","2":"nl","3":"en"
}

new Vue({
    el: "#div-practice-main",
    data: {
        config:{},
        isfinished: true,

        question:{

        },

        iquestions: 0,
        questions:[],
        answers:[],

        iquestion:0,
        ianswered:0,
        strquestion: "",
        stranswer: "",
        strlang: "",

    },//data

    mounted(){
        const config = db.select(LANG_CONFIG)
        if(config) {
            this.config = {...config}
            if(this.config.questions>0)
                this.iquestions = this.config.questions
        }
        this.load_questions()
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
            this.answers.push({"q":this.iquestion,"lang":this.strlang,"r":this.stranswer,"gr":""})
        },
        load_questions(){
            this.questions = objpractice.sentences
        },
        load_question(){
            this.strquestion = this.questions[this.iquestion-1]["translatable"]
        }
    },//methods
})
