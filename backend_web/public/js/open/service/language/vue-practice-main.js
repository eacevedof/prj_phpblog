import openglobal from "/js/open/helpers/openglobal.js"
import funcs from "/js/open/helpers/openfuncs.js"
import openapilanguage from "/js/open/helpers/openapilanguage.js"
import openapifetch from "/js/open/helpers/openapifetch.js"
import db from "/js/open/helpers/opendb.js"
//https://devhints.io/bulma

const LANG_CONFIG = "lang-config"

new Vue({
    el: "#div-practice-main",
    data: {
        config:{},
        languages: [],
        attempts: [],
        tops: [],

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

        iok: 0,
        inok: 0,
        iskipped: 0,
        errorword: "",

        btnskip: "Saltar",
        btnnext: "Siguiente"

    },//data

    async mounted(){
        const config = db.select(LANG_CONFIG)

        if(!config) return alert("No config found")

        if(config && Object.keys(config).length>0) {
            this.config = {...config}
            await this.load_languages()
            await this.load_attempts()
            await this.load_tops()

            this.load_questions()

            if(this.config.questions>0)
                this.iquestions = this.config.questions < this.questions.length ? this.config.questions: this.questions.length
        }
        console.log("MAIN MOUNTED","questions",this.iquestions,"attempts",this.attempts,"tops",this.tops)
    },//mounted

    methods:{
        load_attempts: async function(){
            this.attempts = await openapilanguage.get_tops_by_subject(idsubject)
        },

        load_tops: async function(){
            this.tops = await openapilanguage.get_attempts_by_subject(idsubject)
        },

        load_languages: async function () {
            const languages = await openapifetch.get_languages()
            this.languages = languages
        },

        load_questions(){
            this.questions = openglobal.get_sentences()
            //console.table(this.questions)
            if(this.config.israndom==="true") {
                this.questions = funcs.get_shuffled(this.questions)
            }
        },

        load_question(){
            if(this.iquestion > this.iquestions) {
                this.isfinished = true
                this.load_result()
                return
            }

            this.stranswer = ""
            this.expanswer = ""

            const iq = this.iquestion - 1;
            this.idquestion = this.questions[iq].id
            this.strquestion = this.questions[iq].translatable
            this.langsource = this.get_langcode(this.questions[iq].id_language) //es,
            this.langtarget = this.get_langcode(parseInt(this.config.seltargets[0]))

            if(this.iquestion === this.iquestions)
                this.btnnext = "Finalizar"
        },

        load_result(){
            this.iok = this.answers.filter(obj => obj.status === "ok").length
            this.inok = this.answers.filter(obj => obj.status === "nok").length
            this.iskipped = this.answers.filter(obj => obj.status === "skipped").length
        },

        get_langcode(idlanguage){
            return this.languages.filter(obj => obj.id === idlanguage).map(obj => obj.code_erp).join("")
        },

        get_idlanguage(langcode){
            return this.languages.filter(obj => obj.code_erp === langcode).map(obj => obj.id).join("")
        },

        save_attempt: async function (obj){
            const r = openapilanguage.save_attempt(obj)
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
                this.save_attempt({id_sentence_tr:1,iresult:1})
                this.errorword = ""
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

            if(this.stranswer.trim())
                this.save_attempt({id_sentence_tr:1,iresult:0})
            this.errorword = funcs.get_wrongword(this.stranswer, this.expanswer)
            toast.open({
                message: "Respuesta incorrecta",
                type:"is-danger",
            })
        },

        skip(){
            this.save_attempt({id_sentence_tr:1,iresult:2})
            this.answers.push({
                id:this.iquestion,
                question: this.strquestion,
                lang: this.langsource,
                answer: this.stranswer,
                expected: this.expanswer,
                status: "skipped"
            })
            this.errorword = ""
            this.iquestion++
            this.load_question()
        },

        focusanswer(){
            const answer = this.$refs.answer
            if(answer) {
                answer.focus()
                answer.select()
            }
        },

        is_good(){
            if(!this.stranswer.trim()) return false

            const idlang = this.get_idlanguage(this.langtarget)
            this.expanswer = openglobal.get_stranswer(idlang, this.idquestion)
            return funcs.is_good(this.stranswer, this.expanswer)
        }

    },//methods
})
