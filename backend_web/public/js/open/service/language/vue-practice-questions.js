//vue-practice-questions
const questions = {
    get_test: ({quests, attempts, iquestions, config}) => {
        console.log("attempt",attempts)
        console.log("config",config)
        //const idsource = config.selsource
        //const idtarget = config.seltargets[0]

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
