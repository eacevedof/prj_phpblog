import funcs from "/js/open/helpers/openfuncs.js"
import openapi from "/js/open/helpers/openapi.js"
import openapifetch from "/js/open/helpers/openapifetch.js";
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
        languages: [],

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
        btnskip: "Saltar",
        btnnext: "Siguiente"

    },//data

    async mounted(){
        console.log("main mounted")
        const config = db.select(LANG_CONFIG)
        if(!config) throw "vue-practice-main.js: Mising config"
        if(config) {
            this.load_questions()
            this.config = {...config}
            if(this.config.questions>0)
                this.iquestions = this.config.questions < this.questions.length ? this.config.questions: this.questions.length
            console.log("mounted iquestions",this.iquestions)
            //return
        }
        await this.load_languages()
    },//mounted

    methods:{
        load_languages: async function () {
            const languages = await openapifetch.get_languages()
            //this.languages = languages.map(obj => Object.entries(obj).map( obj => console.log(obj)))
            //funcs.pr(this.languages)
        },

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
            this.$nextTick(()=> this.focusanswer())
        },
        save(){
            const isok = this.is_good()
            this.focusanswer()
            if(isok) {
                toast.open({
                    message: "Respuesta correcta",
                    type:"is-success",
                })
                this.answers.push({
                    id:this.iquestion,
                    question: this.strquestion,
                    lang: this.langsource,
                    answer: this.stranswer,
                    expected: this.expanswer,
                    status: "ok"
                })
                this.iquestion++
                this.load_question()
                return
            }
            toast.open({
                message: "Respuesta incorrecta",
                type:"is-danger",
            })
        },

        skip(){
            alert("xxx")
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
