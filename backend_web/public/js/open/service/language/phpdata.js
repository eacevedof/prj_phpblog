//objpractice variable definida en blade
const objglobal = objpractice || {}
//console.log("phpdata objglobal.sentences")
//console.table(objglobal.sentences);
//console.log("phpdata objglobal.stence_tr")
//console.table(objglobal.sentence_tr)

const phpdata = {
    get_stranswer(idlanguage, idsentence){
        const r = objglobal.sentence_tr
            .filter(obj => parseInt(obj.id_sentence) === parseInt(idsentence))
            .filter(obj => parseInt(obj.id_language) === parseInt(idlanguage))
            .map(obj => obj.translated)
            .join()
        //console.log("global.sentcetr",idlanguage,idsentence,"get_stranswer",r)
        return r;
    },

    get_answer(idlanguage, idsentence){
        //alert(idlanguage)
        //console.log("answ.idlang",idlanguage)
        return objglobal.sentence_tr
            .filter(obj => parseInt(obj.id_sentence) === parseInt(idsentence))
            .filter(obj => parseInt(obj.id_language) === parseInt(idlanguage))[0] || {}
    },

    get_question(idlanguage, idsentence){
        return objglobal.sentences
            .filter(obj => parseInt(obj.id) === parseInt(idsentence))
            .filter(obj => parseInt(obj.id_language) === parseInt(idlanguage))[0] || {}
    },

    get_sentences(){ return objglobal.sentences },

    get_sentences_by_lang(idlanguage){
        return objglobal.sentences.filter(obj => obj.id_language === parseInt(idlanguage))
    },

    get_answers_by_lang(idlanguage){
        return objglobal.sentence_tr.filter(obj =>obj.id_language === parseInt(idlanguage))
    }
}

export default phpdata

