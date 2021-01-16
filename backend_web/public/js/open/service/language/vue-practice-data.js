import openglobal from "/js/open/helpers/openglobal.js"
import openfuncs from "/js/open/helpers/openfuncs.js"

const get_questions = (id_langfrom, id_langto) => {
    const questions = openglobal.get_sentences_by_lang(id_langfrom)
    const answers = openglobal.get_answers_by_lang(id_langfrom)

    const all = [].concat(questions.map(quest => ({
       uuid: openfuncs.get_uuid(),
       type: "question",
       id: quest.id,
       translatable: quest.translatable,
       answer: openglobal.get_answer(id_langto, quest.id)["translated"]
    }))).concat(answers.map(answ => ({
        uuid: openfuncs.get_uuid(),
        type: "answer",
        id: answ.id,
        translatable: answ.translated,
        answer: openglobal.get_question(answ.id_sentence)["translatable"]
    })))

    return all
}

const questions = {
    get_test: ({quests, attempts, iquestions, config}) => {

        console.log(config)
        const all = get_questions(config.selsource, config.seltargets[0])
        console.log("all",all)
        console.table(all)

        const ishow = iquestions || 20
        const wrongnok = attempts.filter(obj => parseInt(obj.iresult)===0 || parseInt(obj.iresult)===2).map(obj => obj.id_sentence)
        const inwrong = quests.filter(quest => wrongnok.includes(quest.id)).map(obj => obj.id)
        const notin = quests.filter(quest => !wrongnok.includes(quest.id)).map(obj => obj.id)
        const final = quests.filter(quest => inwrong.includes(quest.id))
            //solo las textos del idioma de origen
            .filter(quest => quest.id_language === parseInt(config.selsource))
            .concat(quests.filter(quest => notin.includes(quest.id)))

        return final.filter((quest, i)=> i< ishow)
    }
}

export default questions
