import phpdata from "/js/open/service/language/phpdata.js"
import openfuncs from "/js/open/helpers/openfuncs.js"

const get_questions = (id_langfrom, id_langto) => {
    console.log("langs from:",id_langfrom, "to:",id_langto)
    const questions = phpdata.get_sentences_by_lang(id_langfrom)
    const answers = phpdata.get_answers_by_lang(id_langfrom)

    const all = [].concat(questions.map(quest => ({
       uuid: openfuncs.get_uuid(5),
       type: "question",
       id: quest.id,
       translatable: quest.translatable,
       id_answer: phpdata.get_answer(id_langto, quest.id).id,
       answer: phpdata.get_answer(id_langto, quest.id).translated || ""
    }))).concat(answers.map(answ => ({
        uuid: openfuncs.get_uuid(5),
        type: "answer",
        id: answ.id_sentence,
        id_answer: answ.id,
        translatable: answ.translated,
        answer: phpdata.get_question(id_langto, answ.id_sentence).translatable || ""
    }))).filter(quest => quest.answer !== ""  )

    return all
}

const questions = {

    get_all: config => get_questions(config.selsource, config.seltargets[0]),

    get_final: ({attempts, config}) => {
        const all = get_questions(config.selsource, config.seltargets[0])
        console.log("all")
        console.table(all)
        const iquestions = config.questions

        const ishow = iquestions || 20
        //0: error o 2: skip
        const idnoks = attempts.filter(att => parseInt(att.iresult)===0 || parseInt(att.iresult)===2).map(att => att.id_sentence)
        const inwrong = all.filter(quest => idnoks.includes(quest.id_answer)).map(quest => quest.id_answer)
        const idoks = all.filter(quest => !idnoks.includes(quest.id_answer)).map(quest => quest.id_answer)

        //todos los que tienen errores o saltos
        const final = all.filter(quest => inwrong.includes(quest.id_answer))
            .concat(all.filter(quest => idoks.includes(quest.id_answer)))

        return final.filter((quest, i) => i< ishow)
    }
}

const regexp = new RegExp(/[\'\"\:\,\.\?\;\+\!\(\)\?]/gi)

export const answers = {


    is_good(str1, strexp) {
        const answeer = str1.toLowerCase().split(" ").map(str => str.replace(regexp,"").trim()).filter(str => str!=="").join(" ")
        const expected = strexp.toLowerCase().split(" ").map(str => str.replace(regexp,"").trim()).filter(str => str!=="").join(" ")
        console.log("answer:",answeer,"expected:",expected)
        return answeer===expected
    },

    get_wrongword(str1, str2) {
        const aranswer = str1.trim().toLowerCase().split(" ").
                            map(str => str.replace(regexp,"").trim()).
                            filter( str => str!=="")
        //expected
        const arexpect = str2.trim().
                            toLowerCase().
                            split(" ").
                            map(str => str.replace(regexp,"").trim()).
                            filter(str => str!=="")

        const r = aranswer.filter((str,i) => i !== arexpect.indexOf(str,i))[0]
        console.log("get_wrongword aranswer",aranswer,"arexpect",arexpect,"r:",r)
        return r ? r : aranswer[0]
    },
}

export default questions
