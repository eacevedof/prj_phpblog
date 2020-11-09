const objglobal = objpractice || {}
console.table(objglobal.sentences); console.table(objglobal.sentence_tr)

const openglobal = {
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
        return objglobal.sentence_tr
            .filter(obj => parseInt(obj.id_sentence) === parseInt(idsentence))
            .filter(obj => parseInt(obj.id_language) === parseInt(idlanguage))[0] || {}
    },

    get_sentences(){ return objglobal.sentences }
}
export default openglobal
