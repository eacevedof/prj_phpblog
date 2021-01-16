import phpdata from "/js/open/service/language/phpdata.js"
import funcs from "/js/open/helpers/openfuncs.js"
import openapilanguage from "/js/open/helpers/openapilanguage.js"
import openapifetch from "/js/open/helpers/openapifetch.js"
import db from "/js/open/helpers/opendb.js"
import quest, {answers as answ} from "/js/open/service/language/vue-practice-data.js"
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

        uuid: "",
        iquestion: 0,
        strquestion: "",
        stranswer: "",
        expanswer: "",
        objanswer: {},
        itotal: 0,

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
    },//mounted

    methods:{
        load_attempts: async function(){
            const idsubject = objpractice.subject.id
            this.attempts = await openapilanguage.get_attempts_by_subject(idsubject)
        },

        load_tops: async function(){
            const idsubject = objpractice.subject.id
            this.tops = await openapilanguage.get_tops_by_subject(idsubject)
        },

        load_languages: async function () {
            const languages = await openapifetch.get_languages()
            this.languages = languages
        },

        load_questions(){

            this.questions = quest.get_final({
                attempts: this.attempts,
                config: this.config
            })

            this.itotal = quest.get_all(this.config).length

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
            this.objanswer = {}

            const iq = this.iquestion - 1;
            this.uuid = this.questions[iq].uuid
            this.strquestion = this.questions[iq].translatable
            this.langsource = this.get_langcode(parseInt(this.config.selsource)) //es,
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

        save_attempt: async function (iresult){
            const expanswer = this.questions.filter(quest => quest.uuid === this.uuid )
            if(expanswer.type==="question")
                openapilanguage.save_attempt({id_sentence_tr:expanswer.id, iresult})
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

        is_good(){
            if(!this.stranswer.trim()) return false

            const idlang = this.get_idlanguage(this.langtarget)
            this.expanswer = phpdata.get_stranswer(idlang, this.uuid)
            return answ.is_good(this.stranswer, this.expanswer)
        },

        save(){
            const isok = this.is_good()
            this.focusanswer()
            if(isok) {
                this.save_attempt(1)
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
                this.save_attempt(0)
            this.errorword = answ.get_wrongword(this.stranswer, this.expanswer)
            toast.open({
                message: "Respuesta incorrecta",
                type:"is-danger",
            })
        },

        skip(){
            this.save_attempt(2)

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
    },//methods
})
