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
    get_attempts_by_subject: async (idsubject)=>{
        const url = `/api/language/sentenceattempt`
        return await get(url)
    },
}

export default openapilanguage
