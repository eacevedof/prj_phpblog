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


const openapifetch = {
    get_categories: async ()=>{
        const url = "/api/post/category"
        return await get(url)
    },

    get_sources: async ()=>{
        const url = "/api/app-array/source"
        return await get(url)
    },

    get_languages: async ()=>{
        const url = "/api/picklist/language"
        return await get(url)
    },

    get_contexts: async ()=>{
        const url = "/api/app-array/lang-context"
        return await get(url)
    },

    get_types: async ()=>{
        const url = "/api/app-array/lang-type"
        return await get(url)
    },
}

export default openapifetch
