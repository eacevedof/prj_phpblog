import funcs from "./openfuncs.js";

const openapifetch = {
    get_categories: async ()=>{
        //const _token = funcs.get_csrftoken()
        const url = "/api/post/category"
        let r = null
        try {
            r = await (await fetch(url)).json()
            return r.data
        }
        catch (e) {
            r = e
            return {error:e}
        }
        finally {
            console.log("get_categories.r",r)
        }
    },

    get_sources: async ()=>{
        const url = "/api/app-array/source"
        let r = null
        try {
            r = await (await fetch(url)).json()
            return r.data
        }
        catch (e) {
            r = e
            return {error:e}
        }
        finally {
            console.log("get_sources.r",r)
        }
    },

    get_languages: async ()=>{
        const url = "/api/picklist/language"
        let r = null
        try {
            const r = await (await fetch(url)).json()
            return r.data
        }
        catch (e) {
            return {error:e}
        }
        finally {
            console.log("get_languages.r",r)
        }
    },

    get_contexts: async ()=>{
        const url = "/api/app-array/lang-context"
        let r = null
        try {
            r = await (await fetch(url)).json()
            return r.data
        }
        catch (e) {
            return {error:e}
        }
        finally {
            console.log("get_langcontexts.r",r)
        }
    },

    get_types: async ()=>{
        const url = "/api/app-array/lang-type"
        let r = null
        try {
            r = await (await fetch(url)).json()
            return r.data
        }
        catch (e) {
            return {error:e}
        }
        finally {
            console.log("get_langtypes.r",r)
        }
    },
}

export default openapifetch
