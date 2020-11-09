import funcs from "./openfuncs.js";

async function get (url){
    let r = null
    try {
        r = await (await fetch(url)).json()
        return r.data
    }
    catch (e) {
        r = e
        console.error("error:",url,e)
        return {error:e}
    }
    finally {
        console.log("url:",url,"result:",r)
    }
}

const openapilanguage = {
    get_attempts_by_subject: async idsubject => {
        const url = `/api/language/subject/${idsubject}/sentenceattempts`
        const r = await get(url)
        return r
    },

    get_tops_by_subject: async idsubject => {
        const url = `/api/language/subject/${idsubject}/sentencetops`
        const r = await get(url)
        return r
    },

    save_attempt: async obj => {
        const url = `/api/language/sentenceattempt`
        try {
            const form = new FormData()
            form.append("_token", funcs.get_csrftoken())
            form.append("action","sentenceattempt-insert")
            form.append("id_sentence_tr", obj.id_sentence_tr)
            form.append("iresult", obj.iresult)

            const attempts = await fetch(url,{method: 'post', body: form})
            const r = (await attempts.json()).data
            return r
        }
        catch (e) {
            return {error:e}
        }
    },

}

export default openapilanguage
